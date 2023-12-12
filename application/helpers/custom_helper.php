<?php
/*
 * Custom Helpers
 *
 */

//check admin
if (!function_exists('is_admin')) {
    function is_admin()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->admin_model->is_admin();
    }
}
if (!function_exists('date_format_func')) {
    function date_format_func($date)
    {
            if($date == NULL)
        	{
        		return "";
        	}
            else if($date == '0000-00-00')
            {
                return "";
            }
        	else
        	{
        		return date('d-m-Y',strtotime($date));
		    }
    }
}
if (!function_exists('number_to_word')) {
    function number_to_word($number){
        $no = (int)floor($number);
        $point = (int)round(($number - $no) * 100);
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
         '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
         '7' => 'seven', '8' => 'eight', '9' => 'nine',
         '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
         '13' => 'thirteen', '14' => 'fourteen',
         '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
         '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
         '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
         '60' => 'sixty', '70' => 'seventy',
         '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
          $divider = ($i == 2) ? 10 : 100;
          $number = floor($no % $divider);
          $no = floor($no / $divider);
          $i += ($divider == 10) ? 1 : 2;
     
     
          if ($number) {
             $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
             $hundred = ($counter == 1 && $str[0]) ? null : null;
             $str [] = ($number < 21) ? $words[$number] .
                 " " . $digits[$counter] . $plural . " " . $hundred
                 :
                 $words[floor($number / 10) * 10]
                 . " " . $words[$number % 10] . " "
                 . $digits[$counter] . $plural . " " . $hundred;
          } else $str[] = null;
       }
       $str = array_reverse($str);
       $result = implode('', $str);
     
     
       if ($point > 20) {
         $points = ($point) ?
           "" . $words[floor($point / 10) * 10] . " " . 
               $words[$point = $point % 10] : ''; 
       } else {
           $points = $words[$point];
       }
       if($points != ''){        
           echo ucwords($result . "Rupees and " . $points . " Paise Only");
       } else {
     
           echo ucwords($result . "Rupees Only");
       }
     
     }
}

if (! function_exists('_prx')) {
    function _prx($array)
    {
        return "<pre>".print_r($array,true)."</pre>";
    }
}

/**
 * get full name bu fname, mname, and lname
 */
if(!function_exists('get_full_name')) {
    function get_full_name($fname, $mname = null, $lname = null) {
        $full_name = $fname;
        if(!empty($mname)) {
            $full_name .= ' '.$mname;
        }
        if(!empty($lname)) {
            $full_name .= ' '.$lname;
        }
        return $full_name;
    }
}

/**
 * get customer button class by status
 */
if(!function_exists('get_customer_button_class')) {
    function get_customer_button_class($status) {
        switch ($status) {
            case "PENDING":
                return 'btn-info';
            case "REJECTED":
                return 'btn-danger';
            case "VERIFIED":
                return 'btn-success';
            default:
                return 'btn-default';
        }
    }
}
