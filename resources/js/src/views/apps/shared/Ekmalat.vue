<template>
<div>
  <!-- eteration -->

  <form data-vv-scope="step-3">
    <div v-for="(i, index) in items" :key="i.id">
      <vs-row vs-w="12" class="pb-2 mb-2">
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 mr-3">
            <label for=""><small>جنس / محصول</small><span v-if="remaining_items[index] != undefined" class="item-remain-balance" :data="remaining_items[index]">موجودی {{ remaining_items[index][0] }} {{ remaining_items[index][1] }}</span></label>
            <v-select v-validate="'required'" :clearable="false" :title="errors.first(`step-3.item_id_${index}`)" v-bind:class="errors.first(`step-3.item_id_${index}`) ? 'has-error' : ''" :name="`item_id_${index}`" @input="itemSelected($event, i.item_id.id, index, i.item_id.uom_equiv_id.acronym)" :get-option-label="(option) => option.type.type + ' - ' + option.name" v-model="i.item_id" :options="goods" :dir="$vs.rtl ? 'rtl' : 'ltr'">
              <span slot="no-options" @click="$refs.select.open = false">
                محصول موجود نمی باشد.
              </span>
            </v-select>
            <has-error :form="form" field="item_id"></has-error>
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="1" vs-sm="2" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <label for=""><small>عملیه</small></label>
            <v-select v-validate="'required'" :clearable="false" v-show="true" :title="errors.first(`step-3.operation_id_${index}`)" :class="errors.first(`step-3.operation_id_${index}`) ? 'has-error' : ''" :name="`operation_id_${index}`" label="title" @input="operationChange(i.operation_id, index)" v-model="i.operation_id" :options="operations" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
            <!-- <span class="absolute text-danger alerttext">{{ errors.first(`step-3.operation_id_${index}`) }}</span> -->
          </div>
        </vs-col>
        <vs-col vs-type="flex" v-if="is_active[index].uom && !is_active[index].reverse" vs-justify="center" vs-align="center" vs-lg="2" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <label for>
              <small>مقدار (واحد اصلی)</small>
            </label>
            <vx-input-group class="">
              <template slot="append" v-if="i.item_id && i.item_id.uom_id">
                <div class="append-text bg-primary">
                  <span>{{
                      i.item_id.uom_id ? i.item_id.uom_id.acronym : i.item_id
                    }}</span>
                </div>
              </template>
              <vs-input :disabled="!i.operation_id" v-validate="'required'" :title="errors.first(`step-3.ammount_${index}`)" :class="errors.first(`step-3.ammount_${index}`) ? 'has-error' : ''" :name="`ammount_${index}`" @input="formatToEnPrice($event, items[index], 'ammount', visualFields[index])" v-model="visualFields[index].ammount" />
            </vx-input-group>
            <!-- <span class="absolute text-danger alerttext">{{ errors.first(`step-3.ammount_${index}`) }}</span> -->
            <has-error :form="form" field="ammount"></has-error>
          </div>
        </vs-col>
        <vs-col vs-type="flex" v-if="is_active[index].eqv_uom && is_active[index].reverse" vs-justify="center" vs-align="center" vs-lg="2" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <label for>
              <small>مقدار (واحد فرعی)</small>
            </label>
            <vx-input-group class="">
              <template slot="append" v-if="i.item_id && i.item_id.uom_equiv_id">
                <div class="append-text bg-primary">
                  <span>{{
                      i.item_id.uom_equiv_id ? i.item_id.uom_equiv_id.acronym : i.item_id
                    }}</span>
                </div>
              </template>
              <vs-input :disabled="!i.operation_id" v-validate="'required'" :title="errors.first(`step-3.equivalent_${index}`)" :name="`equivalent_${index}`" :class="errors.first(`step-3.equivalent_${index}`) ? 'has-error' : ''" @input="formatToEnPrice($event, items[index], 'equivalent', visualFields[index])" v-model="visualFields[index].equivalent" />
            </vx-input-group>
            <has-error :form="form" field="equivalent"></has-error>
          </div>
        </vs-col>
        <vs-col vs-type="flex" v-if="is_active[index].density" vs-justify="center" vs-align="center" vs-lg="1" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <vs-input type="number" v-validate="'required'" :title="errors.first(`step-3.density_${index}`)" :class="errors.first(`step-3.density_${index}`) ? 'has-error' : ''" :name="`density_${index}`" v-model="i.density" label="ثقلت" class="w-full number-rtl" />
            <has-error :form="form" field="density"></has-error>
            <!--<span class="text-danger text-sm" v-show="errors.has('reference_no')">{{ errors.first('reference_no') }}</span>-->
          </div>
        </vs-col>
        <vs-col vs-type="flex" v-if="is_active[index].eqv_uom && !is_active[index].reverse" vs-justify="center" vs-align="center" vs-lg="2" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <label for>
              <small>مقدار (واحد فرعی)</small>
            </label>
            <vx-input-group class="">
              <template slot="append" v-if="i.item_id && i.item_id.uom_equiv_id">
                <div class="append-text bg-primary">
                  <span>{{
                      i.item_id.uom_equiv_id ? i.item_id.uom_equiv_id.acronym : i.item_id
                    }}</span>
                </div>
              </template>
              <vs-input :disabled="!i.operation_id" v-validate="'required'" :title="errors.first(`step-3.equivalent_${index}`)" :name="`equivalent_${index}`" :class="errors.first(`step-3.equivalent_${index}`) ? 'has-error' : ''" @input="formatToEnPrice($event, items[index], 'equivalent', visualFields[index])" v-model="visualFields[index].equivalent" />
            </vx-input-group>
            <has-error :form="form" field="equivalent"></has-error>
          </div>
        </vs-col>
        <vs-col vs-type="flex" v-if="is_active[index].uom && is_active[index].reverse" vs-justify="center" vs-align="center" vs-lg="2" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <label for>
              <small>مقدار (واحد اصلی)</small>
            </label>
            <vx-input-group class="">
              <template slot="append" v-if="i.item_id && i.item_id.uom_id">
                <div class="append-text bg-primary">
                  <span>{{
                      i.item_id.uom_id ? i.item_id.uom_id.acronym : i.item_id
                    }}</span>
                </div>
              </template>
              <vs-input :disabled="!i.operation_id" v-validate="'required'" :title="errors.first(`step-3.ammount_${index}`)" :class="errors.first(`step-3.ammount_${index}`) ? 'has-error' : ''" :name="`ammount_${index}`" @input="formatToEnPrice($event, items[index], 'ammount', visualFields[index])" v-model="visualFields[index].ammount" />
            </vx-input-group>
            <!-- <span class="absolute text-danger alerttext">{{ errors.first(`step-3.ammount_${index}`) }}</span> -->
            <has-error :form="form" field="ammount"></has-error>
          </div>
        </vs-col>

        <vs-col vs-type="flex" vs-justify="center" vs-align="center" :vs-lg="is_active[index].density ? 1 : is_active[index].eqv_uom == is_active[index].uom ? 2 : 3" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <vs-input v-validate="'required'" :title="errors.first(`step-3.unit_price_${index}`)" :class="errors.first(`step-3.unit_price_${index}`) ? 'has-error' : ''" :name="`unit_price_${index}`" @input="formatToEnPrice($event, items[index], 'unit_price', visualFields[index])" v-model="visualFields[index].unit_price" label="قیمت‌فی‌واحد" class="w-full" />
            <has-error :form="form" field="density"></has-error>
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" :vs-lg="is_active[index].eqv_uom == is_active[index].uom ? 2 : 3" vs-sm="6" vs-xs="12">
          <div class="w-full pt-2 ml-3 mr-3">
            <label for>
              <small>قیمت مجموعی</small>
            </label>
            <vx-input-group class="">
              <template slot="prepend">
                <div class="prepend-text bg-primary">
                  <span>AFN</span>
                </div>
              </template>
              <vs-input v-model="visualFields[index].total_price" :data="itemsTotalPrice" />
            </vx-input-group>
            <has-error :form="form" field="total_price"></has-error>
          </div>
        </vs-col>
      </vs-row>
    </div>
  </form>
  <vs-row vs-w="12">
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="4" vs-xs="12" class="pt-2 mb-2 ml-3 mr-3">
      <vs-button type="border" @click.stop="addRow" color="success" icon="add"></vs-button>
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
} from "vee-validate";

export default {
  name: "vx-ekmalat",
  props: ["items", "form", "listOfFields"],
  data() {
    return {
      operations: [],
      density: 0,
      item_types: [],
      mesure_unit: [],
      goods: [],
      dictOfErr: [],
      is_active: [{
        density: false,
        uom: true,
        eqv_uom: true,
        reverse: false,
      }],
      visualFields: [{
        equivalent: "0",
        ammount: "0",
        unit_price: "0",
        total_price: "0",
        density: false,
      }],
      remaining_items: [],
    };
  },
  created() {
    this.getOperations();
  },
  methods: {
    itemSelected(e, id, index, acronym) {

      this.$Progress.start();
      this.axios.get(`/api/item-records`, {
        params: {
          item_id: id,
          source: null,
          source_id: null
        }}).then((response) => {
        this.remaining_items[index] = [response.data, acronym];
        this.remaining_items = Object.assign({}, this.remaining_items)
        // 
        this.$Progress.set(100);
      });
    },
    operationChange(data, index) {
      if (data.id == 5 || data.id == 6) {
        this.is_active[index].density = true;
        this.is_active[index].uom = true;
        this.is_active[index].eqv_uom = true;
        if (data.id == 6) {
          this.is_active[index].reverse = true;
        } else {
          this.is_active[index].reverse = false;
        }
      } else if (data.id == 1) {
        this.is_active[index].density = false;
        this.is_active[index].uom = true;
        this.is_active[index].eqv_uom = false;
        this.is_active[index].reverse = false;
      } else if (data.id == 2) {
        this.is_active[index].density = false;
        this.is_active[index].uom = false;
        this.is_active[index].eqv_uom = true;
        this.is_active[index].reverse = false;
      } else if (data.id == 3) {
        this.is_active[index].density = false;
        this.is_active[index].uom = true;
        this.is_active[index].eqv_uom = true;
        this.is_active[index].reverse = false;
      } else if (data.id == 4) {
        this.is_active[index].density = false;
        this.is_active[index].uom = true;
        this.is_active[index].eqv_uom = true;
        this.is_active[index].reverse = true;
      } else {
        this.is_active[index].density = false;
        this.is_active[index].uom = true;
        this.is_active[index].eqv_uom = true;
        this.is_active[index].reverse = false;
      };
    },
    getOperations() {
      this.$Progress.start();
      this.axios.get("/api/operation").then((response) => {
        this.operations = response.data;
        this.getAllItems();
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
      this.axios.get("/api/items").then((response) => {
        this.goods = response.data;
        this.getAllUnites();
      });
    },
    // for getting measure unit of the item
    getAllUnites() {
      this.axios.get("/api/m-units").then((response) => {
        this.mesure_unit = response.data;
        for (let index = 0; index < this.items.length; index++) {
          this.is_active.push({
            density: false,
            uom: true,
            eqv_uom: true,
            reverse: false,
          });
          this.visualFields.push({
            equivalent: "0",
            ammount: "0",
            unit_price: "0",
            total_price: "0",
          })

        }
      });
    },
    addNewRow() {
      this.initFormError();
      let resp = new Promise((resolve, reject) => {
        this.$validator.validateAll("step-3").then((result) => {
          if (result) {
            this.addRow();
          } else {
            reject('correct all values')
          }
        });
      });
    },
    validateEkmalatForm() {
      // this.initFormError();
      // return new Promise((resolve, reject) => {
      //   this.$validator.validateAll("step-3").then((result) => {
      //     if (result) {
      //       return true;
      //     } else {
      //       return false;
      //     }
      //   });
      // });
    },
    resetArrays(){
      this.visualFields.splice(0,this.visualFields.length);
      this.is_active.splice(0,this.is_active.length);
      this.items.splice(0,this.items.length);
    },
    addRow(data = null) {
      if (data.key) {
        this.items[data.key] = data['data'];
        this.visualFields[data.key] = {
          ammount: data['data'].ammount,
          equivalent: data['data'].equivalent,
          unit_price: data['data'].unit_price,
          total_price: data['data'].total_price,
        }
        this.is_active[data.key] = {
          density: false,
          uom: true,
          eqv_uom: true,
          reverse: false,
        }        
      }else{
        this.items.push({
          item_id: "",
          operation_id: null,
          equivalent: "",
          ammount: "0",
          unit_price: "0",
          total_price: "0",
          density: "1.00",
        });
        this.visualFields.push({
          ammount: "0",
          equivalent: "0",
          unit_price: "0",
          total_price: "0",
        })
        this.is_active.push({
          density: false,
          uom: true,
          eqv_uom: true,
          reverse: false,
        });
      }
    },
    initFormError() {
      this.listOfFields.custom = {
        serial_no: {
          required: "سریال نمبر الزامی میباشد.",
          number: "سریال نمبر باید نمبر باشد.",
        },
        publish_date: {
          required: "تاریخ نشر اعلان را انتخاب کنید.",
        },
        publish_address: {
          required: "آدرس نشر اعلان الزامی است.",
          min: "آدرس نشر اعلان باید بیشتر از 6 حرف باشد.",
        },
        client_id: {
          required: "نهاد را انتخاب کنید.",
        },
        title: {
          required: "عنوان اعلان الزامی است.",
        },
        reference_no: {
          required: "شماره شناسایی اعلان ضروری است.",
        },
        submission_date: {
          required: "تاریخ ختم پیشنهادات الزامی است.",
        },
        bidding_date: {
          required: "تاریخ آفرگشایی الزامی است.",
        },
        bidding_address: {
          required: "آدرس آفرگشایی الزامی است.",
        },
        offer_guarantee: {
          required: "تضمین آفر الزامی است",
        },
        deposit: {
          required: "فیصدی تامینات را وارد کنید.",
        },
        tax: {
          required: "فیصدی مالیه را وارد کنید",
        },
        others: {
          required: "قیمت متفرقه بالای اعلان را وارد کنید.",
        },
        pr_worth: {
          required: "ارزش قرارداد الزامی است.",
        },
        transit: {
          required: "قیمت انتقالات را وارد کنید.",
        },
        total_price: {
          required: "",
        },
      };
      for (let index = 0; index < this.items.length; index++) {
        this.listOfFields.custom[`operation_id_${index}`] = {
          required: "عملیه الزامی است.",
        };
        this.listOfFields.custom[`item_id_${index}`] = {
          required: "انتخاب نوع جنس الزامی است.",
        };
        this.listOfFields.custom[`equivalent_${index}`] = {
          required: "معادل الزامی است.",
        };
        this.listOfFields.custom[`ammount_${index}`] = {
          required: "مقدار الزامی است.",
        };
        this.listOfFields.custom[`unit_price_${index}`] = {
          required: "قیمت فی واحد الزامی است.",
        };
        this.listOfFields.custom[`density_${index}`] = {
          required: "ثقلت الزامی است.",
        };
      }
      // 
      Validator.localize("en", this.listOfFields);
    },
    findUom(id, field) {
      let unit = null;
      Object.keys(this.goods).some((key) =>
        this.goods[key].id == id ? (unit = this.goods[key][field]) : ""
      );
      let resp = "";
      Object.keys(this.mesure_unit).some((key) =>
        this.mesure_unit[key].id == unit ? (resp = this.mesure_unit[key].acronym) : ""
      );
      return resp;
    },
    removeRow() {
      if (typeof this.items[this.items.length - 1].item_id == "string" && !this.items[this.items.length - 1].operation_id) {
        this.items.splice(this.items.length - 1, 1);
      } else {

        swal
          .fire({
            title: "آیا  مطمئن هستید؟",
            text: "جنس مورد نظر حذف خواهد شد",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "rgb(54 34 119)",
            cancelButtonColor: "rgb(229 83 85)",
            confirmButtonText: "<span>بله، حذف شود!</span>",
            cancelButtonText: "<span>خیر، لغو عملیه!</span>",
          })
          .then((result) => {
            if (result.isConfirmed) {
              if (this.items.length > 1) {
                if (this.items[this.items.length - 1].id == undefined) {
                  this.items.splice(this.items.length - 1, 1);
                } else {
                  let id = this.items[this.items.length - 1].id;
                  this.axios
                    .delete("/api/pro-item/" + id)
                    .then((id) => {
                      swal.fire({
                        title: "عملیه موفقانه انجام شد.",
                        text: "جنس مورد نظر از سیستم پاک شد!",
                        icon: "success",
                      });
                      if (this.items.length > 1) {
                        this.items.splice(this.items.length - 1, 1);
                        this.is_active.splice(this.items.length - 1, 1);
                      }
                    })
                    .catch(() => {});
                }
              }
            }
          });
      }
    },
  },
  // End Of methods
  computed: {
    itemsTotalPrice: function () {
      var x = this.listOfFields.increment + this.listOfFields.increment_equiv + this.listOfFields.unit_price + this.listOfFields.total_price;
      for (const key of Object.keys(this.items)) {
        let item_equivalent = this.items[key].item_id.equivalent;
        let opr = this.items[key].operation_id;

        let unit_price = this.items[key].unit_price;
        this.items[key].density = this.items[key].density*1;
        let density = this.items[key].density;

        if (opr && opr.id == 1) {
          this.items[key].total_price = this.items[key].ammount * unit_price;
          this.visualFields[key].total_price = this.formatToEnPriceSimple(this.items[key].total_price);
          this.items[key].equivalent = 0;
        } else if (opr && opr.id == 2) {
          this.items[key].total_price = this.items[key].equivalent * unit_price;
          this.visualFields[key].total_price = this.formatToEnPriceSimple(this.items[key].total_price);
          this.items[key].ammount = 0;
        } else if (opr && opr.id == 3) {
          if (item_equivalent !== 0) {
            this.items[key].equivalent = this.items[key].ammount * item_equivalent;
            this.items[key].equivalent = this.items[key].equivalent.toFixed(4);
            this.visualFields[key].equivalent = this.formatToEnPriceSimple(this.items[key].equivalent);
          }
          this.items[key].total_price = this.items[key].equivalent * unit_price;
          this.visualFields[key].total_price = this.formatToEnPriceSimple(this.items[key].total_price);
        } else if (opr && opr.id == 4) {
          if (item_equivalent !== 0) {
            this.items[key].ammount = this.items[key].equivalent / item_equivalent;
            this.items[key].ammount = this.items[key].ammount.toFixed(4);
            this.visualFields[key].ammount = this.formatToEnPriceSimple(this.items[key].ammount);
          }
          this.items[key].total_price = this.items[key].ammount * unit_price;
          this.visualFields[key].total_price = this.formatToEnPriceSimple(this.items[key].total_price);
        } else if (opr && opr.id == 5) {
          if (item_equivalent !== 0) {
            this.items[key].equivalent = (this.items[key].ammount * density) * item_equivalent;
            this.items[key].equivalent = this.items[key].equivalent.toFixed(4);
            this.visualFields[key].equivalent = this.formatToEnPriceSimple(this.items[key].equivalent);
          }
          this.items[key].total_price = this.items[key].equivalent * unit_price;
          this.visualFields[key].total_price = this.formatToEnPriceSimple(this.items[key].total_price);
        } else if (opr && opr.id == 6) {
          if (item_equivalent !== 0) {
            this.items[key].ammount = (this.items[key].equivalent * density) / item_equivalent;
            this.items[key].ammount = this.items[key].ammount.toFixed(4);
            this.visualFields[key].ammount = this.formatToEnPriceSimple(this.items[key].ammount);
          }
          this.items[key].total_price = this.items[key].ammount * unit_price;
          this.visualFields[key].total_price = this.formatToEnPriceSimple(this.items[key].total_price);
        }

      }

    }

  },
  components: {
    "v-select": vSelect,
  },
};
</script>
