<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acmethemes
 * @subpackage SuperMag
 */

/**
 * supermag_action_before_head hook
 * @since supermag 1.0.0
 *
 * @hooked supermag_set_global -  0
 * @hooked supermag_doctype -  10
 */
do_action( 'supermag_action_before_head' );?>
	<head>
	<!-- TradeDoubler site verification 2973410 -->
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MDJWJQ3');</script>
<!-- End Google Tag Manager -->
		<?php
		/**
		 * supermag_action_before_wp_head hook
		 * @since supermag 1.0.0
		 *
		 * @hooked supermag_before_wp_head -  10
		 */
		do_action( 'supermag_action_before_wp_head' );

		wp_head();
		?>
	<!-- W3TC-include-css -->
	</head>
<body <?php body_class();
/**
 * supermag_action_body_attr hook
 * @since supermag 1.0.0
 *
 * @hooked supermag_body_attr- 10
 */
do_action( 'supermag_action_body_attr' );?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MDJWJQ3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
/**
 * supermag_action_before hook
 * @since supermag 1.0.0
 *
 * @hooked supermag_page_start - 10
 * @hooked supermag_page_start - 15
 */
do_action( 'supermag_action_before' );

/**
 * supermag_action_before_header hook
 * @since supermag 1.0.0
 *
 * @hooked supermag_skip_to_content - 10
 */
do_action( 'supermag_action_before_header' );


/**
 * supermag_action_header hook
 * @since supermag 1.0.0
 *
 * @hooked supermag_after_header - 10
 */
do_action( 'supermag_action_header' );


/**
 * supermag_action_after_header hook
 * @since supermag 1.0.0
 *
 * @hooked null
 */
do_action( 'supermag_action_after_header' );


/**
 * supermag_action_before_content hook
 * @since supermag 1.0.0
 *
 * @hooked supermag_before_content - 10
 */
do_action( 'supermag_action_before_content' );
