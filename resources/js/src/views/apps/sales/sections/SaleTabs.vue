<template>
<div>
  <vs-tabs :value="$route.query.tab">
    <vs-tab label="فورم">
      <SalesFormAdd></SalesFormAdd>
    </vs-tab>
    <vs-tab label="لیست">
      <SalesList></SalesList>
    </vs-tab>
    <!--<vs-tab label="بازرسی" id="evaluate">
      <SalesInside></SalesInside>
    </vs-tab>-->
  </vs-tabs>
</div>
</template>

<script>
import SalesFormAdd from './SalesFormAdd'
import SalesList from './SalesList'
import SalesInside from './SalesInside'
export default {
  name: 'vx-sale-tabes',
  components: {
    SalesFormAdd,
    SalesList,
    SalesInside
  },
  created() {
    // console.log('route value', this.$route)
  },
}
</script>
