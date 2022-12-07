<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'event';

    protected $fillable  = [
        'id',
        'evento',
        'borderColor',
        'textColor',
        'backgroundColor',
        'borrado'
    ];
    /**
     * busca los eventos creados en la base de datos que no esten dados de baja
     */
    public function findEvents(){
        return DB::table($this->table)->where('borrado' , 0)->select()->get();
    }
    /**
     * encuentra el evento en especifico
     */
    public function findEvent($id){
        return DB::table($this->table)->where('id' , $id)->first();
    }
}
