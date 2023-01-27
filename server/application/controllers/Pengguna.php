<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";

class Pengguna extends Server {

	//buat fungsi "GET"
    function service_get()
    {
        // panggil model "Mpengguna"
        $this->load->model("Mpengguna","mdl",TRUE);
        // panggil fungsi "get_data"
        $hasil = $this->mdl->get_data();

        $this->response(array("Pengguna" => $hasil),200);
    }
    //buat fungsi "POST"
    function service_post()
    {
        // panggil model "Mpengguna"
        $this->load->model("Mpengguna","mdl",TRUE);
        // ambil parameter data yang akan diisi
        $data = array(
            "username" => $this->post("username"),
            "password" => $this->post("password"),
            "status" => $this->post("status"),
            "npm" => $this->post("npm"),
            "nip" => $this->post("nip"),
            "kode_admin" => $this->post("kode_admin"),
            "token" => base64_encode($this->post("username")),
        );

        // $data["username"] = $this->post("username");
        // $data["password"] = $this->post("password");

        // $username = $this->post("username");
        // $password = $this->post("password");

        // panggil method "save_data"
        $hasil = $this->mdl->save_data($data["username"],$data["password"],$data["status"],$data["npm"],$data["nip"],$data["kode_admin"],$data["token"]);
        // jika hasil = 0
        if($hasil == 0)
        {
            $this->response(array("status" => "Data Pengguna Berhasil Disimpan"),200);
        }
        // jika hasil != 0
        else
        {
            $this->response(array("status" => "Data Pengguna Gagal Disimpan !"),200);
        }

    }
    //buat fungsi "PUT"
    function service_put()
    {
        $this->load->model("Mpengguna","mdl",TRUE);
        $data = array(
            "username" => $this->put("username"),
            "password" => $this->put("password"),
            "status" => $this->put("status"),
            "npm" => $this->put("npm"),
            "nip" => $this->put("nip"),
            "kode_admin" => $this->put("kode_admin"),
            "token" => base64_encode($this->put("username")),
        );
        $hasil = $this->mdl->put_data($data["username"],$data["password"],$data["status"],$data["npm"],$data["nip"],$data["kode_admin"],$data["token"]);

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
        // panggil model "Mpengguna"
        $this->load->model("Mpengguna","mdl",TRUE);
        // ambil paramater token "(username)"
        $token = $this->delete("username");
        // panggil fungsi "delete_data"
        $hasil = $this->mdl->delete_data(base64_encode($token));
        // jika proses delete berhasil
        if($hasil == 1)
        {
            $this->response(array("status" => "Data Pengguna Berhasil Dihapus"),200);
        }
        // jika proses delete gagal
        else
        {
            $this->response(array("status" => "Data Pengguna Gagal Dihapus !"),200);
        }   
    }
}
