<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function liste(Request $request,$type){
        if ($request->ajax()){

            $query = Category::where('type',$type);
            $table = DataTables::of($query);

            $table->addColumn('actions',function ($row){
                $edit_modal = ['url'=>route('category.modifier',$row->id),'modal_id'=>'edit-cat-modal'];
                $delete = route('category.supprimer',$row->id);
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
        return view('categories.liste',compact('type'));
    }

    public function sauvegarder(Request $request){
        $request->validate([
            'i_nom'=>'required|string|min:2|max:255'
        ]);
        Category::create(['nom' => $request->get('i_nom'),'type'=>$request->input('i_type')]);
        session()->flash('success','Catégorie ajouté !');
        return redirect()->route('category.liste',$request->input('type'));
    }

    public function modifier($id){
        $category = Category ::findOrfail($id);
        return view('categories.partials.modifier_modal',compact('category'));
    }

    public function mettre_a_jour(Request $request, $id){
        $request->validate([
            'i_nom'=>'required|string|min:2|max:255'
        ]);
        $category = Category::findOrfail($id);
        $category->update([
            'nom' => $request->get('i_nom')
        ]);
        session()->flash('success','Catégorie mettre à jour !');
        return redirect()->route('category.liste',$category->type);
    }

    public function supprimer($id){
        $category = Category::findOrfail($id);
        $category->delete();
        return response('Catégorie supprimée',200);
    }
    public function select(Request $request,$type){
        if ($request->ajax()) {
            $search = '%' . $request->get('term') . '%';
            $data = Category::where('nom', 'LIKE', $search)->where('type',$type)->get(['id', 'nom as text']);
            return response()->json($data, 200);
        }
        abort(404);
    }
}
