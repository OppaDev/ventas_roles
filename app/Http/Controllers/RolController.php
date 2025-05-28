<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    public function crear() {
        $role = Role::create(['name' => 'ADMIN']);
        session()->flash('success', 'Rol creado exitosamente.');
        return redirect()->route('dashboard');
    }
}
