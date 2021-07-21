<?php
nux_set_view_count();
while (have_posts()) {
    the_post();

    the_content();
}