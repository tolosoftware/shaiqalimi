<template>
<vx-card>
    <form class="pl-4 pr-4 pb-2 pt-2" autocomplete="off">
        <input autocomplete="off" name="hidden" type="text" style="display:none;">

        <div class="vx-row">
            <div class="vx-row w-2/3">
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12" class="pl-4 pr-4 pb-2 pt-2">
                    <div class="w-full">
                        <vs-input class="w-full" label="نام" v-model="form.firstName" />
                    </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12" class="pl-4 pr-4 pb-2 pt-2">
                    <div class="w-full">
                        <vs-input class="w-full" label="تخلص" v-model="form.lastName" />
                    </div>
                </vs-col>

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12" class="pl-4 pr-4 pb-2 pt-2">
                    <div class="w-full">

                        <label for="text"><small>نوعیت کاربر</small> </label>
                        <v-select label="text" :options="usertypes" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="form.user_type" />
                    </div>

                </vs-col>

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12" class="pl-4 pr-4 pb-2 pt-2">
                    <div class="w-full">
                        <vs-input class="w-full" type="text" label="پوسیشن" v-model="form.position" />
                    </div>
                </vs-col>

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12" class="pl-4 pr-4 pb-2 pt-2">
                    <div class="w-full">
                        <vs-input class="w-full" type="email" label="ایمیل" v-model="form.email" />
                    </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12" class="pl-4 pr-4 pb-2 pt-2">
                    <div class="w-full">
                        <vs-input class="w-full" type="text" label="شماره تماس" v-model="form.phone" />
                    </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12" class="pl-4 pr-4 pb-2 pt-2">
                    <div class="w-full">
                        <vs-input class="w-full" type="text" label="آدرس" v-model="form.address" autocomplete="off" autofill="off" />
                    </div>
                </vs-col>

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12" class="pl-4 pr-4 pb-2 pt-2">
                    <div class="w-full">
                        <vs-input class="w-full" type="password" label="رمز عبور" v-model="form.password" />
                    </div>
                </vs-col>

                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="12" vs-sm="12" vs-xs="12" class="pl-4 pr-4 pb-2 pt-2">
                    <div class="w-full con-select-example">
                      

                        <label class="typo__label">مافوق برای کابر</label>
                        <v-select  v-model="form.userleaders" :options="arrayofobject" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="مافوق کاربر را انتخاب کنید" label="name" track-by="name" :preselect-first="true">
                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="form.userleaders.length &amp;&amp; !isOpen">{{ form.userleaders.length }} به این تعداد انتخاب شده</span></template>
                        </v-select>
                     
                    </div>
                </vs-col>

            </div>
            <div class="vx-col w-1/3">
                <!-- Product Image -->
                <template v-if="form.image">
                    <!-- Image Container -->
                    <div class="img-container w-64 mx-auto flex items-center justify-center mt-5">
                        <img :src="form.image" width="50px" height="50px" alt="img" class="user_image responsive" />
                    </div>

                    <!-- Image upload Buttons -->
                    <div class="modify-img flex justify-between mt-5">
                        <input type="file" class="hidden" ref="updateImgInput" @change="updateCurrImg" accept="image/*" />
                        <vs-button class="mr-4" type="flat" @click="$refs.updateImgInput.click()">تغییر</vs-button>
                        <vs-button type="flat" color="#999" @click="form.image = null">حذف</vs-button>
                    </div>
                </template>
                <!-- Upload -->

                <!-- <vs-upload text="Upload Image" class="img-upload" ref="fileUpload" /> -->

                <div class="upload-img mt-5 text-center" v-if="!form.image">
                    <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*" />
                    <vs-button @click="$refs.uploadImgInput.click()">آپلود تصویر</vs-button>
                </div>

                <!-- Product Image -->
                <template v-if="!form.image">
                    <div class="mt-4">
                        <!-- Image Container -->
                        <div class="img-container w-64 mx-auto flex items-center justify-center">
                            <img src="/images/user/user.jpg" width="50px" height="50px" alt="img" class="user_image responsive" />
                        </div>

                    </div>
                </template>
                <!-- Upload -->
            </div>
        </div>
        <div class="vx-row">
            <div class="vx-col pt-5">
                <div class="w-full">
                    <vs-button class="mr-3 mb-2" @click.prevent="submitData">ثبت</vs-button>
                    <vs-button color="warning" type="border" class="mb-2" @click="formreset">پاک کردن</vs-button>
                </div>
            </div>
        </div>
    </form>
</vx-card>
</template>

<script>
import vSelect from "vue-select";
import Multiselect from 'vue-multiselect'
export default {
    components: {

        "v-select": vSelect,
        Multiselect
    },
    data() {
        return {

            users: [],
            arrayofobject: [{
                    name: 'Mahdi Naseri',
                    language: '1'
                },
                {
                    name: 'Naseri Karimi',
                    language: '2'
                },
                {
                    name: 'Jamal Ahmadi',
                    language: '3'
                },
              
            ],

            usertypes: [{
                    text: 'آدمین',
                    value: 0
                },
                {
                    text: 'منیجر ',
                    value: 2
                },
                {
                    text: 'سوپروایزر',
                    value: 3
                },

                {
                    text: 'کابر عادی',
                    value: 4
                },
            ],
            form: new Form({
                id: '',
                firstName: '',
                lastName: '',
                user_type: '',
                position: '',
                email: '',
                phone: '',
                address: '',
                password: '',
                image: '',
                userleaders: '',
            })
        }
    },

    methods: {
        loadUsers() {
            this.axios.get('/api/users').then(({
                data
            }) => (this.users = data));
        },
        formreset() {
            this.form.reset();
        },
        submitData() {

            this.form.post('/api/users')
                .then(() => {
                    this.$vs.notify({
                        title: ' کاربر جدید اضافه شد',
                        text: 'عملیه موفغانه انجام شد',
                        color: 'success',
                        iconPack: 'feather',
                        icon: 'icon-check',
                        position: 'top-right'
                    })
                    this.form.reset();
                })

                .catch(() => {

                })
        },

        initValues() {
            this.form.image = null
        },
        updateCurrImg(input) {
            if (input.target.files && input.target.files[0]) {
                const reader = new FileReader()
                reader.onload = e => {
                    this.form.image = e.target.result

                }
                reader.readAsDataURL(input.target.files[0])
            }
        }
    },

    created() {
        this.loadUsers();
    },
}
</script>
