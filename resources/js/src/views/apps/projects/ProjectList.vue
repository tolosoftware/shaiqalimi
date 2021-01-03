<template>
<div id="data-list-thumb-view" class="w-full data-list-container">
  <vs-table class="w-full" ref="table" pagination :max-items="itemsPerPage" search :data="projects">
    <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">
      <!-- ITEMS PER PAGE -->
      <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4">
        <div class="pl-4 pr-4 pt-1 pb-1 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
          <!-- <span class="mr-2">۴ از ۱۰</span> -->
          <span class="mr-2">
            {{ currentPage * itemsPerPage - (itemsPerPage - 1) }} -
            {{
              projects.length - currentPage * itemsPerPage > 0
              ? currentPage * itemsPerPage
              : projects.length
              }}
            از {{ queriedItems }}
          </span>
          <!-- <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ projects.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : projects.length }} از {{ queriedItems }}</span> -->
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
      <!--<vs-button size="small" type="gradient" icon="print" id="printBTN" @click.stop="printProject">چاپ</vs-button> -->
    </div>

    <template slot="thead">
      <vs-th>نمبر</vs-th>
      <vs-th>نهاد</vs-th>
      <vs-th sort-key="name">قرارداد</vs-th>
      <vs-th sort-key="project_guarantee">تضمین قرارداد</vs-th>
      <vs-th sort-key="pr_worth">ارزش قرارداد</vs-th>
      <vs-th sort-key="total_price">قیمت</vs-th>
      <vs-th sort-key="contract_end_date">تاریخ ختم</vs-th>
      <vs-th sort-key="contract_date">تاریخ قرارداد</vs-th>
      <vs-th>نمظیمات</vs-th>
    </template>

    <template slot-scope="{data}">
      <tbody>
        <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
          <vs-td class="pl-2 text-center">
            {{ indextr + 1 }}
          </vs-td>
          <vs-td class="img-container">
            <router-link v-if="tr.pro_data" class="product-name font-medium truncate" :to="{
                  path: '/projects/project/${tr.id}',
                  name: 'project-edit',
                  params: { id: tr.id, dyTitle: tr.title },
                }">
              <!-- <img :src="tr.img" class="product-img" /> -->
              <p>{{ findClient(tr.pro_data.client_id) }}</p>
            </router-link>
          </vs-td>

          <vs-td>
            <div v-if="tr.pro_data">
              <router-link class="product-name font-medium truncate" :to="{
                  path: '/projects/project/${tr.id}',
                  name: 'project-edit',
                  params: { id: tr.id, dyTitle: tr.pro_data.title },
                }">
                {{ tr.pro_data.title }}</router-link>
            </div>
          </vs-td>

          <vs-td>
            <!-- <vs-progress :percent="Number(tr.popularity)" :color="getPopularityColor(Number(tr.popularity))" class="shadow-md" /> -->
            <p class="project_guarantee">{{ tr.project_guarantee }} افغانی</p>
          </vs-td>

          <vs-td>
            <p v-if="tr.pro_data" class="contract_end_date">{{ tr.pro_data.pr_worth }}</p>
          </vs-td>
          <vs-td>
            <p v-if="tr.pro_data" class="product-total_price">{{ tr.pro_data.total_total_price }} افغانی</p>
          </vs-td>
          <vs-td>
            <p class="contract_end_date">{{ tr.contract_end_date }}</p>
          </vs-td>
          <vs-td>
            <p class="contract_date">{{ tr.contract_date }}</p>
          </vs-td>

          <vs-td class="whitespace-no-wrap notupfromall">
            <feather-icon icon="PrinterIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current" class="ml-2" @click.stop="showPrintData(tr.id)" />&nbsp;&nbsp;
            <router-link class="product-name font-medium truncate" :to="{
                  path: '/projects/project/${tr.id}',
                  name: 'project-edit',
                  params: { id: tr.id, dyTitle: tr.title },
                }">
              <feather-icon icon="EditIcon" svgClasses="w-6 h-6 hover:text-primary stroke-current" />
            </router-link>
            <feather-icon icon="TrashIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(tr.id)" />
          </vs-td>
        </vs-tr>
      </tbody>
    </template>
  </vs-table>
</div>
</template>

<script>
import DataViewSidebar from "./DataViewSidebar.vue";
import {
  Form,
  HasError,
  AlertError
} from 'vform'

export default {
  name: "vx-project-list",
  data() {
    return {
      // Project Form
      pForm: new Form({
        serial_no: '',
        issue_date: '',
        issue_address: '',
        source_address: '',
        title: '',
        img: '',
        auth_number: '',
        type: '',
        total_price: '',
        duration: '',
        offer_date: '',
        close_date: '',
        offer_total_price: '',
        project_total_price: '',
        announce_id: '',
        organization_id: '',
      }),
      // End Project Form

      pr_worthFa: {
        on_hold: "درجریان",
        delivered: "تکمیل",
        canceled: "نا موفق",
      },
      selected: [],
      projects: [],
      itemsPerPage: 5,
      isMounted: false,
      addNewDataSidebar: false,
      sidebarData: {},
      clients: [],
    };
  },
  components: {
    DataViewSidebar,
  },
  created() {
    this.getProject();
    this.getAllClients();
  },
  computed: {
    currentPage() {
      if (this.isMounted) {
        return this.$refs.table.currentx;
      }
      return 0;
    },
    queriedItems() {
      return this.$refs.table ?
        this.$refs.table.queriedResults.length :
        this.projects.length;
    },
  },
  methods: {
    showPrintData(id) {
      this.popupActive = true;
    },
    findClient(id) {
      let name = '';
      Object.keys(this.clients).some(key => (this.clients[key].id == id) ? name = this.clients[key].name : null);
      return name;
    },
    // for Organs that implement the ad
    getAllClients() {
      this.axios.get('/api/clients')
        .then((response) => {
          this.clients = response.data;
          this.$Progress.set(100)
        })
    },
    getProject() {
      // Start the Progress Bar
      this.$Progress.start()

      this.pForm.get('/api/project').then((data) => {
          this.projects = data.data;
          // Finish the Progress Bar
        })
        .catch(() => {});
    },

    // Start Custom
    goTo(data) {
      this.$router
        .push({
          path: "/projects/project/${data.id}",
          name: "project-view",
          params: {
            id: data.id,
            dyTitle: data.title
          },
        })
        .catch(() => {});
    },
    goToEdit(data) {
      this.$router
        .push({
          path: "/projects/project/${data.id}/edit",
          name: "project-edit",
          params: {
            id: data.id,
            dyTitle: data.title
          },
        })
        .catch(() => {});
    },
    // End Custom
    addNewData() {
      this.sidebarData = {};
      this.toggleDataSidebar(true);
    },
    deleteData(id, title) {
      swal.fire({
        title: 'آیا  متمئن هستید؟',
        text: "پروژه حذف خواهد شد",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>نخیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.pForm.delete('/api/project/' + id).then((id) => {
              swal.fire({
                title: 'عملیه موفقانه انجام شد.',
                text: "پروژه از سیستم پاک شد!",
                icon: 'success',
              })
              this.getProject();
            })
            .catch(() => {});
        }
      })
    },
    editData(data) {
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      this.sidebarData = data;
      this.toggleDataSidebar(true);
    },
    getOrderStatusColor(pr_worth) {
      if (pr_worth === "on_hold") return "warning";
      if (pr_worth === "delivered") return "success";
      if (pr_worth === "canceled") return "danger";
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
    printProject() {
      window.print();
    }
  },
  mounted() {
    this.isMounted = false;
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
