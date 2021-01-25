<template>
<div>
  <div slot="header">صلاحیت های کاربر را انتخاب کنید</div>
  <vs-row class="pt-5 pb-5">
    <ul class="demo-alignment flex space-between">
      <li v-for="(n, index) in privileges" :key="index" class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pt-3 pb-3">
        <div class="vs-component con-vs-checkbox vs-checkbox-success vs-checkbox-default">
          <input type="checkbox" class="vs-checkbox--input" v-model="n.assign" @click="n.assign = !n.assign">
          <span class="checkbox_x vs-checkbox" style="border: 2px solid rgb(180, 180, 180);">
            <span class="vs-checkbox--check">
              <i class="vs-icon notranslate icon-scale vs-checkbox--icon  material-icons null">check</i>
            </span>
          </span>
          <span class="con-slot-label">{{n.label}}</span>
        </div>
      </li>
    </ul>
    <vs-col class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pt-3 pb-3">
      <div class="w-full">
        <vs-button class="w-full mt-6 input-height" @click.stop="storePrivilages(privileges)">ثبت صلاحیت های کابر</vs-button>
      </div>
    </vs-col>

  </vs-row>
</div>
</template>

<script>
export default {
  props: {
    source: {
      required: false
    },
  },
  data() {
    return {
      privileges: [{
        label: 'مدیریت تانک تیل ها',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت اجناس و محصولات',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت گدام ها',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت انتقالات',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت راپورها',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت مصارف',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت کاربران',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت قراردادها',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت آفرها',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت فروشات',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت حساب ها',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت معاملات تجارتی',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت ذخایر',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت خریداری ها',
        code: '',
        assign: false,
      }, {
        label: 'مدیریت آرشیف',
        code: '',
        assign: false,
      }, {
        label: 'تنظیمات سیستم',
        code: '',
        assign: false,
      }, {
        label: 'تنظیمات مشتریان',
        code: '',
        assign: false,
      }, {
        label: 'تنظیمات فروشندگان',
        code: '',
        assign: false,
      }],
    }
  },
  created() {
    console.log(this.source);
  },
  methods: {
    storePrivilages(p){
      console.log(p);
      this.$emit('closeModal'); 
    }
  }

}
</script>

<style>

</style>
