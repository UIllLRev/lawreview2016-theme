# Includes

This folder contains PHP files that can be injected elsewhere in the template structure. For example, `logo.svg.php` is added to `header.php` using the `get_template_part()` function. Even though the original SVG file is stored in the `img/` folder, `logo.svg.php` was created as a better way to inline the SVG into the header. 

Reference: [Treehouse Blog](http://blog.teamtreehouse.com/perfect-wordpress-inline-svg-workflow)