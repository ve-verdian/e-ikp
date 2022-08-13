<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_filter extends CI_Model {
  public function view_by_date($date){
        $this->db->where('DATE(tgl)', $date); // Tambahkan where tanggal nya
        
    return $this->db->get('tb_barang_keluar')->result();// Tampilkan data tb_barang_keluar sesuai tanggal yang diinput oleh user pada filter
  }
    
  public function view_by_month($month, $year){
        $this->db->where('MONTH(tgl)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tgl)', $year); // Tambahkan where tahun
        
    return $this->db->get('tb_barang_keluar')->result(); // Tampilkan data tb_barang_keluar sesuai bulan dan tahun yang diinput oleh user pada filter
  }
    
  public function view_by_year($year){
        $this->db->where('YEAR(tgl)', $year); // Tambahkan where tahun
        
    return $this->db->get('tb_barang_keluar')->result(); // Tampilkan data tb_barang_keluar sesuai tahun yang diinput oleh user pada filter
  }
    
  public function view_all(){
    return $this->db->get('tb_barang_keluar')->result(); // Tampilkan semua data tb_barang_keluar
  }
    
    public function option_tahun(){
        $this->db->select('YEAR(tgl) AS tahun'); // Ambil Tahun dari field tgl
        $this->db->from('tb_barang_keluar'); // select ke tabel tb_barang_keluar
        $this->db->order_by('YEAR(tgl)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tgl)'); // Group berdasarkan tahun pada field tgl
        
        return $this->db->get()->result(); // Ambil data pada tabel tb_barang_keluar sesuai kondisi diatas
    }
}
