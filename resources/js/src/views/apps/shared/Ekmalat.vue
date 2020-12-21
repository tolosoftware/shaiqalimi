<template>
<div>
  <!-- eteration -->
  <div v-for="i in items" :key="i.id">
    <vs-row vs-w="12" class="pb-2 mb-2">
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="8" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>جنس / محصول</small></label>
          <v-select label="text" @input="setItemId" v-model="i.item_id" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
          <has-error :form="form" field="item_id"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="4" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for=""><small>عملیه</small></label>
          <v-select label="title"  @input="setOperation" v-model="selectedOperation" :options="operations" :dir="$vs.rtl ? 'rtl' : 'ltr'"/>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="4" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for>
            <small>مقدار</small>
          </label>
          <vx-input-group class="">
            <template slot="append">
              <div class="append-text bg-primary">
                <span>UOM</span>
              </div>
            </template>
            <vs-input type="number" v-model="i.ammount" />
          </vx-input-group>
          <has-error :form="form" field="ammount"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" v-if="selectedOperation == 1" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <vs-input v-validate="'required'" v-model="density" label="ثقلت" class="w-full" />
          <has-error :form="form" field="density"></has-error>
          <!--<span class="text-danger text-sm" v-show="errors.has('reference_no')">{{ errors.first('reference_no') }}</span>-->
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="4" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for>
            <small>معادل</small>
          </label>
          <vx-input-group class="">
            <template slot="append">
              <div class="append-text bg-primary">
                <span>UOM</span>
              </div>
            </template>
            <vs-input v-validate="'required|min:2'" type="number" v-model="i.unit_id" />
          </vx-input-group>
          <has-error :form="form" field="unit_id"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="4" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for>
            <small>هزینه فی واحد</small>
          </label>
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>AFN</span>
              </div>
            </template>
            <vs-input type="number" v-model="i.unit_price" />
          </vx-input-group>
          <has-error :form="form" field="unit_price"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="4" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <label for>
            <small>هزینه مجموعی</small>
          </label>
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>AFN</span>
              </div>
            </template>
            <vs-input type="number" v-model="i.total_price" />
          </vx-input-group>
          <has-error :form="form" field="total_price"></has-error>
        </div>
      </vs-col>
    </vs-row>
  </div>
  <vs-row vs-w="12">
    <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="4" vs-xs="12" class="pt-2 mb-2 ml-3 mr-3">
      <vs-button type="border" @click="addNewRow" color="success" icon="add"></vs-button>
      &nbsp;&nbsp;
      <vs-button type="border" @click="removeRow" color="danger" icon="delete" :disabled="this.items.length <= 1"></vs-button>
    </vs-col>
  </vs-row>
</div>
</template>

<script>
import vSelect from "vue-select";

export default {
  name: "vx-ekmalat",
  props: ["items", "form"],
  data() {
    return {
      operations: [],
      selectedOperation: 0,
      density: null,
      itemType: [{
          text: "تیل دیزل",
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
    };
  },
  created() {
    this.getOperations();
  },
  methods: {
    setOperation(data){
      console.log(data.id);
      this.selectedOperation = data.id;
    },
    getOperations() {
      this.$Progress.start();
      this.axios.get("/api/operation").then((response) => {
        this.operations = response.data;
        this.$Progress.set(100);
      });
    },
    addNewRow() {
      this.items.push({
        item_id: "",
        ammount: "",
        unit_id: "",
        unit_price: "",
        total_price: "",
      });
    },
    removeRow() {
      if (this.items.length > 1) {
        this.items.splice(this.items.length - 1, 1);
      }
    },
    setItemId(arr) {
      this.items.item_id = arr.id;
    },
  },
  components: {
    "v-select": vSelect,
  },
};
</script>
