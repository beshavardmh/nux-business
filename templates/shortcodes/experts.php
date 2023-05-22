<section class="py-6">
    <div class="container">
        <div class="row ai-center">
            <div class="col-lg-6 mt-5">
                <p class="text-justify font-22">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
                    چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است .
                </p>
            </div>

            <div class="col-lg-6 mt-5">
                <div class="d-flex mx-n2">
                    <div class="col-6 px-2">
                        <div class="card radius-10 p-4 text-center lh-1">
                            <b class="font-50 d-block fg-blue">172</b>
                            <span class="d-block font-18">کشور های قابل پشتیبانی</span>
                        </div>
                    </div>

                    <div class="col-6 px-2">
                        <div class="card radius-10 p-4 text-center lh-1">
                            <b class="font-50 d-block fg-blue">64M</b>
                            <span class="d-block font-18">سرمایه گذاران</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-6 pb-lg-6">
    <div class="container mt-n6 mt-lg-0 mb-lg-6">
        <?php
        $query_args = array(
            'post_type' => 'nux-team',
            'post_status' => 'publish',
            'posts_per_page' => '-1',
            'orderby' => array('date' => 'ASC', 'title' => 'ASC')
        );
        $query = new WP_Query($query_args);
        $counter = 0;
        ?>

        <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()): ?>
                <?php
                $query->the_post();
                ++$counter;
                ?>
                <?php if ($counter % 2 == 0): ?>
                    <div class="row flex-row-reverse ai-center mt-n5 mb-6 mb-lg-0">
                        <div class="col-lg-6 pr-lg-0 mt-5">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="expert-thumbnail">
                                    <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6 pl-lg-5 mt-5">
                            <h2 class="font-30"><?php the_title(); ?></h2>
                            <span class="d-block mt-3"><?php
                                $team_title = get_post_meta(get_the_ID(), 'nux_team_title', true);
                                nux_show_exist($team_title);
                                ?></span>

                            <?php if (has_excerpt()): ?>
                                <p class="font-18 text-justify my-4">
                                    <?php echo get_the_excerpt(); ?>
                                </p>
                            <?php endif; ?>

                            <div class="hr-line my-5"></div>

                            <div class="d-flex mx-n3 ai-center">
                                <?php $team_social = get_post_meta($post->ID, 'nux_team_social')[0]; ?>
                                <a href="<?php nux_show_exist($team_social['facebook'], '#'); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook"
                                   class="fab fa-facebook-f fg-gray font-20 mx-3"></a>
                                <a href="<?php nux_show_exist($team_social['twitter'], '#'); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Twitter"
                                   class="fab fa-twitter fg-gray font-20 mx-3"></a>
                                <a href="<?php nux_show_exist($team_social['linkedin'], '#'); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Linkedin"
                                   class="fab fa-linkedin-in fg-gray font-20 mx-3"></a>
                                <a href="<?php nux_show_exist($team_social['instagram'], '#'); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Instagram"
                                   class="fab fa-instagram fg-gray font-20 mx-3"></a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row ai-center mt-n5 mb-6 mb-lg-0">
                        <div class="col-lg-6 pl-lg-0 mt-5">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="expert-thumbnail">
                                    <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6 pr-lg-5 mt-5">
                            <h2 class="font-30"><?php the_title(); ?></h2>
                            <span class="d-block mt-3"><?php
                                $team_title = get_post_meta(get_the_ID(), 'nux_team_title', true);
                                nux_show_exist($team_title);
                                ?></span>

                            <?php if (has_excerpt()): ?>
                                <p class="font-18 text-justify my-4">
                                    <?php echo get_the_excerpt(); ?>
                                </p>
                            <?php endif; ?>

                            <div class="hr-line my-5"></div>

                            <div class="d-flex mx-n3 ai-center">
                                <?php $team_social = get_post_meta($post->ID, 'nux_team_social')[0]; ?>
                                <a href="<?php nux_show_exist($team_social['facebook'], '#'); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook"
                                   class="fab fa-facebook-f fg-gray font-20 mx-3"></a>
                                <a href="<?php nux_show_exist($team_social['twitter'], '#'); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Twitter"
                                   class="fab fa-twitter fg-gray font-20 mx-3"></a>
                                <a href="<?php nux_show_exist($team_social['linkedin'], '#'); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Linkedin"
                                   class="fab fa-linkedin-in fg-gray font-20 mx-3"></a>
                                <a href="<?php nux_show_exist($team_social['instagram'], '#'); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Instagram"
                                   class="fab fa-instagram fg-gray font-20 mx-3"></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
</section>