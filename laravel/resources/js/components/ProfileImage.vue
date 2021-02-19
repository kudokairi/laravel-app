<template>
<div>
  <img :src = "filePath" style="width: 5rem;height: 5rem;border-radius: 50%;" class="imgProfile">
</div>
</template>

<script>
  export default {
    props:{
      initialFilePath: {
        type:String,
      },
    },
    data() {
      return {
        filePath: this.initialFilePath,
      };
    },
};
</script>