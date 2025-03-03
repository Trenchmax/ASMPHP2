<?php 
 namespace Src\Helpers;

use Src\Controllers\BaseController;
use Src\Models\Client\UserModel;
 use Src\Notifications\Notification;

 class NotFoundHelper extends BaseController{
 public function show() {
        echo $this->view->render('Client/404');
    }




  
 }