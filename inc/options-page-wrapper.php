<?php

/**
 * ----------------------------------------------------
 * CKDEV ADDITIONAL USER CONTACT METHODS OPTIONS PAGE.
 * ----------------------------------------------------
 *
 * Place styles at top. Convert to stylesheet only when plugin advances and requires more CSS
 *
 *
 *
 *
 */

?>

<style>
    div.post-body-content-amended {
        max-width: 464px;
    }
</style>
<div class="wrap">

    <div id="icon-options-general" class="icon32"></div>
    <h1><?php esc_attr_e( 'CKDEV Additional User Contact Methods', 'wp_admin_style' ); ?></h1>

    <div id="poststuff" >

        <div id="post-body" class="metabox-holder columns-1">

            <!-- main content -->
            <div id="post-body-content" class="post-body-content-amended">

                <div class="meta-box-sortables ui-sortable">

                    <div class="postbox">

                        <h2 class="hndle"><span><?php esc_attr_e( 'Select Required Contact Methods', 'wp_admin_style' ); ?></span></h2>

                        <div class="inside">

                            <form name="ckdev_aucm_options" method="post" action="">

                                <input type="hidden" name="ckdev_aucm_options_submitted" value="Y">

                                <table class="form-table">
                                    <!-- Facebook -->
                                    <tr>
                                        <td>
                                            <?php

                                            // Grab the stored options array then check all values and set
                                            // the value to pass into the checked() function used by each checkbox
                                            //
                                            $selected_options = get_option('ckdev_AUCM_options');


                                            if ($selected_options['facebook'] == true ){

                                                $facebook_value = true;

                                            } else {

                                                $facebook_value = false;
                                            }

                                            if ($selected_options['twitter'] == true ){

                                                $twitter_value = true;

                                            } else {

                                                $twitter_value = false;
                                            }

                                            if ($selected_options['google-plus'] == true ){

                                                $google_value = true;

                                            } else {

                                                $google_value = false;
                                            }

                                            if ($selected_options['linked-in'] == true ){

                                                $linkedin_value = true;

                                            } else {

                                                $linkedin_value = false;
                                            }
                                            ?>

                                            <input type="checkbox" value="1" name="<?php esc_attr_e( 'ckdev-AUCM-facebook', 'wp_admin_style' ); ?>" <?php checked( $facebook_value, '1', TRUE ); ?> />
                                            <label for="<?php esc_attr_e( 'ckdev-AUCM-facebook', 'wp_admin_style' ); ?>">
                                                <?php esc_attr_e( 'Facebook', 'wp_admin_style' ); ?>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- Twitter -->
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="1" name="<?php esc_attr_e( 'ckdev-AUCM-twitter', 'wp_admin_style' ); ?>" <?php checked( $twitter_value, '1', TRUE ); ?> />

                                            <label for="<?php esc_attr_e( 'ckdev-AUCM-twitter', 'wp_admin_style' ); ?>">
                                                <?php esc_attr_e( 'Twitter', 'wp_admin_style' ); ?>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- Google Plus -->
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="1" name="<?php esc_attr_e( 'ckdev-AUCM-google-plus', 'wp_admin_style' ); ?>" <?php checked( $google_value, '1', TRUE ); ?> />

                                            <label for="<?php esc_attr_e( 'ckdev-AUCM-google-plus', 'wp_admin_style' ); ?>">
                                                <?php esc_attr_e( 'Google+', 'wp_admin_style' ); ?>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- Linked In-->
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="1" name="<?php esc_attr_e( 'ckdev-AUCM-linked-in', 'wp_admin_style' ); ?>" <?php checked( $linkedin_value, '1', TRUE ); ?> />

                                            <label for="<?php esc_attr_e( 'ckdev-AUCM-linked-in', 'wp_admin_style' ); ?>">
                                                <?php esc_attr_e( 'LinkedIn', 'wp_admin_style' ); ?>
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                                <p>
                                <input class="button-primary" type="submit" name="ckdev-AUCM-submit" value="<?php esc_attr_e( 'Save' ); ?>" />
                                </p>
                            </form>
                        </div>
                        <!-- .inside -->

                    </div>
                    <!-- .postbox -->

                </div>
                <!-- .meta-box-sortables .ui-sortable -->

            </div>
            <!-- post-body-content -->
        </div>
        <!-- #post-body .metabox-holder .columns-1 -->

        <br class="clear">
    </div>
    <!-- #poststuff -->
</div> <!-- .wrap -->