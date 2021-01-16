<template>
<div>
  <vs-tabs>
    <vs-tab label="ثبت مصارف">
      <div class="vx-row">
        <vx-card class="height-vh-80">
          <div class="vx-row">
            <div class="vx-col w-1/2">
              <h3>فورم ثبت مصارف</h3>
            </div>
          </div>
          <form>
            <div class="vx-row">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full  ml-3 mr-3">
                  <vs-input size="medium" v-validate="'required'" v-model="form.serial_no" label="سریال نمبر" name="serial_no" class="mt-5 w-full" placeholder="سریال نمبر" disabled />
                  <!--<span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first("serialnumber") }}</span> -->
                  <has-error :form="form" field="serial_no"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12" class="mt-4">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for class="ml-4 mr-4 mb-2">واحد پولی</label>
                  <div class="radio-group w-full">
                    <div class="w-1/2">
                      <input type="radio" value="1" id="struct" name="status" checked v-model="form.currency_id" v-on:change="currencychange(1)" />
                      <label for="struct" class="w-full text-center">افغانی</label>
                    </div>
                    <div class="w-1/2">
                      <input type="radio" value="2" id="specific" name="status" v-model="form.currency_id" v-on:change="currencychange(2)" />
                      <label for="specific" class="w-full text-center">دالر</label>
                    </div>
                  </div>
                  <has-error :form="form" field="status"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full  ml-3 mr-3">
                  <label for="date" class="mt-3"><small>تاریخ </small></label>
                  <date-picker color="#e85454" input-format="YYYY/MM/DD HH:mm" format="jYYYY/jMM/jDD HH:mm" type="datetime" v-model="form.datetime" />
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="6" vs-xs="12">
                <div class="w-full  ml-3 mr-3">
                  <vs-input size="medium" v-model="form.title" @input="getTitle" label="عنوان مصارف" class="w-full" />
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12" class="mt-5">
                <div class="w-full  ml-3 mr-3 mt-2">
                  <label for>
                    <small>مقدار</small>
                  </label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>{{currency_title}}</span>
                      </div>
                    </template>
                    <vs-input type="number" v-model="form.ammount" />
                  </vx-input-group>
                </div>
              </vs-col>
              <div class="vx-col w-1/3 mt-4">
                <label for=""><small> حساب کریدیت</small></label>
                <v-select size="large" label="name" :options="accounts" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="form.credit_account" />
              </div>
              <div class="vx-col w-2/3">
                <vs-input size="medium" v-validate="'required'" label="تفصیلات " name="projecttitle" class="mt-5 w-full" v-model="form.credit_desc" />
              </div>
              <div class="vx-col w-1/3 mt-4">
                <label for=""><small> حساب دبت</small></label>
                <v-select label="name" :options="accounts" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="form.debit_account" />
              </div>
              <div class="vx-col w-2/3">
                <vs-input size="medium" v-validate="'required'" label="تفصیلات " name="projecttitle" class="mt-5 w-full" v-model="form.debit_desc" />
              </div>
              <div class="vx-col w-full mt-4">
                <vs-textarea label="تفصیلات کلی" v-model="form.description"></vs-textarea>
              </div>
            </div>
            <vs-button type="filled" @click.prevent="submitData" class="mt-5 block">ثبت</vs-button>
          </form>
        </vx-card>
      </div>
    </vs-tab>
    <vs-tab label="لیست مصارف">
      <Expenselist></Expenselist>
    </vs-tab>
  </vs-tabs>
</div>
</template>
<script>
import Expenselist from "./Expenselist.vue";
import vSelect from "vue-select";

export default {
  components: {
    Expenselist,
    "v-select": vSelect
  },
  data() {
    return {
      form: new Form({
        serial_no: '',
        currency_id: 1,
        datetime: this.momentj().format('jYYYY/jMM/jDD HH:mm'),
        title: '',
        user_id: localStorage.getItem('id'),
        ammount: '',
        credit_account: '',
        debit_account: '',
        credit_desc: '',
        debit_desc: '',
        description: ''
      }),
      currency_title: 'AFN',
      accounts: [],
    };
  },
  methods: {
    currencychange(data) {
      if (data == 2) {
        this.currency_title = "USD";
      } else {
        this.currency_title = "AFN";
      }
    },
    getTitle(data) {
      this.form.credit_desc = data;
      this.form.debit_desc = data;
    },
    submitData() {
      this.form.post('/api/expenses')
        .then(() => {
          this.$vs.notify({
            title: 'عملیه ثبت موفق بود!',
            text: 'عملیه موفغانه انجام شد',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
          this.form.reset();
        })
        .catch(() => {
          this.$vs.notify({
            title: 'ثبت عملیه  ناموفق بود!',
            text: 'عملیه  ناکم شد لطفا دوباره تلاش نماید',
            color: 'danger',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        })
    },

    getAccounts() {
      this.$Progress.start()
      this.$vs.loading()
      this.axios.get('/api/account')
        .then((response) => {
          this.accounts = response.data;
          this.$Progress.set(100)
          this.$vs.loading.close();
        })
    },

    getSerialNom() {
      this.axios.get('/api/exserialno')
        .then((resp) => {
          this.form.serial_no = resp.data;
        });
    }
  },

  created() {
    this.getAccounts();
    this.getSerialNom();
  }
};
</script>

<style>
.customstyle {
  border-right: solid;
  border-right-width: initial;
  border-right-style: solid;
  border-right-color: initial;

}

.vs-radio {
  border-top-left-radius: 1 !important;
  border-bottom-left-radius: 1 !important;
}
</style>
