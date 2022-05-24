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

        if($profile_image === false){
            return redirect()->to('/users/new')
                            ->with('warning', 'No File is uploaded')
                            ->withInput();
        }else if($profile_image == null){
            return redirect()->back()
                            ->with('warning', 'No File Selected')
                            ->withInput();
        }else if ($profile_image == "Invalid File"){
            return redirect()->back()
                            ->with('warning', 'Invalid File')
                            ->withInput();
        }

        $user->profile_image = $profile_image;

        if(!$this->userModel->insert($user)){
            return redirect()->back()
                            ->with('errors', $this->userModel->errors())
                            ->withInput();
        }

        return redirect()->to('/')->with('info', 'User Created Sucessfully');
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

    public function editImage($id){

        $user = $this->userModel->getUser($id);

        return view('user/profileImage', [
            'user' => $user
        ]);

    }


    public function updateImage($id){
        $user = $this->userModel->getUser($id);

        $path = WRITEPATH . '/public/uploads/profile_images/' . $user->profile_image;

        $file = $this->request->getFile('profile_image');

        $profile_image = $this->imageHandling($file);

        if($profile_image === false){
            return redirect()->to('/users/editImage/'. $user->id)
                            ->with('warning', 'No File is uploaded')
                            ->withInput();
        }else if($profile_image == null){
            return redirect()->back()
                            ->with('warning', 'No File Selected')
                            ->withInput();
        }else if ($profile_image == "Invalid File"){
            return redirect()->back()
                            ->with('warning', 'Invalid File')
                            ->withInput();
        }

        if(is_file($path)){
            unlink($path);
        }

        $user->profile_image = $profile_image;

        if($this->userModel->save($user)){
            return redirect()->to('/')->with('info', 'User Updated Sucessfully');
        }
    }





    public function update($id) {
        $user = $this->userModel->getUser($id);

        $post = $this->request->getPost();

        
        $user->fill($post);
        // dd($user);

        if($user->hasChanged()){
            if($this->userModel->protect(false)->save($user)){
                return redirect()->to('/users/show/' . $id)
                                ->with('info', 'User Updated Sucessfully');
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

        if($this->userModel->delete($id)){
            return redirect()->to('/')->with('info', 'User Deleted Sucessfully');
        }
    }


    public function imageHandling($file){ // handling the process of storing image

        
        if(! $file->isValid()){
            $errorCode = $file->getError();

            if($errorCode === UPLOAD_ERR_NO_FILE){
                return null;
            }

            throw new \RuntimeException($file->getErrorString(). " " . $errorCode);
        }

        $type = $file->getMimeType();

        if(! in_array($type, ['image/png', 'image/jpeg', 'image/jpg'])){
            return "Invalid File";
        }

        if(! $file->hasMoved()){
            $newName = $file->getRandomName();
            $file->move('../public/uploads/profile_images', $newName);
        }

        // $path = WRITEPATH . 'public/uploads/' . $file->store('profile_images');

        // // service('image')->withFile($path)->fit(300, 300)->save($path);
        // $file->move(WRITEPATH . 'public/uploads/');

        return $newName;
    }

    public function search(){

        $results = $this->userModel->search($this->request->getGet('keyword'));

        return $this->response->setJSON($results);


    }

    
}