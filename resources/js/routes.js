import Home from "./components/Home.vue";
import Login from "./components/Login.vue";
import Register from "./components/Register.vue";
import Dashboard from "./components/Dashboard.vue";
import CreatePost from "./components/CreatePost.vue";

export const routes = [
    {
        name: "home",
        path: "/",
        component: Home
    },
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            requiresGuest: true
        }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            requiresGuest: true
        }
    },
    {
        name: "dashboard",
        path: "/dashboard",
        component: Dashboard,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: "create-post",
        path: "/dashboard/create",
        component: CreatePost,
        meta: {
            requiresAuth: true
        }
    }
];
