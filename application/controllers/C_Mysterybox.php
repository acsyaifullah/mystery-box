<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Mysterybox extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Mysterybox', 'mod');
	}

	// START MG --------------------------------------------
	public function index()
	{
		$data['hadiah'] = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah')->result_array();
		$this->load->view('V_Mysterybox', $data);
	}

	public function getHadiah()
	{
		$id 	= $_POST['id'];
		$data	= $this->db->get_where('tb_hadiah', ['idhadiah' => $id])->row();
		echo json_encode($data);
	}

	public function minKuotaMG()
	{
		$id 	= $_POST['id'];
		$this->db->set('jumlah', 'jumlah-1', FALSE)->where('idhadiah', $id)->update('tb_hadiah');
	}

	public function listHadiahMG()
	{
		$data['hadiah'] = $this->db->get('tb_hadiah')->result();
		$this->load->view('V_ListHadiah', $data);
	}

	public function addHadiahMG()
	{
		$config['upload_path']		= './assets/images/hadiah/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar'		=> 'mb.png'];

			$this->mod->addHadiahMG($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$this->mod->addHadiahMG($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah')->result();
		$this->load->view('V_ListHadiah', $data2);
	}

	public function delHadiahMG($id)
	{
		// $id = $_POST['id'];
		$query = $this->db->get_where('tb_hadiah', ['idhadiah' => $id])->row();
		if ($query->gambar != 'mb.png') {
			unlink("./assets/images/hadiah/$query->gambar");
		}

		$this->mod->delHadiahMG($id);

		$data['hadiah'] = $this->db->get('tb_hadiah')->result();
		$this->load->view('V_ListHadiah', $data);
	}
	// END MG --------------------------------------------
	
	// START PTC --------------------------------------------
	public function indexSPM()
	{
		$data['hadiah'] = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah_spm')->result_array();
		$this->load->view('V_MysteryboxSPM', $data);
	}

	public function getHadiahSPM()
	{
		$id 	= $_POST['id'];
		$data	= $this->db->get_where('tb_hadiah_spm', ['idhadiah' => $id])->row();
		echo json_encode($data);
	}

	public function listHadiahSPM()
	{
		echo "Supermall";
	}
	// END PTC --------------------------------------------

	// NAMPILNO HADIAH SEBANYAK KUOTA HADIAH
	// public function index()
	// {
	// 	$query1 = $this->db->get('tb_hadiah')->result_array();

	// 	// $data = [];
	// 	foreach ($query1 as $query) {
	// 		for ($i=0; $i < $query['jumlah']; $i++) {
	// 			$data[] = [
	// 				'idhadiah'	=> $query['idhadiah'],
	// 				'nama'		=> $query['nama_hadiah'],
	// 				'gambar'	=> 'assets/'.$query['gambar']
	// 			];
	// 		}
	// 	}
	// 	$data['hadiah'] = $data;
	// 	// print_r($data);
	// 	$this->load->view('V_Mysterybox', $data);
	// }
}
?>