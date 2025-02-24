<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;

class UserController extends BaseController{

    public function index(){
        echo $this->view->render('Client/Pages/MyAccount',);

    }
    public function userAddress(){
        echo $this->view->render('Client/Pages/UserAddressManage',);

    }
}