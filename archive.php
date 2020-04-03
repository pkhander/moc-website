<?php
/**
 * The template for displaying Archive pages.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 * @package etalon
 * by KeyDesign
 */
?>

<?php
  $redux_ThemeTek = get_option( 'redux_ThemeTek' );
  if (!isset($redux_ThemeTek['tek-blog-minimal'])) {
     $redux_ThemeTek['tek-blog-minimal'] = 0;
  }
  if (!isset($redux_ThemeTek['tek-blog-sidebar'])) {
     $redux_ThemeTek['tek-blog-sidebar'] = 0;
  }
  get_header();
?>

<?php if ( have_posts() ) : ?>
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
              <a class="tt_button" href="<?php esc_url(the_permalink()); ?>"><?php esc_html_e('Read more', 'etalon'); ?><span class="fa fa-chevron-right"></span></a>
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
<?php endif; ?>
<?php else : ?>
<div id="posts-content"  class="container" >
   <h2 class="section-title"><?php esc_html_e( 'Nothing Found', 'etalon' ); ?></h2>
   <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
   <p><?php printf( esc_html__( 'Ready to publish your first post?', 'etalon' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
   <?php elseif ( is_search() ) : ?>
   <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again using different keywords.', 'etalon' ); ?></p>
   <?php get_search_form(); ?>
   <?php else : ?>
   <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'etalon' ); ?></p>
   <?php get_search_form(); ?>
   <?php endif; ?>
</div>
<?php endif; ?>
<?php get_footer(); ?>
