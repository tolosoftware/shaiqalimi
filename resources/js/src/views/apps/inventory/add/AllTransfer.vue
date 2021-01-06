<template>
<component :is="scrollbarTag" class="scroll-area--data-list-add-new" :key="$vs.rtl">
  <vx-card v-if="!isloaded" title="">
    <p style="height:40px;margin:20px;" id="success-load">
    </p>
  </vx-card>
  <div id="data-list-thumb-view" class="w-full data-list-container">
    <vs-table v-if="isloaded" ref="table" pagination :max-items="itemsPerPage" :data="transfers">
      <template slot="thead">
        <vs-th>شماره سریال</vs-th>
        <vs-th>عنوان</vs-th>
        <vs-th>هزینه مجموعی</vs-th>
        <vs-th>مسول</vs-th>
      </template>

      <template slot-scope="{data}">
        <vs-tr :key="i" v-for="(tr, i) in data">

          <vs-td :data="data[i].serial_no">
            {{ data[i].serial_no }}
          </vs-td>

          <vs-td :data="data[i].title" >
            <p>{{ data[i].title }}</p>
          </vs-td>

          <vs-td :data="data[i].total">
            {{ data[i].total }} افغانی
          </vs-td>

          <vs-td :data="data[i].supervisor" class="just-one-line">
            <p>{{ data[i].supervisor }}</p>
          </vs-td>

        </vs-tr>
        </tbody>
      </template>
    </vs-table>
  </div>
</component>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      transfers: [],
      itemsPerPage: 5,
      isloaded: false,
      isloadedrow: false,

      settings: { // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: .60
      }
    }
  },
  created() {
    this.getTransfers();
  },
  methods: {
    getTransfers() {
      this.axios
        .get("/api/transfer")
        .then((data) => {
          this.transfers = data.data;
          // Finish the Progress Bar
            this.isloaded = true;
          this.$Progress.set(100);
        })
        .catch(() => {});
    }
  },
  computed: {
    scrollbarTag() {
      return this.$store.getters.scrollbarTag
    },
    currentPage() {
      if (this.isMounted) {
        return this.$refs.table.currentx
      }
      return 0
    },
    queriedItems() {
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.transfers.length
    }

  },
}
</script>
