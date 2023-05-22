<?php

namespace admin_menus;

class Meta_Boxes
{

    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_layout']);
        add_action('save_post', [$this, 'save_layout']);

        add_action('add_meta_boxes', [$this, 'add_team_social']);
        add_action('save_post', [$this, 'save_team_social']);

        add_action('add_meta_boxes', [$this, 'add_team_title']);
        add_action('save_post', [$this, 'save_team_title']);

        add_action('post_submitbox_misc_actions', [$this, 'show_count_views']);
    }

    public function add_layout()
    {
        add_meta_box('nux_layout',
            'چیدمان صفحه',
            [$this, 'render_layout'],
            array('post', 'page'),
            'normal'
        );
    }

    public function render_layout($post)
    {
        ?>
        <?php $layout = get_post_meta($post->ID, 'layout')[0]; ?>
        <div class="uk-child-width-1-1@s" uk-grid>
        <div>
            <div uk-grid>
                <div class="uk-width-auto@m">
                    <ul class="uk-tab-left" uk-tab="connect: #component-tab-left; animation: uk-animation-fade">
                        <li><a href="#">هِدر</a></li>
                        <li><a href="#">بدنه محتوا</a></li>
                        <li><a href="#">فوتر</a></li>
                    </ul>
                </div>
                <div class="uk-width-expand@m">
                    <ul id="component-tab-left" class="uk-switcher">
                        <li>
                            <div class="uk-form-horizontal uk-margin-large">
                                <div class="uk-margin">
                                    <div class="uk-form-label">نمایش هِدر</div>
                                    <div class="uk-form-controls uk-form-controls-text">
                                        <label><input class="uk-radio" type="radio" value="1"
                                                <?php nux_checked_context($layout['header']['visible'], 1); ?>
                                                <?php echo !$layout ? 'checked' : ''; ?>
                                                      name="layout[header][visible]"> بله</label><br>
                                        <label><input class="uk-radio" type="radio" value="0"
                                                <?php nux_checked_context($layout['header']['visible'], 0); ?>
                                                      name="layout[header][visible]"> خیر</label>
                                    </div>
                                </div>

                                <div class="uk-margin">
                                    <div class="uk-form-label">حالت sticky</div>
                                    <div class="uk-form-controls uk-form-controls-text">
                                        <label><input class="uk-radio" type="radio" value="1"
                                                <?php nux_checked_context($layout['header']['sticky'], 1); ?>
                                                      name="layout[header][sticky]"> فعال</label><br>
                                        <label><input class="uk-radio" type="radio" value="0"
                                                <?php nux_checked_context($layout['header']['sticky'], 0); ?>
                                                <?php echo !$layout ? 'checked' : ''; ?>
                                                      name="layout[header][sticky]"> غیرفعال</label>
                                    </div>
                                </div>

                                <div class="uk-margin">
                                    <div class="uk-form-label">هِدر شفاف</div>
                                    <div class="uk-form-controls uk-form-controls-text">
                                        <label><input class="uk-radio" type="radio" value="1"
                                                <?php nux_checked_context($layout['header']['transparent'], 1); ?>
                                                      name="layout[header][transparent]"> بله</label><br>
                                        <label><input class="uk-radio" type="radio" value="0"
                                                <?php nux_checked_context($layout['header']['transparent'], 0); ?>
                                                <?php echo !$layout ? 'checked' : ''; ?>
                                                      name="layout[header][transparent]"> خیر</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-form-horizontal uk-margin-large">
                                <div class="uk-margin">
                                    <div class="uk-form-label">پهنای بدنه‌ی محتوا</div>
                                    <div class="uk-form-controls uk-form-controls-text">
                                        <label><input class="uk-radio" type="radio" value="fluid"
                                                <?php nux_checked_context($layout['container']['width'], 'fluid'); ?>
                                                      name="layout[container][width]"> استاندارد</label><br>
                                        <label><input class="uk-radio" type="radio" value="wide"
                                                <?php nux_checked_context($layout['container']['width'], 'wide'); ?>
                                                <?php echo !$layout ? 'checked' : ''; ?>
                                                      name="layout[container][width]"> کشیده شده</label>
                                    </div>
                                </div>

                                <div class="uk-margin">
                                    <div class="uk-form-label">نمایش بخش عنوان صفحه</div>
                                    <div class="uk-form-controls uk-form-controls-text">
                                        <label><input class="uk-radio" type="radio" value="1"
                                                <?php nux_checked_context($layout['container']['title_bar'], 1); ?>
                                                <?php echo !$layout ? 'checked' : ''; ?>
                                                      name="layout[container][title_bar]"> بله</label><br>
                                        <label><input class="uk-radio" type="radio" value="0"
                                                <?php nux_checked_context($layout['container']['title_bar'], 0); ?>
                                                      name="layout[container][title_bar]"> خیر</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-form-horizontal uk-margin-large">
                                <div class="uk-margin">
                                    <div class="uk-form-label">نمایش بخش میانی</div>
                                    <div class="uk-form-controls uk-form-controls-text">
                                        <label><input class="uk-radio" type="radio" value="1"
                                                <?php nux_checked_context($layout['footer']['middle'], 1); ?>
                                                <?php echo !$layout ? 'checked' : ''; ?>
                                                      name="layout[footer][middle]"> بله</label><br>
                                        <label><input class="uk-radio" type="radio" value="0"
                                                <?php nux_checked_context($layout['footer']['middle'], 0); ?>
                                                      name="layout[footer][middle]"> خیر</label>
                                    </div>
                                </div>

                                <div class="uk-margin">
                                    <div class="uk-form-label">نمایش بخش انتهایی</div>
                                    <div class="uk-form-controls uk-form-controls-text">
                                        <label><input class="uk-radio" type="radio" value="1"
                                                <?php nux_checked_context($layout['footer']['bottom'], 1); ?>
                                                <?php echo !$layout ? 'checked' : ''; ?>
                                                      name="layout[footer][bottom]"> بله</label><br>
                                        <label><input class="uk-radio" type="radio" value="0"
                                                <?php nux_checked_context($layout['footer']['bottom'], 0); ?>
                                                      name="layout[footer][bottom]"> خیر</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }

    public function save_layout($post_id)
    {
        if (isset($_REQUEST['layout'])) {
            $layout_meta = $_REQUEST['layout'];
            update_post_meta($post_id, 'layout', $layout_meta);
        }
    }


    public function add_team_social()
    {
        add_meta_box('nux_team_social',
            'شبکه های اجتماعی',
            [$this, 'render_team_social'],
            'nux-team',
            'normal'
        );
    }

    public function render_team_social($post)
    {
        ?>
        <?php $team_social = get_post_meta($post->ID, 'nux_team_social')[0]; ?>
        <div class="uk-form-horizontal uk-margin-large">
            <div class="uk-margin">
                <div class="uk-form-label">لینک فیسبوک</div>
                <div class="uk-form-controls uk-form-controls-text">
                    <input dir="ltr" class="uk-input" type="text" value="<?php nux_show_exist($team_social['facebook']); ?>" name="nux_team_social[facebook]">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-form-label">لینک توییتر</div>
                <div class="uk-form-controls uk-form-controls-text">
                    <input dir="ltr" class="uk-input" type="text" value="<?php nux_show_exist($team_social['twitter']); ?>" name="nux_team_social[twitter]">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-form-label">لینک لینکدین</div>
                <div class="uk-form-controls uk-form-controls-text">
                    <input dir="ltr" class="uk-input" type="text" value="<?php nux_show_exist($team_social['linkedin']); ?>" name="nux_team_social[linkedin]">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-form-label">لینک اینستاگرام</div>
                <div class="uk-form-controls uk-form-controls-text">
                    <input dir="ltr" class="uk-input" type="text" value="<?php nux_show_exist($team_social['instagram']); ?>" name="nux_team_social[instagram]">
                </div>
            </div>
        </div>
        <?php
    }

    public function save_team_social($post_id)
    {
        if (isset($_REQUEST['nux_team_social'])) {
            $team_social_meta = $_REQUEST['nux_team_social'];
            update_post_meta($post_id, 'nux_team_social', $team_social_meta);
        }
    }


    public function add_team_title()
    {
        add_meta_box('nux_team_title',
            'لقب',
            [$this, 'render_team_title'],
            'nux-team',
            'normal'
        );
    }

    public function render_team_title($post)
    {
        ?>
        <?php $team_title = get_post_meta($post->ID, 'nux_team_title', true); ?>
        <div class="uk-form-controls uk-form-controls-text">
            <input class="uk-input" type="text" value="<?php nux_show_exist($team_title); ?>" name="nux_team_title">
        </div>
        <?php
    }

    public function save_team_title($post_id)
    {
        if (isset($_REQUEST['nux_team_title'])) {
            $team_title_meta = sanitize_text_field($_REQUEST['nux_team_title']);
            update_post_meta($post_id, 'nux_team_title', $team_title_meta);
        }
    }


    public function show_count_views()
    {
        if (get_post_type() == 'post' || get_post_type() == 'page') {
            $view_count = nux_get_view_count();
            $html = '<div class="misc-pub-section">';
            $html .= '<p><span class="icon dashicons-welcome-view-site"></span> تعداد بازدید: <b>' . $view_count . '</b></p>';
            $html .= '</div>';
            echo $html;
        }
    }

}