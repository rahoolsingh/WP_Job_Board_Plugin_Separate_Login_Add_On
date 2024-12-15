# WP_SEPARATE_LOGIN Plugin

## Description
The **WP_SEPARATE_LOGIN** plugin provides customizable and separate login forms for candidates and employers. It is specifically designed for job portals or websites that require role-specific authentication. This plugin includes shortcode support, making it easy to integrate into any WordPress site.

---

## Features
- **Role-Specific Login Forms**: Separate login forms for candidates and employers.
- **Shortcode Support**: Easily embed login forms using shortcodes.
- **Secure Authentication**: Uses WordPress’ built-in authentication mechanisms.
- **Error Handling**: Displays user-friendly error messages for invalid credentials.
- **Redirection**: Redirects users to role-specific dashboards upon successful login.

---

## Shortcodes

### Candidate Login
Use the following shortcode to display the candidate login form:
```[candidate_login]```

### Employer Login
Use the following shortcode to display the employer login form:
```[employer_login]```

---

## Installation
### Method 1: Manual Installation
1. Download the plugin files and upload them to your WordPress plugin directory (`/wp-content/plugins/wp_separate_login`).
2. Activate the plugin through the WordPress admin panel under the **Plugins** menu.
3. Add the shortcodes `[candidate_login]` and `[employer_login]` to the desired pages or posts.

### Method 2: Upload Plugin Zip File
1. Download the `WP_SEPARATE_LOGIN.zip` file.
2. Go to your WordPress admin panel and navigate to **Plugins > Add New**.
3. Click on the **Upload Plugin** button and select the `WP_SEPARATE_LOGIN.zip` file.
4. Click **Install Now**, and then activate the plugin.

---

## Usage
### Candidate Login Form
- Displays a form for candidates to log in.
- Redirects successfully authenticated candidates to `/user-dashboard/`.
- Displays an error if the credentials are invalid or if the user does not have the `wp_job_board_pro_candidate` role.

### Employer Login Form
- Displays a form for employers to log in.
- Redirects successfully authenticated employers to `/user-dashboard/`.
- Displays an error if the credentials are invalid or if the user does not have the `wp_job_board_pro_employer` role.

---

## Code Snippet Overview
### Candidate Login Form
The `candidate_login_shortcode` function:
- Handles form submission securely.
- Validates user credentials.
- Ensures the user has the `wp_job_board_pro_candidate` role.

### Employer Login Form
The `employer_login_shortcode` function:
- Handles form submission securely.
- Validates user credentials.
- Ensures the user has the `wp_job_board_pro_employer` role.

---

## Author
**Veer Rajpoot**  
Follow me on Twitter: [@i_veerrajpoot](https://x.com/i_veerrajpoot)

---

## License
This plugin is licensed under the GPL v2 or later. See the [GNU General Public License](https://www.gnu.org/licenses/gpl-2.0.html) for more details.

---

## Support
For issues or feature requests, please contact me through Twitter or create a pull request on the [GitHub repository](https://github.com/veerrajpoot/wp_separate_login).
