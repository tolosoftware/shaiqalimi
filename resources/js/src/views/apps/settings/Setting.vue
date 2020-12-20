<template>
<div class="vx-row">
  <div class="vx-col w-full sm:w-1/3 md:w-1/3 mb-base">
    <div class="vx-card">
      <div class="vx-card__header">
        <div class="vx-card__title">
          <h4 class="">نتظیمات واحد پولی </h4>
          <!---->
        </div>
        <!---->
      </div>
      <div class="vx-card__collapsible-content vs-con-loading__container">
        <div class="vx-card__body">
          <!-- start -->

          <vs-table :data="users">

            <template slot="thead">
              <vs-th>نام</vs-th>
              <vs-th>نرخ</vs-th>
              <vs-th>تنظیمات</vs-th>

            </template>

            <template slot-scope="{data}">
              <vs-tr :key="indextr" v-for="(tr, indextr) in data">

                <vs-td :data="data[indextr].id">
                  {{ data[indextr].website }}
                </vs-td>

                <vs-td :data="data[indextr].id">
                  {{ data[indextr].id }}
                </vs-td>
                <vs-td :data="data[indextr].id">
                  {{ data[indextr].website }}
                </vs-td>

                <vs-td :data="data[indextr].id">
                  {{ data[indextr].id }}
                </vs-td>
              </vs-tr>
            </template>

          </vs-table>

          <!-- end -->
        </div>
      </div>
    </div>
  </div>

  <div class="vx-col w-full sm:w-1/3 md:w-1/3 mb-base">
    <div class="vx-card">
      <div class="vx-card__header">
        <div class="vx-card__title">
          <h4 class="">نتظیمات واحد پولی </h4>
          <!---->
        </div>
        <!---->
      </div>
      <div class="vx-card__collapsible-content vs-con-loading__container">
        <div class="vx-card__body">
          <!-- start -->

          <vs-table :data="users">

            <template slot="thead">
              <vs-th>نام</vs-th>
              <vs-th>نرخ</vs-th>
              <vs-th>تنظیمات</vs-th>

            </template>

            <template slot-scope="{data}">
              <vs-tr :key="indextr" v-for="(tr, indextr) in data">

                <vs-td :data="data[indextr].id">
                  {{ data[indextr].website }}
                </vs-td>

                <vs-td :data="data[indextr].id">
                  {{ data[indextr].id }}
                </vs-td>
                <vs-td :data="data[indextr].id">
                  {{ data[indextr].website }}
                </vs-td>

                <vs-td :data="data[indextr].id">
                  {{ data[indextr].id }}
                </vs-td>
              </vs-tr>
            </template>

          </vs-table>

          <!-- end -->
        </div>
      </div>
    </div>
  </div>

  <div class="vx-col w-full sm:w-1/3 md:w-1/3 mb-base">
    <div class="vx-card">
      <div class="vx-card__header">
        <div class="vx-card__title">
          <h4 class="">تنظیمات واحد پولی </h4>
          <!---->
        </div>
        <!---->
      </div>
      <div class="vx-card__collapsible-content vs-con-loading__container">
        <div class="vx-card__body">
          <!-- start -->

          <vs-table :data="users">

            <template slot="thead">
              <vs-th>نام</vs-th>
              <vs-th>نرخ</vs-th>
              <vs-th>تنظیمات</vs-th>

            </template>

            <template slot-scope="{data}">
              <vs-tr :key="indextr" v-for="(tr, indextr) in data">

                <vs-td :data="data[indextr].id">
                  {{ data[indextr].website }}
                </vs-td>

                <vs-td :data="data[indextr].id">
                  {{ data[indextr].id }}
                </vs-td>
                <vs-td :data="data[indextr].id">
                  {{ data[indextr].website }}
                </vs-td>

                <vs-td :data="data[indextr].id">
                  {{ data[indextr].id }}
                </vs-td>
              </vs-tr>
            </template>

          </vs-table>

          <!-- end -->
        </div>
      </div>
    </div>
  </div>
  <div class="vx-col w-full md:w-2/3 mb-base">
    <div class="vx-card">
      <div class="vx-card__header">
        <div class="vx-card__title">
          <h4 class="">واحدهای پولی </h4>
          <!---->
        </div>
        <!-- <vs-button class="shadow-md md:w-1/4 lg:mt-0 mt-4 mr-3 mb-2" @click="exRateForm = !exRateForm">{{ exRateForm ? 'افزودن واحد پولی' : 'ویرایش نرخ اسعار' }}</vs-button> -->
        <!---->
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
</div>
</template>

<script>
export default {
  name: 'vx-settings',
  data() {
    return {
      exRateForm: true,
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
      users: [{
          id: 1,
          name: "Leanne Graham",
          username: "Bret",
          email: "Sincere@april.biz",
          website: "hildegard.org",
        },
        {
          id: 2,
          name: "Ervin Howell",
          username: "Antonette",
          email: "Shanna@melissa.tv",
          website: "anastasia.net",
        },
      ],

    };
  },
  created() {
    this.getAllCurrency();
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
    }
  },
}
</script>
