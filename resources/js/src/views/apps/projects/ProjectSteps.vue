<template>
<form-wizard color="rgba(var(--vs-primary), 1)" :title="null" :subtitle="null" ref="wizard" @on-complete="formSubmitted">
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
              <p> {{ tr.item_id.name }} </p>
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
  <tab-content title=" مرحله اکمالات وتوزیعات" class="mb-5" :before-change="changeStepStatus2">
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
              <p> {{ tr.item_id.name }} </p>
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
  <tab-content title="تکمیل پروژه" class="mb-5">
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
              <p> {{ tr.item_id.name }} </p>
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
  <vs-button v-bind:class="is_ekmalat_allowed ? '': 'hide'" slot="next">بعدی</vs-button>
  <vs-button disabled v-bind:class="is_ekmalat_allowed ? 'hide': ''">بعدی</vs-button>

  <vs-button v-bind:class="finishedcontract && is_ekmalat_allowed ? '': 'hide'" slot="finish">بستن صحفه</vs-button>
  <!--<vs-button disabled v-bind:class="finishedcontract ? 'hide': ''">بستن صحفه</vs-button>-->
</form-wizard>
</template>

<script>
import {
  FormWizard,
  TabContent
} from 'vue-form-wizard'
export default {
  props: ['project'],
  data() {
    return {
      step: 0,
      status: 1,
      nextTabIndex: 0,
      is_ekmalat_allowed: 0,
      adminis_procedure: 0,
      setting_and_baqyat: 0,
      finishedcontract: 0,
      mactob_sending: 0,
    }
  },
  components: {
    FormWizard,
    TabContent
  },
  created() {
    console.log('s', this.step)
    // console.log('sssss', this.$refs.wizard.activeTabIndex)
    // setInterval(this.step = this.step + 1, 2000);
  },
  computed: {

  },
  methods: {
    formSubmitted() {
      this.$emit('closesteps');
    },
    // nextTab() {
    //   let cb = () => {
    //     if (this.activeTabIndex < this.tabCount - 1) {
    //       this.changeTab(this.activeTabIndex, this.activeTabIndex + 1)
    //       this.afterTabChange(this.activeTabIndex)
    //       console.log('fslkfjslafs','fsfaaaaaaaa')
    //     } else {
    //       this.$emit('on-complete')
    //     }
    //   }
    //   this.beforeTabChange(this.activeTabIndex, cb)
    // },
    setWizardStep(index) {
      this.step = index;
      console.log('index', this.step);
      this.$refs.wizard.activateAll();
      this.$refs.wizard.navigateToTab(index - 1);
      // this.$refs.wizard.navigateToTab(2);
    },
    changeItTo(id, st) {
      this.$Progress.start()
      this.axios.get('/api/projectstchange/' + id + '/' + st)
        .then((response) => {
          this.$Progress.set(100);
          this.$vs.notify({
            title: 'موفقیت!',
            text: 'قدم موفقانه تغیر یافت.',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        }).catch(() => {});
    },
    changeStepStatus() {
      if (this.step == 1) {
        this.step = 2;
        this.changeItTo(this.project.id, this.step);
      }
      return true;
    },
    changeStepStatus2() {
      if (this.step == 2) {
        if (this.is_ekmalat_allowed) {
          this.step = 3;
          this.changeItTo(this.project.id, this.step)
        }
      }
      return true;
    },
    changeStepStatus3() {
      if (this.step == 3) {
        if (this.is_ekmalat_allowed) {
          this.step = 4;
          this.changeItTo(this.project.id, this.step)
        }
      }
      return true;
    },
    changeStepStatus4() {
      if (this.step == 4) {
        if (this.is_ekmalat_allowed) {
          this.step = 5;
          this.changeItTo(this.project.id, this.step);
        }
      }
      return true;
    },

  },
  mounted() {

  }
}
</script>

<style>
[dir] .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
  padding: 0.75rem 2rem;
  float: left;
}
</style>
