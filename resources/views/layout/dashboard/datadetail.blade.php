@extends('layout.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container">
    <div class="grey-bg container-fluid">
    @include('layout.dataicon.data')


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {!! \Session::get('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                    
            @endif
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DAFTAR DATA RUMAH IBADAH - Wilayah Kabupaten Tangerang</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row mb-4">
                        <div class="col-md-12">
                           

                          
                            <!-- <a href="{{ url()->previous() }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i>
                                BACK
                            </a> -->
                            
                            

                            <a href="{{ route('createHome') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Tambah Data
                            </a>
                        </div>
                    </div>
              
              <div class="divider"></div>
            
                <div class="table-responsive mt-5">
                    <div class="col-md-12">
                    <table class="table table-bordered" id="example1">
                    <thead>
                        <tr>
                          
                            <th>Kelurahan</th>
                            <th>Nama Tempat Ibadah</th>
                            <th>Alamat</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($getDataByKelurahan as $dat)
                        <tr>
                            <td>{{ $dat->kelurahan->name}}</td>
                            <td>{{ $dat->nama }}</td>
                            
                            <td>{{ $dat->alamat }}</td>
                            <td>
                            <div class="btn-group">
                                            <a class="btn btn-sm btn-primary" href="{{  url('edit/rumahibadah/'.$dat->id_rumah) }}"><i class="fas fa-edit"></i></a> 
                                            &nbsp;
                                            <a href="{{ url('/hapus/'.$dat->id_rumah) }}" class="btn btn-sm btn-danger" type="button" ><i class="fas fa-trash"></i></a>
                                            </div>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
   
    
    </div>
    </div>

    
</div>
@endsection