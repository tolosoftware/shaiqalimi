<template>
<div>
  <vs-button size="small" type="gradient" icon="print" id="printBTN" @click="cprint">چاپ</vs-button>

  <div id="print-this">
    <vs-row vs-w="12" class="project-view-header">
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
        <h4>&nbsp;بخش معلومات عمومی&nbsp;</h4>
      </vs-col>
    </vs-row>
    <vs-row vs-w="12">
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            سریال نمبر:
          </strong>
          <small class="mb-5" vs-justify="right" vs-align="right"> {{ project.serial_no }}{{ (project.pro_data && project.pro_data.company_id) ? ' - ' + project.pro_data.company_id.sign : '' }}</small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            اعلان:
          </strong>
          <small class="mb-5" v-if="project.proposal_id" v-text="project.proposal_id.pro_data.title" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            تاریخ عقد قرارداد:
          </strong>
          <small class="mb-5" v-text="project.contract_date" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-1">
          <strong class="mr-4">
            مرجع مربوطه :
          </strong>
          <small class="mb-5" v-if="project.pro_data" v-text="project.pro_data.client.name" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            عنوان قرارداد:
          </strong>
          <small class="mb-5" v-if="project.pro_data" v-text="project.pro_data.title" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            نوعیت قرارداد:
          </strong>
          <small v-if="project.status == 'B'" class="mb-5" vs-justify="right" vs-align="right">معین</small>
          <small v-if="project.status == 'A'" class="mb-5" vs-justify="right" vs-align="right">چارچوبی</small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            شماره شناسایی قرارداد :
          </strong>
          <small class="mb-5" v-if="project.pro_data" v-text="project.pro_data.reference_no" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            تاریخ ختم قرارداد:
          </strong>
          <small class="mb-5" v-text="project.contract_end_date" vs-justify="right" vs-align="right"></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            تضمین قرارداد:
          </strong>
          <small class="mb-5" v-text="project.project_guarantee" vs-justify="right" vs-align="right"></small>
          <small style="color:#42b983;"><b>افغانی </b></small>
        </h6>
      </vs-col>
    </vs-row>
    <br>
    <!-- Ekmalat section -->
    <vs-row vs-w="12" class="project-view-header">
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
        <h4>&nbsp;بخش اکمالات /اقلام&nbsp;</h4>
      </vs-col>
    </vs-row>
    <vs-table :data="project.pro_items">
      <template slot="thead">
        <vs-th>جنس / محصول</vs-th>
        <vs-th>مقدار</vs-th>
        <vs-th>عملیه</vs-th>
        <vs-th>قیمت فی واحد</vs-th>
        <vs-th>قیمت مجموعی</vs-th>
      </template>
      <template slot-scope="{data}">
        <vs-tr v-for="(tr, i) in data" :key="i">
          <vs-td :data="tr.item_id">
            <p> {{ (tr.item_id && tr.item_id.type) ? tr.item_id.type.type : '' }} {{ tr.item_id.name }} </p>
            <!-- <p> {{ (tr.item_id && tr.item_id.type) ? tr.item_id.type.type : '' }} {{ tr.item_id.name }} </p> -->
          </vs-td>
          <vs-td :data="tr.equivalent">
            {{tr.equivalent | NumThreeDigit}} {{ tr.item_id.uom_equiv_id.title }}
          </vs-td>
          <vs-td :data="tr.operation_id">
            <p> {{ tr.operation_id.formula }} </p>
          </vs-td>
          <vs-td :data="tr.unit_price">
            {{tr.unit_price | NumThreeDigit}} <small style="color:#42b983;"><b>افغانی </b></small>
          </vs-td>
          <vs-td :data="tr.total_price">
            {{tr.total_price | NumThreeDigit}} <small style="color:#42b983;"><b>افغانی </b></small>
          </vs-td>
        </vs-tr>
      </template>
    </vs-table>

    <vs-col vs-lg="6" vs-sm="6" vs-xs="12">
      <h3 class="project-view-header pr-2 pl-2">بررسی ارزش اجناس قرارداد</h3>
      <project-items-chart ref="item_chart_type" />
    </vs-col>
    <vs-col vs-lg="6" vs-sm="6" vs-xs="12">
      <h3 class="project-view-header pl-2 pr-2">بررسی فروشات اجناس بر اساس نوعیت</h3>
      <project-items-chart ref="item_chart" />
    </vs-col>

    <vs-row vs-w="12" class="project-view-header">
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
        <h4>&nbsp; بخش مصارف&nbsp;</h4>
      </vs-col>
    </vs-row>
    <vs-row ws-w="12">
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            تامینات:
          </strong>
          <span class="mb-5" v-if="project.pro_data" vs-justify="right" vs-align="right"> {{ project.pro_data.deposit | NumThreeDigit}}</span>
          <small style="color:#42b983;"><b>% </b></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            مالیات:
          </strong>
          <small class="mb-5" v-if="project.pro_data" v-text="project.pro_data.tax" vs-justify="right" vs-align="right"></small>
          <small style="color:#42b983;"><b>% </b></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            متفرقه:
          </strong>
          <span class="mb-5" v-if="project.pro_data" vs-justify="right" vs-align="right"> {{ project.pro_data.others | NumThreeDigit}}</span>
          <small style="color:#42b983;"><b>افغانی </b></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            ارزش قرارداد:
          </strong>
          <span class="mb-5" v-if="project.pro_data" vs-justify="right" vs-align="right"> {{ project.pro_data.pr_worth | NumThreeDigit}}</span>
          <small style="color:#42b983;"><b>افغانی </b></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            انتقالات:
          </strong>
          <span class="mb-5" v-if="project.pro_data" vs-justify="right" vs-align="right"> {{ project.pro_data.transit | NumThreeDigit}}</span>
          <small style="color:#42b983;"><b>افغانی </b></small>
        </h6>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
        <h6 class="mb-5 mt-3 ml-2">
          <strong class="mr-4">
            نرخ دهی:
          </strong>
          <span class="mb-5" v-if="project.pro_data" vs-justify="right" vs-align="right"> {{ project.pro_data.total_price | NumThreeDigit}}</span>
          <small style="color:#42b983;"><b>افغانی </b></small>
        </h6>
      </vs-col>
    </vs-row>
    <br>
    <project-sale-summary />
  </div>
</div>
</template>

<script>
import ProjectSaleSummary from './ProjectSaleSummary'
import ProjectItemsChart from './ProjectItemsChart'
import print from 'print-js'

export default {
  data() {
    return {
      // init values
      project: [],
      printStyle: `
      body { direction: rtl;}
      th, td {
        text-align: right !important;
        padding: 8px !important;
      }
      tr:nth-child(even) {background-color: #f2f2f2 !important;}
      thead{
        border-bottom: solid 3px #EA5455 !important;
      }
      .print_extra_data{
        float:left;
      }
      `,
    };
  },
  components: {
    ProjectSaleSummary,
    ProjectItemsChart
  },
  created() {
    this.getProject();
  },
  methods: {
    getProject() {
      // Start the Progress Bar
      this.$Progress.start()
      this.axios.get('/api/project/' + this.$route.params.id)
        .then((response) => {
          this.project = response.data;
          // for (let [key, item] of Object.entries(this.project.pro_items)) {
          //   this.$refs.item_chart.pie.series[0].name = 'نام جنس و قیمت مجموعی';
          //   this.$refs.item_chart.pie.legend.data.push(item.item_id.name);
          //   this.$refs.item_chart.pie.series[0].data.push({
          //     value: (item.total_price) ? item.total_price : 0,
          //     name: item.item_id.name
          //   });
          // }
          // this.$refs.item_chart_type.pie.series[0].name = 'مقدار اجناس براساس واحد';
          // for (let [key, item] of Object.entries(this.project.pro_items)) {
          //   this.$refs.item_chart_type.pie.series[0].color = ['#FF9F43', '#28C76F', '#EA5455', '#87ceeb', '#7367F0'].reverse();

          //   console.log(this.$refs.item_chart_type.pie.legend.data);
          //     this.$refs.item_chart_type.pie.legend.data.push(item.item_id.uom_equiv_id.title);
          //     this.$refs.item_chart_type.pie.series[0].data.push({
          //       value: (item.equivalent) ? item.equivalent : 0,
          //       name: item.item_id.uom_equiv_id.title
          //     });
          // }
          this.getProjectSales();
          this.getProjectItemsChart();
        })
    },
    getProjectSales() {
      // Start the Progress Bar
      this.$Progress.start()
      this.axios.get('/api/sale/project/type/' + this.$route.params.id)
        .then((response) => {
          if (response.data) {
            this.$refs.item_chart.pie.series[0].name = 'فروشات اجناس بر اساس واحد';
            for (let [key, value] of Object.entries(response.data)) {
              this.$refs.item_chart_type.pie.legend.data.push(key);
              this.$refs.item_chart_type.pie.series[0].color = ['#FF9F43', '#28C76F', '#EA5455', '#87ceeb', '#7367F0'].reverse();
              this.$refs.item_chart_type.pie.series[0].data.push({
                value: value,
                name: key
              });
            }
          }
        })
    },
    getProjectItemsChart() {
      // Start the Progress Bar
      this.$Progress.start()
      this.axios.get('/api/sale/project/item-chart/' + this.$route.params.id)
        .then((response) => {
          if (response.data) {
            this.$refs.item_chart_type.pie.series[0].name = 'فروشات اجناس بر اساس نوعیت';
            for (let [key, value] of Object.entries(response.data)) {
              this.$refs.item_chart.pie.legend.data.push(key);
              this.$refs.item_chart.pie.series[0].color = ['#FF9F43', '#28C76F', '#EA5455', '#87ceeb', '#7367F0'];
              this.$refs.item_chart.pie.series[0].data.push({
                value: value,
                name: key
              });
            }
          }
        })
    },
    cprint() {
      var someJSONdata = [{
          field: 'سریال نمبر',
          value: this.project.serial_no,
        },
        {
          field: 'مرجع مربوطه',
          value: this.project.pro_data.client.name,
        },
        {
          field: 'شماره شناسایی قرارداد',
          value: this.project.pro_data.reference_no,
        },
        {
          field: 'تاریخ عقد قرارداد',
          value: this.project.contract_date,
        },
        {
          field: 'اعلان',
          value: this.project.proposal_id.pro_data.title,
        },
        {
          field: 'عنوان قرارداد',
          value: this.project.pro_data.title,
        },
        {
          field: 'نوعیت قرارداد',
          value: this.project.status == 'B' ? "معین" : "چارچوبی",
        },
        {
          field: 'تضمین قرارداد',
          value: this.project.project_guarantee,
        },
      ]

      var header = `<div class="print-header">
      <img width="30" src="/img/default/navelogo.png" alt="login">
      <span class="vx-logo-text">شرکت شایق علیمی</span>
      <span class="print_extra_data">
        <span>پرینت توسط ${localStorage.getItem('name')} ${localStorage.getItem('lastname')}</span>
        <br>
        <span>${ new Date().toLocaleString('fa-AF', { hour12: true })}</span>
      </span>
      </div>`; // printJS('print-this', 'html');
      var options = {
        printable: someJSONdata,
        properties: [{
            field: 'field',
            displayName: 'نام'
          },
          {
            field: 'value',
            displayName: 'دیتا'
          },
        ],
        type: 'json',
        header: header,
        documentTitle: 'راپور پروژه تیل وزارت معارف xyz-821738',
        style: this.printStyle,
        css: [
          '/css/app.css'
        ],
        scanStyles: false
      };
      printJS(options);
    }
  },
};
</script>
