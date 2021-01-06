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
          <vs-divider></vs-divider>
          <div class="vx-card__collapsible-content vs-con-loading__container">
            <div class="vx-card__body">
              <!-- start -->

              <!-- Operations Form -->
              <div class="vx-col w-full mb-base" v-if="acountActiveForm">
                <div class="vx-col w-full">
                  <div class="vx-col sm:w-1/3 w-full">
                    <span>عنوان</span>
                  </div>
                  <div class="vx-col w-full">
                    <vs-input class="w-full" v-model="acountTypeForm.title" />
                    <has-error :form="acountTypeForm" field="title"></has-error>
                  </div>
                </div>
                <div class="vx-col w-full pt-4 pb-5">
                  <div class="vx-col w-full">
                    <vs-checkbox color="success" size="large" v-model="have_type"> نوعیت دارد ! </vs-checkbox>

                  </div>
                </div>
                <div class="vx-col w-full pt-2 pb-4" v-if="have_type">

                  <label for="title"><small>نوعیت</small> </label>
                  <v-select label="title" :options="accountTypes" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="acountTypeForm.type_id" />

                </div>
              </div>
              <div class="vx-col w-full mb-base mt-5 float-right">
                <vs-button v-if="!acountTypeForm.id" class="shadow-md w-full lg:mt-0 mt-4 mr-3 mb-2" @click="storeAccountType">ثبت عملیه</vs-button>
                <vs-button v-if="acountTypeForm.id" class="shadow-md w-full lg:mt-0 mt-4 mb-2" @click="updateAccountType">آپدیت عملیه</vs-button>
              </div>

            </div>
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
                    <div class="inline-flex">
                      <vs-button @click="editAccountType(tr)" size="large" color="warning" type="flat" icon-pack="feather" icon="icon-edit"></vs-button>
                      <span v-if="(tr.system ==1)">
                        <vs-button disabled @click="deleteAccountType(tr.id)" size="large" color="warning" type="flat" icon-pack="feather" icon="icon-trash"></vs-button>
                      </span>
                      <span v-if="!(tr.system ==1)">
                        <vs-button @click="deleteAccountType(tr.id)" size="large" color="warning" type="flat" icon-pack="feather" icon="icon-trash"></vs-button>
                      </span>
                    </div>
                  </vs-td>
                </vs-tr>
              </template>

            </vs-table>

            <!-- end -->
          </div>

        </div>
      </div>
      <div class="w-full pt-2 ml-3 mr-3">
        <ItemType></ItemType>
      </div>
    </vs-row>
  </vs-col>
  <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="6" vs-sm="6" vs-xs="12">
    <!--<div class="vx-col w-full md:w-2/3 mb-base"> -->
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
                  {{ tr.last_rate.created_at  | moment("HH:MM:ss - YYYY/M/D") }}
                </vs-td>
              </vs-tr>
            </template>

          </vs-table>
          <!-- end -->
        </div>
      </div>
      <!--</div> -->
      <!--<div class="vx-col w-full sm:w-1/3 md:w-1/3 mb-base"> -->
      <div class="w-full pt-2 ml-3 mr-3">
        <div class="vx-card">
          <div class="vx-card__header">
            <div class="vx-card__title">
              <h4 class="">تنظیمات عملیه های اساسی </h4>
            </div>
            <!-- <vs-button @click="operationActiveForm = !operationActiveForm, operationForm.reset()">{{ operationActiveForm ? 'بستن فورم' : 'عملیه جدید' }}</vs-button> -->
            <vs-button v-if="operationActiveForm" @click="operationActiveForm = !operationActiveForm, operationForm.reset()">بستن فورم </vs-button>
          </div>
          <vs-divider></vs-divider>
          <div class="vx-card__collapsible-content vs-con-loading__container">
            <div class="vx-card__body">
              <!-- start -->

              <!-- Operations Form -->
              <div class="vx-col w-full mb-base" v-if="operationActiveForm">
                <div class="vx-col w-full">
                  <div class="vx-col w-full">
                    <span>عنوان</span>
                  </div>
                  <div class="vx-col w-full">
                    <vs-input class="w-full" v-model="operationForm.title" />
                    <has-error :form="operationForm" field="title"></has-error>
                  </div>
                </div>
                <div class="vx-col w-full">
                  <div class="vx-col w-full">
                    <span>فرمول</span>
                  </div>
                  <div class="vx-col w-full">
                    <vs-input class="w-full" v-model="operationForm.formula" />
                    <has-error :form="operationForm" field="formula"></has-error>
                  </div>
                </div>
                <div class="vx-col w-full">
                  <div class="vx-col w-full">
                    <span>معلومات</span>
                  </div>
                  <div class="vx-col w-full">
                    <vs-input class="w-full" v-model="operationForm.description" />
                    <has-error :form="operationForm" field="description"></has-error>
                  </div>
                </div>
                <div class="vx-col w-full mb-base mt-5 float-right">
                  <vs-button v-if="!operationForm.id" class="shadow-md w-full lg:mt-0 mt-4 mr-3 mb-2" @click="storeOperation">ثبت عملیه</vs-button>
                  <vs-button v-if="operationForm.id" class="shadow-md w-full lg:mt-0 mt-4 mb-2" @click="updateOperation">آپدیت عملیه</vs-button>
                </div>

              </div>
              <vs-table :data="operations">

                <template slot="thead">
                  <vs-th>#</vs-th>
                  <vs-th>عنوان</vs-th>
                  <vs-th>فرمول</vs-th>
                  <vs-th>معلومات</vs-th>
                  <vs-th>عملیه</vs-th>

                </template>

                <template slot-scope="{data}">
                  <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td :data="tr.id">
                      {{ tr.id }}
                    </vs-td>
                    <vs-td :data="tr.id">
                      {{ tr.title }}
                    </vs-td>

                    <vs-td :data="tr.id">
                      {{ tr.formula }}
                    </vs-td>

                    <vs-td :data="tr.id">
                      {{ tr.description }}
                    </vs-td>
                    <vs-td :data="tr.id">
                      <div class="inline-flex">
                        <vs-button @click="editOperation(tr)" color="warning" type="flat" icon-pack="feather" icon="icon-edit"></vs-button>
                        <!-- <vs-button @click="deleteOperation(tr.id)" color="warning" type="flat" icon-pack="feather" icon="icon-trash"></vs-button> -->
                      </div>
                    </vs-td>
                  </vs-tr>
                </template>

              </vs-table>

              <!-- end -->
            </div>
          </div>
        </div>
      </div>
      <div class="w-full pt-2 ml-3 mr-3">
        <Uom></Uom>
      </div>
    </vs-row>
    <!--</div> -->
  </vs-col>
  </vs-divider>
</div>
</template>

<script>
import ItemType from './ItemType'
import Uom from "./Uom"
import vSelect from 'vue-select'
export default {
  components: {
    ItemType,
    Uom,
    'v-select': vSelect,
  },
  data() {
    return {
      exRateForm: true,
      operationActiveForm: false,
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
      operations: [],
      operationForm: new Form({
        title: '',
        formula: '',
        description: '',
        id: null,
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
  created() {
    this.getAllCurrency();
    this.getAllOperation();
    // get all Account_types: by ahmadi
    this.getAllAccountTypes();
  },
  methods: {
    // for items to be bought
    getAllCurrency() {
      this.$Progress.start()
      this.axios.get('/api/currency')
        .then((response) => {
          this.currencies = response.data;
          this.rateEditForm.currencies = JSON.parse(JSON.stringify(response.data));
          this.$Progress.set(100)
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

    // for items to be bought
    getAllCurrency() {
      this.$Progress.start()
      this.axios.get('/api/currency')
        .then((response) => {
          this.currencies = response.data;
          this.rateEditForm.currencies = JSON.parse(JSON.stringify(response.data));
          this.$Progress.set(100)
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
      this.$Progress.start()
      this.currencyForm.post('/api/currency')
        .then(({
          data
        }) => {
          console.log(data);
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
          this.$Progress.set(100)
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
      console.log(this.rateEditForm.currencies);
      this.rateEditForm.post('/api/currency/rates')
        .then(({
          data
        }) => {
          console.log(data);
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
          this.$Progress.set(100)
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
    editOperation(data) {
      this.operationActiveForm = true;
      this.operationForm.title = data.title;
      this.operationForm.formula = data.formula;
      this.operationForm.description = data.description;
      this.operationForm.id = data.id;
      // console.log('operation',this.operationForm);

    },

    storeOperation() {
      // Start the Progress Bar
      this.operationForm.post('/api/operation')
        .then(({
          data
        }) => {
          console.log(data);
          this.getAllOperation();
          this.operationForm.reset();
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
          this.$Progress.set(100)
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

    updateOperation() {
      this.operationForm.patch('/api/operation/' + this.operationForm.id)
        .then(({
          data
        }) => {
          // Finish the Progress Bar
          this.getAllOperation();
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
    deleteOperation(id) {
      swal.fire({
        title: 'آیا  مطمئن هستید؟',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>نخیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.operationForm.delete('/api/operation/' + id).then((id) => {
              swal.fire({
                title: 'عملیه موفقانه انجام شد.',
                icon: 'success',
              })
              this.getAllOperation();
            })
            .catch(() => {});
        }
      })

    },

    storeOperation() {
      // Start the Progress Bar
      this.operationForm.post('/api/operation')
        .then(({
          data
        }) => {
          console.log(data);
          this.getAllOperation();
          this.operationForm.reset();
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
          this.$Progress.set(100)
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

    updateOperation() {
      this.operationForm.patch('/api/operation/' + this.operationForm.id)
        .then(({
          data
        }) => {
          // Finish the Progress Bar
          this.getAllOperation();
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
    deleteOperation(id) {
      swal.fire({
        title: 'آیا  متمئن هستید؟',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>نخیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.operationForm.delete('/api/operation/' + id).then((id) => {
              swal.fire({
                title: 'عملیه موفقانه انجام شد.',
                icon: 'success',
              })
              this.getAllOperation();
            })
            .catch(() => {});
        }
      })

    },
    getAllOperation() {
      this.$Progress.start()
      this.axios.get('/api/operation')
        .then((response) => {
          this.operations = response.data;
          this.$Progress.set(100)
        })

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

          this.$Progress.set(100)
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
      this.$Progress.start()
      this.axios.get('/api/acount_type')
        .then((response) => {
          this.accountTypes = response.data;
          this.$Progress.set(100)
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
        cancelButtonText: 'نخیر'
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
