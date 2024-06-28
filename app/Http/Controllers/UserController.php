<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function liste(Request $request){
        if ($request->ajax())
        {
            $query = User::all();
            $table = DataTables::of($query);

            $table->addColumn('actions',function ($row){
                $edit = route('users.modifier',$row->id);
                $delete = route('users.supprimer',$row->id);
                return view('layouts.partials.__datatable-action',compact('edit','delete'));
            })->editColumn('loggable',function ($row){
                return $row->loggable ? 'Oui' : 'Non';
            })->addColumn(
                'selectable_td',
                function ($row) {
                    $id = $row->id;
                    return '<input type="checkbox" class="row-select form-check-input" value="' . $id . '">';
                }
            )->rawColumns(['actions','selectable_td']);
            return $table->make();
        }
        return view('users.liste');
    }

    public function ajouter(){
        return view('users.ajouter');
    }

    public function sauvegarder(Request $request){
        $request->validate([
            'i_nom'=>'required|string|min:1|max:255',
            'i_email'=>'required|email',
            'i_post'=>'required|string|max:255',
            'i_loggable'=>'nullable',
           'i_password'=>'nullable|string|max:255',
        ]);
        User::create([
            'name' => $request->get('i_nom'),
            'email' => $request->get('i_email'),
            'post' => $request->get('i_post'),
            'loggable' =>(bool) $request->get('i_loggable'),
            'password' => $request->get('i_loggable') ? ($request->get('i_password')? Hash::make($request->get('i_password')) : "0") : "0",
        ]);
        session()->flash('success','Employé ajouté');
        return redirect()->route('users.liste');
    }

    public function modifier($id){
        $user = User::findOrFail($id);
        return view('users.modifier',compact('user'));
    }

    public function mettre_a_jour(Request $request, $id){
        $request->validate([
            'i_nom'=>'required|string|min:1|max:255',
            'i_email'=>'required|email',
            'i_post'=>'required|string|max:255',
            'i_loggable'=>'nullable',
            'i_password'=>'required_with:i_loggable',
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->get('i_nom'),
            'email' => $request->get('i_email'),
            'post' => $request->get('i_post'),
            'loggable' =>(bool) $request->get('i_loggable'),
            'password' => $request->get('i_loggable') ? Hash::make($request->get('i_password')) : "0",
        ]);
        session()->flash('success','Employé mettre à jour !');
        return redirect()->route('users.liste');

    }

    public function supprimer($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response('Employé supprimé',200);
    }
    public function select(Request $request){
        if ($request->ajax()) {
            $search = '%' . $request->get('term') . '%';
            $data = User::where('name', 'LIKE', $search)->get(['id', 'name as text']);
            return response()->json($data, 200);
        }
        abort(404);
    }
}
