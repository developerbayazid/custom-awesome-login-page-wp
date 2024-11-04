<?php
/*
 * Plugin Name:       Login Page Customize WP
 * Plugin URI:        https://github.com/developerbayazid/custom-login-page-wp
 * Description:       Customize your login page
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Bayazid Hasan
 * Author URI:        https://github.com/developerbayazid
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       clp
*/

/**
 * Plugin options page functions
 */

// Loading admin CSS file
add_action('admin_enqueue_scripts', 'clp_admin_login_enqueue_register');
function clp_admin_login_enqueue_register(){
  wp_enqueue_style( 'clp-admin-styles', plugins_url('css/clp-admin-styles.css', __FILE__), array(), '1.0.0');

}

add_action('admin_menu', 'clp_create_admin_page');
function clp_create_admin_page(){
    add_menu_page( 'Login page for admin', 'Login Page', 'manage_options', 'clp-login-page', 'clp_create_page', 'dashicons-unlock', 101 );
}

/**
 * Plugin callback
 */
function clp_create_page(){
    ?>
    <div class="clp_main_area">
        <div class="clp_body_area clp_common">
            <h3 id="title"><?php print esc_attr('Login Page Customize', 'clp'); ?></h3>
            <form action="options.php" method="post">
                <?php wp_nonce_field( 'update-options' ); ?>
                <!-- Primary Color -->
                <label for="clp-primary-color" name="clp-primary-color"><?php print esc_attr('Primary Color', 'clp') ?></label>
                <small>Update your primary color</small>
                <input type="color" name="clp-primary-color" id="clp-primary-color" value="<?php print get_option('clp-primary-color'); ?>">
                <!-- Primary Button Hover Color -->
                <label for="clp-primary-color-hover" name="clp-primary-color-hover"><?php print esc_attr('Primary Hover Color', 'clp') ?></label>
                <small>Update your primary button hover color</small>
                <input type="color" name="clp-primary-color-hover" id="clp-primary-color-hover" value="<?php print get_option('clp-primary-color-hover'); ?>">
                <!-- Secondary Color -->
                <label for="clp-secondary-color" name="clp-secondary-color"><?php print esc_attr('Secondary Color', 'clp') ?></label>
                <small>Update your secondary color</small>
                <input type="color" name="clp-secondary-color" id="clp-secondary-color" value="<?php print get_option('clp-secondary-color'); ?>">
                <!-- Secondary Button Hover Color -->
                <label for="clp-secondary-color-hover" name="clp-secondary-color-hover"><?php print esc_attr('Secondary Hover Color', 'clp') ?></label>
                <small>Update your secondary button hover color</small>
                <input type="color" name="clp-secondary-color-hover" id="clp-secondary-color-hover" value="<?php print get_option('clp-secondary-color-hover'); ?>">
                <!-- Main Logo -->
                <label for="clp-main-logo" name="clp-main-logo"><?php print esc_attr('Upload Your Logo', 'clp') ?></label>
                <small>Paste your logo URL here (recommended size: 80px * 80px)</small>
                <input type="text" name="clp-main-logo" id="clp-main-logo" placeholder="Paste your logo URL" value="<?php print get_option('clp-main-logo'); ?>">               
                <!-- Background Image -->
                <label for="clp-bg-image" name="clp-bg-image"><?php print esc_attr('Upload Your Background Image', 'clp') ?></label>
                <small>Paste your background image URL here</small>
                <input type="text" name="clp-bg-image" id="clp-bg-image" placeholder="Paste your bg img URL" value="<?php print get_option('clp-bg-image'); ?>">
                <!-- Background Opacity -->
                <label for="clp-bg-opacity" name="clp-bg-opacity"><?php print esc_attr('Background Opacity', 'clp') ?></label>
                <small>Update your background opacity (0.1 to 0.9)</small>
                <input type="text" name="clp-bg-opacity" id="clp-bg-opacity" placeholder="background opacity (0.1 to 0.9)" value="<?php print get_option('clp-bg-opacity'); ?>">
                
                
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="page_options" value="clp-primary-color, clp-primary-color-hover, clp-secondary-color, clp-secondary-color-hover, clp-main-logo, clp-bg-image, clp-bg-opacity">
                <input type="submit" class="button button-primary" value="<?php _e('Save Changes', 'clp'); ?>">
            </form>
        </div>
        <div class="clp_sidebar_area clp_common">
            <h3 id="title"><?php print esc_attr('About Author', 'clp'); ?></h3>
            <img src="https://avatars.githubusercontent.com/u/70211199?v=4" alt=<?php print esc_attr('Bayazid Hasan'); ?>>
            <p> <b><i>Hi, I am Bayazid Hasan. I am a web application developer.</i></b> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatum voluptas assumenda quam? Delectus alias distinctio odit? Excepturi distinctio nobis sit, hic ipsa ut maiores earum. Enim quidem odit fuga nisi, ipsam, numquam impedit voluptatibus tempore, iste id nesciunt dolorum facere?</p>
        </div>
    </div>

    <?php
}

// Loading CSS file
add_action('login_enqueue_scripts', 'clp_login_enqueue_register');
function clp_login_enqueue_register(){
  wp_enqueue_style( 'clp-styles', plugins_url('css/clp-styles.css', __FILE__), array(), '1.0.0');

}


// Login Form Customize
add_action( 'login_enqueue_scripts', 'clp_login_logo_change');
function clp_login_logo_change(){
  ?>
  <style>
    /* Login Page Logo Change */
    #login h1 a, .login h1 a{
      background-image: url(<?php echo get_option('clp-main-logo'); ?>);
    }
    /* Login Input Field Border Color */
    input#user_login, input#user_pass {
        border-left: 4px solid <?php echo get_option('clp-primary-color'); ?>!important;
    }
    /* Submit Button Background color */
    #login form p.submit input {
        background-color: <?php echo get_option('clp-primary-color'); ?>!important;
    }
    #login form p.submit input:hover {
        background-color: <?php echo get_option('clp-primary-color-hover'); ?>!important;
    }
    /* Secondary Button Style */
    .login #backtoblog a {
        background-color: <?php echo get_option('clp-secondary-color'); ?>!important;
    }
    .login #backtoblog a:hover {
        background-color: <?php echo get_option('clp-secondary-color-hover'); ?>!important;
    }
    body.login {
        background-image: url(<?php echo get_option('clp-bg-image'); ?>)!important;
    }
    /* Background Opacity */
    body.login::after {
        opacity: <?php echo get_option('clp-bg-opacity'); ?>!important;
    }
  </style>

  <?php
}

// Changing Login form logo url
add_filter( 'login_headerurl', 'clp_login_logo_url_change');
function clp_login_logo_url_change(){
  return home_url();
}


/**
 * Plugin Redirect Function
 */

register_activation_hook( __FILE__, 'clp_activation_plugin');
function clp_activation_plugin(){
  add_option('clp_plugin_activation_do_redirect', true);
}

add_action('admin_init', 'clp_plugin_redirect');
function clp_plugin_redirect(){
  if(get_option('clp_plugin_activation_do_redirect', false)){
    delete_option('clp_plugin_activation_do_redirect');
    if(!isset($_GET['active-multi'])){
      wp_safe_redirect(admin_url('admin.php?page=clp-login-page'));
      exit;
    }
  }
}


?>