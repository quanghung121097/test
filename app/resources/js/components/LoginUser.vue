<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-header">Đăng Nhập</div>
      <div class="card-body">
        <div class="alert alert-danger" v-if="error && !success">
          <p>Vui lòng thử lại</p>
          <span class="help-block" v-if="error && errors">{{ errors }}</span>
        </div>
        <div class="alert alert-success">
          <p>
            Chưa có tài khoản
            <router-link :to="{ name: 'register' }">Đăng ký</router-link>
          </p>
        </div>
        <form
          autocomplete="off"
          @submit.prevent="login"
          v-if="!success"
          method="post"
        >
          <div class="form-group">
            <label for="email">Email</label>
            <input
              type="email"
              id="email"
              class="form-control"
              placeholder="user@example.com"
              v-model="email"
            />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              id="password"
              class="form-control"
              v-model="password"
            />
          </div>
          <button type="submit" class="btn btn-primary mt-2">
            Đăng nhập
            <div
              v-show="loading"
              class="spinner-border spinner-border-sm ml-2 mr-2"
              role="status"
            ></div>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>
 
<script>
import { mapActions } from "vuex";
export default {
  data: function () {
    return {
      email: "",
      password: "",
      error: false,
      errors: "",
      success: false,
      loading: false,
    };
  },
  methods: {
    // async login() {
    //   this.loading = true;
    //   await this.axios
    //     .post("/api/auth/login", {
    //       email: this.email,
    //       password: this.password,
    //     })
    //     .then((response) => {
          
    //       let token = response.headers.authorization
    //       let data = response.data
    //       data.token = token
    //       localStorage.setItem('user', JSON.stringify(data));
    //       this.error = false;
    //       this.errors = '';
    //     })
    //     .catch((err) => {
    //       this.error = true;
    //       this.errors = err.response.data.message;
    //     })
    //     .finally(() => (this.loading = false));
    // },
    ...mapActions(["LogIn"]),
    async login() {
      const User = new FormData();
      User.append("email", this.email);
      User.append("password", this.password);
      try {
          await this.LogIn(User);
          this.$router.push("/");
          this.error = false
      } catch (error) {
        this.error = true;
        this.errors = err.response.data.message;
      }
    },
  },
};
</script>