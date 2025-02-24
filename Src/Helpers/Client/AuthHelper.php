<?php 
 namespace Src\Helpers\Client;
 use Src\Models\Client\UserModel;
 use Src\Notifications\Notification;

 class AuthHelper{
  

    

   
  

    public static function middleware()
    {
        $admin = explode('/', $_SERVER['REQUEST_URI']);
        $admin = $admin[1];

        if ($admin == 'admin') {
            if (!isset($_SESSION['user'])) {
                header('location: /loginForm');
                exit;
            }
            if ($_SESSION['user']['role'] != 2) {
                header('location: /home');
                exit;
            }
            
        }


    }



  
 }