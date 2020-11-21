<template>
<div>
   <Accountadd :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />
  <vs-card>
    <div class="vx-row mb-3">
     <div class="vx-col w-1/2">
    
        <h3 class="mt-4">
          <b>
 لیست حسابات    
          </b>
         
          </h3>
     
               
      </div>

      <div class="vx-col w-1/2 float-left">
       <vs-button color="primary" type="filled" class="float-right ml-3" @click="addNewData">اکونت جدید</vs-button>
                <vs-input icon-after="true" label-placeholder="icon-after" icon="search" placeholder="Search account" class="mt-1 float-right" style="max-width:320px"/>
               
      </div>

      
      

    </div>
     
  </vs-card>
  <vs-card  v-for="fruit in fruits" :key="fruit">
   <vs-table max-items="3" pagination :data="users">
      <template slot="header">
        <h4 class="p-4">
          <b>
   {{ fruit}}
          </b>
      
        </h4>
      </template>
      <template slot="thead">
        <vs-th>
          Email
        </vs-th>
        <vs-th>
          Name
        </vs-th>
        <vs-th>
          Website
        </vs-th>
        <vs-th>
          Nro
        </vs-th>
      </template>

      <template slot-scope="{data}">
        <vs-tr :key="indextr" v-for="(tr, indextr) in data" >
          <vs-td :data="data[indextr].email">
            {{data[indextr].email}}
          </vs-td>

          <vs-td :data="data[indextr].username">
            {{data[indextr].username}}
          </vs-td>

          <vs-td :data="data[indextr].id">
            {{data[indextr].website}}
          </vs-td>

          <vs-td :data="data[indextr].id">
            {{data[indextr].id}}
          </vs-td>
        </vs-tr>
      </template>
    </vs-table>
    </vs-card>

     <vs-pagination :total="40" v-model="currentx"></vs-pagination>
</div>
</template>
<script>
import Accountadd from './Accountadd.vue'
import vSelect from 'vue-select'
export default {

  components:{
    'v-select': vSelect,
    Accountadd
  },
  data:()=>({

    // Data Sidebar
    addNewDataSidebar: false,
    sidebarData: {},
    currentx: 14,
    fruits: ['قراداد ها', 'بانکها', 'دارایی ها','مشتریان', 'مصارف'],

    users:[
      {
        "id": 1,
        "name": "Leanne Graham",
        "username": "Bret",
        "email": "Sincere@april.biz",
        "website": "hildegard.org",
      },
      {
        "id": 2,
        "name": "Ervin Howell",
        "username": "Antonette",
        "email": "Shanna@melissa.tv",
        "website": "anastasia.net",
      },
      {
        "id": 3,
        "name": "Clementine Bauch",
        "username": "Samantha",
        "email": "Nathan@yesenia.net",
        "website": "ramiro.info",
      },
      {
        "id": 4,
        "name": "Patricia Lebsack",
        "username": "Karianne",
        "email": "Julianne.OConner@kory.org",
        "website": "kale.biz",
      },
      {
        "id": 5,
        "name": "Chelsey Dietrich",
        "username": "Kamren",
        "email": "Lucio_Hettinger@annie.ca",
        "website": "demarco.info",
      },
      {
        "id": 6,
        "name": "Mrs. Dennis Schulist",
        "username": "Leopoldo_Corkery",
        "email": "Karley_Dach@jasper.info",
        "website": "ola.org",
      },
      {
        "id": 7,
        "name": "Kurtis Weissnat",
        "username": "Elwyn.Skiles",
        "email": "Telly.Hoeger@billy.biz",
        "website": "elvis.io",
      },
     
    ]
  }),

   methods: {
  addNewData () {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
  toggleDataSidebar (val = false) {
  this.addNewDataSidebar = val
   }



  },
}
</script>
<style lang="stylus">
 .vs-input--icon {
   top: 12px;
 }
</style>