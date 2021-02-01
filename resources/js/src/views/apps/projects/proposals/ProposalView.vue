<template>
<div v-if="proposal">
  <vs-button size="small" type="gradient" icon="print" id="printBTN" @click="cprint">چاپ</vs-button>
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
        <small class="mb-5" v-text="proposal.serial_no" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          تاریخ نشر اعلان:
        </strong>
        <small class="mb-5" v-text="proposal.publish_date" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          آدرس نشر اعلان:
        </strong>
        <small class="mb-5" v-text="proposal.publish_address" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          تاریخ آفرگشایی:
        </strong>
        <small class="mb-5" v-text="proposal.bidding_date" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          آدرس آفرگشایی:
        </strong>
        <small class="mb-5" v-text="proposal.bidding_address" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>

    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          تضمین آفر:
        </strong>
        <small class="mb-5" v-text="proposal.offer_guarantee" vs-justify="right" vs-align="right"></small>
        <small style="color:#42b983;"><b>افغانی </b></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          نوعیت قرارداد:
        </strong>
        <small v-if="proposal.status == 'B'" class="mb-5" vs-justify="right" vs-align="right">معین</small>
        <small v-if="proposal.status == 'income'" class="mb-5" vs-justify="right" vs-align="right">چارچوبی</small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-1">
        <strong class="mr-4">
          نهاد تطبیق کننده :
        </strong>
        <small class="mb-5" v-if="proposal.pro_data" v-text="proposal.pro_data.client.name" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          عنوان قرارداد:
        </strong>
        <small class="mb-5" v-if="proposal.pro_data" v-text="proposal.pro_data.title" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          شماره شناسایی قرارداد :
        </strong>
        <small class="mb-5" v-if="proposal.pro_data" v-text="proposal.pro_data.reference_no" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          تاریخ ختم پیشنهاد:
        </strong>
        <small class="mb-5" v-text="proposal.submission_date" vs-justify="right" vs-align="right"></small>
      </h6>
    </vs-col>
  </vs-row>
  <!-- Ekmalat section -->
  <vs-row vs-w="12" class="project-view-header">
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
      <h4>&nbsp;بخش اکمالات /اقلام&nbsp;</h4>
    </vs-col>
  </vs-row>
  <vs-table :data="proposal.pro_items">
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
        </vs-td>
        <vs-td :data="tr.equivalent">
          {{tr.equivalent}} {{ tr.item_id.uom_equiv_id.title }}
        </vs-td>
        <vs-td :data="tr.operation_id">
          <p> {{ tr.operation_id.formula }} </p>
        </vs-td>
        <vs-td :data="tr.unit_price">
          {{tr.unit_price}} <small style="color:#42b983;"><b>افغانی </b></small>
        </vs-td>
        <vs-td :data="tr.total_price">
          {{tr.total_price}} <small style="color:#42b983;"><b>افغانی </b></small>
        </vs-td>
      </vs-tr>
    </template>
  </vs-table>
</div>
</template>

<script>
import print from 'print-js'

export default {

  data() {
    return {
      proposal: null,
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
    this.getProposal();
  },
  methods: {
    getProposal() {
      this.axios.get('/api/proposal/' + this.$route.params.id)
        .then((response) => {
          this.proposal = response.data;
          // Object.keys(this.proposal).some(key => this.proposal[key]['title'] = this.proposal[key].pro_data.title);
          console.log(this.proposal);
          this.$Progress.set(100)
        })
    },
    cprint() {
      var someJSONdata = [{
          field: 'سریال نمبر',
          value: this.proposal.serial_no,
        },
        {
          field: 'مرجع مربوطه',
          value: this.proposal.pro_data.client.name,
        },
        {
          field: 'شماره شناسایی قرارداد',
          value: this.proposal.pro_data.reference_no,
        },
        {
          field: 'تاریخ نشر اعلان',
          value: this.proposal.publish_date,
        },
        {
          field: 'آدرس نشر اعلان',
          value: this.proposal.publish_address,
        },
        {
          field: 'تاریخ آفرگشایی',
          value: this.proposal.bidding_date,
        },
        {
          field: 'آدرس آفرگشایی',
          value: this.proposal.bidding_date,
        },
        {
          field: 'عنوان قرارداد',
          value: this.proposal.pro_data.title,
        },
        {
          field: 'نوعیت قرارداد',
          value: this.proposal.status == 'B' ? "معین" : "چارچوبی",
        },
        {
          field: 'تضمین آفر',
          value: this.proposal.offer_guarantee,
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
    },
  }
}
</script>

<style>

</style>
