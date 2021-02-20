<template>
<form-wizard v-if="proposal" color="rgba(var(--vs-primary), 1)" :title="null" :subtitle="null" ref="wizarde" @on-complete="formSubmitted">
  <tab-content title="ثبت اطلاعات" class="mb-5" :before-change="changePropStepStatus">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>بررسی بخش ثبت اطلاعات</vs-divider>
      </vs-row>
      <vs-row vs-w="12">
        <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
          <div class="vx-row">
            <vs-col vs-lg="3" vs-sm="4" vs-xs="12">
              <div class="img-container">
                <img :src="'/images/img/clients/'+proposal.pro_data.client.logo" style="height:80px;margin:-1px 10px" class="product-img" @click.stop="showClientData(tr.id)" />
              </div>
            </vs-col>
            <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="8" vs-xs="12">
              <div class="vx-row w-full">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p clas="w-full" v-if="proposal.pro_data"><strong>نام نهاد: </strong><span v-text="proposal.pro_data.client.name"></span></p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                  <p class="w-full" v-if="proposal.pro_data"><strong>شماره قرارداد: </strong><span v-text="proposal.pro_data.reference_no"></span></p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p class="w-full pr-5" v-if="proposal.pro_data"><strong>عنوان قرارداد: </strong><span v-text="proposal.pro_data.title"></span></p>
                </vs-col>
              </div>
            </vs-col>
          </div>
        </vs-col>
        <vs-col class="pl-5" vs-lg="6" vs-sm="6" vs-xs="12">
          <div class="vx-row w-full">
            <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
              <p clas="w-full" v-if="proposal"><strong class="mr-4">تاریخ نشراعلان: </strong><span v-text="proposal.publish_date"></span></p>
            </vs-col>
          </div>
          <div class="vx-row">
            <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
              <p class="w-full" v-if="proposal"><strong class="mr-4">تاریخ ختم پیشنهادات: </strong><span v-text="proposal.submission_date"></span></p>
            </vs-col>
          </div>
          <div class="vx-row">
            <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
              <p class="w-full pr-5" v-if="proposal"><strong class="mr-4">تاریخ داوطلبی: </strong><span v-text="proposal.bidding_date"></span></p>
            </vs-col>
          </div>
          <div class="vx-row">
            <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
              <p class="w-full pr-5" v-if="proposal"><strong class="mr-4">مقدار تضمین: </strong><span v-text="proposal.offer_guarantee"></span><small style="color:#42b983;"><b> افغانی </b></small></p>
            </vs-col>
          </div>
        </vs-col>
        <!-- <div class="flex justify-between float-right">
              <vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2">ثبت</vs-button>
            </div>-->
      </vs-row>
      <vs-divider>بخش اکمالات</vs-divider>
      <vs-table class="responsive" :data="proposal.pro_items">
        <template slot="thead">
          <vs-th>جنس / محصول</vs-th>
          <vs-th>مقدار</vs-th>
          <vs-th>عملیه</vs-th>
          <vs-th>قیمت فی واحد</vs-th>
          <vs-th>قیمت مجموعی</vs-th>
        </template>
        <template slot-scope="{data}">
          <vs-tr v-for="(tr, i) in data" :key="i">
            <vs-td :data="tr.item_id">
              <p> {{ tr.item_id.name }} </p>
            </vs-td>
            <vs-td :data="tr.equivalent">
              {{tr.equivalent}} {{ tr.item_id.uom_equiv_id.title }}
            </vs-td>
            <vs-td :data="tr.operation_id">
              <p> {{ tr.operation_id.formula }} </p>
            </vs-td>
            <vs-td :data="tr.unit_price">
              {{tr.unit_price}} <small style="color:#42b983;"><b>افغانی </b></small>
            </vs-td>
            <vs-td :data="tr.total_price">
              {{tr.total_price}} <small style="color:#42b983;"><b>افغانی </b></small>
            </vs-td>
          </vs-tr>
        </template>
      </vs-table>
    </vs-row>
  </tab-content>
  <tab-content title="ارسال درخواستی" class="mb-5" :before-change="changePropStepStatus1">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>بررسی بخش ارسال درخواستی</vs-divider>
      </vs-row>
      <vs-row vs-w="12">
        <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
          <div class="vx-row">
            <vs-col vs-lg="3" vs-sm="4" vs-xs="12">
              <div class="img-container">
                <img :src="'/images/img/clients/'+proposal.pro_data.client.logo" style="height:80px;margin:-1px 10px" class="product-img" @click.stop="showClientData(tr.id)" />
              </div>
            </vs-col>
            <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="8" vs-xs="12">
              <div class="vx-row w-full">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p clas="w-full" v-if="proposal.pro_data"><strong>نام نهاد: </strong><span v-text="proposal.pro_data.client.name"></span></p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                  <p class="w-full" v-if="proposal.pro_data"><strong>شماره قرارداد: </strong><span v-text="proposal.pro_data.reference_no"></span></p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p class="w-full pr-5" v-if="proposal.pro_data"><strong>عنوان قرارداد: </strong><span v-text="proposal.pro_data.title"></span></p>
                </vs-col>
              </div>
            </vs-col>
          </div>
        </vs-col>
        <vs-col class="pl-5" vs-lg="6" vs-sm="6" vs-xs="12">
          <div class="vx-row">
            <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
              <p clas="w-full" v-if="proposal.pro_data"><strong class="mr-4"> شماه تماس: </strong>{{proposal.pro_data.client.phone}}</p>
            </vs-col>
          </div>
          <div class="vx-row">
            <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
              <p class="w-full" v-if="proposal.pro_data"><strong class="mr-4"> آدرس: </strong><span v-text="proposal.pro_data.client.address"></span></p>
            </vs-col>
          </div>
          <div class="vx-row">
            <vs-col vs-type="flex" class="mb-1" vs-justify="right" vs-align="right" vs-w="12">

              <!--<div class="mt-2 mr-5">
                <vs-input label=" اسم شخص مسول را وارد نمایید" v-model="pStepForm.res_person" />
              </div>
              -->
            </vs-col>
          </div>
        </vs-col>
      </vs-row>
      <vs-divider />
      <vs-row vs-w="12">
        <div class="w-full">
          <quill-editor v-model="pStepForm.res_person" :options="editorOption">
            <div id="toolbar" slot="toolbar">
              <button class="ql-bold">Bold</button>
              <button class="ql-italic">Italic</button>
              <button class="ql-underline">Underline</button>

              <select class="ql-size">
                <option value="small"></option>
                <option selected></option>
                <option value="large"></option>
                <option value="huge"></option>
              </select>

              <select class="ql-font">
                <option selected="selected"></option>
                <option value="serif"></option>
                <option value="monospace"></option>
              </select>

              <select class="ql-align">
                <option selected="justify"></option>
                <option value="center"></option>
                <option value="right"></option>
              </select>

              <select class="ql-header">
                <option selected="1"></option>
                <option value="2"></option>
                <option value="3"></option>
                <option value="4"></option>
                <option value="5"></option>
                <option value="6"></option>
                <option value="false"></option>
              </select>

              <button class="ql-direction" value="rtl"></button>

              <button class="ql-list" value="ordered"></button>

              <button class="ql-list" value="bullet"></button>

              <button class="ql-indent" value="+1"></button>

              <button class="ql-indent" value="-1"></button>
            </div>
          </quill-editor>
        </div>
      </vs-row>
    </vs-row>
    <div class="pt-2 mt-1 mb-2 float-right">
      <vs-button class="mr-1 mt-1" type="gradient" icon="print" @click="cprint">چاپ عریضه</vs-button>
    </div>
    <vs-row></vs-row>
    </vs-row>
  </tab-content>
  <tab-content title="دریافت شرطنامه/آفر" class="mb-5" :before-change="changePropStepStatus2">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>بررسی بخش دریافت شرطنامه </vs-divider>
      </vs-row>
      <vs-row vs-w="12">
        <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
          <div class="vx-row">
            <vs-col vs-lg="3" vs-sm="4" vs-xs="12">
              <div class="img-container">
                <img :src="'/images/img/clients/'+proposal.pro_data.client.logo" style="height:80px;margin:-1px 10px" class="product-img" @click.stop="showClientData(tr.id)" />
              </div>
            </vs-col>
            <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="8" vs-xs="12">
              <div class="vx-row w-full">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p clas="w-full" v-if="proposal.pro_data"><strong>نام نهاد: </strong><span v-text="proposal.pro_data.client.name"></span></p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                  <p class="w-full" v-if="proposal.pro_data"><strong>شماره قرارداد: </strong><span v-text="proposal.pro_data.reference_no"></span></p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p class="w-full pr-5" v-if="proposal.pro_data"><strong>عنوان قرارداد: </strong><span v-text="proposal.pro_data.title"></span></p>
                </vs-col>
              </div>
            </vs-col>
          </div>
        </vs-col>
        <vs-col class="pl-5" vs-lg="6" vs-sm="6" vs-xs="12">
          <div class="vx-row pl-3">
            <vs-col class="mb-3 ml-2" vs-justify="right" vs-align="right" vs-w="12">
              <p clas="mb-1" v-if="proposal.pro_data"><strong class="mr-4"> تاریخ دریافت شرطنامه: </strong><span></span>
              </p>
            </vs-col>
            <vs-col class="mb-2" vs-justify="right" vs-align="right" vs-w="12">
              <vs-checkbox color="success" size="large" v-model="pStepForm.is_recieved_cont"><strong> شرطنامه دریافت گردید ؟ </strong></vs-checkbox>
              <!--<vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2 mt-2 ml-1"> ویرایش معلومات </vs-button>-->
            </vs-col>
          </div>
        </vs-col>
      </vs-row>
      <vs-divider></vs-divider>
    </vs-row>
  </tab-content>
  <tab-content title="اشتراک" class="mb-5" :before-change="changePropStepStatus3">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>بررسی بخش اشتراک</vs-divider>
      </vs-row>
      <vs-row vs-w="12">
        <ekmalat :items="proposal.pro_items" :form="aForm" :listOfFields="dict" ref="ekmalat"></ekmalat>
      </vs-row>
      <vs-row vs-w="12">
        <vs-col class="pl-5" vs-lg="9" vs-sm="9" vs-xs="12">
        </vs-col>
        <vs-col class="pl-5" vs-lg="3" vs-sm="3" vs-xs="12">
          <vs-checkbox color="success" class="float-left" size="large" v-model="pStepForm.is_participated"><strong> اشتراک میشود ؟ </strong></vs-checkbox>
        </vs-col>
      </vs-row>
      <vs-divider></vs-divider>
    </vs-row>
  </tab-content>
  <tab-content title="مرحله داوطلبی" class="mb-5" :before-change="changePropStepStatus4">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>بررسی بخش داوطلبی</vs-divider>
      </vs-row>
      <vs-row vs-w="12">
        <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
          <div class="vx-row">
            <vs-col vs-lg="3" vs-sm="4" vs-xs="12">
              <div class="img-container">
                <img :src="'/images/img/clients/'+proposal.pro_data.client.logo" style="height:80px;margin:-1px 10px" class="product-img" @click.stop="showClientData(tr.id)" />
              </div>
            </vs-col>
            <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="8" vs-xs="12">
              <div class="vx-row w-full">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p clas="w-full" v-if="proposal.pro_data"><strong>نام نهاد: </strong><span v-text="proposal.pro_data.client.name"></span></p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                  <p class="w-full" v-if="proposal.pro_data"><strong>شماره قرارداد: </strong><span v-text="proposal.pro_data.reference_no"></span></p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p class="w-full pr-5" v-if="proposal.pro_data"><strong>عنوان قرارداد: </strong><span v-text="proposal.pro_data.title"></span></p>
                </vs-col>
              </div>
            </vs-col>
          </div>
        </vs-col>
        <vs-col class="pl-5" vs-lg="6" vs-sm="6" vs-xs="12">
          <div class="vx-row pl-3">
            <vs-col class="mb-3" vs-justify="right" vs-align="right" vs-w="12">
              <p clas="mb-1" v-if="proposal"><strong class="mr-4"> تاریخ داوطلبی: </strong><span v-text="proposal.bidding_date"></span></p>
            </vs-col>
            <vs-col class="mb-2" vs-justify="right" vs-align="right" vs-w="12">
              <p class="w-full" v-if="proposal"><strong class="mr-4"> آدرس داوطلبی: </strong><span v-text="proposal.bidding_address"></span></p>
            </vs-col>
            <vs-col class="mb-2" vs-justify="right" vs-align="right" vs-w="12">
              <p class="w-full" v-if="proposal"><strong class="mr-4"> مقدارتضمین: </strong><span v-text="proposal.offer_guarantee"></span><b> افغانی </b>__<b style="color:green">بانکی</b></p>
            </vs-col>
          </div>
        </vs-col>
        <!--<div class="flex justify-between float-right">
             <vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2">ثبت</vs-button>
            </div>-->
      </vs-row>
      <vs-divider>اطلاعات اشتراک کننده گان داوطلبی</vs-divider>
      <vs-row vs-w="12">
        <form>
          <div v-for="(i, index) in participators" :key="i.id">
            <vs-row vs-w="12">
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="3" vs-xs="6">
                <div class="w-full pt-2 ml-1 mr-1 mb-3">
                  <vs-input autocomplete="off" label="نام شرکت" name="co_name" v-model="i.name" class="w-full" />
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="3" vs-xs="6">
                <div class="w-full pt-2 ml-1 mr-1 mb-3">
                  <vs-input autocomplete="off" v-model="i.same_dificult" label="مشابه / مشکلات" name="same_dificult" class="w-full" />
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="6">
                <div class="w-full pt-2 ml-1 mr-1 mb-3">
                  <vs-input autocomplete="off" v-model="i.statement" label="استیتمنت" name="statement" class="w-full" />
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="3" vs-xs="6">
                <div class="w-full pt-2 ml-1 mr-1 mb-3">
                  <vs-input autocomplete="off" v-model="i.feyat" label="فیات" name="feyat" class="w-full" />
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="3" vs-xs="6">
                <div class="w-full pt-2 ml-1 mr-1 mb-3">
                  <vs-input autocomplete="off" v-model="i.offer_price" label="قیمت آفر" name="offer_price" class="w-full" />
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="3" vs-xs="6">
                <div class="w-full pt-2 ml-1 mr-1 mb-3">
                  <vs-input autocomplete="off" v-model="i.discount" label="تخفیف" name="discount" class="w-full" />
                </div>
              </vs-col>
              <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="3" vs-xs="6">
                <div class="w-full pt-2 ml-1 mr-1 mb-3">
                  <vs-input autocomplete="off" v-model="i.final_price" label="قیمت نهایی" name="final_price" class="w-full" />
                </div>
              </vs-col>
            </vs-row>
          </div>
        </form>
        <vs-row vs-w="12">
          <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="4" vs-xs="12" class="pt-2 mb-2 ml-3 mr-3">
            <vs-button type="border" @click.stop="addRow" color="success" icon="add"></vs-button>
            &nbsp;&nbsp;
            <vs-button type="border" id="delete-btn" @click.stop="removeRow" color="danger" icon="delete" :disabled="this.participators.length <= 1"></vs-button>
          </vs-col>
        </vs-row>
      </vs-row>
      <vs-divider></vs-divider>
    </vs-row>
  </tab-content>
  <tab-content title="نتیجه قرارداد" class="mb-5" :before-change="changePropStepStatus5">
    <vs-row vs-w="12" class="mb-1">
      <vs-row vs-w="12">
        <vs-divider>بررسی بخش نتیجه قرارداد</vs-divider>
      </vs-row>
      <vs-row vs-w="12" vs-type="flex" vs-justify="center">
        <div class="radio-group1 w-full">
          <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
            <vs-row vs-w="12" vs-type="flex" vs-justify="center">
              <input type="radio" v-model="pStepForm.prop_recieve_or_allow" value="1" id="struct" name="prop_recieve_or_allow" />
              <label for="struct" id="recieve" style="font-size:35px;" class="w-full text-center p-24">دریافت قرارداد</label>
            </vs-row>
          </vs-col>
          <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
            <vs-row vs-w="12" vs-type="flex" vs-justify="center">
              <input type="radio" v-model="pStepForm.prop_recieve_or_allow" value="2" id="specific" name="prop_recieve_or_allow" />
              <label for="specific" id="allowto" style="font-size:35px;" class="w-full text-center p-12">واگذاری قرارداد</label>
              <vs-divider><span for="winner">برنده قرار داد</span></vs-divider>
              <vs-input id="winner" autocomplete="off" v-model="pStepForm.winner" name="winner" class="w-full" />
            </vs-row>
          </vs-col>
        </div>
      </vs-row>
      <vs-divider></vs-divider>
    </vs-row>
  </tab-content>
  <vs-button slot="prev">قبلی</vs-button>
  <vs-button slot="next">بعدی</vs-button>
  <vs-button slot="finish">بستن صحفه</vs-button>
  <!--<vs-button v-bind:class="is_ekmalat_allowed ? '': 'hide'" slot="next">بعدی</vs-button>
  <vs-button disabled v-bind:class="is_ekmalat_allowed ? 'hide': ''">بعدی</vs-button>

  <vs-button v-bind:class="finishedcontract && is_ekmalat_allowed ? '': 'hide'" slot="finish">بستن صحفه</vs-button>-->
</form-wizard>
</template>

<script>
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import { quillEditor } from 'vue-quill-editor'
import Prism from 'vue-prism-component'

import Ekmalat from "../../shared/Ekmalat.vue"
import {
  FormWizard,
  TabContent
} from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
export default {
  props: ['proposal', 'participators'],
  data() {
    return {
      editorOption: {
        modules: {
          toolbar: '#toolbar'
        }
      },
      content: '',
      firstloadstep: 0,
      pStepForm: new Form({
        step: 0,
        proposal_id: '',
        res_person: '',
        is_recieved_cont: '',
        is_participated: '',
        prop_recieve_or_allow: 1,
        winner: ''
      }),
      // participators: [{
      //   proposal_id: this.pStepForm.proposal_id,
      //   name: '',
      //   same_dificult: '',
      //   statement: '',
      //   feyat: '',
      //   offer_price: '',
      //   discount: '',
      //   final_price: ''
      // }],
      aForm: new Form({
        item: [{
          item_id: "",
          unit_id: "",
          operation_id: null,
          equivalent: "",
          ammount: "0",
          unit_price: "0",
          total_price: "",
          density: 0,
        }]
      }),
      dict: {
        custom: {
          sf: {
            required: 'سریال نمبر الزامی میباشد.',
            number: 'سریال نمبر باید نمبر باشد.'
          }
        }
      },
    }
  },
  components: {
    FormWizard,
    TabContent,
    Ekmalat,
    quillEditor,
    Prism
  },
  created() {},
  computed: {},
  methods: {
    changeItTo(proposalid, st) {
      this.$Progress.start()
      this.pStepForm.post('/api/proposlstchange/' + proposalid)
        .then((response) => {
          this.$Progress.set(100);
          if (this.firstloadstep == 1) {
            if (st == 7) {
              this.$vs.notify({
                title: 'موفقیت!',
                text: 'تمام مراحل اعلان ختم گردید',
                color: 'success',
                iconPack: 'feather',
                icon: 'icon-check',
                position: 'top-right'
              })
            } else {
              this.$vs.notify({
                title: 'موفقیت!',
                text: ' مرحله موفقانه به ' + st + ' تغیر یافت.',
                color: 'success',
                iconPack: 'feather',
                icon: 'icon-check',
                position: 'top-right'
              })
            }

          } else if (this.firstloadstep > 1) {
            this.firstloadstep = (this.firstloadstep - 1);
          }
        }).catch(() => {});
    },
    changePropStepStatus() {
      // if (this.step == 1) {
      this.pStepForm.step = 2;
      this.changeItTo(this.proposal.id, this.pStepForm.step);
      // }
      return true;
    },
    changePropStepStatus1() {
      // if (this.step == 2) {
      this.pStepForm.step = 3;

      this.changeItTo(this.proposal.id, this.pStepForm.step);
      // }
      return true;
    },
    changePropStepStatus2() {
      // if (this.step == 3) {
      this.pStepForm.step = 4;
      this.changeItTo(this.proposal.id, this.pStepForm.step);
      // }
      return true;
    },
    changePropStepStatus3() {
      // if (this.step == 4) {
      this.pStepForm.step = 5;
      this.changeItTo(this.proposal.id, this.pStepForm.step);
      // }
      return true;
    },
    changePropStepStatus4() {
      // // if (this.step == 5) {
      this.pStepForm.step = 6;
      this.changeItTo(this.proposal.id, this.pStepForm.step);
      // }
      return true;
    },
    changePropStepStatus5() {
      this.pStepForm.step = 7;
      this.changeItTo(this.proposal.id, this.pStepForm.step);
      this.formSubmitted();
    },
    cprint() {},
    formSubmitted() {
      this.$emit('closesteps');
    },
    addRow(id) {
      this.participators.push({
        proposal_id: this.pStepForm.proposal_id,
        name: '',
        same_dificult: '',
        statement: '',
        feyat: '',
        offer_price: '',
        discount: '',
        final_price: ''
      });
    },
    removeRow() {
      this.participators.splice(this.participators.length - 1, 1);
    },
    setWizardStep1(index = 1, proposalstepdata) {
      this.setProposalData(index, proposalstepdata);
      console.log('Participators:', this.participators)
      // this.setPropParticipators();
      this.$refs.wizarde.activateAll();
      this.$refs.wizarde.navigateToTab(index - 1);
    },
    setProposalData(index, pData) {
      this.firstloadstep = index;
      this.pStepForm.step = index;
      this.pStepForm.proposal_id = pData.proposal_id;
      this.pStepForm.res_person = pData.res_person;
      this.pStepForm.is_recieved_cont = pData.is_recieved_cont;
      this.pStepForm.is_participated = pData.is_participated;
      this.pStepForm.prop_recieved_or_allow = pData.prop_recieved_or_allow;
      this.pStepForm.winner = pData.winner;
    },
    setPropParticipators() {

    }
  },
  mounted() {

  }
}
</script>

<style>
.con-vs-popup .vs-popup {
  width: 900px;
}

.vue-form-wizard .navbar .navbar-nav>li>a.wizard-btn,
.vue-form-wizard .wizard-btn {
  min-width: 40px !important;
}

[dir] .vue-form-wizard .wizard-tab-content {
  padding: 30px 20px 2px 10px !important;
}

.radio-group1 {
  display: inline-flex;
  overflow: visible;
}

.radio-group1 div:first-child label {
  overflow: hidden;
}

[dir=ltr] .radio-group1 div:first-child label {
  border-bottom-left-radius: 5px;
  border-top-left-radius: 5px;

}

[dir=rtl] .radio-group1 div:first-child label {
  border-bottom-right-radius: 5px;
  border-top-right-radius: 5px;

}

.radio-group1 div:last-child label {
  overflow: hidden;

}

[dir=ltr] .radio-group1 div:last-child label {
  border-bottom-right-radius: 5px;
  border-top-right-radius: 5px;

}

[dir=rtl] .radio-group1 div:last-child label {
  border-bottom-left-radius: 5px;
  border-top-left-radius: 5px;

}

.radio-group1 input[type=radio] {
  position: absolute;
  visibility: hidden;
  display: none;
}

.radio-group1 label {
  display: inline-block;
  font-weight: bold;
  transition: 0.4s;
}

[dir] .radio-group1 label#recieve {
  cursor: pointer;
  padding: 30px 18px;
  border: solid 1px rgba(var(--vs-success), 1);
}

[dir] .radio-group1 label#allowto {
  cursor: pointer;
  padding: 30px 18px;
  border: solid 1px rgba(var(--vs-danger), 1);
}

.radio-group1 input[type=radio]:checked+label {
  color: white;
}

[dir] .radio-group1 input[type=radio]:checked+label#recieve {
  background: rgba(var(--vs-success), 1);
  box-shadow: 0 8px 25px -8px #e85454;
  border-color: rgba(var(--vs-success), 1);
}

[dir] .radio-group1 input[type=radio]:checked+label#allowto {
  background: rgba(var(--vs-danger), 1);
  box-shadow: 0 8px 25px -8px #e85454;
  border-color: rgba(var(--vs-danger), 1);
}
</style>
