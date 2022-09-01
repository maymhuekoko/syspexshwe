@extends('master')
@section('title','BOM Supplier Purchase Order')
@section('link','BOM Supplier Purchase Order')
@section('content')
<style>
.crd{
    box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
}
</style>
<div class="card crd" style="border-radius:0px 0px 50px 50px;border-bottom: 2px solid cyan;">
    <div class="card-shadow">
        <div class="card-header">
            <label class="text-success"><i>{{$bom_supplier->request_no}}</i></label>
            <span class="float-center offset-md-4 text-danger"><label>BOM Supplier Purcahse Order Form</label></span>
            
        </div>
        <form action="{{route('store_bom_po_info')}}" method="post" id="store_po">
            @csrf
            <input type="hidden" name="bom_supplier_id" value="{{$bom_supplier->id}}">
            @if($bom_purchase_order != null)
            <input type="hidden" name="bom_po_id" value="{{$bom_purchase_order->id}}">
            @endif
        <div class="card-body">
            <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="name" class="text-info">Supplier PO No</label>
                    @if($bom_purchase_order != null)
                    <input type="text" class="form-control border border-info" id="po_no" name="po_no" placeholder="Enter Purchase Order Number" value="{{$bom_purchase_order->supplier_po_no}}">
                    @else
                    <input type="text" class="form-control border border-info" id="po_no" name="po_no" placeholder="Enter Purchase Order Number">
                    @endif
                    </div>
                </div>
                <div class="col-md-1">

                </div>
                <div class="col-md-5">
                    <div class="form-group">
                    <label for="name" class="text-info">Supplier Name</label>
                    <input type="text" class="form-control border border-info" id="supplier_name" name="supplier_name" readonly value="{{$bom_supplier->supplier->company_name}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="name" class="text-info">Title</label>
                    @if($bom_purchase_order == null)
                    <input type="text" class="form-control border border-info" id="po_title" name="po_title" placeholder="Enter Title" value="">
                    @else
                    <input type="text" class="form-control border border-info" id="po_title" name="po_title" placeholder="Enter Title" value="{{$bom_purchase_order->po_email_title}}">
                    @endif
                    </div>
                </div>
                <div class="col-md-1">
                    
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                    <label for="name" class="text-info">Supplier Email</label>
                 
                    <input type="text" class="form-control border border-info" id="email" name="email" readonly value="{{$bom_supplier->supplier->email}}">
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="form-group">
                    <label class="offset-md-6" class="text-info">Description</label><br>
                    @if($bom_purchase_order != null)
                    <textarea class="form-control border border-info" id="po_desc" name="po_desc" rows="5px" cols="110px">{{$bom_purchase_order->po_email_description}}</textarea>
                    @else
                    <textarea class="form-control border border-info" id="po_desc" name="po_desc" rows="5px" cols="110px"></textarea>

                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-info">Attach File</label>
                            @if($bom_purchase_order != null)
                            <input type="file" name="attach_file" id="attach_file" class="form-control border border-info" value="{{$bom_purchase_order->po_email_filepath}}">
                            @else
                            <input type="file" name="attach_file" id="attach_file" class="form-control border border-info" >

                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-info">Date</label>
                            @if($bom_purchase_order != null)
                            <input type="date" name="podate" id="podate" class="form-control border border-info" value="{{$bom_purchase_order->po_date}}">
                            @else
                            <input type="date" name="podate" id="podate" class="form-control border border-info" value="<?php echo date('Y-m-d'); ?>">

                            @endif
                        </div>
                    </div>

                </div>
            </div>
            
            </div><hr>
            <div class="container">
                <div class="col-12" class="">
                    <label class="text-success">Product Lists</label>
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
                        @if($bom_purchase_order == null)
                        @foreach($bom_sup_product as $bspro)
                        <tr>
                            <input type="hidden" name="product_id[]" value="{{$bspro->product_id}}">
                            
                            <td>{{$i++}}</td>
                            <td>{{$bspro->product->name}}</td>
                            <td>{{$bspro->product->brand->name}}</td>
                            <td class="pr-3"><span id="editQty{{$bspro->id}}"><input type="text" class="form-control" id="qty{{$bspro->id}}" name="qty[]" size="1" value="0" style="border-color:cyan"></span></td>
                            <td class="pr-3"><span id="editPrice{{$bspro->id}}"><input type="text" class="form-control" id="price{{$bspro->id}}" name="price[]" size="1" value="0" style="border-color:cyan"></span></td>
                            <td class="pr-3"><span id="editSpec{{$bspro->id}}"><input type="text" class="form-control" id="spec{{$bspro->id}}" name="spec[]" size="1" placeholder="specs..." style="border-color:cyan"></span></td>
                            <td><span class="badge badge-danger pl-2 pr-2 pt-2 pb-2"><i class="fas fa-times"></i></span></td>
                        </tr>
                        @endforeach
                        @else
                        @foreach($bom_po_product as $bpo)
                        <tr>
                            <input type="hidden" name="bompoproduct_id[]" value="{{$bpo->id}}">
                            
                            <td>{{$i++}}</td>
                            <td>{{$bpo->product->name}}</td>
                            <td>{{$bpo->product->brand->name}}</td>
                            <td class="pr-3"><span id="editQty{{$bpo->id}}"><input type="text" class="form-control" id="qty{{$bpo->id}}" name="qty[]" size="1"  style="border-color:cyan" value="{{$bpo->order_qty}}"></span></td>
                            <td class="pr-3"><span id="editPrice{{$bpo->id}}"><input type="text" class="form-control" id="price{{$bpo->id}}" name="price[]" size="1"  style="border-color:cyan" value="{{$bpo->order_price}}"></span></td>
                            <td class="pr-3"><span id="editSpec{{$bpo->id}}"><input type="text" class="form-control" id="spec{{$bpo->id}}" name="spec[]" size="1" placeholder="specs..." style="border-color:cyan" value="{{$bpo->required_specification}}"></span></td>
                            <td><span class="badge badge-danger pl-2 pr-2 pt-2 pb-2"><i class="fas fa-times"></i></span></td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </form>
        <div class="card-footer">
            @if($bom_purchase_order == null)
            <button class="btn btn-primary offset-md-5" onclick="sendcheck()"><i class="fas fa-save ml-2 mr-2"></i>Save</button>
            @else
            <button class="btn btn-warning offset-md-5" onclick="sendcheck_po()">><i class="fa fa-pencil-square-o ml-2 mr-2" aria-hidden="true"></i>Update</button>
            @endif
            <button class="btn btn-danger"><i class="fas fa-paper-plane ml-2 mr-2"></i>Send Email</button>

            <!-- <a href="{{route('back_bom_supplier_list',$bom_supplier->bom_id)}}" class="btn btn-danger"><i class="fas fa-ban ml-2 mr-2"></i>Cancel</a> -->
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
function sendcheck()
{
    // alert("hello");
    var bomproduct = @json($bom_sup_product);
    $.each(bomproduct,function(i,v){
        var qty = $('#qty'+v.id).val();
        var price = $('#price'+v.id).val();
        var spec = $('#spec'+v.id).val();
        // alert(spec);
        // alert(qty+price);
        // if(qty == null)
        // {
        //     alert("NULLLL");
        // }
        // alert(isNaN(qty));
    if(qty != 0 && isNaN(qty) == false)
    {
        // alert("qty");
        if(price == 0 && $.trim(spec) == '')
        {
            swal({

            title:"Failed!",
            text:"Please fill Price And Spec of "+v.product.name,
            icon:"info",
            timer: 3000,
            });         
        }
        else if(price != 0 && $.trim(spec) == '')
        {
            
            swal({

            title:"Failed!",
            text:"Please fill Spec of "+v.product.name,
            icon:"info",
            timer: 3000,
            });
        }
        else if(price == 0 && $.trim(spec) != '')
        {
            swal({

                title:"Failed!",
                text:"Please fill Price of "+v.product.name,
                icon:"info",
                timer: 3000,
                });
        }
        else
        {
            alert("hellofff");
            $('#store_po').submit();
        }
    }
    if(price != 0 && isNaN(price) == false)
    {
        // alert("price");

        if(qty == 0 && $.trim(spec) == '')
        {
            swal({

            title:"Failed!",
            text:"Please fill Qty And Spec of "+v.product.name,
            icon:"info",
            timer: 3000,
            });         
        }
        else if(qty != 0 && $.trim(spec) == '')
        {
            swal({

            title:"Failed!",
            text:"Please fill Spec of "+v.product.name,
            icon:"info",
            timer: 3000,
            });
        }
        else if(qty == 0 && $.trim(spec) != '')
        {
            swal({

                title:"Failed!",
                text:"Please fill Qty of "+v.product.name,
                icon:"info",
                timer: 3000,
                });
        }
        else
        {
            alert("hellofff");
            $('#store_po').submit();
        }
    }
    if($.trim(spec) != '')
    {
        // alert("spec");
        if(qty == 0 && price == 0)
        {
            swal({

            title:"Failed!",
            text:"Please fill Qty And Price of "+v.product.name,
            icon:"info",
            timer: 3000,
            });         
        }
        else if(qty != 0 && price == 0)
        {
            swal({

            title:"Failed!",
            text:"Please fill Price of "+v.product.name,
            icon:"info",
            timer: 3000,
            });
        }
        else if(qty == 0 && price != 0)
        {
            swal({

                title:"Failed!",
                text:"Please fill Qty of "+v.product.name,
                icon:"info",
                timer: 3000,
                });
        }
        else
        {
            alert("hellofff");
            $('#store_po').submit();
        }
    }
        
    });
}
function sendcheck_po()
{
    $('#store_po').submit();
}
</script>
@endsection