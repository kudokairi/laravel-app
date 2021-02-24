<template>
  <div class="ml-auto">
    <input id="lefile" type="file" style="display:none" @change="onFileChange">
    <div class="input-group">
    <span class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input[id=lefile]').click();">アイコン変更</button></span>
    </div>
    <p>{{ message }}</p>

    <div id="overlay" v-show="showContent">
        <div id="content" class="w-50">
          <p class="text-center small d-block d-sm-none small">プロフィールを下記画像に設定しますか？</p>
          <p class="text-center d-none d-sm-block">プロフィールを下記画像に設定しますか？</p>
          <img :src="uploadedImage" class="w-50 h-50 d-block mx-auto">
          <div class="row justify-content-center">
            <button class="btn btn-info waves-effect waves-light h-25 p-1 col-6 col-sm-3" v-on:click="upload_image">適用</button>
            <button class="btn btn-info waves-effect waves-light h-25 p-1 col-6 col-sm-3" v-on:click="closeModal">キャンセル</button>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      endpoint: {
        type: String,
      },
    },
    data() {
        return {
          message:'',
          showContent: false,
          uploadedImage: '',
          files: '',
          type: '',
          maxWidth: 300,
          imageFile: '',
          errors: '',
        };
    },
    methods: {   
      closeModal: function(){
        this.files = '';
        this.type = '';
        var obj = document.getElementById("lefile");
        obj.value = "";
        this.showContent = false;
      },

      onFileChange(e) {
        this.files = e.target.files[0];
        this.type = this.files.type;

        if (this.type != 'image/jpeg' && this.type != 'image/gif' && this.type != 'image/png') {
          this.errors += '.jpg、.gif、.pngのいずれかのファイルのみ許可されています\n'
        }

        if (this.errors) {
          alert(this.errors);
          this.errors = '';
          this.files = '';
          this.type = '';
          return false;
        }
        this.showContent = true;
        this.createImage(this.files);
     },

      // アップロードした画像をリサイズ・表示
      createImage(file) {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = e => {

            let img = new Image();
            img.onload = () => {

                let width = img.width;
                let height = img.height;

                if(width > this.maxWidth) {

                    height = Math.round(height * this.maxWidth / width);
                    width = this.maxWidth;

                }

                let canvas = document.createElement('canvas');
                canvas.width = width;
                canvas.height = height;
                let ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);
                ctx.canvas.toBlob((blob) => {

                    this.imageFile = new File([blob], file.name, {
                        type: file.type,
                        lastModified: Date.now()
                    });

                }, file.type, 1);

            };
            img.src = e.target.result;
            console.log(img.src);
            this.uploadedImage = e.target.result;
            console.log(this.uploadedImage);
        };
      },

      async upload_image() {
        const data = new FormData();
        data.append("file", this.imageFile);
        console.log(data);
        console.log(this.endpoint);
        const response = await axios.post(this.endpoint,data);
        const items = response.data;
        const imgProfile = document.getElementsByClassName("imgProfile");
        for (var i = 0; i < imgProfile.length; i++) {
          imgProfile[i].setAttribute('src',items);
        }
        this.showContent = false;
        this.message ='';
        this.files = '';
        this.type = '';
        this.imageFile = '';
        this.errors = '';
      },
    }
  }
</script>

