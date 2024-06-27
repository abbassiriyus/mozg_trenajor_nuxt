<template>
  <BurgerMenu />
	<header class="header">
		<div class="container">
			<div class="header__menu">
        <div class="header__left">
			<router-link class="header__logo" to="/">
				<img style="height:80px;" src="@/assets/svg/logo12.png" alt="">
			</router-link>
        </div>
        
			<nav class="header__nav">
				<ul class="header__nav-list">
				<li class="header__nav-item">
					<router-link class="header__nav-link" to="/">Главная</router-link>
				</li>
				<li class="header__nav-item">
					<a class="header__nav-link" href="#razvitie">Развитие</a>
				</li>
				<li class="header__nav-item">
					<a class="header__nav-link" href="#preimushestva">Преимущества</a>
				</li>
				<li class="header__nav-item">
					<a class="header__nav-link" href="/training">Тренажеры</a>
				</li>
				</ul>
			</nav>
			<div class="header__btn-box">
				<router-link class="header__btn button" to="/login">Войти</router-link>
			</div>
			</div>
		</div>
	</header>



	<main class="main">
		<section class="main__mind mind">
			<div class="container">
			<div class="mind__inner">
				<div class="mind__block">
				<div class="mind__block-title">ЗАСТАВЬ <br> СВОЙ МОЗГ РАБОТАТЬ БЫСТРЕЕ!</div>
				<div class="mind__block-subtitle">Тренажеры для мозга. Тренировка памяти, внимания и мышления.</div>
				<router-link to="/training" class="mind__btn">ТРЕНИРОВАТЬ МОЗГ</router-link>
				</div>
				<div class="mind__bg"></div>
			</div>
			<div class="mind__bottom-box">
				<div class="mind__bottom-btn">
          <a href="#razvitie"><img src="@/assets/svg/mind-bottom-btn.svg" alt=""></a>
				</div>
			</div>
			</div>
		</section>
		<section class="main__develop develop">
			<div class="container">
			<div class="develop__inner">
				<div class="develop__top">
				<div class="develop__top-svg">
					<img class="develop__svg-1" src="@/assets/svg/develop-1.svg" alt="">
					<img class="develop__svg-2" src="@/assets/svg/develop-3.svg" alt="">
				</div>
				<div class="develop__top-title" id="razvitie">РАЗВИТИЕ МОЗГА</div>
				<div class="develop__top-svg">
					<img class="develop__svg-1" src="@/assets/svg/develop-2.svg" alt="">
					<img class="develop__svg-2" src="@/assets/svg/develop-4.svg" alt="">
				</div>
				</div>
				<div class="develop__subtitle">С помощью наших тренажеров для ума вы легко сможете улучшить ваши умственные способности качество работы мозга в разных направлениях.</div>
				<div class="develop__block">
				<div class="develop__block-bg">
					<img src="@/assets/svg/develop-bg.svg" alt="">
				</div>
				<div class="develop__block-ul">
					<div class="develop__li develop__li-1">
					<img src="@/assets/svg/develop-bg-1.svg" alt="">
					</div>
					<div class="develop__block-li">
					<div class="develop__block-title">ПАМЯТЬ</div>
					<div class="develop__block-subtitle">Тренировка памяти это одно из важнейших задач для мозга. Имея хорошую память вы с легкостью и за короткое время сможете осваивать любые навыки и даже профессию.</div>
					</div>
					<div class="develop__li develop__li-2">
					<img src="@/assets/svg/develop-bg-2.svg" alt="">
					</div>
					<div class="develop__block-li">
					<div class="develop__block-title">ВНИМАНИЕ</div>
					<div class="develop__block-subtitle">Научившись концентрировать внимание вы сможете эффективно, безошибочно и с большой скоростью выполнять любые сложные задачи.</div>
					</div>
					<div class="develop__li develop__li-3">
					<img src="@/assets/svg/develop-bg-3.svg" alt="">
					</div>
					<div class="develop__block-li">
					<div class="develop__block-title">МЫШЛЕНИЕ</div>
					<div class="develop__block-subtitle">Тренажеры для развития мышления ускорят работу мозга и его вычеслитетельные способности. Научитесь в уме быстро выполнять сложные арифметические операции.</div>
					</div>
				</div>
				</div>
				<div class="mind__bottom-box">
				<div class="mind__bottom-btn">
					<a href="#preimushestva"><img src="@/assets/svg/mind-bottom-btn.svg" alt=""></a>
				</div>
				</div>
			</div>
			</div>
		</section>
		<section class="main__advantage advantage">
			<div class="container">
			<div class="advantage__inner">
				<div class="develop__top advantage__top">
				<div class="develop__top-svg">
					<img src="@/assets/svg/develop-1.svg" alt="">
				</div>
				<div class="develop__top-title advantage__top-title" id="preimushestva">ПРЕИМУЩЕСТВА ТРЕНАЖЕРОВ</div>
				<div class="develop__top-svg">
					<img src="@/assets/svg/develop-2.svg" alt="">
				</div>
				</div>
				<div class="advantage__content">
				<div class="advantage__ul">
					<div class="advantage__li drop-1">
					<div class="advantage__li-title">Доступны онлайн</div>
					<div class="advantage__li-subtitle">Не нужно скачивать и устанавливать дополнительных приложений.Тренажеры доступны с любого устройства.</div>
					</div>
					<div class="advantage__li drop-2">
					<div class="advantage__li-title">Экономят время</div>
					<div class="advantage__li-subtitle">Для тренировки мозга не нужно много времени. Достаточно 10-20 минут каждый день в любое доступное для вас время.</div>
					</div>
					<div class="advantage__li drop-3">
					<div class="advantage__li-title">Просты в использовании</div>
					<div class="advantage__li-subtitle">Все тренажеры очень просты в использовании. Вы сможете начать тренироваться мгновенно.</div>
					</div>
				</div>
				<div class="advantage__img">
					<img class="advantage__img-0" src="@/assets/svg/advantage-img-0.svg" alt="">
					<img class="advantage__img-1" src="@/assets/svg/advantage-img.svg" alt="">
					<img class="advantage__img-2" src="@/assets/svg/advantage-img-2.svg" alt="">
					<img class="advantage__img-3" src="@/assets/svg/advantage-img-3.svg" alt="">
					<img class="advantage__img-4" src="@/assets/svg/advantage-img-4.svg" alt="">
					<img class="advantage__img-5" src="@/assets/svg/advantage-img-5.svg" alt="">
				</div>
				<div class="advantage__ul">
					<div class="advantage__li drop-4">
					<div class="advantage__li-title">Гибки в использовании</div>
					<div class="advantage__li-subtitle">Все тренажеры очень просты в использовании. Вы сможете начать тренироваться мгновенно.</div>
					</div>
					<div class="advantage__li drop-5">
					<div class="advantage__li-title">Видны результаты</div>
					<div class="advantage__li-subtitle">Все результаты тренировок фиксируются и вы сможете легко отслеживать свои достижения.</div>
					</div>
					<div class="advantage__li drop-6">
					<div class="advantage__li-title">Можно бесплатно</div>
					<div class="advantage__li-subtitle">Можно выполнять упражнения для тренировки мозга совершенно бесплатно. Только с некоторыми ограничениями.</div>
					</div>
				</div>
				</div>
				<div class="mind__bottom-box">
				<div class="mind__bottom-btn">
					<a href="#training"><img src="@/assets/svg/mind-bottom-btn.svg" alt=""></a>
				</div>
				</div>
			</div>
			</div>
		</section>
		<section class="main__trainer trainer">
			<div class="container">
			<div class="trainer__inner">
				<div class="develop__top trainer__top">
				<div class="develop__top-svg">
					<img src="@/assets/svg/develop-1.svg" alt="">
				</div>
				<div class="develop__top-title trainer__top-title" id="training">Тренажеры</div>
				<div class="develop__top-svg">
					<img src="@/assets/svg/develop-2.svg" alt="">
				</div>
				</div>
				<div class="trainer__content">
				<div class="trainer__block">
					<div class="trainer__block-img">
					<img src="@/assets/img/main-trainer-1.jpg" alt="">
					</div>
					<div class="trainer__block-content">
					<div class="trainer__block-title">Прокачайте свою память</div>
					<div class="trainer__block-textbox trainer__textbox-blue">
						<div class="trainer__block-text">Специально разработанные психологами тренажеры для развития памяти позволяют научиться сохранять в голове не только множество новой информации, но и дают практические навыки по ее структурированию, определению прядка, преобразованию в образы и длительному хранению.
						</div>
					</div>
					<div class="trainer__block-ul">
						<div class="trainer__block-li">
						<div class="trainer__block-li-top">
							<div class="trainer__block-li-svg">
							<img src="@/assets/svg/trainer-1.svg" alt="">
							</div>
							<div class="trainer__block-li-title">Учитесь запоминать списки</div>
						</div>
						<div class="trainer__block-li-bot">Длинные цепочки несвязанных между собой слов станут для вас легко запоминаемы, и за покупками в магазин вы уже не будете брать с собой список, все и так будет в памяти.</div>
						</div>
						<div class="trainer__block-li">
						<div class="trainer__block-li-top">
							<div class="trainer__block-li-svg">
							<img src="@/assets/svg/trainer-8.svg" alt="">
							</div>
							<div class="trainer__block-li-title">Телефонный справочник в голове</div>
						</div>
						<div class="trainer__block-li-bot">А как на счет большого объема цифр? Занимайтесь развитием памяти регулярно и все важные номера, пароли и реквизиты платежных карт просто поселяться на постоянное место жительства в вашей голове.</div>
						</div>
						<div class="trainer__block-li">
						<div class="trainer__block-li-top">
							<div class="trainer__block-li-svg">
							<img src="@/assets/svg/trainer-3.svg" alt="">
							</div>
							<div class="trainer__block-li-title">Никакой забывчивости в старости</div>
						</div>
						<div class="trainer__block-li-bot">Давно доказано врачами, что умственные занятия и изучение новых умений, значительно снижают риск развития заболеваний головного мозга в пожилом возрасте. Тренируйте свой мозг и встречайте старость с радостью и ясным умом.</div>
						</div>
					</div>
					</div>
				</div>
				<div class="trainer__block">
					<div class="trainer__block-content">
					<div class="trainer__block-title">Владейте своим вниманием</div>
					<div class="trainer__block-textbox trainer__textbox-purple">
						<div class="trainer__block-text">Тренажеры для работы с вниманием и концентрацией направленны на обретение способностей более продуктивно работать с получаемой информацией и позволяют научиться реагировать только на важные вещи, а все, что не несет ценности для вас, игнорировать.</div>
					</div>
					<div class="trainer__block-ul">
						<div class="trainer__block-li">
						<div class="trainer__block-li-top">
							<div class="trainer__block-li-svg">
							<img src="@/assets/svg/trainer-4.svg" alt="">
							</div>
							<div class="trainer__block-li-title">Научитесь видеть больше</div>
						</div>
						<div class="trainer__block-li-bot">Постоянные тренировки, помогают научиться замечать больше деталей и мелких вещей, на которые ранее просто не хватало внимания.</div>
						</div>
						<div class="trainer__block-li">
						<div class="trainer__block-li-top">
							<div class="trainer__block-li-svg">
							<img src="@/assets/svg/trainer-5.svg" alt="">
							</div>
							<div class="trainer__block-li-title">Держите в фокусе только главное</div>
						</div>
						<div class="trainer__block-li-bot">При постоянном неудержимом потоке информации с различных систем-анализаторов организма, наш мозг учится определять что из этого важно, помогите ему это делать лучше и быстрее.</div>
						</div>
						<div class="trainer__block-li">
						<div class="trainer__block-li-top">
							<div class="trainer__block-li-svg">
							<img src="@/assets/svg/trainer-6.svg" alt="">
							</div>
							<div class="trainer__block-li-title">Станьте образцом в работе</div>
						</div>
						<div class="trainer__block-li-bot">Давно доказано врачами, что умственные занятия и изучение новых умений, значительно снижают риск развития заболеваний головного мозга в пожилом возрасте. Тренируйте свой мозг и встречайте старость с радостью и ясным умом.</div>
						</div>
					</div>
					</div>
					<div class="trainer__block-img">
					<img src="@/assets/img/main-trainer-2.jpg" alt="">
					</div>
				</div>
				<div class="trainer__block trainer__block-reverse">
					<div class="trainer__block-img">
					<img src="@/assets/img/main-trainer-3.jpg" alt="">
					</div>
					<div class="trainer__block-content">
					<div class="trainer__block-title">Расширьте границы мышления</div>
					<div class="trainer__block-textbox trainer__textbox-green">
						<div class="trainer__block-text">Не стоит мыслить сложившимися стереотипами, для стабильного роста личности, будьте открыты к новым взглядам и умственным приемам. Тренажеры для мышления заставляют взглянуть на знакомые вам вещи по другому и поискать нестандартное решение.</div>
					</div>
					<div class="trainer__block-ul">
						<div class="trainer__block-li">
						<div class="trainer__block-li-top">
							<div class="trainer__block-li-svg">
							<img src="@/assets/svg/trainer-7.svg" alt="">
							</div>
							<div class="trainer__block-li-title">Находите выход легко</div>
						</div>
						<div class="trainer__block-li-bot">Качественное развитие креативного мышления, позволяет быстро и эффективно находить выход из любой сложившейся ситуации, для такого работника нет неразрешимых задач, а с проектами он справляется легко и неординарно.</div>
						</div>
						<div class="trainer__block-li">
						<div class="trainer__block-li-top">
							<div class="trainer__block-li-svg">
							<img src="@/assets/svg/trainer-8.svg" alt="">
							</div>
							<div class="trainer__block-li-title">Телефонный справочник в голове</div>
						</div>
						<div class="trainer__block-li-bot">Творческие способности есть у каждого человека с рождения, однако их можно как развивать, так и угашать. Уникальные занятия на развитие творчества – ценный вклад в развитие личности.</div>
						</div>
						<div class="trainer__block-li">
						<div class="trainer__block-li-top">
							<div class="trainer__block-li-svg">
							<img src="@/assets/svg/trainer-3.svg" alt="">
							</div>
							<div class="trainer__block-li-title">Никакой забывчивости в старости</div>
						</div>
						<div class="trainer__block-li-bot">Умение оперировать абстрактными понятиями, позволяет размышлять о вещах и понятиях не известных вам до этого момента. Такой навык полезен , когда перед вами не стандартная ситуация.</div>
						</div>
					</div>
					</div>
				</div>
				</div>
			</div>
			</div>
		</section>
		</main>
	<Footer />
</template>

<script>
import $ from 'jquery'
import BurgerMenu from '../components/BurgerMenu.vue'
import Footer from '../components/Footer.vue'

export default {
	name: 'Home',
	components: {BurgerMenu, Footer},
	mounted() {
		$(".drop-1").hover(function() {
			$('.drop-1').addClass('drop--left');
			$('.advantage__img-1').addClass('advantage__img--show');
			$('.drop-1').addClass('advantage__li--active');
			$('.advantage__img-0').addClass('advantage__img--hide');
		});
		$(".drop-1").mouseleave(function() {
			$('.drop-1').removeClass('drop--left');
			$('.advantage__img-1').removeClass('advantage__img--show');
			$('.drop-1').removeClass('advantage__li--active');
			$('.advantage__img-0').removeClass('advantage__img--hide');
		});

		$(".drop-2").hover(function() {
			$('.drop-2').addClass('drop--left');
			$('.advantage__img-2').addClass('advantage__img--show');
			$('.drop-2').addClass('advantage__li--active');
			$('.advantage__img-0').addClass('advantage__img--hide');
		});
		$(".drop-2").mouseleave(function() {
			$('.drop-2').removeClass('drop--left');
			$('.advantage__img-2').removeClass('advantage__img--show');
			$('.drop-2').removeClass('advantage__li--active');
			$('.advantage__img-0').removeClass('advantage__img--hide');
		});

		$(".drop-3").hover(function() {
			$('.drop-3').addClass('drop--left');
			$('.advantage__img-3').addClass('advantage__img--show');
			$('.drop-3').addClass('advantage__li--active');
			$('.advantage__img-0').addClass('advantage__img--hide');
		});
		$(".drop-3").mouseleave(function() {
			$('.drop-3').removeClass('drop--left');
			$('.advantage__img-3').removeClass('advantage__img--show');
			$('.drop-3').removeClass('advantage__li--active');
			$('.advantage__img-0').removeClass('advantage__img--hide');
		});

		$(".drop-4").hover(function() {
			$('.drop-4').addClass('drop--right');
			$('.advantage__img-4').addClass('advantage__img--show');
			$('.drop-4').addClass('advantage__li--active');
			$('.advantage__img-0').addClass('advantage__img--hide');
		});
		$(".drop-4").mouseleave(function() {
			$('.drop-4').removeClass('drop--right');
			$('.advantage__img-4').removeClass('advantage__img--show');
			$('.drop-4').removeClass('advantage__li--active');
			$('.advantage__img-0').removeClass('advantage__img--hide');
		});

		$(".drop-5").hover(function() {
			$('.drop-5').addClass('drop--right');
			$('.advantage__img-5').addClass('advantage__img--show');
			$('.drop-5').addClass('advantage__li--active');
			$('.advantage__img-0').addClass('advantage__img--hide');
		});
		$(".drop-5").mouseleave(function() {
			$('.drop-5').removeClass('drop--right');
			$('.advantage__img-5').removeClass('advantage__img--show');
			$('.drop-5').removeClass('advantage__li--active');
			$('.advantage__img-0').removeClass('advantage__img--hide');
		});

		$(".drop-6").hover(function() {
			$('.drop-6').addClass('drop--right');
			$('.drop-6').addClass('advantage__li--active');
		});
		$(".drop-6").mouseleave(function() {
			$('.drop-6').removeClass('drop--right');
			$('.drop-6').removeClass('advantage__li--active');
		});
	}
}
</script>

<style scoped>
*{padding: 0;margin: 0;border: 0;}
*,*:before,*:after{-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;}
:focus,:active{outline: none;}
a:focus,a:active{outline: none;}
nav,footer,header,aside{display: block;}
html,body{
  height:100%;width:100%;
  font-size:100%;line-height:1;-ms-text-size-adjust:100%;-moz-text-size-adjust:100%;-webkit-text-size-adjust:100%;}
input,button,textarea{font-family:inherit;}
input::-ms-clear{display: none;}
button{cursor: pointer;}
button::-moz-focus-inner{padding:0;border:0;}
a,a:visited{text-decoration: none;}
a:hover{text-decoration: none;}
ul li{list-style: none;}
img{vertical-align: top;}
h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight: inherit;}
a{color:inherit;}

/* GLOBAL  -------------------------------------------------------------*/
body {
  font-family: 'Open Sans', sans-serif;
  color: #000;
}
.wrapper {
  min-height: 100%;
  width: 100%;
  overflow: hidden;
}
.burger__btn{
  display: none;
}
.container{
  max-width: 1140px;
  padding: 0 15px;
  margin: 0 auto;
  height: 100%;
}
.overlay{

}
.burger {
  display: none;
}
.burger--follow {
}
/* HEADER  -------------------------------------------------------------*/
.header {
  margin-top: 40px;
}
.header__menu{
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
}
.header__logo {
  margin-right: 15px;
}
.header__nav {
}
.header__nav-list {
  display: flex;
  flex-direction: row;
  align-items: center;
}
.header__nav-item {
  margin-right: 36px;
  font-size: 16px;
  font-style: normal;
  font-weight: 600;
  line-height: 170%; /* 27.2px */
  color: #333;
}
.header__nav-item:last-child {
  margin-right: 0px;
}
.header__nav-link {
  transition: all .3s;
}
.header__nav-link:hover {
  transition: all .3s;
  color: #3281FF;
}
.header__btn-box {
  display: flex;
  flex-direction: row;
  align-items: center;
}
.header__btn {
  background: #3281FF;
  padding: 10px 42px;
  border-radius: 10px;
  margin-right: 32px;
  text-align: center;
  font-size: 16px;
  font-style: normal;
  font-weight: 700;
  line-height: 170%; /* 27.2px */
  color: #FFF;
}
.button {
}
.header__user-navbox{
}
.header__user-nav {
}
.user-nav-1 {
}
.user-nav-2 {
  display: none;
}
/* MAIN  -------------------------------------------------------------*/
.main {
  margin-top: 120px;
}
.main__mind {
  margin-bottom: 68px;
}
.mind {
}
.main__develop {
  margin-top: 110px;
  margin-bottom: 102px;
}
.develop {
}
.main__advantage {
  margin-top: 80px;
  margin-bottom: 80px;
}
.advantage {
}
.main__trainer {
  margin-top: 80px;
  margin-bottom: 100px;
}
.header__left{
  display: flex;
  align-items: center;
}


/* MAIN-MIND  -------------------------------------------------------------*/
.mind__inner {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  margin-bottom: 29px;
}
.mind__block {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  border: 3px solid rgba(255, 255, 255, 0.58);
  background: rgba(255, 255, 255, 0.40);
  backdrop-filter: blur(5.5px);
  border-radius: 60px;
  width: 822px;
  height: 658px;
}
.mind__bg{
  position: relative;
}
.mind__bg::before{
  content: "";
  position: absolute;
  width: 594px;
  height: 700px;
  top: 10px;
  right: 0px;
  z-index: -1;
  background: url('~@/assets/svg/main-mind.svg') no-repeat;
}
.mind__block-title {
  font-size: 63px;
  font-style: normal;
  font-weight: 800;
  line-height: 140%; /* 88.2px */
  color: #222;
  max-width: 680px;
  margin-bottom: 25px;
}
.mind__block-title br{
  display: none;
}
.mind__block-subtitle {
  font-size: 21px;
  font-style: normal;
  font-weight: 400;
  line-height: 170%; /* 35.7px */
  color: #555;
  margin-bottom: 30px;
  max-width: 560px;
}
.mind__btn {
  background: var(--Primary-Landing-Page-3, #3281FF);
  padding: 16px 20px;
  text-align: center;
  font-size: 21.785px;
  font-style: normal;
  font-weight: 700;
  line-height: 170%; /* 37.034px */
  color: #FFF;
  border-radius: 10px;
}
.mind__bottom-box {
  display: flex;
  flex-direction: row;
  justify-content: center;
}
.mind__bottom-btn {
  cursor: pointer;
}
/* MAIN-DEVELOP  -------------------------------------------------------------*/
.develop__inner {
}
.develop__top {
  display: flex;
  flex-direction: row;
  justify-content: center;
  position: relative;
  margin-bottom: 50px;
}
.develop__top::before {
  content: "";
  position: absolute;
  bottom: 1px;
  left: 50%;
  transform: translateX(-50%);
  background: #222;
  width: 61%;
  height: 3px;
}
.develop__top-svg{

}
.develop__svg-1 {
}
.develop__svg-2 {
  display: none;
}
.develop__top-title {
  font-size: 54px;
  font-style: normal;
  font-weight: 800;
  line-height: 140%; /* 75.6px */
  color: #222;
  padding: 0 38px;
  white-space: nowrap;
  text-transform: uppercase;
}
.develop__subtitle {
  text-align: center;
  font-size: 21px;
  font-style: normal;
  font-weight: 400;
  line-height: 170%; /* 35.7px */
  color: #555;
  margin: 0 auto;
  margin-bottom: 50px;
  max-width: 850px;
}
.develop__block {
}
.develop__block-bg {
  display: flex;
  justify-content: center;
  z-index: -1;
  position: relative;
}
.develop__block-ul {
  display: grid;
  grid-template-columns: repeat(3, auto);
  grid-template-rows: repeat(1, auto);
  justify-content: center;
  column-gap: 35px;
  margin-top: -50px;
  margin-bottom: 30px;
}
.develop__block-li {
  border: 1px solid #D8D8D8;
  background: rgba(255, 255, 255, 0.40);
  backdrop-filter: blur(3.5px);
  border-radius: 16px;
  padding: 16px 15px;
  max-width: 284px;
  width: 100%;
}
.develop__block-title {
  text-align: center;
  font-size: 32.224px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%; /* 45.114px */
  color: #222;
  margin-bottom: 7px;
}
.develop__block-subtitle {
  text-align: center;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 170%; /* 23.8px */
  color: #555;
}
.develop__li{
  display: none;
}
/* ADVANTAGE-MIND  -------------------------------------------------------------*/
.advantage__top{
  position: relative;
  margin-bottom: 80px;
}
.advantage__top::before {
  content: "";
  position: absolute;
  bottom: 2px;
  left: 50%;
  transform: translateX(-50%);
  background: #222;
  width: 93%;
  height: 3px;
}
.advantage__top-title{
  margin-bottom: 7px;
}
.advantage__content {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  margin-bottom: 30px;
}
.advantage__ul {
  margin-top: 30px;
}
.advantage__li {
  display: flex;
  flex-direction: column;
  justify-content: center;
  border: 1px solid #D8D8D8;
  background: rgba(255, 255, 255, 0.40);
  backdrop-filter: blur(3.5px);
  border-radius: 16px;
  max-width: 344px;
  max-height: 170px;
  width: 100%;
  height: 100%;
  padding: 18px 31px;
  margin-bottom: 27px;
  cursor: pointer;
  transition: all .3s;
}
.advantage__li--active{
  border-radius: 16px;
  border: 1px solid #3281FF;
  background: rgba(255, 255, 255, 0.40);
  backdrop-filter: blur(6.5px);
}
.advantage__li-title {
  text-align: center;
  font-size: 28px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%; /* 39.2px */
  color: #222;
  margin-bottom: 5px;
}
.advantage__li-subtitle {
  text-align: center;
  font-size: 12px;
  font-style: normal;
  font-weight: 400;
  line-height: 170%; /* 20.4px */
  color: #555;
}
.advantage__img {
  height: 612px;
}
.advantage__img-1 {
  display: none;
}
.advantage__img-2 {
  display: none;
}
.advantage__img-3 {
  display: none;
}
.advantage__img-4 {
  display: none;
}
.advantage__img-5 {
  display: none;
}
.advantage__img--show{
  display: block;
}
.advantage__img--hide{
  display: none;
}
.advantage__li--active .advantage__li-title{
  color: #3281FF;
}
.drop--left{
  transition: all .3s;
  transform: translateX(20%);
}
.drop--right{
  transition: all .3s;
  transform: translateX(-20%);
}
/* TRAINER-MIND  -------------------------------------------------------------*/
.trainer__inner {
}
.trainer__top {
  position: relative;
  margin-bottom: 70px;
}
.trainer__top::before {
  content: "";
  position: absolute;
  bottom: 1px;
  left: 50%;
  transform: translateX(-50%);
  background: #222;
  width: 71%;
  height: 3px;
}
.trainer__top-title{
  padding: 0 174px;
}
.trainer__content {
}
.trainer__block {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 50px;
}
.trainer__block:last-child {
  margin-bottom: 0px;
}

.trainer__block-content {
  max-width: 650px;
}
.trainer__block-title {
  text-align: right;
  font-size: 26px;
  font-style: normal;
  font-weight: 800;
  line-height: 140%; /* 36.4px */
  text-transform: uppercase;
  color: #222;
  margin-bottom: 22px;
}
.trainer__block-textbox {
  text-align: justify;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
  color: #000;
}
.trainer__block-text {
  margin-bottom: 28px;
  margin-left: 15px;
}
.trainer__block-ul {
  margin-left: 45px;
}
.trainer__block-li {
  margin-bottom: 16px;
}
.trainer__block-li:last-child {
  margin-bottom: 0px;
}
.trainer__block-li-top {
  display: flex;
  flex-direction: row;
  align-items: center;
  margin-bottom: 9px;
}
.trainer__block-li-svg {
  margin-right: 10px;
}
.trainer__block-li-title {
  font-size: 16px;
  font-style: normal;
  font-weight: 700;
  line-height: 140%; /* 22.4px */
  color: #000;
}
.trainer__block-li-bot {
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
  color: #000;
  margin-left: 40px;
}
.trainer__textbox-blue{
  position: relative;
}
.trainer__textbox-purple{
  position: relative;
}
.trainer__textbox-green{
  position: relative;
}
.trainer__textbox-blue::before{
  content: "";
  position: absolute;
  height: 100%;
  width: 3px;
  left: 0px;
  top: 0px;
  border-radius: 2px;
  background: #3281FF;
}
.trainer__textbox-purple::before{
  content: "";
  position: absolute;
  height: 100%;
  width: 3px;
  left: 0px;
  top: 0px;
  border-radius: 2px;
  background: #5243AA;
}
.trainer__textbox-green::before{
  content: "";
  position: absolute;
  height: 100%;
  width: 3px;
  left: 0px;
  top: 0px;
  border-radius: 2px;
  background: #009B72;
}
.burger__menu{
  display: none;
}
/* ================================ BREAK-POINTS =========================== */
/* ================================ BREAK-POINTS =========================== */
/* ================================== 1000 ================================ */
@media (max-width: 1000px) {
/* HEADER  -------------------------------------------------------------*/
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
  .header__nav{
    display: none;
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
  /* MAIN-MIND  -------------------------------------------------------------*/
  .mind__block{
    width: 722px;
    height: 658px;
  }
  .mind__bottom-box{
    display: none;
  }

}
/* ================================== 900 ================================ */
@media (max-width: 900px) {
  /* MAIN-DEVELOP  -------------------------------------------------------------*/
  .develop__block-bg{
    display: none;
  }
  .develop__subtitle{
    margin-bottom: 0px;
  }
  .develop__block-ul{
    grid-template-columns: repeat(1, auto);
    grid-template-rows: repeat(6, auto);
    row-gap: 0px;
  }
  .develop__block-li{
    max-width: 100%;
  }
  .develop__li{
    display: block;
    margin: 0 auto;
  }
  .develop__li-1{
    margin-bottom: -120px;
  }
  .develop__li-2{
    margin-bottom: -30px;
  }
  .develop__li-3{
    margin-top: -100px;
    margin-bottom: -120px;
  }
  /*trainer------------------------------------------------------- */
  .trainer__block{
    flex-direction: column;
  }
  .trainer__block-reverse{
    flex-direction: column-reverse;
  }
  .trainer__block-ul{
    margin-left: 0px;
  }
  .trainer__block-li-bot{
    margin-left: 0px
  }
  .trainer__block-li-top{
    margin-left: 44px;
  }
  /*advantage---------------------------------------------------------*/
  .advantage__content{
    flex-direction: column;
  }
  .advantage__ul{
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .advantage__img{
    display: flex;
    justify-content: center;
  }
  .advantage__li.drop--left{
    transform: translateX(5%);
  }
  .advantage__li.drop--right{
    transform: translateX(-5%);
  }
}
/* ================================== 800 ================================ */
@media (max-width: 800px) {
  /* MAIN-MIND  -------------------------------------------------------------*/
  .mind__block{
    width: 100%;
    height: 100%;
    margin-top: 90px;
  }
  .mind__btn{
    margin-bottom: 28px;
  }
  .burger__btn{
    display: block;
  }
  .mind__bg::before{
    content: "";
    position: absolute;
    width: 594px;
    height: 700px;
    top: -80px;
    right: 0px;
    z-index: -1;
    background: url('~@/assets/svg/main-mind.svg') no-repeat;
  }
  /* MAIN-DEVELOP  -------------------------------------------------------------*/
  .develop__top-title{
    font-size: 44px;
  }
  .develop__top::before{
    width: 75%;
  }
  
}
/* ================================== 700 ================================ */
@media (max-width: 700px) {
  .develop__top-title{
    font-size: 34px;
    padding: 0px 10px;
  }
  .develop__top{
    border-bottom: 1px solid black;
    width: fit-content;
    margin: 0 auto;
    margin-bottom: 17px;
    
  }
  .develop__top::before{
    display: none;
  }
  .develop__top-svg {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
  }
  .develop__top-svg img{
    width: 38px;
    height: 39px;
  }
}
/* ================================== 600 ================================ */
@media (max-width: 600px) {
  /* MAIN-MIND  -------------------------------------------------------------*/
  .mind__block{
    width: 100%;
    height: 100%;
    margin-top: 50px;
  }
  .mind__bg::before{
    content: "";
    position: absolute;
    width: 340px;
    height: 343.695px;
    top: -80px;
    right: 50px;
    z-index: -1;
    background: url('~@/assets/svg/main-mind-mb.svg') no-repeat;
  }
  .mind__block-title{
    font-size: 48px;
  }
  /* MAIN-DEVELOP  -------------------------------------------------------------*/
  .develop__top-svg{
    margin-bottom: 0.6px;
  }
  .develop__top-title{
    font-size: 24px;
  }
  .develop__svg-1 {
    display: none;
  }
  .develop__svg-2 {
    display: block;
  }
}
/* ================================== 450 ================================ */
@media (max-width: 450px) {
  
  /* HEADER  -------------------------------------------------------------*/
  .header__btn {
    font-size: 12px;
    padding: 7px 20px;
    margin-right: 17px;
    border-radius: 4px;
  }
  .user-nav-1 {
    display: none;
  }
  .user-nav-2 {
    display: block;
  }
  /* MAIN-DEVELOP  -------------------------------------------------------------*/
  .develop__top-title{
    max-width: 250px;
    white-space: wrap;
    text-align: center
  }
  .develop__subtitle{
    font-size: 16px;
    margin-bottom: -80px;
  }
  .develop__block-title{
    font-size: 18px
  }
  .develop__block-subtitle{
    font-size: 12px;
  }
  /* MAIN-MIND  -------------------------------------------------------------*/
  .mind__block{
    margin-top: 50px;
    border-radius: 23px;
  }
  .mind__bg::before{
    content: "";
    position: absolute;
    width: 340px;
    height: 343.695px;
    top: -80px;
    right: 0px;
    z-index: -1;
    background: url('~@/assets/svg/main-mind-mb.svg') no-repeat;
  }
  .mind__block-title{
    font-size: 38px;
    margin-bottom: 9px;
    font-weight: 700;
  }
  .mind__block-title br{
    display: block;
  }
  .mind__block{
    padding: 25px 18px;
  }
  .mind__block-subtitle{
    font-size: 16px;
    margin-bottom: 16px;
  }
  .mind__btn{
    margin: 0 auto;
    padding: 13px 33px;
    font-size: 12px;
    font-weight: 400;
  }
  /*trainer------------------------------------------------------- */
  .trainer__block-li-top{
    margin-left: 24px;
  }
  .trainer__block-img img{
    width: 100%;
    max-width: 100%;
  }
.header__logo img {
  height: 55px !important;
  margin-right: 15px;
}

}
</style>