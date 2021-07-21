<?php if (\layout\Header::is_visible()): ?>
    <header class="position-relative z-index-20">
        <?php if (has_nav_menu('primary')): ?>
            <nav class="<?php
            echo \layout\Header::is_sticky() ? 'is-sticky position-fixed w-100 right-0 top-0 ' : '';
            echo \layout\Header::is_transparent() ? 'is-transparent position-absolute w-100 right-0 top-0 ' : 'bg-darkblue';
            ?> d-none d-xl-block">
                <div class="container">
                    <div class="d-flex ai-center jc-between">
                        <?php
                        wp_nav_menu($args = array(
                            'theme_location' => 'primary',
                            'depth' => 1,
                            'container' => 'ul',
                            'menu_class' => 'main-menu d-flex ai-center overflow-hidden mx-n5',
                            'walker' => new nav_menu\Main(),
                        ));
                        ?>

                        <?php if (get_theme_mod('nux_logo')) : ?>
                            <div class="logo-wrap px-xl-4 bg bg-blue">
                                <img src="<?php echo get_theme_mod('nux_logo'); ?>"
                                     alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>

            <nav class="bg-blue <?php
            if (\layout\Header::is_sticky()) echo 'position-fixed';
            elseif (\layout\Header::is_transparent()) echo 'position-absolute';
            else echo 'position-relative';
            ?> w-100 right-0 top-0 d-xl-none dir-ltr">
                <div class="container">
                    <div class="d-flex ai-center jc-between">
                        <?php if (get_theme_mod('nux_logo')) : ?>
                            <div class="logo-wrap bg-blue">
                                <img src="<?php echo get_theme_mod('nux_logo'); ?>"
                                     alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
                wp_nav_menu($args = array(
                    'theme_location' => 'primary',
                    'depth' => 1,
                    'container' => 'ul',
                    'menu_class' => 'main-menu-mobile d-flex d-xl-none flex-column ai-center jc-center position-fixed z-index-30 top-0 w-100 min-vh-100 font-20',
                    'walker' => new nav_menu\Mobile(),
                ));
                ?>
            </nav>

            <div class="container <?php echo \layout\Header::is_sticky() ? 'position-fixed w-100 right-0 top-0 ' : 'position-absolute w-100 right-0 top-0 '; ?> z-index-40 d-flex d-xl-none">
                <div id="nav-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        <?php endif; ?>
    </header>
<?php endif; ?>