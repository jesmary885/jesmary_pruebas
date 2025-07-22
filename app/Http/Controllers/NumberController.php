<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NumberController extends Controller
{
    protected $pvaService;

    public function __construct(PvaDealsService $pvaService)
    {
        $this->pvaService = $pvaService;
    }

    /**
     * Activar un número
     */
    public function activateNumber($id)
    {
        $activation = $this->pvaService->activateLtrNumber($id);
        
        if (isset($activation['error'])) {
            return back()->with('error', 'Error al activar el número: ' . $activation['error']);
        }
        
        return back()->with('success', 'Número activado correctamente');
    }

    /**
     * Ver estado de un número
     */
    public function checkNumberStatus($id)
    {
        $status = $this->pvaService->checkLtrStatus($id);
        
        return response()->json($status);
    }

    /**
     * Obtener mensajes de un número
     */
    public function getNumberMessages($id)
    {
        // Primero obtenemos la información del número para asegurarnos que existe
        $numberInfo = $this->pvaService->getNumberInfo($id);
        
        if (isset($numberInfo['error'])) {
            return response()->json(['error' => $numberInfo['error']], 400);
        }
        
        // Luego obtenemos los SMS para este número
        $smsCodes = $this->pvaService->getSmsCodes("requestId:{$id}");
        
        return response()->json([
            'number_info' => $numberInfo,
            'messages' => $smsCodes
        ]);
    }

    /**
     * Enviar un SMS desde un número
     */
    public function sendSms(Request $request, $id)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:160'
        ]);
        
        $result = $this->pvaService->sendSms($id, $validated['message']);
        
        if (isset($result['error'])) {
            return back()->with('error', $result['error']);
        }
        
        return back()->with('success', 'Mensaje enviado correctamente');
    }
}
