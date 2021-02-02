<template>
<form-wizard color="rgba(var(--vs-primary), 1)" :title="null" :subtitle="null" ref="wizardproc" @on-complete="formSubmitted">
  <tab-content title="درخواست خریداری" class="mb-5" :before-change="changeStepStatus">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>درخواست خریداری</vs-divider>
      </vs-row>
      <vs-row vs-w="12">
        <div>
          <p v-if="procurment.vendor">نام فروشند: {{procurment.vendor.name }}</p>
        </div>
      </vs-row>
    </vs-row>
  </tab-content>
  <tab-content title="اطلاعات مالی" class="mb-5" :before-change="changeStepStatus1">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>اطلاعات مالی</vs-divider>
      </vs-row>
      <vs-row vs-w="12">
      </vs-row>
    </vs-row>
  </tab-content>
  <tab-content title="دریافت اکمالات" class="mb-5" :before-change="changeStepStatus2">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>دریافت اکمالات</vs-divider>
      </vs-row>
      <vs-row vs-w="12">
      </vs-row>
    </vs-row>
  </tab-content>
  <tab-content title="تصفیه حسابات" class="mb-5" :before-change="changeStepStatus3">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>تصفیه حسابات</vs-divider>
      </vs-row>
      <vs-row vs-w="12">
      </vs-row>
    </vs-row>
  </tab-content>
  <tab-content title="تاییدی" class="mb-5">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>تاییدی</vs-divider>
      </vs-row>
      <vs-row vs-w="12">
      </vs-row>
    </vs-row>
  </tab-content>

  <vs-button slot="prev">قبلی</vs-button>
  <vs-button slot="next">بعدی</vs-button>
  <vs-button slot="finish">بستن صحفه</vs-button>
</form-wizard>
</template>

<script>
import {
  FormWizard,
  TabContent
} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
export default {
  props: ['procurment'],
  data() {
    return {
      step: 0
    }
  },
  created() {},
  components: {
    FormWizard,
    TabContent
  },
  methods: {
    formSubmitted() {
      this.$emit('closesteps');
    },
    setWizardStepProc(index) {
      this.step = index;
      console.log('step', this.step);
      this.$refs.wizardproc.activateAll();
      this.$refs.wizardproc.navigateToTab(index - 1);
      // this.$refs.wizard.navigateToTab(2);
    },
    changeItTo(id, st) {
      this.$Progress.start()
      this.axios
        .get('/api/procchange/' + id + '/' + st)
        .then((response) => {
          this.$Progress.set(100);
          this.$vs.notify({
            title: 'موفقیت!',
            text: ' مرحله موفقانه به ' + st + ' تغیر یافت.',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        }).catch(() => {});
    },
    changeStepStatus() {
      if (this.step == 1) {
        this.step = 2;
        this.changeItTo(this.procurment.id, this.step)
      }
      return true;
    },
    changeStepStatus1() {
      if (this.step == 2) {
        this.step = 3;
        this.changeItTo(this.procurment.id, this.step)
      }
      return true;
    },
    changeStepStatus2() {
      if (this.step == 3) {
        this.step = 4;
        this.changeItTo(this.procurment.id, this.step)
      }
      return true;
    },
    changeStepStatus3() {
      if (this.step == 4) {
        this.step = 5;
        this.changeItTo(this.procurment.id, this.step)
      }
      return true;
    }
  }
}
</script>
