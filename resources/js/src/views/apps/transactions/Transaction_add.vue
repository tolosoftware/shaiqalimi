<template>
  <div class="vx-row">
    <vx-card class="height-vh-80">
      <div class="vx-row">
        <div class="vx-col w-1/2">
          <h3>فارم ثبت معامله</h3>
        </div>
      </div>
      <div style="padding: 20px">
        <form>
          <div class="vx-row">
            <!-- serial number  class="mt-5 w-full"-->
            <div class="vx-col w-1/4 mt-5">
              <vs-input
                id="deal_serial_number"
                label="سریال نمبر"
                v-model="transaction.deal_serial_number"
                name="deal_serial_number"
                disabled
              />
              <span
                class="text-danger text-sm"
                v-show="errors.has('deal_serial_number')"
                >{{ errors.first("deal_serial_number") }}</span
              >
            </div>
            <!-- deal currency -->
            <div class="vx-col w-1/5 mt-5">
              <label for="currency">واحد پولی</label>
              <div class="btn-group">
                <div class="vx-row pl-4 pr-4" id="curency">
                  <br />
                  <input
                    class="form-check-input"
                    type="radio"
                    name="deal_curency"
                    id="afghani"
                    @change="onChange_curency($event)"
                    v-model="transaction.deal_curency"
                    value="afghani"
                    checked
                    style="height: 25px; width: 25px"
                  />
                  <label class="form-check-label" for="afghani">
                    &nbsp;
                    <b>افغانی</b>
                    &nbsp;&nbsp;
                  </label>
                  <input
                    class="form-check-input"
                    type="radio"
                    name="deal_curency"
                    @change="onChange_curency($event)"
                    id="dolar"
                    value="dolar"
                    style="height: 25px; width: 25px"
                  />
                  <label class="form-check-label" for="dolar">
                    &nbsp;
                    <b>دالر</b>
                  </label>
                </div>
              </div>
            </div>
            <!-- deal amount -->
            <div class="vx-col w-1/3 pt-4">
              <label for="deal_amount"
                ><span style="margin-right: 5px">مقدار به</span></label
              >
              <vx-input-group class="mb-base">
                <template slot="prepend">
                  <div class="prepend-text bg-primary">
                    <span>{{ curency_label }}</span>
                  </div>
                </template>
                <vs-input
                  type="number"
                  name="deal_amount"
                  class="w-full"
                  id="deal_amount"
                  v-model="transaction.deal_amount"
                />
              </vx-input-group>
              <!-- /TITLE -->
            </div>
            <!-- deal status -->
            <div class="vx-col w-1/5 mt-5">
              <label for>حالت معامله</label>
              <div class="btn-group">
                <div class="vx-row pl-4 pr-4">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="deal_status"
                    @change="onChange_deal_status($event)"
                    id="deal_status1"
                    value="income"
                    style="height: 25px; width: 25px"
                  />
                  <label class="form-check-label" for="deal_status">
                    &nbsp;
                    <b>عاید</b>
                    &nbsp;&nbsp;
                  </label>
                  <input
                    class="form-check-input"
                    type="radio"
                    name="deal_status"
                    @change="onChange_deal_status($event)"
                    id="deal_status2"
                    value="normal"
                    checked
                    style="height: 25px; width: 25px"
                  />
                  <label class="form-check-label" for="deal_status">
                    &nbsp;
                    <b>امانت</b>
                  </label>
                </div>
              </div>
            </div>
            <!-- deal date -->
            <div class="vx-col w-1/3">
              <label for="deal_date" style="margin-right: 5px"
                >تاریخ معامله
                <date-picker
                  input-format="YYYY/MM/DD"
                  format="jYYYY/jMM/jDD"
                  id="deal_date"
                  v-model="transaction.deal_date"
                  :auto-submit="true"
                  size="large"
                  type="datetime"
                ></date-picker
              ></label>
              <!-- <date-picker :auto-submit="true" type="datetime" /> -->
            </div>
            <!-- deal title -->
            <div class="vx-col w-2/3">
              <vs-input
                v-model="transaction.deal_title"
                label="عنوان معامله"
                name="deal_title"
                class="w-full"
              />
            </div>
            <!-- debit account -->
            <div class="vx-col w-1/3 mt-6">
              <label for> حساب دبت </label>
              <v-select
                label="text"
                v-model="transaction.deal_debit_account"
                size="large"
                :options="debit_options"
                :dir="$vs.rtl ? 'rtl' : 'ltr'"
              />
            </div>
            <!-- debit account description -->
            <div class="vx-col w-2/3 mt-6">
              <vs-input
                v-model="transaction.deal_dbt_acnt_desc"
                label="توضیحات حساب دبت"
                name="deal_dbt_acnt_desc"
                class="w-full"
              />
            </div>
            <!-- credit account -->
            <div class="vx-col w-1/3 mt-5">
              <label for>حساب کریدیت</label>
              <v-select
                :options="credit_options"
                label="text"
                v-model="transaction.deal_credit_account"
                size="large"
                :dir="$vs.rtl ? 'rtl' : 'ltr'"
              />
            </div>
            <!-- credit account description -->
            <div class="vx-col w-2/3 mt-6">
              <vs-input
                v-model="transaction.deal_crdt_acnt_desc"
                label="توضیحات حساب کریدیت"
                name="deal_crdt_acnt_desc"
                class="w-full"
              />
            </div>
            <!-- deal detail -->
            <div class="vx-col w-full mt-6">
              <label for="deal_detail"> جزییات معامله</label>
              <vs-textarea
                v-model="transaction.deal_description"
                placeholder=" تفصیلات معامله را اینجا بنویسید"
                id="deal_detail"
              ></vs-textarea>
            </div>
          </div>
          <vs-button
            type="filled"
            @click.prevent="submitForm"
            class="mt-5 block"
          >
            ثبت معامله جدید</vs-button
          >
        </form>
      </div>
    </vx-card>
  </div>
</template>
<script>
import vSelect from "vue-select";
import Validation from "../../../Validation.js";
export default {
  data() {
    return {
      curency_label: "افغانی",
      success: false,
      loaded: true,
      debit_options: [
        { text: "گزینه ۱", value: "1" },
        { text: "گزینه ۲", value: "2" },
        { text: "گزینه ۳", value: "3" },
      ],
      credit_options: [
        { text: "گزینه ۱", value: "1" },
        { text: "گزینه ۲", value: "2" },
      ],
      itemType: [
        {
          text: "تیل دیزل",
          value: "1",
        },
        {
          text: "تیل گاز",
          value: "2",
        },
        {
          text: "تیل پطرول",
          value: "3",
        },
        {
          text: "موبلین",
          value: "4",
        },
      ],
      transaction: {
        deal_serial_number: "1001",
        deal_curency: "afghani",
        deal_amount: "4564",
        deal_status: "normal",
        deal_date: "1399/09/08",
        deal_title: "حل مشکلات مبنی بر قرار داد وزارت",
        deal_debit_account: "",
        deal_dbt_acnt_desc: "kslfjlaskfa",
        deal_credit_account: "",
        deal_crdt_acnt_desc: "klsjflkasjfl",
        deal_description: "lksjfklajsflaj",
      },
      validation: new Validation(),
    };
  },
  components: { "v-select": vSelect },
  methods: {
    onChange_curency(event) {
      this.transaction.curency = event.target.value;
      if (this.transaction.curency == "afghani") {
        this.curency_label = "افغانی";
      } else if (this.transaction.curency == "dolar") {
        this.curency_label = "دالر";
      }
      console.log(this.transaction.curency);
    },
    onChange_deal_status(event) {
      this.transaction.deal_status = event.target.value;
      console.log(this.transaction.deal_status);
    },
    submitForm() {
      //   console.log("data", this.transaction);
      if (this.loaded) {
        this.loaded = false;
        this.success = false;
        let transactionDate = this.transaction;
        this.validation.empty();
        this.axios
          .post("api/transaction/create", transactionDate)
          .then((response) => {
            this.transaction = {}; //Clear input fields
            this.loaded = true;
            this.success = true;
            toast.fire({
              type: "success",
              title: "معامله موفقانه ذخیره گردید !",
            });
          })
          .catch((error) => {
            this.loaded = true;
            if (error.response.status == 422) {
              this.validation.setMessages(error.response.data.errors);
            }
          });
      }
    },
  },
};
</script>
