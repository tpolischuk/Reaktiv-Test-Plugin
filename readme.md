
# Visitor Login Plugin
- Requires at least: 5.0
- Tested up to: 5.3
- Stable tag: 5.3
- License: GPLv2 or later
- License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is a simulated visitor registration form created as a test project
for Reaktiv Studios.

## Installation

Clone the entire contents of the repository into a directory called 'reaktiv-visitor-log':

`git clone git@github.com:tpolischuk/Reaktiv-Test-Plugin.git reaktiv-visitor-log`

Move the plugin into your plugins directory.

`mv reaktiv-visitor-log path/to/your/wp-content/plugins`

Activate the plugin from the WordPress dashboard.

## Usage

On activation, the plugin will create a page in the database located at /visit/.

The form allows for 1 visit per person per day. A valid e-mail address must be supplied.

The employee list is automatically generated from a remote JSON file.

Upon a successful visit, an entry is made in a custom post type called 'Visitor Log'.

## Screenshot

![Visitor Registration Form](https://i.imgur.com/bCxyfzc.png)
