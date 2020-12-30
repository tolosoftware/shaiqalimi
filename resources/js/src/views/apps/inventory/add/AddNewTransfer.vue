<template>
<vx-card class="no-shadow">
    <component :is="scrollbarTag" class="scroll-area--data-list-add-new"  :key="$vs.rtl">
        <form>
            <div class="vx-row">

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
                    <div class="w-full  ml-3 mr-3">
                        <vs-input size="medium" v-validate="'serialnumber'" label="سریال نمبر" name="serialnumber" placeholder="101" disabled />
                        <span class="text-danger text-sm" v-show="errors.has('serialnumber')">{{ errors.first("serialnumber") }}</span>
                    </div>
                </vs-col>

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
                    <div class="w-full  ml-3 mr-3">
                        <label for="date" class="mt-3"><small>تاریخ </small></label>
                        <date-picker color="#e85454" :auto-submit="true" type="datetime" />
                    </div>
                </vs-col>

                <!-- Must only consist of numbers -->

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="12" vs-sm="12" vs-xs="12">
                    <div class="w-full  ml-3 mr-3">
                        <vs-input size="medium" v-validate="'required'" label="عنوان انتقال" name="projecttitle" class="w-full" />
                    </div>
                </vs-col>

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="12" vs-xs="12">
                    <div class="w-full  ml-3 mr-3">
                        <label for>
                            <small> منبع</small>
                        </label>
                        <v-select size="large" label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                    </div>
                </vs-col>

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="12" vs-xs="12">
                    <div class="w-full  ml-3 mr-3">
                        <label for>
                            <small> مقصد </small>
                        </label>
                        <v-select size="large" label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                    </div>
                </vs-col>

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="12" vs-xs="12">
                    <div class="w-full  ml-3 mr-3">
                        <label for>
                            <small> عملیه </small>
                        </label>
                        <v-select size="large" label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                    </div>
                </vs-col>

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
                    <div class="w-full  ml-3 mr-3 ">
                        <label for>
                            <small>مقدار</small>
                        </label>
                        <vx-input-group>
                            <template slot="prepend">
                                <div class="prepend-text bg-primary">
                                    <span>UOM</span>
                                </div>
                            </template>

                            <vs-input type="number" />
                        </vx-input-group>
                    </div>
                </vs-col>

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="12" vs-xs="12">
                    <div class="w-full  ml-3 mr-3">
                        <vs-input size="medium" v-validate="'required'" label=" ثقلت" name="projecttitle" class="w-full" />
                    </div>
                </vs-col>

                  <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
                    <div class="w-full  ml-3 mr-3 ">
                        <label for>
                            <small>معادل</small>
                        </label>
                        <vx-input-group>
                            <template slot="prepend">
                                <div class="prepend-text bg-primary">
                                    <span>UOM</span>
                                </div>
                            </template>

                            <vs-input type="number" />
                        </vx-input-group>
                    </div>
                </vs-col>

                  <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
                    <div class="w-full  ml-3 mr-3 ">
                        <label for>
                            <small>مصارف انتقال</small>
                        </label>
                        <vx-input-group>
                            <template slot="prepend">
                                <div class="prepend-text bg-primary">
                                    <span>AFN</span>
                                </div>
                            </template>

                            <vs-input type="number" />
                        </vx-input-group>
                    </div>
                </vs-col>

                 <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="12" vs-xs="12">
                    <div class="w-full  ml-3 mr-3">
                        <vs-input size="medium" v-validate="'required'" label="شخص مسول" name="projecttitle" class="w-full" />
                    </div>
                </vs-col>

                <div class="vx-col w-full mt-4">
                    <vs-textarea placeholder="تفصیلات"></vs-textarea>
                </div>
            </div>
            <vs-button type="filled" @click.prevent="submitForm" class="mt-5 block">ثبت</vs-button>
        </form>
    </component>

</vx-card>
</template>

<script>
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
    components: {
        'v-select': vSelect,

    },
    data() {
        return {
            itemType: [{
                    text: 'تن',
                    value: '1'
                },
                {
                    text: 'متر مکعب',
                    value: '2'
                },
                {
                    text: 'لیتر',
                    value: '3'
                },
                {
                    text: 'کیلوگرام',
                    value: '4'
                },
            ],
            // End of sidebar items
            dataId: null,
            dataName: '',
            dataCategory: null,
            dataImg: null,
            dataOrder_status: 'pending',
            dataPrice: 0,

            category_choices: [{
                    text: 'Audio',
                    value: 'audio'
                },
                {
                    text: 'Computers',
                    value: 'computers'
                },
                {
                    text: 'Fitness',
                    value: 'fitness'
                },
                {
                    text: 'Appliance',
                    value: 'appliance'
                }
            ],

            order_status_choices: [{
                    text: 'Pending',
                    value: 'pending'
                },
                {
                    text: 'Canceled',
                    value: 'canceled'
                },
                {
                    text: 'Delivered',
                    value: 'delivered'
                },
                {
                    text: 'On Hold',
                    value: 'on_hold'
                }
            ],
            settings: { // perfectscrollbar settings
                maxScrollbarLength: 60,
                wheelSpeed: .60
            }
        }
    },
    watch: {
        isSidebarActive(val) {
            if (!val) return
            if (Object.entries(this.data).length === 0) {
                this.initValues()
                this.$validator.reset()
            } else {
                const {
                    category,
                    id,
                    img,
                    name,
                    order_status,
                    price
                } = JSON.parse(JSON.stringify(this.data))
                this.dataId = id
                this.dataCategory = category
                this.dataImg = img
                this.dataName = name
                this.dataOrder_status = order_status
                this.dataPrice = price
                this.initValues()
            }
            // Object.entries(this.data).length === 0 ? this.initValues() : { this.dataId, this.dataName, this.dataCategory, this.dataOrder_status, this.dataPrice } = JSON.parse(JSON.stringify(this.data))
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
        initValues() {
            if (this.data.id) return
            this.dataId = null
            this.dataName = ''
            this.dataCategory = null
            this.dataOrder_status = 'pending'
            this.dataPrice = 0
            this.dataImg = null
        },
        submitData() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    const obj = {
                        id: this.dataId,
                        name: this.dataName,
                        img: this.dataImg,
                        category: this.dataCategory,
                        order_status: this.dataOrder_status,
                        price: this.dataPrice
                    }

                    if (this.dataId !== null && this.dataId >= 0) {
                        this.$store.dispatch('dataList/updateItem', obj).catch(err => {
                            console.error(err)
                        })
                    } else {
                        delete obj.id
                        obj.popularity = 0
                        this.$store.dispatch('dataList/addItem', obj).catch(err => {
                            console.error(err)
                        })
                    }

                    this.$emit('closeSidebar')
                    this.initValues()
                }
            })
        },
        updateCurrImg(input) {
            if (input.target.files && input.target.files[0]) {
                const reader = new FileReader()
                reader.onload = e => {
                    this.dataImg = e.target.result
                }
                reader.readAsDataURL(input.target.files[0])
            }
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
