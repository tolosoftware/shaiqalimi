<template>
<div>
  <div slot="header"><span>صلاحیت های کاربر را انتخاب کنید</span>
    <span class="float-right">
      <vs-button @click="setAllPrivilages(checkAll)" color="danger">
        {{ (checkAll)? 'دادن همه صلاحیت ها':'گرفتن همه صلاحیت ها' }}
      </vs-button>
    </span>
  </div>
  <vs-row class="pt-5 pb-5">
    <ul class="demo-alignment flex space-between">
      <li v-for="(n, index) in privileges" :key="index" class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pt-3 pb-3">
        <div class="vs-component con-vs-checkbox vs-checkbox-success vs-checkbox-default">
          <input type="checkbox" class="vs-checkbox--input" v-model="privileges[index].assign" @click="privileges[index].assign = !privileges[index].assign">
          <span class="checkbox_x vs-checkbox" style="border: 2px solid rgb(180, 180, 180);">
            <span class="vs-checkbox--check">
              <i class="vs-icon notranslate icon-scale vs-checkbox--icon  material-icons null">check</i>
            </span>
          </span>
          <span class="con-slot-label">{{privileges[index].name}}</span>
        </div>
      </li>
    </ul>
    <vs-col class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pt-3 pb-3">
      <div class="w-full">
        <vs-button class="w-full mt-6 input-height" @click.stop="storePrivilages(privileges)">ثبت صلاحیت های کابر</vs-button>
      </div>
    </vs-col>

  </vs-row>
</div>
</template>

<script>
export default {
  props: {
    source: {
      required: false
    },
  },
  data() {
    return {
      privileges: [],
      user: null,
      checkAll: true,
    }
  },
  methods: {
    getPermissions(user) {
      this.user = user;
      this.axios.get('/api/permissions', {
          params: {
            id: user.id
          }
        })
        .then((response) => {
          this.privileges = response.data;
          this.$emit('closeModal');
        })
    },
    storePrivilages(p) {
      swal.fire({
        title: `آیا از صلاحیت های تعیین شده برای ${this.user.firstName} ${this.user.lastName} مطمیٔن هستید؟`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، ثبت شود!</span>',
        cancelButtonText: '<span>خیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.$Progress.start()
          this.axios.post('/api/permissions', [this.user.id, this.privileges.filter((e) => e.assign === true)])
            .then((response) => {
              this.privileges = response.data;
              this.$emit('closeModal');

              this.$Progress.set(100)
              this.$vs.notify({
                title: 'موفقیت!',
                text: 'صلاحیت های کاربر موفقانه ثبت شد.',
                color: 'success',
                iconPack: 'feather',
                icon: 'icon-check',
                position: 'top-right'
              })
            }).catch((errors) => {
              this.$vs.notify({
                title: 'ناموفق!',
                text: 'لطفاً معلومات را چک کنید و دوباره امتحان کنید!',
                color: 'danger',
                iconPack: 'feather',
                icon: 'icon-cross',
                position: 'top-right'
              })
            });
        }
      })
    },
    setAllPrivilages(value) {
      for (const key of Object.keys(this.privileges)) {
        this.privileges[key]['assign'] = value
      }
      this.checkAll = !value
    }
  }

}
</script>

<style>

</style>
