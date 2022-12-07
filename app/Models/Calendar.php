<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'calendar';

    protected $fillable = [
        'ID_USUARIO',
        'start',
        'end',
        'title',
        'ID_EVENTOS'
    ];
    /**
     * Hace una busqueda en la base de datos y recoge las citas de cada usuario
     */
    public function findCitas(){
        return DB::table($this->table)->where('ID_USUARIO' , Auth::user()->id)->get();
    }
}
