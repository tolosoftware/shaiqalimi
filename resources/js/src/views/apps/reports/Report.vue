<template>
<vx-card>
  <div class="mt-base mb-base flex justify-between">
    <div class="vx-col w-1/2">
      <h1>راپورها</h1>
    </div>
    <div class="vx-col w-1/2">
      <div class="sm:w-1 md:w-1/2 lg:w-1/4 float-right xl:w-1/4">
        <div class="radio-group w-full">
          <div class="w-1/2">
            <input type="radio" v-model="curr_display" @change="mcurr_display = curr_display" value='afn' id="report_list_afn" name="curr_display" />
            <label for="report_list_afn" class="w-full text-center">افغانی</label>
          </div>
          <div class="w-1/2">
            <input type="radio" v-model="curr_display" @change="mcurr_display = curr_display" value='usd' id="report_list_usd" name="curr_display" />
            <label for="report_list_usd" class="w-full text-center">دالر</label>
          </div>
        </div>
      </div>
    </div>

  </div>
  <vs-divider />
  <div class="vx-row mt-base">
    <div class="vx-col w-full md:w-1/4 mb-base">
      <vx-card>
        <div class="mt-base mb-base flex justify-between">
          <div>
            <strong>مشتریان جدید</strong>
            <p>ماه جدی: ۱۲</p>
          </div>
          <feather-icon icon="UsersIcon" svgClasses="w-12 h-12 text-darkgrey"></feather-icon>
        </div>
      </vx-card>
    </div>
    <div class="vx-col w-full md:w-1/4 mb-base">
      <vx-card>
        <div class="mt-base mb-base flex justify-between">
          <div>
            <strong>فروشات</strong>
            <p>ماه جدی: ۱۲</p>
          </div>
          <feather-icon icon="ShoppingBagIcon" svgClasses="w-12 h-12 text-darkgrey"></feather-icon>
        </div>
      </vx-card>
    </div>
    <div class="vx-col w-full md:w-1/4 mb-base">
      <vx-card title-color="#fff" content-color="#fff" card-background="linear-gradient(120deg ,rgba(247,97,161,0.5), rgba(140,27,171,.8))">
        <div class="mt-base mb-base flex justify-between">
          <div>
            <strong>عایدات</strong>
            <p>ماه جدی: ۱۲</p>
          </div>
          <feather-icon icon="DownloadIcon" svgClasses="w-12 h-12 text-white"></feather-icon>
        </div>
      </vx-card>
    </div>
    <div class="vx-col w-full md:w-1/4 mb-base">
      <vx-card title-color="#fff" content-color="#fff" card-background="linear-gradient(to right, #56ab2f, #a8e063)">
        <div class="mt-base mb-base flex justify-between">
          <div>
            <strong>مصارف</strong>
            <p>ماه جدی: ۱۲</p>
          </div>
          <feather-icon icon="UploadIcon" svgClasses="w-12 h-12 text-white"></feather-icon>
        </div>
      </vx-card>
    </div>
  </div>
  <vs-divider />
  <!-- Report generate section -->
  <div class="vx-row mt-base">
    <div class="vx-col w-full md:w-1/3 mb-base hover-move-up cursor-pointer" @click="popupReport = true">
      <vx-card>
        <div class="mt-base mb-base flex">
          <feather-icon icon="DownloadIcon" svgClasses="w-12 h-12 text-darkgrey"></feather-icon>
          <strong class="text-3xl ml-2 pt-2">عایدات</strong>
        </div>
        <div class="mb-base">
          <p>ماه جدی: ۱۲</p>
          <p>سال جاری: ۱۲</p>
        </div>
      </vx-card>
    </div>
    <div class="vx-col w-full md:w-1/3 mb-base hover-move-up cursor-pointer" @click="popupReport = true">
      <vx-card>
        <div class="mt-base mb-base flex">
          <feather-icon icon="UploadIcon" svgClasses="w-12 h-12 text-darkgrey"></feather-icon>
          <strong class="text-3xl ml-2 pt-2">مصارف</strong>
        </div>
        <div class="mb-base">
          <p>ماه جدی: ۱۲</p>
          <p>سال جاری: ۱۲</p>
        </div>
      </vx-card>
    </div>
    <div class="vx-col w-full md:w-1/3 mb-base hover-move-up cursor-pointer" @click="popupReport = true">
      <vx-card>
        <div class="mt-base mb-base flex">
          <feather-icon icon="ShoppingCartIcon" svgClasses="w-12 h-12 text-darkgrey"></feather-icon>
          <strong class="text-3xl ml-2 pt-2">فروشات</strong>
        </div>
        <div class="mb-base">
          <p>ماه جدی: ۱۲</p>
          <p>سال جاری: ۱۲</p>
        </div>
      </vx-card>
    </div>
    <div class="vx-col w-full md:w-1/3 mb-base hover-move-up cursor-pointer" @click="popupReport = true">
      <vx-card>
        <div class="mt-base mb-base flex">
          <feather-icon icon="CompassIcon" svgClasses="w-12 h-12 text-darkgrey"></feather-icon>
          <strong class="text-3xl ml-2 pt-2">ترازنامه</strong>
        </div>
        <div class="mb-base">
          <p>ماه جدی: ۱۲</p>
          <p>سال جاری: ۱۲</p>
        </div>
      </vx-card>
    </div>
    <div class="vx-col w-full md:w-1/3 mb-base hover-move-up cursor-pointer" @click="popupReport = true">
      <vx-card>
        <div class="mt-base mb-base flex">
          <feather-icon icon="UsersIcon" svgClasses="w-12 h-12 text-darkgrey"></feather-icon>
          <strong class="text-3xl ml-2 pt-2">حسابات</strong>
        </div>
        <div class="mb-base">
          <p>ماه جدی: ۱۲</p>
          <p>سال جاری: ۱۲</p>
        </div>
      </vx-card>
    </div>
    <div class="vx-col w-full md:w-1/3 mb-base hover-move-up cursor-pointer" @click="popupReport = true">
      <vx-card>
        <div class="mt-base mb-base flex">
          <feather-icon icon="FileTextIcon" svgClasses="w-12 h-12 text-darkgrey"></feather-icon>
          <strong class="text-3xl ml-2 pt-2">صورت حساب</strong>
        </div>
        <div class="mb-base">
          <p>ماه جدی: ۱۲</p>
          <p>سال جاری: ۱۲</p>
        </div>
      </vx-card>
    </div>
  </div>

  <!-- Modal -->
  <vs-popup class="holamundo" :title="vsPopupTitle" :active.sync="popupReport">
    <div class="vx-row m-3">
      <div class="sm:w-1 md:w-1/2 lg:w-1/4 float-right xl:w-1/4">
        <div class="radio-group w-full">
          <div class="w-1/2">
            <input type="radio" v-model="mcurr_display" @change="curr_display = mcurr_display" value='afn' id="mreport_list_afn" name="mcurr_display" />
            <label for="mreport_list_afn" class="w-full text-center">افغانی</label>
          </div>
          <div class="w-1/2">
            <input type="radio" v-model="mcurr_display" @change="curr_display = mcurr_display" value='usd' id="mreport_list_usd" name="mcurr_display" />
            <label for="mreport_list_usd" class="w-full text-center">دالر</label>
          </div>
        </div>
      </div>
    </div>
    <div class="vx-row mb-2">
      <div class="vx-col w-full">
        <vs-input class="w-full" icon-pack="feather" icon="icon-user" icon-no-border label-placeholder="تاریخ شروع" v-model="input21" />
      </div>
    </div>
    <div class="vx-row mb-2">
      <div class="vx-col w-full">
        <vs-input type="email" class="w-full" icon-pack="feather" icon="icon-mail" icon-no-border label-placeholder="تاریخ ختم" v-model="input22" />
      </div>
    </div>
    <div class="vx-row mb-2">
      <div class="vx-col w-full">
        <vs-input class="w-full" icon-pack="feather" icon="icon-smartphone" icon-no-border label-placeholder="سال" v-model="input23" />
      </div>
    </div>
    <div class="vx-row mb-6">
      <div class="vx-col w-full">
        <vs-input type="password" class="w-full" icon-pack="feather" icon="icon-lock" icon-no-border label-placeholder="نوعیت" v-model="input24" />
      </div>
    </div>
    <div class="vx-row">
      <div class="vx-col w-full">
        <vs-button class="mr-3 mb-2">بررسی</vs-button>
        <vs-button color="warning" type="border" class="mb-2" @click="popupReport = false;">انصراف</vs-button>
      </div>
    </div>
  </vs-popup>

</vx-card>
</template>

<script>
export default {
  name: 'vx-report',
  data() {
    return {
      curr_display: 'afn',
      mcurr_display: 'afn',
      popupReport: false,
      vsPopupTitle: 'انتخاب تاریخ راپور',
    }
  },
  created() {
  },
  methods: {
    closeModel() {
      this.popupReport = false;
    },
  }
}
</script>
