<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Mysterybox extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Mysterybox', 'mod');
	}

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
	// 	print_r($data);
	// 	$this->load->view('V_Mysterybox', $data);
	// }
}
?>