<!-- =========================================================================================
  File Name: AddNewDataSidebar.vue
  Description: Add New Data - Sidebar component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
<vs-sidebar position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
    <div class="mt-6 flex items-center justify-between px-6">
        <h4>ثبت فروشنده </h4>
        <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>

    <component :is="scrollbarTag" class="scroll-area--data-list-add-new" :key="$vs.rtl">

        <div class="pt-6 pr-6 pl-6">

            <!-- NAME -->
            <vs-input label=" نام" class="mt-5 w-full" name="item-name" v-validate="'required'" v-model="form.name" />
            <!-- <span class="text-danger text-sm" v-show="errors.has('item-name')">{{ errors.first('item-name') }}</span> -->

            <!-- CATEGORY -->

            <!-- NAME -->
            <vs-input label="شماره تماس" class="mt-5 w-full" name="item-name" v-model="form.phone" />

            <vs-input label="آدرس" class="mt-5 w-full" name="item-name" v-model="form.address" />

        </div>
    </component>

    <div class="flex flex-wrap items-center p-6" slot="footer">
        <vs-button class="mr-6" @click="submitData">انجام</vs-button>
        <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">لغو</vs-button>
    </div>
</vs-sidebar>
</template>

<script>
import Ekmalat from "../shared/Ekmalat"
import vSelect from 'vue-select'
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

    data() {
        return {

            form: new Form({
                id: '',
                name: '',
                phone: '',
                address: '',
              user_id: localStorage.getItem('id'),
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

                }
            }
        },

        scrollbarTag() {
            return this.$store.getters.scrollbarTag
        }
    },
    methods: {
        submitData() {
             this.form.post('/api/vendors')
                .then(() => {
                    this.$vs.notify({
                        title: 'عملیه ثبت موفق بود!',
                        text: 'عملیه موفغانه انجام شد',
                        color: 'success',
                        iconPack: 'feather',
                        icon: 'icon-check',
                        position: 'top-right'
                    })
                    this.form.reset();
                })

                .catch(() => {
                    this.$vs.notify({
                        title: 'عملیه ثبت ناموفق بود!',
                        text: 'عملیه  ناکم شد لطفا دوباره تلاش نماید',
                        color: 'danger',
                        iconPack: 'feather',
                        icon: 'icon-check',
                        position: 'top-right'
                    })
                })
        }
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
