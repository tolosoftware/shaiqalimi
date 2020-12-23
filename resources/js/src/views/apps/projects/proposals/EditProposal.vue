<template>
<form-wizard color="rgba(var(--vs-primary), 1)" :title="null" :subtitle="null" back-button-text="قبلی" next-button-text="بعدی" :start-index="0" ref="wizard" finishButtonText="ثبت معلومات" @on-complete="formSubmitted">
  <tab-content title="معلومات عمومی" class="mb-5" icon="feather icon-home">
    <vs-row vs-w="12">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <vs-input size="medium" v-model="aForm.serial_no" label="سریال نمبر" name="serial_no" class="w-full" placeholder="101" disabled />
          <span class="text-danger text-sm" v-show="errors.has('serial_no')">{{ errors.first('serial_no') }}</span>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for="date" class="mt-3"><small>تاریخ نشر اعلان</small></label>
          <date-picker color="#e85454" v-validate="'required'" v-model="aForm.publish_date" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" :auto-submit="true" size="large"></date-picker>
          <has-error :form="aForm" field="publish_date"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <vs-input v-validate="'required|min:6'" v-model="aForm.publish_address" label="آدرس نشراعلان" name="publish_address" class="w-full" />
          <!--<span class="text-danger text-sm" v-show="errors.has('publish_address')">{{ errors.first('publish_address') }}</span> -->
          <has-error :form="aForm" field="publish_address"></has-error>
        </div>
      </vs-col>
    </vs-row>
    <vs-row vs-w="12" class="pt-2">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>نهاد تطبیق کننده</small></label>
          <v-select label="name" v-model="aForm.client_id" v-validate="'required'" :options="clients" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
          <has-error :form="aForm" field="client_id"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <vs-input size="medium" v-model="aForm.title" v-validate="'required|min:6'" label="عنوان قرارداد" name="title" class="w-full" />
          <has-error :form="aForm" field="title"></has-error>
          <!-- <span class="text-danger text-sm" v-show="errors.has('title')">{{ errors.first('title') }}</span> -->
        </div>
      </vs-col>
    </vs-row>
    <vs-row vs-w="12" class="pt-2">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for class="ml-4 mr-4 mb-2">نوعیت قرارداد</label>
          <div class="radio-group w-full">
            <div class="w-1/2">
              <input type="radio" v-model="aForm.status" value="1" id="struct" name="status" />
              <label for="struct" class="w-full text-center">چارچوبی</label>
            </div>
            <div class="w-1/2">
              <input type="radio" v-model="aForm.status" value="2" id="specific" name="status" />
              <label for="specific" class="w-full text-center">معین</label>
            </div>
          </div>
          <has-error :form="aForm" field="status"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <vs-input v-validate="'required|min:6'" v-model="aForm.reference_no" label="شماره شناسایی قرارداد" name="reference_no" class="w-full" />
          <has-error :form="aForm" field="reference_no"></has-error>
          <!--<span class="text-danger text-sm" v-show="errors.has('reference_no')">{{ errors.first('reference_no') }}</span>-->
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for="date" class="mt-3"><small>تاریخ ختم پیشنهادات</small></label>
          <date-picker color="#e85454" v-validate="'required'" v-model="aForm.submission_date" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" :auto-submit="true" size="large"></date-picker>
          <has-error :form="aForm" field="submission_date"></has-error>
        </div>
      </vs-col>
    </vs-row>
    <vs-row vs-w="12" class="pt-2">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for="date" class="mt-3"><small>تاریخ آفرگشایی</small></label>
          <date-picker color="#e85454" v-validate="'required'" v-model="aForm.bidding_date" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" class="mt-5 w-full" :auto-submit="true" size="large"></date-picker>
          <has-error :form="aForm" field="bidding_date"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <vs-input size="medium" label="آدرس آفرگشایی" v-validate="'required'" v-model="aForm.bidding_address" name="offeraddress" class="w-full" />
          <has-error :form="aForm" field="bidding_address"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <!-- TITLE -->
          <label for=""><small>تضمین آفر</small></label>
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>AFN</span>
              </div>
            </template>
            <vs-input type="number" v-validate="'required'" v-model="aForm.offer_guarantee" />
          </vx-input-group>
          <has-error :form="aForm" field="offer_guarantee"></has-error>
        </div>
      </vs-col>
    </vs-row>
    <br>
  </tab-content>
  <tab-content title="اکمالات / مصارف " class="mb-5" icon="feather icon-briefcase">
    <ekmalat :items="aForm.item" :form="aForm"></ekmalat>
    <vs-row vs-w="12">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <!-- TITLE -->
          <label for=""><small>تامینات</small></label>
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>٪</span>
              </div>
            </template>
            <vs-input type="number" v-model="aForm.deposit" />
          </vx-input-group>
          <has-error :form="aForm" field="deposit"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>مالیات</small></label>
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>٪</span>
              </div>
            </template>
            <vs-input type="number" v-model="aForm.tax" />
          </vx-input-group>
          <has-error :form="aForm" field="tax"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>متفرقه</small></label>
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>AFN</span>
              </div>
            </template>
            <vs-input type="number" v-model="aForm.others" />
          </vx-input-group>
          <has-error :form="aForm" field="others"></has-error>
        </div>
      </vs-col>
    </vs-row>
    <vs-row vs-w="12" class="mb-base">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>ارزش قرارداد</small></label>
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>AFN</span>
              </div>
            </template>
            <vs-input type="number" v-model="aForm.pr_worth" />
          </vx-input-group>
          <has-error :form="aForm" field="pr_worth"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>انتقالات</small></label>
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>AFN</span>
              </div>
            </template>
            <vs-input type="number" v-model="aForm.transit" />
          </vx-input-group>
          <has-error :form="aForm" field="transit"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>نرخ دهی</small></label>
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>AFN</span>
              </div>
            </template>
            <vs-input type="number" v-model="aForm.total_price" :v-model="aForm.total_price = total_cost" />
          </vx-input-group>
        </div>
      </vs-col>
    </vs-row>
  </tab-content>
  <tab-content title="بررسی و مرور" class="mb-5" icon="feather icon-eye">
    <vs-row vs-w="12" style="background-color: #f3f5f7; border-color: #42b983; padding: 1rem 0;border-right-width:0.6rem;border-right-style: solid;margin: 1rem 0">
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
        <h4>&nbsp;مرور بخش معلومات عمومی&nbsp;</h4>
      </vs-col>
    </vs-row>
    <vs-row vs-w="12">
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            سریال نمبر:
          </strong>
          <small class="mb-5" v-text="aForm.serial_no" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            تاریخ نشر اعلان :
          </strong>
          <small class="mb-5" v-text="aForm.publish_date" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            آدرس نشراعلان:
          </strong>
          <small class="mb-5" v-text="aForm.publish_address" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-1">
          <strong class="mr-4">
            نهاد تطبیق کننده:
          </strong>
          <small class="mb-5" v-text="aForm.client_id.name" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            عنوان قرارداد:
          </strong>
          <small class="mb-5" v-text="aForm.title" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            نوعیت قرارداد:
          </strong>
          <small v-if="aForm.status== 2" class="mb-5" vs-justify="right" vs-align="right">معین</small>
          <small v-if="aForm.status== 1" class="mb-5" vs-justify="right" vs-align="right">چارچوبی</small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            شماره شناسایی قرارداد :
          </strong>
          <small class="mb-5" v-text="aForm.reference_no" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            تاریخ ختم پیشنهادات:
          </strong>
          <small class="mb-5" v-text="aForm.submission_date" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            تاریخ آفرگشایی:
          </strong>
          <small class="mb-5" v-text="aForm.bidding_date" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            آدرس آفرگشایی:
          </strong>
          <small class="mb-5" v-text="aForm.bidding_address" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            تضمین آفر:
          </strong>
          <small class="mb-5" v-text="aForm.offer_guarantee" vs-justify="right" vs-align="right"></small>
          <small style="color:#42b983;"><b>افغانی </b></small>
        </h6>
      </vs-col>
    </vs-row>
    <br>
    <vs-row vs-w="12" style="background-color: #f3f5f7; border-color: #42b983; padding: 1rem 0;border-right-width:0.6rem;border-right-style: solid;margin: 1rem 0">
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
        <h4>&nbsp;مرور بخش اکمالات /اقلام&nbsp;</h4>
      </vs-col>
    </vs-row>
    <vs-table :data="aForm.item">
      <template slot="thead" style="background-color: #f3f5f7">
        <vs-th>جنس / محصول</vs-th>
        <vs-th>مقدار</vs-th>
        <vs-th>واحد اندازه گیری</vs-th>
        <vs-th>هزینه فی واحد</vs-th>
        <vs-th>هزینه مجموعی</vs-th>
      </template>
      <template slot-scope="{data}">
        <vs-tr :key="indextr" v-for="(tr, indextr) in data">
          <vs-td :data="tr.item_id.name">
            {{tr.item_id.name}}
          </vs-td>
          <vs-td :data="tr.ammount">
            {{tr.ammount}}
          </vs-td>
          <!-- <vs-td :data="tr.unit_id.text">
                    {{tr.unit_id.text}}
                  </vs-td> -->
          <vs-td :data="tr.item_id.uom_id">
            {{tr.item_id.uom_id}}
          </vs-td>
          <vs-td :data="tr.unit_price">
            {{tr.unit_price}} <small style="color:#42b983;"><b>افغانی </b></small>
          </vs-td>
          <vs-td :data="tr.total_price">
            {{tr.total_price}} <small style="color:#42b983;"><b>افغانی </b></small>
          </vs-td>
        </vs-tr>
      </template>
    </vs-table>
    <br>
    <vs-row vs-w="12" style="background-color: #f3f5f7; border-color: #42b983; padding: 1rem 0;border-right-width:0.6rem;border-right-style: solid;margin: 1rem 0">
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
        <h4>&nbsp;مرور بخش مصارف&nbsp;</h4>
      </vs-col>
    </vs-row>
    <vs-row ws-w="12">
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            تامینات:
          </strong>
          <small class="mb-5" v-text="aForm.deposit" vs-justify="right" vs-align="right"></small>
          <small style="color:#42b983;"><b>% </b></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            مالیات:
          </strong>
          <small class="mb-5" v-text="aForm.tax" vs-justify="right" vs-align="right"></small>
          <small style="color:#42b983;"><b>% </b></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            متفرقه:
          </strong>
          <small class="mb-5" v-text="aForm.others" vs-justify="right" vs-align="right"></small>
          <small style="color:#42b983;"><b>افغانی </b></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            ارزش قرارداد:
          </strong>
          <small class="mb-5" v-text="aForm.pr_worth" vs-justify="right" vs-align="right"></small>
          <small style="color:#42b983;"><b>افغانی </b></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            انتقالات:
          </strong>
          <small class="mb-5" v-text="aForm.transit" vs-justify="right" vs-align="right"></small>
          <small style="color:#42b983;"><b>افغانی </b></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            نرخ دهی:
          </strong>
          <small class="mb-5" v-text="aForm.total_price" vs-justify="right" vs-align="right"></small>
          <small style="color:#42b983;"><b>افغانی </b></small>
        </h6>
      </vs-col>
    </vs-row>
    <br>
    <vs-row vs-w="12" class="pt-6 pb-6">
      <vs-checkbox color="success" size="large" v-model="is_accepted">تایید مینمایم که معلومات فوق درست میباشد.</vs-checkbox>
    </vs-row>
  </tab-content>
</form-wizard>
</template>

<script>
import vSelect from 'vue-select'
import Ekmalat from "../../shared/Ekmalat"
import {
  FormWizard,
  TabContent
} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

export default {
  components: {
    'v-select': vSelect,
    FormWizard,
    TabContent,
    Ekmalat

  },
  data() {
    return {
      is_accepted: false,
      currentSerialNo: 0,
      aForm: new Form({
        serial_no: '',
        publish_date: '',
        publish_address: '',
        status: '1',
        client_id: '',
        total_price: 0,
        title: '',
        reference_no: '',
        submission_date: '',
        bidding_date: '',
        bidding_address: '',
        offer_guarantee: '',
        deposit: '',
        tax: '',
        others: '',
        pr_worth: '',
        transit: '',
        item: [{
          item_id: "",
          unit_id: "",
          operation_id: null,
          equivalent: "",
          ammount: "",
          unit_price: "",
          total_price: "",
          density: null,
        }],
      }),
      clients: [],
      items: [],
    }
  },
  created() {
    this.getNextSerialNo();
    this.getAllClients();
    this.getAllItems();
    this.getProposal();
  },
  methods: {
    getProposal() {
      let pro_id = this.$route.params.id;
      this.aForm.get('/api/proposal/' + pro_id)
        .then(({
          data
        }) => {
          this.setFromValue(data);
        }).catch((errors) => {});

    },
    setFromValue(resp) {
      for (let [key, value] of Object.entries(resp)) {
        if (key == 'status') {
          this.aForm[key] = (value == 'income') ? 1 : 2;
        } else {

          this.aForm[key] = value;
        }
      }
      for (let [key, value] of Object.entries(resp.pro_datas)) {
        this.aForm[key] = value;
      }
      this.aForm.item = resp.pro_items;
    },

    reloadData() {
      this.getNextSerialNo();
      this.getAllClients();
      this.getAllItems();
      this.$refs.wizard.reset();
      this.$Progress.set(100)
    },
    // for getting the next serian number
    getNextSerialNo() {
      this.$Progress.start()
      this.axios.get('/api/serial-num?type=prop')
        .then((response) => {
          this.currentSerialNo = response.data;
          this.aForm.serial_no = this.currentSerialNo;
        })
    },

    // for Organs that implement the ad
    getAllClients() {
      this.$Progress.start()
      this.axios.get('/api/clients')
        .then((response) => {
          this.clients = response.data;
        })
    },

    // for items to be bought
    getAllItems() {
      this.$Progress.start()
      this.axios.get('/api/items')
        .then((response) => {
          this.items = response.data;
          this.$Progress.set(100)
        })
    },
    formSubmitted() {
      this.$Progress.start()
      this.aForm.patch('/api/proposal/' + this.$route.params.id)
        .then(({
          aForm
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
    },
  },
  // End Of methods
  computed: {
    // To calculate the total price for :the proposal
    total_cost: function () {
      let others = (this.aForm.others) ? parseInt(this.aForm.others) : 0;
      let transit = (this.aForm.transit) ? parseInt(this.aForm.transit) : 0;
      let pr_worth = (this.aForm.pr_worth) ? parseInt(this.aForm.pr_worth) : 0;

      let total_items = 0;
      if (this.aForm.item) {
        this.aForm.item.filter(function (item) {
          if (item && item.total_price) {
            total_items += parseInt(item.total_price);
          }
        })
      }
      return others + transit + pr_worth + total_items;
    },
  },
}
</script>

<style scoped>
.vs-icon {
  color: inherit;
  text-align: center;
  font-size: 2rem;
}
</style>
