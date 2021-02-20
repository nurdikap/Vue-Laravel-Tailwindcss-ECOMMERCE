

window.Vue = require('vue');
import router from './routes';
import VModal from 'vue-js-modal'
Vue.use(VModal);


Vue.component('index', require('./components/pages/index.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
