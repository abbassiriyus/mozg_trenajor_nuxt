<template>
    <div class="burger__menu">
		<div class="burger__menu-inner">
			<div class="burger__menu-profile"  v-if="this.username">
                <div class="burger__profile-left">
                    <div class="burger__profile-img">
                        <img src="@/assets/img/profile-img-mob.png" alt="">
                    </div>
                    <div class="burger__profile-nickname">{{this.username}}</div>
                    <div class="burger__profile-mail">{{this.email}}</div>
                </div>
			</div>
			<div class="burger__menu-ul">
                <div class="burger__menu-li">
                    <div class="burger__menu-svg">
                    <img src="@/assets/svg/user-square.svg" alt="">
                    </div>
                    <router-link class="burger__menu-text burger__menu-text--active" to="/profile">Профиль</router-link>
                </div>
                <div class="burger__menu-li" v-if="this.username">
                    <div class="burger__menu-svg">
                    <img src="@/assets/svg/logout.svg" alt="">
                    </div>
                    <div class="burger__menu-text" v-on:click="logout()">Выход</div>
                </div>
			</div>
			<div class="burger__menu-ul">
                <div class="burger__menu-li burger__menu-li-sub">
                    <div class="burger__menu-li-main">
                        <div class="burger__menu-svg"><img src="@/assets/svg/weight_grey.svg" alt=""></div>
                        <router-link class="burger__menu-text" to="/training">Тренажеры</router-link>
                    </div>
                    <button class="burger__menu-li-arrow" @click="OpenSubMenu()">
                        <img src="@/assets/svg/submenu.svg" alt="">
                    </button>
                </div>
                <div class="burger__menu-li-submenu" v-if="IsSubMenuOpen">
                    <div class="burger__menu-li">
                        <div class="burger__menu-svg">
                        <img src="@/assets/svg/memory.svg" alt="">
                        </div>
                        <router-link class="burger__menu-text" to="/training?type=memory">Память</router-link>
                    </div>
                    <div class="burger__menu-li">
                        <div class="burger__menu-svg">
                        <img src="@/assets/svg/attention.svg" alt="">
                        </div>
                        <router-link class="burger__menu-text" to="/training?type=attention">Внимание</router-link>
                    </div>
                    <div class="burger__menu-li">
                        <div class="burger__menu-svg">
                        <img src="@/assets/svg/mind.svg" alt="">
                        </div>
                        <router-link class="burger__menu-text" to="/training?type=mind">Мышление</router-link>
                    </div>
                    <div class="burger__menu-li">
                        <div class="burger__menu-svg">
                        <img src="@/assets/svg/speed.svg" alt="">
                        </div>
                        <router-link class="burger__menu-text" to="/training?type=speed">Тренажёры для скорости реакции</router-link>
                    </div>
                </div>
                
			</div>
			<div class="burger__menu-ul">
                <div class="burger__menu-li">
                    <div class="burger__menu-svg">
                    <img src="@/assets/svg/statistick.svg" alt="">
                    </div>
                    <router-link class="burger__menu-text" to="/stats">Статистика</router-link>
                </div>
			</div>
		</div>
	</div>
</template>

<script>
import {useAuthStore} from '../store/auth'

export default {
    name: "BurgerMenu",
    data() {
        return {
            username: null,
            email: null,
            IsSubMenuOpen: false
        }
    },
    methods: {
        logout() {
            const auth = useAuthStore();
            auth.logout();
            window.location.href = '/';
        },
        OpenSubMenu(){
            this.IsSubMenuOpen = !this.IsSubMenuOpen
        }
    },
    mounted() {
        const auth = useAuthStore();
        let a = auth.decodeToken();

        if(a) {
            this.username = a.username;
            this.email = a.email;
        }
    }
}
</script>
<style scoped>
.burger__menu-li-main{
    display: flex;
    align-items: center;
}
.burger__menu-li-sub{
    justify-content: space-between;
}
.burger__menu-li-submenu{
    padding-left: 20px;
}
.burger__menu-li-submenu .burger__menu-li{
    padding: 10px 14px
}
.burger__menu-inner{
    max-width: 250px;
    width: 250px
}
.burger__menu-ul{
    margin-bottom: 0px;
}
</style>