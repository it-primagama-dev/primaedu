<?php

class ChpassController extends ControllerBase
{

    public function indexAction(){
        // Method GET
        if($this->request->isPost() && $this->session->has('auth')){

            $oldPassword = $this->request->getPost('OldPass');
            $newPassword1 = $this->request->getPost('NewPass1');
            $newPassword2 = $this->request->getPost('NewPass2');
            
            if(!$oldPassword){
                $this->flash->error("Password Lama Harus Diisi");
                return;
            }
            if(!$newPassword1){
                $this->flash->error("Password Baru Harus Diisi");
                return;
            }
            if(!$newPassword2){
                $this->flash->error("Konfirmasi Password Harus Diisi");
                return;
            }

            if($newPassword1 == $newPassword2){
                $user = Users::findFirst(
                    array(
                        "Username = :user: AND Password = :pass: AND Disabled = 0",
                        'bind' => array('user' => $this->session->get('auth')['username'], 'pass' => sha1($oldPassword))
                    ));
                if(!$user){
                    $this->flash->warning("Password Lama Salah");
                    return;
                }
                $user->Password = sha1($newPassword1);
                if(!$user->save()){
                    $this->flash->error("Terjadi Galat Saat Mengubah Password");
                    return $this->forward('index');
                }
                $this->flash->success("Penggantian Password Sukses");
                return $this->forward('index');
            } else {
                $this->flash->warning("Password Baru Tidak Sama");
            }
        }
    }

}

