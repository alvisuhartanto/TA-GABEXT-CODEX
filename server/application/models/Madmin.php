<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Madmin extends CI_Model {

	// buat method untuk tampil data
    function get_data()
    {        
        $this->db->select("
        kode_admin AS kode_admin_aja,
        nama AS nama_aja,
        ");
        $this->db->from("tb_admin");
        $this->db->order_by("kode_admin","DESC");
        
        $query = $this->db->get()->result();
        return $query;        
    }

    // buat fungsi untuk hapus data
    function delete_data($token)
    {
        // cek apakah kode_admin ada/tidak
        $this->db->select("kode_admin");
        $this->db->from("tb_admin");
        $this->db->where("TO_BASE64(kode_admin) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika kode_admin ditemukan
        if(count($query) == 1)
        {
            // hapus data admin
            $this->db->where("TO_BASE64(kode_admin) = '$token'");
            $this->db->delete("tb_admin");
            // kirim nilai hasil = 1
            $hasil = 1;
        }
        // jika kode_admin tidak ditemukan
        else
        {
            // kirim nilai hasil = 0
            $hasil = 0;
        }
        // kirim variabel hasil ke "controller" admin
        return $hasil;
    }
	
    // buat fungsi untuk simpan data
    function save_data($kode_admin,$nama,$token)
    {
        // cek apakah kode_admin ada/tidak
        $this->db->select("kode_admin");
        $this->db->from("tb_admin");
        $this->db->where("TO_BASE64(kode_admin) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika kode_admin tidak ditemukan
        if(count($query) == 0)
        {
            // isi nilai untuk masing2 field
            $data = array(
                "kode_admin" => $kode_admin,
                "nama" => $nama,
            );
            // simpan data
            $this->db->insert("tb_admin",$data);
            $hasil = 0;
        }
        // jika kode_admin ditemukan
        else
        {
            $hasil = 1;
        }

        return $hasil;
    }

    function put_data($kode_admin,$nama,$token)
	{
		$this->db->select("kode_admin");;
		$this->db->from("tb_admin");
		$this->db->where("TO_BASE64(kode_admin) != '$token'AND kode_admin = '$kode_admin'");

		$query = $this->db->get()->result();

		if(count($query) == 0)
		{
			$data = array(
				"kode_admin" => $kode_admin,
                "nama" => $nama,
			);
			$this->db->where("TO_BASE64(kode_admin) = '$token'");
			$this->db->update("tb_admin", $data);
			$hasil = 0;
		}
		else
		{
			$hasil = 1;
		}

		return $hasil; 
	}
}

