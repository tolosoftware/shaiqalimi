<template>
<div id="data-list-thumb-view" class="w-full data-list-container">
  <vs-table class="w-full mb-6 pb-6" ref="table" :data="projects">
    <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">
      <h4 class="projectListDashboard">لست پروژه های فعال</h4>
    </div>
    <template slot="thead">
      <vs-th>نمبر</vs-th>
      <vs-th>نهاد</vs-th>
      <vs-th>قرارداد</vs-th>
      <vs-th>تضمین قرارداد</vs-th>
      <vs-th>ارزش قرارداد</vs-th>
      <vs-th>قیمت</vs-th>
      <vs-th>تاریخ ختم</vs-th>
      <vs-th>تاریخ قرارداد</vs-th>
      <!--<vs-th>تنظیمات</vs-th> -->
    </template>
    <template slot-scope="{data}">
      <tbody>
        <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
          <vs-td class="pl-2 text-center">
            {{ indextr + 1 }}
          </vs-td>
          <vs-td>
            <router-link v-if="tr.pro_data" class="font-medium truncate" :to="{
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
              <router-link class="font-medium truncate" :to="{
                  path: '/projects/project/${tr.id}',
                  name: 'project-edit',
                  params: { id: tr.id, dyTitle: tr.pro_data.title },
                }">
                {{ tr.pro_data.title }}</router-link>
            </div>
          </vs-td>

          <vs-td>
            <!-- <vs-progress :percent="Number(tr.popularity)" :color="getPopularityColor(Number(tr.popularity))" class="shadow-md" /> -->
            <p>{{ tr.project_guarantee }} افغانی</p>
          </vs-td>

          <vs-td>
            <p v-if="tr.pro_data">{{ tr.pro_data.pr_worth }}</p>
          </vs-td>
          <vs-td>
            <p v-if="tr.pro_data">{{ tr.pro_data.total_total_price }} افغانی</p>
          </vs-td>
          <vs-td>
            <p>{{ tr.contract_end_date }}</p>
          </vs-td>
          <vs-td>
            <p>{{ tr.contract_date }}</p>
          </vs-td>
          <!--
          <vs-td class="whitespace-no-wrap notupfromall">
            <router-link class="product-name font-medium truncate" :to="{
                  path: '/projects/project/${tr.id}',
                  name: 'project-edit',
                  params: { id: tr.id, dyTitle: tr.title },
                }">
              <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" />
            </router-link>
            <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(tr.id)" />
          </vs-td>-->
        </vs-tr>
      </tbody>
    </template>
  </vs-table>
  <br><br>
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
      projects: [],
      clients: [],
    };
  },
  components: {

  },
  created() {
    this.getActiveProjects();
    this.getAllClients();
  },
  computed: {

  },
  methods: {
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
        })
    },
    getActiveProjects() {
      this.$Progress.start();
      this.axios.get('/api/active-project').then((data) => {
          this.projects = data.data;
          this.$Progress.set(100)
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
        title: 'آیا مطمئن هستید؟',
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
          padding: 20px;

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
