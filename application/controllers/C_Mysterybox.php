<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Mysterybox extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Mysterybox', 'mod');
	}

	public function indexTTS()
	{
		$this->load->view('V_TTS');
	}
	public function tts1()
	{
		$this->load->view('tts1');
	}
	public function tts2()
	{
		$this->load->view('tts2');
	}
	public function tts3()
	{
		$this->load->view('tts3');
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
			// $newhadiah = $this->db->limit(4)->order_by('idhadiah', 'RANDOM')->get('tb_hadiah')->result_array();
			$newhadiah = [];
			for($i=0;$i<4;$i++) {
					if (isset($hadiah[$i])) {
						$newhadiah[] = $hadiah[$i];
					}else{
						$newhadiah[] = [
							'idhadiah'	=> 999,
							'nama'		=> "",
							'jumlah'	=> 0
						];
					}
			}

			shuffle($newhadiah);
		}

		$data['hadiah'] = $newhadiah;

		$this->load->view('V_Mysterybox', $data);
	}

	public function getHadiah()
	{
		$id 	= $_POST['id'];
		$data = [];
		if ($id == 999) {
			$status = 0;
		}else{
			$data	= $this->db->get_where('tb_hadiah', ['idhadiah' => $id])->row();
			$status = 1;
		}
		
		echo json_encode([
			'status' => $status,
			'data' => $data
			]);
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
		$query1 = $this->db->get('tb_hadiah_spm')->result_array();

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
			$newhadiah = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah_spm')->result_array();
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
		$query1 = $this->db->get('tb_hadiah_blt')->result_array();

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
			$newhadiah = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah_blt')->result_array();
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
		$query1 = $this->db->get('tb_hadiah_ngy')->result_array();

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
			$newhadiah = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah_ngy')->result_array();
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

	// START ALS --------------------------------------------
	public function indexALS()
	{
		$query1 = $this->db->get('tb_hadiah_als')->result_array();

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
			$newhadiah = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah_als')->result_array();
		}

		$data['hadiah'] = $newhadiah;

		$this->load->view('V_MysteryboxALS', $data);
	}

	public function getHadiahALS()
	{
		$id 	= $_POST['id'];
		$data	= $this->db->get_where('tb_hadiah_als', ['idhadiah' => $id])->row();
		echo json_encode($data);
	}

	public function minKuotaALS()
	{
		$id 	= $_POST['id'];
		$this->db->set('jumlah', 'jumlah-1', FALSE)->where('idhadiah', $id)->update('tb_hadiah_als');
	}

	public function listHadiahALS()
	{
		$data['hadiah'] = $this->db->get('tb_hadiah_als')->result();
		$this->load->view('V_ListHadiahALS', $data);
	}

	public function addHadiahALS()
	{
		$config['upload_path']		= './assets/images/hadiah/ALS/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar'		=> 'mb.png'];

			$this->mod->addHadiahALS($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$this->mod->addHadiahALS($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_als')->result();
		$this->load->view('V_ListHadiahALS', $data2);
	}

	public function updHadiahALS()
	{
		$config['upload_path']		= './assets/images/hadiah/ALS/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah']];

			$this->mod->updHadiahALS($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$query = $this->db->where('idhadiah', $data['idhadiah'])->get('tb_hadiah_als')->row();
			if ($query->gambar != 'mb.png') {
				unlink("./assets/images/hadiah/ALS/$query->gambar");
			}

			$this->mod->updHadiahALS($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_als')->result();
		$this->load->view('V_ListHadiahALS', $data2);
	}

	public function delHadiahALS($id)
	{
		$query = $this->db->get_where('tb_hadiah_als', ['idhadiah' => $id])->row();
		if ($query->gambar != 'mb.png') {
			unlink("./assets/images/hadiah/ALS/$query->gambar");
		}

		$this->mod->delHadiahALS($id);

		$data['hadiah'] = $this->db->get('tb_hadiah_als')->result();
		redirect('/C_Mysterybox/listHadiahALS');
	}
	// END ALS --------------------------------------------

	// START PLM --------------------------------------------
	public function indexPLM()
	{
		$query1 = $this->db->get('tb_hadiah_plm')->result_array();

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
			$newhadiah = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah_plm')->result_array();
		}

		$data['hadiah'] = $newhadiah;

		$this->load->view('V_MysteryboxPLM', $data);
	}

	public function getHadiahPLM()
	{
		$id 	= $_POST['id'];
		$data	= $this->db->get_where('tb_hadiah_plm', ['idhadiah' => $id])->row();
		echo json_encode($data);
	}

	public function minKuotaPLM()
	{
		$id 	= $_POST['id'];
		$this->db->set('jumlah', 'jumlah-1', FALSE)->where('idhadiah', $id)->update('tb_hadiah_plm');
	}

	public function listHadiahPLM()
	{
		$data['hadiah'] = $this->db->get('tb_hadiah_plm')->result();
		$this->load->view('V_ListHadiahPLM', $data);
	}

	public function addHadiahPLM()
	{
		$config['upload_path']		= './assets/images/hadiah/PLM/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar'		=> 'mb.png'];

			$this->mod->addHadiahPLM($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$this->mod->addHadiahPLM($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_plm')->result();
		$this->load->view('V_ListHadiahPLM', $data2);
	}

	public function updHadiahPLM()
	{
		$config['upload_path']		= './assets/images/hadiah/PLM/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah']];

			$this->mod->updHadiahPLM($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$query = $this->db->where('idhadiah', $data['idhadiah'])->get('tb_hadiah_plm')->row();
			if ($query->gambar != 'mb.png') {
				unlink("./assets/images/hadiah/PLM/$query->gambar");
			}

			$this->mod->updHadiahPLM($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_plm')->result();
		$this->load->view('V_ListHadiahPLM', $data2);
	}

	public function delHadiahPLM($id)
	{
		$query = $this->db->get_where('tb_hadiah_plm', ['idhadiah' => $id])->row();
		if ($query->gambar != 'mb.png') {
			unlink("./assets/images/hadiah/PLM/$query->gambar");
		}

		$this->mod->delHadiahPLM($id);

		$data['hadiah'] = $this->db->get('tb_hadiah_plm')->result();
		redirect('/C_Mysterybox/listHadiahPLM');
	}
	// END PLM --------------------------------------------

	// START KDR --------------------------------------------
	public function indexKDR()
	{
		$query1 = $this->db->get('tb_hadiah_kdr')->result_array();

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
			$newhadiah = [];
			for($i=0;$i<4;$i++) {
					if (isset($hadiah[$i])) {
						$newhadiah[] = $hadiah[$i];
					}else{
						$newhadiah[] = [
							'idhadiah'	=> 999,
							'nama'		=> "",
							'jumlah'	=> 0
						];
					}
			}

			shuffle($newhadiah);
		}

		$data['hadiah'] = $newhadiah;

		$this->load->view('V_MysteryboxKDR', $data);
	}

	public function getHadiahKDR()
	{
		$id 	= $_POST['id'];
		$data = [];
		if ($id == 999) {
			$status = 0;
		}else{
			$data	= $this->db->get_where('tb_hadiah_kdr', ['idhadiah' => $id])->row();
			$status = 1;
		}
		
		echo json_encode([
			'status' => $status,
			'data' => $data
			]);
	}

	public function minKuotaKDR()
	{
		$id 	= $_POST['id'];
		$this->db->set('jumlah', 'jumlah-1', FALSE)->where('idhadiah', $id)->update('tb_hadiah_kdr');
	}

	public function listHadiahKDR()
	{
		$data['hadiah'] = $this->db->get('tb_hadiah_kdr')->result();
		$this->load->view('V_ListHadiahKDR', $data);
	}

	public function addHadiahKDR()
	{
		$config['upload_path']		= './assets/images/hadiah/KDR/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar'		=> 'mb.png'];

			$this->mod->addHadiahKDR($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$this->mod->addHadiahKDR($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_kdr')->result();
		$this->load->view('V_ListHadiahKDR', $data2);
	}

	public function updHadiahKDR()
	{
		$config['upload_path']		= './assets/images/hadiah/KDR/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah']];

			$this->mod->updHadiahKDR($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$query = $this->db->where('idhadiah', $data['idhadiah'])->get('tb_hadiah_kdr')->row();
			if ($query->gambar != 'mb.png') {
				unlink("./assets/images/hadiah/KDR/$query->gambar");
			}

			$this->mod->updHadiahKDR($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_kdr')->result();
		$this->load->view('V_ListHadiahKDR', $data2);
	}

	public function delHadiahKDR($id)
	{
		$query = $this->db->get_where('tb_hadiah_kdr', ['idhadiah' => $id])->row();
		if ($query->gambar != 'mb.png') {
			unlink("./assets/images/hadiah/KDR/$query->gambar");
		}

		$this->mod->delHadiahKDR($id);

		$data['hadiah'] = $this->db->get('tb_hadiah_kdr')->result();
		redirect('/C_Mysterybox/listHadiahKDR');
	}
	// END KDR --------------------------------------------

	// START SMG --------------------------------------------
	public function indexSMG()
	{
		$query1 = $this->db->get('tb_hadiah_smg')->result_array();

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
			$newhadiah = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah_smg')->result_array();
		}

		$data['hadiah'] = $newhadiah;

		$this->load->view('V_MysteryboxSMG', $data);
	}

	public function getHadiahSMG()
	{
		$id 	= $_POST['id'];
		$data	= $this->db->get_where('tb_hadiah_smg', ['idhadiah' => $id])->row();
		echo json_encode($data);
	}

	public function minKuotaSMG()
	{
		$id 	= $_POST['id'];
		$this->db->set('jumlah', 'jumlah-1', FALSE)->where('idhadiah', $id)->update('tb_hadiah_smg');
	}

	public function listHadiahSMG()
	{
		$data['hadiah'] = $this->db->get('tb_hadiah_smg')->result();
		$this->load->view('V_ListHadiahSMG', $data);
	}

	public function addHadiahSMG()
	{
		$config['upload_path']		= './assets/images/hadiah/SMG/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar'		=> 'mb.png'];

			$this->mod->addHadiahSMG($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$this->mod->addHadiahSMG($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_smg')->result();
		$this->load->view('V_ListHadiahSMG', $data2);
	}

	public function updHadiahSMG()
	{
		$config['upload_path']		= './assets/images/hadiah/SMG/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah']];

			$this->mod->updHadiahSMG($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$query = $this->db->where('idhadiah', $data['idhadiah'])->get('tb_hadiah_smg')->row();
			if ($query->gambar != 'mb.png') {
				unlink("./assets/images/hadiah/SMG/$query->gambar");
			}

			$this->mod->updHadiahSMG($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_smg')->result();
		$this->load->view('V_ListHadiahSMG', $data2);
	}

	public function delHadiahSMG($id)
	{
		$query = $this->db->get_where('tb_hadiah_smg', ['idhadiah' => $id])->row();
		if ($query->gambar != 'mb.png') {
			unlink("./assets/images/hadiah/SMG/$query->gambar");
		}

		$this->mod->delHadiahSMG($id);

		$data['hadiah'] = $this->db->get('tb_hadiah_smg')->result();
		redirect('/C_Mysterybox/listHadiahSMG');
	}
	// END SMG --------------------------------------------

	// START PDM --------------------------------------------
	public function indexPDM()
	{
		$query1 = $this->db->get('tb_hadiah_pdm')->result_array();

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
			$newhadiah = $this->db->order_by('idhadiah', 'RANDOM')->get('tb_hadiah_pdm')->result_array();
		}

		$data['hadiah'] = $newhadiah;

		$this->load->view('V_MysteryboxPDM', $data);
	}

	public function getHadiahPDM()
	{
		$id 	= $_POST['id'];
		$data	= $this->db->get_where('tb_hadiah_pdm', ['idhadiah' => $id])->row();
		echo json_encode($data);
	}

	public function minKuotaPDM()
	{
		$id 	= $_POST['id'];
		$this->db->set('jumlah', 'jumlah-1', FALSE)->where('idhadiah', $id)->update('tb_hadiah_pdm');
	}

	public function listHadiahPDM()
	{
		$data['hadiah'] = $this->db->get('tb_hadiah_pdm')->result();
		$this->load->view('V_ListHadiahPDM', $data);
	}

	public function addHadiahPDM()
	{
		$config['upload_path']		= './assets/images/hadiah/PDM/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar'		=> 'mb.png'];

			$this->mod->addHadiahPDM($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$this->mod->addHadiahPDM($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_pdm')->result();
		$this->load->view('V_ListHadiahPDM', $data2);
	}

	public function updHadiahPDM()
	{
		$config['upload_path']		= './assets/images/hadiah/PDM/';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		// $config['encrypt_name'] 	= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah'	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah']];

			$this->mod->updHadiahPDM($data);
		} else {
			$gambar = ['gambar' => $this->upload->data()];

			$data = ['idhadiah'		=> $_POST['idhadiah'],
					'nama_hadiah' 	=> $_POST['nama_hadiah'],
					'jumlah' 		=> $_POST['jumlah'],
					'gambar' 		=> $gambar['gambar']['file_name']];

			$query = $this->db->where('idhadiah', $data['idhadiah'])->get('tb_hadiah_pdm')->row();
			if ($query->gambar != 'mb.png') {
				unlink("./assets/images/hadiah/PDM/$query->gambar");
			}

			$this->mod->updHadiahPDM($data);
		}

		$data2['hadiah'] = $this->db->get('tb_hadiah_pdm')->result();
		$this->load->view('V_ListHadiahPDM', $data2);
	}

	public function delHadiahPDM($id)
	{
		$query = $this->db->get_where('tb_hadiah_pdm', ['idhadiah' => $id])->row();
		if ($query->gambar != 'mb.png') {
			unlink("./assets/images/hadiah/PDM/$query->gambar");
		}

		$this->mod->delHadiahPDM($id);

		$data['hadiah'] = $this->db->get('tb_hadiah_pdm')->result();
		redirect('/C_Mysterybox/listHadiahPDM');
	}
	// END PDM --------------------------------------------

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