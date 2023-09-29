<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\models\M_Company;

class Company extends BaseController{
    
    public function __construct()
        {
            $this->modelCompany = new M_Company;
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
           $company = $this->modelCompany->search($keyword);
        }else{
            $company = $this->modelCompany;
        }

        $data = [
            'judul' => 'Data company',
            //'company' => $this->modelCompany->getAllData()
            //localhost:8080/company/page_?
            'company' => $this->modelCompany->paginate('10', 'company'),
            'pager' => $this->modelCompany->pager
        ];
        //load View
        tampilan('company/index', $data); 
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
                'name_company'         => [
                    'label'  => 'Name Company',
                    'rules'  => 'required'
                ]
            ]);

            if(!$val){
                session()->setFlashdata('err',\Config\Services::validation()->listErrors());
                
                $data = [
                    'judul' => 'Data company',
                    'company' => $this->modelCompany->getAllData()
                ];
                //load View
                tampilan('company/index', $data);
            }   else{
                    $data = [
                        'name_company'          => $this->request->getPost('name_company')
                    ];
            
                    //insert data
                    $success = $this->modelCompany->tambah($data);
                    if($success){
                        session()->setFlashdata('message',' Ditambahkan');
                        return redirect()->to('/company');
                    }
            }
        } else{
            return redirect()->to('/company');
        }
        
    }

    public function hapus($id)
    {
        //jika belum login, user tidak memiliki akses
        if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? site_url('/login');
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        $this->modelCompany->hapus($id);
            session()->setFlashdata('message',' Dihapus');
            return redirect()->to('/company');
    }

    public function ubah(){

        //jika belum login, user tidak memiliki akses
        if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? site_url('/login');
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        if (isset($_POST['ubah'])){
                $val = $this->validate([
                    'name_company'         => [
                        'label'  => 'Name Company',
                        'rules'  => 'required'
                    ]
                ]);

            if(!$val){
                session()->setFlashdata('err',\Config\Services::validation()->listErrors());
                
                $data = [
                    'judul' => 'Data company',
                    'company' => $this->modelCompany->getAllData()
                ];
                //load View
                tampilan('company/index', $data);
            }   else{

                    $id = $this->request->getPost('id');

                    $data = [
                        'name_company'          => $this->request->getPost('name_company')
            
                    ];
            
                    //update data
                    $success = $this->modelCompany->ubah($data, $id);
                    if($success){
                        session()->setFlashdata('message',' Diubah');
                        return redirect()->to('/company');
                    }
            }
        } else{
            return redirect()->to('/company');
        }
        
    }

    public function excel()
    {
        $data = [
            'company' => $this->modelCompany->getAllData()
        ];
        echo view('company/excel', $data);
    }

}
?>

