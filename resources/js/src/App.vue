<!-- =========================================================================================
  File Name: App.vue
  Description: Main vue file - APP
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent

  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
<div id="app" :class="vueAppClasses">
  <router-view :currentuser="currentuserdata" @setAppClasses="setAppClasses" />
  <!-- <router-view :key="$route.fullPath" @setAppClasses="setAppClasses" /> -->
  <!-- set progressbar -->
  <vue-progress-bar></vue-progress-bar>
</div>
</template>

<script>
import themeConfig from '@/../themeConfig.js'
import jwt from '@/http/requests/auth/jwt/index.js'

export default {
  data() {
    return {
      vueAppClasses: [],
      currentuserdata: [],
    }
  },
  watch: {
    '$store.state.theme'(val) {
      this.toggleClassInBody(val)
    },
    '$vs.rtl'(val) {
      document.documentElement.setAttribute('dir', val ? 'rtl' : 'ltr')
    }
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
          localStorage.setItem('user_permissions', this.currentuserdata.permission_keys)

        }).catch(() => {

          this.$router.push({
            path: '/login'
          });
          if (this.$route.name != 'login') {
            this.$vs.notify({
              title: ' شما به سیستم دسترسی ندارید!',
              text: 'عملیه  ناکام شد لطفا دوباره تلاش نماید',
              color: 'danger',
              iconPack: 'feather',
              icon: 'icon-check',
              position: 'top-right'
            })
          }
        })
    },

    toggleClassInBody(className) {
      if (document.body) {
        if (className === 'dark') {
          if (document.body.className.match('theme-semi-dark')) document.body.classList.remove('theme-semi-dark')
          document.body.classList.add('theme-dark')
        } else if (className === 'semi-dark') {
          if (document.body.className.match('theme-dark')) document.body.classList.remove('theme-dark')
          document.body.classList.add('theme-semi-dark')
        } else {
          if (document.body.className.match('theme-dark')) document.body.classList.remove('theme-dark')
          if (document.body.className.match('theme-semi-dark')) document.body.classList.remove('theme-semi-dark')
        }
      }
    },

    setAppClasses(classesStr) {
      this.vueAppClasses.push(classesStr)
    },

    handleWindowResize() {
      this.$store.commit('UPDATE_WINDOW_WIDTH', window.innerWidth)
      // Set --vh property
      document.documentElement.style.setProperty('--vh', `${window.innerHeight * 0.01}px`)
    },
    handleScroll() {
      this.$store.commit('UPDATE_WINDOW_SCROLL_Y', window.scrollY)
    }
  },
  mounted() {
    this.toggleClassInBody(themeConfig.theme)
    this.$store.commit('UPDATE_WINDOW_WIDTH', window.innerWidth)

    const vh = window.innerHeight * 0.01
    // Then we set the value in the --vh custom property to the root of the document
    document.documentElement.style.setProperty('--vh', `${vh}px`)
  },
  beforeMount() {
    this.loadcurrentuser();
  },
  async created() {

    // jwt
    jwt.init()
    const dir = this.$vs.rtl ? 'rtl' : 'ltr'
    document.documentElement.setAttribute('dir', dir)
    window.addEventListener('resize', this.handleWindowResize)
    window.addEventListener('scroll', this.handleScroll)
    // Auth0
    // try { await this.$auth.renewTokens() } catch (e) { console.error(e) }

  },
  destroyed() {
    window.removeEventListener('resize', this.handleWindowResize)
    window.removeEventListener('scroll', this.handleScroll)
  }
}
</script>
