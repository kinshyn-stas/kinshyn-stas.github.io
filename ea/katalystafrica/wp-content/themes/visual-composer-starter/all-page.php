<?php 
/* Template Name: All page */ 

get_header(); ?>

<section id="innerHead" class="section" style="background-image: url(<?= get_the_post_thumbnail_url(); ?>);">
    <div class="container text-center">
        <h1><?php the_title(); ?></h1>
        <div class="breadcump">
            <ul>
            	<li><a href="<?= home_url(); ?>">Home</a></li>
                <li><span>|</span></li>
                <li><?php the_title(); ?></li>
            </ul>
        </div>
    </div>
</section>

<div class="<?php echo esc_attr( visualcomposerstarter_get_content_container_class() ); ?>">
    <div class="content-wrapper">
        <div class="row">
            <div class="<?php echo esc_attr( visualcomposerstarter_get_maincontent_block_class() ); ?>">
                <div class="main-content">
                    <div class="entry-content">
                        <?php 
							the_post();
							the_content(); 
						?>
                    </div>
                </div>
                <!--.main-content-->
            </div>
            <!--.<?php echo esc_html( visualcomposerstarter_get_maincontent_block_class() ); ?>-->
            <?php if ( visualcomposerstarter_get_sidebar_class() ) : ?>
            <?php get_sidebar(); ?>
            <?php endif; ?>
        </div>
        <!--.row-->
    </div>
    <!--.content-wrapper-->
</div>
<!--.<?php echo esc_html( visualcomposerstarter_get_content_container_class() ); ?>-->
<?php get_footer();