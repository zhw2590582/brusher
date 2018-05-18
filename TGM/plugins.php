<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.0-alpha
 * @author     Thomas Griffin
 * @author     Gary Jones
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme.
		array(
			'name'               => 'Cue', // The plugin name.
			'slug'               => 'cue', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/TGM/plugins/cue.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are wrapped in a sprintf(), so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Island插件', 'theme-slug' ),
			'menu_title'                      => __( 'Island插件', 'theme-slug' ),
			'installing'                      => __( 'Island插件: %s', 'theme-slug' ), // %s = plugin name.
			'oops'                            => __( '插件API出现错误', 'theme-slug' ),
			'notice_can_install_required'     => _n_noop( '主题必备插件: %1$s.', 'This theme requires the following plugins: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop( '主题推荐插件: %1$s.', 'This theme recommends the following plugins: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( '很抱歉, 你没有权限安装 %s 插件，联系该网站的管理员在得到安装插件的帮助。', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'theme-slug' ), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop( '以下所需的插件是目前处于非激活状态: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop( '以下推荐的插件是目前未激活: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop( '很抱歉, 你没有权限激活 %s插件，联系该网站的管理员在得到激活插件的帮助。', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'theme-slug' ), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop( '下面插件需要更新到最新版本，以确保与这个主题的最大兼容性: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop( '很抱歉, 你没有权限更新 %s 插件，联系该网站的管理员在得到更新插件的帮助。', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'theme-slug' ), // %1$s = plugin name(s).
			'install_link'                    => _n_noop( '开始安装插件', 'Begin installing plugins', 'theme-slug' ),
			'activate_link'                   => _n_noop( '开始激活插件', 'Begin activating plugins', 'theme-slug' ),
			'return'                          => __( '返回到必备插件安装界面', 'theme-slug' ),
			'plugin_activated'                => __( '插件激活成功.', 'theme-slug' ),
			'complete'                        => __( '安装并成功激活所有插件. %s', 'theme-slug' ), // %s = dashboard link.
			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );

}
