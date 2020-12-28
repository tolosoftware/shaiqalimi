<template>
  <div>
    <Clients
      :isSidebarActive="addNewDataSidebar"
      @closeSidebar="toggleDataSidebar"
      :data="sidebarData"
    />
    <div class="vx-row">
      <vx-card>
        <div class="vx-row">
          <div class="vx-col w-1/2">
            <h3>فارم ویرایش پروژه قرار دادی</h3>
          </div>
        </div>
        <project-form></project-form>
      </vx-card>
    </div>
  </div>
</template>

<script>
import vSelect from "vue-select";
import Clients from "./proposals/Clients.vue";
import DataViewSidebar from "./DataViewSidebar.vue";
import moduleDataList from "./data-list/moduleDataList.js";
import ProjectList from "./ProjectList.vue";
import ProjectForm from "./ProjectForm.vue";

export default {
  components: {
    Clients,
    ProjectList,
    ProjectForm,
    "v-select": vSelect,
  },
  data() {
    return {
      // init values
      announces: [],
      org: [],
      selectedAnnounce: null,
      selectedOrg: null,

      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {},
    };
  },
  created() {

  },
  methods: {
    
    // submitForm(id) {
    //   // Start the Progress Bar
    //   this.$Progress.start()
    //   // this.$vs.loading({type: 'border',color: '#432e81'});
    //   this.pForm.patch('/api/project/' + this.$route.params.id)
    //     .then(({data}) => {
    //       // Finish the Progress Bar
    //       this.$Progress.set(100)
    //       // toast notification
    //       this.$vs.notify({
    //         title: 'موفقیت!',
    //         text: 'قرارداد ' + data.title + ' موفقانه آپدیت شد.',
    //         color: 'success',
    //         iconPack: 'feather',
    //         icon: 'icon-check',
    //         position: 'top-right'
    //       })
    //     });
    // },
    addNewData() {
      this.sidebarData = {};
      this.toggleDataSidebar(true);
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val;
    },
    // End Custom
    addNewData() {
      this.sidebarData = {};
      this.toggleDataSidebar(true);
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val;
    },
  },
};
</script>

<style lang="scss">

</style>