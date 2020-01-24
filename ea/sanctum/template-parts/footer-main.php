  <footer class="main-footer container-fluid">
      <div class="row">
        <div class="main-footer__block container">
          <div class="row">
            <div class="col-12 col-lg-3 footer__logo logo">
              <a href="/" class="logo__url">
                <img src="/img/logo.svg" alt="" class="logo__img">
              </a>
              <p class="logo__text">
                Твоя студия йоги в центре Киева
              </p>
            </div>
            <div class="col-12 col-lg-6 footer-nav-block">
              <nav class="footer-nav">
                <ul class="nav-list">
                  <li class="nav-item">
                    <a href="https://<?= $_SERVER['HTTP_HOST']; ?>/" class="nav-item__url">Главная</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://<?= $_SERVER['HTTP_HOST']; ?>/aboutus" class="nav-item__url">Кто мы</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://<?= $_SERVER['HTTP_HOST']; ?>/programs" class="nav-item__url">Программы</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://<?= $_SERVER['HTTP_HOST']; ?>/calendar" class="nav-item__url">Календарь</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://<?= $_SERVER['HTTP_HOST']; ?>/events" class="nav-item__url">События</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://<?= $_SERVER['HTTP_HOST']; ?>/bar" class="nav-item__url">Бар</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://<?= $_SERVER['HTTP_HOST']; ?>/blog" class="nav-item__url">Блог</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://<?= $_SERVER['HTTP_HOST']; ?>/contacts" class="nav-item__url">Контакты</a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="col-12 col-lg-3 footer-contacts-block">
              <div class="contacts-block">
                <a href="tel:+380931234567" class="contacts-block__url contacts-block__url__phone">+38 (093) 123-45-67</a>
                <a href="mailto:example@gmail.com" class="contacts-block__url contacts-block__url__mail">example@gmail.com</a>
              </div>
              <?php require($_SERVER['DOCUMENT_ROOT'].'template-parts/soc-list.php'); ?>
            </div>
          </div>
        </div>
      </div>
  </footer>
