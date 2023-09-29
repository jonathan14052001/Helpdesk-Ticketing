<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Pic;

class Pic extends BaseController{
    
    public function __construct()
        {
            $this->model = new M_Pic;
            helper('sn');
            $this->session = service('session');
            $this->auth = service('authentication');
            $this->pager = \Config\Services::pager();
        }
    
    public function index()
    {
        //jika belum login, user tidak memiliki akses
        if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? site_url('/login');
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        $keyword = $this->request->getVar('keyword');
        if($keyword){
           $pic = $this->model->search($keyword);
        }else{
            $pic = $this->model;
        }

        $data = [
            'judul' => 'Data pic',
            'pic' => $this->model->getAllData()
            //localhost:8080/pic/page_?
            // 'pic' => $this->model->paginate('10', 'pic'),
            // 'pager' => $this->model->pager
        ];
        //load View
        tampilan('pic/index', $data); 
    }

    public function tambah(){
        //jika belum login, user tidak memiliki akses
        if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? site_url('/login');
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        if (isset($_POST['tambah'])){
            $val = $this->validate([
                'name_pic'         => [
                    'label'  => 'Name pic',
                    'rules'  => 'required'
                ],
                'email' =>[
                    'label'  => 'Email',
                    'rules' => 'required',
                    'valid_user_email' => 'Email address is not in format',
                    'is_unique' => 'Email address already exists'
                ],
                'position_pic'         => [
                    'label'  => 'Posisi PIC',
                    'rules'  => 'required'
                ]
            ]);

            if(!$val){
                session()->setFlashdata('err',\Config\Services::validation()->listErrors());
                
                $data = [
                    'judul' => 'Data PIC',
                    'pic' => $this->model->getAllData()
                ];
                //load View
                tampilan('pic/index', $data);
            }   else{
                    $data = [
                        'name_pic'          => $this->request->getPost('name_pic'),
                        'email'             => $this->request->getPost('email'),
                        'position_pic'          => $this->request->getPost('position_pic')
                    ];
            
                    //insert data
                    $success = $this->model->tambah($data);
                    if($success){
                        session()->setFlashdata('message',' Ditambahkan');
                        return redirect()->to('/pic');
                    }
            }
        } else{
            return redirect()->to('/pic');
        }
        
    }

    public function hapus($id_user)
    {
        //jika belum login, user tak memiliki akses
        if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? site_url('/login');
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        $this->model->hapus($id_user);
            session()->setFlashdata('message',' Dihapus');
            return redirect()->to('/pic');
    }

    public function ubah(){

        //jika belum login, user tak memiliki akses
        if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? site_url('/login');
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        if (isset($_POST['ubah'])){
                $val = $this->validate([
                    'name_pic'         => [
                        'label'  => 'Nama PIC',
                        'rules'  => 'required'
                    ],
                    'email' =>[
                        'label'  => 'Email',
                        'rules' => 'required',
                        'validemail' => 'Email address is not in format',
                        'is_unique' => 'Email address already exists'
                    ],
                    'position_pic'         => [
                        'label'  => 'Posisi PIC',
                        'rules'  => 'required'
                    ]
                ]);

            if(!$val){
                session()->setFlashdata('err',\Config\Services::validation()->listErrors());
                
                $data = [
                    'judul' => 'Data PIC',
                    'pic' => $this->model->getAllData()
                ];
                //load View
                tampilan('pic/index', $data);
            }   else{

                    $id_user = $this->request->getPost('id_user');

                    $data = [
                        'name_pic'          => $this->request->getPost('name_pic'),
                        'email'             => $this->request->getPost('email'),
                        'position_pic'          => $this->request->getPost('position_pic')
            
                    ];
            
                    //update data
                    $success = $this->model->ubah($data, $id_user);
                    if($success){
                        session()->setFlashdata('message',' Diubah');
                        return redirect()->to('/pic');
                    }
            }
        } else{
            return redirect()->to('/pic');
        }
        
    }

    public function excel()
    {
        $data = [
            'pic' => $this->model->getAllData()
        ];
        echo view('pic/excel', $data);
    }

}
?>

