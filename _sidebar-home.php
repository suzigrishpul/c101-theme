<div id="sidebar">
<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Bare 
 * @since Bare 1.0
 */
if ( function_exists ( dynamic_sidebar('Homepage Sidebar') ) ) : 
 dynamic_sidebar (1); 
endif; 
?>
</ul>
</div>
