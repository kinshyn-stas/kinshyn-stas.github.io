<?php
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/page-start.php');
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/header-main.php');
?>
  <main class="content-area container-fluid">
		<div class="row">
			<article class="article-content container-fluid calendarpage singlepage">
				<div class="bg-container"></div>
				<section class="article-body main-content row">
					<div class="container">
						<div class="row valigncenter page-header-block">
							<div class="col-12 left-side">
								<h1 class="main_head content-center">Юлия Москаленко</h1>
								<h4 class="sub_head content-center">Преподаватель Шахти йоги</h4>
								<div class="content-center">
									<?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/soc-list.php'); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="row side-item side-item__right">
							<div class="col-12 col-lg-10 bg-part">
								<div class="bg-block" style="background-image: url(/img/pages/homepage/img_home_aboutus.jpg);">

								</div>
							</div>
							<div class="col-12 col-lg-7 info-part">
								<div class="info-block">
									<h2 class="block_head">О преподавателе</h2>
									<p class="info__text">8 лет занималась танцами в спортивно-эстрадном ансамбле.
Затем увлекалась восточными единоборствами. Стала посещать разные направления йоги. Преподавала хатха-йогу, акро-йогу как для коллектива, так и частно. Нашла себя в коллективе файер-шоу, где помимо искусства огня обучали парной акробатике и элементам акро-йоги. Считаю fly-йогу идеальным занятием для людей, которые хотят совместить активность</p>
								</div>
							</div>
						</div>
					</div>
					<!-- CONTACTS BLOCK -->
					<div class="container">
						<div class="row">
							<div class="col-12">
								<h2 class="block_head content-center">Расписание тренера</h2>
							</div>
							<div class="col-12">
								<img src="/img/pages/calendar/calendar-img.svg" alt="">
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
