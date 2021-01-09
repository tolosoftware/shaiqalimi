<template>
<vs-row>
  <div class="vx-card">
    <div class="vx-card__header">
      <div class="vx-card__title">
        <h4 class=""> ثبت واحدات اندازه گیری </h4>
      </div>
    </div>
    <vs-divider></vs-divider>
    <div>
      <form action="" class="p-2">
        <vs-col vs-type="flex" vs-lg="6" vs-sm="12" vs-xs="12" class="p-1">
          <div class="w-full">
            <vs-input size="medium" label=" مخفف" v-model="form.acronym" name="type" class="w-full" />
          </div>
        </vs-col>
        <vs-col vs-type="flex" vs-lg="6" vs-sm="12" vs-xs="12" class="p-1">
          <div class="w-full">
            <vs-input size="medium" label="نام" v-model="form.title" name="type" class="w-full" />
          </div>
        </vs-col>

        <vs-col vs-type="flex" vs-lg="12" vs-sm="12" vs-xs="12" class="mt-4 float-left">
          <vs-button @click="submitdata"> ثبت </vs-button>
        </vs-col>
      </form>

      <vs-divider></vs-divider>
      <vs-table :data="uom" vs-justify="center">
        <template slot="thead" vs-justify="center">
          <vs-th>
            شماره
          </vs-th>
          <vs-th>
            نام
          </vs-th>
          <vs-th>
            مخفف
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
              {{data[indextr].title}}
            </vs-td>

            <vs-td :data="data[indextr].type">
              {{data[indextr].acronym}}
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
      uom: [],
      form: new Form({
        id: '',
        title: '',
        acronym: '',
      }),

    }
  },
  methods: {
    submitdata() {
      this.form.post('/api/uom')
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
          this.axios.delete('/api/uom/' + id).then(() => {
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
      this.axios.get('/api/uom').then(({
        data
      }) => (this.uom = data,
        this.$Progress.set(100), this.$vs.loading.close()));
    },

  },

  created() {
    this.loadItemtype();
  },
}
</script>
