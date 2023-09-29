<?php

namespace App\Controllers;
use App\Models\M_Admin;
use App\Models\M_Authgroup;

class Admin extends BaseController
{
    protected $db, $builder;
    public function __construct()
        {
        $this->model = new M_Admin;
        $this->authgroupModel = new M_Authgroup;
        helper('sn');
        $this->session = service('session');
		$this->auth = service('authentication');
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        }

    public function index()
    {
        //jika belum login, user tidak memiliki akses hi
        if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? site_url('/login');
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        $keyword = $this->request->getVar('keyword');
        if($keyword){
           $admin = $this->model->search($keyword);
        }else{
            $admin = $this->model;
        }

        $authgroup = $this->authgroupModel->findAll();
        $data = [
           'judul' => 'User List',
           'authgroup' => $authgroup
           
        ];

        $this->builder->select('users.id as userid, username, email, user_image, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        //$this->builder->join('auth_permissions', 'auth_permissions.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();
        //load View
        tampilan('admin/index', $data);
    }

    public function tambah($id = 0){
        //jika belum login, user tidak memiliki akses
        if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? site_url('/login');
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        if (isset($_POST['tambah'])){
            $val = $this->validate([
                'email'      => [
                    'label'  => 'Email Pengguna',
                    'rules'  => 'required'
                ],
                'username'          => [
                    'label'  => 'Nama Pengguna',
                    'rules'  => 'required'
                ],
                'fullname'      => [
                    'label'  => 'Nama Lengkap Pengguna',
                    'rules'  => 'required'
                ],
                'user_image'   => [
                    'label'  => 'Foto Pengguna',
                    'rules'  => 'uploaded[user_image]|max_size[user_image,1024]is_image[user_image]|mime_in[user_image,image/jpg, image/jpep, image/png]',
                    'errors' => [
                        'uploaded' => 'Pilih gambar User terlbih dahulu',
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar',
                    ]
                ]
            ]);

            if(!$val){
                session()->setFlashdata('err',\Config\Services::validation()->listErrors());
                
                $data = [
                    'judul' => 'Data Users',
                    'users' => $this->model->getAllData()
                ];
                $this->builder->select('users.id as userid, username, email, fullname, user_image, name');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->where('users.id', $id);
                $query = $this->builder->get();
                //load View
                tampilan('admin/index', $data);
            }   else{
                    $data = [
                        'email'             => $this->request->getPost('email'),
                        'username'          => $this->request->getPost('username'),
                        'fullname'          => $this->request->getPost('fullname'),
                        'user_image'        => $this->request->getPost('user_image'),
                        'name'              => $this->request->getPost('name')
                        
                    ];
            
                    //insert data
                    $success = $this->model->tambah($data);
                    if($success){
                        session()->setFlashdata('message',' Ditambahkan');
                        return redirect()->to('/admin');
                    }
            }
        } else{
            return redirect()->to('/admin');
        }
        
    }

    public function detail($id = 0)
    {
        //jika belum login, user tidak memiliki akses
        if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? site_url('/login');
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        $data = [
           'judul' => 'User Detail'
        ];
        $this->builder->select('users.id as userid, username, email, fullname, user_image, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();

        if(empty($data['user'])){
            return redirect()->to('/admin');
        }
        //load View
        return tampilan('admin/detail', $data);

        
    }
    public function hapus($userid)
    {
        //jika belum login, user tidak memiliki akses
        if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? site_url('/login');
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        $this->model->hapus($userid);
            session()->setFlashdata('message',' Dihapus');
            return redirect()->to('admin');
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
                    'username'         => [
                        'label'  => 'username',
                        'rules'  => 'required'
                    ],
                    'email' =>[
                        'label'  => 'Email',
                        'rules' => 'required',
                        'validemail' => 'Email address is not in format',
                        'is_unique' => 'Email address already exists'
                    ],
                    'fullname'      => [
                        'label'  => 'Nama Lengkap Pengguna',
                        'rules'  => 'required'
                    ],
                    'user_image'   => [
                        'label'  => 'Foto Pengguna',
                        'rules'  => 'uploaded[user_image]|max_size[user_image,1024]is_image[user_image]|mime_in[user_image,image/jpg, image/jpep, image/png]',
                        'errors' => [
                            'uploaded' => 'Pilih gambar User terlbih dahulu',
                            'max_size' => 'Ukuran gambar terlalu besar',
                            'is_image' => 'Yang anda pilih bukan gambar',
                            'mime_in' => 'Yang anda pilih bukan gambar',
                        ]
                    ]
                ]);

            if(!$val){
                session()->setFlashdata('err',\Config\Services::validation()->listErrors());
                
                $data = [
                    'judul' => 'Data User',
                    'admin' => $this->model->getAllData()
                ];
                //load View
                tampilan('admin/index', $data);
            }   else{

                    $userid = $this->request->getPost('userid');

                    $data = [
                        'username'          => $this->request->getPost('username'),
                        'email'             => $this->request->getPost('email'),
                        'fullname'             => $this->request->getPost('fullname'),
                        'user_image'             => $this->request->getPost('user_image')
            
                    ];
            
                    //update data
                    $success = $this->model->ubah($data, $userid);
                    if($success){
                        session()->setFlashdata('message',' Diubah');
                        return redirect()->to('/admin');
                    }
            }
        } else{
            return redirect()->to('/admin');
        }
        
    }
}
