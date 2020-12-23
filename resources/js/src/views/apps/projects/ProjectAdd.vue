<template>
<div>
  <OrganizationAdd :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />

  <vs-tabs>
    <vs-tab label=" ثبت قرارداد جدید" style="padding:2px 0px 0px 0px !important;">
      <vx-card class="height-vh-80">
        <div class="header">
          <vs-row vs-w="12">
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="3" vs-sm="6" vs-xs="7">
              <div class="">
                <h3 class="pt-1 pr-5 mr-5 ml-4 w-full">
                  فارم ثبت پروژه قرار دادی
                </h3>
              </div>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="7" vs-sm="3" vs-xs="1"></vs-col>
            <vs-col vs-type="flex" vs-justify="left" vs-align="left" vs-lg="2" vs-sm="3" vs-xs="4">
              <div class="w-full">
                <vs-button type="filled" @click="addNewData" icon="add">ثبت نهاد جدید </vs-button>
              </div>
            </vs-col>
          </vs-row>
          <br>
          <hr>
        </div>
        <form-wizard color="rgba(var(--vs-primary), 1)" :title="null" :subtitle="null" finishButtonText="ثبت قرارداد" @on-complete="submitForm">
          <tab-content title="معلومات عمومی قرارداد" class="mb-5">
            <vs-row vs-w="12">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-input size="medium" v-model="pForm.serial_no" v-validate="'required'" label="سریال نمبر" name="serial_no" class="w-full" placeholder="101" disabled />
                  <span class="text-danger text-sm" v-show="errors.has('serial_no')">{{ errors.first('serial_no') }}</span>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for=""><small>انتخاب اعلان</small></label>
                  <v-select label="text" v-model="pForm.proposal_id" v-validate="'required'" :options="announces" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                  <has-error :form="pForm" field="proposal_id"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for="date" class="mt-3"><small>تاریخ عقد قرارداد</small></label>
                  <date-picker color="#e85454" v-validate="'required'" v-model="pForm.contract_date" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" :auto-submit="true" size="large"></date-picker>
                  <has-error :form="pForm" field="contract_date"></has-error>
                </div>
              </vs-col>
            </vs-row>
            <vs-row vs-w="12" class="pt-2">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for=""><small>مرجع مربوطه</small></label>
                  <v-select label="text" v-model="pForm.client_id" v-validate="'required'" :options="organs" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                  <has-error :form="pForm" field="client_id"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-input size="medium" v-model="pForm.title" v-validate="'required|min:6'" label="عنوان قرارداد" name="title" class="w-full" />
                  <has-error :form="pForm" field="title"></has-error>
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
                      <input type="radio" v-model="pForm.status" value="1" id="struct" name="status" />
                      <label for="struct" class="w-full text-center">چارچوبی</label>
                    </div>
                    <div class="w-1/2">
                      <input type="radio" v-model="pForm.status" value="2" id="specific" name="status" />
                      <label for="specific" class="w-full text-center">معین</label>
                    </div>
                  </div>
                  <has-error :form="pForm" field="status"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-input v-validate="'required|min:6'" v-model="pForm.reference_no" label="شماره شناسایی قرارداد" name="reference_no" class="w-full" />
                  <has-error :form="pForm" field="reference_no"></has-error>
                  <!--<span class="text-danger text-sm" v-show="errors.has('reference_no')">{{ errors.first('reference_no') }}</span>-->
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for="date" class="mt-3"><small>تاریخ ختم قرارداد</small></label>
                  <date-picker color="#e85454" v-validate="'required'" v-model="pForm.contract_end_date" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" :auto-submit="true" size="large"></date-picker>
                  <has-error :form="pForm" field="contract_end_date"></has-error>
                </div>
              </vs-col>
            </vs-row>
            <vs-row vs-w="12" class="pt-2">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for=""><small>تضمین قرارداد</small></label>
                  <vx-input-group class="">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>
                    <vs-input type="number" v-validate="'required'" v-model="pForm.project_guarantee" />
                  </vx-input-group>
                  <has-error :form="pForm" field="project_guarantee"></has-error>
                </div>
              </vs-col>
            </vs-row>
          </tab-content>

          <tab-content title="اکمالات/ مصارف" class="mb-5">
            <ekmalat :items="pForm.item" :form="pForm"></ekmalat>
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
                    <vs-input type="number" v-model="pForm.deposit" />
                  </vx-input-group>
                  <has-error :form="pForm" field="deposit"></has-error>
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
                    <vs-input type="number" v-model="pForm.tax" />
                  </vx-input-group>
                  <has-error :form="pForm" field="tax"></has-error>
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
                    <vs-input type="number" v-model="pForm.others" />
                  </vx-input-group>
                  <has-error :form="pForm" field="others"></has-error>
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
                    <vs-input type="number" v-model="pForm.pr_worth" />
                  </vx-input-group>
                  <has-error :form="pForm" field="pr_worth"></has-error>
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
                    <vs-input type="number" v-model="pForm.transit" />
                  </vx-input-group>
                  <has-error :form="pForm" field="transit"></has-error>
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
                    <vs-input type="number" />
                  </vx-input-group>
                </div>
              </vs-col>
            </vs-row>
          </tab-content>

          <tab-content title="بررسی" class="mb-5">
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
                  <small class="mb-5" v-text="pForm.serial_no" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    انتخاب اعلان:
                  </strong>
                  <small class="mb-5" v-text="pForm.proposal_id.text" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    تاریخ عقد قرارداد:
                  </strong>
                  <small class="mb-5" v-text="pForm.contract_date" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-1">
                  <strong class="mr-4">
                    مرجع مربوطه :
                  </strong>
                  <small class="mb-5" v-text="pForm.client_id.text" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    عنوان قرارداد:
                  </strong>
                  <small class="mb-5" v-text="pForm.title" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    نوعیت قرارداد:
                  </strong>
                  <small v-if="pForm.status== 2" class="mb-5" vs-justify="right" vs-align="right">معین</small>
                  <small v-if="pForm.status== 1" class="mb-5" vs-justify="right" vs-align="right">چارچوبی</small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    شماره شناسایی قرارداد :
                  </strong>
                  <small class="mb-5" v-text="pForm.reference_no" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    تاریخ ختم قرارداد:
                  </strong>
                  <small class="mb-5" v-text="pForm.contract_end_date" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    تضمین قرارداد:
                  </strong>
                  <small class="mb-5" v-text="pForm.project_guarantee" vs-justify="right" vs-align="right"></small>
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
            <vs-table :data="pForm.item">
              <template slot="thead" style="background-color: #f3f5f7">
                <vs-th>جنس / محصول</vs-th>
                <vs-th>مقدار</vs-th>
                <vs-th>واحد اندازه گیری</vs-th>
                <vs-th>هزینه فی واحد</vs-th>
                <vs-th>هزینه مجموعی</vs-th>
              </template>
              <template slot-scope="{data}">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                  <vs-td :data="data[indextr].item_id.text">
                    {{data[indextr].item_id.text}}
                  </vs-td>
                  <vs-td :data="data[indextr].ammount">
                    {{data[indextr].ammount}}
                  </vs-td>
                  <!-- <vs-td :data="data[indextr].unit_id.text">
                    {{data[indextr].unit_id.text}}
                  </vs-td> -->
                  <vs-td :data="data[indextr].unit_id">
                    {{data[indextr].unit_id}}
                  </vs-td>
                  <vs-td :data="data[indextr].unit_price">
                    {{data[indextr].unit_price}} <small style="color:#42b983;"><b>افغانی </b></small>
                  </vs-td>
                  <vs-td :data="data[indextr].total_price">
                    {{data[indextr].total_price}} <small style="color:#42b983;"><b>افغانی </b></small>
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
                  <small class="mb-5" v-text="pForm.deposit" vs-justify="right" vs-align="right"></small>
                  <small style="color:#42b983;"><b>% </b></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    مالیات:
                  </strong>
                  <small class="mb-5" v-text="pForm.tax" vs-justify="right" vs-align="right"></small>
                  <small style="color:#42b983;"><b>% </b></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    متفرقه:
                  </strong>
                  <small class="mb-5" v-text="pForm.others" vs-justify="right" vs-align="right"></small>
                  <small style="color:#42b983;"><b>افغانی </b></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    ارزش قرارداد:
                  </strong>
                  <small class="mb-5" v-text="pForm.pr_worth" vs-justify="right" vs-align="right"></small>
                  <small style="color:#42b983;"><b>افغانی </b></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    انتقالات:
                  </strong>
                  <small class="mb-5" v-text="pForm.transit" vs-justify="right" vs-align="right"></small>
                  <small style="color:#42b983;"><b>افغانی </b></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    نرخ دهی:
                  </strong>
                  <small class="mb-5" v-text="pForm.transit" vs-justify="right" vs-align="right"></small>
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
      </vx-card>
    </vs-tab>
    <vs-tab label=" لست قرار دادها">
      <div class="vx-row">
        <!-- <project-list></project-list> -->
        <ProposalList></ProposalList>
      </div>
    </vs-tab>
  </vs-tabs>
</div>
</template>

<script>
import vSelect from "vue-select";
import OrganizationAdd from "./OrganizationAdd.vue";
import DataViewSidebar from "./DataViewSidebar.vue";
import moduleDataList from "./data-list/moduleDataList.js";
import ProjectList from "./ProjectList.vue";
import Ekmalat from "../shared/Ekmalat";
import ProposalList from './proposals/ProposalList.vue'

import {
  FormWizard,
  TabContent
} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

export default {
  components: {
    OrganizationAdd,
    ProjectList,
    "v-select": vSelect,
    FormWizard,
    TabContent,
    Ekmalat,
    ProposalList
  },
  data() {
    return {
      is_accepted: false,
      currentSerialNo: 0,
      // init values
      org: [],
      mainSNumber: 0,
      // Project Form
      pForm: new Form({
        serial_no: '1001',
        proposal_id: '',
        contract_date: '',
        client_id: '',
        title: '',
        status: "1",
        reference_no: '',
        contract_end_date: '',
        project_guarantee: '',
        item: [{
          item_id: '',
          ammount: '',
          unit_id: '',
          unit_price: '',
          total_price: '',
          density: '',
        }],
        deposit: '',
        tax: '',
        others: '',
        pr_worth: '',
        transit: '',

      }),
      clients: [],
      items: [],
      mesure_unit: [],
      announces: [{
        text: 'اعلان قرار داد تیل وزارت دفاع',
        value: '1'
      }, {
        text: 'اعلان قرار داد تیل وزارت داخله',
        value: '2'
      }],
      organs: [{
          text: 'وزارت داخله',
          value: '1'
        },
        {
          text: 'وزارت دفاع ملی',
          value: '2'
        }
      ],
      itemType: [{
          text: "تیل دیزل",
          value: "1",
        },
        {
          text: "تیل گاز",
          value: "2",
        },
        {
          text: "تیل پطرول",
          value: "3",
        },
        {
          text: "موبلین",
          value: "4",
        },
      ],
      // End Project Form

      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {},
      statusFa: {
        on_hold: "درجریان",
        delivered: "تکمیل",
        canceled: "نا موفق",
      },
      selected: [],
      // products: [],
      itemsPerPage: 4,
      isMounted: false,
      addNewDataSidebar: false,
      sidebarData: {},
    };
  },
  created() {
    // this.getNextSerianNo();
    this.getAllClients();
    this.getAllItems();
    this.getAllUnites();
  },
  computed: {
    isFormValid() {
      return Object.keys(this.fields).some(key => this.fields[key].validated) && Object.keys(this.fields).some(key => this.fields[key].valid);
    },
    currentPage() {
      if (this.isMounted) {
        return this.$refs.table.currentx;
      }
      return 0;
    },
    queriedItems() {
      return this.$refs.table ?
        this.$refs.table.queriedResults.length :
        this.products.length;
    },
  },
  mounted() {
    this.isMounted = false;
    this.$validator.validate();
  },
  methods: {
    getNextSerianNo() {
      this.$Progress.start()
      this.axios.get('/api/getAddSerianID')
        .then((response) => {
          this.currentSerialNo = response.data;
          this.pForm.serial_no = this.currentSerialNo;
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
        })
    },

    // for getting measure unit of the item
    getAllUnites() {
      this.$Progress.start()
      this.axios.get('/api/add-unites')
        .then((response) => {
          this.mesure_unit = response.data;
        })
    },

    // set the id of Selected Organ
    setClientId(arr) {
      this.pForm.client_id = arr.text;
    },

    // set the id of Selected Goods/Product name
    setItemId(arr) {
      this.pForm.item.item_id = arr.id;
    },

    // set the id of Selected Measure Unite
    setUnitId(arr) {
      this.pForm.item.unit_id = arr.id;
    },

    addNewRow() {
      this.pForm.item.push({
        item_id: '',
        ammount: '',
        unit_id: '',
        unit_price: '',
        total_price: '',
      })
    },
    removeRow() {
      if (this.pForm.item.length > 1) {
        this.pForm.item.splice(this.pForm.item.length - 1, 1)
      }
    },

    submitForm() {
      // Start the Progress Bar
      this.$Progress.start()

      this.pForm.post('/api/project')
        .then(({
          data
        }) => {
          // Finish the Progress Bar
          this.getLastProj();
          this.$Progress.set(100)
          this.$vs.notify({
            title: 'موفقیت!',
            text: 'قرارداد ' + data.title + ' موفقانه ثبت شد.',
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
    formReset() {
      this.pForm.reset();
      this.pForm.s_number = this.mainSNumber;
    },
    addNewData() {
      this.sidebarData = {};
      this.toggleDataSidebar(true);
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val;
    },
    goTo(data) {
      this.$router
        .push({
          path: "/projects/project/${data.id}",
          name: "project-view",
          params: {
            id: data.id,
            dyTitle: data.name
          },
        })
        .catch(() => {});
    },
    viewProject(id) {
      // Vue.$forceUpdate();
      this.$router.push("/projects/project/" + id).catch(() => {});
    },
    // End Custom
    addNewData() {
      this.sidebarData = {};
      this.toggleDataSidebar(true);
    },
    deleteData(id) {
      this.$store.dispatch("dataList/removeItem", id).catch((err) => {
        console.error(err);
      });
    },
    editData(data) {
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      this.sidebarData = data;
      this.toggleDataSidebar(true);
    },
    getOrderStatusColor(status) {
      if (status === "on_hold") return "warning";
      if (status === "delivered") return "success";
      if (status === "canceled") return "danger";
      return "primary";
    },
    getPopularityColor(num) {
      if (num > 90) return "success";
      if (num > 70) return "primary";
      if (num >= 50) return "warning";
      if (num < 50) return "danger";
      return "primary";
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val;
    },
  },
};
</script>

<style lang="scss">
#data-list-thumb-view {
  .vs-con-table {
    .product-name {
      max-width: 23rem;
    }

    .vs-table--header {
      display: flex;
      flex-wrap: wrap-reverse;
      margin-left: 1.5rem;
      margin-right: 1.5rem;

      >span {
        display: flex;
        flex-grow: 1;
      }

      .vs-table--search {
        padding-top: 0;

        .vs-table--search-input {
          padding: 0.9rem 2.5rem;
          font-size: 1rem;

          &+i {
            left: 1rem;
          }

          &:focus+i {
            left: 1rem;
          }
        }
      }
    }

    .vs-table {
      border-collapse: separate;
      border-spacing: 0 1.3rem;
      padding: 0 1rem;

      tr {
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.05);

        td {
          padding: 10px;

          &:first-child {
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
          }

          &:last-child {
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
          }

          &.img-container {

            // width: 1rem;
            // background: #fff;
            span {
              display: flex;
              justify-content: flex-start;
            }

            .product-img {
              height: 110px;
            }
          }
        }

        td.td-check {
          padding: 20px !important;
        }
      }
    }

    .vs-table--thead {
      th {
        padding-top: 0;
        padding-bottom: 0;

        .vs-table-text {
          text-transform: uppercase;
          font-weight: 600;
        }
      }

      th.td-check {
        padding: 0 15px !important;
      }

      tr {
        background: none;
        box-shadow: none;
      }
    }

    .vs-table--pagination {
      justify-content: center;
    }
  }
}
</style>
