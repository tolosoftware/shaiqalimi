<template>
<form @submit.prevent="submitForm">
  <div class="vx-row">
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <label for=""><small>سریال نمبر</small></label>
        <vx-input-group class="">
          <template slot="append">
            <div class="append-text bg-primary">
              <span>S1</span>
            </div>
          </template>
          <vs-input :value="sForm.serial_no" disabled autocomplete="off" type="number" />
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
      <date-picker v-model="sForm.datatime" color="#e85454" type="datetime" v-validate="'required'" :title="errors.first(`contract_date`)" v-bind:class="errors.first(`contract_date`) ? 'has-error' : ''" name="contract_date" :auto-submit="true" size="large"></date-picker>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <label for class="vs-input--label">انتخاب قراردادها</label>
        <v-select v-model="sForm.project_id" :get-option-label="
              (option) => option.serial_no + ' - ' + option.pro_data.title
            " name="contract" :options="contracts" :searchable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" @input="onChange">
          <span slot="no-options">{{ $t("WhoopsNothinghere") }}</span>
        </v-select>
      </div>
    </div>
  </div>
  <div class="vx-row">
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input name="client_name" class="w-full" v-bind:value="field_data.clientName" label="نام نهاد" />
      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input name="person_relation" class="w-full" v-bind:value="field_data.repativePerson" type="text" label="شخص ارتباطی" />
      </div>
    </div>
    <div class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
      <div class="vx-col w-full">
        <vs-input name="phone_number" class="w-full number-rtl" v-bind:value="field_data.clientPhone" label="شماره تماس" />
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
        <vs-input v-model="sForm.destination" v-validate="'required'" :title="errors.first(`destination`)" v-bind:class="errors.first(`destination`) ? 'has-error' : ''" name="destination" class="w-full" label="مقصد" />
      </div>
    </div>
  </div>

  <!-- Ekmalat -->
  <ekmalat :items="sForm.item" :form="sForm" :listOfFields="[]" ref="ekmalat"></ekmalat>

  <vs-row vs-w="12" class="mb-base">
    <vs-col vs-type="flex" vs-w="6" class="mb-base">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 mr-3">
          <label for=""><small>مصارف انتقالات</small></label>
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>AFN</span>
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
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>AFN</span>
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
    <vs-col vs-type="flex" vs-w="3" class="mb-base">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>مالیات</small></label>
          <vx-input-group class="">
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
          <vx-input-group class="">
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

    <vs-col vs-type="flex" vs-w="3" class="mb-base">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="12" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>هزینه نهایی</small></label>
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>AFN</span>
              </div>
            </template>
            <vs-input v-model="sForm.total" autocomplete="off" type="number" />
          </vx-input-group>
          <span class="absolute text-danger alerttext">{{
              errors.first("step-2.total_price")
            }}</span>
        </div>
      </vs-col>
    </vs-col>
  </vs-row>
  <div class="vx-row">
    <vs-textarea v-model="sForm.description" label="تفصیلات" class="mr-3" />
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
</form>
</template>

<script>
import vSelect from "vue-select";
import Ekmalat from "../../../shared/Ekmalat";
import SourceSelect from "../../../shared/SourceSelect";

export default {
  props: {
    data: {
      type: Object,
      default: () => {},
    },
  },
  components: {
    "v-select": vSelect,
    Ekmalat,
    SourceSelect,
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
        transport_cost: "",
        service_cost: "",
        tax: "",
        deposit: "",
        total: "",
        steps: null,
        description: "",

        // shared fields with other sales
        type: "s1",
        source_id: "", // The Id of the Project.
        source_type: "", // Type Project
        user_id: localStorage.getItem('id'), //Get the current user id
        currency_id: 1,
        datatime: "",
        // Item for the ekmalat section
        item: [{
          item_id: "",
          unit_id: "",
          operation_id: null,
          equivalent: "",
          ammount: "",
          unit_price: "",
          total_price: "",
          density: null,
        }, ],
      }),
      items: [],
      contracts: [],
      field_data: [],
      // End of sidebar items
    };
  },
  created() {
    this.getProject();
    this.getNextSerialNo();
  },
  computed: {
    // isFormValid() {
    //   // return !this.errors.any() && this.dataName && this.dataCategory && this.dataPrice > 0
    // },
  },
  methods: {
    getProject() {
      // Start the Progress Bar
      this.$Progress.start();

      this.axios
        .get("/api/project")
        .then((data) => {
          this.contracts = data.data;
          // Finish the Progress Bar
          this.$Progress.set(100);
        })
        .catch(() => {});
    },
    // Old methods
    onChange(contract) {
      console.log(this.sForm);
      if (contract != null) {
        this.field_data.clientName = contract.pro_data.client.name;
        // this.field_data.repativePerson = contract.pro_data.client.phone;
        this.field_data.clientPhone = contract.pro_data.client.phone;
        this.field_data.clientAddress = contract.pro_data.client.address;
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
      // this.$validator.validateAll().then(result => {
      //   if(result) {
      //     // if form have no errors
      //     alert("form submitted!");
      //   }else{
      //     console.log("Form have erors");
      //     // form have errors
      //   }
      // })
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
          console.log(errors.errors);
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
    appCheckBoxes(x) {
      if(this.sForm.steps && this.sForm.steps >= x){
        this.sForm.steps = (x - 1);
      }
      else{
        this.sForm.steps = x;
      }
      for (let i = 0; i < this.checked.length; i++) {
        this.checked[i].state = i <= x ? true : false;
      }
    },
    // for getting the next serian number
    getNextSerialNo() {
      this.$Progress.start()
      this.axios.get('/api/serial-num?type=sale1')
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
