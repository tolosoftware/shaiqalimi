<template>
<vs-sidebar click-not-close position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
    <div class="mt-6 flex items-center justify-between px-6 float-right">
        <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
    </div>

    <vs-tabs>
        <vs-tab label=" لیست گدام">

            <vs-table :data="users">

                <template slot="thead">
                    <vs-th>Email</vs-th>
                    <vs-th>Name</vs-th>
                    <vs-th>Website</vs-th>
                    <vs-th>Nro</vs-th>
                </template>

                <template slot-scope="{data}">
                    <vs-tr :key="indextr" v-for="(tr, indextr) in data">

                        <vs-td :data="data[indextr].email">
                            {{ data[indextr].email }}
                        </vs-td>

                        <vs-td :data="data[indextr].username">
                            {{ data[indextr].name }}
                        </vs-td>

                        <vs-td :data="data[indextr].id">
                            {{ data[indextr].website }}
                        </vs-td>

                        <vs-td :data="data[indextr].id">
                            {{ data[indextr].id }}
                        </vs-td>

                    </vs-tr>
                </template>

            </vs-table>

        </vs-tab>
        <vs-tab label="ثبت گدام">

            <div class="pt-6 pr-6 pl-6">
                <!-- NAME -->
                <vs-input label=" نام" class="mt-5 w-full" name="item-name" v-validate="'required'" />
                <!-- <span class="text-danger text-sm" v-show="errors.has('item-name')">{{ errors.first('item-name') }}</span> -->

                <!-- CATEGORY -->
                <vs-input label=" آدرس" class="mt-5 w-full" name="item-name" v-validate="'required'" />

                <!-- CATEGORY -->

                <!-- NAME -->
                <vs-input label=" مسول" class="mt-5 w-full" name="item-name" v-validate="'required'" />

                <!-- CATEGORY -->
                <!-- NAME -->
                <vs-input label=" تماس" class="mt-5 w-full" name="item-name" v-validate="'required'" />
                <!-- NAME -->
                <div class="vx-col mt-4"></div>
                <vs-textarea placeholder="تفصیلات" />

                <div class="flex flex-wrap items-center p-6" slot="footer">
                    <vs-button class="mr-6" @click="submitData">ثبت</vs-button>
                    <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">لغو</vs-button>
                </div>
            </div>

        </vs-tab>
    </vs-tabs>

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

            users: [{
                    "id": 1,
                    "name": "Leanne Graham",
                    "username": "Bret",
                    "email": "Sincere@april.biz",
                    "website": "hildegard.org",
                },
                {
                    "id": 2,
                    "name": "Ervin Howell",
                    "username": "Antonette",
                    "email": "Shanna@melissa.tv",
                    "website": "anastasia.net",
                },
                {
                    "id": 3,
                    "name": "Clementine Bauch",
                    "username": "Samantha",
                    "email": "Nathan@yesenia.net",
                    "website": "ramiro.info",
                },
                {
                    "id": 4,
                    "name": "Patricia Lebsack",
                    "username": "Karianne",
                    "email": "Julianne.OConner@kory.org",
                    "website": "kale.biz",
                },
                {
                    "id": 5,
                    "name": "Chelsey Dietrich",
                    "username": "Kamren",
                    "email": "Lucio_Hettinger@annie.ca",
                    "website": "demarco.info",
                },
                {
                    "id": 6,
                    "name": "Mrs. Dennis Schulist",
                    "username": "Leopoldo_Corkery",
                    "email": "Karley_Dach@jasper.info",
                    "website": "ola.org",
                },
                {
                    "id": 7,
                    "name": "Kurtis Weissnat",
                    "username": "Elwyn.Skiles",
                    "email": "Telly.Hoeger@billy.biz",
                    "website": "elvis.io",
                },
            
            ]
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
        width: 500px;
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
