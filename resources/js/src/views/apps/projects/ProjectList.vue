<template>
<div id="data-list-thumb-view" class="w-full data-list-container">
  <div v-if="!isdata">
    <TableLoading></TableLoading>
  </div>
  <vs-table v-if="isdata" class="w-full" ref="table" pagination :max-items="itemsPerPage" search :data="projects">
    <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">
      <!-- ITEMS PER PAGE -->
      <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4">
        <div class="pl-4 pr-4 pt-1 pb-1 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
          <!-- <span class="mr-2">۴ از ۱۰</span> -->
          <span class="mr-2">
            {{ currentPage * itemsPerPage - (itemsPerPage - 1) }} -
            {{
              projects.length - currentPage * itemsPerPage > 0
              ? currentPage * itemsPerPage
              : projects.length
              }}
            از {{ queriedItems }}
          </span>
          <!-- <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ projects.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : projects.length }} از {{ queriedItems }}</span> -->
          <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
        </div>
        <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
        <vs-dropdown-menu>
          <vs-dropdown-item @click="itemsPerPage = 4">
            <span>۴</span>
          </vs-dropdown-item>
          <vs-dropdown-item @click="itemsPerPage = 10">
            <span>۱۰</span>
          </vs-dropdown-item>
          <vs-dropdown-item @click="itemsPerPage = 15">
            <span>۱۵</span>
          </vs-dropdown-item>
          <vs-dropdown-item @click="itemsPerPage = 20">
            <span>۲۰</span>
          </vs-dropdown-item>
        </vs-dropdown-menu>
      </vs-dropdown>
      <!--<vs-button size="small" type="gradient" icon="print" id="printBTN" @click.stop="printProject">چاپ</vs-button> -->
    </div>
    <template slot="thead">
      <vs-th>نمبر</vs-th>
      <vs-th>نهاد</vs-th>
      <vs-th sort-key="name">قرارداد</vs-th>
      <vs-th sort-key="project_guarantee">تضمین قرارداد</vs-th>
      <vs-th sort-key="pr_worth">ارزش قرارداد</vs-th>
      <vs-th sort-key="total_price">قیمت</vs-th>
      <vs-th sort-key="contract_end_date">تاریخ ختم</vs-th>
      <vs-th sort-key="contract_date">تاریخ قرارداد</vs-th>
      <vs-th>نمظیمات</vs-th>
    </template>
    <template slot-scope="{data}">
      <tbody>
        <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
          <vs-td class="pl-2 text-center">
            {{ indextr + 1 }}
          </vs-td>
          <vs-td class="img-container">
            <p v-if="tr.pro_data" class="product-name font-medium truncate" @click.stop="$router.push({ path: `/projects/project/${tr.id}` })">
              <!-- <img :src="tr.img" class="product-img" /> -->
              <p>{{ findClient(tr.pro_data.client_id) }}</p>
            </p>
          </vs-td>
          <vs-td>
            <div v-if="tr.pro_data">
              <p class="product-name font-medium truncate" @click.stop="$router.push({ path: `/projects/project/${tr.id}` })">
                {{ tr.pro_data.title }}</p>
            </div>
          </vs-td>
          <vs-td>
            <!-- <vs-progress :percent="Number(tr.popularity)" :color="getPopularityColor(Number(tr.popularity))" class="shadow-md" /> -->
            <p class="project_guarantee">{{ tr.project_guarantee }} افغانی</p>
          </vs-td>
          <vs-td>
            <p v-if="tr.pro_data" class="contract_end_date">{{ tr.pro_data.pr_worth }}</p>
          </vs-td>
          <vs-td>
            <p v-if="tr.pro_data" class="product-total_price">{{ tr.pro_data.total_total_price }} افغانی</p>
          </vs-td>
          <vs-td>
            <p class="contract_end_date">{{ tr.contract_end_date }}</p>
          </vs-td>
          <vs-td>
            <p class="contract_date">{{ tr.contract_date }}</p>
          </vs-td>
          <vs-td class="whitespace-no-wrap notupfromall">
            <feather-icon icon="CheckSquareIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current" class="ml-2" @click.stop="showStepsModal(tr.id)" />&nbsp;&nbsp;
            <feather-icon icon="PrinterIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current" class="ml-2" @click.stop="showPrintData(tr.id)" />&nbsp;&nbsp;
            <!--<router-link class="product-name font-medium truncate"> -->
            <feather-icon icon="EditIcon" svgClasses="w-6 h-6 hover:text-primary stroke-current" />
            <!--</router-link> -->
            <feather-icon icon="TrashIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(tr.id)" />
          </vs-td>
        </vs-tr>
      </tbody>
    </template>
  </vs-table>
  <!--:before-change="changeStepStatus(1)"-->
  <vs-popup class="holamundo" title="تنظیمات مربط پروژه" :active.sync="popupModalActive">
    <form-wizard color="rgba(var(--vs-primary), 1)" :title="null" :subtitle="null" :start-index="step-1" ref="wizard" @on-complete="formSubmitted">
      <tab-content title="دریافت قرار داد" class="mb-5" :before-change="changeStepStatus">
        <vs-row vs-w="12" class="mb-1">
          <vs-row vs-w="12">
            <vs-divider>دریافت قرار داد</vs-divider>
          </vs-row>
          <vs-row vs-w="12">
            <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="vx-row">
                <vs-col vs-lg="3" vs-sm="4" vs-xs="12">
                  <div class="img-container" v-if="project.pro_data">
                    <img :src="'/images/img/clients/'+project.pro_data.client.logo" style="height:80px;margin:-1px 10px" class="product-img" />
                  </div>
                </vs-col>
                <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="8" vs-xs="12">
                  <div class="vx-row w-full">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p clas="w-full" v-if="project.pro_data"><strong>نام نهاد: </strong><span v-text="project.pro_data.client.name"></span></p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                      <p class="w-full" v-if="project.pro_data"><strong>شماره قرارداد: </strong><span v-text="project.pro_data.reference_no"></span></p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p class="w-full pr-5" v-if="project.pro_data"><strong>عنوان قرارداد: </strong><span v-text="project.pro_data.title"></span></p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p class="w-full pr-5" v-if="project.pro_data"><strong>تاریخ قرارداد: </strong>(<span v-text="project.contract_date"></span>&nbsp;-&nbsp;<span v-text="project.contract_end_date"></span>)</p>
                    </vs-col>
                  </div>
                </vs-col>
              </div>
            </vs-col>
            <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="w-full pt-2 ml-3 mr-3 p-3">
                <!--<label for class="ml-4 mr-4 mb-2">نوعیت قرارداد</label>-->
                <div class="radio-group w-full">
                  <div class="w-1/2">
                    <input type="radio" v-model="status" value="1" id="active" name="status" />
                    <label for="active" class="w-full text-center p-4">قرارداد فعال است</label>
                  </div>
                  <div class="w-1/2">
                    <input type="radio" v-model="status" value="2" id="deactive" name="status" />
                    <label for="deactive" class="w-full text-center p-4">قرارداد داد غیر فعال است</label>
                  </div>
                </div>
              </div>
            </vs-col>
          </vs-row>
          <vs-divider>بخش اکمالات</vs-divider>
          <vs-table class="responsive" :data="project.pro_items">
            <template slot="thead">
              <vs-th>جنس / محصول</vs-th>
              <vs-th>مقدار</vs-th>
              <vs-th>عملیه</vs-th>
              <vs-th>قیمت فی واحد</vs-th>
              <vs-th>قیمت مجموعی</vs-th>
            </template>
            <template slot-scope="{data}">
              <vs-tr v-for="(tr, i) in data" :key="i">
                <vs-td :data="tr.item_id">
                    <p> {{ (tr.item_id && tr.item_id.type) ? tr.item_id.type.type : '' }} {{ tr.item_id.name }} </p>
                </vs-td>
                <vs-td :data="tr.equivalent">
                  {{tr.equivalent}} {{ tr.item_id.uom_equiv_id.title }}
                </vs-td>
                <vs-td :data="tr.operation_id">
                  <p> {{ tr.operation_id.formula }} </p>
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
        </vs-row>
      </tab-content>
      <tab-content title=" مرحله اکمالات وتوزیعات" class="mb-5">
        <vs-row vs-w="12" class="mb-1">
          <vs-row vs-w="12">
            <vs-divider> مرحله اکمالات وتوزیعات</vs-divider>
          </vs-row>
          <vs-row vs-w="12">
            <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="vx-row">
                <vs-col vs-lg="3" vs-sm="4" vs-xs="12">
                  <div class="img-container" v-if="project.pro_data">
                    <img :src="'/images/img/clients/'+project.pro_data.client.logo" style="height:80px;margin:-1px 10px" class="product-img" />
                  </div>
                </vs-col>
                <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="8" vs-xs="12">
                  <div class="vx-row w-full">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p clas="w-full" v-if="project.pro_data"><strong>نام نهاد: </strong><span v-text="project.pro_data.client.name"></span></p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                      <p class="w-full" v-if="project.pro_data"><strong>شماره قرارداد: </strong><span v-text="project.pro_data.reference_no"></span></p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p class="w-full pr-5" v-if="project.pro_data"><strong>عنوان قرارداد: </strong><span v-text="project.pro_data.title"></span></p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p class="w-full pr-5" v-if="project.pro_data"><strong>تاریخ قرارداد: </strong>(<span v-text="project.contract_date"></span>&nbsp;-&nbsp;<span v-text="project.contract_end_date"></span>)</p>
                    </vs-col>
                  </div>
                </vs-col>
              </div>
            </vs-col>
            <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="p-6">
                <vs-checkbox color="success" class="float-left" size="large" v-model="is_ekmalat_allowed"><strong>اکمالات مجاز است </strong></vs-checkbox>
              </div>
            </vs-col>
          </vs-row>
          <vs-divider>بخش اکمالات</vs-divider>
          <vs-table class="responsive" :data="project.pro_items">
            <template slot="thead">
              <vs-th>جنس / محصول</vs-th>
              <vs-th>مقدار</vs-th>
              <vs-th>عملیه</vs-th>
              <vs-th>قیمت فی واحد</vs-th>
              <vs-th>قیمت مجموعی</vs-th>
            </template>
            <template slot-scope="{data}">
              <vs-tr v-for="(tr, i) in data" :key="i">
                <vs-td :data="tr.item_id">
                    <p> {{ (tr.item_id && tr.item_id.type) ? tr.item_id.type.type : '' }} {{ tr.item_id.name }} </p>
                </vs-td>
                <vs-td :data="tr.equivalent">
                  {{tr.equivalent}} {{ tr.item_id.uom_equiv_id.title }}
                </vs-td>
                <vs-td :data="tr.operation_id">
                  <p> {{ tr.operation_id.formula }} </p>
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
        </vs-row>
      </tab-content>
      <tab-content title="اطلاعات مالی" class="mb-5" :before-change="changeStepStatus3">
        <vs-row vs-w="12" class="mb-1">
          <vs-divider>اطلاعات مالی</vs-divider>

          <vs-divider></vs-divider>
        </vs-row>
      </tab-content>
      <tab-content title="مراحل ختم پروژه" class="mb-5" :before-change="changeStepStatus4">
        <vs-row vs-w="12" class="mb-1">
          <vs-row vs-w="12">
            <vs-divider>مراحل ختم پروژه</vs-divider>
          </vs-row>
          <vs-row vs-w="12">
            <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="vx-row">
                <vs-col vs-lg="3" vs-sm="4" vs-xs="12">
                  <div class="img-container" v-if="project.pro_data">
                    <img :src="'/images/img/clients/'+project.pro_data.client.logo" style="height:80px;margin:-1px 10px" class="product-img" />
                  </div>
                </vs-col>
                <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="8" vs-xs="12">
                  <div class="vx-row w-full">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p clas="w-full" v-if="project.pro_data"><strong>نام نهاد: </strong><span v-text="project.pro_data.client.name"></span></p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                      <p class="w-full" v-if="project.pro_data"><strong>شماره قرارداد: </strong><span v-text="project.pro_data.reference_no"></span></p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p class="w-full pr-5" v-if="project.pro_data"><strong>عنوان قرارداد: </strong><span v-text="project.pro_data.title"></span></p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p class="w-full pr-5" v-if="project.pro_data"><strong>تاریخ قرارداد: </strong>(<span v-text="project.contract_date"></span>&nbsp;-&nbsp;<span v-text="project.contract_end_date"></span>)</p>
                    </vs-col>
                  </div>
                </vs-col>
              </div>
            </vs-col>
            <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="p-2">
                <div class="p-2">
                  <vs-checkbox color="success" size="large" v-model="mactob_sending"><strong>ارسال مکتوبات </strong></vs-checkbox>
                </div>
                <div class="p-2">
                  <vs-checkbox color="success" size="large" v-model="adminis_procedure"><strong>طی مراحل اداری</strong></vs-checkbox>
                </div>
                <div class="p-2">
                  <vs-checkbox color="success" size="large" v-model="setting_and_baqyat"><strong>دریافت تنظیمات و باقیات</strong></vs-checkbox>
                </div>
              </div>
            </vs-col>
          </vs-row>
          <vs-divider></vs-divider>
        </vs-row>
      </tab-content>
      <tab-content title="تکمیل پروژه" class="mb-5" :before-change="changeStepStatus5">
        <vs-row vs-w="12" class="mb-1">
          <vs-row vs-w="12">
            <vs-divider>تکمیل پروژه</vs-divider>
          </vs-row>
          <vs-row vs-w="12">
            <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="vx-row">
                <vs-col vs-lg="3" vs-sm="4" vs-xs="12">
                  <div class="img-container" v-if="project.pro_data">
                    <img :src="'/images/img/clients/'+project.pro_data.client.logo" style="height:80px;margin:-1px 10px" class="product-img" />
                  </div>
                </vs-col>
                <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="8" vs-xs="12">
                  <div class="vx-row w-full">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p clas="w-full" v-if="project.pro_data"><strong>نام نهاد: </strong><span v-text="project.pro_data.client.name"></span></p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                      <p class="w-full" v-if="project.pro_data"><strong>شماره قرارداد: </strong><span v-text="project.pro_data.reference_no"></span></p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p class="w-full pr-5" v-if="project.pro_data"><strong>عنوان قرارداد: </strong><span v-text="project.pro_data.title"></span></p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p class="w-full pr-5" v-if="project.pro_data"><strong>تاریخ قرارداد: </strong>(<span v-text="project.contract_date"></span>&nbsp;-&nbsp;<span v-text="project.contract_end_date"></span>)</p>
                    </vs-col>
                  </div>
                </vs-col>
              </div>
            </vs-col>
            <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="p-5">
                <vs-checkbox color="success" size="large" v-model="finishedcontract"><strong>ختم قرارداد</strong></vs-checkbox>
              </div>
            </vs-col>
          </vs-row>
          <vs-divider>بخش اکمالات</vs-divider>
          <vs-table class="responsive" :data="project.pro_items">
            <template slot="thead">
              <vs-th>جنس / محصول</vs-th>
              <vs-th>مقدار</vs-th>
              <vs-th>عملیه</vs-th>
              <vs-th>قیمت فی واحد</vs-th>
              <vs-th>قیمت مجموعی</vs-th>
            </template>
            <template slot-scope="{data}">
              <vs-tr v-for="(tr, i) in data" :key="i">
                <vs-td :data="tr.item_id">
                    <p> {{ (tr.item_id && tr.item_id.type) ? tr.item_id.type.type : '' }} {{ tr.item_id.name }} </p>
                </vs-td>
                <vs-td :data="tr.equivalent">
                  {{tr.equivalent}} {{ tr.item_id.uom_equiv_id.title }}
                </vs-td>
                <vs-td :data="tr.operation_id">
                  <p> {{ tr.operation_id.formula }} </p>
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
          <vs-divider></vs-divider>
        </vs-row>
      </tab-content>
      <vs-button slot="prev">قبلی</vs-button>
      <vs-button slot="next">بعدی</vs-button>
      <vs-button slot="finish">بستن صحفه</vs-button>
    </form-wizard>
  </vs-popup>
</div>
</template>

<script>
import DataViewSidebar from "./DataViewSidebar.vue"
import TableLoading from './../shared/TableLoading.vue'
import {
  Form,
  HasError,
  AlertError
} from 'vform';
import {
  FormWizard,
  TabContent
} from 'vue-form-wizard'

export default {
  name: "vx-project-list",
  data() {
    return {
      status: 1,
      step: 1,
      is_ekmalat_allowed: 0,
      adminis_procedure: 0,
      setting_and_baqyat: 0,
      finishedcontract: 0,
      mactob_sending: 0,
      isdata: false,
      popupModalActive: false,
      activeLoading: false,
      // Project Form
      pForm: new Form({
        serial_no: '',
        issue_date: '',
        issue_address: '',
        source_address: '',
        title: '',
        img: '',
        auth_number: '',
        type: '',
        total_price: '0',
        duration: '',
        offer_date: '',
        close_date: '',
        offer_total_price: '0',
        project_total_price: '0',
        announce_id: '',
        organization_id: '',
      }),
      // End Project Form

      pr_worthFa: {
        on_hold: "درجریان",
        delivered: "تکمیل",
        canceled: "نا موفق",
      },
      selected: [],
      projects: [],
      project: [],
      itemsPerPage: 5,
      isMounted: false,
      addNewDataSidebar: false,
      sidebarData: {},
      clients: [],
    };
  },
  components: {
    DataViewSidebar,
    FormWizard,
    TabContent,
    TableLoading
  },
  created() {
    this.getProject();
    this.getAllClients();
  },
  computed: {
    currentPage() {
      if (this.isMounted) {
        return this.$refs.table.currentx;
      }
      return 0;
    },
    queriedItems() {
      return this.$refs.table ?
        this.$refs.table.queriedResults.length :
        this.projects.length;
    },
  },
  methods: {
    changeStepStatus() {
      if (this.step == 1) {
        alert("you were at the Step :" + this.step)
        this.step = 2
      } else if (this.step == 2) {
        alert("came from step :" + this.step)
        this.step = 1
        alert("changed back to :" + this.step)
      } else if (this.step == 3) {
        alert("came from step :" + this.step)
        this.step = 1
        alert("changed back to :" + this.step)
      } else if (this.step == 4) {
        alert("came from step :" + this.step)
        this.step = 1
        alert("changed back to :" + this.step)
      } else if (this.step == 5) {
        alert("came from step :" + this.step)
        this.step = 1
        alert("changed back to :" + this.step)
      }
      return true;
    },

    changeStepStatus2() {
      if (this.step == 2) {
        alert("you were at the Step :" + this.step)
        this.step = 2
      } else if (this.step == 2) {
        alert("came from step :" + this.step)
        this.step = 1
        alert("changed back to :" + this.step)
      } else if (this.step == 3) {
        alert("came from step :" + this.step)
        this.step = 1
        alert("changed back to :" + this.step)
      } else if (this.step == 4) {
        alert("came from step :" + this.step)
        this.step = 1
        alert("changed back to :" + this.step)
      } else if (this.step == 5) {
        alert("came from step :" + this.step)
        this.step = 1
        alert("changed back to :" + this.step)
      }
      return true;
    },
    changeStepStatus3() {

      // this.step = this.step + 1;
      alert("you changed the Step 3")
      return true;
    },
    changeStepStatus4() {

      // this.step = this.step + 1;
      alert("you changed the Step 4")
      return true;
    },
    changeStepStatus5() {

      // this.step = this.step + 1;
      alert("you changed the Step 5")
      return true;
    },
    getThisProject(id) {
      this.$Progress.start()
      this.axios.get('/api/project/' + id)
        .then((response) => {
          this.project = response.data;
          console.log('project', this.project);
          this.$Progress.set(100);
        }).catch(() => {});
    },

    formSubmitted() {
      alert("تنظیمات بسته شد")
      this.popupModalActive = false;

    },
    showStepsModal(id) {
      this.popupModalActive = true;
      this.getThisProject(id);
    },
    showPrintData(id) {
      this.popupActive = true;
    },
    findClient(id) {
      let name = '';
      Object.keys(this.clients).some(key => (this.clients[key].id == id) ? name = this.clients[key].name : null);
      return name;
    },
    // for Organs that implement the ad
    getAllClients() {
      this.axios.get('/api/clients')
        .then((response) => {
          this.clients = response.data;
          this.$Progress.set(100)
        })
    },
    getProject() {
      // Start the Progress Bar
      this.$Progress.start()
      // this.$vs.loading()
      this.pForm.get('/api/project').then((data) => {
          this.projects = data.data;
          console.log('projects', this.projects);
          this.isdata = true;
          this.$Progress.set(100);
          // this.$vs.loading.close();
          // Finish the Progress Bar
        })
        .catch(() => {});
    },

    // Start Custom
    goTo(data) {
      this.$router
        .push({
          path: "/projects/project/${data.id}",
          name: "project-view",
          params: {
            id: data.id,
            dyTitle: data.title
          },
        })
        .catch(() => {});
    },
    goToEdit(data) {
      this.$router
        .push({
          path: "/projects/project/${data.id}/edit",
          name: "project-edit",
          params: {
            id: data.id,
            dyTitle: data.title
          },
        })
        .catch(() => {});
    },
    // End Custom
    addNewData() {
      this.sidebarData = {};
      this.toggleDataSidebar(true);
    },
    deleteData(id, title) {
      swal.fire({
        title: 'آیا  مطمئن هستید؟',
        text: "پروژه حذف خواهد شد",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>خیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.pForm.delete('/api/project/' + id).then((id) => {
              swal.fire({
                title: 'عملیه موفقانه انجام شد.',
                text: "پروژه از سیستم پاک شد!",
                icon: 'success',
              })
              this.getProject();
            })
            .catch(() => {});
        }
      })
    },
    editData(data) {
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      this.sidebarData = data;
      this.toggleDataSidebar(true);
    },
    getOrderStatusColor(pr_worth) {
      if (pr_worth === "on_hold") return "warning";
      if (pr_worth === "delivered") return "success";
      if (pr_worth === "canceled") return "danger";
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
    printProject() {
      window.print();
    }
  }
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
</style><style>
.con-vs-popup .vs-popup {
  width: 900px;
}

.vue-form-wizard .navbar .navbar-nav>li>a.wizard-btn,
.vue-form-wizard .wizard-btn {
  min-width: 40px !important;
}

[dir] .vue-form-wizard .wizard-tab-content {
  padding: 30px 20px 2px 10px !important;
}
</style>
