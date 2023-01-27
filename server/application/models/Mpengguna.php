<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpengguna extends CI_Model {

	// buat method untuk tampil data
    function get_data()
    {        
        $this->db->select("
        username AS username_pengguna,
        password AS password_pengguna,
        status AS status_pengguna,
        npm AS npm_pengguna,
        nip AS nip_pengguna,
        kode_admin AS kode_admin_pengguna,
        ");
        $this->db->from("tb_pengguna");
        $this->db->order_by("username","DESC");
        
        $query = $this->db->get()->result();
        return $query;        
    }

    // buat fungsi untuk hapus data
    function delete_data($token)
    {
        // cek apakah username ada/tusernameak
        $this->db->select("username");
        $this->db->from("tb_pengguna");
        $this->db->where("TO_BASE64(username) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika username ditemukan
        if(count($query) == 1)
        {
            // hapus data pengguna
            $this->db->where("TO_BASE64(username) = '$token'");
            $this->db->delete("tb_pengguna");
            // kirim nilai hasil = 1
            $hasil = 1;
        }
        // jika username tusernameak ditemukan
        else
        {
            // kirim nilai hasil = 0
            $hasil = 0;
        }
        // kirim variabel hasil ke "controller" pengguna
        return $hasil;
    }
	
    // buat fungsi untuk simpan data
    function save_data($username,$password,$status,$npm,$nip,$kode_admin,$token)
    {
        // cek apakah username ada/tusernameak
        $this->db->select("username");
        $this->db->from("tb_pengguna");
        $this->db->where("TO_BASE64(username) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika username tusernameak ditemukan
        if(count($query) == 0)
        {
            // isi nilai untuk masing2 field
            $data = array(
                "username" => $username,
                "password" => $password,
                "status" => $status,
                "npm" => $npm,
                "nip" => $nip,
                "kode_admin" => $kode_admin,
            );
            // simpan data
            $this->db->insert("tb_pengguna",$data);
            $hasil = 0;
        }
        // jika username ditemukan
        else
        {
            $hasil = 1;
        }

        return $hasil;
    }

    function put_data($username,$password,$status,$npm,$nip,$kode_admin,$token)
	{
		$this->db->select("username");;
		$this->db->from("tb_pengguna");
		$this->db->where("TO_BASE64(username) != '$token'AND username = '$username'");

		$query = $this->db->get()->result();

		if(count($query) == 0)
		{
			$data = array(
                "username" => $username,
                "password" => $password,
                "status" => $status,
                "npm" => $npm,
                "nip" => $nip,
                "kode_admin" => $kode_admin,
			);
			$this->db->where("TO_BASE64(username) = '$token'");
			$this->db->update("tb_pengguna", $data);
			$hasil = 0;
		}
		else
		{
			$hasil = 1;
		}

		return $hasil; 
	}
}

