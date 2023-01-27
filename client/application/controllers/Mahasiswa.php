<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public function index()
	{	
		$data["tampil"] = json_decode
		($this->client->simple_get(APIMAHASISWA));

		$this->load->view('Data_siswa',$data);
	}

	function setDelete()
	{
	
			$json = file_get_contents("php://input");
			$hasil = json_decode($json);

			$delete = json_decode($this->client->simple_delete(APIMAHASISWA, array("npm" => $hasil -> npmnya,
			)));

			// kirim hasil ke "vw_mahasiswa"
			echo json_encode(array("statusnya" => $delete -> status));
	}

	function addMahasiswa()
	{
		$this->load->view('en_mahasiswa');
	}

	function setSave()
	{	
		$data = array(
			"npm"=> $this->input->post("npmnya"),
			"nama"=> $this->input->post("namanya"),
			"jenis_kelamin"=> $this->input->post("jenis_kelaminnya"),
			"tanggal_lahir"=> $this->input->post("tanggal_lahirnya"),
			"id_pk"=> $this->input->post("id_pknya"),
			"Semester"=> $this->input->post("Semesternya"),
			"alamat" => $this->input->post("alamatnya"),
			"token"=> $this->input->post("npmnya"),
			
		);

		$save = json_decode($this->client->simple_post(APIMAHASISWA, $data));

		echo json_encode(array("statusnya" => $save-> status));

	}

	function updateMahasiswa()
	{
		// $segmen = $this->uri->total_segments();
		$token = $this->uri->segment(3);
		echo $token;

		$data["tampil"] = json_decode
		($this->client->simple_get(APIMAHASISWA, array("cari" => $token)));

		foreach ($data["tampil"] -> mahasiswa as $record) {
			$data["npm"] = $record->npm_mhs;
			$data["nama"] = $record->nama_mhs;
			$data["jenis_kelamin"] = $record->jenis_kelamin_mhs;
			$data["tanggal_lahir"] = $record->tanggal_lahir_mhs;
			$data["id_pk"] = $record->id_pk_mhs;
			$data["Semester"] = $record->Semester_mhs;
			$data["alamat"] = $record->alamat_mhs;
			$data["token"] = $token;				 
		}

		$this->load->view('Data_siswa',$data);

	}
	
	function setUpdate()
	{
	
		
		$data = array(
			"npm"=> $this->input->post("npmnya"),
			"nama"=> $this->input->post("namanya"),
			"jenis_kelamin"=> $this->input->post("jenis_kelaminnya"),
			"tanggal_lahir"=> $this->input->post("tanggal_lahirnya"),
			"id_pk"=> $this->input->post("id_pknya"),
			"Semester"=> $this->input->post("Semesternya"),
			"alamat" => $this->input->post("alamatnya"),
			"token"=> $this->input->post("npmnya"),
			
		);

		$update = json_decode($this->client->simple_put(APIMAHASISWA, $data));

		echo json_encode(array("statusnya" => $update -> status));

	}
}  
