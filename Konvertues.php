<?php
// Lexo shumën nga tastiera me readline
$euro = readline("Shkruaj shumën në Euro: ");

// Kontroll nëse inputi është numër
if (!is_numeric($euro)) {
    echo "Gabim: Ju lutem shkruani një numër të vlefshëm.\n";
    exit(1);
}

// Marrim të dhënat e kursit nga API
$response = file_get_contents("https://api.exchangerate.host/latest?base=EUR&symbols=ALL,USD");

// Kontroll nëse kërkesa dështoi
if (!$response) {
    echo "Gabim: Nuk mund të merret kursi i këmbimit.\n";
    exit(1);
}

// Dekodim JSON
$data = json_decode($response, true);

// Kontroll nëse JSON është valid
if (!isset($data['rates']['ALL']) || !isset($data['rates']['USD'])) {
    echo "Gabim: Kursi i këmbimit nuk u gjet.\n";
    exit(1);
}

// Merr kurset
$kursiLek = $data['rates']['ALL'];
$kursiUSD = $data['rates']['USD'];

// Llogarit konvertimet
$lek = $euro * $kursiLek;
$usd = $euro * $kursiUSD;

// Shfaq rezultatin
echo "\nRezultati:\n";
echo "€$euro = " . number_format($lek, 2) . " Lekë\n";
echo "€$euro = $" . number_format($usd, 2) . " Dollarë\n";
?>
