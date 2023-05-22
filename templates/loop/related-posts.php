<?php
$current_post_id = get_the_ID();

//get the categories of the current post
$cats = get_the_category($current_post_id);
if ($cats) {
    $cat_array = array();
    foreach ($cats as $key1 => $cat) {
        $cat_array[$key1] = $cat->slug;
    }
}

//get the tags of the current post
$tags = get_the_tags($current_post_id);
if ($tags) {
    $tag_array = array();
    foreach ($tags as $key2 => $tag) {
        $tag_array[$key2] = $tag->slug;
    }
}

$query_args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'tax_query' => array(
        'relation' => 'OR',
    ),
    'posts_per_page' => 3,
    'post__not_in' => array($current_post_id),
    'orderby' => array('title' => 'ASC', 'date' => 'DESC')
);

if ($cat_array) {
    $query_args['tax_query'][] = array(
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms' => $cat_array
    );
}

if ($tag_array) {
    $query_args['tax_query'][] = array(
        'taxonomy' => 'post_tag',
        'field' => 'slug',
        'terms' => $tag_array
    );
}

$related_posts = new WP_Query($query_args);

if ($related_posts->have_posts()): ?>
    <div class="related-posts mb-6">
        <h2 class="text-center text-sm-right">شاید برایتان مفید باشد</h2>

        <div class="row mx-n2 mt-n2">
            <?php while ($related_posts->have_posts()) :$related_posts->the_post(); ?>
                <div class="col-sm-6 col-lg-4 px-2 mt-5">
                    <div class="item d-flex flex-column jc-between ai-center bg-white radius-4 border">
                        <div class="thumbnail position-relative overflow-hidden">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'nux_thumbnail') ?>"
                                     class="img-fit"
                                     alt="<?php the_title(); ?>">
                            <?php else: ?>
                                <img src="<?php echo home_url('/wp-content/uploads/2021/06/placeholder.jpg'); ?>"
                                     class="img-fit"
                                     alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </div>

                        <div class="item-body text-center p-3">
                            <a href="<?php esc_attr_e(get_the_permalink()); ?>"
                               class="font-24 d-block fw-semibold fg-blue">
                                <?php esc_html_e(get_the_title()); ?>
                            </a>

                            <div class="meta mt-2">
                                <time><?php echo parsidate('j F Y', get_the_date('Y-m-d'), 'per'); ?></time>
                                <span class="mx-1">|</span>
                                <span class="fg-blue"><?php echo nux_get_view_count(); ?> بازدید</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
<?php endif; ?>