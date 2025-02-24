<?php
namespace Src\Models\Admin;

use Src\Models\BaseModel;

class CommentModel extends BaseModel {
    protected $table = 'comments';
    protected $id = 'id';
    
    public function createComment($data) {
        return $this->create($data);
    }


    public function getOneComment($id) {
        return $this->getOne($id);
    }
    public function updateComment($id, $data) {
        return $this->update($id,$data);
    }

    public function getAllActiveComments() {
        return $this->getAllByStatus();
    }

    public function deleteComment($id) {
        return $this->delete($id);
    } 
}