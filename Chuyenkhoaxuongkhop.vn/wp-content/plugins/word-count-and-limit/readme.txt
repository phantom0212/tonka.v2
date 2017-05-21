=== WordPress Word Count and Limit ===
Contributors: jojaba
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=5PXUPNR78J2YW&lc=FR&item_name=Jojaba&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: words, characters, count, limit
Requires at least: 3.0.1
Tested up to: 4.4.2
Stable tag: 1.4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Counts dynamically the characters/words in edit post window and limit the characters/words count if needed for one or more user roles.

== Description ==

This plugin replaces the word count info in bottom of the edit post window by the characters/words count (on the fly). Additionnaly, you can limit the characters/words count for defined user roles.

Here's the list of the settings (see screenshots for further infos):

* Enable or disable characters/words count limit.
* Max characters and words count setting
* Warning characters and words count setting (the count before max count when the warning is fired)
* Output Format. You can define how you would like to see the output displayed using different placeholders : `#chars` (the character count that has been typed), `#words` (The number of words), `#maxChars` (the max characters allowed), `#leftChars` (the characters count left),`#maxWords` (the max words allowed), `#leftWords` (the words count left).
* Choose what user role should be limited. Default set to contributor role.
* Choose the post types that should be limited. Default set to post.
* Set customised messages for warning or for contributor submission.

Availabe languages : english and french.

== Installation ==

1. Upload `word-count-limit` directory to the `/wp-content/plugins/` directory of your Wordpress installation
2. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= What could I limit? =

You can limit characters or words count. You must choose between this two items in the admin page (see screenshots).

= Could I enable the characters/words count limit for multiple user roles? =

Yes. You just have to check the right checkboxes in the plugin options screen. Default limited role is *contributor* but you can also limit other roles.

= What happens when user disable JavaScript? =

The native WP word count will be displayed. The characters limit will still be functionnal, but no warning message will be displayed before submitting. After clicking on the button to submit the post and if the characters count exceed the max characters count set in the options, the submission will be refused.

= Can I add html tags in the output format? =

Yes, all html tags enabled in your WordPress installation are allowed (the available tags are listed in the admin page).

So this format : `<b>#chars</b> characters | <b>#words</b> words`

… will output something like that : **80** characters | **15** words (the numbers are bold).

== Screenshots ==

1. How to find the WordPress Word Count and Limit options
2. The Options page with characters limit
3. The Options page with words limit
4. The output for the format : `#chars` characters | `#words` words
5. The output for the format : `#chars`/`#maxChars` characters, `#leftChars` left | `#words` words (when under the limit)
6. The output for the format : `#chars`/`#maxChars` characters, `#leftChars` left | `#words` words (when over the limit)

== Changelog ==

= 1.4.1 =
* Fixed the text domain issue (strings weren't translated)

= 1.4 =
* Words limit available now
* Improving code
* Improving Admin page explanations

= 1.3 =
* Works on all WorPress Version (also 4.3 and 4.4 versions)

= 1.2 =
* Fixed wrong post type display in option page
* Fixed the wrong condition set to get the options in option page
* Changed the way the user is notified when over the limit (now fires when submitting, not on hovering the publish div)
* Fixed some typos in fr tanslation

= 1.1 =
* Improved the characters and word count system
* Adding new options : impacted post types and customised messages.
* Fixing typos in language files

= 1.0 =
* First release. Thanks for your feedback!
