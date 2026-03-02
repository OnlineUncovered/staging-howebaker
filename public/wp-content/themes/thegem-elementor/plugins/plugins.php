<?php

require_once get_template_directory() . '/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'thegem_register_required_plugins' );
function thegem_register_required_plugins() {
	$plugins = array(
		array(
			'name' => esc_html__('TheGem Theme Elements (for Elementor)', 'thegem'),
			'slug' => 'thegem-elements-elementor',
			'source' => esc_url('http://democontent.codex-themes.com/plugins/thegem-elementor/required/thegem-elements-elementor.zip'),
			'required' => true,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => esc_html__('TheGem Demo Import (for Elementor)', 'thegem'),
			'slug' => 'thegem-importer-elementor',
			'source' => esc_url('http://democontent.codex-themes.com/plugins/thegem-elementor/recommended/thegem-importer-elementor.zip'),
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => esc_html__('TheGem Blocks (for Elementor)', 'thegem'),
			'slug' => 'thegem-blocks-elementor',
			'source' => esc_url('http://democontent.codex-themes.com/plugins/thegem-elementor/recommended/thegem-blocks-elementor.zip'),
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => esc_html__('LayerSlider WP', 'thegem'),
			'slug' => 'LayerSlider',
			'source' => esc_url('http://democontent.codex-themes.com/plugins/thegem/recommended/layersliderwp.installable.zip'),
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => esc_html__('Revolution Slider', 'thegem'),
			'slug' => 'revslider',
			'source' => esc_url('http://democontent.codex-themes.com/plugins/thegem/recommended/revslider.zip'),
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => esc_html__('Wordpress Page Widgets', 'thegem'),
			'slug' => 'wp-page-widget',
			'required' => false,
		),
		array(
			'name' => esc_html__('Elementor', 'thegem'),
			'slug' => 'elementor',
			'source' => esc_url('http://democontent.codex-themes.com/plugins/thegem-elementor/required/elementor.zip'),
			'required' => true,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => esc_html__('Contact Form 7', 'thegem'),
			'slug' => 'contact-form-7',
			'required' => false,
		),
		array(
			'name' => esc_html__('Easy Forms for MailChimp by YIKES', 'thegem'),
			'slug' => 'yikes-inc-easy-mailchimp-extender',
			'required' => false,
		),
		array(
			'name' => esc_html__('ZillaLikes', 'thegem'),
			'slug' => 'zilla-likes',
			'source' => esc_url('http://democontent.codex-themes.com/plugins/thegem/recommended/zilla-likes.zip'),
			'required' => false,
			'version' => '1.1.1',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
	);

	if(thegem_is_plugin_active('woocommerce/woocommerce.php')) {
		$plugins[] = array(
			'name' => esc_html__('YITH WooCommerce Wishlist', 'thegem'),
			'slug' => 'yith-woocommerce-wishlist',
			'required' => false,
		);
	}

	$config = array(
		'domain' => 'thegem',
		'default_path' => '',
		'parent_slug' => 'admin.php',
		'menu' => 'install-required-plugins',
		'has_notices' => true,
		'is_automatic' => true,
		'message' => '',
		'strings' => array(
			'page_title' => esc_html__( 'Install Plugins', 'thegem' ),
			'menu_title' => esc_html__( 'Install Plugins', 'thegem' ),
			'installing' => esc_html__( 'Installing Plugin: %s', 'thegem' ),
			'oops' => esc_html__( 'Something went wrong with the plugin API.', 'thegem' ),
			'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'thegem' ),
			'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'thegem' ),
			'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'thegem' ),
			'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'thegem' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'thegem' ),
			'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'thegem' ),
			'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'thegem' ),
			'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'thegem' ),
			'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'thegem' ),
			'activate_link' => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'thegem' ),
			'return' => esc_html__( 'Return to Required Plugins Installer', 'thegem' ),
			'plugin_activated' => esc_html__( 'Plugin activated successfully.', 'thegem' ),
			'complete' => esc_html__( 'All plugins installed and activated successfully. %s', 'thegem' ),
			'nag_type' => 'updated'
		)
	);

	tgmpa( $plugins, $config );

}

add_action( 'admin_init', 'thegem_updater_plugin_load' );
function thegem_updater_plugin_load() {
	if ( ! class_exists( 'TGM_Updater' ) ) {
		require get_template_directory() . '/plugins/class-tgm-updater.php';
	}
	if(thegem_is_plugin_active('thegem-elements-elementor/thegem-elements-elementor.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'thegem-elements-elementor/thegem-elements-elementor.php');
		$args = array(
			'plugin_name' => esc_html__('TheGem Theme Elements (for Elementor)', 'thegem'),
			'plugin_slug' => 'thegem-elements-elementor',
			'plugin_path' => 'thegem-elements-elementor/thegem-elements-elementor.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'thegem-elements-elementor',
			'remote_url'  => esc_url('http://democontent.codex-themes.com/plugins/thegem-elementor/required/thegem-elements-elementor.json'),
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
	if(thegem_is_plugin_active('thegem-importer-elementor/thegem-importer.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'thegem-importer-elementor/thegem-importer.php');
		$args = array(
			'plugin_name' => esc_html__('TheGem Elementor Demo Import', 'thegem'),
			'plugin_slug' => 'thegem-importer-elementor',
			'plugin_path' => 'thegem-importer-elementor/thegem-importer.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'thegem-importer-elementor',
			'remote_url'  => esc_url('http://democontent.codex-themes.com/plugins/thegem-elementor/recommended/thegem-importer-elementor.json'),
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
	if(thegem_is_plugin_active('thegem-blocks-elementor/thegem-blocks-elementor.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'thegem-blocks-elementor/thegem-blocks-elementor.php');
		$args = array(
			'plugin_name' => esc_html__('TheGem Elementor Demo Import', 'thegem'),
			'plugin_slug' => 'thegem-blocks-elementor',
			'plugin_path' => 'thegem-blocks-elementor/thegem-blocks-elementor.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'thegem-blocks-elementor',
			'remote_url'  => esc_url('http://democontent.codex-themes.com/plugins/thegem-elementor/recommended/thegem-blocks-elementor.json'),
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
	if(thegem_is_plugin_active('LayerSlider/layerslider.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'LayerSlider/layerslider.php');
		$args = array(
			'plugin_name' => esc_html__('LayerSlider WP', 'thegem'),
			'plugin_slug' => 'LayerSlider',
			'plugin_path' => 'LayerSlider/layerslider.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'LayerSlider',
			'remote_url'  => esc_url('http://democontent.codex-themes.com/plugins/thegem/recommended/layerslider.json'),
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
	if(thegem_is_plugin_active('revslider/revslider.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'revslider/revslider.php');
		$args = array(
			'plugin_name' => esc_html__('Revolution Slider', 'thegem'),
			'plugin_slug' => 'revslider',
			'plugin_path' => 'revslider/revslider.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'revslider',
			'remote_url'  => esc_url('http://democontent.codex-themes.com/plugins/thegem/recommended/revslider.json'),
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
	if(thegem_is_plugin_active('zilla-likes/zilla-likes.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'zilla-likes/zilla-likes.php');
		$args = array(
			'plugin_name' => esc_html__('ZillaLikes', 'thegem'),
			'plugin_slug' => 'zilla-likes',
			'plugin_path' => 'zilla-likes/zilla-likes.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'zilla-likes',
			'remote_url'  => esc_url('http://democontent.codex-themes.com/plugins/thegem/recommended/zilla-likes.json'),
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
}

function thegem_get_purchase() {
	if(!defined('ENVATO_HOSTED_SITE')) {
		$theme_options = get_option('thegem_theme_options');
		if($theme_options && isset($theme_options['purchase_code'])) {
			return $theme_options['purchase_code'];
		}
	} else {
		return 'envato_hosted:'.(defined('SUBSCRIPTION_CODE') ? SUBSCRIPTION_CODE : '');
	}
	return false;
}

if(function_exists('layerslider_set_as_theme')) layerslider_set_as_theme();

function thegem_upgrader_pre_download($reply, $package, $upgrader) {
	if(strpos($package, 'democontent.codex-themes.com') !== false && strpos($package, 'envato-wordpress-toolkit') === false) {
		if(!thegem_get_purchase()) {
			if(!defined('ENVATO_HOSTED_SITE')) {
				return new WP_Error('thegem_purchase_empty', sprintf(wp_kses(__('Purchase code verification failed. <a href="%s" target="_blank">Activate TheGem</a>', 'thegem'), array('a' => array('href' => array(), 'target' => array()))),esc_url(admin_url('admin.php?page=thegem-theme-options#activation'))));
			}
		}
		$response_p = wp_remote_get(add_query_arg(array('code' => thegem_get_purchase(), 'site_url' => get_site_url(), 'type' => 'elementor'), 'http://democontent.codex-themes.com/av_validate_code'.(defined('ENVATO_HOSTED_SITE') ? '_envato' : '').'.php'), array('timeout' => 20));
		if(is_wp_error($response_p)) {
			return new WP_Error('thegem_connection_failed', esc_html__('Some troubles with connecting to TheGem server.', 'thegem'));
		}
		$rp_data = json_decode($response_p['body'], true);
		if(!(is_array($rp_data) && isset($rp_data['result']) && $rp_data['result'] && isset($rp_data['item_id']) && $rp_data['item_id'] === '16061685')) {
			if(!defined('ENVATO_HOSTED_SITE')) {
				return new WP_Error('thegem_purchase_error', sprintf(wp_kses(__('Purchase code verification failed. <a href="%s" target="_blank">Activate TheGem</a>', 'thegem'), array('a' => array('href' => array(), 'target' => array()))), esc_url(admin_url('admin.php?page=thegem-theme-options#activation'))));
			}
		}
	}
	return $reply;
}
add_filter('upgrader_pre_download', 'thegem_upgrader_pre_download', 10, 3);

function thegem_pre_set_site_transient_update_themes( $transient ) {

	$response = wp_remote_get('http://democontent.codex-themes.com/plugins/thegem-elementor/theme/theme.json', array('timeout' => 5));
	if ( is_wp_error( $response ) ) {
		return $transient;
	}

	$body = wp_remote_retrieve_body($response);
	$data = json_decode($body, 1);
	if ( ! isset( $data['new_version'] ) ) {
		return $transient;
	}

	$new_version = $data['new_version'];

	// Save update info if there are newer version.
	$theme = wp_get_theme('thegem-elementor');
	if ( version_compare( $theme->get( 'Version' ), $new_version, '<' ) ) {
		$transient->response[ 'thegem-elementor' ] = array(
			'theme' => 'thegem-elementor',
			'new_version' => $new_version,
			'url' => $data['changelog'],
			'package' => $data['package'],
		);
	}

	return $transient;
}
add_filter('pre_set_site_transient_update_themes', 'thegem_pre_set_site_transient_update_themes', 10, 3);


function thegem_pre_set_site_transient_update_plugins( $transient ) {

	$response = wp_remote_get('http://democontent.codex-themes.com/plugins/thegem-elementor/required/elementor.json', array('timeout' => 5));

	if ( is_wp_error( $response ) ) {
		return $transient;
	}

	$body = wp_remote_retrieve_body($response);
	$data = json_decode($body, 1);
	if ( ! isset( $data['new_version'] ) ) {
		return $transient;
	}
	$new_version = $data['new_version'];

	$elementor_data = new stdClass;

	if(isset($transient->response['elementor/elementor.php'])) {
		$elementor_data = $transient->response['elementor/elementor.php'];
		unset($transient->response['elementor/elementor.php']);
	} elseif(isset($transient->no_update['elementor/elementor.php'])) {
		$elementor_data = $transient->no_update['elementor/elementor.php'];
		unset($transient->no_update['elementor/elementor.php']);
	}

	if(defined( 'ELEMENTOR_VERSION' ) && isset($elementor_data->new_version)) {
		if ( version_compare( ELEMENTOR_VERSION, $new_version, '<' ) ) {
			$elementor_data->new_version = $new_version;
			$elementor_data->package = $data['package'];
			$transient->response['elementor/elementor.php'] = $elementor_data;
		} else {
			$elementor_data->new_version = $new_version;
			$elementor_data->package = $data['package'];
			$transient->no_update['elementor/elementor.php'] = $elementor_data;
		}
	}
	return $transient;
}
add_filter('pre_set_site_transient_update_plugins', 'thegem_pre_set_site_transient_update_plugins', 10, 3);


add_action('wp_ajax_thegem_theme_update_confirm', 'thegem_theme_update_confirm_content');
function thegem_theme_update_confirm_content() {
?>
<div class="fancybox-content thegem-theme-update-fancybox-content">
	<div class="thegem-theme-update-confirm-content">
		<div class="ttucc-title"><img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/ttucc-title.png" alt="#" /></div>
		<div class="ttucc-description"><?php esc_html_e('Before updating, it would be better if you make a backup of your current theme files (via FTP). Also please note: if you have done any code modifications directly in parent’s theme source files, this changes may be overwritten. We recommend to use TheGem child theme for any code modifications and customizations in order to ensure all further updates without any issues.', 'thegem'); ?></div>
		<div class="ttucc-confirm">
			<div class="ttucc-confirm-checkbox">
				<label for="thegem-update-confirm-checkbox"><input type="checkbox" name="confirm" id="thegem-update-confirm-checkbox" value="1" /><?php esc_html_e('I have read this notice and agree to proceed', 'thegem'); ?></label>
			</div>
			<div class="ttucc-confirm-button">
				<button id="thegem-update-confirm-button" disabled="disabled"><?php esc_html_e('Proceed with update', 'thegem'); ?></button>
			</div>
		</div>
	</div>
</div>
<?php
	die(-1);
}

function thegem_update_notice() {
	if ( !current_user_can('update_themes' ) )
		return false;
	if ( !isset($themes_update) )
		$themes_update = get_site_transient('update_themes');
	if ( isset($themes_update->response['thegem']) ) {
		$update = $themes_update->response['thegem'];
		$theme = wp_prepare_themes_for_js( array( wp_get_theme('thegem') ) );
		$details_url = add_query_arg(array(), $update['url']);
		$update_url = wp_nonce_url( admin_url( 'update.php?action=upgrade-theme&amp;theme=' . urlencode( 'thegem' ) ), 'upgrade-theme_thegem' );
		if(isset($theme[0]) && isset($theme[0]['hasUpdate']) && $theme[0]['hasUpdate']) {
			wp_enqueue_script('jquery-fancybox');
			wp_enqueue_style('jquery-fancybox');
			echo '<div class="thegem-update-notice notice notice-warning is-dismissible">';
			echo '<p>'.sprintf(wp_kses(__('There is a new version of TheGem theme available. Your current version is <strong>%s</strong>. Update to <strong>%s</strong>.', 'thegem'), array('strong' => array())), $theme[0]['version'], $update['new_version']).'</p>';
			echo '<p>'.sprintf(wp_kses(__('<strong><a href="%s" class="thegem-view-details-link">View update details</a></strong> or <strong><a href="%s" class="thegem-update-link">Update now</a></strong>.', 'thegem'), array('strong' => array(), 'a' => array('href' => array(), 'class' => array()))), $details_url, $update_url).'</p>';
			echo '</div>';
		}
	}
}
add_action('admin_notices', 'thegem_update_notice');

function thegem_plugins_update_notice() {
	if ( !current_user_can('update_plugins' ) )
		return false;
	$plugins = get_site_transient('update_plugins');
	$thegem_plugins = array(
		'thegem-elements-elementor/thegem-elements-elementor.php',
		'thegem-importer-elementor/thegem-importer-elementor.php',
		'thegem-blocks-elementor/thegem-blocks-elementor.php',
		'LayerSlider/layerslider.php',
		'revslider/revslider.php',
	);
	if ( isset($plugins->response) && is_array($plugins->response) ) {
		wp_enqueue_script('jquery-fancybox');
		wp_enqueue_style('jquery-fancybox');
		$plugins_ids = array_keys( $plugins->response );
		foreach ( $plugins_ids as $plugin_file ) {
			if(in_array($plugin_file, $thegem_plugins)) {
				$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).$plugin_file);
				$plugin_update = $plugins->response[$plugin_file];
				echo '<div class="thegem-update-notice notice notice-warning is-dismissible">';
				echo '<p>'.sprintf(wp_kses(__('There is a new version of <strong>%s</strong> plugin available. Your current version is <strong>%s</strong>. Update to <strong>%s</strong>.', 'thegem'), array('strong' => array())), $plugin_data['Name'], $plugin_data['Version'], $plugin_update->new_version).'</p>';
				echo '<p>'.sprintf(wp_kses(__('<strong><a href="%s">Update now</a></strong>.', 'thegem'), array('strong' => array(), 'a' => array('href' => array()))), esc_url(admin_url('update-core.php'))).'</p>';
				echo '</div>';
			}
		}
	}
}
add_action('admin_notices', 'thegem_plugins_update_notice');

function thegem_tgmpa_admin_menu_args($args) {
	$args['parent_slug'] = 'thegem-theme-options';
	return $args;
}
add_filter('tgmpa_admin_menu_args', 'thegem_tgmpa_admin_menu_args');
