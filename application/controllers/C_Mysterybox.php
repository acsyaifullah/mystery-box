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
		// $data['hadiah'] = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah')->result_array();
		// $this->load->view('V_Mysterybox', $data);
		$query1 = $this->db->get('tb_hadiah')->result_array();

		$hadiah = [];
		foreach ($query1 as $query) {
			for ($i=0; $i < $query['jumlah']; $i++) {
				$hadiah[] = [
					'idhadiah'	=> $query['idhadiah'],
					'nama'		=> $query['nama_hadiah'],
					'gambar'	=> 'assets/'.$query['gambar']
				];
			}
		}
		if (count($hadiah) > 3) {
			shuffle($hadiah);
			$newhadiah = [];
			for($i=0;$i<4;$i++) {
					$newhadiah[] = $hadiah[$i];
			}
		} else {
			// $newhadiah = $hadiah;
			$newhadiah = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah')->result_array();
		}

		$data['hadiah'] = $newhadiah;

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

	public function updHadiahMG()
	{
		$config['upload_path']		= './assets/images/hadiah/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah']];

			$this->mod->updHadiahMG($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$query = $this->db->where('idhadiah', $data['idhadiah'])->get('tb_hadiah')->row();
			if ($query->gambar != 'mb.png') {
				unlink("./assets/images/hadiah/$query->gambar");
			}

			$this->mod->updHadiahMG($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah')->result();
		$this->load->view('V_ListHadiah', $data2);
	}

	public function delHadiahMG($id)
	{
		$query = $this->db->get_where('tb_hadiah', ['idhadiah' => $id])->row();
		if ($query->gambar != 'mb.png') {
			unlink("./assets/images/hadiah/$query->gambar");
		}

		$this->mod->delHadiahMG($id);

		$data['hadiah'] = $this->db->get('tb_hadiah')->result();
		redirect('/C_Mysterybox/listHadiahMG');
	}
	// END MG --------------------------------------------
	
	// START SPM --------------------------------------------
	public function indexSPM()
	{
		$query1 = $this->db->get('tb_hadiah')->result_array();

		$hadiah = [];
		foreach ($query1 as $query) {
			for ($i=0; $i < $query['jumlah']; $i++) {
				$hadiah[] = [
					'idhadiah'	=> $query['idhadiah'],
					'nama'		=> $query['nama_hadiah'],
					'gambar'	=> 'assets/'.$query['gambar']
				];
			}
		}
		if (count($hadiah) > 3) {
			shuffle($hadiah);
			$newhadiah = [];
			for($i=0;$i<4;$i++) {
					$newhadiah[] = $hadiah[$i];
			}
		} else {
			// $newhadiah = $hadiah;
			$newhadiah = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah')->result_array();
		}

		$data['hadiah'] = $newhadiah;

		$this->load->view('V_MysteryboxSPM', $data);
	}

	public function getHadiahSPM()
	{
		$id 	= $_POST['id'];
		$data	= $this->db->get_where('tb_hadiah_spm', ['idhadiah' => $id])->row();
		echo json_encode($data);
	}

	public function minKuotaSPM()
	{
		$id 	= $_POST['id'];
		$this->db->set('jumlah', 'jumlah-1', FALSE)->where('idhadiah', $id)->update('tb_hadiah_spm');
	}

	public function listHadiahSPM()
	{
		$data['hadiah'] = $this->db->get('tb_hadiah_spm')->result();
		$this->load->view('V_ListHadiahSPM', $data);
	}

	public function addHadiahSPM()
	{
		$config['upload_path']		= './assets/images/hadiah/SPM/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar'		=> 'mb.png'];

			$this->mod->addHadiahSPM($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$this->mod->addHadiahSPM($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_spm')->result();
		$this->load->view('V_ListHadiahSPM', $data2);
	}

	public function updHadiahSPM()
	{
		$config['upload_path']		= './assets/images/hadiah/SPM/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah']];

			$this->mod->updHadiahSPM($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$query = $this->db->where('idhadiah', $data['idhadiah'])->get('tb_hadiah_spm')->row();
			if ($query->gambar != 'mb.png') {
				unlink("./assets/images/hadiah/SPM/$query->gambar");
			}

			$this->mod->updHadiahSPM($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_spm')->result();
		$this->load->view('V_ListHadiahSPM', $data2);
	}

	public function delHadiahSPM($id)
	{
		$query = $this->db->get_where('tb_hadiah_spm', ['idhadiah' => $id])->row();
		if ($query->gambar != 'mb.png') {
			unlink("./assets/images/hadiah/SPM/$query->gambar");
		}

		$this->mod->delHadiahSPM($id);

		$data['hadiah'] = $this->db->get('tb_hadiah_spm')->result();
		redirect('/C_Mysterybox/listHadiahSPM');
	}
	// END SPM --------------------------------------------

	// START BLT --------------------------------------------
	public function indexBLT()
	{
		$query1 = $this->db->get('tb_hadiah')->result_array();

		$hadiah = [];
		foreach ($query1 as $query) {
			for ($i=0; $i < $query['jumlah']; $i++) {
				$hadiah[] = [
					'idhadiah'	=> $query['idhadiah'],
					'nama'		=> $query['nama_hadiah'],
					'gambar'	=> 'assets/'.$query['gambar']
				];
			}
		}
		if (count($hadiah) > 3) {
			shuffle($hadiah);
			$newhadiah = [];
			for($i=0;$i<4;$i++) {
					$newhadiah[] = $hadiah[$i];
			}
		} else {
			// $newhadiah = $hadiah;
			$newhadiah = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah')->result_array();
		}

		$data['hadiah'] = $newhadiah;

		$this->load->view('V_MysteryboxBLT', $data);
	}

	public function getHadiahBLT()
	{
		$id 	= $_POST['id'];
		$data	= $this->db->get_where('tb_hadiah_blt', ['idhadiah' => $id])->row();
		echo json_encode($data);
	}

	public function minKuotaBLT()
	{
		$id 	= $_POST['id'];
		$this->db->set('jumlah', 'jumlah-1', FALSE)->where('idhadiah', $id)->update('tb_hadiah_blt');
	}

	public function listHadiahBLT()
	{
		$data['hadiah'] = $this->db->get('tb_hadiah_blt')->result();
		$this->load->view('V_ListHadiahBLT', $data);
	}

	public function addHadiahBLT()
	{
		$config['upload_path']		= './assets/images/hadiah/BLT/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar'		=> 'mb.png'];

			$this->mod->addHadiahBLT($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$this->mod->addHadiahBLT($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_blt')->result();
		$this->load->view('V_ListHadiahBLT', $data2);
	}

	public function updHadiahBLT()
	{
		$config['upload_path']		= './assets/images/hadiah/BLT/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah']];

			$this->mod->updHadiahBLT($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$query = $this->db->where('idhadiah', $data['idhadiah'])->get('tb_hadiah_blt')->row();
			if ($query->gambar != 'mb.png') {
				unlink("./assets/images/hadiah/BLT/$query->gambar");
			}

			$this->mod->updHadiahBLT($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_blt')->result();
		$this->load->view('V_ListHadiahBLT', $data2);
	}

	public function delHadiahBLT($id)
	{
		$query = $this->db->get_where('tb_hadiah_blt', ['idhadiah' => $id])->row();
		if ($query->gambar != 'mb.png') {
			unlink("./assets/images/hadiah/BLT/$query->gambar");
		}

		$this->mod->delHadiahBLT($id);

		$data['hadiah'] = $this->db->get('tb_hadiah_blt')->result();
		redirect('/C_Mysterybox/listHadiahBLT');
	}
	// END BLT --------------------------------------------

	// START NGY --------------------------------------------
	public function indexNGY()
	{
		$query1 = $this->db->get('tb_hadiah')->result_array();

		$hadiah = [];
		foreach ($query1 as $query) {
			for ($i=0; $i < $query['jumlah']; $i++) {
				$hadiah[] = [
					'idhadiah'	=> $query['idhadiah'],
					'nama'		=> $query['nama_hadiah'],
					'gambar'	=> 'assets/'.$query['gambar']
				];
			}
		}
		if (count($hadiah) > 3) {
			shuffle($hadiah);
			$newhadiah = [];
			for($i=0;$i<4;$i++) {
					$newhadiah[] = $hadiah[$i];
			}
		} else {
			// $newhadiah = $hadiah;
			$newhadiah = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah')->result_array();
		}

		$data['hadiah'] = $newhadiah;

		$this->load->view('V_MysteryboxNGY', $data);
	}

	public function getHadiahNGY()
	{
		$id 	= $_POST['id'];
		$data	= $this->db->get_where('tb_hadiah_ngy', ['idhadiah' => $id])->row();
		echo json_encode($data);
	}

	public function minKuotaNGY()
	{
		$id 	= $_POST['id'];
		$this->db->set('jumlah', 'jumlah-1', FALSE)->where('idhadiah', $id)->update('tb_hadiah_ngy');
	}

	public function listHadiahNGY()
	{
		$data['hadiah'] = $this->db->get('tb_hadiah_ngy')->result();
		$this->load->view('V_ListHadiahNGY', $data);
	}

	public function addHadiahNGY()
	{
		$config['upload_path']		= './assets/images/hadiah/NGY/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar'		=> 'mb.png'];

			$this->mod->addHadiahNGY($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$this->mod->addHadiahNGY($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_ngy')->result();
		$this->load->view('V_ListHadiahNGY', $data2);
	}

	public function updHadiahNGY()
	{
		$config['upload_path']		= './assets/images/hadiah/NGY/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah']];

			$this->mod->updHadiahNGY($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$query = $this->db->where('idhadiah', $data['idhadiah'])->get('tb_hadiah_ngy')->row();
			if ($query->gambar != 'mb.png') {
				unlink("./assets/images/hadiah/NGY/$query->gambar");
			}

			$this->mod->updHadiahNGY($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_ngy')->result();
		$this->load->view('V_ListHadiahNGY', $data2);
	}

	public function delHadiahNGY($id)
	{
		$query = $this->db->get_where('tb_hadiah_ngy', ['idhadiah' => $id])->row();
		if ($query->gambar != 'mb.png') {
			unlink("./assets/images/hadiah/NGY/$query->gambar");
		}

		$this->mod->delHadiahNGY($id);

		$data['hadiah'] = $this->db->get('tb_hadiah_ngy')->result();
		redirect('/C_Mysterybox/listHadiahNGY');
	}
	// END NGY --------------------------------------------

	// NAMPILNO HADIAH SEBANYAK KUOTA HADIAH DAN RANDOM -----/ COBA COBA
	// public function index()
	// {
	// 	$query1 = $this->db->get('tb_hadiah')->result_array();

	// 	$hadiah = [];
	// 	foreach ($query1 as $query) {
	// 		for ($i=0; $i < $query['jumlah']; $i++) {
	// 			$hadiah[] = [
	// 				'idhadiah'	=> $query['idhadiah'],
	// 				'nama'		=> $query['nama_hadiah'],
	// 				'gambar'	=> 'assets/'.$query['gambar']
	// 			];
	// 		}
	// 	}
	// 	if (count($hadiah) > 3) {
	// 		shuffle($hadiah);
	// 		$newhadiah = [];
	// 		for($i=0;$i<4;$i++) {
	// 				$newhadiah[] = $hadiah[$i];
	// 		}
	// 	} else {
	// 		// $newhadiah = $hadiah;
	// 		$newhadiah = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah')->result_array();
	// 	}

	// 	$data['hadiah'] = $newhadiah;

	// 	$this->load->view('V_Mysterybox', $data);

		// $query1 = $this->db->get('tb_hadiah')->result_array();

		// $hadiah = [];
		// foreach ($query1 as $query) {
		// 	for ($i=0; $i < $query['jumlah']; $i++) {
		// 		$hadiah[] = [
		// 			'idhadiah'	=> $query['idhadiah'],
		// 			'nama'		=> $query['nama_hadiah'],
		// 			'gambar'	=> 'assets/'.$query['gambar']
		// 		];
		// 	}
		// }
		// shuffle($hadiah);
		// $data['hadiah'] = $hadiah;
		// print_r($data);
		// $this->load->view('V_Mysterybox', $data);
	// }
}
?>