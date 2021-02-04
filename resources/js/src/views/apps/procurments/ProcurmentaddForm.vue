<template>
<div>
  <SerllerAddForm :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />
  <div class="vx-row">
    <vx-card class="height-vh-80">
      <div class="vx-row">
        <div class="vx-col w-1/2">
          <h3>فورم ثبت خریداری</h3> {{prForm.source}}
        </div>
        <div class="vx-col w-1/2">
          <vs-button type="filled" @click="addNewData" class="mt-5 float-right">ثبت فروشنده جدید</vs-button>
        </div>
      </div>

      <form data-vv-scope="procurmentForm">
        <vs-row vs-w="12">
          <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
            <div class="w-full pt-2 ml-3 mr-3">
              <vs-input size="medium" v-validate="'required'" label="سریال نمبر" name="serialnumber" v-model="prForm.serial_no" class="w-full" disabled />
              <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first("serialnumber") }}</span>
            </div>
          </vs-col>

          <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
            <div class="w-full pt-2 ml-3 mr-3">
              <label for>واحد پولی</label>
              <div class="radio-group w-full">
                <div class="w-1/2">
                  <input type="radio" id="afn" name="currency" value="1" v-model="prForm.currency_id" />
                  <label for="afn" class="w-full text-center">افغانی</label>
                </div>
                <div class="w-1/2">
                  <input type="radio" id="usd" name="currency" value="2" v-model="prForm.currency_id" />
                  <label for="usd" class="w-full text-center">دالر</label>
                </div>
              </div>
            </div>
          </vs-col>

          <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
            <div class="w-full  ml-3 mr-3">
              <label for="date" class="mt-3"><small>تاریخ </small></label>
              <date-picker color="#e85454" name="procurment_date" v-validate="'required'" input-format="YYYY/MM/DD HH:mm" format="jYYYY/jMM/jDD HH:mm" type="datetime" v-model="prForm.date_time" />
            </div>
          </vs-col>

          <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
            <div class="w-full pt-2 ml-3 mr-3">
              <label for>
                <small> نام فروشنده</small>
              </label>
              <v-select label="name" name="seller_name" v-validate="'required'" v-model="prForm.vendor_name" :options="allvendors" :dir="$vs.rtl ? 'rtl' : 'ltr'" @input="setVendordata" />
            </div>
          </vs-col>
          <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
            <div class="w-full pt-2 ml-3 mr-3">
              <vs-input size="medium" v-validate="'required'" label="شماره تماس" name="seller_phone" class="w-full" v-model="prForm.vendor_phone" />
              <span class="text-danger text-sm" v-show="errors.has('seller_phone')">{{ errors.first("seller_phone") }}</span>
            </div>
          </vs-col>
          <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
            <div class="w-full pt-2 ml-3 mr-3">
              <vs-input size="medium" v-validate="'required'" label="آدرس" name="address" class="w-full" v-model="prForm.vendor_address" />
              <span class="text-danger text-sm" v-show="errors.has('address')">{{ errors.first("address") }}</span>
            </div>
          </vs-col>
          <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
            <div class="w-full pt-2 ml-3 mr-3">
              <label for>
                <small>ذخیره اصلی</small>
              </label>
              <source-select :parentForm="prForm" @updateItems="update_items" name="source" v-validate="'required'" v-model="prForm.source_id"></source-select>
            </div>
          </vs-col>

        </vs-row>
        <br>
        <vs-divider />

        <EkmalatStock :items="prForm.item" :form="prForm" :currencyID="prForm.currency_id" :listOfFields="[]" :disabledFields="[]" :grid="[]" ref="ekmalat"></EkmalatStock>

        <vs-row vs-w="12">
          <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="12" vs-sm="12" vs-xs="12">
            <div class="w-full pt-2 ml-3 mr-3">
              <vs-textarea label="تفصیلات" v-model="prForm.description"></vs-textarea>
            </div>
          </vs-col>
        </vs-row>
        <vs-button class="mr-3 mb-2" :disabled="prForm.busy" @click.prevent="submitData">ثبت</vs-button>
        <div v-if="(errors.items.length > 0)">
          <vs-list v-if="showEr">
            <vs-list-header color="danger" title="مشکلات"></vs-list-header>
            <div :key="indextr" v-for="(err, indextr) in errors.items">
              <vs-list-item icon="verified_user" style="color:red;" :subtitle="err.msg"></vs-list-item>
            </div>
          </vs-list>
        </div>
      </form>
    </vx-card>
  </div>
</div>
</template>

<script>
import SerllerAddForm from './SerllerAddForm.vue'
import moment from 'moment-jalaali'
import EkmalatStock from "../shared/EkmalatStock"
import SourceSelect from "../shared/SourceSelect";
import vSelect from 'vue-select'
import {
  Validator
} from 'vee-validate'

export default {
  data() {
    return {
      active: true,
      showEr: true,
      // Data Sidebar
      addNewDataSidebar: false,
      addNewDataSidebar: false,
      sidebarData: {},

      allvendors: [],
      storage: [],
      prForm: new Form({
        serial_no: '',
        currency_id: 1,
        date_time: this.momentj().format('jYYYY/jMM/jDD HH:mm'), //new Date().getTime().formatdate('YYYY/MM/DD'),
        vendor_id: '',
        account_id: '',
        vendor_address: '',
        vendor_phone: '',
        vendor_name: '',
        source: '',
        source_id: '',
        source_type: '',
        user_id: localStorage.getItem('id'),
        description: '',
        item: [{
          item_id: "",
          unit_id: "",
          operation_id: null,
          increment_equiv: "",
          increment: "",
          unit_price: "",
          total_price: "",
          density: null,
        }],

      }),
      dictp: {
        custom: {
          serialnumber: { required: ' سریال نمبر خریداری الزامی میباشد.' },
          procurment_date: { required: ' تاریخ انجام خریداری الزامی میباشد.' },
          seller_name: { required: ' نام فروشنده الزامی میباشد.' },
          seller_phone: { required: ' شماره تماس فروشنده الزامی میباشد.' },
          address: { required: ' آدرس فروشنده الزامی میباشد.', min: 'آدرس فروشنده باید بیشتر از 2 حرف باشد.' },
          source: { required: ' انتخاب ذخیره اصلی الزامی میباشد.' }
        }
      },

    }
  },
  watch: {
    addNewDataSidebar: function () {
      if (this.addNewDataSidebar == false) {
        this.$validator.reset();
        this.showEr = true;
      } else {
        this.showEr = false;
      }
    },

  },
  created() {
    this.$on('sellerdelete', function (value) {
      this.loadvendor();
    });
    this.$on('selleradd', function (value) {
      this.loadvendor();
    });
    this.getPurchaseSerialNumber();
    Validator.localize('en', this.dictp);
    this.loadvendor();
    // this.loadgodam();
  },
  components: {
    "v-select": vSelect,
    EkmalatStock,
    moment,
    SourceSelect,
    Validator,
    SerllerAddForm
  },
  methods: {
    update_items(matched_items) {
      this.$refs.ekmalat.getAllItems(matched_items, false);
    },
    toggleDataSidebar(val = false) {
      // this.errors.items.length = 0
      // this.errors.length = 0
      this.loadvendor();
      this.$validator.reset()
      this.addNewDataSidebar = val
    },
    addNewData() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    setVendordata(data) {
      // 
      this.prForm.vendor_id = data.id;
      this.prForm.vendor_address = data.address;
      this.prForm.vendor_phone = data.phone;
      this.prForm.account_id = data.account_id;
      this.prForm.vendor_name = data.name;

      // 

    },
    loadvendor() {
      this.axios.get('/api/vendors')
        .then((resp) => {
          this.allvendors = resp.data;
        });
    },
    // loadgodam() {
    //   this.axios.get('/api/storage')
    //     .then((resp) => {
    //       this.storage = resp.data;
    //     });
    // },
    getPurchaseSerialNumber() {
      this.axios.get('/api/purchSerialNO')
        .then((resp) => {
          this.prForm.serial_no = resp.data;
        });
    },

    toggleDataSidebar(val = false) {
      // this.errors.items.length = 0
      // this.errors.length = 0
      this.$validator.reset()
      this.addNewDataSidebar = val
    },
    submitData() {
      this.$validator.validateAll('procurmentForm').then(result => {
        if (result) {
          this.prForm.post('/api/procurments')
            .then(() => {
              this.$vs.notify({
                title: 'عملیه ثبت موفق بود!',
                text: 'عملیه موفغانه انجام شد',
                color: 'success',
                iconPack: 'feather',
                icon: 'icon-check',
                position: 'top-right'
              })
              this.prForm.reset();
              this.$validator.reset();
              this.getPurchaseSerialNumber();
            }).catch(() => {
              this.$vs.notify({
                title: 'ثبت عملیه  ناموفق بود!',
                text: 'عملیه  ناکم شد لطفا دوباره تلاش نماید',
                color: 'danger',
                iconPack: 'feather',
                icon: 'icon-check',
                position: 'top-right'
              })
            })
        } else {

          // form have errors
        }
      })
    }
  }
}
</script>

<style>
.customstyle {
  border-right: solid;
  border-right-width: initial;
  border-right-style: solid;
  border-right-color: initial;
}

.vs-radio {
  border-top-left-radius: 1 !important;
  border-bottom-left-radius: 1 !important;
}
</style>
