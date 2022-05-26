<?php 

namespace App\Controllers;

use App\Models\UserModel;

class Test extends BaseController{
    public function __construct(){
        $this->userModel = new UserModel();
    }
    public function index (){
        dd($this->userModel->select('created_at, updated_at')->get()->getResultArray());
    }
}