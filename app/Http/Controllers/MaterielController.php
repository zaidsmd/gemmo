<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Materiel;
use App\Models\MaterielHistorique;
use App\Models\User;
use App\services\LocaleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class MaterielController extends Controller
{
    public function liste(Request $request)
    {
        if ($request->ajax()) {

            $query = Materiel::where('locale_id',LocaleService::getLocaleId())->get();
            $table = DataTables::of($query);

            $table->addColumn('actions', function ($row) {
                $edit = route('materiels.modifier', $row->id);
                $delete = route('materiels.supprimer', $row->id);
                $show = route('materiels.afficher', $row->id);
                return view('layouts.partials.__datatable-action', compact('edit', 'delete', 'show'));
            })->addColumn(
                'selectable_td',
                function ($contact) {
                    $id = $contact->id;
                    return '<input type="checkbox" class="row-select form-check-input" value="' . $id . '">';
                }
            )->rawColumns(['actions', 'selectable_td']);
            return $table->make();
        }
        return view('materials.liste');
    }

    public function ajouter()
    {
        $departments = Departement::where('locale_id',LocaleService::getLocaleId())->get();
        return view('materials.ajouter',compact('departments'));
    }

    public function afficher($id)
    {
        $materiel = Materiel::findOrFail($id);
        $historique = MaterielHistorique::where('materiel_id',$id)->get();
        return view('materials.afficher', compact('materiel','historique'));
    }

    public function sauvegarder(Request $request)
    {
        $request->validate([
            'i_nom' => 'required|string|min:1|max:255',
            'i_marque' => "nullable|string|min:1|max:255",
            'i_serial' => "nullable|string",
            'i_inventaire' => "nullable|string",
            'i_description' => "nullable|string",
            'i_statut' => 'required',
            'i_departement'=>'nullable|exists:departements,id',
            'i_category' => 'nullable|exists:categories,id',
            'i_prix_achat'=>'nullable|numeric|min:0',
            'i_quatite'=>'nullable|numeric|min:0',
        ]);
        $image = null;
        if ($request->file('i_image')) {
            $file = $request->file('i_image');
            $fileName = $this->store_article_image($file);
            $image = $fileName;
        }
        Materiel::create([
            'nom' => $request->get('i_nom'),
            'marque' => $request->get('i_marque'),
            'serial' => $request->get('i_serial'),
            'inventaire' => $request->get('i_inventaire'),
            'description' => $request->get('i_description'),
            'statut' => $request->get('i_statut'),
            'category_id' => $request->get('i_category'),
            'image' => $image,
            'prix_achat' => $request->input('i_prix_achat') ?? 0,
            'quantite' => $request->input('i_quantite') ?? 0,
            'departement_id' => $request->input('i_departement') ?? null,
            'locale_id' => LocaleService::getLocaleId()
        ]);
        session()->flash('success', 'Matériel ajouté !');
        return redirect()->route('materiels.liste');
    }

    public function modifier($id)
    {
        $materiel = Materiel::findOrfail($id);
        $departements = Departement::where('locale_id',LocaleService::getLocaleId())->get();
        return view('materials.modifier', compact('materiel','departements'));
    }

    public function mettre_a_jour(Request $request, $id)
    {
        $request->validate([
            'i_nom' => 'required|string|min:1|max:255',
            'i_marque' => "nullable|string|min:1|max:255",
            'i_serial' => "nullable|string",
            'i_inventaire' => "nullable|string",
            'i_description' => "nullable|string",
            'i_statut' => 'required',
            'i_departement'=>'nullable|exists:departements,id',
            'i_category' => 'nullable|exists:categories,id',
            'i_prix_achat'=>'nullable|numeric|min:0',
            'i_quatite'=>'nullable|numeric|min:0',
        ]);
        $materiel = Materiel::findOrfail($id);
        $old_departement = $materiel->departement_id;
        $image = $materiel->image;
        if ($request->file('i_image')) {
            $file = $request->file('i_image');
            $fileName = $this->store_article_image($file);
            $image = $fileName;
        } elseif ($request->get('i_supprimer_image') == '1') {
            $image = null;
        }
        $materiel->update([
            'nom' => $request->get('i_nom'),
            'marque' => $request->get('i_marque'),
            'serial' => $request->get('i_serial'),
            'inventaire' => $request->get('i_inventaire'),
            'description' => $request->get('i_description'),
            'statut' => $request->get('i_statut'),
            'category_id' => $request->get('i_category'),
            'prix_achat' => $request->input('i_prix_achat') ?? 0,
            'quantite' => $request->input('i_quantite') ?? 0,
            'departement_id' => $request->input('i_departement') ?? null,
            'image' => $image
        ]);
        if ($old_departement != $request->input('i_departement')){
            $this->add_history($materiel->id,"Transféré à l'emplacement ".$materiel->departement->nom);
        }else {
            $this->add_history($materiel->id,'Modification par '.auth()->user()->name);
        }
        session()->flash('success', 'Matériel mettre à jour !');
        return redirect()->route('materiels.liste');
    }

    public function attacher(Request $request)
    {
        $user = User::findOrFail($request->get('user'));
        $materiel = Materiel::findOrFail($request->get('materiel'));
        if ($materiel->employe()->exists()){
            session()->flash('warning', 'Matériel est déja attaché !');
            return redirect()->route('materiels.afficher',$materiel->id);
        }
        $materiel->employe()->attach($user->id);
        $this->add_history($materiel->id,'Attaché à '.$materiel->employe->first()->name);
        session()->flash('success', 'Matériel attaché !');
        return redirect()->route('materiels.afficher',$materiel->id);

    }
    public function dettacher(Request $request,$id)
    {
        $materiel = Materiel::findOrFail($id);
        $this->add_history($materiel->id,'Détaché de '.$materiel->employe->first()->name);
        DB::table('materiel_user')->where('materiel_id',$id)->where('current',1)->update(['current'=>0,'updated_at'=>Carbon::now()]);
        session()->flash('success', 'Matériel Détaché !');
        return redirect()->route('materiels.afficher',$materiel->id);

    }

    public function supprimer($id)
    {
        $materiel = Materiel::findOrfail($id);
        $materiel->delete();
        return response('Matériel supprimée', 200);
    }

    function store_article_image($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = 'public' . DIRECTORY_SEPARATOR . 'materiels' . DIRECTORY_SEPARATOR . $fileName;
        Storage::put($path, file_get_contents($file));
        return $fileName;
    }

    function add_history($materiel_id,$action){
        MaterielHistorique::create([
            'materiel_id' => $materiel_id,
            'action' => $action,
            'date' => Carbon::now()
        ]);
    }
}
