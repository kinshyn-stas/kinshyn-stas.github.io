<?php
/**
 * Single
 *
 * @package WordPress
 * @subpackage Visual Composer Starter
 * @since Visual Composer Starter 1.0
 */

get_header();
while ( have_posts() ) : the_post(); ?>

<div class="container">
    <nav aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= get_home_url(); ?>">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= get_home_url(); ?>/news">News</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php the_title(); ?>
            </li>
        </ol>
    </nav>
</div>

<section class="section inner-page news-page news-article-page pt-0">
    <div class="container"><h1><?php the_title(); ?></h1>
        <div class="d-flex flex-row mb-4 pt-1">
            <div class="card-date p-2">
                <span class="icon"><img src="/wp-content/themes/visual-composer-starter/img/calendar-icon.png" data-rjs="2" data-rjs-processed="true" width="15" height="15"></span><?= get_the_date('d.m.Y'); ?></div>
            <div class="card-author p-2"><?php if(!empty(get_field("post_author"))){echo 'by ' . get_field("post_author");} ?></div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="article">
                    <div class="post-image mb-3">
                        <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid" alt="<?php the_title(); ?>">
                    </div>
                    <?php the_content(); ?>
                </div>
                <div class="article-control d-flex justify-content-between">
                    <div class="readmore-reverse"><?= get_previous_post_link('%link', '<span class="icon"><img src="/wp-content/themes/visual-composer-starter/img/arrow-l.png" data-rjs="2" alt="arrow"></span> PREVIOUS POST'); ?></div>
                    <div class="readmore"><?= get_next_post_link('%link', 'NEXT POST <span class="icon"><img src="/wp-content/themes/visual-composer-starter/img/arrow-r.png" data-rjs="2" alt="arrow"></span>'); ?></div>
                </div>
            </div>
            <div class="col-sm-8 col-md-6 col-lg-4 col-xl-3">
                <div style="position: sticky; top: 50px;">
                    <?= do_shortcode('[recentSidebar]') ?>
                    <div class="subscribe-block mt-5">
    	                <h4>Subscribe</h4>
    	                <?= do_shortcode("[fc id='2'][/fc]") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endwhile;
get_footer();