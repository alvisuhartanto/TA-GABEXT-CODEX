<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";

class Matkul extends Server {

	//buat fungsi "GET"
    function service_get()
    {
        // panggil model "Mmatkul"
        $this->load->model("Mmatkul","mdl",TRUE);
        // panggil fungsi "get_data"
        $hasil = $this->mdl->get_data();

        $this->response(array("matkul" => $hasil),200);
    }
    //buat fungsi "POST"
    function service_post()
    {
        // panggil model "Mmatkul"
        $this->load->model("Mmatkul","mdl",TRUE);
        // ambil parameter data yang akan diisi
        $data = array(
            "kode_mk" => $this->post("kode_mk"),
            "nama_mk" => $this->post("nama_mk"),
            "sks" => $this->post("sks"),
            "token" => base64_encode($this->post("kode_mk")),
        );

        // $data["kode_mk"] = $this->post("kode_mk");
        // $data["nama_mk"] = $this->post("nama_mk");

        // $kode_mk = $this->post("kode_mk");
        // $nama_mk = $this->post("nama_mk");

        // panggil method "save_data"
        $hasil = $this->mdl->save_data($data["kode_mk"],$data["nama_mk"],$data["sks"],$data["token"]);
        // jika hasil = 0
        if($hasil == 0)
        {
            $this->response(array("status" => "Data matkul Berhasil Disimpan"),200);
        }
        // jika hasil != 0
        else
        {
            $this->response(array("status" => "Data matkul Gagal Disimpan !"),200);
        }

    }
    //buat fungsi "PUT"
    function service_put()
    {
        $this->load->model("Mmatkul","mdl",TRUE);
        $data = array(
            "kode_mk" => $this->put("kode_mk"),
            "nama_mk" => $this->put("nama_mk"),
            "sks" => $this->put("sks"),
            "token" => base64_encode($this->put("kode_mk")),
        );
        $hasil = $this->mdl->put_data($data["kode_mk"],$data["nama_mk"],$data["sks"],$data["token"]);

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
        // panggil model "Mmatkul"
        $this->load->model("Mmatkul","mdl",TRUE);
        // ambil paramater token "(kode_mk)"
        $token = $this->delete("kode_mk");
        // panggil fungsi "delete_data"
        $hasil = $this->mdl->delete_data(base64_encode($token));
        // jika proses delete berhasil
        if($hasil == 1)
        {
            $this->response(array("status" => "Data matkul Berhasil Dihapus"),200);
        }
        // jika proses delete gagal
        else
        {
            $this->response(array("status" => "Data matkul Gagal Dihapus !"),200);
        }   
    }
}
