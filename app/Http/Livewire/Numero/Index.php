<?php

namespace App\Http\Livewire\Numero;

use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;
use App\Services\PvaDealsService;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;


class Index extends Component
{

    public $phoneNumber = '';
    public $serviceId = null;
    public $activationStatus = '';
    public $isLoading = false;
    public $isActive = false;
    public $messages = [];
    public $checkInterval = 10;
    public $maxChecks = 12;

    protected $pvaService;

    public function boot()
    {
        $this->pvaService = new PvaDealsService();
    }

  public function activateNumber()
    {
         $this->validate(['phoneNumber' => 'required|min:10']);

        $this->resetState();
        $this->isLoading = true;
        $this->activationStatus = 'Buscando número...';

        try {
            $response = $this->pvaService->getServiceRequests();
            
            // Manejar errores de la API
            if (isset($response['error'])) {
                throw new \Exception($response['error']);
            }

            // Buscar el número en diferentes formatos de respuesta
            $foundNumber = $this->findNumberInResponse($this->phoneNumber, $response);

            if (!$foundNumber) {
                throw new \Exception("Número no encontrado. Respuesta de la API: " . json_encode($response));
            }

            // Resto del proceso de activación...
            
        } catch (\Exception $e) {
            $this->handleError($e);
        }
    
    }

    protected function normalizePhoneNumber($number)
    {
        // Eliminar todo excepto dígitos y signo +
        return preg_replace('/[^0-9+]/', '', $number);
    }

    protected function findNumberInResponse($number, $serviceRequests)
    {
          // Normalizar el número buscado
        $normalizedNumber = $this->normalizePhoneNumber($number);
        
        // Intentar diferentes estructuras de respuesta
        $possibleDataStructures = [
            $apiResponse['data'] ?? null,    // Estructura esperada
            $apiResponse['numbers'] ?? null,  // Posible alternativa
            $apiResponse                      // Si los datos están en el nivel superior
        ];
        
        foreach ($possibleDataStructures as $candidates) {
            if (!is_array($candidates)) continue;
            
            foreach ($candidates as $item) {
                if (!is_array($item)) continue;
                
                // Buscar en diferentes campos posibles
                $numberFields = ['phoneNumber', 'number', 'phone', 'telephone'];
                foreach ($numberFields as $field) {
                    if (isset($item[$field]) && 
                        $this->normalizePhoneNumber($item[$field]) === $normalizedNumber) {
                        return $item;
                    }
                }
            }
        }
        
        return null;
    }


    protected function processActivation()
    {
        $this->activationStatus = 'Activando número...';
        $activationResult = $this->pvaService->activateLtrNumber($this->serviceId);
        
        if (isset($activationResult['error'])) {
            throw new \Exception($activationResult['error']);
        }

        $this->activationStatus = 'Activación iniciada. Verificando estado...';
        $this->dispatch('startStatusCheck');
    }

    public function checkNumberStatus()
    {
        try {
            $statusResult = $this->pvaService->checkLtrStatus($this->serviceId);
            
            if (!isset($statusResult['status'])) {
                throw new \Exception("Respuesta inesperada al verificar estado");
            }

            if ($statusResult['status'] === 'ONLINE') {
                $this->activationSuccess();
                return;
            }

            $this->continueStatusCheck();

        } catch (\Exception $e) {
            $this->handleError($e);
        }
    }

    protected function activationSuccess()
    {
        $this->isActive = true;
        $this->isLoading = false;
        $this->activationStatus = '¡Número activado correctamente!';
        $this->dispatch('startMessagePolling');
        $this->loadMessages();
    }

    protected function continueStatusCheck()
    {
        $this->maxChecks--;
        
        if ($this->maxChecks <= 0) {
            $this->activationStatus = 'La activación está tardando más de lo esperado. Puedes cerrar esta ventana y volver más tarde.';
            $this->isLoading = false;
            $this->dispatch('stopStatusCheck');
        } else {
            $this->activationStatus = "Verificando estado... ({$this->maxChecks} intentos restantes)";
            $this->dispatch('continueStatusCheck');
        }
    }

    public function loadMessages()
    {
        try {
            $response = $this->pvaService->getSmsCodes("requestId:{$this->serviceId}");
            $this->messages = $response['data'] ?? [];
            
            if (!empty($this->messages)) {
                $this->dispatch('notifyNewMessage', message: 'Tienes nuevos mensajes');
            }
        } catch (\Exception $e) {
            Log::error("Error loading messages: " . $e->getMessage());
        }
    }

     protected function handleError(\Exception $e)
    {
        $errorDetails = [
        'error' => $e->getMessage(),
        'phone' => $this->phoneNumber,
        'time' => now()->toDateTimeString(),
        'trace' => $e->getTraceAsString()
        ];
        
        \Log::error('Error en NumberActivator', $errorDetails);
        
        $userMessage = $e->getMessage();
        
        // Mensajes más amigables para errores conocidos
        if (str_contains($e->getMessage(), 'Formato de respuesta inesperado')) {
            $userMessage = "La API devolvió una respuesta inesperada. Por favor contacta al soporte técnico.";
        }
        
        $this->activationStatus = "Error: " . $userMessage;
        $this->isLoading = false;
        
        // Opcional: Mostrar detalles técnicos en desarrollo
        if (config('app.debug')) {
            $this->activationStatus .= " [Detalles: " . $e->getMessage() . "]";
        }
    }

    protected function resetState()
    {
        $this->serviceId = null;
        $this->isActive = false;
        $this->messages = [];
        $this->maxChecks = 12;
    }


    public function render()
    {
        return view('livewire.numero.index', [
            'isLoading' => $this->isLoading,
            'isActive' => $this->isActive,
            'activationStatus' => $this->activationStatus,
            'serviceId' => $this->serviceId,
            'messages' => $this->messages
        ]);
    }

   
}
