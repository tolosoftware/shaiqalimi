<template>
<vs-row vs-w="12" class="mb-4">
  <div class="w-full">
    <div class="vx-card">
      <div class="vx-card__header">
        <div class="vx-card__title">
          <h4 class="">لست کمپنی ها</h4>
        </div>
        <!--<vs-button type="border" @click="blue=true"></vs-button>-->
      </div>
      <div class="vx-card__collapsible-content vs-con-loading__container">
        <div class="vx-card__body">
          <vs-table :data="companies" stripe>
            <template slot="thead">
              <vs-th>#</vs-th>
              <vs-th>لیبل</vs-th>
              <vs-th>علامت</vs-th>
              <vs-th>عملیه</vs-th>
            </template>
            <template slot-scope="{data}">
              <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                <vs-td :data="tr.id">
                  {{ ++indextr }}
                </vs-td>
                <vs-td :data="tr.id">
                  {{ tr.label }}
                </vs-td>
                <vs-td :data="tr.id">
                  {{ tr.sign }}
                </vs-td>
                <vs-td :data="tr.id">
                  <div class="inline-flex">
                    <vs-button @click="editCompany(tr)" size="large" color="warning" type="flat" icon-pack="feather" icon="icon-edit"></vs-button>
                    <vs-button @click="deleteCompany(tr.id)" size="large" color="warning" type="flat" icon-pack="feather" icon="icon-trash"></vs-button>
                  </div>
                </vs-td>
              </vs-tr>
            </template>
          </vs-table>
        </div>
      </div>
    </div>
  </div>
</vs-row>
</template>

<script>
export default {
  name: "companies",
  data() {
    return {
      companies: [],
    }
  },
  components: {

  },
  created() {
    this.getCompanies();
  },
  methods: {
    getCompanies() {
      this.axios.get('/api/companies')
        .then((response) => {
          this.companies = response.data;
          this.$Progress.set(100);
          this.$vs.loading.close();
        })
    },
    editCompany(row) {
      alert("edit triggered");
    },
    deleteCompany(id) {
      alert("delete clicked")
    }
  }
}
</script>
