import { isLoggedIn, logOut } from "./utils";
export default {
    state: {
        isLoggedIn: false,
        user: {},
        userPosts: []
    },
    getters: {
        isLoggedIn: state => {
            return state.isLoggedIn;
        },
        user: state => {
            return state.user;
        },
        userPosts: state => {
            return state.userPosts;
        }
    },
    mutations: {
        SET_USER(state, payload) {
            state.user = payload;
        },
        SET_LOGGED_IN(state, payload) {
            state.isLoggedIn = payload;
        },
        SET_USER_POSTS(state, posts) {
            state.userPosts = posts;
        }
    },
    actions: {
        async loadUser({ commit, dispatch }) {
            try {
                await axios.get("/sanctum/csrf-cookie");
                await axios.get("/api/v1/user").then(res => {
                    commit("SET_USER", res.data);
                    commit("SET_LOGGED_IN", true);
                });
            } catch (error) {
                commit("SET_LOGGED_IN", false);
                console.log(error);
            }
        },
        setUserPosts({ commit }, posts) {
            commit("SET_USER_POSTS", posts);
        },
        logoutUser({ commit }) {
            try {
                commit("SET_USER", null);
                commit("SET_LOGGED_IN", false);
                logOut();
            } catch (error) {
                console.log(error);
            }
        }
    }
};
