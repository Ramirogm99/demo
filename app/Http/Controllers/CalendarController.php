<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Evento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CalendarController extends Controller
{
    //
    protected $calendarModel;
    protected $eventoModel;

    public function __construct(Calendar $calendarios, Evento $eventos)
    {
        $this->calendarModel = $calendarios;
        $this->eventoModel = $eventos;
    }
    /**
     * Carga las citas y devuelve la vista del calendario
     */
    public function index()
    {
        $tipoEventos = $this->eventoModel->findEvents();
        return view('home', ['tipoEventos' => $tipoEventos]);
    }
    /**
     * Recibe una request por ajax y se saca informacion de todas las citas con sus colores respectivos, tambien sirve para 
     * guardar y alterar las citas ya creadas
     */
    public function createDate(Request $request)
    {
        switch ($request->tipo) {
            case 0:
                $event = $this->calendarModel->findCitas();
                $eventosTodo = [];
                foreach ($event as $evento) {
                    $color = $this->eventoModel->findEvent($evento->ID_EVENTOS);
                    if ($color->id == $evento->ID_EVENTOS) {
                        $evento->backgroundColor = $color->backgroundColor;
                        $evento->borderColor = $color->borderColor;
                        $evento->textColor = $color->textColor;
                        array_push($eventosTodo, $evento);
                    }
                }
                return json_encode($eventosTodo);
                break;
            case 1:
                try {
                    $event = new Calendar();
                    $event->ID_USUARIO = $request->ID_USUARIO;
                    $event->title = $request->title;
                    $event->start = $request->start;
                    $event->end = $request->end;
                    $event->ID_EVENTOS = $request->ID_EVENTOS;
                    $event->save();
                    return redirect()->action([CalendarController::class, "index"]);
                } catch (Exception $e) {
                    Log::error('El error es este', ['Error ' => $e]);
                    return redirect()->action([CalendarController::class, "index"]);
                }

                break;
            case 2:
                try {
                    $event = Calendar::find($request->id);
                    $event->ID_USUARIO = $request->ID_USUARIO;
                    $event->start = $request->start;
                    $event->end = $request->end;
                    $event->title = $request->title;
                    $event->ID_EVENTOS = $request->ID_EVENTOS;
                    $event->save();
                    return redirect()->action([CalendarController::class, "index"]);
                } catch (Exception $e) {
                    return redirect()->action([CalendarController::class, "index"]);
                }
                break;
            case 3:
                try {
                    $event = Calendar::find($request->id);
                    $event->delete();
                    return redirect()->action([CalendarController::class, "index"]);
                } catch (Exception $e) {

                    return redirect()->action([CalendarController::class, "index"]);
                }
                break;
            default:
                break;
        }
    }
}
