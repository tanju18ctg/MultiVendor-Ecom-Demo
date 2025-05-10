<template>
  <div>
    <DropZone
        url="http://127.0.0.1:8000/api/v1/upload"
        :uploadOnDrop="true"
        :maxFiles="Number(20)"
        :acceptedFiles="['image']"
        @removedFile="onFileRemove"
        />
  </div>

</template>

<script>
import { defineComponent } from 'vue';
import { DropZone } from 'dropzone';

export default defineComponent({
  components: {
    DropZone,
  },
  name: 'App',
  setup() {
    return {
    };
  },
});
</script>

<style>

</style>
