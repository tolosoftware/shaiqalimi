<template>
<div class="demo-alignment">
  <vs-dropdown>
    <div>AAAAAAAAAAAAAAA</div>
    <vs-dropdown-menu>
      <vs-dropdown-group vs-label="ذخایر عمومی">
        <vs-dropdown-item @click="ddSelected('storage 1')"> ذخیره 1 </vs-dropdown-item>
        <vs-dropdown-item @click="ddSelected('storage 2')"> ذخیره 2 </vs-dropdown-item>
      </vs-dropdown-group>
      <vs-dropdown-group vs-collapse vs-label="تانک تیل">
        <vs-dropdown-group>
          <vs-dropdown-group vs-collapse @click="ddSelected('tank til ahmad')" vs-label="تانک تیل احمدیار">
            <vs-dropdown-group vs-collapse @click="ddSelected('storage of tank til')" vs-label="ذخیره تانک تیل احمدیار">
              <vs-dropdown-item @click="ddSelected('dispenser 1')">دسپنسر ۱ </vs-dropdown-item>
              <vs-dropdown-item @click="ddSelected('dispenser 2')"> دسپنسر ۲</vs-dropdown-item>
            </vs-dropdown-group>
          </vs-dropdown-group>
        </vs-dropdown-group>
      </vs-dropdown-group>
      <vs-dropdown-group vs-label="گدام ها">
        <vs-dropdown-item @click="ddSelected('godam 1')"> گدام 1 </vs-dropdown-item>
        <vs-dropdown-item @click="ddSelected('godam 2')"> گدام 2 </vs-dropdown-item>
      </vs-dropdown-group>
    </vs-dropdown-menu>
  </vs-dropdown>
</div>

<!-- <div class="vx-col w-full">
  <label for class="vs-input--label">منبع</label>
  <v-select  label="name" :options="sources" :searchable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'">
    <span slot="no-options">{{ $t("WhoopsNothinghere") }}</span>
  </v-select>
</div> -->
</template>

<script>
import vSelect from "vue-select";

export default {
  props: ["sForm"],
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      sources: [],
    }
  },
  created() {
    this.getStorages();
  },
  methods: {
    ddSelected(data) {
      console.log(data);
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
}
</script>

<style lang="">

</style>
