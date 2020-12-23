<template>
<div>
  <Clients :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />
  <vs-tabs>
    <vs-tab label="ثبت اعلان" style="padding:2px 0px 0px 0px !important;">
      <vx-card class="height-vh-80">
        <div class="header">
          <vs-row vs-w="12">
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="2" vs-sm="4" vs-xs="4">
              <div class="">
                <h3 class="pt-1 pr-5 mr-5 ml-4 w-full">
                  فارم ثبت اعلانات
                </h3>
              </div>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="4" vs-xs="1"></vs-col>
            <vs-col vs-type="flex" vs-justify="left" vs-align="left" vs-lg="2" vs-sm="4" vs-xs="7">
              <div class="w-full">
                <vs-button type="filled" @click="addNewData" icon="add">ثبت نهاد جدید </vs-button>
              </div>
            </vs-col>
          </vs-row>
          <br>
          <hr>
          <!--<vs-divider/> -->
        </div>
        <form-wizard color="rgba(var(--vs-primary), 1)" :title="null" :subtitle="null" finishButtonText="ثبت معلومات" @on-complete="formSubmitted">
          <tab-content title="معلومات عمومی" class="mb-5" icon="feather icon-home">
            <vs-row vs-w="12">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-input size="medium" v-model="aForm.serial_no" v-validate="'required'" label="سریال نمبر" name="serial_no" class="w-full" placeholder="101" disabled />
                  <span class="text-danger text-sm" v-show="errors.has('serial_no')">{{ errors.first('serial_no') }}</span>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for="date" class="mt-3"><small>تاریخ نشر اعلان</small></label>
                  <date-picker color="#e85454" v-validate="'required'" v-model="aForm.publish_date" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" :auto-submit="true" size="large"></date-picker>
                  <has-error :form="aForm" field="publish_date"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-input v-validate="'required|min:6'" v-model="aForm.publish_address" label="آدرس نشراعلان" name="publish_address" class="w-full" />
                  <!--<span class="text-danger text-sm" v-show="errors.has('publish_address')">{{ errors.first('publish_address') }}</span> -->
                  <has-error :form="aForm" field="publish_address"></has-error>
                </div>
              </vs-col>
            </vs-row>
            <vs-row vs-w="12" class="pt-2">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for=""><small>نهاد تطبیق کننده</small></label>
                  <v-select label="text" v-model="aForm.client_id" v-validate="'required'" :options="organs" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                  <has-error :form="aForm" field="client_id"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-input size="medium" v-model="aForm.title" v-validate="'required|min:6'" label="عنوان قرارداد" name="title" class="w-full" />
                  <has-error :form="aForm" field="title"></has-error>
                  <!-- <span class="text-danger text-sm" v-show="errors.has('title')">{{ errors.first('title') }}</span> -->
                </div>
              </vs-col>
            </vs-row>
            <vs-row vs-w="12" class="pt-2">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for class="ml-4 mr-4 mb-2">نوعیت قرارداد</label>
                  <div class="radio-group w-full">
                    <div class="w-1/2">
                      <input type="radio" v-model="aForm.status" value="1" id="struct" name="status" />
                      <label for="struct" class="w-full text-center">چارچوبی</label>
                    </div>
                    <div class="w-1/2">
                      <input type="radio" v-model="aForm.status" value="2" id="specific" name="status" />
                      <label for="specific" class="w-full text-center">معین</label>
                    </div>
                  </div>
                  <has-error :form="aForm" field="status"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-input v-validate="'required|min:6'" v-model="aForm.reference_no" label="شماره شناسایی قرارداد" name="reference_no" class="w-full" />
                  <has-error :form="aForm" field="reference_no"></has-error>
                  <!--<span class="text-danger text-sm" v-show="errors.has('reference_no')">{{ errors.first('reference_no') }}</span>-->
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for="date" class="mt-3"><small>تاریخ ختم پیشنهادات</small></label>
                  <date-picker color="#e85454" v-validate="'required'" v-model="aForm.submission_date" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" :auto-submit="true" size="large"></date-picker>
                  <has-error :form="aForm" field="submission_date"></has-error>
                </div>
              </vs-col>
            </vs-row>
            <vs-row vs-w="12" class="pt-2">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for="date" class="mt-3"><small>تاریخ آفرگشایی</small></label>
                  <date-picker color="#e85454" v-validate="'required'" v-model="aForm.bidding_date" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" class="mt-5 w-full" :auto-submit="true" size="large"></date-picker>
                  <has-error :form="aForm" field="bidding_date"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <vs-input size="medium" label="آدرس آفرگشایی" v-validate="'required'" v-model="aForm.bidding_address" name="offeraddress" class="w-full" />
                  <has-error :form="aForm" field="bidding_address"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <!-- TITLE -->
                  <label for=""><small>تضمین آفر</small></label>
                  <vx-input-group class="">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>
                    <vs-input type="number" v-validate="'required'" v-model="aForm.offer_quaratee" />
                  </vx-input-group>
                  <has-error :form="aForm" field="offer_quaratee"></has-error>
                </div>
              </vs-col>
            </vs-row>
            <br>
          </tab-content>
          <tab-content title="اکمالات / مصارف " class="mb-5" icon="feather icon-briefcase">
            <div v-for="(i , index) in aForm.item">
              <vs-row vs-w="12" class="pb-2 mb-2">
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="8" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3">
                    <label for=""><small>جنس / محصول</small></label>
                    <v-select label="text" @input="setItemId" v-model="i.item_id" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                    <has-error :form="aForm" field="item_id"></has-error>
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
                    <has-error :form="aForm" field="ammount"></has-error>
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="4" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3">
                    <!--<label for=""><small>واحد اندازه گیری</small></label>-->
                    <vs-input v-validate="'required|min:6'" v-model="i.unit_id" label="واحد اندازه گیری" name="unit_id" class="w-full" />
                    <!--<v-select label="text" @input="setUnitId" v-model="i.unit_id" :options="mes_unit" :dir="$vs.rtl ? 'rtl' : 'ltr'" /> -->
                    <has-error :form="aForm" field="unit_id"></has-error>
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
                    <has-error :form="aForm" field="unit_price"></has-error>
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
                    <has-error :form="aForm" field="total_price"></has-error>
                  </div>
                </vs-col>
              </vs-row>
            </div>
            <vs-row vs-w="12">
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="4" vs-xs="12" class="pt-2 mb-2 ml-3 mr-3">
                <vs-button type="border" @click="addNewRow" color="success" icon="add"></vs-button> &nbsp;&nbsp;
                <vs-button type="border" @click="removeRow" color="danger" icon="delete" :disabled="aForm.item.length <= 1"></vs-button>
              </vs-col>
            </vs-row>
            <vs-row vs-w="12">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <!-- TITLE -->
                  <label for=""><small>تامینات</small></label>
                  <vx-input-group class="">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>٪</span>
                      </div>
                    </template>
                    <vs-input type="number" v-model="aForm.deposit" />
                  </vx-input-group>
                  <has-error :form="aForm" field="deposit"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for=""><small>مالیات</small></label>
                  <vx-input-group class="">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>٪</span>
                      </div>
                    </template>
                    <vs-input type="number" v-model="aForm.tax" />
                  </vx-input-group>
                  <has-error :form="aForm" field="tax"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for=""><small>متفرقه</small></label>
                  <vx-input-group class="">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>
                    <vs-input type="number" v-model="aForm.others" />
                  </vx-input-group>
                  <has-error :form="aForm" field="others"></has-error>
                </div>
              </vs-col>
            </vs-row>
            <vs-row vs-w="12" class="mb-base">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for=""><small>ارزش قرارداد</small></label>
                  <vx-input-group class="">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>
                    <vs-input type="number" v-model="aForm.pr_worth" />
                  </vx-input-group>
                  <has-error :form="aForm" field="pr_worth"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for=""><small>انتقالات</small></label>
                  <vx-input-group class="">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>
                    <vs-input type="number" v-model="aForm.transit" />
                  </vx-input-group>
                  <has-error :form="aForm" field="transit"></has-error>
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                <div class="w-full pt-2 ml-3 mr-3">
                  <label for=""><small>نرخ دهی</small></label>
                  <vx-input-group class="">
                    <template slot="prepend">
                      <div class="prepend-text bg-primary">
                        <span>AFN</span>
                      </div>
                    </template>
                    <vs-input type="number" />
                  </vx-input-group>
                </div>
              </vs-col>
            </vs-row>
          </tab-content>
          <tab-content title="بررسی و مرور" class="mb-5" icon="feather icon-eye">
            <vs-row vs-w="12" style="background-color: #f3f5f7; border-color: #42b983; padding: 1rem 0;border-right-width:0.6rem;border-right-style: solid;margin: 1rem 0">
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
                <h4>&nbsp;مرور بخش معلومات عمومی&nbsp;</h4>
              </vs-col>
            </vs-row>
            <vs-row vs-w="12">
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    سریال نمبر:
                  </strong>
                  <small class="mb-5" v-text="aForm.serial_no" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    تاریخ نشر اعلان :
                  </strong>
                  <small class="mb-5" v-text="aForm.publish_date" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    آدرس نشراعلان:
                  </strong>
                  <small class="mb-5" v-text="aForm.publish_address" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-1">
                  <strong class="mr-4">
                    نهاد تطبیق کننده:
                  </strong>
                  <small class="mb-5" v-text="aForm.client_id.text" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    عنوان قرارداد:
                  </strong>
                  <small class="mb-5" v-text="aForm.title" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    نوعیت قرارداد:
                  </strong>
                  <small v-if="aForm.status== 2" class="mb-5" vs-justify="right" vs-align="right">معین</small>
                  <small v-if="aForm.status== 1" class="mb-5" vs-justify="right" vs-align="right">چارچوبی</small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    شماره شناسایی قرارداد :
                  </strong>
                  <small class="mb-5" v-text="aForm.reference_no" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    تاریخ ختم پیشنهادات:
                  </strong>
                  <small class="mb-5" v-text="aForm.submission_date" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    تاریخ آفرگشایی:
                  </strong>
                  <small class="mb-5" v-text="aForm.bidding_date" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    آدرس آفرگشایی:
                  </strong>
                  <small class="mb-5" v-text="aForm.bidding_address" vs-justify="right" vs-align="right"></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    تضمین آفر:
                  </strong>
                  <small class="mb-5" v-text="aForm.offer_quaratee" vs-justify="right" vs-align="right"></small>
                  <small style="color:#42b983;"><b>افغانی </b></small>
                </h6>
              </vs-col>
            </vs-row>
            <br>
            <vs-row vs-w="12" style="background-color: #f3f5f7; border-color: #42b983; padding: 1rem 0;border-right-width:0.6rem;border-right-style: solid;margin: 1rem 0">
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
                <h4>&nbsp;مرور بخش اکمالات /اقلام&nbsp;</h4>
              </vs-col>
            </vs-row>
            <vs-table :data="aForm.item">
              <template slot="thead" style="background-color: #f3f5f7">
                <vs-th>جنس / محصول</vs-th>
                <vs-th>مقدار</vs-th>
                <vs-th>واحد اندازه گیری</vs-th>
                <vs-th>هزینه فی واحد</vs-th>
                <vs-th>هزینه مجموعی</vs-th>
              </template>
              <template slot-scope="{data}">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                  <vs-td :data="data[indextr].item_id.text">
                    {{data[indextr].item_id.text}}
                  </vs-td>
                  <vs-td :data="data[indextr].ammount">
                    {{data[indextr].ammount}}
                  </vs-td>
                  <!-- <vs-td :data="data[indextr].unit_id.text">
                    {{data[indextr].unit_id.text}}
                  </vs-td> -->
                  <vs-td :data="data[indextr].unit_id">
                    {{data[indextr].unit_id}}
                  </vs-td>
                  <vs-td :data="data[indextr].unit_price">
                    {{data[indextr].unit_price}} <small style="color:#42b983;"><b>افغانی </b></small>
                  </vs-td>
                  <vs-td :data="data[indextr].total_price">
                    {{data[indextr].total_price}} <small style="color:#42b983;"><b>افغانی </b></small>
                  </vs-td>
                </vs-tr>
              </template>
            </vs-table>
            <br>
            <vs-row vs-w="12" style="background-color: #f3f5f7; border-color: #42b983; padding: 1rem 0;border-right-width:0.6rem;border-right-style: solid;margin: 1rem 0">
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="12" vs-sm="12" vs-xs="12">
                <h4>&nbsp;مرور بخش مصارف&nbsp;</h4>
              </vs-col>
            </vs-row>
            <vs-row ws-w="12">
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    تامینات:
                  </strong>
                  <small class="mb-5" v-text="aForm.deposit" vs-justify="right" vs-align="right"></small>
                  <small style="color:#42b983;"><b>% </b></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    مالیات:
                  </strong>
                  <small class="mb-5" v-text="aForm.tax" vs-justify="right" vs-align="right"></small>
                  <small style="color:#42b983;"><b>% </b></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    متفرقه:
                  </strong>
                  <small class="mb-5" v-text="aForm.others" vs-justify="right" vs-align="right"></small>
                  <small style="color:#42b983;"><b>افغانی </b></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    ارزش قرارداد:
                  </strong>
                  <small class="mb-5" v-text="aForm.pr_worth" vs-justify="right" vs-align="right"></small>
                  <small style="color:#42b983;"><b>افغانی </b></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    انتقالات:
                  </strong>
                  <small class="mb-5" v-text="aForm.transit" vs-justify="right" vs-align="right"></small>
                  <small style="color:#42b983;"><b>افغانی </b></small>
                </h6>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                  <strong class="mr-4">
                    نرخ دهی:
                  </strong>
                  <small class="mb-5" v-text="aForm.transit" vs-justify="right" vs-align="right"></small>
                  <small style="color:#42b983;"><b>افغانی </b></small>
                </h6>
              </vs-col>
            </vs-row>
            <br>
            <vs-row vs-w="12" class="pt-6 pb-6">
              <vs-checkbox color="success" size="large" v-model="is_accepted">تایید مینمایم که معلومات فوق درست میباشد.</vs-checkbox>
            </vs-row>
          </tab-content>
        </form-wizard>
        </vs-row>
      </vx-card>
    </vs-tab>
    <vs-tab label="لیست اعلانات">
      <div class="vx-row">
        <Advertismentlist></Advertismentlist>
      </div>
    </vs-tab>
  </vs-tabs>
</div>
</template>

<script>
import Advertismentlist from './Advertismentlist.vue'
import vSelect from 'vue-select'
import Clients from './Clients.vue'
import { FormWizard, TabContent } from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

export default {
  components: {
    Advertismentlist,
    'v-select': vSelect,
    Clients,
    FormWizard,
    TabContent

  },
  data() {
    return {
      is_accepted: false,
      currentSerialNo: 0,
      aForm: new Form({
        serial_no: '1001',
        publish_date: '1399/09/21',
        publish_address: 'کارته مامورین، ناحیه پنجم، کابل ، افغانستان',
        status: '1',
        client_id: '',
        title: 'تامین تیل مورد نیاز وزارت دفاع ملی مطابق قوانین و مقررات تعین شده از زمان عقد قرار داد الی مدت یک سال',
        reference_no: '222',
        submission_date: '1399/09/21',
        bidding_date: '1399/09/21',
        bidding_address: 'کارته مامورین، ناحیه پنجم، کابل ، افغانستان',
        offer_quaratee: '',
        item: [{
          item_id: '',
          ammount: '',
          unit_id: '',
          unit_price: '',
          total_price: ''
        }],
        deposit: '',
        tax: '',
        others: '',
        pr_worth: '',
        transit: '',
      }),
      clients: [],
      items: [],
      mesure_unit: [],
      organs: [{
          text: 'وزارت داخله',
          value: '1'
        },
        {
          text: 'وزارت دفاع ملی',
          value: '2'
        }
      ],
      itemType: [{
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
      mes_unit: [{
          text: 'بیرل',
          value: 1
        },
        {
          text: 'تانکر',
          value: 2
        },
        {
          text: 'کیلوگرام',
          value: '3'
        },
      ],

      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {},
    }
  },
  computed: {
    isFormValid() {
      return Object.keys(this.fields).some(key => this.fields[key].validated) && Object.keys(this.fields).some(key => this.fields[key].valid);
    }
  },
  mounted() {
    this.isMounted = false;
    this.$validator.validate();
  },
  created() {
    // this.getNextSerianNo();
    this.getAllClients();
    this.getAllItems();
    this.getAllUnites();
  },
  methods: {
    // for getting the next serian number
    getNextSerianNo() {
      this.$Progress.start()
      this.axios.get('/api/getAddSerianID')
        .then((response) => {
          this.currentSerialNo = response.data;
          this.aForm.serial_no = this.currentSerialNo;
        })
    },

    // for Organs that implement the ad
    getAllClients() {
      this.$Progress.start()
      this.axios.get('/api/clients')
        .then((response) => {
          this.clients = response.data;
        })
    },

    // for items to be bought
    getAllItems() {
      this.$Progress.start()
      this.axios.get('/api/items')
        .then((response) => {
          this.items = response.data;
        })
    },

    // for getting measure unit of the item
    getAllUnites() {
      this.$Progress.start()
      this.axios.get('/api/add-unites')
        .then((response) => {
          this.mesure_unit = response.data;
        })
    },

    // set the id of Selected Organ
    setClientId(arr) {
      this.aForm.client_id = arr.text;
    },

    // set the id of Selected Goods/Product name
    setItemId(arr) {
      this.aForm.item.item_id = arr.id;
    },

    // set the id of Selected Measure Unite
    setUnitId(arr) {
      this.aForm.item.unit_id = arr.id;
    },

    formSubmitted() {
      // this.$validator.validateAll().then(result => {
      //   if (result) {
      //     if (this.is_accepted == true) {
      //       console.log('form', this.aForm);
      //       alert("Form submitted!");
      //     }
      //   } else {
      //     // there is errors in form
      //   }
      // })
      this.$Progress.start()

      this.aForm.post('/api/add-advert')
        .then(({
          aForm
        }) => {
          // Finish the Progress Bar
          this.getNextSerianNo();
          this.$Progress.set(100)
          this.$vs.notify({
            title: 'موفقیت!',
            text: 'قرارداد ' + aForm.title + ' موفقانه ثبت شد.',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-check',
            position: 'top-right'
          })
        }).catch((errors) => {
          this.$Progress.set(100)
          this.$vs.notify({
            title: 'ناموفق!',
            text: 'لطفاً معلومات را چک کنید و دوباره امتحان کنید!',
            color: 'danger',
            iconPack: 'feather',
            icon: 'icon-cross',
            position: 'top-right'
          })
        });
    },

    // add new Goods/Product 
    addNewRow() {
      this.aForm.item.push({
        item_id: '',
        ammount: '',
        unit_id: '',
        unit_price: '',
        total_price: '',
      })
    },
    // remove the Goods/Product
    removeRow() {
      this.aForm.item.splice(this.aForm.item.length - 1, 1)
    },

    addNewData() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },

    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val
    }

  },
}
</script>

<style scoped>
.vs-icon {
  color: inherit;
  text-align: center;
  font-size: 2rem;
}
</style>
