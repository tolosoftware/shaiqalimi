<template>
<div class="vx-col w-full">
  <!-- RADIAL CHART -->
  <div class="vx-row">
    <!-- CARD 2: SUBSCRIBERS GAINED
    <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4 mb-base">

      <statistics-card-line icon="UsersIcon" statistic="92.6k" statisticTitle="اعلانات ماه های اخیر" :chartData="subscribersGained.series" type="area"></statistics-card-line>
    </div> -->

    <!-- CARD 3: ORDER RECIEVED sm:w-1/2 lg:w-1/2 xl:w-1/2 
    <div class="vx-col w-full md:w-1/2 mb-base">
      <div class="pb-6">
        <statistics-card-line icon="ShoppingBagIcon" statistic="97.5K" statisticTitle="قراردادهای اخیر" :chartData="ordersRecevied.series" color="warning" type="area"></statistics-card-line>
      </div>
    </div>-->
    <div class="vx-col w-full md:w-1/2 lg:w-1/2 xl:w-1/2">
      <statistics-card-line class="md:mb-0 mb-base" style="height:190px;" icon="ShoppingBagIcon" icon-right statistic="659.8k" statisticTitle="میزان تغیر قراردادهای اخیر " :chartData="ordersRecevied.series" color="success" />
    </div>

    <div class="vx-col w-full md:w-1/4 mb-base">
      <vx-card title="تانگ تیل">
        <template slot="actions">
          <feather-icon icon="ServerIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
        </template>
        <div class="mt-base">
          <div class="mt-4">
            <div class="flex justify-between">
              <div class="flex flex-col">
                <span class="mb-1">گاز</span>
                <h4>۴۴%</h4>
              </div>
              <div class="flex flex-col text-right">
                <span class="flex -mr-1">
                  <span class="mr-1">زمان ورود</span>
                </span>
                <span class="text-grey">۱۲:۳۴</span>
              </div>
            </div>
            <vs-progress :percent="44" color="success"></vs-progress>
          </div>
        </div>
      </vx-card>
    </div>
    <div class="vx-col w-full md:w-1/4 mb-base">
      <vx-card title="انتقالات امروز">
        <template slot="actions">
          <feather-icon icon="TruckIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
        </template>
        <div class="mt-base">
          <div class="mt-4">
            <div class="flex justify-between">
              <div class="flex flex-col">
                <span class="mb-1">موبلایل</span>
                <h4>۸۴%</h4>
              </div>
              <div class="flex flex-col text-right">
                <span class="flex -mr-1">
                  <span class="mr-1">زمان ورود</span>
                </span>
                <span class="text-grey">۰۸:۳۴</span>
              </div>
            </div>
            <vs-progress :percent="84"></vs-progress>
          </div>
        </div>
      </vx-card>
    </div>
  </div>
</div>
</template>

<script>
import DataViewSidebar from './DataViewSidebar.vue'
import moduleDataList from './data-list/moduleDataList.js'

// Small Line Charts
import StatisticsCardLine from '@/components/statistics-cards/StatisticsCardLine.vue'
import VueApexCharts from 'vue-apexcharts'

export default {
  name: 'vx-project-featured',
  data() {
    return {
      subscribersGained: {
        series: [{
          name: 'Subscribers',
          data: [28, 34, 49, 52, 68, 70, 95]
        }],
        analyticsData: {
          subscribers: 92600
        }
      },
      ordersRecevied: {
        series: [{
          name: 'Orders',
          data: [60, 15, 58, 15, 74, 42, 82]
        }],
        analyticsData: {
          orders: 97500
        }
      },
      activeUsers: {},

    }
  },
  methods: {
    createNewProject() {
      this.$router.push('/projects/add').catch(() => {})
    },
  },
  mounted() {
    this.isMounted = false
  },
  components: {
    StatisticsCardLine,
    VueApexCharts,
  },
  created() {
    this.$http.get('/api/card/card-statistics/active-users')
      .then((response) => { this.activeUsers = response.data })
      .catch((error) => { console.log(error) })
  }
}
</script>
