<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerModel extends Model
{
    public function AllMasCustomer(){        
        return DB::table('mastercustomer')->whereRaw('hapus = 0')->get();
    }
    public function SatuMasCustomer($customer){        
        return DB::table('mastercustomer')->whereRaw('id = '.$customer)->get();
    }

    public function addData($data)
    {
        return DB::table('mastercustomer')->insert($data);
    }

    public function updateData($data)
    {
        return DB::table('mastercustomer')->where('id','=',$data["id"])->update($data);
    }

    public function hapusData($id)
    {
        return DB::table('mastercustomer')->where('id','=',$id)->delete();
    }
}
