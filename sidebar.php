<div id="sidebar" class="widget-area" role="complementary">
<?php
$is_sidebar = false;
// Strona główna  -------------------------------------
if (is_home()) {   
        $is_sidebar = dynamic_sidebar('sidebar-default');
}
?>
</div>