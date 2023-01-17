<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mprogram_keahlian extends CI_Model {

	// buat method untuk tampil data
    function get_data()
    {        
        $this->db->select("
        id_pk AS id_pk_aja,
        nama_pk AS nama_pk_aja,
        ");
        $this->db->from("tb_program_keahlian");
        $this->db->order_by("id_pk","DESC");
        
        $query = $this->db->get()->result();
        return $query;        
    }

    // buat fungsi untuk hapus data
    function delete_data($token)
    {
        // cek apakah id_pk ada/tidak
        $this->db->select("id_pk");
        $this->db->from("tb_program_keahlian");
        $this->db->where("TO_BASE64(id_pk) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika id_pk ditemukan
        if(count($query) == 1)
        {
            // hapus data program_keahlian
            $this->db->where("TO_BASE64(id_pk) = '$token'");
            $this->db->delete("tb_program_keahlian");
            // kirim nilai hasil = 1
            $hasil = 1;
        }
        // jika id_pk tidak ditemukan
        else
        {
            // kirim nilai hasil = 0
            $hasil = 0;
        }
        // kirim variabel hasil ke "controller" program_keahlian
        return $hasil;
    }
	
    // buat fungsi untuk simpan data
    function save_data($id_pk,$nama_pk,$token)
    {
        // cek apakah id_pk ada/tidak
        $this->db->select("id_pk");
        $this->db->from("tb_program_keahlian");
        $this->db->where("TO_BASE64(id_pk) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika id_pk tidak ditemukan
        if(count($query) == 0)
        {
            // isi nilai untuk masing2 field
            $data = array(
                "id_pk" => $id_pk,
                "nama_pk" => $nama_pk,
            );
            // simpan data
            $this->db->insert("tb_program_keahlian",$data);
            $hasil = 0;
        }
        // jika id_pk ditemukan
        else
        {
            $hasil = 1;
        }

        return $hasil;
    }

    function put_data($id_pk,$nama_pk,$token)
	{
		$this->db->select("id_pk");;
		$this->db->from("tb_program_keahlian");
		$this->db->where("TO_BASE64(id_pk) != '$token'AND id_pk = '$id_pk'");

		$query = $this->db->get()->result();

		if(count($query) == 0)
		{
			$data = array(
				"id_pk" => $id_pk,
                "nama_pk" => $nama_pk,
			);
			$this->db->where("TO_BASE64(id_pk) = '$token'");
			$this->db->update("tb_program_keahlian", $data);
			$hasil = 0;
		}
		else
		{
			$hasil = 1;
		}

		return $hasil; 
	}
}

