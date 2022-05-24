<?php 

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $returnType = 'App\Entities\User';

    protected $allowedFields = ['name', 'email', 'profile_description', 'profile_image'];

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|is_unique[users.email]',
        'profile_description' => 'min_length[1]|max_length[255]'
    ];
    


    public function getUser($id = null){

        if($id !== null){
            
            return $this->where('id', $id)->first();
        }

        return $this->findAll();
    }

    public function search($keyword){

        if($keyword === null){
            return [];
        }
            
        return $this->select('id, name')->like('name', $keyword)->get()->getResultArray();
    }
}