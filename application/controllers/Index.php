<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends Ci_controller
{
	public function __construct(){
		parent::__construct();		
		$this->load->model('Cek_model');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function ambilData()
	{
		if($this->input->is_ajax_request()){
			$key = $this->input->post('keyword');
			if ($post = $this->Cek_model->ambilData($where=" WHERE id_produk = '$key'")){
				$data = array('respon' => 'success', 'post' => $post);
			}else{
				$data = array('respon' => 'error', 'message' => 'Gagal mengambil data Produk');
				var_dump($data);
				die();
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function null_404()
	{
		$this->load->view('404');
	}

	function autocomplete(){
		if ( isset($_GET['search']) ) {
			$search_key = $_GET['search'];
			$cari = $this->Cek_model->cari_produk($search_key)->num_rows();
			$result = $this->Cek_model->cari_produk($search_key)->result_array();

			if ($cari == 0) {
				echo "<div>Not Found</div>";

			}else {
				$bold_keyword = '<strong>'.$search_key.'</strong>';
				foreach ($result as $key => $value) {
					echo "<div class=\"show_result\" onclick=\"showData('".$value['id_produk']."','".$value['barcode']."');\"><span>".str_ireplace($search_key, $bold_keyword, $value['id_produk'])." </span> | Merek : ".$value['nama_produk']." <span> </span></div>";
				}
			}
		}
	}

}
