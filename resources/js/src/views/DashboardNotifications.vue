<template>
  <div>
    <vs-tabs>
        <vs-tab :label="$t('Important')">
          <div class="vx-row">
            <!-- TITLE COLOR -->    
            <div
              v-for="item in ImportnatNotif"
              :key="item.id"
              class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 mb-base cursor-pointer">
                <vx-card
                    :title="item.title"
                    :title-color="item.titleColor"
                    :subtitle="item.subtitle"
                    :time="item.time"
                    :content-color="item.contentColor"
                    :subtitle-color="item.subtitleColor"
                    :card-background="item.cardBackground"
                  >
                    <span class="item-time-ago" :style="'color:' + item.titleColor">{{item.time}} روز قبل</span>
                    <p class="mb-3 notification-desc" style=" -webkit-box-orient: vertical; ">{{item.desc}}</p>
                </vx-card>
            </div>
          <!-- PAGINATION -->
          <vs-pagination
            :total="ImportnatNotif.length"
            :max="7"
            :value="1"
            @input="(val) => { val }" />

          </div>
        </vs-tab>
        <vs-tab :label="$t('All')">
          <div class="vx-row">
            <!-- TITLE COLOR -->    
            <div
              v-for="item in allNotif"
              :key="item.id"
              class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 mb-base cursor-pointer">
                <vx-card
                    :title="item.title"
                    :title-color="item.titleColor"
                    :content-color="item.contentColor"
                    :card-background="item.cardBackground"
                    :subtitle="item.subtitle"
                    :subtitle-color="item.subtitleColor"
                    >
                    <span class="item-time-ago" :style="'color:' + item.titleColor">{{item.time}} روز قبل</span>
                    <p class="mb-3 notification-desc" style=" -webkit-box-orient: vertical; ">{{item.desc}}</p>
                </vx-card>
            </div>
          </div>
          <!-- PAGINATION -->
          <vs-pagination
            :total="allNotif.length"
            :max="7"
            :value="1"
            @input="(val) => { val }" />
        </vs-tab>

      </vs-tabs>

    <!-- <div class="demo-alignment mb-10">
      <vs-button color="warning" type="filled" icon-pack="feather" icon="icon-star">Important</vs-button>
      <vs-button color="primary" type="border" icon-pack="feather" icon="icon-check">All</vs-button>
    </div> -->

  </div>
</template>
<script>
export default{
//   name: 'vx-procurment',
  computed: {
    ImportnatNotif: function () {
      return this.cartItems.filter(i => i.priority == 1)
    },
    allNotif: function () {
      return this.cartItems
    }
  },
  data () {
    return {
      cartItems : [
        {
          id: 21,
          time: 21,
          title: 'یادآوری ۱',
          titleColor: '#562db8',
          priority: 1,
          subtitle: 'برداشت از تانک تیل',
          desc: 'برایابنشتساینباسشینمتبانشستیابنتاشسینتباشسنیبانت اولین بار سه نوع ماده ضدخوردگی جدید تزریق منقطع (درون چاهی) و دو نوع ماده ضدخوردگی جدید تزریق پیوسته در چاههای شرکت بهره بردای نفت و گاز شرق مورد استفاده و تأیید نهایی قرار گرفت.',
        },
        {
          id: 22,
          time: 22,
          title: 'یادآوری ۲',
          titleColor: '#562db8',
          priority: 2,
          subtitle: 'قرارداد شرکت روشن',
          desc: 'برای تغییر رنگ عنوان کارت می توانید استفاده کنید. این پایه از رنگهای و تم پشتیبانی می کند. شکلات دسر باربن شکلات شیرینی پودینگ پای سیب بستنی شکلاتی مافین. من عاشق پنجه خرس هستم',
        },

        {
          id: 23,
          time: 23,
          title: 'یادآوری ۳',
          titleColor: '#562db8',
          priority: 2,
          subtitle: 'آخرین مهلت ارسال پروپوزال',
          desc: 'دستیار وزیر نفت و عضو هیات مدیره شرکت نفت مناطق مرکزی ایران، گفت: با توجه به نیاز آتی کشور به تثبیت و افزایش تولید گاز و همچنین کاهش فشار تولید از میدانهای گازی شرکت بهره‌برداری نفت و گاز زاگرس جنوبی، این شرکت می‌تواند پایلوت فشار افزایی میادین گازی کشور باشد.',
        },
        {
          id: 24,
          time: 24,
          title: 'یادآوری ۴',
          titleColor: '#562db8',
          priority: 2,
          subtitle: 'اعلانات پروژه جدید',
          desc: 'برای تغییر رنگ عنوان کارت می توانید استفاده کنید. این پایه از رنگهای و تم پشتیبانی می کند. شکلات دسر باربن شکلات شیرینی پودینگ پای سیب بستنی شکلاتی مافین. من عاشق پنجه خرس هستم',
        },
        {
          id: 211,
          time: 211,
          title: 'یادآوری ۱',
          titleColor: '#562db8',
          priority: 1,
          subtitle: 'برداشت از تانک تیل',
          desc: 'برای اولین بار سه نوع ماده ضدخوردگی جدید تزریق منقطع (درون چاهی) و دو نوع ماده ضدخوردگی جدید تزریق پیوسته در چاههای شرکت بهره بردای نفت و گاز شرق مورد استفاده و تأیید نهایی قرار گرفت.',
        },
        {
          id: 212,
          time: 212,
          title: 'یادآوری ۲',
          titleColor: '#562db8',
          priority: 1,
          subtitle: 'قرارداد شرکت روشن',
          desc: 'برای تغییر رنگ عنوان کارت می توانید استفاده کنید. این پایه از رنگهای و تم پشتیبانی می کند. شکلات دسر باربن شکلات شیرینی پودینگ پای سیب بستنی شکلاتی مافین. من عاشق پنجه خرس هستم',
        },
        {
          id: 213,
          time: 213,
          title: 'یادآوری ۳',
          titleColor: '#562db8',
          priority: 1,
          subtitle: 'آخرین مهلت ارسال پروپوزال',
          desc: 'دستیار وزیر نفت و عضو هیات مدیره شرکت نفت مناطق مرکزی ایران، گفت: با توجه به نیاز آتی کشور به تثبیت و افزایش تولید گاز و همچنین کاهش فشار تولید از میدانهای گازی شرکت بهره‌برداری نفت و گاز زاگرس جنوبی، این شرکت می‌تواند پایلوت فشار افزایی میادین گازی کشور باشد.',
        },
        {
          id: 214,
          time: 214,
          title: 'یادآوری ۴',
          titleColor: '#562db8',
          priority: 1,
          subtitle: 'اعلانات پروژه جدید',
          desc: 'برای تغییر رنگ عنوان کارت می توانید استفاده کنید. این پایه از رنگهای و تم پشتیبانی می کند. شکلات دسر باربن شکلات شیرینی پودینگ پای سیب بستنی شکلاتی مافین. من عاشق پنجه خرس هستم',
        },
        {
          id: 1,
          time: 1,
          title: 'یادآوری ۱',
          titleColor: '#562db8',
          priority: 1,
          subtitle: 'برداشت از تانک تیل',
          desc: 'برای اولین بار سه نوع ماده ضدخوردگی جدید تزریق منقطع (درون چاهی) و دو نوع ماده ضدخوردگی جدید تزریق پیوسته در چاههای شرکت بهره بردای نفت و گاز شرق مورد استفاده و تأیید نهایی قرار گرفت.',
        },
        {
          id: 2,
          time: 2,
          title: 'یادآوری ۲',
          titleColor: '#562db8',
          priority: 2,
          subtitle: 'قرارداد شرکت روشن',
          desc: 'برای تغییر رنگ عنوان کارت می توانید استفاده کنید. این پایه از رنگهای و تم پشتیبانی می کند. شکلات دسر باربن شکلات شیرینی پودینگ پای سیب بستنی شکلاتی مافین. من عاشق پنجه خرس هستم',
        },

        {
          id: 3,
          time: 3,
          title: 'یادآوری ۳',
          titleColor: '#562db8',
          priority: 2,
          subtitle: 'آخرین مهلت ارسال پروپوزال',
          desc: 'دستیار وزیر نفت و عضو هیات مدیره شرکت نفت مناطق مرکزی ایران، گفت: با توجه به نیاز آتی کشور به تثبیت و افزایش تولید گاز و همچنین کاهش فشار تولید از میدانهای گازی شرکت بهره‌برداری نفت و گاز زاگرس جنوبی، این شرکت می‌تواند پایلوت فشار افزایی میادین گازی کشور باشد.',
        },
        {
          id: 4,
          time: 4,
          title: 'یادآوری ۴',
          titleColor:"#fff",
          contentColor:"#fff",
          subtitleColor: "#fff",
          cardBackground:"linear-gradient(to right, #56ab2f, #a8e063)",
          priority: 2,
          subtitle: 'اعلانات پروژه جدید',
          desc: 'برای تغییر رنگ عنوان کارت می توانید استفاده کنید. این پایه از رنگهای و تم پشتیبانی می کند. شکلات دسر باربن شکلات شیرینی پودینگ پای سیب بستنی شکلاتی مافین. من عاشق پنجه خرس هستم',
        },
        {
          id: 11,
          time: 11,
          title: 'یادآوری ۱',
          titleColor: '#562db8',
          priority: 1,
          subtitle: 'برداشت از تانک تیل',
          desc: 'برای اولین بار سه نوع ماده ضدخوردگی جدید تزریق منقطع (درون چاهی) و دو نوع ماده ضدخوردگی جدید تزریق پیوسته در چاههای شرکت بهره بردای نفت و گاز شرق مورد استفاده و تأیید نهایی قرار گرفت.',
        },
        {
          id: 12,
          time: 12,
          title: 'یادآوری ۲',
          titleColor: '#562db8',
          priority: 1,
          subtitle: 'قرارداد شرکت روشن',
          desc: 'برای تغییر رنگ عنوان کارت می توانید استفاده کنید. این پایه از رنگهای و تم پشتیبانی می کند. شکلات دسر باربن شکلات شیرینی پودینگ پای سیب بستنی شکلاتی مافین. من عاشق پنجه خرس هستم',
        },
        {
          id: 13,
          time: 13,
          title: 'یادآوری ۳',
          titleColor: '#562db8',
          priority: 1,
          subtitle: 'آخرین مهلت ارسال پروپوزال',
          desc: 'دستیار وزیر نفت و عضو هیات مدیره شرکت نفت مناطق مرکزی ایران، گفت: با توجه به نیاز آتی کشور به تثبیت و افزایش تولید گاز و همچنین کاهش فشار تولید از میدانهای گازی شرکت بهره‌برداری نفت و گاز زاگرس جنوبی، این شرکت می‌تواند پایلوت فشار افزایی میادین گازی کشور باشد.',
        },
        {
          id: 14,
          time: 14,
          title: 'یادآوری ۴',
          titleColor:"#fff",
          contentColor:"#fff",
          subtitleColor: "#fff",
          cardBackground:"linear-gradient(to right, #56ab2f, #a8e063)",
          priority: 1,
          subtitle: 'اعلانات پروژه جدید',
          desc: 'برای تغییر رنگ عنوان کارت می توانید استفاده کنید. این پایه از رنگهای و تم پشتیبانی می کند. شکلات دسر باربن شکلات شیرینی پودینگ پای سیب بستنی شکلاتی مافین. من عاشق پنجه خرس هستم',
        },
      ]
    }
  }
}
</script>