<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";

class Nilai extends Server {

	//buat fungsi "GET"
    function service_get()
    {
        // panggil model "Mnilai"
        $this->load->model("Mnilai","mdl",TRUE);
        // panggil fungsi "get_data"
        $hasil = $this->mdl->get_data();

        $this->response(array("Nilai" => $hasil),200);
    }
    //buat fungsi "POST"
    function service_post()
    {
        // panggil model "Mnilai"
        $this->load->model("Mnilai","mdl",TRUE);
        // ambil parameter data yang akan diisi
        $data = array(
            "nim" => $this->post("nim"),
            "kode_mk" => $this->post("kode_mk"),
            "nilai" => $this->post("nilai"),
            "token" => base64_encode($this->post("nim")),
        );

        // $data["nim"] = $this->post("nim");
        // $data["kode_mk"] = $this->post("kode_mk");

        // $nim = $this->post("nim");
        // $kode_mk = $this->post("kode_mk");

        // panggil method "save_data"
        $hasil = $this->mdl->save_data($data["nim"],$data["kode_mk"],$data["nilai"],$data["token"]);
        // jika hasil = 0
        if($hasil == 0)
        {
            $this->response(array("status" => "Data Nilai Berhasil Disimpan"),200);
        }
        // jika hasil != 0
        else
        {
            $this->response(array("status" => "Data Nilai Gagal Disimpan !"),200);
        }

    }
    //buat fungsi "PUT"
    function service_put()
    {
        $this->load->model("Mnilai","mdl",TRUE);
        $data = array(
            "nim" => $this->put("nim"),
            "kode_mk" => $this->put("kode_mk"),
            "nilai" => $this->put("nilai"),
            "token" => base64_encode($this->put("nim")),
        );
        $hasil = $this->mdl->put_data($data["nim"],$data["kode_mk"],$data["nilai"],$data["token"]);

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
        // panggil model "Mnilai"
        $this->load->model("Mnilai","mdl",TRUE);
        // ambil paramater token "(nim)"
        $token = $this->delete("nim");
        // panggil fungsi "delete_data"
        $hasil = $this->mdl->delete_data(base64_encode($token));
        // jika proses delete berhasil
        if($hasil == 1)
        {
            $this->response(array("status" => "Data Nilai Berhasil Dihapus"),200);
        }
        // jika proses delete gagal
        else
        {
            $this->response(array("status" => "Data Nilai Gagal Dihapus !"),200);
        }   
    }
}
