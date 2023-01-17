<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";

class Perogram_Keahlian extends Server {

	//buat fungsi "GET"
    function service_get()
    {
        // panggil model "Mprogram_keahlian"
        $this->load->model("Mprogram_keahlian","mdl",TRUE);
        // panggil fungsi "get_data"
        $hasil = $this->mdl->get_data();

        $this->response(array("Perogram_Keahlian" => $hasil),200);
    }
    //buat fungsi "POST"
    function service_post()
    {
        // panggil model "Mprogram_keahlian"
        $this->load->model("Mprogram_keahlian","mdl",TRUE);
        // ambil parameter data yang akan diisi
        $data = array(
            "id_pk" => $this->post("id_pk"),
            "nama_pk" => $this->post("nama_pk"),
            "token" => base64_encode($this->post("id_pk")),
        );

        // $data["id_pk"] = $this->post("id_pk");
        // $data["nama_pk"] = $this->post("nama_pk");

        // $id_pk = $this->post("id_pk");
        // $nama_pk = $this->post("nama_pk");

        // panggil method "save_data"
        $hasil = $this->mdl->save_data($data["id_pk"],$data["nama_pk"],$data["token"]);
        // jika hasil = 0
        if($hasil == 0)
        {
            $this->response(array("status" => "Data Perogram_Keahlian Berhasil Disimpan"),200);
        }
        // jika hasil != 0
        else
        {
            $this->response(array("status" => "Data Perogram_Keahlian Gagal Disimpan !"),200);
        }

    }
    //buat fungsi "PUT"
    function service_put()
    {
        $this->load->model("Mprogram_keahlian","mdl",TRUE);
        $data = array(
            "id_pk" => $this->put("id_pk"),
            "nama_pk" => $this->put("nama_pk"),
            "token" => base64_encode($this->put("id_pk")),
        );
        $hasil = $this->mdl->put_data($data["id_pk"],$data["nama_pk"],$data["token"]);

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
        // panggil model "Mprogram_keahlian"
        $this->load->model("Mprogram_keahlian","mdl",TRUE);
        // ambil paramater token "(id_pk)"
        $token = $this->delete("id_pk");
        // panggil fungsi "delete_data"
        $hasil = $this->mdl->delete_data(base64_encode($token));
        // jika proses delete berhasil
        if($hasil == 1)
        {
            $this->response(array("status" => "Data Perogram_Keahlian Berhasil Dihapus"),200);
        }
        // jika proses delete gagal
        else
        {
            $this->response(array("status" => "Data Perogram_Keahlian Gagal Dihapus !"),200);
        }   
    }
}
