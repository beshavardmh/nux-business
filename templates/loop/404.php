<div class="container">
    <div class="d-flex flex-column ai-center jc-center min-vh-100">
        <?php
        $uri = $_SERVER['REQUEST_URI'];
        if (strpos($uri, '403-forbidden')) :?>
            <h2 style="font-size: 120px">403</h2>
            <p class="font-18 mt-n5">دسترسی شما محدود شده!</p>
        <?php else: ?>
            <h2 style="font-size: 120px">404</h2>
            <p class="font-18 mt-n5">صفحه مورد نظر پیدا نشد!</p>
            <a href="<?php echo home_url(); ?>" class="btn btn-fat btn-primary lh-1_8 fg-white mt-5">بازگشت به صفحه
                اصلی</a>
        <?php endif; ?>
    </div>
</div>