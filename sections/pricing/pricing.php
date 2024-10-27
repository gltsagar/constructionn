<?php
/**
 *  Pricing Template, Pricing Plans Section
 *
 *  @package constructionn-pro
 */
$pricingpg_headings = get_theme_mod( 'pricingpg_heading', __( 'Reliable pricing strategies', 'constructionn-pro' ) );

$starter_heading  = get_theme_mod( 'starter_heading', __( 'Starter Package', 'constructionn-pro' ) );
$starter_price    = get_theme_mod( 'starter_price', __( '$ 99', 'constructionn-pro' ) );
$starter_rate     = get_theme_mod( 'starter_rate', __( 'per months', 'constructionn-pro' ) );
$starter_btn_txt  = get_theme_mod( 'starter_btn_text', __( 'Choose Plan', 'constructionn-pro' ) );
$starter_btn_link = get_theme_mod( 'starter_btn_link', '#' );
$starter_repeater = get_theme_mod( 'starter_repeater', array() );

$standard_offer    = get_theme_mod( 'standard_off', __( '10% OFF', 'constructionn-pro' ) );
$standard_heading  = get_theme_mod( 'standard_heading', __( 'Standard Package', 'constructionn-pro' ) );
$standard_price    = get_theme_mod( 'standard_price', __( '$ 299', 'constructionn-pro' ) );
$standard_rate     = get_theme_mod( 'standard_rate', __( 'per month', 'constructionn-pro' ) );
$standard_repeater = get_theme_mod( 'standard_repeater', array() );
$standard_btn_txt  = get_theme_mod( 'standard_btn_text', __( 'Choose Plan', 'constructionn-pro' ) );
$standard_btn_link = get_theme_mod( 'standard_btn_link', '#' );

$premium_heading  = get_theme_mod( 'premium_heading', __( 'Premium Package', 'constructionn-pro' ) );
$premium_price    = get_theme_mod( 'premium_price', __( '$ 399', 'constructionn-pro' ) );
$premium_rate     = get_theme_mod( 'premium_rate', __( 'per month', 'constructionn-pro' ) );
$premium_repeater = get_theme_mod( 'premium_repeater', array() );
$premium_btn_txt  = get_theme_mod( 'premium_btn_text', __( 'Choose Plan', 'constructionn-pro' ) );
$premium_btn_link = get_theme_mod( 'premium_btn_link', '#' );

$plans = array(
	'starter'  => array(
		'heading'  => $starter_heading,
		'price'    => $starter_price,
		'rate'     => $starter_rate,
		'repeater' => $starter_repeater,
		'btn_text' => $starter_btn_txt,
		'btn_link' => $starter_btn_link,
		'offer'    => '',
	),
	'standard' => array(
		'heading'  => $standard_heading,
		'price'    => $standard_price,
		'rate'     => $standard_rate,
		'repeater' => $standard_repeater,
		'btn_text' => $standard_btn_txt,
		'btn_link' => $standard_btn_link,
		'offer'    => $standard_offer,
	),
	'premium'  => array(
		'heading'  => $premium_heading,
		'price'    => $premium_price,
		'rate'     => $premium_rate,
		'repeater' => $premium_repeater,
		'btn_text' => $premium_btn_txt,
		'btn_link' => $premium_btn_link,
		'offer'    => '',
	),
);

if ( $pricingpg_headings || $starter_heading || $starter_price || $starter_rate || $starter_repeater || $standard_off || $standard_heading || $standard_price || $standard_rate || $standard_repeater || $premium_heading || $premium_price || $premium_rate || $premium_repeater ) { ?>
	<div class="pricing-section">
		<div class="container">
			<?php if ( $pricingpg_headings ) { ?>
				<div class="section-meta-wrap is-centered">
					<h2 class="section-heading"><?php echo esc_html( $pricingpg_headings ); ?></h2>
				</div>
			<?php } ?>

			<?php if ( $starter_heading || $starter_price || $starter_rate || ( $starter_btn_txt && $starter_btn_link ) || $starter_repeater || $standard_off || $standard_heading || $standard_price || $standard_rate || ( $standard_btn_txt && $standard_btn_link ) || $standard_repeater || $premium_heading || $premium_price || $premium_rate || ( $premium_btn_txt && $premium_btn_link ) || $premium_repeater ) { ?> 
				<div class="pricing-wrapper">
					<?php
					foreach ( $plans as $plan ) {
						constructionn_pro_get_pricing_card(
							$plan['heading'],
							$plan['price'],
							$plan['rate'],
							$plan['repeater'],
							$plan['btn_text'],
							$plan['btn_link'],
							$plan['offer']
						);
					}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>
