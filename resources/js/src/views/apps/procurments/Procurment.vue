<template>
<div>
  <vs-tabs>
    <vs-tab label="ثبت خریداری">
      <ProcurmentaddNew></ProcurmentaddNew>
    </vs-tab>
    <vs-tab label="لیست خریداری">
      <Procurmentlist></Procurmentlist>
    </vs-tab>
  </vs-tabs>
</div>
</template>

<script>
import Procurmentlist from './Procurmentlist.vue'
import ProcurmentaddNew from './ProcurmentaddNew.vue'

export default {
  components: {
    Procurmentlist,
    ProcurmentaddNew
  },
}
</script>


