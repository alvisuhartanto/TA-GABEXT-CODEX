<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matkul extends CI_Controller {
	public function index()
	{
		$data["tampil"] = json_decode
		($this->client->simple_get(APIMATKUL));

		$this->load->view('Data_matkul',$data);
	}
	function setDelete()
	{
		$json = file_get_contents("php://input");
		$hasil = json_decode($json);

		$delete = json_decode($this->client->simple_delete(APIMATKUL, array("kode_mk" => $hasil -> kode_mknya)));
        
		echo json_encode(array("statusnya" => $delete -> status));
	}

	function add()
	{
		$this->load->view('en_matkul');
	}

	function setSave()
	{
		// baca nilai dari fetch
		$data = array (
			"kode_mk" => $this->input->post("kode_mknya"),
			"nama_mk" => $this->input->post("nama_mknya"),
			"sks" => $this->input->post("sksya"),
			"token" => $this->input->post("kode_mknya")
		);
		 $save = json_decode($this->client->simple_post(APIMATKUL, $data));

		 echo json_encode(array("statusnya" => $save -> status));
	}
	function updateMatkul()
	{

		$token = $this->uri->segment(3);

		$data["tampil"] = json_decode
		($this->client->simple_get(APIMATKUL,array("kode_mk" => $token)));

		foreach ($data["tampil"] -> matkul as $record)
		{
			$data["kode_mk"] = $record->kode_mk_mhs;
			$data["nama_mk"] = $record->nama_mk_mhs;
			$data["sks"] = $record->sks_mhs;
			$data["token"] = $token;
		}

		$this->load->view('up_matkul',$data);
	}
}