<template>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse">
        <div class="navbar-nav" v-show="!isAuth">
          <router-link to="/register" class="nav-item nav-link"
            >Đăng ký</router-link
          >
          <router-link to="/login" class="nav-item nav-link"
            >Đăng nhập</router-link
          >
          <router-link to="/" class="nav-item nav-link">Trang chủ</router-link>
        </div>
      </div>
    </nav>

    <router-view> </router-view>
  </div>
</template>
 
<script>
import check from './auth';
export default {

  data: function () {
    return {
        isAuth : false
    };
  },
  watch: {
    isAuth() {
        return check
    }
  },

};
</script>