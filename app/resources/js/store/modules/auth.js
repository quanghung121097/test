import axios from "axios";
const state = {
    user: null,
};
const getters = {
    isAuthenticated: (state) => !!state.user,
    StateUser: (state) => state.user,
};
const actions = {
    async LogOut({ commit }) {
        let user = null;
        commit("LogOut", user);
    },
    async LogIn({ commit }, User) {
        await axios.post("/api/auth/login", User);
        await commit("setUser", User.get("email"));
    },
};
const mutations = {
    setUser(state, email) {
        state.user = email;
    },
    LogOut(state) {
        state.user = null;
    },
};
export default {
    state,
    getters,
    actions,
    mutations,
};
