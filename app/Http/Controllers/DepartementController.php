<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\services\LocaleService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepartementController extends Controller
{

    public function liste(Request $request){
        if ($request->ajax()){

            $query = Departement::where('locale_id',LocaleService::getLocaleId());
            $table = DataTables::of($query);

            $table->addColumn('actions',function ($row){
               $edit_modal = ['url'=>route('departements.modifier',$row->id),'modal_id'=>'edit-cat-modal'];
               $delete = route('departements.supprimer',$row->id);
               return view('layouts.partials.__datatable-action',compact('edit_modal','delete'));
            })->addColumn(
                'selectable_td',
                function ($contact) {
                    $id = $contact->id;
                    return '<input type="checkbox" class="row-select form-check-input" value="' . $id . '">';
                }
            )->rawColumns(['actions','selectable_td']);
            return $table->make();
        }
        return view('departements.liste');
    }

    public function sauvegarder(Request $request){
        $request->validate([
            'i_nom'=>'required|string|min:2|max:255'
        ]);
        Departement::create(['nom' => $request->get('i_nom'),'locale_id' => LocaleService::getLocaleId()]);
        session()->flash('success','Emplacement ajouté !');
        return redirect()->route('departements.liste');
    }

    public function modifier($id){
        $departement = Departement::findOrfail($id);
        return view('departements.partials.modifier_modal',compact('departement'));
    }

    public function mettre_a_jour(Request $request, $id){
        $request->validate([
            'i_nom'=>'required|string|min:2|max:255'
        ]);
        $departement = Departement::findOrfail($id);
        $departement->update([
            'nom' => $request->get('i_nom')
        ]);
        session()->flash('success','Emplacement mettre à jour !');
        return redirect()->route('departements.liste');
    }

    public function supprimer($id){
        $departement = Departement::findOrfail($id);
        $departement->delete();
        return response('Emplacement supprimée',200);
    }
}
