<template>
  <div>
    <Godamsadd
      :isSidebarActive="addNewDataSidebar"
      @closeSidebar="toggleDataSidebar"
      :data="sidebarData"
    />
    <div class="vx-row">
      <vs-card>
        <div class="vx-row">
          <div class="vx-col w-1/2">
            <h5 class="mt-4">
              <!-- <b class="float-left">
                <br />
                گدام ها : &nbsp;&nbsp;
              </b> -->
              <v-select
                label="text"
                class="float"
                :options="itemType"
                :dir="$vs.rtl ? 'rtl' : 'ltr'"
              />
            </h5>
            <br />
            <!-- <div class=""> -->
            <!-- <label for="" class="float-right">انتخاب گدام ;</label> -->
            <!-- </div> -->
          </div>

          <div class="vx-col w-1/2 float-left">
            <vs-button
              color="primary"
              type="filled"
              class="float-right ml-3"
              @click="addNewData"
            >
              ثبت اجناس جدید برای گدام</vs-button
            >
          </div>
        </div>
        <hr />
        <br />
        <ListOfGodam></ListOfGodam>
      </vs-card>
    </div>
  </div>
</template>
<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import Godamsadd from "./Godams_add.vue";
import ListOfGodam from "./DatatableSample.vue";
import vSelect from "vue-select";
export default {
  name: "vx-archive",
  data: () => ({
    // Data Sidebar
    addNewDataSidebar: false,
    sidebarData: {},
    currentx: 14,
    fruits: ["لست اجناس"],
    itemType: [
      {
        text: "تیل دیزل",
        seleted: "selected",
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

    users: [
      {
        id: 1,
        name: "Leanne Graham",
        username: "Bret",
        email: "Sincere@april.biz",
        website: "hildegard.org",
      },
      {
        id: 2,
        name: "Ervin Howell",
        username: "Antonette",
        email: "Shanna@melissa.tv",
        website: "anastasia.net",
      },
      {
        id: 3,
        name: "Clementine Bauch",
        username: "Samantha",
        email: "Nathan@yesenia.net",
        website: "ramiro.info",
      },
      {
        id: 4,
        name: "Patricia Lebsack",
        username: "Karianne",
        email: "Julianne.OConner@kory.org",
        website: "kale.biz",
      },
      {
        id: 5,
        name: "Chelsey Dietrich",
        username: "Kamren",
        email: "Lucio_Hettinger@annie.ca",
        website: "demarco.info",
      },
      {
        id: 6,
        name: "Mrs. Dennis Schulist",
        username: "Leopoldo_Corkery",
        email: "Karley_Dach@jasper.info",
        website: "ola.org",
      },
      {
        id: 7,
        name: "Kurtis Weissnat",
        username: "Elwyn.Skiles",
        email: "Telly.Hoeger@billy.biz",
        website: "elvis.io",
      },
    ],
  }),

  components: {
    "v-select": vSelect,
    VuePerfectScrollbar,
    Godamsadd,
    ListOfGodam,
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