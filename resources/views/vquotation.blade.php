@extends('layout.vtemplate')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title col-11">{{ $section1 }}</h3>
                        @if ($section1  == 'Header')
                            <a href="addquotation" class="badge badge-primary badge-pill">Tambah</a>
                        @else
                            <a href="{{ url('quotation') }}" class="badge badge-primary badge-pill">Kembali</a>
                        @endif
                    </div>
                    <div class="card-body scroll">
                        @if(session('pesan') and $section1 != 'Baru')
                            <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Sukses!</h5>                            
                            {{ session('pesan') }}.
                            </div>
                        @endif
                        
                        @if ($section1  == 'Header')
                            <table id="tblquotation" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Customer Name</th>
                                        <th>Tanggal</th>   
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($KepalaQuotation as $index =>  $data)                                        
                                    <tr>
                                        <td class="tdw50">{{$index+1}}</td>
                                        <td>{{$data->Customer_Name}}</td>
                                        <td>{{$data->Tanggal_Quotation}}</td>
                                        <td>{{$data->status}}</td>
                                        <td class="tdw105">
                                            <a href="detailquotation/{{$data->id}}" class="badge rounded-pill bg-success">Detail</a>
                                            <!-- <a href="detailquotation/{{$data->idcustomer}}/{{$data->Tanggal_Quotation}}/{{$data->Nomor_Quotation}}" class="badge rounded-pill bg-success">Detail</a> -->
                                            <!-- <a href="destroycustomer/{{$data->id}}" class="badge rounded-pill bg-danger">Hapus</a> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @elseif ($section1  == 'Baru')
                            <form action="storequotation" method="post">
                                @csrf
                                <input type="hidden" id="iduser" name="iduser" value="1">
                                <div class="row">
                                    <div class="col col-sm-5">                                    
                                        <div class="form-group row">
                                            <label for="Nomor_Quotation" class="col-sm-5 col-form-label">Nomor Quotation</label>
                                            <div class="col-sm-2">
                                                <input type="text" value="{{ ($TopCustomer[0]==0)?old('Nomor_Quotation'):$TopCustomer[0] }}" class="form-control @error('Nomor_Quotation') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="4" id="Nomor_Quotation" name="Nomor_Quotation" placeholder="No" {{ ($TopCustomer[2]!="")?"Readonly":"" }}>
                                                @error('Nomor_Quotation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-5">                                            
                                                <input type="text" value="{{ ($TopCustomer[1]=='')?old('Format_Nomor'):$TopCustomer[1] }}" class="form-control @error('Format_Nomor') is-invalid @enderror" id="Format_Nomor" name="Format_Nomor" placeholder="Format Nomor" {{ ($TopCustomer[2]!="")?"Readonly":"" }}>
                                                @error('Format_Nomor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>                                        
                                        </div>

                                        <div class="form-group row">
                                            <label for="Tgl_Quotation" class="col-sm-5 col-form-label">Tanggal Quotation</label>
                                            <div class="col-sm-7">
                                                <input type="date" value="{{ date('Y-m-d') }}" class="form-control @error('Tanggal_Quotation') is-invalid @enderror" id="Tanggal_Quotation" name="Tanggal_Quotation" placeholder="Tanggal Quotation"  {{ ($TopCustomer[2]!='')?"Readonly":"" }}>
                                                @error('Tanggal_Quotation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Nama_Customer" class="col-sm-5 col-form-label">Nama Customer</label>
                                            <div class="col-sm-7">
                                                <select name="Nama_Customer" value="{{ old('idcustomer') }}" id="Nama_Customer" class="form-control @error('Nama_Customer') is-invalid @enderror"  {{ ($TopCustomer[2]!="")?"Readonly":"" }}>
                                                    <option value=0>Pilih</option>
                                                    @foreach ($AllMasCustomer as $customer)
                                                        <option value="{{$customer->id}}" {{ ($TopCustomer[2]==$customer->id?"selected":"") }}>{{$customer->Customer_Name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('Nama_Customer')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Nama_Barang" class="col-sm-5 col-form-label">Nama Barang</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Nama_Barang') }}" class="form-control @error('Nama_Barang') is-invalid @enderror" id="Nama_Barang" name="Nama_Barang" placeholder="Nama Barang">
                                                @error('Nama_Barang')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                            <div class="form-group row">
                                            <label for="Merk_Barang" class="col-sm-5 col-form-label">Merk Barang</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Merk_Barang') }}" class="form-control @error('Merk_Barang') is-invalid @enderror" id="Merk_Barang" name="Merk_Barang" placeholder="Merk Barang">
                                                @error('Merk_Barang')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Quantity_Barang" class="col-sm-5 col-form-label">Quantity Barang</label>
                                            <div class="col-sm-7">
                                                <input type="number" value="{{ old('Quantity_Barang') }}" class="form-control @error('Quantity_Barang') is-invalid @enderror" id="Quantity_Barang" name="Quantity_Barang" placeholder="Quantity Barang">
                                                @error('Quantity_Barang')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Harga_Barang" class="col-sm-5 col-form-label">Harga Barang</label>
                                            <div class="col-sm-7">
                                                <input type="number" value="{{ old('Harga_Barang') }}" class="form-control @error('Harga_Barang') is-invalid @enderror" id="Harga_Barang" name="Harga_Barang" placeholder="Harga Barang">
                                                @error('Harga_Barang')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Keterangan" class="col-sm-5 col-form-label">Keterangan</label>
                                            <div class="col-sm-7">
                                                <!-- <input type="text" value="{{ old('Keterangan') }}" class="form-control @error('Keterangan') is-invalid @enderror" id="Keterangan" name="Keterangan" placeholder="Keterangan"> -->
                                                <textarea class="form-control" id="Keterangan" name="Keterangan" rows="3" placeholder="Keterangan">{{ old('Keterangan') }}</textarea>
                                                @error('Keterangan')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>                                        
                                        </div>
                                    </div>
                                    <div class="col col-sm-5">                                    
                                        <table id="tbldraft" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Merk</th>   
                                                <th>Harga</th>   
                                                <th>Quantity</th>
                                                <th>Jumlah</th>                                            
                                                <th>Action</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                            @foreach ($DraftDetailQuotation as $index =>  $data)
                                                <tr>
                                                    <td>{{$index+1}}</td>
                                                    <td>{{$data->Nama_Barang}}</td>
                                                    <td>{{$data->Merk_Barang}}</td>
                                                    <td>{{$data->Harga_Barang}}</td>
                                                    <td>{{$data->Quantity_Barang}}</td>
                                                    <td>{{$data->jumlah}}</td>
                                                    <td>
                                                    <a href="/bataldrafquot/{{$data->id}}" class="badge rounded-pill bg-danger">{{($data->hapus==0)?"Batal":''}}</a>
                                                    <!-- @if ($data->hapus==0)
                                                        <a href="bataldrafquot/{{$data->id}}" class="badge rounded-pill bg-success">Batal</a>    
                                                    @endif -->
                                                    
                                                    </td>
                                                </tr>
                                            @endforeach 
                                        </tbody>
                                        </table>
                                        
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col col-sm-1">
                                        <input type="submit" value="Simpan">
                                    </div>
                                    <div class="col">
                                        <input type="submit" value="Cancel">
                                    </div>
                                </div>
                            </form>                        
                        @elseif ($section1  == 'Edit')
                            <form action="/updatecustomer" method="post">
                            <input type="hidden" id="iduser" name="iduser" value="1">
                                @csrf
                                <input type="hidden" id="id" name="id" value="{{ $satuMasCustomer['id'] }}">
                                <div class="row">
                                    <div class="col col-sm-5">
                                        <div class="form-group row">
                                            <label for="Customer_Name" class="col-sm-5 col-form-label">Customer Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Customer_Name'] }}" class="form-control @error('Customer_Name') is-invalid @enderror" id="Customer_Name" name="Customer_Name" placeholder="Customer Name">
                                                @error('Customer_Name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Fiscal_Address" class="col-sm-5 col-form-label">Fiscal Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Fiscal_Address'] }}" class="form-control @error('Fiscal_Address') is-invalid @enderror" id="Fiscal_Address" name="Fiscal_Address" placeholder="Fiscal Address">
                                                @error('Fiscal_Address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="City" class="col-sm-5 col-form-label">City</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['City'] }}" class="form-control @error('City') is-invalid @enderror" id="City" name="City" placeholder="City">
                                                @error('City')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Phone_Customer" class="col-sm-5 col-form-label">Phone Customer</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Phone_Customer'] }}" class="form-control @error('Phone_Customer') is-invalid @enderror" id="Phone_Customer" name="Phone_Customer" placeholder="Phone Customer">
                                                @error('Phone_Customer')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-sm-5">                                        
                                        <div class="form-group row">
                                            <label for="Postal_Code_Customer" class="col-sm-5 col-form-label">Postal Code Customer</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Postal_Code_Customer'] }}" class="form-control @error('Postal_Code_Customer') is-invalid @enderror" id="Postal_Code_Customer" name="Postal_Code_Customer" placeholder="Postal Code Customer">
                                                @error('Postal_Code_Customer')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Fax_Customer" class="col-sm-5 col-form-label">Fax Customer</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Fax_Customer'] }}" class="form-control @error('Fax_Customer') is-invalid @enderror" id="Fax_Customer" name="Fax_Customer" placeholder="Fax Customer">
                                                @error('Fax_Customer')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="NPWP_Customer" class="col-sm-5 col-form-label">NPWP Customer</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['NPWP_Customer'] }}" class="form-control @error('NPWP_Customer') is-invalid @enderror" id="NPWP_Customer" name="NPWP_Customer" placeholder="NPWP Customer">
                                                @error('NPWP_Customer')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="NPPKP_Customer" class="col-sm-5 col-form-label">NPPKP Customer</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['NPPKP_Customer'] }}" class="form-control @error('NPPKP_Customer') is-invalid @enderror" id="NPPKP_Customer" name="NPPKP_Customer" placeholder="NPPKP Customer">
                                                @error('NPPKP_Customer')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col col-sm-5">
                                        <div class="form-group row">
                                            <label for="Delivery_Address" class="col-sm-5 col-form-label">Delivery Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Delivery_Address'] }}" class="form-control @error('Delivery_Address') is-invalid @enderror" id="Delivery_Address" name="Delivery_Address" placeholder="Delivery Address">
                                                @error('Delivery_Address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="City_Delivery" class="col-sm-5 col-form-label">City Delivery</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['City_Delivery'] }}" class="form-control @error('City_Delivery') is-invalid @enderror" id="City_Delivery" name="City_Delivery" placeholder="City Delivery">
                                                @error('City_Delivery')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Phone_Delivery" class="col-sm-5 col-form-label">Phone Delivery</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Phone_Delivery'] }}" class="form-control @error('Phone_Delivery') is-invalid @enderror" id="Phone_Delivery" name="Phone_Delivery" placeholder="Phone Delivery">
                                                @error('Phone_Delivery')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-sm-5">                                        
                                        <div class="form-group row">
                                            <label for="Postal_Code_Delivery" class="col-sm-5 col-form-label">Postal Code Delivery</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Postal_Code_Delivery'] }}" class="form-control @error('Postal_Code_Delivery') is-invalid @enderror" id="Postal_Code_Delivery" name="Postal_Code_Delivery" placeholder="Postal Code Delivery">
                                                @error('Postal_Code_Delivery')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Fax_Delivery" class="col-sm-5 col-form-label">Fax Delivery</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Fax_Delivery'] }}" class="form-control @error('Fax_Delivery') is-invalid @enderror" id="Fax_Delivery" name="Fax_Delivery" placeholder="Fax Delivery">
                                                @error('Fax_Delivery')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Contact_Person" class="col-sm-5 col-form-label">Contact Person</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Contact_Person'] }}" class="form-control @error('Contact_Person') is-invalid @enderror" id="Contact_Person" name="Contact_Person" placeholder="Contact Person">
                                                @error('Contact_Person')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div> 
                                <br>
                                <div class="row">
                                    <div class="col col-sm-5">
                                        <div class="form-group row">
                                            <label for="Title" class="col-sm-5 col-form-label">Title</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Title'] }}" class="form-control @error('Title') is-invalid @enderror" id="Title" name="Title" placeholder="Title">
                                                @error('Title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Phone_Extension" class="col-sm-5 col-form-label">Phone Extension</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Phone_Extension'] }}" class="form-control @error('Phone_Extension') is-invalid @enderror" id="Phone_Extension" name="Phone_Extension" placeholder="Phone Extension">
                                                @error('Phone_Extension')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Finance_Manager" class="col-sm-5 col-form-label">Finance Manager</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Finance_Manager'] }}" class="form-control @error('Finance_Manager') is-invalid @enderror" id="Finance_Manager" name="Finance_Manager" placeholder="Finance Manager">
                                                @error('Finance_Manager')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-sm-5">                                        
                                        <div class="form-group row">
                                            <label for="HP_Contact" class="col-sm-5 col-form-label">HP Contact</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['HP_Contact'] }}" class="form-control @error('HP_Contact') is-invalid @enderror" id="HP_Contact" name="HP_Contact" placeholder="HP Contact">
                                                @error('HP_Contact')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Email_Contact" class="col-sm-5 col-form-label">Email Contact</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Email_Contact'] }}" class="form-control @error('Email_Contact') is-invalid @enderror" id="Email_Contact" name="Email_Contact" placeholder="Email Contact">
                                                @error('Email_Contact')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> 
                                <br>
                                <div class="row">
                                    <div class="col col-sm-5">
                                        <div class="form-group row">
                                            <label for="Acct_Payable_Contact" class="col-sm-5 col-form-label">Acct Payable Contact</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Acct_Payable_Contact'] }}" class="form-control @error('Acct_Payable_Contact') is-invalid @enderror" id="Acct_Payable_Contact" name="Acct_Payable_Contact" placeholder="Acct Payable Contact">
                                                @error('Acct_Payable_Contact')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="HP_Acct" class="col-sm-5 col-form-label">HP Acct</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['HP_Acct'] }}" class="form-control @error('HP_Acct') is-invalid @enderror" id="HP_Acct" name="HP_Acct" placeholder="HP Acct">
                                                @error('HP_Acct')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Email_Acct" class="col-sm-5 col-form-label">Email Acct</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Email_Acct'] }}" class="form-control @error('Email_Acct') is-invalid @enderror" id="Email_Acct" name="Email_Acct" placeholder="Email Acct">
                                                @error('Email_Acct')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-sm-5">                                        
                                        <div class="form-group row">
                                            <label for="Bank_Account_No" class="col-sm-5 col-form-label">Bank Account No</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Bank_Account_No'] }}" class="form-control @error('Bank_Account_No') is-invalid @enderror" id="Bank_Account_No" name="Bank_Account_No" placeholder="Bank Account No">
                                                @error('Bank_Account_No')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Bank_Name_Branch" class="col-sm-5 col-form-label">Bank Name Branch</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Bank_Name_Branch'] }}" class="form-control @error('Bank_Name_Branch') is-invalid @enderror" id="Bank_Name_Branch" name="Bank_Name_Branch" placeholder="Bank Name Branch">
                                                @error('Bank_Name_Branch')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Currency" class="col-sm-5 col-form-label">Currency</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasCustomer['Currency'] }}" class="form-control @error('Currency') is-invalid @enderror" id="Currency" name="Currency" placeholder="Currency">
                                                @error('Currency')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col col-sm-1">
                                        <input type="submit" value="Update">
                                    </div>
                                    <div class="col">
                                        <input type="submit" value="Cancel">
                                    </div>
                                </div>
                            </form>                        
                        @elseif ($section1  == 'Detail')
                            <form action="storequotation" method="post">
                                @csrf                            
                                <div class="row">
                                    <div class="col col-sm-5">                                    
                                        <div class="form-group row">
                                            <label for="Nomor_Quotation" class="col-sm-5 col-form-label">Nomor Quotation</label>
                                            <div class="col-sm-2">
                                                <input type="text" value="{{ $Customer->Nomor_Quotation }}" class="form-control @error('Nomor_Quotation') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="4" id="Nomor_Quotation" name="Nomor_Quotation" placeholder="No">
                                                @error('Nomor_Quotation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-5">                                            
                                                <input type="text" value="{{ $Customer->Format_Nomor }}" class="form-control @error('Format_Nomor') is-invalid @enderror" id="Format_Nomor" name="Format_Nomor" placeholder="Format Nomor"}>
                                                @error('Format_Nomor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>                                        
                                        </div>

                                        <div class="form-group row">
                                            <label for="Tgl_Quotation" class="col-sm-5 col-form-label">Tanggal Quotation</label>
                                            <div class="col-sm-7">
                                                <input type="date" value="{{ $Customer->Tanggal_Quotation }}" class="form-control @error('Tanggal_Quotation') is-invalid @enderror" id="Tanggal_Quotation" name="Tanggal_Quotation" placeholder="Tanggal Quotation">
                                                @error('Tanggal_Quotation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Nama_Customer" class="col-sm-5 col-form-label">Nama Customer</label>
                                            <div class="col-sm-7">
                                                <select name="Nama_Customer" value="{{ old('idcustomer') }}" id="Nama_Customer" class="form-control @error('Nama_Customer') is-invalid @enderror">
                                                    <option value=0>Pilih</option>
                                                    @foreach ($AllMasCustomer as $customer)
                                                        <option value="{{$customer->id}}" {{ ($Customer->idcustomer==$customer->id?"selected":"") }}>{{$customer->Customer_Name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('Nama_Customer')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Nama_Barang" class="col-sm-5 col-form-label">Nama Barang</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $Customer->Nama_Barang }}" class="form-control @error('Nama_Barang') is-invalid @enderror" id="Nama_Barang" name="Nama_Barang" placeholder="Nama Barang">
                                                @error('Nama_Barang')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                            <div class="form-group row">
                                            <label for="Merk_Barang" class="col-sm-5 col-form-label">Merk Barang</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $Customer->Merk_Barang }}" class="form-control @error('Merk_Barang') is-invalid @enderror" id="Merk_Barang" name="Merk_Barang" placeholder="Merk Barang">
                                                @error('Merk_Barang')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Quantity_Barang" class="col-sm-5 col-form-label">Quantity Barang</label>
                                            <div class="col-sm-7">
                                                <input type="number" value="{{ $Customer->Quantity_Barang }}" class="form-control @error('Quantity_Barang') is-invalid @enderror" id="Quantity_Barang" name="Quantity_Barang" placeholder="Quantity Barang">
                                                @error('Quantity_Barang')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Harga_Barang" class="col-sm-5 col-form-label">Harga Barang</label>
                                            <div class="col-sm-7">
                                                <input type="number" value="{{ $Customer->Harga_Barang }}" class="form-control @error('Harga_Barang') is-invalid @enderror" id="Harga_Barang" name="Harga_Barang" placeholder="Harga Barang">
                                                @error('Harga_Barang')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Keterangan" class="col-sm-5 col-form-label">Keterangan</label>
                                            <div class="col-sm-7">
                                                <!-- <input type="text" value="{{ old('Keterangan') }}" class="form-control @error('Keterangan') is-invalid @enderror" id="Keterangan" name="Keterangan" placeholder="Keterangan"> -->
                                                <textarea class="form-control" id="Keterangan" name="Keterangan" rows="3" placeholder="Keterangan">{{ $Customer->Keterangan }}</textarea>
                                                @error('Keterangan')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>                                        
                                        </div>
                                    </div>
                                    <div class="col col-sm-5">                                    
                                        <table id="tbldraft" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Merk</th>   
                                                <th>Harga</th>   
                                                <th>Quantity</th>
                                                <th>Jumlah</th>                                            
                                                <th>Action</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @php
                                                $tampil=0;
                                            @endphp
                                            
                                            @foreach ($DraftDetailQuotation as $index =>  $data)
                                                @if ($data->hapus==0)
                                                @php
                                                $tampil=1;
                                                @endphp
                                                @endif
                                                <tr>
                                                    <td>{{$index+1}}</td>
                                                    <td><a href="/detailquotation/{{$data->id}}">{{$data->Nama_Barang}}</a></td>
                                                    <td>{{$data->Merk_Barang}}</td>
                                                    <td>{{$data->Harga_Barang}}</td>
                                                    <td>{{$data->Quantity_Barang}}</td>
                                                    <td>{{$data->jumlah}}</td>
                                                    <td>
                                                    <a href="/bataldrafquot/{{$data->id}}" class="badge rounded-pill bg-danger">{{($data->hapus==0)?"Batal":''}}</a>
                                                    <!-- @if ($data->hapus==0)
                                                        <a href="bataldrafquot/{{$data->id}}" class="badge rounded-pill bg-success">Batal</a>    
                                                    @endif -->
                                                    
                                                    </td>
                                                </tr>
                                            @endforeach 
                                        </tbody>
                                        </table>
                                        
                                    </div>                                    
                                </div>
                                <div class="row">
                                    @if ($tampil>0)
                                    <div class="col col-sm-1">
                                        <input type="submit" value="Simpan">
                                    </div>
                                    <div class="col">
                                        <input type="submit" value="Cancel">
                                    </div>
                                    @endif
                                </div>
                            </form>
                        @else
                            <form action="storecustomer" method="post">
                                @csrf
                                <input type="hidden" id="iduser" name="iduser" value="1">
                                <div class="row">
                                    <div class="col col-sm-5">
                                        <div class="form-group row">
                                            <label for="Customer_Name" class="col-sm-5 col-form-label">Customer Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Customer_Name') }}" class="form-control @error('Customer_Name') is-invalid @enderror" id="Customer_Name" name="Customer_Name" placeholder="Customer Name">
                                                @error('Customer_Name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Fiscal_Address" class="col-sm-5 col-form-label">Fiscal Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Fiscal_Address') }}" class="form-control @error('Fiscal_Address') is-invalid @enderror" id="Fiscal_Address" name="Fiscal_Address" placeholder="Fiscal Address">
                                                @error('Fiscal_Address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="City" class="col-sm-5 col-form-label">City</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('City') }}" class="form-control @error('City') is-invalid @enderror" id="City" name="City" placeholder="City">
                                                @error('City')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Phone_Customer" class="col-sm-5 col-form-label">Phone Customer</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Phone_Customer') }}" class="form-control @error('Phone_Customer') is-invalid @enderror" id="Phone_Customer" name="Phone_Customer" placeholder="Phone Customer">
                                                @error('Phone_Customer')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-sm-5">                                        
                                        <div class="form-group row">
                                            <label for="Postal_Code_Customer" class="col-sm-5 col-form-label">Postal Code Customer</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Postal_Code_Customer') }}" class="form-control @error('Postal_Code_Customer') is-invalid @enderror" id="Postal_Code_Customer" name="Postal_Code_Customer" placeholder="Postal Code Customer">
                                                @error('Postal_Code_Customer')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Fax_Customer" class="col-sm-5 col-form-label">Fax Customer</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Fax_Customer') }}" class="form-control @error('Fax_Customer') is-invalid @enderror" id="Fax_Customer" name="Fax_Customer" placeholder="Fax Customer">
                                                @error('Fax_Customer')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="NPWP_Customer" class="col-sm-5 col-form-label">NPWP Customer</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('NPWP_Customer') }}" class="form-control @error('NPWP_Customer') is-invalid @enderror" id="NPWP_Customer" name="NPWP_Customer" placeholder="NPWP Customer">
                                                @error('NPWP_Customer')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="NPPKP_Customer" class="col-sm-5 col-form-label">NPPKP Customer</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('NPPKP_Customer') }}" class="form-control @error('NPPKP_Customer') is-invalid @enderror" id="NPPKP_Customer" name="NPPKP_Customer" placeholder="NPPKP Customer">
                                                @error('NPPKP_Customer')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col col-sm-5">
                                        <div class="form-group row">
                                            <label for="Delivery_Address" class="col-sm-5 col-form-label">Delivery Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Delivery_Address') }}" class="form-control @error('Delivery_Address') is-invalid @enderror" id="Delivery_Address" name="Delivery_Address" placeholder="Delivery Address">
                                                @error('Delivery_Address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="City_Delivery" class="col-sm-5 col-form-label">City Delivery</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('City_Delivery') }}" class="form-control @error('City_Delivery') is-invalid @enderror" id="City_Delivery" name="City_Delivery" placeholder="City Delivery">
                                                @error('City_Delivery')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Phone_Delivery" class="col-sm-5 col-form-label">Phone Delivery</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Phone_Delivery') }}" class="form-control @error('Phone_Delivery') is-invalid @enderror" id="Phone_Delivery" name="Phone_Delivery" placeholder="Phone Delivery">
                                                @error('Phone_Delivery')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-sm-5">                                        
                                        <div class="form-group row">
                                            <label for="Postal_Code_Delivery" class="col-sm-5 col-form-label">Postal Code Delivery</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Postal_Code_Delivery') }}" class="form-control @error('Postal_Code_Delivery') is-invalid @enderror" id="Postal_Code_Delivery" name="Postal_Code_Delivery" placeholder="Postal Code Delivery">
                                                @error('Postal_Code_Delivery')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Fax_Delivery" class="col-sm-5 col-form-label">Fax Delivery</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Fax_Delivery') }}" class="form-control @error('Fax_Delivery') is-invalid @enderror" id="Fax_Delivery" name="Fax_Delivery" placeholder="Fax Delivery">
                                                @error('Fax_Delivery')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Contact_Person" class="col-sm-5 col-form-label">Contact Person</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Contact_Person') }}" class="form-control @error('Contact_Person') is-invalid @enderror" id="Contact_Person" name="Contact_Person" placeholder="Contact Person">
                                                @error('Contact_Person')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div> 
                                <br>
                                <div class="row">
                                    <div class="col col-sm-5">
                                        <div class="form-group row">
                                            <label for="Title" class="col-sm-5 col-form-label">Title</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Title') }}" class="form-control @error('Title') is-invalid @enderror" id="Title" name="Title" placeholder="Title">
                                                @error('Title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Phone_Extension" class="col-sm-5 col-form-label">Phone Extension</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Phone_Extension') }}" class="form-control @error('Phone_Extension') is-invalid @enderror" id="Phone_Extension" name="Phone_Extension" placeholder="Phone Extension">
                                                @error('Phone_Extension')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Finance_Manager" class="col-sm-5 col-form-label">Finance Manager</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Finance_Manager') }}" class="form-control @error('Finance_Manager') is-invalid @enderror" id="Finance_Manager" name="Finance_Manager" placeholder="Finance Manager">
                                                @error('Finance_Manager')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-sm-5">                                        
                                        <div class="form-group row">
                                            <label for="HP_Contact" class="col-sm-5 col-form-label">HP Contact</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('HP_Contact') }}" class="form-control @error('HP_Contact') is-invalid @enderror" id="HP_Contact" name="HP_Contact" placeholder="HP Contact">
                                                @error('HP_Contact')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Email_Contact" class="col-sm-5 col-form-label">Email Contact</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Email_Contact') }}" class="form-control @error('Email_Contact') is-invalid @enderror" id="Email_Contact" name="Email_Contact" placeholder="Email Contact">
                                                @error('Email_Contact')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> 
                                <br>
                                <div class="row">
                                    <div class="col col-sm-5">
                                        <div class="form-group row">
                                            <label for="Acct_Payable_Contact" class="col-sm-5 col-form-label">Acct Payable Contact</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Acct_Payable_Contact') }}" class="form-control @error('Acct_Payable_Contact') is-invalid @enderror" id="Acct_Payable_Contact" name="Acct_Payable_Contact" placeholder="Acct Payable Contact">
                                                @error('Acct_Payable_Contact')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="HP_Acct" class="col-sm-5 col-form-label">HP Acct</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('HP_Acct') }}" class="form-control @error('HP_Acct') is-invalid @enderror" id="HP_Acct" name="HP_Acct" placeholder="HP Acct">
                                                @error('HP_Acct')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Email_Acct" class="col-sm-5 col-form-label">Email Acct</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Email_Acct') }}" class="form-control @error('Email_Acct') is-invalid @enderror" id="Email_Acct" name="Email_Acct" placeholder="Email Acct">
                                                @error('Email_Acct')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-sm-5">                                        
                                        <div class="form-group row">
                                            <label for="Bank_Account_No" class="col-sm-5 col-form-label">Bank Account No</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Bank_Account_No') }}" class="form-control @error('Bank_Account_No') is-invalid @enderror" id="Bank_Account_No" name="Bank_Account_No" placeholder="Bank Account No">
                                                @error('Bank_Account_No')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Bank_Name_Branch" class="col-sm-5 col-form-label">Bank Name Branch</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Bank_Name_Branch') }}" class="form-control @error('Bank_Name_Branch') is-invalid @enderror" id="Bank_Name_Branch" name="Bank_Name_Branch" placeholder="Bank Name Branch">
                                                @error('Bank_Name_Branch')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Currency" class="col-sm-5 col-form-label">Currency</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Currency') }}" class="form-control @error('Currency') is-invalid @enderror" id="Currency" name="Currency" placeholder="Currency">
                                                @error('Currency')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col col-sm-1">
                                        <input type="submit" value="Simpan">
                                    </div>
                                    <div class="col">
                                        <input type="submit" value="Cancel">
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div> <!-- card -->
            </div>
        </div> <!-- row -->
    </div>
</section>
@endsection
