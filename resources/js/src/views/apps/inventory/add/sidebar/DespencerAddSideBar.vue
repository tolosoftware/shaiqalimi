<template>
  <vs-sidebar
    position-right
    parent="body"
    default-index="1"
    color="primary"
    class="add-new-data-sidebar items-no-padding"
    spacer
    v-model="isSidebarActiveLocal"
  >
    <div class="mt-6 flex items-center justify-between px-6">
      <h4>افزودن دسپنسر</h4>
      <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
    </div>
    <div class="p-6">
      <div class="vx-row mb-6">
        <div class="vx-col w-full">
          <vs-input class="w-full" type="text" label="کود" />
        </div>
      </div>
      <div class="vx-row mb-6">
        <div class="vx-col w-full">
          <vs-input class="w-full" label="مسؤل" />
        </div>
      </div>
      <div class="vx-row mb-6">
        <div class="vx-col w-full">
          <vs-input class="w-full" label="نوعیت" />
        </div>
      </div>
      <div class="vx-row mb-6">
        <div class="vx-col w-full">
          <vs-input class="w-full" label="شماره" />
        </div>
      </div>
      <div class="vx-row mb-6">
        <div class="vx-col w-full">
          <label for class="vs-input--label">منبع</label>
          <v-select
            label="text"
            :options="itemType"
            :searchable="false"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
          >
            <span slot="no-options">{{$t('WhoopsNothinghere')}}</span>
          </v-select>
        </div>
      </div>
      <div class="vx-row mb-6">
        <div class="vx-col w-full">
          <vs-input class="w-full" label="ظرفیت" />
        </div>
      </div>
      <div class="vx-row">
        <div class="vx-col w-full">
          <vs-button class="mr-3 mb-2">ثبت</vs-button>
          <vs-button
            color="warning"
            type="border"
            class="mb-2"
            @click="input9 = input10 = input11 = input12 = ''; check3 = false;"
          >پاک کردن فرم</vs-button>
        </div>
      </div>
    </div>
  </vs-sidebar>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import vSelect from 'vue-select'


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
    VuePerfectScrollbar,
  },
  data() {
    return {
      itemType: [
        {
          text: 'تن',
          value: '1'
        },
        {
          text: 'متر مکعب',
          value: '2'
        },
        {
          text: 'لیتر',
          value: '3'
        },
        {
          text: 'کیلوگرام',
          value: '4'
        },
      ],
      // End of sidebar items
      dataId: null,
      dataName: '',
      dataCategory: null,
      dataImg: null,
      dataOrder_status: 'pending',
      dataPrice: 0,

      category_choices: [
        {text: 'Audio',value: 'audio'},
        {text: 'Computers',value: 'computers'},
        {text: 'Fitness',value: 'fitness'},
        {text: 'Appliance',value: 'appliance'}
      ],

      order_status_choices: [
        {text: 'Pending',value: 'pending'},
        {text: 'Canceled',value: 'canceled'},
        {text: 'Delivered',value: 'delivered'},
        {text: 'On Hold',value: 'on_hold'}
      ],
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
        const {category,id,img,name,order_status,price} = JSON.parse(JSON.stringify(this.data))
        this.dataId = id
        this.dataCategory = category
        this.dataImg = img
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
          // this.$validator.reset()
          // this.initValues()
        }
      }
    },
    isFormValid() {
      return !this.errors.any() && this.dataName && this.dataCategory && this.dataPrice > 0
    },
    scrollbarTag() {return this.$store.getters.scrollbarTag}
  },
  methods: {
    initValues() {
      if (this.data.id) return
      this.dataId = null
      this.dataName = ''
      this.dataCategory = null
      this.dataOrder_status = 'pending'
      this.dataPrice = 0
      this.dataImg = null
    },
    submitData() {
      this.$validator.validateAll().then(result => {
        if (result) {
          const obj = {
            id: this.dataId,
            name: this.dataName,
            img: this.dataImg,
            category: this.dataCategory,
            order_status: this.dataOrder_status,
            price: this.dataPrice
          }

          if (this.dataId !== null && this.dataId >= 0) {
            this.$store.dispatch('dataList/updateItem',obj).catch(err => {console.error(err)})
          } else {
            delete obj.id
            obj.popularity = 0
            this.$store.dispatch('dataList/addItem',obj).catch(err => {console.error(err)})
          }

          this.$emit('closeSidebar')
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
