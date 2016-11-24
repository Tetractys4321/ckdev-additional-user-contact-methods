<?php
/**
 * Plugin Name: CKDEV Additional User Contact Methods
 * Plugin URI:
 * Description: Adds additional contact method fields to user profile.
 * Version 1.0
 * Author: Cameron Kellett
 * Author URI:
 * Licence: GPL2
 *
 */

//////////////////////////////////////
// 1.   ASSIGN GLOBAL VARIABLES HERE
//////////////////////////////////////

// The URL of the main plugin file
$ckdev_AUCM_url = WP_PLUGIN_URL . '/ckdev-additional-user-contact-methods.php';

// Empty options array created at init.
// This will be populated with data from the options table.
$ckdev_AUCM_options = array();



//////////////////////////////////////
// 2.  PLUGIN OPTION FUNCTIONS
//////////////////////////////////////

/**
 * ckdev_additional_user_contact_methods_menu()
 *
 * This function is called when admin_menu hook is initialised and adds a link to plugin options page into the
 * Admin Settings menu and also assigns the function responsible for outputting the options page.
 *
 */
function ckdev_additional_user_contact_methods_menu() {

    // add_options_page($page_title, $menu_title, $capability, $menu_slug, $function)
    //
    add_options_page(
        'Addtional User Contact Methods Plugin',
        'Additional User Contact Methods',
        'manage_options',
        'ckdev-additional-user-contact-methods',
        'ckdev_additional_user_contact_methods_options_page'
        );
}

add_action( 'admin_menu' , 'ckdev_additional_user_contact_methods_menu' );


/**
 *  ckdev_additional_user_contact_methods_options_page()
 *
 *  This is the main function responsible for outputting the plugin's option page.
 *  It first checks the credentials of the user, who must have 'manage-options' access.
 *  Then checks if the plugin's options form has been submitted, if so cleans the input and
 *  updates the global option array variable with the selected options prior to updating the
 *  wp_options table with those values.
 *
 */
function ckdev_additional_user_contact_methods_options_page() {

    // check credentials
    //
    if ( !current_user_can( 'manage_options' ) ){

        wp_die('You do not have permission to access this page.');
    }

    // give the function access to the plugin globals
    global $ckdev_AUCM_url; // required by the ckdev-mailchimp-options-page-wrapper.php include called at the end of the function.
    global $ckdev_AUCM_options; // the options array

    // check and sanitize data and update the wp_options table.
    //
    if ( isset( $_POST['ckdev_aucm_options_submitted'] ) ) {

        // Sanitize the submission check value
        //
        $submission_check = esc_html( $_POST['ckdev_aucm_options_submitted'] );

        // If the plugin's options form has been submitted, clean all inputs then set all true/false values
        // according to the form input values. Then update the wp_options table.
        if ( $submission_check === 'Y') {

            // Sanitize
            //
            $facebook =  esc_html($_POST['ckdev-AUCM-facebook']);
            $twitter = esc_html($_POST['ckdev-AUCM-twitter']);
            $google_plus = esc_html($_POST['ckdev-AUCM-google-plus']);
            $linked_in = esc_html($_POST['ckdev-AUCM-linked-in']);

            if ( $facebook === '1' ) {

                $ckdev_AUCM_options['facebook'] = true;

            } else {

                $ckdev_AUCM_options['facebook'] = false;
            }

            if ( $twitter === '1' ) {

                $ckdev_AUCM_options['twitter'] = true;

            } else {

                $ckdev_AUCM_options['twitter'] = false;

            }

            if ( $google_plus === '1' ) {

                $ckdev_AUCM_options['google-plus'] = true;

            } else {

                $ckdev_AUCM_options['google-plus'] = false;

            }

            if ( $linked_in === '1' ) {

                $ckdev_AUCM_options['linked-in'] = true;

            } else {

                $ckdev_AUCM_options['linked-in'] = false;
            }

            // save data into options table
            //
            update_option('ckdev_AUCM_options', $ckdev_AUCM_options);
        }
    }

    // output the options-page-wrapper
    require( 'inc/options-page-wrapper.php' );
}

//////////////////////////////////////
// 3.  PLUGIN CORE FUNCTIONALITY
//////////////////////////////////////

/**
 * ckdev_show_user_contact_method_fields($user)
 *
 * @param $user: The WordPress global for the user
 *
 * Source: https://developer.wordpress.org/plugins/users/working-with-user-metadata/
 *
 * This function fetches the plugin's options array from the wp_optons table and builds the
 * input html using the booloean values it contains as a reference before outputting the html.
 *
 * Note: If an option is set to false, it also clears the users meta data for that option.
 *
 */

function ckdev_show_user_contact_method_fields($user)

{
    $contact_options = get_option('ckdev_AUCM_options');


    $html = '<h3>Additional User Contact Methods</h3>
             <table class="form-table">';

    if ( $contact_options['facebook'] === true ){

        $html .= '
        <tr>
            <th><label for="facebook">Facebook</label></th>
            <td><input type="text" name="facebook" id="facebook"
                       value="' . esc_attr( get_the_author_meta( 'facebook', $user->ID ) )  . '"
                       class="regular-text" /><br />
                <span class="description">Please enter your Facebook URL.</span>
            </td>
        </tr>
        ';
    } else {

        update_user_meta( absint(  $user->ID ), 'facebook', '' );
    }

    if ( $contact_options['twitter'] === true ){

        $html .= '
        <tr>
            <th><label for="twitter">Twitter</label></th>
            <td><input type="text" name="twitter" id="twitter"
                       value="' . esc_attr( get_the_author_meta( 'twitter', $user->ID ) ) . '"
                       class="regular-text" /><br />
                <span class="description">Please enter your Twitter username.</span>
            </td>
        </tr>
        ';
    } else {

        update_user_meta( absint(  $user->ID ), 'twitter', '' );
    }

    if ( $contact_options['google-plus'] === true ){

        $html .= '
<tr>
            <th><label for="google-plus">Google+</label></th>
            <td><input type="text" name="google-plus" id="google-plus"
                       value="' . esc_attr( get_the_author_meta( 'google-plus', $user->ID ) ) . '"
                       class="regular-text" /><br />
                <span class="description">Please enter your Google+ URL.</span>
            </td>
        </tr>
        ';
    } else {

        update_user_meta( absint(  $user->ID ), 'google-plus', '' );
    }

    if ( $contact_options['linked-in'] === true ){

        $html .= '
      <tr>
            <th><label for="linked-in">LinkedIn</label></th>
            <td><input type="text" name="linked-in" id="linked-in"
                       value="' . esc_attr( get_the_author_meta( 'linked-in', $user->ID ) ) . '"
                       class="regular-text" /><br />
                <span class="description">Please enter your LinkedIn URL.</span>
            </td>
        </tr>
        ';
    } else {

        update_user_meta( absint(  $user->ID ), 'linked-in', '' );
    }

    $html .= '</table>';

    echo $html;

}

add_action('show_user_profile', 'ckdev_show_user_contact_method_fields', 21);
add_action('edit_user_profile', 'ckdev_show_user_contact_method_fields', 21);

/**
 * ckdev_save_user_contact_method_fields( $user_id )
 *
 * @param $user_id: WordPress global for user id
 * @return bool
 *
 * This function is called when an authorised user attempts to update the profile with entered values.*
 *
 */
function ckdev_save_user_contact_method_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

    /* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
    update_user_meta( absint( $user_id ), 'twitter', wp_kses_post( $_POST['twitter'] ) );
    update_user_meta( absint( $user_id ), 'facebook', wp_kses_post( $_POST['facebook'] ) );
    update_user_meta( absint( $user_id ), 'google-plus', wp_kses_post( $_POST['google-plus'] ) );
    update_user_meta( absint( $user_id ), 'linked-in', wp_kses_post( $_POST['linked-in'] ) );
}

add_action( 'personal_options_update', 'ckdev_save_user_contact_method_fields' );
add_action( 'edit_user_profile_update', 'ckdev_save_user_contact_method_fields' );