<?php
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/page-start.php');
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/header-main.php');
?>
  <main class="content-area container-fluid">
		<div class="row">
			<article class="article-content container-fluid homepage">
				<div class="bg-container"></div>
				<section class="article-body main-content row">
					<!-- SLIDER BLOCK -->
					<div class="any-slider home-slider container">
						<div class="slide-item row valigncenter">
							<div class="col-12 col-lg-6 left-side">
								<h1 class="main_head">Гибкое тело — здоровое тело</h1>
								<h5 class="sub_head">С Андреем Федорив каждый вторник и среду с 19:00 до 21:00</h5>
								<a href="#" class="btn btn-main openformbtn">ЗАПИСАТЬСЯ</a>
							</div>
							<div class="col-12 col-lg-6 right-side">
								<img src="img/pages/homepage/img_homeslide1.png" alt="" class="imgcont">
							</div>
						</div>
						<div class="slide-item row valigncenter">
							<div class="col-12 col-lg-6 left-side">
								<h1 class="main_head">Гибкое тело — здоровое тело2</h1>
								<h5 class="sub_head">С Андреем Федорив каждый вторник и среду с 19:00 до 21:00</h5>
								<a href="#" class="btn btn-main openformbtn">ЗАПИСАТЬСЯ</a>
							</div>
							<div class="col-12 col-lg-6 right-side">
								<img src="img/pages/homepage/img_homeslide1.png" alt="" class="imgcont">
							</div>
						</div>
						<div class="slide-item row valigncenter">
							<div class="col-12 col-lg-6 left-side">
								<h1 class="main_head">Гибкое тело — здоровое тело3</h1>
								<h5 class="sub_head">С Андреем Федорив каждый вторник и среду с 19:00 до 21:00</h5>
								<a href="#" class="btn btn-main openformbtn">ЗАПИСАТЬСЯ</a>
							</div>
							<div class="col-12 col-lg-6 right-side">
								<img src="img/pages/homepage/img_homeslide1.png" alt="" class="imgcont">
							</div>
						</div>
					</div>
					<!-- ABOUT US BLOCK -->
					<div class="home-aboutus container">
						<div class="row side-item side-item__right">
							<div class="col-12 col-lg-10 bg-part">
								<div class="bg-block" style="background-image: url(/img/pages/homepage/img_home_aboutus.jpg);">

								</div>
							</div>
							<div class="col-12 col-lg-7 info-part">
								<div class="info-block">
									<h2 class="block_head">Sanctum пространство</h2>
									<p class="info__text">Это йога-центр, расположенный в городе Киев.<br>
	Мы искренне любим то, что делаем, поэтому вложили весь свой многолетний опыт, чтобы создать настоящее место силы.<br>
	В нашем центре мы собрали воедино лучшие йога-практики, чтобы дать вам возможность погрузиться в мир единения и духовно-физического просвещения.</p>
									<a href="/aboutus" class="btn btn-main">ПОДРОБНЕЕ О НАС</a>
								</div>
							</div>
						</div>
					</div>
					<!-- ADVANTAGES BLOCK -->
					<!-- ADVANTAGES BLOCK -->
					<div class="advantages-block container">
						<?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/adv-block.php'); ?>
					</div>
					<!-- EVENTS BLOCK -->
					<div class="home-events container">
						<div class="row home-events__line head_line">
							<div class="col-12 col-lg-7 info-part">
								<h2 class="block_head">Наши события</h2>
								<h4 class="sub_head">Мы подготовили направления наших занятий таким образом, чтобы охватить основные духовные и функциональные особенности организма. Всё вместе образует гармонию.</h4>
							</div>
							<div class="col-12 col-lg-5 url-part">
								<a href="/events" class="btn btn-second">ВСЕ СОБЫТИЯ</a>
							</div>
						</div>
						<div class="row scroll-frame events-scroll">
							<div class="scroll-frame__row">
								<div class="col-12 scroll-frame__item">
									<div class="events-item__img img-part" style="background-image: url(/img/pages/homepage/img_home_aboutbar.jpg);">

									</div>
									<div class="events-item__info row">
										<div class="col-6 left-part">
											<h4 class="item__head">
												Хатха Йога
											</h4>
											<h5 class="item__name">
												Андрей Федорив
											</h5>
											<h6 class="item__date">
												12.09.2019
											</h6>
										</div>
										<div class="col-6 right-part">
											<a href="/events/singleevent" class="btn btn-main">ПОДРОБНЕЕ</a>
										</div>
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="events-item__img img-part" style="background-image: url(/img/pages/homepage/img_home_aboutbar.jpg);">

									</div>
									<div class="events-item__info row">
										<div class="col-6 left-part">
											<h4 class="item__head">
												Хатха Йога
											</h4>
											<h5 class="item__name">
												Андрей Федорив
											</h5>
											<h6 class="item__date">
												12.09.2019
											</h6>
										</div>
										<div class="col-6 right-part">
											<a href="/events/singleevent" class="btn btn-main">ПОДРОБНЕЕ</a>
										</div>
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="events-item__img img-part" style="background-image: url(/img/pages/homepage/img_home_aboutbar.jpg);">

									</div>
									<div class="events-item__info row">
										<div class="col-6 left-part">
											<h4 class="item__head">
												Хатха Йога
											</h4>
											<h5 class="item__name">
												Андрей Федорив
											</h5>
											<h6 class="item__date">
												12.09.2019
											</h6>
										</div>
										<div class="col-6 right-part">
											<a href="/events/singleevent" class="btn btn-main">ПОДРОБНЕЕ</a>
										</div>
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="events-item__img img-part" style="background-image: url(/img/pages/homepage/img_home_aboutbar.jpg);">

									</div>
									<div class="events-item__info row">
										<div class="col-6 left-part">
											<h4 class="item__head">
												Хатха Йога
											</h4>
											<h5 class="item__name">
												Андрей Федорив
											</h5>
											<h6 class="item__date">
												12.09.2019
											</h6>
										</div>
										<div class="col-6 right-part">
											<a href="/events/singleevent" class="btn btn-main">ПОДРОБНЕЕ</a>
										</div>
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="events-item__img img-part" style="background-image: url(/img/pages/homepage/img_home_aboutbar.jpg);">

									</div>
									<div class="events-item__info row">
										<div class="col-6 left-part">
											<h4 class="item__head">
												Хатха Йога
											</h4>
											<h5 class="item__name">
												Андрей Федорив
											</h5>
											<h6 class="item__date">
												12.09.2019
											</h6>
										</div>
										<div class="col-6 right-part">
											<a href="/events/singleevent" class="btn btn-main">ПОДРОБНЕЕ</a>
										</div>
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
					<!-- ABOUT BAR BLOCK -->
					<div class="home-aboutbar container">
						<div class="row side-item side-item__left">
							<div class="col-12 col-lg-10 bg-part">
								<div class="bg-block" style="background-image: url(/img/pages/homepage/img_home_aboutbar.jpg);">

								</div>
							</div>
							<div class="col-12 col-lg-7 info-part">
								<div class="info-block">
									<h2 class="block_head">Кушай здорово с нами</h2>
									<p class="info__text">Это йога-центр, расположенный в городе Киев.<br>
Мы искренне любим то, что делаем, поэтому вложили весь свой многолетний опыт, чтобы создать настоящее место силы.</p>
									<a href="/bar" class="btn btn-main">ПОДРОБНЕЕ О БАРЕ</a>
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
					<!-- ONE FREE LESSEON BLOCK -->
					<?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/onefree-block.php'); ?>
					<!-- CONTACTS BLOCK -->
					<div class="home-contacts container-fluid">
						<div class="home-contacts__line row">
							<div class="col-12 col-lg-7 map-block">
								<?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/gmap.php'); ?>
							</div>
							<div class="col-12 col-lg-5 contacts-block">
								<h2 class="block_head">Контакты</h2>
								<div class="contacts-block__line">
									<h5 class="line_head">Телефон</h5>
									<a href="tel:+380931234567" class="contacts-block__url contacts-block__url__phone">+38 (093) 123-45-67</a>
								</div>
								<div class="contacts-block__line">
									<h5 class="line_head">Адрес</h5>
									<p class="contacts-block__text">Украина, Киев, Вознесенский спуск, 13</p>
								</div>
								<div class="contacts-block__line">
									<h5 class="line_head">Почта</h5>
									<a href="mailto:example@gmail.com" class="contacts-block__url contacts-block__url__mail">example@gmail.com</a>
								</div>
								<div class="contacts-block__line">
									<h5 class="line_head">Мы в социальных сетях</h5>
									<?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/soc-list.php'); ?>
								</div>
							</div>
						</div>
					</div>
				</section>
			</article>
		</div>
  </main>
<?php
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/footer-main.php');
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/page-end.php');
?>
