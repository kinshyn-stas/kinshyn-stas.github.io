<div class="yum amenu<?php echo $box_class ? ' ' . $box_class : ''; ?>">
  <div <?php echo $title_class ? 'class="' . $title_class . '"' : ''; ?>><?php echo $title; ?><span class="nav-bars"></span></div>
  <nav>
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

              echo '><div';
              if ($level > 0) {
               echo ' style="padding-left: ' . ($level+.5) . 'em"';
              }
               echo '>';

              if ($parameters['img_status'] && $item['img']) {
                if ($item['img_type'] == 'img') {
                  echo '<span class="icon"><img src="'.$item['img'].'" alt="'.$item['alt'].'" title="'.$item['alt'].'" /></span>';
                } else {
                  echo '<span class="icon">'.$item['img'].'</span>';
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
                echo '<ul';

                if ($item['active']) {
                  echo ' class="list-active"';
                }

                echo '>';

                if ($parameters['sublimit'] > 0) {
                  echo $menu(array_slice($item['children'],0,$parameters['sublimit']), $level + 1);
                } else {
                  echo $menu($item['children'], $level + 1);
                }

                if ($parameters['more_btn'] && $item['href']) {
                  echo '<li class="more"><div style="padding-left: ' . ($level+1.5) . 'em"><a href="' . $item['href'] . '">' . $parameters['text_show_more'] . ' "' . $item['title'] . '"</a></div></li>';
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
            echo '<div class="more-wrapper">';
            echo $menu(array_slice($items,$parameters['mainlimit']), $level = 0);
            echo '</div>';

            echo '<li class="selected menu-more-btn" data-show-more="' . $parameters['text_show_more'] . '" data-hide-more="' . $parameters['text_hide_more'] . '"><div><a>' . $parameters['text_show_more'] . '</a></div></li>';
          }

        } else {
          echo $menu($items);
        }

      ?>
    </ul>
  </nav>
</div>