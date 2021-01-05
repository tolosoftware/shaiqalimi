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
  <vx-card v-if="!isloaded" title="">
    <p style="height:40px;margin:20px;" id="success-load">

    </p>
  </vx-card>
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
      <vs-th>هزینه کلی</vs-th>
      <vs-th>هزینه خدمات</vs-th>
      <vs-th>نوع فروش</vs-th>
      <vs-th>منبع</vs-th>
      <vs-th>تنظیمات</vs-th>
    </template>
    <template slot-scope="{data}">
      <tbody>
        <vs-tr :data="tr" :key="i" v-for="(tr, i) in data">
          <vs-td>
            <p>{{ (itemsPerPage * (currentPage - 1)) + i + 1 }}</p>
          </vs-td>
          <vs-td>
            <p>{{ tr.type +" - "+ tr.serial_no }}</p>
          </vs-td>
          <vs-td>
            <p>{{ tr.total }} افغانی</p>
          </vs-td>
          <vs-td>
            <p>{{ tr.service_cost }} افغانی</p>
          </vs-td>
          <vs-td>
            <p>{{ $t(tr.type) }}</p>
          </vs-td>
          <vs-td>
            <p>{{ tr.source_type }}</p>
          </vs-td>
          <vs-td>
            <feather-icon icon="CheckSquareIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current" class="ml-2" @click.stop="showCheckModal(tr.serial_no)" />&nbsp;&nbsp;
            <router-link class="product-name font-medium truncate" :to="{
              path: '/projects/project/${tr.id}',
                  name: 'project-edit',
                  params: { id: tr.id, dyTitle: tr.title },
            }">
              <feather-icon icon="EditIcon" svgClasses="w-6 h-6 hover:text-primary stroke-current" />
            </router-link>
            <feather-icon icon="TrashIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(tr.sales_id)" />
          </vs-td>
        </vs-tr>
      </tbody>
    </template>
  </vs-table>
  <vs-popup class="holamundo" title="تنظیمات مربط به فروشات" :active.sync="popupModalActive">
    <vx-card v-if="!isloadedrow" title="">
      <p style="height:40px;margin:20px;" id="success-load1"></p>
    </vx-card>
    <div v-if="isloadedrow" v-for="(s,i) in sale">
      <p>سریال نمبر: {{ s.type +" - "+ s.serial_no }}</p>
    </div>
  </vs-popup>

</div>
</template>

<script>
//import DataViewSidebar from '../../../DataViewSidebar.vue'
import moduleDataList from '@/store/data-list/moduleDataList.js'

export default {
  components: {
    // DataViewSidebar
  },
  data() {
    return {
      popupModalActive: false,
      sales: [],
      sale: [],
      // Demo data
      popupActive: false,
      isloaded: false,
      isloadedrow: false,
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
      this.popupModalActive = true;
      this.axios
        .get("/api/sales/" + id)
        .then((data) => {
          this.sale = data.data;
          this.isloadedrow = true;
          console.log('sale', this.sale);
          this.$Progress.set(100);

        })
        .catch(() => {});
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
    deleteData(id, title) {
      swal.fire({
        title: 'آیا  مطمئن هستید؟',
        text: "پروژه حذف خواهد شد",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>نخیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          // this.pForm.delete('/api/project/' + id).then((id) => {
          //     swal.fire({
          //       title: 'عملیه موفقانه انجام شد.',
          //       text: "پروژه از سیستم پاک شد!",
          //       icon: 'success',
          //     })
          //     this.getProject();
          //   })
          //   .catch(() => {});
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
    }
  },
  created() {
    this.getAllSales();
  },
  mounted() {
    this.isMounted = false
    this.$vs.loading({
      container: '#success-load',
      type: 'point',
      text: "درحال بارگیری...."
    })
    this.$vs.loading({
      container: '#success-load1',
      type: 'point',
      text: "درحال بارگیری...."
    })
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
