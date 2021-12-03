<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\Datatables\Datatables;



use Illuminate\Http\Request;
use App\HomeModel;
use App\Kategori;
use App\Models\Rumah;
use Illuminate\Support\Facades\DB;
use App\Models\Province;
use App\Models\City;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {


    //GET ALL PROVINCE
        $data = [];
        $data['provincess'] = Province::orderby("name","asc")
                    ->select('id','name')->where('id',36)->get();
    //    
        $city = City::orderby("name","asc")
                    ->select('id','name')->where('id',3603)->get();

        $data['kategori'] = Kategori::all();

     

        $dataku = Kecamatan::withCount('masjid','mushola','gerejakeristen','gerejakatolik','purehindu','purebudha','kelenteng')->orderBy('name','asc')->get();
        

        $datakuid = Kecamatan::with('rumah')->withCount('masjid','mushola','gerejakeristen','gerejakatolik','purehindu','purebudha','kelenteng')->orderBy('name','asc')->get();
        

    //   dd($datakuid);
      
       
       
     

        
      

    
        // ->join('indonesia_cities', 'rumah_ibadah.city_id', '=', 'indonesia_cities.id')
        // ->where('kategori.id','=',1)
        // // ->select('rumah.*', 'contacts.phone', 'orders.price')
        // ->get();
    
        $data['dataAngkaMasjid'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',1)->get();
        $data['angkaMasjid'] = $data['dataAngkaMasjid']->count();
        $data['dataAngkaMushola'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',2)->get();
        $data['angkaMushola'] = $data['dataAngkaMushola']->count();
        $data['dataGerejaKristen'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',3)->get();
        $data['angkaGerejaKristen'] = $data['dataGerejaKristen']->count();
        $data['dataGerejaKatolik'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',4)->get();
        $data['angkaGerejaKatolik'] = $data['dataGerejaKatolik']->count();
        $data['dataPureHindu'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',5)->get();
        $data['angkaPureHindu'] = $data['dataPureHindu']->count();
        $data['dataPureBudha'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',6)->get();
        $data['angkaPureBudha'] = $data['dataPureBudha']->count();
        $data['dataKelenteng'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',7)->get();
        $data['angkaKelenteng']= $data['dataKelenteng']->count();
        return view('layout.dashboard.indexone',compact('data','dataku','datakuid','city'));
    }

    public function getKelurahan(Request $request, $district_id){

        $datakuid = Kelurahan::with('rumah')->withCount('masjid','mushola','gerejakeristen','gerejakatolik','purehindu','purebudha','kelenteng')->orderBy('name','asc')->where('district_id',$request->district_id)->get();
        // dd($datakuid);

        // MENGHITUNG JUMLAH KATERGORI SELURUH KOTA, KELURAHAN DAN KECAMATAN
        $data['dataAngkaMasjid'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',1)->get();
        $data['angkaMasjid'] = $data['dataAngkaMasjid']->count();
        $data['dataAngkaMushola'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',2)->get();
        $data['angkaMushola'] = $data['dataAngkaMushola']->count();
        $data['dataGerejaKristen'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',3)->get();
        $data['angkaGerejaKristen'] = $data['dataGerejaKristen']->count();
        $data['dataGerejaKatolik'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',4)->get();
        $data['angkaGerejaKatolik'] = $data['dataGerejaKatolik']->count();
        $data['dataPureHindu'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',5)->get();
        $data['angkaPureHindu'] = $data['dataPureHindu']->count();
        $data['dataPureBudha'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',6)->get();
        $data['angkaPureBudha'] = $data['dataPureBudha']->count();
        $data['dataKelenteng'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',7)->get();
        $data['angkaKelenteng']= $data['dataKelenteng']->count();
        return view('layout.dashboard.datakelurahan',compact('data','datakuid','datakuid'));
    }




    public function getCitys($province_id){

        $citysData['data'] = City::orderby("name","asc")
                   ->select('province_id','name')
                   ->where('province_id',$province_id)
                   ->get();
        echo( $citysData['data']);exit;
       return response()->json($citysData);
   }


   public function getDistrict($city_id){

    $districtData['data'] = Kecamatan::orderby("name","asc")
               // ->select('province_id','id','name')
               ->where('city_id',$city_id)
               ->get();
    // echo( $citysData['data']);exit;
   return response()->json($districtData);
}

public function getVillages($district_id){

        $villagesData['data'] = Kelurahan::orderby("name","asc")
                // ->select('province_id','id','name')
                ->where('district_id',$district_id)
                ->get();
        
        // echo( $citysData['data']);exit;
        return response()->json($villagesData);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //GET ALL PROVINCE
        $provincess = Province::orderby("name","asc")
                    ->select('id','name')->where('id',36)->get();
    //    
        $city= City::orderby("name","asc")
                    ->select('id','name')->where('id',3603)->get();

        
        $kategori = Kategori::all();
        return view('layout.rumah.add',compact('provincess','city','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    

    public function dataindex(Request $request)
    {
        //
        // DATA SATUAN
        $villages_id = $request->village;
        $kategori_id = $request->kategory;
        $getDataByKelurahan = Rumah::where('villages_id','=',$villages_id)->where('kategori_id','=',$kategori_id)->get();
        // dd($getDataByKelurahan);
        // MENGHITUNG JUMLAH KATERGORI SELURUH KOTA, KELURAHAN DAN KECAMATAN
        $data['dataAngkaMasjid'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',1)->get();
        $data['angkaMasjid'] = $data['dataAngkaMasjid']->count();
        $data['dataAngkaMushola'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',2)->get();
        $data['angkaMushola'] = $data['dataAngkaMushola']->count();
        $data['dataGerejaKristen'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',3)->get();
        $data['angkaGerejaKristen'] = $data['dataGerejaKristen']->count();
        $data['dataGerejaKatolik'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',4)->get();
        $data['angkaGerejaKatolik'] = $data['dataGerejaKatolik']->count();
        $data['dataPureHindu'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',5)->get();
        $data['angkaPureHindu'] = $data['dataPureHindu']->count();
        $data['dataPureBudha'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',6)->get();
        $data['angkaPureBudha'] = $data['dataPureBudha']->count();
        $data['dataKelenteng'] = Rumah::with('kota','kecamatan','kelurahan','kategoris')->select('kategori_id')->where('kategori_id',7)->get();
        $data['angkaKelenteng']= $data['dataKelenteng']->count();
       
        return view('layout.dashboard.datadetail',compact('data','getDataByKelurahan'));

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HomeModel  $homeModel
     * @return \Illuminate\Http\Response
     */
    public function show(HomeModel $homeModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomeModel  $homeModel
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeModel $homeModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomeModel  $homeModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeModel $homeModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomeModel  $homeModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeModel $homeModel)
    {
        //
    }
}
