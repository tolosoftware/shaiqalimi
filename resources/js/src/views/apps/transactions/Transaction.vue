<template>
<div>
  <vs-tabs>
    <vs-tab label="ثبت معاملات">
      <div class="vx-row">
        <vx-card class="height-vh-80">
          <div class="vx-row">
            <div class="vx-col w-1/2">
              <h3>فارم ثبت معاملات تجارتی</h3>
            </div>
          </div>

          <form>
            <div class="vx-row">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
                <div class="w-full  ml-3 mr-3">
                  <vs-input size="medium" v-validate="'serialnumber'" label="سریال نمبر" name="serialnumber" class="mt-5 w-full" placeholder="101" disabled />
                  <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first("serialnumber") }}</span>
                </div>
              </vs-col>

              <!-- currency -->

              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12" class="mt-3">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for class="ml-4 mr-4 mb-2">واحد پولی</label>
                  <div class="radio-group w-full">
                    <div class="w-1/2">
                      <input type="radio" value="1" id="struct" name="curency" />
                      <label for="struct" class="w-full text-center">افغانی</label>
                    </div>
                    <div class="w-1/2">
                      <input type="radio" value="2" id="specific" name="curency" />
                      <label for="specific" class="w-full text-center">دالر</label>
                    </div>
                  </div>
                  <has-error :form="aForm" field="curency"></has-error>
                </div>
              </vs-col>
              <!-- end currency -->

              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
                <div class="w-full  ml-3 mr-3">
                  <label for="date" class="mt-3"><small>تاریخ </small></label>
                  <date-picker color="#e85454" :auto-submit="true" type="datetime" />
                </div>
              </vs-col>

              <!-- currency -->

              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for class="ml-4 mr-4 mb-2"> حالت معامله</label>
                  <div class="radio-group w-full">
                    <div class="w-1/2">
                      <input type="radio" value="1" id="benifate" name="transaction" checked />
                      <label for="benifate" class="w-full text-center">عاید</label>
                    </div>
                    <div class="w-1/2">
                      <input type="radio" value="2" id="basic" name="transaction" />
                      <label for="basic" class="w-full text-center">امانت/عادی</label>
                    </div>
                  </div>
                  <has-error :form="aForm" field="status"></has-error>
                </div>
              </vs-col>

              <!-- Must only consist of numbers -->

              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
                <div class="w-full  ml-3 mr-3">
                  <vs-input size="medium" v-model="tForm.title" v-validate="'projecttitle'" label="عنوان معامله" name="projecttitle" class="w-full" />
                </div>
              </vs-col>

              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12" class="mt-5">
                <div class="w-full  ml-3 mr-3 mt-2">
                  <label for>
                    <small>مقدار</small>
                  </label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>

                    <vs-input type="number" />
                  </vx-input-group>
                </div>
              </vs-col>

              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full  ml-3 mr-3">
                  <label for>
                    <small>حساب کریدیت</small>
                  </label>
                  <v-select size="large" label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                </div>
              </vs-col>

              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="6" vs-xs="12">
                <div class="w-full  ml-3 mr-3 mb-4">
                  <vs-input size="medium" v-validate="'projecttitle'" v-model="tForm.title" label="تفصیلات " name="projecttitle" class="mt-5 w-full" />
                </div>
              </vs-col>

              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full  ml-3 mr-3">
                  <label for>
                    <small>حساب دبیت </small>
                  </label>
                  <v-select size="large" label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                </div>
              </vs-col>

              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="6" vs-xs="12">
                <div class="w-full  ml-3 mr-3 mb-4">
                  <vs-input size="medium" v-validate="'projecttitle'" label="تفصیلات " name="projecttitle" class="mt-5 w-full" />
                </div>
              </vs-col>

              <div class="vx-col w-full mt-4">
                <vs-textarea placeholder="تفصیلات"></vs-textarea>
              </div>

            </div>
            <vs-button type="filled" @click.prevent="submitForm" class="mt-5 block">ثبت</vs-button>
          </form>
        </vx-card>
      </div>
    </vs-tab>

    <vs-tab label="لیست معاملات">
      <Transactionlist></Transactionlist>
    </vs-tab>
  </vs-tabs>
</div>
</template>

<script>
import Transactionlist from "./Transactionlist.vue";
import vSelect from "vue-select";

export default {
  components: {
    Transactionlist,
    "v-select": vSelect,
  },
  data() {
    return {
      tForm: new Form({
        currency: 1,
        title: ''
      }),
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
    submitForm() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          // if form have no errors
          alert("form submitted!");
        } else {
          // form have errors
        }
      });
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
