<template>
  <div>
    <vs-card>
      <div class="vx-row mb-3">
        <div class="vx-col w-1/2">
          <h4 class="mt-4">
            <b> اجناس </b>
          </h4>
        </div>

        <div class="vx-col w-1/2 float-left">
          <vs-button
            color="primary"
            type="filled"
            class="float-right ml-3"
            @click="addNewData"
            >اکونت جدید</vs-button
          >
        </div>
      </div>
    </vs-card>
    <vs-card>
      <div class="vx-row"></div>
    </vs-card>
  </div>
</template>
<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import vSelect from "vue-select";
export default {
  name: "vx-archive",
  components: {
    "v-select": vSelect,
    VuePerfectScrollbar,
  },
};
</script>