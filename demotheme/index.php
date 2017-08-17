<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * 
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Susy Demo Theme
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
       <?php if (have_posts()) { ?>
    
        <div class="basic-container flex-container">
            
        <?php    
        while (have_posts()) { 
                the_post(); 
                
       ?>
       <article>
            <?php if (has_post_thumbnail()): ?>
            <div class="thumb medium-thumb background-image" style="background-image:url('<?php the_post_thumbnail_url('full'); ?>');">
                <a href="<?php the_permalink(); ?>" class="thumb-link" title="<?php the_title(); ?>"></a>
            </div>
            <?php endif; ?>

            <a href="<?php the_permalink(); ?>" class="entry-title">
                 <?php the_title( '<h2>', '</h2>' ); ?>
            </a>  
            <?php echo susy_custom_excerpt(); ?>        
        </article>  
        
        <?php  } // endwhile ?>
                </div><!-- .basic-container -->
        <?php }  // endif ?>

<?php 
    $args = array(
	'post_type'              => array( 'post' ),
        'category_name'          => 'news',
        'posts_per_page'         => 14,
);

// The Query
$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    $i = 1;
?>
                         
<div class="wide-container flex-container">
<?php	

while ( $query->have_posts() ) {
    $query->the_post(); 
    
?>
		
<article>
    <?php if (has_post_thumbnail()): ?>
    <div class="thumb medium-thumb background-image" style="background-image:url('<?php the_post_thumbnail_url('full'); ?>');">
        <a href="<?php the_permalink(); ?>" class="thumb-link" title="<?php the_title(); ?>"></a>
    </div>
    <?php endif; ?>

    <a href="<?php the_permalink(); ?>" class="entry-title">
         <?php the_title( '<h2>', '</h2>' ); ?>
    </a>  
    <?php echo susy_custom_excerpt(); ?>        
</article>     

<?php 
    if ($i % 7 == 0) {
        // close the row at every 7th post
        echo '</div><div class="wide-container">';
    }

    $i++;
        } // endwhile
    echo '</div>';

    wp_reset_postdata();
    }    //  endif     
?>    
    
    
</main><!-- #main -->

<?php get_footer(); ?>