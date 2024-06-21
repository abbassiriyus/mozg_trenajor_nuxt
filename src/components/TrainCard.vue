<template>
    <div :class="'trains-card trains-card--' + type">
        <router-link :to="'/game?id=' + id" class="g">
            <div class="trains-card__header">
                <div class="trains-card__icon"></div>
                <h2 class="trains-card__title">{{ title }}</h2>
                <h3 class="trains-card__subtitle">Сложность:<b>{{ difficulty }}</b></h3>
            </div>
            <div class="trains-card__content">
                <img :src="require(`../assets/svg/${img}`)" alt="">
            </div>
        </router-link >
        <div class="trains-card__footer">
            <button class="trains-card__like action_svg" v-on:click="like(id)">
                <img v-if="localisLiked" src="../assets/svg/like2.svg">
                <img v-else src="../assets/svg/like.svg">
            </button>
            <button class="trains-card__annotation action_svg" v-on:click="annotation(id)">
                <img src="../assets/svg/annotation.svg">
            </button>
            <button class="trains-card__share action_svg" v-on:click="share(id)">
                <img src="../assets/svg/share.svg">
            </button>
        </div>

        <div :id="'modal'+id" class="modal">
            <div class="modal-content">
                <span class="close" v-on:click="closeModal(id)">&times;</span>
                <p>{{this.localinformation  ?? "Описания нет."}}</p>
            </div>
        </div>
        
        <div :id="'modalshare'+id" class="modal">
            <div class="modal-content modal-content__share">
                <span class="close" v-on:click="closeShare(id)">&times;</span>
                <div class="ad">
                    <div class="sharebtn">
                        <share-network class="sharebtn__" network="vk" title="Заголовок" :url="'https://lk.shamil-ahmadullin.ru/game?id=' + id">
                            <button style="color: #fff;">Поделиться в VK</button>
                        </share-network>
                    </div>
                    <div class="sharebtn">
                        <share-network class="sharebtn__" network="facebook" title="Заголовок" :url="'https://lk.shamil-ahmadullin.ru/game?id=' + id">
                            <button style="color: #fff;">Поделиться в Facebook</button>
                        </share-network>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import userService from '../services/user';
import {useAuthStore} from '../store/auth';
import $ from 'jquery'

export default {
    name: 'TrainCard',
    props: {
        id: {
            required: true
        },
        title: {
            required: true
        },
        difficulty: {
            required: true
        },
        type: {
            required: true
        },
        img: {
            required: true
        },
        isLiked: {
            required: true
        },
        information: {
            required: true
        }
    },
    data() {
        return {
            image: '',
            localisLiked: this.isLiked,
            localinformation: this.information
        }
    },
    methods: {
        like(id) {
            const auth = useAuthStore();

            userService.like(id, auth.token).then(res => {
                if(res.data.status == 1) {
                    this.localisLiked = false;
                }else if(res.data.status == 2) {
                    this.localisLiked = true;
                }

                console.log(res.data);
            })
        },
        annotation(id) {
            console.log(id);

            const modal = document.getElementById("modal" + id);
            modal.style.display = "block";
            
        },
        closeModal(id) {
            const modal = document.getElementById("modal" + id);
            modal.style.display = "none";
        },
        share(id) {
            const modal = document.getElementById("modalshare" + id);
            modal.style.display = "block";
        },
        closeShare(id) {
            const modal = document.getElementById("modalshare" + id);
            modal.style.display = "none";
        },
    },
    mounted() {
        window.addEventListener("click", function(event) {
            if ($(event.target).hasClass("modal") && $(event.target).is(":visible")) {
                $(event.target).css("display", "none");
            }
        });
    }
}
</script>

<style scoped>
.ad {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
@media screen and (max-width: 768px) {
    .modal-content {
        width: 70%!important;
    }
}
.sharebtn {
    background-color: #3281FF;
    display: flex;
    border-radius: 20px;
    max-width: 200px;
}
.sharebtn__ {
    display: flex;
    padding: 10px 15px;
    width: auto;
}
.modal-content__share {
    max-width: 300px;
}
/* Стили для модального окна */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.modal-content {
    background-color: #fff;
    border-radius: 20px;
    margin: 20% auto;
    padding: 20px;
    width: 40%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.close {
    float: right;
    font-size: 24px;
    cursor: pointer;
}

/* Стили для кнопки открытия модального окна */
#showModalButton {
    margin: 20px;
}
.g {
    display: flex;
    flex-direction: column;
}
.action_svg:hover {
    cursor: pointer;
}
.trains-card {
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
  overflow-wrap: break-word;
  max-width: 200px;
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

.trains-card__content img {
    max-width: 200px;
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
</style>