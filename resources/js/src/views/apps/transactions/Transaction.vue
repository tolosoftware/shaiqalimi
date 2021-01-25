<template>
<div>
  <vs-tabs>
    <vs-tab label="ثبت معاملات">
      <TransactionAdd></TransactionAdd>
    </vs-tab>
    <vs-tab label="لیست معاملات">
      <Transactionlist></Transactionlist>
    </vs-tab>
  </vs-tabs>
</div>
</template>

<script>
import Transactionlist from "./Transactionlist.vue";
import TransactionAdd from "./Transactionadd.vue";

export default {
  components: {
    Transactionlist,
    TransactionAdd,

  },
};
</script>
