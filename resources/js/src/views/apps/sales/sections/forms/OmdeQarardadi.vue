<template>
<form data-vv-scope="s1Form" :before-change="validateS1Add">
  <div class="vx-row">
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <label for=""><small>سریال نمبر</small></label>
        <vx-input-group class="number-rtl">
          <template slot="append">
            <div v-if="sForm.project_id && sForm.project_id.pro_data" class="append-text bg-primary serial_no_reference">
              <span>{{ sForm.project_id.pro_data.reference_no }}</span>
            </div>
            <div class="append-text bg-primary">
              <span>S1</span>
            </div>
          </template>
          <vs-input :value="sForm.serial_no" disabled autocomplete="off" placeholder="انتخاب قرارداد الزمی است." type="number" />
        </vx-input-group>
      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <label for class="ml-4 mr-4 mb-2">واحد پولی</label>
        <div class="radio-group w-full">
          <div class="w-1/2">
            <input type="radio" v-model="sForm.currency_id" value="1" id="struct" name="curency" />
            <label for="struct" class="w-full text-center">افغانی</label>
          </div>
          <div class="w-1/2">
            <input type="radio" v-model="sForm.currency_id" value="2" id="specific" name="curency" />
            <label for="specific" class="w-full text-center">دالر</label>
          </div>
        </div>
      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <label for="date" class="mt-3"><small>تاریخ</small></label>
      <date-picker v-model="sForm.datatime" inputFormat="jYYYY/jMM/jDD HH:mm" display-format="jYYYY/jMM/jDD hh:mm" color="#e85454" type="datetime" v-validate="'required'" :title="errors.first(`contract_date`)" v-bind:class="errors.first(`contract_date`) ? 'has-error' : ''" name="sel_date" :auto-submit="true" size="large"></date-picker>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <label for class="vs-input--label">انتخاب قراردادها</label>
        <v-select v-validate="'required'" v-model="sForm.project_id" :get-option-label="
              (option) => option.serial_no + ' - ' + option.pro_data.title
            " name="contract" :options="contracts" :searchable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" @input="onChangeContract">
          <span slot="no-options">{{ $t("WhoopsNothinghere") }}</span>
        </v-select>
      </div>
    </div>
  </div>
  <div class="vx-row">
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input name="client_name" v-validate="'required|min:2'" class="w-full" v-bind:value="field_data.clientName" label="نام نهاد" />
      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input class="w-full" v-bind:value="field_data.repativePerson" type="text" label="شخص ارتباطی" />
      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input name="phone_number" v-validate="'required|min:2'" class="w-full number-rtl" v-bind:value="field_data.clientPhone" label="شماره تماس" />
      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input name="address" v-validate="'required|min:3'" class="w-full" v-bind:value="field_data.clientAddress" label="آدرس" />
      </div>
    </div>
  </div>
  <!-- 3td Row -->
  <div class="vx-row">
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <!-- This conpoment need the form source id and form source type field -->
      <label for=""><small>منبع</small></label>
      <source-select :parentForm="sForm"></source-select>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-3/4 xl:w-3/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input v-model="sForm.destination" v-validate="'required'" :title="errors.first(`destination`)" v-bind:class="errors.first(`destination`) ? 'has-error' : ''" name="destination" class="w-full" label="مقصد" />
      </div>
    </div>
  </div>
  <!-- EkmalatStock -->
  <ekmalat-stock :items="sForm.item" :form="sForm" :currencyID="sForm.currency_id" :listOfFields="[]" :disabledFields="[]" :grid="[]" ref="ekmalat"></ekmalat-stock>
  <vs-row vs-w="12" class="mb-base">
    <vs-col vs-type="flex" vs-w="3">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 mr-3">
          <label for=""><small>مصارف انتقالات</small></label>
          <vx-input-group class="number-rtl">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span v-if="sForm.currency_id==1">AFN</span>
                <span v-if="sForm.currency_id==2">USD</span>
              </div>
            </template>
            <vs-input v-model="sForm.transport_cost" autocomplete="off" type="number" v-validate="'required'" name="others" />
          </vx-input-group>
          <span class="absolute text-danger alerttext">{{
              errors.first("step-2.others")
            }}</span>
          <has-error :form="sForm" field="others"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>مصارف خدمات</small></label>
          <vx-input-group class="number-rtl">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span v-if="sForm.currency_id==1">AFN</span>
                <span v-if="sForm.currency_id==2">USD</span>
              </div>
            </template>
            <vs-input v-model="sForm.service_cost" autocomplete="off" type="number" v-validate="'required'" name="transit" />
          </vx-input-group>
          <span class="absolute text-danger alerttext">{{
              errors.first("step-2.transit")
            }}</span>
          <has-error :form="sForm" field="transit"></has-error>
        </div>
      </vs-col>
    </vs-col>
    <vs-col vs-type="flex" vs-w="3">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="12" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>قیمت مجموعی</small></label>
          <vx-input-group class="number-rtl">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span v-if="sForm.currency_id==1">AFN</span>
                <span v-if="sForm.currency_id==2">USD</span>
              </div>
            </template>
            <vs-input disabled :value="saleTotalCost" autocomplete="off" type="number" />
          </vx-input-group>
          <span class="absolute text-danger alerttext">{{
              errors.first("step-2.total_price")
            }}</span>
        </div>
      </vs-col>
    </vs-col>

    <vs-col vs-type="flex" vs-w="3">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>مالیات</small></label>
          <vx-input-group class="number-rtl">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>٪</span>
              </div>
            </template>
            <vs-input v-model="sForm.tax" autocomplete="off" type="number" v-validate="'required'" name="tax" />
          </vx-input-group>
          <span class="absolute text-danger alerttext">{{
              errors.first("step-2.tax")
            }}</span>
          <has-error :form="sForm" field="tax"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 mr-3">
          <!-- TITLE -->
          <label for=""><small>تامینات</small></label>
          <vx-input-group class="number-rtl">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>٪</span>
              </div>
            </template>
            <vs-input v-model="sForm.deposit" autocomplete="off" type="number" v-validate="'required'" name="deposit" />
          </vx-input-group>
          <span class="absolute text-danger alerttext">{{
              errors.first("step-2.deposit")
            }}</span>
          <has-error :form="sForm" field="deposit"></has-error>
        </div>
      </vs-col>
    </vs-col>

    <vs-col vs-type="flex" vs-w="3">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="12" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>قیمت نهایی</small></label>
          <vx-input-group class="number-rtl">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span v-if="sForm.currency_id==1">AFN</span>
                <span v-if="sForm.currency_id==2">USD</span>
              </div>
            </template>
            <vs-input disabled :value="saleTotalCostFinal" autocomplete="off" type="number" />
          </vx-input-group>
          <span class="absolute text-danger alerttext">{{
              errors.first("step-2.total_price")
            }}</span>
        </div>
      </vs-col>
    </vs-col>
  </vs-row>
  <div class="vx-row">
    <div class="w-full pt-2 ml-3 mr-3">
      <vs-col vs-align="right" vs-lg="3" class="pl-4" vs-sm="3" vs-xs="12">
        <bank-account-select :form="sForm"></bank-account-select>
      </vs-col>
    </div>
  </div>
  <div class="vx-row">
    <div class="w-full pt-2 ml-3 mr-3">
      <label for=""><small>تفصیلات</small></label>
      <vs-textarea v-model="sForm.description" class="mr-3 mb-1 w-full" />
    </div>
  </div>
  <div class="vx-row official-process">
    <vs-collapse type="margin">
      <vs-collapse-item>
        <div slot="header">طی مراحل اداری</div>
        <ul class="demo-alignment">
          <li v-for="(n, index) in checked" :key="index">
            <div class="vs-component con-vs-checkbox vs-checkbox-success vs-checkbox-default">
              <input type="checkbox" class="vs-checkbox--input" v-model="n.state" @click="appCheckBoxes(index)" value="">
              <span class="checkbox_x vs-checkbox" style="border: 2px solid rgb(180, 180, 180);">
                <span class="vs-checkbox--check">
                  <i class="vs-icon notranslate icon-scale vs-checkbox--icon  material-icons null">check</i>
                </span>
              </span>
              <span class="con-slot-label">{{n.label}}</span>
            </div>
          </li>
        </ul>
      </vs-collapse-item>
    </vs-collapse>
  </div>
  <div class="mt-10">
    <div class="vx-col w-full">
      <vs-button @click.prevent="submitForm" class="mb-2">ثبت</vs-button>
      <vs-button color="warning" type="border" class="mb-2 ml-2" @click="resetForm">پاک کردن فرم</vs-button>
    </div>
  </div>
  <vs-list>
    <vs-list-header color="danger" title="مشکلات"></vs-list-header>
    <div :key="indextr" v-for="(error, indextr) in errors.items">
      <vs-list-item icon="verified_user" style="color:red;" :subtitle="error.msg"></vs-list-item>
    </div>
    <!--<vs-list-item title="" subtitle=""></vs-list-item> -->
  </vs-list>
</form>
</template>

<script>
import vSelect from "vue-select";
import EkmalatStock from "../../../shared/EkmalatStock";
import SourceSelect from "../../../shared/SourceSelect";
import BankAccountSelect from "../../../shared/BankAccountSelect"
import {
  Validator
} from 'vee-validate'

export default {
  props: {
    data: {
      type: Object,
      default: () => {},
    },
  },
  components: {
    "v-select": vSelect,
    EkmalatStock,
    SourceSelect,
    BankAccountSelect,
    Validator
  },
  data() {
    return {
      checked: [{
          state: false,
          label: 'تنظیم اطلاعات'
        },
        {
          state: false,
          label: 'تحویل اجناس'
        },
        {
          state: false,
          label: 'ارسال بل'
        },
        {
          state: false,
          label: 'فورم م-16 (m-16)'
        },
        {
          state: false,
          label: 'وزارت مالیه'
        },
        {
          state: false,
          label: 'دافغانستان بانک'
        },
        {
          state: false,
          label: 'دریافت پول'
        },
        {
          state: false,
          label: 'تایید'
        },
      ],
      userid: localStorage.getItem('id'),
      sForm: new Form({
        // sales_id: '', // Get the created sales id.
        serial_no: "",
        project_id: "",
        destination: "",
        transport_cost: "0",
        service_cost: "0",
        tax: "0",
        deposit: "0",
        total: "0",
        steps: null,
        description: "",

        // shared fields with other sales
        bank_account: null,
        type: "s1",
        source_id: "", // The Id of the Project.
        source_type: "", // Type Project
        user_id: localStorage.getItem('id'), //Get the current user id
        currency_id: 1,
        datatime: this.momentj().format('jYYYY/jMM/jDD HH:mm'),
        // Item for the ekmalat section
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
      items: [],
      contracts: [],
      field_data: [],
      dict: {
        custom: {
          curency: { required: ' واحد پولی الزامی میباشد.' },
          sel_date: { required: ' تاریخ فروش الزامی میباشد.' },
          contract: { required: ' انتخاب علان الزامی میباشد.' },
          client_name: { required: '  اسم نهاد الزامی میباشد.', min: 'اسم نهاد باید بیشتر از 2 حرف باشد.', },
          // person_relation: { required: '  شخص ارتباطی الزامی میباشد.', min: 'اسم شخص ارتباطی باید بیشتر از 2 حرف باشد.', },
          phone_number: { required: 'شماره تماس الزامی میباشد .', min: 'شماره تماس شخص ارتباطی باید بیشتر از 2 حرف باشد.', },
          address: { required: '  آدرس الزامی میباشد.', min: 'آدرس باید بیشتر از 3 حرف باشد.', },
          source: { required: ' انتخاب منبع الزامی میباشد.' },
          destination: { required: ' انتخاب مقصد الزامی میباشد.' },
          // sel_date: { required: '  الزامی میباشد.', min: 'اسم باید بیشتر از 2 حرف باشد.', },
        }
      }
      // End of sidebar items
    };
  },
  created() {
    Validator.localize('en', this.dict);
    this.getProject();
    window.addEventListener('keydown', (e) => {
      if (e.key == 'Enter') {
        if (!e.path.find(x => x.className === 'vs-textarea')) {
          this.submitForm();
        }
      }
    });
  },
  computed: {
    saleTotalCostFinal: function () {
      var x = parseFloat(this.sForm.total) - (this.sForm.total * ((this.sForm.deposit / 100)) + (this.sForm.total * (this.sForm.tax / 100)));
      return x.toFixed(2);
    },
    saleTotalCost: function () {
      var i_total = 0;
      this.sForm.item.forEach(item => {
        i_total += item.total_price;
      });

      this.sForm.total = (parseFloat(this.sForm.transport_cost) + parseFloat(this.sForm.service_cost) + parseFloat(i_total)).toFixed(2);
      return this.sForm.total;
    }
    // isFormValid() {
    //   // return !this.errors.any() && this.dataName && this.dataCategory && this.dataPrice > 0
    // },
  },
  methods: {
    validateS1Add() {
      // return new Promise((resolve, reject) => {
      //   this.$validator.validateAll('s1Form').then(result => {
      //     if (result) {
      //       resolve(true)
      //     } else {
      //       reject('correct all values')
      //     }
      //   })
      // })
    },
    getProject() {
      // Start the Progress Bar
      this.$Progress.start();
      this.$vs.loading();
      this.axios
        .get("/api/project")
        .then((data) => {
          this.contracts = data.data;
          console.log('contractss', this.contracts);
          // Finish the Progress Bar
          this.$Progress.set(100);
          this.$vs.loading.close()
        })
        .catch(() => {});
    },
    // Old methods
    onChangeContract(contract) {
      if (contract != null) {
        this.getNextSerialNo(contract.id);

        this.field_data.clientName = contract.pro_data.client.name;
        // this.field_data.repativePerson = contract.pro_data.client.phone;
        this.field_data.clientPhone = contract.pro_data.client.phone;
        this.field_data.clientAddress = contract.pro_data.client.address;
        this.sForm.item = contract.pro_items;
        for (const [index, item] of Object.values(this.sForm.item).entries()) {
          this.sForm.item[index].increment = this.sForm.item[index].ammount;
          this.sForm.item[index].increment_equiv = this.sForm.item[index].equivalent;
          this.$refs.ekmalat.operationChange(this.sForm.item[index].operation_id, index);
          this.$refs.ekmalat.itemSelected('', this.sForm.item[index].item_id.id, index, this.sForm.item[index].item_id.uom_id.acronym);
        }
      } else {
        this.field_data.clientName = null;
        // this.field_data.repativePerson = null;
        this.field_data.clientPhone = null;
        this.field_data.clientAddress = null;
      }
    },
    resetForm() {
      const f = this.form;
      for (var key in f) {
        this.form[key] = null;
      }
    },
    submitForm() {

      this.$validator.validateAll('s1Form').then(result => {
        if (result) {
          this.$Progress.start()
          this.sForm.post('/api/sale1')
            .then(({
              data
            }) => {
              // Finish the Progress Bar
              // this.sForm.reset();
              // this.errors.clear();
              this.$Progress.set(100)
              this.$vs.notify({
                title: 'موفقیت!',
                text: 'قرارداد موفقانه ثبت شد.',
                color: 'success',
                iconPack: 'feather',
                icon: 'icon-check',
                position: 'top-right'
              })
            }).catch((errors) => {
              // console.log(errors.errors);
              this.$vs.notify({
                title: 'ناموفق!',
                text: 'لطفاً معلومات را چک کنید و دوباره امتحان کنید!',
                color: 'danger',
                iconPack: 'feather',
                icon: 'icon-cross',
                position: 'top-right'
              })
            });
        } else {
          console.log("Form have erors");
          // form have errors
        }
      })

    },
    appCheckBoxes(x) {
      if (this.sForm.steps && this.sForm.steps >= x) {
        this.sForm.steps = (x - 1);
      } else {
        this.sForm.steps = x;
      }
      for (let i = 0; i < this.checked.length; i++) {
        this.checked[i].state = i <= x ? true : false;
      }
    },
    // for getting the next serian number
    getNextSerialNo(type = null) {
      this.sForm.serial_no = null;
      this.$Progress.start()
      this.axios.get(`api/serial-num?type=proj-${type}`)
        .then((response) => {
          this.sForm.serial_no = response.data;
        })
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
