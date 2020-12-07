<template>
  <div>
    <OrganizationAdd
      :isSidebarActive="addNewDataSidebar"
      @closeSidebar="toggleDataSidebar"
      :data="sidebarData"
    />

    <vs-tabs>
      <vs-tab label=" ثبت قرارداد جدید">
        <div class="vx-row">
          <vx-card class="height-vh-80">
            <div class="vx-row">
              <div class="vx-col mb-base w-1/2">
                <h3>فارم ثبت پروژه قرار دادی</h3>
              </div>
            </div>

            <form>
              <div class="vx-row">
                <!-- required -->
                <div class="vx-col mb-base w-1/3">
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

                <div class="vx-col mb-base w-1/3 mt-4">
                  <label for>
                    <small>انتخاب اعلان</small>
                  </label>
                  <v-select
                    label="title"
                    @input="setAnnounceId"
                    :options="announces"
                    :dir="$vs.rtl ? 'rtl' : 'ltr'"
                  />
                  <has-error :form="pForm" field="announce_id"></has-error>
                </div>

                <!-- Only alphabetic characters -->
                <div class="vx-col mb-base w-1/3 pt-5 pb-0">
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
                  <has-error :form="pForm" field="issue_date"></has-error>
                </div>

                <!-- Only alphabetic characters, numbers, dashes or underscores -->
                <div class="vx-col mb-base w-1/3">
                  <vs-input
                    v-model="pForm.issue_address"
                    size="medium"
                    v-validate="'required'"
                    label="محل اعلان"
                    class="mt-5 w-full"
                  />
                  <has-error :form="pForm" field="issue_address"></has-error>
                </div>

                <!-- May contain alphabetic characters or numbers -->

                <div class="vx-col mb-base w-1/3 mt-4">
                  <label for>
                    <small>نهاد تطبیق کننده</small>
                  </label>
                  <v-select
                    @input="setOrganizationId"
                    label="title"
                    :options="org"
                    :dir="$vs.rtl ? 'rtl' : 'ltr'"
                  />
                  <has-error :form="pForm" field="organization_id"></has-error>
                </div>

                <div class="vx-col mb-base w-1/3 mt-4">
                  <vs-button
                    type="filled"
                    class="mt-5 block"
                    @click="addNewData"
                  >نهاد جدید اضافه کنید</vs-button>
                </div>

                <!-- Must only consist of numbers -->
                <div class="vx-col mb-base w-1/3">
                  <vs-input
                    size="medium"
                    v-model="pForm.title"
                    v-validate="'required|min:6'"
                    label="عنوان پروژه"
                    class="mt-5 w-full"
                  />
                  <has-error :form="pForm" field="title"></has-error>
                </div>

                <!-- Must be a valid email -->
                <div class="vx-col mb-base w-1/3 mt-5">
                  <label for class="ml-4 mr-4 mb-2">نوع قرارداد</label>
                  <div class="vx-row pl-4 pr-4">
                    <div class="radio-group w-full">
                      <div class="w-1/2">
                        <input
                          type="radio"
                          v-model="pForm.type"
                          value="1"
                          id="afn"
                          name="type"
                        />
                        <label for="afn" class="w-full text-center">چارچوبی</label>
                      </div>
                      <div class="w-1/2">
                        <input
                          type="radio"
                          v-model="pForm.type"
                          value="2"
                          id="usd"
                          name="type"
                        />
                        <label for="usd" class="w-full text-center">معین</label>
                      </div>
                    </div>
                  </div>
                  <has-error :form="pForm" field="type"></has-error>
                </div>
                <!-- Must be a valid url -->

                <!-- Only alphabetic characters or spaces -->
                <div class="vx-col mb-base w-1/3">
                  <vs-input
                    size="medium"
                    v-model="pForm.auth_number"
                    v-validate="'required|min:6'"
                    label="شماره شناسایی"
                    class="mt-5 w-full"
                  />
                  <has-error :form="pForm" field="auth_number"></has-error>
                </div>

                <div class="vx-col mb-base w-1/3 pt-4">
                  <!-- TITLE -->
                  <label for>
                    <small>مدت قرار داد</small>
                  </label>
                  <vx-input-group>
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>ماه</span>
                      </div>
                    </template>

                    <vs-input type="number" v-model="pForm.duration" />
                  </vx-input-group>
                  <has-error :form="pForm" field="duration"></has-error>
                  <!-- /TITLE -->
                </div>

                <!-- Length should not be less than the specified length : 3 -->
                <div class="vx-col mb-base w-1/3 pt-4">
                  <!-- TITLE -->
                  <label for>
                    <small>ارزش قرارداد</small>
                  </label>
                  <vx-input-group>
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>

                    <vs-input type="number" v-model="pForm.price" />
                  </vx-input-group>
                  <has-error :form="pForm" field="price"></has-error>
                  <!-- /TITLE -->
                </div>

                <!-- Length may not exceed the specified length : 6 -->
                <div class="vx-col mb-base w-1/3 pt-4">
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
                  <has-error :form="pForm" field="offer_date"></has-error>
                </div>

                <!-- Password 1 -->
                <div class="vx-col mb-base w-1/3 pt-4">
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
                  <has-error :form="pForm" field="close_date"></has-error>
                </div>

                <!-- Confirm Password -->
                <div class="vx-col mb-base w-1/3">
                  <vs-input
                    v-model="pForm.source_address"
                    size="medium"
                    label="آدرس داوطلبی"
                    class="mt-5 w-full"
                  />
                  <has-error :form="pForm" field="source_address"></has-error>
                </div>

                <!-- Date Format: dd/MM/yyyy -->
                <div class="vx-col mb-base w-1/3 mt-5">
                  <!-- TITLE -->
                  <label for>
                    <small>مقدار معین آفر</small>
                  </label>
                  <vx-input-group>
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>

                    <vs-input v-model="pForm.offer_price" type="number" />
                  </vx-input-group>
                  <has-error :form="pForm" field="offer_price"></has-error>

                  <!-- /TITLE -->
                </div>

                <!-- Numeric value between minimum value and a maximum value : 1 and 11 -->
                <div class="vx-col mb-base w-1/3 mt-5">
                  <!-- TITLE -->
                  <label for>
                    <small>مقدار معین پروژه</small>
                  </label>
                  <vx-input-group>
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>

                    <vs-input v-model="pForm.project_price" type="number" />
                  </vx-input-group>
                  <has-error :form="pForm" field="project_price"></has-error>
                  <!-- /TITLE -->
                </div>
              </div>
              <vs-button
                type="filled"
                :disabled="pForm.busy"
                @click.prevent="submitForm"
              >ثبت قرارداد</vs-button>
              <vs-button type="border" @click.prevent="formReset()">پاک کردن</vs-button>
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
import OrganizationAdd from "./OrganizationAdd.vue";
import DataViewSidebar from "./DataViewSidebar.vue";
import moduleDataList from "./data-list/moduleDataList.js";
import ProjectList from "./ProjectList.vue";
import {Form,HasError,AlertError} from 'vform'

export default {
  components: {
    OrganizationAdd,
    ProjectList,
    "v-select": vSelect,
    HasError,
    AlertError,
  },
  data() {
    return {
      // init values
      announces: [],
      org: [],
      mainSNumber: 0,
      // Project Form
      pForm: new Form({
        s_number: '',
        issue_date: '',
        issue_address: '',
        source_address: '',
        title: '',
        img: '',
        auth_number: '',
        type: "1",
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
    this.getAnnounces();
    this.getOrganizations();
    this.getLastProj();
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
      this.pForm.announce_id = arr.id;
    },
    setOrganizationId(arr) {
      //  trigger a mutation, or dispatch an action  
      this.pForm.organization_id = arr.id;
    },
    getAnnounces() {
      // Start the Progress Bar
      this.$Progress.start()
      this.axios.get('/api/announcement')
        .then((response) => {
          this.announces = response.data;
        })
    },
    getLastProj() {
      this.axios.get('/api/project-last')
        .then((response) => {
          this.mainSNumber = response.data;
          this.pForm.s_number = this.mainSNumber;
        })
    },
    getOrganizations() {
      this.axios.get('/api/organization')
        .then((response) => {
          this.org = response.data;
          // Finish the Progress Bar
          this.$Progress.set(100)
        })
    },
    submitForm() {
      // Start the Progress Bar
      this.$Progress.start()

      this.pForm.post('/api/project')
        .then(({data}) => {
          // Finish the Progress Bar
          this.getLastProj();
          this.$Progress.set(100)
          this.$vs.notify({
            title: 'موفقیت!',
            text: 'قرارداد ' + data.title + ' موفقانه ثبت شد.',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        }).catch((errors) => {
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
    formReset() {
      this.pForm.reset();
      this.pForm.s_number = this.mainSNumber;
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
