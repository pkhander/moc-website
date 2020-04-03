<?php
$redux_ThemeTek = get_option( 'redux_ThemeTek' );

if ($redux_ThemeTek['tek-topbar'] && ($redux_ThemeTek['tek-topbar-template'] == '1')) : ?>
  <div class="topbar first-template">
<?php elseif ($redux_ThemeTek['tek-topbar'] && ($redux_ThemeTek['tek-topbar-template'] == '2')) : ?>
  <div class="topbar second-template">
<?php endif; ?>
    <div class="container">
       <div class="topbar-contact">
          <?php if (isset($redux_ThemeTek['tek-business-address']) && $redux_ThemeTek['tek-business-address'] != '' ) : ?>
               <span class="topbar-address"><span class="iconsmind-Map-Marker2"></span><?php echo esc_attr($redux_ThemeTek['tek-business-address']); ?></span>
           <?php endif; ?>
           <?php if (isset($redux_ThemeTek['tek-business-phone']) && $redux_ThemeTek['tek-business-phone'] != '' ) : ?>
               <span class="topbar-phone"><span class="iconsmind-Telephone"></span><a href="tel:<?php echo esc_attr($redux_ThemeTek['tek-business-phone']); ?>"><?php echo esc_attr($redux_ThemeTek['tek-business-phone']); ?></a></span>
           <?php endif; ?>
           <?php if (isset($redux_ThemeTek['tek-business-email']) && $redux_ThemeTek['tek-business-email'] != '' ) : ?>
               <span class="topbar-email"><span class="iconsmind-Mail"></span><a href="mailto:<?php echo esc_attr($redux_ThemeTek['tek-business-email']); ?>"><?php echo esc_attr($redux_ThemeTek['tek-business-email']); ?></a></span>
           <?php endif; ?>
       </div>
       <div class="topbar-socials">
           <?php if ($redux_ThemeTek['tek-social-icons'][1] == 1): ?><a href="<?php echo esc_url($redux_ThemeTek['tek-facebook-url']) ?>" target="_blank"><span class="fa fa-facebook"></span></a><?php endif;  ?>
           <?php if ($redux_ThemeTek['tek-social-icons'][2] == 1): ?><a href="<?php echo esc_url($redux_ThemeTek['tek-twitter-url']) ?>" target="_blank"><span class="fa fa-twitter"></span></a><?php endif;  ?>
           <?php if ($redux_ThemeTek['tek-social-icons'][3] == 1): ?><a href="<?php echo esc_url($redux_ThemeTek['tek-google-url']) ?>" target="_blank"><span class="fa fa-google-plus"></span></a><?php endif;  ?>
           <?php if ($redux_ThemeTek['tek-social-icons'][4] == 1): ?><a href="<?php echo esc_url($redux_ThemeTek['tek-pinterest-url']) ?>" target="_blank"><span class="fa fa-pinterest"></span></a><?php endif;  ?>
           <?php if ($redux_ThemeTek['tek-social-icons'][5] == 1): ?><a href="<?php echo esc_url($redux_ThemeTek['tek-youtube-url']) ?>" target="_blank"><span class="fa fa-youtube"></span></a><?php endif;  ?>
           <?php if ($redux_ThemeTek['tek-social-icons'][6] == 1): ?><a href="<?php echo esc_url($redux_ThemeTek['tek-linkedin-url']) ?>" target="_blank"><span class="fa fa-linkedin"></span></a><?php endif;  ?>
           <?php if ($redux_ThemeTek['tek-social-icons'][7] == 1): ?><a href="<?php echo esc_url($redux_ThemeTek['tek-instagram-url']) ?>" target="_blank"><span class="fa fa-instagram"></span></a><?php endif;  ?>
           <?php if (isset($redux_ThemeTek['tek-social-icons'][8])) :?>
             <?php if ($redux_ThemeTek['tek-social-icons'][8] == 1): ?><a href="<?php echo esc_url($redux_ThemeTek['tek-skype-url']) ?>" target="_blank"><span class="fa fa-skype"></span></a><?php endif;  ?>
           <?php endif; ?>
           <?php if (isset($redux_ThemeTek['tek-social-icons'][9])) :?>
             <?php if ($redux_ThemeTek['tek-social-icons'][9] == 1): ?><a href="<?php echo esc_url($redux_ThemeTek['tek-yelp-url']) ?>" target="_blank"><span class="fa fa-yelp"></span></a><?php endif;  ?>
           <?php endif; ?>
           <?php if (isset($redux_ThemeTek['tek-social-icons'][10])) :?>
             <?php if ($redux_ThemeTek['tek-social-icons'][10] == 1): ?><a href="<?php echo esc_url($redux_ThemeTek['tek-houzz-url']) ?>" target="_blank"><span class="fa fa-houzz"></span></a><?php endif;  ?>
           <?php endif; ?>
       </div>
    </div>
</div>
