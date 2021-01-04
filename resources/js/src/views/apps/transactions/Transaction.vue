<template>
<div>
    <vs-tabs>
        <vs-tab label="ثبت معاملات">
            <vs-card class="w-full p-4">

              <form action="">
                <div class="vx-row">
                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
                        <div class="w-full  ml-3 mr-3">
                            <vs-input size="medium" v-validate="'required'" v-model="form.serial_no" label="سریال نمبر" name="serial_no" class="mt-5 w-full" placeholder="سریال نمبر" disabled />
                            <!--<span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first("serialnumber") }}</span> -->
                            <has-error :form=" form" field="serial_no"></has-error>
                        </div>
                    </vs-col>

                    <!-- currency -->

                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12" class="mt-3">
                        <div class="w-full pt-2 ml-3 mr-3">
                            <label for class="ml-4 mr-4 mb-2">واحد پولی</label>
                            <div class="radio-group w-full">
                                <div class="w-1/2">
                                    <input type="radio" v-model="form.currency_id" value="1" id="struct" name="curency" />
                                    <label for="struct" class="w-full text-center">افغانی</label>
                                </div>
                                <div class="w-1/2">
                                    <input type="radio" v-model="form.currency_id" value="2" id="specific" name="curency" />
                                    <label for="specific" class="w-full text-center">دالر</label>
                                </div>
                            </div>
                            <has-error :form=" form" field="curency"></has-error>
                        </div>
                    </vs-col>
                    <!-- end currency -->


                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
                        <div class="w-full  ml-3 mr-3">
                            <label for="date" class="mt-3"><small>تاریخ </small></label>

                            <date-picker color="#e85454" input-format="DD/MM/YYYY HH:mm" format="jDD/jMM/jYYYY HH:mm" type="datetime" v-model="form.datetime" />
                        </div>
                    </vs-col>

                    <!-- currency -->

                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="3" vs-sm="6" vs-xs="12">
                        <div class="w-full pt-2 ml-3 mr-3">
                            <label for class="ml-4 mr-4 mb-2"> حالت معامله</label>
                            <div class="radio-group w-full">
                                <div class="w-1/2">
                                    <input type="radio" v-model="form.transaction_status" value="1" id="benifate" name="transaction" />
                                    <label for="benifate" class="w-full text-center">عاید</label>
                                </div>
                                <div class="w-1/2">
                                    <input type="radio" v-model="form.transaction_status" value="2" id="basic" name="transaction" />
                                    <label for="basic" class="w-full text-center">امانت/عادی</label>
                                </div>
                            </div>
                            <has-error :form=" form" field="transaction_status"></has-error>
                        </div>
                    </vs-col>

                    <!-- Must only consist of numbers -->

                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
                        <div class="w-full  ml-3 mr-3">
                            <vs-input size="medium" v-model="form.title" @input="getTitle" label="عنوان معامله" class="w-full" />
                        </div>
                    </vs-col>

                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12" class="mt-5">
                        <div class="w-full  ml-3 mr-3 mt-2">
                            <label for>
                                <small>مقدار</small>
                            </label>
                            <vx-input-group class="mb-base">
                                <template slot="prepend">
                                    <div class="prepend-text bg-primary">
                                        <span>AFN</span>
                                    </div>
                                </template>

                                <vs-input type="number" v-model="form.ammount"/>
                            </vx-input-group>
                        </div>
                    </vs-col>

                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                        <div class="w-full  ml-3 mr-3">
                            <label for>
                                <small>حساب کریدیت</small>
                            </label>
                            <v-select size="medium" label="name" :options="accounts" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="form.credit_account" />
                        </div>
                    </vs-col>

                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="6" vs-xs="12">
                        <div class="w-full  ml-3 mr-3 mb-4">
                            <vs-input size="medium" label="تفصیلات " v-model="form.credit_desc" class="mt-5 w-full" />
                        </div>
                    </vs-col>

                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                        <div class="w-full  ml-3 mr-3">
                            <label for>
                                <small>حساب دبیت </small>
                            </label>
                            <v-select size="medium" label="name" :options="accounts" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="form.debit_account"/>
                        </div>
                    </vs-col>

                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="8" vs-sm="6" vs-xs="12">
                        <div class="w-full  ml-3 mr-3 mb-4">
                            <vs-input size="medium" label="تفصیلات " v-model="form.debit_desc" class="mt-5 w-full" />
                        </div>
                    </vs-col>

                    <div class="vx-col w-full mt-4">
                        <vs-textarea label="تفصیلات کلی" v-model="form.description"></vs-textarea>
                    </div>
                </div>
                    <vs-button class="mr-3 mb-2" @click.prevent="submitData">ثبت</vs-button>
                </form>
            </vs-card>
        </vs-tab>

        <vs-tab label="لیست معاملات">
            <Transactionlist></Transactionlist>
        </vs-tab>
    </vs-tabs>
</div>
</template>

<script>
import Transactionlist from "./Transactionlist.vue";
import vSelect from "vue-select";

export default {
    components: {
        Transactionlist,
        "v-select": vSelect,
    },
    data() {
        return {
            form: new Form({
                serial_no: '',
                currency_id: 1,
                datetime: new Date().getTime(),
                title: '',
                transaction_status: '',
                ammount: '',
                credit_account: '',
                debit_account: '',
                credit_desc: '',
                debit_desc: '',
                description: ''
            }),
            accounts: [],
        };
    },
    created() {
        this.getAccounts();
    },
    methods: {
        submitData() {
            
        },

        getAccounts() {
            this.$Progress.start()
            this.$vs.loading()
            this.axios.get('/api/account')
                .then((response) => {
                    this.accounts = response.data;
                    this.$vs.loading.close();
                })
        }
    },
};
</script>


