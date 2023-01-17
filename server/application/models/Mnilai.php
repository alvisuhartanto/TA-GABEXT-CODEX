<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mnilai extends CI_Model {

	// buat method untuk tampil data
    function get_data()
    {        
        $this->db->select("
        nim AS nim_dsn,
        kode_mk AS kode_mk_dsn,
        nilai AS nilai_dsn,
        ");
        $this->db->from("tb_nilai");
        $this->db->order_by("nim","DESC");
        
        $query = $this->db->get()->result();
        return $query;        
    }

    // buat fungsi untuk hapus data
    function delete_data($token)
    {
        // cek apakah nim ada/tidak
        $this->db->select("nim");
        $this->db->from("tb_nilai");
        $this->db->where("TO_BASE64(nim) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika nim ditemukan
        if(count($query) == 1)
        {
            // hapus data nilai
            $this->db->where("TO_BASE64(nim) = '$token'");
            $this->db->delete("tb_nilai");
            // kirim nilai hasil = 1
            $hasil = 1;
        }
        // jika nim tidak ditemukan
        else
        {
            // kirim nilai hasil = 0
            $hasil = 0;
        }
        // kirim variabel hasil ke "controller" nilai
        return $hasil;
    }
	
    // buat fungsi untuk simpan data
    function save_data($nim,$kode_mk,$nilai,$token)
    {
        // cek apakah nim ada/tidak
        $this->db->select("nim");
        $this->db->from("tb_nilai");
        $this->db->where("TO_BASE64(nim) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika nim tidak ditemukan
        if(count($query) == 0)
        {
            // isi nilai untuk masing2 field
            $data = array(
                "nim" => $nim,
                "kode_mk" => $kode_mk,
                "nilai" => $nilai,
            );
            // simpan data
            $this->db->insert("tb_nilai",$data);
            $hasil = 0;
        }
        // jika nim ditemukan
        else
        {
            $hasil = 1;
        }

        return $hasil;
    }

    function put_data($nim,$kode_mk,$nilai,$token)
	{
		$this->db->select("nim");;
		$this->db->from("tb_nilai");
		$this->db->where("TO_BASE64(nim) != '$token'AND nim = '$nim'");

		$query = $this->db->get()->result();

		if(count($query) == 0)
		{
			$data = array(
				"nim" => $nim,
                "kode_mk" => $kode_mk,
                "nilai" => $nilai,
			);
			$this->db->where("TO_BASE64(nim) = '$token'");
			$this->db->update("tb_nilai", $data);
			$hasil = 0;
		}
		else
		{
			$hasil = 1;
		}

		return $hasil; 
	}
}

