/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
window.Vue = require("vue");
import AppWeb from "./AppWeb.vue";

import "es6-promise/auto";
import VueAuth from "@websanova/vue-auth";
import VueAxios from "vue-axios";
import VueRouter from "vue-router";
import VueMeta from 'vue-meta'
import authweb from "./authweb";
import router from "./routerweb";

import DefaultWeb from "./layouts/DefaultWeb.vue";

Vue.component("default-layout", DefaultWeb);
Vue.component("no-sidebar-layout", DefaultWeb);

// Set Vue globally
window.Vue = Vue;

// Set Vue router
Vue.router = router;
Vue.use(VueRouter);

Vue.use(VueMeta, {
    // optional pluginOptions
    refreshOnceOnNavigation: true
})


Vue.use(require("vue-moment"));

// Set Vue authentication
Vue.use(VueAxios, axios);
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api/web`;
Vue.use(VueAuth, authweb);

// Load Index
Vue.component("validation-errors", {
    data() {
        return {};
    },
    props: ["errors"],
    template: `<div v-if="validationErrors">
                <ul class="alert alert-danger">
                    <li v-for="(value, key, index) in validationErrors">{{ value }}</li>
                </ul>
            </div>`,
    computed: {
        validationErrors() {
            let errors = Object.values(this.errors);
            errors = errors.flat();
            return errors;
        }
    }
});

const app = new Vue({
    router,
    render: h => h(AppWeb)
}).$mount("#app_web");

/*
  const app = new Vue({
      el: '#app_web',
      router: router
  });
*/
