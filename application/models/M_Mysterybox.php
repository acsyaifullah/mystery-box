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

	// HADIAH - SUPERMALL //////////////////////////////////////////////////////
	public function addHadiahSPM($data)
	{
		if ($this->db->insert('tb_hadiah_spm', $data)) {
			return TRUE;
		}
	}

	public function updHadiahSPM($data)
	{
		$this->db->where('idhadiah', $data['idhadiah']);
		$this->db->update('tb_hadiah_spm', $data);
	}

	public function delHadiahSPM($id)
	{
		if ($this->db->delete('tb_hadiah_spm', 'idhadiah = '.$id)) {
			return TRUE;
		}
	}
	// END HADIAH - SUPERMALL //////////////////////////////////////////////////////

	// HADIAH - BILITON //////////////////////////////////////////////////////
	public function addHadiahBLT($data)
	{
		if ($this->db->insert('tb_hadiah_blt', $data)) {
			return TRUE;
		}
	}

	public function updHadiahBLT($data)
	{
		$this->db->where('idhadiah', $data['idhadiah']);
		$this->db->update('tb_hadiah_blt', $data);
	}

	public function delHadiahBLT($id)
	{
		if ($this->db->delete('tb_hadiah_blt', 'idhadiah = '.$id)) {
			return TRUE;
		}
	}
	// END HADIAH - BILITON //////////////////////////////////////////////////////
}
?>