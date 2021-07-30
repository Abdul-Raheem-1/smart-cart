<?php
    include("./inc/utility.inc.php");
    class database
    {
        // local var
        private $host = "localhost";
        private $user = "root";
        private $pswd = "";
        private $db = "smartcartdb";
        private $link = null;

        // constructor
        function __construct()
        {
            $this->link = mysqli_connect($this->host, $this->user, $this->pswd, $this->db);
            // log to console
            if($this->link){
                echo Utility::console_log("database connected!");
            }
            else{
                echo Utility::console_log("database not connected! mysqli error no: " . mysqli_errno($this->get_link()));
                die("<br>mysqli error no: " . mysqli_errno($this->get_link()));
            }
        }

        // getter
        function get_link(){
            return $this->link;
        }

        function query($q){
            $res = mysqli_query($this->link, $q);
            $out = "";
            if ($res) {
                $out = "Query Executed Sucessfully ✅ query: $q";
                echo Utility::console_log($out);
            } else {
                $out = "Query Error ❌: " . mysqli_errno($this->get_link()) . " on query: $q";
                echo Utility::console_error($out);
            }
            Utility::log($out);
            return $res;
        }


        public function delete_entity($table_name, $id){
            $q = "DELETE FROM `$table_name` WHERE `id` = $id";
            $res = $this->query($q);
            return $res;
        }

        
        public function update_entity($table_name, $col_name, $new_value, $id){
            $q = "UPDATE `$table_name` SET `$col_name` = '$new_value' WHERE id = " . $id;
            $res = $this->query($q);
            return $res;
        }


        public function get_entity($table_name, $id){
            $q = "SELECT * FROM `$table_name` WHERE ID = " . $id; 
            $res = $this->query($q);
            return $res->fetch_assoc();
        }

        public function get_entities($table_name){
            $q = "SELECT * FROM `$table_name`"; 
            $res = $this->query($q);
            return $res;
        }

        public function login_user($email, $pswd){
            $q = "SELECT * FROM user WHERE email='$email' AND password='$pswd'";
            $res = $this->query($q);
            $data = $res->fetch_assoc();
            $id = $data["id"];
            return $id ? true : false;
        }

        public function user_exists($email){
            $q = "SELECT * FROM user WHERE email='$email'";
            $res = $this->query($q);
            $data = $res->fetch_assoc();
            $id = $data["id"];
            return $id ? true : false;
        }
        

    }

?>
