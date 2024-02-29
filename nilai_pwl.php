<?php
require_once 'Nilai.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    // Validasi input
    function validateInput($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    $partisipasi = validateInput($_POST["partisipasi"]);
    $tugas = validateInput($_POST["tugas"]);
    $uts = validateInput($_POST["uts"]);
    $uas = validateInput($_POST["uas"]);

    // Validasi nilai harus dalam rentang 0-100
    function validateRange($value)
    {
        return $value >= 0 && $value <= 100;
    }

    if (!validateRange($partisipasi) || !validateRange($tugas) || !validateRange($uts) || !validateRange($uas)) {
        $errors[] = "Nilai harus dalam rentang 0-100.";
    }

    if (empty($partisipasi) || empty($tugas) || empty($uts) || empty($uas)) {
        $errors[] = "Semua nilai harus diisi.";
    }

    if (empty($errors)) {
        $nilai = new Nilai($partisipasi, $tugas, $uts, $uas);
        $nilai_akhir = $nilai->hitungNilaiAkhir();
        $nilai_huruf = $nilai->konversiNilaiHuruf();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi Nilai</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-3">Konversi Nilai</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <?php if (!empty($errors)) {
                echo '<div class="alert alert-danger">';
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
                echo '</div>';
            } ?>
            <div class="form-group">
                <label for="partisipasi">Nilai Partisipasi:</label>
                <input type="number" class="form-control" id="partisipasi" name="partisipasi" step="0.01" min="0" max="100" required>
            </div>
            <div class="form-group">
                <label for="tugas">Nilai Tugas:</label>
                <input type="number" class="form-control" id="tugas" name="tugas" step="0.01" min="0" max="100" required>
            </div>
            <div class="form-group">
                <label for="uts">Nilai UTS:</label>
                <input type="number" class="form-control" id="uts" name="uts" step="0.01" min="0" max="100" required>
            </div>
            <div class="form-group">
                <label for="uas">Nilai UAS:</label>
                <input type="number" class="form-control" id="uas" name="uas" step="0.01" min="0" max="100" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php if (!empty($nilai_akhir) && !empty($nilai_huruf)) : ?>
            <div class="mt-3">
                <h4>Hasil:</h4>
                <p>Nilai Akhir: <?php echo $nilai_akhir; ?></p>
                <p>Nilai Huruf: <?php echo $nilai_huruf; ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>