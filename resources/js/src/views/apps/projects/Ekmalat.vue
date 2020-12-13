<template>
<div>
  <!-- eteration -->
  <div v-for="(i , index) in items" v-bind:key="index" class="vx-row">
    <div class="vx-col w-1/4 mt-4">
      <label for>
        <small>محصول</small>
      </label>
      <v-select label="text" v-model="i.product" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
    </div>

    <div class="vx-col w-1/4 pt-4">
      <!-- TITLE -->
      <label for>
        <small>مقدار</small>
      </label>
      <vx-input-group class="mb-base">
        <template slot="prepend">
          <div class="prepend-text bg-primary">
            <span>AFN</span>
          </div>
        </template>

        <vs-input type="number" v-model="i.amount" />
      </vx-input-group>
      <!-- /TITLE -->
    </div>

    <div class="vx-col w-1/4">
      <vs-input size="medium" v-model="i.equal" label=" معادل" class="mt-5 w-full" />
      <span class="text-danger text-sm" v-show="errors.has('equal')">{{ errors.first("equal") }}</span>
    </div>

    <div class="vx-col w-1/4 pt-4">
      <!-- TITLE -->
      <label for>
        <small>هزینه</small>
      </label>
      <vx-input-group class="mb-base">
        <template slot="prepend">
          <div class="prepend-text bg-primary">
            <span>AFN</span>
          </div>
        </template>

        <vs-input type="number" v-model="i.price" />
      </vx-input-group>
      <!-- /TITLE -->
    </div>
  </div>

  <!-- end eteration -->

  <div class="vx-row">
    <div class="inline-flex">
      <!-- TITLE -->
      <vs-button title="افزودن" class="m-2" color="success" type="filled" @click="addNewRow" icon-pack="feather" icon="icon-plus"></vs-button>
      <vs-button title="حذف" :disabled="this.items.length <= 1" class="m-2" color="danger" type="filled" @click="removeRow" icon-pack="feather" icon="icon-x"></vs-button>

      <!-- /TITLE -->
    </div>
  </div>
  <!-- Length should not be less than the specified length : 3 -->
  <div class="vx-col mb-base w-1/3 pt-4">
    <!-- TITLE -->
    <label for>
      <small>ارزش قرارداد</small>
    </label>
    <vx-input-group>
      <template slot="prepend">
        <div class="prepend-text bg-primary">
          <span>AFN</span>
        </div>
      </template>

      <vs-input type="number" v-model="items" />
    </vx-input-group>
    <has-error :form="form" field="price"></has-error>
    <!-- /TITLE -->
  </div>
</div>
</template>

<script>
import vSelect from "vue-select";

export default {
  name: 'vx-ekmalat',
  props: ['items', 'form'],
  data (){
    return{
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
        product: '',
        amount: '',
        equal: '',
        price: '',
      })
    },
    removeRow() {
      if (this.items.length > 1) {
        this.items.splice(this.items.length - 1, 1)
      }
    },
  },
  components: {
    'v-select': vSelect,
  }
}
</script>
