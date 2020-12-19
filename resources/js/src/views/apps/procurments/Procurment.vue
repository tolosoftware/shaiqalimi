<template>
<div>
  <Procurmentadd :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />
  <vs-tabs>
    <vs-tab label="ثبت خریداری">
      <div class="vx-row">
        <vx-card class="height-vh-80">
          <div class="vx-row">
            <div class="vx-col w-1/2">
              <h3>فارم ثبت خریداری</h3>
            </div>
            <div class="vx-col w-1/2">
              <vs-button type="filled" @click="addNewData" class="mt-5 float-right">ثبت فروشنده جدید</vs-button>
            </div>
          </div>

          <form>
            <vs-row vs-w="12">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-input size="medium" v-validate="'serialnumber'" label="سریال نمبر" name="serialnumber" value="1001" class="w-full" disabled />
                  <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first("serialnumber") }}</span>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for>
                    <small> نام فروشنده</small>
                  </label>
                  <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-input size="medium" v-validate="'serialnumber'" label="شماره تماس" name="serialnumber" class="w-full" />
                  <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first("serialnumber") }}</span>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-input size="medium" v-validate="'serialnumber'" label="آدرس" name="serialnumber" class="w-full" />
                  <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first("serialnumber") }}</span>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for>
                    <small>ذخیره / گدام</small>
                  </label>
                  <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for>واحد پولی</label>
                  <div class="radio-group w-full">
                    <div class="w-1/2">
                      <input type="radio" id="afn" name="currency" checked />
                      <label for="afn" class="w-full text-center">افغانی</label>
                    </div>
                    <div class="w-1/2">
                      <input type="radio" id="usd" name="currency" />
                      <label for="usd" class="w-full text-center">دالر</label>
                    </div>
                  </div>
                </div>
              </vs-col>
            </vs-row>
            <br>
            <vs-divider />
            <!-- end currency -->
            <!-- eteration -->
            <div v-for="(i , index) in item">
              <vs-row vs-w="12" class="pb-2 mb-2">
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3">
                    <label for>
                      <small>محصول</small>
                    </label>
                    <v-select label="text" v-model="i.product" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3">
                    <label for>
                      <small>عملیه</small>
                    </label>
                    <v-select label="text" v-model="i.product" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3">
                    <label for>
                      <small>مقدار</small>
                    </label>
                    <vx-input-group class="">
                      <template slot="prepend">
                        <div class="prepend-text bg-primary">
                          <span>AFN</span>
                        </div>
                      </template>
                      <vs-input type="number" v-model="i.amount" />
                    </vx-input-group>
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3">
                    <vs-input size="medium" v-model="i.equal" v-validate="'serialnumber'" label=" معادل" name="serialnumber" class="w-full" />
                    <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first("serialnumber") }}</span>
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3">
                    <label for>
                      <small>هزینه</small>
                    </label>
                    <vx-input-group class="">
                      <template slot="prepend">
                        <div class="prepend-text bg-primary">
                          <span>AFN</span>
                        </div>
                      </template>
                      <vs-input type="number" v-model="i.price" />
                    </vx-input-group>
                  </div>
                </vs-col>
              </vs-row>
            </div>
            <!-- end eteration -->
            <vs-row vs-w="12">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="12" vs-xs="12">
                <!-- TITLE -->
                <vs-button type="border" color="success" @click="addNewRow" class="ml-4 mr-2 pull-right" icon="add_circle"></vs-button>
                <vs-button type="border" color="primary" v-show="item.length > 1" @click="removeRow" class="mr-2 ml-2 pull-left" icon="close"></vs-button>
                <vs-button type="border" color="primary" v-show="item.length== 1" class="mr-2 ml-2 pull-left" icon="close" disabled></vs-button>
                <!-- /TITLE -->
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="9" vs-sm="12" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-textarea placeholder="تفصیلات"></vs-textarea>
                </div>
              </vs-col>
            </vs-row>
            <vs-button type="filled" @click.prevent="submitForm" class="mt-3 block">ارسال</vs-button>
          </form>
        </vx-card>
      </div>
    </vs-tab>

    <vs-tab label="لیست خریداری">
      <Procurmentlist></Procurmentlist>
    </vs-tab>
  </vs-tabs>
</div>
</template>

<script>
import Procurmentlist from './Procurmentlist.vue'
import Procurmentadd from './Procurmentadd.vue'
import vSelect from 'vue-select'

export default {
  components: {
    Procurmentlist,
    Procurmentadd,
    "v-select": vSelect,
  },

  data() {
    return {
      active: true,
      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {},

      prForm: new Form({
        serial_no: '1001',
        item: [{
          product: '',
          amount: '',
          equal: '',
          price: '',
        }],
      }),

      item: [{
        product: '',
        amount: '',
        equal: '',
        price: '',
      }],

      itemType: [{
          text: "تیل دیزل",
          value: "1",
        },
        {
          text: "تیل گاز",
          value: "2",
        },
        {
          text: "تیل پطرول",
          value: "3",
        },
        {
          text: "موبلین",
          value: "4",
        },
      ],
    };
  },

  methods: {
    addNewData() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val
    },
    submitForm() {

    },

    addNewRow() {
      this.item.push({
        product: '',
        amount: '',
        equal: '',
        price: '',
      })
    },

    removeRow() {
      if (this.item.length > 1) {
        this.item.splice(this.item.length - 1, 1)
      }

    },
  },
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
