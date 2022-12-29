<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdosen extends CI_Model {

	// buat method untuk tampil data
    function get_data()
    {        
        $this->db->select("
        nip AS nip_dsn,
        nama AS nama_dsn,
        kode_dosen AS kode_dosen_dsn,
        ");
        $this->db->from("tb_dosen");
        $this->db->order_by("nip","DESC");
        
        $query = $this->db->get()->result();
        return $query;        
    }

    // buat fungsi untuk hapus data
    function delete_data($token)
    {
        // cek apakah nip ada/tidak
        $this->db->select("nip");
        $this->db->from("tb_dosen");
        $this->db->where("TO_BASE64(nip) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika nip ditemukan
        if(count($query) == 1)
        {
            // hapus data dosen
            $this->db->where("TO_BASE64(nip) = '$token'");
            $this->db->delete("tb_dosen");
            // kirim nilai hasil = 1
            $hasil = 1;
        }
        // jika nip tidak ditemukan
        else
        {
            // kirim nilai hasil = 0
            $hasil = 0;
        }
        // kirim variabel hasil ke "controller" dosen
        return $hasil;
    }
	
    // buat fungsi untuk simpan data
    function save_data($nip,$nama,$kode_dosen,$token)
    {
        // cek apakah nip ada/tidak
        $this->db->select("nip");
        $this->db->from("tb_dosen");
        $this->db->where("TO_BASE64(nip) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika nip tidak ditemukan
        if(count($query) == 0)
        {
            // isi nilai untuk masing2 field
            $data = array(
                "nip" => $nip,
                "nama" => $nama,
                "kode_dosen" => $kode_dosen,
            );
            // simpan data
            $this->db->insert("tb_dosen",$data);
            $hasil = 0;
        }
        // jika nip ditemukan
        else
        {
            $hasil = 1;
        }

        return $hasil;
    }

    function put_data($nip,$nama,$kode_dosen,$token)
	{
		$this->db->select("nip");;
		$this->db->from("tb_dosen");
		$this->db->where("TO_BASE64(nip) != '$token'AND nip = '$nip'");

		$query = $this->db->get()->result();

		if(count($query) == 0)
		{
			$data = array(
				"nip" => $nip,
                "nama" => $nama,
                "kode_dosen" => $kode_dosen,
			);
			$this->db->where("TO_BASE64(nip) = '$token'");
			$this->db->update("tb_dosen", $data);
			$hasil = 0;
		}
		else
		{
			$hasil = 1;
		}

		return $hasil; 
	}
}

