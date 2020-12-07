<template>
<vx-card>
    <form class="p-4">

        <div class="vx-row">
            <div class="vx-row w-2/3">
                <div class="vx-col mb-6 w-1/2">
                    <div class="w-full">
                        <vs-input class="w-full" label="نام" v-model="form.firstName" />
                    </div>
                </div>
                <div class="vx-col mb-6 w-1/2">
                    <div class="w-full">
                        <vs-input class="w-full" label="تخلص" v-model="form.lastName" />
                    </div>
                </div>

                <div class="vx-col  w-1/2 mt-6">
                    <div class="w-full">
                        <v-select label="text" :options="itemType" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="form.userType" />
                    </div>
                </div>

                 <div class="vx-col mb-6 w-1/2">
                    <div class="w-full">
                        <vs-input class="w-full" type="text" label="پوسیشن" v-model="form.position" />
                    </div>
                </div>

                <div class="vx-col mb-6 w-1/2">
                    <div class="w-full">
                        <vs-input class="w-full" type="email" label="ایمیل" v-model="form.email" />
                    </div>
                </div>
                <div class="vx-col mb-6 w-1/2">
                    <div class="w-full">
                        <vs-input class="w-full number-rtl" label="شماره تماس" v-model="form.phone" />
                    </div>
                </div>
                <div class="vx-col mb-6 w-1/2">
                    <div class="w-full">
                        <vs-input class="w-full" label="آدرس" v-model="form.address" />
                    </div>
                </div>

                <div class="vx-col mb-6 w-1/2">
                    <div class="w-full">
                        <vs-input class="w-full" type="password" label="رمز عبور" v-model="form.password" />
                    </div>
                </div>

            </div>
            <div class="vx-col w-1/3">
                <!-- Product Image -->
                <template v-if="form.userimg">
                    <!-- Image Container -->
                    <div class="img-container w-64 mx-auto flex items-center justify-center mt-5">
                        <img :src="form.userimg" width="50px" height="50px" alt="img" class="user_image responsive" />
                    </div>

                    <!-- Image upload Buttons -->
                    <div class="modify-img flex justify-between mt-5">
                        <input type="file" class="hidden" ref="updateImgInput" @change="updateCurrImg" accept="image/*" />
                        <vs-button class="mr-4" type="flat" @click="$refs.updateImgInput.click()">تغییر</vs-button>
                        <vs-button type="flat" color="#999" @click="form.userimg = null">حذف</vs-button>
                    </div>
                </template>
                <!-- Upload -->

           

                <!-- <vs-upload text="Upload Image" class="img-upload" ref="fileUpload" /> -->

                <div class="upload-img mt-5 text-center" v-if="!form.userimg">
                    <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*" />
                    <vs-button @click="$refs.uploadImgInput.click()">آپلود تصویر</vs-button>
                </div>

              <!-- Product Image -->
                <template v-if="!form.userimg">
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
export default {
    components: {
        "v-select": vSelect,
    },
    data() {
        return {

            itemType: [{
                    text: "آدمین",
                    value: "1",
                },
                {
                    text: "منیجر",
                    value: "2",
                },
                {
                    text: "سوپروایزر",
                    value: "3",
                },
                {
                    text: "اجینت",
                    value: "4",
                },
            ],

            form: new Form({
                id: '',
                firstName: '',
                lastName: '',
                userType: '',
                position: '',
                email: '',
                phone: '',
                address: '',
                password: '',
                userimg: '',
            })
        }
    },

    methods: {
        formreset() {
            this.form.reset();
        },
        submitData() {

            this.form.post('/api/users1')
                .then(() => {
                    this.$vs.notify({
                        title: 'Icon mail',
                        text: 'Lorem ipsum dolor sit amet, consectetur',
                        color: 'success',
                        iconPack: 'feather',
                        icon: 'icon-check',
                        position: 'top-right'
                    })
                })

                .catch(() => {

                })
        },

        mahdi() {
            console.log("work");
        },

        initValues() {
            this.form.userimg = null
        },
        updateCurrImg(input) {
            if (input.target.files && input.target.files[0]) {
                const reader = new FileReader()
                reader.onload = e => {
                    this.form.userimg = e.target.result

                }
                reader.readAsDataURL(input.target.files[0])
            }
        }
    },

    created() {

    },
}
</script>
