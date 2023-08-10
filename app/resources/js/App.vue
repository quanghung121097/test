<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link
                        to="/register"
                        class="nav-item nav-link"
                        v-if="!isLoggedIn"
                        >Đăng ký</router-link
                    >
                    <router-link
                        to="/login"
                        class="nav-item nav-link"
                        v-if="!isLoggedIn"
                        >Đăng nhập</router-link
                    >
                    <a
                        class="nav-item nav-link router-link-exact-active router-link-active"
                        @click="logout"
                        v-if="isLoggedIn"
                        >Đăng xuất</a
                    >
                    <router-link to="/" class="nav-item nav-link"
                        >Trang chủ</router-link
                    >
                </div>
            </div>
        </nav>

        <router-view> </router-view>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    computed: {
        isLoggedIn: function () {
            return this.$store.getters.isAuthenticated;
        },
    },
    created() {},
    methods: {
        async logout() {
            await this.$store.dispatch("LogOut");
            this.$router.push("/login");
        },
    },
};
</script>
