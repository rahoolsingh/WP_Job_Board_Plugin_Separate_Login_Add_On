<?php
/*
Plugin Name: WP_SEPARATE_LOGIN
Description: Adds customizable and separate login forms for candidates and employers, tailored for job portals or websites requiring role-specific authentication. Includes shortcode support for easy integration.
Version: 1.95.1
Author: Veer Rajpoot
Author URI: https://x.com/i_veerrajpoot
License: GPL v2 or later
Text Domain: custom-login-shortcodes
*/


// Candidate Login Shortcode
function candidate_login_shortcode() {
    ob_start(); // Start output buffering
    $error_message = '';

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_id']) && $_POST['form_id'] === 'candidate_login_form') {
        $creds = array(
            'user_login'    => sanitize_text_field($_POST['username']),
            'user_password' => sanitize_text_field($_POST['password']),
            'remember'      => isset($_POST['remember']),
        );

        $user = wp_signon($creds, is_ssl());

        if (is_wp_error($user)) {
            $error_message = 'Invalid username or password. Please try again.';
        } else {
            // Check for the correct role
            if (!in_array('wp_job_board_pro_candidate', $user->roles)) {
                wp_logout(); // Log the user out immediately
                $error_message = 'Invalid Credentials. Please log in with valid Candidate credentials.';
            } else {
                wp_safe_redirect(home_url('/user-dashboard/'));
                exit;
            }
        }
    }

    // Check if the user is already logged in
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        if (in_array('wp_job_board_pro_candidate', $current_user->roles)) {
            wp_safe_redirect(home_url('/user-dashboard/'));
            exit;
        } else {
            echo '<div class="alert alert-danger">Invalid Credentials. Please log in with valid Candidate credentials. <a href="' . wp_logout_url(get_permalink()) . '">Try Again</a></div>';
        }
    }

    // Display the login form with errors (if any)
    if ($error_message) {
        echo '<div class="alert alert-danger">' . esc_html($error_message) . '</div>';
    }

    ?>
    <form method="post" action="<?php echo esc_url(get_permalink()); ?>">
        <div class="form-group">
            <label for="username">Jobseeker/Candidate Login</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="remember"> Keep me signed in
            </label>
        </div>
        <input type="hidden" name="form_id" value="candidate_login_form">
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <?php

    return ob_get_clean(); // Return the buffered content
}
add_shortcode('candidate_login', 'candidate_login_shortcode');

// Employer Login Shortcode
function employer_login_shortcode() {
    ob_start(); // Start output buffering
    $error_message = '';

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_id']) && $_POST['form_id'] === 'employer_login_form') {
        $creds = array(
            'user_login'    => sanitize_text_field($_POST['username']),
            'user_password' => sanitize_text_field($_POST['password']),
            'remember'      => isset($_POST['remember']),
        );

        $user = wp_signon($creds, is_ssl());

        if (is_wp_error($user)) {
            $error_message = 'Invalid username or password. Please try again.';
        } else {
            // Check for the correct role
            if (!in_array('wp_job_board_pro_employer', $user->roles)) {
                wp_logout(); // Log the user out immediately
                $error_message = 'Error: Invalid Credentials. Please log in with valid Employer credentials.';
            } else {
                wp_safe_redirect(home_url('/user-dashboard/'));
                exit;
            }
        }
    }

    // Check if the user is already logged in
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        if (in_array('wp_job_board_pro_employer', $current_user->roles)) {
            wp_safe_redirect(home_url('/user-dashboard/'));
            exit;
        } else {
            echo '<div class="alert alert-danger">Error: Invalid Credentials. Please log in with valid Employer credentials. <a href="' . wp_logout_url(get_permalink()) . '">Try Again</a></div>';
        }
    }

    // Display the login form with errors (if any)
    if ($error_message) {
        echo '<div class="alert alert-danger">' . esc_html($error_message) . '</div>';
    }

    ?>
    <form method="post" action="<?php echo esc_url(get_permalink()); ?>">
        <div class="form-group">
            <label for="username">Employer Login</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="remember"> Keep me signed in
            </label>
        </div>
        <input type="hidden" name="form_id" value="employer_login_form">
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <?php

    return ob_get_clean(); // Return the buffered content
}
add_shortcode('employer_login', 'employer_login_shortcode');
