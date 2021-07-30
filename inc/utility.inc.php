<?php
class Utility
{


    static function script($code)
    {
        return "<script>" . $code . "</script>";
    }

    static function alert($msg)
    {
        return "<script>alert('" . $msg . "');</script>";
    }

    static function console_log($msg)
    {
        return '<script>console.log("' . $msg . '");</script>';
    }

    static function console_warn($msg)
    {
        return "<script>console.warn('" . $msg . "');</script>";
    }

    static function console_error($msg)
    {
        return "<script>console.error('" . $msg . "');</script>";
    }

    static function hide_pswd($pswd)
    {
        $_ = "";
        for ($i = 0; $i < strlen($pswd); $i++) {
            $_ = $_ . "*";
        }
        return $_;
    }

    static function hide_card_digits($card_no)
    {
        $_ = substr($card_no, 0, 6) . "****" . substr($card_no, 9, -1);
        return $_;
    }

    static function echo_nl($msg)
    {
        echo $msg . "<br>";
    }

    static function get_date_formatted()
    {

        return date("Y-m-d");
    }

    static function redirect_to($url)
    {
        header("location: $url");
        die;
    }

    static function generateRandomString($for, $length)
    {
        $randomString = '';
        if (strtolower($for) == "otp"){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$%&#@!';
        }
        else if (strtolower($for) == "order"){
            $characters = '0123456789';
            $randomString .= '#';
        }
        else{
            return "Error";
        }
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // static function generateOrderNumber()
    // {
    //     $characters = '0123456789';
    //     $charactersLength = strlen($characters);
    //     $length = 11;
    //     $randomString = '#';
    //     for ($i = 0; $i < $length; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }
    //     return $randomString;
    // }

    static function compareDates($date1, $date2)
    {
        return strtotime($date1) - strtotime($date2);
    }

    static function log($msg)
    {
        if (!file_exists('log.txt')) {
            file_put_contents('log.txt', '');
        }

        date_default_timezone_set('Asia/Karachi');

        $time = date('m/d/y h:iA', time());
        $page = basename($_SERVER['PHP_SELF']);
        $user = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "guest";

        $contents = file_get_contents('log.txt');
        $contents .=  "User: $user\t$time\t$page\t$msg\r";
        
        file_put_contents('log.txt', $contents);
    }
}
