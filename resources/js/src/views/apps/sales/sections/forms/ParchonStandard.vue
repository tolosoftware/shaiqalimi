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
        <vs-input name="client_name" v-model="sForm.client_name" class="w-full" label="نام" />
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
  <ekmalat-stock :items="sForm.item" :form="sForm" :currencyID="sForm.currency_id" :disabledFields="[]" :grid="[]" :listOfFields="[]" ref="ekmalat"></ekmalat-stock>

  <vs-row vs-w="12" class="mb-base">
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="3" vs-xs="12">
      <div class="w-full pt-2 ml-3 mr-3">
        <label for=""><small>مصارف خدمات</small></label>
        <vx-input-group class="">
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
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="3" vs-xs="12">
      <div class="w-full pt-2 ml-3 mr-3">
        <label for=""><small>مصارف متفرقه</small></label>
        <vx-input-group class="">
          <template slot="prepend">
            <div class="prepend-text bg-primary">
              <span v-if="sForm.currency_id==1">AFN</span>
              <span v-if="sForm.currency_id==2">USD</span>
            </div>
          </template>
          <vs-input autocomplete="off" v-model="sForm.additional_cost" type="number" v-validate="'required'" name="additional_cost" />
        </vx-input-group>
        <span class="absolute text-danger alerttext">{{ errors.first('step-2.additional_cost') }}</span>
        <has-error :form="sForm" field="additional_cost"></has-error>
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
          <vs-input autocomplete="off" v-model="sForm.tax" type="number" v-validate="'required'" name="tax" />
        </vx-input-group>
        <span class="absolute text-danger alerttext">{{ errors.first('step-2.tax') }}</span>
        <has-error :form="sForm" field="tax"></has-error>
      </div>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
      <div class="w-full pt-2 ml-3 mr-3">
        <label for=""><small>قیمت نهایی</small></label>
        <vx-input-group class="">
          <template slot="prepend">
            <div class="prepend-text bg-primary">
              <span v-if="sForm.currency_id==1">AFN</span>
              <span v-if="sForm.currency_id==2">USD</span>
            </div>
          </template>
          <vs-input v-model="sForm.total" autocomplete="off" type="number" />
        </vx-input-group>
        <span class="absolute text-danger alerttext">{{ errors.first('step-2.total') }}</span>
      </div>
    </vs-col>
    </vs-col>
  </vs-row>
  <div class="vx-row">
    <vs-textarea v-model="sForm.description" label="تفصیلات" class="mr-3" />
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
import EkmalatStock from "../../../shared/EkmalatStock"
import SourceSelect from "../../../shared/SourceSelect";

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
    SourceSelect

  },
  data() {
    return {
      userid: localStorage.getItem('id'),
      sForm: new Form({
        // sales_id: '', // Get the created sales id.
        serial_no: '',
        service_cost: '',
        additional_cost: '',
        total: '',
        steps: '',
        description: '',
        // shared fields with other sales
        type: "s4",
        // client_id: "", // The Id of the Client.
        source_type: "client", // Type Client
        user_id: localStorage.getItem('id'), //Get the current user id
        currency_id: 1,
        datatime: "",
        // relative_person: "",
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
      // End of sidebar items
    };
  },
  created() {
    this.getNextSerialNo()
  },
  computed: {
    // isFormValid() {
    //   // return !this.errors.any() && this.dataName && this.dataCategory && this.dataPrice > 0
    // },
  },
  methods: {
    // Old methods
    submitForm() {
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
