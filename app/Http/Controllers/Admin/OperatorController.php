<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index() {
        return view('admin.operator.index', ['operators' => \App\Models\User::where('role', 'operator')->orderBy('name')->paginate(10)]);
    }

    public function create() {
        return view('admin.operator.form');
    }

    public function store(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        
        $data['role'] = 'operator';
        $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);

        // Set role secara eksplisit (bukan via fillable) — keamanan mass assignment
        $user = new \App\Models\User($data);
        $user->role = 'operator';
        $user->save();

        \App\Models\ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => 'Menambahkan Akun Operator: ' . $data['name'],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
        return redirect('/admin/operator')->with('success', 'Akun operator berhasil dibuat!');
    }

    public function edit($id) {
        return view('admin.operator.form', ['operator' => \App\Models\User::findOrFail($id)]);
    }

    public function update(\Illuminate\Http\Request $request, $id) {
        $operator = \App\Models\User::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:8|confirmed'
        ]);
        
        if (!empty($data['password'])) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        
        $operator->update($data);
        \App\Models\ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => 'Update Akun Operator: ' . $data['name'],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
        return redirect('/admin/operator')->with('success', 'Akun operator berhasil diupdate!');
    }

    public function destroy($id) {
        $operator = \App\Models\User::findOrFail($id);
        if ($operator->id == auth()->id()) abort(403, 'Aksi dilarang.');
        $operator->delete();
        \App\Models\ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => 'Menghapus Akun Operator',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
        return back()->with('success', 'Akun operator dihapus!');
    }
}
