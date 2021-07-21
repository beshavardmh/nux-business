<?php
ob_start([Buffer_Controller::class, 'filters']);

get_header('simple');

?>

    <div class="container">
        <div class="d-flex flex-column ai-center jc-center min-vh-100">
            <div class="card max-w-600 w-100">
                <div class="card-body text-center">
                    <form action="" method="post">
                        <?php if (isset($_SESSION['mail_sent_status']) && $_SESSION['mail_sent_status'] == 1): ?>
                            <?php if (!empty($_SESSION['mail_sent_msg'])): ?>
                                <label class="d-block mb-2 font-18"><?php echo $_SESSION['mail_sent_msg']; ?></label>
                                <?php $_SESSION['mail_sent_msg'] = null; ?>
                            <?php endif; ?>
                            <?php if (!empty($_SESSION['user_verify_msg'])): ?>
                                <label class="d-block mb-2 font-18"><?php echo $_SESSION['user_verify_msg']; ?></label>
                                <?php $_SESSION['user_verify_msg'] = null; ?>
                            <?php endif; ?>
                            <input type="text" class="form-control max-w-300 mx-auto"
                                   name="login_code"
                                   placeholder="کد 6 رقمی را اینجا وارد کنید">
                            <div class="mt-4">
                                <button type="submit" name="nux_check_user_verified" class="submit_checkVerifiedUser btn btn-info">ثبت و ورود
                                    <i class="far fa-spinner-third process-animation mr-3"
                                       style="display: none;"></i>
                                </button>
                                <button type="submit" name="nux_resend_verify_code" class="submit_resendVerifyCode btn btn-outline-info mr-3">ارسال
                                    مجدد کد
                                    <i class="far fa-spinner-third process-animation mr-3"
                                       style="display: none;"></i>
                                </button>
                            </div>
                        <?php else: ?>
                            <?php if (!empty($_SESSION['mail_sent_msg'])): ?>
                                <label class="d-block font-18 fg-red"><?php echo $_SESSION['mail_sent_msg']; ?></label>
                                <?php $_SESSION['mail_sent_msg'] = null; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php

get_footer('simple');

ob_end_flush();