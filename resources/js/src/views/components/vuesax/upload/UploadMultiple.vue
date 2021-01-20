<!-- =========================================================================================
    File Name: UploadMultiple.vue
    Description: Uploading multiple files at once
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <vx-card title="Multiple" code-toggler>

        <p>You can upload multiple files by adding the <code>multiple</code> property within the component</p>

        <div class="mt-5">
            <vs-upload multiple text="Upload Multiple" action="/api/archive" @on-success="successUpload" />
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
