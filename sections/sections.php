<?php
/**
 * Render homepage sections.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function cleaning_services_agent_homepage_sections() {

	$cleaning_services_agent_homepage_sections = array_keys(
		cleaning_services_agent_get_homepage_sections()
	);

	foreach ( $cleaning_services_agent_homepage_sections as $cleaning_services_agent_section ) {

		// Load parent section.
		require get_template_directory() . '/sections/' . $cleaning_services_agent_section . '.php';

		// Load Team section immediately after Banner.
		if ( 'banner' === $cleaning_services_agent_section ) {
			require get_stylesheet_directory() . '/sections/team.php';
		}
	}
}