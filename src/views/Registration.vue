<template>
    <section class="content">
        <ContentHeader v-if="checklogin != '/login' && checklogin != '/registration'"/>
        
        <div class="page_sign-up">
            <section class="sidebar">
                <div class="sidebar__container">
                    <router-link to="/"><img class="sidebar__logo" src="@/assets/svg/logo.svg"></router-link>
                    <div class = "burger"><img src = "@/assets/svg/ion_menu.svg"></div>
                </div>
            </section>


            <div class="sign-up">
				<div class="sign-up_text">
					<div class="sign-up_title">Регистрация в  Мозг</div>
					<div class="sign-up_subtitle">У вас уже есть учетная запись? <router-link class = "enter" to="/login">Войти</router-link> </div>
				</div>
				<form @submit.prevent="submit" class="sign-up_form">
					<div class="sign-up_form_content">
						<input type="text" class="name input-width" v-model="this.username" placeholder = "Имя Фамилия" required>
					</div>
					<div class="sign-up_form_content">
						<input type="email" class="email input-width" v-model="this.email" placeholder = "E-mail" required>
					</div>
					<div class="sign-up_form_content">
						<input type="password" class="pass input-width" v-model="this.password" placeholder="Пароль" required>
					</div>
					<div class="sign-up_form_content">
						<input type="password" class="pass input-width" v-model="this.confirm_password" ref="confirm_password" placeholder="Подтверждение пароля" required>   
					</div>
				
					<div class="policy">
						<div class = "policy_inner">
							<input class ="checkbox" type ="checkbox" width="24px" height="24px" required>
							<div class="policy_text">Создавая учетную запись, вы соглашаетесь c нашей <a href = "#" class = "policy_link" >Политикой конфиденциальности,<br> сроками</a> и <a href = "#" class = "policy_link" >условиями</a>, a также <a href = "#" class = "policy_link" >настройками уведомлений</a></div>
						</div>
					</div>
					<div class = "registration__button">
						<button width = "584px" height = "20px" class="registration" type="submit">Регистрация</button>
					</div>
					<div class = "or">
						<hr class = "line"><p class = "or_text">или</p><hr class = "line">
					</div>
					<div class="social__button">
						<button class="google_enter">Войти через Google</button>
						<button class="vk_enter">Войти через ВК</button>
					</div>
				</form>
			</div>
        </div>
        
    </section>
</template>

<script>
import ContentHeader from '../components/ContentHeader.vue';
import userService from '../services/user.js';

export default {
    name: "Registration",
    components: {ContentHeader},
    data() {
        return {
            username: null,
            email: null,
            password: null,
            confirm_password: null
        }
    },
    computed: {
        checklogin() {
            return this.$route.path;
        }
    },
    methods: {
        submit() {
            if(this.password !== this.confirm_password) {
                console.log(this.password + " " + this.confirm_password);
            } else {
                userService.userRegistration(this.email, this.username, this.password).then(res => {
                    this.$notify({
                        title: "Успешно",
                        text: res.data.message,
                        type: "success"
                    });

                    this.$router.push({ path: '/login' })
                }).catch(res => {
                    this.$notify({
                        title: "Внимание",
                        text: res.response.data.message,
                        type: "warn"
                    });
                })

            }
        }
    }
}
</script>

<style scoped>
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
  height: 100%;
  overflow-x: hidden !important;
  width: 100%;
  height: 100%;
}

body>.page {
  max-width: 1920px;
  margin: 0 auto;
}

.page {
  height: 100%;
}

.sidebar{
  max-width: 260px;
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

.burger{
  display: none;
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
.sidebar__container{
  padding: 25px 15px;
}
.enter{
    color: #3281FF;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    letter-spacing: -0.246px;
    text-decoration: none; 
    margin-left: 5px;   
}
/*Sign-up text*/

.sign-up{
    width:100%; 
    margin-top: 80px;   
}
.sign-up_title{

    color: #171717;
    text-align: center;
    font-size: 30px;
    font-style: normal;
    font-weight: 700;
    line-height: 36px; 
    letter-spacing: -0.4px; 
    margin-bottom: 12px;

}
.sign-up_subtitle{
    color: #8F92A1;
    text-align: center;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    letter-spacing: -0.246px; 
}
.sign-up_form{
  width:100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 51px auto 0;
}
.sign-up_form_content{
  display: flex;
  flex-direction: row;
}
.name{
  height: 45px;
  width: 584px;
  padding-left:55px;
  background-color: transparent;
  background: url('~@/assets/svg/icon-form-gray.svg') no-repeat left;
  background-repeat: no-repeat;
  outline: none;
  color: #171717;
  text-align: left;
  border: 0;
  border-bottom: .1px solid rgba(143, 146, 161, 0.40); 
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: 24px; /* 171.429% */
  letter-spacing: -0.2px; 
  margin-bottom: 20px;
}
.name::placeholder {color:#8F92A1 ;text-align: left;}
.name:focus{
  background: url('~@/assets/svg/icon-form.svg') no-repeat left;
  border-bottom: .1px solid #171717; 
}
.email{
  height: 45px;
  width: 584px;
  padding-left:55px;
  background-color: transparent;
  background: url('~@/assets/svg/email-gray.svg') no-repeat left;
  background-repeat: no-repeat;
  outline: none;
  color: #171717;
  text-align: left;
  border: 0;
  border-bottom: .1px solid rgba(143, 146, 161, 0.40); 
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: 24px; /* 171.429% */
  letter-spacing: -0.2px;
  margin-bottom: 20px; 
}
.email::placeholder {color:#8F92A1 ;text-align: left;}
.email:focus{
  background: url('~@/assets/svg/email.svg') no-repeat left;
  border-bottom: .1px solid #171717; 
}
.pass{
  height: 45px;
  width: 584px;
  padding-left:55px;
  background-color: transparent;
  background: url('~@/assets/svg/lock-gray.svg') no-repeat left ;
  background-repeat: no-repeat;
  outline: none;
  color: #171717;
  text-align: left;
  border: 0;
  border-bottom: .1px solid rgba(143, 146, 161, 0.40); 
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: 24px; /* 171.429% */
  letter-spacing: -0.2px;
  margin-bottom: 20px; 
}
.pass::placeholder {color:#8F92A1 ;text-align: left;}
.pass:focus{
  background: url('~@/assets/svg/lock.svg') no-repeat left;
  border-bottom: .1px solid #171717; 
}
.policy{
  width: 100%;
  margin: 25px auto 0;
}
.input-width{

}
.policy_inner{
  display: flex;
  justify-content: center;
}
.checkbox{
  background-color: #DEEBFF;
  margin-right: 16px;
}
.policy_text{
  color: #8F92A1;
  font-size: 12px;
  font-style: normal;
  font-weight: 700;
  line-height: 20px; /* 166.667% */
  letter-spacing: -0.2px; 
}
.policy_link{
  color: #3281FF;
  font-size: 12px;
  font-style: normal;
  font-weight: 700;
  line-height: 20px;
  letter-spacing: -0.2px; 
  text-decoration: none;
}
.registration:hover {
	cursor: pointer;
}
.registration__button{
  width: 100%;
  display: flex;
  justify-content: center;
  margin-top:49px;
}
.registration{
  width:584px;
  height:40px;
  background-color: #3281FF;
  border-radius: 5px;
  color: #FFF;
  text-align: center;
  font-size: 12px;
  font-style: normal;
  font-weight: 700;
  line-height: 20px; /* 166.667% */
  letter-spacing: -0.2px; 
  padding-top: 10px;
  padding-bottom: 10px;
}
.or{
  display: flex;
  flex-direction: row;
  align-items: center;
  margin-top: 24px;
}
.line{
  height: 1px;
  width: 267px;
  background-color: #8F92A1;
  opacity: 0.1; 
}
.or_text{
  margin: 0 10px 0;
  color: #8F92A1;
  text-align: center;
  font-size: 12px;
  font-style: normal;
  font-weight: 700;
  line-height: 20px; /* 166.667% */
  letter-spacing: 1px;
  text-transform: uppercase; 
}
.social__button{
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 25px;
}
.google_enter{
  margin-top:24px;
  width: 584px;
  height: 40px;
  border-radius: 8px;
  background-color: transparent;
  background: rgba(143, 146, 161, 0.10);
  color: #171717;
  background-position: 17px 10px;
	background-image: url('~@/assets/svg/Logo\ Google.svg');
	background-repeat: no-repeat;
  text-align: center;
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: 20px; /* 142.857% */
  letter-spacing: -0.4px; 
}
.vk_enter{
  margin-top:24px;
  width: 584px;
  height: 40px;
  border-radius: 8px;
  background: rgba(143, 146, 161, 0.10);
  background-position: 17px 7px;
	background-image: url('~@/assets/svg/VK.png');
	background-repeat: no-repeat;
  color: #171717;
  text-align: center;
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: 20px; /* 142.857% */
  letter-spacing: -0.4px; 
}
@media screen and (max-width: 800px){
  .sidebar{
    display: flex
  }
  .burger{
    display: none !important;
  }
}
@media screen and (max-width: 550px){
  .checkbox{
    margin-left: 0px;
    margin-bottom: 0px !important
  }
  .policy_inner{
    align-items: center;
    justify-content: flex-start;
  }
}
@media screen and (max-width: 360px){
  
  .sign-up{
    margin:0px;
  }

  .sign-up_title{
    color: #0A0E1A;
    font-size: 20px;
    font-style: normal;
    font-weight: 700;
    line-height: 140%; /* 28px */ 
  }

  .sign-up_subtitle{
    color:  #8F92A1;
    text-align: center;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    letter-spacing: -0.246px; 
  }

  .name{
    color: #171717;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 24px; /* 171.429% */
    letter-spacing: -0.2px; 
    width: 320px;
  }

  .email{
    color: #171717;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 24px; /* 171.429% */
    letter-spacing: -0.2px; 
    width: 320px;
  }

  .pass{
    color: #171717;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 24px; /* 171.429% */
    letter-spacing: -0.2px; 
    width: 320px;
  }

  .policy_inner{

    justify-content: space-between;
  
  }

  .checkbox{
    margin-left: 10px;
    margin-right: 5px;
    margin-bottom: 55px;
  }
  
  .policy_text{
    color: #8F92A1;
    font-size: 12px;
    font-style: normal;
    font-weight: 500;
    line-height: 20px; /* 166.667% */
    letter-spacing: -0.2px;
    margin-right: 20px;
  }
  
  .policy_link{
    color: #3281FF;
    font-size: 12px;
    font-style: normal;
    font-weight: 500;
    line-height: 20px;
    letter-spacing: -0.2px; 
  }

  .registration{
    width: 320px;
    height:40px;
    background-color: #3281FF;
    border-radius: 5px;
    color: #FFF;
    text-align: center;
    font-size: 12px;
    font-style: normal;
    font-weight: 700;
    line-height: 20px; /* 166.667% */
    letter-spacing: -0.2px; 
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .line{
    width: 155px;
  }

  .or_text{
    color: #8F92A1;
    text-align: center;
    font-size: 10px;
    font-style: normal;
    font-weight: 700;
    line-height: 20px; /* 200% */
    letter-spacing: 1px;
    text-transform: uppercase; 
  }

  .google_enter{
    width: 320px;
  }

  .vk_enter{
    width: 320px;
  }

  .sidebar__container{
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .burger{
    display: block;
    margin-left:180px;
  }
}
/* ================================ BREAK-POINTS =========================== */
/* ================================ BREAK-POINTS =========================== */
/* ================================== 600 ================================ */

@media (max-width: 600px) {
  .sign-up_form_content{
    justify-content: center;
    width: 100%;
  }
  .input-width{
    width: 95%;
  }
  .policy_inner{
    margin: 0 17px;
  }
  .policy_link br{
    display: none;
  }
  .registration__button{
    padding-left: 20px;
    padding-right: 20px;
  }
  .google_enter, .vk_enter{
    max-width: 92%;
  }
  .checkbox{
    margin-bottom: 40px;
    margin-right: 5px;
  }

}

/* ================================== 391 ================================ */
@media (max-width: 391px) {
  .input-width{
    width: 90%;
  }
  .policy_inner{
    margin: 0 20px;
  }
  .checkbox{
    margin-bottom: 40px;
  }
}
/* ================================== 350 ================================ */
@media (max-width: 350px) {
  .input-width{
    width: 90%;
  }
  .policy_inner{
    margin: 0 10px;
  }
  .registration__button{
    margin-top: 40px;
  }
  .checkbox{
    margin-bottom: 60px;
  }
}




</style>