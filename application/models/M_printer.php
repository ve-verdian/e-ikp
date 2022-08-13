<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_printer extends CI_Model
{

    public $table = 'tb_printer';
    public $id = 'id_printer';
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
		$this->db->like('id_printer', $q);
		$this->db->or_like('tgl_input', $q);
		$this->db->or_like('kategori', $q);
		$this->db->or_like('merk', $q);
		$this->db->or_like('type', $q);
		$this->db->or_like('serial_number', $q);
		$this->db->or_like('qty_out', $q);
		$this->db->or_like('capacity', $q);
		$this->db->or_like('keterangan', $q);
		$this->db->or_like('warna', $q);
		$this->db->or_like('pengguna', $q);
		$this->db->or_like('lokasi', $q);
		$this->db->or_like('backup', $q);
		$this->db->or_like('kepemilikan', $q);
		$this->db->or_like('posisi_skg', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
		$this->db->order_by($this->id, $this->order);
		$this->db->like('id_printer', $q);
		$this->db->or_like('tgl_input', $q);
		$this->db->or_like('kategori', $q);
		$this->db->or_like('merk', $q);
		$this->db->or_like('type', $q);
		$this->db->or_like('serial_number', $q);
		$this->db->or_like('qty_out', $q);
		$this->db->or_like('capacity', $q);
		$this->db->or_like('keterangan', $q);
		$this->db->or_like('warna', $q);
		$this->db->or_like('pengguna', $q);
		$this->db->or_like('lokasi', $q);
		$this->db->or_like('backup', $q);
		$this->db->or_like('kepemilikan', $q);
		$this->db->or_like('posisi_skg', $q);
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

