<template>
  <div>
    <div class="vx-row">
      <vx-card v-if="project != null">
        <div class="vx-row">
          <div class="vx-col w-1/2">
            <h3>معلومات پروژه {{ project.title }}</h3>
          </div>
        </div>
        <vs-divider class="my-6"></vs-divider>
        <div class="vx-col lg:w-1/2 w-full">
          <vs-table stripe :data="[1]" class="table-striped vs-table vs-table--tbody-table">
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('title') }}</vs-td>
              <vs-td>{{ project.title }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('s_number') }}</vs-td>
              <vs-td>{{ project.s_number }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('issue_date') }}</vs-td>
              <vs-td>{{ project.issue_date }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('issue_address') }}</vs-td>
              <vs-td>{{ project.issue_address }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('type') }}</vs-td>
              <vs-td>{{ project.type }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('auth_number') }}</vs-td>
              <vs-td>{{ project.auth_number }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('duration') }} ماه</vs-td>
              <vs-td>{{ project.duration }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('price') }} افغانی</vs-td>
              <vs-td>{{ project.price }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('offer_date') }}</vs-td>
              <vs-td>{{ project.offer_date }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('close_date') }}</vs-td>
              <vs-td>{{ project.close_date }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('source_address') }}</vs-td>
              <vs-td>{{ project.source_address }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('offer_price') }} افغانی</vs-td>
              <vs-td>{{ project.offer_price }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('project_price') }} افغانی</vs-td>
              <vs-td>{{ project.project_price }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('announce_id') }}</vs-td>
              <vs-td>{{ (announce) ? announce.title : '' }}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-td class="font-semibold pr-10">{{ $t('organization_id') }}</vs-td>
              <vs-td>{{ (org) ? org.title : '' }}</vs-td>
            </vs-tr>
          </vs-table>
          <div class="mt-5">
            <router-link
              :to="{
                    path: '/projects/project/${project.id}/edit',
                    name: 'project-edit',
                    params: { id: project.id, dyTitle: project.title },
                  }"
            >
              <vs-button>ویرایش قرارداد</vs-button>
            </router-link>
            <vs-button color="warning" @click="$router.go(-1)" type="border">
              بازگشت
              <feather-icon
                icon="ArrowLeftIcon"
                svgClasses="w-5 h-5"
                class="icon-12px position-relative top-5 ml-2"
              />
            </vs-button>
          </div>
        </div>
      </vx-card>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      // init values
      announce: [],
      org: [],
      selectedAnnounce: null,
      selectedOrg: null,

      project: null,
      statusFa: {
        on_hold: "درجریان",
        delivered: "تکمیل",
        canceled: "نا موفق",
      },
    };
  },
  created() {
    this.getProject();
  },
  methods: {
    setAnnounceId(arr) {
      //  trigger a mutation, or dispatch an action  
      this.selectedAnnounce = arr;
    },
    setOrganizationId(arr) {
      //  trigger a mutation, or dispatch an action  
      this.selectedOrg = arr;
    },
    getAnnounces() {
    // console.log(this.project.announce_id);
      if (this.project.announce_id) {
        this.axios.get('/api/announcement/' + this.project.announce_id)
          .then((response) => {
            this.announce = response.data;
            // Finish the Progress Bar
            this.$Progress.set(100)
          })
      }
      else {
        // Finish the Progress Bar
        this.$Progress.set(100)
      }
    },
    getProject() {
      // Start the Progress Bar
      this.$Progress.start()
      this.axios.get('/api/project/' + this.$route.params.id)
        .then((response) => {
          this.project = response.data;
          // this.getOrganizations();
        })
    },
  },
};
</script>