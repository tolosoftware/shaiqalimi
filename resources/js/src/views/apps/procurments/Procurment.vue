<template>
  <div>
    <Procurmentadd
      :isSidebarActive="addNewDataSidebar"
      @closeSidebar="toggleDataSidebar"
      :data="sidebarData"
    />
    <vs-tabs>
      <vs-tab label="ثبت خریداری">
        <div class="vx-row">
          <vx-card class="height-vh-80">
            <div class="vx-row">
              <div class="vx-col w-1/2">
                <h3>فارم ثبت خریداری</h3>
              </div>
              <div class="vx-col w-1/2">
                <vs-button
                  type="filled"
                  @click="addNewData"
                  class="mt-5 float-right"
                >ثبت فروشنده جدید</vs-button>
              </div>
            </div>

            <form>
              <div class="vx-row">
                <div class="vx-col w-1/4 mt-4">
                  <label for>
                    <small>حساب فروشنده</small>
                  </label>
                  <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                </div>
                <!-- required -->
                <div class="vx-col w-1/4">
                  <vs-input
                    size="medium"
                    v-validate="'serialnumber'"
                    label="نام"
                    name="serialnumber"
                    class="mt-5 w-full"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('serialnumber')"
                  >{{ errors.first("serialnumber") }}</span>
                </div>

                <div class="vx-col w-1/4">
                  <vs-input
                    size="medium"
                    v-validate="'serialnumber'"
                    label="شماره تماس"
                    name="serialnumber"
                    class="mt-5 w-full"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('serialnumber')"
                  >{{ errors.first("serialnumber") }}</span>
                </div>

                <div class="vx-col w-1/4">
                  <vs-input
                    size="medium"
                    v-validate="'serialnumber'"
                    label="آدرس"
                    name="serialnumber"
                    class="mt-5 w-full"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('serialnumber')"
                  >{{ errors.first("serialnumber") }}</span>
                </div>

                <div class="vx-col w-1/3">
                  <vs-input
                    size="medium"
                    v-validate="'serialnumber'"
                    label="سریال نمبر"
                    name="serialnumber"
                    value="1001"
                    class="mt-5 w-full"
                    disabled
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('serialnumber')"
                  >{{ errors.first("serialnumber") }}</span>
                </div>

                <div class="vx-col w-1/3 mt-4">
                  <label for>
                    <small>ذخیره / گدام</small>
                  </label>
                  <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                </div>

                <!-- currency -->
                <div class="vx-col w-1/3 mt-4">
                  <label for>واحد پولی</label>
                  <div class="vx-row pl-4 pr-4">
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
                </div>
              </div>
              <!-- end currency -->
              <!-- eteration -->
              
              <div v-for="(i , index) in item" class="vx-row">
                <div class="vx-col w-1/4 mt-4">
                  <label for>
                    <small>محصول</small>
                  </label>
                  <v-select
                    label="text"
                    v-model="item.product"
                    :options="itemType"
                    :dir="$vs.rtl ? 'rtl' : 'ltr'"
                  />
                </div>

                <div class="vx-col w-1/4 pt-4">
                  <!-- TITLE -->
                  <label for>
                    <small>مقدار</small>
                  </label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>

                    <vs-input type="number" v-model="item.amount" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>

                <div class="vx-col w-1/4">
                  <vs-input
                    size="medium"
                    v-model="item.equal"
                    v-validate="'serialnumber'"
                    label=" معادل"
                    name="serialnumber"
                    class="mt-5 w-full"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('serialnumber')"
                  >{{ errors.first("serialnumber") }}</span>
                </div>

                <div class="vx-col w-1/4 pt-4">
                  <!-- TITLE -->
                  <label for>
                    <small>هزینه</small>
                  </label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>

                    <vs-input type="number" v-model="item.price" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>
              </div>

              <!-- end eteration -->

              <div class="vx-row">
                <div class="w-1/4">
                  <!-- TITLE -->
                  <vs-button
                    type="filled"
                    color="success"
                    @click="addNewRow"
                    class="mt-5 ml-4"
                  >اضافه</vs-button>

                  <vs-button type="filled" color="success" @click="removeRow" class="mt-5">حذف</vs-button>

                  <!-- /TITLE -->
                </div>
                <div class="vx-col w-3/4 mt-4">
                  <vs-textarea placeholder="تفصیلات"></vs-textarea>
                </div>
              </div>
              <vs-button type="filled" @click.prevent="submitForm" class="mt-5 block">ارسال</vs-button>
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
      this.item.splice(this.item.length - 1,1)
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
