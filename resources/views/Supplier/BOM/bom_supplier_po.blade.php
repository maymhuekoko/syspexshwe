@extends('master')
@section('title','BOM Supplier Purchase Order')
@section('link','BOM Supplier Purchase Order')
@section('content')

<div class="card">
    <div class="card-shadow">
        <div class="card-header">
            <label class="text-success"><i>{{$bom_supplier->request_no}}</i></label>
            <span class="float-center offset-md-4 text-danger"><label>BOM Supplier Purcahse Order Form</label></span>
            
        </div>
        <div class="card-body">
            <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="name">Supplier PO No</label>
                    <input type="text" class="form-control border border-success" id="po_no" name="po_no" placeholder="Enter Purchase Order Number">
                    </div>
                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-5">
                    <div class="form-group">
                    <label for="name">Supplier Name</label>
                    <input type="text" class="form-control border border-success" id="supplier_name" name="supplier_name" readonly value="{{$bom_supplier->supplier->name}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control border border-success" id="po_title" name="po_title" placeholder="Enter Title">
                    </div>
                </div>
                <div class="col-md-1">
                    
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                    <label for="name">Supplier Email</label>
                    <input type="text" class="form-control border border-success" id="email" name="email" readonly value="{{$bom_supplier->supplier->email}}">
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="form-group">
                    <label class="offset-md-6">Description</label><br>
                    <textarea class="form-control border border-success" id="po_desc" name="po_desc" rows="5px" cols="110px"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Attach File</label>
                    <input type="file" name="attach_file" id="attach_file" class="form-control border border-success">
                </div>
            </div>
            </div><hr>
            <div class="container">
                <div class="col-12" class="">
                    <label>Product List</label>
                    <table class="table table-bordered">
                        <thead class="text-center bg-info">
                            <th>No</th>
                            <th>Product Name</th>                                   
                            <th>Brand</th>
                            <th>Order Qty</th>
                            <th>Order Price</th>
                            <th>Required Specification</th>
                            <th>Action</th>
                        </thead>
                        <tbody class="text-center">
                            <?php $i=1; ?>
                        @foreach($bom_sup_product as $bspro)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$bspro->product->name}}</td>
                            <td>{{$bspro->product->brand->name}}</td>
                            <td><span id="editQty{{$bspro->id}}"><button type="button"  class="btn btn-success" data-toggle="modal" data-target="#edit_order_qty_{{$bspro->id}}"><i class="fas fa-tools mr-2"></i>Edit</button></span></td>
                            <td><span id="editPrice{{$bspro->id}}"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit_order_price_{{$bspro->id}}"><i class="fas fa-tools mr-2"></i>Edit</button></span></td>
                            <td><span id="editSpec{{$bspro->id}}"><button type="button"  class="btn btn-success" data-toggle="modal" data-target="#edit_order_spec_{{$bspro->id}}"><i class="fas fa-tools mr-2"></i>Edit</button></span></td>
                            <td><span class="badge badge-danger pl-2 pr-2 pt-2 pb-2"><i class="fas fa-times"></i></span></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            
            <button class="btn btn-info offset-md-5"><i class="fas fa-paper-plane ml-2 mr-2"></i>Send</button>
            <a href="{{route('back_bom_supplier_list',$bom_supplier->bom_id)}}" class="btn btn-danger"><i class="fas fa-ban ml-2 mr-2"></i>Cancel</a>
        </div>
    </div>
</div>

@endsection