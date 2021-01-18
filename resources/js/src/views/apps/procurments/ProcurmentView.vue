<template>
<div v-if="purchase">
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
        <small class="mb-5" v-if="(typeof field !== 'object')">{{ purchase[field] }}</small>
        <small class="mb-5" v-if="(typeof field === 'object')">
          <span :key="i" v-for="(sub, i) in field[1]"> {{ purchase[field[0]][sub] }} </span>
        </small>
      </h6>
    </vs-col>
  </vs-row>

    <!-- Ekmalat section -->
  <vs-row vs-w="12" class="project-view-header">
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
      <h4>&nbsp;بخش اکمالات /اقلام&nbsp;</h4>
    </vs-col>
  </vs-row>
  <vs-table :data="purchase.stock">
    <template slot="thead">
      <vs-th>جنس / محصول</vs-th>
      <vs-th>مقدار</vs-th>
      <vs-th>عملیه</vs-th>
      <vs-th>قیمت فی واحد</vs-th>
      <vs-th>قیمت مجموعی</vs-th>
    </template>
    <template slot-scope="{data}">
      <vs-tr v-for="(tr, i) in data" :key="i">
        <vs-td :data="tr.item_id">
          <p> {{ tr.item_id.name }} </p>
        </vs-td>
        <vs-td :data="tr.increment_equiv">
          {{tr.increment_equiv}} {{ tr.item_id.uom_equiv_id.title }}
        </vs-td>
        <vs-td :data="tr.operation_id">
          <p> {{ tr.operation_id.formula }} </p>
        </vs-td>
        <vs-td :data="tr.unit_price">
          {{tr.unit_price}} <small style="color:#42b983;"><b>افغانی </b></small>
        </vs-td>
        <vs-td :data="tr.total_price">
          {{tr.total_price}} <small style="color:#42b983;"><b>افغانی </b></small>
        </vs-td>
      </vs-tr>
    </template>
  </vs-table>
</div>
</template>

<script>
export default {
  props: {
    purchase: {
      required: false
    },
  },
  data() {
    return {
      fields: [
        'serial_no',
        'description',
        'date_time',
        ['vendor', ['name']],
        ['user', ['firstName', 'lastName']],
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
        this.axios.get('/api/purches/' + this.$route.params.id)
          .then((response) => {
            this.purchase = response.data;
            this.$vs.loading.close();
            this.$Progress.set(100)
          })
      }
    },
  },
};
</script>
