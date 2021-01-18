<template>
<div v-if="expense">
  <vs-button size="small" type="gradient" icon="print" class="mb-1" id="printBTN">چاپ</vs-button>
  <vs-row vs-w="12" class="project-view-header">
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
      <h4>&nbsp;بخش معلومات عمومی&nbsp;</h4>
    </vs-col>
  </vs-row>
  <vs-row vs-w="12">
    <vs-col :key="i" v-for="(field, i) in fields" vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
      <h6 class="mb-5 mt-3 ml-2">
        <strong class="mr-4">
          {{ (typeof field === 'object') ? $t(field[0]) : $t(field) }}:
        </strong>
        <small class="mb-5" v-if="(typeof field !== 'object')">{{ expense[field] }}</small>
        <small class="mb-5" v-if="(typeof field === 'object')">
          <span :key="i" v-for="(sub, i) in field[1]"> {{ expense[field[0]][sub] }} </span>
        </small>
      </h6>
    </vs-col>
  </vs-row>
</div>
</template>

<script>
export default {
  props: {
    expense: {
      required: false
    },
  },
  data() {
    return {
      fields: [
        'serial_no',
        'description',
      ],
    };
  },
  created() {
    this.getTransaction();
  },
  methods: {

    getTransaction() {
      if (this.$route.params.id) {
        this.$Progress.start()
        this.$vs.loading()
        this.axios.get('/api/expenses/' + this.$route.params.id)
          .then((response) => {
            this.expense = response.data;
            this.$vs.loading.close();
            this.$Progress.set(100)
          })
      }
    },
  },
};
</script>
