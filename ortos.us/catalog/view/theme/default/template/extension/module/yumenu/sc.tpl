<div class="yum showcase<?php echo $box_class ? ' ' . $box_class : ''; ?>">
  <div <?php echo $title_class ? 'class="' . $title_class . '"' : ''; ?>><?php echo $title; ?><span class="nav-bars"></span></div>
  <nav>
    <ul>
      <?php 
        $menu = function ($items, $level = 1) use ($parameters, &$menu) {
          if($items) {
            foreach ($items as $item) {
              $li_classes = array();

              if ($level == 1) {
                $li_classes[] = 'grid-view';
              }

              if ($item['active']) {
                $li_classes[] = 'selected';
              }

              if ($item['class']) {
                $li_classes[] = $item['class'];
              }

              $string_li_classes = implode(' ', $li_classes);

              echo '<li';

              if ($string_li_classes) {
                echo ' class="' . $string_li_classes . '"';
              }

              echo '>';

              if ($level == 1) {
                echo '<div class="img-' . $parameters['img_position'] . '">';
              }

              if ($parameters['img_position'] == 'left' || $parameters['img_position'] == 'right') {

                if ($parameters['img_status'] && $item['img'] && $level == 1) {
                  echo '<a';
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

                  echo '</a>';
                }

                echo '<div>';

                if ($parameters['img_status'] && $item['img'] && $level > 1) {
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

                if (isset($item['children']) && $parameters['sub_status'] && $level > 1) {
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

                echo '><span class="title">' . $item['title'] . '</span>';

                if ($item['count']) {
                  echo '<span class="count">' . $item['count'] . '</span>';
                }

                echo '</a>';

                if (isset($item['children']) && $parameters['sub_status'] && $level > 1) {
                  echo '<span class="toggle"></span>';
                }

                if ($level > 1) {
                  echo '</div>';
                }
              } else {

                if ($level > 1) {
                  echo '<div>';
                }


                echo '<a';
                if ($item['href']) {
                  echo ' href="' . $item['href'] . '"';
                }

                if ($item['target']) {
                  echo ' target="_blank"';
                }

                $a_classes = array();

                if (isset($item['children']) && $parameters['sub_status'] && $level > 1) {
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

                echo '>';

                if ($parameters['img_status'] && $item['img']) {
                  if ($item['img_type'] == 'img') {
                    echo '<span class="icon"><img src="'.$item['img'].'"';

                    if ($level == 1) {
                      echo ' width="'.$parameters['img_width'].'" height="'.$parameters['img_height'].'"';
                    }

                    echo ' alt="'.$item['alt'].'" title="'.$item['alt'].'" /></span>';
                  } else {
                    echo '<span class="icon">'.$item['img'].'</span>';
                  }
                }

                if ($level == 1) {
                  echo '<div class="title">';
                }

                echo '<span>' . $item['title'] . '</span>';

                if ($item['count']) {
                  echo '<span class="count">' . $item['count'] . '</span>';
                }

                if ($level == 1) {
                  echo '</div>';
                }

                echo '</a>';

                if (isset($item['children']) && $parameters['sub_status'] && $level > 1) {
                  echo '<span class="toggle"></span>';
                }

                if ($level > 1) {
                  echo '</div>';
                }
              }

              if (isset($item['children']) && $parameters['sub_status'] && $level < 11) {
                echo '<ul';

                if ($item['active']) {
                  echo ' class="list-active"';
                }

                echo '>';

                if ($level > 1) {
                  echo '<li class="prev-list"><div><a class="toggle">' . $parameters['text_back'] . '</a></div></li>';
                }

                if ($parameters['sublimit'] > 0) {
                  echo $menu(array_slice($item['children'],0,$parameters['sublimit']), $level + 1);
                } else {
                  echo $menu($item['children'], $level + 1);
                }

                if ($parameters['more_btn'] && $item['href']) {
                  echo '<li class="more"><div><a href="' . $item['href'] . '">' . $parameters['text_show_more'] . ' "' . $item['title'] . '"</a></div></li>';
                }

                echo '</ul>';

                if ($level == 1 && ($parameters['img_position'] == 'left' || $parameters['img_position'] == 'right')) {
                  echo '</div>';
                }

              }

              if ($level == 1) {
                echo '</div>';
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