import Vue from 'vue';
import router from './router';
import App from './components/App';
require('./bootstrap');



Vue.component('table-draggable', require('./components/TableDraggable.vue').default);
Vue.component('delete-table', require('./components/DeleteTable.vue').default);



const app = new Vue({
    el: '#app',
    components:{
      App,
    },
    router
});
