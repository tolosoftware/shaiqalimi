<template>
<vs-dropdown class="w-full pro-serial-number account-select-wrapper" id="account-select-wrapper">
  <label for="bank_account"><small>حساب بانکی</small></label>
  <vs-input autocomplete="off" size="medium" name="bank_account" :value="(this.selected) ? this.selected.name : ''" class="w-full" disabled />
  <vs-dropdown-menu class="account-select" id="account-select">
    <vs-dropdown-item v-for="(acc, i) in bankAccounts" :key="'fs' + i" @click.stop="bankAccountSelected(acc)"> <span>{{ acc.name }}</span> </vs-dropdown-item>
  </vs-dropdown-menu>
</vs-dropdown>
</template>

<script>
export default {
  props: {
    form: {
      type: Object,
      required: true,
      default: () => {}
    }
  },
  data() {
    return {
      bankAccounts: [],
      selected: ''
    }
  },
  created() {
    this.getBankAccounts();
  },
  methods:{
    findAndSet(id){
      this.bankAccounts.forEach(e => {
        if (e.id === id) {
          this.bankAccountSelected(e)
        }
      })
    },
    bankAccountSelected(data){
      this.selected = data;
      this.form.bank_account = data.id
    },
    getBankAccounts() {
      // Start the Progress Bar
      this.$Progress.start();
      this.axios
        .get("/api/bank-accounts")
        .then((data) => {
          this.bankAccounts = data.data;
          this.$Progress.set(100);
        })
        .catch(() => {});
    },

  },
}
</script>

<style>

</style>
