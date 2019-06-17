Task:

Create a WordPress plugin that handles visitor check-in for an office. Our office has recently tightened its security measures and we need to maintain a log of each visitor on an internal website.

Requirements:

A front-end page (/visit/) with a form that collects the visitor's name, email, and the name of the person they are visiting. Only valid email addresses are accepted.
The names of workers in the office are available via JSON here: https://gist.githubusercontent.com/jjeaton/21f04d41287119926eb4/raw/4121417bda0860f662d471d1d22b934a0af56eca/coworkers.json. Your plugin should retrieve this list once and store it. It does not need to periodically check it for updates. This list of names should be selectable and only a name from this list can be entered.
A visitor may not check in twice in the same day.
A successful registration should create a new post in a "Visitor Log" post type which logs the submitted form, the date/time, and which desk they'll be visiting.
After the successful submission, the visitor should be given positive confirmation, and then reset, ready for the next visitor.
If the submission was unsuccessful, display an error message indicating the issue.
An administrator can view the list of visitor log entries somewhere in the backend of the site.
No login is required to submit the visitor form.
It should be possible for other plugins to listen for when a new addition to the log has been made.

Additional Requirements:

Your code must conform to the WordPress coding standards.
Your code must be secure and keeping performance in mind.
Your code should be 100% custom, no third party plugins allowed. If there’s something you think would be useful, please ask.

