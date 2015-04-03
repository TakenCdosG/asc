<?php
if( !defined('ABSPATH') ) exit;
if (!class_exists("Cobalt_Theme_Options")) {
    class Cobalt_Theme_Options {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
			$this->initSettings();
        }

        public function initSettings() {

            if ( !class_exists("ReduxFramework" ) ) {
                return;
            }       
            
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();
            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections() {
			//---- Theme Option Here ----//
			$schedules	=	array();
        	$wp_get_schedules	=	function_exists( 'wp_get_schedules' ) ? wp_get_schedules() : null;
        	if( is_array( $wp_get_schedules ) && !empty( $wp_get_schedules ) ){
        		foreach ($wp_get_schedules as $key=>$value) {
        			$schedules[ $key ]	=	$value['display'];
        		}
        	}

			$this->sections[] 	=	array(
				'title'	=>	__('General','cobalt'),
				'icon'	=>	'el-icon-home',
				'desc'	=>	null,
				'fields'	=>	array(
					array(
						'id'        => 'colorscheme',
						'type'      => 'image_select',
						'compiler'  => true,
						'title'     => __('Color Scheme', 'cobalt'),
						'options'   => array(
							'default' => array('alt' =>  __('Default','cobalt') , 'img' => get_template_directory_uri() . '/assets/images/default.png'  ),
							'blue' => array('alt' =>  __('Default','cobalt') , 'img' => get_template_directory_uri() . '/assets/images/color-blue.png'  ),
							'bridge' => array('alt' =>  __('Default','cobalt') , 'img' => get_template_directory_uri() . '/assets/images/color-bridge.png'  ),
							'cyan' => array('alt' =>  __('Default','cobalt') , 'img' => get_template_directory_uri() . '/assets/images/color-cyan.png'  ),
							'darkred' => array('alt' =>  __('Default','cobalt') , 'img' => get_template_directory_uri() . '/assets/images/color-darkred.png'  ),
							'green' => array('alt' =>  __('Default','cobalt') , 'img' => get_template_directory_uri() . '/assets/images/color-green.png'  ),
							'lightblue' => array('alt' =>  __('Default','cobalt') , 'img' => get_template_directory_uri() . '/assets/images/color-lightblue.png'  ),
							'orange' => array('alt' =>  __('Default','cobalt') , 'img' => get_template_directory_uri() . '/assets/images/color-orange.png'  ),
							'pink' => array('alt' =>  __('Default','cobalt') , 'img' => get_template_directory_uri() . '/assets/images/color-pink.png'  ),
							'purple' => array('alt' =>  __('Default','cobalt') , 'img' => get_template_directory_uri() . '/assets/images/color-purple.png'  ),
							'slate' => array('alt' =>  __('Default','cobalt') , 'img' => get_template_directory_uri() . '/assets/images/color-slate.png'  ),
							'yellow' => array('alt' =>  __('Default','cobalt') , 'img' => get_template_directory_uri() . '/assets/images/color-yellow.png'  )
						),
						'default'   => 'default'
					),	
					array(
						'id'        => 'post_search',
						'type'      => 'checkbox',
						'title'     => __('Search Results', 'cobalt'),
						'description'	=>	__('Only display the post in search results.','cobalt'),	
						'default'	=>	1
					),
					array(
						'id'        => 'preloader_active',
						'type'      => 'checkbox',
						'title'     => __('Display the Reloader', 'cobalt'),
						'default'	=>	1
					),
					array(
						'id'        => 'preloader',
						'type'      => 'media',
						'title'     => __('Preloader Image', 'cobalt'),
						'subtitle' => __('Upload any media using the WordPress native uploader', 'cobalt'),
						'default'	=>	array( 'url'=>get_template_directory_uri() . '/assets/images/preloader.gif' ),
						'indent'    => false,
						'required'  => array('preloader_active', "=", 1)
					),
					array(
						'id'	=>	'favicon',
						'type'	=>	'media',
						'url' => true,
                        'subtitle' => __('Upload any media using the WordPress native uploader', 'cobalt'),				
						'title'	=>	__('Favicon','cobalt')
					),
                   array(
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'title' => __('Custom CSS', 'cobalt'),
                        'subtitle' => __('Paste your CSS code here, no style tag.', 'cobalt'),
                        'mode' => 'css',
                        'theme' => 'monokai'
                    ),	
                    array(
                        'id' => 'custom_js',
                        'type' => 'ace_editor',
                        'title' => __('Custom JS', 'cobalt'),
                        'subtitle' => __('Paste your JS code here, no script tag, eg: alert(\'hello world\');', 'cobalt'),
                        'mode' => 'javascript',
                        'theme' => 'chrome'
                    )
				)
			);
	
			$this->sections[] 	=	array(
				'title'	=>	__('Contact Page','cobalt'),
				'icon'	=>	'el-icon-phone',
				'desc'	=>	null,
				'fields'	=>	array(
                    array(
                        'id' => 'address',
                        'type' => 'text',
                        'title' => __('Address', 'cobalt'),
                    	'subtitle'	=>	__('Your company/organization address','cobalt')
                    ),
					array(
						'id' => 'phone',
						'type' => 'text',
						'title' => __('Phone', 'cobalt'),
						'subtitle'	=>	__('Your company/organization phone number','cobalt')
					),
					array(
						'id' => 'fax',
						'type' => 'text',
						'title' => __('Fax', 'cobalt'),
						'subtitle'	=>	__('Your company/organization fax number','cobalt')
					),
					array(
						'id' => 'email',
						'type' => 'text',
						'title' => __('Email', 'cobalt'),
						'subtitle'	=>	__('Your email address','cobalt'),
						'default'	=>	get_bloginfo( 'admin_email' )
					),
					array(
						'id' => 'gmap_lat',
						'type' => 'text',
						'title' => __('Gmap Lat', 'cobalt'),
						'subtitle'	=>	__('Google map Latitude number','cobalt')
					),
					array(
						'id' => 'gmap_lng',
						'type' => 'text',
						'title' => __('Gmap Lng', 'cobalt'),
						'subtitle'	=>	__('Google map Longitude number','cobalt')
					),
					array(
						'id' => 'gmap_center',
						'type' => 'text',
						'title' => __('Center', 'cobalt'),
						'subtitle'	=>	__('This place will be center the screen.','cobalt'),
						'description'	=>	__('Enter Gmap Lat, Lng number, example 51.51152, -0.064198','cobalt')
					),
					array(
						'id' => 'gmap_zoom',
						'type' => 'text',
						'title' => __('Zoom', 'cobalt'),
						'default'	=>	14
					),						
					array(
						'id'	=>	'gmap_marker',
						'type'	=>	'media',
						'url' => true,
						'subtitle' => __('Upload any media using the WordPress native uploader', 'cobalt'),
						'title'	=>	__('Gmap Marker','cobalt')
					),
					array(
						'id' => 'cf7id',
						'type' => 'text',
						'title' => __('Contact form 7 ID', 'cobalt'),
						'subtitle'	=>	sprintf( __('The contact form id can be found %s','cobalt'), '<a href="'.admin_url( 'admin.php?page=wpcf7' ).'">'.__('HERE','cobalt').'</a>' )
					)						
				)
			);
			
			$this->sections[] 	=	array(
				'title'	=>	__('404 Page','cobalt'),
				'icon'	=>	'el-icon-error',
				'desc'	=>	null,
				'fields'	=>	array(
					array(
						'id'        => '404-background',
						'type'      => 'color',
						'title'     => __('Background', 'cobalt'),
						'subtitle'  => __('Pick a background color for the 404 page (default: #a2a2aa).', 'cobalt'),
						'default'   => '#a2a2aa',
						'validate'  => 'color',
					),						
					array(
						'id' => '404_text',
						'type' => 'textarea',
						'title' => __('Text', 'cobalt'),
						'subtitle'	=>	__('The text of 404 page.','cobalt'),
						'default'	=>	__('<p>UPSS! Something went wrong, <br> this page does not exist</p>','cobalt')
					),
					array(
						'id'        => '404_image',
						'type'      => 'media',
						'title'     => __('Image', 'cobalt'),
						'subtitle' => __('Upload any media using the WordPress native uploader', 'cobalt'),
						'description'	=>	__('Leave blank to use to default image.','cobalt')
					),
					array(
						'id' => '404_title',
						'type' => 'text',
						'title' => __('Title', 'cobalt'),
						'subtitle'	=>	__('The title of 404 page.','cobalt'),
						'default'	=>	__('404 ERROR','cobalt')
					)
				)
			);
			
			$this->sections[]	=	array(
				'title'	=>	__('Styling','cobalt'),
				'icon'      => 'el-icon-website',
				'fields'	=>	array(
					array(
						'id'        => 'background',
						'type'      => 'background',
						'output'    => array('header'),
						'title'     => __('Header/Left column Background Color', 'cobalt'),
						'subtitle'  => __('Pick a background color for the Header (default: #ffffff).', 'cobalt'),
						'default'   => '#FFFFFF',
					),
					array(
						'id'        => 'menu-color',
						'type'      => 'color',
						'title'     => __('Menu Color', 'cobalt'),
						'subtitle'  => __('Pick a color for the Menu (default: #606060).', 'cobalt'),
						'default'   => '#606060',
						'validate'  => 'color',
					),
					array(
						'id'        => 'menu-hover-color',
						'type'      => 'color',
						'title'     => __('Menu Hover Color', 'cobalt'),
						'subtitle'  => __('Pick a color for the Menu Hover (default: #000000).', 'cobalt'),
						'default'   => '#000000',
						'validate'  => 'color',
					)						
				)
			);
        }
        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'cobalttheme', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'submenu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Theme Options', 'cobalt'),
                'page' => __('Theme Options', 'cobalt'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                'async_typography'  => true,
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'      	=> '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );            
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://twitter.com/marstheme',
                'title' => __('Follow us on Twitter','cobalt'),
                'icon' => 'el-icon-twitter'
            );
            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'cobalt'), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'cobalt');
            }

            // Add content after the form.
            //$this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'cobalt');
        }

    }

    new Cobalt_Theme_Options();
}