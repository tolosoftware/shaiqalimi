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
      <h4>جنس جدید را وارید کنید</h4>
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
          label=" نوعیت"
          class="mt-5 w-full"
          name="item-name"
          v-validate="'required'"
        />
        <!-- <span class="text-danger text-sm" v-show="errors.has('item-name')">{{ errors.first('item-name') }}</span> -->

        <!-- CATEGORY -->
        <div class="vx-col mt-4">
          <label for=""><small>کتگوری</small></label>
          <v-select
            label="text"
            :options="itemType"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
          />
        </div>

        <!-- CATEGORY -->

        <!-- NAME -->
        <div class="vx-col mt-4">
          <label for=""><small>واحد سنجش اصلی</small></label>
          <v-select
            label="text"
            :options="itemType"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
          />
        </div>

        <!-- CATEGORY -->
        <!-- NAME -->
        <div class="vx-col mt-4">
          <label for=""><small>واحد سنجش فرعی</small></label>
          <v-select
            label="text"
            :options="itemType"
            :dir="$vs.rtl ? 'rtl' : 'ltr'"
          />
        </div>
        <!-- NAME -->
        <div class="vx-col mt-4"></div>
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
