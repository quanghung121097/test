import axios from 'axios';
const config = {
    check: false,
    isAuth() {
        let user = JSON.parse(localStorage.getItem("user"));
        if (user && user.token) {
            axios.get(`/api/auth/check`, {
                    headers: { Authorization: 'Bearer ' + user.token }
                }).then((response) => {
                    if (response.data.data.success) {
                        this.check = true
                    }
                })
                .catch((error) => {
                    this.check = false
                });
        } else {
            return false;
        }
    },
    authHeader() {
        let user = JSON.parse(localStorage.getItem('user'));

        if (user && user.accessToken) {
            return { Authorization: 'Bearer ' + user.accessToken }; // for Spring Boot back-end
            // return { 'x-access-token': user.accessToken };       // for Node.js Express back-end
        } else {
            return {};
        }
    }
};
export default config;