<?php
$per_page = 9;
$pagination = true;
get_template_part('templates/loop/recent-posts', null, compact('per_page', 'pagination'));
?>