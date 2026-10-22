<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author u43255
 */
$basepath = str_replace('system', 'vendor', BASEPATH);

require $basepath . 'phpmailer/phpmailer/src/Exception.php';
require $basepath . 'phpmailer/phpmailer/src/PHPMailer.php';
require $basepath . 'phpmailer/phpmailer/src/SMTP.php';

class MY_Controller extends CI_Controller {

    public $user;
    public $language = '';
    public $multiple = 1;
    public $table_color = '';
    public $box_color = '';
	public $company_roundoff = 2;
    public function __construct() {
        parent::__construct();
        if ($this->input->get('newpage', TRUE) == 'new') {
            $url = base_url() . "dashboard/admin/";
            //$this->uri->uri_string
            $this->load->helper('cookie');
            $name = 'newpage';
            $value = base_url() . $this->uri->uri_string;
            $expire = time() + 360;
            $path = '/';
            setcookie($name, $value, $expire, $path);
            redirect($url);
        }

        $product_name = $this->config->item('product_name');
        $this->load->helper('lang_translate');
        $this->load->library('session');
        $user = $this->session->userdata('user');
        $this->user = $user;

        $this->table_color = $this->config->item('table_color');
        $this->box_color = $this->config->item('box_color');

        $global_data['hostname'] = $this->session->userdata('hostname');
        $global_data['username'] = $this->session->userdata('username');
        $global_data['password'] = $this->session->userdata('password');
        $global_data['database'] = $this->session->userdata('database');
        $global_data['isexcute'] = $this->session->userdata('isexcute'); 
        if ($global_data['hostname'] == '') {
            $version = $this->config->item('version');
            $url = str_replace($version . '/','', base_url()) . "login/";
            redirect($url);
        }
        $this->load->vars($global_data);
        $this->load->model('menus_model', 'menu');
        if ($user['utype'] == 'Admin' || $user['utype'] == 'Super Admin') {
            $dat = $this->menu->list_items($user['Id']);
        } else {
            $dat = $this->menu->list_items_by_user($user['Id']);
        }
        $global_data['menus'] = $dat;
        $global_data['user'] = $user;
        $global_data['company'] = $this->menu->getCompany();
		if(isset($global_data['company']['company_roundoff']) ){
			$this->company_roundoff = $global_data['company']['company_roundoff'];
		}
        $this->load->vars($global_data);
        $createdby = $this->session->userdata('logged_in');
        if ($createdby != 1) {
             $version = $this->config->item('version');
            $url = str_replace($version . '/','', base_url()) . "login/";
            redirect($url);
        }

        if (!isset($_COOKIE['language'])) {
            setcookie('language', 'en', time() + (86400 * 365), "/");
            $this->language = 'en';
        } else {
            $language = $_COOKIE['language'];
            $this->language = $language;
            if ($language == 'ac') {
                $this->lang->load('ac_site', 'ac');
            } else {
                if ($product_name == 'faz') {
                    $this->lang->load('en_site', 'en');
                } else {
                    $this->lang->load('gs_site', 'en');
                }
            }
        }

        if ($product_name == 'faz' || $product_name == 'demo') {
            $this->multiple = 1;
        } else {
            $this->multiple = 0;
        }
    }

    function getpermission() {
        $user = $this->session->userdata('user');
        $url = $this->input->post('url');
        $result = $this->menu->getpermission($user['Id'], $url);
        print_r(json_encode($result));
    }

    function getKey($key) {
        return $this->menu->getValue($key);
    }

    function number_fm($number) {
        return number_format((float) $number, $this->company_roundoff, '.', '');
    }
	
	

	function array_list_filter($list, $val) {
		$filter_rules = array(
			'Field' => $val
		);

		$filter = function ($player) use ($filter_rules) {
			foreach ($filter_rules as $rulekey => $rulevalue) {
				if ($player->$rulekey != $rulevalue) {
					return false;
			}
			}
			return true;
		};

		$filtered = array_filter($list, $filter);
		return $filtered;
	}	 

    public function Show_Amount_In_Words($number) {

        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'One', '2' => 'Two',
            '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
            '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
            '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
            '13' => 'Thirteen', '14' => 'Fourteen',
            '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
            '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
            '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
            '60' => 'Sixty', '70' => 'Seventy',
            '80' => 'Eighty', '90' => 'Ninety');
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
            } else {
                $str[] = null;
            }
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
                "." . $words[$point / 10] . " " .
                $words[$point = $point % 10] : '';
        return $result . " Only";
    }

    function download() {
        date_default_timezone_set('GMT');
        // Load the file helper in codeigniter
        $this->load->helper('file');
        $DBUSER = $this->session->userdata('username');
        $DBPASSWD = $this->session->userdata('password');
        $DATABASE = $this->session->userdata('database');

        $folder = '/var/database/';
        if (!is_dir($folder))
            mkdir($folder, 0777, true);
       // chmod($folder, 0777);

        $date = date('m-d-Y');
        $filename = $folder . $DATABASE . "_db_". '.sql';
        if (file_exists($filename)) {
			unlink($filename);
        }

        $days = 15;
        $path = $folder;

// Open the directory  
        if ($handle = opendir($path)) {
            // Loop through the directory  
            while (false !== ($file = readdir($handle))) {
                // Check the file we're doing is actually a file  
                if (is_file($path . $file)) {
                    // Check if the file is older than X days old  
                    if (filemtime($path . $file) < ( time() - ( $days * 24 * 60 * 60 ) )) {
                        // Do the deletion  
                        unlink($path . $file);
                    }
                }
            }
        }
		$DBSERVER = $this->session->userdata('hostname');
        $con = mysqli_connect($DBSERVER, $DBUSER, $DBPASSWD, $DATABASE);
		
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

        $handle = fopen($filename, 'w+');
        fwrite($handle, $result);
        fclose($handle);
    }

    //put your code here
}

?>
