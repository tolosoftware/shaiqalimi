<template>
<div>
  <Accountadd :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :accForm="accForm" :accountTypes="accountTypes" />
  <vs-card>
    <div class="vx-row mb-3">
      <div class="vx-col w-1/2">
        <h3 class="mt-4">
          <b> لیست حسابات </b>
        </h3>
      </div>
      <div class="vx-col w-1/2 float-left">
        <vs-button color="primary" type="filled" class="float-right ml-3" @click="addNewData">حساب جدید</vs-button>
        <!-- <vs-button @click="testTost">tost</vs-button> -->
        <!-- <vs-input icon-after="true" label-placeholder="icon-after" icon="search" placeholder="Search account" class="mt-1 float-right" style="max-width:320px" /> -->
      </div>
    </div>
  </vs-card>
  <div v-if="!isdata">
    <TableLoading></TableLoading>
  </div>
  <span v-if="isdata" v-for="(type, i) in accountTypes" :key="i">
    <vs-card v-if="type.accounts && type.accounts.length > 0">
      <vs-table max-items="3" pagination :data="type.accounts" stripe>
        <template slot="header">
          <h4 class="p-4"><b>{{ type.title }}</b></h4>
          <span class="p-4 align-right">
            <span class="text-rtl-left breadcrumb" v-if="type.type_id">{{ generateBroadCrumps(type) }}</span>
          </span>
        </template>
        <template slot="thead">
          <vs-th> <strong> ریفرینس کد</strong> </vs-th>
          <vs-th> <strong> عنوان</strong> </vs-th>
          <vs-th> <strong> بالانس</strong> </vs-th>
          <vs-th> <strong> حالت</strong> </vs-th>
          <vs-th> <strong> تنظیمات</strong> </vs-th>
        </template>
        <template slot-scope="{ data }">
          <vs-tr :key="i" v-for="(tr, i) in data">
            <vs-td :data="tr.ref_code">
              <p class="cursor-pointer" @click.stop="openFinancialRecords(tr)">{{ tr.ref_code }} </p>
            </vs-td>
            <vs-td :data="tr.name">
              <p class="cursor-pointer" @click.stop="openFinancialRecords(tr)">{{ tr.name }} </p>
            </vs-td>
            <vs-td :data="tr">
              <p class="cursor-pointer" @click.stop="openFinancialRecords(tr)">{{ countTheBalance(tr) }} </p>
            </vs-td>
            <vs-td :data="tr.status">
              <p>{{ (tr.status == 1) ? "فعال" :"غیرفعال"}} </p>
            </vs-td>
            <vs-td class="whitespace-no-wrap notupfromall">
              <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" class="cursor-pointer" />
              <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2 cursor-pointer" @click.stop="deleteData(tr.id)" />
              <!-- <feather-icon icon="DollarSignIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2 cursor-pointer" @click.stop="openFinancialRecords(tr)" /> -->
            </vs-td>
          </vs-tr>
        </template>
      </vs-table>
      <vs-popup class="holamundo financial-records-modal" title="اطلاعات معاملات تجاری" :active.sync="popupActive">
        <financial-records :recordsData="financialRecordsData"></financial-records>
      </vs-popup>
    </vs-card>
  </span>
</div>
</template>

<script>
import Accountadd from "./Accountadd.vue"
import TableLoading from './../shared/TableLoading.vue'
import FinancialRecords from "../transactions/FinancialRecords"
import vSelect from "vue-select"
export default {
  components: {
    "v-select": vSelect,
    Accountadd,
    FinancialRecords,
    TableLoading
  },
  data: () => ({
    // Data Sidebar
    isdata: false,
    addNewDataSidebar: false,
    editAccData: {},
    accForm: new Form({
      type_id: '',
      name: '',
      ref_code: '0',
      status: 1,
      description: '',
      credit: '0',
      debit: '0',
      id: null
    }),
    currentx: 14,
    accounts: [],
    accountTypes: [],
    // financialRecordsData Values
    popupActive: false,
    financialRecordsData: [],
    broadSeperate: `<span class="breadcrumb-separator mx-2"><feather-icon :icon="rtl ? 'ChevronsLeftIcon' : 'ChevronsRightIcon'" svgClasses="w-4 h-4" /></span>`,
  }),
  created() {
    this.getAllAccountTypes();
  },
  methods: {
    // getAllAccountTypes() {
    //   this.$Progress.start()
    //   this.axios.get('/api/acount_type')
    //     .then((response) => {
    //       this.accountTypes = response.data;
    //       this.$Progress.set(100)
    //     })
    // },
    findType(id) {
      let name = '';
      Object.keys(this.accountTypes).some(key => (this.accountTypes[key].id == id) ? name = this.accountTypes[key].title : null);
      return name;
    },
    editAccount(id) {
      this.$Progress.start()
      this.axios.get('/api/account/' + id)
        .then((response) => {
          for (let [key, value] of Object.entries(response.data)) {
            this.accForm[key] = value;
          }
          if (response.data.financial_records[0]) {
            this.accForm.credit = response.data.financial_records[0].credit;
            this.accForm.debit = response.data.financial_records[0].debit;
          }
          this.$Progress.set(100)
          this.toggleDataSidebar(true);
        })
    },
    // Get Account Types
    getAllAccountTypes() {
      this.$Progress.start()
      // this.$vs.loading()
      this.axios.get('/api/accounts')
        .then((response) => {
          this.accountTypes = response.data;
          console.log(this.accountTypes);
          this.isdata = true;
          this.$Progress.set(100)
          // this.$vs.loading.close();
        })
    },
    countTheBalance(data) {
      let x = 0;
      for (let [key, data] of Object.entries(data.financial_records)) {
        if (data.credit) {
          x = x + parseInt(data.credit);
        }
        if (data.debit) {
          x = x - parseInt(data.debit);
        }
      }
      return x;
    },
    deleteData(id) {
      swal.fire({
        title: 'آیا مطمئن هستید؟',
        text: "حساب حذف خواهد شد",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>خیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.accForm.delete('/api/account/' + id).then((id) => {
              swal.fire({
                title: 'عملیه موفقانه انجام شد.',
                text: "حساب از سیستم پاک شد!",
                icon: 'success',
              })
              this.getAllAccountTypes();
            })
            .catch(() => {});
        }
      })
    },
    addNewData() {
      // this.editAccData = {};
      this.toggleDataSidebar(true);
    },
    toggleDataSidebar(val = false) {
      this.getAllAccountTypes();
      this.addNewDataSidebar = val;
    },

    // Financial Records Modal
    openFinancialRecords(data) {
      this.popupActive = true;
      this.$Progress.start()
      this.axios.post('/api/financial-account', data)
        .then((response) => {
          this.financialRecordsData = response.data;
          this.$Progress.set(100)

        })
    },

    // testTost() {
    //     //sweetalirt
    //     swal.fire(
    //         'The Internet?',
    //         'That thing is still around?',
    //         'question'
    //     )

    //     // tost notification
    //     this.$vs.notify({
    //         title: 'Icon mail',
    //         text: 'Lorem ipsum dolor sit amet, consectetur',
    //         color: 'success',
    //         iconPack: 'feather',
    //         icon: 'icon-check',
    //         position: 'top-right'
    //     })
    // }
    generateBroadCrumps(type, seperate = false) {

      if (type.type_id && type.type_id.title) {
        var t = ((seperate) ? " << " : '') + type.type_id.title.replace(/ *\([^)]*\) */g, "") + this.generateBroadCrumps(type.type_id, true);
        return t
      } else {
        return ''
      }
    }
  },
  mounted() {
    this.isMounted = false
  },

};
</script>

<style lang="stylus">
.vs-input--icon {
  top: 12px;
}

.financial-records-modal .vs-popup {
  min-width: 80% !important;
}
</style>
