<!-- =========================================================================================
  File Name: App.vue
  Description: Main vue file - APP
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent

  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>

</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      currentuserdata: [],
    }
  },

  created() {
    this.loadcurrentuser();
  },
  methods: {
    loadcurrentuser() {
      this.axios.get('/api/user')
        .then((response) => {
          this.currentuserdata = response.data
          localStorage.setItem('name', this.currentuserdata.firstName)
          localStorage.setItem('lastname', this.currentuserdata.lastName)
          localStorage.setItem('position', this.currentuserdata.position)
          localStorage.setItem('image', this.currentuserdata.image)
          localStorage.setItem('id', this.currentuserdata.id)
        }).catch(() => {
          this.$router.push({
            path: '/login'
          });
          this.$vs.notify({
            title: ' شما به سیستم دسترسی ندارید!',
            text: 'عملیه  ناکم شد لطفا دوباره تلاش نماید',
            color: 'danger',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        })
    },
  },

}
</script>
