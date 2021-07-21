<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="theme-color" content="#4231ca">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
if (layout\Header::is_visible()) {
    get_template_part('templates/header');
}
?>

<main<?php echo (!empty(\layout\Container::width_type()) && \layout\Container::width_type() == 'fluid') ? ' class="container"' : ''; ?>>

    <?php if (\layout\Container::is_visible_title_bar() && (is_page() || is_single())): ?>
        <section class="page-title-bar">
            <div class="container py-1px">
                <h1 class="<?php
                echo (\layout\Header::is_sticky() || \layout\Header::is_transparent()) ? 'mt-150 mb-80' : 'my-6 pb-3 pt-2';
                ?> fg-white font-50 font-xs-42 text-center text-xl-right"><?php echo get_the_title(); ?></h1>
            </div>
        </section>
    <?php endif; ?>


