<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";

class Mahasiswa extends Server {

	//buat fungsi "GET"
    function service_get()
    {
        // panggil model "Mmahasiswa"
        $this->load->model("Mmahasiswa","mdl",TRUE);
        // panggil fungsi "get_data"
        $hasil = $this->mdl->get_data();

        $this->response(array("mahasiswa" => $hasil),200);
    }
    //buat fungsi "POST"
    function service_post()
    {
        // panggil model "Mmahasiswa"
        $this->load->model("Mmahasiswa","mdl",TRUE);
        // ambil parameter data yang akan diisi
        $data = array(
            "npm" => $this->post("npm"),
            "nama" => $this->post("nama"),
            "jenis_kelamin" => $this->post("jenis_kelamin"),
            "tanggal_lahir" => $this->post("tanggal_lahir"),
            "id_pk" => $this->post("id_pk"),
            "Semester" => $this->post("Semester"),
            "alamat" => $this->post("alamat"),
            "token" => base64_encode($this->post("npm")),
        );

        // $data["npm"] = $this->post("npm");
        // $data["nama"] = $this->post("nama");

        // $npm = $this->post("npm");
        // $nama = $this->post("nama");

        // panggil method "save_data"
        $hasil = $this->mdl->save_data($data["npm"],$data["nama"],$data["jenis_kelamin"],$data["tanggal_lahir"],$data["id_pk"],$data["Semester"],$data["alamat"],$data["token"]);
        // jika hasil = 0
        if($hasil == 0)
        {
            $this->response(array("status" => "Data Mahasiswa Berhasil Disimpan"),200);
        }
        // jika hasil != 0
        else
        {
            $this->response(array("status" => "Data Mahasiswa Gagal Disimpan !"),200);
        }

    }
    //buat fungsi "PUT"
    function service_put()
    {
        $this->load->model("Mmahasiswa","mdl",TRUE);
        $data = array(
            "npm" => $this->put("npm"),
            "nama" => $this->put("nama"),
            "jenis_kelamin" => $this->put("jenis_kelamin"),
            "tanggal_lahir" => $this->put("tanggal_lahir"),
            "id_pk" => $this->put("id_pk"),
            "Semester" => $this->put("Semester"),
            "alamat" => $this->put("alamat"),
            "token" => base64_encode($this->put("npm")),
        );
        $hasil = $this->mdl->put_data($data["npm"],$data["nama"],$data["jenis_kelamin"],$data["tanggal_lahir"],$data["id_pk"],$data["Semester"],$data["alamat"],$data["token"]);

        if($hasil == 0)
        {
            $this->response(array("status" => "Data Berhasil Diubah"), 200);
        }
        else
        {
            $this->response(array("status" => "Data Gagal Diubah"), 200);
        }
    }
    //buat fungsi "DELETE"
    function service_delete()
    {
        // panggil model "Mmahasiswa"
        $this->load->model("Mmahasiswa","mdl",TRUE);
        // ambil paramater token "(npm)"
        $token = $this->delete("npm");
        // panggil fungsi "delete_data"
        $hasil = $this->mdl->delete_data(base64_encode($token));
        // jika proses delete berhasil
        if($hasil == 1)
        {
            $this->response(array("status" => "Data Mahasiswa Berhasil Dihapus"),200);
        }
        // jika proses delete gagal
        else
        {
            $this->response(array("status" => "Data Mahasiswa Gagal Dihapus !"),200);
        }   
    }
}
