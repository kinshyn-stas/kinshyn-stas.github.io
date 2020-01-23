  <header class="main-header container-fluid">
    <div class="row">
      <div class="main-header__block container">
          <div class="logo">
            <a href="/" class="logo__url">
              <img src="/img/logo.svg" alt="" class="logo__img">
            </a>
          </div>
          <nav class="main-nav">
            <ul class="nav-list">
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
          <div class="main-header__widget">
            <div class="contacts-block">
              <a href="tel:+380931234567" class="contacts-block__url contacts-block__url__phone">+38 (093) 123-45-67</a>
            </div>
          </div>
          <div class="main-header__navbtn">
            <a href="#" class="nav-icon">
              <span></span>
              <span></span>
              <span></span>
            </a>
          </div>
      </div>
    </div>
  </header>
