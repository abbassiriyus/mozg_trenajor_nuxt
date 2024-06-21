<template>
    <notifications />
    <div class="wrapper">
        <div class="overlay"></div>
        <div v-if="getPath == '/login' || getPath == '/registration' || getPath == '/'">
            <router-view />
        </div>
        <div v-else>
            <div class="page">
                <Sidebar />
                <router-view />
            </div>
            <Footer />
        </div>
    </div>
</template>

<script>
import {useAuthStore} from './store/auth.js'
import userService from './services/user'
import Sidebar from './components/Sidebar.vue';
import Footer from './components/Footer.vue';

export default {
    components: {Sidebar, Footer},
    computed: {
        getPath() {
            return this.$route.path;
        }
    },
    mounted() {
        const auth = useAuthStore();

        if(auth.token) {
            userService.userCheckToken(auth.token).catch(err => {
                if(!err.response.data.status) auth.logout();
            })
        }
    }
}
</script>
<style lang="css" >
*{
    scroll-behavior: smooth;
}
</style>