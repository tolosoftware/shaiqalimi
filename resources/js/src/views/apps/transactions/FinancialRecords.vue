<template>
<div id="data-list-thumb-view" class="w-full data-list-container">
  <div class="balance_currency_toggle sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pr-3 pb-2 pt-3">
    <div class="radio-group w-full">
      <div class="w-1/2">
        <input type="radio" v-model="currency_display" value="afn" id="struct" name="curency" />
        <label for="struct" class="w-full text-center">افغانی</label>
      </div>
      <div class="w-1/2">
        <input type="radio" v-model="currency_display" value="usd" id="specific" name="curency" />
        <label for="specific" class="w-full text-center">دالر</label>
      </div>
    </div>
  </div>
  <vs-alert class="balance_currency_value flex" v-if="recordsData[currency_display]" :color="recordsData[currency_display] > 0 ? 'success' : 'danger'" active="true">
    <span>بیلانس : </span>
    <p dir="ltr">&nbsp;{{ recordsData[currency_display].toFixed(2) }}&nbsp;</p>
    <span> {{ $t(currency_display) }}</span>
  </vs-alert>
  <vs-table class="w-full" ref="table" pagination :max-items="itemsPerPage" search :data="recordsData['fr']">
    <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">
      <!-- ITEMS PER PAGE -->
      <vs-dropdown v-if="recordsData != null && recordsData.length > 4" vs-trigger-click class="cursor-pointer mb-4 mr-4">
        <div class="pl-4 pr-4 pt-1 pb-1 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
          <span class="mr-2">
            {{ currentPage * itemsPerPage - (itemsPerPage - 1) }} -
            {{
              recordsData.length - currentPage * itemsPerPage > 0
              ? currentPage * itemsPerPage
              : recordsData.length
              }}
            از {{ queriedItems }}
          </span>
          <!-- <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ recordsData.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : recordsData.length }} از {{ queriedItems }}</span> -->
          <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
        </div>
        <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
        <vs-dropdown-menu>
          <vs-dropdown-item @click="itemsPerPage = 4">
            <span>۴</span>
          </vs-dropdown-item>
          <vs-dropdown-item @click="itemsPerPage = 10">
            <span>۱۰</span>
          </vs-dropdown-item>
          <vs-dropdown-item @click="itemsPerPage = 15">
            <span>۱۵</span>
          </vs-dropdown-item>
          <vs-dropdown-item @click="itemsPerPage = 20">
            <span>۲۰</span>
          </vs-dropdown-item>
        </vs-dropdown-menu>
      </vs-dropdown>
    </div>

    <template slot="thead">
      <vs-th :key="i" v-for="(field, i) in tableFields">{{ field.label }}</vs-th>
    </template>

    <template slot-scope="{data}">
      <tbody>
        <vs-tr :key="i" v-for="(tr, i) in data">
          <vs-td :key="i" v-for="(field, i) in tableFields">
            {{ (field.sub) ? $t(tr[field.title][field.sub]) : $t(tr[field.title]) }}
          </vs-td>
        </vs-tr>
      </tbody>
    </template>
  </vs-table>
</div>
</template>

<script>
export default {
  props: ['recordsData'],
  data() {
    return {
      currency_display: 'afn',
      popupActive: false,
      itemsPerPage: 5,
      isMounted: false,
      tableFields: [{
          title: 'description',
          label: 'تفصیلات'
        },
        {
          title: 'credit',
          label: 'کردت'
        },
        {
          title: 'debit',
          label: 'دیبت'
        },
        {
          title: 'currency',
          label: 'واحد پولی',
          sub: 'sign_fa'
        },
        {
          title: 'exchange_rate',
          label: 'نرخ',
          sub: 'rate'
        },
        {
          title: 'status',
          label: 'نوعیت'
        },
        {
          title: 'type',
          label: 'منبع'
        },
      ]
    }
  },
  computed: {
    currentPage() {
      if (this.isMounted) {
        return this.$refs.table.currentx;
      }
      return 0;
    },
    queriedItems() {
      return this.$refs.table ?
        this.$refs.table.queriedResults.length :
        (this.recordsData) ? this.recordsData.length : 0;
    },
  },
  created() {

  }

}
</script>
