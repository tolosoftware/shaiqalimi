<template>
<vs-sidebar click-not-close position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
  <div class="mt-6 flex items-center justify-between px-6 float-right">
    <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
  </div>
  <vs-tabs>
    <vs-tab label=" لیست گدام">
      <div id="data-list-thumb-view" class="w-full data-list-container">
        <vs-table :data="godams">
          <template slot="thead">
            <vs-th>نام گدام</vs-th>
            <vs-th>مسول</vs-th>
            <vs-th>تماس</vs-th>
            <vs-th>تماس</vs-th>
            <vs-th>بررسی</vs-th>
          </template>
          <template slot-scope="{data}">
            <vs-tr :key="indextr" v-for="(tr, indextr) in data">
              <vs-td :data="data[indextr].name">
                {{ data[indextr].name }}
              </vs-td>
              <vs-td :data="data[indextr].manager">
                {{ data[indextr].manager }}
              </vs-td>
              <vs-td :data="data[indextr].phone">
                {{ data[indextr].phone }}
              </vs-td>
              <vs-td>
                <span>
                  <vs-icon icon="visibility" size="small" color="primary"></vs-icon>
                </span>
              </vs-td>
              <vs-td class="whitespace-no-wrap notupfromall">
                <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" class="mr-2" @click.stop="editGodamData(tr)" />
                <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteGodamData(tr.id)" />
              </vs-td>
            </vs-tr>
          </template>

        </vs-table>
      </div>
    </vs-tab>
    <vs-tab label="ثبت گدام">
      <form>
        <div class="pt-1 pr-6 pl-6">
          <vs-input label="نام گدام" class="mt-3 w-full" v-model="gForm.name" />
          <has-error :form="gForm" field="name"></has-error>
          <vs-input label=" آدرس" class="mt-3 w-full" v-model="gForm.address" />
          <has-error :form="gForm" field="address"></has-error>
          <vs-input label=" مسول" class="mt-3 w-full" v-model="gForm.manager" />
          <has-error :form="gForm" field="manager"></has-error>
          <vs-input label=" تماس" class="mt-3 w-full" v-model="gForm.phone" />
          <has-error :form="gForm" field="phone"></has-error>
          <div class="vx-col mt-5">
            <vs-textarea placeholder="تفصیلات" v-model="gForm.description" />
            <has-error :form="gForm" field="description"></has-error>
          </div>
        </div>
        <div class="flex flex-wrap items-center p-6" slot="footer">
          <vs-button type="border" color="success" icon="save" class="mr-6" @click="submitGFormData"><strong>ثبت گدام</strong></vs-button>
          <vs-button type="border" color="danger" icon="close" @click="isSidebarActiveLocal = false">خارج شدن</vs-button>
        </div>
      </form>
    </vs-tab>
  </vs-tabs>

</vs-sidebar>
</template>

<script>
import vSelect from "vue-select";
export default {
  props: {
    isSidebarActive: {
      type: Boolean,
      required: true,
    },
    data: {
      type: Object,
      default: () => {},
    },
  },
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      gForm: new Form({
        name: '',
        address: '',
        manager: '',
        phone: '',
        description: ''
      }),
      godams: []
    };
  },
  watch: {},
  computed: {
    isSidebarActiveLocal: {
      get() {
        return this.isSidebarActive;
      },
      set(val) {
        if (!val) {
          this.$emit("closeSidebar");
        }
      },
    },

    scrollbarTag() {
      return this.$store.getters.scrollbarTag;
    },
  },
  created() {
    this.getGodamList();
  },
  methods: {
    submitGFormData() {
      this.gForm.post('/api/godam')
        .then(({
          data
        }) => {
          this.getGodamList();
          this.gForm.reset();
          this.$vs.notify({
            title: 'موفقیت!',
            text: 'گدام موفقانه ثبت سیستم شد.',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
          this.orgForm.reset();
        }).catch((errors) => {
          this.$Progress.set(100)
          this.$vs.notify({
            title: 'ناموفق!',
            text: 'لطفاً معلومات گدام را چک کنید و دوباره امتحان کنید!',
            color: 'danger',
            iconPack: 'feather',
            icon: 'icon-cross',
            position: 'top-right'
          })
        });

    },
    getGodamList() {
      this.$Progress.start()
      this.axios.get('/api/godam')
        .then((response) => {
          this.godams = response.data;
          this.$Progress.set(100)
        })
    },
    editGodamData() {

    },
    deleteGodamData(id) {
      swal.fire({
        title: 'آیا متمعن هستید؟',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>نخیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.orgForm.delete('/api/clients/' + id).then((id) => {
              swal.fire({
                title: 'عملیه موفقانه انجام شد.',
                icon: 'success',
              })
              this.getData();
            })
            .catch(() => {});
        }
      })

    }
  },
};
</script>

<style lang="scss" scoped>
.add-new-data-sidebar {
  ::v-deep .vs-sidebar--background {
    z-index: 52010;
  }

  ::v-deep .vs-sidebar {
    z-index: 52010;
    width: 600px;
    max-width: 90vw;

    .img-upload {
      margin-top: 2rem;

      .con-img-upload {
        padding: 0;
      }

      .con-input-upload {
        width: 100%;
        margin: 0;
      }
    }
  }
}

.scroll-area--data-list-add-new {
  // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
  height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);

  &:not(.ps) {
    overflow-y: auto;
  }
}
</style><style lang="scss">
#data-list-thumb-view {
  .vs-con-table {
    // .product-name {
    //   max-width: 23rem;
    // }

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
              height: 80px;
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
