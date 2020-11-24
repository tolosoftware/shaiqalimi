<template>
  <vs-tabs>
      <vs-tab label="پروفایل">
        <profile-details />
      </vs-tab>
      <vs-tab label="لیست کاربران">
        <user-list />
      </vs-tab>
      <vs-tab label="ثبت کاربر">
        <register-user />
      </vs-tab>
    </vs-tabs>
</template>
<script>

import ProfileDetails from './ProfileDetails'
import RegisterUser from './sub/RegisterUser'
import UserList from './sub/UserList'
export default {
  components:{
    ProfileDetails,
    RegisterUser,
    UserList
  }
}
</script>