<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_ppisatu extends CI_Model
{

    public $table = 'ppi_pertama';
    public $id = 'id';
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
		$this->db->like('id', $q);
		$this->db->or_like('tgl_input', $q);
		$this->db->or_like('nama_pasien', $q);
		$this->db->or_like('tgl_psg_k', $q);
		$this->db->or_like('tgl_lps_k', $q);
		$this->db->or_like('infeksi_satu', $q);
		$this->db->or_like('tgl_psg_in', $q);
		$this->db->or_like('tgl_lps_in', $q);
		$this->db->or_like('infeksi_dua', $q);
		$this->db->or_like('tgl_opr', $q);
		$this->db->or_like('tgl_plg', $q);
		$this->db->or_like('infeksi_tiga', $q);
		$this->db->or_like('tgl_psg_ven', $q);
		$this->db->or_like('tgl_lps_ven', $q);
		$this->db->or_like('infeksi_empat', $q);
		$this->db->or_like('keterangan', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
		$this->db->order_by($this->id, $this->order);
		$this->db->like('id', $q);
		$this->db->or_like('tgl_input', $q);
		$this->db->or_like('nama_pasien', $q);
		$this->db->or_like('tgl_psg_k', $q);
		$this->db->or_like('tgl_lps_k', $q);
		$this->db->or_like('infeksi_satu', $q);
		$this->db->or_like('tgl_psg_in', $q);
		$this->db->or_like('tgl_lps_in', $q);
		$this->db->or_like('infeksi_dua', $q);
		$this->db->or_like('tgl_opr', $q);
		$this->db->or_like('tgl_plg', $q);
		$this->db->or_like('infeksi_tiga', $q);
		$this->db->or_like('tgl_psg_ven', $q);
		$this->db->or_like('tgl_lps_ven', $q);
		$this->db->or_like('infeksi_empat', $q);
		$this->db->or_like('keterangan', $q);
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

