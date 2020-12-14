<template>
<div>
  <!-- eteration -->
  <div v-for="(i , index) in items">
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
          <label for>
            <small>مقدار</small>
          </label>
          <vx-input-group class="">
            <template slot="prepend">
              <div class="prepend-text bg-primary">
                <span>AFN</span>
              </div>
            </template>
            <vs-input type="number" v-model="i.ammount" />
          </vx-input-group>
          <has-error :form="form" field="ammount"></has-error>
        </div>
      </vs-col>
      <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="4" vs-xs="12">
        <div class="w-full pt-2 ml-3 mr-3">
          <!--<label for=""><small>واحد اندازه گیری</small></label>-->
          <vs-input v-validate="'required|min:6'" v-model="i.unit_id" label="واحد اندازه گیری" name="unit_id" class="w-full" />
          <!--<v-select label="text" @input="setUnitId" v-model="i.unit_id" :options="mes_unit" :dir="$vs.rtl ? 'rtl' : 'ltr'" /> -->
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
      <vs-button type="border" @click="addNewRow" color="success" icon="add"></vs-button> &nbsp;&nbsp;
      <vs-button type="border" @click="removeRow" color="danger" icon="delete" :disabled="this.items.length <= 1"></vs-button>
    </vs-col>
  </vs-row>
</div>
</template>

<script>
import vSelect from "vue-select";

export default {
  name: 'vx-ekmalat',
  props: ['items', 'form'],
  data() {
    return {
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
    }
  },
  methods: {
    addNewRow() {
      this.items.push({
        item_id: '',
        ammount: '',
        unit_id: '',
        unit_price: '',
        total_price: '',
      })
    },
    removeRow() {
      if (this.items.length > 1) {
        this.items.splice(this.items.length - 1, 1)
      }
    },
    setItemId(arr) {
      this.items.item_id = arr.id;
    },
  },
  components: {
    'v-select': vSelect,
  }
}
</script>
