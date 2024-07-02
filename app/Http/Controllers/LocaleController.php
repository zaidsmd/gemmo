<?php

namespace App\Http\Controllers;

use App\Models\Locale;
use App\services\LocaleService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LocaleController extends Controller
{
    public function liste(Request $request){
        if ($request->ajax()){

            $query = Locale::all();
            $table = DataTables::of($query);

            $table->addColumn('actions',function ($row){
                $edit_modal = ['url'=>route('locales.modifier',$row->id),'modal_id'=>'edit-cat-modal'];
                $delete = route('locales.supprimer',$row->id);
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
        return view('locales.liste');
    }
    public function sauvegarder(Request $request){
        $request->validate([
            'i_nom'=>'required|string|min:2|max:255'
        ]);
        Locale::create(['nom' => $request->get('i_nom')]);
        LocaleService::setSessionLocales();
        session()->flash('success','Locale ajouté !');
        return redirect()->route('locales.liste');
    }

    public function modifier($id){
        $locale = Locale::findOrfail($id);
        return view('locales.partials.modifier_modal',compact('locale'));
    }

    public function mettre_a_jour(Request $request, $id){
        $request->validate([
            'i_nom'=>'required|string|min:2|max:255'
        ]);
        $locale = Locale::findOrfail($id);
        $locale->update([
            'nom' => $request->get('i_nom')
        ]);
        LocaleService::setSessionLocales();
        session()->flash('success','Locale mettre à jour !');
        return redirect()->route('locales.liste');
    }

    public function supprimer($id){
        if ($id == LocaleService::getLocaleId()){
            return  response('Ce locale est utilisé, vous ne pouvez pas le supprimer',400);
        }
        $locale = Locale::findOrfail($id);
        $locale->delete();
        LocaleService::setSessionLocales();
        return response('Locale supprimée',200);
    }

    public function change(Request  $request){
        $request->validate(['locale'=>'exists:locales,id']);
        LocaleService::setSessionLocale($request->get('locale'));
        return response('Locale changé');
    }
}
