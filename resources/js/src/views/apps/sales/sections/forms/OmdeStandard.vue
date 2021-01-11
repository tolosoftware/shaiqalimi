<template>
<form @submit.prevent="submitForm">
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
              <span>S2</span>
            </div>
          </template>
          <vs-input disabled :value="sForm.serial_no" autocomplete="off" type="number" />
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
      <date-picker color="#e85454" v-model="sForm.datatime" type="datetime" v-validate="'required'" name="contract_date" :auto-submit="true" size="large"></date-picker>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <label for class="vs-input--label">انتخاب نهاد</label>
        <v-select :get-option-label="option => option.name" name="contract" :options="clients" :searchable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="sForm.client_id" @input="onChange">
          <span slot="no-options">{{ $t('WhoopsNothinghere') }}</span>
        </v-select>
      </div>
    </div>
  </div>
  <div class="vx-row">
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input name="person_relation" class="w-full" v-model="sForm.repativePerson" type="text" label="شخص ارتباطی" />
      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input name="phone_number" class="w-full number-rtl" v-bind:value="field_data.clientPhone" label="شماره تماس" />
      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input type="email" name="email" class="w-full number-rtl" v-bind:value="field_data.clientEmail" label="ایمیل آدرس" />
      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input name="address" class="w-full" v-bind:value="field_data.clientAddress" label="آدرس" />
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
        <vs-input v-model="sForm.destination" class="w-full" label="مقصد" />
      </div>
    </div>
  </div>

  <!-- EkmalatStock -->
  <ekmalat-stock :items="sForm.item" :form="sForm" :currencyID="sForm.currency_id" :listOfFields="[]" :disabledFields="[]" :grid="[]" ref="ekmalat"></ekmalat-stock>

  <vs-row vs-w="12" class="mb-base">
    <vs-col vs-type="flex" vs-w="4" class="mb-base">
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
          <span class="absolute text-danger alerttext">{{ errors.first('step-2.others') }}</span>
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
            <vs-input v-model="sForm.service_cost" autocomplete="off" type="number" v-validate="'required'" name="service_cost" />
          </vx-input-group>
          <span class="absolute text-danger alerttext">{{ errors.first('step-2.service_cost') }}</span>
          <has-error :form="sForm" field="service_cost"></has-error>
        </div>
      </vs-col>
    </vs-col>
    <vs-col vs-type="flex" vs-w="3" class="mb-base">
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
          <span class="absolute text-danger alerttext">{{ errors.first('step-2.total') }}</span>
        </div>
      </vs-col>
    </vs-col>
    <vs-col vs-type="flex" vs-w="2" class="mb-base">
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
        <span class="absolute text-danger alerttext">{{ errors.first('step-2.tax') }}</span>
        <has-error :form="sForm" field="tax"></has-error>
      </div>
    </vs-col>

    <vs-col vs-type="flex" vs-w="3" class="mb-base">
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
          <span class="absolute text-danger alerttext">{{ errors.first('step-2.total') }}</span>
        </div>
      </vs-col>
    </vs-col>
  </vs-row>
  <div class="vx-row">
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="3" vs-xs="12">
      <bank-account-select :form="sForm"></bank-account-select>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="9" vs-sm="9" vs-xs="12">
      <div class="w-full pt-2 ml-3 mr-3">
        <label for=""><small>تفصیلات</small></label>
        <vs-input v-model="sForm.description" class="mr-3 mb-1 w-full" />
      </div>
    </vs-col>
  </div>
  <div class="vx-row official-process">
    <vs-collapse type="margin">
      <vs-collapse-item>
        <div slot="header">
          طی مراحل اداری
        </div>
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
      <vs-button color="warning" type="border" class="mb-2 ml-2" @click.prevent="sForm.reset()">پاک کردن فرم</vs-button>
    </div>
  </div>
</form>
</template>

<script>
import vSelect from 'vue-select'
import EkmalatStock from "../../../shared/EkmalatStock"
import SourceSelect from "../../../shared/SourceSelect";
import BankAccountSelect from "../../../shared/BankAccountSelect"

export default {
  props: {
    data: {
      type: Object,
      default: () => {}
    }
  },
  components: {
    'v-select': vSelect,
    EkmalatStock,
    SourceSelect,
    BankAccountSelect

  },
  data() {
    return {
      checked: [{
          state: false,
          label: 'نرخ دهی'
        },
        {
          state: false,
          label: 'ارسال بل'
        },
        {
          state: false,
          label: 'دریافت پیشکی'
        },
        {
          state: false,
          label: 'اکمالات'
        },
        {
          state: false,
          label: 'دریافت کامل پول'
        },
        {
          state: false,
          label: 'تاییدی'
        },
      ],

      userid: localStorage.getItem('id'),
      sForm: new Form({
        // sales_id: '', // Get the created sales id.
        serial_no: "",
        source_id: "",
        destination: "",
        transport_cost: "",
        service_cost: "",
        tax: "",
        // deposit: "",
        total: "",
        steps: "",
        description: "",
        client: "",

        // shared fields with other sales
        bank_account: null,
        type: "s2",
        client_id: "", // The Id of the Client.
        source_type: "client", // Type Client
        user_id: localStorage.getItem('id'), //Get the current user id
        currency_id: 1,
        datatime: "",
        relative_person: "",
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
      clients: [],
      field_data: [],
      // End of sidebar items
    };
  },
  created() {
    this.getNextSerialNo()
    this.getProject();
  },
  computed: {
    saleTotalCostFinal: function () {
      var x = parseFloat(this.sForm.total) - (this.sForm.total * (this.sForm.tax / 100));
      return x.toFixed(2);
    },
    saleTotalCost: function () {
      var i_total = 0;
      this.sForm.item.forEach(item => {
        i_total += item.total_price;
      });

      this.sForm.total = parseFloat(this.sForm.transport_cost) + parseFloat(this.sForm.service_cost) + parseFloat(i_total);
      return this.sForm.total;
    }
    // isFormValid() {
    //   // return !this.errors.any() && this.dataName && this.dataCategory && this.dataPrice > 0
    // },
  },
  methods: {
    getProject() {
      // Start the Progress Bar
      this.$Progress.start();

      this.axios
        .get("/api/clients")
        .then((data) => {
          this.clients = data.data;
          // Finish the Progress Bar
          this.$Progress.set(100);
        })
        .catch(() => {});
    },
    // Old methods
    onChange(client) {
      if (client != null) {
        // this.field_data.clientName = client.name;
        this.field_data.clientEmail = client.email;
        this.field_data.clientPhone = client.phone;
        this.field_data.clientAddress = client.address;
      } else {
        // this.field_data.clientName = null;
        this.field_data.clientEmail = null;
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
      this.$Progress.start()
      this.sForm.post('/api/sale2')
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
    },
    // for getting the next serian number
    getNextSerialNo() {
      this.$Progress.start()
      this.axios.get('/api/serial-num?type=sale2')
        .then((response) => {
          this.sForm.serial_no = response.data;
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
