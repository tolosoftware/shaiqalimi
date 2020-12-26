<template>
<vx-card class="no-shadow">
    <component :is="scrollbarTag" class="scroll-area--data-list-add-new" :settings="settings" :key="$vs.rtl">
        <div class="p-6">

            <div class="vx-row mb-6">
                <div class="vx-col w-full">
                    <vs-input class="w-full" type="text" label="کود" v-model="form.code" />
                </div>
            </div>

            <div class="vx-row mb-6">
                <div class="vx-col w-full">
                    <vs-input class="w-full" label="عنوان" v-model="form.name" />
                </div>
            </div>

            <div class="vx-row mb-6">
                <div class="vx-col w-full">
                    <vs-input class="w-full" label="مسؤل" v-model="form.manager" />
                </div>
            </div>

            <div class="vx-row mb-6">
                <div class="vx-col w-full">
                    <vs-input class="w-full" label="شماره" v-model="form.phone" />
                </div>
            </div>

            <div class="vx-row mb-6">
                <div class="vx-col w-full">
                    <vs-input class="w-full" label="آدرس" v-model="form.address" />
                </div>
            </div>

            <div class="vx-row mb-6">
                <div class="vx-col w-full">
                    <vs-input class="w-full" label="ظرفیت" v-model="form.capacity" />
                </div>
            </div>

            <div class="vx-row mb-6">
                <div class="vx-col w-full">
                    <label for="" class="vs-input--label">واحد ظرفیت</label>
                    <v-select v-model="form.oum_id" label="title" :options="uom" :searchable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'">
                        <span slot="no-options">
                            {{$t('WhoopsNothinghere')}}
                        </span>
                    </v-select>
                </div>
            </div>

            <div class="vx-row">
                <div class="vx-col w-full">
                    <vs-button class="mr-3 mb-2" @click="submitdata">ثبت</vs-button>
                    <vs-button color="warning" type="border" class="mb-2" @click="input9 = input10 = input11 = input12 = ''; check3 = false;">پاک کردن فرم</vs-button>
                </div>
            </div>
        </div>
    </component>

</vx-card>
</template>

<script>
import vSelect from 'vue-select'
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
export default {
    props: {
        isSidebarActive: {
            type: Boolean,
            required: true
        },
        data: {
            type: Object,
            default: () => {}
        }
    },
    components: {
        'v-select': vSelect,
        VuePerfectScrollbar
    },
    data() {
        return {
            uom: [],
            form: new Form({
                id: '',
                code: '',
                name: '',
                manager: '',
                phone: '',
                address: '',
                capacity: '',
                oum_id: '',

            }),

            settings: { // perfectscrollbar settings
                maxScrollbarLength: 60,
                wheelSpeed: .60
            }
        }
    },

    computed: {
        isSidebarActiveLocal: {
            get() {
                return this.isSidebarActive
            },
            set(val) {
                if (!val) {
                    this.$emit('closeSidebar')
                    // this.$validator.reset()
                    // this.initValues()
                }
            }
        },
        isFormValid() {
            return !this.errors.any() && this.dataName && this.dataCategory && this.dataPrice > 0
        },
        scrollbarTag() {
            return this.$store.getters.scrollbarTag
        }
    },

    created() {
        this.loaduom();
    },
    methods: {
        submitdata() {
            this.form.post('/api/storage')
                .then(() => {
                    this.$vs.notify({
                        title: 'ذخیره اضافه شد',
                        text: 'عملیه موفغانه انجام شد',
                        color: 'success',
                        iconPack: 'feather',
                        icon: 'icon-check',
                        position: 'top-right'
                    })
                    this.form.reset();
                    this.loadItemtype();
                })

                .catch(() => {
                    this.$vs.notify({
                        title: 'عملیه ناکام شد',
                        text: 'عملیه موفغانه انجام شد',
                        color: 'danger',
                        iconPack: 'feather',
                        icon: 'icon-check',
                        position: 'top-right'
                    })
                })
        },

        loaduom() {
            this.axios.get('/api/uom').then(({
                data
            }) => (this.uom = data));
        },

    }

}
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

    }
}

.scroll-area--data-list-add-new {
    // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
    height: calc(var(--vh, 1vh) * 100 - 10px - 25px - 82px);

    &:not(.ps) {
        overflow-y: auto;
    }
}
</style>
