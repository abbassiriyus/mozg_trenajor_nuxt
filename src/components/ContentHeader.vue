<template>
    <BurgerMenu />
    <div class="content__header">
        <div class="content__header-left">
            <div class="burger__btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <g clip-path="url(#clip0_247_2183)">
                    <path d="M0 7.24219H15.3692M0 11.9993H15.3692M0 16.7565H15.3692" stroke="#0A0E1A" stroke-width="1.26857" stroke-miterlimit="10" stroke-linecap="round"/>
                </g>
                <defs>
                    <clipPath id="clip0_247_2183">
                    <rect width="23.4198" height="23.4198" fill="white" transform="translate(0 0.290039)"/>
                    </clipPath>
                </defs>
                </svg>
            </div>
            <div class="burger__logo">
                <img class="burger__logo-n" src="@/assets/svg/logo.svg">
            </div>
        </div>
        <p class="content__greeting">{{this.title}}</p>
    </div>
</template>

<script>
import {useAuthStore} from '../store/auth'
import gameService from "../services/game";
import BurgerMenu from '../components/BurgerMenu.vue';
import $ from 'jquery'

export default {
    name: "ContentHeader",
    components: {
        BurgerMenu
    },
    data() {
        return {
            username: '...',
            email: null,
            title: '...'
        }
    },
    mounted() {
        $('.overlay').removeClass('overlay--show');
        $('.burger__menu').removeClass(' burger__menu--active')
        if(this.$route.name == 'Game') {
            gameService.gameGetOne(this.$route.query.id).then(res => {       
                this.title = 'Тренажеры / ' + res.data.data[0].title;   
            })
        }else {
            const auth = useAuthStore();
            let a = auth.decodeToken();

            if(a) {
                if(a){
                    this.username = a.username;
                    this.email = a.email;
                }
            } else {
                this.username = 'Гость';
            }

            this.title = `👋 Привет, ${this.username}!`;
            
            $('.burger__btn').on('click', function (e) {
                e.preventDefault()
                $('.overlay').addClass('overlay--show')
                $('.burger__menu').addClass(' burger__menu--active')
            })
            $('.overlay').on('click', function (e) {
                e.preventDefault()
                $('.overlay').removeClass('overlay--show')
                $('.burger__menu').removeClass(' burger__menu--active')
            })
        }
    }
}
</script>

<style scoped>

@media (max-width: 750px) {
  .content__greeting {
    font-size: 14px;
  }

}
.content__header{
    width: 100%;
    height: 90px;
    padding: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #171717;
    font-family: Roboto;
    font-size: 22px;
    font-style: normal;
    font-weight: 400;
    line-height: 30px; /* 136.364% */
    letter-spacing: -0.4px;
    background-color: #fff;
}
.notifications{
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    background-color: #F4F5F7;
    border-radius: 50%;
}
.notifications--unread::after{
    content: '';
    width: 10px;
    height: 10px;
    border-radius: 50%;
    border: 2px solid #FFF;
    background-color: #DE4848;
    position: absolute;
    top: 0;
    right: 0;
}
@media screen and (max-width: 380px){
    .content__header{
        padding: 10px
    }
}
</style>