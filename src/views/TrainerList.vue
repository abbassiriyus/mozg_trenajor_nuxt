<template>
    <section class="content">
        <ContentHeader />
        <div class="content__section section">
            <div class="section__container">
                <h1 class="section__title">Тренажёры {{ name }}</h1>
                <div class="trainers">
                    <div class="trainers__container">
                        <TrainCard v-for="(item, index) in filteredData" :id="item.id" :title="item.title" :difficulty="item.difficulty" :type="item.type" :img="item.img" :information="item.information" :isLiked="isGameLiked(item.id) ?? false" v-bind:key="index"/>
                    </div>
                    <div v-if="this.filteredData[0] == null">Тренажеров нет</div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import TrainCard from '../components/TrainCard.vue';
import ContentHeader from '../components/ContentHeader.vue';
import gameService from '../services/game';
import {useAuthStore} from '../store/auth';

export default {
    components: {TrainCard, ContentHeader},
    data() {
        return {
            datas: [],
            liked: []
        }
    },
    computed: {
        filteredData() {
            const type = this.$route.query.type;

            if (type) {
                let result = this.datas.filter(data => data.type === type);
                return result;
            } else {
                return this.datas;
            }
        },
        isGameLiked() {
            return (id) => {
                if (this.liked && this.liked.length > 0) {
                    return this.liked.some((item) => item.training_id === id);
                } else {
                    return false;
                }
            };
        },
        name() {
            if(this.$route.query.type == 'memory') return 'для памяти'
            if(this.$route.query.type == 'attention') return 'для внимания'
            if(this.$route.query.type == 'mind') return 'для мышления'
            if(this.$route.query.type == 'speed') return 'для скорости реакции'

            return '';
        }
    },
    mounted() {
        const auth = useAuthStore();

        gameService.gameGetAll(auth.token).then(res =>{
     
          const uniqueTitles = new Map();

    // Loop through the data and add unique titles to the Map
    res.data.data.forEach(item => {
      if (!uniqueTitles.has(item.title)) {
        uniqueTitles.set(item.title, item);
      }
    });

    // Convert the Map back to an array
    this.datas = Array.from(uniqueTitles.values()).sort((a, b) => a.difficulty - b.difficulty);
            this.liked = res.data.upd
        })

        
    }
}
</script>

<style scoped>
.content__section{
    background-color: #eee;
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
@media screen and (max-width: 500px){
    .content{
        flex: auto;
        max-width: 100%
    }
    .section__container{
        padding: 10px
    }
}
</style>