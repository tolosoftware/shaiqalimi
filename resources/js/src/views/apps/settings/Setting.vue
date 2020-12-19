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
  <div class="vx-col w-full sm:w-1/3 md:w-1/3 mb-base">
    <div class="vx-card">
      <div class="vx-card__header">
        <div class="vx-card__title">
          <h4 class="">واحدهای پولی </h4>
          <!---->
        </div>
        <!---->
      </div>
      <vs-divider></vs-divider>
      <div class="vx-card__collapsible-content vs-con-loading__container">
        <div class="vx-card__body">
          <div class="vx-col w-full mb-base">
            <div class="vx-row mb-6">
              <div class="vx-col sm:w-1/3 w-full">
                <span>نشان انگلیسی</span>
              </div>
              <div class="vx-col sm:w-2/3 w-full">
                <vs-input class="w-full" v-model="currencyForm.sign_en" />
                <has-error :form="currencyForm" field="sign_en"></has-error>
              </div>
            </div>
            <div class="vx-row mb-6">
              <div class="vx-col sm:w-1/3 w-full">
                <span>نشان دری</span>
              </div>
              <div class="vx-col sm:w-2/3 w-full">
                <vs-input class="w-full" v-model="currencyForm.sign_fa" />
                <has-error :form="currencyForm" field="sign_fa"></has-error>
              </div>
            </div>
            <div class="vx-row mb-6">
              <div class="vx-col sm:w-1/3 w-full">
                <span>نرغ</span>
              </div>
              <div class="vx-col sm:w-2/3 w-full">
                <vs-input class="w-full" v-model="currencyForm.rate" />
                <has-error :form="currencyForm" field="rate"></has-error>
              </div>
            </div>
            <div class="vx-row">
              <div class="vx-col sm:w-2/3 w-full ml-auto">
                <vs-button size="small" class="mr-3 mb-2" v-if="!currencyForm.id" @click="addNewCurrency">ثبت</vs-button>
                <vs-button size="small" class="mr-3 mb-2" v-if="currencyForm.id" @click="updateCurrency(currencyForm)">آپدیت</vs-button>
                <vs-button size="small" class="mr-3 mb-2" color="warning" v-if="currencyForm.id" @click="updateCancel">لغو</vs-button>
              </div>
            </div>
          </div>
          <!-- Currency Table -->
          <vs-table :data="currencies" class="overflow-hidden-x">

            <template slot="thead">
              <vs-th>نشان انگلیسی</vs-th>
              <vs-th>نشان دری</vs-th>
              <vs-th>عمله</vs-th>
            </template>

            <template slot-scope="{data}">
              <vs-tr :key="indextr" v-for="(tr, indextr) in data">

                <vs-td :data="tr.sign_en">
                  {{ tr.sign_en }}
                </vs-td>
                <vs-td :data="tr.sign_fa">
                  {{ tr.sign_fa }}
                </vs-td>
                <vs-td>
                  <vs-button @click="editCurrency(tr)" color="warning" type="flat" icon-pack="feather" icon="icon-edit"></vs-button>
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
      currencies: [],
      currencyForm: new Form({
        sign_en: '',
        sign_fa: '',
        id: null,
        rate: '',
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
    updateCurrency(data) {
      // Start the Progress Bar
      this.$Progress.start()
      this.currencyForm.patch('/api/currency/' + data.id)
        .then(({
          data
        }) => {
          this.getAllCurrency();
          this.$vs.notify({
            title: 'موفقیت!',
            text: 'معلومات موفقانه در سیستم آپدیت شد.',
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
