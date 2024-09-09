@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Akun Keuangan</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Akun Keuangan</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data Akun Keuangan</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
               <!-- Display success message -->
            <div class="container-fluid">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success dark" role="alert">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if (session()->has('warning'))
    <div class="alert alert-danger dark" role="alert">
        <p>{{ session('warning') }}</p>
    </div>
@endif
@if (session()->has('failures'))
    @php
        $failureCount = count(session('failures'));
    @endphp
    <div class="alert alert-warning dark" role="alert">
        <p>
            Berhasil diUpload: {{ session('gagal') }} Data<br/>
            Gagal diUpload: {{ $failureCount }} Data ==> 
            <a href="#" onclick="downloadTableAsExcel()"><b> DOWNLOAD DATA GAGAL</b></a> <==
        </p>
    </div>
    <script>
        function downloadTableAsExcel() {
            var table = document.getElementById('downloaded');
            var html = table.outerHTML;

            // Convert HTML to Blob
            var blob = new Blob([html], { type: 'application/vnd.ms-excel' });

            // Create download link and trigger click
            var a = document.createElement('a');
            a.href = window.URL.createObjectURL(blob);
            a.download = 'failed_data.xls';
            document.body.appendChild(a);
            a.click();

            // Remove the temporary link
            document.body.removeChild(a);
        }
    </script>
    <table border="1" id="downloaded" style="display: none;">
        <tr> 
            <th>Baris</th>
            <th>Atribut</th>
            <th>Error</th>
            <th>Value</th>
        </tr>
        @foreach (session()->get('failures') as $validasi)
            <tr>
                <td>{{ $validasi->row() }}</td>
                <td>{{ $validasi->attribute() }}</td>
                <td>
                    @foreach ($validasi->errors() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </td>
                <td>{{ $validasi->values()[$validasi->attribute()] }}</td>
            </tr>
        @endforeach
    </table>
@endif



        
                <div class="row">
                    <div class="col-lg-12">
                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                            <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                                <div class="d-flex align-items-center flex-wrap justify-content-center">
                                    <div class="project-search order-search  global-shadow mt-10">
                                    <?php
                                        if(auth()->user()->status === 'A') { ?>        
                                        <form action="{{ route('master.akun.search') }}" class="order-search__form">
                                        <?php } else { ?>
                                            <form action="{{ route('proposal.akun.search') }}" class="order-search__form">
                                            <?php } ?>
                                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" name="keyword" placeholder="Filter by keyword" aria-label="Search">
                                        </form>
                                    </div>
                                </div>
                                <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                    <a href="{{ route('master.akun.export',['keyword'=>request('keyword')]) }}">  <button type="button" class="btn btn-warning btn-xs btn-squared">Export</button></a>
                           
                                    <a href="{{ route('master.akun.import') }}">  <button type="button" class="btn btn-primary btn-xs btn-squared">Import Data</button></a>

                                    <a href="{{ route('master.akun.create') }}">  <button type="button" class="btn btn-info btn-xs btn-squared">Tambah Data</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless border-0">
                                    <thead>
                                        <tr class="userDatatable-header">
                                        <th scope="col">ID</th>
                                        <th scope="col">Kode</th>
                                           <th scope="col">Uraian</th>
                                           <th scope="col">Level</th>
                                           <th scope="col">Sifat</th>
                                           <th scope="col">Kelompok</th>
                                           <th scope="col">Status</th>
                                           <th scope="col" width="10%"><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $d)
                                        <tr>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->kode }}</td>
                                            <td>{{ $d->uraian }}</td>
                                            <td>{{ $d->level }}</td>
                                            <td>{{ $d->sifat == 'D' ? 'Debet' : 'Kredit' }}</td>
                                            <td>{{ $d->kelompok }}</td>
                                            <td>{{ $d->status == 'A' ? 'Aktif' : 'Non-Aktif' }}</td>

                                            <td>
                                                <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                                               
                                                    <li>
                                                        <a href="{{ route('master.akun.edit', $d->id) }}" class="edit">
                                                            <i class="uil uil-edit"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('master.akun.destroy', $d->id) }}"  onclick="return confirm('Apakah Anda Yakin ?');"  class="remove">
                                                            <i class="uil uil-trash-alt"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                     



                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end mt-15 pt-25 border-top">

                              <nav class="dm-page ">
                                <ul class="dm-pagination d-flex">
                                    {{ $data->onEachSide(2)->withQueryString()->links('pagination') }}
                                </ul>
                              </nav>


                           </div>
                            
                        </div>
                    </div>
    </div>
</div>
@endsection


