<template>
<div v-if="sale">
  <vs-button size="small" type="gradient" icon="print" id="printBTN">چاپ</vs-button>
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
        <small class="mb-5" v-text="sale.sale_s3.serial_no" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          نوعیت:
        </strong>
        <small class="mb-5" v-text="$t(sale.type)" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          نوع منبع:
        </strong>
        <small class="mb-5" v-text="$t(sale.source_type)" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          منبع:
        </strong>
        <small class="mb-5" v-text="$t(sale.source_id)" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          واحد پولی:
        </strong>
        <small class="mb-5" v-text="sale.currency_id" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>

    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          حساب بانک:
        </strong>
        <small class="mb-5" v-text="sale.bank_account" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          تاریخ:
        </strong>
        <small class="mb-5" v-text="sale.datatime" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          پروژه:
        </strong>
        <small class="mb-5" v-text="sale.sale_s3.project_id" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          نام دریور:
        </strong>
        <small class="mb-5" v-text="sale.sale_s3.driver_name" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          نمبر پلیت:
        </strong>
        <small class="mb-5" v-text="sale.sale_s3.plate_no" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          شماره تماس دریور :
        </strong>
        <small class="mb-5" v-text="sale.sale_s3.driver_phone" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2"> <strong class="mr-4"> مصارف خدمات : </strong> <small class="mb-5" v-text="sale.sale_s3.service_cost" vs-justify="right" vs-align="right"></small> </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2"> <strong class="mr-4"> مالیات : </strong> <small class="mb-5" v-text="sale.sale_s3.tax" vs-justify="right" vs-align="right"></small> </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2"> <strong class="mr-4"> تامینات : </strong> <small class="mb-5" v-text="sale.sale_s3.deposit" vs-justify="right" vs-align="right"></small> </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2"> <strong class="mr-4"> قیمت نهایی : </strong> <small class="mb-5" v-text="sale.sale_s3.total" vs-justify="right" vs-align="right"></small> </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2"> <strong class="mr-4"> پیشرفت : </strong> <small class="mb-5" v-text="sale.sale_s3.steps" vs-justify="right" vs-align="right"></small> </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2"> <strong class="mr-4"> تفصیلات : </strong> <small class="mb-5" v-text="sale.sale_s3.description" vs-justify="right" vs-align="right"></small> </h6>
    </vs-col>
  </vs-row>
</div>
</template>

<script>
import print from 'print-js'

export default {

  data() {
    return {
      sale: null,
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
    }
  },
  created() {
    this.getSale();
  },
  methods: {
    getSale() {
      this.axios.get('/api/sale/' + this.$route.params.id)
        .then((response) => {
          this.sale = response.data;
          this.$Progress.set(100)
        })
    },
  }
}
</script>

<style>

</style>
