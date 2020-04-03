<?php
if (!class_exists('keydesign_Redux_Framework_config')) {
    class keydesign_Redux_Framework_config {
        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;
        public function __construct() {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            // This is needed. Bah WordPress bugs.  ;)
            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array(
                    $this,
                    'initSettings'
                ), 10);
            }
        }

        public function initSettings() {
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();
            // Set the default arguments
            $this->setArguments();
            // Set a few help tabs so you can see how it's done
            $this->setSections();
            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**
        * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
        * Simply include this function in the child themes functions.php file.

        * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
        * so you must use get_template_directory_uri() if you want to use any of the built in icons
        * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'etalon'),
                'desc' => esc_html__('This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'etalon'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );
            return $sections;
        }

        /**
        * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
        * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;
            return $args;
        }

        /**
        *Filter hook for filtering the default value of any given field. Very useful in development mode.
        * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';
            return $defaults;
        }

        public function setSections() {
            /**
            * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
            * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns      = array();
            ob_start();
            $ct              = wp_get_theme();
            $this->theme     = $ct;
            $item_name       = $this->theme->get('Name');
            $tags            = $this->theme->Tags;
            $screenshot      = $this->theme->get_screenshot();
            $class           = $screenshot ? 'has-screenshot' : '';
            $customize_title = sprintf(esc_html__('Customize &#8220;%s&#8221;', 'etalon'), $this->theme->display('Name'));
?>
    <div id="current-theme" class="<?php echo esc_attr($class); ?>">
        <?php if ($screenshot): ?>
          <?php if (current_user_can('edit_theme_options')): ?>
          <a href="<?php echo esc_url(wp_customize_url()); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
              <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','etalon'); ?>" />
          </a>
          <?php endif; ?>
          <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','etalon'); ?>" />
        <?php endif; ?>

        <h4><?php echo esc_attr($this->theme->display('Name')); ?></h4>

        <div>
            <ul class="theme-info">
                <li><?php printf(esc_html__('By %s', 'etalon'), $this->theme->display('Author')); ?></li>
                <li><?php printf(esc_html__('Version %s', 'etalon'), $this->theme->display('Version')); ?></li>
                <li><?php echo '<strong>' . esc_html__('Tags', 'etalon') . ':</strong>'; ?>
                <?php printf($this->theme->display('Tags')); ?></li>
            </ul>
            <p class="theme-description"><?php echo esc_attr($this->theme->display('Description')); ?></p>
        </div>
    </div>

        <?php
            $item_info = ob_get_contents();
            ob_end_clean();
            $sampleHTML = '';
            // ACTUAL DECLARATION OF SECTIONS

            $this->sections[] = array(
                'icon' => 'el-icon-bookmark',
                'title' => esc_html__('Business Info', 'etalon'),
                'compiler' => 'true',
                'fields' => array(
                    array(
                        'id' => 'tek-business-address',
                        'type' => 'text',
                        'title' => esc_html__('Business Address', 'etalon'),
                        'default' => '49 Grand Street, Los Angeles'
                    ),
                    array(
                        'id' => 'tek-business-phone',
                        'type' => 'text',
                        'title' => esc_html__('Business Phone', 'etalon'),
                        'default' => '(222) 400-630'
                    ),
                    array(
                        'id' => 'tek-business-email',
                        'type' => 'text',
                        'title' => esc_html__('Business Email', 'etalon'),
                        'default' => 'contact@etalon-theme.com'
                    ),
                    array(
                        'id' => 'tek-social-icons',
                        'type' => 'checkbox',
                        'title' => esc_html__('Social Icons', 'etalon'),
                        'subtitle' => esc_html__('Select visible social icons', 'etalon'),
                        'options' => array(
                            '1' => 'Facebook',
                            '2' => 'Twitter',
                            '3' => 'Google+',
                            '4' => 'Pinterest',
                            '5' => 'Youtube',
                            '6' => 'Linkedin',
                            '7' => 'Instagram',
                            '8' => 'Skype',
                            '9' => 'Yelp',
                            '10' => 'Houzz',
                        ),
                        'default' => array(
                            '1' => '1',
                            '2' => '1',
                            '3' => '1',
                            '4' => '0',
                            '5' => '0',
                            '6' => '1',
                            '7' => '0',
                            '8' => '0',
                            '9' => '0',
                            '10' => '0',
                        )
                    ),
                    array(
                        'id' => 'tek-facebook-url',
                        'type' => 'text',
                        'title' => esc_html__('Facebook Link', 'etalon'),
                        'subtitle' => esc_html__('Enter Facebook URL', 'etalon'),
                        'default' => '#'
                    ),

                    array(
                        'id' => 'tek-twitter-url',
                        'type' => 'text',
                        'title' => esc_html__('Twitter Link', 'etalon'),
                        'subtitle' => esc_html__('Enter Twitter URL', 'etalon'),
                        'default' => '#'
                    ),

                    array(
                        'id' => 'tek-google-url',
                        'type' => 'text',
                        'title' => esc_html__('Google+ Link', 'etalon'),
                        'subtitle' => esc_html__('Enter Google+ URL', 'etalon'),
                        'default' => '#'
                    ),
                    array(
                        'id' => 'tek-pinterest-url',
                        'type' => 'text',
                        'title' => esc_html__('Pinterest Link', 'etalon'),
                        'subtitle' => esc_html__('Enter Pinterest URL', 'etalon'),
                        'default' => '#'
                    ),

                    array(
                        'id' => 'tek-youtube-url',
                        'type' => 'text',
                        'title' => esc_html__('Youtube Link', 'etalon'),
                        'subtitle' => esc_html__('Enter Youtube URL', 'etalon'),
                        'default' => '#'
                    ),
                    array(
                        'id' => 'tek-linkedin-url',
                        'type' => 'text',
                        'title' => esc_html__('Linkedin Link', 'etalon'),
                        'subtitle' => esc_html__('Enter Linkedin URL', 'etalon'),
                        'default' => '#'
                    ),
                    array(
                        'id' => 'tek-instagram-url',
                        'type' => 'text',
                        'title' => esc_html__('Instagram Link', 'etalon'),
                        'subtitle' => esc_html__('Enter Instagram URL', 'etalon'),
                        'default' => '#'
                    ),
                    array(
                        'id' => 'tek-skype-url',
                        'type' => 'text',
                        'title' => esc_html__('Skype Link', 'etalon'),
                        'subtitle' => esc_html__('Enter Skype URL', 'etalon'),
                        'default' => '#'
                    ),
                    array(
                        'id' => 'tek-yelp-url',
                        'type' => 'text',
                        'title' => esc_html__('Yelp Link', 'etalon'),
                        'subtitle' => esc_html__('Enter Yelp URL', 'etalon'),
                        'default' => '#'
                    ),
                    array(
                        'id' => 'tek-houzz-url',
                        'type' => 'text',
                        'title' => esc_html__('Houzz Link', 'etalon'),
                        'subtitle' => esc_html__('Enter Houzz URL', 'etalon'),
                        'default' => '#'
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-globe',
                'title' => esc_html__('Global Options', 'etalon'),
                'compiler' => 'true',
                'fields' => array(
                    array(
                        'id' => 'tek-main-color',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Main Theme Color', 'etalon'),
                        'default' => '#3f9df3',
                        'validate' => 'color'
                    ),
                    array(
                        'id' => 'tek-preloader',
                        'type' => 'switch',
                        'title' => esc_html__('Preloader', 'etalon'),
                        'subtitle' => esc_html__('Activate to enable theme preloader', 'etalon'),
                        'default' => true
                    ),
                    array(
                        'id' => 'tek-google-api',
                        'type' => 'text',
                        'title' => __('Google Map API Key <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank" class="el-icon-question-sign"></a>', 'etalon'),
                        'default' => '',
                        'subtitle' => esc_html__('Generate, copy and paste here Google Maps API Key', 'etalon'),
                    ),
                    array(
                        'id' => 'tek-disable-animations',
                        'type' => 'switch',
                        'title' => esc_html__('Disable Animations on Mobile', 'etalon'),
                        'subtitle' => esc_html__('Globally turn on/off element animations on mobile', 'etalon'),
                        'default' => false
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-star',
                'title' => esc_html__('Logo', 'etalon'),
                'fields' => array(
                  array(
                      'id' => 'tek-logo-style',
                      'type' => 'select',
                      'title' => esc_html__('Logo Style', 'etalon'),
                      'options'  => array(
                          '1' => 'Image logo',
                          '2' => 'Text logo'
                      ),
                      'default' => '2'
                  ),
                  array(
                      'id' => 'tek-logo',
                      'type' => 'media',
                      'readonly' => false,
                      'url' => true,
                      'title' => esc_html__('Primary Logo', 'etalon'),
                      'subtitle' => esc_html__('Upload logo image. Recommended image size: 195x64px', 'etalon'),
                      'required' => array('tek-logo-style','equals','1'),
                      'default' => array(
                          'url' => get_template_directory_uri() . '/images/logo.png'
                      )
                  ),
                  array(
                      'id' => 'tek-logo2',
                      'type' => 'media',
                      'readonly' => false,
                      'url' => true,
                      'title' => esc_html__('Secondary Logo', 'etalon'),
                      'subtitle' => esc_html__('Upload logo image for sticky navigation. Recommended image size: 195x64px', 'etalon'),
                      'required' => array('tek-logo-style','equals','1'),
                      'default' => array(
                          'url' => get_template_directory_uri() . '/images/logo-2.png'
                      )
                  ),
                  array(
                      'id' => 'tek-logo-size',
                      'type' => 'dimensions',
                      'height' => false,
                      'units'    => false,
                      'url' => true,
                      'title' => esc_html__('Logo Size', 'etalon'),
                      'subtitle' => esc_html__('Choose logo width - the image will constrain proportions', 'etalon'),
                      'required' => array('tek-logo-style','equals','1'),
                  ),
                  array(
                      'id' => 'tek-text-logo',
                      'type' => 'text',
                      'title' => esc_html__('Text Logo', 'etalon'),
                      'required' => array('tek-logo-style','equals','2'),
                      'default' => 'ETALON'
                  ),
                  array(
                      'id' => 'tek-main-logo-color',
                      'type' => 'color',
                      'transparent' => false,
                      'title' => esc_html__('Main Logo Text Color', 'etalon'),
                      'required' => array('tek-logo-style','equals','2'),
                      'default' => '#2f2f2f',
                      'validate' => 'color'
                  ),
                  array(
                      'id' => 'tek-secondary-logo-color',
                      'type' => 'color',
                      'transparent' => false,
                      'title' => esc_html__('Secondary Logo Text Color', 'etalon'),
                      'subtitle' => esc_html__('Logo text color for sticky navigation', 'etalon'),
                      'required' => array('tek-logo-style','equals','2'),
                      'default' => '#2f2f2f',
                      'validate' => 'color'
                  ),
                  array(
                      'id' => 'tek-favicon',
                      'type' => 'media',
                      'readonly' => false,
                      'preview' => false,
                      'url' => true,
                      'title' => esc_html__('Favicon', 'etalon'),
                      'subtitle' => esc_html__('Upload favicon image', 'etalon'),
                      'default' => array(
                          'url' => get_template_directory_uri() . '/images/favicon.png'
                      ),
                  ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-lines',
                'title' => esc_html__('Header', 'etalon'),
                'compiler' => 'true',
                'fields' => array(
                    array(
                        'id'=>'tek-header-bar-section-start',
                        'type' => 'section',
                        'title' => esc_html__('Header Bar Settings', 'etalon'),
                        'indent' => true,
                    ),
                    array(
                        'id' => 'tek-menu-style',
                        'type' => 'button_set',
                        'title' => esc_html__('Header Bar Width', 'etalon'),
                        'subtitle' => esc_html__('You can choose between full width and contained.', 'etalon'),
                        'options' => array(
                            '1' => 'Full width',
                            '2' => 'Contained'
                         ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'tek-menu-behaviour',
                        'type' => 'button_set',
                        'title' => esc_html__('Header Bar Behaviour', 'etalon'),
                        'subtitle' => esc_html__('You can choose between a sticky or a fixed top menu.', 'etalon'),
                        'options' => array(
                            '1' => 'Sticky',
                            '2' => 'Fixed'
                         ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'tek-search-bar',
                        'type' => 'switch',
                        'title' => esc_html__('Search Bar', 'etalon'),
                        'subtitle' => esc_html__('Turn on to display search bar.', 'etalon'),
                        'default' => false
                    ),
                    array(
                        'id' => 'tek-header-menu-bg',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Header Bar Background Color', 'etalon'),
                        'default' => '',
                        'validate' => 'color'
                    ),
                    array(
                        'id' => 'tek-header-menu-bg-sticky',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Sticky Header Bar Background Color', 'etalon'),
                        'default' => '',
                        'validate' => 'color'
                    ),
                    array(
                      	'id'=>'tek-header-bar-section-end',
                      	'type' => 'section',
                      	'indent' => false,
                    ),
                    array(
                      	'id'=>'tek-menu-settings-section-start',
                      	'type' => 'section',
                      	'title' => esc_html__('Main Menu Settings', 'etalon'),
                      	'indent' => true,
                    ),
                    array(
                        'id' => 'tek-menu-typo',
                        'type' => 'typography',
                        'title' => esc_html__('Menu Font Settings', 'etalon'),
                        'google' => true,
                        'font-style' => true,
                        'font-size' => true,
                        'line-height' => false,
                        'text-transform' => true,
                        'color' => false,
                        'text-align' => false,
                        'preview' => true,
                        'all_styles' => false,
                        'default' => array(
                            'font-weight' => '700',
                            'font-family' => 'Montserrat',
                            'font-size' => '13px',
                            'text-transform' => 'uppercase',
                        ),
                        'units' => 'px',
                        'preview' => array(
                            'text' => 'Menu Item'
                        )
                    ),
                    array(
                        'id' => 'tek-header-menu-color',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Menu Link Color', 'etalon'),
                        'default' => '',
                        'validate' => 'color'
                    ),
                    array(
                        'id' => 'tek-header-menu-color-hover',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Menu Link Hover Color', 'etalon'),
                        'default' => '',
                        'validate' => 'color'
                    ),
                    array(
                        'id' => 'tek-header-menu-color-sticky',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Sticky Menu Link Color', 'etalon'),
                        'default' => '',
                        'validate' => 'color'
                    ),
                    array(
                        'id' => 'tek-header-menu-color-sticky-hover',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Sticky Menu Link Hover Color', 'etalon'),
                        'default' => '',
                        'validate' => 'color'
                    ),
                    array(
                      	'id'=>'tek-menu-settings-section-end',
                      	'type' => 'section',
                      	'indent' => false,
                    ),
                    array(
                      	'id'=>'tek-home-transparent-section-start',
                      	'type' => 'section',
                      	'title' => esc_html__('Homepage Transparent Header', 'etalon'),
                      	'indent' => true,
                    ),
                    array(
                        'id' => 'tek-transparent-homepage-menu',
                        'type' => 'switch',
                        'title' => esc_html__('Homepage Transparent Header', 'etalon'),
                        'subtitle' => esc_html__('Turn on to set a transparent background color to the header area.', 'etalon'),
                        'default' => false
                    ),
                    array(
                        'id' => 'tek-transparent-homepage-menu-colors',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Menu Link Color', 'etalon'),
                        'subtitle' => esc_html__('Homepage navigation color when transparent background', 'etalon'),
                        'default' => '',
                        'validate' => 'color',
                        'required' => array('tek-transparent-homepage-menu','equals', true),
                    ),
                    array(
                        'id' => 'tek-logo3',
                        'type' => 'media',
                        'readonly' => false,
                        'url' => true,
                        'title' => esc_html__('Logo', 'etalon'),
                        'subtitle' => esc_html__('Upload logo image for homepage navigation when transparent background', 'etalon'),
                        'required' => array('tek-transparent-homepage-menu','equals','1'),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/logo-2.png'
                        )
                    ),
                    array(
                     	'id'=>'tek-home-transparent-section-end',
                     	'type' => 'section',
                     	'indent' => false,
                    ),
                )
            );
            $this->sections[] = array(
                'title' => esc_html__('Topbar', 'etalon'),
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'tek-topbar',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Topbar', 'etalon'),
                        'subtitle' => esc_html__('Turn on to display topbar.', 'etalon'),
                        'default' => true
                    ),
                    array(
                        'id' => 'tek-topbar-sticky',
                        'type' => 'switch',
                        'title' => esc_html__('Sticky Topbar', 'etalon'),
                        'required' => array('tek-topbar','equals', true),
                        'subtitle' => esc_html__('Turn on to enable sticky topbar.', 'etalon'),
                        'default' => false
                    ),
                    array(
                        'id' => 'tek-topbar-template',
                        'type' => 'select',
                        'title' => esc_html__('Topbar Template', 'etalon'),
                        'required' => array('tek-topbar','equals', true),
                        'options'  => array(
                            '1' => 'Business info (left) + Social icons (right)',
                            '2' => 'Social icons (left) + Business info (right)',
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'tek-topbar-typo',
                        'type' => 'typography',
                        'title' => esc_html__('Topbar Font Settings', 'etalon'),
                        'google' => false,
                        'font-family' => false,
                        'font-style' => true,
                        'font-size' => true,
                        'line-height' => false,
                        'color' => false,
                        'text-align' => false,
                        'preview' => false,
                        'all_styles' => false,
                        'units' => 'px',
                    ),
                    array(
                        'id' => 'tek-topbar-bg-color',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Topbar Background Color', 'etalon'),
                        'default' => '#3f9df3',
                        'validate' => 'color',
                        'required' => array('tek-topbar','equals', true),
                    ),
                    array(
                        'id' => 'tek-topbar-text-color',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Topbar Text Color', 'etalon'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                        'required' => array('tek-topbar','equals', true),
                    ),
                    array(
                        'id' => 'tek-topbar-hover-text-color',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Topbar Text Hover Color', 'etalon'),
                        'default' => '#dddddd',
                        'validate' => 'color',
                        'required' => array('tek-topbar','equals', true),
                    ),
                )
            );

            $this->sections[] = array(
              'title' => esc_html__('Header Button', 'etalon'),
              'subsection' => true,
              'fields' => array(
                    array(
                        'id' => 'tek-header-button',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Header Button', 'etalon'),
                        'default' => true
                    ),
                    array(
                        'id' => 'tek-header-button-text',
                        'type' => 'text',
                        'title' => esc_html__('Button Text', 'etalon'),
                        'required' => array('tek-header-button','equals', true),
                        'default' => 'Get a quote'
                    ),
                    array(
                        'id' => 'tek-header-button-action',
                        'type' => 'select',
                        'title' => esc_html__('Button Action', 'etalon'),
                        'required' => array('tek-header-button','equals', true),
                        'options'  => array(
                            '1' => 'Open modal box',
                            '2' => 'Scroll to section',
                            '3' => 'Open a new page'
                        ),
                        'default' => '3'
                    ),
                    array(
                        'id' => 'tek-modal-title',
                        'type' => 'text',
                        'title' => esc_html__('Modal Title', 'etalon'),
                        'required' => array('tek-header-button-action','equals','1'),
                        'default' => 'Lets get in touch'
                    ),
                    array(
                        'id' => 'tek-modal-subtitle',
                        'type' => 'text',
                        'title' => esc_html__('Modal Subtitle', 'etalon'),
                        'required' => array('tek-header-button-action','equals','1'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tek-modal-form-select',
                        'type' => 'select',
                        'title' => esc_html__('Contact Form Plugin', 'etalon'),
                        'required' => array('tek-header-button-action','equals','1'),
                        'options'  => array(
                            '1' => 'Contact Form 7',
                            '2' => 'Ninja Forms',
                            '3' => 'Gravity Forms',
                            '4' => 'WP Forms',
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'tek-modal-contactf7-formid',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1, ),
                        'title' => esc_html__('Contact Form 7 Title', 'etalon'),
                        'required' => array('tek-modal-form-select','equals','1'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tek-modal-ninja-formid',
                        'type' => 'text',
                        'title' => esc_html__('Ninja Form ID', 'etalon'),
                        'required' => array('tek-modal-form-select','equals','2'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tek-modal-gravity-formid',
                        'type' => 'text',
                        'title' => esc_html__('Gravity Form ID', 'etalon'),
                        'required' => array('tek-modal-form-select','equals','3'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tek-modal-wp-formid',
                        'type' => 'text',
                        'title' => esc_html__('WP Form ID', 'etalon'),
                        'required' => array('tek-modal-form-select','equals','4'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tek-scroll-id',
                        'type' => 'text',
                        'title' => esc_html__('Scroll to Section ID', 'etalon'),
                        'required' => array('tek-header-button-action','equals','2'),
                        'default' => '#download-etalon'
                    ),

                    array(
                        'id' => 'tek-button-new-page',
                        'type' => 'text',
                        'title' => esc_html__('New Page Link', 'etalon'),
                        'required' => array('tek-header-button-action','equals','3'),
                        'default' => '#'
                    ),

                    array(
                        'id' => 'tek-button-target',
                        'type' => 'select',
                        'title' => esc_html__('Link target', 'etalon'),
                        'required' => array('tek-header-button-action','equals','3'),
                        'options'  => array(
                            'new-page' => 'Open in a new page',
                            'same-page' => 'Open in same page'
                        ),
                        'default' => 'new-page'
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'title' => esc_html__('Home Slider', 'etalon'),
                'compiler' => 'true',
                'fields' => array(
                    array(
                        'id' => 'tek-slider',
                        'type' => 'text',
                        'title' => esc_html__('Revolution Slider Alias', 'etalon'),
                        'subtitle' => esc_html__('Insert Revolution Slider Alias here', 'etalon'),
                        'default' => ''
                    )
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-thumbs-up',
                'title' => esc_html__('Footer', 'etalon'),
                'fields' => array(

                    array(
                        'id' => 'tek-footer-fixed',
                        'type' => 'switch',
                        'title' => esc_html__('Fixed Footer', 'etalon'),
                        'subtitle' => esc_html__('Enable to activate this feature.', 'etalon'),
                        'default' => true
                    ),
                    array(
                        'id' => 'tek-backtotop',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Go to Top Button', 'etalon'),
                        'subtitle' => esc_html__('Enable to display the Go to Top button.', 'etalon'),
                        'default' => true
                    ),
                    array(
                        'id' => 'tek-footer-business-info',
                        'type' => 'switch',
                        'title' => esc_html__('Display Footer Panel', 'etalon'),
                        'subtitle' => esc_html__('Enable to display a business info panel.', 'etalon'),
                        'default' => true
                    ),
                    array(
                        'id' => 'tek-footer-bussiness-template',
                        'type' => 'select',
                        'title' => esc_html__('Footer Panel Template', 'etalon'),
                        'required' => array('tek-footer-business-info','equals', true),
                        'options'  => array(
                            '1' => 'Business info (address, phone, email)',
                            '2' => 'Social icons + Newsletter form',
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'tek-footer-panel-formid',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => array( 'post_type' => 'wpcf7_contact_form', ),
                        'title' => esc_html__('Newsletter Form', 'etalon'),
                        'required' => array('tek-footer-bussiness-template','equals','2'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tek-upper-footer-color',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Upper Footer Background', 'etalon'),
                        'default' => '',
                        'validate' => 'color'
                    ),
                    array(
                        'id' => 'tek-lower-footer-color',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Lower Footer Background', 'etalon'),
                        'default' => '',
                        'validate' => 'color'
                    ),
                    array(
                        'id' => 'tek-footer-heading-color',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Footer Headings Color', 'etalon'),
                        'default' => '',
                        'validate' => 'color'
                    ),
                    array(
                        'id' => 'tek-footer-text-color',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Footer Text Color', 'etalon'),
                        'default' => '',
                        'validate' => 'color'
                    ),
                    array(
                        'id' => 'tek-footer-text',
                        'type' => 'text',
                        'title' => esc_html__('Copyright Text', 'etalon'),
                        'subtitle' => esc_html__('Enter footer bottom copyright text', 'etalon'),
                        'default' => 'Etalon by KeyDesign. All rights reserved.'
                    ),

                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-fontsize',
                'title' => esc_html__('Typography', 'etalon'),
                'compiler' => true,
                'fields' => array(
                    array(
                        'id' => 'tek-default-typo',
                        'type' => 'typography',
                        'title' => esc_html__('Body Typography', 'etalon'),
                        'google' => true,
                        'font-style' => true,
                        'font-size' => true,
                        'line-height' => true,
                        'color' => true,
                        'text-align' => true,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'color' => '#828282',
                            'font-weight' => '400',
                            'font-family' => 'Raleway',
                            'google' => true,
                            'font-size' => '14px',
                            'text-align' => 'left',
                            'line-height' => '24px'
                        ),
                        'preview' => array(
                            'text' => 'Sample Text'
                        )
                    ),
                    array(
                        'id' => 'tek-heading-typo',
                        'type' => 'typography',
                        'title' => esc_html__('Heading Typography', 'etalon'),
                        'google' => true,
                        'font-style' => true,
                        'font-size' => true,
                        'line-height' => true,
                        'text-transform' => true,
                        'color' => true,
                        'text-align' => true,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'color' => '#2f2f2f',
                            'font-weight' => '700',
                            'font-family' => 'Montserrat',
                            'google' => true,
                            'font-size' => '34px',
                            'text-transform' => 'inherit',
                            'text-align' => 'center',
                            'line-height' => '45px'
                        ),
                    ),
                )
            );

            $this->sections[] = array(
                'title' => esc_html__('Typekit Fonts', 'etalon'),
                'subsection' => true,
                'fields' => array(
                  array(
                      'id' => 'tek-typekit-switch',
                      'type' => 'switch',
                      'title' => esc_html__('Enable Typekit', 'etalon'),
                      'subtitle' => esc_html__('Select to enable Typekit fonts and display options below.', 'etalon'),
                      'default' => true
                  ),
                  array(
                      'id' => 'tek-typekit',
                      'type' => 'text',
                      'title' => __('Typekit ID <a href="http://keydesign-themes.com/etalon/documentation#ops-typekit" target="_blank" class="el-icon-question-sign"></a>', 'etalon'),
                      'subtitle' => esc_html__('Enter in the ID for your kit here. Only published data is accessible, so make sure that any changes you make to your kit are updated.', 'etalon'),
                      'mode' => 'text',
                      'default' => '',
                      'theme' => 'chrome',
                      'required' => array('tek-typekit-switch','equals', true),
                  ),
                  array(
                      'id' => 'tek-body-typekit-selector',
                      'type' => 'text',
                      'title' => __('Body Font Selector <a href="https://helpx.adobe.com/typekit/using/css-selectors.html" target="_blank" class="el-icon-question-sign"></a>', 'etalon'),
                      'subtitle' => esc_html__('Add the Typekit font family name.', 'etalon'),
                      'default' => '',
                      'required' => array('tek-typekit-switch','equals', true),
                  ),
                  array(
                      'id' => 'tek-heading-typekit-selector',
                      'type' => 'text',
                      'title' => __('Headings Font Selector <a href="https://helpx.adobe.com/typekit/using/css-selectors.html" target="_blank" class="el-icon-question-sign"></a>', 'etalon'),
                      'subtitle' => esc_html__('Add the Typekit font family name.', 'etalon'),
                      'default' => '',
                      'required' => array('tek-typekit-switch','equals', true),
                  ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-th-list',
                'title' => esc_html__('Portfolio', 'etalon'),
                'compiler' => 'true',
                'fields' => array(
                    array(
                                'id' => 'tek-portfolio-title',
                                'type' => 'switch',
                                'title' => esc_html__('Show Title', 'etalon'),
                                'subtitle' => esc_html__('Activate to display the portfolio item title in the content area.', 'etalon'),
                                'default' => '1',
                                'on' => 'Yes',
                                'off' => 'No',
                        ),
                    array(
                                'id' => 'tek-portfolio-social',
                                'type' => 'switch',
                                'title' => esc_html__('Social Media', 'etalon'),
                                'subtitle' => esc_html__('Activate to display the share on social media buttons.', 'etalon'),
                                'default' => '1',
                                'on' => 'Yes',
                                'off' => 'No',
                        ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-shopping-cart',
                'title' => esc_html__('WooCommerce', 'etalon'),
                'compiler' => 'true',
                'fields' => array(
                    array(
                        'id' => 'tek-woo-sidebar-position',
                        'type' => 'select',
                        'title' => esc_html__('Shop Sidebar Position', 'etalon'),
                        'select2' => array('allowClear' => false, 'minimumResultsForSearch' => '-1'),
                        'options'  => array(
                            'woo-sidebar-left' => 'Left',
                            'woo-sidebar-right' => 'Right',
                        ),
                        'default' => 'woo-sidebar-right'
                    ),
                    array(
                        'id' => 'tek-woo-single-sidebar',
                        'type' => 'switch',
                        'title' => esc_html__('Single Product Sidebar', 'etalon'),
                        'subtitle' => esc_html__('Enable/Disable shop sidebar on single product pages.', 'etalon'),
                        'default' => '0',
                        '1' => 'Yes',
                        '0' => 'No',
                    ),
                    array(
                        'id' => 'tek-woo-cart',
                        'type' => 'switch',
                        'title' => esc_html__('Cart Icon', 'etalon'),
                        'subtitle' => esc_html__('Activate to display cart icon in header.', 'etalon'),
                        'default' => '1',
                        '1' => 'On',
                        '0' => 'Off',
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-pencil-alt',
                'title' => esc_html__('Blog', 'etalon'),
                'fields' => array(
                    array(
                        'id' => 'tek-blog-sidebar',
                        'type' => 'switch',
                        'title' => esc_html__('Display Sidebar', 'etalon'),
                        'subtitle' => esc_html__('Turn on/off blog sidebar', 'etalon'),
                        'default' => true
                    ),
                    array(
                        'id' => 'tek-blog-minimal',
                        'type' => 'switch',
                        'title' => esc_html__('Grid View Blog', 'etalon'),
                        'subtitle' => esc_html__('Change blog layout to minimal grid view style', 'etalon'),
                        'default' => false
                    )
                )
            );
            $this->sections[] = array(
                'icon' => 'el-icon-error-alt',
                'title' => esc_html__('404 Page', 'etalon'),
                'fields' => array(
                    array(
                        'id' => 'tek-404-title',
                        'type' => 'text',
                        'title' => esc_html__('Title', 'etalon'),
                        'default' => 'Error 404'
                    ),
                    array(
                        'id' => 'tek-404-subtitle',
                        'type' => 'text',
                        'title' => esc_html__('Subtitle', 'etalon'),
                        'default' => 'This page could not be found!'
                    ),
                    array(
                        'id' => 'tek-404-back',
                        'type' => 'text',
                        'title' => esc_html__('Back to Homepage Button Text', 'etalon'),
                        'default' => 'Back to homepage'
                    )
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-wrench-alt',
                'title' => esc_html__('Maintenance Page', 'etalon'),
                'fields' => array(
                    array(
                        'id' => 'tek-maintenance-mode',
                        'type' => 'switch',
                        'title' => __('Enable Maintenance Mode', 'etalon'),
                        'subtitle' => esc_html__('Activate to enable maintenance mode.', 'etalon'),
                        'default' => false
                    ),
                    array(
                        'id' => 'tek-maintenance-title',
                        'type' => 'text',
                        'title' => esc_html__('Page Title', 'etalon'),
                        'required' => array('tek-maintenance-mode','equals', true),
                        'default' => 'Website launching soon'
                    ),
                    array(
                        'id' => 'tek-maintenance-content',
                        'type' => 'editor',
                        'title' => esc_html__('Page Content', 'etalon'),
                        'required' => array('tek-maintenance-mode','equals', true),
                        'default' => '',
		                    'args'   => array(
                          'teeny'  => true,
                          'textarea_rows' => 10,
                          'media_buttons' => false,
			                  )
                    ),
                    array(
                        'id' => 'tek-maintenance-countdown',
                        'type' => 'switch',
                        'title' => __('Enable Countdown', 'etalon'),
                        'subtitle' => esc_html__('Activate to enable the countdown timer.', 'etalon'),
                        'required' => array('tek-maintenance-mode','equals', true),
                        'default' => false
                    ),
                    array(
                        'id' => 'tek-maintenance-count-day',
                        'type' => 'text',
                        'title' => esc_html__('End Day', 'etalon'),
                        'subtitle' => esc_html__('Enter day value. Eg. 05', 'etalon'),
                        'required' => array('tek-maintenance-countdown','equals', true),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tek-maintenance-count-month',
                        'type' => 'text',
                        'title' => esc_html__('End Month', 'etalon'),
                        'subtitle' => esc_html__('Enter month value. Eg. 09', 'etalon'),
                        'required' => array('tek-maintenance-countdown','equals', true),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tek-maintenance-count-year',
                        'type' => 'text',
                        'title' => esc_html__('End Year', 'etalon'),
                        'subtitle' => esc_html__('Enter year value. Eg. 2020', 'etalon'),
                        'required' => array('tek-maintenance-countdown','equals', true),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tek-maintenance-days-text',
                        'type' => 'text',
                        'title' => esc_html__('Days Label', 'etalon'),
                        'subtitle' => esc_html__('Enter days text label.', 'etalon'),
                        'required' => array('tek-maintenance-countdown','equals', true),
                        'default' => 'Days'
                    ),
                    array(
                        'id' => 'tek-maintenance-hours-text',
                        'type' => 'text',
                        'title' => esc_html__('Hours Label', 'etalon'),
                        'subtitle' => esc_html__('Enter hours text label.', 'etalon'),
                        'required' => array('tek-maintenance-countdown','equals', true),
                        'default' => 'Hours'
                    ),
                    array(
                        'id' => 'tek-maintenance-minutes-text',
                        'type' => 'text',
                        'title' => esc_html__('Minutes Label', 'etalon'),
                        'subtitle' => esc_html__('Enter minutes text label.', 'etalon'),
                        'required' => array('tek-maintenance-countdown','equals', true),
                        'default' => 'Minutes'
                    ),
                    array(
                        'id' => 'tek-maintenance-seconds-text',
                        'type' => 'text',
                        'title' => esc_html__('Seconds Label', 'etalon'),
                        'subtitle' => esc_html__('Enter seconds text label.', 'etalon'),
                        'required' => array('tek-maintenance-countdown','equals', true),
                        'default' => 'Seconds'
                    ),
                    array(
                        'id' => 'tek-maintenance-subscribe',
                        'type' => 'switch',
                        'title' => __('Enable Contact Form', 'etalon'),
                        'subtitle' => esc_html__('Activate to enable contact form on page.', 'etalon'),
                        'required' => array('tek-maintenance-mode','equals', true),
                        'default' => false
                    ),
                    array(
                        'id' => 'tek-maintenance-form-select',
                        'type' => 'select',
                        'title' => esc_html__('Contact Form Plugin', 'etalon'),
                        'required' => array('tek-maintenance-subscribe','equals',true),
                        'options'  => array(
                            '1' => 'Contact Form 7',
                            '2' => 'Ninja Forms',
                            '3' => 'Gravity Forms',
                            '4' => 'WP Forms',
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'tek-maintenance-contactf7-formid',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1, ),
                        'title' => esc_html__('Contact Form 7 Title', 'etalon'),
                        'required' => array('tek-maintenance-form-select','equals','1'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tek-maintenance-ninja-formid',
                        'type' => 'text',
                        'title' => esc_html__('Ninja Form ID', 'etalon'),
                        'required' => array('tek-maintenance-form-select','equals','2'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tek-maintenance-gravity-formid',
                        'type' => 'text',
                        'title' => esc_html__('Gravity Form ID', 'etalon'),
                        'required' => array('tek-maintenance-form-select','equals','3'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tek-maintenance-wp-formid',
                        'type' => 'text',
                        'title' => esc_html__('WP Form ID', 'etalon'),
                        'required' => array('tek-maintenance-form-select','equals','4'),
                        'default' => ''
                    ),

                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-css',
                'title' => esc_html__('Custom CSS/JS', 'etalon'),
                'fields' => array(
                    array(
                        'id' => 'tek-css',
                        'type' => 'ace_editor',
                        'title' => esc_html__('CSS', 'etalon'),
                        'subtitle' => esc_html__('Enter your CSS code in the side field. Do not include any tags or HTML in the field. Custom CSS entered here will override the theme CSS.', 'etalon'),
                        'mode' => 'css',
                        'theme' => 'chrome',
                    ),
                    array(
                  			'id' => 'tek-javascript',
                  			'type' => 'ace_editor',
                  			'title' => esc_html__( 'Javascript', 'etalon' ),
                  			'subtitle' => esc_html__( 'Only accepts Javascript code.', 'etalon' ),
                  			'mode' => 'html',
                  			'theme' => 'chrome',
                		),
                )
            );

            $this->sections[] = array(
                'title' => esc_html__('Import Demo ', 'etalon'),
                'desc' => __('Import demo content <a href="http://keydesign-themes.com/etalon/documentation#gs-importing-demo-content" target="_blank" class="el-icon-question-sign"></a>', 'etalon'),
                'icon' => 'el-icon-magic',
                'fields' => array(
                    array(
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => __('Import Demo Content <a href="http://keydesign-themes.com/etalon/documentation#gs-importing-demo-content" target="_blank" class="el-icon-question-sign"></a>', 'etalon'),
                        'subtitle' => '',
                        'full_width' => false
                    )
                )
            );
        }

        /**
        * All the possible arguments for Redux.
        * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
        * */
        public function setArguments() {
            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args = array(
                'opt_name' => 'redux_ThemeTek',
                'menu_type' => 'submenu',

                'menu_title' => 'Theme Options',
                'page_title' => 'Theme Options',

                'async_typography' => false,
                'admin_bar' => false,
                'dev_mode' => false,
                'show_options_object'  => false,
                'customizer' => false,
                'show_import_export' => true,

                'page_parent' => 'themes.php',
                'page_permissions' => 'manage_options',
                'page_slug' => 'theme-options',
                'hints' => array(
                    'icon' => 'el-icon-question-sign',
                    'icon_position' => 'right',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'light'
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right'
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'duration' => '500',
                            'event' => 'mouseover'
                        ),
                        'hide' => array(
                            'duration' => '500',
                            'event' => 'mouseleave unfocus'
                        )
                    )
                ),
                'output' => '1',
                'output_tag' => '1',
                'compiler' => '0',
                'page_icon' => 'icon-themes',
                'save_defaults' => '1',
                'transient_time' => '3600',
                'network_sites' => '1',
            );
            $this->args["display_name"] = $theme->get("Name");
            $this->args["display_version"] = $theme->get("Version");

        }
    }
    global $reduxConfig;
    $reduxConfig = new keydesign_Redux_Framework_config();
}
