<?php 
    function logout(){
        session_start();
        $_POST = array();
        $destroyed = session_destroy();
        $helper = array_keys($_SESSION);
        foreach ($helper as $key){
            unset($_SESSION[$key]);
        }
        setcookie('name', null, -1, '/');
        setcookie('PHPSESSID', null, -1, '/');  
        //print_r($_COOKIE);
        return $destroyed;
    }
    logout();
    $url=$_SERVER['HTTP_REFERER'];
    //header("location:$url");
    header("location: http://pawsveterinary.000webhostapp.com/index.php");
?>