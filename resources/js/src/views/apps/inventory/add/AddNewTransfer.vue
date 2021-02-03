<template>
<component :is="scrollbarTag" class="scroll-area--data-list-add-new">
  <vx-card class="no-shadow">
    <form data-vv-scope="transferAddForm">
      <div class="vx-row">
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="6">
          <div class="w-full pb-2 ml-3 mr-3">
            <label for=""><small>سریال نمبر</small></label>
            <vs-input class="w-full" disabled :value="tForm.serial_no" autocomplete="off" type="number" />
          </div>
        </vs-col>

        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="6">
          <div class="w-full pb-2 ml-3 mr-3">
            <label for="date" class="mt-3"><small>تاریخ </small></label>
            <date-picker name="trans_date" v-validate="'required'" inputFormat="jYYYY/jMM/jDD HH:mm" display-format="jYYYY/jMM/jDD hh:mm" color="#e85454" :auto-submit="true" v-model="tForm.datetime" type="datetime" />
          </div>
        </vs-col>

        <!-- Must only consist of numbers -->

        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="12" vs-sm="12" vs-xs="12">
          <div class="w-full pb-2 ml-3 mr-3">
            <vs-input size="medium" name="trans_title" v-validate="'required|min:2'" v-model="tForm.title" label="عنوان انتقال" class="w-full" />
          </div>
        </vs-col>

        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="6">
          <div class="w-full pb-2 ml-3 mr-3">
            <label for=""><small>منبع</small></label>
            <source-select :parentForm="tForm" name="source" v-validate="'required'" v-model="tForm.source_id"></source-select>
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="6">
          <div class="w-full pb-2 ml-3 mr-3">
            <label for=""><small>مقصد</small></label>
            <destination-select :parentForm="tForm" name="destination" v-validate="'required'" v-model="tForm.destination"></destination-select>
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="12" vs-sm="12" vs-xs="12">
          <!-- EkmalatStock -->
          <div class="mr-3 pb-2 ml-3">
            <ekmalat-stock :disabledFields="['total_price', 'unit_price']" :items="tForm.item" :form="tForm" :grid="[6, 6, 12]" ref="ekmalat"></ekmalat-stock>
          </div>
        </vs-col>

        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="6">
          <div class="w-full pb-2 ml-3 mr-3 ">
            <label for>
              <small>مصارف انتقال</small>
            </label>
            <vx-input-group>
              <template slot="prepend">
                <div class="prepend-text bg-primary">
                  <span>AFN</span>
                </div>
              </template>

              <vs-input v-model="tForm.transit" name="trans_transit" v-validate="'required'" type="number" />
            </vx-input-group>
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="6">
          <div class="w-full pb-2 ml-3 mr-3 ">
            <label for>
              <small>مصارف ترازو</small>
            </label>
            <vx-input-group>
              <template slot="prepend">
                <div class="prepend-text bg-primary">
                  <span>AFN</span>
                </div>
              </template>

              <vs-input v-model="tForm.scale" name="trans_scale" v-validate="'required'" type="number" />
            </vx-input-group>
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="6">
          <div class="w-full pb-2 ml-3 mr-3 ">
            <label for>
              <small>مصارف متفرقه</small>
            </label>
            <vx-input-group>
              <template slot="prepend">
                <div class="prepend-text bg-primary">
                  <span>AFN</span>
                </div>
              </template>

              <vs-input v-model="tForm.others" name="trans_others" v-validate="'required'" type="number" />
            </vx-input-group>
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="6">
          <div class="w-full pb-2 ml-3 mr-3 ">
            <label for>
              <small>مصارف مجموعی</small>
            </label>
            <vx-input-group>
              <template slot="prepend">
                <div class="prepend-text bg-primary">
                  <span>AFN</span>
                </div>
              </template>

              <vs-input :value="tForm.total = total_cost" name="trans_total" v-validate="'required'" v-model="tForm.total" type="number" />
            </vx-input-group>
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="6">
          <div class="w-full pb-2 ml-3 mr-3">
            <vs-input size="medium" v-model="tForm.supervisor" name="trans_supervisor" v-validate="'required'" label="شخص مسول" class="w-full" />
          </div>
        </vs-col>

        <div class="w-full mt-4 mr-3 ml-3">
          <vs-textarea v-model="tForm.description" label="تفصیلات"></vs-textarea>
        </div>
      </div>
      <vs-button :disabled="tForm.busy" type="filled" @click.prevent="submitForm" class="mt-5 block">ثبت</vs-button>
      <vs-list v-if="(errors.items.length > 0)">
        <vs-list-header color="danger" title="مشکلات"></vs-list-header>
        <div :key="indextr" v-for="(error, indextr) in errors.items">
          <vs-list-item icon="verified_user" style="color:red;" :subtitle="error.msg"></vs-list-item>
        </div>
        <!--<vs-list-item title="" subtitle=""></vs-list-item> -->
      </vs-list>
    </form>
  </vx-card>
</component>
</template>

<script>
import vSelect from "vue-select";
import EkmalatStock from "../../shared/EkmalatStock";
import SourceSelect from "../../shared/SourceSelect";
import DestinationSelect from "../../shared/DestinationSelect";
import {
  Validator
} from 'vee-validate'

export default {
  components: {
    'v-select': vSelect,
    EkmalatStock,
    DestinationSelect,
    SourceSelect,
    Validator
  },
  data() {
    return {
      // Main INIT
      tForm: new Form({
        serial_no: '',
        source_id: "", // The Id of the Source.
        source_type: "", // Type Source
        datetime: this.momentj().format('jYYYY/jMM/jDD HH:mm'),
        title: '',
        supervisor: '',
        description: 'تفصیلات تاحال درج نشده است.',
        destination_id: '',
        destination: '',
        currency_id: 1,
        // Costs ....
        transit: '0',
        scale: '0',
        others: '0',
        total: '0',

        user_id: localStorage.getItem('id'),
        // Item for the ekmalat section
        item: [{
          item_id: "",
          unit_id: "",
          operation_id: null,
          increment_equiv: "",
          increment: "",
          unit_price: 0,
          total_price: 0,
          density: null,
        }],

      }),
      items: [],
      // End Main
      settings: { // perfectscrollbar settings
        maxScrollbarLength: 70,
        wheelSpeed: .60
      },
      dict: {
        custom: {
          trans_date: { required: ' تاریخ انتقال الزامی میباشد.' },
          trans_title: { required: ' عنوان انتقال الزامی میباشد.', min: 'عنوان انتقال باید بیشتر از 2 حرف باشد.' },
          source: { required: 'منبع انتقال الزامی میباشد.' },
          trans_destination: { required: ' مقصد انتقال الزامی میباشد.' },
          trans_transit: { required: ' مصارف انتقال الزامی میباشد.' },
          trans_scale: { required: ' مصارف ترازو انتقال الزامی میباشد.' },
          trans_others: { required: ' مصارف متفرقه انتقال الزامی میباشد.' },
          trans_total: { required: ' مصارف مجموعی انتقال الزامی میباشد.' },
          trans_supervisor: { required: ' شخص مسول انتقال الزامی میباشد.' }
        }
      }
    }
  },
  watch: {},
  computed: {
    itFormValid() {
      //   return !this.errors.any() && this.dataName && this.dataCategory && this.dataPrice > 0
    },
    scrollbarTag() {
      return this.$store.getters.scrollbarTag
    },
    // To calculate the total price for :the proposal
    total_cost: function () {
      let others = (this.tForm.others) ? parseInt(this.tForm.others) : 0;
      let transit = (this.tForm.transit) ? parseInt(this.tForm.transit) : 0;
      let scale = (this.tForm.scale) ? parseInt(this.tForm.scale) : 0;

      let total_items = 0;
      this.tForm.item.filter(function (item) {
        if (item && item.total_price) {
          total_items += parseInt(item.total_price);
        }
      })
      return others + scale + transit + total_items;
    },
  },
  created() {
    Validator.localize('en', this.dict);
    this.getNextSerialNo();
  },
  methods: {
    // for getting the next serian number
    getNextSerialNo() {
      this.$Progress.start()
      this.axios.get('/api/serial-num?type=transfer')
        .then((response) => {
          this.tForm.serial_no = response.data;
          this.tForm.user_id = localStorage.getItem('id');
          // Item for the ekmalat section
          this.tForm.item = [{
            item_id: "",
            unit_id: "",
            operation_id: null,
            increment_equiv: "",
            increment: "",
            unit_price: "0",
            total_price: "0",
            density: null,
          }];
        })
    },
    submitForm() {
      
      this.$validator.validateAll('transferAddForm').then(result => {
        if (result) {
          this.$Progress.start()
          this.tForm.post('/api/transfer')
            .then(({
              data
            }) => {
              this.$vs.notify({
                title: 'موفقیت!',
                text: 'انتقال موفقانه ثبت شد.',
                color: 'success',
                iconPack: 'feather',
                icon: 'icon-check',
                position: 'top-right'
              })
              this.tForm.reset();
              this.$validator.reset();
              this.getNextSerialNo();
              this.$Progress.set(100)
            }).catch((errors) => {

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
      // Start the Progress Bar

    }
  },
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
