<template>
  <form @submit.prevent="submitForm">
    <div class="vx-row">
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <label for class="vs-input--label">لیست قراردادها</label>
          <v-select
            label="name"
            name="contract"
            :options="contracts"
            :searchable="false"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
            v-model="form.selectedItem"
            @input="onChange()"
          >
            <span slot="no-options">{{ $t('WhoopsNothinghere') }}</span>
          </v-select>
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <vs-input name="nahad_name" class="w-full" v-model="form.nahadName" label="نام نهاد" />
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <vs-input
            name="person_relation"
            class="w-full"
            v-model="form.repativePerson"
            type="text"
            label="شخص ارتباطی"
          />
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <vs-input
            name="phone_number"
            class="w-full number-rtl"
            v-model="form.nahadPhone"
            label="شماره تماس"
          />
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <vs-input name="address" class="w-full" v-model="form.nahadAddress" label="آدرس" />
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <label class="vs-input--label">جنس/محصول</label>
          <v-select
            name="product"
            label="text"
            v-model="form.product"
            :options="products"
            :searchable="false"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
          >
            <span slot="no-options">{{$t('WhoopsNothinghere')}}</span>
          </v-select>
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <vs-input v-model="form.responsible" class="w-full" label="مسؤل" />
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <label for class="vs-input--label">منبع</label>
          <v-select
            v-model="form.source"
            label="text"
            :options="source"
            :searchable="false"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
          >
            <span slot="no-options">{{$t('WhoopsNothinghere')}}</span>
          </v-select>
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <vs-input v-model="form.target" class="w-full" label="مقصد" />
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <vs-input v-model="form.quantity" class="w-full" label="مقدار" />
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <vs-input v-model="form.serial_number" class="w-full" label="سریال نمبر" />
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <label class="vs-input--label">واحد پولی</label>
          <v-select
            v-model="form.money_unit"
            label="text"
            :options="itemMoney"
            :searchable="false"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
          >
            <span slot="no-options">{{$t('WhoopsNothinghere')}}</span>
          </v-select>
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <label class="vs-input--label">هزینه</label>
          <vx-input-group>
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>{{form.money_unit.unit}}</span>
              </div>
            </template>
            <vs-input v-model="form.cost" class="w-full" />
          </vx-input-group>
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <label class="vs-input--label">کل هزینه</label>
          <vx-input-group>
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>{{form.money_unit.unit}}</span>
              </div>
            </template>
            <vs-input v-model="form.total_cost" class="w-full" />
          </vx-input-group>
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <vs-input v-model="form.fi_unit" class="w-full" label="فی واحد" />
        </div>
      </div>

      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <label for class="vs-input--label">واحد</label>
          <v-select
            name="unit"
            v-model="form.unit"
            label="text"
            :options="itemType"
            :searchable="false"
            :clearable="false"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
          >
            <span slot="no-options">{{$t('WhoopsNothinghere')}}</span>
          </v-select>
        </div>
      </div>
      <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
        <div class="vx-col w-full">
          <vs-input v-model="form.equal" class="w-full" label="معادل" />
        </div>
      </div>
    </div>
    <div class="mt-10">
      <div class="vx-col w-full">
        <vs-button @click.prevent="submitForm" class="mb-2">ثبت</vs-button>
        <vs-button
          color="warning"
          type="border"
          class="mb-2 ml-2"
          @click="resetForm"
        >پاک کردن فرم</vs-button>
      </div>
    </div>
  </form>
</template>
<script>

import vSelect from 'vue-select'


export default {
  props: {
    data: {
      type: Object,
      default: () => {}
    }
  },
  components: {
    'v-select': vSelect,
    
  },
  data() {
    return {
      form:{
        selectedItem: null,
        nahadName: null,
        repativePerson: null,
        nahadPhone: null,
        nahadAddress: null,
        product: null,
        responsible: null,
        source: null,
        target: null,
        quantity: null,
        serial_number: null,
        money_unit: {
          text: 'افغانی',
          unit: 'AFN',
          value: '1'
        },
        cost: null,
        total_cost: null,
        fi_unit: null,
        unit: null,
        equal: null,
      },
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
      itemMoney: [
        {
          text: 'افغانی',
          unit: 'AFN',
          value: '1'
        },
        {
          text: 'دالر',
          unit: 'USD',
          value: '2'
        },
      ],
      source: [
        {
          text: 'یاران',
          value: '1'
        },
        {
          text: 'مکروریان',
          value: '2'
        },
        {
          text: 'کابل',
          value: '3'
        },
        {
          text: 'هرات',
          value: '4'
        },
      ],
      products: [
        {
          text: 'تیل گاز',
          value: '1'
        },
        {
          text: 'تیل دیزل',
          value: '2'
        },
        {
          text: 'تیل پطرول',
          value: '3'
        },
        {
          text: 'موبلین',
          value: '4'
        },
      ],
      contracts: [
        {
          name: "قرداد تیل 0012DXR4581 - وزارت ارشاد، حج و اوقاف",
          nahad: 'وزارت ارشاد، حج و اوقاف',
          person: 'احمد ولی',
          phone: '+9376624176',
          address: 'کابل- افغانستان',

          value: '1'
        },
        {
          name: "قرداد تیل 0012DXR4531 - وزارت دفاع ملى افغانستان",
          nahad: 'وزارت دفاع ملى افغانستان',
          person: 'سعیده سادات',
          phone: '+9376624176',
          address: 'کابل- افغانستان',

          value: '2'
        },
        {
          name: "قرداد تیل 0012DXR4511 - وزارت  صحت عامه",
          nahad: 'وزارت  صحت عامه',
          person: 'نبیل پوپل',
          phone: '+9376624176',
          address: 'کابل- افغانستان',
          value: '3'
        },
        {
          name: "قرداد تیل 0012DXR4551 - وزارت اقتصاد",
          value: '4',
          nahad: 'وزارت اقتصاد',
          person: 'نبیل پوپل',
          phone: '+9376624176',
          address: 'کابل- افغانستان',
        },
      ],
      // End of sidebar items
    }
  },
  watch: {
  },
  computed: {
    isFormValid() {
      return !this.errors.any() && this.dataName && this.dataCategory && this.dataPrice > 0
    },
  },
  methods: {
    onChange() {
      if (this.form.selectedItem != null) {
        this.form.nahadName = this.form.selectedItem.nahad;
        this.form.repativePerson = this.form.selectedItem.person;
        this.form.nahadPhone = this.form.selectedItem.phone;
        this.form.nahadAddress = this.form.selectedItem.address;
      } else {
        this.form.nahadName = null;
        this.form.repativePerson = null;
        this.form.nahadPhone = null;
        this.form.nahadAddress = null;
      }
    },
    resetForm(submitEvent) {
      const f = this.form;
      for (var key in f){
        this.form[key] = null;
      }
    },
    submitForm(submitEvent) {
      this.$validator.validateAll().then(result => {
        if (result) {
          console.log(this.form);
          
          // if form have no errors
          alert("form submitted!");
        } else {
          // form have errors
        }
      })
    },
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
