<?php
	require('template-parts/page-start.php');
	require('template-parts/header-main.php');
?>
  
<!--<script>
  function onSubmit(token) {
	document.getElementById("contactform").submit();
  }

  function validate(event) {
    event.preventDefault();
    if (!document.getElementById('email').value) {			
      		var emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
            var email = $('#email').val();            

            if (!email.match(emailPattern)) {                
                $('#email').css('border-bottom', '2px solid #FF0000');
				$('#email').after('<span style="text-align:center;display:block;color:#ff1100">Введите корректный email</span>')				
            }
    } else {
      grecaptcha.execute();
    }
  }

  function onload() {
    var element = document.getElementById('send');
    element.onclick = validate;
  }
</script>-->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <main class="testimonialpage">
		<section class="container-fluid firstblock">
			<div class="row">
				<h2 class="backblock-heading">Reviews</h2>
				<div class="container">
					<div class="row">
						<div class="col-12 content-part">
							<h1 class="frontblock-heading">Отзывы о нашей работе</h1>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="container-fluid secondblock">
			<div class="example_box">

				<div class="example_item">
					<figure class="example_image">
						<img src="img/examples/example_1.png" alt="" />
					</figure>
					<h3 class="example_title">Inveria</h3>
					<p>Экосистема для интеллектуального и творческого развития</p>
				</div>

				<div class="example_item">
					<figure class="example_image">
						<img src="img/examples/example_2.png" alt="" />
					</figure>
					<h3 class="example_title">Green Tech Trade</h3>
					<p>Официальный представитель солнечных панелей First Solar и Zorlu Energy в Украине</p>
				</div>

				<div class="example_item">
					<figure class="example_image">
						<img src="img/examples/example_3.png" alt="" />
					</figure>
					<h3 class="example_title">Наш Формат</h3>
					<p>Издательство, специализирующееся на нехудожественной литературе (нон-фикшн)</p>
				</div>

				<div class="example_item">
					<figure class="example_image">
						<img src="img/examples/example_4.png" alt="" />
					</figure>
					<h3 class="example_title">Klitschko Expo</h3>
					<p>Выставка-музей достижений легендарных братьев Кличко</p>
				</div>

				<div class="example_item">
					<figure class="example_image">
						<img src="img/examples/example_5.png" alt="" />
					</figure>
					<h3 class="example_title">Vera Brezhneva</h3>
					<p>Официальный представитель солнечных панелей First Solar и Zorlu Energy в Украине</p>
				</div>

				<div class="example_item">
					<figure class="example_image">
						<img src="img/examples/example_6.png" alt="" />
					</figure>
					<h3 class="example_title">Self Invest</h3>
					<p>Легальное трудоустройство студентов в Германии в период зимних и летних каникул</p>
				</div>

			</div>
		</section>
		<section class="container-fluid thirdblock">
			<div class="testimonial_box">

				<div class="testimonial_item">
					<div class="testimonial_content">
						<div class="testimonial_text">
							<p class="testimonial_title">Татьяна Марченко</p>
							<p class="testimonial_undertitle">Менеджер по работе с клиентами</p>
							<div class="testimonial_text_content">
								<p>Имея свой сайт с 2006 года, мы обратились в агенство easy-agency с просьбой оценить наш сайт на актуальность. В результате оценки специалистами этой компании было рекомендовано разработать новый современный сайт с учетом необходимости онлайн-работы на всех видах устройствах.</p>
								<p>Поскольку Inveria является одним из основных предприятий украинской авиационной промышленности, то и требования к сайту нашей компании максимальные. Сайт, разработанный для нас агенством easy-agency, вполне соответствует заданному уровню и выполняет все требования.</p>
							</div>
						</div>
						<figure class="testimonial_media">
							<img class="testimonial_image" src="img/mockup.png" alt="" />
							<a class="testimonial_image_link">Смотреть оригинал</a>
						</figure>
					</div>
				</div>

				<div class="testimonial_item">
					<div class="testimonial_content">
						<div class="testimonial_text">
							<p class="testimonial_title">Владислав Демченко</p>
							<p class="testimonial_undertitle">Директор Green Tech Trade</p>
							<div class="testimonial_text_content">
								<p>Имея свой сайт с 2006 года, мы обратились в агенство easy-agency с просьбой оценить наш сайт на актуальность. В результате оценки специалистами этой компании было рекомендовано разработать новый современный сайт с учетом необходимости онлайн-работы на всех видах устройствах.</p>
								<p>Поскольку Inveria является одним из основных предприятий украинской авиационной промышленности, то и требования к сайту нашей компании максимальные. Сайт, разработанный для нас агенством easy-agency, вполне соответствует заданному уровню и выполняет все требования.</p>
							</div>
						</div>
						<figure class="testimonial_media">
							<img class="testimonial_image" src="img/mockup_2.png" alt="" />
							<a class="testimonial_image_link">Смотреть оригинал</a>
						</figure>
					</div>
				</div>

				<div class="testimonial_item">
					<div class="testimonial_content">
						<div class="testimonial_text">
							<p class="testimonial_title">Татьяна Марченко</p>
							<p class="testimonial_undertitle">Менеджер по работе с клиентами</p>
							<div class="testimonial_text_content">
								<p>Имея свой сайт с 2006 года, мы обратились в агенство easy-agency с просьбой оценить наш сайт на актуальность. В результате оценки специалистами этой компании было рекомендовано разработать новый современный сайт с учетом необходимости онлайн-работы на всех видах устройствах.</p>
								<p>Поскольку Inveria является одним из основных предприятий украинской авиационной промышленности, то и требования к сайту нашей компании максимальные. Сайт, разработанный для нас агенством easy-agency, вполне соответствует заданному уровню и выполняет все требования.</p>
							</div>
						</div>
						<figure class="testimonial_media">
							<img class="testimonial_image" src="img/mockup.png" alt="" />
							<a class="testimonial_image_link">Смотреть оригинал</a>
						</figure>
					</div>
				</div>

				<div class="testimonial_item">
					<div class="testimonial_content">
						<div class="testimonial_text">
							<p class="testimonial_title">Владислав Демченко</p>
							<p class="testimonial_undertitle">Директор Green Tech Trade</p>
							<div class="testimonial_text_content">
								<p>Имея свой сайт с 2006 года, мы обратились в агенство easy-agency с просьбой оценить наш сайт на актуальность. В результате оценки специалистами этой компании было рекомендовано разработать новый современный сайт с учетом необходимости онлайн-работы на всех видах устройствах.</p>
								<p>Поскольку Inveria является одним из основных предприятий украинской авиационной промышленности, то и требования к сайту нашей компании максимальные. Сайт, разработанный для нас агенством easy-agency, вполне соответствует заданному уровню и выполняет все требования.</p>
							</div>
						</div>
						<figure class="testimonial_media">
							<img class="testimonial_image" src="img/mockup_2.png" alt="" />
							<a class="testimonial_image_link">Смотреть оригинал</a>
						</figure>
					</div>
				</div>

				<div class="testimonial_item">
					<div class="testimonial_content">
						<div class="testimonial_text">
							<p class="testimonial_title">Татьяна Марченко</p>
							<p class="testimonial_undertitle">Менеджер по работе с клиентами</p>
							<div class="testimonial_text_content">
								<p>Имея свой сайт с 2006 года, мы обратились в агенство easy-agency с просьбой оценить наш сайт на актуальность. В результате оценки специалистами этой компании было рекомендовано разработать новый современный сайт с учетом необходимости онлайн-работы на всех видах устройствах.</p>
								<p>Поскольку Inveria является одним из основных предприятий украинской авиационной промышленности, то и требования к сайту нашей компании максимальные. Сайт, разработанный для нас агенством easy-agency, вполне соответствует заданному уровню и выполняет все требования.</p>
							</div>
						</div>
						<figure class="testimonial_media">
							<img class="testimonial_image" src="img/mockup.png" alt="" />
							<a class="testimonial_image_link">Смотреть оригинал</a>
						</figure>
					</div>
				</div>

				<div class="testimonial_item">
					<div class="testimonial_content">
						<div class="testimonial_text">
							<p class="testimonial_title">Владислав Демченко</p>
							<p class="testimonial_undertitle">Директор Green Tech Trade</p>
							<div class="testimonial_text_content">
								<p>Имея свой сайт с 2006 года, мы обратились в агенство easy-agency с просьбой оценить наш сайт на актуальность. В результате оценки специалистами этой компании было рекомендовано разработать новый современный сайт с учетом необходимости онлайн-работы на всех видах устройствах.</p>
								<p>Поскольку Inveria является одним из основных предприятий украинской авиационной промышленности, то и требования к сайту нашей компании максимальные. Сайт, разработанный для нас агенством easy-agency, вполне соответствует заданному уровню и выполняет все требования.</p>
							</div>
						</div>
						<figure class="testimonial_media">
							<img class="testimonial_image" src="img/mockup_2.png" alt="" />
							<a class="testimonial_image_link">Смотреть оригинал</a>
						</figure>
					</div>
				</div>

			</div>
   		</section>
		<!--<section class="container-fluid secondblock">
			<div class="row">
				<div class="container">
					<div class="row work-content-block">
						<div class="col-12 col-lg-6 left-part">
							<h4>Мы находимся</h4>
							<p>
		            Easy-Agency<br>
								Украина, Киев<br>
								<a href="https://goo.gl/maps/vYwZhmkgQAedMqpf6" target="_blank">пр-т. В. Лобановского, 6а</a>
		          </p>
						</div>
						<div class="col-12 col-lg-6 right-part">
							<h4>Наши контакты</h4>
		          <p>
		            <a href="tel:+380934686757">+38 (093) 468-67-57</a><br>
		            <a href="mailto:support@easy-agency.com">support@easy-agency.com</a>
		          </p>
						</div>
					</div>
				</div>
			</div>
    	</section>-->
  </main>
<?php
	// require('template-parts/footer-main.php');
	require('template-parts/page-end.php');
?>
