<?php
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/page-start.php');
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/header-main.php');
?>
  <main class="content-area container-fluid">
		<div class="row">
			<article class="article-content container-fluid contactspage">
				<div class="bg-container"></div>
				<section class="article-body main-content row">
					<div class="container">
						<div class="row valigncenter page-header-block">
							<div class="col-12 col-lg-6 left-side">
								<h1 class="main_head">Контакты</h1>
								<h5 class="sub_head">Студия йоги и здорового питания SANCTUM в центре Киева</h5>
							</div>
						</div>
					</div>
					<!-- CONTACTS BLOCK -->
					<div class="contacts-part container">
						<div class="contacts-part__line row">
							<div class="col-12 col-lg-7 map-block">
								<?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/gmap.php'); ?>
							</div>
							<div class="col-12 col-lg-5 contacts-block">
								<h2 class="block_head">Свяжитесь с нами</h2>
								<div class="contacts-block__line">
									<h5 class="line_head">Запись на занятия</h5>
									<a href="tel:+380931234567" class="contacts-block__url contacts-block__url__phone">+38 (093) 123-45-67</a> <br>
									<a href="tel:+380681234567" class="contacts-block__url contacts-block__url__phone">+38 (068) 123-45-67</a>
								</div>
								<div class="contacts-block__line">
									<h5 class="line_head">График работы</h5>
									<p class="contacts-block__text">Пн-пт с 08:00 до 17:00 <br>Сб-вс с 11:00 до 16:00</p>
								</div>
								<div class="contacts-block__line">
									<h5 class="line_head">Адрес</h5>
									<p class="contacts-block__text">Украина, Киев, <br>Вознесенский спуск, 13</p>
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
