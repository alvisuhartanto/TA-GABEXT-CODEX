<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";

class Detail_Dosen extends Server {

	//buat fungsi "GET"
    function service_get()
    {
        // panggil model "MDetail_Dosen"
        $this->load->model("MDetail_Dosen","mdl",TRUE);
        // panggil fungsi "get_data"
        $hasil = $this->mdl->get_data();

        $this->response(array("Detail_Dosen" => $hasil),200);
    }
    //buat fungsi "POST"
    function service_post()
    {
        // panggil model "MDetail_Dosen"
        $this->load->model("MDetail_Dosen","mdl",TRUE);
        // ambil parameter data yang akan diisi
        $data = array(
            "NIP" => $this->post("NIP"),
            "kode_mk" => $this->post("kode_mk"),
            "jam_mengajar" => $this->post("jam_mengajar"),
            "token" => base64_encode($this->post("kode_mk")),
        );

        // $data["NIP"] = $this->post("NIP");
        // $data["kode_mk"] = $this->post("kode_mk");

        // $NIP = $this->post("NIP");
        // $kode_mk = $this->post("kode_mk");

        // panggil method "save_data"
        $hasil = $this->mdl->save_data($data["NIP"],$data["kode_mk"],$data["jam_mengajar"],$data["token"]);
        // jika hasil = 0
        if($hasil == 0)
        {
            $this->response(array("status" => "Data Detail_Dosen Berhasil Disimpan"),200);
        }
        // jika hasil != 0
        else
        {
            $this->response(array("status" => "Data Detail_Dosen Gagal Disimpan !"),200);
        }

    }
    //buat fungsi "PUT"
    function service_put()
    {
        $this->load->model("MDetail_Dosen","mdl",TRUE);
        $data = array(
            "NIP" => $this->put("NIP"),
            "kode_mk" => $this->put("kode_mk"),
            "jam_mengajar" => $this->put("jam_mengajar"),
            "token" => base64_encode($this->put("kode_mk")),
        );
        $hasil = $this->mdl->put_data($data["NIP"],$data["kode_mk"],$data["jam_mengajar"],$data["token"]);

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
        // panggil model "MDetail_Dosen"
        $this->load->model("MDetail_Dosen","mdl",TRUE);
        // ambil paramater token "(NIP)"
        $token = $this->delete("kode_mk");
        // panggil fungsi "delete_data"
        $hasil = $this->mdl->delete_data(base64_encode($token));
        // jika proses delete berhasil
        if($hasil == 1)
        {
            $this->response(array("status" => "Data Detail_Dosen Berhasil Dihapus"),200);
        }
        // jika proses delete gagal
        else
        {
            $this->response(array("status" => "Data Detail_Dosen Gagal Dihapus !"),200);
        }   
    }
}
