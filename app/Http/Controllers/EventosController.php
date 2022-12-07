<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventosController extends Controller
{
    //
    protected $eventosModel;

    public function __construct(Evento $eventos)
    {
        $this->eventosModel = $eventos;
    }
    /**
     * Se devuelve la vista de los eventos
     */
    public function index()
    {
        $eventos = $this->eventosModel->findEvents();
        return view('logged.eventAdmin', ['eventos' => $eventos]);
    }
    /**
     * Guardas el evento creado y se genera un log si se produce un fallo
     */
    public function createEvent(Request $request)
    {

        try {
            $eventos = new Evento($request->all());
            $eventos->save();
        } catch (Exception $e) {
            Log::error('El usuario : ' . Auth::user()->name . ' ha creado un evento en la base de datos ', ['eventos ' => $eventos]);
        }
        return redirect()->action([EventosController::class, "index"]);

    }
    /**
     * Se guarda el cambio en el evento
     */
    public function saveEdit(Request $request)
    {
        
        try {
            $evento = Evento::find($request->id);
            $evento->evento = $request->evento;
            $evento->backgroundColor = $request->backgroundColor;
            $evento->textColor = $request->textColor;
            $evento->borderColor = $request->borderColor;

            $evento->save();
            Log::info('El usuario : ' . Auth::user()->name . ' ha actualizado un evento en la base de datos ', ['evento' => $evento]);
        } catch (Exception $e) {
            Log::error('El usuario : ' . Auth::user()->name . ' ha intentado actualizar un evento en la base de datos ', ['evento' => $evento]);
            
        }
        return redirect()->action([EventosController::class, "index"]);
    }
    /**
     * Hace un soft delete del evento para evitar problemas en la base de datos
     */
    public function deleteEvent(Request $request)
    {
        try {
            $evento = Evento::find($request->id);
            $evento->borrado = 1;
            $evento->save();
        } catch (Exception $e) {
            Log::error('El usuario : ' . Auth::user()->name . ' ha borrado un evento en la base de datos ', ['evento ' => $evento]);
        }
        return redirect()->action([EventosController::class, "index"]);

    }
    /**
     * Recupera los eventos para la peticion ajax
     */
    public function eventAjax(Request $request){
        $eventoAJAX = Evento::find($request->id);
        return json_encode($eventoAJAX);
    }
}
