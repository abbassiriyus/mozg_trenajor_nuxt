<template>
    <section class="sidebar">
        <div class="sidebar__container">
        <router-link to="/"><img class="sidebar__logo" src="@/assets/svg/logo.svg"></router-link>
        <nav class="sidebar__nav nav">
            <ul class="nav__list-item">
            <li class="nav__item">
                <img class="nav__item-icon" src="@/assets/svg/profile-circle.svg">
                <router-link class="nav__item-text" to="/profile">{{this.username}}</router-link>
            </li>
            <li class="nav__item">
                <div class="nav__sub-nav sub-nav">
                    <button v-on:click="za()" class="sub-nav__button">
                        <img class="sub-nav__icon" src="@/assets/svg/weight.svg">
                        <router-link  class="sub-nav__text" to="/training">Тренажеры</router-link >
                        <img src="@/assets/svg/submenu-arrow.svg" class="sub-nav__arrow">
                    </button>
                    <ul class="sub-nav__list-item">
                        <li class="sub-nav__item">
                        <img src="@/assets/svg/memory.svg" class="sub-nav__item-icon">
                        <router-link v-on:click="z()" class="sub-nav__item-text" to="/training?type=memory">Память</router-link>
                        </li>
                        <li class="sub-nav__item">
                        <img src="@/assets/svg/attention.svg" class="sub-nav__item-icon">
                        <router-link v-on:click="z()" class="sub-nav__item-text" to="/training?type=attention">Внимание</router-link>
                        </li>
                        <li class="sub-nav__item">
                        <img src="@/assets/svg/mind.svg" class="sub-nav__item-icon">
                        <router-link v-on:click="z()" class="sub-nav__item-text" to="/training?type=mind">Мышление</router-link>
                        </li>
                        <li class="sub-nav__item">
                        <img src="@/assets/svg/speed.svg" class="sub-nav__item-icon">
                        <router-link v-on:click="z()" class="sub-nav__item-text" to="/training?type=speed">Тренажёры для скорости реакции</router-link>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav__item">
                <img class="nav__item-icon" src="@/assets/svg/statistick.svg">
                <router-link class="nav__item-text" to="/stats">Статистика</router-link>
            </li>
            </ul>
        </nav>
        </div>
    </section>
</template>

<script>
import {useAuthStore} from '../store/auth'
import $ from 'jquery'

export default {
    name: 'Sidebar',
    data() {
        return {
            username: '...',
            link: '/login',
            a: false
        }
    },
    methods: {
        z() {
            if(!this.a) {
                $('.sub-nav__list-item').css('display', 'flex');
                $('.sub-nav__arrow').css('transform', 'rotate(0deg)');
                $('.sub-nav__button').css('border-radius', '8px 8px 0px 0px');
                
                this.a = true;
            }
        },
        za() {
            if(!this.a) {
                $('.sub-nav__list-item').css('display', 'flex');
                $('.sub-nav__arrow').css('transform', 'rotate(0deg)');
                $('.sub-nav__button').css('border-radius', '8px 8px 0px 0px');
                
                this.a = true;
            }else {
                $('.sub-nav__list-item').css('display', 'none');
                $('.sub-nav__arrow').css('transform', 'rotate(180deg)');
                $('.sub-nav__button').css('border-radius', '8px 8px 8px 8px');

                this.a = false;
            }
        }
    }, 
    mounted() {
        const auth = useAuthStore();
        let a = auth.decodeToken();

        if(a) {
            if(a){
                this.username = a.username;
                this.link = '/profile'
            }
        } else {
            this.username = 'Гость';
        }
    }
}
</script>

<style scoped>
.sidebar {
    background-color: #fff;
    min-height: 1000px;
}
</style>