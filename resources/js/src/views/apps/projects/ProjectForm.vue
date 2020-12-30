<template>
<form-wizard color="rgba(var(--vs-primary), 1)" :title="null" :subtitle="null" back-button-text="قبلی" next-button-text="بعدی" :start-index="0" ref="wizard" finishButtonText="ثبت معلومات" @on-complete="submitForm">
    <tab-content title="معلومات عمومی قرارداد" class="mb-5" :before-change="validateStep1">
        <form data-vv-scope="step-1">
            <vs-row vs-w="12">
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                    <div class="w-full pt-2 ml-3 mr-3">
                        <vs-input size="medium" v-model="pForm.serial_no" label="سریال نمبر" class="w-full" disabled />
                        <span class="text-danger text-sm" v-show="errors.has('serial_no')">{{ errors.first('serial_no') }}</span>
                    </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                    <div class="w-full pt-2 ml-3 mr-3">
                        <label for=""><small>انتخاب اعلان</small></label>
                        <v-select name="serial_no" :clearable="false" :get-option-label="option => option.serial_no + ' - ' + option.pro_data.title" @input="setProjectData" v-model="pForm.proposal_id" :options="proposals" :dir="$vs.rtl ? 'rtl' : 'ltr'">
                            <span slot="no-options">{{$t('WhoopsNothinghere')}}</span>
                        </v-select>
                        <has-error :form="pForm" field="proposal_id"></has-error>
                    </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                    <div class="w-full pt-2 ml-3 mr-3">
                        <label for="date" class="mt-3"><small>تاریخ عقد قرارداد</small></label>
                        <date-picker color="#e85454" v-validate="'required'" name="contract_date" v-model="pForm.contract_date" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" :auto-submit="true" size="large"></date-picker>
                        <span class="absolute text-danger alerttext">{{ errors.first('step-1.contract_date') }}</span>
                        <has-error :form="pForm" field="contract_date"></has-error>
                    </div>
                </vs-col>
            </vs-row>
            <vs-row vs-w="12" class="pt-2">
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                    <div class="w-full pt-2 ml-3 mr-3">
                        <label for=""><small>مرجع مربوطه</small></label>
                        <v-select label="name" v-model="pForm.client_id" v-validate="'required'" name="client_id" :options="clients" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                        <span class="absolute text-danger alerttext">{{ errors.first('step-1.client_id') }}</span>
                        <has-error :form="pForm" field="client_id"></has-error>
                    </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="6" vs-xs="12">
                    <div class="w-full pt-2 ml-3 mr-3">
                        <vs-input size="medium" v-model="pForm.title" v-validate="'required|min:6'" label="عنوان قرارداد" name="title" class="w-full" />
                        <span class="absolute text-danger alerttext">{{ errors.first('step-1.title') }}</span>
                        <has-error :form="pForm" field="title"></has-error>
                    </div>
                </vs-col>
            </vs-row>
            <vs-row vs-w="12" class="pt-2">
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                    <div class="w-full pt-2 ml-3 mr-3">
                        <label for class="ml-4 mr-4 mb-2">نوعیت قرارداد</label>
                        <div class="radio-group w-full">
                            <div class="w-1/2">
                                <input type="radio" v-model="pForm.status" value="1" id="struct" name="status" />
                                <label for="struct" class="w-full text-center">چارچوبی</label>
                            </div>
                            <div class="w-1/2">
                                <input type="radio" v-model="pForm.status" value="2" id="specific" name="status" />
                                <label for="specific" class="w-full text-center">معین</label>
                            </div>
                        </div>
                    </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                    <div class="w-full pt-2 ml-3 mr-3">
                        <vs-input v-validate="'required|min:3'" v-model="pForm.reference_no" label="شماره شناسایی قرارداد" name="reference_no" class="w-full" />
                        <span class="absolute text-danger alerttext">{{ errors.first('step-1.reference_no') }}</span>
                        <has-error :form="pForm" field="reference_no"></has-error>
                    </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                    <div class="w-full pt-2 ml-3 mr-3">
                        <label for="date" class="mt-3"><small>تاریخ ختم قرارداد</small></label>
                        <date-picker color="#e85454" v-validate="'required'" name="contract_end_date" v-model="pForm.contract_end_date" input-format="YYYY/MM/DD" format="jYYYY/jMM/jDD" :auto-submit="true" size="large"></date-picker>
                        <span class="absolute text-danger alerttext">{{ errors.first('step-1.contract_end_date') }}</span>
                        <has-error :form="pForm" field="contract_end_date"></has-error>
                    </div>
                </vs-col>
            </vs-row>
            <vs-row vs-w="12" class="pt-2">
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                    <div class="w-full pt-2 ml-3 mr-3">
                        <label for=""><small>تضمین قرارداد</small></label>
                        <vx-input-group class="">
                            <template slot="prepend">
                                <div class="prepend-text bg-primary">
                                    <span>AFN</span>
                                </div>
                            </template>
                            <vs-input type="number" name="project_guarantee" v-model="pForm.project_guarantee" />
                        </vx-input-group>
                        <span class="absolute text-danger alerttext">{{ errors.first('step-1.project_guarantee') }}</span>
                        <has-error :form="pForm" field="project_guarantee"></has-error>
                    </div>
                </vs-col>
            </vs-row>
        </form>
    </tab-content>

    <tab-content title="اکمالات / مصارف " class="mb-5" icon="feather icon-briefcase" :before-change="validateStep2">

        <form data-vv-scope="step-2">
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
                            <vs-input autocomplete="off" type="number" v-model="pForm.pr_worth" v-validate="'required'" name="pr_worth" />
                        </vx-input-group>
                        <span class="absolute text-danger alerttext">{{ errors.first('step-2.pr_worth') }}</span>
                        <has-error :form="pForm" field="pr_worth"></has-error>
                    </div>
                </vs-col>
            </vs-row>

            <ekmalat :items="pForm.item" :form="pForm"></ekmalat>
            <vs-row vs-w="12" class="mb-base">
                <vs-col vs-type="flex" vs-w="3" class="mb-base">
                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
                        <div class="w-full pt-2 ml-3 mr-3">
                            <!-- TITLE -->
                            <label for=""><small>تامینات</small></label>
                            <vx-input-group class="">
                                <template slot="prepend">
                                    <div class="prepend-text bg-primary">
                                        <span>٪</span>
                                    </div>
                                </template>
                                <vs-input autocomplete="off" type="number" v-model="pForm.deposit" v-validate="'required'" name="deposit" />
                            </vx-input-group>
                            <span class="absolute text-danger alerttext">{{ errors.first('step-2.deposit') }}</span>
                            <has-error :form="pForm" field="deposit"></has-error>
                        </div>
                    </vs-col>
                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
                        <div class="w-full pt-2 ml-3 mr-3">
                            <label for=""><small>مالیات</small></label>
                            <vx-input-group class="">
                                <template slot="prepend">
                                    <div class="prepend-text bg-primary">
                                        <span>٪</span>
                                    </div>
                                </template>
                                <vs-input autocomplete="off" type="number" v-model="pForm.tax" v-validate="'required'" name="tax" />
                            </vx-input-group>
                            <span class="absolute text-danger alerttext">{{ errors.first('step-2.tax') }}</span>
                            <has-error :form="pForm" field="tax"></has-error>
                        </div>
                    </vs-col>
                </vs-col>
                <vs-col vs-type="flex" vs-w="9" class="mb-base">

                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                        <div class="w-full pt-2 ml-3 mr-3">
                            <label for=""><small>مصارف متفرقه</small></label>
                            <vx-input-group class="">
                                <template slot="prepend">
                                    <div class="prepend-text bg-primary">
                                        <span>AFN</span>
                                    </div>
                                </template>
                                <vs-input autocomplete="off" type="number" v-model="pForm.others" v-validate="'required'" name="others" />
                            </vx-input-group>
                            <span class="absolute text-danger alerttext">{{ errors.first('step-2.others') }}</span>
                            <has-error :form="pForm" field="others"></has-error>
                        </div>
                    </vs-col>
                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                        <div class="w-full pt-2 ml-3 mr-3">
                            <label for=""><small>مصارف انتقالات</small></label>
                            <vx-input-group class="">
                                <template slot="prepend">
                                    <div class="prepend-text bg-primary">
                                        <span>AFN</span>
                                    </div>
                                </template>
                                <vs-input autocomplete="off" type="number" v-model="pForm.transit" v-validate="'required'" name="transit" />
                            </vx-input-group>
                            <span class="absolute text-danger alerttext">{{ errors.first('step-2.transit') }}</span>
                            <has-error :form="pForm" field="transit"></has-error>
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
                                <vs-input autocomplete="off" type="number" v-model="pForm.total_price" :v-model="pForm.total_price = total_cost" />
                            </vx-input-group>
                            <span class="absolute text-danger alerttext">{{ errors.first('step-2.total_price') }}</span>
                        </div>
                    </vs-col>
                </vs-col>
            </vs-row>
        </form>

    </tab-content>

    <tab-content title="بررسی" class="mb-5">
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
                    <small class="mb-5" v-text="pForm.serial_no" vs-justify="right" vs-align="right"></small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                    <strong class="mr-4">
                        انتخاب اعلان:
                    </strong>
                    <small class="mb-5" v-text="pForm.proposal_id.text" vs-justify="right" vs-align="right"></small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                    <strong class="mr-4">
                        تاریخ عقد قرارداد:
                    </strong>
                    <small class="mb-5" v-text="pForm.contract_date" vs-justify="right" vs-align="right"></small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-1">
                    <strong class="mr-4">
                        مرجع مربوطه :
                    </strong>
                    <small class="mb-5" v-text="pForm.client_id.text" vs-justify="right" vs-align="right"></small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                    <strong class="mr-4">
                        عنوان قرارداد:
                    </strong>
                    <small class="mb-5" v-text="pForm.title" vs-justify="right" vs-align="right"></small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                    <strong class="mr-4">
                        نوعیت قرارداد:
                    </strong>
                    <small v-if="pForm.status== 2" class="mb-5" vs-justify="right" vs-align="right">معین</small>
                    <small v-if="pForm.status== 1" class="mb-5" vs-justify="right" vs-align="right">چارچوبی</small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                    <strong class="mr-4">
                        شماره شناسایی قرارداد :
                    </strong>
                    <small class="mb-5" v-text="pForm.reference_no" vs-justify="right" vs-align="right"></small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                    <strong class="mr-4">
                        تاریخ ختم قرارداد:
                    </strong>
                    <small class="mb-5" v-text="pForm.contract_end_date" vs-justify="right" vs-align="right"></small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                    <strong class="mr-4">
                        تضمین قرارداد:
                    </strong>
                    <small class="mb-5" v-text="pForm.project_guarantee" vs-justify="right" vs-align="right"></small>
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
        <vs-table :data="pForm.item">
            <template slot="thead" style="background-color: #f3f5f7">
                <vs-th>جنس / محصول</vs-th>
                <vs-th>مقدار</vs-th>
                <vs-th>واحد اندازه گیری</vs-th>
                <vs-th>هزینه فی واحد</vs-th>
                <vs-th>هزینه مجموعی</vs-th>
            </template>
            <template slot-scope="{data}">
                <vs-tr :key="i" v-for="(tr, i) in data">
                    <vs-td :data="tr.item_id">
                        {{ (typeof tr.item_id == "object") ? findItem(tr.item_id.id) : findItem(tr.item_id) }}
                    </vs-td>
                    <vs-td :data="tr.ammount">
                        {{tr.ammount}}
                    </vs-td>
                    <vs-td :data="tr.item_id.uom_id">
                        {{ (typeof tr.item_id == "object") ? findUom(tr.item_id.uom_id) : findUom(tr.unit_id) }}
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
        <vs-row vs-w="12" class="expense-section">
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
                    <small class="mb-5" v-text="pForm.deposit" vs-justify="right" vs-align="right"></small>
                    <small style="color:#42b983;"><b>% </b></small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                    <strong class="mr-4">
                        مالیات:
                    </strong>
                    <small class="mb-5" v-text="pForm.tax" vs-justify="right" vs-align="right"></small>
                    <small style="color:#42b983;"><b>% </b></small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                    <strong class="mr-4">
                        متفرقه:
                    </strong>
                    <small class="mb-5" v-text="pForm.others" vs-justify="right" vs-align="right"></small>
                    <small style="color:#42b983;"><b>افغانی </b></small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                    <strong class="mr-4">
                        ارزش قرارداد:
                    </strong>
                    <small class="mb-5" v-text="pForm.pr_worth" vs-justify="right" vs-align="right"></small>
                    <small style="color:#42b983;"><b>افغانی </b></small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                    <strong class="mr-4">
                        انتقالات:
                    </strong>
                    <small class="mb-5" v-text="pForm.transit" vs-justify="right" vs-align="right"></small>
                    <small style="color:#42b983;"><b>افغانی </b></small>
                </h6>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="right" vs-align="right" vs-lg="4" vs-sm="6" vs-xs="12">
                <h6 class="mb-5 mt-3 ml-2">
                    <strong class="mr-4">
                        نرخ دهی:
                    </strong>
                    <small class="mb-5" v-text="pForm.total_price" vs-justify="right" vs-align="right"></small>
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
</template>

<script>
import vSelect from "vue-select";
import Ekmalat from "../shared/Ekmalat";

import {
    FormWizard,
    TabContent
} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import {
    Validator
} from 'vee-validate'
const dict = {
    custom: {
        serial_no: {
            required: 'سریال نمبر الزامی میباشد.',
            number: 'سریال نمبر باید نمبر باشد.'
        },
        contract_date: {
            required: 'تاریخ عقد قرارداد را انتخاب کنید.'
        },
        client_id: {
            required: 'نهاد را انتخاب کنید.'
        },
        title: {
            required: 'عنوان قرراداد الزامی است.'
        },
        reference_no: {
            required: 'شماره شناسایی قرارداد ضروری است.'
        },
        contract_end_date: {
            required: 'تاریخ ختم قرارداد الزامی است.'
        },
        bidding_date: {
            required: 'تاریخ آفرگشایی الزامی است.'
        },
        bidding_address: {
            required: 'آدرس آفرگشایی الزامی است.'
        },
        project_guarantee: {
            required: 'تضمین قرارداد الزامی است'
        },
        deposit: {
            required: 'فیصدی تامینات را وارد کنید.',
        },
        tax: {
            required: 'فیصدی مالیه را وارد کنید',
        },
        others: {
            required: 'هزینه متفرقه بالای قرارداد را وارد کنید.',
        },
        pr_worth: {
            required: 'ارزش قرارداد الزامی است.',
        },
        transit: {
            required: 'هزینه انتقالات را وارد کنید.',
        },
        total_price: {
            required: '',
        },
    }
}
// register custom messages
Validator.localize('en', dict)

export default {
    components: {
        "v-select": vSelect,
        FormWizard,
        TabContent,
        Ekmalat,
    },
    props: ['clients', 'newClient'],
    data() {
        return {
            is_accepted: false,
            // init values
            mainSNumber: 0,
            // Project Form
            pForm: new Form({
                serial_no: '',
                proposal_id: '',
                client_id: '',
                title: '',
                reference_no: '',
                status: "1",
                contract_date: '',
                contract_end_date: '',
                project_guarantee: '',
                item: [{
                    item_id: "",
                    unit_id: "",
                    operation_id: null,
                    equivalent: "",
                    ammount: "",
                    unit_price: "",
                    total_price: "",
                    density: null,
                }],
                deposit: '',
                tax: '',
                others: '',
                pr_worth: '',
                transit: '',
                total_price: 0,

            }),
            items: [],
            mesure_unit: [],
            proposals: [],
            itemType: [],
            // End Project Form

            // Data Sidebar
            addNewDataSidebar: false,
            sidebarData: {},
            statusFa: {
                on_hold: "درجریان",
                delivered: "تکمیل",
                canceled: "نا موفق",
            },
            selected: [],
            // products: [],
            itemsPerPage: 4,
            isMounted: false,
            addNewDataSidebar: false,
            sidebarData: {},
            proposalList: [],
        };
    },
    created() {
        this.$Progress.start()
        // this.getAllClients();
        this.getAllItems();
        this.getAllUnites();
        this.getProposals();
        if (this.$route.params.id) {
            this.getProject();
        } else {
            this.getNextSerialNo();
        }
    },
    computed: {
        isFormValid() {
            return Object.keys(this.fields).some(key => this.fields[key].validated) && Object.keys(this.fields).some(key => this.fields[key].valid);
        },
    },
    methods: {
        setProjectData(data) {
            if (data) {
                if (data.pro_items.length) {
                    for (let [key, data] of Object.entries(data.pro_items)) {
                        this.pForm.item.push(data.item);
                        console.log(this.pForm.item);
                    }

                } else {
                    this.pForm.item = [{
                        item_id: "",
                        unit_id: "",
                        operation_id: null,
                        equivalent: "",
                        ammount: "",
                        unit_price: "",
                        total_price: "",
                        density: null,

                    }];
                }
                if (data.pro_data) {
                    this.pForm.client_id = data.pro_data.client;
                    this.pForm.deposit = data.pro_data.deposit;
                    this.pForm.others = data.pro_data.others;
                    this.pForm.pr_worth = data.pro_data.pr_worth;
                    this.pForm.reference_no = data.pro_data.reference_no;
                    this.pForm.tax = data.pro_data.tax;
                    this.pForm.title = data.pro_data.title;
                    this.pForm.total_price = data.pro_data.total_price;
                    this.pForm.transit = data.pro_data.transit;
                    this.pForm.status = (data.status == 'normal') ? 1 : 2;
                    // console.log(this.pForm);
                }
            }
        },
        // for getting measure unit of the item
        getAllUnites() {
            this.axios.get('/api/m-units')
                .then((response) => {
                    this.mesure_unit = response.data;
                })
        },

        findItem(id) {
            let item = '';
            Object.keys(this.items).some(key => (this.items[key].id == id) ? item = this.items[key].name : null);
            return item;
        },
        findUom(id) {
            let name = '';
            Object.keys(this.mesure_unit).some(key => (this.mesure_unit[key].id == id) ? name = this.mesure_unit[key].acronym : null);
            return name;
        },

        // 'asdfdsfds', for getting the next serian number
        getNextSerialNo() {
            this.axios.get('/api/serial-num?type=pro')
                .then((response) => {
                    this.pForm.serial_no = response.data;
                    if (this.newClient) {
                        this.pForm.client_id = this.clients.find(e => !!e);
                        // this.pForm.client_id = this.clients.find(e => !!e);
                    }
                })
        },

        // for Organs that implement the ad
        getAllClients() {
            this.axios.get('/api/clients')
                .then((response) => {
                    this.clients = response.data;
                })
        },

        // for items to be bought
        getAllItems() {
            this.axios.get('/api/items')
                .then((response) => {
                    this.items = response.data;

                })
        },
        getProposals() {
            this.axios.get('/api/proposal')
                .then((response) => {
                    this.proposals = response.data;
                    // Object.keys(this.proposals).some(key => this.proposals[key]['title'] = this.proposals[key].pro_data.title);
                    // console.log(this.proposals);
                    this.$Progress.set(100)
                })
        },

        // set the id of Selected Organ
        setClientId(arr) {
            this.pForm.client_id = arr.text;
        },

        // set the id of Selected Goods/Product name
        setItemId(arr) {
            this.pForm.item.item_id = arr.id;
        },

        // set the id of Selected Measure Unite
        setUnitId(arr) {
            this.pForm.item.unit_id = arr.id;
        },

        addNewRow() {
            this.pForm.item.push({
                item_id: "",
                unit_id: "",
                operation_id: null,
                equivalent: "",
                ammount: "",
                unit_price: "",
                total_price: "",
                density: null,
            })
        },
        validateStep1() {
            return new Promise((resolve, reject) => {
                this.$validator.validateAll('step-1').then(result => {
                    if (result) {
                        resolve(true)
                    } else {
                        reject('correct all values')
                    }
                })
            })
        },
        validateStep2() {
            return new Promise((resolve, reject) => {
                this.$validator.validateAll('step-2').then(result => {
                    if (result) {
                        resolve(true)
                    } else {
                        reject('correct all values')
                    }
                })
            })
        },
        submitForm() {
            // Start the Progress Bar
            if (!this.is_accepted) {
                swal.fire({
                    title: 'نامکمل!',
                    text: 'لطفا معلومات را تایید کنید.',
                    icon: 'error',
                })
            } else {
                this.$Progress.start()
                this.pForm.post('/api/project')
                    .then(({
                        data
                    }) => {
                        // Finish the Progress Bar
                        this.$refs.wizard.reset();
                        this.pForm.reset();
                        this.errors.clear();
                        this.$Progress.set(100)
                        this.$vs.notify({
                            title: 'موفقیت!',
                            text: 'قرارداد موفقانه ثبت شد.',
                            color: 'success',
                            iconPack: 'feather',
                            icon: 'icon-check',
                            position: 'top-right'
                        })
                    }).catch((errors) => {
                        this.$vs.notify({
                            title: 'موفقیت!',
                            text: 'قرارداد موفقانه ثبت شد.',
                            color: 'success',
                            iconPack: 'feather',
                            icon: 'icon-check',
                            position: 'top-right'
                        })
                    });
            }
        },
        formReset() {
            this.pForm.reset();
            this.pForm.s_number = this.mainSNumber;
        },
        getProject() {
            this.axios.get('/api/project/' + this.$route.params.id)
                .then((response) => {
                    this.setPFromValue(response.data);
                    this.$Progress.set(100)
                })
        },
        setPFromValue(resp) {
            // for (let [key,value] of Object.entries(resp)) {
            //   this.pForm[key] = value;
            // }
            for (let [key, value] of Object.entries(resp.pro_data)) {
                this.pForm[key] = value;
            }
            for (let [key, value] of Object.entries(resp)) {
                if (key == 'status') {
                    this.pForm[key] = (value == 'income') ? 1 : 2;
                } else {

                    this.pForm[key] = value;
                }
            }
            if (resp.pro_items) {
                this.pForm.item = resp.pro_items;
            }
            console.log(resp.pro_items);

            this.pForm.client_id = resp.pro_data.client;
        },
    },
    // End Of methods
    computed: {
        // To calculate the total price for :the proposal
        total_cost: function () {
            let others = (this.pForm.others) ? parseInt(this.pForm.others) : 0;
            let transit = (this.pForm.transit) ? parseInt(this.pForm.transit) : 0;
            // let pr_worth = (this.pForm.pr_worth) ? parseInt(this.pForm.pr_worth) : 0;

            let total_items = 0;
            this.pForm.item.filter(function (item) {
                if (item && item.total_price) {
                    total_items += parseInt(item.total_price);
                }
            })
            return others + transit + total_items;
        },
    },

};
</script>

<style lang="scss">
#data-list-thumb-view {
    .vs-con-table {
        .product-name {
            max-width: 23rem;
        }

        .vs-table--header {
            display: flex;
            flex-wrap: wrap-reverse;
            margin-left: 1.5rem;
            margin-right: 1.5rem;

            >span {
                display: flex;
                flex-grow: 1;
            }

            .vs-table--search {
                padding-top: 0;

                .vs-table--search-input {
                    padding: 0.9rem 2.5rem;
                    font-size: 1rem;

                    &+i {
                        left: 1rem;
                    }

                    &:focus+i {
                        left: 1rem;
                    }
                }
            }
        }

        .vs-table {
            border-collapse: separate;
            border-spacing: 0 1.3rem;
            padding: 0 1rem;

            tr {
                box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.05);

                td {
                    padding: 10px;

                    &:first-child {
                        border-top-left-radius: 0.5rem;
                        border-bottom-left-radius: 0.5rem;
                    }

                    &:last-child {
                        border-top-right-radius: 0.5rem;
                        border-bottom-right-radius: 0.5rem;
                    }

                    &.img-container {

                        // width: 1rem;
                        // background: #fff;
                        span {
                            display: flex;
                            justify-content: flex-start;
                        }

                        .product-img {
                            height: 110px;
                        }
                    }
                }

                td.td-check {
                    padding: 20px !important;
                }
            }
        }

        .vs-table--thead {
            th {
                padding-top: 0;
                padding-bottom: 0;

                .vs-table-text {
                    text-transform: uppercase;
                    font-weight: 600;
                }
            }

            th.td-check {
                padding: 0 15px !important;
            }

            tr {
                background: none;
                box-shadow: none;
            }
        }

        .vs-table--pagination {
            justify-content: center;
        }
    }
}
</style>
