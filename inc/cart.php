<?php
    class cart{
        public $cart = null;
        function __construct()
        {
            $cart = $_SESSION['cart'];
        }
        static function init_cart(){
            $cart = $_SESSION['cart'];
        }
        function add_to_cart($book_id){
            

        }
        static function del_from_cart(){
        }
        static function update_cart(){
        }
        static function empty_cart(){
        }

    }

?>