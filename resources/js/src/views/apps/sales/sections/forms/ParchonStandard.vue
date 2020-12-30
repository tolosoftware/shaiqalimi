<template>
<form @submit.prevent="submitForm">
  <div class="vx-row">
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <label for=""><small>سریال نمبر</small></label>
        <vx-input-group class="">
          <template slot="append">
            <div class="append-text bg-primary">
              <span>S4</span>
            </div>
          </template>
          <vs-input autocomplete="off" type="number" />
        </vx-input-group>

      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <label for class="ml-4 mr-4 mb-2">واحد پولی</label>
        <div class="radio-group w-full">
          <div class="w-1/2">
            <input type="radio" v-model="sForm.currency" value="1" id="struct" name="curency" />
            <label for="struct" class="w-full text-center">افغانی</label>
          </div>
          <div class="w-1/2">
            <input type="radio" v-model="sForm.currency" value="2" id="specific" name="curency" />
            <label for="specific" class="w-full text-center">دالر</label>
          </div>
        </div>
      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <label for="date" class="mt-3"><small>تاریخ</small></label>
      <date-picker color="#e85454" type="datetime" v-validate="'required'" name="contract_date" :auto-submit="true" size="large"></date-picker>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input name="client_name" class="w-full" v-bind:value="form.clientName" label="نام" />
      </div>
    </div>
  </div>
  <!-- 3td Row -->
  <div class="vx-row">
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <label for class="vs-input--label">منبع</label>
        <v-select v-model="form.source" label="text" :options="source" :searchable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'">
          <span slot="no-options">{{$t('WhoopsNothinghere')}}</span>
        </v-select>
      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-3/4 xl:w-3/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input v-model="form.target" class="w-full" label="مقصد" />
      </div>
    </div>
  </div>

  <!-- Ekmalat -->
  <ekmalat :items="sForm.item" :form="sForm" :listOfFields="[]" ref="ekmalat"></ekmalat>

  <vs-row vs-w="12" class="mb-base">
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="3" vs-xs="12">
      <div class="w-full pt-2 ml-3 mr-3">
        <label for=""><small>مصارف خدمات</small></label>
        <vx-input-group class="">
          <template slot="prepend">
            <div class="prepend-text bg-primary">
              <span>AFN</span>
            </div>
          </template>
          <vs-input autocomplete="off" type="number" v-validate="'required'" name="transit" />
        </vx-input-group>
        <span class="absolute text-danger alerttext">{{ errors.first('step-2.transit') }}</span>
        <has-error :form="sForm" field="transit"></has-error>
      </div>
    </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="3" vs-xs="12">
      <div class="w-full pt-2 ml-3 mr-3">
        <label for=""><small>مصارف متفرقه</small></label>
        <vx-input-group class="">
          <template slot="prepend">
            <div class="prepend-text bg-primary">
              <span>AFN</span>
            </div>
          </template>
          <vs-input autocomplete="off" type="number" v-validate="'required'" name="transit" />
        </vx-input-group>
        <span class="absolute text-danger alerttext">{{ errors.first('step-2.transit') }}</span>
        <has-error :form="sForm" field="transit"></has-error>
      </div>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="3" vs-xs="12">
      <div class="w-full pt-2 ml-3 mr-3">
        <label for=""><small>مالیات</small></label>
        <vx-input-group class="">
          <template slot="prepend">
            <div class="prepend-text bg-primary">
              <span>٪</span>
            </div>
          </template>
          <vs-input autocomplete="off" type="number" v-validate="'required'" name="tax" />
        </vx-input-group>
        <span class="absolute text-danger alerttext">{{ errors.first('step-2.tax') }}</span>
        <has-error :form="sForm" field="tax"></has-error>
      </div>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
      <div class="w-full pt-2 ml-3 mr-3">
        <label for=""><small>هزینه نهایی</small></label>
        <vx-input-group class="">
          <template slot="prepend">
            <div class="prepend-text bg-primary">
              <span>AFN</span>
            </div>
          </template>
          <vs-input autocomplete="off" type="number" />
        </vx-input-group>
        <span class="absolute text-danger alerttext">{{ errors.first('step-2.total_price') }}</span>
      </div>
    </vs-col>
    </vs-col>
  </vs-row>
  <div class="vx-row">
    <vs-textarea label="تفصیلات" class="mr-3" />
  </div>
  <div class="mt-10">
    <div class="vx-col w-full">
      <vs-button @click.prevent="submitForm" class="mb-2">ثبت</vs-button>
      <vs-button color="warning" type="border" class="mb-2 ml-2" @click="resetForm">پاک کردن فرم</vs-button>
    </div>
  </div>
</form>
</template>

<script>
import vSelect from 'vue-select'
import Ekmalat from "../../../shared/Ekmalat"

export default {
  props: {
    data: {
      type: Object,
      default: () => {}
    }
  },
  components: {
    'v-select': vSelect,
    Ekmalat

  },
  data() {
    return {
      checkBox: [{
          0: false
        },
        {
          1: false
        },
        {
          2: false
        },
        {
          3: false
        },
        {
          4: false
        },
        {
          5: false
        },
        {
          6: false
        },
        {
          7: false
        },
      ],
      sForm: new Form({
        currency: 1,
        serial_no: '',
        proposal_id: '',
        client_id: '',
        title: '',
        reference_no: '',
        status: "1",
        contract_date: '',
        contract_end_date: '',
        project_guarantee: '',
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
        deposit: '',
        tax: '',
        others: '',
        pr_worth: '',
        transit: '',
        total_price: 0,

      }),
      items: [],
      form: {
        selectedItem: null,
        clientName: null,
        repativePerson: null,
        clientPhone: null,
        clientAddress: null,
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
      itemType: [{
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
      itemMoney: [{
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
      source: [{
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
      products: [{
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
      contracts: [],
      // End of sidebar items
    }
  },
  created() {
    this.getProject();
    this.setCheck(0);
  },
  computed: {
    // isFormValid() {
    //   // return !this.errors.any() && this.dataName && this.dataCategory && this.dataPrice > 0
    // },
  },
  methods: {
    setCheck(index) {

      for (let i = 1; i < this.checkBox.length; i++) {
        this.checkBox[i] = false;
        if (i <= index) {
          this.checkBox[i] = true;
        }
      }
    },
    getProject() {
      // Start the Progress Bar
      this.$Progress.start()

      this.axios.get('/api/project').then((data) => {
          this.contracts = data.data;
          // Finish the Progress Bar
          this.$Progress.set(100)
        })
        .catch(() => {});
    },
    // End of Methods
    // Old methods
    onChange(contract) {
      if (contract != null) {
        this.form.clientName = contract.pro_data.client.name;
        // this.form.repativePerson = contract.pro_data.client.phone;
        this.form.clientPhone = contract.pro_data.client.phone;
        this.form.clientAddress = contract.pro_data.client.address;
      } else {
        this.form.clientName = null;
        this.form.repativePerson = null;
        this.form.clientPhone = null;
        this.form.clientAddress = null;
      }
    },
    resetForm(submitEvent) {
      const f = this.form;
      for (var key in f) {
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
