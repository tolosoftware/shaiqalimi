
<template>

  <div>

  <Organizationadd :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />

 <vs-tabs>
       <vs-tab label=" قرار دادی">
           <div class="vx-row">
             <vx-card class="height-vh-80">
                  <div class="vx-row">
                    <div class="vx-col w-1/2">
                      <h3>
                فارم ثبت پروژه قرار دادی 
                      </h3>
                  
                    </div>
                    
                </div>

                <form>
                  <div class="vx-row">

                    <!-- required -->
                    <div class="vx-col w-1/3">
                      <vs-input size="medium" v-validate="'serialnumber'"  label="سریال نمبر" name="serialnumber"  class="mt-5 w-full" placeholder="101" disabled/>
                      <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first('serialnumber') }}</span>
                    </div>

                       <div class="vx-col w-1/3 mt-4">
                    <label for=""><small>انتخاب اعلان  </small></label>
                    <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                    </div>

                    
                     <div class="vx-col w-1/3 mt-4">
                    <label for=""><small>انتخاب از پیشنهاد  </small></label>
                    <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                    </div>


                    <!-- Only alphabetic characters -->
                    <div class="vx-col w-1/3 pt-5 pb-0">
                        <label for="date" class="mt-3"><small>تاریخ نشر اعلان</small></label>
                        <date-picker
                          input-format="YYYY/MM/DD"
                          format="jYYYY/jMM/jDD"
                          :auto-submit="true"
                           size="large" ></date-picker>
                     
                    </div>

                    <!-- Only alphabetic characters, numbers, dashes or underscores -->
                    <div class="vx-col w-1/3">
                      <vs-input size="medium" v-validate="'announceplace'" label="محل اعلان" name="announceplace"  class="mt-5 w-full" />
                      <span class="text-danger text-sm" v-show="errors.has('announceplace')">{{ errors.first('announceplace') }}</span>
                    </div>

                    <!-- May contain alphabetic characters or numbers -->
                  
                    <div class="vx-col w-1/3 mt-4">
                    <label for=""><small>نهاد تطبیق کننده</small></label>
                    <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                    </div>

                    <div class="vx-col w-1/3 mt-4">
                    <vs-button type="filled"  class="mt-5 block"  @click="addNewData" >نهاد جدید اضافه کنید</vs-button>
                    </div>

                    <!-- Must only consist of numbers -->
                    <div class="vx-col w-1/3">
                      <vs-input size="medium" v-validate="'projecttitle'" label="عنوان پروژه" name="projecttitle" class="mt-5 w-full" />
                      <span class="text-danger text-sm" v-show="errors.has('projecttitle')">{{ errors.first('projecttitle') }}</span>
                    </div>

                    
                    <!-- Must be a valid email -->
                        <div class="  vx-col w-1/3 mt-5">
                              <label for="" class="ml-4 mr-4 mb-2">نوع قرارداد</label>
                                <ul class="leftx">
                               
                                  <li>
                                    <vs-radio  vs-name="radios1" vs-value="luis" class="ml-4 mr-4"><small>چارچوبی</small> </vs-radio>
                                     <vs-radio  vs-name="radios1" vs-value="carols" class="ml-4 mr-4"><small>معین</small></vs-radio>
                                  </li>
                                 
                                </ul>
                        </div>
                    <!-- Must be a valid url -->


                    <!-- Only alphabetic characters or spaces -->
                    <div class="vx-col w-1/3">
                      <vs-input size="medium" v-validate="'identitynumber'" label="شماره شناسایی" name="identitynumber"  class="mt-5 w-full" />
                      <span class="text-danger text-sm" v-show="errors.has('identitynumber')">{{ errors.first('identitynumber') }}</span>
                    </div>

                    <div class="vx-col w-1/3 pt-4">
                    <!-- TITLE -->
                    <label for=""> <small>مدت قرار داد</small></label>
                      <vx-input-group class="mb-base">
                        <template slot="prepend">
                          <div class="prepend-text bg-primary">
                            <span>ماه</span>
                          </div>
                        </template>

                        <vs-input  type="number"  />
                      </vx-input-group>
                      <!-- /TITLE -->
                   </div>

                    <!-- Length should not be less than the specified length : 3 -->
                    <div class="vx-col w-1/3 pt-4 ">
                    <!-- TITLE -->
                    <label for="" ><small>ارزش قرارداد</small></label>
                      <vx-input-group class="mb-base">
                        <template slot="prepend">
                          <div class="prepend-text bg-primary">
                            <span>AFN</span>
                          </div>
                        </template>

                        <vs-input  type="number"  />
                      </vx-input-group>
                      <!-- /TITLE -->
                   </div>

                    <!-- Length may not exceed the specified length : 6 -->
                    <div class="vx-col w-1/3 pt-4">
                       <label for="date" class="mt-3"><small>تاریخ  آفرگشایی</small></label>
                        <date-picker
                          input-format="YYYY/MM/DD"
                          format="jYYYY/jMM/jDD"
                          :auto-submit="true"
                           size="large" ></date-picker>
                    </div>

                    <!-- Password 1 -->
                    <div class="vx-col w-1/3 pt-4">
                       <label for="date" class="mt-3"><small>  ختم پیشنهادات</small></label>
                        <date-picker
                          input-format="YYYY/MM/DD"
                          format="jYYYY/jMM/jDD"
                          :auto-submit="true"
                           size="large" ></date-picker>
                    </div>

                    <!-- Confirm Password -->
                    <div class="vx-col w-1/3">
                      <vs-input size="medium"  label="آدرس داوطلبی" name="offeraddress"  class="mt-5 w-full"  />
                     
                    </div>

                    <!-- Date Format: dd/MM/yyyy -->
                      <div class="vx-col w-1/3 mt-5">
                    <!-- TITLE -->
                    <label for=""><small> مقدار معین آفر</small></label>
                      <vx-input-group class="mb-base">
                        <template slot="prepend">
                          <div class="prepend-text bg-primary">
                            <span>AFN</span>
                          </div>
                        </template>

                        <vs-input  type="number"  />
                      </vx-input-group>
                      <!-- /TITLE -->
                   </div>

                    <!-- Numeric value between minimum value and a maximum value : 1 and 11 -->
                      <div class="vx-col w-1/3 mt-5">
                    <!-- TITLE -->
                    <label for=""><small> مقدار معین پروژه </small></label>
                      <vx-input-group class="mb-base">
                        <template slot="prepend">
                          <div class="prepend-text bg-primary">
                            <span>AFN</span>
                          </div>
                        </template>

                        <vs-input  type="number"  />
                      </vx-input-group>
                      <!-- /TITLE -->
                   </div>

                  </div>
                  <vs-button type="filled" @click.prevent="submitForm" class="mt-5 block">Submit</vs-button>
                </form>
              </vx-card>
          </div>
         
        </vs-tab>
        <vs-tab label=" عادی">
          <div class="vx-row">
             <vx-card class="height-vh-80">
                  <div class="vx-row">
                    <div class="vx-col w-1/2">
                      <h3>
                 فارم ثبت پروژه عادی  
                      </h3>
                  
                    </div>
                    
                </div>

                <form>
                  <div class="vx-row">

                    <!-- required -->
                    <div class="vx-col w-1/3">
                      <vs-input size="medium" v-validate="'serialnumber'"  label="سریال نمبر" name="serialnumber"  class="mt-5 w-full" placeholder="101" disabled/>
                      <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first('serialnumber') }}</span>
                    </div>

                    <div class="vx-col w-1/3 mt-4">
                    <label for=""><small>انتخاب از اعلان  </small></label>
                    <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                    </div>

                     <div class="vx-col w-1/3 mt-4">
                    <label for=""><small>انتخاب از پیشنهاد  </small></label>
                    <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                    </div>


                    <!-- Only alphabetic characters -->
                    <div class="vx-col w-1/3 pt-5 pb-0">
                        <label for="date" class="mt-3"><small>تاریخ نشر اعلان</small></label>
                        <date-picker
                          input-format="YYYY/MM/DD"
                          format="jYYYY/jMM/jDD"
                          :auto-submit="true"
                           size="large" ></date-picker>
                     
                    </div>

                    <!-- Only alphabetic characters, numbers, dashes or underscores -->
                    <div class="vx-col w-1/3">
                      <vs-input size="medium" v-validate="'announceplace'" label="محل اعلان" name="announceplace"  class="mt-5 w-full" />
                      <span class="text-danger text-sm" v-show="errors.has('announceplace')">{{ errors.first('announceplace') }}</span>
                    </div>

                    <!-- May contain alphabetic characters or numbers -->
                  
                    <div class="vx-col w-1/3 mt-4">
                    <label for=""><small>نهاد تطبیق کننده</small></label>
                    <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                    </div>

                    <div class="vx-col w-1/3 mt-4">
                    <vs-button type="filled"  class="mt-5 block"  @click="addNewData" >نهاد جدید اضافه کنید</vs-button>
                    </div>

                    <!-- Must only consist of numbers -->
                    <div class="vx-col w-1/3">
                      <vs-input size="medium" v-validate="'projecttitle'" label="عنوان پروژه" name="projecttitle" class="mt-5 w-full" />
                      <span class="text-danger text-sm" v-show="errors.has('projecttitle')">{{ errors.first('projecttitle') }}</span>
                    </div>

                    
                    <!-- Must be a valid email -->
                        <div class="  vx-col w-1/3 mt-5">
                              <label for="" class="ml-4 mr-4 mb-2">نوع قرارداد</label>
                                <ul class="leftx">
                               
                                  <li>
                                    <vs-radio  vs-name="radios1" vs-value="luis" class="ml-4 mr-4"><small>چارچوبی</small> </vs-radio>
                                     <vs-radio  vs-name="radios1" vs-value="carols" class="ml-4 mr-4"><small>معین</small></vs-radio>
                                  </li>
                                 
                                </ul>
                        </div>
                    <!-- Must be a valid url -->


                    <!-- Only alphabetic characters or spaces -->
                    <div class="vx-col w-1/3">
                      <vs-input size="medium" v-validate="'identitynumber'" label="شماره شناسایی" name="identitynumber"  class="mt-5 w-full" />
                      <span class="text-danger text-sm" v-show="errors.has('identitynumber')">{{ errors.first('identitynumber') }}</span>
                    </div>

                    <div class="vx-col w-1/3 pt-4">
                    <!-- TITLE -->
                    <label for=""> <small>مدت قرار داد</small></label>
                      <vx-input-group class="mb-base">
                        <template slot="prepend">
                          <div class="prepend-text bg-primary">
                            <span>ماه</span>
                          </div>
                        </template>

                        <vs-input  type="number"  />
                      </vx-input-group>
                      <!-- /TITLE -->
                   </div>

                    <!-- Length should not be less than the specified length : 3 -->
                    <div class="vx-col w-1/3 pt-4 ">
                    <!-- TITLE -->
                    <label for="" ><small>ارزش قرارداد</small></label>
                      <vx-input-group class="mb-base">
                        <template slot="prepend">
                          <div class="prepend-text bg-primary">
                            <span>AFN</span>
                          </div>
                        </template>

                        <vs-input  type="number"  />
                      </vx-input-group>
                      <!-- /TITLE -->
                   </div>

                    <!-- Length may not exceed the specified length : 6 -->
                    <div class="vx-col w-1/3 pt-4">
                       <label for="date" class="mt-3"><small>تاریخ  آفرگشایی</small></label>
                        <date-picker
                          input-format="YYYY/MM/DD"
                          format="jYYYY/jMM/jDD"
                          :auto-submit="true"
                           size="large" ></date-picker>
                    </div>

                    <!-- Password 1 -->
                    <div class="vx-col w-1/3 pt-4">
                       <label for="date" class="mt-3"><small>  ختم پیشنهادات</small></label>
                        <date-picker
                          input-format="YYYY/MM/DD"
                          format="jYYYY/jMM/jDD"
                          :auto-submit="true"
                           size="large" ></date-picker>
                    </div>

                    <!-- Confirm Password -->
                    <div class="vx-col w-1/3">
                      <vs-input size="medium"  label="آدرس داوطلبی" name="offeraddress"  class="mt-5 w-full"  />
                     
                    </div>

                    <!-- Date Format: dd/MM/yyyy -->
                      <div class="vx-col w-1/3 mt-5">
                    <!-- TITLE -->
                    <label for=""><small> مقدار معین آفر</small></label>
                      <vx-input-group class="mb-base">
                        <template slot="prepend">
                          <div class="prepend-text bg-primary">
                            <span>AFN</span>
                          </div>
                        </template>

                        <vs-input  type="number"  />
                      </vx-input-group>
                      <!-- /TITLE -->
                   </div>

                    <!-- Numeric value between minimum value and a maximum value : 1 and 11 -->
                      <div class="vx-col w-1/3 mt-5">
                    <!-- TITLE -->
                    <label for=""><small> مقدار معین پروژه </small></label>
                      <vx-input-group class="mb-base">
                        <template slot="prepend">
                          <div class="prepend-text bg-primary">
                            <span>AFN</span>
                          </div>
                        </template>

                        <vs-input  type="number"  />
                      </vx-input-group>
                      <!-- /TITLE -->
                   </div>

                  </div>
                  <vs-button type="filled" @click.prevent="submitForm" class="mt-5 block">Submit</vs-button>
                </form>
              </vx-card>
          </div>
         
        </vs-tab>

      </vs-tabs>
  </div>
</template>

<script>


import vSelect from 'vue-select'
import Organizationadd from './proposals/Organizationadd.vue'
export default {
  components:{
      Organizationadd,
    'v-select': vSelect,
  
  },
  data() {
    return {
     itemType: [
        {
          text: 'تیل دیزل',
          value: '1'
        },
        {
          text: 'تیل گاز',
          value: '2'
        },
        {
          text: 'تیل پطرول',
          value: '3'
        },
        {
          text: 'موبلین',
          value: '4'
        },
      ],

      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {}
    }
  },

  methods: {
    submitForm() {
      this.$validator.validateAll().then(result => {
        if (result) {
          // if form have no errors
          alert("form submitted!");
        } else {
          // form have errors
        }
      })
    },

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
