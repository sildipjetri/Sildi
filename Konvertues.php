<?php
$euro = readline("Shkruaj shumën në Euro: ");

if (!is_numeric($euro)) {
    echo "Gabim: Ju lutem shkruani një numër të vlefshëm.\n";
    exit(1);
}

$response = file_get_contents("https://api.exchangerate.host/latest?base=EUR&symbols=ALL,USD");

if (!$response) {
    echo "Gabim: Nuk mund të merret kursi i këmbimit.\n";
    exit(1);
}

$data = json_decode($response, true);

if (!isset($data['rates']['ALL']) || !isset($data['rates']['USD'])) {
    echo "Gabim: Kursi i këmbimit nuk u gjet.\n";
    exit(1);
}

$kursiLek = $data['rates']['ALL'];
$kursiUSD = $data['rates']['USD'];

$lek = $euro * $kursiLek;
$usd = $euro * $kursiUSD;

echo "\nRezultati:\n";
echo "€$euro = " . number_format($lek, 2) . " Lekë\n";
echo "€$euro = $" . number_format($usd, 2) . " Dollarë\n";
?>
