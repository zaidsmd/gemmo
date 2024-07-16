<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Licence;
use App\Models\Materiel;
use App\services\LocaleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TableauBordController extends Controller
{
    public function liste(){
        $local_id = LocaleService::getLocaleId();
        $material_total = Materiel::where('locale_id',$local_id)->count();
        $categorie_materiel_total = Category::where('type','materiel')->count();
        $licences_total = Licence::where('locale_id',$local_id)->count();
        $categorie_licence_total = Category::where('type','licence')->count();
        $licences = Licence::where('locale_id',$local_id)->whereDate('date_expiration','<=',Carbon::now()->addMonth())->get(['id','nom','date_expiration']);
        return view('tableau_bord',compact('material_total','categorie_materiel_total','licences_total','categorie_licence_total','licences'));
    }
    public function category_materiel(){
        if (\request()->ajax()){
            $query = Category::where('type','materiel');
            $table = DataTables::of($query);

            $table->addColumn('nombre',function ($row){
                return $row->materiel()->count();
            });
            return $table->make();
        }
    }
}
