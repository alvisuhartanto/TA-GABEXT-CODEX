<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmatkul extends CI_Model {

	// buat method untuk tampil data
    function get_data()
    {        
        $this->db->select("
        kode_mk AS kode_mk_mhs,
        nama_mk AS nama_mk_mhs,
        sks AS sks_mhs,
        ");
        $this->db->from("tb_mata_kuliah");
        $this->db->order_by("kode_mk","DESC");
        
        $query = $this->db->get()->result();
        return $query;        
    }

    // buat fungsi untuk hapus data
    function delete_data($token)
    {
        // cek apakah kode_mk ada/tidak
        $this->db->select("kode_mk");
        $this->db->from("tb_mata_kuliah");
        $this->db->where("TO_BASE64(kode_mk) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika kode_mk ditemukan
        if(count($query) == 1)
        {
            // hapus data matkul
            $this->db->where("TO_BASE64(kode_mk) = '$token'");
            $this->db->delete("tb_mata_kuliah");
            // kirim nilai hasil = 1
            $hasil = 1;
        }
        // jika kode_mk tidak ditemukan
        else
        {
            // kirim nilai hasil = 0
            $hasil = 0;
        }
        // kirim variabel hasil ke "controller" matkul
        return $hasil;
    }
	
    // buat fungsi untuk simpan data
    function save_data($kode_mk,$nama_mk,$sks,$token)
    {
        // cek apakah kode_mk ada/tidak
        $this->db->select("kode_mk");
        $this->db->from("tb_mata_kuliah");
        $this->db->where("TO_BASE64(kode_mk) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika kode_mk tidak ditemukan
        if(count($query) == 0)
        {
            // isi nilai untuk masing2 field
            $data = array(
                "kode_mk" => $kode_mk,
                "nama_mk" => $nama_mk,
                "sks" => $sks,
            );
            // simpan data
            $this->db->insert("tb_mata_kuliah",$data);
            $hasil = 0;
        }
        // jika kode_mk ditemukan
        else
        {
            $hasil = 1;
        }

        return $hasil;
    }

    function put_data($kode_mk,$nama_mk,$sks,$token)
	{
		$this->db->select("kode_mk");;
		$this->db->from("tb_mata_kuliah");
		$this->db->where("TO_BASE64(kode_mk) != '$token'AND kode_mk = '$kode_mk'");

		$query = $this->db->get()->result();

		if(count($query) == 0)
		{
			$data = array(
				"kode_mk" => $kode_mk,
                "nama_mk" => $nama_mk,
                "sks" => $sks,
			);
			$this->db->where("TO_BASE64(kode_mk) = '$token'");
			$this->db->update("tb_mata_kuliah", $data);
			$hasil = 0;
		}
		else
		{
			$hasil = 1;
		}

		return $hasil; 
	}
}

