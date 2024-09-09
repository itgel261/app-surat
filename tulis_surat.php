<?php
// PHP bagian untuk memeriksa session dan menyiapkan data
if (empty($_SESSION['admin'])) {
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
}

// Ambil divisi dari session
$divisi = $_SESSION['divisi'];

// Query untuk mendapatkan jenis surat yang sesuai dengan divisi
$ps = "SELECT id_jenis_surat, jenis_surat, s_jenis_surat, kode_surat, divisi, id_user FROM tbl_jenis_surat WHERE divisi = ?";
$stmt = $config->prepare($ps);

if (!$stmt) {
    die("Prepare failed: " . $config->error);
}

$stmt->bind_param("s", $divisi);
$stmt->execute();
$srt = $stmt->get_result();

if (!$srt) {
    die("Execute failed: " . $stmt->error);
}
?>

<div class="row">
    <!-- Secondary Nav START -->
    <div class="col s12">
        <nav class="secondary-nav">
            <div class="nav-wrapper blue-grey darken-1">
                <ul class="left">
                    <li class="waves-effect waves-light"><a href="" class="judul"><i class="material-icons md-36">mode_edit</i> Tulis Surat</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Secondary Nav END -->
</div>
<!-- Row END -->

<?php
if (isset($_SESSION['errQ'])) {
    $errQ = $_SESSION['errQ'];
    echo '<div id="alert-message" class="row">
            <div class="col m12">
                <div class="card red lighten-5">
                    <div class="card-content notif">
                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> ' . $errQ . '</span>
                    </div>
                </div>
            </div>
        </div>';
    unset($_SESSION['errQ']);
}
if (isset($_SESSION['errEmpty'])) {
    $errEmpty = $_SESSION['errEmpty'];
    echo '<div id="alert-message" class="row">
            <div class="col m12">
                <div class="card red lighten-5">
                    <div class="card-content notif">
                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> ' . $errEmpty . '</span>
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
            <input id="no_surat" type="text" class="validate" name="no_surat" onkeyup="displayType()" required>
            <label for="no_surat">Nomor Surat</label>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">assignment_ind</i>
                <input id="divisi" type="text" class="validate" name="divisi" value="<?php echo $_SESSION['divisi']; ?>" onkeyup="displayType()" disabled>
                <label for="divisi">Divisi</label>
            </div>

            <div class="input-field col s6">
                <i class="material-icons prefix md-prefix">date_range</i>
                <input id="tgl_surat" type="text" name="tgl_surat" class="datepicker" onkeyup="displayType()" required>
                <?php
                if (isset($_SESSION['tgl_surat'])) {
                    $tgl_surat = $_SESSION['tgl_surat'];
                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $tgl_surat . '</div>';
                    unset($_SESSION['tgl_surat']);
                }
                ?>
                <label for="tgl_surat">Tanggal Surat</label>
            </div>

            <?php
            if ($_SESSION['divisi'] == "ALL" || $_SESSION['divisi'] == "LEGAL" || $_SESSION['divisi'] == "GA") { ?>
                <div class="input-field col s6">
                    <i class="material-icons prefix md-prefix">account_balance</i>
                    <input id="pt_pertama" type="text" name="pt_pertama" class="datepicker"  onkeyup="displayType()" required>
                    <?php
                    if (isset($_SESSION['pt_pertama'])) {
                        $pt_pertama = $_SESSION['pt_pertama'];
                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $pt_pertama . '</div>';
                        unset($_SESSION['pt_pertama']);
                    }
                    ?>
                    <label for="pt_pertama">PT Pihak Pertama</label>
                </div>

            <?php
                    }
            ?>
            <?php
             if ($_SESSION['divisi'] == "ALL" || $_SESSION['divisi'] == "LEGAL" && $h_idjs == "1"){?>
                <div class="input-field col s6">
                    <i class="material-icons prefix md-prefix">account_balance</i>
                    <input id="pt_kedua" type="text" name="pt_kedua" class="datepicker"  onkeyup="displayType()" required>
                    <?php
                    if (isset($_SESSION['pt_kedua'])) {
                        $pt_kedua = $_SESSION['pt_kedua'];
                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $pt_kedua . '</div>';
                        unset($_SESSION['pt_kedua']);
                    }
                    ?>
                    <label for="pt_kedua">PT Pihak Kedua</label>
                </div>

                <?php
                    }
                 ?>
            

            <?php
            if ($_SESSION['divisi'] == "ALL" || $_SESSION['divisi'] == "GA") { ?>
                <div class="input-field col s6">
                    <i class="material-icons prefix md-prefix">account_balance</i>
                    <input id="vendor" type="text" name="vendor" class="datepicker" onkeyup="displayType()" required>
                    <?php
                    if (isset($_SESSION['vendor'])) {
                        $vendor = $_SESSION['vendor'];
                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $vendor . '</div>';
                        unset($_SESSION['vendor']);
                    }
                    ?>
                    <label for="vendor">Nama Vendor</label>
                </div>
            <?php
            }
            ?>

                <div class="input-field col s6">
                    <i class="material-icons prefix md-prefix">subtitles</i>
                    <select id="jenis_surat" name="jenis_surat" onkeyup="displayType()" required>
                        <option value="" disabled selected>Pilih Jenis Surat</option>
                        <?php
                        // Fetch and populate dropdown options with data attributes
                        while ($row = $srt->fetch_assoc()) {
                            $id_js = htmlspecialchars($row['id_jenis_surat']);
                            $jenis_surat = htmlspecialchars($row['jenis_surat']);
                            $s_jenis_surat = htmlspecialchars($row['s_jenis_surat']);
                            $kode_surat = htmlspecialchars($row['kode_surat']);
                            echo "<option value=\"$id_js\" data-jenis=\"$jenis_surat\" data-sjenis=\"$s_jenis_surat\" data-kodesurat=\"$kode_surat\">$jenis_surat</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-field col s6">
                    <div class="Kode-surat">
                        Kode Surat : <span id="kode_surat_display"></span>
                    </div>
                </div>
                <div class="input-field col s6">
                    </div>


            <br><br><br><br>
            <div class="sectionsurat">



            <?php
            if ($_SESSION['divisi'] == "GA") { ?>
            <script>
                function displayType() {
                    var nosurat = document.getElementById("no_surat").value;
                    var divisi = document.getElementById("divisi").value;
                    var pt_pertama = document.getElementById("pt_pertama").value;
                    var vendor = document.getElementById("vendor").value;
                    var tgl_surat = document.getElementById("tgl_surat").value;
                   

                    // Pisahkan hari, bulan, dan tahun dari tanggal
                    var dateParts = tgl_surat.split("-");
                    var year = dateParts[0];
                    var month = parseInt(dateParts[1], 10) || "";

                    // Format tanggal dalam format yang diinginkan
                    var formattedDate = toRoman(month) + "/" + year;
                    
                    // Update target dengan informasi yang dipisahkan
                    var targetKetikan = document.getElementById("kode_surat_display");
                    targetKetikan.innerHTML = nosurat + "/" + pt_pertama + "/" + divisi + "-" + vendor + "/" + formattedDate;
                }

                function toRoman(num) {
                    if (isNaN(num)) return '';
                    var roman = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
                    return roman[num - 1] || '';
                }
            </script>
            <?php
            }
            ?>


            <?php
            if ($_SESSION['divisi'] == "LEGAL") { ?>
            <script>
                function displayType() {
                    var nosurat = document.getElementById("no_surat").value;
                    var divisi = document.getElementById("divisi").value;
                    var pt_pertama = document.getElementById("pt_pertama").value;
                    var pt_kedua = document.getElementById("pt_kedua").value;
                    var tgl_surat = document.getElementById("tgl_surat").value;
                    var h_idjs = document.getElementById("jenis_surat").value;

                    
                    // Pisahkan hari, bulan, dan tahun dari tanggal
                    var dateParts = tgl_surat.split("-");
                    var year = dateParts[0];
                    var month = parseInt(dateParts[1], 10) || "";

                    // Format tanggal dalam format yang diinginkan
                    var formattedDate = toRoman(month) + "/" + year;
                    
                    // Update target dengan informasi yang dipisahkan
                    var targetKetikan = document.getElementById("kode_surat_display");
                    targetKetikan.innerHTML = nosurat + "/" + pt_pertama + "/" + formattedDate;
                }

                function toRoman(num) {
                    if (isNaN(num)) return '';
                    var roman = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
                    return roman[num - 1] || '';
                }
            </script>
            <?php
            }
            ?>
            
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
