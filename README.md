# Introduction for Child Theme for IT Connect

## Required parent theme
This theme extends the University of Washington WordPress Theme. You'll need to install it to your themes directory as well:

https://github.com/uweb/UW-Wordpress-Theme

## Required Plug-ins

### Breadcrumb NavXT

* http://mtekk.us/code/breadcrumb-navxt/
* Installing involved adding a breadcrumbs div to the page.php file
above the page h1
* Contents of breadcrumbs are determined by the parent/child 
relationships defined when editing the page

### Responsive Select Menu

* http://wpmegamenu.com/responsive-select-menu/
* Configured in the theme. When activated, a Responsive Select
link appears with the current theme when you view the Manage
Themes page. 
* Using that menu, set Maximum Menu Width to 979px and Menu 
Depth Limit to 2
* First Item Name is the text that appears before you have
pulled down the select list. Currently set to IT Connect Topics
* The Sub Item Spacer is currently just -
* The dropdowns.php file was edited to have only the select menu appear
* Contents in the menu are determined in the regular Menus page. NOTE: 
The UW Marketing theme desktop view only handles two 
levels. It blows up if you have a menu with three or more levels  

