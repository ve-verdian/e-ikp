<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_ikp extends CI_Model
{

    public $table = 'tb_ikp';
    public $id = 'id_ikp';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
		$this->db->like('id_ikp', $q);
		$this->db->or_like('nama', $q);
		$this->db->or_like('no_mr', $q);
		$this->db->or_like('ruangan', $q);
		$this->db->or_like('umur', $q);
		$this->db->or_like('biaya', $q);
		$this->db->or_like('jk', $q);
		$this->db->or_like('tanggal_1', $q);
		$this->db->or_like('waktu_1', $q);
		$this->db->or_like('tanggal_2', $q);
		$this->db->or_like('waktu_2', $q);
		$this->db->or_like('insiden', $q);
		$this->db->or_like('kronologi', $q);
		$this->db->or_like('jns_insiden', $q);
		$this->db->or_like('ins_tjd', $q);
		$this->db->or_like('dampak', $q);
		$this->db->or_like('probalitas', $q);
		$this->db->or_like('pelapor', $q);
        $this->db->or_like('ins_pas', $q);
		$this->db->or_like('tempat', $q);
		$this->db->or_like('unit_terkait', $q);
		$this->db->or_like('tindaklanjut', $q);
		$this->db->or_like('stlh_dilaku', $q);
		$this->db->or_like('prnh_tjd', $q);
		$this->db->or_like('no_ulang', $q);
		$this->db->or_like('petugas', $q);
		$this->db->or_like('karu', $q);
		$this->db->or_like('kmrkp', $q);
		$this->db->or_like('direktur', $q);
		$this->db->or_like('grad_res', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
		$this->db->order_by($this->id, $this->order);
		$this->db->like('id_ikp', $q);
		$this->db->or_like('nama', $q);
		$this->db->or_like('no_mr', $q);
		$this->db->or_like('ruangan', $q);
		$this->db->or_like('umur', $q);
		$this->db->or_like('biaya', $q);
		$this->db->or_like('jk', $q);
		$this->db->or_like('tanggal_1', $q);
		$this->db->or_like('waktu_1', $q);
		$this->db->or_like('tanggal_2', $q);
		$this->db->or_like('waktu_2', $q);
		$this->db->or_like('insiden', $q);
		$this->db->or_like('kronologi', $q);
		$this->db->or_like('jns_insiden', $q);
		$this->db->or_like('ins_tjd', $q);
		$this->db->or_like('dampak', $q);
		$this->db->or_like('probalitas', $q);
		$this->db->or_like('pelapor', $q);
        $this->db->or_like('ins_pas', $q);
		$this->db->or_like('tempat', $q);
		$this->db->or_like('unit_terkait', $q);
		$this->db->or_like('tindaklanjut', $q);
		$this->db->or_like('stlh_dilaku', $q);
		$this->db->or_like('prnh_tjd', $q);
		$this->db->or_like('no_ulang', $q);
		$this->db->or_like('petugas', $q);
		$this->db->or_like('karu', $q);
		$this->db->or_like('kmrkp', $q);
		$this->db->or_like('direktur', $q);
		$this->db->or_like('grad_res', $q);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
	
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

