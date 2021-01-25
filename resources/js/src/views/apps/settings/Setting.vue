<template>
<div>
  <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="6" vs-sm="6" vs-xs="12">
    <vs-row vs-w="12" class="mb-4">
      <div class="w-full pt-2 ml-3 mr-3">
        <div class="vx-card">
          <div class="vx-card__header">
            <div class="vx-card__title">
              <h4 class="">نوعیت حساب ها</h4>
            </div>
            <vs-button type="border" @click="acountActiveForm = !acountActiveForm, acountTypeForm.reset()">{{ acountActiveForm ? 'بستن فورم' : 'افزودن نوع حساب جدید' }}</vs-button>
          </div>
          <component :is="scrollbarTag" :key="$vs.rtl" style="max-height:320px;">
            <div class="pt-6 pr-6 pl-6 pb-6">
              <div class="vx-row">
                <div class="vx-col w-full mb-base" v-if="acountActiveForm">
                  <div class="vx-col pr-4 pl-5 mr-3 ml-3">
                    <div class="vx-col sm:w-1/3 w-full">
                      <span>عنوان</span>
                    </div>
                    <div class="vx-col w-full">
                      <vs-input class="w-full" v-model="acountTypeForm.title" />
                      <has-error :form="acountTypeForm" field="title"></has-error>
                    </div>
                  </div>
                  <div class="vx-col pt-4 pb-5 pr-4 pl-5 mr-3 ml-3">
                    <div class="vx-col w-full">
                      <vs-checkbox color="success" size="large" v-model="have_type"> نوعیت دارد ! </vs-checkbox>
                    </div>
                  </div>
                  <div class="vx-col pt-2 pb-4 pr-4 pl-5 mr-3 ml-3" v-if="have_type">
                    <label for="title"><small>نوعیت</small> </label>
                    <v-select label="title" :options="accountTypes" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="acountTypeForm.type_id" />
                  </div>
                  <div class="vx-col w-full mb-base mt-5 pr-4 pl-4 mr-3 ml-3">
                    <vs-button v-if="!acountTypeForm.id" class="shadow-md w-full lg:mt-0 mt-4 mr-3 mb-2" @click="storeAccountType">ثبت عملیه</vs-button>
                    <vs-button v-if="acountTypeForm.id" class="shadow-md w-full lg:mt-0 mt-4 mb-2" @click="updateAccountType">آپدیت عملیه</vs-button>
                  </div>
                </div>
              </div>
              <br>
              <vs-table :data="accountTypes" stripe>
                <template slot="thead">
                  <vs-th>#</vs-th>
                  <vs-th>نام</vs-th>
                  <vs-th>نوعیت</vs-th>
                  <vs-th>سیستم</vs-th>
                  <vs-th>عملیه</vs-th>
                </template>

                <template slot-scope="{data}">
                  <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td :data="tr.id">
                      {{ ++indextr }}
                    </vs-td>
                    <vs-td :data="tr.id">
                      {{ tr.title }}
                    </vs-td>

                    <vs-td :data="tr.id">
                      <span v-if="!(tr.system == 1)">
                        <!--<vs-select v-model="tr.type_id" disabled>
                          <vs-select-item :key="index" :value="item.id" :text="item.title" v-for="item,index in accountTypes" />
                        </vs-select> -->
                        <div v-for="(item,index) in accountTypes" :key="index">
                          <span v-if="(tr.type_id==item.id)">
                            <span v-text="item.title"></span>
                          </span>
                        </div>
                      </span>
                      <span v-if="(tr.system == 1)"> سیستم </span>
                    </vs-td>

                    <vs-td :data="tr.id">
                      <span v-if="(tr.system == 1)">است</span>
                      <span v-if="(tr.system == 0)">نیست</span>
                    </vs-td>
                    <vs-td :data="tr.id">
                      <div class="flex">
                        <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="cursor-pointer" @click.stop="editAccountType(tr.id)" />&nbsp;&nbsp;
                        <span v-if="(tr.system ==1)" style="padding-top:9px;">
                          <feather-icon disabled icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="cursor-pointer" @click.stop="deleteAccountType(tr.id)" />
                        </span>
                        <span v-if="!(tr.system ==1)" style="padding-top:9px;">
                          <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="cursor-pointer" @click.stop="deleteAccountType(tr.id)" />
                        </span>
                      </div>
                    </vs-td>
                  </vs-tr>
                </template>
              </vs-table>
            </div>
          </component>
        </div>
      </div>
      <div class="w-full pt-2 ml-3 mr-3">
        <ItemType></ItemType>
      </div>
    </vs-row>
  </vs-col>
  <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="6" vs-sm="6" vs-xs="12">
    <vs-row vs-w="12" class="mb-3">
      <div class="w-full pt-2 ml-3 mr-3">
        <div class="vx-card">
          <div class="vx-card__header">
            <div class="vx-card__title">
              <h4 class="">واحدهای پولی </h4>
            </div>
            <vs-button type="border" @click="currencyActiveChange = !currencyActiveChange, operationForm.reset()">{{ currencyActiveChange ? 'بستن فورم' : 'اپدیت نرخ اسعار' }}</vs-button>
          </div>
          <br>
          <!-- Add New Currency -->
          <div v-if="!exRateForm">
            <div class="vx-card__collapsible-content vs-con-loading__container">
              <div class="vx-card__body">
                <div class="w-full mb-base">
                  <div class="vx-row">
                    <div class="vx-col w-full">
                      <div class="vx-col w-full">
                        <span>نشان انگلیسی</span>
                      </div>
                      <div class="vx-col w-full">
                        <vs-input class="w-full" v-model="currencyForm.sign_en" />
                        <has-error :form="currencyForm" field="sign_en"></has-error>
                      </div>
                    </div>
                    <div class="vx-col w-full md:w-1/2">
                      <div class="vx-col sm:w-1/3 w-full">
                        <span>نشان دری</span>
                      </div>
                      <div class="vx-col w-full">
                        <vs-input class="w-full" v-model="currencyForm.sign_fa" />
                        <has-error :form="currencyForm" field="sign_fa"></has-error>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="vx-row">
                  <div class="vx-col w-full md:w-1/2">
                    <div class="vx-col sm:w-1/3 w-full">
                      <span>نرخ</span>
                    </div>
                    <div class="vx-col w-full">
                      <vx-input-group class="">
                        <template slot="prepend">
                          <div class="prepend-text bg-primary">
                            <span>AFN</span>
                          </div>
                        </template>
                        <vs-input type="number" v-model="currencyForm.rate" class="number-rtl" />
                      </vx-input-group>

                      <has-error :form="currencyForm" field="rate"></has-error>
                    </div>
                  </div>
                  <div class="vx-col w-full md:w-1/2 mb-base mt-5">
                    <vs-button class="shadow-md w-full lg:mt-0 mt-4 mr-3 mb-2" @click="addNewCurrency">ثبت</vs-button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End of Add Currency -->
          <!-- Edit rates -->
          <div v-if="currencyActiveChange">
            <vs-divider></vs-divider>
            <div class="vx-card__collapsible-content vs-con-loading__container">
              <div class="vx-card__body">
                <div class="vx-col w-full mb-base">
                  <div v-for="(item, index) in rateEditForm.currencies" :key="item.id">
                    <div class="vx-row mb-6">
                      <div class="vx-col sm:w-1/3 w-full">
                        <span>{{ item.sign_fa }}</span>
                      </div>
                      <div class="vx-col sm:w-2/3 w-full">
                        <vx-input-group class="">
                          <template slot="prepend">
                            <div class="prepend-text bg-primary">
                              <span>AFN</span>
                            </div>
                          </template>
                          <span v-if="(item.sign_en == 'AFN')">
                            <vs-input type="number" disabled v-model="rateEditForm.currencies[index].last_rate.rate" class="number-rtl" /></span>
                          <span v-if="!(item.sign_en == 'AFN')">
                            <vs-input type="number" v-model="rateEditForm.currencies[index].last_rate.rate" class="number-rtl" /></span>
                        </vx-input-group>
                      </div>
                    </div>
                  </div>
                  <div class="vx-col w-full md:w-1/2 mb-base mt-5 float-right">
                    <vs-button class="shadow-md w-full lg:mt-0 mt-4 mr-3 mb-2" @click="editRates">آپدیت نرخ اسعار</vs-button>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <!-- Currency Table -->
          <vs-table :data="currencies" class="overflow-hidden-x">

            <template slot="thead">
              <vs-th>#</vs-th>
              <vs-th>نشان انگلیسی</vs-th>
              <vs-th>نشان دری</vs-th>
              <vs-th>نرخ</vs-th>
              <vs-th>تاریخ</vs-th>
            </template>

            <template slot-scope="{data}">
              <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                <vs-td :data="tr.id">
                  {{ tr.id }}
                </vs-td>
                <vs-td :data="tr.sign_en">
                  {{ tr.sign_en }}
                </vs-td>
                <vs-td :data="tr.sign_fa">
                  {{ tr.sign_fa }}
                </vs-td>
                <vs-td :data="tr.last_rate">
                  {{ tr.last_rate.rate }}
                </vs-td>
                <vs-td :data="tr.last_rate">
                  {{ new Date(tr.last_rate.created_at).toLocaleString('fa-AF', { hour12: true }) }}
                </vs-td>
              </vs-tr>
            </template>

          </vs-table>
          <!-- end -->
        </div>
      </div>
      <div class="w-full pt-2 ml-3 mr-3">
        <Operations></Operations>
      </div>
      <div class="w-full pt-2 ml-3 mr-3">
        <Uom></Uom>
      </div>
      <div class="w-full pt-2 ml-3 mr-3">
        <Companies></Companies>
      </div>
    </vs-row>
  </vs-col>
  </vs-divider>
</div>
</template>

<script>
import ItemType from './ItemType'
import Uom from "./Uom"
import vSelect from 'vue-select'
import Companies from './Companies'
import Operations from './Operations'
export default {
  components: {
    ItemType,
    Uom,
    'v-select': vSelect,
    Companies,
    Operations
  },
  data() {
    return {
      exRateForm: true,
      currencyActiveChange: false,
      acountActiveForm: false,
      currencies: [],
      currencyForm: new Form({
        sign_en: '',
        sign_fa: '',
        id: null,
        rate: '',
      }),
      rateEditForm: new Form({
        currencies: null,
      }),

      // select1: 10,
      // Account_type: By Ahamadi
      accountTypes: [],
      acountTypeForm: new Form({
        id: null,
        title: '',
        type_id: '',
        system: 0,
      }),
      have_type: 0,

    };
  },
  computed: {
    scrollbarTag() {
      return this.$store.getters.scrollbarTag;
    },
  },
  created() {
    this.$vs.loading();
    this.$Progress.start();
    this.getAllCurrency();
    this.getAllAccountTypes();
  },
  methods: {
    getAllCurrency() {
      this.axios.get('/api/currency')
        .then((response) => {
          this.currencies = response.data;
          this.rateEditForm.currencies = JSON.parse(JSON.stringify(response.data));
        })
    },
    updateCancel() {
      this.currencyForm.reset();
    },
    editCurrency(data) {
      this.currencyForm.sign_en = data.sign_en;
      this.currencyForm.sign_fa = data.sign_fa;
      this.currencyForm.id = data.id;
    },

    getAllCurrency() {
      this.axios.get('/api/currency')
        .then((response) => {
          this.currencies = response.data;
          this.rateEditForm.currencies = JSON.parse(JSON.stringify(response.data));
        })
    },
    updateCancel() {
      this.currencyForm.reset();
    },
    editCurrency(data) {
      this.currencyForm.sign_en = data.sign_en;
      this.currencyForm.sign_fa = data.sign_fa;
      this.currencyForm.id = data.id;
    },
    addNewCurrency() {
      // Start the Progress Bar
      this.currencyForm.post('/api/currency')
        .then(({
          data
        }) => {
          // console.log(data);
          this.currencyForm.currency_id = data.id;
          this.getAllCurrency();
          this.currencyForm.reset();
          this.$vs.notify({
            title: 'موفقیت!',
            text: 'معلومات موفقانه ثبت سیستم شد.',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        }).catch((errors) => {
          console.log(errors);
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
    editRates() {
      // console.log(this.rateEditForm.currencies);
      this.rateEditForm.post('/api/currency/rates')
        .then(({
          data
        }) => {
          // console.log(data);
          this.getAllCurrency();
          this.currencyForm.reset();
          this.$vs.notify({
            title: 'موفقیت!',
            text: 'معلومات موفقانه ثبت سیستم شد.',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        }).catch((errors) => {
          this.$vs.notify({
            icon: 'icon-cross',
            position: 'top-right'
          })
        });
    },

    // by ahmadi...

    // 1- store AccountType 
    storeAccountType() {
      this.acountTypeForm.post('/api/acount_type')
        .then(({
          data
        }) => {
          this.getAllAccountTypes();
          this.accountTypes.reset();
          this.$vs.notify({
            title: 'موفقیت!',
            text: 'معلومات موفقانه ثبت سیستم شد.',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        }).catch((errors) => {
          // this.$vs.notify({
          //     title: 'ناموفق!',
          //     text: 'لطفاً معلومات را چک کنید و دوباره امتحان کنید!',
          //     color: 'danger',
          //     iconPack: 'feather',
          //     icon: 'icon-cross',
          //     position: 'top-right'
          // })

          this.$vs.notify({
            title: 'موفقیت!',
            text: 'معلومات موفقانه ثبت سیستم شد.',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        });
    },
    // 2- Account Types
    getAllAccountTypes() {
      this.axios.get('/api/acount_type')
        .then((response) => {
          this.accountTypes = response.data;
        })
    },
    // 3- show edit operation
    editAccountType(data) {
      this.acountActiveForm = true;
      this.acountTypeForm.title = data.title;
      this.acountTypeForm.type_id = data.type_id;
      this.acountTypeForm.system = data.system;
      this.acountTypeForm.id = data.id;
      // console.log('editaAccount_type', this.acountTypeForm)
    },
    // 4- update the info
    updateAccountType() {
      this.acountTypeForm.put('/api/acount_type/' + this.acountTypeForm.id)
        .then(({
          data
        }) => {
          // Finish the Progress Bar
          this.getAllAccountTypes();
          // toast notification
          this.$vs.notify({
            title: 'موفقیت!',
            text: 'آیتم موفقانه آپدیت شد.',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        });
    },
    // 5- deleteAccountType
    deleteAccountType(id) {
      swal.fire({
        title: 'آیا شما مطمئن هستید ؟',
        text: "شما قادر به برگردادن این شخص پس از حذف نمی باشید !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'بلی مطمئن هستم',
        cancelButtonText: 'خیر'
      }).then((result) => {
        if (result.value) {
          this.axios.delete('/api/acount_type/' + id).then(() => {
            swal.fire(
              'حذف شد !',
              'موفقانه عملیه حذف انجام شد',
              'success'
            )
            this.loadUsers();
          }).catch(() => {
            swal.fire("Failed!", "سیستم قادر به حذف نیست دوباره تلاش نماید.", "warning");
          })
        }
      })
    }

  }
  // End Of Methods
}
</script>
