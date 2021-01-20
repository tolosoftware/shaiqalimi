<!-- =========================================================================================
    File Name: UploadDefault.vue
    Description: Rendering of default Upload
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <vx-card title="Default" code-toggler>

        <p>You can upload files to the server with the <code>vs-upload</code> component, the requested parameter is <code>action</code> which is the URL of the server</p>

        <vs-alert color="primary" icon="new_releases" active="true" class="mt-5">
            <p>For the title of each tab the <code>vs-label</code> property is implemented in the <code>vs-tab</code> component</p>
        </vs-alert>

        <div class="mt-5">
            <vs-upload action="/api/archive" @on-success="successUpload" />
        </div>
    </vx-card>
</template>

<script>
export default {
  methods: {
    successUpload () {
      this.$vs.notify({ color: 'success', title: 'Upload Success', text: 'Lorem ipsum dolor sit amet, consectetur' })
    }
  }
}
</script>
