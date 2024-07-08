<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Licence;
use App\Models\LicenceHistorique;
use App\Models\Materiel;
use App\Models\MaterielHistorique;
use App\Models\User;
use App\services\LocaleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LicenceController extends Controller
{
    public function liste(Request $request)
    {
        if ($request->ajax()) {
            $query = Licence::all();
            $table = \DataTables::of($query);

            $table->addColumn('actions', function ($row) {
                $edit = route('licences.modifier', $row->id);
                $delete = route('licences.supprimer', $row->id);
                $show = route('licences.afficher', $row->id);
                return view('layouts.partials.__datatable-action', compact('edit', 'delete', 'show'));
            })->addColumn(
                'selectable_td',
                function ($contact) {
                    $id = $contact->id;
                    return '<input type="checkbox" class="row-select form-check-input" value="' . $id . '">';
                }
            )->editColumn('category_id',function ($row){
                return $row->category_id ?$row->category->nom : null;
            })->editColumn('date_expiration',function ($row){
                return $row->date_expiration ? Carbon::make($row->date_expiration)->format('d/m/Y') : null;
            })->rawColumns(['actions', 'selectable_td']);
            return $table->make();
        }
        return view('licences.liste');
    }
    public function afficher($id){
        $licence = Licence::findOrFail($id);
        $historique = LicenceHistorique::where('licence_id',$id)->get();
        return view('licences.afficher',compact('licence','historique'));
    }
    public function ajouter()
    {
        $departements = Departement::where('locale_id', LocaleService::getLocaleId())->get();
        return view('licences.ajouter', compact('departements'));
    }

    public function sauvegarder(Request $request)
    {
        Validator::make($request->all(), [
            "i_category" => "exists:categories,id",
            "i_nom" => "nullable|string|max:255",
            "i_date_achat" => "nullable|date_format:d/m/Y",
            "i_date_expiration" => "nullable|date_format:d/m/Y",
            "i_description" => "nullable|string",
            "i_departement" => "nullable|exists:departements,id",
            "i_prix_achat" => "nullable|numeric",
            "i_quantite" => "nullable|numeric|min:1",
        ]);
        Licence::create([
            'nom' => $request->input('i_nom'),
            'date_achat' => $request->input('i_date_achat') ? Carbon::createFromFormat('d/m/Y',$request->input('i_date_achat'))->toDateString() : null,
            'date_expiration' => $request->input('i_date_expiration') ? Carbon::createFromFormat('d/m/Y',$request->input('i_date_expiration'))->toDateString() : null,
            'description' => $request->input('i_description'),
            'departement_id' => $request->input('i_departement')??null,
            'i_prix_achat' => $request->input('i_prix_achat'),
            'quantite' => $request->input('i_quantite') ?? 0,
            'locale_id' => LocaleService::getLocaleId(),
            'category_id' => $request->input('i_category'),
        ]);
        session()->flash('success','Licence ajouté');
        return redirect()->route('licences.liste');
    }

    public function modifier($id)
    {
        $licence = Licence::findOrfail($id);
        $departements = Departement::where('locale_id',LocaleService::getLocaleId())->get();
        return view('licences.modifier', compact('licence','departements'));
    }

    public function mettre_a_jour(Request $request, $id)
    {
        $request->validate([
            "i_category" => "exists:categories,id",
            "i_nom" => "nullable|string|max:255",
            "i_date_achat" => "nullable|date_format:d/m/Y",
            "i_date_expiration" => "nullable|date_format:d/m/Y",
            "i_description" => "nullable|string",
            "i_departement" => "nullable|exists:departements,id",
            "i_prix_achat" => "nullable|numeric",
            "i_quantite" => "nullable|numeric|min:1",
        ]);
        $licence = Licence::findOrfail($id);
        $old_departement = $licence->departement_id;
        $licence->update([
            'nom' => $request->input('i_nom'),
            'date_achat' => $request->input('i_date_achat') ? Carbon::createFromFormat('d/m/Y',$request->input('i_date_achat'))->toDateString() : null,
            'date_expiration' => $request->input('i_date_expiration') ? Carbon::createFromFormat('d/m/Y',$request->input('i_date_expiration'))->toDateString() : null,
            'description' => $request->input('i_description'),
            'departement_id' => $request->input('i_departement')??null,
            'i_prix_achat' => $request->input('i_prix_achat'),
            'quantite' => $request->input('i_quantite') ?? 0,
            'category_id' => $request->input('i_category'),

        ]);
        if ($old_departement != $request->input('i_departement')){
            $this->add_history($licence->id,"Transféré à l'emplacement ".$licence->departement->nom);
        }else {
            $this->add_history($licence->id,'Modification par '.auth()->user()->name);
        }
        session()->flash('success', 'Licence mettre à jour !');
        return redirect()->route('licences.liste');
    }

    public function attacher(Request $request)
    {
        $user = User::findOrFail($request->get('user'));
        $licence = Licence::findOrFail($request->get('licence'));
        if ($licence->employe()->exists()){
            session()->flash('warning', 'Licence est déja attaché !');
            return redirect()->route('licences.afficher',$licence->id);
        }
        $licence->employe()->attach($user->id);
        $this->add_history($licence->id,'Attaché à '.$licence->employe->first()->name);
        session()->flash('success', 'Licence attaché !');
        return redirect()->route('licences.afficher',$licence->id);

    }
    public function dettacher(Request $request,$id)
    {
        $licence = Licence::findOrFail($id);
        $this->add_history($licence->id,'Détaché de '.$licence->employe->first()->name);
        DB::table('licence_user')->where('licence_id',$id)->where('current',1)->update(['current'=>0,'updated_at'=>Carbon::now()]);
        session()->flash('success', 'Licence Détaché !');
        return redirect()->route('licences.afficher',$licence->id);

    }

    public function supprimer($id){
        Licence::findOrFail($id)->delete();
        return response('Licence supprimée !');
    }

    function add_history($licence_id, $action){
        LicenceHistorique::create([
            'licence_id' => $licence_id,
            'action' => $action,
            'date' => Carbon::now()
        ]);
    }
}
