<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       francis.li
 * @since      1.0.0
 *
 * @package    Site_Analytics
 * @subpackage Site_Analytics/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
if (!get_option('site_analytics_after_body_installed')) {
					echo '<div class="notice notice-error is-dismissible"><p>';
					echo __( "The 'after body hook' is not installed! This could potentially break tracking and scripts! Install <strong style='color: red;'>&lt;?php do_action('site_analytics_after_body'); ?&gt;</strong> into your theme's header just right after the &lt;body&gt; tag.", 'site-analytics' );
					echo '</p></div>';
}
?>
<div class="wrap">
		<h2>Site Analytics</h2>
        <p>Installs Google Analytics, Google Tag Manager and Tracking Scripts into the site.</p>
		<form method="post" action="options.php">
            <?php
                settings_fields( 'site-analytics' );
                do_settings_sections( 'site-analytics' );
                submit_button();
            ?>
		</form>
	</div>
	