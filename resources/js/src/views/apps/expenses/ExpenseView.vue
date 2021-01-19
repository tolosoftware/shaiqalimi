<template>
<div v-if="expense">
  <vs-button size="small" type="gradient" icon="print" class="mb-1" id="printBTN" @click="cprint">چاپ</vs-button>
  <vs-row vs-w="12" class="project-view-header">
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
      <h4>&nbsp;بخش مصارف&nbsp;</h4>
    </vs-col>
  </vs-row>
  <vs-row vs-w="12">
    <vs-col :key="i" v-for="(field, i) in fields" vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          {{ (typeof field === 'object') ? $t(field[0]) : $t(field) }}:
        </strong>
        <small class="mb-5" v-if="(typeof field !== 'object')">{{ expense[field] }}</small>
        <small class="mb-5" v-if="(typeof field === 'object')">
          <span :key="i" v-for="(sub, i) in field[1]"> {{ expense[field[0]][sub] }} </span>
        </small>
      </h6>
    </vs-col>
  </vs-row>
</div>
</template>

<script>
export default {
  props: {
    expense: {
      required: false
    },
  },
  data() {
    return {
      fields: [
        'serial_no',
        'datetime',
        'title',
        'ammount',
        ['currency', ['sign_fa']],
        ['user', ['firstName', 'lastName']],
        'description',
      ],
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
  created() {
    this.getTransaction();
  },
  methods: {
    cprint() {
      var someJSONdata = [{
          field: 'سریال نمبر',
          value: this.expense.serial_no,
        },
        {
          field: 'تاریخ',
          value: this.expense.datetime,
        },
        {
          field: 'عنوان',
          value: this.expense.title,
        },
        {
          field: 'مقدار',
          value: this.expense.ammount,
        },
        {
          field: 'واحد پولی',
          value: this.expense.currency.sign_fa,
        },
        {
          field: 'کاربر',
          value: this.expense.user.firstName + ' ' + this.expense.user.lastName,
        },
        {
          field: 'تفصیلات',
          value: this.expense.description,
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
    getTransaction() {
      if (this.$route.params.id) {
        this.$Progress.start()
        this.$vs.loading()
        this.axios.get('/api/expenses/' + this.$route.params.id)
          .then((response) => {
            this.expense = response.data;
            this.$vs.loading.close();
            this.$Progress.set(100)
          })
      }
    },
  },
};
</script>
