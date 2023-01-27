<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";

class Paket_krs extends Server {

	//buat fungsi "GET"
    function service_get()
    {
        // panggil model "Mpaket_krs"
        $this->load->model("Mpaket_krs","mdl",TRUE);
        // panggil fungsi "get_data"
        $hasil = $this->mdl->get_data();

        $this->response(array("Paket_krs" => $hasil),200);
    }
    //buat fungsi "POST"
    function service_post()
    {
        // panggil model "Mpaket_krs"
        $this->load->model("Mpaket_krs","mdl",TRUE);
        // ambil parameter data yang akan diisi
        $data = array(
            "kode_mk" => $this->post("kode_mk"),
            "nim" => $this->post("nim"),
            "ipk" => $this->post("ipk"),
            "token" => base64_encode($this->post("kode_mk")),
        );

        // $data["kode_mk"] = $this->post("kode_mk");
        // $data["nim"] = $this->post("nim");

        // $kode_mk = $this->post("kode_mk");
        // $nim = $this->post("nim");

        // panggil method "save_data"
        $hasil = $this->mdl->save_data($data["kode_mk"],$data["nim"],$data["ipk"],$data["token"]);
        // jika hasil = 0
        if($hasil == 0)
        {
            $this->response(array("status" => "Data paket_krs Berhasil Disimpan"),200);
        }
        // jika hasil != 0
        else
        {
            $this->response(array("status" => "Data paket_krs Gagal Disimpan !"),200);
        }

    }
    //buat fungsi "PUT"
    function service_put()
    {
        $this->load->model("Mpaket_krs","mdl",TRUE);
        $data = array(
            "kode_mk" => $this->put("kode_mk"),
            "nim" => $this->put("nim"),
            "ipk" => $this->put("ipk"),
            "token" => base64_encode($this->put("kode_mk")),
        );
        $hasil = $this->mdl->put_data($data["kode_mk"],$data["nim"],$data["ipk"],$data["token"]);

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
        // panggil model "Mpaket_krs"
        $this->load->model("Mpaket_krs","mdl",TRUE);
        // ambil paramater token "(kode_mk)"
        $token = $this->delete("kode_mk");
        // panggil fungsi "delete_data"
        $hasil = $this->mdl->delete_data(base64_encode($token));
        // jika proses delete berhasil
        if($hasil == 1)
        {
            $this->response(array("status" => "Data paket_krs Berhasil Dihapus"),200);
        }
        // jika proses delete gagal
        else
        {
            $this->response(array("status" => "Data paket_krs Gagal Dihapus !"),200);
        }   
    }
}
