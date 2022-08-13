<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_pc extends CI_Model
{

    public $table = 'tb_pc';
    public $id = 'id_pc';
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
		$this->db->like('id_pc', $q);
		$this->db->or_like('tgl_input', $q);
		$this->db->or_like('divisi', $q);
		$this->db->or_like('hostname', $q);
		$this->db->or_like('user', $q);
		$this->db->or_like('jenis', $q);
		$this->db->or_like('hard_disk', $q);
		$this->db->or_like('ram', $q);
		$this->db->or_like('processor', $q);
		$this->db->or_like('os', $q);
		$this->db->or_like('ip_address', $q);
		$this->db->or_like('lokasi', $q);
		$this->db->or_like('internet', $q);
		$this->db->or_like('lokal', $q);
		$this->db->or_like('simrs', $q);
		$this->db->or_like('status', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
		$this->db->order_by($this->id, $this->order);
		$this->db->like('id_pc', $q);
		$this->db->or_like('tgl_input', $q);
		$this->db->or_like('divisi', $q);
		$this->db->or_like('hostname', $q);
		$this->db->or_like('user', $q);
		$this->db->or_like('jenis', $q);
		$this->db->or_like('hard_disk', $q);
		$this->db->or_like('ram', $q);
		$this->db->or_like('processor', $q);
		$this->db->or_like('os', $q);
		$this->db->or_like('ip_address', $q);
		$this->db->or_like('lokasi', $q);
		$this->db->or_like('internet', $q);
		$this->db->or_like('lokal', $q);
		$this->db->or_like('simrs', $q);
		$this->db->or_like('status', $q);
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

