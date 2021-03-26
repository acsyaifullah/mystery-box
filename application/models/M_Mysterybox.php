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

	// HADIAH - NGY //////////////////////////////////////////////////////
	public function addHadiahNGY($data)
	{
		if ($this->db->insert('tb_hadiah_ngy', $data)) {
			return TRUE;
		}
	}

	public function updHadiahNGY($data)
	{
		$this->db->where('idhadiah', $data['idhadiah']);
		$this->db->update('tb_hadiah_ngy', $data);
	}

	public function delHadiahNGY($id)
	{
		if ($this->db->delete('tb_hadiah_ngy', 'idhadiah = '.$id)) {
			return TRUE;
		}
	}
	// END HADIAH - NGY //////////////////////////////////////////////////////

	// HADIAH - ALS //////////////////////////////////////////////////////
	public function addHadiahALS($data)
	{
		if ($this->db->insert('tb_hadiah_als', $data)) {
			return TRUE;
		}
	}

	public function updHadiahALS($data)
	{
		$this->db->where('idhadiah', $data['idhadiah']);
		$this->db->update('tb_hadiah_als', $data);
	}

	public function delHadiahALS($id)
	{
		if ($this->db->delete('tb_hadiah_als', 'idhadiah = '.$id)) {
			return TRUE;
		}
	}
	// END HADIAH - ALS //////////////////////////////////////////////////////

	// HADIAH - PLM //////////////////////////////////////////////////////
	public function addHadiahPLM($data)
	{
		if ($this->db->insert('tb_hadiah_plm', $data)) {
			return TRUE;
		}
	}

	public function updHadiahPLM($data)
	{
		$this->db->where('idhadiah', $data['idhadiah']);
		$this->db->update('tb_hadiah_plm', $data);
	}

	public function delHadiahPLM($id)
	{
		if ($this->db->delete('tb_hadiah_plm', 'idhadiah = '.$id)) {
			return TRUE;
		}
	}
	// END HADIAH - PLM //////////////////////////////////////////////////////

	// HADIAH - KDR //////////////////////////////////////////////////////
	public function addHadiahKDR($data)
	{
		if ($this->db->insert('tb_hadiah_kdr', $data)) {
			return TRUE;
		}
	}

	public function updHadiahKDR($data)
	{
		$this->db->where('idhadiah', $data['idhadiah']);
		$this->db->update('tb_hadiah_kdr', $data);
	}

	public function delHadiahKDR($id)
	{
		if ($this->db->delete('tb_hadiah_kdr', 'idhadiah = '.$id)) {
			return TRUE;
		}
	}
	// END HADIAH - KDR //////////////////////////////////////////////////////

	// HADIAH - SMG //////////////////////////////////////////////////////
	public function addHadiahSMG($data)
	{
		if ($this->db->insert('tb_hadiah_smg', $data)) {
			return TRUE;
		}
	}

	public function updHadiahSMG($data)
	{
		$this->db->where('idhadiah', $data['idhadiah']);
		$this->db->update('tb_hadiah_smg', $data);
	}

	public function delHadiahSMG($id)
	{
		if ($this->db->delete('tb_hadiah_smg', 'idhadiah = '.$id)) {
			return TRUE;
		}
	}
	// END HADIAH - SMG //////////////////////////////////////////////////////

	// HADIAH - PDM //////////////////////////////////////////////////////
	public function addHadiahPDM($data)
	{
		if ($this->db->insert('tb_hadiah_pdm', $data)) {
			return TRUE;
		}
	}

	public function updHadiahPDM($data)
	{
		$this->db->where('idhadiah', $data['idhadiah']);
		$this->db->update('tb_hadiah_pdm', $data);
	}

	public function delHadiahPDM($id)
	{
		if ($this->db->delete('tb_hadiah_pdm', 'idhadiah = '.$id)) {
			return TRUE;
		}
	}
	// END HADIAH - PDM //////////////////////////////////////////////////////
}
?>