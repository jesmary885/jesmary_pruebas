<?php
// app/Services/PvaDealsService.php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;


class PvaDealsService
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    
    {
        $this->baseUrl = 'https://prod-v3.pvadeals.com/v3';
        $this->apiKey = config('services.pvadeals.api_key');
        
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => $this->apiKey,
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * Obtener todos los números de servicio
     */
    public function getServiceRequests($filter = null, $after = null, $first = null)
        {
             try {
                $response = $this->client->get('/getServiceRequests');
                $statusCode = $response->getStatusCode();
                $body = $response->getBody()->getContents();
                
                // Registrar respuesta completa para diagnóstico
                \Log::debug('Respuesta completa de PVADeals API', [
                    'status' => $statusCode,
                    'headers' => $response->getHeaders(),
                    'body' => $body
                ]);

                if ($statusCode !== 200) {
                    throw new \Exception("Error en la API. Código: $statusCode");
                }

                $responseData = json_decode($body, true);
                
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception("La respuesta no es un JSON válido");
                }

                // Verificación más flexible de la estructura
                if (empty($responseData)) {
                    throw new \Exception("La respuesta está vacía");
                }

                // La API podría devolver los datos directamente o bajo una clave 'data'
                return $responseData['data'] ?? $responseData;
                
            } catch (\Exception $e) {
                \Log::error("Error en getServiceRequests: " . $e->getMessage());
                return ['error' => $e->getMessage(), 'raw_response' => $body ?? null];
            }
        }

    /**
     * Activar un número LTR
     */
    public function activateLtrNumber($id)
    {
        try {
            $response = $this->client->post("/activateLTRNumber/{$id}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Verificar estado de un número LTR
     */
    public function checkLtrStatus($id)
    {
        try {
            $response = $this->client->post("/checkLTRStatus/{$id}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Obtener códigos SMS recibidos
     */
    public function getSmsCodes($filter = null, $after = null, $first = null)
    {
        try {
            $query = [];
            if ($filter) $query['filter'] = $filter;
            if ($after) $query['after'] = $after;
            if ($first) $query['first'] = $first;

            $response = $this->client->get('/getMySMSCodes', [
                'query' => $query
            ]);
            
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Obtener información de un número específico
     */
    public function getNumberInfo($id)
    {
        try {
            $response = $this->client->get("/getServiceRequest/{$id}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Enviar un SMS
     */
    public function sendSms($requestId, $smsText)
    {
        try {
            $response = $this->client->post('/sendSMS', [
                'json' => [
                    'requestId' => $requestId,
                    'smsText' => $smsText
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Comprar un nuevo número
     */
    public function purchaseNumber($data)
    {
        try {
            $response = $this->client->post('/purchaseNumber', [
                'json' => $data
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Reutilizar un número existente
     */
    public function reuseNumber($id)
    {
        try {
            $response = $this->client->post("/reuseNumber/{$id}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}