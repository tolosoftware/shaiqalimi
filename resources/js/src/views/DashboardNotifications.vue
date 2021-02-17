<template>
<div>
  <vs-tabs>
    <vs-tab :label="$t('Important')">
      <div class="vx-row" :key="importantNotifKey">
        <!-- TITLE COLOR -->
        <div v-for="item in importnatNotif[0]" :key="item.id" class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 mb-base">
          <vx-card :title="item.title" :title-color="item.type" :subtitle="item.subtitle" :time="moment(item.gen_date).fromNow()" :content-color="item.contentColor" :subtitle-color="item.subtitleColor" :card-background="item.cardBackground">
            <span class="item-time-ago cursor-pointer">
              <vs-button radius color="warning" size="small" title="پاک کردن از مهمترین ها" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="close" style="margin-right:7px;" @click="removeFromImportant(item.id)"></vs-button>&nbsp;&nbsp;
              <vs-button v-if="item.user_notification.pin == 0" title="سنجاق به بالا " radius color="#7367F0" size="small" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="bookmark" @click="addToPins(item.id, false)"></vs-button>
              <vs-button v-if="item.user_notification.pin == 1" title="برداشتن از بالا" radius color="success" size="small" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="bookmark" @click="addToPins(item.id, true)"></vs-button>
            </span>
            <p class="mb-3 notification-desc" style=" -webkit-box-orient: vertical; ">{{item.text}}</p>
            <div slot="footer">
              <vs-row>
                <vs-button @click="notifActionCenter(item)" color="primary" size="small" class="pull-right">{{ $t('notif_' + item.notif_number) }}</vs-button>
              </vs-row>
            </div>
          </vx-card>
        </div>
        <div v-for="item in importnatNotif[1]" :key="item.id" class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 mb-base">
          <vx-card :title="item.title" :title-color="item.type" :subtitle="item.subtitle" :time="moment(item.gen_date).fromNow()" :content-color="item.contentColor" :subtitle-color="item.subtitleColor" :card-background="item.cardBackground">
            <span class="item-time-ago cursor-pointer">
              <vs-button radius color="warning" size="small" title="پاک کردن از مهمترین ها" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="close" style="margin-right:7px;" @click="removeFromImportant(item.id)"></vs-button>&nbsp;&nbsp;
              <vs-button v-if="item.user_notification.pin == 0" title="سنجاق به بالا " radius color="#7367F0" size="small" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="bookmark" @click="addToPins(item.id, false)"></vs-button>
              <vs-button v-if="item.user_notification.pin == 1" title="برداشتن از بالا" radius color="success" size="small" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="bookmark" @click="addToPins(item.id, true)"></vs-button>
            </span>
            <p class="mb-3 notification-desc" style=" -webkit-box-orient: vertical; ">{{item.text}}</p>
            <div slot="footer">
              <vs-row>
                <vs-button @click="notifActionCenter(item)" color="primary" size="small" class="pull-right">{{ $t('notif_' + item.notif_number) }}</vs-button>
              </vs-row>
            </div>
          </vx-card>
        </div>

      </div>
    </vs-tab>
    <vs-tab :label="$t('All')">
      <div class="vx-row" :key="standardNotifKey">
        <!-- TITLE COLOR -->
        <div v-for="item in allNotif[0]" :key="item.id" class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 mb-base cursor-pointer">
          <vx-card :title="item.title" :title-color="item.type" :subtitle="item.subtitle" :time="moment(item.gen_date).fromNow()" :content-color="item.contentColor" :subtitle-color="item.subtitleColor" :card-background="item.cardBackground">
            <span class="item-time-ago" :style="'color:' + item.titleColor">
              <vs-button radius color="primary" size="small" title="حذف کامل" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="close" style="margin-right:7px;" @click="removeFromUser(item.id)"></vs-button>&nbsp;&nbsp;
              <vs-button v-if="item.user_notification.pin == 0" title="سنجاق به بالا " radius color="#7367F0" size="small" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="bookmark" @click="addToPins(item.id, false)"></vs-button>
              <vs-button v-if="item.user_notification.pin == 1" title="برداشتن از بالا" radius color="success" size="small" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="bookmark" @click="addToPins(item.id, true)"></vs-button>
            </span>
            <p class="mb-3 notification-desc" style=" -webkit-box-orient: vertical; ">{{item.text}}</p>
            <div slot="footer">
              <vs-row>
                <vs-button @click="notifActionCenter(item)" color="primary" size="small" class="pull-right">{{ $t('notif_' + item.notif_number) }}</vs-button>
              </vs-row>
            </div>
          </vx-card>
        </div>
        <div v-for="item in allNotif[1]" :key="item.id" class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 mb-base cursor-pointer">
          <vx-card :title="item.title" :title-color="item.type" :subtitle="item.subtitle" :time="moment(item.gen_date).fromNow()" :content-color="item.contentColor" :subtitle-color="item.subtitleColor" :card-background="item.cardBackground">
            <span class="item-time-ago" :style="'color:' + item.titleColor">
              <vs-button radius color="primary" size="small" title="حذف کامل" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="close" style="margin-right:7px;" @click="removeFromUser(item.id)"></vs-button>&nbsp;&nbsp;
              <vs-button v-if="item.user_notification.pin == 0" title="سنجاق به بالا " radius color="#7367F0" size="small" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="bookmark" @click="addToPins(item.id, false)"></vs-button>
              <vs-button v-if="item.user_notification.pin == 1" title="برداشتن از بالا" radius color="success" size="small" svgClasses="w-2 h-3 hover:text-danger" type="border" icon="bookmark" @click="addToPins(item.id, true)"></vs-button>
            </span>
            <p class="mb-3 notification-desc" style=" -webkit-box-orient: vertical; ">{{item.text}}</p>
            <div slot="footer">
              <vs-row>
                <!--<vs-button line-position="top" color="primary" line-origin="right" type="line" size="small" icon="info"> برای دیدن جزییات اینجا را کلیک کنید !</vs-button> -->
                <vs-button @click="notifActionCenter(item)" color="primary" size="small" class="pull-right">{{ $t('notif_' + item.notif_number) }}</vs-button>
              </vs-row>
            </div>
          </vx-card>
        </div>
      </div>
      <!-- PAGINATION -->
      <!-- <vs-pagination :total="allNotif.length" :max="5" :value="1" @input="(val) => { val }" /> -->
    </vs-tab>
  </vs-tabs>
  <vs-popup class="holamundo" :title="vsPopupTitle" :active.sync="popupStepActive">
    <vs-button @click="closeModel" ref="wizardModalProcur" color="primary" size="small" class="pull-right">Close</vs-button>
  </vs-popup>

</div>
</template>

<script>
import {
  AirplayIcon
} from 'vue-feather-icons'
export default {
  //   name: 'vx-procurment',
  data() {
    return {
      popupStepActive: false,
      vsPopupTitle: '',
      importnatNotif: [],
      allNotif: [],
      cartItems: [],
      removeFromI: false,
      importantNotifKey: 0,
      standardNotifKey: 0,
    }
  },
  components: {
    AirplayIcon
  },
  created() {
    this.$vs.loading();
    this.getAllNotification();
    setTimeout(() => {
      this.$vs.loading.close()
    }, 2500);
  },
  methods: {
    closeModel() {
      this.popupStepActive = false;
    },
    addToPins(id, unpin = false) {
      this.axios.post('/api/notif/pin', {
          notif_id: id,
          unpin: unpin
        })
        .then((response) => {
          this.getAllNotification();
        })
    },
    getAllNotification() {
      this.axios.get('/api/notification')
        .then((response) => {
          this.cartItems = response.data;
          this.allNotif[0] = Object.values(this.cartItems).filter(i => (i.user_notification) ? i.user_notification.pin != 0 : false)
          this.allNotif[1] = Object.values(this.cartItems).filter(i => (i.user_notification) ? i.user_notification.pin != 1 : false)
          this.importnatNotif[0] = Object.values(this.allNotif[0]).filter(i => (i.user_notification) ? i.user_notification.status != 'not_im' : false)
          this.importnatNotif[1] = Object.values(this.allNotif[1]).filter(i => (i.user_notification) ? i.user_notification.status != 'not_im' : false)
          this.importantNotifKey += 1;
          this.standardNotifKey += 1;
        })
    },
    removeFromImportant(id) {
      swal.fire({
        title: 'مطمیٔن هستید ؟',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله !</span>',
        cancelButtonText: '<span>خیر !</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.$Progress.start()
          this.axios.post('/api/notif/no-important', {
              notif_id: id
            })
            .then(({
              data
            }) => {
              this.getAllNotification();
              this.$Progress.set(100)
              this.$vs.notify({
                title: 'موفقیت!',
                text: 'اعلامیه مذکور به لست عمومی انتقال نمود!.',
                color: 'success',
                iconPack: 'feather',
                icon: 'icon-check',
                position: 'top-right'
              })
            }).catch((errors) => {
              this.$vs.notify({
                title: 'ناموفق!',
                text: 'لطفاً معلومات را چک کنید و دوباره امتحان کنید!',
                color: 'danger',
                iconPack: 'feather',
                icon: 'icon-cross',
                position: 'top-right'
              })
            });
        }
      })
    },
    removeFromUser(id) {
      swal.fire({
        title: 'مطمیٔن هستید ؟',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(54 34 119)',
        cancelButtonColor: 'rgb(229 83 85)',
        confirmButtonText: '<span>بله !</span>',
        cancelButtonText: '<span>خیر !</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          this.$Progress.start()
          this.axios.post('/api/notif/remove-notif-user', {
              notif_id: id
            })
            .then(({
              data
            }) => {
              this.getAllNotification();
              this.$Progress.set(100)
              this.$vs.notify({
                title: 'موفقیت!',
                text: 'اعلامیه مذکور از لیست شما حذف شد!.',
                color: 'success',
                iconPack: 'feather',
                icon: 'icon-check',
                position: 'top-right'
              })
            }).catch((errors) => {
              this.$vs.notify({
                title: 'ناموفق!',
                text: 'لطفاً معلومات را چک کنید و دوباره امتحان کنید!',
                color: 'danger',
                iconPack: 'feather',
                icon: 'icon-cross',
                position: 'top-right'
              })
            });
        }
      })
    },
    notifActionCenter(item) {
      if (item.action == 'btn-link') {
        this.$router.push(item.url).catch(() => {})
      } else if (item.action == 'btn-modal') {
        this.vsPopupTitle = item.title;
        this.popupStepActive = true;
      }
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
