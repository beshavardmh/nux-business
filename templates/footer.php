<?php if (\layout\Footer::is_visible_middle_section() || \layout\Footer::is_visible_bottom_section()): ?>
    <footer>
        <?php if (\layout\Footer::is_visible_middle_section()): ?>
            <div class="container pt-6 pb-6">
                <div class="row fg-white mt-n6">
                    <div class="col-sm-6 col-lg-4 mt-6">
                        <?php if (is_registered_sidebar('sidebar_middle_1')) {
                            dynamic_sidebar('sidebar_middle_1');
                        } ?>
                    </div>

                    <div class="col-sm-6 col-lg-4 mt-6">
                        <?php if (is_registered_sidebar('sidebar_middle_2')) {
                            dynamic_sidebar('sidebar_middle_2');
                        } ?>
                    </div>

                    <div class="col-sm-6 col-lg-4 mt-6">
                        <?php if (is_registered_sidebar('sidebar_middle_3')) {
                            dynamic_sidebar('sidebar_middle_3');
                        } ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div style="background-color: #ecefef1a!important;" class="hr-line my-0"></div>

        <?php if (\layout\Footer::is_visible_bottom_section()): ?>
            <div class="container pt-1 pb-4">
                <?php if (is_registered_sidebar('sidebar_bottom')) {
                    dynamic_sidebar('sidebar_bottom');
                } ?>
            </div>
        <?php endif; ?>
    </footer>
<?php endif; ?>