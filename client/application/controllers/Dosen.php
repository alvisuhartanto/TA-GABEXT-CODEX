<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {
	public function index()
	{
		$data["tampil"] = json_decode
		($this->client->simple_get(APIDOSEN));

		$this->load->view('Data_dosen',$data);
	}
	function setDelete()
	{
		$json = file_get_contents("php://input");
		$hasil = json_decode($json);

		$delete = json_decode($this->client->simple_delete(APIDOSEN, array("nip" => $hasil -> nipnya)));
        
		echo json_encode(array("statusnya" => $delete -> status));
	}

	function add()
	{
		$this->load->view('en_dosen');
	}

	function setSave()
	{
		// baca nilai dari fetch
		$data = array (
			"nip" => $this->input->post("nipnya"),
			"nama" => $this->input->post("namanya"),
			"kode_dosen" => $this->input->post("kode_dosenya"),
			"token" => $this->input->post("nipnya")
		);
		 $save = json_decode($this->client->simple_post(APIDOSEN, $data));

		 echo json_encode(array("statusnya" => $save -> status));
	}
	function updateDosen()
	{

		$token = $this->uri->segment(3);

		$data["tampil"] = json_decode
		($this->client->simple_get(APIDOSEN,array("nip" => $token)));

		foreach ($data["tampil"] -> dosen as $record)
		{
			$data["nip"] = $record->nip_dsn;
			$data["nama"] = $record->nama_dsn;
			$data["kode_dosen"] = $record->kode_dosen_dsn;
			$data["token"] = $token;
		}

		$this->load->view('up_dosen',$data);
	}
}