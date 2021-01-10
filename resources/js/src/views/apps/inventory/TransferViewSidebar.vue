<!-- =========================================================================================
  File Name: AddNewDataSidebar.vue
  Description: Add New Data - Sidebar component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
<vs-sidebar position-right parent="#app" default-index="1" color="primary" class="add-new-data-sidebar transfer-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
  <div class="mt-6 flex items-center justify-between px-6 float-right">
    <feather-icon icon="XIcon" @click.stop="$emit('closeSidebar')" class="cursor-pointer"></feather-icon>
  </div>

  <vs-tabs>
    <vs-tab label="انتقالات">
      <AllTransfer></AllTransfer>
    </vs-tab>
    <vs-tab label="ثبت انتقال">
      <AddNewTransfer></AddNewTransfer>
    </vs-tab>
  </vs-tabs>
</vs-sidebar>
</template>

<script>
import vSelect from 'vue-select'
import AllTransfer from './add/AllTransfer';
import AddNewTransfer from './add/AddNewTransfer';

export default {
  props: {
    isSidebarActive: {
      type: Boolean,
      required: true
    },
    data: {
      type: Object,
      default: () => {}
    }
  },
  components: {
    'v-select': vSelect,
    AllTransfer,
    AddNewTransfer,
  },
  watch: {},
  computed: {
    isSidebarActiveLocal: {
      get() {
        return this.isSidebarActive
      },
      set(val) {
        if (!val) {
          // this.isSidebarActive = !this.isSidebarActive;
          this.$emit('closeSidebar')
          // this.$validator.reset()
          // this.initValues()
        }
      }
    },
  },
}
</script>

<style lang="scss" scoped>
.add-new-data-sidebar {
  ::v-deep .vs-sidebar--background {
    z-index: 52010;
  }

  ::v-deep .vs-sidebar {
    z-index: 52010;
    width: 500px;
    max-width: 90vw;

    .img-upload {
      margin-top: 2rem;

      .con-img-upload {
        padding: 0;
      }

      .con-input-upload {
        width: 100%;
        margin: 0;
      }
    }
  }
}

.scroll-area--data-list-add-new {
  // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
  height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);

  &:not(.ps) {
    overflow-y: auto;
  }
}
</style>
