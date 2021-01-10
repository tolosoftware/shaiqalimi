<template>
<vs-row>

  <div class="vx-card">
    <div class="vx-card__header">
      <div class="vx-card__title">
        <h4 class="">نوعیت محصولات </h4>
      </div>
    </div>
    <vs-divider></vs-divider>
    <div>
      <form action="" class="p-2">
        <vs-col vs-type="flex" vs-lg="8" vs-sm="12" vs-xs="12">
          <div class="w-full">
            <vs-input size="medium" label="عنوان معامله" v-model="form.type" name="type" class="w-full" />
          </div>
        </vs-col>

        <vs-col vs-type="flex" vs-lg="4" vs-sm="12" vs-xs="12" class="mt-4 float-left">
          <vs-button @click="submitdata"> ثبت </vs-button>
        </vs-col>
      </form>

      <vs-divider></vs-divider>
      <vs-table :data="itemtype" vs-justify="center">
        <template slot="thead" vs-justify="center">
          <vs-th>
            شماره
          </vs-th>
          <vs-th>
            نام
          </vs-th>
          <vs-th>
            تنظیمات
          </vs-th>

        </template>

        <template slot-scope="{data}">
          <vs-tr :key="indextr" v-for="(tr, indextr) in data">
            <vs-td :data="data[indextr].type">
              {{indextr+1}}
            </vs-td>

            <vs-td :data="data[indextr].type">
              {{data[indextr].type}}
            </vs-td>

            <vs-td>
              <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" @click="$router.push({
                           name: 'user-profile-edit', 
                           params: {user_id: tr.id }}).catch(() => {})" />
              <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(data[indextr].id)" />
            </vs-td>

          </vs-tr>
        </template>
      </vs-table>

    </div>
  </div>

</vs-row>
</template>

<script>
export default {
  data() {
    return {
      itemtype: [],
      form: new Form({
        id: '',
        type: '',

      }),

    }
  },
  methods: {
    submitdata() {
      this.form.post('/api/itemtype')
        .then(() => {
          this.$vs.notify({
            title: 'نوعیت محصول اضافه شد',
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

    deleteData(id) {
      swal.fire({
        title: 'آیا شما مطمئن هستید ؟',
        text: "شما قادر به برگردادن این شخص پس از حذف نمی باشید !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'بلی مطمئن هستم',
        cancelButtonText: 'نخیر'
      }).then((result) => {
        if (result.value) {
          this.axios.delete('/api/itemtype/' + id).then(() => {
            swal.fire(
              'حذف شد !',
              'موفقانه عملیه حذف انجام شد',
              'success'
            )
            this.loadItemtype();
          }).catch(() => {
            swal("Failed!", "سیستم قادر به حذف نیست دوباره تلاش نماید.", "warning");
          })
        }
      })
    },

    loadItemtype() {
      this.axios.get('/api/itemtype').then(({
        data
      }) => (this.itemtype = data));
    },

  },

  created() {
    this.loadItemtype();
  },
}
</script>
