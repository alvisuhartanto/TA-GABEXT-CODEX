<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdetail_dosen extends CI_Model {

	// buat method untuk tampil data
    function get_data()
    {        
        $this->db->select("
        NIP AS NIP_dsn,
        kode_mk AS kode_mk_dsn,
        jam_mengajar AS jam_mengajar_dsn,
        ");
        $this->db->from("tb_detail_dosen");
        $this->db->order_by("kode_mk","DESC");
        
        $query = $this->db->get()->result();
        return $query;        
    }

    // buat fungsi untuk hapus data
    function delete_data($token)
    {
        // cek apakah NIP ada/tidak
        $this->db->select("kode_mk");
        $this->db->from("tb_detail_dosen");
        $this->db->where("TO_BASE64(kode_mk) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika NIP ditemukan
        if(count($query) == 1)
        {
            // hapus data detail_dosen
            $this->db->where("TO_BASE64(kode_mk) = '$token'");
            $this->db->delete("tb_detail_dosen");
            // kirim nilai hasil = 1
            $hasil = 1;
        }
        // jika NIP tidak ditemukan
        else
        {
            // kirim nilai hasil = 0
            $hasil = 0;
        }
        // kirim variabel hasil ke "controller" detail_dosen
        return $hasil;
    }
	
    // buat fungsi untuk simpan data
    function save_data($NIP,$kode_mk,$jam_mengajar,$token)
    {
        // cek apakah kode_mk ada/tidak
        $this->db->select("kode_mk");
        $this->db->from("tb_detail_dosen");
        $this->db->where("TO_BASE64(kode_mk) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika kode_mk tidak ditemukan
        if(count($query) == 0)
        {
            // isi nilai untuk masing2 field
            $data = array(
                "NIP" => $NIP,
                "kode_mk" => $kode_mk,
                "jam_mengajar" => $jam_mengajar,
            );
            // simpan data
            $this->db->insert("tb_detail_dosen",$data);
            $hasil = 0;
        }
        // jika kode_mk ditemukan
        else
        {
            $hasil = 1;
        }

        return $hasil;
    }

    function put_data($NIP,$kode_mk,$jam_mengajar,$token)
	{
		$this->db->select("kode_mk");;
		$this->db->from("tb_detail_dosen");
		$this->db->where("TO_BASE64(kode_mk) != '$token'AND NIP = '$NIP'");

		$query = $this->db->get()->result();

		if(count($query) == 0)
		{
			$data = array(
				"NIP" => $NIP,
                "kode_mk" => $kode_mk,
                "jam_mengajar" => $jam_mengajar,
			);
			$this->db->where("TO_BASE64(kode_mk) = '$token'");
			$this->db->update("tb_detail_dosen", $data);
			$hasil = 0;
		}
		else
		{
			$hasil = 1;
		}

		return $hasil; 
	}
}

