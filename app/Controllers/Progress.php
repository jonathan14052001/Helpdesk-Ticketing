<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Progress;

class Progress extends BaseController{
    
    public function __construct()
        {
            $this->model = new M_Progress;
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
           $progress = $this->model->search($keyword);
        }else{
            $progress = $this->model;
        }

        $data = [
            'judul' => 'Data Progress',
            //'progress' => $this->model->getAllData()
            //localhost:8080/progress/page_?
            'progress' => $this->model->paginate('10', 'progress'),
            'pager' => $this->model->pager
        ];
        //load View
        tampilan('progress/index', $data); 
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
                'id_ticket'         => [
                    'label'  => 'Id Ticket',
                    'rules'  => 'required|numeric|is_unique[progress.id_ticket]'
                ],
                'persen_progress'           => [
                    'label'  => 'Persen Progress',
                    'rules'  => 'required'
                ],
                'solution'      => [
                    'label'  => 'Solusi',
                    'rules'  => 'required'
                ],
                'status_ticket'          => [
                    'label'  => 'Status Ticket',
                    'rules'  => 'required'
                ]
            ]);

            if(!$val){
                session()->setFlashdata('err',\Config\Services::validation()->listErrors());
                
                $data = [
                    'judul' => 'Data Progress',
                    'progress' => $this->model->getAllData()
                ];
                //load View
                tampilan('progress/index', $data);
            }   else{
                    $data = [
                        'id_ticket'          => $this->request->getPost('id_ticket'),
                        'persen_progress'    => $this->request->getPost('persen_progress'),
                        'solution'           => $this->request->getPost('solution'),
                        'status_ticket'      => $this->request->getPost('status_ticket')
                    ];
            
                    //insert data
                    $success = $this->model->tambah($data);
                    if($success){
                        session()->setFlashdata('message',' Ditambahkan');
                        return redirect()->to('/progress');
                    }
            }
        } else{
            return redirect()->to('/progress');
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

        $this->model->hapus($id);
            session()->setFlashdata('message',' Dihapus');
            return redirect()->to('/progress');
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
            $id = $this->request->getPost('id');
            $id_ticket = $this->request->getPost('id_ticket');
            $db_id_ticket = $this->model->getAllData($id)['id_ticket'];

            if($id_ticket === $db_id_ticket) {
                $val = $this->validate([
                    'id_ticket'         => [
                        'label'  => 'Id Ticket',
                        'rules'  => 'required|numeric'
                    ],
                    'persen_progress'           => [
                        'label'  => 'Persen Progress',
                        'rules'  => 'required'
                    ],
                    'solution'      => [
                        'label'  => 'Solusi',
                        'rules'  => 'required'
                    ],
                    'status_ticket'          => [
                        'label'  => 'Status Ticket',
                        'rules'  => 'required'
                    ]
                ]);
            } else{
                $val = $this->validate([
                    'id_ticket'         => [
                        'label'  => 'Id Ticket',
                        'rules'  => 'required|numeric'
                    ],
                    'persen_progress'           => [
                        'label'  => 'Persen Progress',
                        'rules'  => 'required'
                    ],
                    'solution'      => [
                        'label'  => 'Solusi',
                        'rules'  => 'required'
                    ],
                    'status_ticket'          => [
                        'label'  => 'Status Ticket',
                        'rules'  => 'required'
                    ]
                ]);
            }

            if(!$val){
                session()->setFlashdata('err',\Config\Services::validation()->listErrors());
                
                $data = [
                    'judul' => 'Data Progress',
                    'progress' => $this->model->getAllData()
                ];
                //load View
                tampilan('progress/index', $data);
            }   else{

                    $id = $this->request->getPost('id');

                    $data = [
                        'id_ticket'          => $this->request->getPost('id_ticket'),
                        'persen_progress'    => $this->request->getPost('persen_progress'),
                        'solution'           => $this->request->getPost('solution'),
                        'status_ticket'      => $this->request->getPost('status_ticket')
            
                    ];
            
                    //update data
                    $success = $this->model->ubah($data, $id);
                    if($success){
                        session()->setFlashdata('message',' Diubah');
                        return redirect()->to('/progress');
                    }
            }
        } else{
            return redirect()->to('/progress');
        }
        
    }

    public function excel()
    {
        $data = [
            'progress' => $this->model->getAllData()
        ];
        echo view('progress/excel', $data);
    }

}
?>

