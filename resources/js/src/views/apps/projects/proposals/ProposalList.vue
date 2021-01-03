<template>
<div id="data-list-thumb-view" class="w-full data-list-container">
  <vs-table class="w-full" ref="table" pagination :max-items="itemsPerPage" search :data="proposals">
    <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between" id="proposalTable">
      <!-- ITEMS PER PAGE -->
      <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4">
        <div class="pl-4 pr-4 pt-1 pb-1 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
          <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ proposals.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : proposals.length }} از {{ queriedItems }}</span>
          <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
        </div>
        <vs-dropdown-menu>
          <vs-dropdown-item @click="itemsPerPage=4">
            <span>۴</span>
          </vs-dropdown-item>
          <vs-dropdown-item @click="itemsPerPage=10">
            <span>۱۰</span>
          </vs-dropdown-item>
          <vs-dropdown-item @click="itemsPerPage=15">
            <span>۱۵</span>
          </vs-dropdown-item>
          <vs-dropdown-item @click="itemsPerPage=20">
            <span>۲۰</span>
          </vs-dropdown-item>
        </vs-dropdown-menu>
      </vs-dropdown>
    </div>
    <template slot="thead">
      <vs-th>نمبر</vs-th>
      <vs-th>نهاد</vs-th>
      <vs-th sort-key="name">پروژه</vs-th>
      <vs-th sort-key="offer_guarantee">تضمین آفر</vs-th>
      <vs-th sort-key="status">وضعیت</vs-th>
      <vs-th sort-key="price">قیمت</vs-th>
      <vs-th sort-key="bidding_address">آدرس</vs-th>
      <vs-th sort-key="bidding_date">تاریخ پیشنهاد</vs-th>
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
                  path: '/projects/proposal/${tr.id}',
                  name: 'proposal-edit',
                  params: { id: tr.id, dyTitle: tr.title },
                }">
              <!-- <img :src="tr.img" class="product-img" /> -->
              <p>{{ findClient(tr.pro_data.client_id) }}</p>

            </router-link>
          </vs-td>

          <vs-td>
            <div v-if="tr.pro_data">
              <router-link class="product-name font-medium truncate" :to="{
                  path: '/projects/proposal/${tr.id}',
                  name: 'proposal-edit',
                  params: { id: tr.id, dyTitle: tr.title },
                }">
                {{ tr.pro_data.title }}</router-link>
            </div>
          </vs-td>

          <vs-td>
            <!-- <vs-progress :percent="Number(tr.popularity)" :color="getPopularityColor(Number(tr.popularity))" class="shadow-md" /> -->
            <p class="offer_guarantee">{{ tr.offer_guarantee }} افغانی</p>
          </vs-td>

          <vs-td>
            <vs-chip :color="getOrderStatusColor(tr.status)" class="product-order-status">{{ statusFa[tr.status] }}</vs-chip>
          </vs-td>

          <vs-td>
            <p v-if="tr.pro_data" class="product-price">{{ tr.pro_data.total_price }} افغانی</p>
          </vs-td>
          <vs-td>
            <p class="bidding_address">{{ tr.bidding_address }}</p>
          </vs-td>
          <vs-td>
            <p class="bidding_date">{{ tr.bidding_date }}</p>
          </vs-td>

          <vs-td class="whitespace-no-wrap notupfromall">
            <router-link class="product-name font-medium truncate" :to="{
                  path: '/projects/proposal/${tr.id}',
                  name: 'proposal-edit',
                  params: { id: tr.id, dyTitle: tr.title },
                }">
              <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" />
            </router-link>
            <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(tr.id)" />
          </vs-td>
        </vs-tr>
      </tbody>
    </template>
  </vs-table>

  <vs-collapse accordion>
    <vs-collapse-item>
      <div slot="header">
        نمایش حالت چاپ
      </div>
      <vs-button size="small" type="gradient" icon="print" id="printBTN" @click="printProposal">چاپ</vs-button>
      <vue-easy-print tableShow ref="easyPrint">
        <vs-table class="w-full" ref="table" :data="proposals">
          <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between" id="proposalTable">
          </div>
          <template slot="thead">
            <vs-th>نمبر</vs-th>
            <vs-th>نهاد</vs-th>
            <vs-th>پروژه</vs-th>
            <vs-th>تضمین آفر</vs-th>
            <vs-th>وضعیت</vs-th>
            <vs-th>قیمت</vs-th>
            <vs-th>آدرس</vs-th>
            <vs-th>تاریخ پیشنهاد</vs-th>
          </template>
          <template slot-scope="{data}">
            <tbody>
              <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                <vs-td class="pl-2 text-center">
                  {{ indextr + 1 }}
                </vs-td>
                <vs-td class="img-container">
                  <router-link v-if="tr.pro_data" class="product-name font-medium truncate" :to="{
                  path: '/projects/proposal/${tr.id}',
                  name: 'proposal-edit',
                  params: { id: tr.id, dyTitle: tr.title },
                }">
                    <!-- <img :src="tr.img" class="product-img" /> -->
                    <p>{{ findClient(tr.pro_data.client_id) }}</p>

                  </router-link>
                </vs-td>

                <vs-td>
                  <div v-if="tr.pro_data">
                    <router-link class="product-name font-medium truncate" :to="{
                  path: '/projects/proposal/${tr.id}',
                  name: 'proposal-edit',
                  params: { id: tr.id, dyTitle: tr.title },
                }">
                      {{ tr.pro_data.title }}</router-link>
                  </div>
                </vs-td>

                <vs-td>
                  <!-- <vs-progress :percent="Number(tr.popularity)" :color="getPopularityColor(Number(tr.popularity))" class="shadow-md" /> -->
                  <p>{{ tr.offer_guarantee }} افغانی</p>
                </vs-td>

                <vs-td>
                  <vs-chip :color="getOrderStatusColor(tr.status)">{{ statusFa[tr.status] }}</vs-chip>
                </vs-td>

                <vs-td>
                  <p v-if="tr.pro_data">{{ tr.pro_data.total_price }} افغانی</p>
                </vs-td>
                <vs-td>
                  <p>{{ tr.bidding_address }}</p>
                </vs-td>
                <vs-td>
                  <p>{{ tr.bidding_date }}</p>
                </vs-td>
              </vs-tr>
            </tbody>
          </template>
        </vs-table>
      </vue-easy-print>
    </vs-collapse-item>
  </vs-collapse>
</div>
</template>

<script>
import DataViewSidebar from './../DataViewSidebar.vue'
import moduleDataList from './../data-list/moduleDataList.js'
import vueEasyPrint from "vue-easy-print";

export default {
  name: 'vx-project-list',
  data() {
    return {
      statusFa: {
        normal: 'درجریان',
        delivered: 'تکمیل',
        canceled: 'نا موفق',
        income: 'تاخیر'
      },
      selected: [],
      proposals: [],
      itemsPerPage: 4,
      isMounted: false,
      addNewDataSidebar: false,
      sidebarData: {},
      clients: [],
    }
  },
  components: {
    DataViewSidebar,
    vueEasyPrint
  },
  created() {
    this.getProposals();
    this.getAllClients();
  },
  computed: {
    currentPage() {
      if (this.isMounted) {
        return this.$refs.table.currentx
      }
      return 1
    },
    queriedItems() {
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.proposals.length
    }
  },
  methods: {
    getAllClients() {
      this.axios.get('/api/clients')
        .then((response) => {
          this.clients = response.data;
        })
    },
    findClient(id) {
      let name = '';
      Object.keys(this.clients).some(key => (this.clients[key].id == id) ? name = this.clients[key].name : null);
      return name;
    },
    getProposals() {
      this.$Progress.start()
      this.axios.get('/api/proposal')
        .then((response) => {
          this.proposals = response.data;
          this.$Progress.set(100)
        })
    },
    // Start Custom
    goTo(data) {
      this.$router.push({
        path: '/projects/project/${data.id}',
        name: 'project-view',
        params: {
          id: data.id,
          dyTitle: data.name
        },
      }).catch(() => {})
    },
    // End Custom
    addNewData() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    deleteData(id) {
      swal.fire({
        title: 'آیا  متمئن هستید؟',
        text: "پیشنهاد حذف خواهد شد",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>نخیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.axios.delete('/api/proposal/' + id).then((id) => {
              swal.fire({
                title: 'عملیه موفقانه انجام شد.',
                text: "پیشنهاد از سیستم پاک شد!",
                icon: 'success',
              })
              this.getProposals();
            })
            .catch(() => {});
        }
      })
    },
    editData(data) {
      console.log(data);
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      // this.sidebarData = data
      // this.toggleDataSidebar(true)
    },
    getOrderStatusColor(status) {
      if (status === 'normal') return 'warning'
      if (status === 'delivered') return 'success'
      if (status === 'canceled') return 'danger'
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
    printProposal() {
      // this.$htmlToPaper('proposalTable');
      this.$refs.easyPrint.print()
    },
  },
  mounted() {
    this.isMounted = false
  }
}
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
