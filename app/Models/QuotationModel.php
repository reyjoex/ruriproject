<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuotationModel extends Model
{
    public function batalData($data,$id){
        return DB::table('quotation')->where('id','=',$id)->update($data);

    }
    public function addData($data){
        return DB::table('quotation')->insert($data);
    }

    public function TopCustomer(){
        return DB::table('quotation')
        ->select('quotation.Nomor_Quotation','quotation.Format_Nomor')        
        ->orderBy('quotation.Nomor_Quotation','desc')
        ->limit(1)
        ->whereRaw('quotation.hapus = 0')        
        ->get();      
    }
    
    public function DraftDetailQuotation($noqdraft){
        return DB::table('quotation')
        ->select('quotation.id','quotation.Nomor_Quotation','quotation.Nama_Barang','quotation.Merk_Barang','quotation.hapus',
        'quotation.Quantity_Barang','quotation.Harga_Barang',DB::raw('quotation.Quantity_Barang * quotation.Harga_Barang as jumlah'))
        ->whereRaw('quotation.Nomor_Quotation ='.$noqdraft)
        ->orderBy('quotation.Nama_Barang','asc')        
        ->get();
    }

    public function EditDetailBarang($id){
        return DB::table('quotation')
        ->select('quotation.id','quotation.Nomor_Quotation','quotation.Nama_Barang','quotation.Merk_Barang','quotation.hapus',
        'quotation.Quantity_Barang','quotation.Harga_Barang',DB::raw('quotation.Quantity_Barang * quotation.Harga_Barang as jumlah'),
        'quotation.Format_Nomor','quotation.Tanggal_Quotation','quotation.idcustomer','quotation.Keterangan')
        ->whereRaw('quotation.id ='.$id)
        ->orderBy('quotation.Nama_Barang','asc')        
        ->get();
    }    

    public function EditDetailQuotation($cari){
        return DB::table('quotation')
        ->select('quotation.id','quotation.Nomor_Quotation','quotation.Nama_Barang','quotation.Merk_Barang','quotation.hapus',
        'quotation.Quantity_Barang','quotation.Harga_Barang',DB::raw('quotation.Quantity_Barang * quotation.Harga_Barang as jumlah'),
        'quotation.Format_Nomor','quotation.Tanggal_Quotation','quotation.idcustomer','quotation.Keterangan')
        ->whereRaw('quotation.idcustomer ='.$cari->idcustomer)
        ->whereRaw('quotation.tanggal_quotation ="'.$cari->Tanggal_Quotation.'"')
        ->whereRaw('quotation.nomor_quotation ='.$cari->Nomor_Quotation)
        ->orderBy('quotation.Nama_Barang','asc')        
        ->get();
    }    

    public function KepalaQuotation(){
        return DB::table('quotation')
        ->select('quotation.id', 'quotation.idcustomer','mastercustomer.Customer_Name','quotation.Tanggal_Quotation','quotation.Nomor_Quotation','quotation.Format_Nomor','quotation.status')
        ->leftJoin('mastercustomer', 'quotation.idcustomer', '=', 'mastercustomer.id')
        ->groupBy('mastercustomer.Customer_Name','quotation.Tanggal_Quotation','quotation.Nomor_Quotation')
        ->whereRaw('quotation.hapus = 0')->get();
    }

    public function cariIdKepala($id){
        return DB::table('quotation')
        ->select('quotation.id','quotation.idcustomer','quotation.Tanggal_Quotation','quotation.Nomor_Quotation')
        ->whereRaw('quotation.id ='.$id)->get();
    }


}
