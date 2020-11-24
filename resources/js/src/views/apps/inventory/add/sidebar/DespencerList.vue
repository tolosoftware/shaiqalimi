<template>
  <div id="data-list-thumb-view" class="w-full data-list-container">
    <vs-table
      class="w-full"
      ref="table"
      pagination
      :max-items="itemsPerPage"
      :data="products"
    >
      <template slot="thead">
        <vs-th sort-key="name">نام</vs-th>
        <vs-th sort-key="category">ظرقیت</vs-th>
        <vs-th sort-key="order_status">وضعیت</vs-th>
        <vs-th sort-key="price">فروش</vs-th>
        <vs-th>بررسی</vs-th>
      </template>

      <template slot-scope="{data}">
        <tbody>
          <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
            <vs-td>
              <div @click="goTo(tr)">
                <router-link
                  class="product-name font-medium truncate"
                  :to="{
                      path: '/projects/project/${tr.id}',
                      name: 'دسپنسر -view',
                      params: { id: tr.id, dyTitle: tr.name },
                    }"
                >{{ tr.name }}</router-link>
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
              <p class="product-price">{{ tr.price }} دالر</p>
            </vs-td>

            <vs-td class="whitespace-no-wrap notupfromall">
              <feather-icon
                icon="EditIcon"
                svgClasses="w-5 h-5 hover:text-primary stroke-current"
                @click="$router.push({
                  name: 'دسپنسر -profile-edit', 
                  params: {user_id: tr.id }}).catch(() => {})"
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
</template>

<script>
export default {
  name: 'دسپنسر -project-list',
  data() {
    return {
      statusFa: {
        on_hold: 'مدیر',
        delivered: 'ادمین',
        canceled: 'سوپروایزر',
      },
      selected: [],
      // products: [],
      itemsPerPage: 4,
      isMounted: false,
      addNewDataSidebar: false,
      sidebarData: {},
    }
  },
  components: {
  },
  created() {

  },
  computed: {
    currentPage() {
      if (this.isMounted) {
        return this.$refs.table.currentx
      }
      return 0
    },
    products() {
      return [
        {
          id: 4,
          category: "4398",
          img: require("@assets/images/profile/user-uploads/user-01.jpg"),
          name: 'دسپنسر A',
          order_status: "delivered",
          popularity: 65,
          price: 199.99
        },

        {
          id: 5,
          category: "4398",
          img: require("@assets/images/profile/user-uploads/user-02.jpg"),
          name: 'دسپنسر B',
          order_status: "canceled",
          popularity: 87,
          price: 199.99
        },
        {
          id: 6,
          category: "4398",
          img: require("@assets/images/profile/user-uploads/user-03.jpg"),
          name: 'دسپنسر C',
          order_status: "canceled",
          popularity: 55,
          price: 39.99
        },
        {
          id: 7,
          category: "4398",
          img: require("@assets/images/profile/user-uploads/user-04.jpg"),
          name: 'دسپنسر ',
          order_status: "on_hold",
          popularity: 99,
          price: 39.99
        },
      ]
    },
    queriedItems() {
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.products.length
    }
  },
  methods: {
    // Start Custom
    goTo(data) {
      this.$router.push({
        path: '/projects/project/${data.id}',
        name: 'دسپنسر -view',
        params: {id: data.id,dyTitle: data.name},
      }).catch(() => {})
    },
    viewProject(id) {
      // Vue.$forceUpdate();
      this.$router.push('/projects/project/' + id).catch(() => {})
    },
    // End Custom
    addNewData() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    deleteData(id) {
      this.$store.dispatch('dataList/removeItem',id).catch(err => {console.error(err)})
    },
    editData(data) {
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      this.sidebarData = data
      this.toggleDataSidebar(true)
    },
    getOrderStatusColor(status) {
      if (status === 'on_hold') return 'warning'
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
  },
  mounted() {
    this.isMounted = true
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
