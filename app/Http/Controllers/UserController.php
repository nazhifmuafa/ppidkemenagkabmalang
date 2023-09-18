<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DynamicTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function index(){

        $categoryImages = [
            'Pendma' => 'img/imageuser/seksi/graduation.png',
            'Haji' => 'img/imageuser/seksi/kaaba.png',
            'Sekjen' =>'img/imageuser/seksi/founder.png',
            'Pontren' =>'img/imageuser/seksi/window.png',
            'PAI' =>'img/imageuser/seksi/quran.png',
            'Bimas' =>'img/imageuser/seksi/ramadan.png',
            'Syariah' =>'img/imageuser/seksi/zakat.png',
            'Katolik' =>'img/imageuser/seksi/church.png',
            'Buddha' =>'img/imageuser/seksi/temple.png',
            'Kristen' =>'img/imageuser/seksi/building.png',
            'Hindu' =>'img/imageuser/seksi/pagoda.png',
        ];

        $categoryNames = [
            'Pendma' => 'Pendidikan Madrasah',
            'Haji' => 'Haji dan Umroh',
            'Sekjen' =>'Sekretaris Jenderal',
            'Pontren' =>'Pondok Pesantren',
            'PAI' =>'Pendidikan Agama Islam',
            'Bimas' =>'Bimbingan Masyarakat',
            'Syariah' =>'Syariah',
            'Katolik' =>'Katolik',
            'Buddha' =>'Budha',
            'Kristen' =>'Kristen',
            'Hindu' =>'Hindu',
        ];

        $dynamicTables = DynamicTable::all();
        $dynamicTableCategories = $dynamicTables->groupBy('category');

        return view('user.home', ['dynamicTableCategories' => $dynamicTableCategories, 'categoryImages' => $categoryImages, 'categoryNames' => $categoryNames]);
    }

}
