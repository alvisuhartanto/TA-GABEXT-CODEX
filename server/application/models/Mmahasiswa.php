<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmahasiswa extends CI_Model {

	// buat method untuk tampil data
    function get_data()
    {        
        $this->db->select("id AS id_mhs,
        npm AS npm_mhs,
        nama AS nama_mhs,
        jenis_kelamin AS jenis_kelamin_mhs,
        tanggal_lahir AS tanggal_lahir_mhs,
        id_pk AS id_pk_mhs,
        Semester AS Semester_mhs,
        alamat AS alamat_mhs
        ");
        $this->db->from("tb_mahasiswa");
        $this->db->order_by("npm","DESC");
        
        $query = $this->db->get()->result();
        return $query;        
    }

    // buat fungsi untuk hapus data
    function delete_data($token)
    {
        // cek apakah npm ada/tidak
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika npm ditemukan
        if(count($query) == 1)
        {
            // hapus data mahasiswa
            $this->db->where("TO_BASE64(npm) = '$token'");
            $this->db->delete("tb_mahasiswa");
            // kirim nilai hasil = 1
            $hasil = 1;
        }
        // jika npm tidak ditemukan
        else
        {
            // kirim nilai hasil = 0
            $hasil = 0;
        }
        // kirim variabel hasil ke "controller" Mahasiswa
        return $hasil;
    }
	
    // buat fungsi untuk simpan data
    function save_data($npm,$nama,$jenis_kelamin,$tanggal_lahir,$id_pk,$Semester,$alamat,$token)
    {
        // cek apakah npm ada/tidak
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();        
        // jika npm tidak ditemukan
        if(count($query) == 0)
        {
            // isi nilai untuk masing2 field
            $data = array(
                "npm" => $npm,
                "nama" => $nama,
                "jenis_kelamin" => $jenis_kelamin,
                "tanggal_lahir" => $tanggal_lahir,
                "id_pk" => $id_pk,
                "Semester" => $Semester,
                "alamat" => $alamat
            );
            // simpan data
            $this->db->insert("tb_mahasiswa",$data);
            $hasil = 0;
        }
        // jika npm ditemukan
        else
        {
            $hasil = 1;
        }

        return $hasil;
    }

    function put_data($npm,$nama,$jenis_kelamin,$tanggal_lahir,$id_pk,$Semester,$alamat,$token)
	{
		$this->db->select("npm");;
		$this->db->from("tb_mahasiswa");
		$this->db->where("TO_BASE64(npm) != '$token'AND npm = '$npm'");

		$query = $this->db->get()->result();

		if(count($query) == 0)
		{
			$data = array(
				"npm" => $npm,
                "nama" => $nama,
                "jenis_kelamin" => $jenis_kelamin,
                "tanggal_lahir" => $tanggal_lahir,
                "id_pk" => $id_pk,
                "Semester" => $Semester,
                "alamat" => $alamat
			);
			$this->db->where("TO_BASE64(npm) = '$token'");
			$this->db->update("tb_mahasiswa", $data);
			$hasil = 0;
		}
		else
		{
			$hasil = 1;
		}

		return $hasil; 
	}
}

