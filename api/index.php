<?php

require_once __DIR__ . "/lib/CSVReader.php";

if (!empty($_POST['fonction'])) {
    switch ($_POST['fonction']) {
        case "getNombreRaccordableByCodePostal":
            $file = __DIR__ . "/../resources/raccordable_par_code_postal.csv";
            $csv = CSVReader::generateArrayFromCSVFile($file);
            $response = array('status' => true, 'data' => $csv);
            break;
        case "getNombreRaccordablefor1CodePostal":
            $file = __DIR__ . "/../resources/raccordable_par_code_postal.csv";
         
           $datasearch = $_POST['datasearch'];
            $csv = CSVReader::generateSmallArrayFromCSVFile($file,$datasearch);

            $response = array('status' => true, 'data' => $csv , 'search' => $datasearch);
            break;
        default:
            http_response_code(404);
            $response = array('status' => false, 'data' => NULL, 'message' => "404 Method not found.");
            break;
    }
    } else {
    http_response_code(404);
    $response = array('status' => false, 'data' => NULL, 'message' => "404 Method not found.");
           }

header('Content-Type: application/json;charset:utf-8;');
echo json_encode($response);

?>
