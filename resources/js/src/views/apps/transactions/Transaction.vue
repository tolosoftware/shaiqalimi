<template>
  <div>
    <vs-tabs>
      <vs-tab label="لیست معاملات">
        <Transaction-list></Transaction-list>
      </vs-tab>
      <vs-tab label="ثبت معاملات">
        <Transaction-add></Transaction-add>
      </vs-tab>
    </vs-tabs>
  </div>
</template>

<script>
import TransactionList from "./Transactionlist.vue";
import TransactionAdd from "./Transaction_add.vue";

export default {
  components: {
    TransactionAdd,
    TransactionList,
  },
  data() {
    return {
      itemType: [
        {
          text: "تیل دیزل",
          value: "1",
        },
        {
          text: "تیل گاز",
          value: "2",
        },
        {
          text: "تیل پطرول",
          value: "3",
        },
        {
          text: "موبلین",
          value: "4",
        },
      ],
    };
  },

  methods: {
    submitForm() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          // if form have no errors
          alert("form submitted!");
        } else {
          // form have errors
        }
      });
    },
  },
};
</script>

<style>
.customstyle {
  border-right: solid;
  border-right-width: initial;
  border-right-style: solid;
  border-right-color: initial;
}

.vs-radio {
  border-top-left-radius: 1 !important;
  border-bottom-left-radius: 1 !important;
}
</style>
