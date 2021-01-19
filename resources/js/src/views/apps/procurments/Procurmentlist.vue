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
  <div v-if="!isdata">
    <TableLoading></TableLoading>
  </div>
  <!-- <data-view-sidebar :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" /> -->
  <vs-table v-if="isdata" ref="table" pagination :max-items="itemsPerPage" search :data="allpurchase">
    <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">
      <div class="flex flex-wrap-reverse items-center data-list-btn-container">
        <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4 items-per-page-handler float-right">
          <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
            <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ products.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : products.length }} of {{ queriedItems }}</span>
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
      <vs-th sort-key="name">شماره</vs-th>
      <vs-th sort-key="category">سریال نمبر</vs-th>
      <vs-th sort-key="popularity">نام فروشند</vs-th>
      <vs-th sort-key="popularity">کار بر ثبت کننده</vs-th>
      <vs-th sort-key="order_status">تاریخ و ساعت</vs-th>
      <vs-th sort-key="price">توضیحات</vs-th>
      <vs-th>تنظیمات</vs-th>
    </template>
    <template slot-scope="{data}">
      <tbody>
        <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
          <vs-td>
            <p class="product-name font-medium truncate">{{ indextr +1 }}</p>
          </vs-td>
          <vs-td>
            <p class="product-category">{{ tr.serial_no }}</p>
          </vs-td>
          <vs-td>
            <p class="product-category">{{ tr.vendor.name }}</p>
          </vs-td>
          <vs-td>
            <vs-chip :color="getOrderStatusColor(tr.user.firstName + ' ' + tr.user.lastName)" class="product-order-status">{{ tr.user.firstName + ' '+ tr.user.lastName }}</vs-chip>
          </vs-td>
          <vs-td>
            <p class="product-price">{{ tr.date_time }}</p>
          </vs-td>
          <vs-td>
            <p class="product-price">{{ tr.description }}</p>
          </vs-td>
          <vs-td class="whitespace-no-wrap">
            <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" @click="$router.push({
                           name: 'procurment-edit', 
                           params: {procurment_id: tr.id }}).catch(() => {})" />

            <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(tr.id)" />
            <feather-icon icon="EyeIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current cursor-pointer" class="ml-2" @click.stop="$router.push({ path: `/view/procurment/${tr.id}` })" />
          </vs-td>
        </vs-tr>
      </tbody>
    </template>
  </vs-table>
</div>
</template>

<script>
//import DataViewSidebar from '../../../DataViewSidebar.vue'
import TableLoading from './../shared/TableLoading.vue'
import moduleDataList from '@/store/data-list/moduleDataList.js'
import ProcurmentView from './ProcurmentView'
export default {
  components: {
    ProcurmentView,
    TableLoading
  },
  data() {
    return {
      isdata: false,
      allpurchase: [],
      selected: [],
      // products: [],
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
    products() {
      return this.$store.state.dataList.products
    },
    queriedItems() {
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.products.length
    }
  },
  methods: {
    loadpurchase() {
      this.axios.get('/api/procurments').then(({
          data
        }) => (this.allpurchase = data,
          this.isdata = true
        ))
        .catch(() => {
          this.$vs.notify({
            title: '  معلومات بارگیری نشد !',
            text: 'عملیه بارگیری معلومات نام شد',
            color: 'danger',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        });
    },

    addNewData() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    deleteData(id) {
      swal.fire({
        title: 'آیا شما مطمئن هستید ؟',
        text: "شما قادر به برگردادن این شخص پس از حذف نمی باشید !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'بلی مطمئن هستم',
        cancelButtonText: 'خیر'
      }).then((result) => {
        if (result.value) {
          this.axios.delete('/api/procurments/' + id).then(() => {
            swal.fire(
              'حذف شد !',
              'موفقانه عملیه حذف انجام شد',
              'success'
            )
            this.loadpurchase();
          }).catch(() => {
            swal("Failed!", "سیستم قادر به حذف نیست دوباره تلاش نماید.", "warning");
          })
        }
      })
    },
    editData(data) {
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      this.sidebarData = data
      this.toggleDataSidebar(true)
    },
    getOrderStatusColor(status) {
      if (status === 'on_hold') return 'success'
      if (status === 'delivered') return 'success'
      if (status === 'canceled') return 'success'
      return 'primary'
    },
    getPopularityColor(num) {
      if (num > 90) return 'success'
      if (num > 70) return 'primary'
      if (num >= 50) return 'warning'
      if (num < 50) return 'danger'
      return 'primary'
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val
    },
  },
  created() {
    this.loadpurchase();
    if (!moduleDataList.isRegistered) {
      this.$store.registerModule('dataList', moduleDataList)
      moduleDataList.isRegistered = true
    }
    this.$store.dispatch('dataList/fetchDataListItems')
  },
  mounted() {
    this.isMounted = false
  }
}
</script>

<style lang="scss">
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
</style>
