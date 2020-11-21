<template>
  <div class="vx-row">
    <div class="vx-col w-full md:w-1/2 mb-base">
        <vx-card>
            <div class="vx-row flex-col-reverse lg:flex-row">

                <!-- LEFT COL -->
                <div class="vx-col w-full lg:w-1/2 xl:w-1/2 flex flex-col justify-between" v-if="salesBarSession.analyticsData">
                    <div>
                        <!-- Avg Session -->
                        <h2 class="mb-1 font-bold ">اعلانات</h2>
                    </div>
                    <router-link to="advertisment">
                      <vs-button icon-pack="feather" icon="icon-chevrons-left" icon-after class="shadow-md w-full lg:mt-0 mt-4">ثبت اعلان جدید</vs-button>
                    </router-link>
                </div>

                <!-- RIGHT COL -->
                <div class="vx-col w-full lg:w-1/2 xl:w-1/2 flex flex-col lg:mb-0 mb-base">
                    <change-time-duration-dropdown class="self-end" />
                    <vue-apex-charts
                      type="bar"
                      height="200"
                      :options="analyticsData.salesBar.chartOptions"
                      :series="salesBarSession.series"
                      v-if="salesBarSession.series" />
                </div>
            </div>
            <vs-divider class="my-6"></vs-divider>
            <div class="vx-row">
                <div class="vx-col w-1/2 mb-3">
                    <small>همه اعلانات: ۳۲۷</small>
                    <vs-progress class="block mt-1" :percent="50" color="primary"></vs-progress>
                </div>
                <div class="vx-col w-1/2 mb-3">
                    <small>علانات موجود: ۷۳</small>
                    <vs-progress class="block mt-1" :percent="90" color="success"></vs-progress>
                </div>
                <div class="vx-col w-1/2 mb-3">
                    <small>اعلانات جدید: ۱۰۰</small>
                    <vs-progress class="block mt-1" :percent="60" color="warning"></vs-progress>
                </div>
                <div class="vx-col w-1/2 mb-3">
                    <small>افزایش یافته: ۷۸%</small>
                    <vs-progress class="block mt-1" :percent="70" color="danger"></vs-progress>
                </div>
            </div>
        </vx-card>
    </div>
    <div class="vx-col w-full md:w-1/2 mb-base">
        <vx-card>
            <div class="vx-row flex-col-reverse lg:flex-row">

                <!-- LEFT COL -->
                <div class="vx-col w-full lg:w-1/2 xl:w-1/2 flex flex-col justify-between" v-if="salesBarSession.analyticsData">
                    <div>
                        <h2 class="mb-1 font-bold ">پیشنهادات</h2>
                    </div>
                </div>

                <!-- RIGHT COL -->
                <div class="vx-col w-full lg:w-1/2 xl:w-1/2 flex flex-col lg:mb-0 mb-base">
                    <change-time-duration-dropdown class="self-end" />
                    <vue-apex-charts
                      type="bar"
                      height="200"
                      :options="analyticsData.salesBar.chartOptions"
                      :series="salesBarSession.series"
                      v-if="salesBarSession.series" />
                </div>

            </div>

            <vs-divider class="my-6"></vs-divider>

            <div class="vx-row">
                <div class="vx-col w-1/2 mb-3">
                    <small>همه پشنهادات: ۳۴۲</small>
                    <vs-progress class="block mt-1" :percent="50" color="primary"></vs-progress>
                </div>
                <div class="vx-col w-1/2 mb-3">
                    <small>پیشنهاد جدید: ۱۰۰</small>
                    <vs-progress class="block mt-1" :percent="60" color="warning"></vs-progress>
                </div>
                <div class="vx-col w-1/2 mb-3">
                    <small>پشنهادات این ماه: ۸</small>
                    <vs-progress class="block mt-1" :percent="70" color="danger"></vs-progress>
                </div>
                <div class="vx-col w-1/2 mb-3">
                    <router-link to="proposal">
                      <vs-button icon-pack="feather" icon="icon-chevrons-left" icon-after class="shadow-md w-full lg:mt-0 mt-1">ثبت پیشنهاد جدید</vs-button>
                    </router-link>
                </div>

            </div>
        </vx-card>
    </div>


    <!-- Project Begin -->
    <FeaturedProjectInfo></FeaturedProjectInfo>
    <ProjectList></ProjectList>
  </div>
</template>
<script>
import VueApexCharts from 'vue-apexcharts'
import ProjectList from './ProjectList.vue'
import FeaturedProjectInfo from './FeaturedProjectInfo.vue'

import StatisticsCardLine from '@/components/statistics-cards/StatisticsCardLine.vue'
import analyticsData from './js/analyticsDataProject.js'
import ChangeTimeDurationDropdown from '@/components/ChangeTimeDurationDropdown.vue'

export default {
  data () {
    return {
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
    ProjectList,
    FeaturedProjectInfo
  },
  created () {
    // Sessions By Device
    this.$http.get('/api/card/card-analytics/session-by-device')
      .then((response) => { this.sessionsData = response.data })
      .catch((error) => { console.log(error) })

      // Products Order
    this.$http.get('/api/card/card-analytics/products-orders')
      .then((response) => { this.productsOrder = response.data })
      .catch((error) => { console.log(error) })

      // Customers
    this.$http.get('/api/card/card-analytics/customers')
      .then((response) => { this.customersData = response.data })
      .catch((error) => { console.log(error) })

      // Sales Radar
    this.$http.get('/api/card/card-analytics/sales/radar')
      .then((response) => { this.salesRadar = response.data })
      .catch((error) => { console.log(error) })

      // Support Tracker
    this.$http.get('/api/card/card-analytics/support-tracker')
      .then((response) => { this.supportTracker = response.data })
      .catch((error) => { console.log(error) })

      // Revenue Comparison
    this.$http.get('/api/card/card-analytics/revenue-comparison')
      .then((response) => { this.revenueComparisonLine = response.data })
      .catch((error) => { console.log(error) })

      // Goal Overview
    this.$http.get('/api/card/card-analytics/goal-overview')
      .then((response) => { this.goalOverview = response.data })
      .catch((error) => { console.log(error) })

      // Sales bar
    this.$http.get('/api/card/card-analytics/sales/bar')
      .then((response) => { this.salesBarSession = response.data })
      .catch((error) => { console.log(error) })

      // Todo
    this.$http.get('/api/card/card-analytics/todo/today')
      .then((response) => { this.todoToday = response.data })
      .catch((error) => { console.log(error) })

      // Funding
    this.$http.get('/api/card/card-analytics/funding')
      .then((response) => { this.funding = response.data })
      .catch((error) => { console.log(error) })

      // Sales line
    this.$http.get('/api/card/card-analytics/sales/line')
      .then((response) => { this.salesLine = response.data })
      .catch((error) => { console.log(error) })

      // Browser Analytics
    this.$http.get('/api/card/card-analytics/browser-analytics')
      .then((response) => { this.browserStatistics = response.data })
      .catch((error) => { console.log(error) })

      // Client Retention
    this.$http.get('/api/card/card-analytics/client-retention')
      .then((response) => { this.clientRetentionBar = response.data })
      .catch((error) => { console.log(error) })
  },
}
</script>


<style lang="scss">
#demo-card-analytics {
    .tasks-today-container {
        .tasks-today__task {
            transition: background .15s ease-out;
            .tasks-today__actions {
                display: none;
            }

            &:hover {
                background: rgba(var(--vs-primary),.04) ;
                .tasks-today__actions {
                    display: flex;
                }
            }
        }
    }
}
</style>
