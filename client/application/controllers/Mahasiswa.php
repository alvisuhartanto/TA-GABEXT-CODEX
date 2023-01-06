<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public function index()
	{
		$data["tampil"] = json_decode
		($this->client->simple_get(APIMAHASISWA));

		//foreach ($data["tampil"] -> mahasiswa as $record) {
		//	echo $record->npm_mhs."-".
		//		 $record->nama_mhs."<br>";
		//}

		$this->load->view('Data_siswa',$data);
	}
	function setDelete()
	{
		$json = file_get_contents("php://input");
		$hasil = json_decode($json);

		$delete = json_decode($this->client->simple_delete(APIMAHASISWA, array("npm" => $hasil -> npmnya)));
		// isikan nilai err
		// $err = 1;

		// kirim hasil ke "Data_siswa"
		echo json_encode(array("statusnya" => $delete -> status));
	}

	function addMahasiswa()
	{
		$this->load->view('en_mahasiswa');
	}

	function setSave()
	{
		// baca nilai dari fetch
		$data = array (
			"npm" => $this->input->post("npmnya"),
			"nama" => $this->input->post("namanya"),
			"telepon" => $this->input->post("teleponya"),
			"jurusan" => $this->input->post("jurusannya"),
			"token" => $this->input->post("npmnya")
		);
		 $save = json_decode($this->client->simple_post(APIMAHASISWA, $data));

		 // kirim hasil ke "em_mahasiswa"
		 echo json_encode(array("statusnya" => $save -> status));
	}
	function updateMahasiswa()
	{
		//$segmen = $this->uri->total_segments();
		//ambil nilai npm (berdasarkan segmentasi)
		$token = $this->uri->segment(3);

		$data["tampil"] = json_decode
		($this->client->simple_get(APIMAHASISWA,array("npm" => $token)));

		foreach ($data["tampil"] -> mahasiswa as $record)
		{
			$data["npm"] = $record->npm_mhs;
			$data["nama"] = $record->nama_mhs;
			$data["telepon"] = $record->telepon_mhs;
			$data["jurusan"] = $record->jurusan_mhs;
			$data["token"] = $token;
		}

		$this->load->view('up_mahasiswa',$data);
	}
}