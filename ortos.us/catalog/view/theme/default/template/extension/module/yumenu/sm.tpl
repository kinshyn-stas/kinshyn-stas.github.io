<div class="mmenu">
  <div <?php echo $title_class ? 'class="' . $title_class . '"' : ''; ?>><a href="#mmenu"><?php echo $title; ?><span class="nav-bars"></span></a></div>
  <nav id="mmenu">
    <ul>
      <?php 
        $menu = function ($items, $level = 0) use ($parameters, &$menu) {
          if($items) {
            foreach ($items as $item) {
              $li_classes = array();

              if ($item['class']) {
                $li_classes[] = $item['class'];
              }

              if ($item['active']) {
                $li_classes[] = 'selected';
              }

              $string_li_classes = implode(' ', $li_classes);

              echo '<li';

              if ($string_li_classes) {
                echo ' class="' . $string_li_classes . '"';
              }

               echo '><a';

              if ($item['href']) {
                echo ' href="' . $item['href'] . '"';
              }

              if ($item['target']) {
                echo ' target="_blank"';
              }

              echo '><span>' . $item['title'] . '</span>';

              if ($item['count']) {
                echo '<span class="count">' . $item['count'] . '</span>';
              }

              echo '</a>';

              if (isset($item['children']) && $parameters['sub_status'] && $level < 11) {
                echo '<ul>';

                if ($parameters['sublimit'] > 0) {
                  echo $menu(array_slice($item['children'],0,$parameters['sublimit']), $level + 1);
                } else {
                  echo $menu($item['children'], $level + 1);
                }

                if ($parameters['more_btn'] && $item['href']) {
                  echo '<li class="more"><a href="' . $item['href'] . '">' . $parameters['text_show_more'] . ' "' . $item['title'] . '"</a></li>';
                }

                echo '</ul>';
              }

              echo '</li>';
            }
          }
        };
        $menu($items);
      ?>
    </ul>
  </nav>
</div>

<script type="text/javascript"><!--
$('#mmenu').mmenu({
  'navbar': {
    'title':'<?php echo $title; ?>'
  }
});
//--></script>