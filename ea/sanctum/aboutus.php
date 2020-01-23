<?php
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/page-start.php');
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/header-main.php');
?>
  <main class="content-area container-fluid">
		<div class="row">
			<article class="article-content container-fluid aboutuspage">
				<div class="bg-container">
					<div class="playbtn-block">
						<a href="#" class="playbtn" target="_blank"></a>
						<span class="btntext">Посмотрите видео о нас</span>
						<div class="videoblk">
							<iframe width="100%" height="360" src="https://www.youtube-nocookie.com/embed/u5960wdImQM?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
				</div>
				<section class="article-body main-content row">
					<div class="container">
						<div class="row valigncenter page-header-block">
							<div class="col-12 col-lg-6 left-side">
								<h1 class="main_head">Студия йоги и здорового питания SANCTUM</h1>
							</div>
						</div>
					</div>
					<!-- EABOUT US SLIDER -->
					<div class="aboutus-slider container">
						<div class="row aboutus-slider__line head_line">
							<div class="col-12 col-lg-6 info-part">
								<h2 class="block_head">Пространство для работы над собой</h2>
								<h4 class="sub_head">Мы — команда активных и вовлеченных перфекцеонистов. Мы создаем увлекательную среду, в которой классно раскрывать свои таланты и потенциал.</h4>
							</div>
						</div>
						<div class="row scroll-frame aboutus-scroll">
							<div class="scroll-frame__row">
								<div class="col-12 scroll-frame__item">
									<div class="aboutus-item__img img-part" style="background-image: url(img/pages/aboutus/abusitem1.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="aboutus-item__img img-part" style="background-image: url(img/pages/aboutus/abusitem1.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="aboutus-item__img img-part" style="background-image: url(img/pages/aboutus/abusitem1.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="aboutus-item__img img-part" style="background-image: url(img/pages/aboutus/abusitem1.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="aboutus-item__img img-part" style="background-image: url(img/pages/aboutus/abusitem1.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="aboutus-item__img img-part" style="background-image: url(img/pages/aboutus/abusitem1.jpg);">
									</div>
								</div>
							</div>
						</div>
						<div class="frame-scrollbar">
							<div class="handle">
								<div class="mousearea"></div>
							</div>
						</div>
					</div>
					<!-- ADVANTAGES BLOCK -->
					<div class="advantages-block container">
						<div class="row advantages-block__line">
							<div class="col-12">
								<h2 class="block_head">Преимущества зала</h2>
							</div>
						</div>
						<?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/adv-block.php'); ?>
					</div>
					<!-- TESM BLOCK -->
					<div class="container-fluid tesm-block">
						<div class="row">
							<div class="col-12 tesm-content">
								<p class="tesm_text">
									Мы стремимся открывать и развивать самые сильные и эффективные практики для здоровья, красоты и сознания таким образом, чтобы горячая йога и самые новые, передовые направления тренировок были доступны всем.
								</p>
							</div>
						</div>
					</div>
					<!-- OUR TECHERS -->
					<div class="container teachers-block__line">
						<div class="row">
							<div class="col-12">
								<h2 class="block_head">Наши преподаватели</h2>
							</div>
						</div>
					</div>
					<div class="container teachers-block side-item-list">
						<!-- ITEM -->
						<div class="row side-item">
							<div class="col-12 col-lg-5 bg-part">
								<div class="bg-block" style="background-image: url(img/pages/aboutus/teachitem1.jpg);">

								</div>
							</div>
							<div class="col-12 col-lg-6 info-part">
								<div class="info-block">
									<div class="info-block__head">
										<div class="left-part">
											<h2 class="block_head">Юлия Москаленко</h2>
											<h4 class="sub_head">Преподаватель Шакти йоги</h4>
										</div>
										<div class="right-part">
											<?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/soc-list.php'); ?>
										</div>
									</div>
									<p class="info__text">Это йога-центр, расположенный в городе Киев.
Мы искренне любим то, что делаем, поэтому вложили весь свой многолетний опыт, чтобы создать настоящее место.</p>
									<a href="/calendar/yuliamoskalenko" class="btn btn-second">СМОТРЕТЬ РАСПИСАНИЕ</a>
								</div>
							</div>
						</div>
						<!-- ITEM -->
						<div class="row side-item">
							<div class="col-12 col-lg-5 bg-part">
								<div class="bg-block" style="background-image: url(img/pages/aboutus/teachitem1.jpg);">

								</div>
							</div>
							<div class="col-12 col-lg-6 info-part">
								<div class="info-block">
									<div class="info-block__head">
										<div class="left-part">
											<h2 class="block_head">Юлия Москаленко</h2>
											<h4 class="sub_head">Преподаватель Шакти йоги</h4>
										</div>
										<div class="right-part">
											<?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/soc-list.php'); ?>
										</div>
									</div>
									<p class="info__text">Это йога-центр, расположенный в городе Киев.
Мы искренне любим то, что делаем, поэтому вложили весь свой многолетний опыт, чтобы создать настоящее место.</p>
									<a href="/calendar/yuliamoskalenko" class="btn btn-second">СМОТРЕТЬ РАСПИСАНИЕ</a>
								</div>
							</div>
						</div>
						<!-- ITEM -->
						<div class="row side-item">
							<div class="col-12 col-lg-5 bg-part">
								<div class="bg-block" style="background-image: url(img/pages/aboutus/teachitem1.jpg);">

								</div>
							</div>
							<div class="col-12 col-lg-6 info-part">
								<div class="info-block">
									<div class="info-block__head">
										<div class="left-part">
											<h2 class="block_head">Юлия Москаленко</h2>
											<h4 class="sub_head">Преподаватель Шакти йоги</h4>
										</div>
										<div class="right-part">
											<?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/soc-list.php'); ?>
										</div>
									</div>
									<p class="info__text">Это йога-центр, расположенный в городе Киев.
Мы искренне любим то, что делаем, поэтому вложили весь свой многолетний опыт, чтобы создать настоящее место.</p>
									<a href="/calendar/yuliamoskalenko" class="btn btn-second">СМОТРЕТЬ РАСПИСАНИЕ</a>
								</div>
							</div>
						</div>
					</div>
					<!-- ABON BLOCK -->
					<div class="abon-block container">
						<div class="row abon-block__line">
							<div class="col-12">
								<h2 class="block_head content-center">Абонементы</h2>
							</div>
						</div>
						<?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/tarif-block.php'); ?>
					</div>
					<!-- CONTACT FORM MAIN -->
					<?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/contact-form-block.php'); ?>
				</section>
			</article>
		</div>
  </main>
<?php
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/footer-main.php');
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/page-end.php');
?>
