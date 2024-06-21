<template>
    <section class="content">
        <ContentHeader />
        <div class="content__game">
            <div class="game">
                <div class="game__container">
                    <div class="window">
                        
                        <div class="window__header">
                            <div class="window__header-top">
                            <div class="window__header-info">
                                <img src="@/assets/svg/score.svg">
                                <p>Очки: {{this.totalScore}}</p>
                                
                            </div>
                            <div class="window__header-info">
                                <img src="@/assets/svg/level.svg">
                                <p>Уровень: {{this.gameInfo.thislevel}}/{{this.gameInfo.maxlevel}}</p>
                            </div>
                            <div class="window__header-info">
                                <img src="@/assets/svg/time.svg">
                                <p>Время: {{Math.round(this.startTime * 10) / 10}}</p>
                            </div>
                            </div>
                            <div class="window__header-down" v-if="!dynamicComponent">
                                <div :class="`trains-card__header trains-card--${this.gameInfo.type}`">
                                    <div class="trains-card__icon"></div>
                                    <h2 class="trains-card__title">{{this.gameInfo.title}}</h2>
                                    <h3 class="trains-card__subtitle">Сложность:<b>{{this.gameInfo.difficulty}}</b></h3>
                                </div>
                                <ul class="window__header-profit-list">
                                    <li class="window__header-profit-item">
                                    Повышает эрудицию
                                    </li>
                                    <li class="window__header-profit-item">
                                    Развивает интуицию
                                    </li>
                                    <li class="window__header-profit-item">
                                    Скорость мышления
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="window__content" v-if="!dynamicComponent">
                            <div class="result" v-if="!dynamicComponent && end">
                                <div class="result__container">
                                    <h1 class="result__header">РЕЗУЛЬТАТ:</h1>
                                    <div class="result__info">
                                        <p class="result__score">{{this.endtime ?? Math.round(this.startTime * 10) / 10}} сек, {{this.totalScore}} очков</p>
                                    </div>
                                </div>
                            </div>
                            <button class="window__start-button" @click="loadComponent">
                                <p>Начать тренировку</p>
                            </button>
                            <button class="window__link-rules" @click="OpenRules()">Правила игры</button>
                            <div class="modal__rules" v-if="IsRulesOpen">
                                <p class="modal__rules-text">{{this.gameInfo.information}}</p>
                                <button class="modal__rules-close" @click="OpenRules()">×</button>
                            </div>
                        </div>

                        <div class="window__footer" v-if="!dynamicComponent">
                            <p>ПРИГЛАСИТЕ ДРУЗЕЙ НА ТРЕНИРОВКУ:</p>
                            <div class="window__link-list">
                            <a class="window__link" href="">
                                <share-network class="sharebtn__" network="facebook" title="ЗАСТАВЬ СВОЙ МОЗГ РАБОТАТЬ БЫСТРЕЕ!" :url="'http://infohic3.beget.tech/game?id=' + this.$route.query.id">
                                    <img src="@/assets/svg/facebook.svg" alt="">
                                </share-network>
                            </a>
                            <a class="window__link" href="">
                                <share-network class="sharebtn__" network="vk" title="ЗАСТАВЬ СВОЙ МОЗГ РАБОТАТЬ БЫСТРЕЕ!" :url="'http://infohic3.beget.tech/game?id=' + this.$route.query.id">
                                    <img src="@/assets/svg/VK.svg" alt="">
                                </share-network>
                            </a>
                            <a class="window__link" href="">
                                <share-network class="sharebtn__" network="telegram" title="ЗАСТАВЬ СВОЙ МОЗГ РАБОТАТЬ БЫСТРЕЕ!" :url="'http://infohic3.beget.tech/game?id=' + this.$route.query.id">
                                    <img src="@/assets/svg/Telegram.svg" alt="">
                                </share-network>
                            </a>
                            </div>
                        </div>
                        <div class="window__header-down a" v-if="dynamicComponent">
                            <div class="game-name">{{this.gameInfo.title}}</div>
                            <div class="game-exit" @click="exitGame()">
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.25012 1.25L19.0524 18.8022" stroke="#0A0E19" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19.0521 1.25L1.24988 18.8022" stroke="#0A0E19" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <iframe :src="dynamicComponent" v-if="dynamicComponent" height="100%" frameborder="0"></iframe>
                </div>
            </div>
            </div>
            <div class="statistics">
            <p class="statistics__text">График развития</p>
            <img src="@/assets/svg/graphics.svg" alt="" class="statistics__graphics">
            <div class="statistics__button-container" >
                <router-link class="button button--white" to="/stats">
                    <img class="button__icon" src="@/assets/svg/result.svg">
                    <p class="button__text">Результаты</p>
                </router-link>
                <a class="button button--blue">
                    <img class="button__icon" src="@/assets/svg/ranking.svg">
                    <p class="button__text">Рейтинг</p>
                </a>
            </div>
            <div v-if="this.gamestats">
                <div class="userwrap" v-for="(item, index) in this.gamestats" :key="index">
                    <div class="usernum">{{index+1}}.</div>
                    <div class="user">
                        <div class="userinfo">
                            <div class="username">{{item.username}}</div>
                            <div class="userdop">{{formatUnixTimestamp(item.date_end)}}</div>
                        </div>
                        <div class="userres">
                            {{item.scores}} очков
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="t">Нет данных.</div>
            </div>
        </div>
    </section>
</template>

<script>
import ContentHeader from '../components/ContentHeader.vue';
import gameService from '../services/game';
import $ from "jquery"
export default {
    name: "Game",
    components: {
        ContentHeader
    },
    data() {
        return {
            dynamicComponent: null,
            end: false,
            endtime: 0,
            gameInfo: [],
            session_token: null,
            gamestats: null,
            totalScore: 0,
            startTime: 0,
            timerActive: false,
            timerInterval: null,
            IsRulesOpen: false
        }
    },
    methods: {
        OpenRules() {
            this.IsRulesOpen = !this.IsRulesOpen
        },
        startTimer () {
            this.timerActive = true;
            this.timerInterval = setInterval(() => {
                this.startTime += 0.1;
            }, 100);
        },
        stopTimer () {
            this.timerActive = false;
            clearInterval(this.timerInterval);
        },
        formatUnixTimestamp(unixTimestamp) {
            const date = new Date(unixTimestamp * 1000);
            const formattedDate = date.toLocaleString('ru-RU', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
            });
            return formattedDate.replace(',', '');
        },
        async loadComponent() {
            try {
                this.dynamicComponent = `/iframe/${this.$route.query.id}.html`
                
                if(localStorage.getItem('token') !== null) {
                    gameService.gameCreateSession(localStorage.getItem('token')).then(res => {
                        this.session_token = res.data.data
                    })
                }
            } catch (error) {
                console.error(`Ошибка при загрузке компонента: ${error}`);
            }
        },
        exitGame() {
            this.startTime = 0;
            this.dynamicComponent = null;
            this.stopTimer();
        },
        calculateTotalScore(data) {
            // Коэффициенты для начисления баллов
            const clickCoefficient = 1;
            const correctClickCoefficient = 5;
            const incorrectClickCoefficient = -2;

            const clickScore = data.click_count * clickCoefficient;
            const correctClickScore = data.true_clicks * correctClickCoefficient;
            const incorrectClickScore = data.false_clicks * incorrectClickCoefficient;
            
            const totalScore = clickScore + correctClickScore + incorrectClickScore;
            return totalScore;
        },
        receiveMessage(event) {
            if(event.data.status) {
                if(event.data.type == 'end') {
                    this.stopTimer();
                    this.dynamicComponent = null
                    this.end = true
                    this.endtime = event.data.info.resTime

                    const { clickCount, falseClick, resTime, trueClick } = event.data.info;

                    let gameResultInfo = {
                        click_count: clickCount ?? 0,
                        false_clicks: falseClick ?? 0,
                        result_time: resTime ?? 0,
                        training_id: this.$route.query.id,
                        true_clicks: trueClick ?? 0,
                        user_token: localStorage.getItem('token'),
                        session_token: this.session_token
                    };

                    let rt = this.calculateTotalScore(gameResultInfo);
                    if(rt < 0) this.totalScore = 0
                    else this.totalScore = rt

                    gameService.gameEnd(gameResultInfo).then(res => {
                        console.log(res);
                    })
                }else if(event.data.type == 'start') {
                    this.startTime = 0;
                    this.startTimer();
                }
            }
        },
    },
    mounted() {
        gameService.gameGetOne(this.$route.query.id).then(res => {
            this.gameInfo = res.data.data[0];
        })
        window.addEventListener('message', this.receiveMessage);

        gameService.gameGetStats(this.$route.query.id).then(res => {
            this.gamestats = res.data.data;
        })
        $('.burger__btn, .overlay').on('click', function (e) {
            e.preventDefault()
            $('.overlay').toggleClass('overlay--show')
            $('.burger__menu').toggleClass(' burger__menu--active')
        })
    }
}
</script>

<style scoped>
.t {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}
.usernum {
    margin-right: 50px;
}
.userwrap {
    margin-top: 20px;
    display: flex;
    align-items: center;
}
.user {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
iframe{
    height: 100vh; 
}
.game-name {
    color: var(--Text-Black, #0A0E1A);
    font-family: Open Sans;
    font-size: 18px;
    font-weight: 600;
    line-height: 130%;
}
.game-exit:hover {
    cursor: pointer;
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
.window__header-profit-item::before{
  content: "";
  background-image: url("~@/assets/svg/tick-square.svg");
  position: absolute;
  width: 15px;
  height: 15px;
  left: -20px;
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
/* GAME ----------------------------------------------------------------------- */
.content__game{
  flex: 1 0 auto;
  display: flex;
  justify-content: space-between;
  align-items: stretch;
}
.game{
  width: 100%;
  height: 100%;
}
.game__container{
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 50px 40px;
  width: 100%;
  height: 100%;
  background-color: #EEE;;
}
.window{
  border-radius: 8px 8px 0px 0px;
  background-color: #FFF;
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: stretch;
}
.window__header-top{
  padding: 20px;
  border-radius: 8px 8px 0px 0px;
background: #3281FF;
display: flex;
justify-content: space-between;
align-items: center;
}
.window__header-info{
  display: flex;
  align-items: center;
  justify-content: flex-start;
}
.window__header-info img{
  margin-right: 15px;
}
.window__header-info p{
  color: #FFF;
font-family: Open Sans;
font-size: 18px;
font-style: normal;
font-weight: 700;
line-height: 150%; /* 27px */
}
.window__header-down{
  background: #F7F7F7;
  padding: 30px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.window__header-down .trains-card__header{
  padding-top: 0;
  margin-left: -30px;
}
.window__header-profit-item{
    color: #696969;
    font-family: Open Sans;
    font-size: 12px;
    font-style: normal;
    font-weight: 600;
    line-height: 130%; /* 15.6px */
    position: relative;
}
.window__header-profit-item+.window__header-profit-item{
    margin-top: 10px;
}

.window__content{
    min-height: 200px;
    display: flex;
    flex: 1 0 auto;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
}
.modal__rules{
    background-color: #fff;
    border-radius: 20px;
    padding: 20px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    position: absolute;
    top: 290px;
    display: flex;
    align-items: center;
    justify-content: space-between;

}
.modal__rules-close{
    font-size: 24px;
    cursor: pointer;
}
.window__start-button{
    width: 400px;
    padding: 20px;
    border-radius: 8px;
    background: #3281FF;
    margin-bottom: 10px;
}
.window__start-button:hover{
    cursor: pointer;
    background-color: #4188fa;
}
.window__start-button:active{
    cursor: pointer;
    background-color: #286fe1;
}
.window__start-button p {
    text-align: center;
    color: var(--white-w-100, #FFF);
    text-align: center;
    font-family: Open Sans;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 20px; /* 133.333% */
    letter-spacing: -0.2px;
}
.window__link-rules{
    color: #818181;
    text-align: center;
    font-family: Open Sans;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 130%; /* 18.2px */
    text-decoration-line: underline;
    cursor: pointer;
}
.window__footer{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding-bottom: 60px;
}
.window__footer p {
    color: var(--Text-Black, #0A0E1A);
    text-align: center;
    font-family: Open Sans;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: 130%; /* 23.4px */
    margin-bottom: 25px;
}
.window__link-list{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 230px;
}
.statistics{
    padding: 20px;
    width: 33%;
    max-width: 492px;
    background-color: #FFF;
}
.statistics__graphics{
    width: 100%;
    margin-bottom: 15px;
}
.statistics__text{
    color: var(--gray-g-100, #8F92A1);
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Open Sans;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 20px; /* 142.857% */
    letter-spacing: 1px;
    text-transform: uppercase;
}
.statistics__button-container{
    display: grid;
    grid-template-columns: 50% 50%;
    gap: 5px;
}
.result__container{
    display: grid;
    grid-template-areas:
    "a a"
    "b c";    
    margin-bottom: 70px;
}
.result__header{
    grid-area: a;
    text-align: center;
    font-family: Open Sans;
    font-size: 25px;
    font-style: normal;
    font-weight: 600;
    line-height: 130%; /* 32.5px */
    margin-bottom: 40px;
}
.result__progress-bar{
    grid-area: b;
    margin-right: 65px;
}
.result__info{
    grid-area: c;
}
.result__score{
    color: #00875A;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Open Sans;
    font-size: 50px;
    font-style: normal;
    font-weight: 700;
    line-height: 34.468px; /* 68.936% */
    letter-spacing: -0.46px;
    margin-bottom: 20px;
}
.result__correct, .result__uncorrect{
    color: #818181;
    font-family: Open Sans;
    font-size: 18.383px;
    font-style: normal;
    font-weight: 600;
    line-height: 130%; 
    margin-bottom: 5px;
}
.result__correct b{
    color: #00875A;
    font-family: Open Sans;
    font-size: 18.383px;
    font-style: normal;
    font-weight: 800;
    line-height: 130%;
}
.result__uncorrect b{
    color: #AF1A1A;
    font-family: Open Sans;
    font-size: 18.383px;
    font-style: normal;
    font-weight: 800;
    line-height: 130%;
}
.result__link-answers{
    color: #3281FF;
    font-family: Open Sans;
    font-size: 18.383px;
    font-style: normal;
    font-weight: 700;
    line-height: 130%; 
    text-decoration: none;
}
@media screen and (max-width: 520px){
    .content{
        flex: auto;
        max-width: 100%
    }
    .game__container{
        padding: 0px !important
    }
    .window__header-top{
        flex-direction: column;
        align-items: flex-start;
    }
    .knopka{
        max-width: 100% !important;
        width: 100% !important
    }
    .window__start-button{
        max-width: 100%;
        width: 100%
    }
}
</style>