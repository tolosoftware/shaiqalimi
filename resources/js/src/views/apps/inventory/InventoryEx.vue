<template>
  <!-- ROW 1 -->
  <div>
    <div class="vx-row">
      <div>
        <data-view-sidebar
          :isSidebarActive="addNewDataSidebar"
          @closeSidebar="toggleDataSidebar"
          :data="sidebarData"
        />
        <transfer-view-sidebar
          :isSidebarActive="transferSidebar"
          @closeSidebar="toggleTSidebar"
          :data="sidebarData"
        />
      </div>
      <!-- LINE CHART -->   <!-- <template slot="actions">
      <feather-icon icon="SettingsIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
          </template>-->
      <div class="vx-col w-full md:w-2/3 mb-base">
        <vx-card title="تغییرات در ذخایر">
          <div slot="no-body" class="p-6 pb-0">
            <div class="flex" v-if="revenueComparisonLine.analyticsData">
              <div class="mr-6">
                <p class="mb-1 font-semibold">{{$t('ThisMonth')}}</p>
                <p class="text-3xl text-success">
                  <sup class="text-base mr-1">{{$t('$')}}</sup>
                  {{ revenueComparisonLine.analyticsData.thisMonth.toLocaleString() }}
                </p>
              </div>
              <div>
                <p class="mb-1 font-semibold">{{$t('LastMonth')}}</p>
                <p class="text-3xl">
                  <sup class="text-base mr-1">{{$t('$')}}</sup>
                  {{ revenueComparisonLine.analyticsData.lastMonth.toLocaleString() }}
                </p>
              </div>
            </div>

            <vue-apex-charts
              type="line"
              height="266"
              :options="analyticsData.revenueComparisonLine.chartOptions"
              :series="revenueComparisonLine.series"
            />
          </div>
        </vx-card>
      </div>
      <!-- RADIAL CHART -->
      <div class="vx-col w-full md:w-1/3 mb-base">
        <vx-card title="ذخایر اصلی">
          <!-- <template slot="actions">
          <feather-icon icon="HelpCircleIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
          </template>-->

          <!-- CHART -->
          <template slot="no-body">
            <div class="mt-10">
              <vue-apex-charts
                v-if="goalOverviewRadialBar"
                type="radialBar"
                height="240"
                :options="goalOverviewRadialBar.chartOptions"
                :series="goalOverviewRadialBar.series"
              />
            </div>
          </template>

          <!-- DATA -->
          <div class="flex justify-between text-center mt-4" slot="no-body-bottom">
            <div
              class="w-1/2 border border-solid d-theme-border-grey-light border-r-0 border-b-0 border-l-0"
            >
              <p class="mt-4">تعداد ذخایر</p>
              <p class="mb-4 text-3xl font-semibold">{{totalStorageStations}}</p>
            </div>
            <div
              class="w-1/2 justify-center border border-solid d-theme-border-grey-light border-r-0 border-b-0"
            >
              <div class="justify-col justify-center flex ml-5 mr-5">
                <vs-button
                  icon-pack="feather"
                  icon="icon-chevrons-left"
                  icon-after
                  class="shadow-md w-full"
                  @click="toggleSidebar()"
                >بررسی</vs-button>
              </div>
            </div>
          </div>
        </vx-card>
      </div>
    </div>
    <!-- Second Row -->
    <div class="vx-row">
      <!-- Start Tank Till -->
      <div class="vx-col w-full md:w-1/3 lg:w-1/4 xl:w-1/4">
        <vx-card>
          <template slot="no-body">
            <div class="p-8 clearfix">
              <div class="mb-5">
                <h1>
                  <span>تانک های تیل</span>
                </h1>
                <small>
                  <span class="text-grey">تعداد:</span>
                  <span>298</span>
                </small>
              </div>
              <!-- <p
                class="mt-2 mb-8 text-xl font-medium"
                :class="283 >= 0 ? 'text-success' : 'text-danger'"
              >
                <span class="ml-1">ارزش: 2398 دالر</span>
              </p> -->

              <router-link class="product-name font-medium truncate" :to="{name: 'fuel-station'}">
                <vs-button
                  icon-pack="feather"
                  icon="icon-chevrons-left"
                  icon-after
                  class="shadow-md w-full"
                >بررسی</vs-button>
              </router-link>
            </div>
            <div
              class="p-8 border d-theme-border-grey-light border-solid border-r-0 border-l-0 border-b-0"
            >
              <div class="mb-4">
                <small>درآمد: ۴۳۸۷ دالر</small>
                <vs-progress :percent="23" color="success"></vs-progress>
              </div>
              <div>
                <small>مدت زمان: ۲ سال</small>
                <vs-progress :percent="48" color="warning"></vs-progress>
              </div>
            </div>
          </template>
        </vx-card>
      </div>
      <!-- End Tank Till -->
      <!-- Start Goods -->
      <div class="vx-col w-full md:w-1/3 lg:w-1/4 xl:w-1/4">
        <vx-card>
          <template slot="no-body">
            <div class="p-8 clearfix">
              <div class="mb-5">
                <h1>
                  <span>اجناس و محصولات</span>
                </h1>
                <small>
                  <span class="text-grey">تعداد:</span>
                  <span>238</span>
                </small>
              </div>
              <!--<p
                class="mt-2 mb-8 text-xl font-medium"
                :class="283 >= 0 ? 'text-success' : 'text-danger'"
              >
                <span class="ml-1">ارزش: 2398 دالر</span>
              </p> -->

              <router-link class="product-name font-medium truncate" :to="{name: 'goods'}">
                <vs-button
                  icon-pack="feather"
                  icon="icon-chevrons-left"
                  icon-after
                  class="shadow-md w-full"
                >بررسی</vs-button>
              </router-link>
            </div>
            <div
              class="p-8 border d-theme-border-grey-light border-solid border-r-0 border-l-0 border-b-0"
            >
              <div class="mb-4">
                <small>درآمد: ۴۳۸۷ دالر</small>
                <vs-progress :percent="34" color="success"></vs-progress>
              </div>
              <div>
                <small>مدت زمان: ۲ سال</small>
                <vs-progress :percent="32" color="warning"></vs-progress>
              </div>
            </div>
          </template>
        </vx-card>
      </div>
      <!-- End Goods -->
      <!-- Start Godams -->
      <div class="vx-col w-full md:w-1/3 lg:w-1/4 xl:w-1/4">
        <vx-card>
          <template slot="no-body">
            <div class="p-8 clearfix">
              <div class="mb-5">
                <h1>
                  <span>گدام‌ها</span>
                </h1>
                <small>
                  <span class="text-grey">اجناس:</span>
                  <span>3248</span>
                </small>
              </div>
              <!--<p
                class="mt-2 mb-8 text-xl font-medium"
                :class="283 >= 0 ? 'text-success' : 'text-danger'"
              >
                <span class="ml-1">ارزش: 2398 دالر</span>
              </p> -->

              <router-link class="product-name font-medium truncate" :to="{name: 'godams'}">
                <vs-button
                  icon-pack="feather"
                  icon="icon-chevrons-left"
                  icon-after
                  class="shadow-md w-full"
                >مدیریت</vs-button>
              </router-link>
            </div>
            <div
              class="p-8 border d-theme-border-grey-light border-solid border-r-0 border-l-0 border-b-0"
            >
              <div class="mb-4">
                <small>درآمد: ۴۳۸۷ دالر</small>
                <vs-progress :percent="73" color="success"></vs-progress>
              </div>
              <div>
                <small>مدت زمان: ۲ سال</small>
                <vs-progress :percent="21" color="warning"></vs-progress>
              </div>
            </div>
          </template>
        </vx-card>
      </div>
      <!-- End Godams -->
      <!-- Start Transfers -->
      <div class="vx-col w-full md:w-1/3 lg:w-1/4 xl:w-1/4">
        <vx-card>
          <template slot="no-body">
            <div class="p-8 clearfix">
              <div class="mb-5">
                <h1>
                  <span>انتقالات</span>
                </h1>
                <small>
                  <span class="text-grey">تعداد:</span>
                  <span>3248</span>
                </small>
              </div>
              <!--<p
                class="mt-2 mb-8 text-xl font-medium"
                :class="283 >= 0 ? 'text-success' : 'text-danger'"
              >
                <span class="ml-1">ارزش: 2398 دالر</span>
              </p> -->

              <vs-button
                icon-pack="feather"
                icon="icon-chevrons-left"
                icon-after
                class="shadow-md w-full"
                @click="ToggleTransfer()"
              >بررسی</vs-button>
            </div>
            <div
              class="p-8 border d-theme-border-grey-light border-solid border-r-0 border-l-0 border-b-0"
            >
              <div class="mb-4">
                <small>درآمد: ۴۳۸۷ دالر</small>
                <vs-progress :percent="73" color="success"></vs-progress>
              </div>
              <div>
                <small>مدت زمان: ۲ سال</small>
                <vs-progress :percent="21" color="warning"></vs-progress>
              </div>
            </div>
          </template>
        </vx-card>
      </div>
      <!-- End Transfers -->
    </div>
  </div>
</template>
<script>
import VueApexCharts from 'vue-apexcharts'
import DataViewSidebar from './DataViewSidebar.vue'
import TransferViewSidebar from './TransferViewSidebar.vue'
import StatisticsCardLine from '@/components/statistics-cards/StatisticsCardLine.vue'
import analyticsData from './analyticsData.js'
import ChangeTimeDurationDropdown from '@/components/ChangeTimeDurationDropdown.vue'

export default {
  name: 'vx-inventory-ex',
  data() {
    return {
      totalStorageStations:'',
      // Sidebar
      addNewDataSidebar: false,
      transferSidebar: false,
      toggleTransferSidebar: false,
      sidebarData: {},
      // End Sidebar
      sessionsData: {},
      productsOrder: {},
      customersData: {},
      salesRadar: {},
      supportTracker: {},
      revenueComparisonLine: {
        analyticsData: {
          thisMonth: 86589,
          lastMonth: 73683
        },
        series: [
          {
            name: 'ماه جاری',
            data: [45000,47000,44800,47500,45500,48000,46500,48600]
          },
          {
            name: 'ماه گذشته',
            data: [46000,48000,45500,46600,44500,46500,45000,47000]
          }
        ]
      },
      goalOverviewRadialBar: {
        chartOptions: {
          plotOptions: {
            radialBar: {
              size: 110,
              startAngle: -150,
              endAngle: 150,
              hollow: {
                size: '77%'
              },
              track: {
                background: '#bfc5cc',
                strokeWidth: '50%'
              },
              dataLabels: {
                name: {
                  show: false
                },
                value: {
                  offsetY: 18,
                  color: '#99a2ac',
                  fontSize: '4rem'
                }
              }
            }
          },
          colors: ['#00db89'],
          fill: {
            type: 'gradient',
            gradient: {
              shade: 'dark',
              type: 'horizontal',
              shadeIntensity: 0.5,
              gradientToColors: ['#00b5b5'],
              inverseColors: true,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0,100]
            }
          },
          stroke: {
            lineCap: 'round'
          },
          chart: {
            sparkline: {
              enabled: true
            },
            dropShadow: {
              enabled: true,
              blur: 3,
              left: 1,
              top: 1,
              opacity: 0.1
            }
          }
        },
        series: [83]
      },

      salesBarSession: {},
      sessionDataTime: 'lastWeek',
      todoToday: {},

      salesLine: {},
      funding: {},

      browserStatistics: [],
      clientRetentionBar: {},

      analyticsData
    }
  },
  components: {
    VueApexCharts,
    StatisticsCardLine,
    ChangeTimeDurationDropdown,
    DataViewSidebar,
    TransferViewSidebar
  },
  created() {
    this.totalStorageStation();
  },
  methods: {
    totalStorageStation(){
        this.$vs.loading()
      this.$Progress.start();
        this.axios.get('/api/totalstorage')
        .then((response) => {
          // this.totalStorageStations = response.data;
          // console.log('all',this.totalStorageStations);
          // this.$vs.loading.close();
          this.totalStorageStations=response.data;
          this.$Progress.set(100)
          this.$vs.loading.close();
        })
    },
    ToggleTransfer() {
      this.sidebarData = {}
      this.toggleTSidebar(true)
    },
    toggleSidebar() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val
    },
    toggleTSidebar(val = false) {
      this.transferSidebar = val
    }
  },
  
}
</script>


<style lang="scss">
#demo-card-analytics {
  .tasks-today-container {
    .tasks-today__task {
      transition: background 0.15s ease-out;
      .tasks-today__actions {
        display: none;
      }

      &:hover {
        background: rgba(var(--vs-primary), 0.04);
        .tasks-today__actions {
          display: flex;
        }
      }
    }
  }
}
</style>
