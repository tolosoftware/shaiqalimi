<template>
<div>
  <div class="vx-row">
    <div class="vx-col w-full md:w-3/3 mb-2">
      <vx-card>
        <div class="vx-row">
          <div class="md:w-1/2 lg:w-1/3 xl:w-1/3">
            <div class="vx-col w-full">
              <label for>
                <small>اکونت مربوط را انتخاب نماید!</small>
              </label>
              <v-select v-model="seletedAccount" label="name" :options="accounts" :dir="$vs.rtl ? 'rtl' : 'ltr'" @input="accountChanged" />
            </div>
          </div>
        </div>
      </vx-card>
    </div>
  </div>
  <div class="vx-row">
    <div class="vx-col w-full md:w-2/3">
      <div v-if="!isdata">
        <TableLoading></TableLoading>
      </div>
      <vx-card v-if="isdata" title="لست آرشیف" style="height:527px;">
        <vs-table max-items="7" pagination :data="archievs" stripe @updateTable="loadArchives">
          <template slot="thead">
            <vs-th>عنوان</vs-th>
            <vs-th>ریفرینس</vs-th>
            <vs-th>کاربر</vs-th>
            <vs-th>نوع فایل</vs-th>
            <vs-th>تغییرات</vs-th>
          </template>
          <template slot-scope="{ data }">
            <vs-tr :key="indextr" v-for="(tr, indextr) in data">
              <vs-td :data="data[indextr].id">{{ data[indextr].title }}</vs-td>
              <vs-td :data="data[indextr].id">{{ data[indextr].refcode  }}</vs-td>
              <vs-td :data="data[indextr].id">{{ data[indextr].user_id }}</vs-td>
              <vs-td :data="data[indextr].id">{{ data[indextr].type }}</vs-td>
              <vs-td class="whitespace-no-wrap notupfromall">
                <feather-icon icon="FileIcon" svgClasses="w-6 h-6 hover:text-primary stroke-current" class="mr-2" @click.stop="showClientData(tr.id)" />
                <feather-icon icon="EditIcon" svgClasses="w-6 h-6 hover:text-primary stroke-current" />
                <!--</router-link> -->
                <feather-icon icon="TrashIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(tr.id)" />
              </vs-td>
            </vs-tr>
          </template>
        </vs-table>
      </vx-card>
    </div>
    <div class="vx-col w-full md:w-1/3">
      <vx-card title="افزودن آرشیف جدید" :before-change="validateArchiveAdd">
        <form data-vv-scope="archForm">

          <div class="mb-base">
            <vs-input class="w-full" autocomplete="off" v-validate="'required|min:2'" name="title" label="عنوان فایل" v-model="aForm.title" />
            <span class="absolute text-danger alerttext">{{ errors.first('archForm.title') }}</span>

          </div>
          <div class="mb-base">
            <vs-input type="text" autocomplete="off" class="w-full" v-validate="'required|unique:archives'" name="refcode" label="ریفرینس کود" v-model="aForm.refcode" />
            <span class="absolute text-danger alerttext">{{ errors.first('archForm.refcode') }}</span>

          </div>

          <div id="scroll">
            <!-- <div> -->
            <vs-upload text="اپلود فایل آرشیف" :show-upload-button="filse"></vs-upload>
          </div>

          <!--<div class="mb-base">
            <vs-input type="text" autocomplete="off" class="w-full" v-validate="'required'" name="type" label="نوع" v-model="aForm.type" />
            <span class="absolute text-danger alerttext">{{ errors.first('archForm.type') }}</span>-->
          <!--<has-error :form="aForm" field="type"></has-error>-->
          <!--</div>
          <div class="mb-base pt-4">
            <vs-textarea label="نوت" v-validate="'required|min:3'" name="note" v-model="aForm.note"></vs-textarea>
            <span class="absolute text-danger alerttext">{{ errors.first('archForm.note') }}</span>-->
          <!--<has-error :form="aForm" field="note"></has-error>
          </div>-->
          <div class="flex flex-wrap items-center p-6" slot="footer">
            <vs-button class="mr-6" @click="submitData">ذخیره</vs-button>
            <vs-button type="border" color="danger" @click="resetFrom">لغو</vs-button>
          </div>
        </form>
      </vx-card>
    </div>
  </div>
</div>
</template>

<script>
import Vue from "vue";

import TableLoading from '../shared/TableLoading.vue'
import {
  Validator
} from 'vee-validate'
import vSelect from "vue-select";
export default {
  props: {
    data: {
      type: Object,
      default: () => {},
    },
  },
  name: "vx-archive",
  data() {
    return {
      seletedAccount: {},
      archiveFile: [],
      accounts: [],
      isdata: false,
      aForm: new Form({
        title: '',
        refcode: '',
        account_id: 21,
        file: '',
        note: '',
        user_id: localStorage.getItem('id'),
        type: ''
      }),
      settings: {
        // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: 0.6,
      },
      archievs: [],
      dict: {
        custom: {
          title: {
            required: ' عنوان الزامی میباشد.',
            min: 'عنوان باید بیشتر از 2 حرف باشد.',
          },
          refcode: {
            required: 'کود الزامی میباشد',
            unique: 'کود منحصر میباشد'
          },
          account_id: {
            required: 'حساب الزامی است.',
          },
          note: {
            required: ' توضیح الزامی است.',
            min: 'توضیح باید بیشتر از 3 حرف باشد.',
          },
          type: {
            required: 'نوع آرشیف الزامی است.',
          }
        }
      }
    };
  },

  methods: {
    upateFile(data) {
      console.log('file', data);
    },
    updateCurrImg(input) {
      this.aForm.file = input;
      // console.log('input', this.aForm.file);
      // if (input.target.files && input.target.files[0]) {
      //   // this.oldImage = false
      //   const reader = new FileReader()
      //   reader.onload = e => {
      //     this.archiveFile = e.target.result
      //     console.log('file', this.archiveFile)
      //   }
      //   reader.readAsDataURL(input.target.files[0])
      // }
    },
    validateArchiveAdd() {
      return new Promise((resolve, reject) => {
        this.$validator.validateAll('archForm').then(result => {
          if (result) {
            resolve(true)
          } else {
            reject('correct all values')
          }
        })
      })
    },
    resetFrom() {
      this.aForm.reset();
      this.$validator.reset();
    },
    loadAccount() {
      this.$vs.loading();
      this.$Progress.start();
      this.axios.get('/api/accoutload')
        .then((resp) => {
          this.accounts = resp.data;
          this.$Progress.set(100);
          this.$vs.loading.close();
        });
    },
    defalutAcount() {
      this.$vs.loading()
      this.$Progress.start();
      this.axios.get('/api/mostresent').then(({
        data
      }) => (this.seletedAccount = data, this.$Progress.set(100), this.$vs.loading.close()));
    },

    accountChanged(data) {
      this.isdata = false;
      this.aForm.account_id = data.id;
      this.loadArchives();
    },
    submitData() {
      // console.log('file', this.archiveFile);
      let valide = this.validateArchiveAdd();
      if (valide) {
        this.aForm.post('/api/archive')
          .then(({
            data
          }) => {
            this.resetFrom();
            this.loadArchives();
            this.$vs.notify({
              title: 'موفقیت!',
              text: 'آرشیف موفقانه ثبت سیستم شد.',
              color: 'success',
              iconPack: 'feather',
              icon: 'icon-check',
              position: 'top-right'
            })
            this.aForm.reset();
          }).catch((errors) => {
            this.$Progress.set(100)
            this.$vs.notify({
              title: 'ناموفق!',
              text: 'لطفاً معلومات آرشیف را چک کنید و دوباره امتحان کنید!',
              color: 'danger',
              iconPack: 'feather',
              icon: 'icon-cross',
              position: 'top-right'
            })
          });

      }
    },

    loadArchives(id) {
      this.$vs.loading();
      this.$Progress.start();
      this.axios.get('/api/archive', this.seletedAccount)
        .then((resp) => {
          // this.archievs = resp.data;
          this.archievs = resp.data.filter(c => (this.seletedAccount != null && this.seletedAccount.id) ? c.account_id == this.seletedAccount.id : true);
          this.$Progress.set(100);
          this.$vs.loading.close();
          this.isdata = true;
        });
    },
    deleteData(id) {
      swal.fire({
        title: 'آیا مطمیٔن هستید؟',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>خیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.aForm.delete('/api/archive/' + id).then((id) => {
              swal.fire({
                title: 'عملیه حذف موفقانه انجام شد.',
                icon: 'success',
              })
              this.loadArchives();
              this.resetFrom();
            })
            .catch(() => {});
        }
      })
    },
    successUpload() {
      this.$vs.notify({
        color: "success",
        title: "Upload Success",
        text: "Lorem ipsum dolor sit amet, consectetur",
      });
    }

  },

  computed: {
    isSidebarActiveLocal: {
      get() {
        return this.isSidebarActive;
      },
      set(val) {
        if (!val) {
          this.$emit("closeSidebar");
        }
      },
    },

    scrollbarTag() {
      return this.$store.getters.scrollbarTag;
    },
  },

  created() {
    Validator.localize('en', this.dict);
    this.defalutAcount();
    console.log('default', this.seletedAccount);
    this.loadAccount();
    this.loadArchives();
  },
  components: {
    "v-select": vSelect,
    TableLoading,
    Validator
  },
}
</script>

<style>
[dir] .vx-row>.vx-col {
  padding: 0 0.4rem !important;
}

.alerttext {
  padding: 10px;
  font-size: 13px !important;
}

#scroll {
  height: 35vh;
  overflow-y: scroll;
}

.vs-con-textarea {
  margin-bottom: 1px;
}
</style>
