<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VendorModel extends Model
{
    public function AllMasVendor(){        
        return DB::table('mastervendor')->whereRaw('hapus = 0')->get();
    }
    public function SatuMasVendor($vendor){        
        return DB::table('mastervendor')->whereRaw('id = '.$vendor)->get();
    }

    public function addData($data)
    {
        return DB::table('mastervendor')->insert($data);
    }

    public function updateData($data)
    {
        return DB::table('mastervendor')->where('id','=',$data["id"])->update($data);
    }

    public function hapusData($id)
    {
        return DB::table('mastervendor')->where('id','=',$id)->delete();
    }
}
