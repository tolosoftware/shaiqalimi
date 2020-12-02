<template>
  <div id="all-inventory">
    <!-- PRODUCT ORDERS -->
    <div class="vx-col w-full mb-base">
      <vx-card title="توزیع ذخایر" class="no-shadow">
        <!-- CHART -->
        <div slot="no-body">
          <vue-apex-charts
            type="radialBar"
            height="350"
            :options="radialBarChart.chartOptions"
            :series="radialBarChart.series"
          ></vue-apex-charts>
        </div>
        <!-- End CHART DATA -->
        <!-- List Of Items -->
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
        <!-- End of project lists -->
      </vx-card>
    </div>
  </div>
</template>
<script>
import VueApexCharts from 'vue-apexcharts'
import analyticsData from '../analyticsData.js'


export default {
  name: 'vx-archive',
  data() {
    return {
      settings: {
        maxScrollbarLength : 60,
        wheelSpeed         : .60
      },
      radialBarChart: {
        analyticsData: [
          {'orderType': 'Finished','counts': 23043,color: 'primary'},
          {'orderType': 'Pending','counts': 14658,color: 'warning'},
          {'orderType': 'Rejected ','counts': 4758,color: 'danger'},
        ],
        series: [70,52,26],
        chartOptions: {
          labels: ['A','B','C'],
          
          plotOptions: {
            radialBar: {
              size: 165,
              offsetY: -5,
              hollow: {
                size: '20%'
              },
              track: {
                background: '#ebebeb',
                strokeWidth: '100%',
                margin: 15
              },
              dataLabels: {
                show: true,
                name: {
                  fontSize: '18px'
                },
                value: {
                  fontSize: '16px',
                  color: '#636a71',
                  offsetY: 11
                },
                total: {
                  show: true,
                  label: 'Total',
                  formatter() {
                    return 42459
                  }
                }
              }
            }
          },
          responsive: [
            {
              breakpoint: 576,
              options: {
                plotOptions: {
                  radialBar: {
                    size: 150,
                    hollow: {
                      size: '20%'
                    },
                    track: {
                      background: '#ebebeb',
                      strokeWidth: '100%',
                      margin: 15
                    }
                  }
                }
              }
            }
          ],
          colors: ['#7961F9','#FF9F43','#EA5455'],
          fill: {
            type: 'gradient',
            gradient: {
              // enabled: true,
              shade: 'dark',
              type: 'vertical',
              shadeIntensity: 0.5,
              gradientToColors: ['#9c8cfc','#FFC085','#f29292'],
              inverseColors: false,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0,100]
            }
          },
          stroke: {
            lineCap: 'round'
          },
          chart: {
            height: 355,
            dropShadow: {
              enabled: true,
              blur: 3,
              left: 1,
              top: 1,
              opacity: 0.1
            }
          }
        }
      }
    }
  },
  created() {
    console.log(this.radialBarChart);

  },
  components: {
    VueApexCharts,
    
  },
}
</script>
<style lang="scss">
#all-inventory .con-tab.vs-tabs--content{
  max-height: 90vh !important;
  overflow-y: scroll !important;
}
</style>