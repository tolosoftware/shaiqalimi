<template>
<vs-sidebar position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
  <div class="mt-6 flex items-center justify-between px-6 float-right">
        <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
    </div>

     <vs-tabs>
        <vs-tab label="لیست ">
            <Stationlist></Stationlist>
       </vs-tab>
       <vs-tab label= "ثبت">
           <div class="p-6">
        <div class="vx-row mb-6">
            <div class="vx-col w-full">
                <vs-input class="w-full" label="نام" v-model="form.name"/>
            </div>
        </div>
      
        <div class="vx-row mb-6">
            <div class="vx-col w-full">
                <vs-input class="w-full" label="مسؤل" v-model="form.manager"/>
            </div>
        </div>
        <div class="vx-row mb-6">
            <div class="vx-col w-full">
                <vs-input class="w-full" label="آدرس" v-model="form.phone"/>
            </div>
        </div>
        <div class="vx-row mb-6">
            <div class="vx-col w-full">
                <vs-input class="w-full" label="شماره" v-model="form.address"/>
            </div>
        </div>
     
       
        <div class="vx-row">
            <div class="vx-col w-full">
                <vs-button class="mr-3 mb-2"  @click="submitdata">ثبت</vs-button>
                <vs-button color="warning" type="border" class="mb-2" @click="input9 = input10 = input11 = input12 = ''; check3 = false;">پاک کردن فرم</vs-button>
            </div>
        </div>
    </div>
       </vs-tab>
       
     </vs-tabs>
  
</vs-sidebar>
</template>

<script>
import vSelect from 'vue-select'
import Stationlist from './Stationlist.vue'
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
        Stationlist

    },
    data() {
        return {

             form: new Form({
                id: '',
                name: '',
                manager: '',
                phone: '',
                address: '',
                
            }),

            // End of sidebar items
            dataId: null,
            dataName: '',
            dataCategory: null,
            dataImg: null,
            dataOrder_status: 'pending',
            dataPrice: 0,

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
    methods: {
        submitdata() {
            this.form.post('/api/fuelstation')
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
