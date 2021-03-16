<?php  

class M_Mysterybox extends CI_Model
{
	public function  __construct()
	{
		parent::__construct();
	}

	// HADIAH - MANYAR GARDEN //////////////////////////////////////////////////////
	public function addHadiahMG($data)
	{
		if ($this->db->insert('tb_hadiah', $data)) {
			return TRUE;
		}
	}

	public function updHadiahMG($data)
	{
		$this->db->where('idhadiah', $data['idhadiah']);
		$this->db->update('tb_hadiah', $data);
	}

	public function delHadiahMG($id)
	{
		if ($this->db->delete('tb_hadiah', 'idhadiah = '.$id)) {
			return TRUE;
		}
	}
	// END HADIAH - MANYAR GARDEN //////////////////////////////////////////////////////
}
?>