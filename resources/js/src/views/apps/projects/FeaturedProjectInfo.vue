<template>
  <div class="vx-col w-full">
      <!-- RADIAL CHART -->
      <div class="vx-row">
        <div class="vx-col w-full md:w-1/4 mb-base">
            <button 
                class="shadow-md w-full lg:mt-0 mt-1 cbig-btn c-button"
                @click="createNewProject"
                title="افزودن پروژه جدید"
            >
                <svg width="10em" height="10em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Free 5.15.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) --><path d="M320 336c0 8.84-7.16 16-16 16h-96c-8.84 0-16-7.16-16-16v-48H0v144c0 25.6 22.4 48 48 48h416c25.6 0 48-22.4 48-48V288H320v48zm144-208h-80V80c0-25.6-22.4-48-48-48H176c-25.6 0-48 22.4-48 48v48H48c-25.6 0-48 22.4-48 48v80h512v-80c0-25.6-22.4-48-48-48zm-144 0H192V96h128v32z"/></svg>
            </button>
        </div>
        <div class="vx-col w-full md:w-1/4 mb-base">
            <vx-card title="آخرین پروژه ها">
                <template slot="actions">
                    <feather-icon icon="HelpCircleIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
                </template>
                <div class="mt-base">
                      <div class='mt-4'>
                          <div class="flex justify-between">
                              <div class="flex flex-col">
                                  <span class="mb-1">دیزل</span>
                                  <h4>۷۴%</h4>
                              </div>
                              <div class="flex flex-col text-right">
                                  <span class="flex -mr-1">
                                      <span class="mr-1">زمان ورود</span>
                                  </span>
                                  <span class="text-grey">۲۲:۳۴</span>
                              </div>
                          </div>
                          <vs-progress :percent="74" color="success"></vs-progress>
                      </div>
                  </div>
            </vx-card>
        </div>
        <div class="vx-col w-full md:w-1/4 mb-base">
            <vx-card title="تانگ تیل">
                <template slot="actions">
                    <feather-icon icon="HelpCircleIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
                </template>
                <div class="mt-base">
                      <div class='mt-4'>
                          <div class="flex justify-between">
                              <div class="flex flex-col">
                                  <span class="mb-1">گاز</span>
                                  <h4>۴۴%</h4>
                              </div>
                              <div class="flex flex-col text-right">
                                  <span class="flex -mr-1">
                                      <span class="mr-1">زمان ورود</span>
                                  </span>
                                  <span class="text-grey">۱۲:۳۴</span>
                              </div>
                          </div>
                          <vs-progress :percent="44" color="success"></vs-progress>
                      </div>
                  </div>
            </vx-card>
        </div>
        <div class="vx-col w-full md:w-1/4 mb-base">
            <vx-card title="انتقالات امروز">
                <template slot="actions">
                    <feather-icon icon="HelpCircleIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
                </template>
                <div class="mt-base">
                      <div class='mt-4'>
                          <div class="flex justify-between">
                              <div class="flex flex-col">
                                  <span class="mb-1">موبلایل</span>
                                  <h4>۸۴%</h4>
                              </div>
                              <div class="flex flex-col text-right">
                                  <span class="flex -mr-1">
                                      <span class="mr-1">زمان ورود</span>
                                  </span>
                                  <span class="text-grey">۰۸:۳۴</span>
                              </div>
                          </div>
                          <vs-progress :percent="84"></vs-progress>
                      </div>
                  </div>
            </vx-card>
        </div>
      </div>
    </div>
</template>

<script>
import DataViewSidebar from './DataViewSidebar.vue'
import moduleDataList from './data-list/moduleDataList.js'

export default {
  name: 'vx-project-featured',
  methods : {
    createNewProject(){
        this.$router.push('/projects/add' ).catch(() => {})
    },
  },
  mounted () {
    this.isMounted = false
  }
}
</script>
