<template>
<div class="vx-row">
    <div class="vx-col w-full sm:w-1/3 md:w-1/3 mb-base">
        <div class="vx-card">
            <div class="vx-card__header">
                <div class="vx-card__title">
                    <h4 class="">نتظیمات واحد پولی </h4>
                    <!---->
                </div>
                <!---->
            </div>
            <div class="vx-card__collapsible-content vs-con-loading__container">
                <div class="vx-card__body">
                    <!-- start -->

                    <vs-table :data="users">

                        <template slot="thead">
                            <vs-th>نام</vs-th>
                            <vs-th>نرخ</vs-th>
                            <vs-th>تنظیمات</vs-th>

                        </template>

                        <template slot-scope="{data}">
                            <vs-tr :key="indextr" v-for="(tr, indextr) in data">

                                <vs-td :data="data[indextr].id">
                                    {{ data[indextr].website }}
                                </vs-td>

                                <vs-td :data="data[indextr].id">
                                    {{ data[indextr].id }}
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

                    <!-- end -->
                </div>
            </div>
        </div>
    </div>

      <div class="vx-col w-full sm:w-1/3 md:w-1/3 mb-base">
        <div class="vx-card">
            <div class="vx-card__header">
                <div class="vx-card__title">
                    <h4 class="">نتظیمات واحد پولی </h4>
                    <!---->
                </div>
                <!---->
            </div>
            <div class="vx-card__collapsible-content vs-con-loading__container">
                <div class="vx-card__body">
                    <!-- start -->

                    <vs-table :data="users">

                        <template slot="thead">
                            <vs-th>نام</vs-th>
                            <vs-th>نرخ</vs-th>
                            <vs-th>تنظیمات</vs-th>

                        </template>

                        <template slot-scope="{data}">
                            <vs-tr :key="indextr" v-for="(tr, indextr) in data">

                                <vs-td :data="data[indextr].id">
                                    {{ data[indextr].website }}
                                </vs-td>

                                <vs-td :data="data[indextr].id">
                                    {{ data[indextr].id }}
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

                    <!-- end -->
                </div>
            </div>
        </div>
    </div>


      <div class="vx-col w-full sm:w-1/3 md:w-1/3 mb-base">
        <div class="vx-card">
            <div class="vx-card__header">
                <div class="vx-card__title">
                    <h4 class="">نتظیمات واحد پولی </h4>
                    <!---->
                </div>
                <!---->
            </div>
            <div class="vx-card__collapsible-content vs-con-loading__container">
                <div class="vx-card__body">
                    <!-- start -->

                    <vs-table :data="users">

                        <template slot="thead">
                            <vs-th>نام</vs-th>
                            <vs-th>نرخ</vs-th>
                            <vs-th>تنظیمات</vs-th>

                        </template>

                        <template slot-scope="{data}">
                            <vs-tr :key="indextr" v-for="(tr, indextr) in data">

                                <vs-td :data="data[indextr].id">
                                    {{ data[indextr].website }}
                                </vs-td>

                                <vs-td :data="data[indextr].id">
                                    {{ data[indextr].id }}
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

                    <!-- end -->
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'vx-settings',
     data() {
        return {
          
        users: [{
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
        ],

        };
     },
}
</script>
