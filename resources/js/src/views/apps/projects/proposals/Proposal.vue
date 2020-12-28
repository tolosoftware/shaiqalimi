<template>
<div>
  <Clients :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />
  <vs-tabs>
    <vs-tab label="ثبت اعلان" style="padding:2px 0px 0px 0px !important;">
      <vx-card class="height-vh-80">
        <div class="header">
          <vs-row vs-w="12">
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="2" vs-sm="4" vs-xs="4">
              <div class="">
                <h3 class="pt-1 pr-5 mr-5 ml-4 w-full">
                  فورم ثبت اعلانات
                </h3>
              </div>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="4" vs-xs="1"></vs-col>
            <vs-col vs-type="flex" vs-justify="left" vs-align="left" vs-lg="2" vs-sm="4" vs-xs="7">
              <div class="w-full">
                <vs-button type="filled" @click="addNewData" icon="add">ثبت نهاد جدید </vs-button>
              </div>
            </vs-col>
          </vs-row>
          <br>
          <hr>
          <!--<vs-divider/> -->
        </div>
        <add-proposal></add-proposal>
      </vx-card>
    </vs-tab>
    <vs-tab label="لیست اعلانات">
      <div class="vx-row">
        <ProposalList :editId="edit_id" ></ProposalList>
      </div>
    </vs-tab>
    <vs-tab v-if="edit_id" label="ویرایش اعلانات">
      <div class="vx-row">
        {{ edit_id }}
      </div>
    </vs-tab>
  </vs-tabs>
</div>
</template>

<script>
import ProposalList from './ProposalList.vue'
import AddProposal from './AddProposal.vue'
import Clients from './Clients.vue'

export default {
  components: {
    ProposalList,
    AddProposal,
    Clients,
  },
  data() {
    return {
      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {},
      edit_id: 0,
    }
  },
  computed: {
    isFormValid() {
      return Object.keys(this.fields).some(key => this.fields[key].validated) && Object.keys(this.fields).some(key => this.fields[key].valid);
    }
  },
  mounted() {
    this.isMounted = false;
    this.$validator.validate();
  },
  created() {},
  methods: {
    addNewData() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },

    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val
    }

  },
}
</script>

<style scoped>
.vs-icon {
  color: inherit;
  text-align: center;
  font-size: 2rem;
}
</style>
