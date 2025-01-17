<!-- Create a header in the default WordPress 'wrap' container -->
<div class="wrap">

    <h2><?php _e( 'RevEngine Tracker Options', 'revengine-tracker-options' ); ?></h2>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php settings_fields( 'revengine-tracker-options-group' ); ?>
        <?php do_settings_sections( 'revengine-tracker-options-group' ); ?>
        <h2>RevEngine Settings</h2>
        <hr>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Enable RevEngine Tracking</th>
                    <td>
                        <label for="revengine_enable_tracking">
                            <input name="revengine_enable_tracking" type="checkbox" id="revengine_enable_tracking" value="1" <?php esc_attr_e(get_option("revengine_enable_tracking") ? 'checked="checked"' : "") ?>>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">RevEngine Tracker Server Address</th>
                    <td>
                        <input style="width: 600px; height: 40px;" name="revengine_tracker_server_address" placeholder="revengine.dailymaverick.com" id="revengine_tracker_server_address" type="text" value="<?php esc_attr_e(get_option('revengine_tracker_server_address')); ?>">
                        <p>Omit the "http(s)://".</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">RevEngine Tracker Server Port</th>
                    <td>
                        <input style="width: 600px; height: 40px;" name="revengine_tracker_server_port" placeholder="443" id="revengine_tracker_server_port" type="number" value="<?php esc_attr_e(get_option('revengine_tracker_server_port')); ?>">
                        <p>80 for http, 443 for https</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Use SSL</th>
                    <td>
                        <label for="revengine_tracker_ssl">
                            <input name="revengine_tracker_ssl" type="checkbox" id="revengine_tracker_ssl" value="1" <?php esc_attr_e(get_option("revengine_tracker_ssl") ? 'checked="checked"' : "") ?>>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">RevEngine Tracker Timeout</th>
                    <td>
                        <input style="width: 600px; height: 40px;" name="revengine_tracker_timeout" placeholder="1" id="revengine_tracker_timeout" type="number" value="<?php esc_attr_e(get_option('revengine_tracker_timeout')); ?>">
                        <p>Timeout in seconds</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Enable RevEngine Tracking on AMP pages</th>
                    <td>
                        <label for="revengine_tracker_amp">
                            <input name="revengine_tracker_amp" type="checkbox" id="revengine_tracker_amp" value="1" <?php esc_attr_e(get_option("revengine_tracker_amp") ? 'checked="checked"' : "") ?>>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Use IFrame Method</th>
                    <td>
                        <label for="revengine_tracker_iframe">
                            <input name="revengine_tracker_iframe" type="checkbox" id="revengine_tracker_iframe" value="1" <?php esc_attr_e(get_option("revengine_tracker_iframe") ? 'checked="checked"' : "") ?>>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Enable Debug</th>
                    <td>
                        <label for="revengine_tracker_debug">
                            <input name="revengine_tracker_debug" type="checkbox" id="revengine_tracker_debug" value="1" <?php esc_attr_e(get_option("revengine_tracker_debug") ? 'checked="checked"' : "") ?>>
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php submit_button(); ?>
    </form>
</div><!-- /.wrap -->