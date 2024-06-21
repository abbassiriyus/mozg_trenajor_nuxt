<template>
    <section class="content">
        <ContentHeader />
            <div class="content__profile">
                <div class="profile__header">
                    <div class="profile__top">
                    <div class="profile__top-header">
                        <div class="profile__top-header-img">
                        <img src="@/assets/img/profile-img.png" alt="">
                        </div>
                        <div class="profile__top-header-info">
                        <div class="profile__top-header-nick">{{this.userinfo.username}}</div>
                        <div class="profile__top-header-mail">{{this.userinfo.email}}</div>
                        </div>
                    </div>
                    <div class="profile__top-menu"></div>
                    </div>
                    <div class="profile__bottom">
                    <router-link class="profile__bottom-profile " :class="{ 'profile__bottom--active': this.$route.query.act != 'settings' }" to="/profile">Профиль</router-link>
                    <router-link class="profile__bottom-settings " :class="{ 'profile__bottom--active': this.$route.query.act == 'settings' }" to="/profile?act=settings">Настройки</router-link>
                    </div>
                </div>
                <div class="profile__footer">
                    <div class="profile__footer-prof" v-if="this.$route.query.act != 'settings'">
                      <div class="footer__prof-left">
                          <div class="footer__prof-pretitle">Персональная информация</div>
                          <div class="footer__prof-ul">
                          <div class="footer__prof-li">
                              <div class="footer__prof-svg">
                              <img src="@/assets/svg/footer-name.svg" alt="">
                              </div>
                              <div class="footer__prof-title">Имя</div>
                              <div class="footer__prof-subtitle">{{this.userinfo.username}}</div>
                          </div>
                          <div class="footer__prof-li">
                              <div class="footer__prof-svg">
                              <img src="@/assets/svg/footer-mail.svg" alt="">
                              </div>
                              <div class="footer__prof-title">E-mail</div>
                              <div class="footer__prof-subtitle">{{this.userinfo.email}}</div>
                          </div>
                          </div>
                      </div>
                      <div class="footer__prof-right">
                          <div class="footer__prof-pretitle">Данные аккаунта</div>
                          <div class="footer__prof-ul">
                          <div class="footer__prof-li">
                              <div class="footer__prof-svg">
                              <img src="@/assets/svg/footer-stat.svg" alt="">
                              </div>
                              <div class="footer__prof-title">Статус аккаунта</div>
                              <div class="footer__prof-subtitle">{{this.userinfo.role}}</div>
                          </div>
                          <div class="footer__prof-li">
                              <div class="footer__prof-svg">
                              <img src="@/assets/svg/footer-ex.svg" alt="">
                              </div>
                              <div class="footer__prof-title">Кол-во тренировок</div>
                              <div class="footer__prof-subtitle">{{this.updataDop.countGames ?? 0}}</div>
                          </div>
                          </div>
                      </div>
                    </div>

                    <div class="profile__footer-prof" v-if="this.$route.query.act != 'settings'" style="margin-top: 24px; flex-direction: column;">
                      <div class="footer__prof-pretitle">Избранные тренажеры</div>
                      <div class="trainers">
                        <div class="trainers__container">
                            <TrainCard v-for="(item, index) in datas" :id="item.training_id" :title="item.title" :difficulty="item.difficulty" :type="item.type" :img="item.img" :isLiked="true" :information="item.information" v-bind:key="index"/>
                        </div>
                        <div v-if="this.datas == null">Тренажеров нет</div>
                    </div>
                    </div>

                    <div class="profile__footer-set" v-if="this.$route.query.act == 'settings'">
                      <form @submit.prevent="change" class="footer__set-left">
                          <div class="footer__set-date">
                            <div class="footer__date-title">Персональная информация</div>
                            <div class="footer__date-row date__row-name">
                                <input type="text" class="footer-name" placeholder = "" v-model="this.newusername">
                            </div>
                            <div class="footer__date-row date__row-email">
                                <input type="email" class="footer-email" placeholder = "" v-model="this.newemail">
                            </div>
                          </div>
                          <div class="footer__set-date">
                            <div class="footer__date-title">Изменить пароль</div>
                            <div class="footer__date-row date__row-newpass">
                                <input type="password" class="footer-pass" placeholder = "" v-model="this.newpass">
                                <div class="footer__newpass-space"></div>
                            </div>
                            <div class="footer__date-row date__row-accpass">
                                <input type="password" class="footer-pass" placeholder = "" v-model="this.newconfpass">
                                <div class="footer__pass-space"></div>
                            </div>
                          </div>
                            <div class="footer__setleft-btnbox">
                            <button class="footer__setleft-btn" type="submit">Сохранить данные</button>
                          </div>
                      </form>
                    </div>
                </div>
            </div>
    </section>
</template>

<script>
import ContentHeader from '../components/ContentHeader.vue';
import TrainCard from '../components/TrainCard.vue';
import {useAuthStore} from '../store/auth';
import userService from '../services/user';
import gameService from '../services/game';
import $ from 'jquery'

export default {
    name: "Profile",
    components: {ContentHeader, TrainCard},
    data() {
        return {
            datas: [],
            username: '',
            userinfo: [],
            updataDop: [],
            newusername: undefined,
            newemail: undefined,
            newpass: undefined,
            newconfpass: undefined
        }
    },  
    methods: {
      change() {
        if(this.newpass !== this.newconfpass) {
          this.$notify({
              title: "Внимание",
              text: "Введите одинаковые пароли",
              type: "warn"
          });

          return;
        } 

        const auth = useAuthStore();
        userService.setUserInfo(auth.token, this.newusername, this.newemail, this.newpass).then(res => {
          this.$notify({
              title: "Успешно",
              text: res.data.message,
              type: "success"
          });
        }).catch(err => {
          this.$notify({
              title: "Внимание",
              text: err.response.data.message,
              type: "warn"
          });
        })
      }
    },
    mounted() {
        const auth = useAuthStore();
        let a = auth.decodeToken();

        if(a) {
            if(a){
                this.username = a.username;
            }
        }

        gameService.gameGetLiked(auth.token).then(res => {
          this.datas = res.data.data;
        })

        userService.getUserInfo(auth.token).then(res => {
            this.userinfo = res.data.dataProfile[0]
            this.updataDop = res.data.dataProfileDop[0];
            if(this.userinfo.role == 1) this.userinfo.role = 'Базовый'
            if(this.userinfo.role == 2) this.userinfo.role = 'Администратор'
        })

        $('.statistick__icon-box, .statistics__top-exit').on('click', function (e) {
            e.preventDefault()
            $('.statistics').toggleClass('statistics--show')
        })

        $('.footer__btn-one').on('click', function (e) {
            e.preventDefault()
            $('.footer__btn-one').toggleClass('footer__set-btn--active')
            $('.footer__slyde-one').toggleClass('footer__slyde-one--active')
        })
        $('.footer__btn-two').on('click', function (e) {
            e.preventDefault()
            $('.footer__btn-two').toggleClass('footer__set-btn--active')
            $('.footer__slyde-two').toggleClass('footer__slyde-two--active')
        })

        $('.footer__newpass-space').on('click', function (e) {
            e.preventDefault()
            $('.date__row-newpass').toggleClass('date__row-newpass--not')
        })
        $('.footer__pass-space').on('click', function (e) {
            e.preventDefault()
            $('.date__row-accpass').toggleClass('date__row-accpass--not')
        })


        $('.profile__bottom-profile').on('click', function (e) {
            e.preventDefault()
            $('.profile__bottom-profile').addClass('profile__bottom--active')
            $('.profile__bottom-settings').removeClass('profile__bottom--active')
            $('.profile__footer-prof').removeClass('profile__footer--hide')
            $('.profile__footer-set').addClass('profile__footer--hide')
        })

        $('.profile__bottom-settings').on('click', function (e) {
            e.preventDefault()
            $('.profile__bottom-settings').addClass('profile__bottom--active')
            $('.profile__bottom-profile').removeClass('profile__bottom--active')
            $('.profile__footer-set').removeClass('profile__footer--hide')
            $('.profile__footer-prof').addClass('profile__footer--hide')
        })
    }
}
</script>

<style scoped>
/* IMPORT ----------------------------------------------------------*/
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

/* GLOBAL  -------------------------------------------------------------*/
* {
  font-family: 'Open Sans', sans-serif;
  margin: 0;
  padding: 0;
}
*, *::before, *::after {
  box-sizing: border-box;
}
.trainers__container{
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 10px;
}
@media screen and (max-width: 1500px) {
  .trainers__container{
    grid-template-columns: repeat(3, 1fr);
  }
}
@media screen and (max-width: 1200px) {
  .trainers__container{
    grid-template-columns: repeat(2, 1fr);
  }
}
@media screen and (max-width: 900px) {
  .trainers__container{
    grid-template-columns: repeat(1, 1fr);
  }
}
body,
html {
  display: block;
  overflow-x: hidden !important;
  width: 100%;
  height: 100%;
}

body>.page {
  max-width: 1920px;
  margin: 0 auto;
}

.page {
  display: flex;
  flex-direction: row;
  height: 100%;
}

.sidebar{
  max-width: 260px;
}

.content {
  flex: 1 0 auto;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: stretch;
}

ul{
  list-style: none;
}

button{
  border: 0;
  border-color: none;
  background-color: none;
  background: none;
}

.button{
  padding: 20px 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.button:hover, .button:active{
  cursor: pointer;
}
.button__icon{
  margin-right: 10px;
}
.button__text{
  text-align: center;
font-family: Open Sans;
font-size: 12px;
font-style: normal;
font-weight: 700;
line-height: 20px; /* 166.667% */
letter-spacing: -0.2px;
}
.button--white{
  background-color: white;
  border-radius: 10.558px;
border: 1px solid #3281FF;
}
.button--white>.button__text{
  color: #3281FF;
}
.button--blue{
  background-color: #3281FF;
  border-radius: 10.558px;
border: 1px solid #3281FF;
}
.button--blue>.button__text{
  color: white;
}

/* SIDEBAR -------------------------------------------------------------------------------- */

.sidebar__container{
  padding: 25px 15px;
}
.sidebar__logo{
  margin-bottom: 40px;
}
.nav__list-item{
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: stretch;
}
.nav__item{
  padding: 15px;
  display: flex;
  justify-self: flex-start;
  align-items: center;
}
.nav__item-icon{
  margin-right: 15px;
}
.nav__item-text{
  color: #78828E;
  font-family: Open Sans;
  font-size: 14px;
  line-height: 150%; /* 21px */
  text-decoration: none;
}
.nav__item-text:hover{
  text-decoration: underline;
}
.sub-nav{
  margin-left: -15px;
  margin-top: -15px;
  min-width: 228px;
}
.sub-nav:hover .sub-nav__button{
  border-radius: 8px 8px 0px 0px;
}
.sub-nav:hover .sub-nav__arrow{
  transform: rotate(0deg);
}
.sub-nav:hover .sub-nav__list-item{
  display: flex;
}
.sub-nav__button{
  width: 100%;
  padding: 15px;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  border-radius: 8px 8px 8px 8px;
  background: #3281FF;
}
.sub-nav__icon{
  margin-right: 15px;
}
.sub-nav__left{
  display: grid;
  grid-template-columns: repeat(2, auto);
  grid-template-rows: repeat(2, auto);
  margin-right: 27px;
}
.sub-nav__img{
  margin-right: 6px;
  grid-row: span 2;
}
.sub-nav__img img{
  border-radius: 50%;
}
.sub-nav__text-name {
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: 150%; /* 21px */
  color: #FFF;
  white-space: nowrap;
}
.sub-nav__text-email {
  font-size: 10px;
  font-style: normal;
  font-weight: 400;
  line-height: 150%; /* 15px */
  color: #FFF;
}
.sub-nav__text{
  color: #FFF;
  font-family: Open Sans;
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: 150%; /* 21px */
  margin-right: 60px;
}
.sub-nav__arrow{
  transform: rotate(180deg);
}
.sub-nav__list-item{
  display: none;
  flex-direction: column;
  justify-content: flex-start;
  align-items: stretch;
}
.sub-nav__item{
  display: flex;
  padding: 15px;
  align-items: center;
  justify-content: flex-start;
  background: rgba(50, 129, 255, 0.10);
}
.sub-nav__item+.sub-nav__item{
  margin-top: 1px;
}
.sub-nav__item:last-child{
  border-radius: 0px 0px 8px 8px;
}
.sub-nav__item-icon{
  margin-right: 10px;
}
.sub-nav__item-text{
  text-decoration: none;
  color: #78828E;
  font-family: Open Sans;
  font-size: 14px;
  line-height: 150%; /* 21px */
}
.sub-nav__item-text:hover{
  text-decoration: underline;
}

/* CONTENT ------------------------------------------ */
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
.content__text-block {
  display: flex;
  flex-direction: row;
  align-items: center;
}
.content__text-vector {
  display: flex;
  align-items: center;
  margin-right: 35px;
}
.content__text-url {
  font-size: 16px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 19.2px */
  color: var(--black-b-100, #171717);
}
.section__container{
  padding: 30px;
}
.section__title{
  font-family: Open Sans;
  font-size: 25px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 30px */
  margin-bottom: 30px;
}
.trainers__container{
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 10px;
}
@media screen and (max-width: 1500px) {
  .trainers__container{
    grid-template-columns: repeat(3, 1fr);
  }
}
@media screen and (max-width: 1200px) {
  .trainers__container{
    grid-template-columns: repeat(2, 1fr);
  }
}
@media screen and (max-width: 900px) {
  .trainers__container{
    grid-template-columns: repeat(1, 1fr);
  }
}
.trains-card{
  color: black;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  justify-content: space-between;
  height: 275px;
  border-radius: 12px;
  background: #FFF;
  box-shadow: 0px 1px 8px 0px rgba(0, 0, 0, 0.08);
}
.trains-card--memory .trains-card__icon{
  background-image: url('~@/assets/svg/card-memory.svg');
}
.trains-card--memory .trains-card__icon::before{
  background: #3281FF;
  box-shadow: 2px 0px 4px 0px rgba(0, 128, 252, 0.48);
}
.trains-card--mind .trains-card__icon{
  background-image: url('~@/assets/svg/card-mind.svg');
}
.trains-card--mind .trains-card__icon::before{
  fill: #009B72;
  filter: drop-shadow(2px 0px 4px rgba(0, 155, 114, 0.48));
}
.trains-card--attention .trains-card__icon{
  background-image: url('~@/assets/svg/card-attention.svg');
}
.trains-card--attention .trains-card__icon::before{
  border-radius: 0.1px 0px 0px 0px;
  background: #5243AA;
  box-shadow: 2px 0px 4px 0px rgba(82, 67, 170, 0.48);
}
.trains-card--speed .trains-card__icon{
  background-image: url('~@/assets/svg/card-speed.svg');
}
.trains-card--speed .trains-card__icon::before{
  border-radius: 0.1px 0px 0px 0px;
  background: #FF8A00;
  box-shadow: 2px 0px 4px 0px rgba(255, 138, 0, 0.48);
}
.trains-card__header{
  padding: 15px 25px 0 25px;
  display: grid;
  grid-template-columns: 60px 1fr;
  grid-template-areas:
  "a b"
  "a c";
}
.trains-card__icon{
  position: relative;
  margin-right: 20px;
  grid-area: a;
  width: 40px;
  height: 40px;
}
.trains-card__icon::before{
  content: "";
  position: absolute;
  top: 15%;
  left: -25px;
  width: 2px;
height: 30px;
border-radius: 0.1px 0px 0px 0px;
}
.trains-card__title{
  grid-area: b;
  font-family: Open Sans;
  font-size: 18px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 23.4px */
}
.trains-card__subtitle{
  grid-area: c;
  color: #696969;
  font-family: Open Sans;
  font-size: 12px;
  font-style: normal;
  font-weight: 500;
  line-height: 130%; /* 15.6px */
}
.trains-card__content{
  display: flex;
  justify-content: center;
  align-items: center;
}
.trains-card__footer{
  padding: 0 30px 15px 30px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}
.trains-card__footer * + *{
  margin-left: 20px;
}

/* =========== New classes ========== */
.content__header-left {
  display: none;
  flex-direction: row;
  align-items: center;
}
.content__header-right{
  display: flex;
  flex-direction: row;
  align-items: center;
}
.statistick__icon-box {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  background-color: #F4F5F7;
  border-radius: 50%;
  margin-left: 7px;
  cursor: pointer;
  display: none;
}
.statistick__icon {
}
.burger__btn {
  display: flex;
  align-items: center;
  margin-right: 15px;
}
.burger__logo {
  display: flex;
  align-items: center;
  margin-right: 15px;
}
.burger__logo--game{
  display: none;
}
.burger__logo-n {
}
.statistics__top-exit{
  display: none;
}
/* ======= burger-menu ====== */
.burger__menu {
  display: none;
}
/* =========== New classes-profile ========== */
.content__profile {
    flex: 1 0 auto;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    padding: 42px 32px;
    background: #EEE;
}
.profile__header{
    max-width: 1595px;
    height: 326px;
    border-radius: 16px;
    background: var(--white-w-100, #FFF);
    margin-bottom: 24px;
}
.profile__top {
    margin-bottom: 35px;
}
.profile__top-header {
    display: flex;
    flex-direction: column;
    margin: 0 auto;
    align-items: center;
}
.profile__top-header-img {
    margin-top: 29px;
    margin-bottom: 11px;
}
.profile__top-header-info {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.profile__top-header-nick {
    text-align: center;
    font-size: 22px;
    font-style: normal;
    font-weight: 700;
    line-height: 30px; /* 136.364% */
    letter-spacing: -0.4px;
    color: #171717;
}
.profile__top-header-mail {
    text-align: center;
    font-size: 15.224px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 22.837px */
    color: #8F92A1;
}
.profile__top-menu {
}
.profile__bottom {
    display: flex;
    flex-direction: row;
    justify-content: center;
}
.profile__bottom-profile {
    text-align: center;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 24px; /* 133.333% */
    letter-spacing: -0.2px;
    color: #171717;
    margin-right: 544px;
    position: relative;
    cursor: pointer;
}
.profile__bottom-profile::before, 
.profile__bottom-settings::before{
    content: "";
    display: block;
    position: absolute;
    bottom: -25px;
    left: 50%;
    transform: translateX(-50%);
    width: 602px;
    height: 5px;
    border-radius: 15px 15px 0px 0px;
    background: #D6D6D6;
}
.profile__bottom-profile.profile__bottom--active::before{
    background: #3281FF;
}
.profile__bottom-settings {
    text-align: center;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 24px; /* 133.333% */
    letter-spacing: -0.2px;
    color: #171717;
    position: relative;
    cursor: pointer;
}
/* .profile__bottom-settings::before{
    content: "";
    display: block;
    position: absolute;
    bottom: -25px;
    left: 50%;
    transform: translateX(-50%);
    width: 602px;
    height: 5px;
    border-radius: 15px 15px 0px 0px;
    background: #D6D6D6;
} */
.profile__bottom-settings.profile__bottom--active::before{
    background: #3281FF;
}
.profile__bottom--active{
    color:#3281FF;
}
/* ==== profile-footer ===== */
.profile__footer {
  max-width: 1595px;
}
.profile__footer-prof {
    display: flex;
    flex-direction: row;
    border-radius: 16px;
    background: #FFF;
    padding: 36px 56px;
}

.footer__prof-left {
    margin-right: 550px;
}
.footer__prof-pretitle {
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: 20px; /* 125% */
    letter-spacing: -0.4px;
    color: #B0B0B0;
    margin-bottom: 21px;
}
.footer__prof-ul {
}
.footer__prof-li {
    margin-bottom: 15px;
    display: grid;
    grid-template-columns: repeat(2, auto);
    grid-template-rows: repeat(2, auto);
    justify-content: flex-start;
    align-items: center;
}
.footer__prof-li:last-child {
    margin-bottom: 0px;
}
.footer__prof-svg {
    text-align: center;
    grid-row: span 2;
    width: 36px;
    height: 36px;
    margin-right: 17px;
}
.footer__prof-title {
    font-size: 12px;
    font-style: normal;
    font-weight: 500;
    line-height: 20px; /* 166.667% */
    letter-spacing: -0.2px;
    color: #8F92A1;
}
.footer__prof-subtitle {
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 24px; /* 171.429% */
    letter-spacing: -0.2px;
    color: #171717;
}
.footer__prof-right {
}
/* ===== set =====*/
.profile__footer-set {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    border-radius: 16px;
    background: #FFF;
    padding: 36px 56px;
}
.footer__set-left {
  margin-right: 15px;
}
.footer__set-date {
}
.footer__date-title {
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: 20px; /* 125% */
    letter-spacing: -0.4px;
    color: #B0B0B0;
    margin-bottom: 24px;
}
.footer__date-row {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  margin-bottom: 40px;
  width: 702px;
  height: 40px;
  border-radius: 8px;
  border: 1px solid #8F92A1;
}
.date__row-name{
  position: relative;
}
.date__row-name::after{
  content: "Имя";
  position: absolute;
  display: block;
  top: -13px;
  left: 8px;
  width: 35px;
  height: 20px;
  padding-left: 5px;
  background-color: #ffffff;
  font-size: 12px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px; /* 166.667% */
  letter-spacing: -0.2px;
  color: #8F92A1;
}
.date__row-email{
  position: relative;
}
.date__row-email::after{
  content: "E-mail";
  position: absolute;
  display: block;
  top: -13px;
  left: 8px;
  width: 45px;
  height: 20px;
  padding-left: 5px;
  background-color: #ffffff;
  font-size: 12px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px; /* 166.667% */
  letter-spacing: -0.2px;
  color: #8F92A1;
}
.date__row-cake{
  position: relative;
}
.date__row-cake::after{
  content: "День рождения";
  position: absolute;
  display: block;
  top: -13px;
  left: 8px;
  width: 100px;
  height: 20px;
  padding-left: 5px;
  background-color: #ffffff;
  font-size: 12px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px; /* 166.667% */
  letter-spacing: -0.2px;
  color: #8F92A1;
}
.date__row-newpass{
  position: relative;
}
.date__row-newpass::after{
  content: "Новый пароль";
  position: absolute;
  display: block;
  top: -13px;
  left: 8px;
  width: 95px;
  height: 20px;
  padding-left: 5px;
  background-color: #ffffff;
  font-size: 12px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px; /* 166.667% */
  letter-spacing: -0.2px;
  color: #8F92A1;
}
.date__row-newpass::before{
  content: "";
  position: absolute;
  display: block;
  top: 7px;
  right: 10px;
  width: 24px;
  height: 24px;
  background: url('~@/assets/svg/eye.svg') no-repeat;
  cursor: pointer;
}
.date__row-newpass--not::before{
  content: "";
  position: absolute;
  display: block;
  top: 7px;
  right: 10px;
  width: 24px;
  height: 24px;
  background: url('~@/assets/svg/eye-slash.svg') no-repeat;
  cursor: pointer;
}
.date__row-accpass{
  position: relative;
}
.date__row-accpass::after{
  content: "Подтверждение пароля";
  position: absolute;
  display: block;
  top: -13px;
  left: 8px;
  width: 150px;
  height: 20px;
  padding-left: 5px;
  background-color: #ffffff;
  font-size: 12px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px; /* 166.667% */
  letter-spacing: -0.2px;
  color: #8F92A1;
}
.date__row-accpass::before{
  content: "";
  position: absolute;
  display: block;
  top: 7px;
  right: 10px;
  width: 24px;
  height: 24px;
  background: url('~@/assets/svg/eye.svg') no-repeat;
  cursor: pointer;
}
.date__row-accpass--not::before{
  content: "";
  position: absolute;
  display: block;
  top: 7px;
  right: 10px;
  width: 24px;
  height: 24px;
  background: url('~@/assets/svg/eye-slash.svg') no-repeat;
  cursor: pointer;
}
.footer__date-row {
  display: flex;
  flex-direction: row;
  align-items: center;
}
.footer-name{
  border: 0;
  width: 670px;
  height: 35px;
  padding-left:35px;
  margin-left: 15px;
  background-color: transparent;
  background: url('~@/assets/svg/footer-name-gray.svg') no-repeat left;
  background-repeat: no-repeat;
  outline: none;
  color: #171717;
  text-align: left;
  border: 0;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 24px; /* 171.429% */
  letter-spacing: -0.2px; 
}
.footer-email{
  border: 0;
  width: 670px;
  height: 35px;
  padding-left:35px;
  margin-left: 15px;
  background-color: transparent;
  background: url('~@/assets/svg/footer-email.svg') no-repeat left;
  background-repeat: no-repeat;
  outline: none;
  color: #171717;
  text-align: left;
  border: 0;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 24px; /* 171.429% */
  letter-spacing: -0.2px; 
}
.footer-cake{
  border: 0;
  width: 670px;
  height: 35px;
  padding-left:35px;
  margin-left: 15px;
  background-color: transparent;
  background: url('~@/assets/svg/footer-cake-grat.svg') no-repeat left;
  background-repeat: no-repeat;
  outline: none;
  color: #171717;
  text-align: left;
  border: 0;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 24px; /* 171.429% */
  letter-spacing: -0.2px; 
}
.footer__newpass-space{
  width: 40px;
  height: 20px;
  z-index: 50;
  cursor: pointer;
}
.footer__pass-space{
  width: 40px;
  height: 20px;
  z-index: 50;
  cursor: pointer;
}
.footer-pass{
  border: 0;
  width: 630px;
  height: 35px;
  padding-left:35px;
  margin-left: 15px;
  background-color: transparent;
  background: url('~@/assets/svg/footer-password.svg') no-repeat left;
  background-repeat: no-repeat;
  outline: none;
  color: #171717;
  text-align: left;
  border: 0;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 24px; /* 171.429% */
  letter-spacing: -0.2px; 
}
.footer__set-setting {
  margin-bottom: 19px;
}
.footer__set-wrapper{
  display: flex;
  flex-direction: row;
  align-items: center;
}
.footer__set-text {
    font-size: 14px;
    font-style: normal;
    font-weight: 500;
    line-height: 20px; /* 142.857% */
    letter-spacing: -0.4px;
    color: #000;
    margin-right: 20px;
}
.footer__set-btnbox {
  display: flex;
  flex-direction: row;
  align-items: center;
}
.footer__set-btn {
  width: 40px;
  height: 20px;
  border-radius: 25px;
  background: #8F92A1;
  cursor: pointer;
}
.footer__set-btn--active {
  width: 40px;
  height: 20px;
  border-radius: 25px;
  background: #3281FF;
  cursor: pointer;
  transition: all .3s;
}
.footer__set-btn:first-child {
  margin-right: 14px;
}
.footer__set-slyde{

}
.footer__btn-one{
  position: relative;
  transition: all .3s;
}
.footer__btn-two{
  position: relative;
  transition: all .3s;
}
.footer__slyde-one::after{
  content: "";
  position: absolute;
  width: 6px;
  height: 10px;
  background-color: #FFFFFF;
  top: 5px;
  left: 5px;
  border-radius: 20px;
  transition: all .3s;
}
.footer__slyde-two::after{
  content: "";
  position: absolute;
  width: 6px;
  height: 10px;
  background-color: #FFFFFF;
  top: 5px;
  left: 5px;
  border-radius: 20px;
  transition: all .3s;
}
.footer__slyde-one--active::after{
  content: "";
  position: absolute;
  width: 6px;
  height: 10px;
  background-color: #FFFFFF;
  top: 5px;
  left: 28px;
  border-radius: 20px;
  transition: all .3s;
}
.footer__slyde-two--active::after{
  content: "";
  position: absolute;
  width: 6px;
  height: 10px;
  background-color: #FFFFFF;
  top: 5px;
  left: 28px;
  border-radius: 20px;
  transition: all .3s;
}
.footer__setleft-btnbox {
  display: flex;
  align-items: center;
}
.footer__setleft-btnbox--mob{
  display: none;
}
.footer__setleft-btn {
  padding: 16px 39px;
  border-radius: 8px;
  background: #3281FF;
  text-align: center;
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: 20px; /* 142.857% */
  letter-spacing: -0.2px;
  color: #FFF;
  cursor: pointer;
}
.footer__set-right {
  margin-right: 64px;
}
.footer__set-avatbox {
  display: grid;
  grid-template-columns: repeat(2, auto);
  grid-template-rows: repeat(2, auto);
  align-items: center;
  justify-content: flex-start;
}
.footer__avat-img {
  grid-row: span 2;
  border-radius: 50%;
  margin-right: 28px;
}
.footer__avat-img img {
  border-radius: 50%;
}
.footer__avat-btnbox {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  background: #3281FF;
  width: 353px;
  height: 53px;
  cursor: pointer;
}
.footer__avat-btnsvg {
  margin-right: 15px;
}
.footer__avat-btn {
  text-align: center;
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: 20px; /* 142.857% */
  letter-spacing: -0.2px;
  color: #FFF;
}
.footer__avat-subtext {
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px; /* 125% */
  letter-spacing: -0.4px;
  color: #B0B0B0;
  margin-top: -30px;
}
.profile__footer--hide{
  display: none;
}
/* =========== FOOTER =========== */
/* =========== FOOTER =========== */
.wrapper{
  min-height: 100%;
  width: 100%;
  overflow: hidden;
}
.footer {
  background: #3281FF;
  padding: 68px 15px;
  display: flex;
  width: 100%;
  justify-content: center;
}
.footer__wrapper{
  max-width: 1440px;
  display: flex;
  flex-direction: row;
}
.footer__left {
  display: flex;
  flex-direction: column;
  margin-right: 15px;
}
.footer__left-ico {
  margin-bottom: 31px;
}
.footer__left-text {
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
  color: #FFF;
  margin-bottom: 31px;
}
.footer__left-socials {
  margin-bottom: 31px;
  display: flex;
  flex-direction: row;
  align-items: center;
}
.footer__left-social {
  margin-right: 15px;
  cursor: pointer;
}
.footer__left-social:last-child {
  margin-right: 0px;
}
.footer__left-copyright {
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  color: #FFF;
}
.footer__right {
  display: flex;
  flex-direction: column;
}
.footer__right-top {
  display: grid;
  grid-template-columns: repeat(3, auto);
  grid-template-rows: repeat(auto, auto);
  column-gap: 80px;
  margin-bottom: 70px;
}
.footer__right-ul {
}
.footer__right-title {
  font-size: 16.028px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-transform: uppercase;
  color: #FFF;
  margin-bottom: 9px;
}
.footer__right-li {
  display: flex;
  flex-direction: row;
  align-items: center;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
  text-decoration-line: underline;
  color: #FFF;
  margin-bottom: 19px;
  cursor: pointer;
}
.footer__right-li:last-child{
  margin-bottom: 0;
}
.footer__right-svg {
  margin-right: 5px;
}
.footer__right-mail {
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
  color: #FFF;
}
.footer__right-bottom {
  display: flex;
  flex-direction: row;
  align-items: center;
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  color: #FFF;
}
.footer__right-bottext {
  white-space: nowrap;
  cursor: pointer;
}
.footer__right-line {
  margin: 0 35px;
}


/* ================================ BREAK-POINTS =========================== */
/* ================================ BREAK-POINTS =========================== */
/* ================================== 1700 ================================ */
@media (max-width: 1700px) {
  /* ====== profile__footer ===== */
  .footer__date-row {
    width: 542px;
  }
  .footer__set-right{
    margin-right: 15px;
  }
  .footer__date-row input{
    width: 470px;
  }




}
/* ================================== 1600 ================================ */
@media (max-width: 1600px) {
    .profile__bottom-profile::before, 
    .profile__bottom-settings::before{
        width: 502px;
    }
    .footer__prof-left{
        margin-right: 450px;
    }
}
/* ================================== 1500 ================================ */
@media (max-width: 1500px) {
    .profile__bottom-profile::before, 
    .profile__bottom-settings::before{
        width: 402px;
    }
    .profile__bottom-profile {
        margin-right: 444px;
    }
  .statistics{
    width: 50%;
  }
  .statistics__result-date {
    margin-right: 30px;
  }
  .score{
    margin-right: 60px;
  }
  .ratio{
    margin-right: 80px;  
  }
  .statistics__top-mr:first-child{
    margin-right: 35px;
  }
  .statistics__top-mr{
    margin-right: 25px;
  }
  .footer__prof-left{
    margin-right: 350px;
  }
    /* ====== profile__footer ===== */
    .footer__date-row {
      width: 442px;
    }
    .footer__set-right{
      margin-right: 15px;
    }
    .footer__date-row input{
      width: 370px;
    }
    .footer__avat-btnbox {
      width: 300px;
  }


  
}
/* ================================== 1400 ================================ */
@media (max-width: 1400px) {
  /* ====== profile__footer ===== */
  .profile__footer-set{
    flex-direction: column;
  }
  .footer__date-row {
    width: 702px;
  }
  .footer__date-row input{
    width: 670px;
  }
  .footer__set-left{
    margin-bottom: 40px;
  }

}
/* ================================== 1300 ================================ */
@media (max-width: 1300px) {
    .profile__bottom-profile::before, 
    .profile__bottom-settings::before{
        width: 302px;
    }
    .profile__bottom-profile {
        margin-right: 244px;
    }
  .statistick__icon-box{
    display: flex;
  }
  .statistics{
    transform: translateX(100%);
    z-index: 100;
    top: 0;
    right: 0;
    position: fixed;
    height: 100%;
    background-color: #fff;
    transition: all .3s;
    overflow-y: scroll;
  }
  .statistics--show{
    transform: translateX(0%);
    z-index: 100;
    top: 0;
    right: 0;
    position: fixed;
    height: 100%;
    background-color: #fff;
    transition: all .3s;
    overflow-y: scroll;
  }
  .statistics__top{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    background: #F7F7F7;
    margin-bottom: 14px;
  }
  .statistics__title-box{
    padding: 20px;
    background: #F7F7F7;
    margin-bottom: 13px;
    margin-top: 14px;
  }
  .statistics__top-exit{
    display: flex;
  }
  .statistics__text, .statistics__title{
    color: #0A0E1A;
  }
  .footer__prof-left{
    margin-right: 250px;
}
}
/* ================================== 1200 ================================ */
@media (max-width: 1200px) {
    .footer__prof-left{
        margin-right: 150px;
    }
}
/* ================================== 1100 ================================ */
@media (max-width: 1100px) {
    .profile__footer-prof{
        justify-content: space-between;
    }
    .footer__prof-left{
        margin-right: 20px;
    }
  /* ====== profile__footer ===== */
  .profile__footer-set{
    flex-direction: column;
  }
  .footer__date-row {
    width: 502px;
  }
  .footer__date-row input{
    width: 470px;
  }
}
/* ================================== 1000 ================================ */
@media (max-width: 1000px) {
    .profile__bottom-profile::before, 
    .profile__bottom-settings::before{
        width: 202px;
    }
    .profile__bottom-profile {
        margin-right: 144px;
    }
}
/* ================================== 950 ================================ */
@media (max-width: 950px) {
  /* ====== profile__footer ===== */
  .profile__footer-set{
    flex-direction: column;
  }
  .footer__date-row {
    width: 402px;
  }
  .footer__date-row input{
    width: 370px;
  }
  .footer__set-avatbox{
    grid-template-columns: repeat(1, auto);
    grid-template-rows: repeat(2, auto);
  }
  .footer__avat-img{
    margin-bottom: 20px;
  }
  .footer__avat-subtext{
    margin-top: 20px;
  }
}
/* ================================== 900 ================================ */
@media (max-width: 900px) {
.statistics{
  width: 100%;
}
}
/* ================================== 800 ================================ */
@media (max-width: 800px) {
  .overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 50;
    background: rgba(0, 0, 0, 0.349);
    visibility: hidden;
    opacity: 0;
    transition: all .3s;
  }
  .overlay--show {
    visibility: visible;
    opacity: 1;
  }
  .content__header{
    padding: 14px 30px;
  }
  .content__header-left {
    display: flex;
  }
  .sidebar{
    display: none;
  }
  .notifications--hide{
    display: none;
  }
  .content__section{
    background: #EEE;;
  }
  /* ===== burger-menu ===== */
  .burger__menu {
    display: flex;
    flex-direction: column;
    transform: translateX(-100%);
    z-index: 100;
    height: 100vh;
    top: 0;
    left: 0;
    position: fixed;
    background-color: #fff;
    transition: all .3s;
  }
  .burger__menu--active {
    position: fixed;
    top: 0;
    left: 0;
    background-color: #fff;
    z-index: 100;
    min-width: 228px;
    height: 100%;
    transform: translateX(0%);
    transition: all .3s;
  }
  .burger__menu-inner{
    display: flex;
    flex-direction: column;
    min-width: 228px;
    z-index: 100;
  }
  .burger__menu-profile {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    background: #3281FF;
  }
  .burger__profile-left {
    display: grid;
    grid-template-columns: repeat(2, auto);
    grid-template-rows: repeat(2, auto);
    padding: 9px 0;
  }
  .burger__profile-img {
    grid-row: span 2;
    margin-left: 14px;
    margin-right: 6px;
  }
  .burger__profile-img img {
    border-radius: 50%;
  }
  .burger__profile-nickname {
    color: #FFF;
    font-size: 14px;
    font-weight: 700;
    line-height: 150%; /* 21px */
  }
  .burger__profile-mail {
    font-size: 10px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 15px */
    color: #FFF;
  }
  .burger__profile-right {
  }
  .burger__profile-slide {
    margin-right: 14px;
  }
  .burger__menu-ul {
    margin-bottom: 16px;
    background: #fff;
  }
  .burger__menu-ul:last-child {
    margin-bottom: 0px;
  }
  .burger__menu-li {
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 14px 20px;
  }
  .burger__menu-svg {
    max-width: 25px;
    width: 100%;
    margin-top: 5px;
    margin-right: 11px;
  }
  .burger__menu-text { 
    color: #78828E;
    font-size: 14px;
    font-weight: 700;
    line-height: 150%; /* 21px */
  }
  .burger__menu-text--active{
    color: #3281FF;
  }
    /* ====== profile__footer ===== */
    .profile__footer-set{
      flex-direction: column;
    }
    .footer__date-row {
      width: 402px;
    }
    .footer__date-row input{
      width: 370px;
    }
    .footer__set-avatbox{
      grid-template-columns: repeat(2, auto);
      grid-template-rows: repeat(2, auto);
    }
    .footer__avat-img{
      margin-bottom: 0px;
    }
    .footer__avat-subtext{
      margin-top: -40px;
    }
    .footer__set-right{
      margin-right: 0;
    }
    .content__profile{
      padding: 0px;
    }
    .profile__header, .profile__footer-prof, .profile__footer-set{
      border-radius: 0;
    }
    .footer__set-left{
      margin-right: 0;
    }
}
/* ================================== 600 ================================ */
@media (max-width: 600px) {
/* ====== trainer-game ====== */
.content__text-vector{
  margin-right: 10px;
}
.game__container{
  padding: 0px;
}
.window__header-top{
  border-radius: 0;
}
.window__header-info img{
  margin-right: 5px;
}
.window__header-down .trains-card__header {
  padding-top: 0;
  margin-left: -10px;
}
  /* ====== profile__footer ===== */
  .profile__footer-prof{
    flex-direction: column;
  }
  .footer__prof-left{
    margin-bottom: 25px;
  }
  .profile__footer-set{
    flex-direction: column;
  }
  .footer__date-row {
    width: 302px;
  }
  .footer__date-row input{
    width: 270px;
  }
  .footer__set-avatbox{
    grid-template-columns: repeat(2, auto);
    grid-template-rows: repeat(2, auto);
  }
  .footer__avat-img{
    margin-bottom: 0px;
  }
  .footer__avat-subtext{
    margin-top: 20px;
  }
  .footer__setleft-btnbox--mob{
    display: none;
    display: flex;
    align-items: center;
    margin: 40px 0px;
    width: 100%;
  }
  .footer__setleft-btn{
    width: 100%;
  }
  .profile__footer-prof, .profile__footer-set{
    padding: 15px 20px;
  }
  .footer__date-row {
    width: 402px;
  }
  .footer__date-row input{
    width: 370px;
  }
  .footer__avat-img{
    margin-right: 22px;
  }
  .footer__avat-img img{
    width: 72px;
    height: 72px;
  }
}
/* ================================== 500 ================================ */
@media (max-width: 500px) {
  .content__greeting{
    font-size: 16px;
  }
  .burger__logo-n{
    width: 90px;
    height: 38px;
  }
  .content__header{
    padding: 10px 20px;
  }
  .content__text-url{
    font-size: 14px !important;
    margin-right: 15px;
  }
  .profile__bottom-profile::before, 
  .profile__bottom-settings::before{
      width: 154px;
  }
  .profile__bottom-profile {
      margin-right: 100px;
  }
  .footer__date-row {
    width: 342px;
  }
}
/* ================================== 450 ================================ */
@media (max-width: 450px) {
  .window__header-info p{
    font-size: 12px;
  }
  .window__header-info img {
    width: 18px;
    height: 18px;
  }
  .window__header-down{
    flex-direction: column;
    padding: 15px 30px;
  }
  .trains-card__header{
    margin-bottom: 15px;
  }
  .window__header-profit-list{
    margin-left: 15px;
  }
  .window__start-button{
    width: 350px;
  }
  .statistics__result-top {
    padding: 12px 17px;
    margin-bottom: 14px;
  }
  .statistics__result-row{
    padding: 12px 17px;
  }
  .stat__top-h{
    display: flex;
  }
  .stat__top-sh{
    display: none;
  }
  .result-date-h{
    display: flex;
  }
  .result-date{
    display: none;
  }
  .statistics__result-date{
    margin-left: 0; 
  }
  .score {
    margin-right: 40px;
  }
  .ratio {
    margin-right: 60px;
  }
  .statistics__top-mr {
    margin-right: 35px;
  }
  .footer__avat-btnbox{
    width: 100%;
    padding: 0px 17px;
  }
  .footer__avat-btn{
    font-size: 12px;
  }
  .footer__avat-btnsvg{
    display: none;
  }
  .footer__avat-subtext{
    font-size: 12px;
  }
  .profile__bottom-profile{
    margin-right: 80px;
  }
.profile__bottom-profile::before, 
.profile__bottom-settings::before{
    /* width: 602px; */
    height: 3px;
  }
  .burger__btn{
    margin-right: 5px !important;
  }
}
/* ================================== 400 ================================ */
@media (max-width: 400px) {
  .content__greeting{
    font-size: 14px;
  }
  .burger__logo-n{
    width: 75px;
    height: 26px;
  }

}
/* ================================== 360 ================================ */
@media (max-width: 360px) {


}

</style>