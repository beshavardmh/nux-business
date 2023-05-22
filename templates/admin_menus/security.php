<?php
Site_Options::form_controller();

$security = Site_Options::$options['security'];
if (!$security) return;

?>
<div class="wrap">
    <h1>امنیت سایت</h1>

    <?php do_action( 'admin_notices' ); ?>

    <ul style="font-weight: bold" uk-tab>
        <li><a href="#">لاگین</a></li>
        <li><a href="#">دیتابیس</a></li>
    </ul>

    <ul class="uk-switcher uk-margin">
        <li>
            <form class="uk-form-horizontal uk-margin-large" action="" method="post">

                <div class="uk-margin">
                    <div class="uk-form-label">محدود کردن لاگین :
                        <span uk-tooltip="محدود کردن تعداد دفعات ورود اشتباه"
                              class="dashicons-editor-help font-dashicons fs-16"></span>
                    </div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-radio" type="radio" value="1"
                                <?php checked($security['limit_login']['enabled'], 1); ?>
                                      name="security[limit_login][enabled]"> بله</label><br>
                        <label><input class="uk-radio" type="radio" value="0"
                                <?php checked($security['limit_login']['enabled'], 0); ?>
                                      name="security[limit_login][enabled]"> خیر</label>
                    </div>

                    <div class="uk-form-label">تعداد دفعات لاگین مجاز :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <input class="uk-input uk-form-width-small"
                               value="<?php nux_show_not_empty($security['limit_login']['try_time']); ?>"
                               name="security[limit_login][try_time]" type="number">
                    </div>

                    <div class="uk-form-label">مدت زمان محدود ماندن کاربر (دقیقه) :</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <input class="uk-input uk-form-width-small"
                               value="<?php nux_show_not_empty($security['limit_login']['exp_time']); ?>"
                               name="security[limit_login][exp_time]" type="text">
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-form-label">تغییر URL صفحه ورود :
                        <span uk-tooltip="نویسه های مجاز، (a-z و 0-9 و - و _) هستند."
                              class="dashicons-editor-help font-dashicons fs-16"></span>
                    </div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <input class="slug_input uk-input uk-form-width-medium ltr"
                               value="<?php nux_show_not_empty($security['login_url']['path']); ?>" name="security[login_url][path]" type="text">
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-form-label">احراز هویت دو مرحله ای :
                        <span uk-tooltip="ورود با ارسال کد تایید به ایمیل کاربر تکمیل می‌شود."
                              class="dashicons-editor-help font-dashicons fs-16"></span>
                    </div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-radio"
                                <?php checked($security['two_step_auth']['enabled'], 1); ?>
                                      value="1"
                                      type="radio" name="security[two_step_auth][enabled]"> بله</label><br>
                        <label><input class="uk-radio"
                                <?php checked($security['two_step_auth']['enabled'], 0); ?>
                                      value="0"
                                      type="radio" name="security[two_step_auth][enabled]"> خیر</label>
                        <?php
                        if (is_site_on_locahost()){
                            echo '<p class="fs-12 uk-margin-small-top text-red">امکان فعالسازی روی Localhost وجود ندارد!</p>';
                        }
                        ?>
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-form-label">لیست سیاه :
                        <span uk-tooltip="ip هایی که نمی‌خواهید وارد سایت شوند."
                              class="dashicons-editor-help font-dashicons fs-16"></span>
                    </div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <?php $blacklist = !empty($security['blacklist_ip']) ? implode(',', $security['blacklist_ip']) : ''; ?>
                        <textarea style="height: 80px; resize: none; overflow-y: auto;"
                                  name="security[blacklist_ip]"
                                  class="uk-textarea ltr uk-form-width-large"><?php echo $blacklist; ?></textarea>
                        <p style="font-size: 12px; color: gray; margin: 5px 0;">IP ها را با , جدا کنید</p>
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-form-label">لاگ های ورود و خروج پنل :
                        <div>
                            <button type="button" class="saveLogAsFile button button-orange mt-3">دانلود</button>
                            <button type="button" class="delete_log button button-red mt-3">پاک کردن</button>
                        </div>
                    </div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <textarea style="height: 80px; resize: none; overflow-y: auto;"
                                  id="log_textarea"
                                  name="security[logs]"
                                  class="uk-textarea ltr uk-form-width-large" readonly><?php nux_show_not_empty($security['logs']); ?></textarea>
                    </div>
                </div>

                <hr>

                <div class="uk-margin uk-align-left">
                    <button type="submit" name="submit_nux_security_login" class="uk-button uk-button-primary">ذخیره تغییرات</button>
                </div>

            </form>
        </li>

        <li>
            <form class="uk-form-horizontal uk-margin-large" action="" method="post">

                <div class="uk-margin">
                    <div class="uk-form-label">پیشوند جداول دیتابیس <?php
                        global $wpdb;
                        echo $wpdb->prefix == 'wp_' ? '<span class="text-red">(Bad)</span>' : '<span class="text-green">(Good)</span>';
                        ?> :
                    </div>
                    <div class="uk-form-controls uk-form-controls-text ltr fs-16">
                        <?php echo $wpdb->prefix; ?>
                    </div>

                    <div class="uk-form-label">تغییر به :
                        <span uk-tooltip="قبل از تغییر، از دیتابیس خود بکاپ بگیرید."
                              class="dashicons-editor-help font-dashicons fs-16"></span>
                    </div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <input class="uk-input uk-form-width-small" name="security_change_prefix" type="text">
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-margin">
                        <button type="button" class="get_backup_db uk-button uk-button-secondary uk-border-pill">دریافت بکاپ از
                            دیتابیس
                            <i class="far fa-spinner-third process-animation text-white mr-3"
                               style="display: none;"></i>
                        </button>
                        <p style="font-size: 12px; color: gray; margin: 5px 0;">فرایند دریافت بکاپ ممکن است کمی زمانبر
                            باشد.</p>
                        <p class="alert_backup_db text-red my-1 fs-13" style="display: none;"></p>
                    </div>
                </div>

                <hr>

                <div class="uk-margin uk-align-left">
                    <button type="submit" name="submit_nux_security_database" class="uk-button uk-button-primary">ذخیره تغییرات</button>
                </div>

            </form>
        </li>
    </ul>
</div>