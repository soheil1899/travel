
require('./bootstrap');

window.Vue = require('vue').default;
import moment from 'moment-jalaali';
import vSelect from 'vue-select'




Vue.component('v-select', vSelect)


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('admin-index', require('./admin/index.vue').default);




const app = new Vue({
    el: '#app',
});

Vue.filter('date', (date, format) => {
    return moment(date).format(format)
});
