<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class MaterielController extends Controller
{
    public function liste(Request $request)
    {
        if ($request->ajax()) {

            $query = Materiel::all();
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
        return view('materials.ajouter');
    }

    public function afficher($id)
    {
        $materiel = Materiel::findOrFail($id);
        return view('materials.afficher', compact('materiel'));
    }

    public function sauvegarder(Request $request)
    {
        $request->validate([
            'i_nom' => 'required|string|min:1|max:255',
            'i_marque' => "nullable|string|min:1|max:255",
            'i_serial' => "nullable|numeric",
            'i_inventaire' => "nullable|string",
            'i_description' => "nullable|string",
            'i_statut' => 'required',
            'i_category' => 'nullable|exists:categories,id'
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
            'image' => $image
        ]);
        session()->flash('success', 'Matériel ajouté !');
        return redirect()->route('materiels.liste');
    }

    public function modifier($id)
    {
        $materiel = Materiel::findOrfail($id);
        return view('materials.modifier', compact('materiel'));
    }

    public function mettre_a_jour(Request $request, $id)
    {
        $request->validate([
            'i_nom' => 'required|string|min:1|max:255',
            'i_marque' => "nullable|string|min:1|max:255",
            'i_serial' => "nullable|numeric",
            'i_inventaire' => "nullable|string",
            'i_description' => "nullable|string",
            'i_statut' => 'required',
            'i_category' => 'nullable|exists:categories,id'
        ]);
        $materiel = Materiel::findOrfail($id);
        $materiel->update([
            'nom' => $request->get('i_nom'),
            'marque' => $request->get('i_marque'),
            'serial' => $request->get('i_serial'),
            'inventaire' => $request->get('i_inventaire'),
            'description' => $request->get('i_description'),
            'statut' => $request->get('i_statut'),
            'category_id' => $request->get('i_category')
        ]);
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
        session()->flash('success', 'Matériel attaché !');
        return redirect()->route('materiels.afficher',$materiel->id);

    }
    public function dettacher(Request $request,$id)
    {
        $materiel = Materiel::findOrFail($id);
        DB::table('materiel_user')->where('materiel_id',$id)->update(['current'=>0]);
        session()->flash('success', 'Matériel attaché !');
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
}
