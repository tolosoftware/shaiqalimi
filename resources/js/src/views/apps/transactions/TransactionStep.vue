<template>
<form-wizard color="rgba(var(--vs-primary), 1)" :title="null" :subtitle="null" ref="wizardtran" @on-complete="formSubmitted">
  <tab-content title="اطلاعات مالی" class="mb-5" :before-change="changeStepStatus">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>اطلاعات مالی</vs-divider>
      </vs-row>
      <vs-row vs-w="12">
        <div>
          <p v-if="transaction.title">عنوان معامله: {{transaction.title }}</p>
        </div>
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
  props: ['transaction'],
  data() {
    return {
      step: 0
    }
  },
  components: {
    FormWizard,
    TabContent
  },
  methods: {
    formSubmitted() {
      this.$emit('closesteps');
    },
    setWizardStepTrans(index) {
      this.step = index;
      console.log('step', this.step);
      this.$refs.wizardtran.activateAll();
      this.$refs.wizardtran.navigateToTab(index - 1);
    },
    changeItTo(id, st) {
      this.$Progress.start()
      this.axios
        .get('/api/tranchange/' + id + '/' + st)
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
        this.changeItTo(this.transaction.id, this.step)
      }
      return true;
    }
  }
}
</script>
