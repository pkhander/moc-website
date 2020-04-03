<?php
/**
 * Theme header
 * @package etalon
 * by KeyDesign
 */
 ?>

<?php $redux_ThemeTek = get_option( 'redux_ThemeTek' ); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <?php if (isset($redux_ThemeTek['tek-main-color']) && $redux_ThemeTek['tek-main-color'] != '' ) : ?>
        <meta name="theme-color" content="<?php echo esc_attr($redux_ThemeTek['tek-main-color']); ?>" />
      <?php endif; ?>
      <link rel="profile" href="http://gmpg.org/xfn/11">
      <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
        <link href="<?php echo esc_url($redux_ThemeTek['tek-favicon']['url']); ?>" rel="icon">
      <?php } ?>
      <link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>" />
      <?php wp_head(); ?>
   </head>
    <body <?php body_class();?>>
      <?php if( !empty($redux_ThemeTek['tek-preloader']) && $redux_ThemeTek['tek-preloader'] == 1 ) : ?>
        <div id="preloader">
           <div class="spinner"></div>
        </div>
      <?php endif; ?>

      <nav class="navbar navbar-default navbar-fixed-top <?php if (isset($redux_ThemeTek['tek-menu-style'])) { if ($redux_ThemeTek['tek-menu-style'] == '2') { echo esc_html('contained'); }} ?> <?php if (isset($redux_ThemeTek['tek-menu-behaviour'])) { if ($redux_ThemeTek['tek-menu-behaviour'] == '2') { echo esc_html('fixed-menu'); }} ?> <?php if (isset($redux_ThemeTek['tek-topbar'])) { if ($redux_ThemeTek['tek-topbar'] == '1') { echo esc_html('with-topbar'); }} ?>
      <?php if (isset($redux_ThemeTek['tek-topbar-sticky'])) { if ($redux_ThemeTek['tek-topbar-sticky'] == '1') { echo esc_html('with-topbar-sticky'); }} ?>" >

        <?php /* Topbar template */ ?>
        <?php if( !empty($redux_ThemeTek['tek-topbar']) && $redux_ThemeTek['tek-topbar'] == 1 ) : ?>
          <?php get_template_part( 'core/templates/header/content', 'topbar' ); ?>
        <?php endif; ?>
        <?php /* END Topbar template */ ?>

        <div class="container">
           <div id="logo">
             <?php if (isset($redux_ThemeTek['tek-logo-style']) && $redux_ThemeTek['tek-logo-style'] != '' ) : ?>
               <?php if ($redux_ThemeTek['tek-logo-style'] == '1') : ?>
                 <!-- Image logo -->
                 <a class="logo" href="<?php echo esc_url(home_url()); ?>">
                   <?php if (isset($redux_ThemeTek['tek-logo']['url'])) { ?>
                     <img class="fixed-logo" src="<?php if(is_front_page() && isset($redux_ThemeTek['tek-transparent-homepage-menu']) && ($redux_ThemeTek['tek-transparent-homepage-menu']) && isset($redux_ThemeTek['tek-logo3']['url']) && ($redux_ThemeTek['tek-logo3']['url'] != '')) { echo esc_url($redux_ThemeTek['tek-logo3']['url']); } else { echo esc_url($redux_ThemeTek['tek-logo']['url']); } ?>"  width="<?php echo esc_html($redux_ThemeTek['tek-logo-size']['width']);?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                     <img class="nav-logo" src="<?php echo esc_url($redux_ThemeTek['tek-logo2']['url']); ?>"  width="<?php echo esc_html($redux_ThemeTek['tek-logo-size']['width']);?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                   <?php } else { ?>
                     <img class="fixed-logo" src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.png'); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                     <img class="nav-logo" src="<?php echo esc_url(get_template_directory_uri() . '/images/logo-2.png'); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                   <?php } ?>
                 </a>
               <?php elseif ($redux_ThemeTek['tek-logo-style'] == '2') : ?>
                 <!-- Text logo -->
                 <a class="logo" href="<?php echo esc_url(site_url()); ?>"><?php echo esc_html($redux_ThemeTek['tek-text-logo']);?></a>
               <?php endif; ?>
             <?php endif; ?>
             <?php if (!isset($redux_ThemeTek['tek-logo']['url'])) : ?>
                <a class="logo" href="<?php echo esc_url(site_url()); ?>"><?php bloginfo( 'name' ); ?></a>
             <?php endif; ?>
           </div>
           <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <?php if (isset($redux_ThemeTek['tek-woo-cart'])) {
                      if ($redux_ThemeTek['tek-woo-cart'] && ($redux_ThemeTek['tek-woo-cart'] == '1')) {
                    ?>
                      <div class="mobile-cart">
                          <?php
                            if( !class_exists( 'WooCommerce' ))  {
                                function is_woocommerce() {}
                            }
                            if( class_exists( 'WooCommerce' )) {
                                $keydesign_minicart = '';
                                $keydesign_minicart = keydesign_add_cart_in_menu();
                                echo do_shortcode( shortcode_unautop( $keydesign_minicart ) );
                            }
                          ?>
                      </div>
                    <?php } } ?>
            </div>
            <div id="main-menu" class="collapse navbar-collapse  navbar-right">
               <?php
                  wp_nav_menu( array( 'theme_location' => 'keydesign-header-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'nav navbar-nav', 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker()) );
               ?>

               <?php if( !empty($redux_ThemeTek['tek-search-bar']) && $redux_ThemeTek['tek-search-bar'] == 1 ) : ?>
                 <div class="kd-search-bar">
                    <span class="toggle-search iconsmind-Magnifi-Glass2 fa"></span>
                    <div class="topbar-search-container">
                      <?php get_search_form(); ?>
                    </div>
                 </div>
               <?php endif; ?>


              

              <?php
                if( class_exists( 'WooCommerce' ) ) {
                  if (isset($redux_ThemeTek['tek-woo-cart'])) {
                    if ($redux_ThemeTek['tek-woo-cart'] && ($redux_ThemeTek['tek-woo-cart'] == '1')) {
                      $keydesign_minicart = '';
                      $keydesign_minicart = keydesign_add_cart_in_menu();
                      echo do_shortcode( shortcode_unautop( $keydesign_minicart ) );
                    }
                  }
                }
              ?>

            </div>
         </div>
      </nav>

      <div id="wrapper" class="<?php if (isset($redux_ThemeTek['tek-disable-animations']) && $redux_ThemeTek['tek-disable-animations'] == true ) { echo 'no-mobile-animation'; } ?>">
      <?php if(is_front_page()) { ?>
         <?php if (isset($redux_ThemeTek['tek-slider']) && $redux_ThemeTek['tek-slider'] != '' ) : ?>
          <header id="header">
               <div id="kd-slider" class="fullwidth">
                  <?php echo do_shortcode('[rev_slider alias="'. esc_attr($redux_ThemeTek['tek-slider']). '"]' ); ?>
               </div>
          </header>
         <?php endif; ?>
      <?php } else if (!is_404() && !is_singular( 'themetek_portfolio' )) {
      $keydesign_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_option('page_for_posts')), 'full', false )  ?>
      <header id="header" class="blog-header <?php if (isset($redux_ThemeTek['tek-topbar'])) { if ($redux_ThemeTek['tek-topbar'] == '0') { echo esc_html('no-topbar'); }} ?>">
           <?php if(function_exists('bcn_display')) { ?>
           <?php $themetek_page_title_color = get_post_meta( get_the_ID(), '_themetek_page_title_color', true ); ?>
           <div <?php echo (!empty($themetek_page_title_color) ? 'style="color: '.$themetek_page_title_color.';"' : ''); ?> class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <div class="container">
                <?php bcn_display(); ?>
                </div>
            </div>
           <?php } ?>
      </header>
      <?php } ?>
