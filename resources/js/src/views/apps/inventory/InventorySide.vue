<template>
  <vs-sidebar
    class="items-no-padding"
    parent="#inventory-app"
    id="inventory-list-sidebar"
    :click-not-close="clickNotClose"
    :hidden-background="clickNotClose"
    v-model="isSidebarActive"
  >
    <h1>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat quam a consectetur corporis itaque! Voluptatibus, assumenda, natus est placeat voluptate beatae perspiciatis ullam voluptas excepturi ab accusantium eligendi enim eum.</h1>
  </vs-sidebar>
</template>
<script>
export default {
  data() {
    return {
      active: true,
      isHidden: false,
      searchContact: '',
      activeProfileSidebar: false,
      activeChatUser: null,
      userProfileId: -1,
      typedMessage: '',
      isChatPinned: false,
      settings: {
        maxScrollbarLength: 60,
        wheelSpeed: 0.70
      },
      clickNotClose: false,
      isSidebarActive: false,
      isLoggedInUserProfileView: false
    }
  },
  methods:{
    toggleSidebar(){
      this.isSidebarActive = !this.isSidebarActive;
    }
  }
}
</script>
