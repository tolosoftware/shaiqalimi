<template>
<div>
  <div>
    <fuel-sidebar :isSidebarActive="fuelAddSidebar" @closeSidebar="toggleFuelSidebar" :data="sidebarDataFuel" :seletedStation="seletedStation" />
    <despencer-sidebar :isSidebarActive="despencerSidebar" @closeSidebar="toggleDespencer" :data="dataDespencer" :storages="storages" />
    <fuel-store-sidebar :isSidebarActive="fuelStore" @closeSidebar="toggleFuelStore" :data="dataStoreFuel" />
  </div>

  <vx-card class="mb-5">
    <div class="vx-row justify-between pr-5 pl-5">
      <div class="w-1/3">
        <label class="vs-input--label">تانک تیل</label>
        <v-select v-model="seletedStation" label="name" @input="stationChanged" :options="station" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
      </div>
      <div class="w-1/3">
        <vs-button icon-pack="feather" icon="icon-plus" icon-after class="shadow-md float-right" @click="openFuel()">ثبت تانک تیل</vs-button>
      </div>
    </div>
  </vx-card>
  <div v-if="!isdata">
    <TableLoading></TableLoading>
  </div>
  <vx-card v-if="isdata">
    <div class="vx-row">
      <div class="w-1/2 pr-2">
        <div class="justify-between">
          <vs-button type="line" line-origin="right" class="cursor-default">دسپنسرها</vs-button>
          <vs-button icon-pack="feather" icon="icon-plus" icon-after size="small" @click="openDespencer()" :disabled="Object.keys(this.seletedStation).length === 0" class="mb-5 float-right">ثبت دسپنسر</vs-button>
        </div>
        <DespencerList :depencers="allDepencers" @updateTable="getAllDepencers" />
      </div>
      <div class="w-1/2 pl-2">
        <div class="justify-between">
          <vs-button type="line" line-origin="right" class="cursor-default">ذخیره ها</vs-button>
          <vs-button icon-pack="feather" icon="icon-plus" icon-after size="small" @click="openFuelStore()" :disabled="Object.keys(this.seletedStation).length === 0" class="mb-5 float-right">ثبت ذخیره</vs-button>
        </div>
        <FuelStoreList :fuelstorage="stationStorages" @updateData="loadFuelStorage" />
      </div>
    </div>
  </vx-card>
</div>
</template>

<script>
import vSelect from 'vue-select'
import FuelStationAddSideBar from './sidebar/FuelStationAddSideBar.vue'
import FuelStoreStationAddSideBar from './sidebar/FuelStoreStationAddSideBar.vue'
import DespencerAddSideBar from './sidebar/DespencerAddSideBar.vue'
import DespencerList from './sidebar/DespencerList.vue'
import FuelStoreList from './sidebar/FuelStoreList.vue'
import TableLoading from './../../shared/TableLoading.vue'

export default {
  name: 'vx-fuelstation',
  components: {
    'v-select': vSelect,
    'fuel-sidebar': FuelStationAddSideBar,
    'fuel-store-sidebar': FuelStoreStationAddSideBar,
    'despencer-sidebar': DespencerAddSideBar,
    FuelStoreList,
    DespencerList,
    TableLoading
  },
  data() {
    return {
      isdata: false,
      station: [],
      storages: [],
      seletedStation: {},
      stationStorages: [],

      // Sidebar
      fuelAddSidebar: false,
      sidebarDataFuel: {
        id: 90
      },

      despencerSidebar: false,
      dataDespencer: {},

      fuelStore: false,
      dataStoreFuel: {},
      // End Sidebar           
      allDepencers: []
    };
  },
  methods: {
    defalutStation() {
      this.$vs.loading()
      this.$Progress.start();
      this.axios.get('/api/latestfuelstation').then(({
        data
      }) => (this.seletedStation = data, this.$Progress.set(100), this.$vs.loading.close()));
    },
    stationChanged(data) {
      this.isdata = false;
      this.getAllDepencers();
      this.loadFuelStorage();
    },
    openFuel() {
      this.sidebarDataFuel = {}
      this.toggleFuelSidebar(true)
    },
    toggleFuelSidebar(val = false) {
      this.fuelAddSidebar = val
    },

    openDespencer() {
      this.loadStorageStation();
      this.dataDespencer = this.seletedStation;
      this.toggleDespencer(true)
    },
    toggleDespencer(val = false) {
      this.despencerSidebar = val,
        this.getAllDepencers();
    },

    openFuelStore() {
      this.dataStoreFuel = this.seletedStation;
      this.toggleFuelStore(true)
    },
    toggleFuelStore(val = false) {
      this.fuelStore = val;
      this.loadFuelStorage();
    },

    loadfuelstation() {
      this.axios.get('/api/fuelstation').then(({
        data
      }) => (this.station = data));
    },
    loadStorageStation() {
      this.axios.post('/api/storage-station', this.seletedStation).then(({
        data
      }) => (this.storages = data));
    },

    loadFuelStorage() {
      this.axios.get('/api/fuelstorestation', this.seletedStation)
        .then((response) => {
          this.stationStorages = response.data.filter(c => (this.seletedStation != null && this.seletedStation.id) ? c.station_id == this.seletedStation.id : true);
          // console.log(this.stationStorages);
        });
    },

    getAllDepencers() {
      this.axios.get('/api/despenser', this.seletedStation)
        .then((resp) => {
          // console.log(this.allDepencers);
          this.allDepencers = resp.data.filter(c => (this.seletedStation != null && this.seletedStation.id) ? c.station_id == this.seletedStation.id : true);
          // console.log(this.allDepencers);

        });
    },
  },
  watch: {
    stationStorages: function () {
      if (this.stationStorages) {
        this.isdata = true;
      }
    },

  },
  created() {
    this.defalutStation();
    this.loadfuelstation();
    this.loadFuelStorage();
    this.getAllDepencers();
  }
}
</script>
