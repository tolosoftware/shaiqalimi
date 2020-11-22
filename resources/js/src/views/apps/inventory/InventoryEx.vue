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
      <!-- LINE CHART -->
      <div class="vx-col w-full md:w-2/3 mb-base">
        <vx-card title="تغییرات در ذخایر">
          <!-- <template slot="actions">
      <feather-icon icon="SettingsIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
          </template>-->

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
                type="radialBar"
                height="240"
                :options="analyticsData.goalOverviewRadialBar.chartOptions"
                :series="goalOverview.series"
              />
            </div>
          </template>

          <!-- DATA -->
          <div
            v-if="goalOverview.analyticsData"
            class="flex justify-between text-center mt-4"
            slot="no-body-bottom"
          >
            <div
              class="w-1/2 border border-solid d-theme-border-grey-light border-r-0 border-b-0 border-l-0"
            >
              <p class="mt-4">تعداد ذخایر</p>
              <p
                class="mb-4 text-3xl font-semibold"
              >{{ goalOverview.analyticsData.completed.toLocaleString() }}</p>
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
          <template slot="no-body" v-if="Object.entries(funding).length">
            <div class="p-8 clearfix">
              <div class="mb-5">
                <h1>
                  <span>تانک های تیل</span>
                </h1>
                <small>
                  <span class="text-grey">تعداد:</span>
                  <span>{{ funding.depostis.toLocaleString() }}</span>
                </small>
              </div>
              <p
                class="mt-2 mb-8 text-xl font-medium"
                :class="283 >= 0 ? 'text-success' : 'text-danger'"
              >
                <span class="ml-1">ارزش: 2398 دالر</span>
              </p>

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
                <vs-progress :percent="funding.meta.earned.progress" color="success"></vs-progress>
              </div>
              <div>
                <small>مدت زمان: ۲ سال</small>
                <vs-progress :percent="funding.meta.duration.progress" color="warning"></vs-progress>
              </div>
            </div>
          </template>
        </vx-card>
      </div>
      <!-- End Tank Till -->
      <!-- Start Goods -->
      <div class="vx-col w-full md:w-1/3 lg:w-1/4 xl:w-1/4">
        <vx-card>
          <template slot="no-body" v-if="Object.entries(funding).length">
            <div class="p-8 clearfix">
              <div class="mb-5">
                <h1>
                  <span>اجناس و محصولات</span>
                </h1>
                <small>
                  <span class="text-grey">تعداد:</span>
                  <span>{{ funding.depostis.toLocaleString() }}</span>
                </small>
              </div>
              <p
                class="mt-2 mb-8 text-xl font-medium"
                :class="283 >= 0 ? 'text-success' : 'text-danger'"
              >
                <span class="ml-1">ارزش: 2398 دالر</span>
              </p>

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
                <vs-progress :percent="funding.meta.earned.progress" color="success"></vs-progress>
              </div>
              <div>
                <small>مدت زمان: ۲ سال</small>
                <vs-progress :percent="funding.meta.duration.progress" color="warning"></vs-progress>
              </div>
            </div>
          </template>
        </vx-card>
      </div>
      <!-- End Goods -->
      <!-- Start Godams -->
      <div class="vx-col w-full md:w-1/3 lg:w-1/4 xl:w-1/4">
        <vx-card>
          <template slot="no-body" v-if="Object.entries(funding).length">
            <div class="p-8 clearfix">
              <div class="mb-5">
                <h1>
                  <span>گدام‌ها</span>
                </h1>
                <small>
                  <span class="text-grey">اجناس:</span>
                  <span>{{ funding.depostis.toLocaleString() }}</span>
                </small>
              </div>
              <p
                class="mt-2 mb-8 text-xl font-medium"
                :class="283 >= 0 ? 'text-success' : 'text-danger'"
              >
                <span class="ml-1">ارزش: 2398 دالر</span>
              </p>

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
                <vs-progress :percent="funding.meta.earned.progress" color="success"></vs-progress>
              </div>
              <div>
                <small>مدت زمان: ۲ سال</small>
                <vs-progress :percent="funding.meta.duration.progress" color="warning"></vs-progress>
              </div>
            </div>
          </template>
        </vx-card>
      </div>
      <!-- End Godams -->
      <!-- Start Transfers -->
      <div class="vx-col w-full md:w-1/3 lg:w-1/4 xl:w-1/4">
        <vx-card>
          <template slot="no-body" v-if="Object.entries(funding).length">
            <div class="p-8 clearfix">
              <div class="mb-5">
                <h1>
                  <span>انتقالات</span>
                </h1>
                <small>
                  <span class="text-grey">تعداد:</span>
                  <span>{{ funding.depostis.toLocaleString() }}</span>
                </small>
              </div>
              <p
                class="mt-2 mb-8 text-xl font-medium"
                :class="283 >= 0 ? 'text-success' : 'text-danger'"
              >
                <span class="ml-1">ارزش: 2398 دالر</span>
              </p>

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
                <vs-progress :percent="funding.meta.earned.progress" color="success"></vs-progress>
              </div>
              <div>
                <small>مدت زمان: ۲ سال</small>
                <vs-progress :percent="funding.meta.duration.progress" color="warning"></vs-progress>
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

      revenueComparisonLine: {},
      goalOverview: {},

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
  methods: {
    ToggleTransfer(){
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
  created() {
    // Sessions By Device
    this.$http.get('/api/card/card-analytics/session-by-device')
      .then((response) => {this.sessionsData = response.data})
      .catch((error) => {console.log(error)})

    // Products Order
    this.$http.get('/api/card/card-analytics/products-orders')
      .then((response) => {this.productsOrder = response.data})
      .catch((error) => {console.log(error)})

    // Customers
    this.$http.get('/api/card/card-analytics/customers')
      .then((response) => {this.customersData = response.data})
      .catch((error) => {console.log(error)})

    // Sales Radar
    this.$http.get('/api/card/card-analytics/sales/radar')
      .then((response) => {this.salesRadar = response.data})
      .catch((error) => {console.log(error)})

    // Support Tracker
    this.$http.get('/api/card/card-analytics/support-tracker')
      .then((response) => {this.supportTracker = response.data})
      .catch((error) => {console.log(error)})

    // Revenue Comparison
    this.$http.get('/api/card/card-analytics/revenue-comparison')
      .then((response) => {this.revenueComparisonLine = response.data})
      .catch((error) => {console.log(error)})

    // Goal Overview
    this.$http.get('/api/card/card-analytics/goal-overview')
      .then((response) => {this.goalOverview = response.data})
      .catch((error) => {console.log(error)})

    // Sales bar
    this.$http.get('/api/card/card-analytics/sales/bar')
      .then((response) => {this.salesBarSession = response.data})
      .catch((error) => {console.log(error)})

    // Todo
    this.$http.get('/api/card/card-analytics/todo/today')
      .then((response) => {this.todoToday = response.data})
      .catch((error) => {console.log(error)})

    // Funding
    this.$http.get('/api/card/card-analytics/funding')
      .then((response) => {this.funding = response.data})
      .catch((error) => {console.log(error)})

    // Sales line
    this.$http.get('/api/card/card-analytics/sales/line')
      .then((response) => {this.salesLine = response.data})
      .catch((error) => {console.log(error)})

    // Browser Analytics
    this.$http.get('/api/card/card-analytics/browser-analytics')
      .then((response) => {this.browserStatistics = response.data})
      .catch((error) => {console.log(error)})

    // Client Retention
    this.$http.get('/api/card/card-analytics/client-retention')
      .then((response) => {this.clientRetentionBar = response.data})
      .catch((error) => {console.log(error)})
  }
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
