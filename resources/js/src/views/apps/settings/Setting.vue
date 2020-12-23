<template>
<div class="vx-row">
  <div class="vx-col w-full md:w-2/3 mb-base">
    <div class="vx-card">
      <div class="vx-card__header">
        <div class="vx-card__title">
          <h4 class="">واحدهای پولی </h4>
        </div>
      </div>
      <vs-divider></vs-divider>
      <!-- Add New Currency -->
      <div v-if="!exRateForm">
        <div class="vx-card__collapsible-content vs-con-loading__container">
          <div class="vx-card__body">
            <div class="vx-col w-full mb-base">
              <div class="vx-row">
                <div class="vx-col w-full md:w-1/2">
                  <div class="vx-col sm:w-1/3 w-full">
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
      <div v-if="exRateForm">
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
                      <vs-input type="number" v-model="rateEditForm.currencies[index].last_rate.rate" class="number-rtl" />
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
          <vs-th>نشان انگلیسی</vs-th>
          <vs-th>نشان دری</vs-th>
          <vs-th>نرخ</vs-th>
          <vs-th>تاریخ</vs-th>
        </template>

        <template slot-scope="{data}">
          <vs-tr :key="indextr" v-for="(tr, indextr) in data">

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
  <div class="vx-col w-full sm:w-1/3 md:w-1/3 mb-base">
    <div class="vx-card">
      <div class="vx-card__header">
        <div class="vx-card__title">
          <h4 class="">تنظیمات عملیه های اساسی </h4>
        </div>
        <!-- <vs-button @click="operationActiveForm = !operationActiveForm, operationForm.reset()">{{ operationActiveForm ? 'بستن فارم' : 'عملیه جدید' }}</vs-button> -->
      </div>
      <vs-divider></vs-divider>
      <div class="vx-card__collapsible-content vs-con-loading__container">
        <div class="vx-card__body">
          <!-- start -->

          <!-- Operations Form -->
          <div class="vx-col w-full mb-base" v-if="operationActiveForm">
            <div class="vx-col w-full">
              <div class="vx-col sm:w-1/3 w-full">
                <span>عنوان</span>
              </div>
              <div class="vx-col w-full">
                <vs-input class="w-full" v-model="operationForm.title" />
                <has-error :form="operationForm" field="title"></has-error>
              </div>
            </div>
            <div class="vx-col w-full">
              <div class="vx-col sm:w-1/3 w-full">
                <span>فرمول</span>
              </div>
              <div class="vx-col w-full">
                <vs-input class="w-full" v-model="operationForm.formula" />
                <has-error :form="operationForm" field="formula"></has-error>
              </div>
            </div>
            <div class="vx-col w-full">
              <div class="vx-col sm:w-1/3 w-full">
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
              <vs-th>عنوان</vs-th>
              <vs-th>فرمول</vs-th>
              <vs-th>معلومات</vs-th>
              <vs-th>عملیه</vs-th>

            </template>

            <template slot-scope="{data}">
              <vs-tr :key="indextr" v-for="(tr, indextr) in data">

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
</div>
</template>

<script>
export default {
  name: 'vx-settings',
  data() {
    return {
      exRateForm: true,
      operationActiveForm: false,
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

    };
  },
  created() {
    this.getAllCurrency();
    this.getAllOperation();
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
        title: 'آیا متمعن هستید؟',
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
  },
  // End Of Methods
}
</script>
