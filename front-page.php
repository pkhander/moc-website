<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package etalon
 * by KeyDesign
 */
?>

<?php
   $redux_ThemeTek = get_option( 'redux_ThemeTek' );
   $themetek_page_bgcolor = get_post_meta( get_the_ID(), '_themetek_page_bgcolor', true );
   $themetek_page_background_color = ' background-color:'.$themetek_page_bgcolor.';';
   $themetek_page_layout = get_post_meta( get_the_ID(), '_themetek_page_layout', true );
   $themetek_page_top_padding = get_post_meta( get_the_ID(), '_themetek_page_top_padding', true );
   $themetek_page_bottom_padding = get_post_meta( get_the_ID(), '_themetek_page_bottom_padding', true );
   get_header();
   ?>
<?php if( is_home() ) : ?>
<div id="posts-content" class="container" >
   <?php if (($redux_ThemeTek['tek-blog-sidebar']) && ($redux_ThemeTek['tek-blog-minimal']) == 0) { ?>
   <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
      <?php } else { ?>
      <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 BlogFullWidth">
         <?php } ?>
      <?php
         if (have_posts()) :
         while (have_posts()) :
         the_post();
         ?>
      <?php if (($redux_ThemeTek['tek-blog-minimal']) == 1) { $post_class = "BlogMinimal"; } else { $post_class = "section"; }?>
      <div <?php post_class($post_class); ?> id="post-<?php  the_ID(); ?>" >
         <?php if (($redux_ThemeTek['tek-blog-minimal']) == 1) { ?>
         <a class="blog-image-container" href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('large'); ?></a>
         <?php } ?>
         <h2 class="blog-single-title"><?php  the_title(); ?></h2>
         <div class="entry-meta">
            <?php if ( is_sticky() ) echo '<span class="fa fa-thumb-tack"></span> Sticky <span class="blog-separator">|</span>  '; ?>
            <span class="published"><span class="fa fa-clock-o"></span><a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php  the_time( get_option('date_format') ); ?></a></span>
            <?php if (($redux_ThemeTek['tek-blog-minimal']) == 0) { ?>
            <span class="author"><span class="fa fa-keyboard-o"></span><?php  the_author_posts_link(); ?></span>
            <span class="blog-label"><span class="fa fa-folder-open-o"></span><?php  the_category(', '); ?></span>
            <span class="comment-count"><span class="fa fa-comment-o"></span><?php  comments_popup_link( esc_html__('No comments yet', 'etalon'), esc_html__('1 comment', 'etalon'), esc_html__('% comments', 'etalon') ); ?></span>
            <?php } ?>
         </div>
         <?php if (($redux_ThemeTek['tek-blog-minimal']) == 0) { ?>
         <a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('large'); ?></a>
         <?php } ?>
         <?php if (($redux_ThemeTek['tek-blog-minimal']) == 0) { ?>
         <div class="entry-content">
            <?php if(has_excerpt()) : ?>
            <?php the_excerpt(); ?>
            <?php else : ?>
            <div class="page-content"><?php the_content(); ?></div>
            <?php endif; ?>
            <?php wp_link_pages(); ?>
            <a class="tt_button" href="<?php esc_url(the_permalink()); ?>">Read More<span class="fa fa-chevron-right"></span></a>
         </div>
         <?php } ?>
      </div>
      <?php endwhile; ?>
      <?php the_posts_pagination( array('mid_size' => 1,'prev_text' => esc_html__( 'Previous', 'etalon' ),'next_text' => esc_html__( 'Next', 'etalon' ),) ); ?>
   </div>
   <?php if (($redux_ThemeTek['tek-blog-sidebar']) && ($redux_ThemeTek['tek-blog-minimal']) == 0) { ?>
   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
      <?php get_sidebar(); ?>
   </div>
   <?php } ?>
</div>
<?php else : ?>
<div id="posts-content" class="container" >
   <div id="post-not-found" <?php post_class(); ?>>
      <h2 class="entry-title"><?php esc_html_e('Error 404 - Not Found', 'etalon') ?></h2>
      <div class="entry-content">
         <p><?php esc_html_e("Sorry, no posts matched your criteria.", "etalon") ?></p>
      </div>
   </div>
</div>
<?php endif; ?>
<?php else : ?>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <section id="<?php echo esc_attr($post->post_name);?>" class="section" style="
         <?php echo ( !empty($themetek_page_bgcolor) ? esc_attr($themetek_page_background_color) : '' ); ?>
         <?php echo ( !empty($themetek_page_top_padding) ? ' padding-top:'. esc_attr($themetek_page_top_padding) .';' : '' );?>
         <?php echo ( !empty($themetek_page_bottom_padding) ? ' padding-bottom:'. esc_attr($themetek_page_bottom_padding) .';' : '' );?> ">
         <div class="container <?php echo ( !empty($themetek_page_layout) ? 'fullwidth' : '' );?>" >
            <div class="row">
               <?php the_content(); ?>
            </div>
         </div>
      </section>
      <div class="page-content comments-content">
            <?php
                if ( comments_open() || '0' != get_comments_number() ) {
                    comments_template();
                }
            ?>
        </div>
  <?php endwhile; else: ?>
    <p><?php esc_html_e('Sorry, this page does not exist.', 'etalon'); ?></p>
  <?php endif; ?>

<?php endif; ?>
<?php get_footer(); ?>
