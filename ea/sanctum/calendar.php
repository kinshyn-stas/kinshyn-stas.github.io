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
								<h1 class="main_head content-center">Календарь программ</h1>
							</div>
						</div>
					</div>
					<!-- CONTACTS BLOCK -->
					<div class="container">
						<div class="row">
							<div class="col-12">
								<img src="img/pages/calendar/calendar-img.svg" alt="">
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
