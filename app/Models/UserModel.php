<?php 

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $returnType = 'App\Entities\User';

    protected $allowedFields = ['name', 'email', 'profile_description', 'profile_image', 'gender'];

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]|alpha_numeric_space',
        'email' => 'required|valid_email|is_unique[users.email]',
        'profile_description' => 'max_length[255]',
        'gender' => 'required'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Name is required',
            'min_length' => 'Name must be at least 3 characters',
            'max_length' => 'Name should not be more than 255 characters',
            'alpha_numeric_space' => 'Name should only contain letters, numbers and spaces'
        ],
        'email' => [
            'required' => 'Email is required',
            'is_unique' => 'Email already exists',
            'valid_email' => 'Email entered is not valid'
        ],
        'profile_description' => [
            'max_length' => 'Profile bio should not be more than 255 characters'
        ],
        'gender' =>[
            'required' => 'Gender is required'
        ]
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