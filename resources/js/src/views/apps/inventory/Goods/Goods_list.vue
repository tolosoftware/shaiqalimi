<template>
<div>
  <Goodadd :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />
  <div class="vx-row">
    <vs-card>
      <div class="vx-row mb-3">
        <div class="vx-col w-1/2">
          <h4 class="mt-4">
            <b> اجناس </b>
          </h4>
        </div>
        <div class="vx-col w-1/2 float-left">
          <vs-button color="primary" type="filled" class="float-right ml-3" @click="addNewData">ثبت جنس جدید</vs-button>
        </div>
      </div>
      <hr />
      <br />
      <Itemlist ref="godamslist"></Itemlist>
    </vs-card>
  </div>
  <!-- <vs-card>
      <div class="vx-row"></div>
    </vs-card> -->
</div>
</template>

<script>
import Goodadd from "./Goods_add.vue";
import Itemlist from "./Item_list.vue";
import vSelect from "vue-select";
export default {
  name: "vx-godams",
  data: () => ({
    // Data Sidebar
    addNewDataSidebar: false,
    sidebarData: {},
    currentx: 14,
  }),
  created() {
    this.$on('updateselection', function (value) {
      this.$refs.godamslist.loaditem();
    });
  },
  components: {
    "v-select": vSelect,
    Goodadd,
    Itemlist,
  },
  methods: {
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

<style lang="stylus">
.vs-input--icon {
  top: 12px;
}

.customstyle {
  border-right: solid;
  border-right-width: initial;
  border-right-style: solid;
  border-right-color: initial;
}
</style>
