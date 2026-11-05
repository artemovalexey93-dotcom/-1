<?php
/**
 * Team Section
 *
 * @package Aster Cleaning Service
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! get_theme_mod( 'aster_cleaning_service_team_enable', true ) ) {
	return;
}

$aster_cleaning_service_team_subtitle    = get_theme_mod( 'aster_cleaning_service_team_subtitle', 'EXPERT TEAM' );
$aster_cleaning_service_team_title       = get_theme_mod( 'aster_cleaning_service_team_title', 'Trained Cleaner Team' );
$aster_cleaning_service_team_button_text = get_theme_mod( 'aster_cleaning_service_team_button_text', 'See All Members' );
$aster_cleaning_service_team_button_link = get_theme_mod( 'aster_cleaning_service_team_button_link', '#' );
?>

<section id="aster_cleaning_service_team-section" class="asterthemes-frontpage-section aster-cleaning-service-team">

	<div class="asterthemes-wrapper">

		<div class="team-heading">

			<?php if ( ! empty( $aster_cleaning_service_team_subtitle ) ) : ?>
				<span class="team-subtitle">
					<?php echo esc_html( $aster_cleaning_service_team_subtitle ); ?>
				</span>
			<?php endif; ?>

			<?php if ( ! empty( $aster_cleaning_service_team_title ) ) : ?>
				<h2 class="team-title">
					<?php echo esc_html( $aster_cleaning_service_team_title ); ?>
				</h2>
			<?php endif; ?>

		</div>

		<div class="team-grid">

			<?php
			for ( $aster_cleaning_service_team_i = 1; $aster_cleaning_service_team_i <= 4; $aster_cleaning_service_team_i++ ) :

				$aster_cleaning_service_team_image = absint(
					get_theme_mod(
						"aster_cleaning_service_team_image_{$aster_cleaning_service_team_i}"
					)
				);

				$aster_cleaning_service_team_image_url = $aster_cleaning_service_team_image
					? wp_get_attachment_url( $aster_cleaning_service_team_image )
					: get_template_directory_uri() . '/resource/img/team' . $aster_cleaning_service_team_i . '.png';

				$aster_cleaning_service_team_name        = get_theme_mod( "aster_cleaning_service_team_name_{$aster_cleaning_service_team_i}" );
				$aster_cleaning_service_team_designation = get_theme_mod( "aster_cleaning_service_team_designation_{$aster_cleaning_service_team_i}" );

				?>

				<div class="team-card wow zoomIn delay-1000">

					<div class="team-image">

						<img
							src="<?php echo esc_url( $aster_cleaning_service_team_image_url ); ?>"
							class="team-member-image"
							alt="<?php echo esc_attr( $aster_cleaning_service_team_name ); ?>"
						>

					</div>

					<div class="team-content">

						<?php if ( ! empty( $aster_cleaning_service_team_designation ) ) : ?>

							<span class="team-designation">

								<?php echo esc_html( $aster_cleaning_service_team_designation ); ?>

							</span>

						<?php endif; ?>

						<?php if ( ! empty( $aster_cleaning_service_team_name ) ) : ?>

							<h3 class="team-name">

								<?php echo esc_html( $aster_cleaning_service_team_name ); ?>

							</h3>

						<?php endif; ?>

					</div>

				</div>

			<?php endfor; ?>

		</div>

		<?php if ( ! empty( $aster_cleaning_service_team_button_text ) ) : ?>

			<div class="team-button-wrap">

				<a href="<?php echo esc_url( $aster_cleaning_service_team_button_link ); ?>" class="team-button">

					<?php echo esc_html( $aster_cleaning_service_team_button_text ); ?>

				</a>

			</div>

		<?php endif; ?>

	</div>

</section>