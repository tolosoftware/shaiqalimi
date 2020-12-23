<template>
  <div class="vx-row">
    <div class="vx-col w-full md:w-1/2 mb-base">
      <vx-card>
        <div class="vx-row flex-col-reverse lg:flex-row">
          <!-- LEFT COL -->
          <div
            class="vx-col w-full lg:w-1/2 xl:w-1/2 flex flex-col justify-between"
            v-if="salesBarSession.analyticsData"
          >
            <div>
              <!-- Avg Session -->
              <h2 class="mb-1 font-bold">اعلانات</h2>
            </div>
            <router-link to="proposal">
              <vs-button
                icon-pack="feather"
                icon="icon-chevrons-left"
                icon-after
                class="shadow-md w-full lg:mt-0 mt-4"
              >ثبت اعلان جدید</vs-button>
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
              v-if="salesBarSession.series"
            />
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
          <div
            class="vx-col w-full lg:w-1/2 xl:w-1/2 flex flex-col justify-between"
            v-if="salesBarSession.analyticsData"
          >
            <div>
              <h2 class="mb-1 font-bold">قراردادها</h2>
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
              v-if="salesBarSession.series"
            />
          </div>
        </div>

        <vs-divider class="my-6"></vs-divider>

        <div class="vx-row">
          <div class="vx-col w-1/2 mb-3">
            <small>همه قراردادها: ۳۴۲</small>
            <vs-progress class="block mt-1" :percent="50" color="primary"></vs-progress>
          </div>
          <div class="vx-col w-1/2 mb-3">
            <small>قرارداد جدید: ۱۰۰</small>
            <vs-progress class="block mt-1" :percent="60" color="warning"></vs-progress>
          </div>
          <div class="vx-col w-1/2 mb-3">
            <small>قراردادها این ماه: ۸</small>
            <vs-progress class="block mt-1" :percent="70" color="danger"></vs-progress>
          </div>
          <div class="vx-col w-1/2 mb-3">
            <router-link to="/projects/add">
              <vs-button
                icon-pack="feather"
                icon="icon-chevrons-left"
                icon-after
                class="shadow-md w-full lg:mt-0 mt-4"
              >مدیریت قراردادها</vs-button>
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
import ProjectList from './proposals/ProposalList.vue'
import FeaturedProjectInfo from './FeaturedProjectInfo.vue'

import StatisticsCardLine from '@/components/statistics-cards/StatisticsCardLine.vue'
import analyticsData from './js/analyticsDataProject.js'
import ChangeTimeDurationDropdown from '@/components/ChangeTimeDurationDropdown.vue'

export default {
  data() {
    return {
      salesBarSession: {
        series: [
          {
            name: 'Sessions',
            data: [75,125,225,175,125,75,25]
          }
        ],
        analyticsData: {
          session: 2700,
          comparison: {
            str: 'Last 7 Days',
            result: +5.2
          }
        }
      },
      sessionDataTime: 'lastWeek',
      todoToday: {},

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
  created() {
    console.log(this.analyticsData);
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
