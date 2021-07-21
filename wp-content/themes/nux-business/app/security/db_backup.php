<?php

namespace security;

class DB_Backup
{
    private $tables = '*';
    private $backup_filename;

    public function __construct()
    {
        $this->backup_filename = 'backup-' . DB_NAME . '-' . parsidate('Y-m-d', 'now', 'eng') . '.sql';
        add_action("wp_ajax_db_backup_ajax", [$this, 'db_backup_ajax']);
        add_action("wp_ajax_nopriv_db_backup_ajax", [$this, 'db_backup_ajax']);
    }

    public function db_backup_ajax()
    {
        $nonce = $_POST['nonce'];
        if (!wp_verify_nonce($nonce, 'ajax_nonce')) {
            die('Nonce value cannot be verified.');
        }

        $data = [
            'msg' => '',
            'backup_content' => '',
            'backup_filename' => '',
        ];

        $result = $this->get_backup_tables_file_content();

        if (!$result){
            $data['msg'] = 'خطا در انجام عملیات!';
            wp_send_json_error($data);
        }
        else{
            $data['backup_content'] = $result;
            $data['backup_filename'] = $this->backup_filename;
            wp_send_json_success($data);
        }
    }

    public function get_backup_tables_file_content($tables = '*')
    {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            return false;
        }

        mysqli_query($link, "SET NAMES 'utf8'");

        //get all of the tables
        if ($tables == '*') {
            $tables = array();
            $result = mysqli_query($link, 'SHOW TABLES');
            while ($row = mysqli_fetch_row($result)) {
                $tables[] = $row[0];
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }

        $return = '';
        //cycle through
        foreach ($tables as $table) {
            $result = mysqli_query($link, 'SELECT * FROM ' . $table);
            $num_fields = mysqli_num_fields($result);
            $num_rows = mysqli_num_rows($result);

            $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
            $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE ' . $table));
            $return .= "\n\n" . $row2[1] . ";\n\n";
            $counter = 1;

            //Over tables
            for ($i = 0; $i < $num_fields; $i++) {   //Over rows
                while ($row = mysqli_fetch_row($result)) {
                    if ($counter == 1) {
                        $return .= 'INSERT INTO ' . $table . ' VALUES(';
                    } else {
                        $return .= '(';
                    }

                    //Over fields
                    for ($j = 0; $j < $num_fields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n", "\\n", $row[$j]);
                        if (isset($row[$j])) {
                            $return .= '"' . $row[$j] . '"';
                        } else {
                            $return .= '""';
                        }
                        if ($j < ($num_fields - 1)) {
                            $return .= ',';
                        }
                    }

                    if ($num_rows == $counter) {
                        $return .= ");\n";
                    } else {
                        $return .= "),\n";
                    }
                    ++$counter;
                }
            }
            $return .= "\n\n\n";
        }

        return $return;
    }
}