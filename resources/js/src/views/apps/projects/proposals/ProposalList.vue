<template>
<!--<vs-tabs>
  <vs-tab label="تمام آفرها">-->
<div id="data-list-thumb-view" class="w-full data-list-container">
  <div v-if="!isdata">
    <TableLoading></TableLoading>
  </div>
  <vs-table v-if="isdata" class="w-full" ref="table" pagination :max-items="itemsPerPage" search :data="proposals">
    <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between" id="proposalTable">
      <!-- ITEMS PER PAGE -->
      <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4">
        <div class="pl-4 pr-4 pt-1 pb-1 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
          <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ proposals.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : proposals.length }} از {{ queriedItems }}</span>
          <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
        </div>
        <vs-dropdown-menu>
          <vs-dropdown-item @click="itemsPerPage=4">
            <span>۴</span>
          </vs-dropdown-item>
          <vs-dropdown-item @click="itemsPerPage=10">
            <span>۱۰</span>
          </vs-dropdown-item>
          <vs-dropdown-item @click="itemsPerPage=15">
            <span>۱۵</span>
          </vs-dropdown-item>
          <vs-dropdown-item @click="itemsPerPage=20">
            <span>۲۰</span>
          </vs-dropdown-item>
        </vs-dropdown-menu>
      </vs-dropdown>
    </div>
    <template slot="thead">
      <vs-th>نمبر</vs-th>
      <vs-th>نهاد</vs-th>
      <vs-th sort-key="product-name">پروژه</vs-th>
      <vs-th sort-key="offer_guarantee">تضمین آفر</vs-th>
      <vs-th sort-key="status">وضعیت</vs-th>
      <vs-th sort-key="price">قیمت</vs-th>
      <vs-th sort-key="bidding_address">آدرس</vs-th>
      <vs-th sort-key="bidding_date">تاریخ پیشنهاد</vs-th>
      <vs-th>تنظیمات</vs-th>
    </template>
    <template slot-scope="{data}">
      <tbody>
        <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
          <vs-td class="pl-2 text-center">
            {{ indextr + 1 }}
          </vs-td>
          <vs-td class="img-container">
            <p v-if="tr.pro_data" class="product-name font-medium truncate">
              <!-- <img :src="tr.img" class="product-img" /> -->
              <p @click.stop="$router.push({ path: `/proposal/${tr.id}` })">{{ findClient(tr.pro_data.client_id) }}</p>
            </p>
          </vs-td>

          <vs-td>
            <div v-if="tr.pro_data">
              <p class="product-name font-medium truncate" @click.stop="$router.push({ path: `/proposal/${tr.id}` })">
                {{ tr.pro_data.title }}</p>
            </div>
          </vs-td>

          <vs-td>
            <!-- <vs-progress :percent="Number(tr.popularity)" :color="getPopularityColor(Number(tr.popularity))" class="shadow-md" /> -->
            <p class="offer_guarantee">{{ tr.offer_guarantee }} افغانی</p>
          </vs-td>

          <vs-td>
            <vs-chip :color="getOrderStatusColor(tr.status)" class="product-order-status">{{ statusFa[tr.status] }}</vs-chip>
          </vs-td>

          <vs-td>
            <p v-if="tr.pro_data" class="product-price">{{ tr.pro_data.total_price }} افغانی</p>
          </vs-td>
          <vs-td>
            <p class="bidding_address">{{ tr.bidding_address }}</p>
          </vs-td>
          <vs-td>
            <p class="bidding_date">{{ tr.bidding_date }}</p>
          </vs-td>

          <vs-td class="whitespace-no-wrap notupfromall">
            <feather-icon icon="CheckSquareIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current" class="ml-2" @click.stop="showCheckModal(tr.id)" />
            <feather-icon icon="PrinterIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current" class="ml-2" @click.stop="showPrintData(tr.id)" />
            <feather-icon icon="EditIcon" svgClasses="w-6 h-6 hover:text-primary stroke-current" />
            <feather-icon icon="TrashIcon" svgClasses="w-6 h-6 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(tr.id)" />
          </vs-td>
        </vs-tr>
      </tbody>
    </template>
  </vs-table>
  <vs-popup class="holamundo" title="پیشرفت آفر/ اعلان" :active.sync="popupModalActive">
    <form-wizard color="rgba(var(--vs-primary), 1)" :title="null" :subtitle="null" back-button-text="قبلی" next-button-text="بعدی" :start-index="0" ref="wizard" finishButtonText="بستن مادل" @on-complete="formSubmitted">
      <tab-content title="ثبت اطلاعات" class="mb-5">
        <vs-row vs-w="12" class="mb-1">
          <vs-row vs-w="12">
            <vs-divider>بررسی بخش ثبت اطلاعات</vs-divider>
          </vs-row>
          <vs-row vs-w="12">
            <!--<div v-for="(row, indextr) in proposal">
              <p>{{row.name}}</p>
              <p>{{row.title}}</p>
            </div>
            <br>-->
            <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="vx-row">
                <vs-col vs-lg="3" vs-sm="4" vs-xs="12">
                  <div class="img-container">
                    <img :src="'/images/haj.png'" style="height:80px;margin:-1px 10px" class="product-img" @click.stop="showClientData(tr.id)" />
                  </div>
                </vs-col>
                <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="8" vs-xs="12">
                  <div class="vx-row w-full">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p clas="w-full"><strong>نام نهاد: </strong>{{proposal.pro_data}}</p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                      <p class="w-full"><strong>شماره قرارداد: </strong>995894UNSNS</p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p class="w-full pr-5"><strong>عنوان قرارداد: </strong>قرارداد تیل وزارت معارف</p>
                    </vs-col>
                  </div>
                </vs-col>
              </div>
            </vs-col>
            <vs-col class="pl-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="vx-row w-full">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p clas="w-full"><strong class="mr-4">تاریخ نشراعلان: </strong>1399/10/22</p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                  <p class="w-full"><strong class="mr-4">تاریخ ختم پیشنهادات: </strong>1399/10/22</p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p class="w-full pr-5"><strong class="mr-4">تاریخ داوطلبی: </strong>1399/10/22</p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p class="w-full pr-5"><strong class="mr-4">مقدار تضمین: </strong>1399/10/22</p>
                </vs-col>
              </div>
            </vs-col>
            <!-- <div class="flex justify-between float-right">
              <vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2">ثبت</vs-button>
            </div>-->
          </vs-row>
          <vs-divider>بخش اکمالات</vs-divider>
          <!--<vs-table :data="proposals.pro_items">-->
          <vs-table class="responsive">
            <template>
              <vs-th>جنس / محصول</vs-th>
              <vs-th>مقدار</vs-th>
              <vs-th>عملیه</vs-th>
              <vs-th>قیمت فی واحد</vs-th>
              <vs-th>قیمت مجموعی</vs-th>
            </template>
            <template>
              <vs-tr>
                <vs-td>
                  <p> تیل دیزل </p>
                </vs-td>
                <vs-td>
                  تبنتسب
                </vs-td>
                <vs-td>
                  <p> اصلی </p>
                </vs-td>
                <vs-td>
                  56 <small style="color:#42b983;"><b>افغانی </b></small>
                </vs-td>
                <vs-td>
                  5655 <small style="color:#42b983;"><b>افغانی </b></small>
                </vs-td>
              </vs-tr>
            </template>
          </vs-table>
          <!--<template slot-scope="{data}">
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
              </template>-->
          <!--</vs-table>-->

        </vs-row>
      </tab-content>
      <tab-content title="ارسال درخواستی" class="mb-5">
        <vs-row vs-w="12" class="mb-1">
          <vs-row vs-w="12">
            <vs-divider>بررسی بخش ارسال درخواستی</vs-divider>
          </vs-row>
          <vs-row vs-w="12">
            <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="vx-row">
                <vs-col vs-lg="3" vs-sm="4" vs-xs="12">
                  <div class="img-container">
                    <img :src="'/images/haj.png'" style="height:80px;margin:-1px 10px" class="product-img" @click.stop="showClientData(tr.id)" />
                  </div>
                </vs-col>
                <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="8" vs-xs="12">
                  <div class="vx-row w-full">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p clas="w-full"><strong>نام نهاد: </strong>وزارت معارف</p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                      <p class="w-full"><strong>شماره قرارداد: </strong>995894UNSNS</p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p class="w-full pr-5"><strong>عنوان قرارداد: </strong>قرارداد تیل وزارت معارف قرارداد تیل وزارت معارفقرارداد تیل وزارت معارف</p>
                    </vs-col>
                  </div>
                </vs-col>
              </div>
            </vs-col>
            <vs-col class="pl-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <p clas="w-full"><strong class="mr-4"> شماه تماس: </strong>0799689133 <vs-button class="float-right mr-3" size="small" type="gradient" icon="print" id="printBTN" @click="cprint">چاپ عریضه</vs-button>
                  </p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                  <p class="w-full"><strong class="mr-4"> آدرس: </strong>کارته چهار، ناحیه سوم، کابل افغانستان</p>
                </vs-col>
              </div>
              <div class="vx-row">
                <vs-col vs-type="flex" class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                  <div class="">
                    <vs-input size="small" icon-no-border icon="account_circle" label-placeholder=" اسم شخص مسول را وارد نمایید" v-model="res_person" />
                  </div>
                  <div class="mt-1 mr-4 pt-1">
                    <span class="AFGLabel">
                      <vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2"> ثبت شخص</vs-button>
                    </span>
                  </div>
                </vs-col>
              </div>
            </vs-col>
          </vs-row>
          <vs-divider></vs-divider>
          <div class="vx-row" vs-w="12"></div>
        </vs-row>
      </tab-content>
      <tab-content title="دریافت شرطنامه/آفر" class="mb-5">
        <vs-row vs-w="12" class="mb-1">
          <vs-row vs-w="12">
            <vs-divider>بررسی بخش دریافت شرطنامه </vs-divider>
          </vs-row>
          <vs-row vs-w="12">
            <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="vx-row">
                <vs-col vs-lg="3" vs-sm="4" vs-xs="12">
                  <div class="img-container">
                    <img :src="'/images/haj.png'" style="height:80px;margin:-1px 10px" class="product-img" @click.stop="showClientData(tr.id)" />
                  </div>
                </vs-col>
                <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="8" vs-xs="12">
                  <div class="vx-row w-full">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p clas="w-full"><strong>نام نهاد: </strong>وزارت معارف</p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                      <p class="w-full"><strong>شماره قرارداد: </strong>995894UNSNS</p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p class="w-full pr-5"><strong>عنوان قرارداد: </strong>قرارداد تیل وزارت معارف قرارداد تیل وزارت معارفقرارداد تیل وزارت معارف</p>
                    </vs-col>
                  </div>
                </vs-col>
              </div>
            </vs-col>
            <vs-col class="pl-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="vx-row pl-3">
                <vs-col class="mb-3 ml-2" vs-justify="right" vs-align="right" vs-w="12">
                  <p clas="mb-1"><strong class="mr-4"> تاریخ دریافت شرطنامه: </strong>1399/10/22
                  </p>
                </vs-col>
                <vs-col class="mb-2" vs-justify="right" vs-align="right" vs-w="12">
                  <vs-checkbox color="success" size="large" v-model="is_recieved"><strong> شرطنامه دریافت گردید ؟ </strong></vs-checkbox>
                  <vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2 mt-2 ml-1"> ویرایش معلومات </vs-button>
                </vs-col>
              </div>
            </vs-col>
          </vs-row>
          <vs-divider></vs-divider>
        </vs-row>
      </tab-content>
      <tab-content title="ارایه قیمت" class="mb-5">
        <vs-row vs-w="12" class="mb-1">
          <vs-row vs-w="12">
            <vs-divider>بررسی بخش ارایه قیمت</vs-divider>
          </vs-row>
          <vs-row vs-w="12">
            <ekmalat :items="aForm.item" :form="aForm" :listOfFields="dict" ref="ekmalat"></ekmalat>
            <!--<div class="flex justify-between float-right">
              <vs-button size="small" color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2">ثبت</vs-button>
            </div>-->
          </vs-row>
          <vs-divider></vs-divider>
        </vs-row>
      </tab-content>
      <tab-content title="مرحله داوطلبی" class="mb-5">
        <vs-row vs-w="12" class="mb-1">
          <vs-row vs-w="12">
            <vs-divider>بررسی بخش داوطلبی</vs-divider>
          </vs-row>
          <vs-row vs-w="12">
            <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="vx-row">
                <vs-col vs-lg="3" vs-sm="4" vs-xs="12">
                  <div class="img-container">
                    <img :src="'/images/haj.png'" style="height:80px;margin:-1px 10px" class="product-img" @click.stop="showClientData(tr.id)" />
                  </div>
                </vs-col>
                <vs-col vs-lg="9" class="pl-3" vs-align="right" vs-sm="8" vs-xs="12">
                  <div class="vx-row w-full">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p clas="w-full"><strong>نام نهاد: </strong>وزارت معارف</p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="righ" vs-align="right" vs-w="12">
                      <p class="w-full"><strong>شماره قرارداد: </strong>995894UNSNS</p>
                    </vs-col>
                  </div>
                  <div class="vx-row">
                    <vs-col class="mb-1" vs-justify="right" vs-align="right" vs-w="12">
                      <p class="w-full pr-5"><strong>عنوان قرارداد: </strong>قرارداد تیل وزارت معارف قرارداد تیل وزارت معارفقرارداد تیل وزارت معارف</p>
                    </vs-col>
                  </div>
                </vs-col>
              </div>
            </vs-col>
            <vs-col class="pl-5" vs-lg="6" vs-sm="6" vs-xs="12">
              <div class="vx-row pl-3">
                <vs-col class="mb-3" vs-justify="right" vs-align="right" vs-w="12">
                  <p clas="mb-1"><strong class="mr-4"> تاریخ داوطلبی: </strong>1399/10/22
                  </p>
                </vs-col>
                <vs-col class="mb-2" vs-justify="right" vs-align="right" vs-w="12">
                  <p class="w-full"><strong class="mr-4"> آدرس داوطلبی: </strong>کارته چهار، ناحیه سوم، کابل افغانستان</p>
                </vs-col>
                <vs-col class="mb-2" vs-justify="right" vs-align="right" vs-w="12">
                  <p class="w-full"><strong class="mr-4"> مقدارتضمین: </strong>(1993)<b style="color:lightblue"> افغانی </b>__<b style="color:green">بانکی</b></p>
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
              <vs-row vs-w="12">
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3 mb-3">
                    <vs-input autocomplete="off" label="نام شرکت" name="co_name" class="w-full" />
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3 mb-3">
                    <vs-input autocomplete="off" label="مشابه / مشکلات" name="problems" class="w-full" />
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3 mb-3">
                    <vs-input autocomplete="off" label="اسیستمنت" name="assistment" class="w-full" />
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3 mb-3">
                    <vs-input autocomplete="off" label="فیات" name="feyat" class="w-full" />
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3 mb-3">
                    <vs-input autocomplete="off" label="قیمت آفر" name="offer_price" class="w-full" />
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3 mb-3">
                    <vs-input autocomplete="off" label="تخفیف" name="discount" class="w-full" />
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 ml-3 mr-3 mb-3">
                    <vs-input autocomplete="off" label="قیمت نهایی" name="final_price" class="w-full" />
                  </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="4" vs-sm="6" vs-xs="12">
                  <div class="w-full pt-2 mt-5 ml-3 mr-3 mb-3">
                    <vs-button color="success" icon="save" type="border" @click.prevent="submitForm" class="mb-2 mt-2 ml-1"> ثبت معلومات </vs-button>
                  </div>
                </vs-col>
              </vs-row>
            </form>
          </vs-row>
          <vs-divider></vs-divider>
        </vs-row>
      </tab-content>
      <tab-content title="نتیجه قرارداد" class="mb-5">
        <vs-row vs-w="12" class="mb-1">
          <vs-row vs-w="12">
            <vs-divider>بررسی بخش نتیجه قرارداد</vs-divider>
          </vs-row>
          <vs-row vs-w="12" vs-type="flex" vs-justify="center">
            <div class="radio-group1 w-full">
              <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
                <vs-row vs-w="12" vs-type="flex" vs-justify="center">
                  <!--<div class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
                  </div>-->
                  <div class="pr-5 float-left" vs-lg="8" vs-sm="8" vs-xs="12">
                    <input type="radio" v-model="status" value="1" id="struct" name="status" />
                    <label for="struct" class="w-full text-center">دریافت قرارداد</label>
                  </div>
                </vs-row>
              </vs-col>
              <vs-col class="pr-5" vs-lg="6" vs-sm="6" vs-xs="12">
                <vs-row vs-w="12" vs-type="flex" vs-justify="center">
                  <div class="pr-5" vs-lg="8" vs-sm="8" vs-xs="12">
                    <input type="radio" v-model="status" value="2" id="specific" name="status" />
                    <label for="specific" class="w-full text-center">واگذاری قرارداد</label>
                  </div>
                  <div class="pr-5" vs-lg="4" vs-sm="4" vs-xs="12">
                    <vs-input icon-no-border icon="account_circle" label-placeholder=" برنده قرار داد" v-model="winner" />
                    <!--<vs-input  autocomplete="off" name="winner" class="w-full" />-->
                    <vs-button color="success" size="small" icon="save" type="border" @click.prevent="submitForm" class="mb-2 mt-2 ml-1"> ثبت برنده </vs-button>
                  </div>
                </vs-row>
              </vs-col>
            </div>
          </vs-row>
          <vs-divider></vs-divider>
        </vs-row>
      </tab-content>
    </form-wizard>
  </vs-popup>
  <vs-popup fullscreen title="fullscreen" :active.sync="popupActive">
    <vs-button size="small" type="gradient" icon="print" id="printBTN" @click="printProposal">چاپ</vs-button>
    <vue-easy-print tableShow ref="easyPrint">
      <vs-table :data="proposals">
        <template slot="thead">
          <vs-th>نمبر</vs-th>
          <vs-th>نهاد</vs-th>
          <vs-th>پروژه</vs-th>
          <vs-th>تضمین آفر</vs-th>
          <vs-th>وضعیت</vs-th>
          <vs-th>قیمت</vs-th>
          <vs-th>آدرس</vs-th>
          <vs-th>تاریخ پیشنهاد</vs-th>
        </template>
        <template slot-scope="{data}">
          <tbody>
            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
              <vs-td class="pl-2 text-center">
                {{ indextr + 1 }}
              </vs-td>
              <vs-td>
                <router-link v-if="tr.pro_data" class="font-medium truncate" :to="{
                  path: '/projects/proposal/${tr.id}',
                  name: 'proposal-edit',
                  params: { id: tr.id, dyTitle: tr.title },
                }">
                  <!-- <img :src="tr.img" class="product-img" /> -->
                  <p>{{ findClient(tr.pro_data.client_id) }}</p>

                </router-link>
              </vs-td>
              <vs-td>
                <div v-if="tr.pro_data">
                  <router-link class="font-medium truncate" :to="{
                  path: '/projects/proposal/${tr.id}',
                  name: 'proposal-edit',
                  params: { id: tr.id, dyTitle: tr.title },
                }">
                    {{ tr.pro_data.title }}</router-link>
                </div>
              </vs-td>
              <vs-td>
                <p>{{ tr.offer_guarantee }} افغانی</p>
              </vs-td>
              <vs-td>
                <vs-chip :color="getOrderStatusColor(tr.status)">{{ statusFa[tr.status] }}</vs-chip>
              </vs-td>
              <vs-td>
                <p v-if="tr.pro_data">{{ tr.pro_data.total_price }} افغانی</p>
              </vs-td>
              <vs-td>
                <p>{{ tr.bidding_address }}</p>
              </vs-td>
              <vs-td>
                <p>{{ tr.bidding_date }}</p>
              </vs-td>
            </vs-tr>
          </tbody>
        </template>
      </vs-table>
    </vue-easy-print>
  </vs-popup>
</div>
<!--</vs-tab>
</vs-tabs>-->
</template>

<script>
import TableLoading from './../../shared/TableLoading.vue'
import DataViewSidebar from './../DataViewSidebar.vue'
import moduleDataList from './../data-list/moduleDataList.js'
import Ekmalat from "../../shared/Ekmalat"
import vueEasyPrint from "vue-easy-print";
import {
  FormWizard,
  TabContent
} from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
export default {
  name: 'vx-proposal-list',
  data() {
    return {
      res_person: '',
      winner: '',
      is_recieved: '',
      status: 1,
      isdata: false,
      popupModalActive: false,
      popupActive: false,
      statusFa: {
        normal: 'درجریان',
        delivered: 'تکمیل',
        canceled: 'نا موفق',
        income: 'تاخیر'
      },
      selected: [],
      proposals: [],
      proposal: [],
      itemsPerPage: 4,
      isMounted: false,
      addNewDataSidebar: false,
      sidebarData: {},
      clients: [],
      aForm: new Form({
        item: [{
          item_id: "",
          unit_id: "",
          operation_id: null,
          equivalent: "",
          ammount: "",
          unit_price: "0",
          total_price: "",
          density: null,
        }]
      }),
      dict: {
        custom: {
          sf: {
            required: 'سریال نمبر الزامی میباشد.',
            number: 'سریال نمبر باید نمبر باشد.'
          }
        }
      }
    }
  },
  components: {
    TableLoading,
    DataViewSidebar,
    vueEasyPrint,
    FormWizard,
    TabContent,
    Ekmalat
  },
  created() {
    this.getProposals();
    this.getAllClients();
  },
  computed: {
    currentPage() {
      if (this.isMounted) {
        return this.$refs.table.currentx
      }
      return 1
    },
    queriedItems() {
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.proposals.length
    }
  },
  methods: {
    cprint() {

    },
    formSubmitted() {
      alert("تنظیمات بسته شد")
      this.popupModalActive = false;

    },
    showCheckModal(id) {
      
      this.popupModalActive = true;
      console.log('proposal', this.proposal);
      // this.$Progress.start()
      // this.axios
      //   .get("/api/proposal/" + id)
      //   .then((data) => {
      //     this.proposal = data.data;
      //     console.log("proposal", this.proposal);
      //     this.$Progress.set(100);
      //   })
      //   .catch(() => {});
    },
    showPrintData(id) {
      this.popupActive = true;
    },
    getAllClients() {
      this.axios.get('/api/clients')
        .then((response) => {
          this.clients = response.data;
        })
    },
    findClient(id) {
      let name = '';
      Object.keys(this.clients).some(key => (this.clients[key].id == id) ? name = this.clients[key].name : null);
      return name;
    },
    getProposals() {
      this.$Progress.start()
      this.axios.get('/api/proposal')
        .then((response) => {
          this.proposals = response.data;
          this.isdata = true;
          this.$Progress.set(100)
        })
    },
    // Start Custom
    goTo(data) {
      this.$router.push({
        path: '/projects/project/${data.id}',
        name: 'project-view',
        params: {
          id: data.id,
          dyTitle: data.name
        },
      }).catch(() => {})
    },
    // End Custom
    addNewData() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    deleteData(id) {
      swal.fire({
        title: 'آیا  مطمئن هستید؟',
        text: "پیشنهاد حذف خواهد شد",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله، حذف شود!</span>',
        cancelButtonText: '<span>خیر، لغو عملیه!</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.axios.delete('/api/proposal/' + id).then((id) => {
              swal.fire({
                title: 'عملیه موفقانه انجام شد.',
                text: "پیشنهاد از سیستم پاک شد!",
                icon: 'success',
              })
              this.getProposals();
            })
            .catch(() => {});
        }
      })
    },
    editData(data) {
      // console.log(data);
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      // this.sidebarData = data
      // this.toggleDataSidebar(true)
    },
    getOrderStatusColor(status) {
      if (status === 'normal') return 'warning'
      if (status === 'delivered') return 'success'
      if (status === 'canceled') return 'danger'
      return 'primary'
    },
    getPopularityColor(num) {
      if (num > 90) return 'success'
      if (num > 70) return 'primary'
      if (num >= 50) return 'warning'
      if (num < 50) return 'danger'
      return 'primary'
    },
    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val
    },
    printProposal() {
      // this.$htmlToPaper('proposalTable');
      this.$refs.easyPrint.print()
    },
  },
  mounted() {
    this.isMounted = false
  }
}
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
</style><style>
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

.AFGLabel {
  height: 39px;
  padding: 10px;
  color: white;
  float: left !important;

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
  height: 90px !important;
}

[dir=rtl] .radio-group1 div:first-child label {
  border-bottom-right-radius: 5px;
  border-top-right-radius: 5px;
  height: 90px !important;
}

.radio-group1 div:last-child label {
  overflow: hidden;
  height: 90px !important;
}

[dir=ltr] .radio-group1 div:last-child label {
  border-bottom-right-radius: 5px;
  border-top-right-radius: 5px;
  height: 90px !important;
}

[dir=rtl] .radio-group1 div:last-child label {
  border-bottom-left-radius: 5px;
  border-top-left-radius: 5px;
  height: 90px !important;
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

[dir] .radio-group1 label {
  cursor: pointer;
  padding: 30px 18px;
  border: solid 1px #e85454;
}

.radio-group1 input[type=radio]:checked+label {
  color: white;
}

[dir] .radio-group1 input[type=radio]:checked+label {
  background: #e85454;
  box-shadow: 0 8px 25px -8px #e85454;
  border-color: #e85454;
}
</style>
