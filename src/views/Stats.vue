<template>
    <section class="content">
        <ContentHeader />
        <div class="not" v-if="!this.updata">
            Чтобы смотреть статистику - войдите в аккаунт!
        </div>
        <div class="content__section section" v-if="this.updata">
            <div class="section__container">
                <h1 class="section__title">Статистика</h1>

                <div class="content__wrapper">
                    <div class="content__container">
                        <div class="content__items">
                        <div class="content__item">
                            <div class="items__memory-title">
                            <div class="items__memory-svg">
                                <img src="@/assets/svg/item-1.svg" alt="">
                            </div>
                            <div class="items__memory-text">Очки</div>
                            </div>
                            <div class="items__memory-subtitle">{{this.updataDop.scores ?? 0}}</div>
                        </div>
                        <div class="content__item">
                            <div class="items__memory-title">
                            <div class="items__memory-svg">
                                <img src="@/assets/svg/item-2.svg" alt="">
                            </div>
                            <div class="items__memory-text">Правильных ответов %</div>
                            </div>
                            <div class="items__memory-subtitle">{{Math.floor(this.updataDop.prTrue ?? 0)}}%</div>
                        </div>
                        <div class="content__item">
                            <div class="items__memory-title">
                            <div class="items__memory-svg">
                                <img src="@/assets/svg/item-3.svg" alt="">
                            </div>
                            <div class="items__memory-text">Неправильных ответов %</div>
                            </div>
                            <div class="items__memory-subtitle">{{Math.floor(this.updataDop.preFalse ?? 0)}}% </div>
                        </div>
                        <div class="content__item">
                            <div class="items__memory-title">
                            <div class="items__memory-svg">
                                <img src="@/assets/svg/item-4.svg" alt="">
                            </div>
                            <div class="items__memory-text">Всего тренировок</div>
                            </div>
                            <div class="items__memory-subtitle">{{this.updataDop.countGames ?? 0}}</div>
                        </div>
                        </div>
                        <div class="content__trainer">
                        <div class="trainer__top">
                            <div class="trainer__title">Тренажеры</div>
                            <div class="trainer__subtitle">Показатели по каждому тренажеру.</div>
                        </div>
                        <div class="trainer__bottom">
                            <div class="trainer__table">
                                <div class="trainer__main-table">
                                    <div class="trainer__table-item main-table-1">Дата / <br> Время</div>
                                    <div class="trainer__table-item main-table-2">Очки</div>
                                    <div class="trainer__table-item main-table-3"><span class="text__win">Коэффициент <br> сложности </span><span class="text__mob">Коэфф. <br> сложности.</span></div>
                                    <div class="trainer__table-item"><span class="text__win">Правильных /<br> Неправильных</span><span class="text__mob">+/-</span></div>
                                </div>
                                <div class="trainer__table-items" v-for="(item, index) in this.lowdata" :key="index">
                                    <div class="trainer__table-item table-item-1">{{ getDate(item.date_end, 1) }} <br> {{ getDate(item.date_end, 2) }}</div>
                                    <div class="trainer__table-item table-item-2">{{item.scores}}</div>
                                    <div class="trainer__table-item table-item-3">{{item.difficulty}}</div>
                                    <div class="trainer__table-item"><span class="green">{{item.true_clicks}}</span> / <span class="red">{{item.false_clicks}}</span></div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

				<div class="content__wrapper" v-if="this.updata.role == 2">
					<div class="content__container">
						<h1 class="section__title">Админ статистика</h1>

						<AdminStats />
					</div>
				</div>

            </div>
        </div>
    </section>
</template>

<script>
import AdminStats from '../components/AdminStats.vue';
import ContentHeader from '../components/ContentHeader.vue'
import userService from '../services/user';
import {useAuthStore} from '../store/auth';
import $ from 'jquery';

export default {
    name: "Stats",
    components: {
    ContentHeader,
    AdminStats
},
    data() {
        return {
            updata: null,
            updataDop: null,
            lowdata: null
        }
    },
    mounted() {
        const auth = useAuthStore();

        userService.getUserInfo(auth.token).then(res => {
            this.updata = res.data.dataProfile[0];
            this.updataDop = res.data.dataProfileDop[0];
            this.lowdata = res.data.dataStats;
        })

        $('.overlay').removeClass('overlay--show');
        $('.burger__menu').removeClass(' burger__menu--active')
    },
    methods: {
      getDate(item, id) {
        const date = new Date(item * 1000);
        const dateString = date.toLocaleDateString();
        const timeString = date.toLocaleTimeString();

        if(id == 1) return dateString
        if(id == 2) return timeString
       }
    }
}
</script>

<style scoped>
.not {
    display: flex;
    margin: 50px 0;
    align-items: center;
    justify-content: center;
    font-size: 28px
}
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
  background-color: #eee;
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
  justify-self: start;
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
/* ======= STAT ====== */
.content__wrapper{
  flex: 1 0 auto;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
}
.content__container{
  width: 100%;
  height: 100%;
  padding: 32px 0;
  background: #EEE;
}

/* ====== content-items ======= */
.content__items {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 32px;
}
.content__item{
  display: flex;
  flex-direction: column;
  align-items: center;
  background: #fff;
  max-width: 360px;
  height: 220px;
  width: 100%;
  padding: 46px 15px;
  border-radius: 16px;
  margin-right: 15px;
}
.content__item:last-child{
  margin-right: 0px;
}
.items__memory-title {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.items__memory-svg {
  margin-bottom: 10px;
}
.items__memory-text {
  font-size: 22.131px;
  font-style: normal;
  font-weight: 700;
  line-height: 29.508px; /* 133.333% */
  letter-spacing: -0.246px;
  color: #171717;
  white-space: nowrap;
}
.items__memory-subtitle {
  text-align: center;
  font-size: 54.098px;
  font-style: normal;
  font-weight: 700;
  line-height: 72.787px; /* 134.545% */
  letter-spacing: -0.607px;
  color: #171717;
}
/* ====== content-chart ======= */
.content__chart {
  display: flex;
  flex-direction: column;
  background: #FFF;
  padding: 28px 64px;
  border-radius: 16px;
  margin-bottom: 35px;
}
.chart__top {
  margin-bottom: 12px;
}
.chart__top-above {
  display: flex;
  flex-direction: row;
  align-items: center;
}
.chart__top-svg {
  margin-right: 12px;
}
.chart__top-title {
  text-align: center;
  font-size: 22.131px;
  font-style: normal;
  font-weight: 700;
  line-height: 29.508px; /* 133.333% */
  letter-spacing: -0.246px;
  color: #171717;
}
.chart__top-subtitle {
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px; /* 125% */
  letter-spacing: -0.4px;
  color: #636363;
}
.chart__top-subtitle br{
  display: none;
}
.chart__top-subtitle span{
  font-weight: 700;
}
.chart__img {
  width: 1500px;
  margin-left: -64px;
}
.chart__img-2{
  display: none;
}
.chart__img img{
  width: 100%;
  height: 100%;
  object-fit: contain;
}
.chart__bottom {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
}
.chart__bottom-item {
  display: flex;
  flex-direction: row;
  align-items: center;
  margin-right: 58px;
}
.chart__bottom-item:last-child {
  margin-right: 0px;
}
.chart__bottom-circle {
  margin-right: 18px;
}
.chart__bottom-text {
}
/* ====== content-trainer ======= */
.content__trainer {
  display: flex;
  flex-direction: column;
  background: #FFF;
  padding: 28px 64px;
  border-radius: 16px;
  margin-bottom: 35px;
}
.trainer__top {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-bottom: 14px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px; /* 125% */
  letter-spacing: -0.4px;
}
.trainer__title {
  text-align: center;
  font-size: 22.131px;
  font-style: normal;
  font-weight: 700;
  line-height: 29.508px; /* 133.333% */
  letter-spacing: -0.246px;
  color: #171717;
  margin-bottom: 13px;
}
.trainer__subtitle {
  font-size: 16px;
  color: #636363;
  margin-bottom: 13px;
}
.trainer__text {
  font-size: 16px;
  color: #B8B8B8;
}
.trainer__text br{
  display: none;
}
.trainer__bottom {
}
.trainer__input-box {
  border-radius: 8px;
  border: 1px solid var(--Stock, #F3F3F3);
  margin-bottom: 14px;
}
.trainer__input {
  border: 0;
  width: 100%;
  height: 35px;
  padding: 13px 15px 11px;
  padding-left:35px;
  margin-left: 15px;
  background-color: transparent;
  background: url('~@/assets/svg/search-normal.svg') no-repeat left;
  background-repeat: no-repeat;
  outline: none;
  text-align: left;
  border: 0;
  color: #78828E;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 150%; /* 24px */
}
.trainer__table {
  display: flex;
  flex-direction: column;
}
.trainer__main-table {
  display: flex;
  flex-direction: row;
  align-items: center;
  border-radius: 8px;
  background: #F3F9FF;
  padding: 16px 100px 13px;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 150%; /* 21px */
  color: #0A0E1A;
  margin-bottom: 14px;
}
.trainer__table-items {
  display: flex;
  flex-direction: row;
  align-items: center;
  border-radius: 8px;
  border: 1px solid var(--foundation-blue-b-20, #F5F6F7);
  margin-bottom: 14px;
  text-align: center;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 150%; /* 21px */
  color: #0A0E1A;
  padding: 14px 85px 15px;
  cursor: pointer;
  transition: all .3s;
}
.trainer__table-items:hover{
  background: #F3F3F3;
  transition: all .3s;
}
.trainer__table-item {
  max-width: 250px;
}
.trainer__table-item br{
  display: none;
}
.text__mob{
  display: none;
}
.main-table-1{
  margin-right: 220px;
}
.main-table-2{
  margin-right: 250px;
}
.main-table-3{
  margin-right: 250px;
}
.table-item-1{
  margin-right: 220px;
}
.table-item-2{
  margin-right: 330px;
}
.table-item-3{
  margin-right: 410px;
}
.red {
  color: #B40000;
  font-weight: 700;
}
.green {
  color: #138600;
  font-weight: 700;
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
/* ================================== 1900 ================================ */
@media (max-width: 1900px) {
/* === chart ===== */
.chart__img{
  width: 1300px;
}
.chart__img img{
  width: 1300px;
}
/* ===== trainer ====== */
.main-table-1{
  margin-right: 180px;
}
.main-table-2{
  margin-right: 210px;
}
.main-table-3{
  margin-right: 210px;
}
.table-item-1{
  margin-right: 180px;
}
.table-item-2{
  margin-right: 290px;
}
.table-item-3{
  margin-right: 370px;
}

}
/* ================================== 1800 ================================ */
@media (max-width: 1800px) {
/* ===== trainer ====== */
.main-table-1{
  margin-right: 140px;
}
.main-table-2{
  margin-right: 170px;
}
.main-table-3{
  margin-right: 170px;
}
.table-item-1{
  margin-right: 140px;
}
.table-item-2{
  margin-right: 250px;
}
.table-item-3{
  margin-right: 330px;
}


}
/* ================================== 1700 ================================ */
@media (max-width: 1700px) {
/* === chart ===== */
.chart__img{
  width: 1200px;
}
.chart__img img{
  width: 1200px;
}
/* ===== trainer ====== */
.main-table-1{
  margin-right: 140px;
}
.main-table-2{
  margin-right: 150px;
}
.main-table-3{
  margin-right: 160px;
}
.table-item-1{
  margin-right: 120px;
}
.table-item-2{
  margin-right: 180px;
}
.table-item-3{
  margin-right: 240px;
}


}
/* ================================== 1600 ================================ */
@media (max-width: 1600px) {
/* === chart ===== */
.chart__img{
  width: 1100px;
}
.chart__img img{
  width: 1100px;
}
/* ===== trainer ====== */
.main-table-1{
  margin-right: 140px;
}
.main-table-2{
  margin-right: 150px;
}
.main-table-3{
  margin-right: 160px;
}
.table-item-1{
  margin-right: 120px;
}
.table-item-2{
  margin-right: 180px;
}
.table-item-3{
  margin-right: 240px;
}
.trainer__table-items{
  padding: 14px 100px 15px;
}
.trainer__table-item br{
  display: block;
}

}
/* ================================== 1500 ================================ */
@media (max-width: 1500px) {
/* === chart ===== */
.chart__img{
  width: 900px;
}
.chart__img img{
  width: 900px;
}
/* ===== trainer ====== */
.main-table-1{
  margin-right: 140px;
}
.main-table-2{
  margin-right: 150px;
}
.main-table-3{
  margin-right: 160px;
}
.table-item-1{
  margin-right: 120px;
}
.table-item-2{
  margin-right: 180px;
}
.table-item-3{
  margin-right: 240px;
}


}
/* ================================== 1400 ================================ */
@media (max-width: 1400px) {
  /* === items ===== */
.content__items{
  flex-direction: column;
}
.content__item{
  max-width: 100%;
  width: 100%;
  margin-bottom: 15px;
  margin-right: 0;
}
/* ===== trainer ====== */
.main-table-1{
  margin-right: 100px;
}
.main-table-2{
  margin-right: 110px;
}
.main-table-3{
  margin-right: 120px;
}
.table-item-1{
  margin-right: 80px;
}
.table-item-2{
  margin-right: 140px;
}
.table-item-3{
  margin-right: 200px;
}

}
/* ================================== 1300 ================================ */
@media (max-width: 1300px) {
/* === chart ===== */
.chart__img{
  width: 800px;
}
.chart__img img{
  width: 800px;
}
.chart__bottom-item{
  margin-right: 15px;
}
  /* ===== trainer ====== */
.trainer__main-table, .trainer__table-items{
  padding-left: 50px;
  padding-right: 50px;
}

}
/* ================================== 1200 ================================ */
@media (max-width: 1200px) {
    .footer__prof-left{
        margin-right: 150px;
    }
/* === chart ===== */
.content__chart{
  padding: 0;
  background: none;
}
.chart__img-1{
  display: none;
}
.chart__img-2{
  display: flex;
  margin: 0 auto;
  background: #fff;
}
.chart__bottom{
  display: none;
}
  /* ===== trainer ====== */
  .trainer__main-table, .trainer__table-items{
    padding-left: 25px;
    padding-right: 25px;
  }

}
/* ================================== 1100 ================================ */
@media (max-width: 1100px) {
  /* === chart ===== */
.chart__img-2 {
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin: 0;
  border-radius: 16px;
}
.chart__img-2 img{
  width: 600px;
}
  /* ===== trainer ====== */
  .content__trainer{
    padding: 0px;
    background: none;
  }
  .trainer__bottom{
    background: #fff;
    border-radius: 16px;
    padding: 17px 7px 13px;
  }
  .trainer__main-table, .trainer__table-items{
    padding-left: 20px;
    padding-right: 20px;
  }
  .main-table-1{
    margin-right:80px;
  }
  .main-table-2{
    margin-right: 90px;
  }
  .main-table-3{
    margin-right: 80px;
  }
  .table-item-1{
    margin-right: 60px;
  }
  .table-item-2{
    margin-right: 100px;
  }
  .table-item-3{
    margin-right: 180px;
  }
}
/* ================================== 1000 ================================ */
@media (max-width: 1000px) {
      /* ===== trainer ====== */
  .trainer__main-table, .trainer__table-items{
    padding-left: 15px;
    padding-right: 15px;
  }
  .trainer__text br{
    display: block;
  }
  .main-table-1{
    margin-right:60px;
  }
  .main-table-2{
    margin-right: 50px;
  }
  .main-table-3{
    margin-right: 40px;
  }
  .table-item-1{
    margin-right: 50px;
  }
  .table-item-2{
    margin-right: 60px;
  }
  .table-item-3{
    margin-right: 140px;
  }
}
/* ================================== 950 ================================ */
@media (max-width: 950px) {
}
/* ================================== 900 ================================ */
@media (max-width: 900px) {
    /* === chart ===== */
.chart__img-2 img{
  width: 400px;
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
}
/* ================================== 700 ================================ */
@media (max-width: 700px) {


}
/* ================================== 600 ================================ */
@media (max-width: 600px) {
  .content__container{
    padding: 0;
  }
  .content__text-vector{
    margin-right: 5px;
  }
  .chart__img-2 img{
    width: 320px;
  }
  .chart__top-title{
    margin-bottom: 10px;
  }
  .chart__top-subtitle br{
    display: block;
  }
  /* ===== trainer ====== */
  .trainer__main-table, .trainer__table-items{
    font-size: 12px;
  }
  .trainer__text br{
    display: block;
  }
  .main-table-1{
    margin-right:0;
  }
  .main-table-2{
    margin-right: 0;
  }
  .main-table-3{
    margin-right: 0;
  }
  .table-item-1{
    margin-right: 0;
  }
  .table-item-2{
    margin-right: 0;
  }
  .table-item-3{
    margin-right: 0;
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
  /* ===== trainer ====== */
  .text__win{
    display: none;
  }
  .text__mob{
    display: flex;
  }
  .trainer__main-table, .trainer__table-items{
    padding-left: 12px;
    padding-right: 12px;
  }
  .trainer__text br{
    display: block;
  }
  .main-table-1{
    margin-right:0;
  }
  .main-table-2{
    margin-right: 0;
  }
  .main-table-3{
    margin-right: 0;
  }
  .table-item-1{
    margin-right: 0;
  }
  .table-item-2{
    margin-right: 0;
  }
  .table-item-3{
    margin-right: 0;
  }
}
/* ================================== 450 ================================ */
@media (max-width: 450px) {
  .content{
    flex: auto;
    max-width: 100%;
  }
  .section__container{
    padding: 10px
  }
  .burger__btn{
    margin-right: 5px !important;
  }
    /* ===== trainer ====== */
    .main-table-1{
      margin-left: 15px;
      margin-right: 45px;
    }
    .main-table-2{
      margin-right: 40px;
    }
    .main-table-3{
      margin-right: 50px;
    }
    .table-item-1{
      margin-right: 0;
    }
    .table-item-2{
      margin-right: 0;
    }
    .table-item-3{
      margin-right: 0;
    }
    .trainer__title{
      font-size: 18px;
      margin-bottom: 5px;
    }
    .trainer__subtitle, .trainer__text{
      font-size: 11px;
      margin-bottom: 5px;
    }
}
/* ================================== 400 ================================ */
@media (max-width: 400px) {
  .burger__logo-n{
    width: 75px;
    height: 26px;
  }
}
/* ================================== 391 ================================ */
@media (max-width: 391px) {
  /* ===== trainer ====== */
  .main-table-1{
    margin-left: 0;
    margin-right: 0;
  }
  .main-table-2{
    margin-right: 0;
  }
  .main-table-3{
    margin-right: 0;
  }
  .table-item-1{
    margin-right: 0;
  }
  .table-item-2{
    margin-right: 0;
  }
  .table-item-3{
    margin-right: 0;
  }



}
/* ================================== 360 ================================ */
@media (max-width: 360px) {


}

</style>