@extends('master')
@section('title','Good Receive Note List')
@section('link','Good Receive Note List')
@section('content')

<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><span class="text-primary font-weight-bold">{{$bom_supplier_po->supplier_po_no}}-{{$bom_supplier_po->bomsupplier->request_no}}</span>'s Good Receive Note List</h3>
              <a href="{{route('add_grn',$bom_supplier_po->id)}}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Create Good Receive Note</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-striped">
                <thead class="text-center bg-info">
                	<tr>
                    <th>No</th>
                    <th>GRN No</th>
                    <!-- <th>Serial Number</th> -->
                    <th>Date</th>
                    <th>Total Qty</th>
                    <th>Location</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <?php $i = 1;?>
                <tbody class="text-center">
                @foreach($good_receive_note as $grn)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$grn->grn_no}}</td>
                    <td>{{$grn->date}}</td>
                    <td>{{$grn->total_qty}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- Add Item Modal -->
@endsection