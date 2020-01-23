<?php
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/page-start.php');
	require($_SERVER['DOCUMENT_ROOT'].'template-parts/header-main.php');
?>
  <main class="content-area container-fluid">
		<div class="row">
			<article class="article-content container-fluid page404">
				<div class="bg-container"></div>
				<section class="article-body main-content row">
					<div class="container">
						<div class="row valigncenter">
							<div class="col-12 col-lg-6 left-side">
								<h1 class="main_head">Страница не найдена</h1>
								<h5 class="sub_head">Возможно, она устарела или вы ввели неправильный адрес</h5>
								<a href="/" class="btn btn-main">ВЕРНУТЬСЯ НА ГЛАВНУЮ</a>
							</div>
							<div class="col-12 col-lg-6 right-side">
								<img src="img/pages/page404/img404.svg" alt="" class="imgcont">
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
