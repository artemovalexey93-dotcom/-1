<?php
/**
 * Aster Cleaning Service functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cleaning_services_agent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'aster_cleaning_service_setup' ) ) :
	
	function aster_cleaning_service_setup() {
		
		load_theme_textdomain( 'aster-cleaning-service', get_template_directory() . '/languages' );

		add_theme_support( 'woocommerce' );

		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'aster-cleaning-service' ),
				'social'  => esc_html__( 'Social', 'aster-cleaning-service' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'woocommerce',
			)
		);

		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio', 
		) );

		add_theme_support(
			'custom-background',
			apply_filters(
				'aster_cleaning_service_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'align-wide' );

		add_theme_support( 'responsive-embeds' );
		
		if ( ! defined( 'CLEANING_SERVICES_AGENT_THEME_DOCUMENTATION' ) ) {
			define('CLEANING_SERVICES_AGENT_THEME_DOCUMENTATION',__('https://demo.asterthemes.com/docs/aster-cleaning-service-free/','aster-cleaning-service'));
		}

		if ( ! defined( 'CLEANING_SERVICES_AGENT_THEME_URL' ) ) {
			define('CLEANING_SERVICES_AGENT_THEME_URL',__('https://asterthemes.com/products/aster-cleaning-service','aster-cleaning-service'));
		}
		
		if ( ! defined( 'CLEANING_SERVICES_AGENT_WELCOME_MESSAGE' ) ) {
			define( 'CLEANING_SERVICES_AGENT_WELCOME_MESSAGE', __( 'Welcome to Aster Cleaning Services', 'cleaning-services-agent' ) );
		}
	}
endif;
add_action( 'after_setup_theme', 'aster_cleaning_service_setup' );

function aster_cleaning_service_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'aster-cleaning-service' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'aster-cleaning-service' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);
}
add_action( 'widgets_init', 'aster_cleaning_service_widgets_init' );

function aster_cleaning_service_enqueue_styles() {
    //wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri()) . '/assets/css/bootstrap.css');
    $aster_cleaning_service_parentcss = 'cleaning-services-agent';
    $aster_cleaning_service_theme = wp_get_theme(); wp_enqueue_style( $aster_cleaning_service_parentcss, get_template_directory_uri() . '/style.css', array(), $aster_cleaning_service_theme->parent()->get('Version'));
    wp_enqueue_style( 'aster-cleaning-service-style', get_stylesheet_uri(), array( $aster_cleaning_service_parentcss ), $aster_cleaning_service_theme->get('Version'));
    
    // RTL style.
	wp_style_add_data('aster-cleaning-service-style', 'rtl', 'replace');

    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
}

add_action( 'wp_enqueue_scripts', 'aster_cleaning_service_enqueue_styles' );

// Remove customizer settings
function aster_cleaning_service_remove_custom($wp_customize) {

    $wp_customize->remove_setting('cleaning_services_agent_primary_color');
    $wp_customize->remove_control('cleaning_services_agent_primary_color');

    $wp_customize->remove_section( 'accordion-section-cleaning_services_agent_enable_service_section' );
    $wp_customize->remove_section( 'cleaning_services_agent_enable_service_section' );
}
add_action('customize_register', 'aster_cleaning_service_remove_custom', 1000);

/**
 * Set default typography for child theme.
 */
function cleaning_services_agent_child_set_typography_defaults() {

	if ( false === get_theme_mod( 'cleaning_services_agent_site_title_font', false ) ) {
		set_theme_mod( 'cleaning_services_agent_site_title_font', 'Inter' );
	}

	if ( false === get_theme_mod( 'cleaning_services_agent_site_description_font', false ) ) {
		set_theme_mod( 'cleaning_services_agent_site_description_font', 'Inter' );
	}

	if ( false === get_theme_mod( 'cleaning_services_agent_header_font', false ) ) {
		set_theme_mod( 'cleaning_services_agent_header_font', 'Inter' );
	}

	if ( false === get_theme_mod( 'cleaning_services_agent_content_font', false ) ) {
		set_theme_mod( 'cleaning_services_agent_content_font', 'Inter' );
	}
}
add_action( 'after_setup_theme', 'cleaning_services_agent_child_set_typography_defaults', 20 );

function aster_cleaning_service_customize_register( $wp_customize ) {

    /**
	 * ==================================================
	 * Team Section
	 * ==================================================
	 */

	$wp_customize->add_section(
		'aster_cleaning_service_team_section',
		array(
			'panel'    => 'cleaning_services_agent_front_page_options',
			'title'    => esc_html__( 'Team Section', 'aster-cleaning-service' ),
			'priority' => 11,
		)
	);

	/**
	 * Enable Section
	 */
	$wp_customize->add_setting(
		'aster_cleaning_service_team_enable',
		array(
			'default'           => true,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'aster_cleaning_service_team_enable',
		array(
			'label'   => esc_html__( 'Enable Team Section', 'aster-cleaning-service' ),
			'section' => 'aster_cleaning_service_team_section',
			'type'    => 'checkbox',
		)
	);

	/**
	 * Small Heading
	 */
	$wp_customize->add_setting(
		'aster_cleaning_service_team_subtitle',
		array(
			'default'           => 'EXPERT TEAM',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'aster_cleaning_service_team_subtitle',
		array(
			'label'   => esc_html__( 'Small Heading', 'aster-cleaning-service' ),
			'section' => 'aster_cleaning_service_team_section',
			'type'    => 'text',
		)
	);

	/**
	 * Main Heading
	 */
	$wp_customize->add_setting(
		'aster_cleaning_service_team_title',
		array(
			'default'           => 'Trained Cleaner Team',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'aster_cleaning_service_team_title',
		array(
			'label'   => esc_html__( 'Main Heading', 'aster-cleaning-service' ),
			'section' => 'aster_cleaning_service_team_section',
			'type'    => 'text',
		)
	);

	/**
	 * Button Text
	 */
	$wp_customize->add_setting(
		'aster_cleaning_service_team_button_text',
		array(
			'default'           => 'See All Members',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'aster_cleaning_service_team_button_text',
		array(
			'label'   => esc_html__( 'Button Text', 'aster-cleaning-service' ),
			'section' => 'aster_cleaning_service_team_section',
			'type'    => 'text',
		)
	);

	/**
	 * Button URL
	 */
	$wp_customize->add_setting(
		'aster_cleaning_service_team_button_link',
		array(
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'aster_cleaning_service_team_button_link',
		array(
			'label'   => esc_html__( 'Button Link', 'aster-cleaning-service' ),
			'section' => 'aster_cleaning_service_team_section',
			'type'    => 'url',
		)
	);

	/**
	 * ==================================================
	 * Team Members
	 * ==================================================
	 */

	for ( $aster_cleaning_service_team_i = 1; $aster_cleaning_service_team_i <= 4; $aster_cleaning_service_team_i++ ) {

		// Image.
		$wp_customize->add_setting(
			"aster_cleaning_service_team_image_{$aster_cleaning_service_team_i}",
			array(
				'default'           => '',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				"aster_cleaning_service_team_image_{$aster_cleaning_service_team_i}",
				array(
					'label'      => sprintf( esc_html__( 'Member %d Image', 'aster-cleaning-service' ), $aster_cleaning_service_team_i ),
					'section'    => 'aster_cleaning_service_team_section',
					'mime_type'  => 'image',
				)
			)
		);

		// Name.
		$wp_customize->add_setting(
			"aster_cleaning_service_team_name_{$aster_cleaning_service_team_i}",
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			"aster_cleaning_service_team_name_{$aster_cleaning_service_team_i}",
			array(
				'label'   => sprintf( esc_html__( 'Member %d Name', 'aster-cleaning-service' ), $aster_cleaning_service_team_i ),
				'section' => 'aster_cleaning_service_team_section',
				'type'    => 'text',
			)
		);

		// Designation.
		$wp_customize->add_setting(
			"aster_cleaning_service_team_designation_{$aster_cleaning_service_team_i}",
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			"aster_cleaning_service_team_designation_{$aster_cleaning_service_team_i}",
			array(
				'label'   => sprintf( esc_html__( 'Member %d Designation', 'aster-cleaning-service' ), $aster_cleaning_service_team_i ),
				'section' => 'aster_cleaning_service_team_section',
				'type'    => 'text',
			)
		);
	}


$wp_customize->add_setting(
    'aster_cleaning_service_banner_settings_upgraded_features',
    array(
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    'aster_cleaning_service_banner_settings_upgraded_features',
    array(
        'type'=> 'hidden',
        'description' => "
            <div class='customizer-upgraded-features'>
                <i class='fas fa-info-circle'></i>
                <span class='pro-text'>
                    Unlock Premium <strong>Features</strong> ?<br>
                    <a target='_blank' href='". esc_url(CLEANING_SERVICES_AGENT_PREMIUM_PAGE) ." '>Upgrade Pro</a>
                </div>
            </div>
        ",
        'section' => 'cleaning_services_agent_banner_section'
    )
);

$wp_customize->add_setting(
    'aster_cleaning_service_services_settings_upgraded_features',
    array(
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    'aster_cleaning_service_services_settings_upgraded_features',
    array(
        'type'=> 'hidden',
        'description' => "
            <div class='customizer-upgraded-features'>
                <i class='fas fa-info-circle'></i>
                <span class='pro-text'>
                    Unlock Premium <strong>Features</strong> ?<br>
                    <a target='_blank' href='". esc_url(CLEANING_SERVICES_AGENT_PREMIUM_PAGE) ." '>Upgrade Pro</a>
                </div>
            </div>
        ",
        'section' => 'cleaning_services_agent_services_section'
    )
);

$wp_customize->add_setting(
    'aster_cleaning_service_team_settings_upgraded_features',
    array(
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    'aster_cleaning_service_team_settings_upgraded_features',
    array(
        'type'=> 'hidden',
        'description' => "
            <div class='customizer-upgraded-features'>
                <i class='fas fa-info-circle'></i>
                <span class='pro-text'>
                    Unlock Premium <strong>Features</strong> ?<br>
                    <a target='_blank' href='". esc_url(CLEANING_SERVICES_AGENT_PREMIUM_PAGE) ." '>Upgrade Pro</a>
                </div>
            </div>
        ",
        'section' => 'aster_cleaning_service_team_section'
    )
);

}
add_action( 'customize_register', 'aster_cleaning_service_customize_register', 20 );

/**
 * Replace parent theme footer copyright content.
 */
function cleaning_services_agent_child_output_footer_copyright_content() {

	$cleaning_services_agent_theme_data = wp_get_theme();

	$cleaning_services_agent_copyright_text = get_theme_mod(
		'cleaning_services_agent_footer_copyright_text'
	);

	if ( ! empty( $cleaning_services_agent_copyright_text ) ) {

		$cleaning_services_agent_text = esc_html(
			$cleaning_services_agent_copyright_text
		);

	} else {

		$cleaning_services_agent_default_text =
			'<a href="' . esc_url( CLEANING_SERVICES_AGENT_THEME_URL ) . '" target="_blank">'
			. esc_html( $cleaning_services_agent_theme_data->get( 'Name' ) )
			. '</a>'
			. '&nbsp;'
			. esc_html__( 'by', 'cleaning-services-agent' )
			. '&nbsp;'
			. '<a target="_blank" href="'
			. esc_url( $cleaning_services_agent_theme_data->get( 'AuthorURI' ) )
			. '">'
			. esc_html(
				ucwords(
					$cleaning_services_agent_theme_data->get( 'Author' )
				)
			)
			. '</a>';

		/* translators: %s: wordpress.org URL */
		$cleaning_services_agent_default_text .= sprintf(
			esc_html__( ' | Powered by %s', 'cleaning-services-agent' ),
			'<a href="' . esc_url( __( 'https://wordpress.org/', 'cleaning-services-agent' ) ) . '" target="_blank">WordPress</a>. '
		);

		$cleaning_services_agent_text = $cleaning_services_agent_default_text;
	}

	?>
	<span><?php echo wp_kses_post( $cleaning_services_agent_text ); ?></span>
	<?php
}

add_action(
	'cleaning_services_agent_footer_copyright',
	'cleaning_services_agent_child_output_footer_copyright_content'
);


function aster_cleaning_service_customize_css() {
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr( get_theme_mod( 'aster_cleaning_service_primary_color', '#86c129' ) );


?> !important;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'aster_cleaning_service_customize_css' );

function cleaning_services_agent_customize_register_color( $wp_customize ) {
    $aster_cleaning_service_default_color = (get_stylesheet() === get_template()) ? '#86c129' : '#86c129';

    // Add setting for primary color
    $wp_customize->add_setting(
        'aster_cleaning_service_primary_color',
        array(
            'default'           => $aster_cleaning_service_default_color,
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    // Add control for primary color
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'aster_cleaning_service_primary_color',
            array(
                'label'    => __( 'Primary Color', 'aster-cleaning-service' ),
                'section'  => 'colors',
                'priority' => 5,
            )
        )
    );
}
add_action( 'customize_register', 'cleaning_services_agent_customize_register_color' );


/**
 * Replace parent footer copyright callback.
 */
function cleaning_services_agent_child_replace_footer_copyright() {

    remove_action(
        'cleaning_services_agent_footer_copyright',
        'cleaning_services_agent_output_footer_copyright_content'
    );

    add_action(
        'cleaning_services_agent_footer_copyright',
        'cleaning_services_agent_child_output_footer_copyright_content'
    );
}

add_action(
    'after_setup_theme',
    'cleaning_services_agent_child_replace_footer_copyright',
    20
);