<template>
<vx-card>
<form data-vv-scope="s4Form">
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
              <span>S4</span>
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
      <span class="absolute text-danger alerttext">{{ errors.first('s4Form.curency') }}</span>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <label for="date" class="mt-3"><small>تاریخ</small></label>
      <date-picker inputFormat="jYYYY/jMM/jDD HH:mm" display-format="jYYYY/jMM/jDD hh:mm" color="#e85454" v-model="sForm.datatime" type="datetime" v-validate="'required'" name="sele_date" :auto-submit="true" size="large"></date-picker>
      <span class="absolute text-danger alerttext">{{ errors.first('s4Form.sel_date') }}</span>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input name="client_name" v-validate="'required|min:2'" v-model="sForm.client_name" class="w-full" label="نام" />
        <span class="absolute text-danger alerttext">{{ errors.first('s4Form.client_name') }}</span>
      </div>
    </div>
  </div>
  <!-- 3td Row -->
  <div class="vx-row">
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <!-- This conpoment need the form source id and form source type field -->
      <label for=""><small>منبع</small></label>
      <source-select :parentForm="sForm" @updateItems="update_items" name="source" v-validate="'required'" v-model="sForm.source_id"></source-select>
      <span class="absolute text-danger alerttext">{{ errors.first('s4Form.source') }}</span>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-3/4 xl:w-3/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input v-model="sForm.destination" name="destination" v-validate="'required|min:2'" class="w-full" label="مقصد" />
        <span class="absolute text-danger alerttext">{{ errors.first('s4Form.destination') }}</span>
      </div>
    </div>
  </div>

  <!-- EkmalatStock -->
  <ekmalat-stock :items="sForm.item" :form="sForm" :currencyID="sForm.currency_id" :disabledFields="[]" :grid="[]" :listOfFields="[]" ref="ekmalat"></ekmalat-stock>
  <vs-row vs-w="12" class="mb-base">
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="3" vs-xs="12">
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
            <vs-input v-model="visualFields.service_cost" autocomplete="off" @input="formatToEnPrice($event, sForm, 'service_cost', visualFields)" v-validate="'required'" name="service_cost" />
          </vx-input-group>
          <span class="absolute text-danger alerttext">{{ errors.first('s4Form.service_cost') }}</span>
          <has-error :form="sForm" field="service_cost"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>مصارف متفرقه</small></label>
          <vx-input-group class="number-rtl">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span v-if="sForm.currency_id==1">AFN</span>
                <span v-if="sForm.currency_id==2">USD</span>
              </div>
            </template>
            <vs-input autocomplete="off" v-model="visualFields.additional_cost" @input="formatToEnPrice($event, sForm, 'additional_cost', visualFields)" v-validate="'required'" name="additional_cost" />
          </vx-input-group>
          <span class="absolute text-danger alerttext">{{ errors.first('s4Form.additional_cost') }}</span>
          <has-error :form="sForm" field="additional_cost"></has-error>
        </div>
      </vs-col>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
      <div class="w-full pt-2 ml-3 mr-3">
        <label for=""><small>قیمت مجموعی</small></label>
        <vx-input-group class="number-rtl">
          <template slot="prepend">
            <div class="prepend-text bg-primary">
              <span v-if="sForm.currency_id==1">AFN</span>
              <span v-if="sForm.currency_id==2">USD</span>
            </div>
          </template>
          <vs-input disabled :value="saleTotalCost" name="sale_total_price" v-validate="'required'" autocomplete="off" />
        </vx-input-group>
        <span class="absolute text-danger alerttext">{{ errors.first('s4Form.total') }}</span>
      </div>
    </vs-col>

    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="2" vs-sm="3" vs-xs="12">
      <div class="w-full pt-2 ml-3 mr-3">
        <label for=""><small>مالیات</small></label>
        <vx-input-group class="number-rtl">
          <template slot="prepend">
            <div class="prepend-text bg-primary">
              <span>٪</span>
            </div>
          </template>
          <vs-input autocomplete="off" v-model="sForm.tax" type="number" v-validate="'required'" name="tax" />
        </vx-input-group>
        <span class="absolute text-danger alerttext">{{ errors.first('s4Form.tax') }}</span>
        <has-error :form="sForm" field="tax"></has-error>
      </div>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
      <div class="w-full pt-2 ml-3 mr-3">
        <label for=""><small>قیمت نهایی</small></label>
        <vx-input-group class="number-rtl">
          <template slot="prepend">
            <div class="prepend-text bg-primary">
              <span v-if="sForm.currency_id==1">AFN</span>
              <span v-if="sForm.currency_id==2">USD</span>
            </div>
          </template>
          <vs-input disabled :value="saleTotalCostFinal" name="sele_total_value" v-validate="'required'" autocomplete="off" />
        </vx-input-group>
        <span class="absolute text-danger alerttext">{{ errors.first('s4Form.total') }}</span>
      </div>
    </vs-col>
  </vs-row>
  <div class="vx-row">
    <div class="w-full pt-2 ml-3 mr-3">
      <vs-col vs-align="right" vs-lg="3" class="pl-4" vs-sm="3" vs-xs="12">
        <bank-account-select :form="sForm" name="bank_account" v-validate="'required'" v-model="sForm.bank_account"></bank-account-select><br>
        <span class="absolute text-danger alerttext">{{ errors.first('s4Form.bank_account') }}</span>
      </vs-col>
    </div>
  </div>
  <div class="vx-row">
    <div class="w-full pt-2 ml-3 mr-3">
      <label for=""><small>تفصیلات</small></label>
      <vs-textarea v-model="sForm.description" class="mr-3 mb-1 w-full" />
    </div>
  </div>
  <div class="mt-10">
    <div class="vx-col w-full">
      <vs-button :disabled="sForm.busy" @click.prevent="submitForm" class="mb-2">ثبت</vs-button>
      <vs-button color="warning" type="border" class="mb-2 ml-2" @click="sForm.reset()">پاک کردن فرم</vs-button>
    </div>
  </div>
  <!--<vs-list v-if="(errors.items.length > 0)">
    <vs-list-header color="danger" title="مشکلات"></vs-list-header>
    <div :key="indextr" v-for="(error, indextr) in errors.items">
      <vs-list-item icon="verified_user" style="color:red;" :subtitle="error.msg"></vs-list-item>
    </div>
  </vs-list> -->
</form>
</vx-card>
</template>

<script>
import vSelect from 'vue-select'
import EkmalatStock from "../../../shared/EkmalatStock"
import SourceSelect from "../../../shared/SourceSelect";
import BankAccountSelect from "../../../shared/BankAccountSelect"
import {
  Validator
} from 'vee-validate'

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
    BankAccountSelect,
    Validator
  },
  data() {
    return {
      userid: localStorage.getItem('id'),
      visualFields: {
        service_cost: 0,
        additional_cost: 0,
      },
      sForm: new Form({
        // sales_id: '', // Get the created sales id.
        serial_no: '',
        service_cost: '0',
        additional_cost: '0',
        total: '0',
        steps: '0',
        tax: '0',
        description: '',
        // shared fields with other sales
        bank_account: null,
        type: "s4",
        client_id: "", // The Id of the Client.
        source_type: "",
        source_id: "",
        user_id: localStorage.getItem('id'), //Get the current user id
        currency_id: 1,
        datatime: this.momentj().format('jYYYY/jMM/jDD HH:mm'),
        // relative_person: "",
        // Item for the ekmalat section
        item: [{
          item_id: "",
          unit_id: "",
          operation_id: null,
          increment_equiv: "",
          increment: "",
          unit_price: "0",
          total_price: "0",
          density: 0,
        }],
      }),
      items: [],
      dict: {
        custom: {
          sele_date: { required: ' تاریخ خریداری الزامی میباشد.' },
          client_name: { required: 'اسم نهاد الزامی میباشد', min: 'اسم نهاد باید بیشتر از 2 حرف باشد.' },
          source: { required: ' انتخاب منبع الزامی میباشد.' },
          destination: { required: 'مقصد الزامی میباشد', min: 'مقصد باید بیشتر از 2 حرف باشد.' },
          service_cost: { required: 'مصارف خدمات الزامی میباشد .' },
          additional_cost: { required: 'مصارف اضافی الزامی میباشد. ' },
          sale_total_price: { required: 'مصارف کلی فروش الزامی میباشد .' },
          tax: { required: 'مالیه الزامی میباشد ' },
          sele_total_value: { required: 'قیمت کلی فروش الزامی میباشد .' },
          bank_account: { required: 'انتخاب حساب بانکی الزامی میباشد.', min: 'حساب بانکی باید بیشتر از 2 حرف باشد.', },
        }
      }
      // End of sidebar items
    };
  },
  created() {
    Validator.localize('en', this.dict);
    this.getNextSerialNo()
  },
  computed: {
    saleTotalCost: function () {
      var i_total = 0;
      this.sForm.item.forEach(item => {
        i_total += item.total_price;
      });
      this.sForm.total = parseFloat(this.sForm.additional_cost) + parseFloat(this.sForm.service_cost) + parseFloat(i_total);
      return this.formatToEnPriceSimple(this.sForm.total);
    },
    saleTotalCostFinal: function () {
      var x = parseFloat(this.sForm.total) - (this.sForm.total * (parseFloat(this.sForm.tax) / 100));
      return this.formatToEnPriceSimple(x.toFixed(4));
    },
  },
  methods: {
    update_items(matched_items) {
      this.$refs.ekmalat.getAllItems(matched_items);
    },
    submitForm() {
      this.$validator.validateAll('s4Form').then(result => {
        if (result) {
          this.$Progress.start()
          this.sForm.post('/api/sale4')
            .then(({
              data
            }) => {
              // Finish the Progress Bar
              // this.sForm.reset();
              // this.errors.clear();
              this.$Progress.set(100)
              this.$vs.notify({
                title: 'موفقیت!',
                text: 'مورد فروش موفقانه ثبت شد.',
                color: 'success',
                iconPack: 'feather',
                icon: 'icon-check',
                position: 'top-right'
              })
              this.sForm.reset();
              this.$validator.reset();
            }).catch((errors) => {
              // 
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

          // form have errors
        }

      })

    },
    // for getting the next serian number
    getNextSerialNo() {
      this.$Progress.start()
      this.axios.get('/api/serial-num?type=sale4')
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
