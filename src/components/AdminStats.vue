<template>
    <div class="star__item-title">Количество тернировок</div>
    <div class="content__items">
        <div class="content__item">
        <div class="items__memory-title">
            <div class="items__memory-svg">
            <img src="@/assets/svg/item-memory.svg" alt="">
            </div>
            <div class="items__memory-text">Память</div>
        </div>
        <div class="items__memory-subtitle">{{this.getFor('memory').count}}</div>
        </div>
        <div class="content__item">
        <div class="items__memory-title">
            <div class="items__memory-svg">
            <img src="@/assets/svg/item-attention.svg" alt="">
            </div>
            <div class="items__memory-text">Внимание</div>
        </div>
        <div class="items__memory-subtitle">{{this.getFor('attention').count}}</div>
        </div>
        <div class="content__item">
        <div class="items__memory-title">
            <div class="items__memory-svg">
            <img src="@/assets/svg/item-mind.svg" alt="">
            </div>
            <div class="items__memory-text">Мышление</div>
        </div>
        <div class="items__memory-subtitle">{{this.getFor('mind').count}}</div>
        </div>
        <div class="content__item">
        <div class="items__memory-title">
            <div class="items__memory-svg">
            <img src="@/assets/svg/item-speed.svg" alt="">
            </div>
            <div class="items__memory-text">Тренажеры для <br> скорости реакции</div>
        </div>
        <div class="items__memory-subtitle">{{this.getFor('speed').count}}</div>
        </div>
    </div>

    <div class="star__item-title">Средние показатели</div>
    <div class="content__items">
        <div class="content__item">
        <div class="items__memory-title">
            <div class="items__memory-svg">
            <img src="@/assets/svg/item-memory.svg" alt="">
            </div>
            <div class="items__memory-text">Память</div>
        </div>
        <div class="items__memory-subtitle">{{Math.floor(this.getFor('memory').avg_scores * 10) / 10}}</div>
        </div>
        <div class="content__item">
        <div class="items__memory-title">
            <div class="items__memory-svg">
            <img src="@/assets/svg/item-attention.svg" alt="">
            </div>
            <div class="items__memory-text">Внимание</div>
        </div>
        <div class="items__memory-subtitle">{{Math.floor(this.getFor('attention').avg_scores * 10) / 10}}</div>
        </div>
        <div class="content__item">
        <div class="items__memory-title">
            <div class="items__memory-svg">
            <img src="@/assets/svg/item-mind.svg" alt="">
            </div>
            <div class="items__memory-text">Мышление</div>
        </div>
        <div class="items__memory-subtitle">{{Math.floor(this.getFor('mind').avg_scores * 10) / 10}}</div>
        </div>
        <div class="content__item">
        <div class="items__memory-title">
            <div class="items__memory-svg">
            <img src="@/assets/svg/item-speed.svg" alt="">
            </div>
            <div class="items__memory-text">Тренажеры для <br> скорости реакции</div>
        </div>
        <div class="items__memory-subtitle">{{Math.floor(this.getFor('speed').avg_scores * 10) / 10}}</div>
        </div>
    </div>
    <div class="content__trainer">
        <div class="trainer__top">
        <div class="trainer__title">Тренажеры</div>
        <div class="trainer__subtitle">Показатели по каждому тренажеру.</div>
        <div class="trainer__text">Нажмите на тренажер, чтобы просмотреть подробную <br> статистику по каждому тренажеру.</div>
        </div>
        <div class="trainer__bottom">
        <div class="trainer__input-box">
            <input class="trainer__input" type="text" placeholder = "Поиск" v-model="this.filter">
        </div>
        <div class="trainer__table">
            <div class="trainer__main-table">
            <div class="trainer__table-item main-table-1">Тренажер</div>
            <div class="trainer__table-item main-table-2">Тип</div>
            <div class="trainer__table-item main-table-3"><span class="text__win">Количество <br> тернировок </span><span class="text__mob">Кол. <br> тре.</span></div>
            <div class="trainer__table-item"><span class="text__win">Средний результат </span><span class="text__mob">Сред.<br>резул.</span></div>
            </div>
            <div class="trainer__table-items" v-for="(item, index) in this.filteredItems" :key="index">
                <div class="trainer__table-item table-item-1">{{item.title}}</div>
                <div class="trainer__table-item table-item-2">{{item.type}}</div>
                <div class="trainer__table-item table-item-3">{{item.count}}</div>
                <div class="trainer__table-item">{{Math.floor(item.avg * 10) / 10}}</div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import gameService from '../services/game'
import {useAuthStore} from '../store/auth';

export default {
    name: "AdminStats",
    data() {
        return {
            filter: '',
            datas: [],
            adminstat: []
        }
    },
    computed: {
        filteredItems() {
            return this.datas.filter(item => item.title.toLowerCase().includes(this.filter.toLowerCase()));
        }
    },
    methods: {
        getFor(type) {
            const element = this.adminstat.find(element => element.type === type);
            return element ? element : { count: 0, avg_scores: 0 };
        }
    },  
    mounted() {
        const auth = useAuthStore();
        gameService.gameGetAllStats(auth.token).then(res => {
            this.datas = res.data.data
            this.adminstat = res.data.data1

        })
    }
}
</script>

<style>
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
  padding: 39px 32px;
  background: #EEE;
}
.content__efficiency {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  background: #FFF;
  padding: 28px 64px;
  border-radius: 16px;
  margin-bottom: 35px;
}
.efficiency__left {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-right: 15px;
}
.efficiency__left-top {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 22px;
}
.efficiency__title {
  display: flex;
  flex-direction: row;
  align-items: center;
}
.efficiency__title-svg {
  margin-right: 12px;
}
.efficiency__title-text {
  text-align: center;
  font-size: 22.131px;
  font-style: normal;
  font-weight: 700;
  line-height: 29.508px; /* 133.333% */
  letter-spacing: -0.246px;
  color:#171717;
}
.efficiency__title-numb {
  text-align: center;
  font-size: 73.77px;
  font-style: normal;
  font-weight: 700;
  line-height: 99.255px; /* 134.545% */
  letter-spacing: -0.827px;
  color: #171717;
}
.efficiency__left-bottom {
}
.efficiency__bottom-title {
  font-size: 17.213px;
  font-style: normal;
  font-weight: 700;
  line-height: 24.59px; /* 142.857% */
  letter-spacing: -0.492px;
  color: #171717;
}
.efficiency__bottom-numb {
  text-align: center;
  font-size: 36.885px;
  font-style: normal;
  font-weight: 400;
  line-height: 49.826px; /* 135.084% */
  letter-spacing: -0.415px;
  color: #171717;
}
.efficiency__right {
}
.efficiency__right img {
  width: 100%;
  height: 100%;
}
.efficiency__img-1{

}
.efficiency__img-2{
  display: none;
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
  max-width: 390px;
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
  flex-direction: row;
  align-items: center;
}
.items__memory-svg {
  margin-right: 10px;
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
/* ====== content-star ======= */
.content__star {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 35px;
}
.star__item {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  max-width: 780px;
  width: 100%;
  padding: 32px 35px;
  border-radius: 16px;
  background: #fff;
}
.star__item:first-child {
  margin-right: 15px;
}
.star__item-top{
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-bottom: 22px;
}
.star__item-title {
  color: #171717;
  text-align: center;
  font-size: 22.131px;
  font-style: normal;
  font-weight: 700;
  line-height: 29.508px; /* 133.333% */
  letter-spacing: -0.246px;
  margin-bottom: 12px;
}
.star__item-subtitle {
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px; /* 125% */
  letter-spacing: -0.4px;
  color: #636363;
}
.star__item-img {
  margin: 0 auto;
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
  overflow: hidden;
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
  justify-content: space-between;
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
  justify-content: space-between;
}
.trainer__table-items:hover{
  background: #F3F3F3;
  transition: all .3s;
}
.trainer__table-item {
  max-width: 50px;
}
.trainer__table-item br{
  display: none;
}
.text__mob{
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

}
/* ================================== 1800 ================================ */
@media (max-width: 1800px) {
/* === efficiency ===== */
.efficiency__right img{
  width: 1000px;
}
/* ===== trainer ====== */


}
/* ================================== 1700 ================================ */
@media (max-width: 1700px) {
/* === efficiency ===== */
.efficiency__right img{
  width: 900px;
}
/* === chart ===== */
.chart__img{
  width: 1200px;
}
.chart__img img{
  width: 1200px;
}
/* ===== trainer ====== */


}
/* ================================== 1600 ================================ */
@media (max-width: 1600px) {
  /* === efficiency ===== */
.efficiency__right img{
  width: 800px;
}
/* === chart ===== */
.chart__img{
  width: 1100px;
}
.chart__img img{
  width: 1100px;
}
/* ===== trainer ====== */
.trainer__table-items{
  padding: 14px 100px 15px;
}
.trainer__table-item br{
  display: block;
}

}
/* ================================== 1500 ================================ */
@media (max-width: 1500px) {
  /* === efficiency ===== */
  .efficiency__right img{
    width: 700px;
  }
/* === chart ===== */
.chart__img{
  width: 900px;
}
.chart__img img{
  width: 900px;
}
/* === star ===== */
.content__star{
  flex-direction: column;
}
.star__item{
  max-width: 100%;
  width: 100%;
}
.star__item:first-child{
  margin-right: 0;
  margin-bottom: 15px;
}
/* ===== trainer ====== */


}
/* ================================== 1400 ================================ */
@media (max-width: 1400px) {
  /* === efficiency ===== */
  .efficiency__right img{
    width: 600px;
  }
/* ===== trainer ====== */

}
/* ================================== 1300 ================================ */
@media (max-width: 1300px) {
  /* === efficiency ===== */
  .efficiency__right img{
    width: 500px;
  }
  .efficiency__title-text{
    font-size: 20px;
  }
  .efficiency__title-numb{
    font-size: 62px;
  }
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
/* === efficiency ===== */
  .content__efficiency{
    flex-direction: column;
    padding: 0;
    background: none;
    margin-bottom: 15px;
  }
  .efficiency__left{
    width: 100%;
    border-radius: 8px;
    background: #FFF;
    padding: 14px 60px;
    margin-bottom: 15px;
    margin-right: 0;
  }
  .efficiency__right{
    width: 100%;
    border-radius: 8px;
    background: #FFF;
    padding: 14px 60px;
    text-align: center;
  }
  .efficiency__right img{
    width: 650px;
  }
  .efficiency__title-text{
    font-size: 20px;
  }
  .efficiency__title-numb{
    font-size: 62px;
  }
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
  /* === efficiency ===== */
  .efficiency__right img{
    width: 550px;
  }
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
}
/* ================================== 1000 ================================ */
@media (max-width: 1000px) {
    /* === efficiency ===== */
    .efficiency__right img{
      width: 500px;
    }
    .efficiency__right{
      padding: 0;
    }
      /* ===== trainer ====== */
  .trainer__main-table, .trainer__table-items{
    padding-left: 15px;
    padding-right: 15px;
  }
  .trainer__text br{
    display: block;
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
/* === efficiency ===== */
    .efficiency__right img{
      width: 500px;
    }
}
/* ================================== 700 ================================ */
@media (max-width: 700px) {
/* === efficiency ===== */
.efficiency__right img{
  width: 400px;
  height: 100%;
}
.efficiency__img-1{
  display: none;
}
.efficiency__img-2{
  display: flex;
  margin: 0 auto;
}


}
/* ================================== 600 ================================ */
@media (max-width: 600px) {
  .content__container{
    padding: 27px 20px;
  }
  .content__text-vector{
    margin-right: 5px;
  }
  /* === efficiency ===== */
  .efficiency__right{
    padding: 0;
  }
  .efficiency__right img{
    width: 400px;
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
  /* === star ===== */
.content__star{
  flex-direction: column;
}
.star__item{
  padding: 0;
  background: none;
}
.star__item-img{
  text-align: center;
  width: 100%;
  background: #FFF;
  border-radius: 16px;
}
.star__item-img img{
  width: 400px;
}
  /* ===== trainer ====== */
  .trainer__main-table, .trainer__table-items{
    font-size: 12px;
  }
  .trainer__text br{
    display: block;
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
  /* === star ===== */
  .star__item-title{
    font-size: 22px;
    margin-bottom: 0px;
  }
  .star__item-subtitle{
    font-size: 14px;
  }
  .star__item-img img{
    width: 320px;
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
}
/* ================================== 450 ================================ */
@media (max-width: 450px) {
  .burger__btn{
    margin-right: 5px !important;
  }
    /* === efficiency ===== */
    .efficiency__right img{
      width: 350px;
    }
    .efficiency__left{
      padding: 14px 0px;
    }
    .efficiency__left-top{
      margin-bottom: 0;
    }
    .efficiency__title-text, .efficiency__bottom-title{
      font-size: 18px;
    }
    .efficiency__title-numb{
      font-size: 50px;
    }
    .efficiency__bottom-numb{
      font-size: 36px;
    }
    /* ===== trainer ====== */
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
/* === efficiency ===== */
      .efficiency__right img{
        width: 320px;
      }
      .chart__top-svg{
        display: none;
      }
  /* === star ===== */
  .star__item-title{
    font-size: 18px;
  }
  .star__item-subtitle{
    font-size: 12px;
  }
}
/* ================================== 391 ================================ */
@media (max-width: 391px) {
  /* ===== trainer ====== */



}
/* ================================== 360 ================================ */
@media (max-width: 360px) {


}

</style>