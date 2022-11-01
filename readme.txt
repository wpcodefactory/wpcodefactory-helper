=== WPFactory Helper ===
Contributors: wpcodefactory, algoritmika, anbinder
Tags: wpfactory, wpcodefactory
Requires at least: 4.4
Tested up to: 6.0
Stable tag: 1.4.0
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Plugin helps you manage subscriptions for your products from WPFactory.com.

== Description ==

Plugin helps you manage subscriptions for your products from [WPFactory.com](https://wpfactory.com) marketplace.

Tired of searching for plugins and themes for your WordPress site? WPFactory can change that! WPFactory is your marketplace for customized and uniquely designed plugins and themes. [Browse](https://wpfactory.com) our selection to find something to improve your website. You won't find them anywhere else at these competitive prices. And with a 30-day "no-questions-asked" refund policy, there's no excuse to not have amazing plugins and themes! Here you will find great plugins and themes for your next WordPress website!

### &#128472; Feedback ###

* We are open to your suggestions and feedback. Thank you for using or trying out one of our plugins!
* [Visit our website](https://wpfactory.com/).

== Installation ==

1. Upload the entire plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Start by visiting "Settings > WPFactory" from your admin dashboard.

== Changelog ==

= 1.4.1 - 30/10/2022 =
* Fix - Error message row styling fixed.
* Dev - Plugin Update Checker - Some scheduler actions removed.

= 1.4.0 - 28/10/2022 =
* Dev - `download_url()` function removed in the `alg_get_plugins_list` and `alg_get_themes_list` actions.
* Dev - "Plugin Update Checker Library" updated to v4.13.
* Dev - Plugin is loaded on the `plugins_loaded` action now.
* Dev - Code refactoring.
* Readme.txt updated.
* Deploy script added.

= 1.3.2 - 31/05/2022 =
* Tested up to: 6.0.

= 1.3.1 - 16/04/2021 =
* Dev - Localization - `load_plugin_textdomain()` function moved to the to `init` hook.
* Tested up to: 5.7.

= 1.3.0 - 19/12/2019 =
* Dev - "Plugin Update Checker Library" updated to v4.8 (was v4.2).
* Dev - Code refactoring and clean up.
* Dev - Minor settings restyling.
* Tested up to: 5.3.

= 1.2.3 - 25/07/2019 =
* Tested up to: 5.2.

= 1.2.2 - 07/09/2018 =
* Fix - Trimming key before validation (fixes the issue with tab symbols at the end of the key).

= 1.2.1 - 17/08/2018 =
* Dev - Plugin renamed to "WPFactory Helper".
* Dev - Plugin URL updated.

= 1.2.0 - 02/10/2017 =
* Dev - `alg_wpcfh_update_site_key_status()` - Don't overwrite valid licence response with server errors (no response etc.).
* Dev - "Try again" link added on "Server error" messages.
* Dev - "Check key" links added to "Settings > WPCodeFactory Helper".
* Dev - "Update item list manually" button added to "Settings > WPCodeFactory Helper".
* Dev - "Settings > WPCodeFactory Helper" - Key column - Color and title added.

= 1.1.0 - 29/09/2017 =
* Dev - Themes updates added.
* Dev - Minor restyling on Plugins page.

= 1.0.1 - 22/08/2017 =
* Fix - `ALG_WPCODEFACTORY_HELPER_UPDATE_SERVER` constant added.
* Dev - "Settings" action link added.
* Dev - "Site URL" info added to admin settings page.

= 1.0.0 - 02/08/2017 =
* Initial Release.

== Upgrade Notice ==

= 1.0.0 =
This is the first release of the plugin.
