
<template>
  <div>
    <Organizationadd
      :isSidebarActive="addNewDataSidebar"
      @closeSidebar="toggleDataSidebar"
      :data="sidebarData"
    />

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

                <div class="vx-col w-1/3 mt-4">
                  <label for=""><small>انتخاب اعلان </small></label>
                  <v-select
                    label="text"
                    :options="itemType"
                    :dir="$vs.rtl ? 'rtl' : 'ltr'"
                  />
                </div>

                <div class="vx-col w-1/3 mt-4">
                  <label for=""><small>انتخاب از پیشنهاد </small></label>
                  <v-select
                    label="text"
                    :options="itemType"
                    :dir="$vs.rtl ? 'rtl' : 'ltr'"
                  />
                </div>

                <!-- Only alphabetic characters -->
                <div class="vx-col w-1/3 pt-5 pb-0">
                  <label for="date" class="mt-3"
                    ><small>تاریخ نشر اعلان</small></label
                  >
                  <date-picker
                    input-format="YYYY/MM/DD"
                    format="jYYYY/jMM/jDD"
                    :auto-submit="true"
                    size="large"
                  ></date-picker>
                </div>

                <!-- Only alphabetic characters, numbers, dashes or underscores -->
                <div class="vx-col w-1/3">
                  <vs-input
                    size="medium"
                    v-validate="'announceplace'"
                    label="محل اعلان"
                    name="announceplace"
                    class="mt-5 w-full"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('announceplace')"
                    >{{ errors.first("announceplace") }}</span
                  >
                </div>

                <!-- May contain alphabetic characters or numbers -->

                <div class="vx-col w-1/3 mt-4">
                  <label for=""><small>نهاد تطبیق کننده</small></label>
                  <v-select
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
                    >نهاد جدید اضافه کنید</vs-button
                  >
                </div>

                <!-- Must only consist of numbers -->
                <div class="vx-col w-1/3">
                  <vs-input
                    size="medium"
                    v-validate="'projecttitle'"
                    label="عنوان پروژه"
                    name="projecttitle"
                    class="mt-5 w-full"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('projecttitle')"
                    >{{ errors.first("projecttitle") }}</span
                  >
                </div>

                <!-- Must be a valid email -->
                <div class="vx-col w-1/3 mt-5">
                  <label for="" class="ml-4 mr-4 mb-2">نوع قرارداد</label>
                  <ul class="leftx">
                    <li>
                      <vs-radio
                        vs-name="radios1"
                        vs-value="luis"
                        class="ml-4 mr-4"
                        ><small>چارچوبی</small>
                      </vs-radio>
                      <vs-radio
                        vs-name="radios1"
                        vs-value="carols"
                        class="ml-4 mr-4"
                        ><small>معین</small></vs-radio
                      >
                    </li>
                  </ul>
                </div>
                <!-- Must be a valid url -->

                <!-- Only alphabetic characters or spaces -->
                <div class="vx-col w-1/3">
                  <vs-input
                    size="medium"
                    v-validate="'identitynumber'"
                    label="شماره شناسایی"
                    name="identitynumber"
                    class="mt-5 w-full"
                  />
                  <span
                    class="text-danger text-sm"
                    v-show="errors.has('identitynumber')"
                    >{{ errors.first("identitynumber") }}</span
                  >
                </div>

                <div class="vx-col w-1/3 pt-4">
                  <!-- TITLE -->
                  <label for=""> <small>مدت قرار داد</small></label>
                  <vx-input-group class="mb-base">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>ماه</span>
                      </div>
                    </template>

                    <vs-input type="number" />
                  </vx-input-group>
                  <!-- /TITLE -->
                </div>

                <!-- Length should not be less than the specified length : 3 -->
                <div class="vx-col w-1/3 pt-4">
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

                <!-- Length may not exceed the specified length : 6 -->
                <div class="vx-col w-1/3 pt-4">
                  <label for="date" class="mt-3"
                    ><small>تاریخ آفرگشایی</small></label
                  >
                  <date-picker
                    input-format="YYYY/MM/DD"
                    format="jYYYY/jMM/jDD"
                    :auto-submit="true"
                    size="large"
                  ></date-picker>
                </div>

                <!-- Password 1 -->
                <div class="vx-col w-1/3 pt-4">
                  <label for="date" class="mt-3"
                    ><small> ختم پیشنهادات</small></label
                  >
                  <date-picker
                    input-format="YYYY/MM/DD"
                    format="jYYYY/jMM/jDD"
                    :auto-submit="true"
                    size="large"
                  ></date-picker>
                </div>

                <!-- Confirm Password -->
                <div class="vx-col w-1/3">
                  <vs-input
                    size="medium"
                    label="آدرس داوطلبی"
                    name="offeraddress"
                    class="mt-5 w-full"
                  />
                </div>

                <!-- Date Format: dd/MM/yyyy -->
                <div class="vx-col w-1/3 mt-5">
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

                <!-- Numeric value between minimum value and a maximum value : 1 and 11 -->
                <div class="vx-col w-1/3 mt-5">
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
              </div>
              <vs-button
                type="filled"
                @click.prevent="submitForm"
                class="mt-5 block"
                >Submit</vs-button
              >
            </form>
          </vx-card>
        </div>
      </vs-tab>
      <vs-tab label=" لست قرار دادها">
        <div class="vx-row">
          <div id="data-list-thumb-view" class="w-full data-list-container">
            <vs-table
              class="w-full"
              ref="table"
              pagination
              :max-items="itemsPerPage"
              search
              :data="products"
            >
              <div
                slot="header"
                class="flex flex-wrap-reverse items-center flex-grow justify-between"
              >
                <!-- ITEMS PER PAGE -->
                <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4">
                  <div
                    class="pl-4 pr-4 pt-1 pb-1 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium"
                  >
                    <!-- <span class="mr-2">۴ از ۱۰</span> -->
                    <span class="mr-2"
                      >{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} -
                      {{
                        products.length - currentPage * itemsPerPage > 0
                          ? currentPage * itemsPerPage
                          : products.length
                      }}
                      از {{ queriedItems }}</span
                    >
                    <!-- <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ products.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : products.length }} از {{ queriedItems }}</span> -->
                    <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
                  </div>
                  <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
                  <vs-dropdown-menu>
                    <vs-dropdown-item @click="itemsPerPage = 4">
                      <span>۴</span>
                    </vs-dropdown-item>
                    <vs-dropdown-item @click="itemsPerPage = 10">
                      <span>۱۰</span>
                    </vs-dropdown-item>
                    <vs-dropdown-item @click="itemsPerPage = 15">
                      <span>۱۵</span>
                    </vs-dropdown-item>
                    <vs-dropdown-item @click="itemsPerPage = 20">
                      <span>۲۰</span>
                    </vs-dropdown-item>
                  </vs-dropdown-menu>
                </vs-dropdown>
              </div>

              <template slot="thead">
                <vs-th>نهاد</vs-th>
                <vs-th sort-key="name">موضوع قرارداد</vs-th>
                <vs-th sort-key="category">دسته</vs-th>
                <vs-th sort-key="popularity">مقدار</vs-th>
                <vs-th sort-key="order_status">وضعیت</vs-th>
                <vs-th sort-key="price">قیمت</vs-th>
                <vs-th>بررسی</vs-th>
              </template>

              <template slot-scope="{ data }">
                <tbody>
                  <vs-tr
                    :data="tr"
                    :key="indextr"
                    v-for="(tr, indextr) in data"
                  >
                    <vs-td class="img-container">
                      <router-link
                        class="product-name font-medium truncate"
                        :to="{
                          path: '/projects/project/${tr.id}',
                          name: 'project-view',
                          params: { id: tr.id, dyTitle: tr.name },
                        }"
                      >
                        <img :src="tr.img" class="product-img" />
                      </router-link>
                    </vs-td>

                    <vs-td>
                      <div @click="goTo(tr)">
                        <router-link
                          class="product-name font-medium truncate"
                          :to="{
                            path: '/projects/project/${tr.id}',
                            name: 'project-view',
                            params: { id: tr.id, dyTitle: tr.name },
                          }"
                          >{{ tr.name }}</router-link
                        >
                      </div>
                    </vs-td>

                    <vs-td>
                      <p class="product-category">{{ tr.category }}</p>
                    </vs-td>

                    <vs-td>
                      <vs-progress
                        :percent="Number(tr.popularity)"
                        :color="getPopularityColor(Number(tr.popularity))"
                        class="shadow-md"
                      />
                    </vs-td>

                    <vs-td>
                      <vs-chip
                        :color="getOrderStatusColor(tr.order_status)"
                        class="product-order-status"
                        >{{ statusFa[tr.order_status] }}</vs-chip
                      >
                    </vs-td>

                    <vs-td>
                      <p class="product-price">{{ tr.price }} دالر</p>
                    </vs-td>

                    <vs-td class="whitespace-no-wrap notupfromall">
                      <feather-icon
                        icon="EditIcon"
                        svgClasses="w-5 h-5 hover:text-primary stroke-current"
                        @click.stop="editData(tr)"
                      />
                      <feather-icon
                        icon="TrashIcon"
                        svgClasses="w-5 h-5 hover:text-danger stroke-current"
                        class="ml-2"
                        @click.stop="deleteData(tr.id)"
                      />
                    </vs-td>
                  </vs-tr>
                </tbody>
              </template>
            </vs-table>
          </div>
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
export default {
  components: {
    // Organizationadd,
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
      this.$store.registerModule("dataList", moduleDataList);
      moduleDataList.isRegistered = true;
    }
    this.$store.dispatch("dataList/fetchDataListItems");
  },
  computed: {
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
          params: { id: data.id, dyTitle: data.name },
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
      this.$store.dispatch("dataList/removeItem", id).catch((err) => {
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


