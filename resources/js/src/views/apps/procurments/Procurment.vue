<template>
<div>
  <Procurmentadd :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />
  <vs-tabs>
    <vs-tab label="ثبت خریداری">
      <div class="vx-row">
        <vx-card class="height-vh-80">
          <div class="vx-row">
            <div class="vx-col w-1/2">
              <h3>فورم ثبت خریداری</h3>
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
                  <source-select :parentForm="prForm" name="source" v-validate="'required'" v-model="prForm.source_id"></source-select>
                </div>
              </vs-col>

            </vs-row>
            <br>
            <vs-divider />
            <!-- end currency_id -->
            <!-- eteration -->

            <EkmalatStock :items="prForm.item" :form="prForm" :currencyID="prForm.currency_id" :listOfFields="[]" :disabledFields="[]" :grid="[]" ref="ekmalat"></EkmalatStock>

            <!-- end eteration -->
            <vs-row vs-w="12">

              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="12" vs-sm="12" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-textarea placeholder="تفصیلات" v-model="prForm.description"></vs-textarea>
                </div>
              </vs-col>
            </vs-row>
            <vs-button class="mr-3 mb-2" @click.prevent="submitData">ثبت</vs-button>
            <vs-list>
              <vs-list-header color="danger" title="مشکلات"></vs-list-header>
              <div :key="indextr" v-for="(error, indextr) in errors.items">
                <vs-list-item icon="verified_user" style="color:red;" :subtitle="error.msg"></vs-list-item>
              </div>
              <!--<vs-list-item title="" subtitle=""></vs-list-item> -->
            </vs-list>
          </form>
        </vx-card>
      </div>
    </vs-tab>

    <vs-tab label="لیست خریداری">
      <Procurmentlist></Procurmentlist>
    </vs-tab>
  </vs-tabs>
</div>
</template>

<script>
import moment from 'moment-jalaali'
import EkmalatStock from "../shared/EkmalatStock"
import SourceSelect from "../shared/SourceSelect";
import Procurmentlist from './Procurmentlist.vue'
import Procurmentadd from './Procurmentadd.vue'
import vSelect from 'vue-select'
import {
  Validator
} from 'vee-validate'

export default {
  components: {
    Procurmentlist,
    Procurmentadd,
    "v-select": vSelect,
    EkmalatStock,
    moment,
    SourceSelect,
    Validator
  },

  data() {
    return {
      active: true,
      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {},

      prForm: new Form({
        serial_no: '',
        currency_id: 1,
        date_time: this.momentj().format('jYYYY/jMM/jDD HH:mm'), //new Date().getTime().formatdate('YYYY/MM/DD'),
        vendor_id: '',
        account_id: '',
        vendor_address: '',
        vendor_phone: '',
        vendor_name: '',
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

      allvendors: [],
      storage: [],
      dict: {
        custom: {
          serialnumber: { required: ' سریال نمبر خریداری الزامی میباشد.' },
          procurment_date: { required: ' تاریخ انجام خریداری الزامی میباشد.' },
          seller_name: { required: ' نام فروشنده الزامی میباشد.' },
          seller_phone: { required: ' شماره تماس فروشنده الزامی میباشد.' },
          address: { required: ' آدرس فروشنده الزامی میباشد.', min: 'آدرس فروشنده باید بیشتر از 2 حرف باشد.' },
          source: { required: ' انتخاب ذخیره اصلی الزامی میباشد.' }
        }
      }
    };
  },

  created() {
    Validator.localize('en', this.dict);
    this.loadvendor();
    this.loadgodam();
    this.getPurchaseSerialNumber();
  },
  methods: {
    setVendordata(data) {
      // console.log(data);
      this.prForm.vendor_id = data.id;
      this.prForm.vendor_address = data.address;
      this.prForm.vendor_phone = data.phone;
      this.prForm.account_id = data.account_id;
      this.prForm.vendor_name = data.name;

      // console.log('seller_name', this.prForm.vendor_name);

    },
    loadvendor() {
      this.axios.get('/api/vendors')
        .then((resp) => {
          this.allvendors = resp.data;
        });
    },
    loadgodam() {
      this.axios.get('/api/storage')
        .then((resp) => {
          this.storage = resp.data;
        });
    },
    getPurchaseSerialNumber() {
      this.axios.get('/api/purchSerialNO')
        .then((resp) => {
          this.prForm.serial_no = resp.data;
        });
    },
    addNewData() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    toggleDataSidebar(val = false) {
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
            })

            .catch(() => {
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
          console.log("Form have erors");
          // form have errors
        }
      })

    },
  },

};
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
