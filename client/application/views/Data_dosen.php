<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url("ext/style.css") ?>">
</head>
<body >
    <!-- benner -->
    <nav class="benner">
    </nav>
    <!-- navigasi -->
    <nav class="navigasi1">
        <label class="logo"> Biodata Dosen</label>
        <ul>
            <li><a href="">Biodata Siswa</a></li>
            <li><a href="">Biodata Dosen</a></li>
            <li><a href="">Matakuliah</a></li>
            <li><a href="">Nilai</a></li>
            <li><a href="">KRS</a></li> 
        </ul>
    </nav>
    <!-- buat table data mahasiswa-->
    <table>
       <thead>
       <tr>
        <th style = "width: 5%;">NIP</th>
        <th style = "width: 10%;">NAMA</th>
        <th style = "width: 45%;">kode_dosen</th>
       </tr>
        </thead> 
       <!-- buat isi table -->
       <!-- mulai looping -->
       <tbody>
       <?php
        $no = 1;
        foreach($tampil->dosen as $record)
        { 
       ?>      
       <tr>
        
        <td style = "text-align: center;">
        <?php echo $NIP;?>
        </td>
        <td style = "text-align: center;">
        <?php echo $record->nama_dosen;?>
        </td>
        <td style = "text-align: justify;">
        <?php echo $record->kode_dosen;?>
        </td>
        <td style = "text-align: center;">
        <?php echo $record->telepon_mhs;?>
        </td>
        <td style = "text-align: center;">
        <?php echo $record->jurusan_mhs;?>
        </td>
        <td style = "text-align: center;">
            <nav class="area-aksi">
                <button class="btn-ubah" id="btn_ubah" title="Ubah Data Mahasiswa" 
                onclick="return gotoUpdate('<?php echo $record->npm_mhs; ?>')" >
                <i class="fa-solid fa-pen" ></i>
                </button>
                <button class="btn-hapus" id="btn_hapus" title="Hapus Data Mahasiswa" 
                onclick="return gotoDelete('<?php echo $record->npm_mhs; ?>','<?php echo $record->nama_mhs; ?>')">
                <i class="fa-solid fa-trash"></i>
                </button>
            </nav>  
        </td>
       </tr>
       <!-- akhir looping -->
       <?php 
                $no++;
            }
       ?>  
    </tbody>
    </table>
    <!-- buat menu / tombol-->  
    <nav class="area-tombol">
        <button class="btn-primary" id="btn_tambah">Tambah Data</button>
        <button class="btn-secondary" id="btn_refresh" onclick= "setRefresh()">Refresh Data</button>
    </nav>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let btn_tambah = document.getElementById("btn_tambah");
        btn_tambah.addEventListener('click', function(){
        //alert("Tambah Data")
        //btn_tambah.style.background = "#ffffff";
        //btn_tambah.style.color = "#000000";
        //this.style.borderRadius = "0";
        //this.style.fontSize = "10px";

        //this.className ="btn-scondary";
        
        //this.innerHTML = "<strong>Tambah</strong>";
        //this.innerText = "Tambah";
        
        //this.value="Entry Data"
        //this.innerHTML = "<em>Entry Data</em>"
        //this.Text = "Entry Data";

        location.href="<?php echo site_url("Mahasiswa/addMahasiswa/");?>"
        
        })
       
        function setRefresh(){
            location.href="<?php echo base_url();?>"
        }

        function gotoUpdate(npm){
            location.href='<?php echo site_url("Mahasiswa/updateMahasiswa/"); ?>'+'/'+npm;
        }

        function gotoDelete(npm,nama){
            let keterangan = npm + " - " + nama;
           if(confirm("Data Mahasiswa " + keterangan + " Ingin Dihapus ?") === true ){
            // alert("Data Berhasil Dihapus !");

                setDelete(npm,nama);
            
           }
        }

        function setDelete(npm)
        {
            const data = {
                "npmnya" : npm
            }
            fetch('<?php echo site_url("Mahasiswa/setDelete"); ?>',
            {
                method : "POST",
                headers : {
                    "Content-Type": "aplication/json"
                },
                body : JSON.stringify(data)
            })
            .then((response)=>
            {
                return response.json()
            })
            .then(function(data)
            {
                // jika nilai "err" = 0
                // if(data.err === 0)
                // alert("Data Berhasil Dihapus")
                // jika nilai "err" = 1
                // else
                // alert("Data Gagal Dihapus")

                alert(data.statusnya);

                // panggil fungsi refresh
                setRefresh
            })
        }
    </script>
</body>
</html>