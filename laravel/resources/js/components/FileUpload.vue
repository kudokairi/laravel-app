<template>
  <div>  
    <input id="lefile" type="file" style="display:none" @change="onFileChange">
    <div class="input-group">
    <span v-show="!uploadedImage" class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input[id=lefile]').click();">アイコン変更</button></span>
    </div>
            <div class="preview-item card-body">
            <img
                v-show="uploadedImage"
                class="preview-item-file"
                :src="uploadedImage"
                alt=""
            />
            <div v-show="uploadedImage" class="preview-item-btn" @click="remove">
                <p class="preview-item-name">{{ img_name }}</p>
                <e-icon class="preview-item-icon">close</e-icon>
            </div>
            </div>
    </div>
</template>

<script>
  export default {
    data() {
        return {
          message:"???",
          uploadedImage: '',
          img_name: '',
        }
    },
    methods: {   
        onFileChange(e) {
          const files = e.target.files || e.dataTransfer.files;
          this.createImage(files[0]);
          this.img_name = files[0].name;
        },

        // アップロードした画像を表示
        createImage(file) {
            const reader = new FileReader();
            reader.onload = e => {
                this.uploadedImage = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        remove() {
            this.uploadedImage = false;
        },
    },
  }
</script>

