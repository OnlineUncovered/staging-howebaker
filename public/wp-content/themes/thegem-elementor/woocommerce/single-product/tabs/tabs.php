<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
if ( ! empty( $product_tabs ) ) :
wp_enqueue_script( 'thegem-tabs' );
wp_enqueue_style( 'thegem-tabs' ); ?>

<div class="gem-tta-container woocommerce-tabs wc-tabs-wrapper gem-woocommerce-tabs" data-vc-action="collapse">
	<div class="gem-tta-general gem-tta gem-tta-tabs gem-tta-color-thegem gem-tta-style-classic gem-tta-shape-square gem-tta-spacing-5 gem-tta-tabs-position-top gem-tta-controls-align-left">
		<div class="gem-tta-tabs-container">
			<ul class="gem-tta-tabs-list">
			<?php $is_first = true; foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="gem-tta-tab<?php if($is_first) { echo ' gem-tta-active'; $is_first= false; } ?>" data-vc-tab><a href="#tab-<?php echo esc_attr( $key ); ?>" data-vc-tabs data-vc-container=".gem-tta"><span class="gem-tta-title-text"><?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $product_tab['title'] ), $key ) ); ?></span></a></li>
			<?php endforeach; ?>
			</ul>
		</div>
		<div class="gem-tta-panels-container">
			<div class="gem-tta-panels">
				<?php $is_first = true; foreach ( $product_tabs as $key => $product_tab ) : ?>
				<div class="gem-tta-panel<?php if($is_first) { echo ' gem-tta-active'; $is_first= false; } ?>" id="tab-<?php echo esc_attr( $key ); ?>" data-vc-content=".gem-tta-panel-body">
					<div class="gem-tta-panel-heading"><h4 class="gem-tta-panel-title"><a href="#tab-<?php echo esc_attr( $key ); ?>" data-vc-accordion data-vc-container=".gem-tta-container"><span class="gem-tta-title-text"><?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $product_tab['title'] ), $key ) ); ?></span></a></h4></div>
					<div class="gem-tta-panel-body"><?php if ( isset( $product_tab['callback'] ) ) {	call_user_func( $product_tab['callback'], $key, $product_tab ); }?>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
