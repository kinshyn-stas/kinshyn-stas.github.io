<?php
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/page-start.php');
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/header-main.php');
?>
  <main class="content-area container-fluid">
		<div class="row">
			<article class="article-content container-fluid barpage">
				<div class="bg-container"></div>
				<section class="article-body main-content row">
					<div class="container">
						<div class="row valigncenter page-header-block">
							<div class="col-12 col-lg-6 left-side">
								<h1 class="main_head">Здоровая еда — залог здорового тела и духа</h1>
								<h5 class="sub_head">Мы точно знаем, что полезная еда может быть вкусной, <br>
а здоровый образ жизни — приносить удовольствие</h5>
							</div>
						</div>
					</div>
					<!-- INFO BLOCK -->
					<div class="container">
						<div class="row">
							<div class="col-12">
								<h2 class="block_head">Немного о питаниии</h2>
							</div>
						</div>
						<div class="row side-item side-item__bar side-item__right">
							<div class="col-12 col-lg-8 bg-part">
								<div class="bg-block" style="background-image: url(img/pages/homepage/img_home_aboutus.jpg);">

								</div>
							</div>
							<div class="col-12 col-lg-7 info-part">
								<div class="info-block">
									<p class="info__text">Хатха йога - это древняя система, целью которой является достижение вершин развития человека  с помощью специальных телесно-ориентированных практик и знаний о человеческом организме. Здоровье в йоге понимается комплексно, объединяя единство и гармонию физического, психического, и духовного начала.</p>
								</div>
							</div>
						</div>
					</div>
					<!-- SLIDE LINE -->
					<div class="bar-slider container">
						<div class="row bar-slider__line head_line">
							<div class="col-12 col-lg-7 info-part">
								<h2 class="block_head">Наши полезные салаты</h2>
								<h4 class="sub_head">Всегда свежие овощи. Готовим при вас. Очень вкусно.</h4>
							</div>
						</div>
						<div class="row scroll-frame bar-scroll">
							<div class="scroll-frame__row">
								<div class="col-12 scroll-frame__item">
									<div class="bar-item__img img-part" style="background-image: url(img/pages/bar/menuitem1.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="bar-item__img img-part" style="background-image: url(img/pages/bar/menuitem1.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="bar-item__img img-part" style="background-image: url(img/pages/bar/menuitem1.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="bar-item__img img-part" style="background-image: url(img/pages/bar/menuitem1.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="bar-item__img img-part" style="background-image: url(img/pages/bar/menuitem1.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="bar-item__img img-part" style="background-image: url(img/pages/bar/menuitem1.jpg);">
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
					<!-- SLIDE LINE -->
					<div class="bar-slider container">
						<div class="row bar-slider__line head_line">
							<div class="col-12 col-lg-7 info-part">
								<h2 class="block_head">Тонизирующие напитки</h2>
								<h4 class="sub_head">На любой вкус: с фруктами, овощами.</h4>
							</div>
						</div>
						<div class="row scroll-frame bar-scroll">
							<div class="scroll-frame__row">
								<div class="col-12 scroll-frame__item">
									<div class="bar-item__img img-part" style="background-image: url(img/pages/bar/menuitem2.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="bar-item__img img-part" style="background-image: url(img/pages/bar/menuitem2.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="bar-item__img img-part" style="background-image: url(img/pages/bar/menuitem2.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="bar-item__img img-part" style="background-image: url(img/pages/bar/menuitem2.jpg);">
									</div>
								</div>
								<div class="col-12 scroll-frame__item">
									<div class="bar-item__img img-part" style="background-image: url(img/pages/bar/menuitem2.jpg);">
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
