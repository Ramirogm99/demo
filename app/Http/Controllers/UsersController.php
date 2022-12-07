<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    //
    protected $userModel;

    public function __construct(User $usuarios)
    {
        $this->userModel = $usuarios;
    }
    /**
     * Se devuelve la vista de los usuarios solo para el admin
     */
    public function indexAdmin()
    {
        $usuarios = $this->userModel->UsersFind();
        return view('logged.adminUser', ['usuarios' => $usuarios]);
    }
    public function create(){
        return view('logged.createUser');
    }
    /**
     * Guardas el usuario creado y se genera un log si se produce un fallo
     */
    public function createUser(Request $request)
    {

        try {
            $usuario = new User($request->all());
            $usuario->password = Hash::make($request->password);
            $usuario->borrado = 0;
            $usuario->auth_level = 6;
            $usuario->save();
        } catch (Exception $e) {
            Log::error('El usuario : ' . Auth::user()->name . ' ha creado un usuario en la base de datos ', ['usuario ' => $usuario]);
        }
        return redirect()->action([UsersController::class, "indexAdmin"]);

    }
    /**
     * Se recibe el usuario para editarlo y se devuelve una vista
     */
    public function editUser($id)
    {
        
        $usuario = $this->userModel->UserFind($id);
        return view('logged.user', ['usuario' => $usuario]);
    }
    /**
     * Se guarda el cambio en el usuario
     */
    public function saveEdit(Request $request)
    {
        
        try {
            $usuario = User::find($request->id);
            $usuario->name = $request->name;
            $usuario->password = $request->password;
            $usuario->email = $request->email;

            $usuario->save();
            Log::info('El usuario : ' . Auth::user()->name . ' ha actualizado un usuario en la base de datos ', ['usuario' => $usuario]);
        } catch (Exception $e) {
            Log::error('El usuario : ' . Auth::user()->name . ' ha intentado actualizar un usuario en la base de datos ', ['usuario' => $usuario]);
            
        }
        return redirect()->action([UsersController::class, "indexAdmin"]);
    }
    /**
     * Hace un soft delete del usuario para evitar problemas en la base de datos
     */
    public function deleteUser(Request $request)
    {
        try {
            $usuario = User::find($request->id);
            $usuario->borrado = 1;
            $usuario->save();
        } catch (Exception $e) {
            Log::error('El usuario : ' . Auth::user()->name . ' ha borrado un usuario en la base de datos ', ['usuario ' => $usuario]);
        }
        return redirect()->action([UsersController::class, "indexAdmin"]);

    }
}
