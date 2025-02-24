<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\CommentModel;
class CommentController extends BaseController {
    public function show() {
        $CommentModel = new CommentModel();
        $comments = $CommentModel->getAll();
        echo $this->view->render('Admin/Pages/Comments/CommentsList', ['comments' => $comments] );
    }

    public function add(){
        echo $this->view->render('Admin/Pages/Comments/CommentsAdd');
    }
    public function edit(){
        echo $this->view->render('Admin/Pages/Comments/CommentsEdit');
    }
}