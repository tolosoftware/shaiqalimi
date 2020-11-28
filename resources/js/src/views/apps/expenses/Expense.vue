<template>
  <div>
    <vs-tabs>
      <vs-tab label="ثبت مصارف">
        <div class="vx-row">
          <vx-card class="height-vh-80">
            <div class="vx-row">
              <div class="vx-col w-1/2">
                <h3>فارم ثبت مصارف</h3>
              </div>
            </div>

            <form>
              <div class="vx-row">
                <!-- required -->
                <div class="vx-col w-1/3">
                  <vs-input
                    size="large"
                    v-validate="'serialnumber'"
                    label="سریال نمبر"
                    name="serialnumber"
                    class="mt-5 w-full"
                    placeholder="101"
                    disabled
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('serialnumber')"
                    >{{ errors.first("serialnumber") }}</span
                  >
                </div>

                <!-- currency -->
                <div class="vx-col w-1/3 mt-4">
                  <label for=""> واحد پولی </label>
                  <div class="btn-group">
                    <div class="vx-row pl-4 pr-4">
                      <vs-button
                        class="vx-col w-1/2 customstyle"
                        color="success"
                      >
                        <input
                          class="form-check-input"
                          type="radio"
                          name="curency"
                          id="exampleRadios1"
                          value="option1"
                          checked
                          style="height: 15px; width: 15px"
                        />
                        <label class="form-check-label" for="exampleRadios1">
                          &nbsp; <b>افغانی</b>
                        </label>
                      </vs-button>
                      <vs-button
                        class="vx-col w-1/2 customstyle"
                        color="success"
                      >
                        <input
                          class="form-check-input"
                          type="radio"
                          name="curency"
                          id="exampleRadios"
                          value="option1"
                          checked
                          style="height: 15px; width: 15px"
                        />
                        <label class="form-check-label" for="exampleRadios">
                          &nbsp; <b>دالر</b>
                        </label>
                      </vs-button>
                    </div>
                  </div>
                </div>
                <!-- end currency -->

                <!-- currency -->
                <div class="vx-col w-1/3 pt-5 pb-0">
                  <label for="date" class="mt-3"><small>تاریخ </small></label>
                  <!-- <date-picker
                                    input-format="YYYY/MM/DD"
                                    format="jYYYY/jMM/jDD"
                                    :auto-submit="true"
                                    size="large" type="datetime"></date-picker> -->
                  <date-picker :auto-submit="true" type="datetime" />
                </div>
                <!-- Must only consist of numbers -->
                <div class="vx-col w-2/3">
                  <vs-input
                    size="medium"
                    v-validate="'projecttitle'"
                    label="عنوان "
                    name="projecttitle"
                    class="mt-5 w-full"
                  />
                </div>

                <div class="vx-col w-1/3 pt-4">
                  <!-- TITLE -->
                  <label for=""><small> مقدار</small></label>
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

                <div class="vx-col w-1/3 mt-4">
                  <label for=""><small> حساب کریدیت</small></label>
                  <v-select
                    size="large"
                    label="text"
                    :options="itemType"
                    :dir="$vs.rtl ? 'rtl' : 'ltr'"
                  />
                </div>

                <div class="vx-col w-2/3">
                  <vs-input
                    size="medium"
                    v-validate="'projecttitle'"
                    label="تفصیلات "
                    name="projecttitle"
                    class="mt-5 w-full"
                  />
                </div>

                <div class="vx-col w-1/3 mt-4">
                  <label for=""><small> حساب دبت</small></label>
                  <v-select
                    label="text"
                    :options="itemType"
                    :dir="$vs.rtl ? 'rtl' : 'ltr'"
                  />
                </div>

                <div class="vx-col w-2/3">
                  <vs-input
                    size="medium"
                    v-validate="'projecttitle'"
                    label="تفصیلات "
                    name="projecttitle"
                    class="mt-5 w-full"
                  />
                </div>

                <div class="vx-col w-full mt-4">
                  <vs-textarea placeholder="تفصیلات"></vs-textarea>
                </div>
              </div>
              <vs-button
                type="filled"
                @click.prevent="submitForm"
                class="mt-5 block"
                >ثبت</vs-button
              >
            </form>
          </vx-card>
        </div>
      </vs-tab>

      <vs-tab label="لیست معاملات">
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
    "v-select": vSelect,
  },
  data() {
    return {
      itemType: [
        {
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
