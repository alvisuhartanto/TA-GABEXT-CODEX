<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpaket_krs extends CI_Model {

	// buat method untuk tampil data
    function get_data()
    {        
        $this->db->select("
        kode_mk AS kode_mk_mhs,
        npm AS npm_mhs,
        ipk AS ipk_mhs,
        ");
        $this->db->from("tb_paket_krs");
        $this->db->order_by("kode_mk","DESC");
        
        $query = $this->db->get()->result();
        return $query;        
    }

    // buat fungsi untuk hapus data
    function delete_data($token)
    {
        // cek apakah kode_mk ada/tidak
        $this->db->select("kode_mk");
        $this->db->from("tb_paket_krs");
        $this->db->where("TO_BASE64(kode_mk) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika kode_mk ditemukan
        if(count($query) == 1)
        {
            // hapus data matkul
            $this->db->where("TO_BASE64(kode_mk) = '$token'");
            $this->db->delete("tb_paket_krs");
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
    function save_data($kode_mk,$npm,$ipk,$token)
    {
        // cek apakah kode_mk ada/tidak
        $this->db->select("kode_mk");
        $this->db->from("tb_paket_krs");
        $this->db->where("TO_BASE64(kode_mk) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika kode_mk tidak ditemukan
        if(count($query) == 0)
        {
            // isi nilai untuk masing2 field
            $data = array(
                "kode_mk" => $kode_mk,
                "npm" => $npm,
                "ipk" => $ipk,
            );
            // simpan data
            $this->db->insert("tb_paket_krs",$data);
            $hasil = 0;
        }
        // jika kode_mk ditemukan
        else
        {
            $hasil = 1;
        }

        return $hasil;
    }

    function put_data($kode_mk,$npm,$ipk,$token)
	{
		$this->db->select("kode_mk");;
		$this->db->from("tb_paket_krs");
		$this->db->where("TO_BASE64(kode_mk) != '$token'AND kode_mk = '$kode_mk'");

		$query = $this->db->get()->result();

		if(count($query) == 0)
		{
			$data = array(
				"kode_mk" => $kode_mk,
                "npm" => $npm,
                "ipk" => $ipk,
			);
			$this->db->where("TO_BASE64(kode_mk) = '$token'");
			$this->db->update("tb_paket_krs", $data);
			$hasil = 0;
		}
		else
		{
			$hasil = 1;
		}

		return $hasil; 
	}
}

