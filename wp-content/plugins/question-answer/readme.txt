=== Question Answer ===
	Contributors: pickplugins
	Donate link: http://pickplugins.com
	Tags:  Question Answer, Question, Answer
	Requires at least: 4.1
	Tested up to: 4.7.3
	Stable tag: 1.0.29
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html

	Create Awesome Question and Answer Website in a Minute

== Description ==

Built Question Answer site for your WordPress.

### Question Answer by http://pickplugins.com
* [Live Demo !&raquo; ](http://www.pickplugins.com/demo/question-answer/)
* [Documentation !&raquo; ](http://pickplugins.com/docs/documentation/question-answer/)


<strong>Plugin Features</strong>

* schema.org support.
* Archive page via shortcode.
* frontend question submission form via shortcode.
* Awesome account page via shortcode.


<strong>Add-ons</strong>

* [Question Aswer - Email !&raquo; ](https://wordpress.org/plugins/question-answer-email/)
* [DW Import !&raquo; ](https://wordpress.org/plugins/question-answer-dw-import/)
* [Import Question2answer !&raquo; ](https://wordpress.org/plugins/question-and-answer-import-question2answer/)
* [Import AnsPress - Question and answer !&raquo; ](https://wordpress.org/plugins/question-answer-import-anspress/)


<strong>QA Account</strong>

`[qa_myaccount]` 


<strong>Question submission</strong>

`[qa_add_question]`


<strong>Question Archive</strong>

`[question_archive]`




<strong>Translation</strong>

Pluign is translation ready , please find the 'en.po' for default translation file under 'languages' folder and add your own translation. you can also contribute in translation, please contact us http://www.pickplugins.com/contact/

Contributor

* Bengali - Nur Hasan
* Swedish - Mikaela Hårdstam Ulfsparre


== Frequently Asked Questions ==

= Single question page showing 404 error , how to solve ? =

Pelase go "Settings > Permalink Settings" and save again to reset permalink.


= Single question page style broken, what should i do ? =

Please add follwoing action on your theme fucntions.php file , you need to edit container based on your theme
`
add_action('qa_action_before_single_question', 'qa_action_before_single_question', 10);
add_action('qa_action_after_single_question', 'qa_action_after_single_question', 10);

function qa_action_before_single_question() {
  echo '<div id="main" class="site-main">';
}

function qa_action_after_single_question() {
  echo '</div>';
}

`




== Installation ==

1. Install as regular WordPress plugin.<br />
2. Go your plugin setting via WordPress Dashboard and find "<strong>Question Answer</strong>" activate it.<br />


== Screenshots ==

1. Screenshot 1
2. Screenshot 2
3. Screenshot 3
4. Screenshot 4
5. Screenshot 5
6. Screenshot 6
7. Screenshot 7
8. Screenshot 8
9. Screenshot 9
10. Screenshot 10



== Changelog ==



= 1.0.29 =
* 11/03/2017 fix - Reply on answer logged-in user name.


= 1.0.27 =
* 20/02/2017 add - Latest Questions widget.

= 1.0.26 =
* 02/02/2017 fix - sidebar issue fixed.

= 1.0.25 =
* 18/01/2017 add - added Swedish translation file.
* 18/01/2017 fix - private answer reply display issue fixed.

= 1.0.24 =
* 03/01/2017 add - Custom link redirect after login via my account page.
* 03/01/2017 fix - Custom link redirect login on question submit page.

= 1.0.23 =
* 09/12/2016 fix - Submitted question status issue fixed.

= 1.0.22 =
* 22/11/2016 add - Added poll on questions.

= 1.0.21 =
* 21/11/2016 add - manage answer post by role.
* 21/11/2016 add - manage post comment on answer by role.

= 1.0.20 =
* 21/11/2016 fix - broken div issue fixed single question.

= 1.0.19 =
* 21/11/2016 add - ajax suggestion list before submit question.

= 1.0.18 =
* 21/11/2016 add - Quick Notes for answer reply.

= 1.0.17 =
* 18/11/2016 fix - choosing best answer loggedout user issue fixed.

= 1.0.16 =
* 18/11/2016 add - Question vote on archive page.

= 1.0.15 =
* 30/10/2016 update - Responsive update.

= 1.0.14 =
* 30/10/2016 fix - Only admin can make featured question.
* 30/10/2016 fix - missing closing div on single question page.
* 31/10/2016 fix - private answer display issue fixed.

= 1.0.13 =
* 20/10/2016 add - Question comment permalink added.
* 20/10/2016 add - Answers comment permalink added.
* 20/10/2016 fix - Time in notification fixed.

= 1.0.12 =
* 17/10/2016 fix - link issue fixed on answer comment text.

= 1.0.11 =
* 12/10/2016 add - Comment popup removed.
* 12/10/2016 fix - minor php issue fixed.
* 12/10/2016 add - date & time for notifications.


= 1.0.10 =
* 30/09/2016 add - Comments wpautop added.

= 1.0.9 =
* 21/09/2016 add - marked as read & unread notifications.

= 1.0.8 =
* 20/09/2016 fix - answer display issue fixed after submitted.

= 1.0.7 =
* 19/09/2016 add - question submit form filterbale.

= 1.0.6 =
* 07/09/2016 add - admin can publish, draft, pending from frontend.
* 07/09/2016 add - Best Answer background color.

= 1.0.5 =
* 06/09/2016 add - subscriber for answer.
* 06/09/2016 add - Best Answer.	
* 06/09/2016 add - Featured question.	
* 06/09/2016 add - Social share icons.
* 06/09/2016 add - comment link fixed on notification box.	
* 06/09/2016 add - answer link fixed on notification box.			

= 1.0.4 =
* 28/08/2016 add - subscriber for questions.

= 1.0.3 =
* 28/08/2016 add - addons page.

= 1.0.2 =
* 27/08/2016 add - Bangla translation.

= 1.0.1 =
* 25/08/2016 add - Notifications.

= 1.0.0 =
* 10/08/2016 Initial release.
