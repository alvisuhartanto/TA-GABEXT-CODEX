<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" href="<?php echo base_url("ext/style.css") ?>">
</head>
<body>
<nav class="area-tombol">
        <button class="btn-primary" id="btn_lihat">Lihat</button>
        <button class="btn-secondary" id="btn_refresh" onclick= "setRefresh()">Refresh Data</button>
    </nav>
<main class="area-grid">
    <!-- bagian tambah -->
    <section class="item-label1">
        <label id="lbl_npm" for="txt_npm">
            NPM:
        </label>
    </section>
    <section class="item-input1">
        <input type="text" id="txt_npm" class="txt-input" maxLength="9">
    </section>
    <section class="item-error1">
        <p class="info-error" id="err_npm"></p>
    </section>

    <section class="item-label2">
        <label id="lbl_nama" for="txt_nama">
            Nama:
        </label>
    </section>
    <section class="item-input2">
        <input type="text" id="txt_nama" class="txt-input" maxLength="100">
    </section>
    <section class="item-error2">
        <p class="info-error" id="err_nama"></p>
    </section>

    <section class="item-label3">
        <label id="lbl_semester" for="txt_semester">
            Semester:
        </label>
    </section>
    <section class="item-input3">
        <input type="text" id="txt_semester" class="txt-input" maxLength="10">
    </section>
    <section class="item-error3">
        <p class="info-error" id="err_semester"></p>
    </section>

    <section class="item-label4">
        <label id="lbl_jurusan" for="cbo_jurusan">
            Jurusan:
        </label></section>
    <section class="item-input4">
        <select id="cbo_jurusan" class="select-input">       
            <option value="-">PILIH JURUSAN</option>
            <option value="TI">TEKNOLOGI INFORMASI</option>
            <option value="IF">INFORMATIKA</option>
            <option value="TK">TEKNIK KOMPUTER</option>
            <option value="SIA">SISTEM INFORMASI AKUNTANSI</option>
            <option value="SI">SISTEM INFORMASI</option>
        </select>
    </section>
    <section class="item-error4">
        <p class="info-error" id="err_jurusan"></p>
    </section>

    <section class="item-label5">
        <label id="lbl_tanggal_lahir" for="txt_tanggal_lahir">
            tanggal_lahir:
        </label></section>
    <section class="item-input5">
        <input type="text" id="txt_tanggal_lahir" class="txt-input" maxLength="15">
    </section>
    <section class="item-error5">
        <p class="info-error" id="err_tanggal_lahir"></p>
    </section>

    <section class="item-label6">
        <label id="lbl_jenis_kelamin" for="txt_jenis_kelamin">
            jenis_kelamin:
        </label></section>
    <section class="item-input6">
        <input type="text" id="txt_jenis_kelamin" class="txt-input" maxLength="15">
    </section>
    <section class="item-error6">
        <p class="info-error" id="err_jenis_kelamin"></p>
    </section>
    
    <section class="item-label7">
        <label id="lbl_alamat" for="txt_alamat">
            alamat:
        </label></section>
    <section class="item-input7">
        <input type="text" id="txt_alamat" class="txt-input" maxLength="15">
    </section>
    <section class="item-error7">
        <p class="info-error" id="err_alamat"></p>
    </section>
</main>
<!-- simpan data -->
        <nav class="area-tombol">
                <button class="btn-primary" id="btn_simpan">Simpan Data</button>              
        </nav>
<script>
        let btn_lihat = document.getElementById("btn_lihat");
        let btn_simpan = document.getElementById("btn_simpan");
        btn_lihat.addEventListener('click', function(){
         location.href="<?php echo base_url();?>"
         })

         function setRefresh(){
            location.href='<?php echo site_url("Mahasiswa/addMahasiswa/"); ?>';
        }

        btn_simpan.addEventListener('click',
        function(){
            let lbl_npm = document.getElementById("lbl_npm");
            let txt_npm = document.getElementById("txt_npm");
            let err_npm = document.getElementById("err_npm");

            let lbl_nama = document.getElementById("lbl_nama");
            let txt_nama = document.getElementById("txt_nama");
            let err_nama = document.getElementById("err_nama");

            let lbl_semester = document.getElementById("lbl_semester");
            let txt_semester = document.getElementById("txt_semester");
            let err_semester = document.getElementById("err_semester");

            let lbl_jurusan = document.getElementById("lbl_jurusan");
            let cbo_jurusan = document.getElementById("cbo_jurusan");
            let err_jurusan = document.getElementById("err_jurusan");
            
            let lbl_tanggal_lahir = document.getElementById("lbl_tanggal_lahir");
            let txt_tanggal_lahir = document.getElementById("txt_tanggal_lahir");
            let err_tanggal_lahir = document.getElementById("err_tanggal_lahir");

            let lbl_jenis_kelamin = document.getElementById("lbl_jenis_kelamin");
            let txt_jenis_kelamin = document.getElementById("txt_jenis_kelamin");
            let err_jenis_kelamin = document.getElementById("err_jenis_kelamin");

            let lbl_alamat = document.getElementById("lbl_alamat");
            let txt_alamat = document.getElementById("txt_alamat");
            let err_alamat = document.getElementById("err_alamat");


            if(txt_npm.value === "")
            {
                lbl_npm.style.color = "#FF0000"
                txt_npm.style.borderColor = "#FF0000"
                err_npm.style.display = "unset"
                err_npm.innerHTML ="<em>NPM Harus Disi!!!</em>"
            }
            else
            {
                lbl_npm.style.color = "unset"
                txt_npm.style.borderColor = "unset"
                err_npm.style.display = "none"
                err_npm.innerHTML =""
            }

            const nama = (txt_nama.value === "") ?
            [
                lbl_nama.style.color = "#FF0000",
                txt_nama.style.borderColor = "#FF0000",
                err_nama.style.display = "unset",
                err_nama.innerHTML ="<em>Nama Harus Disi!!!</em>"
            ]
            :
            [
                lbl_nama.style.color = "unset",
                txt_nama.style.borderColor = "unset",
                err_nama.style.display = "none",
                err_nama.innerHTML =""
            ]
            
            const semester = (txt_semester.value === "") ?
            [
                lbl_semester.style.color = "#FF0000",
                txt_semester.style.borderColor = "#FF0000",
                err_semester.style.display = "unset",
                err_semester.innerHTML ="<em>semester Harus Disi!!!</em>"
            ]
            :
            [
                lbl_semester.style.color = "unset",
                txt_semester.style.borderColor = "unset",
                err_semester.style.display = "none",
                err_semester.innerHTML =""
            ]

            const jurusan = (cbo_jurusan.value === "-") ?
            [
                lbl_jurusan.style.color = "#FF0000",
                cbo_jurusan.style.borderColor = "#FF0000",
                err_jurusan.style.display = "unset",
                err_jurusan.innerHTML ="<em>Jurusan Harus Disi!!!</em>"
            ]
            :
            [
                lbl_jurusan.style.color = "unset",
                cbo_jurusan.style.borderColor = "unset",
                err_jurusan.style.display = "none",
                err_jurusan.innerHTML =""
            ]

            const tanggal_lahir = (txt_tanggal_lahir.value === "") ?
            [
                lbl_tanggal_lahir.style.color = "#FF0000",
                txt_tanggal_lahir.style.borderColor = "#FF0000",
                err_tanggal_lahir.style.display = "unset",
                err_tanggal_lahir.innerHTML ="<em>tanggal_lahir Harus Disi!!!</em>"
            ]
            :
            [
                lbl_tanggal_lahir.style.color = "unset",
                txt_tanggal_lahir.style.borderColor = "unset",
                err_tanggal_lahir.style.display = "none",
                err_tanggal_lahir.innerHTML =""
            ]

            const jenis_kelamin = (txt_jenis_kelamin.value === "") ?
            [
                lbl_jenis_kelamin.style.color = "#FF0000",
                txt_jenis_kelamin.style.borderColor = "#FF0000",
                err_jenis_kelamin.style.display = "unset",
                err_jenis_kelamin.innerHTML ="<em>jenis_kelamin Harus Disi!!!</em>"
            ]
            :
            [
                lbl_jenis_kelamin.style.color = "unset",
                txt_jenis_kelamin.style.borderColor = "unset",
                err_jenis_kelamin.style.display = "none",
                err_jenis_kelamin.innerHTML =""
            ]

            const alamat = (txt_alamat.value === "") ?
            [
                lbl_alamat.style.color = "#FF0000",
                txt_alamat.style.borderColor = "#FF0000",
                err_alamat.style.display = "unset",
                err_alamat.innerHTML ="<em>alamat Harus Disi!!!</em>"
            ]
            :
            [
                lbl_alamat.style.color = "unset",
                txt_alamat.style.borderColor = "unset",
                err_alamat.style.display = "none",
                err_alamat.innerHTML =""
            ]

            if(err_npm.innerHTML === "" && nama[3] === "" && semester[3] ==="" && jurusan[3] ===""&& tanggal_lahir[3] ===""&& jenis_kelamin[3] ===""&& alamat[3] ==="")
            {
                setSave(txt_npm.value,txt_nama.value,txt_semester.value,cbo_jurusan.value,txt_tanggal_lahir.value,,txt_jenis_kelamin.value,,txt_alamat.value)
            }  
        })

        const setSave = (npm,nama,semester,jurusan,tanggal_lahir,jenis_kelamin,alamat) =>{
            // buat variabel untuk form
            let form = new FormData();

            // isi/tambah nilai untuk form
            form.append("npmnya",npm);
            form.append("namanya",nama);
            form.append("semester",semester);
            form.append("jurusannya",jurusan);
            form.append("tanggal_lahir",tanggal_lahir);
            form.append("jenis_kelamin",jenis_kelamin);
            form.append("alamat",alamat);

            fetch('<?php echo site_url("Mahasiswa/setSave"); ?>',{
                method : "POST",
                body : form
            })
            .then((response)=>response.json())
            .then((result)=>alert(result.statusnya))
            .catch((error) => alert("Data Gagal Dikirim !!"))   
        }




</script>
</body>
</html>