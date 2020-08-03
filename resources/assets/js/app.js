require('./bootstrap');

window.Vue = require('vue');

import dropify from 'dropify';
import swal from 'sweetalert';

// // Rich Text Editor
import VueQuillEditor from 'vue-quill-editor'
import 'quill/dist/quill.core.css' // import styles
import 'quill/dist/quill.snow.css' // for snow theme
// import 'quill/dist/quill.bubble.css' // for bubble theme
Vue.use(VueQuillEditor)

// dropzone
// import vue2Dropzone from 'vue2-dropzone';
// import 'vue2-dropzone/dist/vue2Dropzone.min.css';
// Vue.component('vueDropzone', vue2Dropzone);


// image cropper
import VueCroppie from 'vue-croppie';
import 'croppie/croppie.css';
Vue.use(VueCroppie);

// Moment
Vue.use(require('vue-moment'));

// Pagination
Vue.component('pagination', require('laravel-vue-pagination'));

// import custom components
// import ProductReview from './components/ProductReview';
// import ExampleComponent from './components/ExampleComponent';


// Vue.component('example-component', require('./components/ExampleComponent.vue'));
// const app = new Vue({
// 	el: '#app'
// });
// import { Picker, Emoji } from 'emoji-mart-vue';
// import 'emoji-mart-vue/css/emoji-mart.css';

// import { Picker, EmojiIndex } from 'emoji-mart-vue-fast'
// let emojiIndex = new EmojiIndex(data)
// import 'emoji-mart-vue-fast/css/emoji-mart.css'
// Vue.component('picker', Picker);
// Vue.component('emoji', Emoji);


// Star Rating
import StarRating from 'vue-star-rating';
Vue.component('star-rating', StarRating);

import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

// import emojione from 'emojione'
import emojionearea from 'emojionearea'
import 'emojionearea/dist/emojionearea.min.css'


