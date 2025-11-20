<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FuncionarioController extends Controller
{
    public function index() {
        $funcionarios = Funcionario::orderBy('id','desc')->get();
        return view('funcionario.index', compact('funcionarios'));
    }

    public function create() {
        $turnos = [
            'gerente',
            'manha_par_entrada','manha_par_saida',
            'manha_impar_entrada','manha_impar_saida',
            'noite_par_entrada','noite_par_saida',
            'noite_impar_entrada','noite_impar_saida'
        ];

        return view('funcionario.create', compact('turnos'));
    }

    public function store(Request $request) {

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:funcionarios,email',
            'senha' => 'required|string|min:4',
            'turno' => 'required|string',
            'foto' => 'nullable|image|max:2048'
        ]);

        $func = new Funcionario();
        $func->nome = mb_strtoupper($request->nome, 'UTF-8');
        $func->email = $request->email;
        $func->senha = Hash::make($request->senha);
        $func->turno = $request->turno;
        $func->is_gerente = ($request->turno === 'gerente');

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

        $turnos = [
            'gerente',
            'manha_par_entrada','manha_par_saida',
            'manha_impar_entrada','manha_impar_saida',
            'noite_par_entrada','noite_par_saida',
            'noite_impar_entrada','noite_impar_saida'
        ];

        return view('funcionario.edit', compact(['func','turnos']));
    }

    public function update(Request $request, string $id) {
        $func = Funcionario::find($id);

        if(!isset($func)) {
            return redirect()->route('funcionario.index');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:funcionarios,email,'.$func->id,
            'turno' => 'required|string',
            'foto' => 'nullable|image|max:2048'
        ]);

        $func->nome = mb_strtoupper($request->nome, 'UTF-8');
        $func->email = $request->email;
        $func->turno = $request->turno;
        $func->is_gerente = ($request->turno === 'gerente');

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

        if(isset($func)) {
            $func->delete(); 
        }

        return redirect()->route('funcionario.index');
    }
}