<template>
  <form action method="post">
    <div class="vx-row">
      <div class="vx-row w-2/3">
        <div class="vx-col mb-6 w-1/2">
          <div class="w-full">
            <vs-input class="w-full" label="نام" v-model="user.name" />
          </div>
        </div>
        <div class="vx-col mb-6 w-1/2">
          <div class="w-full">
            <vs-input class="w-full" label="تخلص" v-model="user.lastname" />
          </div>
        </div>
        <div class="vx-col mb-6 w-1/2">
          <div class="w-full">
            <vs-input class="w-full" type="email" label="ایمیل" v-model="user.email" />
          </div>
        </div>
        <div class="vx-col mb-6 w-1/2">
          <div class="w-full">
            <vs-input class="w-full number-rtl" label="شماره تماس" v-model="user.phone" />
          </div>
        </div>
        <div class="vx-col mb-6 w-1/2">
          <div class="w-full">
            <vs-input class="w-full" label="آدرس" v-model="user.address" />
          </div>
        </div>
        <div class="vx-col mb-6 w-1/2">
          <div class="w-full">
            <vs-input class="w-full" label="نام کاربری" v-model="user.username" />
          </div>
        </div>
        <div class="vx-col mb-6 w-1/2">
          <div class="w-full">
            <vs-input class="w-full" label="زبان" v-model="user.language" />
          </div>
        </div>
        <div class="vx-col mb-6 w-1/2">
          <div class="w-full">
            <vs-input class="w-full" type="password" label="رمز" v-model="user.password" />
          </div>
        </div>
      </div>
      <div class="vx-col w-1/3">
        <!-- Product Image -->
        <template v-if="dataImg">
          <!-- Image Container -->
          <div class="img-container w-64 mx-auto flex items-center justify-center">
            <img :src="dataImg" width="50px" height="50px" alt="img" class="user_image responsive" />
          </div>

          <!-- Image upload Buttons -->
          <div class="modify-img flex justify-between mt-5">
            <input
              type="file"
              class="hidden"
              ref="updateImgInput"
              @change="updateCurrImg"
              accept="image/*"
            />
            <vs-button
            
              class="mr-4"
              type="flat"
              @click="$refs.updateImgInput.click()"
            >تغییر</vs-button>
            <vs-button type="flat" color="#999" @click="dataImg = null">حذف</vs-button>
          </div>
        </template>
        <!-- Upload -->
        <!-- <vs-upload text="Upload Image" class="img-upload" ref="fileUpload" /> -->

        <div class="upload-img mt-5 text-center" v-if="!dataImg">
          <input
            type="file"
            class="hidden"
            ref="uploadImgInput"
            @change="updateCurrImg"
            accept="image/*"
          />
          <vs-button @click="$refs.uploadImgInput.click()">آپلود تصویر</vs-button>
        </div>
      </div>
    </div>
    <div class="vx-row">
      <div class="vx-col pt-5">
        <div class="w-full">
          <vs-button class="mr-3 mb-2">ثبت</vs-button>
          <vs-button color="warning" type="border" class="mb-2">پاک کردن</vs-button>
        </div>
      </div>
    </div>
  </form>
</template>
<script>
export default {
  data() {
    return {
      user: {
        name: '',
        lastname: '',
        email: '',
        phone: '',
        address: '',
        country: '',
        language: '',
        username: '',
        password: '',
        passwordCon: '',
      },
      dataImg: null,
    }
  },
  watch: {
  },
  computed: {
    isFormValid() {
      return !this.errors.any() && this.dataName && this.dataCategory && this.dataPrice > 0
    },
    scrollbarTag() {return this.$store.getters.scrollbarTag}
  },
  methods: {
    initValues() {
      this.dataImg = null
    },
    submitData() {
      this.$validator.validateAll().then(result => {
        if (result) {
          const obj = {
            img: this.dataImg,
          }
          this.initValues()
        }
      })
    },
    updateCurrImg(input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.dataImg = e.target.result
          
        }
        reader.readAsDataURL(input.target.files[0])
      }
    }
  }
}
</script>