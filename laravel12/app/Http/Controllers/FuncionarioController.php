<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class FuncionarioController extends Controller
{
    public function index() {
        Gate::authorize('viewAny', Funcionario::class);
        
        $funcionarios = Funcionario::orderBy('id','desc')->get();
        return view('funcionario.index', compact('funcionarios'));
    }

    public function create() {
        Gate::authorize('create', Funcionario::class);
        
        $turnos = ['gerente', 'entrada', 'saida'];
        return view('funcionario.create', compact('turnos'));
    }

    public function store(Request $request) {
        Gate::authorize('create', Funcionario::class);

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:funcionarios,email',
            'senha' => 'required|string|min:4',
            'turno' => 'required|in:gerente,entrada,saida',
            'foto' => 'nullable|image|max:2048'
        ]);

        $func = new Funcionario();
        $func->nome = mb_strtoupper($request->nome, 'UTF-8');
        $func->email = $request->email;
        $func->senha = Hash::make($request->senha);
        $func->turno = $request->turno; // Apenas turno, sem role_id

        $func->save();

        if($request->hasFile('foto')) {
            $ext = $request->file('foto')->getClientOriginalExtension();
            $name = $func->id.'_'.time().'.'.$ext;
            $request->file('foto')->storeAs('funcionarios', $name, ['disk' => 'public']);
            $func->foto = 'funcionarios/'.$name;
            $func->save();
        }

        return redirect()->route('funcionario.index');
    }

    public function edit(string $id) {
        $func = Funcionario::find($id);

        if(!isset($func)) {
            return redirect()->route('funcionario.index');
        }

        Gate::authorize('update', $func);
        
        $turnos = ['gerente', 'entrada', 'saida'];
        return view('funcionario.edit', compact(['func','turnos']));
    }

    public function update(Request $request, string $id) {
        $func = Funcionario::find($id);

        if(!isset($func)) {
            return redirect()->route('funcionario.index');
        }

        Gate::authorize('update', $func);

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:funcionarios,email,'.$func->id,
            'turno' => 'required|in:gerente,entrada,saida',
            'foto' => 'nullable|image|max:2048'
        ]);

        $func->nome = mb_strtoupper($request->nome, 'UTF-8');
        $func->email = $request->email;
        $func->turno = $request->turno; 

        if($request->filled('senha')) {
            $func->senha = Hash::make($request->senha);
        }

        if($request->hasFile('foto')) {
            $ext = $request->file('foto')->getClientOriginalExtension();
            $name = $func->id.'_'.time().'.'.$ext;
            $request->file('foto')->storeAs('funcionarios', $name, ['disk' => 'public']);
            $func->foto = 'funcionarios/'.$name;
        }

        $func->save();

        return redirect()->route('funcionario.index');
    }

    public function destroy(string $id) {
        $func = Funcionario::find($id);

        if(!isset($func)) {
            return redirect()->route('funcionario.index');
        }

        Gate::authorize('delete', $func);

        $func->delete(); 

        return redirect()->route('funcionario.index');
    }
}