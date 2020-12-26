<!-- =========================================================================================
  File Name: AddNewDataSidebar.vue
  Description: Add New Data - Sidebar component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
<vs-sidebar click-not-close position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
  <div class="mt-6 flex items-center justify-between px-6">
    <h4>حساب جدید اضافه کنید</h4>
    <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
  </div>
  <vs-divider class="mb-0"></vs-divider>

  <component :is="scrollbarTag" class="scroll-area--data-list-add-new" :settings="settings" :key="$vs.rtl">
    <div class="pt-6 pr-6 pl-6">
      <!-- NAME -->
      <div class="vx-col mt-4">
        <label for=""><small>نوعیت</small></label>
        <v-select label="title" v-model="accForm.type_id" :options="accountTypes" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
      </div>
      <vs-input label="ریفرینس کد" v-model="accForm.ref_code" type="number" class="mt-5 w-full" name="ref_code" />
      <!-- NAME -->
      <vs-input label="نام" v-model="accForm.name" class="mt-5 w-full" name="name" v-validate="'required'" />

      <div class="vx-col mt-5">
        <label for="" class="ml-4 mr-4 mb-2">حالت</label>
          <div class="radio-group w-full">
            <div class="w-1/2">
              <input type="radio" v-model="accForm.status" value="1" id="struct" name="status" />
              <label for="struct" class="w-full text-center">فعال</label>
            </div>
            <div class="w-1/2">
              <input type="radio" v-model="accForm.status" value="2" id="specific" name="status" />
              <label for="specific" class="w-full text-center">غیرفعال</label>
            </div>
          </div>
      </div>

      <!-- NAME -->
      <div class="vx-row mt-4">
        <div class="vx-col w-1/2 pt-4">
          <!-- TITLE -->
          <label for=""> <small> کردیت</small></label>
          <vx-input-group class="mb-base">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>َAFN</span>
              </div>
            </template>

            <vs-input type="number" :disabled="accForm.id || accForm.debit > 0" v-model="accForm.credit"/>
          </vx-input-group>
          <!-- /TITLE -->
        </div>

        <div class="vx-col w-1/2 pt-4">
          <!-- TITLE -->
          <label for=""> <small> دبت</small></label>
          <vx-input-group class="mb-base">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>AFN</span>
              </div>
            </template>

            <vs-input type="number" :disabled="accForm.id || accForm.credit > 0" v-model="accForm.debit"/>
          </vx-input-group>
          <!-- /TITLE -->
        </div>
      </div>

      <vs-textarea placeholder="تفصیلات" v-model="accForm.description"/>
    </div>
  </component>

  <div class="flex flex-wrap items-center p-6" slot="footer">
    <vs-button class="mr-6" @click="submitData">انجام</vs-button>
    <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">بستن</vs-button>
  </div>
</vs-sidebar>
</template>

<script>
import vSelect from "vue-select";
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import SidebarDefaultVue from '../../components/vuesax/sidebar/SidebarDefault.vue';

export default {
  props: ['isSidebarActive', 'data', 'accForm'],
  components: {
    VuePerfectScrollbar,
    "v-select": vSelect,
  },
  data() {
    return {
      accountTypes: [],
      settings: {
        // perfectscrollbar settings
        // maxScrollbarLength: 60,
        // wheelSpeed: 0.6,
      },
    };
  },
  created(){
    this.getAllAccountTypes();
  },
  watch: {
  },
  computed: {
    isSidebarActiveLocal: {
      get() {
        return this.isSidebarActive;
      },
      set(val) {
        if (!val) {
          this.$emit("closeSidebar");
        }
      },
    },

    scrollbarTag() {
      return this.$store.getters.scrollbarTag;
    },
  },
  methods: {
    // Get Account Types
    getAllAccountTypes() {
      this.$Progress.start()
      this.axios.get('/api/acount_type')
        .then((response) => {
          this.accountTypes = response.data;
          this.$Progress.set(100)
        })
    },
    submitData() {
      if(this.accForm.id) {
        this.accForm.patch('/api/account/' + this.accForm.id)
          .then(({
            accForm
          }) => {
            // Finish the Progress Bar
            this.$vs.notify({
              title: 'موفقیت!',
              text: 'موفقانه ثبت شد.',
              color: 'success',
              iconPack: 'feather',
              icon: 'icon-check',
              position: 'top-right'
            })
          }).catch((errors) => {
            this.$Progress.set(100)
            this.$vs.notify({
              title: 'ناموفق!',
              text: 'لطفاً معلومات را چک کنید و دوباره امتحان کنید!',
              color: 'danger',
              iconPack: 'feather',
              icon: 'icon-cross',
              position: 'top-right'
            })
          });
      }else{
        this.accForm.post('/api/account')
          .then(({
            accForm
          }) => {
            // Finish the Progress Bar
            this.accForm.reset();
            this.$vs.notify({
              title: 'موفقیت!',
              text: 'موفقانه ثبت شد.',
              color: 'success',
              iconPack: 'feather',
              icon: 'icon-check',
              position: 'top-right'
            })
          }).catch((errors) => {
            this.$Progress.set(100)
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
    },
  },
};
</script>

<style lang="scss" scoped>
.add-new-data-sidebar {
  ::v-deep .vs-sidebar--background {
    z-index: 52010;
  }

  ::v-deep .vs-sidebar {
    z-index: 52010;
    width: 400px;
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
