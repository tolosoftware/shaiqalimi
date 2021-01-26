<template>
<div>
  <vs-tabs>
    <vs-tab label="ثبت خریداری">
      <ProcurmentaddForm></ProcurmentaddForm>
    </vs-tab>
    <vs-tab label="لیست خریداری">
      <Procurmentlist></Procurmentlist>
    </vs-tab>
  </vs-tabs>
</div>
</template>

<script>
import Procurmentlist from './Procurmentlist.vue'
import ProcurmentaddForm from './ProcurmentaddForm.vue'

export default {
  components: {
    Procurmentlist,
    ProcurmentaddForm
  },
}
</script>
