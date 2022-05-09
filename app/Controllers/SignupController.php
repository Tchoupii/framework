<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\CommercialModel;
  
class SignupController extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [];
        echo view('signup', $data);
    }
  
    public function store()
    {
        helper(['form']);
        $rules = [
            'name'          => 'required|min_length[2]|max_length[50]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[COMMERCIAL.LOGIN]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];
          
        if($this->validate($rules)){
            $commercialModel = new CommercialModel();
            $data = [
                'NAME'     => $this->request->getVar('name'),
                'LOGIN'    => $this->request->getVar('email'),
                'PASSWORD' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $commercialModel->save($data);
            return redirect()->to('/signin');
        }else{
            $data['validation'] = $this->validator;
            echo view('signup', $data);
        }
          
    }
  
}