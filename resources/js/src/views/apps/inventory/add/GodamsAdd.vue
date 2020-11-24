<template>
  <div>
    <Godamsadd
      :isSidebarActive="addNewDataSidebar"
      @closeSidebar="toggleDataSidebar"
      :data="sidebarData"
    />
    <div class="vx-row">
      <vs-card>
        <div class="vx-row mb-3">
          <div class="vx-col w-1/2">
            <h4 class="mt-4 float-left">
              <b> گدام ها ؛</b>
            </h4>
            <!-- &nbsp; &nbsp; &nbsp; &nbsp; -->
            <div class="float-left">
              &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
              &nbsp; &nbsp; &nbsp;
              <label for="" class="float-left">انتخاب گدام ;</label>
              <span>&nbsp; &nbsp; &nbsp;</span>
              <v-select
                label="text"
                class=""
                :options="itemType"
                :dir="$vs.rtl ? 'rtl' : 'ltr'"
              />
            </div>
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
        <div v-for="fruit in fruits" :key="fruit">
          <vs-table max-items="3" pagination :data="users">
            <!-- <template slot="header">
              <h4 class="p-4">
                <b>
                  {{ fruit }}
                </b>
              </h4>
            </template> -->
            <template slot="thead">
              <vs-th> شماره </vs-th>
              <vs-th> کتگوری </vs-th>
              <vs-th> محصول </vs-th>
              <vs-th> موجودی </vs-th>
            </template>

            <template slot-scope="{ data }">
              <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                <vs-td :data="data[indextr].id">
                  {{ data[indextr].id }}
                </vs-td>
                <vs-td :data="data[indextr].email">
                  {{ data[indextr].email }}
                </vs-td>

                <vs-td :data="data[indextr].username">
                  {{ data[indextr].username }}
                </vs-td>

                <vs-td :data="data[indextr].id">
                  {{ data[indextr].website }}
                </vs-td>
              </vs-tr>
            </template>
          </vs-table>
        </div>
      </vs-card>
    </div>
  </div>
</template>
<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import Godamsadd from "./Godams.vue";
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