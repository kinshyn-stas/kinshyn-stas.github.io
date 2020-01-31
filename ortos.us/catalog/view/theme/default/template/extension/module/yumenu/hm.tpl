<div class="yum <?php echo $amazon ? 'ahmenu' : 'hmenu'; ?><?php echo $box_class ? ' ' . $box_class : ''; ?>">
  <div <?php echo $title_class ? 'class="' . $title_class . '"' : ''; ?>><?php echo $title; ?><span class="nav-bars"></span></div>
  <nav>
    <ul<?php echo $amazon ? '' : ' class="list-overflow"'; ?>>
      <?php 
        $menu = function ($items, $col = '', $level = 1) use ($parameters, &$menu) {
          if($items) {
            foreach ($items as $item) {
              $li_classes = array();

              if ($col) {
                $columns = $col;
              } else if ($item['col']) {
                $columns = $item['col'];
              } else {
                $columns = $parameters['columns'];
              }

              if (isset($item['children']) && $level == 1) {
                if ($columns > 1 ) {
                  $li_classes[] = 'multi-list';

                  if ($parameters['full_width']) {
                      $li_classes[] = 'fw-list';
                  }
                } else {
                  $li_classes[] = 'single-list';
                }
              }

              if ($columns > 1 && $parameters['full_width'] && $level == 2) {
                if ($columns > 5) {
                  $li_classes[] = 'cls';
                } else {
                  $li_classes[] = 'cls-' . $columns;
                }
              }

              if ($columns > 5 && $level == 1) {
                $li_classes[] = 'fw-list';
              }

              if ($item['class']) {
                $li_classes[] = $item['class'];
              }

              if ($item['active'] || $level ==1 && $item['current']) {
                $li_classes[] = 'selected';
              }

              $string_li_classes = implode(' ', $li_classes);

              echo '<li';

              if ($string_li_classes) {
                echo ' class="' . $string_li_classes . '"';
              }

              echo '>';

              if ($columns > 1) {
                if ($level == 2) {
                  echo '<div class="img-' . $parameters['img_position'] . '"><a';

                  if ($item['href']) {
                    echo ' href="' . $item['href'] . '"';
                  }

                  if ($item['target']) {
                    echo ' target="_blank"';
                  }

                  if ($item['current']) {
                    echo ' class="current"';
                  }

                  echo '>';

                  if ($parameters['img_status'] && $item['img']) {
                    if ($item['img_type'] == 'img') {
                      echo '<div class="img"><img src="'.$item['img'].'" width="'.$parameters['img_width'].'" height="'.$parameters['img_height'].'" alt="'.$item['alt'].'" title="'.$item['alt'].'" /></div>';
                    } else {
                      echo '<div class="img">'.$item['img'].'</div>';
                    }
                  }

                  if ($parameters['img_position'] == 'left' || $parameters['img_position'] == 'right') {
                    echo '</a><div><a';

                    if ($item['href']) {
                      echo ' href="' . $item['href'] . '"';
                    }

                    if ($item['target']) {
                      echo ' target="_blank"';
                    }

                    if ($item['current']) {
                      echo ' class="current"';
                    }

                    echo '>';
                  }

                  echo '<div class="title"><span>' . $item['title'] . '</span>';

                  if ($item['count']) {
                    echo '<span class="count">' . $item['count'] . '</span>';
                  }

                  echo '</div></a>';

                  if (isset($item['children']) && $parameters['sub_status']) {
                    echo '<span class="toggle"></span>';
                  }


                } else {
                  echo '<div><a';

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

                  echo '>';

                  if ($parameters['img_status'] && $item['img']) {
                    if ($item['img_type'] == 'img') {
                      echo '<span class="icon"><img src="'.$item['img'].'" alt="'.$item['alt'].'" title="'.$item['alt'].'" /></span>';
                    } else {
                      echo '<span class="icon">'.$item['img'].'</span>';
                    }
                  }

                  echo '<span class="title">' . $item['title'] . '</span>';

                  echo '</a>';
                  if ($item['count']) {
                    echo '<span class="count">' . $item['count'] . '</span>';
                  }
                  if (isset($item['children']) && $parameters['sub_status']) {
                    echo '<span class="toggle"></span>';
                  }

                  echo '</div>';
                }
              } else {
                echo '<div><a';

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

                echo '>';

                if ($parameters['img_status'] && $item['img']) {
                  if ($item['img_type'] == 'img') {
                    echo '<span class="icon"><img src="'.$item['img'].'" alt="'.$item['alt'].'" title="'.$item['alt'].'" /></span>';
                  } else {
                    echo '<span class="icon">'.$item['img'].'</span>';
                  }
                }

                echo '<span class="title">' . $item['title'] . '</span>';

                echo '</a>';
                if ($item['count']) {
                  echo '<span class="count">' . $item['count'] . '</span>';
                }
                if (isset($item['children']) && $parameters['sub_status']) {
                  echo '<span class="toggle"></span>';
                }

                echo '</div>';
              }

              if (isset($item['children']) && $parameters['sub_status'] && $level < 11) {

                echo '<ul';
                if ($columns > 1 && $parameters['full_width'] == 0 && $level == 1) {
                  if ($columns > 5) {
                    echo ' class="list-col"';
                  } else {
                    if (count($item['children']) < $columns) {
                      echo ' class="list-col-' . count($item['children']) . '"';
                    } else {
                      echo ' class="list-col-' . $columns . '"';
                    }
                  }
                }
                echo '>';

                if ($columns > 1 && $level > 2) {
                  echo '<li class="prev-list"><div><a class="toggle">' . $parameters['text_back'] . '</a></div></li>';
                }

                if ($parameters['sublimit'] > 0) {
                  echo $menu(array_slice($item['children'],0,$parameters['sublimit']), $columns, $level + 1);
                } else {
                  echo $menu($item['children'], $columns, $level + 1);
                }

                if ($parameters['more_btn'] && $item['href'] && $level > 0) {
                  echo '<li class="more"><div><a href="' . $item['href'] . '">' . $parameters['text_show_more'] . ' "' . $item['title'] . '"</a></div></li>';
                }

                echo '</ul>';
              }

              if ($level == 2 && $columns > 1) {
                if ($parameters['img_position'] == 'left' || $parameters['img_position'] == 'right') {
                  echo '</div>';
                }

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