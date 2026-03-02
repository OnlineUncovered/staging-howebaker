<?php
/**
 * Class Recently_Viewed_Products.
 *
 * @package The7
 */

namespace The7\Inc\Mods\Compatibility\WooCommerce\Front;

defined( 'ABSPATH' ) || exit;

/**
 * Class Recently_Viewed_Products
 *
 * @package The7\Inc\Mods\Compatibility\WooCommerce\Front
 */
class Recently_Viewed_Products {

	/**
	 * Return recently viewed products array.
	 *
	 * @return array|int[]
	 */
	public static function get() {
		global $post;

		if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) { // @codingStandardsIgnoreLine.
			$viewed_products = [];
		} else {
			$viewed_products = array_filter( wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ) ); // @codingStandardsIgnoreLine.
		}

		return $viewed_products;
	}

	/**
	 * Output product tracking script.
	 */
	public static function track_via_js() {
		if ( ! is_singular( 'product' ) ) {
			return;
		}

		$viewed_products = static::get();

		// Unset if already in viewed products list.
		$keys = array_flip( $viewed_products );

		if ( isset( $keys[ $post->ID ] ) ) {
			unset( $viewed_products[ $keys[ $post->ID ] ] );
		}

		$viewed_products[] = $post->ID;

		if ( count( $viewed_products ) > 15 ) {
			array_shift( $viewed_products );
		}

		$cookiepath = COOKIEPATH ? COOKIEPATH : '/';
		if ( is_multisite() ) {
			$bloginfo = get_blog_details( null, false );
			if ( isset( $bloginfo->path ) ) {
				$cookiepath = $bloginfo->path;
			}
		}

		?>
		<script>
		jQuery(function() {
		    if (typeof the7Cookies !== 'undefined') {
                the7Cookies.set(
                    "woocommerce_recently_viewed",
					"<?php echo implode( '|', $viewed_products ); ?>",
					"",
					"<?php echo $cookiepath; ?>",
					"<?php echo COOKIE_DOMAIN; ?>"
				);
            }
		});
		</script>
		<?php
	}

}
