<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Ticket;
use App\Models\M_Company;
use App\Models\M_Pic;

class Ticket extends BaseController{

    protected $companyModel;
    protected $picModel;
    
    public function __construct()
        {
            
            $this->pager = \Config\Services::pager();
            $this->model = new M_Ticket;
            $this->companyModel = new M_Company;
            $this->picModel = new M_Pic;
            helper('sn');
            $this->session = service('session');
            $this->auth = service('authentication');
        }
    
    public function index($keyword = null)
    {
        //jika belum login, user tidak memiliki akses
        if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? site_url('/login');
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        // $keyword = $this->request->getVar('keyword');
        // dd($keyword);
        if($keyword){
           $ticket = $this->model->search($keyword);
           //dd($ticket);
        }else{
            $ticket = $this->model;
        }

        $company = $this->companyModel->findAll();
        $pic = $this->picModel->findAll();
        $data = [
            'judul' => 'Data ticket',
            //'ticket' => $this->model->getAllData()
            //localhost:8080/ticket/page_?
            'pager' => $this->model->pager,
            'ticket' => $this->model->paginate('10', 'ticket'),
            'company' => $company,
            'pic' => $pic
        ];
        // dd($data['ticket']);
        //load View
        tampilan('ticket/index', $data); 
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
                'no_ticket'         => [
                    'label'  => 'Nomor Ticket',
                    'rules'  => 'required|numeric|is_unique[ticket.no_ticket]'
                ],
                'user_id'           => [
                    'label'  => 'Id User',
                    'rules'  => 'required|numeric'
                ],
                'urgency'           => [
                    'label'  => 'Urgensi',
                    'rules'  => 'required'
                ],
                'name_company'      => [
                    'label'  => 'Nama Perusahaan',
                    'rules'  => 'required'
                ],
                'name_pic'          => [
                    'label'  => 'Nama Penanggung Jawab',
                    'rules'  => 'required'
                ],
                'position_pic'      => [
                    'label'  => 'Posisi Penanggung Jawab',
                    'rules'  => 'required'
                ],
                'problem_company'   => [
                    'label'  => 'Masalah Perusahaan',
                    'rules'  => 'required'
                ],
                'problem_details'   => [
                    'label'  => 'Detail Masalah Perusahaan',
                    'rules'  => 'required'
                ],
                'status_ticket'   => [
                    'label'  => 'Status Ticket',
                    'rules'  => 'required'
                ]
            ]);

            if(!$val){
                session()->setFlashdata('err',\Config\Services::validation()->listErrors());
                
                $data = [
                    'judul' => 'Data ticket',
                    'ticket' => $this->model->getAllData()
                ];
                //load View
                tampilan('ticket/index', $data);
            }   else{
                $image = $this->request->getFile('image_ticket');
                if($image->getError() == 4){
                    session()->setFlashdata('err',\Config\Services::validation()->listErrors());
                
                    $data = [
                        'judul' => 'Data ticket',
                        'ticket' => $this->model->getAllData()
                    ];
                    //load View
                    tampilan('ticket/index', $data);
                } else{
                    $nameImage = $image->getName();
                    $image->move('picture/',$nameImage);
                }
                    $data = [
                        'id'                => $this->request->getPost('id'),
                        'no_ticket'         => $this->request->getPost('no_ticket'),
                        'user_id'           => $this->request->getPost('user_id'),
                        'urgency'           => $this->request->getPost('urgency'),
                        'name_company'      => $this->request->getPost('name_company'),
                        'name_pic'          => $this->request->getPost('name_pic'),
                        'position_pic'      => $this->request->getPost('position_pic'),
                        'problem_company'   => $this->request->getPost('problem_company'),
                        'problem_details'   => $this->request->getPost('problem_details'),
                        'status_ticket'      => $this->request->getPost('status_ticket'),
                        'image_ticket'      => $nameImage
                    ];
            
                    //insert data
                    $success = $this->model->tambah($data);
                    if($success){
                        session()->setFlashdata('message',' Ditambahkan');
                        return redirect()->to('/ticket');
                    }
            }
        } else{
            return redirect()->to('/ticket');
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
            return redirect()->to('/ticket');
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
            $no_ticket = $this->request->getPost('no_ticket');
            $db_no_ticket = $this->model->getAllData($id)['no_ticket'];

            if($no_ticket === $db_no_ticket) {
                $val = $this->validate([
                    'no_ticket'         => [
                        'label'  => 'Nomor Ticket',
                        'rules'  => 'required|numeric'
                    ],
                    'user_id'           => [
                        'label'  => 'Id User',
                        'rules'  => 'required|numeric'
                    ],
                    'urgency'           => [
                        'label'  => 'Urgensi',
                        'rules'  => 'required'
                    ],
                    'name_company'      => [
                        'label'  => 'Nama Perusahaan',
                        'rules'  => 'required'
                    ],
                    'name_pic'          => [
                        'label'  => 'Nama Penanggung Jawab',
                        'rules'  => 'required'
                    ],
                    'position_pic'      => [
                        'label'  => 'Posisi Penanggung Jawab',
                        'rules'  => 'required'
                    ],
                    'problem_company'   => [
                        'label'  => 'Masalah Perusahaan',
                        'rules'  => 'required'
                    ],
                    'problem_details'   => [
                        'label'  => 'Detail Masalah Perusahaan',
                        'rules'  => 'required'
                    ],
                    'status_ticket'   => [
                        'label'  => 'Status Ticket',
                        'rules'  => 'required'
                    ],
                    'image_ticket'   => [
                        'label'  => 'image Ticket',
                        'rules'  => 'required'
                    ]
                ]);
            } else{
                $val = $this->validate([
                    'no_ticket'         => [
                        'label'  => 'Nomor Ticket',
                        'rules'  => 'required|numeric'
                    ],
                    'user_id'           => [
                        'label'  => 'Id User',
                        'rules'  => 'required|numeric'
                    ],
                    'urgency'           => [
                        'label'  => 'Urgensi',
                        'rules'  => 'required'
                    ],
                    'name_company'      => [
                        'label'  => 'Nama Perusahaan',
                        'rules'  => 'required'
                    ],
                    'name_pic'          => [
                        'label'  => 'Nama Penanggung Jawab',
                        'rules'  => 'required'
                    ],
                    'position_pic'      => [
                        'label'  => 'Posisi Penanggung Jawab',
                        'rules'  => 'required'
                    ],
                    'problem_company'   => [
                        'label'  => 'Masalah Perusahaan',
                        'rules'  => 'required'
                    ],
                    'status_ticket'   => [
                        'label'  => 'Status Ticket',
                        'rules'  => 'required'
                    ]                    
                ]);
            }

            if(!$val){
                session()->setFlashdata('err',\Config\Services::validation()->listErrors());
                
                $company = $this->companyModel->findAll();
                $pic = $this->picModel->findAll();
                $data = [
                    'judul' => 'Data Ticket',
                    'ticket' => $this->model->getAllData(),
                    'company' => $company,
                    'pic' => $pic
                ];
                //load View
                tampilan('ticket/index', $data);
            }   else{
                    $image = $this->request->getFile('image_ticket');
                    if($image->getError() == 4){
                        session()->setFlashdata('err',\Config\Services::validation()->listErrors());
                    
                        $data = [
                            'judul' => 'Data ticket',
                            'ticket' => $this->model->getAllData()
                        ];
                        //load View
                        tampilan('ticket/index', $data);
                    } else{
                        $nameImage = $image->getName();
                        $image->move('picture/',$nameImage);
                    }

                    $id = $this->request->getPost('id');

                    $data = [
                        'no_ticket'         => $this->request->getPost('no_ticket'),
                        'user_id'           => $this->request->getPost('user_id'),
                        'urgency'           => $this->request->getPost('urgency'),
                        'name_company'      => $this->request->getPost('name_company'),
                        'name_pic'          => $this->request->getPost('name_pic'),
                        'position_pic'      => $this->request->getPost('position_pic'),
                        'problem_company'   => $this->request->getPost('problem_company'),
                        'problem_details'   => $this->request->getPost('problem_details'),
                        'status_ticket'      => $this->request->getPost('status_ticket'),
                        'image_ticket'      => $nameImage
            
                    ];
            
                    //update data
                    $success = $this->model->ubah($data, $id);
                    if($success){
                        session()->setFlashdata('message',' Diubah');
                        return redirect()->to('/ticket');
                    }
            }
        } else{
            return redirect()->to('/ticket');
        }
        
    }

    public function excel()
    {
        $data = [
            'ticket' => $this->model->getAllData()
        ];
        echo view('ticket/excel', $data);
    }

    public function download($namafile)
    {
        $path = 'picture/' . $namafile;
        $file = new \CodeIgniter\Files\File($path);
        return $this->response->download($file, null);
    }    

}


?>

