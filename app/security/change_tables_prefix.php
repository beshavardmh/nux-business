<?php

namespace security;

class Change_Tables_Prefix
{
    public static $conn;
    public static $current_prefix;
    public static $new_prefix;

    public static function run($new_prefix)
    {
        global $wpdb;

        self::$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        self::$current_prefix = $wpdb->prefix;
        self::$new_prefix = $new_prefix;

        $result[] = self::change_wp_config();
        $result[] = self::rename_tables_prefix();
        $result[] = self::rename_tables_fields_prefix();

        mysqli_close(self::$conn);

        add_action('init', function () {
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header("Content-Type: application/xml; charset=utf-8");
        });

        return in_array(0, $result) ? 0 : 1;
    }

    public static function change_wp_config()
    {
        $current_prefix = self::$current_prefix;
        $new_prefix = self::$new_prefix;

        $path_to_file = ABSPATH . 'wp-config.php';
        $file_contents = file_get_contents($path_to_file);
        $file_contents = str_replace("\$table_prefix = '{$current_prefix}';", "\$table_prefix = '{$new_prefix}';", $file_contents);
        $result = file_put_contents($path_to_file, $file_contents);

        return $result ? 1 : 0;
    }

    public static function rename_tables_prefix()
    {
        $db_name = DB_NAME;

        $current_prefix = self::$current_prefix;
        $new_prefix = self::$new_prefix;

        $result = false;

        $rename_sqls = [];

        $sql = "SELECT
    concat(
        'ALTER TABLE `',
        TABLE_NAME,
        '` RENAME `',
        replace(TABLE_NAME, '$current_prefix', '$new_prefix'),
        '`;'
    ) AS 'SQL'
FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name';";

        if ($result = mysqli_query(self::$conn, $sql)) {
            $rename_sqls = mysqli_fetch_all($result);
        }
        foreach ($rename_sqls as $rename_sql) {
            $result = mysqli_query(self::$conn, $rename_sql[0]);
        }

        return $result ? 1 : 0;
    }

    public static function rename_tables_fields_prefix()
    {
        $current_prefix = self::$current_prefix;
        $new_prefix = self::$new_prefix;

        $sql_change_usermetas = "UPDATE `{$new_prefix}usermeta`
SET meta_key = REPLACE(meta_key, '$current_prefix', '$new_prefix')
WHERE meta_key LIKE '$current_prefix%';";

        $sql_change_options = "UPDATE `{$new_prefix}options` 
SET option_name = replace(option_name, '$current_prefix', '$new_prefix')
WHERE option_name LIKE '{$current_prefix}user_roles';";

        $result_1 = mysqli_query(self::$conn, $sql_change_usermetas);
        $result_2 = mysqli_query(self::$conn, $sql_change_options);

        return ($result_1 && $result_2) ? 1 : 0;
    }
}