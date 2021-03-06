<template>
<div id="data-list-list-view" class="data-list-container">
  <div v-if="!isdata">
    <TableLoading></TableLoading>
  </div>
  <vs-table v-if="isdata" ref="table" pagination :max-items="itemsPerPage" search :data="allTransaction">
    <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">
      <div class="flex flex-wrap-reverse items-center data-list-btn-container">
        <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4 items-per-page-handler float-right">
          <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
            <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} -
              {{
                  products.length - currentPage * itemsPerPage > 0
                    ? currentPage * itemsPerPage
                    : products.length
                }}
              of {{ queriedItems }}</span>
            <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
          </div>
          <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
          <vs-dropdown-menu>
            <vs-dropdown-item @click="itemsPerPage = 4">
              <span>4</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage = 10">
              <span>10</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage = 15">
              <span>15</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage = 20">
              <span>20</span>
            </vs-dropdown-item>
          </vs-dropdown-menu>
        </vs-dropdown>
      </div>
    </div>

    <template slot="thead">
      <vs-th sort-key="name">شماره</vs-th>
      <vs-th sort-key="category">سریال نمبر</vs-th>
      <vs-th sort-key="popularity">عنوان</vs-th>
      <vs-th sort-key="order_status">حالت معامله</vs-th>
      <vs-th sort-key="price">مقدار</vs-th>
      <vs-th sort-key="price">واحد پولی</vs-th>
      <vs-th sort-key="price">کاربر ثبت</vs-th>
      <vs-th sort-key="price">توضیحات</vs-th>
      <vs-th>تنظیمات</vs-th>
    </template>

    <template slot-scope="{ data }">
      <tbody>
        <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
          <vs-td>
            <p @click.stop="viewData(tr)" class="cursor-pointer product-name font-medium truncate">{{ indextr+1 }}</p>
          </vs-td>
          <vs-td>
            <p @click.stop="viewData(tr)" class="cursor-pointer product-name font-medium truncate">{{'TRA-'+ tr.serial_no }}</p>
          </vs-td>
          <vs-td>
            <p @click.stop="viewData(tr)" class="cursor-pointer product-category">{{ tr.title | title }}</p>
          </vs-td>
          <vs-td>
            <vs-chip :color="getOrderStatusColorr(tr.transaction_status)" class="product-order-status">{{ tr.transaction_status | title }}</vs-chip>
          </vs-td>
          <vs-td>
            <vs-chip :color="getOrderStatusColor(tr.ammount)" class="product-order-status">{{ (tr.ammount | title) | NumThreeDigit }}</vs-chip>
          </vs-td>
          <vs-td>
            <p class="product-price">{{ tr.currency.sign_fa }}</p>
          </vs-td>
          <vs-td>
            <p class="product-price">{{ tr.user.firstName }} {{ tr.user.lastName }}</p>
          </vs-td>
          <vs-td>
            <p class="product-price">{{ tr.description }}</p>
          </vs-td>
          <vs-td class="whitespace-no-wrap">
            <feather-icon icon="CheckSquareIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current cursor-pointer" class="ml-2" @click.stop="showStepsModal(tr.id)" />&nbsp;&nbsp;
            <feather-icon icon="EditIcon" svgClasses="w-6 h-6 hover:text-primary stroke-current cursor-pointer" @click.stop="$router.push({path: '/transactions/edit/' + tr.id, params: {item: tr }}).catch(() => {})" />
            <feather-icon icon="TrashIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current cursor-pointer" class="ml-2" @click.stop="deleteData(tr.id)" />
          </vs-td>
        </vs-tr>
      </tbody>
    </template>
  </vs-table>
  <vs-popup class="holamundo" title=" تنظیمات مربط به معاملات تجارتی " :active.sync="popupStepActive">
    <TransactionStep @closesteps="closeModel" ref="wizardModalTrans" :transaction="transaction"></TransactionStep>
  </vs-popup>
  <vs-popup class="holamundo" title="معلومات معاملات تجارتی" :active.sync="transactionModalActive">
    <transaction-view :transaction="transaction_to_view" />
  </vs-popup>
</div>
</template>

<script>
//import DataViewSidebar from '../../../DataViewSidebar.vue'
import moduleDataList from "@/store/data-list/moduleDataList.js";
import TableLoading from './../shared/TableLoading.vue'
import TransactionView from './TransactionView';
import TransactionStep from './TransactionStep.vue'

export default {
  components: {
    TransactionView,
    TableLoading,
    TransactionStep
  },
  data() {
    return {
      transaction: [],
      popupStepActive: false,
      isdata: false,
      allTransaction: [],
      itemsPerPage: 10,
      isMounted: false,
      transaction_to_view: null,
      transactionModalActive: false,
    };
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
      return this.$refs.table ?
        this.$refs.table.queriedResults.length :
        this.products.length;
    },
  },
  methods: {
    closeModel() {
      this.popupStepActive = false;
    },
    getTransaction(id) {
      this.$Progress.start()
      this.axios
        .get("/api/transaction/" + id)
        .then((data) => {
          this.transaction = data.data;
          this.$refs.wizardModalTrans.setWizardStepTrans(this.transaction);
          this.$Progress.set(100);
        })
        .catch(() => {});
    },
    showStepsModal(id) {
      this.getTransaction(id);
      this.popupStepActive = true;
    },
    loadTransaction() {
      this.axios.get('/api/transaction').then(({
          data
        }) => (this.allTransaction = data,
          this.isdata = true))
        .catch(() => {
          this.$vs.notify({
            title: 'معلومات بارگیری نشد !',
            text: 'عملیه بارگیری معلومات نام شد',
            color: 'danger',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        });
    },
    viewData(transaction) {
      this.$Progress.start()
      this.axios
        .get("/api/transaction/" + transaction.id)
        .then((resp) => {
          this.transaction_to_view = resp.data;
          this.transactionModalActive = true;
          this.$Progress.set(100);
        })
        .catch(() => {});

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
          this.axios.delete('/api/transaction/' + id).then(() => {
            swal.fire(
              'حذف شد !',
              'موفقانه عملیه حذف انجام شد',
              'success'
            )
            this.loadTransaction();
          }).catch(() => {
            swal("Failed!", "سیستم قادر به حذف نیست دوباره تلاش نماید.", "warning");
          })
        }
      })
    },

    editData(data) {
      this.sidebarData = data;
      this.toggleDataSidebar(true);
    },
    getOrderStatusColor(status) {
      return "success";
    },

    getOrderStatusColorr() {
      return "primary";
    }

  },
  created() {
    this.loadTransaction();
    if (!moduleDataList.isRegistered) {
      this.$store.registerModule("dataList", moduleDataList);
      moduleDataList.isRegistered = true;
    }
    this.$store.dispatch("dataList/fetchDataListItems");
  },
  mounted() {
    this.isMounted = false
  },
};
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
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.05);

        td {
          padding: 20px;

          &:first-child {
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
          }

          &:last-child {
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
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
