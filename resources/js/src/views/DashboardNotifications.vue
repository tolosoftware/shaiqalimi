<template>
<div>
  <vs-tabs>
    <vs-tab :label="$t('Important')">
      <div class="vx-row">
        <!-- TITLE COLOR -->
        <div v-for="item in ImportnatNotif" :key="item.id" class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 mb-base">
          <vx-card :title="item.title" :title-color="item.titleColor" :subtitle="item.subtitle" :time="item.time" :content-color="item.contentColor" :subtitle-color="item.subtitleColor" :card-background="item.cardBackground">
            <span class="item-time-ago cursor-pointer">
              <!--<feather-icon icon="BookmarkIcon" svgClasses="w-5 h-6 text-success" />-->
              <vs-button radius color="primary" size="small" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="close" style="margin-right:7px;" @click="showWarn()"></vs-button>&nbsp;&nbsp;
              <vs-button radius color="#7367F0" size="small" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="bookmark"></vs-button>
              <!--<feather-icon icon="XIcon" color="warning" svgClasses="w-5 h-6 hover:text-danger stroke-current" class="mr-2" /> -->&nbsp;&nbsp;
            </span>
            <p class="mb-3 notification-desc" style=" -webkit-box-orient: vertical; ">{{item.desc}}</p>
            <div slot="footer">
              <vs-row>
                <vs-button color="primary" size="small" icon="arrow_right_alt" class="pull-right">مشاهده</vs-button>
              </vs-row>
            </div>
          </vx-card>
        </div>
        <!-- PAGINATION -->

      </div>
    </vs-tab>
    <vs-tab :label="$t('All')">
      <div class="vx-row">
        <!-- TITLE COLOR -->
        <div v-for="item in allNotif" :key="item.id" class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 mb-base cursor-pointer">
          <vx-card :title="item.title" :title-color="item.titleColor" :content-color="item.contentColor" :card-background="item.cardBackground" :subtitle="item.subtitle" :time="item.time">
            <span class="item-time-ago" :style="'color:' + item.titleColor">
              <!-- <feather-icon icon="CornerRightUpIcon" svgClasses="w-5 h-6 text-success"></feather-icon>&nbsp;&nbsp;
              <vs-button radius color="primary" type="border" icon="search"></vs-button>
              <feather-icon icon="XIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" />--> &nbsp;
              <!--<vs-icon size="2.1rem" icon="playlist_add"></vs-icon>-->
              <vs-button radius color="primary" size="small" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="close" style="margin-right:7px;" @click="showWarn()"></vs-button>&nbsp;&nbsp;
              <vs-button radius color="#7367F0" size="small" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="bookmark"></vs-button>
            </span>
            <p class="mb-3 notification-desc" style=" -webkit-box-orient: vertical; ">{{item.desc}}</p>
            <div slot="footer">
              <vs-row vs-justify="center">
                <!--<vs-button line-position="top" color="primary" line-origin="right" type="line" size="small" icon="info"> برای دیدن جزییات اینجا را کلیک کنید !</vs-button> -->
                <vs-button color="primary" size="small" icon="arrow_right_alt" class="pull-right">مشاهده</vs-button>
              </vs-row>
            </div>
          </vx-card>
        </div>
      </div>
      <!-- PAGINATION -->
      <vs-pagination :total="allNotif.length" :max="7" :value="1" @input="(val) => { val }" />
    </vs-tab>
  </vs-tabs>
  <!--<div class="demo-alignment mb-10">
      <vs-button color="warning" type="filled" icon-pack="feather" icon="icon-star">Important</vs-button>
      <vs-button color="primary" type="border" icon-pack="feather" icon="icon-check">All</vs-button>
    </div>-->
</div>
</template>

<script>
import { AirplayIcon } from 'vue-feather-icons'
export default {
  //   name: 'vx-procurment',
  computed: {
    ImportnatNotif: function () {
      return this.cartItems.filter(i => i.priority == 1)
    },
    allNotif: function () {
      return this.cartItems
    }
  },
  data() {
    return {
      cartItems: [

        {
          id: 23,
          time: 3,
          title: 'فروش 20 کیلوگرام مبلایل',
          titleColor: '#562db8',
          priority: 2,
          subtitle: 'آخرین مهلت ارسال پروپوزال',
          desc: 'دستیار وزیر نفت و عضو هیات مدیره شرکت نفت مناطق مرکزی ایران، گفت: با توجه به نیاز آتی کشور به تثبیت و افزایش تولید گاز و همچنین کاهش فشار تولید از میدانهای گازی شرکت بهره‌برداری نفت و گاز زاگرس جنوبی، این شرکت می‌تواند پایلوت فشار افزایی میادین گازی کشور باشد.',
        },
        {
          id: 24,
          time: 1.3,
          title: 'خریداری یک تانکر تیل',
          titleColor: '#562db8',
          priority: 2,
          subtitle: 'اعلانات پروژه جدید',
          desc: 'برای تغییر رنگ عنوان کارت می توانید استفاده کنید. این پایه از رنگهای و تم پشتیبانی می کند. شکلات دسر باربن شکلات شیرینی پودینگ پای سیب بستنی شکلاتی مافین. من عاشق پنجه خرس هستم',
        },

        {
          id: 11,
          time: 11,
          title: 'دریاف 800 دالر از وزارت دفاع',
          titleColor: '#562db8',
          priority: 1,
          subtitle: 'برداشت از تانک تیل',
          desc: 'برای اولین بار سه نوع ماده ضدخوردگی جدید تزریق منقطع (درون چاهی) و دو نوع ماده ضدخوردگی جدید تزریق پیوسته در چاههای شرکت بهره بردای نفت و گاز شرق مورد استفاده و تأیید نهایی قرار گرفت.',
        },
        {
          id: 12,
          time: 13,
          title: 'قرارداد جدید ثبت شد',
          titleColor: '#562db8',
          priority: 1,
          subtitle: 'قرارداد شرکت روشن',
          desc: 'برای تغییر رنگ عنوان کارت می توانید استفاده کنید. این پایه از رنگهای و تم پشتیبانی می کند. شکلات دسر باربن شکلات شیرینی پودینگ پای سیب بستنی شکلاتی مافین. من عاشق پنجه خرس هستم',
        },
        {
          id: 13,
          time: 13,
          title: 'اعلان شماره 8789 حذف شد',
          titleColor: '#562db8',
          priority: 1,
          subtitle: 'آخرین مهلت ارسال پروپوزال',
          desc: 'دستیار وزیر نفت و عضو هیات مدیره شرکت نفت مناطق مرکزی ایران، گفت: با توجه به نیاز آتی کشور به تثبیت و افزایش تولید گاز و همچنین کاهش فشار تولید از میدانهای گازی شرکت بهره‌برداری نفت و گاز زاگرس جنوبی، این شرکت می‌تواند پایلوت فشار افزایی میادین گازی کشور باشد.',
        },

      ]
    }
  },
  components: {
    AirplayIcon
  },
  methods: {
    showWarn() {
      alert("close button clicked");
    }

  }
}
</script>

<style>
.item-time-ago {
  position: absolute;
  top: -45px;
  color: rgba(var(--vs-primary), 1);
}

[dir] .vs-button.includeIcon {
  float: left;
}
</style>
