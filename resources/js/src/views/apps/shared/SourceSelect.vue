<template>
<div class="source-select-wrapper" id="source-select-wrapper">
  <vs-dropdown>
    <vs-input :value="parentForm.source_id ? selection : ''" disabled autocomplete="off" class="w-full" />
    <vs-dropdown-menu class="source-select" id="source-select" :style="getBannerStyle">
      <vs-dropdown-group vs-label="ذخایر عمومی">
        <vs-dropdown-item v-for="(item, i) in sources.str" :key="'str' + i" @click="ddSelected(item, 'STRG')"> {{ item.name }} </vs-dropdown-item>
      </vs-dropdown-group>

      <vs-dropdown-group vs-label="تانک تیل">
        <vs-dropdown-group vs-label="" class="fuel-station">
          <vs-dropdown-group vs-collapse vs-icon="add" v-for="(fuel, i) in sources.fuel" :key="'f' + i" @click="ddSelected(fuel, 'fuel', )" :vs-label="fuel.name">
            <vs-dropdown-item v-for="(item, i) in fuel.fuel_station_storages" :key="'fs' + i" @click="ddSelected(item, 'FSTR', fuel)"> {{ item.name }} </vs-dropdown-item>
            <vs-dropdown-item v-for="(item, i) in fuel.fuel_despencers" :key="'fd' + i" @click="ddSelected(item, 'FDSP', fuel)"> {{ item.name }} </vs-dropdown-item>
          </vs-dropdown-group>
        </vs-dropdown-group>
      </vs-dropdown-group>

      <vs-dropdown-group vs-label="گدام ها">
        <vs-dropdown-item v-for="(item, i) in sources.inv" :key="'s' + i" @click="ddSelected(item, 'STOK')"> {{ item.name }} </vs-dropdown-item>
      </vs-dropdown-group>
    </vs-dropdown-menu>
  </vs-dropdown>
</div>
</template>

<script>
import vSelect from "vue-select";

export default {
  props: ['parentForm'],
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      offsetWidth: 100,
      sources: [],
      selection: ""
    }
  },
  created() {
    this.getStorages();
  },
  methods: {
    ddSelected(data, type, parent = null) {
      this.parentForm.source_id = data;
      this.parentForm.source_type = type;
      if (parent) {
        this.selection = parent.name + ' - ' + this.parentForm.source_id.name;
      } else {
        this.selection = this.parentForm.source_id.name;
      }
    },
    getStorages() {
      // Start the Progress Bar
      this.$Progress.start();

      this.axios
        .get("/api/sources")
        .then((data) => {
          this.sources = data.data;
          this.$Progress.set(100);
        })
        .catch(() => {});
    },
  },
  mounted() {
    this.offsetWidth = document.getElementById('source-select-wrapper').offsetWidth
  },
  computed: {
    getBannerStyle() {
      return `width: ${this.offsetWidth}px;`
    }
  }
}
</script>

<style lang="">

</style>
