require("./bootstrap");
import Vue from "vue";
window.Vue = require("vue");

import App from "./App.vue";
import VueRouter from "vue-router";
import Vuex from "vuex";
import VueAxios from "vue-axios";
import axios from "axios";
import { routes } from "./routes";
import storeData from "./store";

axios.defaults.baseURL = process.env.MIX_SERVER_URL;

Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const store = new Vuex.Store(storeData);

const router = new VueRouter({
    mode: "history",
    routes: routes,
    linkExactActiveClass: "is-active" // active class for *exact* links.
});

router.beforeEach((to, from, next) => {
    console.log(localStorage.getItem("isLoggedIn"));
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem("isLoggedIn") === "false") {
            next("/login");
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.requiresGuest)) {
        if (localStorage.getItem("isLoggedIn") === "true") {
            next("/");
        } else {
            next();
        }
    } else {
        next();
    }
});

const app = new Vue({
    el: "#app",
    router: router,
    async beforeCreate() {
        this.$store.dispatch("loadUser");
    },
    store,
    render: h => h(App)
});
