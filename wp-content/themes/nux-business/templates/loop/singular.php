<?php
nux_set_view_count();
while (have_posts()): the_post(); ?>
    <article>
        <div class="container max-w-800 pt-6">
            <?php if (has_excerpt()): ?>
                <p class="excerpts font-17 text-justify pb-6">
                    <?php echo get_the_excerpt(); ?>
                </p>
            <?php endif; ?>

            <?php if (has_post_thumbnail()): ?>
                <div class="full-thumbnail pb-6">
                    <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty(get_the_content())): ?>
                <div class="content font-17 pb-6">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>

            <div class="border br-0 bl-0 border-gray py-2 mb-6">
                <div class="row mx-n2 ai-center jc-between">
                    <div class="px-3 d-flex ai-center">
                        <i class="fg-blue position-relative top-n2 fal fa-calendar-alt ml-2"></i>
                        <time style="word-spacing: 2px;"><?php echo parsidate('j F Y', get_the_date('Y-m-d'), 'per'); ?></time>
                    </div>

                    <div class="px-3 d-flex ai-center">
                        <i class="fg-blue position-relative top-n2 fal fa-eye ml-2"></i>
                        <span style="word-spacing: 2px;"><?php echo nux_get_view_count() . ' بازدید'; ?></span>
                    </div>
                </div>
            </div>

            <div class="share-post p-3 radius-10 mb-6">
                <div class="row ai-center jc-center jc-sm-between mt-n3">
                    <b class="px-3 font-20 text-center text-sm-right mt-3">این پست را با دوستان خود به اشتراک بگذارید!</b>

                    <div class="row mx-n1 px-3 ai-center mb-n2 mt-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook" class="social-icon mx-1 mb-2 radius-5">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a href="https://t.me/share/url?url=<?php echo get_the_permalink(); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Telegram" class="social-icon mx-1 mb-2 radius-5">
                            <i class="fab fa-telegram-plane"></i>
                        </a>

                        <a href="https://api.whatsapp.com/send/?phone&text=<?php echo get_the_permalink(); ?>&app_absent=0" target="_blank" data-toggle="tooltip" data-placement="top" title="Whatsapp" class="social-icon mx-1 mb-2 radius-5">
                            <i class="fab fa-whatsapp"></i>
                        </a>

                        <a href="http://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php echo get_the_permalink(); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="twitter" class="social-icon mx-1 mb-2 radius-5">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>

            <?php get_template_part('templates/loop/related-posts'); ?>
        </div>
    </article>
<?php
endwhile;