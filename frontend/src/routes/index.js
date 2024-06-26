import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import NotFound from '../components/NotFound.vue';
import Login from '../components/auth/Login.vue';
import Register from '../components/auth/Register.vue';
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
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;