<template>
<vs-sidebar position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
  <div class="mt-6 flex items-center justify-between px-6">
    <h4>جنس جدید را وارید کنید</h4>
    <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
  </div>
  <vs-divider class="mb-0"></vs-divider>

  <component :is="scrollbarTag" class="scroll-area--data-list-add-new" :key="$vs.rtl">
    <div class="pt-6 pr-6 pl-6">
      <form data-vv-scope="goodsAddForm">
        <!-- CATEGORY -->
        <div class="vx-col mt-4">
          <label for=""><small>کتگوری</small></label>
          <v-select label="type" name="good_type" v-validate="'required'" :options="itemtype" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="form.type_id" />
        </div>
        <!-- CATEGORY -->

        <!-- NAME -->
        <vs-input label=" نوعیت" class="mt-5 w-full" name="good_name" v-validate="'required'" v-model="form.name" />
        <!-- <span class="text-danger text-sm" v-show="errors.has('item-name')">{{ errors.first('item-name') }}</span> -->
        <!-- NAME -->
        <div class="vx-col mt-4">
          <label for=""><small>واحد سنجش اصلی</small></label>
          <v-select label="title" name="good_uom" v-validate="'required'" :options="uom" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="form.uom_id" />
        </div>
        <!-- CATEGORY -->

        <!-- NAME -->
        <div class="vx-col mt-4">
          <label for=""><small>واحد سنجش فرعی</small></label>
          <v-select label="title" name="good_uom_equiv" v-validate="'required'" :options="uom" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="form.uom_equiv_id" />
        </div>
        <!-- NAME -->
        <!-- NAME -->
        <vs-input label="مقدار معادل به واحد فرعی" class="mt-5 w-full" name="good_equivalent" v-validate="'required'" v-model="form.equivalent" />
        <!-- <span class="text-danger text-sm" v-show="errors.has('item-name')">{{ errors.first('item-name') }}</span> -->
        <!-- NAME -->
        <div class="vx-col mt-4"></div>
        <vs-textarea label="تفصیلات" v-model="form.description" />
        <div class="flex flex-wrap items-center p-6" slot="footer">
          <vs-button :disabled="form.busy" class="mr-6" @click="submitData">ثبت</vs-button>
          <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">لغو</vs-button>
          <vs-list v-if="(errors.items.length > 0)">
            <vs-list-header color="danger" title="مشکلات"></vs-list-header>
            <div :key="indextr" v-for="(error, indextr) in errors.items">
              <vs-list-item icon="verified_user" style="color:red;" :subtitle="error.msg"></vs-list-item>
            </div>
            <!--<vs-list-item title="" subtitle=""></vs-list-item> -->
          </vs-list>
        </div>
      </form>
    </div>
  </component>
</vs-sidebar>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import vSelect from "vue-select";
import {
  Validator
} from 'vee-validate'
export default {
  props: {
    isSidebarActive: {
      type: Boolean,
      required: true,
    },
    data: {
      type: Object,
      default: () => {},
    },
  },
  components: {
    "v-select": vSelect,
    VuePerfectScrollbar,
    Validator
  },
  data() {
    return {
      uom: [],
      itemtype: [],

      form: new Form({
        id: '',
        type_id: '',
        name: '',
        uom_id: '',
        uom_equiv_id: '',
        equivalent: '0',
        description: '',
      }),
      settings: {
        maxScrollbarLength: 60,
        wheelSpeed: 0.6,
      },
      dict: {
        custom: {
          good_type: { required: ' کتگوری جنس الزامی میباشد' },
          good_name: { required: ' نوعیت جنس الزامی میباشد' },
          good_uom: { required: ' واحد سنجش اصلی جنس الزامی میباشد' },
          good_uom_equiv: { required: ' واحد سنجش  فرعی جنس الزامی میباشد' },
          good_equivalent: { required: ' مقدار معادل به واحد فرعی جنس الزامی میباشد' },
        }
      }
    };
  },
  created() {
    Validator.localize('en', this.dict);
    this.loaduom();
    this.getAllItemtype();

  },

  methods: {
    submitData() {
      this.$validator.validateAll('goodsAddForm').then(result => {
        if (result) {
          this.form.post('/api/item')
            .then(() => {
              this.$parent.$emit('updateselection', 'test');
              this.$vs.notify({
                title: '  محصول اضافه شد',
                text: 'عملیه موفقانه انجام شد',
                color: 'success',
                iconPack: 'feather',
                icon: 'icon-check',
                position: 'top-right'
              })
              this.form.reset();
              this.$validator.reset();

            }).catch(() => {
              this.$vs.notify({
                title: 'عملیه ناکام شد',
                text: 'عملیه حذف جنس انجام نشد',
                color: 'danger',
                iconPack: 'feather',
                icon: 'icon-check',
                position: 'top-right'
              })
            })
        } else {
          
          // form have errors
        }
      })

    },

    loaduom() {
      this.axios.get('/api/uom')
        .then((response) => {
          this.uom = response.data;

        })
    },

    getAllItemtype() {
      this.axios.get('/api/itemtype')
        .then((response) => {
          this.itemtype = response.data;
        })
    },
  },

  computed: {
    isSidebarActiveLocal: {
      get() {
        return this.isSidebarActive;
      },
      set(val) {
        if (!val) {
          this.$emit("closeSidebar");
        }
      },
    },

    scrollbarTag() {
      return this.$store.getters.scrollbarTag;
    },
  },
};
</script>

<style lang="scss" scoped>
.add-new-data-sidebar {
  ::v-deep .vs-sidebar--background {
    z-index: 52010;
  }

  ::v-deep .vs-sidebar {
    z-index: 52010;
    width: 400px;
    max-width: 90vw;

    .img-upload {
      margin-top: 2rem;

      .con-img-upload {
        padding: 0;
      }

      .con-input-upload {
        width: 100%;
        margin: 0;
      }
    }
  }
}

.scroll-area--data-list-add-new {
  // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
  height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 2px);

  &:not(.ps) {
    overflow-y: auto;
  }
}
</style>
