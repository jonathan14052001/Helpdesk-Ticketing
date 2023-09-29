<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Authgroup;

class Pic extends BaseController{
    
    public function __construct()
        {
            $this->model = new M_Authgroup;
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
            'authgroup' => $this->model->getAllData()
            //localhost:8080/pic/page_?
            // 'pic' => $this->model->paginate('10', 'pic'),
            // 'pager' => $this->model->pager
        ];
        //load View
        tampilan('authgroup/index', $data); 
    }
}