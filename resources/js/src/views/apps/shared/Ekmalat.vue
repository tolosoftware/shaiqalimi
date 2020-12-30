<template>
<div>
  <!-- eteration -->

  <form data-vv-scope="step-3">
    <div v-for="(i, index) in items" :key="i.id">
      <vs-row vs-w="12" class="pb-2 mb-2">
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <label for=""><small>جنس / محصول</small></label>
            <v-select v-validate="'required'" :name="`item_id_${index}`" @input="datacalled" :get-option-label="option => option.type.type + ' - ' + option.name" v-model="i.item_id" :options="goods" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
            <span class="absolute text-danger alerttext">{{ errors.first(`step-3.item_id_${index}`) }}</span>
            <has-error :form="form" field="item_id"></has-error>
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="1" vs-sm="2" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <label for=""><small>عملیه</small></label>
            <v-select v-validate="'required'" :name="`operation_id_${index}`" label="title" @input="operationChange" v-model="i.operation_id" :options="operations" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
            <span class="absolute text-danger alerttext">{{ errors.first(`step-3.operation_id_${index}`) }}</span>
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="2" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <label for>
              <small>مقدار</small>
            </label>
            <vx-input-group class="">
              <template slot="append">
                <div class="append-text bg-primary">
                  <span>{{ (i.item_id.uom_equiv_id) ? i.item_id.uom_equiv_id.acronym : i.item_id }}</span>
                </div>
              </template>
              <vs-input v-validate="'required'" :name="`ammount_${index}`" type="number" min="0" v-model="i.ammount" />
            </vx-input-group>
            <span class="absolute text-danger alerttext">{{ errors.first(`step-3.ammount_${index}`) }}</span>
            <has-error :form="form" field="ammount"></has-error>
          </div>
        </vs-col>
        <vs-col vs-type="flex" v-if="i.operation_id != undefined && i.operation_id.id == 1" vs-justify="center" vs-align="center" vs-lg="2" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <vs-input v-model="i.density" label="ثقلت" class="w-full" />
            <has-error :form="form" field="density"></has-error>
            <!--<span class="text-danger text-sm" v-show="errors.has('reference_no')">{{ errors.first('reference_no') }}</span>-->
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="2" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <label for>
              <small>معادل</small>
            </label>
            <vx-input-group class="">
              <template slot="append">
                <div class="append-text bg-primary">
                  <span>{{ (i.item_id.uom_id) ? i.item_id.uom_id.acronym : i.item_id }}</span>
                </div>
              </template>
              <vs-input v-validate="'required|min:2'" type="number" v-model="i.equivalent" />
            </vx-input-group>
            <has-error :form="form" field="equivalent"></has-error>
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="2" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <label for>
              <small>هزینه فی واحد</small>
            </label>
            <vx-input-group class="">
              <template slot="prepend">
                <div class="prepend-text bg-primary">
                  <span>AFN</span>
                </div>
              </template>
              <vs-input type="number" v-validate="'required'" :name="`unit_price_${index}`" v-model="i.unit_price" />
            </vx-input-group>
            <span class="absolute text-danger alerttext">{{ errors.first(`step-3.unit_price_${index}`) }}</span>
            <has-error :form="form" field="unit_price"></has-error>
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="2" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <label for>
              <small>هزینه مجموعی</small>
            </label>
            <vx-input-group class="">
              <template slot="prepend">
                <div class="prepend-text bg-primary">
                  <span>AFN</span>
                </div>
              </template>
              <vs-input type="number" v-model="i.total_price" />
            </vx-input-group>
            <has-error :form="form" field="total_price"></has-error>
          </div>
        </vs-col>
      </vs-row>
    </div>
  </form>
  <vs-row vs-w="12">
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="4" vs-xs="12" class="pt-2 mb-2 ml-3 mr-3">
      <vs-button type="border" @click.stop="addNewRow" color="success" icon="add"></vs-button>
      &nbsp;&nbsp;
      <vs-button type="border" id="delete-btn" @click.stop="removeRow" color="danger" icon="delete" :disabled="this.items.length <= 1"></vs-button>
    </vs-col>
  </vs-row>
</div>
</template>

<script>
import vSelect from "vue-select";
import {
  Validator
} from 'vee-validate'

export default {
  name: "vx-ekmalat",
  props: ["items", "form", 'listOfFields'],
  data() {
    return {
      operations: [],
      density: null,
      item_types: [],
      mesure_unit: [],
      goods: [],
      dictOfErr: [],
    };
  },
  created() {
    this.getOperations();
    this.getAllItems();
    this.getAllUnites();
  },
  methods: {
    datacalled(data) {
      // console.log(data.uom_equiv_id);
    },
    operationChange() {
      // console.log(this.items[0]['operation_id']['id'] == 1);
    },
    getOperations() {
      this.$Progress.start();
      this.axios.get("/api/operation").then((response) => {
        this.operations = response.data;
      });
    },
    getItemTypes() {
      this.$Progress.start();
      this.axios.get("/api/item-type").then((response) => {
        this.item_types = response.data;
      });
    },
    // for items to be bought
    getAllItems() {
      this.$Progress.start()
      this.axios.get('/api/items')
        .then((response) => {
          this.goods = response.data;
        })
    },
    // for getting measure unit of the item
    getAllUnites() {
      this.axios.get('/api/m-units')
        .then((response) => {
          this.mesure_unit = response.data;
        })
    },
    addNewRow() {
      this.initFormError();
      new Promise((resolve, reject) => {
        this.$validator.validateAll('step-3').then(result => {
          if (result) {
            console.log(this.items);
            this.items.push({
              item_id: "",
              operation_id: null,
              equivalent: "",
              ammount: "",
              unit_price: "",
              total_price: "",
              density: null,
            });
          } else {
            // reject('correct all values')
          }
        });
      })
    },
    validateEkmalatForm() {
      this.initFormError();
      return new Promise((resolve, reject) => {
        this.$validator.validateAll('step-3').then(result => {
          if (result) {
            return true;
          } else {
            return false;
          }
        });

      })
    },
    initFormError() {
      this.listOfFields.custom = {
        serial_no: {
          required: 'سریال نمبر الزامی میباشد.',
          number: 'سریال نمبر باید نمبر باشد.'
        },
        publish_date: {
          required: 'تاریخ نشر اعلان را انتخاب کنید.'
        },
        publish_address: {
          required: 'آدرس نشر اعلان الزامی است.',
          min: 'آدرس نشر اعلان باید بیشتر از 6 حرف باشد.',
        },
        client_id: {
          required: 'نهاد را انتخاب کنید.'
        },
        title: {
          required: 'عنوان اعلان الزامی است.'
        },
        reference_no: {
          required: 'شماره شناسایی اعلان ضروری است.'
        },
        submission_date: {
          required: 'تاریخ ختم پیشنهادات الزامی است.'
        },
        bidding_date: {
          required: 'تاریخ آفرگشایی الزامی است.'
        },
        bidding_address: {
          required: 'آدرس آفرگشایی الزامی است.'
        },
        offer_guarantee: {
          required: 'تضمین آفر الزامی است'
        },
        deposit: {
          required: 'فیصدی تامینات را وارد کنید.',
        },
        tax: {
          required: 'فیصدی مالیه را وارد کنید',
        },
        others: {
          required: 'هزینه متفرقه بالای اعلان را وارد کنید.',
        },
        pr_worth: {
          required: 'ارزش قرارداد الزامی است.',
        },
        transit: {
          required: 'هزینه انتقالات را وارد کنید.',
        },
        total_price: {
          required: '',
        },
      };
      for (let index = 0; index < this.items.length; index++) {
        this.listOfFields[`operation_id_${index}`] = {
          required: 'عملیه الزامی است.'
        };
        this.listOfFields[`item_id_${index}`] = {
          required: 'انتخاب نوع جنس الزامی است.'
        };
        this.listOfFields[`ammount_${index}`] = {
          required: 'مقدار الزامی است.'
        };
        this.listOfFields[`unit_price_${index}`] = {
          required: 'هزینه فی واحد الزامی است.'
        };
      }
      console.log(this.listOfFields);
      Validator.localize('en', this.listOfFields);

    },
    findUom(id, field) {
      let unit = null;
      Object.keys(this.goods).some(key => (this.goods[key].id == id) ? unit = this.goods[key][field] : '');
      let resp = '';
      Object.keys(this.mesure_unit).some(key => (this.mesure_unit[key].id == unit) ? resp = this.mesure_unit[key].acronym : '');
      return resp;
    },
    removeRow() {

      swal.fire({
        title: 'آیا  متمئن هستید؟',
        text: "جنس مورد نظر حذف خواهد شد",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>نخیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          if (this.items.length > 1) {
            if (this.items[this.items.length - 1].id == undefined) {
              this.items.splice(this.items.length - 1, 1);
            } else {
              let id = this.items[this.items.length - 1].id;
              this.axios.delete('/api/pro-item/' + id).then((id) => {
                  swal.fire({
                    title: 'عملیه موفقانه انجام شد.',
                    text: "جنس مورد نظر از سیستم پاک شد!",
                    icon: 'success',
                  })
                  if (this.items.length > 1) {
                    this.items.splice(this.items.length - 1, 1);
                  }
                })
                .catch(() => {});
            }
          }
        }
      })
    },
  },
  // End Of methods
  watch: {
    // console.log(this.items);
  },
  components: {
    "v-select": vSelect,
  },
};
</script>
