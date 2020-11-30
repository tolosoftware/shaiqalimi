
<template>
  <div>
    <div class="vx-row">
      <div class="vx-col w-full md:w-3/3 mb-base">
        <vx-card class="height-vh-80">
          <div class="vx-row">
            <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
              <div class="vx-col w-full">
                <v-select
                  name="product"
                  label="text"
                  v-model="form.product"
                  :options="products"
                  :searchable="false"
                  :dir="$vs.rtl ? 'rtl' : 'ltr'"
                >
                  <span slot="no-options">{{ $t("WhoopsNothinghere") }}</span>
                </v-select>
              </div>
            </div>
            <div class="sm:w-1 md:w-1/2 lg:w-1/3 xl:w-1/3 pr-3 pb-2 pt-3">
              <vs-button @click.prevent="submitForm" class="mb-2"
                >استخراج آرشیف مربط</vs-button
              >
            </div>
          </div>
        </vx-card>
      </div>
    </div>
    <div class="vx-row">
      <div class="vx-col w-full md:w-2/3 mb-base">
        <ArchieveList></ArchieveList>
      </div>
      <div class="vx-col w-full md:w-1/3 mb-base">
        <vx-card title="افزودن به آرشیف">
          <div class="pt-6 pr-6 pl-6">
            <vs-input
              label="عنوان"
              type="text"
              class="mt-5 w-full"
              name="item-title"
            />
          </div>
          <div class="pt-6 pr-6 pl-6">
            <vs-input
              label="ریفرینس کد"
              type="number"
              class="mt-5 w-full"
              name="item-name"
            />
          </div>

          <div class="mt-12">
            <vs-upload
              action="https://jsonplaceholder.typicode.com/posts/"
              @on-success="successUpload"
            />
          </div>
          <div class="flex flex-wrap items-center p-6" slot="footer">
            <vs-button class="mr-6" @click="submitData">انجام</vs-button>
            <vs-button
              type="border"
              color="danger"
              @click="isSidebarActiveLocal = false"
              >لغو</vs-button
            >
          </div>
        </vx-card>
      </div>
    </div>
  </div>
</template>
<style scoped>
[dir] .con-img-upload {
  padding-right: 2.6rem !important;
}
.c-onimg-upload {
  width: 100%;
  margin-top: -940px;
  padding-right: 19px;
}
/* .con-img-upload { */
/*width: 100%;
     background: #fff;
    margin-top: -40px;
    padding-right: 19px;
    box-sizing: border-box;
    column-gap: 21px; */
</style>
<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import ArchieveList from "./Archieve_list.vue";
import vSelect from "vue-select";
export default {
  props: {
    // isSidebarActive: {
    //   type: Boolean,
    //   required: true
    // },
    data: {
      type: Object,
      default: () => {},
    },
  },
  name: "vx-archive",
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
    successUpload() {
      this.$vs.notify({
        color: "success",
        title: "Upload Success",
        text: "Lorem ipsum dolor sit amet, consectetur",
      });
    },
    submitData() {},
    submitForm() {},
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
      fruits: ["لست آرشیف"],
      users: [
        {
          id: 1,
          name: "Leanne Graham",
          username: "Bret",
          email: "Sincere@april.biz",
          website: "hildegard.org",
        },
        {
          id: 2,
          name: "Ervin Howell",
          username: "Antonette",
          email: "Shanna@melissa.tv",
          website: "anastasia.net",
        },
        {
          id: 3,
          name: "Clementine Bauch",
          username: "Samantha",
          email: "Nathan@yesenia.net",
          website: "ramiro.info",
        },
        {
          id: 4,
          name: "Patricia Lebsack",
          username: "Karianne",
          email: "Julianne.OConner@kory.org",
          website: "kale.biz",
        },
        {
          id: 5,
          name: "Chelsey Dietrich",
          username: "Kamren",
          email: "Lucio_Hettinger@annie.ca",
          website: "demarco.info",
        },
        {
          id: 6,
          name: "Mrs. Dennis Schulist",
          username: "Leopoldo_Corkery",
          email: "Karley_Dach@jasper.info",
          website: "ola.org",
        },
        {
          id: 7,
          name: "Kurtis Weissnat",
          username: "Elwyn.Skiles",
          email: "Telly.Hoeger@billy.biz",
          website: "elvis.io",
        },
      ],
      form: {
        product: null,
      },
      products: [
        {
          text: "قراردادی اداره امور",
          value: "1",
        },
        {
          text: "قرار دادی گارنیزیون",
          value: "2",
        },
        {
          text: "قراردادی معارف",
          value: "3",
        },
      ],
    };
  },
  components: {
    VuePerfectScrollbar,
    ArchieveList,
    "v-select": vSelect,
  },
}
</script>
