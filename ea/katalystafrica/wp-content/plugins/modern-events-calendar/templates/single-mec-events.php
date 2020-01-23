<?php
/** no direct access **/
defined('_MECEXEC_') or die();

/**
 * The Template for displaying all single events
 * 
 * @author Webnus <info@webnus.biz>
 * @package MEC/Templates
 * @version 1.0.0
 */
get_header('mec'); ?>

<?php 
  $myLoc = $wpdb->get_row("SELECT * FROM wp_postmeta WHERE post_id = " . get_post()->ID . " AND meta_key = 'mec_location_id'");
  $sLoc = $myLoc->meta_value;
  $dLoc = $wpdb->get_row("SELECT * FROM wp_terms WHERE term_id = " . $sLoc);
?>

  <section id="innerHead" class="section pt-5 pb-5 page-event" style="background-image: url(<?= get_the_post_thumbnail_url(); ?>);">
    <div class="container text-center">
      <h1><?php the_title(); ?></h1>
      <div id="clockdiv" class="countdown d-flex justify-content-center pt-3 pb-3">
        <div class="dig-block">
          <div class="dig days">0</div>
          <div class="label">Days</div>
        </div>
        <div class="separate-block">
          <div class="dig">:</div>
        </div>
        <div class="dig-block">
          <div class="dig hours">00</div>
          <div class="label">Hours</div>
        </div>
        <div class="separate-block">
          <div class="dig">:</div>
        </div>
        <div class="dig-block">
          <div class="dig minutes">00</div>
          <div class="label">Minutes</div>
        </div>
        <div class="separate-block">
          <div class="dig">:</div>
        </div>
        <div class="dig-block">
          <div class="dig seconds">00</div>
          <div class="label">Seconds</div>
        </div>
      </div>
      <div class="d-flex justify-content-center date-informer">
        <div class="p-3">
          <p>when</p>
          <p class="mDateTime"></p>
        </div>
        <div class="p-3">
          <p>where</p>
          <p><?= $dLoc->name; ?></p>
        </div>
      </div>
      <div class="pt-4 pb-4">
        <a href="#byeticket" class="btn btn-outline-primary btn-lg upp">BUY TICKET</a>
      </div>
    </div>
  </section>

    <?php do_action('mec_before_main_content'); ?>

        <section id="<?php echo apply_filters('mec_single_page_html_id', 'main-content'); ?>" class="<?php echo apply_filters('mec_single_page_html_class', 'mec-container'); ?>">

      		<?php while(have_posts()): the_post(); ?>

            <?php the_content(); ?>

      		<?php endwhile; // end of the loop. ?>

        </section>

    <?php do_action('mec_after_main_content'); ?>

<?php get_footer('mec'); ?>


<?php 
  $mylink = $wpdb->get_row("SELECT * FROM wp_mec_events WHERE post_id = " . get_post()->ID);
  $mTimeSt = (strtotime($mylink->start)+$mylink->time_start)*1000-10800000; 
  $mTimeEnd = (strtotime($mylink->end)+$mylink->time_end)*1000-10800000; 
?>

<script type="text/javascript">

  /* Countdown timer */
  function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
      'total': t,
      'days': days,
      'hours': hours,
      'minutes': minutes,
      'seconds': seconds
    };
  }
  function initializeClock(id, endtime) {
    var clock = document.getElementById(id);
    var daysSpan = clock.querySelector('.days');
    var hoursSpan = clock.querySelector('.hours');
    var minutesSpan = clock.querySelector('.minutes');
    var secondsSpan = clock.querySelector('.seconds');
    function updateClock() {
      var t = getTimeRemaining(endtime);
      daysSpan.innerHTML = t.days;
      hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
      minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
      secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

      if (t.total <= 0) {
        clearInterval(timeinterval);
      }
    }
    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
  }
  var deadline = new Date(<?= $mTimeSt; ?>);
  function mTime(){
    return parseInt(new Date().getTime())
  }
  if (mTime() <= deadline.getTime()) {
    initializeClock('clockdiv', deadline);
  }

  /* Date events */
  var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
  var dateStart = new Date(<?= $mTimeSt; ?>),
      dateStartDay = dateStart.getDate(),
      dateStartMonth = months[dateStart.getMonth()];
  var dateEnd = new Date(<?= $mTimeEnd; ?>),
      dateEndDay = dateEnd.getDate(),
      dateEndMonth = months[dateEnd.getMonth()];
  if (dateStartMonth == dateEndMonth) {
    if (dateStartDay == dateEndDay) {
      jQuery('.mDateTime').html(datStFin1(dateStartMonth, dateStartDay));
    }else{
      jQuery('.mDateTime').html(datStFin2(dateStartMonth, dateStartDay, dateEndDay));
    }
  }else{
    jQuery('.mDateTime').html(datStFin3(dateStartMonth, dateEndMonth, dateStartDay, dateEndDay));
  }
  function datStFin1(tM, tD){
    return tM + ' ' + tD + ' ' + dateStart.getFullYear();
  }
  function datStFin2(tM, tsD, tsF){
    return tM + ' ' + tsD + '-' + tsF + ' ' + dateStart.getFullYear();
  }  
  function datStFin3(tsM, tdM, tsD, tsF){
    return tsM + ' ' + tsD + ' - ' + tdM + ' ' + tsF + ' ' + dateStart.getFullYear();
  }

  /* Scroll to anchor */
  (function($){ 
    $('a[href^="#"]').bind('click.smoothscroll',function (e) {
        e.preventDefault();
        var target = this.hash,
        $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });
  })(window.jQuery);

</script>