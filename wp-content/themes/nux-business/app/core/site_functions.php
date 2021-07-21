<?php
function nux_show_isset($value, $else_value = '')
{
    echo isset($value) ? $value : $else_value;
}

function nux_get_isset($value, $else_value = '')
{
    return isset($value) ? $value : $else_value;
}

function nux_show_not_empty($value, $else_value = '')
{
    echo !empty($value) ? $value : $else_value;
}

function nux_get_not_empty($value, $else_value = '')
{
    return !empty($value) ? $value : $else_value;
}

function nux_exist($value)
{
    return isset($value) && !empty($value);
}

function nux_get_exist($value, $else_value = '')
{
    return isset($value) && !empty($value) ? $value : $else_value;
}

function nux_show_exist($value, $else_value = '')
{
    echo isset($value) && !empty($value) ? $value : $else_value;
}

function nux_checked_context($value, $context)
{
    esc_attr_e(isset($value) && $value == $context ? 'checked' : '');
}

function nux_selected_context($value, $context)
{
    esc_attr_e(isset($value) && $value == $context ? 'selected' : '');
}

function nux_get_options()
{
    return get_theme_mod('nux_options');
}

function nux_update_options($options)
{
    set_theme_mod('nux_options', $options);
}

function nux_get_countries()
{
    return array(
        'آذربایجان' => 'az',
        'آروبا' => 'aw',
        'آرژانتین' => 'ar',
        'آفریقای جنوبی' => 'za',
        'آفریقای مرکزی' => 'cf',
        'آلبانی' => 'al',
        'آلمان' => 'de',
        'آنتارتیکا (قطب جنوب)' => 'aq',
        'آنتیل هلند' => 'an',
        'آنتیگوا و باربوداس' => 'ag',
        'آندورا' => 'ad',
        'آنگولا' => 'ad',
        'اتریش' => 'at',
        'اتیوپی' => 'et',
        'اردن' => 'jo',
        'ارمنستان' => 'am',
        'اروگوئه' => 'uy',
        'اریتره' => 'er',
        'ازبکستان' => 'uz',
        'استرالیا' => 'au',
        'استونی' => 'ee',
        'اسرائیل' => 'il',
        'اسلوانی' => 'si',
        'اسلواکی' => 'sk',
        'اسپانیا' => 'es',
        'افغانستان' => 'af',
        'ال سالوادور' => 'sv',
        'الجزایر' => 'dz',
        'امارات متحده عربی' => 'ae',
        'اندونزی' => 'id',
        'انگویلا' => 'ai',
        'اوگاندا' => 'ug',
        'اکراین' => 'ua',
        'اکوادور' => 'ec',
        'ایالات متحده آمریکا' => 'us',
        'ایتالیا' => 'it',
        'ایران' => 'ir',
        'ایرلند' => 'ie',
        'ایسلند' => 'is',
        'باربادوس' => 'bb',
        'باهاما' => 'bs',
        'بحرین' => 'bh',
        'برزیل' => 'br',
        'برمودا' => 'bm',
        'برونئی' => 'bn',
        'بروندی' => 'bi',
        'بریتانیا' => 'gb',
        'بلاروس' => 'by',
        'بلغارستان' => 'bg',
        'بلژیک' => 'be',
        'بلیز' => 'bz',
        'بنگلادش' => 'bd',
        'بنین' => 'bj',
        'بوتان' => 'bt',
        'بوتسوانا' => 'bw',
        'بورکینا فاسو' => 'bf',
        'بوسنی و هرزگوین' => 'ba',
        'بولیوی' => 'bo',
        'تاجیکستان' => 'tj',
        'تانزانیا' => 'tz',
        'تایلند' => 'th',
        'تایوان' => 'tw',
        'ترکمنستان' => 'tm',
        'ترکیه' => 'tr',
        'ترینیداد و توباگو' => 'tt',
        'توالو' => 'tv',
        'تونس' => 'tn',
        'تونگا' => 'to',
        'توکلائو' => 'tk',
        'توگو' => 'tg',
        'تیمور شرقی' => 'tl',
        'جامائیکا' => 'jm',
        'جبل الطارق' => 'gi',
        'جزایر انگلستان در اقیانون هند' => 'io',
        'جزایر ترک و سایکوس' => 'tc',
        'جزایر ساموا' => 'as',
        'جزایر سلیمان' => 'sb',
        'جزایر سوالبارد و جان ماین' => 'sj',
        'جزایر فالکلند' => 'fk',
        'جزایر فرو' => 'fo',
        'جزایر مارشال' => 'mh',
        'جزایر ماریانا' => 'mp',
        'جزایر متعلق به آمریکا' => 'um',
        'جزایر هرد و مکدونالد' => 'hm',
        'جزایر والیس و فورتونا' => 'wf',
        'جزایر ویرجین (آمریکا)' => 'vi',
        'جزایر ویرجین (بریتانیا)' => 'vg',
        'جزایر کوک' => 'ck',
        'جزایر کوکوس' => 'cc',
        'جزایر کیمن' => 'ky',
        'جزایر گرجستان جنوبی و ساندویچ' => 'gs',
        'جزیره بووت' => 'bv',
        'جزیره سنت هلن' => 'sh',
        'جزیره نورفولک' => 'nf',
        'جزیره کریسمس' => 'cx',
        'جمهوری خلق کنگو' => 'cd',
        'جمهوری چک' => 'cz',
        'جی بوتی' => 'dj',
        'دانمارک' => 'dk',
        'دومنیکن' => 'do',
        'دومینیکا' => 'dm',
        'رواندا' => 'rw',
        'روسیه' => 'ru',
        'رومانی' => 'ro',
        'ری یونیون' => 're',
        'زامبیا' => 'zm',
        'زیمباوه' => 'zw',
        'سائو توم و پرینسیپ' => 'st',
        'ساموآ' => 'ws',
        'سان مارینو' => 'sm',
        'سریلانکا' => 'lk',
        'سنت لوسیا' => 'lc',
        'سنت وینسنت و گرینادینس' => 'vc',
        'سنت پیر و میکوئلون' => 'pm',
        'سنت کیس و نویس' => 'kn',
        'سنگال' => 'sn',
        'سنگاپور' => 'sg',
        'سوئد' => 'se',
        'سوئیس' => 'ch',
        'سوازیلند' => 'sz',
        'سودان' => 'sd',
        'سورینام' => 'sr',
        'سوریه' => 'sy',
        'سومالی' => 'so',
        'سیرالئون' => 'sl',
        'سیشل' => 'sc',
        'شیلی' => 'cl',
        'صحرای غربی' => 'eh',
        'صربستان' => 'yu',
        'عراق' => 'iq',
        'عربستان سعودی' => 'sa',
        'عمان' => 'om',
        'غنا' => 'gh',
        'فرانسه' => 'fr',
        'فنلاند' => 'fi',
        'فیجی' => 'fj',
        'فیلیپین' => 'ph',
        'قبرس' => 'cy',
        'قرقیزستان' => 'kg',
        'قزاقستان' => 'kz',
        'قطر' => 'qa',
        'لائوس' => 'la',
        'لبنان' => 'lb',
        'لتونی' => 'lv',
        'لسوتو' => 'ls',
        'لهستان' => 'pl',
        'لوکزامبورگ' => 'lu',
        'لیبریا' => 'lr',
        'لیبی' => 'ly',
        'لیتوانی' => 'lt',
        'لیختن اشتاین' => 'li',
        'ماداگاسکار' => 'mg',
        'مارتینیک' => 'mq',
        'مالاوی' => 'mw',
        'مالت' => 'mt',
        'مالدیو' => 'mv',
        'مالزی' => 'my',
        'مالی' => 'ml',
        'ماکائو' => 'mo',
        'مایوت' => 'yt',
        'مجارستان' => 'hu',
        'مراکش' => 'ma',
        'مصر' => 'eg',
        'مغولستان' => 'mn',
        'مقدونیه' => 'mk',
        'ممالک جنوبی فرانسه' => 'tf',
        'موریتانی' => 'mr',
        'موریتینوس' => 'mu',
        'موزابیک' => 'mz',
        'مولدوا' => 'md',
        'موناکو' => 'mc',
        'مونتسرات' => 'ms',
        'مکزیک' => 'mx',
        'میانمار' => 'mm',
        'میکرونزی' => 'fm',
        'نائورو' => 'nr',
        'نامبیا' => 'na',
        'نروژ' => 'no',
        'نپال' => 'np',
        'نیجر' => 'ne',
        'نیجریه' => 'ng',
        'نیو' => 'nu',
        'نیوزیلند' => 'nz',
        'نیکاراگوئه' => 'ni',
        'هایتی' => 'ht',
        'هلند' => 'nl',
        'هندوراس' => 'hn',
        'هندوستان' => 'in',
        'هنگ کنگ' => 'hk',
        'واتیکان' => 'va',
        'وانواتو' => 'vu',
        'ونزوئلا' => 've',
        'ویتنام' => 'vn',
        'پاراگوئه' => 'py',
        'پالائو' => 'pw',
        'پاناما' => 'pa',
        'پاپوا گینه نو' => 'pg',
        'پاکستان' => 'pk',
        'پرتغال' => 'pt',
        'پرو' => 'pe',
        'پورتوریکو' => 'pr',
        'پولینزی فرانسه' => 'pf',
        'پیتکایرن' => 'pn',
        'چاد' => 'td',
        'چین' => 'cn',
        'ژاپن' => 'jp',
        'کابو ورده' => 'cv',
        'کاستاریکا' => 'cr',
        'کامبوج' => 'kh',
        'کامرون' => 'cm',
        'کانادا' => 'ca',
        'کره جنوبی' => 'kr',
        'کره شمالی' => 'kp',
        'کرواسی' => 'hr',
        'کلدونی' => 'nc',
        'کلمبیا' => 'co',
        'کنگو' => 'cg',
        'کنیا' => 'ke',
        'کوبا' => 'cu',
        'کوته دیویور' => 'ci',
        'کوکوروس' => 'km',
        'کویت' => 'kw',
        'کیریباتی' => 'ki',
        'گابن' => 'ga',
        'گامبیا' => 'gm',
        'گرجستان' => 'ge',
        'گرنادا' => 'gd',
        'گرینلند' => 'gl',
        'گواتمالا' => 'gt',
        'گوادالوپ' => 'gp',
        'گوام' => 'gu',
        'گیانا' => 'gy',
        'گیانای فرانسه' => 'gf',
        'گینه' => 'gn',
        'گینه بیسائو' => 'gw',
        'گینه ی استوایی' => 'gq',
        'یمن' => 'ye',
        'یونان' => 'gr',
    );
}

function nux_get_media_src($media_id, $size = 'full')
{
    return wp_get_attachment_image_src($media_id, $size)[0];
}

function get_post_type_by_taxonomy($taxonomy = '')
{

    $taxonomy = !empty($taxonomy) ? $taxonomy : get_queried_object()->taxonomy;

    global $wp_taxonomies;

    if (isset($wp_taxonomies[$taxonomy])) {
        return $wp_taxonomies[$taxonomy]->object_type[0];
    }

    return '';
}

function get_current_url()
{
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
    $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    return $url;
}

function nux_loop_template()
{
    if (is_page()):
        get_template_part('templates/loop/page');
    elseif (is_single()):
        get_template_part('templates/loop/singular');
    elseif (is_404()):
        get_template_part('templates/loop/404');
    else:
        get_template_part('templates/loop/archive');
    endif;
}

function nux_set_view_count()
{
    global $post;
    $view_count = get_post_meta($post->ID, 'nux_view_count', true);
    if (!empty($view_count)) {
        update_post_meta($post->ID, 'nux_view_count', ++$view_count);
    } else {
        update_post_meta($post->ID, 'nux_view_count', 1);
    }
}

function nux_get_view_count()
{
    global $post;
    $view_count = get_post_meta($post->ID, 'nux_view_count', true);
    if (empty($view_count)) {
        return 0;
    }
    return $view_count;
}

function get_the_user_ip()
{

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

        //check ip from share internet

        $ip = $_SERVER['HTTP_CLIENT_IP'];

    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        //to check ip is pass from proxy

        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

    } else {

        $ip = $_SERVER['REMOTE_ADDR'];

    }

    return $ip;

}

function is_site_on_locahost(){
    $localhost = array(
        '127.0.0.1',
        '::1'
    );

    return in_array($_SERVER['REMOTE_ADDR'], $localhost);
}