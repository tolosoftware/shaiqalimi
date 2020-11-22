<template>
  <form action method="post">
    <div class="vx-row mb-6 w-1/3">
      <div class="vx-col w-full">
        <vs-input class="w-full" label="نام" v-model="user.name"/>
      </div>
    </div>
    <div class="vx-row mb-6 w-1/3">
      <div class="vx-col w-full">
        <vs-input class="w-full" label="تخلص" v-model="user.lastname"/>
      </div>
    </div>
    <div class="vx-row mb-6 w-1/3">
      <div class="vx-col w-full">
        <vs-input class="w-full" type="email" label="ایمیل" v-model="user.email"/>
      </div>
    </div>
    <div class="vx-row mb-6 w-1/3">
      <div class="vx-col w-full">
        <vs-input class="w-full" label="شماره تماس" v-model="user.phone"/>
      </div>
    </div>
    <div class="vx-row mb-6 w-1/3">
      <div class="vx-col w-full">
        <vs-input class="w-full" label="آدرس" v-model="user.address"/>
      </div>
    </div>
    <div class="vx-row mb-6 w-1/3">
      <div class="vx-col w-full">
        <vs-input class="w-full" label="نام کاربری" v-model="user.username"/>
      </div>
    </div>
    <div class="vx-row mb-6 w-1/3">
      <div class="vx-col w-full">
        <vs-input class="w-full" label="زبان" v-model="user.language"/>
      </div>
    </div>
    <div class="vx-row mb-6 w-1/3">
      <div class="vx-col w-full">
        <vs-input class="w-full" type="password" label="رمز" v-model="user.password"/>
      </div>
    </div>
    <div class="vx-row pt-5">
      <div class="vx-col w-full">
        <vs-button class="mr-3 mb-2">ثبت</vs-button>
        <vs-button
          color="warning"
          type="border"
          class="mb-2"
        >پاک کردن</vs-button>
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
        passwordCon: ''
      }
    }
  }

}
</script>