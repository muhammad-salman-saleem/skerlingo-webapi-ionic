/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
window.Vue = require("vue");
import VueMeta from 'vue-meta'
import App from "./App.vue";

import VueSlimScroll from 'vue-slimscroll';
Vue.use(VueSlimScroll);

import VuetifyDraggableTreeview from 'vuetify-draggable-treeview';
Vue.use(VuetifyDraggableTreeview);

import "es6-promise/auto";
import VueAuth from "@websanova/vue-auth";
import VueAxios from "vue-axios";
import VueRouter from "vue-router";
import auth from "./auth";
import router from "./router";
import vuetify from './vuetify' // path to vuetify export

import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use( CKEditor );

import Admin from "./layouts/Admin.vue";
import Importer from "./layouts/Importer.vue";
import Exporter from "./layouts/Exporter.vue";
import Default from "./layouts/Default.vue";
import NoSidebar from "./layouts/NoSidebar.vue";

Vue.component("admin-layout", Admin);
Vue.component("importer-layout", Importer);
Vue.component("exporter-layout", Exporter);
Vue.component("default-layout", Default);
Vue.component("no-sidebar-layout", NoSidebar);

// Set Vue globally
window.Vue = Vue;

import excel from "vue-excel-export";
Vue.use(excel);

// Set Vue router
Vue.router = router;
Vue.use(VueRouter);
Vue.use(VueMeta);

Vue.use(require("vue-moment"));

// Set Vue authentication
Vue.use(VueAxios, axios);
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`;
Vue.use(VueAuth, auth);

// Load Index
Vue.component("validation-errors", {
    data() {
        return {};
    },
    props: ["errors"],
    template: `<div class="alert alert-custom alert-light-danger fade show mb-5 p-4"
                  v-if="validationErrors"
                  role="alert"
                >
                  <div class="alert-icon">
                    <i class="flaticon-warning"></i>
                  </div>
                  <div class="alert-text">
                    <p class="mb-0 font-size-sm" v-for="(value, key, index) in validationErrors">{{ value }}</p>
                  </div>
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
    vuetify,
    render: h => h(App)
}).$mount("#app");

/*
  const app = new Vue({
      el: '#app',
      router: router
  });
*/
