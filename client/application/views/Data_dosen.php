<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url("ext/style.css") ?>">
</head>
<body>
    <!-- buat menu / tombol-->
    <nav class="area-tombol">
        <button class="btn-primary" id="btn_tambah">Tambah Data</button>
        <button class="btn-secondary" id="btn_refresh" onclick= "setRefresh()">Refresh Data</button>
    </nav>

    <!-- buat table data Dosen-->
    <table>
       <thead>
       <tr>
        <th style = "width: 10%;">Aksi</th>
        <th style = "width: 20%;">Nip</th>
        <th style = "width: 50%;">Nama Dosen</th>
        <th style = "width: 20%;">Kode Dosen</th>
       </tr>
        </thead> 
       <!-- buat isi table -->
       <!-- mulai looping -->
       <tbody>
       <?php
        $no = 1;
        foreach($tampil->Dosen as $record)
        { 
       ?>      
       <tr>
        <td style = "text-align: center;">
            <nav class="area-aksi">
                <button class="btn-ubah" id="btn_ubah" title="Ubah Data Dosen" 
                onclick="return gotoUpdate('<?php echo $record->nip_dsn; ?>')" >
                <i class="fa-solid fa-pen" ></i>
                </button>
                <button class="btn-hapus" id="btn_hapus" title="Hapus Data Dosen" 
                onclick="return gotoDelete('<?php echo $record->nip_dsn; ?>','<?php echo $record->nama_dsn; ?>')">
                <i class="fa-solid fa-trash"></i>
                </button>
            </nav>  
        </td>
        <td style = "text-align: center;">
        <?php echo $record->nip_dsn;?>
        </td>
        <td style = "text-align: justify;">
        <?php echo $record->nama_dsn;?>
        </td>
        <td style = "text-align: center;">
        <?php echo $record->kode_dosen_dsn;?>
        </td>
       </tr>
       <!-- akhir looping -->
       <?php 
                $no++;
            }
       ?>  
    </tbody>
    </table>
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

        location.href="<?php echo site_url("Dosen/addDosen/");?>"
        
         })
       
        function setRefresh(){
            location.href="<?php echo base_url();?>"
        }

        function gotoUpdate(nip){
            location.href='<?php echo site_url("Dosen/updateDosen/"); ?>'+'/'+nip;
        }

        function gotoDelete(nip,nama){
            let keterangan = nip + " - " + nama;
           if(confirm("Data Dosen " + keterangan + " Ingin Dihapus ?") === true ){
            // alert("Data Berhasil Dihapus !");
             
                setDelete(nip);

           }
        }

        function setDelete(nip)
        {
            const data = {
                "nipnya" : nip
            }


            fetch('<?php echo site_url("Dosen/setDelete"); ?>',
            {
                method : "POST",
                headers : {
                    "Content-Type" : "application/json"
                },
                body : JSON.stringify(data)
            })
            .then((response)=>
            {
                return response.json()
            })
            .then(function(data)
            {
                // // jika nilai "err" = 0
                // if(data.err === 0)
                //     alert("Data Berhasil Dihapus")
                // // jika nilai "err" = 1
                // else
                //     alert("Data Gagal Dihapus !")

                alert(data.statusnya);

                // panggil fungsi setRefresh()
                setRefresh();
            })
        }
    </script>
</body>
</html>