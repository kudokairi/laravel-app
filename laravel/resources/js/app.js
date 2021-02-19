import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import ArticleTagsInput from './components/ArticleTagsInput'
import FollowButton from './components/FollowButton'
import FileUpload from './components/FileUpload'
import MyModal from './components/MyModal'
import ProfileImage from './components/ProfileImage'

const app = new Vue({
  el: '#app',
  components: {
    ArticleLike,
    ArticleTagsInput,
    FollowButton,
    FileUpload,
    MyModal,
    ProfileImage,
  }
})
