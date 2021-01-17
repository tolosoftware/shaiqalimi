<template>
<div>
  <vs-input v-validate="'required|email|min:3'" data-vv-validate-on="blur" name="email" icon-no-border icon="icon icon-user" icon-pack="feather" label="ایمیل" v-model="form.username" class="w-full" />
  <span class="text-danger text-sm">{{ errors.first('email') }}</span>

  <vs-input data-vv-validate-on="blur" v-validate="'required|min:6|max:10'" type="password" name="password" icon-no-border icon="icon icon-lock" icon-pack="feather" label="رمز ورود" v-model="form.password" class="w-full mt-6" />
  <span class="text-danger text-sm">{{ errors.first('password') }}</span>

  <div class=" w-full mt-3">
    <vs-button :disabled="!validateForm" @click="loginJWT">ورود</vs-button>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        username: '',
        password: '',
        grant_type: 'password',
        client_id: 2,
        client_secret: '3uqtjmiGhLD4NaPElH7FrDb6hB2C8fUTVfSHtTlt',
        scope: '*'
      })
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any() && this.form.username !== '' && this.form.password !== ''
    }
  },
  created() {
    this.checkLogin();
    window.addEventListener('keydown', (e) => {
      if (e.key == 'Enter') {
        if(!e.path.find(x => x.className === 'vs-textarea')){
          this.loginJWT();
        }
      }
    });
  },
  methods: {
    checkLogin() {
      if (localStorage.getItem('token')) {
        console.log('go to dashboard');
         this.$router.push({ path: '/dashboard' });
        // this.$router.go('/dashboard');
        this.$vs.notify({
          title: 'شما به سیستم از قبل دسترسی دارید',
          text: 'برای وارد شدن از حساب جدید اول از سیستم خارج شوید',
          color: 'success',
          iconPack: 'feather',
          icon: 'icon-check',
          position: 'top-right'
        })
      }
    },
    loginJWT() {
      this.$vs.loading()
      this.form.post('/oauth/token')
        .then((data) => {
          localStorage.setItem('token', data.data.access_token);
          this.$router.push({ path: '/dashboard' });
          this.$vs.notify({
            title: 'به سیستم خوش آمدید',
            text: 'عملیه ورود موفقانه بود',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
          this.form.reset();
          this.$vs.loading.close()
        })
        .catch(() => {
          this.$vs.notify({
            title: 'عملیه ورود به سیستم ناموفق بود ',
            text: 'لطفا دوباره تلاش نماید',
            color: 'danger',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
          this.$vs.loading.close()
        })
    },

  }
}
</script>
