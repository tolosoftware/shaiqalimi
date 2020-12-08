<template>
<div>
  <Orgnizationregister :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />
  <vs-tabs>
    <vs-tab label="لیست اعلانات">
      <div class="vx-row">
        <Advertismentlist></Advertismentlist>
      </div>
    </vs-tab>
    <vs-tab label="ثبت اعلان">
      <div class="vx-row">
        <vx-card class="height-vh-80">
          <vs-row vs-w="12">
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="2" vs-sm="4" vs-xs="5">
              <div class="pt-5 w-full">

                <h3>
                  فارم ثبت اعلانات
                </h3>

              </div>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="4" vs-xs="2"></vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="2" vs-sm="4" vs-xs="5">
              <div class="pt-5 w-full">
                <vx-tooltip color="primary" text="برای ثبت نهاد جدید اینجارا کلیک کنید">
                  <vs-button type="filled" @click="addNewData" icon="add">ثبت نهاد جدید </vs-button>
                </vx-tooltip>
              </div>
            </vs-col>
          </vs-row>
          <form>
            <vs-row vs-w="12">
              <vs-divider>
                <h4>
                  معلومات عمومی
                </h4>
              </vs-divider>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="pt-4 w-4/5">
                  <vs-input size="medium" v-validate="'serialnumber'" label="سریال نمبر" name="serialnumber" class="mt-1 w-full" placeholder="101" disabled />
                  <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first('serialnumber') }}</span>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="pt-5 w-4/5">
                  <vs-input v-validate="'identitynumber'" label=" شماره شناسایی قرارداد" name="identitynumber" class="w-full" />
                  <span class="text-danger text-sm" v-show="errors.has('identitynumber')">{{ errors.first('identitynumber') }}</span>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/4 pt-5">
                  <label for="" class="ml-4 mr-4 mb-2">نوعیت قرارداد</label>
                  <ul class="leftx">
                    <li>
                      <vs-radio vs-name="radios1" vs-value="luis" class="ml-4 mr-4"><small>چارچوبی</small> </vs-radio>
                      <vs-radio vs-name="radios1" vs-value="carols" class="ml-4 mr-4"><small>معین</small></vs-radio>
                    </li>
                  </ul>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5 pt-6">
                  <label for="date" class="mt-3"><small>تاریخ آفرگشایی</small></label>
                  <date-picker color="#e85454" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" class="mt-5 w-full" :auto-submit="true" size="large"></date-picker>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5 pt-6">
                  <label for="date" class="mt-3"><small> ختم پیشنهادات</small></label>
                  <date-picker color="#e85454" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" :auto-submit="true" size="large"></date-picker>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="pt-6 w-4/5">
                  <label for="date" class="mt-3"><small>تاریخ نشر اعلان</small></label>
                  <date-picker color="#e85454" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" :auto-submit="true" size="large"></date-picker>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5 pt-3">
                  <label for=""><small>نهاد تطبیق کننده</small></label>
                  <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5 pt-3">
                  <vs-input size="medium" v-validate="'projecttitle'" label="عنوان قرارداد" name="projecttitle" class="w-full" />
                  <span class="text-danger text-sm" v-show="errors.has('projecttitle')">{{ errors.first('projecttitle') }}</span>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5 pt-6">
                  <!-- TITLE -->
                  <label for=""> <small>مدت قرار داد</small></label>
                  <vx-input-group class="mb-base pt-3">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>ماه</span>
                      </div>
                    </template>
                    <vs-input type="number" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5">
                  <vs-input size="medium" label="آدرس آفرگشایی" name="offeraddress" class="w-full" />
                </div>
              </vs-col>

              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5">
                  <vs-input size="medium" v-validate="'announceplace'" label="تضمین قرارداد ها" name="announceplace" class="w-full" />
                  <span class="text-danger text-sm" v-show="errors.has('announceplace')">{{ errors.first('announceplace') }}</span>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5">
                  <vs-input v-validate="'announceplace'" label="آدرس نشراعلان" name="announceplace" class="w-full" />
                  <span class="text-danger text-sm" v-show="errors.has('announceplace')">{{ errors.first('announceplace') }}</span>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5 pt-5">
                  <!-- TITLE -->
                  <label for=""><small> مقدار معین آفر</small></label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>
                    <vs-input type="number" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5 pt-5">
                  <!-- TITLE -->
                  <label for=""><small> مقدار معین پروژه </small></label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>
                    <vs-input type="number" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5 pt-6">
                  <!-- TITLE -->
                  <label for=""><small>ارزش قرارداد</small></label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>
                    <vs-input type="number" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5">
                  <!-- TITLE -->
                  <label for=""><small>تضمین قرارداد</small></label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>
                    <vs-input type="number" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5">
                  <!-- TITLE -->
                  <label for=""><small>تامینات</small></label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>٪</span>
                      </div>
                    </template>
                    <vs-input type="number" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-4/5">
                  <!-- TITLE -->
                  <label for=""><small>مالیات</small></label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>٪</span>
                      </div>
                    </template>
                    <vs-input type="number" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>
              </vs-col>
            </vs-row>
            <vs-row vs-w="12">
              <vs-divider>
                <h4>
                  اکمالات / اقلام
                </h4>
              </vs-divider>
            </vs-row>
            <div v-for="(i , index) in item">
              <vs-row vs-w="12">
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="4" vs-xs="12">
                  <div class="w-4/5">
                    <label for=""><small>جنس / محصول</small></label>
                    <v-select label="text" v-model="i.product" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="4" vs-xs="12">
                  <div class="pt-6 w-4/5">
                    <label for>
                      <small>مقدار</small>
                    </label>
                    <vx-input-group class="mb-base pt-1">
                      <template slot="prepend">
                        <div class="prepend-text bg-primary">
                          <span>AFN</span>
                        </div>
                      </template>
                      <vs-input type="number" v-model="i.amount" />
                    </vx-input-group>
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="4" vs-xs="12">
                  <div class="w-4/5">
                    <vs-input v-model="i.unit" size="medium" label="واحد اندازه گیری" name="offeraddress" class="w-full" />
                  </div>
                </vs-col>
              </vs-row>
            </div>
            <br>
            <vs-row vs-w="12">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="4" vs-xs="12">
                <!-- TITLE -->
                <vs-button type="filled" @click="addNewRow" icon="add">اضافه</vs-button> &nbsp;&nbsp;

                <vs-button type="filled" @click="removeRow" icon="delete">حذف</vs-button>

                <!-- /TITLE -->
              </vs-col>
            </vs-row>
            <vs-row vs-w="12">
            
            </vs-row>
          </form>
        </vx-card>
      </div>
      <vs-button type="filled" @click.prevent="submitForm" class="mt-5 block">ارسال معلومات</vs-button>

    </vs-tab>
  </vs-tabs>
</div>
</template>

<script>
import Advertismentlist from './Advertismentlist.vue'
import vSelect from 'vue-select'
import Orgnizationregister from './Orgnizationregister.vue'
export default {
  components: {
    Advertismentlist,
    'v-select': vSelect,
    Orgnizationregister
  },
  data() {
    return {
      item: [{
        product: '',
        amount: '',
        unit: ''
      }],
      itemType: [{
          text: 'تیل دیزل',
          value: '1'
        },
        {
          text: 'تیل گاز',
          value: '2'
        },
        {
          text: 'تیل پطرول',
          value: '3'
        },
        {
          text: 'موبلین',
          value: '4'
        },
      ],

      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {}
    }
  },

  methods: {
    submitForm() {
      this.$validator.validateAll().then(result => {
        if (result) {
          // if form have no errors
          alert("form submitted!");
        } else {
          // form have errors
        }
      })
    },
    addNewRow() {
      this.item.push({
        product: '',
        amount: '',
        unit: '',
      })
    },
    removeRow() {
      this.item.splice(this.item.length - 1, 1)
    },
    addNewData() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val
    }

  },
}
</script>
