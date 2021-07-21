<section class="about-map d-flex flex-column jc-center ai-center py-6">
    <div class="container">
        <h2 data-aos="zoom-in" class="font-42 font-xs-36 text-center mx-3 my-4">ما علاقه مند به کار خود هستیم و از تیم
            خود الهام می گیریم</h2>
    </div>
</section>

<section class="benefits fg-white py-6">
    <div class="container">
        <h2 data-aos="fade-left" class="font-42 font-xs-36 mx-3 my-4">کنترل دارایی ارز دیجیتال خود را در دست بگیرید</h2>

        <div class="row ai-center jc-center mb-5">
            <div class="col-6 col-md-4 col-lg-3">
                <div class="item radius-8 p-4 mt-5">
                    <div class="icon rounded-full d-flex ai-center jc-center">
                        <i class="fas fa-allergies font-20"></i>
                    </div>

                    <h3 class="mt-4 font-22">حفظ کنترل</h3>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <div class="item radius-8 p-4 mt-5">
                    <div class="icon rounded-full d-flex ai-center jc-center">

                        <i class="fas fa-layer-group font-20"></i>
                    </div>

                    <h3 class="mt-4 font-22">بینش عملی</h3>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <div class="item radius-8 p-4 mt-5">
                    <div class="icon rounded-full d-flex ai-center jc-center">

                        <i class="fas fa-wallet font-20"></i>
                    </div>

                    <h3 class="mt-4 font-22">کیف پول هوشمند</h3>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <div class="item radius-8 p-4 mt-5">
                    <div class="icon rounded-full d-flex ai-center jc-center">

                        <i class="fas fa-headset font-20"></i>
                    </div>

                    <h3 class="mt-4 font-22">پشتیبانی فنی</h3>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <div class="item radius-8 p-4 mt-5">
                    <div class="icon rounded-full d-flex ai-center jc-center">

                        <i class="fab fa-firstdraft font-20"></i>
                    </div>

                    <h3 class="mt-4 font-22">اطلاعات دقیق</h3>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <div class="item radius-8 p-4 mt-5">
                    <div class="icon rounded-full d-flex ai-center jc-center">

                        <i class="fab fa-cloudsmith font-20"></i>
                    </div>

                    <h3 class="mt-4 font-22">سریع و آسان</h3>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <div class="item radius-8 p-4 mt-5">
                    <div class="icon rounded-full d-flex ai-center jc-center">

                        <i class="fas fa-child font-20"></i>
                    </div>

                    <h3 class="mt-4 font-22">خدمات برجسته</h3>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <div class="item radius-8 p-4 mt-5">
                    <div class="icon rounded-full d-flex ai-center jc-center">

                        <i class="fas fa-file-medical-alt font-20"></i>
                    </div>

                    <h3 class="mt-4 font-22">نظارت و مانیتورینگ</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-6">
    <div class="container mt-n6">
        <div class="row ai-center mt-3">
            <div data-aos="fade-left" data-aos-delay="300" class="col-lg-4 mt-5 max-w-500 mx-auto">
                <img src="<?php echo home_url('/wp-content/uploads/2021/06/about-us-technologies.webp'); ?>"
                     class="img-fluid" alt="">
            </div>

            <div data-aos="fade-right" class="col-lg-8 mt-5">
                <h2 class="font-30 mt-5">فناوری های ارز دیجیتال نوآورانه</h2>

                <p class="font-18 text-justify my-4">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
                    چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است .
                </p>

                <div class="hr-line my-5"></div>

                <div class="row ai-center jc-between">
                    <ul class="px-3">
                        <li class="mt-3">
                            <i class="fas fa-asterisk fg-orange position-relative top-2 ml-2"></i>

                            لورم ایپسوم متن ساختگی
                        </li>

                        <li class="mt-3">
                            <i class="fas fa-asterisk fg-orange position-relative top-2 ml-2"></i>

                            لورم ایپسوم متن ساختگی
                        </li>

                        <li class="mt-3">
                            <i class="fas fa-asterisk fg-orange position-relative top-2 ml-2"></i>

                            لورم ایپسوم متن ساختگی
                        </li>

                        <li class="mt-3">
                            <i class="fas fa-asterisk fg-orange position-relative top-2 ml-2"></i>

                            لورم ایپسوم متن ساختگی
                        </li>

                        <li class="mt-3">
                            <i class="fas fa-asterisk fg-orange position-relative top-2 ml-2"></i>

                            لورم ایپسوم متن ساختگی
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$query_args = array(
    'post_type' => 'nux-faq',
    'post_status' => 'publish',
    'posts_per_page' => '-1',
    'orderby' => array('date' => 'ASC', 'title' => 'ASC')
);
$query = new WP_Query($query_args);
?>

<?php if ($query->have_posts()): ?>
    <section class="faq pb-6">
        <div class="container">
            <h2 class="font-42 font-xs-36 text-center mx-3 my-4">سوالات متداول</h2>

            <div id="accordion">
                <?php while ($query->have_posts()): $query->the_post(); ?>
                    <div class="card mt-3">
                        <div class="card-header py-0 bb-0">
                            <button class="btn d-flex ai-center jc-between w-100 fg-blue fg-hvr-blue font-24 font-xs-20"
                                    data-toggle="collapse" data-target="#collapse_<?php echo get_the_ID(); ?>"
                                    aria-expanded="false">
                                <?php the_title(); ?>

                                <i class="far fa-chevron-down fg-blue font-18 font-xs-16"></i>
                            </button>
                        </div>

                        <div id="collapse_<?php echo get_the_ID(); ?>" class="collapse" data-parent="#accordion">
                            <div class="card-body font-18 font-xs-16">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>