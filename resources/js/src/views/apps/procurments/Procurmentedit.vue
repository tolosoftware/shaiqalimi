<template>
<div>
   
    <vs-tabs>
        <vs-tab label="ویرایش خریداری">
            <div class="vx-row">
                <vx-card class="height-vh-80">
                    <div class="vx-row">
                        <div class="vx-col w-1/2">
                            <h3>فارم ویرایش خریداری</h3>
                        </div>
                      
                    </div>

                    <form>
                        <vs-row vs-w="12">
                            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
                                <div class="w-full pt-2 ml-3 mr-3">
                                    <vs-input size="medium" v-validate="'serialnumber'" label="سریال نمبر" name="serialnumber" v-model="prForm.serial_no" class="w-full" disabled />
                                    <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first("serialnumber") }}</span>
                                </div>
                            </vs-col>

                             <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
                                <div class="w-full pt-2 ml-3 mr-3">
                                    <label for>واحد پولی</label>
                                    <div class="radio-group w-full">
                                        <div class="w-1/2">
                                            <input type="radio" id="afn" name="currency" value="1"   v-model="prForm.currency_id"/>
                                            <label for="afn" class="w-full text-center">افغانی</label>
                                        </div>
                                        <div class="w-1/2">
                                            <input type="radio" id="usd" name="currency" value="2" v-model="prForm.currency_id"/>
                                            <label for="usd" class="w-full text-center">دالر</label>
                                        </div>
                                    </div>
                                </div>
                            </vs-col>

                             <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
                                <div class="w-full  ml-3 mr-3">
                                  <label for="date" class="mt-3"><small>تاریخ </small></label>
                                  <date-picker color="#e85454" :auto-submit="true"  type="datetime" v-model="prForm.date_time" />
                                </div>
                              </vs-col>


                            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
                                <div class="w-full pt-2 ml-3 mr-3">
                                    <label for>
                                        <small> نام فروشنده</small>
                                    </label>
                                    <v-select label="name" :options="allvendors" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="prForm.vendor_id"  @input="setVendordata"/>
                                </div>
                            </vs-col>
                            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                                <div class="w-full pt-2 ml-3 mr-3">
                                    <vs-input size="medium" v-validate="'serialnumber'" label="شماره تماس"  class="w-full" v-model="prForm.phone"/>
                                    <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first("serialnumber") }}</span>
                                </div>
                            </vs-col>
                            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                                <div class="w-full pt-2 ml-3 mr-3">
                                    <vs-input size="medium" v-validate="'serialnumber'" label="آدرس"  class="w-full" v-model="prForm.address"/>
                                    <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first("serialnumber") }}</span>
                                </div>
                            </vs-col>
                            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                                <div class="w-full pt-2 ml-3 mr-3">
                                    <label for>
                                        <small>ذخیره اصلی</small>
                                    </label>
                                    <v-select label="source" :options="storage" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="prForm.source_id" />
                                </div>
                            </vs-col>
                           
                        </vs-row>
                        <br>
                        <vs-divider />
                        <!-- end currency -->
                        <!-- eteration -->

                        <EkmalatStock :items="prForm.item" :form="prForm" :listOfFields="[]" ref="ekmalat"></EkmalatStock>

                        <!-- end eteration -->
                        <vs-row vs-w="12">

                            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="12" vs-sm="12" vs-xs="12">
                                <div class="w-full pt-2 ml-3 mr-3">
                                    <vs-textarea placeholder="تفصیلات" v-model="prForm.description"></vs-textarea>
                                </div>
                            </vs-col>
                        </vs-row>
                       <vs-button class="mr-3 mb-2" @click.prevent="submitData">ثبت</vs-button>
                    </form>
                </vx-card>
            </div>
        </vs-tab>

      
    </vs-tabs>
</div>
</template>

<script>
import EkmalatStock from "../shared/EkmalatStock"
import vSelect from 'vue-select'

export default {
    components: {
        "v-select": vSelect,
        EkmalatStock
    },

    data() {
        return {
            active: true,
            // Data Sidebar
            addNewDataSidebar: false,
            sidebarData: {},
          
            prForm: new Form({
              serial_no: '',
              currency_id: '',
              date_time:'',
              vendor_id:'',
              account_id:'',
              address:'',
              phone:'',
              vendor_name:'',
              source_id:'',
              user_id: localStorage.getItem('id'),
              description:'',
              item: [{
                  item_id: null,
                  unit_id: "",
                  operation_id: null,
                  equivalent: "",
                  ammount: "",
                  unit_price: "",
                  total_price: "",
                  density: null,
              }],
              

            }),

            allvendors: [],
            storage: [],
        };
    },

      created(){
          this.loadspcificpurchase();
          this.loadvendor();
          this.loadsource_id();
          this.getPurchaseSerialNumber();
      },
    methods: {

            loadspcificpurchase() {
            this.axios.get('/api/purches/'+this.$route.params.procurment_id+'/edit').then(({data}) => (
                 this.prForm.fill(data),
                console.log("hiiii"+data.vendor_id)
                //  this.setVendordata(data.vendor_id)
                 ));
        },

      setVendordata(data){
  
        this.prForm.vendor_id = data.id;
        this.prForm.vendor_address = data.address;
        this.prForm.vendor_phone = data.phone;
        this.prForm.account_id = data.account_id;
        // this.prForm.vendor_name = data.name;
        
      },
       loadvendor(){
        this.axios.get('/api/vendors')
        .then((resp) => {
          this.allvendors = resp.data;
        });
       },

       loadsource_id(){
          this.axios.get('/api/storage')
        .then((resp) => {
          this.storage = resp.data;
        });
       },

        getPurchaseSerialNumber(){
          this.axios.get('/api/purchSerialNO')
        .then((resp) => {
          this.prForm.serial_no = resp.data;
        });
       },

        addNewData() {
            this.sidebarData = {}
            this.toggleDataSidebar(true)
        },
        toggleDataSidebar(val = false) {
            this.addNewDataSidebar = val
        },
        submitData() {
           this.prForm.post('/api/purches')
                .then(() => {
                    this.$vs.notify({
                        title: 'عملیه ثبت موفق بود!',
                        text: 'عملیه موفغانه انجام شد',
                        color: 'success',
                        iconPack: 'feather',
                        icon: 'icon-check',
                        position: 'top-right'
                    })
                    this.form.reset();
                })

                .catch(() => {
                     this.$vs.notify({
                        title: 'عملیه ثبت موفق بود!',
                        text: 'عملیه موفغانه انجام شد',
                        color: 'danger',
                        iconPack: 'feather',
                        icon: 'icon-check',
                        position: 'top-right'
                    })
                })
        },
    },
};
</script>

<style>
.customstyle {
    border-right: solid;
    border-right-width: initial;
    border-right-style: solid;
    border-right-color: initial;
}

.vs-radio {
    border-top-left-radius: 1 !important;
    border-bottom-left-radius: 1 !important;
}
</style>
