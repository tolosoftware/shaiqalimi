<template>
  <div>
    <div>
      <fuel-sidebar
        :isSidebarActive="fuelAddSidebar"
        @closeSidebar="toggleFuelSidebar"
        :data="sidebarDataFuel"
      />

      <despencer-sidebar
        :isSidebarActive="despencerSidebar"
        @closeSidebar="toggleDespencer"
        :data="dataDespencer"
      />

      <fuel-store-sidebar
        :isSidebarActive="fuelStore"
        @closeSidebar="toggleFuelStore"
        :data="dataStoreFuel"
      />
    </div>

    <vx-card class="mb-5">
      <div class="vx-row justify-between pr-5 pl-5">
        <div class="w-1/3">
          <label for>
            <small>تانک تیل</small>
          </label>
          <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
        </div>
        <div class="w-1/3">
          <vs-button
            icon-pack="feather"
            icon="icon-chevrons-left"
            icon-after
            class="shadow-md float-right"
            @click="openFuel()"
          >ثبت تانک تیل</vs-button>
        </div>
      </div>
    </vx-card>
    <vx-card>
      <div class="vx-row">
        <div class="w-1/2 pr-2">
          <vs-button
            type="filled"
            @click="openDespencer()"
            class="mb-5 block float-right"
          >ثبت دسپنسر</vs-button>
          <DespencerList />
        </div>
        <div class="w-1/2 pl-2">
          <vs-button type="filled" @click="openFuelStore()" class="mb-5 block float-right">ثبت ذخیره</vs-button>
          <FuelStoreList />
        </div>
      </div>
    </vx-card>
  </div>
</template>
<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import vSelect from 'vue-select'
import FuelStationAddSideBar from './sidebar/FuelStationAddSideBar.vue'
import FuelStoreStationAddSideBar from './sidebar/FuelStoreStationAddSideBar.vue'
import DespencerAddSideBar from './sidebar/DespencerAddSideBar.vue'
import DespencerList from './sidebar/DespencerList.vue'
import FuelStoreList from './sidebar/FuelStoreList.vue'

export default {
  name: 'vx-archive',
  components: {
    'v-select': vSelect,
    VuePerfectScrollbar,
    'fuel-sidebar': FuelStationAddSideBar,
    'fuel-store-sidebar': FuelStoreStationAddSideBar,
    'despencer-sidebar': DespencerAddSideBar,
    FuelStoreList,
    DespencerList
  },
  data() {
    return {
      // Sidebar
      fuelAddSidebar: false,
      sidebarDataFuel: {},

      despencerSidebar: false,
      dataDespencer: {},

      fuelStore: false,
      dataStoreFuel: {},

      // End Sidebar
      itemType: [{
        text: "تانک تیل احمدیار",
        value: "1",
      },
      {
        text: "تانک تیل مکرویان",
        value: "2",
      },
      {
        text: "تانک تیل اصلی",
        value: "3",
      },
      ],
    };
  },
  methods: {
    openFuel() {
      this.sidebarDataFuel = {}
      this.toggleFuelSidebar(true)
    },
    toggleFuelSidebar(val = false) {
      this.fuelAddSidebar = val
    },

    openDespencer() {
      this.dataDespencer = {}
      this.toggleDespencer(true)
    },
    toggleDespencer(val = false) {
      this.despencerSidebar = val
    },

    openFuelStore() {
      this.dataStoreFuel = {}
      this.toggleFuelStore(true)
    },
    toggleFuelStore(val = false) {
      this.fuelStore = val
    },
  },
}
</script>