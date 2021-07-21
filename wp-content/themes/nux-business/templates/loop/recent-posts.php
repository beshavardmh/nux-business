<?php
extract($args);
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
$query_args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => $per_page,
    'orderby' => array('date' => 'DESC', 'title' => 'ASC')
);

if (isset($pagination)) {
    $query_args['paged'] = $paged;
}

$query = new WP_Query($query_args);

if ($query->have_posts()): ?>
    <section class="blog my-6">
        <div class="container">
            <?php if (isset($is_home)): ?>
                <div class="row ai-center jc-center jc-sm-between mt-n4">
                    <h2 class="font-48 mx-3 mt-4">آخرین خبر ها</h2>

                    <a href="<?php echo home_url('blog'); ?>" class="btn btn-primary btn-fat fg-white lh-1_8 mx-3 mt-4">
                        وبلاگ ما را بررسی کنید
                    </a>
                </div>
            <?php endif; ?>

            <div class="row jc-start mt-5 mb-80">
                <?php while ($query->have_posts()) :$query->the_post(); ?>
                    <div class="col-md-6 col-lg-4 mt-5">
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

                            <div class="item-body text-center p-3 p-sm-4">
                                <a href="<?php esc_attr_e(get_the_permalink()); ?>"
                                   class="font-26 d-block fw-semibold fg-blue">
                                    <?php esc_html_e(get_the_title()); ?>
                                </a>

                                <div class="meta mt-2">
                                    <time><?php echo parsidate('j F Y', get_the_date('Y-m-d'), 'per'); ?></time>
                                    <span class="mx-1">|</span>
                                    <?php
                                    $cats = get_the_category();
                                    $cats_array = '';
                                    if ($cats) {
                                        foreach ($cats as $key1 => $cat) {
                                            $cats_array .= sprintf('<a href="%s" class="fg-blue">%s ،</a>', get_category_link($cat->term_id), $cat->name);
                                        }
                                        echo '<span class="mx-1">|</span>' . $cats_array;
                                    }
                                    ?>
                                </div>

                                <?php
                                $excerpt = get_the_excerpt();
                                $excerpt = substr($excerpt, 0, 220) . '...';
                                ?>
                                <p class="mt-4 font-16 text-justify">
                                    <?php echo $excerpt; ?>
                                </p>
                            </div>

                            <div class="d-flex w-100 ai-center jc-between px-3 px-sm-4 pb-3 pb-sm-4">
                                <a href="<?php echo get_the_permalink(); ?>" class="fg-blue">ادامه مطلب
                                    <i class="font-17 mr-1"> > </i>
                                </a>

                                <span class="fg-blue">
                                    <i class="far fa-eye ml-1"></i>
                                    <?php echo nux_get_view_count(); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>

            <?php if ($pagination): ?>
                <div>
                    <?php
                    $big = 999999999; // need an unlikely integer

                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $query->max_num_pages
                    ) );
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>