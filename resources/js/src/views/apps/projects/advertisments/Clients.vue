<!-- =========================================================================================
  File Name: AddNewDataSidebar.vue
  Description: Add New Data - Sidebar component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
<div>
  <vs-sidebar position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
    <div class="mb-2"></div>
    <div class="mb-5">
      <vs-tabs>
        <vs-tab label=" اضافه کردن نهاد جدید" icon="list">
          <component :is="scrollbarTag" class="scroll-area--data-list-add-new" :settings="settings" :key="$vs.rtl">
            <form>
              <div class="p-6">
                <!-- Product Image -->
                <template v-if="orgForm.logo">
                  <!-- Image Container -->
                  <div class="img-container w-24 mx-auto flex items-center justify-center">
                    <img :src="orgForm.logo" alt="لوگو" class="rounded responsive">
                  </div>
                  <!-- Image upload Buttons -->
                  <div class="modify-img flex justify-between mt-5">
                    <input type="file" class="hidden" ref="updateImgInput" @change="updateCurrImg" accept="image/*">
                    <vs-button class="mr-4" type="flat" @click="$refs.updateImgInput.click()">تبدیل لوگو</vs-button>
                    <vs-button type="flat" color="#999" @click="orgForm.logo = null">حذف این لوگو</vs-button>
                  </div>
                </template>

                <vs-input label="نام نهاد" class="mt-5 w-full" v-model="orgForm.name" />
                <has-error :form="orgForm" field="name"></has-error>
                <!-- <span class="text-danger text-sm" v-show="errors.has('item-name')">{{ errors.first('item-name') }}</span> -->

                <vs-input label="ایمیل" type="email" class="mt-5 w-full" v-model="orgForm.email" />
                <has-error :form="orgForm" field="email"></has-error>
                <!-- NAME -->
                <vs-input label=" شماره تماس " type="text" class="mt-5 w-full" v-model="orgForm.phone" />
                <has-error :form="orgForm" field="phone"></has-error>
                <!-- NAME -->
                <vs-input label="ویب سایت" type="text" class="mt-5 w-full" v-model="orgForm.website" />
                <has-error :form="orgForm" field="website"></has-error>
                <!-- NAME -->
                <vs-input label=" آدرس" type="text" class="mt-5 w-full" v-model="orgForm.address" />
                <has-error :form="orgForm" field="address"></has-error>
                <!-- Upload -->
                <!-- <vs-upload text="Upload Image" class="img-upload" ref="fileUpload" /> -->

                <div class="upload-img mt-5" v-if="!orgForm.logo">
                  <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
                  <vs-button icon="image" @click="$refs.uploadImgInput.click()">اپلود لوگو</vs-button>
                </div>
              </div>
              <div class="flex flex-wrap items-center p-6" slot="footer">
                <vs-button class="mr-6" @click="submitData" :disabled="!isFormValid">ذخیره</vs-button>
                <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">لغو</vs-button>
              </div>
            </form>
          </component>

        </vs-tab>
        <vs-tab label="لست نهادها" icon="account_balance">
        </vs-tab>
      </vs-tabs>
    </div>
  </vs-sidebar>
</div>
</template>

<script>
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

  },
  data() {
    return {
      orgForm: new Form({
        name: 'وزارت مالیه',
        email: 'info@mof.gov.af',
        phone: '0799689133',
        website: 'tolosoft.co',
        address: 'Darlaman-Jae_rayes, Ahmad Yar',
        logo: null,
        account_id: null
      }),
      dataId: null,
      dataName: '',
      dataCategory: null,
      dataOrder_status: 'pending',
      dataPrice: 0,
      settings: { // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: .60
      }
    }
  },
  watch: {
    isSidebarActive(val) {
      if (!val) return
      if (Object.entries(this.data).length === 0) {
        this.initValues()
        this.$validator.reset()
      } else {
        const { category, id, img, name, order_status, price } = JSON.parse(JSON.stringify(this.data))
        this.dataId = id
        this.dataCategory = category
        this.orgForm.logo = img
        this.dataName = name
        this.dataOrder_status = order_status
        this.dataPrice = price
        this.initValues()
      }
      // Object.entries(this.data).length === 0 ? this.initValues() : { this.dataId, this.dataName, this.dataCategory, this.dataOrder_status, this.dataPrice } = JSON.parse(JSON.stringify(this.data))
    }
  },
  computed: {
    isSidebarActiveLocal: {
      get() {
        return this.isSidebarActive
      },
      set(val) {
        if (!val) {
          this.$emit('closeSidebar')

        }
      }
    },

    scrollbarTag() { return this.$store.getters.scrollbarTag }
  },
  methods: {
    isFormValid() {

    },
    submitData() {
      this.orgForm.post('/api/clients')
        .then(({
          data
        }) => {
          // this.getAllAccountTypes();
          this.orgForm.reset();
          this.$vs.notify({
            title: 'موفقیت!',
            text: 'معلومات موفقانه ثبت سیستم شد.',
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

      // this.$validator.validateAll().then(result => {
      //   if (result) {
      //     const obj = {
      //       id: this.dataId,
      //       name: this.dataName,
      //       img: this.orgForm.logo,
      //       category: this.dataCategory,
      //       order_status: this.dataOrder_status,
      //       price: this.dataPrice
      //     }

      //     if (this.dataId !== null && this.dataId >= 0) {
      //       this.$store.dispatch('dataList/updateItem', obj).catch(err => { console.error(err) })
      //     } else {
      //       delete obj.id
      //       obj.popularity = 0
      //       this.$store.dispatch('dataList/addItem', obj).catch(err => { console.error(err) })
      //     }

      //     this.$emit('closeSidebar')
      //     this.initValues()
      //   }
      // })
    },
    updateCurrImg(input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.orgForm.logo = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.add-new-data-sidebar {
  ::v-deep .vs-sidebar--background {
    z-index: 52010;
  }

  ::v-deep .vs-sidebar {
    z-index: 52010;
    width: 600px;
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
