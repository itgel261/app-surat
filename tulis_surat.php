<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
        if(isset($_REQUEST['submit'])){

            //validasi form kosong
            if($_REQUEST['username'] == "" || $_REQUEST['password'] == "" || $_REQUEST['nama'] == "" || $_REQUEST['admin'] == "" || $_REQUEST['divisi'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi!';
                header("Location: ./admin.php?page=sett&sub=usr&act=add");
                die();
            } else {

                $username = $_REQUEST['username'];
                $password = $_REQUEST['password'];
                $nama = $_REQUEST['nama'];
                $admin = $_REQUEST['admin'];
                $divisi = $_REQUEST['divisi'];

                //validasi input data
                if(!preg_match("/^[a-zA-Z0-9_]*$/", $username)){
                    $_SESSION['uname'] = 'Form Username hanya boleh mengandung karakter huruf, angka dan underscore (_)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z., ]*$/", $nama)){
                        $_SESSION['namauser'] = 'Form Nama hanya boleh mengandung karakter huruf, spasi, titik(.) dan koma(,)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {
                            if(!preg_match("/^[2-3]*$/", $admin)){
                                $_SESSION['tipeuser'] = 'Form Tipe User hanya boleh mengandung karakter angka 2 atau 3';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                $cek = mysqli_query($config, "SELECT * FROM tbl_user WHERE username='$username'");
                                $result = mysqli_num_rows($cek);

                                if($result > 0){
                                    $_SESSION['errUsername'] = 'Username sudah terpakai, gunakan yang lain!';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    if(strlen($username) < 5){
                                        $_SESSION['errUser5'] = 'Username minimal 5 karakter!';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    } else {

                                        if(strlen($password) < 5){
                                            $_SESSION['errPassword'] = 'Password minimal 5 karakter!';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        } else {
                                            $query = mysqli_query($config, "INSERT INTO tbl_user(username,password,nama,admin) VALUES('$username','$password','$nama','$admin','$divisi')");

                                            if($query != false){
                                                $_SESSION['succAdd'] = 'SUKSES! User baru berhasil ditambahkan';
                                                header("Location: ./admin.php?page=sett&sub=usr");
                                                die();
                                            } else {
                                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                echo '<script language="javascript">window.history.back();</script>';
                                            }
                                        }
                                    }
                                }
                            }
                        
                    }
                }
            }
        }
    }
?>
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="" class="judul"><i class="material-icons md-36">mode_edit</i>  Tulis Surat</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- Secondary Nav END -->
            </div>
            <!-- Row END -->

            
            <?php
                if(isset($_SESSION['errQ'])){
                    $errQ = $_SESSION['errQ'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errQ.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errQ']);
                }
                if(isset($_SESSION['errEmpty'])){
                    $errEmpty = $_SESSION['errEmpty'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errEmpty.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errEmpty']);
                }
            ?>

            <!-- Row form Start -->
            <div class="row jarak-form">

                <!-- Form START -->
                <form class="col s12" method="POST" action="?page=ts&act=add" enctype="multipart/form-data">

                    <!-- Row in form START -->
                    <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">looks_one</i>
                            <input id="no_surat" type="text" class="validate" name="no_surat" required>
                                <?php
                                    if(isset($_SESSION['no_surat'])){
                                        $no_surat = $_SESSION['no_surat'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_surat.'</div>';
                                        unset($_SESSION['no_surat']);
                                    }
                                    if(isset($_SESSION['errDup'])){
                                        $errDup = $_SESSION['errDup'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errDup.'</div>';
                                        unset($_SESSION['errDup']);
                                    }
                                ?>
                            <label for="no_surat">Nomor Surat</label>
                        </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">assignment_ind</i>
                            <input id="divisi" type="text" class="validate" name="divisi" value="<?php echo $_SESSION['nama']; ?>" disabled>
                                <?php
                                    if(isset($_SESSION['divisi'])){
                                        $asal_surat = $_SESSION['divisi'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$divisi.'</div>';
                                        unset($_SESSION['divisi']);
                                    }
                                ?>
                            <label for="divisi">Divisi</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="tgl_surat" type="text" name="tgl_surat" class="datepicker" required>
                                <?php
                                    if(isset($_SESSION['tgl_surat'])){
                                        $tgl_surat = $_SESSION['tgl_surat'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tgl_surat.'</div>';
                                        unset($_SESSION['tgl_surat']);
                                    }
                                ?>
                            <label for="tgl_surat">Tanggal Surat</label>
                        </div>

                        <?php
                        if($_SESSION['divisi'] == "LEGAL" || $_SESSION['divisi'] == "ALL"){?>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">account_balance</i>
                            <input id="pt_pertama" type="text" name="pt_pertama" class="datepicker" required>
                                <?php
                                    if(isset($_SESSION['pt_pertama'])){
                                        $tgl_surat = $_SESSION['pt_pertama'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$pt_pertama.'</div>';
                                        unset($_SESSION['pt_pertama']);
                                    }
                                ?>
                            <label for="pt_pertama">PT Pihak Pertama</label>
                        </div>

                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">account_balance</i>
                            <input id="pt_kedua" type="text" name="pt_kedua" class="datepicker" required>
                                <?php
                                    if(isset($_SESSION['pt_kedua'])){
                                        $tgl_surat = $_SESSION['pt_kedua'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$pt_kedua.'</div>';
                                        unset($_SESSION['pt_kedua']);
                                    }
                                ?>
                            <label for="tgl_supt_keduarat">PT Pihak Kedua</label>
                        </div>
                        <?php
                        }
                        ?>

                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">subtitles</i>
                            <select id="jenis_surat" name="jenis_surat" required>
                                <option value="" disabled selected>Pilih Jenis Surat</option>
                                <option value="jenis_surat1"></option>
                                <!-- Add more options as needed -->
                            </select>
                            <?php
                                if(isset($_SESSION['jenis_surat'])){
                                    $divisi = $_SESSION['jenis_surat'];
                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$jenis_surat.'</div>';
                                    unset($_SESSION['jenis_surat']);
                                }
                            ?>
                        </div>
      
                            
                    <div class="kode-surat">
                                <?php
                                     echo '<div>'.$_SESSION['nama'].'</div>';
                                ?>
                    </div>
                    <div class="col 6">
                            <button type="submit" name="kode_surat" class="btn-large blue waves-effect waves-light">DISPLAY KODE SURAT <i class="material-icons">done</i></button>
                        </div>
                        <div class="input-field col s6">
                            </div>
                            


                        <br><br><br>
                        <div class="sectionsurat">
                                        <div class="header-isisurat" style="padding:5px; padding-left:500px;">
                                            <a href=""><i class="material-icons md-36">format_bold</i></a>
                                            <a href=""><i class="material-icons md-36">format_italic</i></a>
                                            <a href=""><i class="material-icons md-36">format_underlined</i></a>
                                            
                                            <a href=""><i class="material-icons md-36">format_align_right</i></a>
                                            <a href=""><i class="material-icons md-36">format_align_center</i></a> 
                                            <a href=""><i class="material-icons md-36">format_align_left</i></a>
                                            <a href=""><i class="material-icons md-36">format_align_justify</i></a>
                                        </div>
                                <div class="isi-surat">
                                            <textarea style="height:500px;" name="isisurat" id="isiSurat" rows="5" placeholder="Masukkan isi surat di sini..."></textarea>
                                </div>               
                         </div>
                    </div>



                    <!-- Row in form END -->

                    <div class="row">
                        <div class="col 6">
                            <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        </div>
                        <div class="col 6">
                            <a href="?page=ts" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
                        </div>
                    </div>

                </form>
                <!-- Form END -->

            </div>
            <!-- Row form END -->
