<?php

class Setting extends CI_Controller {
 
    function db_download() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/downloaddb');
    } 

    function db_syncserver() {
        $this->load->view('settings/syncserver');
    } 
    function db_synclocal() {
        $this->load->view('settings/synclocal'); 
    } 
    

    function download() {
        set_time_limit(0); 
        date_default_timezone_set('GMT');
        // Load the file helper in codeigniter
        $this->load->helper('file');
        $DBUSER = $this->session->userdata('username');
        $DBPASSWD = $this->session->userdata('password');
        $DATABASE = $this->session->userdata('database');

        $con = mysqli_connect("localhost", $DBUSER, $DBPASSWD, $DATABASE);

        $tables = array();
        $query = mysqli_query($con, 'SHOW TABLES');
        while ($row = mysqli_fetch_row($query)) {
            $tables[] = $row[0];
        }

        $result = 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";';
        $result .= 'SET time_zone = "+00:00";';

        foreach ($tables as $table) {
            $query = mysqli_query($con, 'SELECT * FROM `' . $table . '`');
            $num_fields = mysqli_num_fields($query);

            $result .= 'DROP TABLE IF EXISTS `' . $table . '`;';
            $row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE `' . $table . '`'));
            $result .= "\n\n" . $row2[1] . ";\n\n";

            for ($i = 0; $i < $num_fields; $i++) {
                while ($row = mysqli_fetch_row($query)) {
                    $result .= 'INSERT INTO `' . $table . '` VALUES(';
                    for ($j = 0; $j < $num_fields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n", "\\n", $row[$j]);
                        if (isset($row[$j])) {
                            $result .= '"' . $row[$j] . '"';
                        } else {
                            $result .= '""';
                        }
                        if ($j < ($num_fields - 1)) {
                            $result .= ',';
                        }
                    }
                    $result .= ");\n";
                }
            }
            $result .= "\n\n";
        }

        //Create Folder
        $folder = 'database/';
        if (!is_dir($folder))
            mkdir($folder, 0777, true);
        chmod($folder, 0777);

        $date = date('m-d-Y');
        $filename = $folder . $DATABASE . "_db_" . $date;

        $handle = fopen($filename . '.sql', 'w+');
        fwrite($handle, $result);
        fclose($handle);
        $this->load->helper('download');
        force_download($filename . '.sql', null);
        //redirect('Dashboard');
    }

// end Export_Database function
}
