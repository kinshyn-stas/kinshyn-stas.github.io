<?php
/** no direct access **/
defined('_MECEXEC_') or die();

$styling = $this->main->get_styling();
$event_colorskin = (isset($styling['mec_colorskin'] ) || isset($styling['color'])) ? 'colorskin-custom' : '';
$settings = $this->main->get_settings();

// colorful
$colorful_flag = $colorful_class = '';
if($this->style == 'colorful')
{
	$colorful_flag = true;
	$this->style = 'modern';
	$colorful_class = ' mec-event-grid-colorful';
}
  
?>
<div class="mec-wrap <?php echo $event_colorskin . $colorful_class; ?>">
    <div class="mec-event-grid-<?php echo $this->style; ?>">
        <?php
        $count = $this->count;

        if($count == 0 or $count == 5) $col = 4;
        else $col = 12 / $count;

        $rcount = 1 ;
        echo ($rcount == 1) ? '<div class="row">' : '';

        foreach($this->events as $date):
        foreach($date as $event):
        
        $location = isset($event->data->locations[$event->data->meta['mec_location_id']])? $event->data->locations[$event->data->meta['mec_location_id']] : array();
        $organizer = isset($event->data->organizers[$event->data->meta['mec_organizer_id']])? $event->data->organizers[$event->data->meta['mec_organizer_id']] : array();
        $event_color = isset($event->data->meta['mec_color']) ? '<span class="event-color" style="background: #'.$event->data->meta['mec_color'].'"></span>' : '';
        $start_time = (isset($event->data->time) ? $event->data->time['start'] : '');
        $end_time = (isset($event->data->time) ? $event->data->time['end'] : ''); 
        // colorful
		$colorful_bg_color = ($colorful_flag && isset($event->data->meta['mec_color'])) ? ' style="background: #' . $event->data->meta['mec_color'] . '"' : '';

        ?>
        <?php if($this->style == 'modern'): ?>
            <div class="event-grid-modern-head clearfix">
                <?php if(isset($settings['multiple_day_show_method']) && $settings['multiple_day_show_method'] == 'all_days') : ?>
                    <div class="mec-event-date"><?php echo date_i18n($this->date_format_modern_1, strtotime($event->date['start']['date'])); ?></div>
                    <div class="mec-event-month"><?php echo date_i18n($this->date_format_modern_2, strtotime($event->date['start']['date'])); ?></div>
                <?php else: ?>
                    <div class="mec-event-month"><?php echo $this->main->date_label($event->date['start'], $event->date['end'], $this->date_format_modern_1) . ' ' . $this->main->date_label($event->date['start'], $event->date['end'], $this->date_format_modern_2); ?></div>
                <?php endif; ?>
                <div class="mec-event-detail"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></div>
                <div class="mec-event-day"><?php echo date_i18n($this->date_format_modern_3, strtotime($event->date['start']['date'])); ?></div>
            </div>
            <div class="mec-event-content">
                <h4 class="mec-event-title"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a><?php echo $event_color; ?></h4>
                <p><?php echo (isset($location['address']) ? $location['address'] : ''); ?></p>
            </div>
            <div class="mec-event-footer">
                <a class="mec-booking-button" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>" target="_self"><?php echo (is_array($event->data->tickets) and count($event->data->tickets)) ? $this->main->m('register_button', __('REGISTER', 'mec')) : $this->main->m('view_detail', __('View Detail', 'mec')) ; ?></a>
                <ul class="mec-event-sharing-wrap">
                    <li class="mec-event-share">
                        <a href="#" class="mec-event-share-icon">
                            <i class="mec-sl-share"></i>
                        </a>
                    </li>
                    <ul class="mec-event-sharing"><?php echo $this->main->module('links.list', array('event'=>$event)); ?></ul>
                </ul>
            </div>
        <?php elseif($this->style == 'classic'): ?>
            <div class="mec-event-image"><a href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->thumbnails['medium']; ?></a></div>
            <div class="mec-event-content">
                <?php if(isset($settings['multiple_day_show_method']) && $settings['multiple_day_show_method'] == 'all_days') : ?>
                    <div class="mec-event-date mec-bg-color"><?php echo date_i18n($this->date_format_classic_1, strtotime($event->date['start']['date'])); ?></div>
                <?php else: ?>
                    <div class="mec-event-date mec-bg-color"><?php echo $this->main->date_label($event->date['start'], $event->date['end'], $this->date_format_classic_1); ?></div>
                <?php endif; ?>
                <h4 class="mec-event-title"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a><?php echo $event_color; ?></h4>
                <p><?php echo trim((isset($location['name']) ? $location['name'] : '').', '.(isset($location['address']) ? $location['address'] : ''), ', '); ?></p>
            </div>
            <div class="mec-event-footer">
                <ul class="mec-event-sharing-wrap">
                    <li class="mec-event-share">
                        <a href="#" class="mec-event-share-icon">
                            <i class="mec-sl-share"></i>
                        </a>
                    </li>
                    <ul class="mec-event-sharing"><?php echo $this->main->module('links.list', array('event'=>$event)); ?></ul>
                </ul>
                <a class="mec-booking-button" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>" target="_self"><?php echo (is_array($event->data->tickets) and count($event->data->tickets)) ? $this->main->m('register_button', __('REGISTER', 'mec')) : $this->main->m('view_detail', __('View Detail', 'mec')) ; ?></a>
            </div>
        <?php elseif($this->style == 'minimal'): ?>
            <div class="mec-event-date mec-bg-color-hover mec-border-color-hover mec-color"><span><?php echo date_i18n($this->date_format_minimal_1, strtotime($event->date['start']['date'])); ?></span><?php echo date_i18n($this->date_format_minimal_2, strtotime($event->date['start']['date'])); ?></div>
            <div class="event-detail-wrap">
                <h4 class="mec-event-title"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a><?php echo $event_color; ?></h4>
                <div class="mec-event-detail"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></div>
            </div>
        <?php elseif($this->style == 'clean'): ?>
            <div class="event-grid-t2-head mec-bg-color clearfix">
                <?php if(isset($settings['multiple_day_show_method']) && $settings['multiple_day_show_method'] == 'all_days') : ?>
                    <div class="mec-event-date"><?php echo date_i18n($this->date_format_clean_1, strtotime($event->date['start']['date'])); ?></div>
                    <div class="mec-event-month"><?php echo date_i18n($this->date_format_clean_2, strtotime($event->date['start']['date'])); ?></div>
                <?php else: ?>
                    <div class="mec-event-month"><?php echo $this->main->date_label($event->date['start'], $event->date['end'], $this->date_format_clean_1.' '.$this->date_format_clean_2); ?></div>
                <?php endif; ?>
                <div class="mec-event-detail"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></div>
            </div>
            <div class="mec-event-image"><a href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->thumbnails['medium']; ?></a></div>
            <div class="mec-event-content">
                <h4 class="mec-event-title"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a><?php echo $event_color; ?></h4>
                <p><?php echo (isset($location['address']) ? $location['address'] : ''); ?></p>
            </div>
            <div class="mec-event-footer mec-color">
                <ul class="mec-event-sharing-wrap">
                    <li class="mec-event-share">
                        <a href="#" class="mec-event-share-icon">
                            <i class="mec-sl-share"></i>
                        </a>
                    </li>
                    <ul class="mec-event-sharing"><?php echo $this->main->module('links.list', array('event'=>$event)); ?></ul>
                </ul>
                <a class="mec-booking-button" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>" target="_self"><?php echo (is_array($event->data->tickets) and count($event->data->tickets)) ? $this->main->m('register_button', __('REGISTER', 'mec')) : $this->main->m('view_detail', __('View Detail', 'mec')) ; ?></a>
            </div>
        <?php elseif($this->style == 'novel'): ?>
            <div class="novel-grad-bg"></div>
            <div class="mec-event-content">
                <div class="mec-event-image"><a href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->thumbnails['thumblist']; ?></a></div>
                <div class="mec-event-detail-wrap">
                    <h4 class="mec-event-title"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a></h4>
                    <?php if(isset($settings['multiple_day_show_method']) && $settings['multiple_day_show_method'] == 'all_days') : ?>
                        <div class="mec-event-month"><?php echo date_i18n($this->date_format_novel_1, strtotime($event->date['start']['date'])); ?></div>
                    <?php else: ?>
                        <div class="mec-event-month"><?php echo $this->main->date_label($event->date['start'], $event->date['end'], $this->date_format_novel_1); ?></div>
                    <?php endif; ?>
                    <?php
                        if(trim($start_time))
                        {
                            echo '<div class="mec-event-detail"><span class="mec-start-time">'.$start_time.'</span>';
                            if(trim($end_time)) echo ' - <span class="mec-end-time">'.$end_time.'</span>';
                            echo '</div>';
                        }

                    if( isset($location['address'] ) ) {
                    ?>
                        <div class="mec-event-address"><?php echo $location['address']; ?></div>
                    <?php 
                    }
                    ?>
                    <div class="mec-event-footer mec-color">
                        <a class="mec-booking-button" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>" target="_self"><?php echo (is_array($event->data->tickets) and count($event->data->tickets)) ? $this->main->m('view_detail', __('View Detail', 'mec')) : $this->main->m('register_button', __('REGISTER', 'mec'))  ; ?></a>
                        <ul class="mec-event-sharing-wrap">
                            <li class="mec-event-share">
                                <a href="#" class="mec-event-share-icon">
                                    <i class="mec-sl-share"></i>
                                </a>
                            </li>
                            <ul class="mec-event-sharing"><?php echo $this->main->module('links.list', array('event'=>$event)); ?></ul>
                        </ul>
                    </div>
                </div>
            </div>
        <?php elseif($this->style == 'simple'): ?>
            <div class="mec-event-date mec-color"><?php echo $this->main->date_label($event->date['start'], $event->date['end'], $this->date_format_simple_1); ?></div>
            <h4 class="mec-event-title"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a><?php echo $event_color; ?></h4>
            <div class="mec-event-detail"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></div>

        <?php elseif($this->style == 'pageEvent'): ?>
            <div class="card mb-4">
              <div class="row">
                <div class="col-xl-3 pr-xl-0">
                  <div class="card-img-top">
                    <div class="card-label">
                      <div class="card-label-wrap">
                        <div class="date"><?php echo date_i18n($this->date_format_modern_1, strtotime($event->date['start']['date'])); ?></div>
                        <div class="month"><?php echo date_i18n($this->date_format_modern_2, strtotime($event->date['start']['date'])); ?></div>
                      </div>
                    </div>
                    <a href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>">
                        <?php echo str_replace('attachment-full size-full wp-post-image', 'card-img', $event->data->thumbnails['full']); ?>
                        <img src="/wp-content/themes/visual-composer-starter/img/400x400.png">
                    </a>
                  </div>
                </div>
                <div class="col-xl-9 pl-xl-0">
                  <div class="card-body">
                    <h5 class="card-title mb-xl-2"><a href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a></h5>
                    <p class="card-text mb-3"><?= $event->data->post->post_excerpt; ?></p>
                    <div class="row align-items-center">
                      <div class="col-xl-5">
                        <ul class="card-list mb-3 mb-xl-0">
                          <li><span class="icon"><img src="/wp-content/themes/visual-composer-starter/img/marker-icon.png" data-rjs="2"></span> <?php echo (isset($location['name']) ? $location['name'] : ''); ?> </li>
                          <li><span class="icon"><img src="/wp-content/themes/visual-composer-starter/img/price-icon.png" data-rjs="2"></span> <?= $event->data->meta['mec_cost']; ?> $</li>
                        </ul>
                      </div>
                      <div class="col-xl-7 pl-xl-0 text-center text-xl-left">
                        <a href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>#byeticket" class="btn btn-outline-danger-gradient btn-lg mb-3 mb-xl-0 d-block d-xl-inline-block"><span>BUY TICKET</span></a>
                        <a href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>" class="readmore ml-3">MORE INFO <span class="icon"><img src="/wp-content/themes/visual-composer-starter/img/arrow-r.png" data-rjs="2" alt="arrow"></span></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        <?php elseif($this->style == 'pagePastEvent'): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card">
            <div class="card-img-top">
              <div class="card-label">
                <div class="card-label-wrap">
                    <div class="date"><?php echo date_i18n($this->date_format_modern_1, strtotime($event->date['start']['date'])); ?></div>
                    <div class="month"><?php echo date_i18n($this->date_format_modern_2, strtotime($event->date['start']['date'])); ?></div>
                </div>
              </div>
              <?php echo str_replace('attachment-full size-full wp-post-image', 'card-img', $event->data->thumbnails['full']); ?>
              <img src="/wp-content/themes/visual-composer-starter/img/370x200.png">
            </div>
            <div class="card-body">
              <h5 class="card-title mb-xl-2"><?php echo $event->data->title; ?></h5>
              <p class="card-text mb-xl-2"><?= $event->data->post->post_excerpt; ?></p>
              <ul class="card-list mb-xl-4">
                <li>
                  <span class="icon"><img src="/wp-content/themes/visual-composer-starter/img/marker-icon.png" data-rjs="2"></span> <?php echo (isset($location['name']) ? $location['name'] : ''); ?>
                </li>
                <li>
                    <span class="icon"><img src="/wp-content/themes/visual-composer-starter/img/price-icon.png" data-rjs="2"></span> <?= $event->data->meta['mec_cost']; ?> $
                </li>
              </ul>
              <a href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>" class="readmore ml-3">MORE INFO <span class="icon"><img src="/wp-content/themes/visual-composer-starter/img/arrow-r.png" data-rjs="2" alt="arrow"></span></a>
            </div>
          </div>
        </div>

        <?php endif;
        ?>
        <?php endforeach; ?>
        <?php endforeach; 

        if($rcount == $count)
        {
            echo '</div>';
            $rcount = 0;
        }

        $rcount++;

        ?>
	</div>
</div>