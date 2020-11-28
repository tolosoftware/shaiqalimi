<template>
  <div>
    <!-- <Organizationadd
      :isSidebarActive="addNewDataSidebar"
      @closeSidebar="toggleDataSidebar"
      :data="sidebarData"
    />-->

    <vs-tabs>
      <vs-tab label=" ثبت قرارداد جدید">
        <div class="vx-row">
          <vx-card class="height-vh-80">
            <div class="vx-row">
              <div class="vx-col w-1/2">
                <h3>فارم ثبت پروژه قرار دادی</h3>
              </div>
            </div>

            <form>
              <div class="vx-row">
                <!-- required -->
                <div class="vx-col w-1/3">
                  <vs-input
                    size="medium"
                    v-validate="'required|min:6|max:10'"
                    label="سریال نمبر"
                    v-model="pForm.s_number"
                    class="mt-5 w-full"
                    placeholder="101"
                    disabled
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('serialnumber')"
                  >{{ errors.first("serialnumber") }}</span>
                </div>

                <div class="vx-col w-1/3 mt-4">
                  <label for>
                    <small>انتخاب اعلان</small>
                  </label>
                  <v-select
                    label="text"
                    @input="setAnnounceId"
                    :options="itemType"
                    :dir="$vs.rtl ? 'rtl' : 'ltr'"
                  />
                </div>

                <!-- Only alphabetic characters -->
                <div class="vx-col w-1/3 pt-5 pb-0">
                  <label for="date" class="mt-3">
                    <small>تاریخ نشر اعلان</small>
                  </label>
                  <date-picker
                    v-model="pForm.issue_date"
                    color="#e85454"
                    input-format="YYYY/MM/DD"
                    format="jYYYY/jMM/jDD"
                    :auto-submit="true"
                    size="large"
                  ></date-picker>
                </div>

                <!-- Only alphabetic characters, numbers, dashes or underscores -->
                <div class="vx-col w-1/3">
                  <vs-input
                    v-model="pForm.issue_address"
                    size="medium"
                    v-validate="'required'"
                    label="محل اعلان"
                    class="mt-5 w-full"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('announceplace')"
                  >{{ errors.first("announceplace") }}</span>
                </div>

                <!-- May contain alphabetic characters or numbers -->

                <div class="vx-col w-1/3 mt-4">
                  <label for>
                    <small>نهاد تطبیق کننده</small>
                  </label>
                  <v-select
                    @input="setOrganizationId"
                    label="text"
                    :options="itemType"
                    :dir="$vs.rtl ? 'rtl' : 'ltr'"
                  />
                </div>

                <div class="vx-col w-1/3 mt-4">
                  <vs-button
                    type="filled"
                    class="mt-5 block"
                    @click="addNewData"
                  >نهاد جدید اضافه کنید</vs-button>
                </div>

                <!-- Must only consist of numbers -->
                <div class="vx-col w-1/3">
                  <vs-input
                    size="medium"
                    v-model="pForm.title"
                    v-validate="'required|min:6'"
                    label="عنوان پروژه"
                    class="mt-5 w-full"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('projecttitle')"
                  >{{ errors.first("projecttitle") }}</span>
                </div>

                <!-- Must be a valid email -->
                <div class="vx-col w-1/3 mt-5">
                  <label for class="ml-4 mr-4 mb-2">نوع قرارداد</label>
                  <ul class="leftx">
                    <li>
                      <vs-radio
                        vs-name="radios1"
                        v-model="pForm.type"
                        vs-value="1"
                        class="ml-4 mr-4"
                      >
                        <small>چارچوبی</small>
                      </vs-radio>
                      <vs-radio
                        vs-name="radios1"
                        v-model="pForm.type"
                        vs-value="2"
                        class="ml-4 mr-4"
                      >
                        <small>معین</small>
                      </vs-radio>
                    </li>
                  </ul>
                </div>
                <!-- Must be a valid url -->

                <!-- Only alphabetic characters or spaces -->
                <div class="vx-col w-1/3">
                  <vs-input
                    size="medium"
                    v-model="pForm.auth_number"
                    v-validate="'required|min:6'"
                    label="شماره شناسایی"
                    class="mt-5 w-full"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('identitynumber')"
                  >{{ errors.first("identitynumber") }}</span>
                </div>

                <div class="vx-col w-1/3 pt-4">
                  <!-- TITLE -->
                  <label for>
                    <small>مدت قرار داد</small>
                  </label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>ماه</span>
                      </div>
                    </template>

                    <vs-input type="number" v-model="pForm.duration" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>

                <!-- Length should not be less than the specified length : 3 -->
                <div class="vx-col w-1/3 pt-4">
                  <!-- TITLE -->
                  <label for>
                    <small>ارزش قرارداد</small>
                  </label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>

                    <vs-input type="number" v-model="pForm.price" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>

                <!-- Length may not exceed the specified length : 6 -->
                <div class="vx-col w-1/3 pt-4">
                  <label for="date" class="mt-3">
                    <small>تاریخ آفرگشایی</small>
                  </label>
                  <date-picker
                    v-model="pForm.offer_date"
                    color="#e85454"
                    input-format="YYYY/MM/DD"
                    format="jYYYY/jMM/jDD"
                    :auto-submit="true"
                    size="large"
                  ></date-picker>
                </div>

                <!-- Password 1 -->
                <div class="vx-col w-1/3 pt-4">
                  <label for="date" class="mt-3">
                    <small>ختم پیشنهادات</small>
                  </label>
                  <date-picker
                    v-model="pForm.close_date"
                    color="#e85454"
                    input-format="YYYY/MM/DD"
                    format="jYYYY/jMM/jDD"
                    :auto-submit="true"
                    size="large"
                  ></date-picker>
                </div>

                <!-- Confirm Password -->
                <div class="vx-col w-1/3">
                  <vs-input
                    v-model="pForm.source_address"
                    size="medium"
                    label="آدرس داوطلبی"
                    class="mt-5 w-full"
                  />
                </div>

                <!-- Date Format: dd/MM/yyyy -->
                <div class="vx-col w-1/3 mt-5">
                  <!-- TITLE -->
                  <label for>
                    <small>مقدار معین آفر</small>
                  </label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>

                    <vs-input v-model="pForm.offer_price" type="number" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>

                <!-- Numeric value between minimum value and a maximum value : 1 and 11 -->
                <div class="vx-col w-1/3 mt-5">
                  <!-- TITLE -->
                  <label for>
                    <small>مقدار معین پروژه</small>
                  </label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>

                    <vs-input v-model="pForm.project_price" type="number" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>
              </div>
              <vs-button
                type="filled"
                :disabled="!isFormValid"
                @click.prevent="submitForm"
                class="mt-5 block"
              >Submit</vs-button>
            </form>
          </vx-card>
        </div>
      </vs-tab>
      <vs-tab label=" لست قرار دادها">
        <div class="vx-row">
          <project-list></project-list>
        </div>
      </vs-tab>
    </vs-tabs>
  </div>
</template>

<script>
import vSelect from "vue-select";
// import Organizationadd from "./proposals/Organizationadd.vue";
import DataViewSidebar from "./DataViewSidebar.vue";
import moduleDataList from "./data-list/moduleDataList.js";
import ProjectList from "./ProjectList.vue";
import {Form,HasError,AlertError} from 'vform'

export default {
  components: {
    // Organizationadd,
    ProjectList,
    "v-select": vSelect,
  },
  data() {
    return {
      // Project Form

      pForm: new Form({
        s_number: 4398,
        issue_date: '',
        issue_address: '',
        source_address: '',
        title: '',
        img: '',
        auth_number: '',
        type: '',
        price: '',
        duration: '',
        offer_date: '',
        close_date: '',
        offer_price: '',
        project_price: '',
        announce_id: '',
        organization_id: '',
      }),
      // End Project Form
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
      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {},
      statusFa: {
        on_hold: "درجریان",
        delivered: "تکمیل",
        canceled: "نا موفق",
      },
      selected: [],
      // products: [],
      itemsPerPage: 4,
      isMounted: false,
      addNewDataSidebar: false,
      sidebarData: {},
    };
  },
  created() {
    if (!moduleDataList.isRegistered) {
      this.$store.registerModule("dataList",moduleDataList);
      moduleDataList.isRegistered = true;
    }
    this.$store.dispatch("dataList/fetchDataListItems");
  },
  computed: {
    isFormValid() {
      return Object.keys(this.fields).some(key => this.fields[key].validated) && Object.keys(this.fields).some(key => this.fields[key].valid);
    },
    currentPage() {
      if (this.isMounted) {
        return this.$refs.table.currentx;
      }
      return 0;
    },
    products() {
      return this.$store.state.dataList.products;
    },
    queriedItems() {
      return this.$refs.table
        ? this.$refs.table.queriedResults.length
        : this.products.length;
    },
  },
  mounted() {
    this.isMounted = false;
    this.$validator.validate();
  },
  methods: {
    setAnnounceId(arr) {
     //  trigger a mutation, or dispatch an action  
     this.pForm.announce_id = arr.value;
  },
    setOrganizationId(arr) {
     //  trigger a mutation, or dispatch an action  
     this.pForm.organization_id = arr.value;
  },
    submitForm() {
      console.log(this.pForm);

      this.$validator.validateAll().then((result) => {
        if (result) {
          // if form have no errors
          // Submit the form via a POST request
          this.pForm.post('/api/project')
            .then(({data}) => {console.log(data)})
        } else {
          console.log("There is errors");

          // form have errors
        }
      });
      this.pForm.post('/api/project')
        .then(({data}) => {console.log(data)});

    },
    addNewData() {
      this.sidebarData = {};
      this.toggleDataSidebar(true);
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val;
    },
    goTo(data) {
      this.$router
        .push({
          path: "/projects/project/${data.id}",
          name: "project-view",
          params: {id: data.id,dyTitle: data.name},
        })
        .catch(() => {});
    },
    viewProject(id) {
      // Vue.$forceUpdate();
      this.$router.push("/projects/project/" + id).catch(() => {});
    },
    // End Custom
    addNewData() {
      this.sidebarData = {};
      this.toggleDataSidebar(true);
    },
    deleteData(id) {
      this.$store.dispatch("dataList/removeItem",id).catch((err) => {
        console.error(err);
      });
    },
    editData(data) {
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      this.sidebarData = data;
      this.toggleDataSidebar(true);
    },
    getOrderStatusColor(status) {
      if (status === "on_hold") return "warning";
      if (status === "delivered") return "success";
      if (status === "canceled") return "danger";
      return "primary";
    },
    getPopularityColor(num) {
      if (num > 90) return "success";
      if (num > 70) return "primary";
      if (num >= 50) return "warning";
      if (num < 50) return "danger";
      return "primary";
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val;
    },
  },
};
</script>

<style lang="scss">
#data-list-thumb-view {
  .vs-con-table {
    .product-name {
      max-width: 23rem;
    }
    .vs-table--header {
      display: flex;
      flex-wrap: wrap-reverse;
      margin-left: 1.5rem;
      margin-right: 1.5rem;
      > span {
        display: flex;
        flex-grow: 1;
      }
      .vs-table--search {
        padding-top: 0;
        .vs-table--search-input {
          padding: 0.9rem 2.5rem;
          font-size: 1rem;
          & + i {
            left: 1rem;
          }
          &:focus + i {
            left: 1rem;
          }
        }
      }
    }
    .vs-table {
      border-collapse: separate;
      border-spacing: 0 1.3rem;
      padding: 0 1rem;
      tr {
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.05);
        td {
          padding: 10px;
          &:first-child {
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
          }
          &:last-child {
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
          }
          &.img-container {
            // width: 1rem;
            // background: #fff;
            span {
              display: flex;
              justify-content: flex-start;
            }
            .product-img {
              height: 110px;
            }
          }
        }
        td.td-check {
          padding: 20px !important;
        }
      }
    }
    .vs-table--thead {
      th {
        padding-top: 0;
        padding-bottom: 0;
        .vs-table-text {
          text-transform: uppercase;
          font-weight: 600;
        }
      }
      th.td-check {
        padding: 0 15px !important;
      }
      tr {
        background: none;
        box-shadow: none;
      }
    }
    .vs-table--pagination {
      justify-content: center;
    }
  }
}
</style>
