<template>
<div>
  <Accountadd :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :accForm="accForm" :data="editAccData" />
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

        <vs-input icon-after="true" label-placeholder="icon-after" icon="search" placeholder="Search account" class="mt-1 float-right" style="max-width:320px" />

      </div>
    </div>
  </vs-card>
  <vs-card v-for="fruit in fruits" :key="fruit">
    <vs-table max-items="3" pagination :data="accounts">
      <template slot="header">
        <h4 class="p-4">
          <b>
            {{ fruit }}
          </b>
        </h4>
      </template>
      <template slot="thead">
        <vs-th> ریفرینس کد </vs-th>
        <vs-th> نام </vs-th>
        <vs-th> تفصیلات </vs-th>
        <vs-th> نوعیت </vs-th>
        <vs-th> تنظیمات </vs-th>
      </template>

      <template slot-scope="{ data }">
        <vs-tr :key="i" v-for="(tr, i) in data">
          <vs-td :data="tr.ref_code">
            {{ tr.ref_code }}
          </vs-td>

          <vs-td :data="tr.name">
            {{ tr.name }}
          </vs-td>

          <vs-td :data="tr.description">
            {{ tr.description }}
          </vs-td>
          <vs-td :data="tr.type_id">
            {{ findType(tr.type_id) }}
          </vs-td>
          <vs-td class="whitespace-no-wrap notupfromall">
            <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" class="cursor-pointer" @click.stop="editAccount(tr.id)"/>
            <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2 cursor-pointer" @click.stop="deleteData(tr.id)" />
          </vs-td>

        </vs-tr>
      </template>
    </vs-table>
  </vs-card>

  <vs-pagination :total="40" v-model="currentx"></vs-pagination>
</div>
</template>

<script>
import Accountadd from "./Accountadd.vue";
import vSelect from "vue-select";
export default {
  components: {
    "v-select": vSelect,
    Accountadd,
  },
  data: () => ({
    // Data Sidebar
    addNewDataSidebar: false,
    editAccData: {},
    accForm: new Form({
      type_id: '',
      name: '',
      ref_code: '',
      status: 1,
      description: '',
      credit: '',
      debit: '',
      id: null
    }),
    currentx: 14,
    fruits: ["قراداد ها", "بانکها", "دارایی ها", "مشتریان", "مصارف"],

    accounts: [],
    accountTypes: [],
  }),
  created() {
    this.getAllAccounts();
    this.getAllAccountTypes();
  },
  methods: {
    findType(id) {
      let name = '';
      Object.keys(this.accountTypes).some(key => (this.accountTypes[key].id == id) ? name = this.accountTypes[key].title : null);
      return name;
    },
    editAccount(id) {
      console.log(this.accForm);
      this.$Progress.start()
      this.axios.get('/api/account/' + id)
        .then((response) => {
          for (let [key,value] of Object.entries(response.data)) {
            this.accForm[key] = value;
          }      
          if(response.data.financial_records[0]) {
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
      this.axios.get('/api/acount_type')
        .then((response) => {
          this.accountTypes = response.data;
          this.$Progress.set(100)
        })
    },

    deleteData(id) {
      swal.fire({
        title: 'آیا متمعن هستید؟',
        text: "حساب حذف خواهد شد",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>نخیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.accForm.delete('/api/account/' + id).then((id) => {
              swal.fire({
                title: 'عملیه موفقانه انجام شد.',
                text: "حساب از سیستم پاک شد!",
                icon: 'success',
              })
              this.getAllAccounts();
            })
            .catch(() => {});
        }
      })

    },
    // Get Account Types
    getAllAccounts() {
      this.$Progress.start()
      this.axios.get('/api/account')
        .then((response) => {
          this.accounts = response.data;
          this.$Progress.set(100)
        })
    },
    addNewData() {
      this.editAccData = {};
      this.toggleDataSidebar(true);
    },
    toggleDataSidebar(val = false) {
      this.getAllAccounts();
      this.addNewDataSidebar = val;
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
  },

};
</script>

<style lang="stylus">
.vs-input--icon {
  top: 12px;
}
</style>
