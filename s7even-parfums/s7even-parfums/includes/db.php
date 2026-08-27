<?php
require_once __DIR__ . '/config.php';

/**
 * Realiza peticiones a la API REST de Supabase mediante cURL.
 * 
 * @param string $endpoint Nombre de la tabla o ruta del endpoint (ej. 'clientes')
 * @param string $method Método HTTP ('GET', 'POST', 'PATCH', 'DELETE')
 * @param array|null $data Datos a enviar en formato array asociativo
 * @return mixed Respuesta decodificada de Supabase en array asociativo
 */
function supabase_request($endpoint, $method = 'GET', $data = null) {
    // Limpia las barras diagonales para evitar URLs mal formadas
    $url = rtrim(SUPABASE_URL, '/') . '/rest/v1/' . ltrim($endpoint, '/');
    
    $headers = [
        "apikey: " . SUPABASE_KEY,
        "Authorization: Bearer " . SUPABASE_KEY,
        "Content-Type: application/json",
        "Prefer: return=representation"
    ];

    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    } elseif ($method !== 'GET') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    }

    $response = curl_exec($ch);
    
    // Captura de errores de red o conexión
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return ['error' => true, 'message' => $error_msg];
    }

    curl_close($ch);

    return json_decode($response, true);
}
