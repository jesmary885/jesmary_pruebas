<div class="container mx-auto p-4"
     x-data="numberActivator({{ $checkInterval * 1000 }})"
     x-init="init">

    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Activar Número y Recibir Mensajes</h2>
        
        <!-- Campo para ingresar número -->
        <div class="mb-4">
            <label for="phoneNumber" class="block text-sm font-medium text-gray-700 mb-1">
                Número de teléfono (ej: +1234567890)
            </label>
            <div class="flex gap-2">
                <input
                    wire:model="phoneNumber"
                    type="text"
                    id="phoneNumber"
                    placeholder="+1234567890"
                    class="flex-1 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    @if($isLoading) disabled @endif
                >
                <button
                    wire:click="activateNumber"
                    wire:loading.attr="disabled"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded disabled:opacity-50"
                >
                    <span wire:loading.remove>Activar</span>
                    <span wire:loading wire:target="activateNumber">Procesando...</span>
                </button>
            </div>
            @error('phoneNumber') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <!-- Estado de activación -->
        @if($activationStatus)
            <div class="p-3 mb-4 rounded 
                @if(str_contains($activationStatus, 'Error')) bg-red-100 text-red-800
                @elseif($isActive) bg-green-100 text-green-800
                @else bg-blue-100 text-blue-800 @endif">
                {{ $activationStatus }}
                @if($isLoading)
                <div class="inline-block ml-2 animate-spin rounded-full h-4 w-4 border-t-2 border-b-2 border-blue-500"></div>
                @endif
            </div>
        @endif
        
        <!-- Mensajes recibidos -->
        @if($isActive && $serviceId)
            <div class="border-t pt-4">
                <h3 class="text-lg font-medium mb-2">Mensajes Recibidos</h3>
                
                @if(count($messages) > 0)
                    <div class="space-y-3 max-h-60 overflow-y-auto">
                        @foreach($messages as $message)
                            <div class="border-b pb-3 last:border-b-0">
                                <p class="text-sm text-gray-500">{{ $message['createdAt'] ?? 'Fecha desconocida' }}</p>
                                <p class="font-medium">{{ $message['smsText'] ?? 'Sin texto' }}</p>
                                @if($message['smsCode'] ?? false)
                                    <p class="text-sm text-gray-600 mt-1">
                                        Código: <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $message['smsCode'] }}</span>
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No se han recibido mensajes aún</p>
                @endif
            </div>
        @endif
    </div>


    @section('js')

        <script>
        function numberActivator(checkInterval) {
            return {
                init() {
                    // Escuchar eventos de Livewire
                    Livewire.on('startStatusCheck', () => {
                        this.checkStatus();
                    });
                    
                    Livewire.on('continueStatusCheck', () => {
                        setTimeout(() => {
                            this.checkStatus();
                        }, checkInterval);
                    });
                    
                    Livewire.on('startMessagePolling', () => {
                        this.startPolling(checkInterval);
                    });
                    
                    Livewire.on('notifyNewMessage', (data) => {
                        this.notify(data.message);
                    });
                    
                    this.requestNotificationPermission();
                },
                
                checkStatus() {
                    @this.checkNumberStatus();
                },
                
                startPolling(interval) {
                    setInterval(() => {
                        @this.loadMessages();
                    }, interval);
                },
                
                requestNotificationPermission() {
                    if (Notification.permission !== 'granted') {
                        Notification.requestPermission();
                    }
                },
                
                notify(message) {
                    // Notificación del navegador
                    if (Notification.permission === 'granted') {
                        new Notification('Nuevo mensaje recibido', {
                            body: message
                        });
                    }
                    
                    // Notificación toast si Toastify está disponible
                    if (typeof Toastify === 'function') {
                        Toastify({
                            text: message,
                            duration: 5000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#4CAF50",
                        }).showToast();
                    }
                }
            }
        }
        </script>

    @stop
</div>