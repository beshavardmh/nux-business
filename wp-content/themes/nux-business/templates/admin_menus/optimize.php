<?php
Site_Options::form_controller();

$optimization = Site_Options::$options['optimization'];
if (!$optimization) return;

?>
<div class="wrap">
    <h1>بهینه سازی سایت</h1>

    <?php do_action( 'admin_notices' ); ?>

    <ul style="font-weight: bold" uk-tab>
        <li><a href="#">سیستم کش</a></li>
        <li><a href="#">پریلود فایل ها</a></li>
        <li><a href="#">لیزی لود تصاویر</a></li>
        <li><a href="#">ترکیب و فشرده سازی فایل ها</a></li>
    </ul>

    <ul class="uk-switcher uk-margin">
        <li>
            <form class="uk-form-horizontal uk-margin-large" action="" method="post">

                <div class="uk-margin">
                    <div class="uk-form-label">فعال بودن سیستم کش :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-radio" value="1"
                                      type="radio" <?php checked($optimization['cache']['enabled_cached'], 1); ?>
                                      name="optimization[cache][enabled_cached]"> بله</label><br>
                        <label><input class="uk-radio" value="0"
                                      type="radio" <?php checked($optimization['cache']['enabled_cached'], 0); ?>
                                      name="optimization[cache][enabled_cached]"> خیر</label>
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-form-label">افزودن استثنا :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-radio" type="radio" value="1"
                                <?php checked($optimization['cache']['has_exception'], 1); ?>
                                      name="optimization[cache][has_exception]">
                            بله</label><br>
                        <label><input class="uk-radio" type="radio" value="0"
                                <?php checked($optimization['cache']['has_exception'], 0); ?>
                                      name="optimization[cache][has_exception]">
                            خیر</label>
                    </div>

                    <div class="uk-form-label">فقط URL های زیر :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-radio" type="radio" value="accept"
                                <?php nux_checked_context($optimization['cache']['exception_type'], 'accept'); ?>
                                      name="optimization[cache][exception_type]"> کش بشوند</label><br>
                        <label><input class="uk-radio" type="radio" value="ignore"
                                <?php nux_checked_context($optimization['cache']['exception_type'], 'ignore'); ?>
                                      name="optimization[cache][exception_type]"> کش نشوند</label>
                    </div>
                    <?php $exceptions = !empty($optimization['cache']['exceptions']) ? implode(',', $optimization['cache']['exceptions']) : ''; ?>
                    <textarea style="height: 80px;" name="optimization[cache][exceptions]"
                              class="uk-textarea ltr uk-form-width-large uk-margin-small-top"><?php echo $exceptions; ?></textarea>
                    <p style="font-size: 12px; color: gray; margin: 5px 0;">URL ها را با , جدا کنید</p>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">مدت زمان نگهداری کش (دقیقه) :</label>
                    <div class="uk-form-controls">
                        <input class="uk-input uk-form-width-small" type="text"
                               name="optimization[cache][cache_exp_time]"
                               value="<?php nux_show_not_empty($optimization['cache']['cache_exp_time']); ?>">
                    </div>
                </div>

                <div class="uk-margin">
                    <button type="button" class="clear_caches uk-button uk-button-secondary uk-border-pill">پاکسازی تمامی کش ها</button>
                    <p class="alert_clear_caches text-red my-1 fs-13" style="display: none;"></p>
                </div>

                <hr>

                <div class="uk-margin uk-align-left">
                    <button type="submit" name="submit_nux_optimization_cache" class="uk-button uk-button-primary">ذخیره تغییرات</button>
                </div>

            </form>
        </li>

        <li>
            <form class="uk-form-horizontal uk-margin-large" action="" method="post">

                <div class="uk-margin">
                    <?php $fonts = !empty($optimization['preloads']['fonts']) ? implode(',', $optimization['preloads']['fonts']) : ''; ?>
                    <div class="uk-form-label">پریلود های fonts :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <textarea style="height: 80px; resize: none; overflow-y: auto;"
                                  name="optimization[preloads][fonts]"
                                  class="uk-textarea ltr uk-form-width-large"><?php echo $fonts; ?></textarea>
                        <p style="font-size: 12px; color: gray; margin: 5px 0;">URL ها را با , جدا کنید</p>
                    </div>
                </div>

                <div class="uk-margin">
                    <?php $images = !empty($optimization['preloads']['images']) ? implode(',', $optimization['preloads']['images']) : ''; ?>
                    <div class="uk-form-label">پریلود های تصاویر :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <textarea style="height: 80px; resize: none; overflow-y: auto;"
                                  name="optimization[preloads][images]"
                                  class="uk-textarea ltr uk-form-width-large"><?php echo $images; ?></textarea>
                        <p style="font-size: 12px; color: gray; margin: 5px 0;">URL ها را با , جدا کنید</p>
                    </div>
                </div>

                <div class="uk-margin">
                    <?php $videos = !empty($optimization['preloads']['videos']) ? implode(',', $optimization['preloads']['videos']) : ''; ?>
                    <div class="uk-form-label">پریلود های ویدیوها :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <textarea style="height: 80px; resize: none; overflow-y: auto;"
                                  name="optimization[preloads][videos]"
                                  class="uk-textarea ltr uk-form-width-large"><?php echo $videos; ?></textarea>
                        <p style="font-size: 12px; color: gray; margin: 5px 0;">URL ها را با , جدا کنید</p>
                    </div>
                </div>

                <div class="uk-margin">
                    <?php $scripts = !empty($optimization['preloads']['scripts']) ? implode(',', $optimization['preloads']['scripts']) : ''; ?>
                    <div class="uk-form-label">پریلود های scripts :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <textarea style="height: 80px; resize: none; overflow-y: auto;"
                                  name="optimization[preloads][scripts]"
                                  class="uk-textarea ltr uk-form-width-large"><?php echo $scripts; ?></textarea>
                        <p style="font-size: 12px; color: gray; margin: 5px 0;">URL ها را با , جدا کنید</p>
                    </div>
                </div>

                <div class="uk-margin">
                    <?php $styles = !empty($optimization['preloads']['styles']) ? implode(',', $optimization['preloads']['styles']) : ''; ?>
                    <div class="uk-form-label">پریلود های styles :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <textarea style="height: 80px; resize: none; overflow-y: auto;"
                                  name="optimization[preloads][styles]"
                                  class="uk-textarea ltr uk-form-width-large"><?php echo $styles; ?></textarea>
                        <p style="font-size: 12px; color: gray; margin: 5px 0;">URL ها را با , جدا کنید</p>
                    </div>
                </div>

                <hr>

                <div class="uk-margin uk-align-left">
                    <button type="submit" name="submit_nux_optimization_preloads" class="uk-button uk-button-primary">ذخیره تغییرات</button>
                </div>

            </form>
        </li>

        <li>
            <form class="uk-form-horizontal uk-margin-large" action="" method="post">

                <div class="uk-margin">
                    <div class="uk-form-label">فعال بودن سیستم Lazyload :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-radio" type="radio"
                                      value="1"
                                      <?php checked($optimization['lazyload']['enabled'], 1); ?>
                                      name="optimization[lazyload][enabled]"> بله</label><br>
                        <label><input class="uk-radio" type="radio"
                                      value="0"
                                      <?php checked($optimization['lazyload']['enabled'], 0); ?>
                                      name="optimization[lazyload][enabled]"> خیر</label>
                    </div>
                </div>

                <hr>

                <div class="uk-margin uk-align-left">
                    <button type="submit" name="submit_nux_optimization_lazyload" class="uk-button uk-button-primary">ذخیره تغییرات</button>
                </div>
            </form>
        </li>

        <li>
            <form class="uk-form-horizontal uk-margin-large" action="" method="post">

                <div class="uk-margin">
                    <div class="uk-form-label">فشرده سازی و ترکیب فایل های css :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-radio" type="radio"
                                      value="1"
                                      <?php checked($optimization['compress']['minify_combine_css'], 1); ?>
                                      name="optimization[compress][minify_combine_css]"> بله</label><br>
                        <label><input class="uk-radio" type="radio"
                                      value="0"
                                      <?php checked($optimization['compress']['minify_combine_css'], 0); ?>
                                      name="optimization[compress][minify_combine_css]"> خیر</label>
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-form-label">فشرده سازی و ترکیب فایل های js :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-radio" type="radio"
                                      value="1"
                                      <?php checked($optimization['compress']['minify_combine_js'], 1); ?>
                                      name="optimization[compress][minify_combine_js]"> بله</label><br>
                        <label><input class="uk-radio" type="radio"
                                      value="0"
                                      <?php checked($optimization['compress']['minify_combine_js'], 0); ?>
                                      name="optimization[compress][minify_combine_js]"> خیر</label>
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-form-label">فشرده سازی HTML :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-radio" type="radio"
                                      value="1"
                                      <?php checked($optimization['compress']['minify_html'], 1); ?>
                                      name="optimization[compress][minify_html]"> بله</label><br>
                        <label><input class="uk-radio" type="radio"
                                      value="0"
                                      <?php checked($optimization['compress']['minify_html'], 0); ?>
                                      name="optimization[compress][minify_html]"> خیر</label>
                    </div>
                </div>

                <hr>

                <div class="uk-margin uk-align-left">
                    <button type="submit" name="submit_nux_optimization_compress" class="uk-button uk-button-primary">ذخیره تغییرات</button>
                </div>
            </form>
        </li>
    </ul>
</div>