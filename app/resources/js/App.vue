<template>
    <div class="container"> 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav" >
                    <router-link to="/register" class="nav-item nav-link">Đăng ký</router-link>
                    <router-link to="/login" class="nav-item nav-link">Đăng nhập</router-link>
                    <router-link to="/" class="nav-item nav-link">Trang chủ</router-link>
                </div>
            </div>
        </nav>

        <router-view> </router-view>
    </div>
</template>
 
<script>
    export default {
        
    }
</script>