import Vue from "vue"
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Dashboard from '../pages/Dashboard';
import UserList from '../pages/User/UserList';

const routes = [
    {
        path: '/',
        component: Dashboard,
        name: 'dashboard'
    },
    {
        path: '/users',
        component: UserList,
        name: 'userList'
    }
];

export default new VueRouter({
    routes,
    mode: 'hash'
})
