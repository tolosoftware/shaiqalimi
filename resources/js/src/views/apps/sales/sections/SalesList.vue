<!-- =========================================================================================
  File Name: DataListListView.vue
  Description: Data List - List View
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
<div id="data-list-list-view" class="data-list-container">
  <div v-if="!isloaded">
    <TableLoading></TableLoading>
  </div>
  <vs-table v-if="isloaded" ref="table" pagination :max-items="itemsPerPage" search :data="sales">
    <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">
      <div class="flex flex-wrap-reverse items-center data-list-btn-container">
        <!-- ITEMS PER PAGE -->
        <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4 items-per-page-handler float-right">
          <div class="p-2 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
            <!-- <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ sales.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : sales.length }} of {{ queriedItems }}</span> -->
            <span class="mr-2">
              {{ currentPage * itemsPerPage - (itemsPerPage - 1) }} -
              {{
              sales.length - currentPage * itemsPerPage > 0
              ? currentPage * itemsPerPage
              : sales.length
              }}
              از {{ queriedItems }}
            </span>
            <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
          </div>
          <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
          <vs-dropdown-menu>
            <vs-dropdown-item @click="itemsPerPage=4">
              <span>4</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=10">
              <span>10</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=15">
              <span>15</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=20">
              <span>20</span>
            </vs-dropdown-item>
          </vs-dropdown-menu>
        </vs-dropdown>
      </div>
    </div>
    <template slot="thead">
      <vs-th>#</vs-th>
      <vs-th>سریال نمبر</vs-th>
      <vs-th>قیمت کلی</vs-th>
      <vs-th>قیمت خدمات</vs-th>
      <vs-th>نوع فروش</vs-th>
      <vs-th>منبع</vs-th>
      <vs-th>تنظیمات</vs-th>
    </template>
    <template slot-scope="{data}">
      <tbody>
        <vs-tr :data="tr" :key="i" v-for="(tr, i) in data">
          <vs-td>
            <p @click.stop="viewData(tr)" class="cursor-pointer">{{i + 1 }}</p>
          </vs-td>
          <vs-td>
            <p @click.stop="viewData(tr)" class="cursor-pointer">
              <!-- {{ tr.type +" - "+ tr.serial_no }} -->
              <small class="mb-5">{{tr.type}}-</small>
              <small class="mb-5" v-if="(tr.sales && tr.sales.project) && tr.sales.project.pro_data">{{tr.sales.project.pro_data.reference_no}}-</small>
              <small class="mb-5" v-text="tr.serial_no"></small>
            </p>
          </vs-td>
          <vs-td>
            <p @click.stop="viewData(tr)" class="cursor-pointer">{{ tr.total | NumThreeDigit}} افغانی</p>
          </vs-td>
          <vs-td>
            <p @click.stop="viewData(tr)" class="cursor-pointer">{{ tr.service_cost | NumThreeDigit }} افغانی</p>
          </vs-td>
          <vs-td>
            <p @click.stop="viewData(tr)" class="cursor-pointer">{{ $t(tr.type) }}</p>
          </vs-td>
          <vs-td>
            <p @click.stop="viewData(tr)" class="cursor-pointer">{{ tr.source_type }}</p>
          </vs-td>
          <vs-td>
            <feather-icon icon="CheckSquareIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current cursor-pointer" class="ml-2" @click.stop="showCheckModal(tr.sales_id)" />&nbsp;&nbsp;
            <feather-icon icon="PrinterIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current cursor-pointer" class="ml-2" @click.stop="showPrintData(tr.id)" />&nbsp;&nbsp;
            <feather-icon icon="EditIcon" svgClasses="w-6 h-6 hover:text-primary stroke-current cursor-pointer" @click.stop="goToEdit(tr)"/>
            <feather-icon icon="TrashIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current cursor-pointer" class="ml-2" @click.stop="deleteData(tr.sales_id)" />
            <feather-icon icon="EyeIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current cursor-pointer" class="ml-2" @click.stop="viewData(tr)" />
          </vs-td>
        </vs-tr>
      </tbody>
    </template>
  </vs-table>
  <vs-popup class="holamundo" title="تنظیمات مربوط به فروشات" :active.sync="popupModalActive">
    <div v-for="(s,i) in sale" :key="i">
      <div v-if="s.type=='s1'">
        <form-wizard color="rgba(var(--vs-primary), 1)" :title="null" :subtitle="null" back-button-text="قبلی" next-button-text="بعدی" :start-index="0" ref="wizard" finishButtonText="بستن صحفه" @on-complete="formSubmitted">
          <tab-content title="تنظیم اطلاعات بل" class="mb-5">
            <vs-divider>تنظیم اطلاعات بل</vs-divider>
            <p>سریال نمبر: {{ s.type +" - "+ s.serial_no }}</p>
            <br>
            <div class="flex justify-between float-right">
              <!--<vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2">ثبت</vs-button>-->
            </div>
            <!--<vs-divider></vs-divider> -->
          </tab-content>
          <tab-content title="اطلاعات مالی" class="mb-5">
            <vs-row vs-w="12" class="mb-1">
              <vs-divider>اطلاعات مالی</vs-divider>
              <div>
                <div>
                  <!--<p>سریال نمبر: {{ s.type +" - "+ s.serial_no }}</p> -->
                </div>
                <br>
                <div class="flex justify-between float-right">
                  <!--<vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2">ثبت</vs-button>-->
                </div>
              </div>
              <!--<vs-divider></vs-divider> -->
            </vs-row>
          </tab-content>
          <tab-content title="اکمالات" class="mb-5">
            <vs-row vs-w="12" class="mb-1">
              <vs-divider>اکمالات</vs-divider>
              <div>
                <div>

                </div>
                <br>
                <div class="flex justify-between float-right">
                  <!--<vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2">ثبت</vs-button>-->
                </div>
              </div>
              <!--<vs-divider></vs-divider> -->
            </vs-row>
          </tab-content>
          <tab-content title="فورم(م-16)" class="mb-5">
            <vs-row vs-w="12" class="mb-1">
              <vs-divider>فورم(م-16)</vs-divider>
              <div>
                <div>

                </div>
                <br>
                <div class="flex justify-between float-right">
                  <!--<vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2">ثبت</vs-button>-->
                </div>
              </div>
              <!--<vs-divider></vs-divider> -->
            </vs-row>
          </tab-content>
          <tab-content title="طی مراحل دولتی" class="mb-5">
            <vs-row vs-w="12" class="mb-1">
              <vs-divider>طی مراحل دولتی</vs-divider>
              <div>
                <div>

                </div>
                <br>
                <div class="flex justify-between float-right">
                  <!--<vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2">ثبت</vs-button>-->
                </div>
              </div>
              <!--<vs-divider></vs-divider> -->
            </vs-row>
          </tab-content>
          <tab-content title="دریافت پول" class="mb-5">
            <vs-row vs-w="12" class="mb-1">
              <vs-divider>دریافت پول</vs-divider>
              <div>
                <div>

                </div>
                <br>
                <div class="flex justify-between float-right">
                  <!--<vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2">ثبت</vs-button>-->
                </div>
              </div>
              <!--<vs-divider></vs-divider> -->
            </vs-row>
          </tab-content>
          <tab-content title="تاییدی" class="mb-5">
            <vs-row vs-w="12" class="mb-1">
              <vs-divider>تاییدی</vs-divider>
              <div>
                <div>

                </div>
                <br>
                <div class="flex justify-between float-right">
                  <!--<vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2">ثبت</vs-button>-->
                </div>
              </div>
              <!--<vs-divider></vs-divider> -->
            </vs-row>
          </tab-content>
        </form-wizard>
      </div>
      <div v-if="s.type=='s2'">
        <h1>S2</h1>
        <p>سریال نمبر: {{ s.type +" - "+ s.serial_no }}</p>
      </div>
      <div v-if="s.type=='s3'">
        <h1>S3</h1>
        <p>سریال نمبر: {{ s.type +" - "+ s.serial_no }}</p>
      </div>
      <div v-if="s.type=='s4'">
        <h1>S4</h1>
        <p>سریال نمبر: {{ s.type +" - "+ s.serial_no }}</p>
      </div>
    </div>

  </vs-popup>
  <vs-popup class="holamundo" title="معلومات فروشات" :active.sync="saleModalActive">
    <sale-view :sale="sale_to_view" />
  </vs-popup>
</div>
</template>

<script>
import TableLoading from './../../shared/TableLoading'
import SaleView from '../view/SaleView'
import {
  FormWizard,
  TabContent
} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
export default {
  components: {
    // DataViewSidebar
    FormWizard,
    TabContent,
    TableLoading,
    SaleView
  },
  data() {
    return {
      popupModalActive: false,
      saleModalActive: false,
      sales: [],
      sale: [],
      sale_to_view: null,
      // Demo data
      popupActive: false,
      isloaded: false,
      selected: [],
      itemsPerPage: 10,
      isMounted: false,

      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {}
    }
  },
  computed: {
    currentPage() {
      if (this.isMounted) {
        return this.$refs.table.currentx
      }
      return 0
    },
    queriedItems() {
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.sales.length
    }
  },
  methods: {
    showCheckModal(id) {
      this.$Progress.start()
      this.axios
        .get("/api/sales/" + id)
        .then((data) => {
          this.sale = data.data;
          this.$Progress.set(100);
          this.popupModalActive = true;
        })
        .catch(() => {});
    },
    formSubmitted() {

    },
    getAllSales() {
      this.$Progress.start()
      this.axios
        .get("/api/sales")
        .then((data) => {
          this.sales = data.data;
          this.isloaded = true;
          this.$Progress.set(100);

        })
        .catch(() => {});
    },
    viewData(sale) {
      this.$Progress.start()
      this.axios
        .get("/api/sale/" + sale.sales_id)
        .then((data) => {
          this.sale_to_view = data.data;
          this.saleModalActive = true;
          this.$Progress.set(100);
        })
        .catch(() => {});
    },
    deleteData(id) {
      swal.fire({
        title: 'آیا  مطمئن هستید؟',
        text: "ریکارد فروش حذف خواهد شد",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>خیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.axios.delete('/api/sale1/' + id).then((id) => {
              swal.fire({
                title: 'عملیه موفقانه انجام شد.',
                text: "مورد فروش از سیستم پاک شد!",
                icon: 'success',
              })
              this.getAllSales();
            })
            .catch(() => {});
        }
      })
    },
    // Demo codes
    addNewData() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    editData(data) {
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      this.sidebarData = data
      this.toggleDataSidebar(true)
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val
    },
    goToEdit(data) {
      this.$router
        .push({
          path: `/sales/sale/${data.sales_id}/edit/${data.type}`,
          params: {
            id: data.id,
            dyTitle: data.title
          },
        })
        .catch(() => {});
    },
  },
  created() {
    this.getAllSales();
  },
  mounted() {
    this.isMounted = false
  }
}
</script>

<style>
[dir] .vs-button.includeIcon {
  float: right;
}
</style><style lang="scss">
#data-list-list-view {
  .vs-con-table {

    /*
      Below media-queries is fix for responsiveness of action buttons
      Note: If you change action buttons or layout of this page, Please remove below style
    */
    @media (max-width: 689px) {
      .vs-table--search {
        margin-left: 0;
        max-width: unset;
        width: 100%;

        .vs-table--search-input {
          width: 100%;
        }
      }
    }

    @media (max-width: 461px) {
      .items-per-page-handler {
        display: none;
      }
    }

    @media (max-width: 341px) {
      .data-list-btn-container {
        width: 100%;

        .dd-actions,
        .btn-add-new {
          width: 100%;
          margin-right: 0 !important;
        }
      }
    }

    .product-name {
      max-width: 23rem;
    }

    .vs-table--header {
      display: flex;
      flex-wrap: wrap;
      margin-left: 1.5rem;
      margin-right: 1.5rem;

      >span {
        display: flex;
        flex-grow: 1;
      }

      .vs-table--search {
        padding-top: 0;

        .vs-table--search-input {
          padding: 0.9rem 2.5rem;
          font-size: 1rem;

          &+i {
            left: 1rem;
          }

          &:focus+i {
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
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .05);

        td {
          padding: 20px;

          &:first-child {
            border-top-left-radius: .5rem;
            border-bottom-left-radius: .5rem;
          }

          &:last-child {
            border-top-right-radius: .5rem;
            border-bottom-right-radius: .5rem;
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
</style><style>
.con-vs-popup .vs-popup {
  width: 800px;
}

.vue-form-wizard .navbar .navbar-nav>li>a.wizard-btn,
.vue-form-wizard .wizard-btn {
  min-width: 40px !important;
}

[dir] .vue-form-wizard .wizard-tab-content {
  padding: 30px 20px 2px 10px !important;
}
</style>
