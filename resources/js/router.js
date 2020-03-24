import Vue from 'vue';
import VueRouter from 'vue-router';
import ContactCreate from "./views/ContactCreate";
import ExampleComonent from "./components/ExampleComonent";
import ContactShow from "./views/ContactShow";
import ContactEdit from "./views/ContactEdit";
import ContactIndex from "./views/ContactIndex";
import BirthdayIndex from "./views/BirthdayIndex";
import Logout from "./Logout/Logout.vue";


Vue.use(VueRouter);

export default new VueRouter({
    routes: [
      {
            path: '/',
            component: ExampleComonent,
            meta: {title: 'Welcome'}
        },{
            path: '/contacts',
            component: ContactIndex,
            meta: {title: '一覧'}

        },{
            path: '/contacts/create',
            component: ContactCreate,
            meta: {title: '新規作成'}

        },{
            path: '/contacts/:id',
            component: ContactShow,
            meta: {title: '詳細'}

        },{
            path: '/contacts/:id/edit',
            component: ContactEdit,
            meta: {title: '編集'}

        },{
            path: '/birthday',
            component: BirthdayIndex,
            meta: {title: '今月の誕生日'}
        },{
            path: '/logout',
            component:Logout,
        }
    ],
    mode: 'history'
});
