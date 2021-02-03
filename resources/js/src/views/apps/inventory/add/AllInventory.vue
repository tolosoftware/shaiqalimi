<template>
<div id="all-inventory">
  <div :key="$vs.rtl" v-if="storageActiveForm">
    <form>
      <vs-divider>
        <h4>
          ویرایش معلومات ذخیره
        </h4>
      </vs-divider>
      <div class="pt-1 pr-6 pl-6">
        <vs-input label="نام ذخیره" class="mt-3 w-full" v-model="sFormEdit.name" />
        <has-error :form="sFormEdit" field="name"></has-error>
        <vs-input label=" آدرس" class="mt-3 w-full" v-model="sFormEdit.address" />
        <has-error :form="sFormEdit" field="address"></has-error>
        <vs-input label=" مسول" class="mt-3 w-full" v-model="sFormEdit.manager" />
        <has-error :form="sFormEdit" field="manager"></has-error>
        <vs-input label=" تماس" class="mt-3 w-full" v-model="sFormEdit.phone" />
        <has-error :form="sFormEdit" field="phone"></has-error>
        <div class="vx-col mt-5">
          <vs-textarea label="تفصیلات" v-model="sFormEdit.capacity" />
          <has-error :form="sFormEdit" field="capacity"></has-error>
        </div>
      </div>
      <div class="flex flex-wrap items-center p-6" slot="footer">
        <vs-button type="border" color="success" icon="save" class="mr-6" @click="updateStorageData()"><strong>ویرایش ذخیره</strong></vs-button>
        <vs-button type="border" icon="close" color="danger" @click="resetAllState()">بستن فورم ویرایش</vs-button>
        <vs-divider>---</vs-divider>
      </div>
    </form>
  </div>
  <div id="data-list-thumb-view" class="w-full data-list-container">
    <div v-if="!isdata">
      <TableLoading></TableLoading>
    </div>
    <vs-table v-if="isdata" :data="storages">
      <template slot="thead">
        <vs-th>کود</vs-th>
        <vs-th>نام ذخیره</vs-th>
        <vs-th>مسول</vs-th>
        <vs-th>بررسی</vs-th>
      </template>
      <template slot-scope="{data}">
        <vs-tr :key="indextr" v-for="(tr, indextr) in data">
          <vs-td>
            <span class="cursor-pointer" @click.stop="showStorageData(tr.id)">{{++indextr}}</span>
          </vs-td>
          <vs-td>
            <span v-text="tr.name" class="cursor-pointer" @click.stop="showStorageData(tr.id)"></span>
          </vs-td>
          <vs-td>
            <span v-text="tr.manager" class="cursor-pointer" @click.stop="showStorageData(tr.id)"></span>
          </vs-td>
          <!--<vs-td>
            <span v-text="tr.phone"></span>
          </vs-td>-->

          <vs-td class="whitespace-no-wrap notupfromall">
            <feather-icon icon="MoreVerticalIcon" svgClasses="w-6 h-6 hover:text-primary stroke-current" class="mr-2 cursor-pointer" @click.stop="showStorageData(tr.id)" />
            <feather-icon icon="EditIcon" svgClasses="w-6 h-6 hover:text-primary stroke-current" class="mr-2 cursor-pointer" @click.stop="editStorageData(tr)" />
            <feather-icon icon="TrashIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current" class="ml-2 cursor-pointer" @click.stop="deleteStorageData(tr.id)" />
          </vs-td>
        </vs-tr>
      </template>
    </vs-table>
    <vs-popup class="holamundo" title="جزییات معلومات ذخیره" :active.sync="popupActive">
      <div :key="indextr" v-for="(tr, indextr) in storageSingleRowData">
        <div class="con-expand-clients w-full">
          <div class="con-btns-client flex items-center justify-between">
            <div class="con-clientx flex items-center justify-start">
            </div>
            </vs-divider>
            <div class="flex">
            </div>
          </div>
          <vs-list>
            <vs-list-item icon-pack="feather" icon="icon-home" :title="tr.name"></vs-list-item>
            <vs-list-item icon-pack="feather" icon="icon-user" :title="tr.manager"></vs-list-item>
            <vs-list-item icon-pack="feather" icon="icon-phone" :title="tr.phone"></vs-list-item>
            <vs-list-item icon-pack="feather" icon="icon-map-pin" :title="tr.address"></vs-list-item>
            <vs-list-item icon-pack="feather" icon="icon-clipboard" :title="tr.capacity"></vs-list-item>
          </vs-list>
        </div>
      </div>
    </vs-popup>
  </div>
  <!-- PRODUCT ORDERS 
    <div class="vx-col w-full mb-base">
        <vx-card title="توزیع ذخایر" class="no-shadow"> 
             CHART -->
  <!--  <div slot="no-body">
                <vue-apex-charts type="radialBar" height="350" :options="radialBarChart.chartOptions" :series="radialBarChart.series"></vue-apex-charts>
            </div> 
             End CHART DATA -->
  <!-- List Of Items 
            <vs-collapse>
                <vs-collapse-item>
                    <div slot="header">ذخیره احمدیار</div>
                    مطابق به احکام قانون اشخاص ازعواید که بابت فعالیت های اقتصادی از قبیل عرضه اجناس و خدمات تحصیل میدارند مکلف به
                    پرداخت مالیات میباشند. درفعالیت کمیشن کاری اشخاص صرف مقدار پول را که به منظور فراهم نمودن تسهیالت یا خدمات فروش
                    به عنوان کمیشن بدست میآورند عواید تابع مالیه وی را تشکیل نمودهو مکلف است ازآن مطابق به احکام قانون مالیه بپردازد.
                    بنابر توضیحات فوق آنعده از تانکهای که تیل سایر اشخاص را طور کمیشن بفروش میرساند، صرف از عواید کمیشن فروش منحیث
                    یک شخص حقیقی تابع مالیه میباشند.
                    برای اینکه برطبق این میتود مالیه بشکل درست سنجش شده بتواند، براساس حکم فقره )7 )ماده هشتادوهفتم قانون مالیات برعایدات
                    عواید تانکهای تیل که بشکل کمیشن فعالیت دارند طور ذیل تعیین میگردد.
                </vs-collapse-item>

                <vs-collapse-item>
                    <div slot="header">ذخیره یاران</div>
                    مثال8 :هرگاه تانک تیل در طی سال مالی به مقدار )000,500,1 )لیتر تیل یا گاز LPG بفروش برسد، در هرلیتر)7.6 )افغانی آن عواید
                    کمیشن بوده واز آن )70 )%مفاد خالص در نظرگرفته شده، مالیه آن قرارذیل ذیل صورت میگیرد:
                </vs-collapse-item>

                <vs-collapse-item>
                    <div slot="header">ذخیره مکرویان</div>
                    طرزالعمل تحصیل مالیه ازتانکهای تیل باتفکیک شخصیت حقوقی و نحوفعالیت آن ترتیب شده است، این طرزالعمل باالی تمامی
                    تانکهای تیل که مصروف فروش انواع تیل یا گازLPG میباشد به تفکیک مقدار وقیمت فروش یکسان تطبیق میگردد.
                    تمامی ادارات مالیاتی مطابق به احکام قانون مکلف به تطبیق این طرزالعمل میباشد.
                </vs-collapse-item>

                <vs-collapse-item>
                    <div slot="header">ذخیره ارغنداب</div>
                    این طرزالعمل از تاریخ منظوری نافذ میباشد، آنعده تانکهای تیل که مالیه سال های مالی 83۳7 و 83۳7 خویش را نیز نپرداخته باشد
                    مطابق این طرزالعمل سنجش و تحصیل گردد. با تطبیق این طرزالعمل، طرزالعمل های قبلی که در زمینه صادر شده است ملغی میباشد.
                </vs-collapse-item>
            </vs-collapse>
            End of project lists
        </vx-card>
    </div> -->
</div>
</template>

<script>
// import VueApexCharts from 'vue-apexcharts'
// import analyticsData from '../analyticsData.js'
import TableLoading from './../../shared/TableLoading.vue'
export default {
  name: 'vx-archive',
  data() {
    return {
      isdata: false,
      storageActiveForm: false,
      popupActive: false,
      sForm: new Form({
        code: '',
        name: '',
        manager: '',
        phone: '',
        address: '',
        capacity: ''
      }),
      sFormEdit: new Form({
        code: '',
        name: '',
        manager: '',
        phone: '',
        address: '',
        capacity: ''
      }),
      storages: [],
      storageSingleRowData: [],
      //   settings: {
      //     maxScrollbarLength: 60,
      //     wheelSpeed: .60
      //   },
      //   radialBarChart: {
      //     analyticsData: [{
      //         'orderType': 'Finished',
      //         'counts': 23043,
      //         color: 'primary'
      //       },
      //       {
      //         'orderType': 'Pending',
      //         'counts': 14658,
      //         color: 'warning'
      //       },
      //       {
      //         'orderType': 'Rejected ',
      //         'counts': 4758,
      //         color: 'danger'
      //       },
      //     ],
      //     series: [70, 52, 26],
      //     chartOptions: {
      //       labels: ['A', 'B', 'C'],

      //       plotOptions: {
      //         radialBar: {
      //           size: 165,
      //           offsetY: -5,
      //           hollow: {
      //             size: '20%'
      //           },
      //           track: {
      //             background: '#ebebeb',
      //             strokeWidth: '100%',
      //             margin: 15
      //           },
      //           dataLabels: {
      //             show: true,
      //             name: {
      //               fontSize: '18px'
      //             },
      //             value: {
      //               fontSize: '16px',
      //               color: '#636a71',
      //               offsetY: 11
      //             },
      //             total: {
      //               show: true,
      //               label: 'Total',
      //               formatter() {
      //                 return 42459
      //               }
      //             }
      //           }
      //         }
      //       },
      //       responsive: [{
      //         breakpoint: 576,
      //         options: {
      //           plotOptions: {
      //             radialBar: {
      //               size: 150,
      //               hollow: {
      //                 size: '20%'
      //               },
      //               track: {
      //                 background: '#ebebeb',
      //                 strokeWidth: '100%',
      //                 margin: 15
      //               }
      //             }
      //           }
      //         }
      //       }],
      //       colors: ['#7961F9', '#FF9F43', '#EA5455'],
      //       fill: {
      //         type: 'gradient',
      //         gradient: {
      //           // enabled: true,
      //           shade: 'dark',
      //           type: 'vertical',
      //           shadeIntensity: 0.5,
      //           gradientToColors: ['#9c8cfc', '#FFC085', '#f29292'],
      //           inverseColors: false,
      //           opacityFrom: 1,
      //           opacityTo: 1,
      //           stops: [0, 100]
      //         }
      //       },
      //       stroke: {
      //         lineCap: 'round'
      //       },
      //       chart: {
      //         height: 355,
      //         dropShadow: {
      //           enabled: true,
      //           blur: 3,
      //           left: 1,
      //           top: 1,
      //           opacity: 0.1
      //         }
      //       }
      //     }
      //   }
    }
  },
  created() {
    // 
    this.getStorageList();

  },
  components: {
    // VueApexCharts,
    TableLoading
  },
  methods: {
    getStorageList() {
      this.axios.get('/api/storage')
        .then((response) => {
          this.isdata = true;
          this.storages = response.data;

        })
    },
    editStorageData(data) {
      this.storageActiveForm = true;
      this.sFormEdit.name = data.name;
      this.sFormEdit.address = data.address;
      this.sFormEdit.manager = data.manager;
      this.sFormEdit.phone = data.phone;
      this.sFormEdit.capacity = data.capacity;
      this.sFormEdit.id = data.id;
    },
    showStorageData(id) {
      this.storageActiveForm = false;
      this.$Progress.start()
      this.sForm.get('/api/storage/' + id)
        .then((response) => {
          this.storageSingleRowData = response.data;
          this.$Progress.set(100)
          this.popupActive = true;
        })
    },
    resetAllState() {
      this.storageActiveForm = false
      this.sFormEdit.reset();
    },
    updateStorageData() {
      this.sFormEdit.put('/api/storage/' + this.sFormEdit.id)
        .then(({
          data
        }) => {
          // Finish the Progress Bar
          this.getStorageList();
          this.resetAllState();
          // toast notification
          this.$vs.notify({
            title: 'موفقیت!',
            text: 'موسسه مذکور موفقانه آپدیت شد.',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        });
    },
    deleteStorageData(id) {
      this.storageActiveForm = false;
      swal.fire({
        title: 'آیا مطمیٔن هستید؟',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>خیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.sForm.delete('/api/storage/' + id).then((id) => {
              swal.fire({
                title: 'عملیه موفقانه انجام شد.',
                text: "ذخیره از سیستم پاک شد!",
                icon: 'success',
              })
              this.getStorageList();
              this.resetAllState();
            })
            .catch(() => {});
        }
      })

    }
  },
  mounted() {
    this.isMounted = false
  },
}
</script>

<style lang="scss">
#all-inventory .con-tab.vs-tabs--content {
  max-height: 90vh !important;
  overflow-y: scroll !important;
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
      padding: 0 0.6rem;

      tr {
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.05);

        td {
          padding: 10px !important;

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
              height: 70px;
              padding-left: 10px;
            }
          }
        }

        td.td-check {
          padding: 10px !important;
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
