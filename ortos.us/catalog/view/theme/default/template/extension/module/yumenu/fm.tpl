<div class="yum fmenu<?php echo $box_class ? ' ' . $box_class : ''; ?>">
  <div <?php echo $title_class ? 'class="' . $title_class . '"' : ''; ?>><?php echo $title; ?><span class="nav-bars"></span></div>
  <nav>
    <ul>
      <?php 
        $menu = function ($items, $level = 1) use ($parameters, &$menu) {
          if($items) {
            foreach ($items as $item) {
              $li_classes = array();

              if (isset($item['children']) && $level == 1) {
                if ($parameters['columns'] > 1 || $parameters['single_push']) {
                  $li_classes[] = 'multi-list';

                  if ($parameters['single_push']) {
                    $li_classes[] = 'single-push';
                  }
                } else {
                  $li_classes[] = 'single-list';
                }
              }

              if ($level == 2 && ($parameters['columns'] > 1 || $parameters['single_push'])) {
                $li_classes[] = 'list-item';
              }

              if ($parameters['columns'] > 1 && $level == 2) {
                if ($parameters['columns'] > 10) {
                  $li_classes[] = 'cls';
                } else {
                  $li_classes[] = 'cls-' . $parameters['columns'];
                }
              }

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

              echo '>';

              if ($parameters['img_status'] && $item['img'] && $level == 2 && ($parameters['columns'] > 1 || $parameters['single_push'])) {
                echo '<p class="item-img"><a';

                if ($item['href']) {
                  echo ' href="' . $item['href'] . '"';
                }

                if ($item['target']) {
                  echo ' target="_blank"';
                }

                echo '>';

                if ($item['img_type'] == 'img') {
                  echo '<span class="icon"><img src="'.$item['img'].'" width="'.$parameters['img_width'].'" height="'.$parameters['img_height'].'" alt="'.$item['alt'].'" title="'.$item['alt'].'" /></span>';
                } else {
                  echo '<span class="icon">'.$item['img'].'</span>';
                }

                echo '</a></p>';
              }

              echo '<div>';

              if ($parameters['img_status'] && $item['img']) {
                if ($parameters['columns'] < 2 && (!$parameters['single_push'] || $parameters['single_push'] && $level != 2) || ($parameters['columns'] > 1 && $level != 2)) {
                  if ($item['img_type'] == 'img') {
                    echo '<span class="icon"><img src="'.$item['img'].'" alt="'.$item['alt'].'" title="'.$item['alt'].'" /></span>';
                  } else {
                    echo '<span class="icon">'.$item['img'].'</span>';
                  }
                }
              }

              echo '<a';

              if ($item['href']) {
                echo ' href="' . $item['href'] . '"';
              }

              if ($item['target']) {
                echo ' target="_blank"';
              }

              $a_classes = array();

              if (isset($item['children']) && $parameters['sub_status']) {
                if (!$item['href'] || $item['empty']) {
                  $a_classes[] = 'toggle';
                }
              }

              if ($item['current']) {
                $a_classes[] = 'current';
              }

              $string_a_classes = implode(' ', $a_classes);

              if ($string_a_classes) {
                echo ' class="' . $string_a_classes . '"';
              }

              echo '>' . $item['title'] . '</a>';

              if ($item['count']) {
                echo '<span class="count">' . $item['count'] . '</span>';
              }

              if (isset($item['children']) && $parameters['sub_status']) {
                echo '<span class="toggle"></span>';
              }

              echo '</div>';

              if (isset($item['children']) && $parameters['sub_status'] && $level < 11) {
                echo '<ul>';

                if ($level > 2 && ($parameters['columns'] > 1 || $parameters['single_push'])) {
                  echo '<li class="prev-list"><div><a class="toggle">' . $parameters['text_back'] . '</a></div></li>';
                }

                if ($parameters['sublimit'] > 0) {
                  echo $menu(array_slice($item['children'],0,$parameters['sublimit']), $level + 1);
                } else {
                  echo $menu($item['children'], $level + 1);
                }

                if ($parameters['more_btn'] && $item['href'] && $level > 0) {
                  echo '<li class="more"><div><a href="' . $item['href'] . '">' . $parameters['text_show_more'] . ' "' . $item['title'] . '"</a></div></li>';
                }

                echo '</ul>';
              }
              echo '</li>';
            }
          }
        };

        if ($parameters['mainlimit'] > 0) {
          echo $menu(array_slice($items,0,$parameters['mainlimit']));

          if ($parameters['main_more_btn'] && count($items) > $parameters['mainlimit']) {
            echo '<ul class="more-wrapper">';
            echo $menu(array_slice($items,$parameters['mainlimit']), $level = 1);
            echo '</ul>';

            echo '<li class="selected menu-more-btn" data-show-more="' . $parameters['text_show_more'] . '" data-hide-more="' . $parameters['text_hide_more'] . '"><div><a>' . $parameters['text_show_more'] . '</a></div></li>';
          }

        } else {
          echo $menu($items);
        }

      ?>
    </ul>
  </nav>
</div>