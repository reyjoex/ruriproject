<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuModel;
use App\Models\CustomerModel;

class CustomerController extends Controller
{
    public function __construct(){
        $this->MenuModel = new MenuModel();
        $this->CustomerModel = new CustomerModel();       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'nama' => 'Customer',
            'section1' => 'Daftar',
            'menu' => $this->MenuModel->DataMenu(),
            'submenu' => $this->MenuModel->DataSubmenu(),
            'allMasCustomer' => $this->CustomerModel->AllMasCustomer(),
        ];
        return view('vcustomer',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'nama' => 'Barang',
            'section1' => 'Baru',
            'menu' => $this->MenuModel->DataMenu(),
            'submenu' => $this->MenuModel->DataSubmenu(),
            'allMasCustomer' => $this->CustomerModel->AllMasCustomer(),
        ];       
        return view('vcustomer',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Customer_Name' => 'required|unique:mastercustomer,Customer_Name|min:3|max:20',
            'Fiscal_Address' => 'required|min:3|max:50',
            'City' => 'required|min:3|max:20',
            'Phone_Customer' => 'required|min:3|max:15',
            'Postal_Code_Customer' => 'required|min:3|max:15',
            'Fax_Customer' => 'required|min:3|max:15',
            'NPWP_Customer' => 'required|unique:mastercustomer,NPWP_Customer|min:3|max:20',
            'NPPKP_Customer' => 'required|unique:mastercustomer,NPPKP_Customer|min:3|max:15',
            'Delivery_Address' => 'required|min:3|max:50',
            'City_Delivery' => 'required|min:3|max:20',
            'Phone_Delivery' => 'required|min:3|max:15',
            'Postal_Code_Delivery' => 'required|min:3|max:6',
            'Fax_Delivery' => 'required|min:3|max:15',
            'Contact_Person' => 'required|min:3|max:15',
            'Title' => 'required|min:1|max:5',
            'Phone_Extension' => 'required|min:3|max:5',
            'Finance_Manager' => 'required|min:3|max:20',
            'HP_Contact' => 'required|min:3|max:15',
            'Email_Contact' => 'required|min:3|max:20',
            'Acct_Payable_Contact' => 'required|min:3|max:15',
            'HP_Acct' => 'required|min:3|max:15',
            'Email_Acct' => 'required|min:3|max:20',
            'Bank_Account_No' => 'required|min:3|max:20',
            'Bank_Name_Branch' => 'required|min:3|max:30',
            'Currency' => 'required|min:1|max:5',
            
        ],[
            'Customer_Name.required'=>'wajib diisi !!',
            'Customer_Name.unique'=>'Sudah ada',            
            'Customer_Name.min'=>'minimal 3 karakter',
            'Customer_Name.max'=>'maximal 50 karakter',
            'Fiscal_Address.required'=>'wajib diisi !!',
            'Fiscal_Address.min'=>'minimal 3 karakter',
            'Fiscal_Address.max'=>'maximal 50 karakter',
            'City.required'=>'wajib diisi !!',
            'City.min'=>'minimal 3 karakter',
            'City.max'=>'maximal 20 karakter',
            'Phone_Customer.required'=>'wajib diisi !!',
            'Phone_Customer.min'=>'minimal 3 karakter',
            'Phone_Customer.max'=>'maximal 15 karakter',
            'Postal_Code_Customer.required'=>'wajib diisi !!',
            'Postal_Code_Customer.min'=>'minimal 3 karakter',
            'Postal_Code_Customer.max'=>'maximal 15 karakter',
            'Fax_Customer.required'=>'wajib diisi !!',
            'Fax_Customer.min'=>'minimal 3 karakter',
            'Fax_Customer.max'=>'maximal 15 karakter',
            'NPWP_Customer.required'=>'wajib diisi !!',
            'NPWP_Customer.unique'=>'Sudah ada',
            'NPWP_Customer.min'=>'minimal 3 karakter',
            'NPWP_Customer.max'=>'maximal 20 karakter',
            'NPPKP_Customer.required'=>'wajib diisi !!',
            'NPPKP_Customer.unique'=>'Sudah ada',
            'NPPKP_Customer.min'=>'minimal 3 karakter',
            'NPPKP_Customer.max'=>'maximal 15 karakter',
            'Delivery_Address.required'=>'wajib diisi !!',
            'Delivery_Address.unique'=>'Sudah ada',
            'Delivery_Address.min'=>'minimal 3 karakter',
            'Delivery_Address.max'=>'maximal 50 karakter',
            'City_Delivery.required'=>'wajib diisi !!',            
            'City_Delivery.min'=>'minimal 3 karakter',
            'City_Delivery.max'=>'maximal 20 karakter',
            'Phone_Delivery.required'=>'wajib diisi !!',
            'Phone_Delivery.min'=>'minimal 3 karakter',
            'Phone_Delivery.max'=>'maximal 15 karakter',
            'Postal_Code_Delivery.required'=>'wajib diisi !!',
            'Postal_Code_Delivery.min'=>'minimal 3 karakter',
            'Postal_Code_Delivery.max'=>'maximal 6 karakter',
            'Fax_Delivery.required'=>'wajib diisi !!',
            'Fax_Delivery.min'=>'minimal 3 karakter',
            'Fax_Delivery.max'=>'maximal 15 karakter',
            'Contact_Person.required'=>'wajib diisi !!',
            'Contact_Person.min'=>'minimal 3 karakter',
            'Contact_Person.max'=>'maximal 15 karakter',
            'Title.required'=>'wajib diisi !!',
            'Title.min'=>'minimal 1 karakter',
            'Title.max'=>'maximal 5 karakter',
            'Phone_Extension.required'=>'wajib diisi !!',
            'Phone_Extension.min'=>'minimal 3 karakter',
            'Phone_Extension.max'=>'maximal 5 karakter',
            'Finance_Manager.required'=>'wajib diisi !!',
            'Finance_Manager.min'=>'minimal 3 karakter',
            'Finance_Manager.max'=>'maximal 20 karakter',
            'HP_Contact.required'=>'wajib diisi !!',
            'HP_Contact.min'=>'minimal 3 karakter',
            'HP_Contact.max'=>'maximal 15 karakter',
            'Email_Contact.required'=>'wajib diisi !!',
            'Email_Contact.min'=>'minimal 3 karakter',
            'Email_Contact.max'=>'maximal 20 karakter',
            'Acct_Payable_Contact.required'=>'wajib diisi !!',
            'Acct_Payable_Contact.min'=>'minimal 3 karakter',
            'Acct_Payable_Contact.max'=>'maximal 20 karakter',
            'HP_Acct.required'=>'wajib diisi !!',
            'HP_Acct.min'=>'minimal 3 karakter',
            'HP_Acct.max'=>'maximal 20 karakter',
            'Email_Acct.required'=>'wajib diisi !!',
            'Email_Acct.min'=>'minimal 3 karakter',
            'Email_Acct.max'=>'maximal 20 karakter',
            'Bank_Account_No.required'=>'wajib diisi !!',
            'Bank_Account_No.min'=>'minimal 3 karakter',
            'Bank_Account_No.max'=>'maximal 20 karakter',
            'Bank_Name_Branch.required'=>'wajib diisi !!',
            'Bank_Name_Branch.min'=>'minimal 3 karakter',
            'Bank_Name_Branch.max'=>'maximal 30 karakter',
            'Currency.required'=>'wajib diisi !!',
            'Currency.min'=>'minimal 1 karakter',
            'Currency.max'=>'maximal 5 karakter',
            
        ]);

        $data = [
            'Customer_Name' => $request->Customer_Name,
            'Fiscal_Address' => $request->Fiscal_Address,
            'City' => $request->City,
            'Phone_Customer' => $request->Phone_Customer,
            'Postal_Code_Customer' => $request->Postal_Code_Customer,
            'Fax_Customer' => $request->Fax_Customer,
            'NPWP_Customer' => $request->NPWP_Customer,
            'NPPKP_Customer' => $request->NPPKP_Customer,
            'Delivery_Address' => $request->Delivery_Address,
            'City_Delivery' => $request->City_Delivery,
            'Phone_Delivery' => $request->Phone_Delivery,
            'Postal_Code_Delivery' => $request->Postal_Code_Delivery,
            'Fax_Delivery' => $request->Fax_Delivery,
            'Contact_Person' => $request->Contact_Person,
            'Title' => $request->Title,
            'Phone_Extension' => $request->Phone_Extension,
            'Finance_Manager' => $request->Finance_Manager,
            'HP_Contact' => $request->HP_Contact,
            'Email_Contact' => $request->Email_Contact,
            'Acct_Payable_Contact' => $request->Acct_Payable_Contact,
            'HP_Acct' => $request->HP_Acct,
            'Email_Acct' => $request->Email_Acct,
            'Bank_Account_No' => $request->Bank_Account_No,
            'Bank_Name_Branch' => $request->Bank_Name_Branch,
            'Currency' => $request->Currency,
            'iduser' => $request->iduser,
        ];
        $this->CustomerModel->addData($data);
        return redirect()->route('customer')->with('pesan','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($customer)
    {
        $data = [
            'nama' => 'Barang',
            'section1' => 'Detail',
            'menu' => $this->MenuModel->DataMenu(),
            'submenu' => $this->MenuModel->DataSubmenu(),
            'satuMasCustomer' =>  json_decode(json_encode($this->CustomerModel->SatuMasCustomer($customer)[0]), true),
        ];       
        return view('vcustomer',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($customer)
    {
        $data = [
            'nama' => 'Barang',
            'section1' => 'Edit',
            'menu' => $this->MenuModel->DataMenu(),
            'submenu' => $this->MenuModel->DataSubmenu(),
            'satuMasCustomer' =>  json_decode(json_encode($this->CustomerModel->SatuMasCustomer($customer)[0]), true),
        ];       
        return view('vcustomer',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'Customer_Name' => 'required|min:3|max:20',
            'Fiscal_Address' => 'required|min:3|max:50',
            'City' => 'required|min:3|max:20',
            'Phone_Customer' => 'required|min:3|max:15',
            'Postal_Code_Customer' => 'required|min:3|max:15',
            'Fax_Customer' => 'required|min:3|max:15',
            'NPWP_Customer' => 'required|min:3|max:20',
            'NPPKP_Customer' => 'required|min:3|max:15',
            'Delivery_Address' => 'required|min:3|max:50',
            'City_Delivery' => 'required|min:3|max:20',
            'Phone_Delivery' => 'required|min:3|max:15',
            'Postal_Code_Delivery' => 'required|min:3|max:6',
            'Fax_Delivery' => 'required|min:3|max:15',
            'Contact_Person' => 'required|min:3|max:15',
            'Title' => 'required|min:1|max:5',
            'Phone_Extension' => 'required|min:3|max:5',
            'Finance_Manager' => 'required|min:3|max:20',
            'HP_Contact' => 'required|min:3|max:15',
            'Email_Contact' => 'required|min:3|max:20',
            'Acct_Payable_Contact' => 'required|min:3|max:15',
            'HP_Acct' => 'required|min:3|max:15',
            'Email_Acct' => 'required|min:3|max:20',
            'Bank_Account_No' => 'required|min:3|max:20',
            'Bank_Name_Branch' => 'required|min:3|max:30',
            'Currency' => 'required|min:1|max:5',
            
        ],[
            'Customer_Name.required'=>'wajib diisi !!',
            'Customer_Name.unique'=>'Sudah ada',            
            'Customer_Name.min'=>'minimal 3 karakter',
            'Customer_Name.max'=>'maximal 50 karakter',
            'Fiscal_Address.required'=>'wajib diisi !!',
            'Fiscal_Address.min'=>'minimal 3 karakter',
            'Fiscal_Address.max'=>'maximal 50 karakter',
            'City.required'=>'wajib diisi !!',
            'City.min'=>'minimal 3 karakter',
            'City.max'=>'maximal 20 karakter',
            'Phone_Customer.required'=>'wajib diisi !!',
            'Phone_Customer.min'=>'minimal 3 karakter',
            'Phone_Customer.max'=>'maximal 15 karakter',
            'Postal_Code_Customer.required'=>'wajib diisi !!',
            'Postal_Code_Customer.min'=>'minimal 3 karakter',
            'Postal_Code_Customer.max'=>'maximal 15 karakter',
            'Fax_Customer.required'=>'wajib diisi !!',
            'Fax_Customer.min'=>'minimal 3 karakter',
            'Fax_Customer.max'=>'maximal 15 karakter',
            'NPWP_Customer.required'=>'wajib diisi !!',
            'NPWP_Customer.unique'=>'Sudah ada',
            'NPWP_Customer.min'=>'minimal 3 karakter',
            'NPWP_Customer.max'=>'maximal 20 karakter',
            'NPPKP_Customer.required'=>'wajib diisi !!',
            'NPPKP_Customer.unique'=>'Sudah ada',
            'NPPKP_Customer.min'=>'minimal 3 karakter',
            'NPPKP_Customer.max'=>'maximal 15 karakter',
            'Delivery_Address.required'=>'wajib diisi !!',
            'Delivery_Address.unique'=>'Sudah ada',
            'Delivery_Address.min'=>'minimal 3 karakter',
            'Delivery_Address.max'=>'maximal 50 karakter',
            'City_Delivery.required'=>'wajib diisi !!',            
            'City_Delivery.min'=>'minimal 3 karakter',
            'City_Delivery.max'=>'maximal 20 karakter',
            'Phone_Delivery.required'=>'wajib diisi !!',
            'Phone_Delivery.min'=>'minimal 3 karakter',
            'Phone_Delivery.max'=>'maximal 15 karakter',
            'Postal_Code_Delivery.required'=>'wajib diisi !!',
            'Postal_Code_Delivery.min'=>'minimal 3 karakter',
            'Postal_Code_Delivery.max'=>'maximal 6 karakter',
            'Fax_Delivery.required'=>'wajib diisi !!',
            'Fax_Delivery.min'=>'minimal 3 karakter',
            'Fax_Delivery.max'=>'maximal 15 karakter',
            'Contact_Person.required'=>'wajib diisi !!',
            'Contact_Person.min'=>'minimal 3 karakter',
            'Contact_Person.max'=>'maximal 15 karakter',
            'Title.required'=>'wajib diisi !!',
            'Title.min'=>'minimal 1 karakter',
            'Title.max'=>'maximal 5 karakter',
            'Phone_Extension.required'=>'wajib diisi !!',
            'Phone_Extension.min'=>'minimal 3 karakter',
            'Phone_Extension.max'=>'maximal 5 karakter',
            'Finance_Manager.required'=>'wajib diisi !!',
            'Finance_Manager.min'=>'minimal 3 karakter',
            'Finance_Manager.max'=>'maximal 20 karakter',
            'HP_Contact.required'=>'wajib diisi !!',
            'HP_Contact.min'=>'minimal 3 karakter',
            'HP_Contact.max'=>'maximal 15 karakter',
            'Email_Contact.required'=>'wajib diisi !!',
            'Email_Contact.min'=>'minimal 3 karakter',
            'Email_Contact.max'=>'maximal 20 karakter',
            'Acct_Payable_Contact.required'=>'wajib diisi !!',
            'Acct_Payable_Contact.min'=>'minimal 3 karakter',
            'Acct_Payable_Contact.max'=>'maximal 20 karakter',
            'HP_Acct.required'=>'wajib diisi !!',
            'HP_Acct.min'=>'minimal 3 karakter',
            'HP_Acct.max'=>'maximal 20 karakter',
            'Email_Acct.required'=>'wajib diisi !!',
            'Email_Acct.min'=>'minimal 3 karakter',
            'Email_Acct.max'=>'maximal 20 karakter',
            'Bank_Account_No.required'=>'wajib diisi !!',
            'Bank_Account_No.min'=>'minimal 3 karakter',
            'Bank_Account_No.max'=>'maximal 20 karakter',
            'Bank_Name_Branch.required'=>'wajib diisi !!',
            'Bank_Name_Branch.min'=>'minimal 3 karakter',
            'Bank_Name_Branch.max'=>'maximal 30 karakter',
            'Currency.required'=>'wajib diisi !!',
            'Currency.min'=>'minimal 1 karakter',
            'Currency.max'=>'maximal 5 karakter',
            
        ]);

        $data = [
            'id' => $request->id,
            'Customer_Name' => $request->Customer_Name,
            'Fiscal_Address' => $request->Fiscal_Address,
            'City' => $request->City,
            'Phone_Customer' => $request->Phone_Customer,
            'Postal_Code_Customer' => $request->Postal_Code_Customer,
            'Fax_Customer' => $request->Fax_Customer,
            'NPWP_Customer' => $request->NPWP_Customer,
            'NPPKP_Customer' => $request->NPPKP_Customer,
            'Delivery_Address' => $request->Delivery_Address,
            'City_Delivery' => $request->City_Delivery,
            'Phone_Delivery' => $request->Phone_Delivery,
            'Postal_Code_Delivery' => $request->Postal_Code_Delivery,
            'Fax_Delivery' => $request->Fax_Delivery,
            'Contact_Person' => $request->Contact_Person,
            'Title' => $request->Title,
            'Phone_Extension' => $request->Phone_Extension,
            'Finance_Manager' => $request->Finance_Manager,
            'HP_Contact' => $request->HP_Contact,
            'Email_Contact' => $request->Email_Contact,
            'Acct_Payable_Contact' => $request->Acct_Payable_Contact,
            'HP_Acct' => $request->HP_Acct,
            'Email_Acct' => $request->Email_Acct,
            'Bank_Account_No' => $request->Bank_Account_No,
            'Bank_Name_Branch' => $request->Bank_Name_Branch,
            'Currency' => $request->Currency,
            'iduser' => 1,
        ];      
        $this->CustomerModel->updatedata($data);
        return redirect()->route('customer')->with('pesan','Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $data = ['hapus' => 1,'iduser' => $iduser,];
        $this->CustomerModel->hapusData($id);
        return redirect()->route('customer')->with('pesan','Data berhasil dihapus');
    }
}
