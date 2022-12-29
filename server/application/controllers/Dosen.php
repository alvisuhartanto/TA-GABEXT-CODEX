<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";

class Dosen extends Server {

	//buat fungsi "GET"
    function service_get()
    {
        // panggil model "MDosen"
        $this->load->model("Mdosen","mdl",TRUE);
        // panggil fungsi "get_data"
        $hasil = $this->mdl->get_data();

        $this->response(array("Dosen" => $hasil),200);
    }
    //buat fungsi "POST"
    function service_post()
    {
        // panggil model "MDosen"
        $this->load->model("Mdosen","mdl",TRUE);
        // ambil parameter data yang akan diisi
        $data = array(
            "nip" => $this->post("nip"),
            "nama" => $this->post("nama"),
            "kode_dosen" => $this->post("kode_dosen"),
            "token" => base64_encode($this->post("nip")),
        );

        // $data["nip"] = $this->post("nip");
        // $data["nama"] = $this->post("nama");

        // $nip = $this->post("nip");
        // $nama = $this->post("nama");

        // panggil method "save_data"
        $hasil = $this->mdl->save_data($data["nip"],$data["nama"],$data["kode_dosen"],$data["token"]);
        // jika hasil = 0
        if($hasil == 0)
        {
            $this->response(array("status" => "Data Dosen Berhasil Disimpan"),200);
        }
        // jika hasil != 0
        else
        {
            $this->response(array("status" => "Data Dosen Gagal Disimpan !"),200);
        }

    }
    //buat fungsi "PUT"
    function service_put()
    {
        $this->load->model("Mdosen","mdl",TRUE);
        $data = array(
            "nip" => $this->put("nip"),
            "nama" => $this->put("nama"),
            "kode_dosen" => $this->put("kode_dosen"),
            "token" => base64_encode($this->put("nip")),
        );
        $hasil = $this->mdl->put_data($data["nip"],$data["nama"],$data["kode_dosen"],$data["token"]);

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
        // panggil model "MDosen"
        $this->load->model("Mdosen","mdl",TRUE);
        // ambil paramater token "(nip)"
        $token = $this->delete("nip");
        // panggil fungsi "delete_data"
        $hasil = $this->mdl->delete_data(base64_encode($token));
        // jika proses delete berhasil
        if($hasil == 1)
        {
            $this->response(array("status" => "Data Dosen Berhasil Dihapus"),200);
        }
        // jika proses delete gagal
        else
        {
            $this->response(array("status" => "Data Dosen Gagal Dihapus !"),200);
        }   
    }
}
