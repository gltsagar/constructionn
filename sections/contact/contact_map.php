<?php
/**
 *  Contact Template, Contact Map Section
 *
 *  @package constructionn
 */
$contact_map_url = get_theme_mod( 'contact_map_iframe' );

if ( $contact_map_url ) { ?>
	<section class="map-section">
		<div class="container">
			<?php echo htmlspecialchars_decode( $contact_map_url ); ?>
		</div>
	</section>
	<?php
}
