<!-- =========================================================================================
  File Name: AddNewDataSidebar.vue
  Description: Add New Data - Sidebar component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <vs-sidebar
    click-not-close
    position-right
    parent="body"
    default-index="1"
    color="primary"
    class="add-new-data-sidebar items-no-padding"
    spacer
    v-model="isSidebarActiveLocal"
  >
    <div class="mt-6 flex items-center justify-between px-6">
      <h4>حساب جدید اضافه کنید</h4>
      <feather-icon
        icon="XIcon"
        @click.stop="isSidebarActiveLocal = false"
        class="cursor-pointer"
      ></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>

    <component
      :is="scrollbarTag"
      class="scroll-area--data-list-add-new"
      :settings="settings"
      :key="$vs.rtl"
    >
      <div class="pt-6 pr-6 pl-6">
        <!-- NAME -->
        <vs-input
          label=" عنوان"
          class="mt-5 w-full"
          name="item-name"
          v-validate="'required'"
        />
        <!-- <span class="text-danger text-sm" v-show="errors.has('item-name')">{{ errors.first('item-name') }}</span> -->

        <!-- CATEGORY -->

        <!-- NAME -->
        <vs-input
          label="ریفرینس کد"
          type="number"
          class="mt-5 w-full"
          name="item-name"
        />

        <!-- CATEGORY -->

        <!-- NAME -->
        <div class="vx-col mt-4">
          <label for=""><small>نوعیت</small></label>
          <v-select
            label="text"
            :options="itemType"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
          />
        </div>

        <!-- CATEGORY -->

        <div class="vx-col w-1/3 mt-5">
          <label for="" class="ml-4 mr-4 mb-2"> حالت</label>
          <ul class="leftx">
            <li style="position: absolute">
              <vs-radio vs-name="radios1" vs-value="luis" class="ml-4 mr-4"
                ><small>فعال</small>
              </vs-radio>
              <vs-radio vs-name="radios1" vs-value="carols" class="ml-4 mr-4"
                ><small>غیر فعال</small></vs-radio
              >
            </li>
          </ul>
        </div>

        <!-- NAME -->
        <div class="vx-row mt-4">
          <div class="vx-col w-1/2 pt-4">
            <!-- TITLE -->
            <label for=""> <small> کردیت</small></label>
            <vx-input-group class="mb-base">
              <template slot="prepend">
                <div class="prepend-text bg-primary">
                  <span>َAFN</span>
                </div>
              </template>

              <vs-input type="number" />
            </vx-input-group>
            <!-- /TITLE -->
          </div>

          <div class="vx-col w-1/2 pt-4">
            <!-- TITLE -->
            <label for=""> <small> دبت</small></label>
            <vx-input-group class="mb-base">
              <template slot="prepend">
                <div class="prepend-text bg-primary">
                  <span>AFN</span>
                </div>
              </template>

              <vs-input type="number" />
            </vx-input-group>
            <!-- /TITLE -->
          </div>
        </div>

        <vs-textarea placeholder="تفصیلات" />
      </div>
    </component>

    <div class="flex flex-wrap items-center p-6" slot="footer">
      <vs-button class="mr-6" @click="submitData">انجام</vs-button>
      <vs-button
        type="border"
        color="danger"
        @click="isSidebarActiveLocal = false"
        >لغو</vs-button
      >
    </div>
  </vs-sidebar>
</template>

<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import vSelect from "vue-select";
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
    VuePerfectScrollbar,
    "v-select": vSelect,
  },
  data() {
    return {
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

      settings: {
        // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: 0.6,
      },
    };
  },
  watch: {},
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
  methods: {
    submitData() {},
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
  height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);

  &:not(.ps) {
    overflow-y: auto;
  }
}
</style>
