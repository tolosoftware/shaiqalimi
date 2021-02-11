<template>
<form-wizard v-if="expense" color="rgba(var(--vs-primary), 1)" :start-index.sync="current" :title="null" :subtitle="null" ref="wizardexpen" @on-complete="formSubmitted">
  <tab-content title="اطلاعات مالی" class="mb-5" :before-change="changeStepStatus">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>اطلاعات مالی</vs-divider>
      </vs-row>
      <vs-row vs-w="12">
        <vs-col class="pr-5" vs-lg="4" vs-sm="4" vs-xs="12">
          <div class="vx-row p-5">
            <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="12" vs-xs="12">
              <div class="vx-row w-full">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p clas="w-full" v-if="expense.serial_no"><strong>سریال نمبر: </strong><span v-text="expense.serial_no"></span></p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                  <p class="w-full" v-if="expense.expense_status"><strong>حالت معامله: </strong><span v-text="expense.expense_status"></span></p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p class="w-full pr-5" v-if="expense.ammount"><strong>مقدار: </strong><span v-text="expense.ammount"></span></p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p class="w-full pr-5" v-if="expense.sign_fa"><strong>واحد پولی: </strong><span v-text="expense.currency.sign_fa"></span></p>
                </vs-col>
              </div>
            </vs-col>
          </div>
        </vs-col>
        <vs-col class="pl-5" vs-lg="8" vs-sm="8" vs-xs="12">
          <div class="vx-row p-5">
            <div class="vx-row w-full">
              <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                <p clas="w-full" v-if="expense.user"><strong class="mr-4"> کاربر ثبت کننده: </strong><span v-text="expense.user.lastName"></span></p>
              </vs-col>
            </div>
            <div class="vx-row w-full">
              <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                <p class="w-full" v-if="expense.title"><strong class="mr-4">عنوان معامله: </strong><span v-text="expense.title"></span></p>
              </vs-col>
            </div>
            <div class="vx-row w-full">
              <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                <p class="w-full" v-if="expense.description"><strong class="mr-4">توضیحات: </strong><span v-text="expense.description"></span></p>
              </vs-col>
            </div>
          </div>
        </vs-col>
      </vs-row>
      <vs-row vs-w="12">
        <vs-divider></vs-divider>
      </vs-row>
    </vs-row>
  </tab-content>
  <tab-content title="تاییدی" class="mb-5" :before-change="approveStatus">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>تاییدی</vs-divider>
      </vs-row>
      <vs-row vs-w="12">
        <vs-checkbox color="success" size="large" v-model="expForm.is_approved"><strong> معاملات تجارتی تاییداست ؟ </strong></vs-checkbox>
      </vs-row>
      <vs-row vs-w="12">
        <vs-divider></vs-divider>
      </vs-row>
    </vs-row>
  </tab-content>
  <vs-button slot="prev">قبلی</vs-button>
  <vs-button slot="next">بعدی</vs-button>
  <vs-button v-bind:class="expForm.is_approved ? '': 'hide'" slot="finish">بستن صحفه</vs-button>
  <vs-button v-if="current == 1" disabled v-bind:class="expForm.is_approved ? 'hide': ''">بستن صحفه</vs-button>
</form-wizard>
</template>

<script>
import {
  FormWizard,
  TabContent
} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
export default {
  props: ['expense'],
  data() {
    return {
      expForm: new Form({
        step: 0,
        is_approved: 0
      }),
      current: 0,
    }
  },
  created() {

  },
  components: {
    FormWizard,
    TabContent
  },
  methods: {
    formSubmitted() {
      this.$emit('closesteps');
    },
    setWizardStepExpense(expense) {
      this.expForm.step = expense.step;
      this.expForm.is_approved = expense.is_approved;
      this.current = expense.step - 1;
      this.$refs.wizardexpen.activateAll();
      this.$refs.wizardexpen.navigateToTab(index - 1);
    },
    changeItTo(id, st) {
      this.$Progress.start()
      this.expForm.post('/api/expchange/' + id)
        .then((response) => {
          this.$Progress.set(100);
          if (this.expForm.step == 3) {
            this.$vs.notify({
              title: 'موفقیت!',
              text: ' مراحل معاملات تجارتی موفقانه تایید شد',
              color: 'success',
              iconPack: 'feather',
              icon: 'icon-check',
              position: 'top-right'
            })
          } else {
            this.$vs.notify({
              title: 'موفقیت!',
              text: ' مرحله موفقانه به ' + st + ' تغیر یافت.',
              color: 'success',
              iconPack: 'feather',
              icon: 'icon-check',
              position: 'top-right'
            })
          }

        }).catch(() => {});
    },
    changeStepStatus() {
      this.expForm.step = 2;
      this.changeItTo(this.expense.id, this.expForm.step);
      return true;
    },
    approveStatus() {
      this.expForm.step = 3;
      this.changeItTo(this.expense.id, this.expForm.step)
      return true;
    }
  }
}
</script>

<style>
[dir] .vs-button:not(.vs-radius):not(.includeIconOnly):not(.small):not(.large) {
  padding: 0.75rem 2rem;
  float: left;
}
</style>
