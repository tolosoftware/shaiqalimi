<template>
<div>
  <div slot="header">صلاحیت های کاربر را انتخاب کنید</div>
  <vs-row class="pt-5 pb-5">
    <ul class="demo-alignment flex space-between">
      <li v-for="(n, index) in privileges" :key="index" class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pt-3 pb-3">
        <div class="vs-component con-vs-checkbox vs-checkbox-success vs-checkbox-default">
          <input type="checkbox" class="vs-checkbox--input" v-model="n.assign" @click="n.assign = !n.assign">
          <span class="checkbox_x vs-checkbox" style="border: 2px solid rgb(180, 180, 180);">
            <span class="vs-checkbox--check">
              <i class="vs-icon notranslate icon-scale vs-checkbox--icon  material-icons null">check</i>
            </span>
          </span>
          <span class="con-slot-label">{{n.name}}</span>
        </div>
      </li>
    </ul>
    <vs-col class="sm:w-1 md:w-1/2 lg:w-1/4 xl:w-1/4 pt-3 pb-3">
      <div class="w-full">
        <vs-button class="w-full mt-6 input-height" @click.stop="storePrivilages(privileges)">ثبت صلاحیت های کابر</vs-button>
      </div>
    </vs-col>

  </vs-row>
</div>
</template>

<script>
export default {
  props: {
    source: {
      required: false
    },
  },
  data() {
    return {
      privileges: [],
      user_id: null,
    }
  },
  methods: {
    getPermissions() {
      this.axios.get('/api/permissions')
        .then((response) => {
          this.privileges = response.data;
          this.$emit('closeModal');
        })
    },
    storePrivilages(p) {
      this.axios.post('/api/permissions', [this.source.id, this.privileges.filter((e) => e.assign === true)])
        .then((response) => {
          this.privileges = response.data;
          this.$emit('closeModal');
        })
    },
    // updatePrivilegeTable(userprivilege, user_id){
    //   // this.user_id = user_id;
    //   // for (let [key, value] of Object.entries(this.privileges)) {
    //   //   if (userprivilege.find(({
    //   //       id
    //   //     }) => value.id === id)) {
    //   //     this.privileges[key]['assign'] = true;
    //   //   }
    //   // }
    //   // console.log(this.privileges);
    // }
  }

}
</script>

<style>

</style>
