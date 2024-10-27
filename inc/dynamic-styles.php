<?php
/**
 * Breadcrumb internal CSS
 */
add_action(
	'wp_head',
	function () {
		$style = '
    .breadcrumbs .trail-browse,
    .breadcrumbs .trail-items,
    .breadcrumbs .trail-items li {
        display:     inline-block;
        margin:      0;
        padding:     0;
        border:      none;
        background:  transparent;
        text-indent: 0;
    }

    .breadcrumbs .trail-browse {
        font-size:   inherit;
        font-style:  inherit;
        font-weight: inherit;
        color:       inherit;
    }

    .breadcrumbs .trail-items {
        list-style: none;
    }

        .trail-items li::after {
            content: "\002F";
            padding: 0 0.5em;
        }

        .trail-items li:last-of-type::after {
            display: none;
        }';

		$style = apply_filters( 'breadcrumb_trail_inline_style', trim( str_replace( array( "\r", "\n", "\t", '  ' ), '', $style ) ) );

		if ( $style ) {
			echo "\n" . '<style type="text/css" id="constructionn-breadcrumbs-css">' . $style . '</style>' . "\n";
		}
	}
);
