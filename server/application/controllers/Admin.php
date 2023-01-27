<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";

class Admin extends Server {

	//buat fungsi "GET"
    function service_get()
    {
        // panggil model "Madmin"
        $this->load->model("Madmin","mdl",TRUE);
        // panggil fungsi "get_data"
        $hasil = $this->mdl->get_data();

        $this->response(array("Admin" => $hasil),200);
    }
    //buat fungsi "POST"
    function service_post()
    {
        // panggil model "Madmin"
        $this->load->model("Madmin","mdl",TRUE);
        // ambil parameter data yang akan diisi
        $data = array(
            "kode_admin" => $this->post("kode_admin"),
            "nama" => $this->post("nama"),
            "token" => base64_encode($this->post("kode_admin")),
        );

        // $data["kode_admin"] = $this->post("kode_admin");
        // $data["nama"] = $this->post("nama");

        // $kode_admin = $this->post("kode_admin");
        // $nama = $this->post("nama");

        // panggil method "save_data"
        $hasil = $this->mdl->save_data($data["kode_admin"],$data["nama"],$data["token"]);
        // jika hasil = 0
        if($hasil == 0)
        {
            $this->response(array("status" => "Data admin Berhasil Disimpan"),200);
        }
        // jika hasil != 0
        else
        {
            $this->response(array("status" => "Data admin Gagal Disimpan !"),200);
        }

    }
    //buat fungsi "PUT"
    function service_put()
    {
        $this->load->model("Madmin","mdl",TRUE);
        $data = array(
            "kode_admin" => $this->put("kode_admin"),
            "nama" => $this->put("nama"),
            "token" => base64_encode($this->put("kode_admin")),
        );
        $hasil = $this->mdl->put_data($data["kode_admin"],$data["nama"],$data["token"]);

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
        // panggil model "Madmin"
        $this->load->model("Madmin","mdl",TRUE);
        // ambil paramater token "(kode_admin)"
        $token = $this->delete("kode_admin");
        // panggil fungsi "delete_data"
        $hasil = $this->mdl->delete_data(base64_encode($token));
        // jika proses delete berhasil
        if($hasil == 1)
        {
            $this->response(array("status" => "Data admin Berhasil Dihapus"),200);
        }
        // jika proses delete gagal
        else
        {
            $this->response(array("status" => "Data admin Gagal Dihapus !"),200);
        }   
    }
}
