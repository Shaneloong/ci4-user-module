<?php 

namespace App\Controllers;

use App\Models\UserModel;
use App\Entities\User;

class Users extends BaseController{

    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }
    

    public function index(){
        return view('user/index', [
            'users' => $this->userModel->getUser()
        ]);
    }

    public function new(){
        
        $user = new User();

        return view('user/create', [
            'user' => $user
        ]);
    }

    public function create(){
        
        $user = new User($this->request->getPost());

        $file = $this->request->getFile('profile_image');


        $profile_image = $this->imageHandling($file);

        $validation = service('validation');

        $validation->setRules($this->userModel->validationRules, $this->userModel->validationMessages);
        
        $errors = [];   

        if(! $validation->run($this->request->getPost())){
            $errors = $validation->getErrors();
        }

        if($profile_image === false){
            return redirect()->back()
                            ->with('warning', 'No File is uploaded')
                            ->with('errors', $errors)
                            ->withInput();
        }

        if($profile_image == 'invalid file'){
            return redirect()->back()
                            ->with('warning', 'Invalid File Type Uploaded (Only JPG, JPEG, PNG)')
                            ->with('errors', $errors)
                            ->withInput();
        }

        if($profile_image == 'oversize'){
            return redirect()->back()
                            ->with('warning', 'File is too large (Max Size: 2MB)')
                            ->with('errors', $errors)
                            ->withInput();
        }


        $user->profile_image = $profile_image;

        if(!$this->userModel->insert($user)){
            $path = '../public/uploads/profile_images/' . $profile_image;

            if(is_file($path)){
                unlink($path);
            }

            return redirect()->back()
                            ->with('errors', $this->userModel->errors())
                            ->withInput();
        }

        return redirect()->to('/')->with('success', 'User Created Sucessfully');
    }

    public function show($id) {
        $user = $this->userModel->getUser($id);

        return view('user/view', [
            'user' => $user
        ]);
    }

    public function edit($id){
        return view('user/edit', [
            'user' => $this->userModel->getUser($id)
        ]);
    }


    public function updateImage($id){
        $user = $this->userModel->getUser($id);

        $path =  '../public/uploads/profile_images/' . $user->profile_image;

        $file = $this->request->getFile('profile_image');

        $profile_image = $this->imageHandling($file);

        if($profile_image === false){
            return redirect()->back()
                            ->with('tabs', 'editImage')
                            ->with('warning', 'No File is uploaded')
                            ->withInput();
        }

        if($profile_image == 'invalid file'){
            return redirect()->back()
                            ->with('tabs', 'editImage')
                            ->with('warning', 'Invalid File Type Uploaded (Only JPG, JPEG, PNG)')
                            ->withInput();
        }

        if($profile_image == 'oversize'){
            return redirect()->back()
                            ->with('tabs', 'editImage')
                            ->with('warning', 'File is too large (Max Size: 2MB)')
                            ->withInput();
        }

        if(is_file($path)){
            unlink($path);
        }

        $user->profile_image = $profile_image;

        if($this->userModel->save($user)){
            return redirect()->to('/users/show/' . $user->id)->with('success', 'Profile Image Updated Sucessfully');
        }
    }


    public function update($id) {
        $user = $this->userModel->getUser($id);

        $post = $this->request->getPost();

        
        $user->fill($post);

        if($user->hasChanged()){
            if($this->userModel->protect(false)->save($user)){
                return redirect()->to('/users/show/' . $id)
                                ->with('success', 'User Profile Updated Sucessfully');
            }
            else{
                return redirect()->back()
                                ->with('errors', $this->userModel->errors())
                                ->withInput();
            }
        }else{
            return redirect()->back()
                            ->with('warning', 'No Changes Made')
                            ->withInput();
        }
    }

    public function delete($id){
        $user = $this->userModel->getUser($id);

        if($this->request->getMethod() !== 'post'){
            return view('user/delete', [
                'user'=> $user
            ]);
        }
        $path = '../public/uploads/profile_images/' . $user->profile_image;

        if(is_file($path)){
            unlink($path);
        }
        if($this->userModel->delete($id)){
            return redirect()->to('/')->with('success', 'User Deleted Sucessfully');
        }
    }


    public function imageHandling($file){ // handling the process of storing image

        
        if(! $file->isValid()){
            $errorCode = $file->getError();

            if($errorCode === UPLOAD_ERR_NO_FILE){
                return false;
            }

            throw new \RuntimeException($file->getErrorString(). " " . $errorCode);
        }

        $type = $file->getMimeType();

        if(! in_array($type, ['image/png', 'image/jpeg', 'image/jpg'])){
            return 'invalid file';
        }

        $size = $file->getSizeByUnit('mb');

        if($size > 2){
            return 'oversize';
        }

        if(! $file->hasMoved()){
            $newName = $file->getRandomName();
            $file->move('../public/uploads/profile_images', $newName);
        }

        return $newName;
    }

    public function search(){

        $results = $this->userModel->search($this->request->getGet('keyword'));

        return $this->response->setJSON($results);

    }

    public function checkValidate(){
        $user = $this->request->getPost();

        $validation = service('validation');

        $validation->setRules($this->userModel->validationRules, $this->userModel->validationMessages);

        if(! $validation->run($user)){
            
            session()->setFlashdata('errors', $validation->getErrors());
            if(session()->has('errors')){

                return $this->response->setJSON(session('errors'));
            }
            else{
                return $this->response->setJSON(['errors' => 'No Errors']);
            }


        }
    }

    
}