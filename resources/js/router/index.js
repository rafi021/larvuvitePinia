import { createWebHistory, createRouter } from "vue-router";

/*Auth Routes */
import Login from  '../pages/Login.vue';
import Register from  '../pages/Register.vue';
/*Auth Routes */
import Home from  '../pages/Home.vue';
import Dashboard from  '../pages/Dashboard.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;

