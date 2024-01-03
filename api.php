<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หวยยี่กี่ 5G </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body style="background-color: black;">

<?php

$url = "https://play3.huaylike.live/ms";

function fetchData($url, $data) {
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'User-Agent: Auutymizkxnxx'
    ]);

    $response = curl_exec($ch);

    if ($response === false) {
        die('Error: ' . curl_error($ch));
    }

    curl_close($ch);

    return json_decode($response, true);
}

function processResults($dataItem) {
    $bon3 = $dataItem['bon3'];
    $lang2 = $dataItem['lang2'];

    $resBon1 = substr($bon3, 0, 1);
    $resBon2 = substr($bon3, -1);
    $lang = substr($lang2, 0, 1);
    $res1 = $resBon1 + $resBon2;
    $res1 = ($res1 == 10) ? 0 : $res1;
    $res2 = substr($res1, -1);
    $res3 = $res2 + $lang;
    $res4 = substr($res3, -1);
    $total = $res4 + 1;
    $total = ($total == 10) ? 0 : $total;
    ?>

    <div class="container mt-4">
        <div class="card bg-dark text-light">
            <div class="card-body">
                <h5 class="card-title">FB : อู๋ ตี้</h5>
                <p class="card-text">
        รอบที่ <?php echo $dataItem['nameSub']; ?>
<br>
    <i class="text-warning">  เลขเด่นที่ได้ </i> : <h3> <b class="badge badge-success">   <?php echo $res4; ?> กับ <?php echo $total; ?> </b></h3><br>
                <h5>    ผลเลขที่ออก  </h5><br>
     บน 3 ตัว : <b class="text-primary"><h5> <?php echo $dataItem['bon3']; ?> 
</h5> </b> <br>
                    ล่าง 2 ตัว : <b class="text-primary"> <h5> <?php echo $dataItem['lang2']; ?> </h5> </b>
                </p>
            </div>
            <div class="card-footer text-muted">
               
            <a href="index.php" id="reloadButton" class="btn btn-outline-warning mt-3">
                <i class="fas fa-sync-alt"></i> รีโหลด
            </a>
        </div>
        <div class="card-footer text-muted">
            <div id="refreshMessage" class="alert alert-info">
                กรุณา รีเฟรช เพจเอานะจ่ะ
            </div>
       

            </div>
        </div>
    </div>

    <?php
}

$data = [
    "operationName" => "getLottoResultYeeKee",
    "variables" => [
        "data" => [
            "code" => "powerball5g",
            "date" => "2024-01-02",
            "round" => 0
        ]
    ],
    "query" => "query getLottoResultYeeKee(\$data: InputGetLottoResultYeeKee!) {
        getLottoResultYeeKee(data: \$data) {
            status
            message
            name
            roundInDate
            data {
                code
                name
                nameSub
                bon3
                bon2
                lang2
                __typename
            }
        }
    }"
];

$result = fetchData($url, $data);

if (isset($result['data']['getLottoResultYeeKee']['data'])) {
    foreach ($result['data']['getLottoResultYeeKee']['data'] as $dataItem) {
        if ($dataItem['bon3'] !== 'xxx' && $dataItem['lang2'] !== 'xx') {
            processResults($dataItem);
        }
    }
} else {
    echo "ไม่พบข้อมูล ของ  API.  ติดต่อ Fb : อู๋ ตี้";
}
?>
	
	<footer>
		<div class="card card-body text-danger">  เลขมีเข้าบ้างมีหลุดบ้าง ให้พอเป็นแนวทางนะครับ </div>
		</footer>

	
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your existing scripts -->
	
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
