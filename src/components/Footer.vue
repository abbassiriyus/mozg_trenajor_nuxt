<template>
    <div class="footer">
      <div class="footer__wrapper">
        <div class="footer__left">
          <div class="footer__left-ico">
            <img src="@/assets/svg/logo-2.svg" alt="">
          </div>
          <div class="footer__left-text">Онлайн тренажеры для мозга. <br> Упражнения для развития памяти, <br> внимания и мышления.</div>
          <div class="footer__left-socials">
            <div class="footer__left-social">
              <a :href="this.facebook_link"><img src="@/assets/svg/Facebook-2.svg" alt=""></a>
            </div>
            <div class="footer__left-social">
              <a :href="this.youtube_link"><img src="@/assets/svg/YouTube-2.svg" alt=""></a>
            </div>
            <div class="footer__left-social">
              <a :href="this.vk_link"><img src="@/assets/svg/VK-2.svg" alt=""></a>
            </div>
          </div>
          <div class="footer__left-copyright">Copyright © 2023</div>
        </div>
        <div class="footer__right">
          <div class="footer__right-top">
            <div class="footer__right-ul">
              <div class="footer__right-title">Тренажеры</div>
              <a href="/training?type=memory" class="footer__right-li">Тренажеры для памяти</a>
              <a href="/training?type=attention" class="footer__right-li">Тренажеры для внимания</a>
              <a href="/training?type=mind" class="footer__right-li">Тренажеры для мышления</a>
              <a href="/training?type=speed" class="footer__right-li">Тренажеры для скорости реакции</a>
            </div>
            <div class="footer__right-ul">
              <div class="footer__right-title">Контакты</div>
              <div class="footer__right-li">
                <div class="footer__right-svg">
                  <img src="src/svg/footer-1.svg" alt="">
                </div>
                <a class="footer__right-mail" href="mailto:mozg@gmail.com">mozg@gmail.com</a>
              </div>
            </div>
          </div>
          <div class="footer__right-bottom">
            <a :href="this.user_agreement"><div class="footer__right-bottext">Пользовательское cоглашение</div></a>
            <div class="footer__right-line">|</div>
            <a :href="this.privacy_policy"><div class="footer__right-bottext">Политика конфиденциальности</div></a>
          </div>
          <div class="footer__left-copyright right__copyright">Copyright © 2023</div>
        </div>
      </div>
    </div>
</template>

<script>
import userService from '../services/user';

export default {
  name: "Footer",
  data() {
    return {
      facebook_link: null,
      youtube_link: null,
      vk_link: null,
      user_agreement: null,
      privacy_policy: null
    }
  },
  mounted() {
    userService.getSettings().then(res => {
      this.facebook_link = res.data.data.facebook_link
      this.youtube_link = res.data.data.youtube_link
      this.vk_link = res.data.data.vk_link
      this.user_agreement = res.data.data.user_agreement
      this.privacy_policy = res.data.data.privacy_policy
    })
  }
}
</script>

<style scoped>
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
  color: #fff;
}
.footer__right-line {
  margin: 0 35px;
}
.right__copyright{
  display: none;
}

/* FOOTER */
@media (max-width: 1200px) {
  .footer__right-top{
    column-gap: 0px;
  }
  .footer__right-line{
    margin: 0 10px;
  }
}

@media (max-width: 1000px) {
.footer__wrapper{
  flex-direction: column;
}
  .footer__left{
    margin-bottom: 58px;
  }
  .footer__left-copyright{
    display: none;
  }
  .right__copyright{
    display: flex;
    justify-content: center;
  }
  .footer__right-bottom{
    margin-bottom: 22px;
  }
  .footer__left-ico{
    margin-bottom: 15px;
  }
  .footer__left-text{
    margin-bottom: 15px;
  }
  .footer__left-socials{
    margin-bottom: 0;
  }
  .footer__left-text br{
    display: none;
  }
}

@media (max-width: 750px) {
  .footer{
    padding-top: 23px;
    padding-bottom: 15px;
  }
  .footer__right-top{
    grid-template-columns: repeat(2, auto);
    grid-template-rows: repeat(2, auto);
    row-gap: 30px;
    column-gap: 32px;
  }
  .footer__right-bottom{
    flex-direction: column;
    align-items: flex-start;
  }
  .footer__right-line{
    display: none;
  }
  .footer__right-bottext{
    margin-bottom: 15px;
  }
  .footer__right-bottext:last-child{
    margin-bottom: 0;
  }
  .footer__right-top{
    margin-bottom: 30px;
  }

}
</style>