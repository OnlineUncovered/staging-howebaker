<?php
/**
 * DT dev tool admin class.
 * @since   1.0.0
 * @package
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'DT_DevToolAdmin' ) ) :

	class DT_DevToolAdmin {

		protected $admin_page_id;
		protected $menu_slug = 'dt-dev-tools';
		private $msg_text;
		private $msg_class;

		const MIN_THEME_VERSION = "5.7.0";

		public function init_admin_page() {
			$theme_path = get_template_directory();
			$file = "$theme_path/inc/mods/dev-tools/main-module.class.php";
			if ( file_exists( $file ) ) {
				require_once( $file );
				add_action( 'admin_print_styles-' . $this->admin_page_id, array( $this, 'enqueue_styles' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'load_script_files' ) );
				add_action( 'admin_post_dt-dev-tools_reset-data', array( $this, 'handle_reset_data' ) );
			}
			add_action( 'load-' . $this->admin_page_id, array( $this, 'parse_message' ) );
		}

		public function parse_message() {
			if ( ! isset ( $_GET['msg'] ) ) {
				return;
			}

			if ( 'success' === $_GET['msg'] ) {
				$this->msg_text = 'Success!';
				$this->msg_class = 'notice-success';
			}

			if ( $this->msg_text ) {
				add_action( 'admin_notices', array( $this, 'render_msg' ) );
			}
		}

		public function render_msg() {
			?>
            <div class="notice <?php echo $this->msg_class ?> is-dismissible">
                <p><?php echo $this->msg_text ?></p>
            </div>
			<?php
		}

		function handle_reset_data() {
			$msg = "Wrong nonce!";
			if ( ! isset ( $_POST['_wp_http_referer'] ) ) {
				die( 'Missing target.' );
			}
			if ( ! empty( $_POST ) && check_admin_referer( 'dt_dev_tools_reset_data_nonce' ) ) {
				$devTool = new The7_DevToolMainModule();
				$devTool->execute();
				$devTool->resetTheme();
				$msg = "success";
			}
			$url = add_query_arg( 'msg', $msg, urldecode( $_POST['_wp_http_referer'] ) );
			wp_safe_redirect( $url );
			exit();

		}

		public function load_script_files() {
			wp_enqueue_media();
			wp_register_script( 'dt-dev-tools-js', plugin_dir_url( __FILE__ ) . ( 'assets/js/the7_dev_tools_admin.js' ), array( 'jquery' ), '1.0' );
			wp_enqueue_script( 'dt-dev-tools-js' );
		}

		public function enqueue_styles() {
			wp_enqueue_style( 'the7-dashboard', PRESSCORE_ADMIN_URI . '/assets/the7-dashboard.css', array(), THE7_VERSION );
		}

		public function setup_admin_page_action() {
			$this->admin_page_id = add_management_page( __( 'The7 White-Label', 'dt-dev-tools' ), __( 'The7 White-Label', 'dt-dev-tools' ), 'edit_theme_options', $this->menu_slug, array(
				$this,
				'admin_page',
			) );
		}

		/**
		 * Display plugin interface.
		 */
		public function admin_page() {
			?>
            <div id="the7-dashboard" class="wrap dt-dev-tools">
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
				<?php
				if ( ! class_exists( 'The7_DevToolMainModule', false ) ) {
					 printf(__( 'To start to use this tool, please enable <b>The7</b> theme, theme version should be greater than <b>%1$s</b>', 'dt-dev-tools' ), $this::MIN_THEME_VERSION );
				} elseif ( ! presscore_theme_is_activated() ) {
                    _e( 'Theme not registered, please register <b>The7</b> theme', 'dt-dev-tools' );
				} else {
					$screenshotName = The7_DevToolMainModule::get_setting_name( 'screenshot' );
					$screenshotVal = The7_DevToolMainModule::getToolOption( 'screenshot' );
					?>
                    <div class="the7-postbox">
                        <form action="options.php" method="post">
							<h2><?php _e( 'General', 'dt-dev-tools' ); ?></h2>
							<?php settings_fields( The7_DevToolMainModule::getOptionName() ); ?>
                            <table class="the7-system-status" cellspacing="0" cellpadding="0">
                                <tbody>
                                <tr>
                                    <td>
                                        <label for="dt-checkbox-hide_the7_menu"><?php _e( 'Hide The7 menu', 'dt-dev-tools' ); ?></label>
                                    </td>
                                    <td>
                                        <input id="dt-checkbox-hide_the7_menu"
                                               name="<?php echo The7_DevToolMainModule::get_setting_name( 'hide_the7_menu' ) ?>"
                                               value=1
                                               type="checkbox"
											<?php checked( The7_DevToolMainModule::getToolOption( 'hide_the7_menu' ), true ); ?>/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="dt-checkbox-hide_theme_options"><?php _e( 'Hide Theme Options', 'dt-dev-tools' ); ?></label>
                                    </td>
                                    <td>
                                        <input id="dt-checkbox-hide_theme_options"
                                               name="<?php echo The7_DevToolMainModule::get_setting_name( 'hide_theme_options' ) ?>"
                                               value=1
                                               type="checkbox"
											<?php checked( The7_DevToolMainModule::getToolOption( 'hide_theme_options' ), true ); ?>/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="dt-checkbox-replace_theme_branding"><?php _e( 'Remove "The7" branding', 'dt-dev-tools' ); ?></label>
                                    </td>
                                    <td>
                                        <input id="dt-checkbox-replace_theme_branding"
                                               name="<?php echo The7_DevToolMainModule::get_setting_name( 'replace_theme_branding' ) ?>"
                                               value=1
                                               type="checkbox"
											<?php checked( The7_DevToolMainModule::getToolOption( 'replace_theme_branding' ), true ); ?>/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="dt-checkbox-use_the7_options"><?php _e( 'Use The7 theme options <br>(this setting will not effect child themes)', 'dt-dev-tools' ); ?></label>
                                    </td>
                                    <td>
                                        <input id="dt-checkbox-use_the7_options"
                                               name="<?php echo The7_DevToolMainModule::get_setting_name( 'use_the7_options' ) ?>"
                                               value=1
                                               type="checkbox"
											<?php checked( The7_DevToolMainModule::getToolOption( 'use_the7_options' ), true ); ?>/>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

							<h2><?php _e( 'Theme Branding', 'dt-dev-tools' ); ?></h2>

                            <table class="the7-system-status" cellspacing="0" cellpadding="0">
                                <tbody>
                                <tr>
                                    <td>
                                        <label for="dt-theme-name"><?php _e( 'Custom theme name', 'dt-dev-tools' ); ?></label>
                                    </td>
                                    <td>
                                        <input id="dt-theme-name" maxlength="15"
                                               name="<?php echo The7_DevToolMainModule::get_setting_name( 'theme_name' ) ?>"
                                               value="<?php echo esc_html( The7_DevToolMainModule::getToolOption( 'theme_name' ) ); ?>"></input>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
										<legend><?php _e( 'Theme screenshot', 'dt-dev-tools' ); ?></legend>
                                    </td>
                                    <td>
		                                <div id="dt_dev_tool_upload_image_thumb" class="dt-upload-file">
											<?php if ( isset( $screenshotVal ) && $screenshotVal != '' ) { ?>
		                                        <img src="<?php echo $screenshotVal; ?>"  width="65"/><?php } else {
												echo 'No image';
											} ?>
		                                </div>
		                                <input id="dt_dev_tool_upload_image" type="text" size="36"
		                                       name="<?php echo $screenshotName ?>"
		                                       value="<?php echo $screenshotVal ?>"
		                                       class=""/>
		                                <input id="dt_dev_tool_upload_image_button" type="button"
		                                       value="<?php _e( 'Upload Image', 'dt-dev-tools' ); ?>"
		                                       class="dt-upload-btn"/>
		                                <input id="dt_dev_tool_delete_image_button" type="button"
		                                       value="<?php _e( 'Remove', 'dt-dev-tools' ); ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="dt-checkbox-custom-descr"><?php _e( 'Enable custom theme description', 'dt-dev-tools' ); ?></label>
                                    </td>
                                    <td>
                                        <input id="dt-checkbox-custom-descr"
                                               name="<?php echo The7_DevToolMainModule::get_setting_name( 'replace_theme_descr' ) ?>"
                                               value=1
                                               type="checkbox"
											<?php checked( The7_DevToolMainModule::getToolOption( 'replace_theme_descr' ), true ); ?>/>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="dt-custom-descr">
								<table class="the7-system-status" cellspacing="0" cellpadding="0" style="width: 100%;">
									<tr>
										<td>
		                                    <legend><?php _e( 'Theme URL', 'dt-dev-tools' ); ?></legend>
                                		</td>
                                		<td style="width: 100%;">
		                                    <input id="dt-theme_url"
		                                           name="<?php echo The7_DevToolMainModule::get_setting_name( 'theme_url' ) ?>"
		                                           value="<?php echo esc_html( The7_DevToolMainModule::getToolOption( 'theme_url' ) ); ?>"></input>
                                		</td>
                                	</tr>
									<tr>
										<td>
											<legend><?php _e( 'Theme Author', 'dt-dev-tools' ); ?></legend>
                                		</td>
                                		<td>
                                    <input id="dt-theme_author"
                                           name="<?php echo The7_DevToolMainModule::get_setting_name( 'theme_author' ) ?>"
                                           value="<?php echo esc_html( The7_DevToolMainModule::getToolOption( 'theme_author' ) ); ?>"></input>
                                		</td>
                                	</tr>
									<tr>
										<td>
											<legend><?php _e( 'Theme Author URL', 'dt-dev-tools' ); ?></legend>
                                		</td>
                                		<td>
										<input id="dt-theme_author_uri"
                                           name="<?php echo The7_DevToolMainModule::get_setting_name( 'theme_author_uri' ) ?>"
                                           value="<?php echo esc_html( The7_DevToolMainModule::getToolOption( 'theme_author_uri' ) ); ?>"></input>
                                		</td>
                                	</tr>
									<tr>
										<td>
		                                    <legend><?php _e( 'Theme Description', 'dt-dev-tools' ); ?></legend>
                                		</td>
                                		<td>
		                                    <textarea
		                                            id="dt-theme_description"
		                                            name="<?php echo The7_DevToolMainModule::get_setting_name( 'theme_description' ) ?>"
		                                            rows="3"
		                                            style="width: 100%;"><?php echo The7_DevToolMainModule::getToolOption( 'theme_description' ); ?></textarea>
                                		</td>
                                	</tr>

									<tr>
										<td>
		                                    <legend><?php _e( 'Theme tags', 'dt-dev-tools' ); ?></legend>
                                		</td>
                                		<td>
		                                    <textarea
		                                            id="dt-theme_tags"
		                                            name="<?php echo The7_DevToolMainModule::get_setting_name( 'theme_tags' ) ?>"
		                                            rows="3"
		                                            style="width: 100%;"><?php echo The7_DevToolMainModule::getToolOption( 'theme_tags' ); ?></textarea>
                                		</td>
                                	</tr>
								</table>
                            </div>
                            <input style="float: right; margin-right: 24px;" type="submit" class="button button-primary"
                                   value="<?php _e( 'Save', 'dt-dev-tools' ); ?>"/>
                        </form>
                        <form style="padding-bottom: 20px;" action="<?php echo admin_url( 'admin-post.php' ) ?>" method="post">
                            <input type="hidden" name="action" value="dt-dev-tools_reset-data">
							<?php echo wp_nonce_field( 'dt_dev_tools_reset_data_nonce' ); ?>
	                        <?php submit_button( 'Reset style.css', 'secondary', 'submit', false ); ?>
                        </form>
                    </div>
					<?php
				}
				?>
            </div>
			<?php
		}
	}

endif;
