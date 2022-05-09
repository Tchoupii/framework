<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\CommercialModel;
  
class SigninController extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('signin');
    } 
  
    public function loginAuth()
    {
        $session = session();
        $CommercialModel = new CommercialModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $data = $CommercialModel->where('LOGIN', $email)->first();
        
        if($data){
            $pass = $data['PASSWORD'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['ID_COMMERCIAL'],
                    'email' => $data['LOGIN'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/carte');
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/signin');
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/signin');
        }
    }
}