require('./bootstrap');

window.Vue = require('vue');

import dropify from 'dropify';
import swal from 'sweetalert';


import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
Vue.component('vueDropzone', vue2Dropzone);


import VueCroppie from 'vue-croppie';
import 'croppie/croppie.css';
Vue.use(VueCroppie);

// Moment
Vue.use(require('vue-moment'));


// import custom components
// import ProductReview from './components/ProductReview';
// import ExampleComponent from './components/ExampleComponent';


// Vue.component('example-component', require('./components/ExampleComponent.vue'));
// const app = new Vue({
// 	el: '#app'
// });

