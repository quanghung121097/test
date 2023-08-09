<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-header">Đăng ký</div>
      <div class="card-body">
        <div class="alert alert-danger" v-if="error && !success">
          <p>Vui lòng thử lại</p>
          <span class="help-block" v-if="error && errors">{{ errors }}</span>
        </div>
         <div class="alert alert-success" v-if="success">
          <p>Đăng ký thành công <router-link :to="{name:'login'}">Đăng nhập</router-link></p>
        </div>
        <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" v-model="name">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" class="form-control" v-model="password">
          </div>
          <div class="form-group">
            <label for="password">Password Confirm</label>
            <input type="password" id="password" class="form-control" v-model="password_confirmation">
          </div>
          <button type="submit" class="btn btn-primary mt-2">Register
            <div v-show="loading" class="spinner-border spinner-border-sm ml-2 mr-2" role="status"></div>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>
 
<script>
export default {
  data: function () {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      error: false,
      errors: {},
      success: false,
      loading: false
    }
  },
  methods: {
    register() {
        this.loading = true
        this.axios.post('/api/auth/register', {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation
            })
            .then(response => {
                if(response.data.success){
                    this.success = true
                }
            })
            .catch(err => {
                this.loading = false
                this.error = true;
                this.errors = err.response.data.message;
            })
            .finally(() => this.loading = false)
    },
  }
}
</script>