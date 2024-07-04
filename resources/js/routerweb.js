import VueRouter from 'vue-router'

// Pages
import Home from './components_web/HomeComponent.vue';
import Services from './components_web/ServicesComponent.vue';
import Mobile from './components_web/MobileComponent.vue';

// Routes
const routes = [{
    path: '/:alias',
    name: 'home',
    //component: Home,
    component: Mobile,
    props: true,
    meta: {
        //auth: true
    }
}, {
    path: '/:alias/services',
    name: 'services',
    //component: Services,
    component: Mobile,
    props: true,
    meta: {
        //auth: true
    }
}, {
    path: '/:alias/mobile',
    name: 'mobile',
    component: Mobile,
    props: true,
    meta: {
        //auth: true
    }
}]

const router = new VueRouter({
    history: true,
    mode: 'history',
    base: '/',
    routes,
})

export default router
