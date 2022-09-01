@extends('master')
@section('title','Bom Supplier List')
@section('link','Bom Of Material List')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <label class="">BOM supplier List<span class="offset-md-4 text-success"><label>{{$bayofmat->bom_no}}</label></span><span class="float-right">	<a href="{{route('bom_supplier_product',$bayofmat->id)}}"  class="btn btn-primary"><i class="fas fa-plus"></i> Create New Request</a></span></label>
                </div>
                
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="text-center bg-info">
                        <th>#</th>
                        <th>Request No</th>
                        <th>Supplier Name</th>                                   
                        <th>Req Quotation Date</th>
                        <th>Replied Date</th>
                        <th>PO Sent Date</th>
                        <th>Invoice Receive Date</th>
                        <th>Import Start Date</th>
                        <th>Status</th>
                        <th>Option</th>
                        <th>Action</th>
                        
                    </thead>
                    <tbody class="text-center">
                        <?php $i=1; ?>
                        @foreach($bom_supplier as $bsup)
                        <tr>
                            <!-- <input type="hidden" id="bomsup_id" value="{{$bsup->id}}"> -->
                            <td>{{$i++}}</td>
                            <td>{{$bsup->request_no}}</td>
                            <td>{{$bsup->supplier->name}}</td>
                            @if($bsup->request_quotation_date == null)
                            <td><span class="text-danger"><b>Not Yet</b></span></td>
                            @else
                            <td class="text-success" style="font-weight:bold">{{$bsup->request_quotation_date}}</td>
                            @endif                           
                            @if($bsup->quotation_reply_date == null)
                            <td><span class="text-danger"><b>Not Yet</b></span></td>
                            @else
                            <td class="text-success">{{$bsup->quotation_reply_date}}</td>
                            @endif
                            @if($bsup->po_sent_date == null)
                            <td><span class="text-danger"><b>Not Yet</b></span></td>
                            @else
                            <td class="text-success">{{$bsup->po_sent_date}}</td>
                            @endif
                            @if($bsup->invoice_received_date == null)
                            <td><span class="text-danger"><b>Not Yet</b></span></td>
                            @else
                            <td class="text-success">{{$bsup->invoice_received_date}}</td>
                            @endif
                            @if($bsup->import_start_date == null)
                            <td><span class="text-danger"><b>Not Yet</b></span></td>
                            @else
                            <td class="text-success">{{$bsup->inport_start_date}}</td>
                            @endif
                            <td>{{$bsup->status}}</td>
                            <td>
                                <div class="form-group">
                                    <!-- <label for="recipient-name" class="col-form-label">Supplier</label> -->
                                    <select class="form-control bg-danger" name="attach_file" style="border-radius:20px" id="attach_file_{{$bsup->id}}" onchange="attach_option(this.value,'{{$bsup->id}}','{{$bsup->request_no}}')">
                                    <option selected="selected" >Select Option</option>
                                    <option value="1" class="bg-light">Quotation</option>
                                    <option value="2" class="bg-light">Purchase Order</option>
                                    <option value="3" class="bg-light">Invoice</option>
                                    <option value="4" class="bg-light">Import Process</option>
                                   
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#product_list_{{$bsup->id}}">Products</button>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#update_{{$bsup->id}}">Update</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <form action="{{route('show_supplier_purchase_order')}}" method="post" id="po">
                    @csrf
                    <input type="hidden" name="bom_supplier_id" id="bom_supplier_id">
                </form>
                <form action="{{route('show_supplier_import_process')}}" method="get" id="import">
                    @csrf
                    <input type="hidden" name="bom_supplier_id" id="import_bom_supplier_id">
                </form>
                <!-- Begin Supplier Quotation Modal Data-->
                @foreach($bom_supplier as $bsup)
                <div class="modal fade" id="supplier_quotation_{{$bsup->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="text-success"><span id="req_sup{{$bsup->id}}"></span><span class="text-dark">Supplier Quotation</span></h5>
                        </div>
                        <form action="{{route('upload_quotation')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" value="{{$bsup->id}}" name="bom_supplier_id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Quotation No</label>
                                <input type="text" class="form-control" id="quo_no{{$bsup->id}}" name="quo_no" placeholder="Enter Quotation Number no have">
                                <!-- @if(!$quo->isEmpty())
                                    @foreach($quo as $quo_each)
                                        @if($quo_each->bom_supplier_id == $bsup->id)
                                            <input type="text" class="form-control" value="{{$quo_each->supplier_quotation_number}}" readonly>
                                        @else
                                            <input type="text" class="form-control" id="quo_no{{$bsup->id}}" name="quo_no" placeholder="Enter Quotation Number errr">
                                        @endif
                                    @endforeach   
                                    
                                    
                                            
                                        
                                    
                                @else
                                <input type="text" class="form-control" id="quo_no{{$bsup->id}}" name="quo_no" placeholder="Enter Quotation Number no have">
                                @endif -->
                            </div>
                            <div class="form-group">
                                <label for="name">File Name</label>
                                
                                <input type="text" class="form-control" id="quo_file_name{{$bsup->id}}" name="quo_file_name" placeholder="Enter File Name">
                                
                            </div>
                            <div class="form-group">
                                <label for="name">Description</label><br>
                               
                                <textarea class="form-control" rows="5px" cols="60px" id="quo_description{{$bsup->id}}" name="quo_description" placeholder="Enter Quotation Description"></textarea>
                                
                            </div>
                            <div class="form-group">
                                <label for="name">Attach File</label>
                                <span id="have_file{{$bsup->id}}">
                                <input type="file" class="form-control" id="quo_file_path{{$bsup->id}}" name="quo_file_path" >
                                </span>
                            </div><hr>
                            <div class="form-group">
                               
                            <button type="submit" id="uploadquo{{$bsup->id}}" class="btn btn-success btn-block" >Upload</button>
                            
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                </div>
                @endforeach
                <!-- End Supplier Quotation Modal -->
                 <!-- Begin Supplier Invoice Modal-->
                 @foreach($bom_supplier as $bsup)
                <div class="modal fade" id="supplier_invoice_{{$bsup->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="text-success"><span id="inv_sup{{$bsup->id}}"></span><span class="text-dark">Supplier Invoice</span></h5>
                        </div>
                        <form action="{{route('upload_invoice')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$bsup->id}}" name="bom_supplier_id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Invoice No</label>
                                
                                <input type="text" class="form-control" id="invoice_no{{$bsup->id}}" name="invoice_no" placeholder="Enter Invoice Number">
                                
                            </div>
                            <div class="form-group">
                                <label for="name">File Name</label>
                                
                                <input type="text" class="form-control" id="invoice_file_name{{$bsup->id}}" name="invoice_file_name" placeholder="Enter File Name">
                                
                            </div>
                            <div class="form-group">
                                <label for="name">Description</label><br>
                                
                                <textarea class="" rows="5px" cols="60px" id="invoice_description{{$bsup->id}}" name="invoice_description" placeholder="Enter Invoice Description"></textarea>
                                
                            </div>
                            <div class="form-group">
                                <label for="name">Attach File</label>
                                <span id="have_file_invo{{$bsup->id}}">
                                <input type="file" class="form-control" id="invoice_file_path{{$bsup->id}}" name="invoice_file_path" >
                                </span>
                            </div><hr>
                            <div class="form-group">
                            <span id="have_upload_invo{{$bsup->id}}">
                            <button type="submit" id="uploadinvo{{$bsup->id}}" class="btn btn-success btn-block" >Upload</button>
                            </span>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
                @endforeach
                <!-- End Supplier Invoice Modal -->
                <!-- Begin Product List Modal-->
                @foreach($bom_supplier as $bsup)
                <div class="modal fade" id="product_list_{{$bsup->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-success">Product List</h5>
                        </div>
                        <div class="modal-body">

                        </div>
                    </div>
                </div>
                </div>
                @endforeach
                <!-- End Product List Modal -->
                <!-- Begin Update Modal-->
                @foreach($bom_supplier as $bsup)
                <div class="modal fade" id="update_{{$bsup->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-success">Update</h5>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead class="bg-info">
                                            <tr>  
                                            <th scope="col">#</th>                                 
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Required Qty</th>
                                            <th scope="col">Required Price</th>
                                            <th scope="col">Required Spec</th>
                                            <th scope="col">Quoted Price</th>
                                            <th scope="col">Available Qty</th>
                                            <th scope="col">Available Spec</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1 ?>
                                        @foreach($bom_supplier_pro as $bspro)
                                        @if($bsup->id == $bspro->bom_supplier_id)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$bspro->product->name}}</td>
                                                <td>{{$bspro->product->brand->name}}</td>
                                                <td>{{$bspro->requested_qty}}</td>
                                                <td>{{$bspro->requested_price}}</td>
                                                <td>{{$bspro->requested_specs}}</td>
                                                <td><span class="" id="QuoPrice{{$bspro->id}}"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#quoted_price_{{$bspro->id}}"><i class="fas fa-tools mr-2"></i>Edit</span></button></td>
                                                <td><span class="" id="AvaQty{{$bspro->id}}"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#available_qty_{{$bspro->id}}"><i class="fas fa-tools mr-2"></i>Edit</span></button></td>
                                                <td><span class="" id="AvaSpec{{$bspro->id}}"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#available_spec_{{$bspro->id}}"><i class="fas fa-tools mr-2"></i>Edit</span></button></td>
                                            </tr>
                                        @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                
                                    <button type="button" class="btn btn-danger offset-md-5"><i class="fas fa-envelope-open-text mr-2"></i>Show Email</button>
                                
                               
                                    <button type="button" class="btn btn-success" onclick="Update()"><i class="fas fa-edit mr-2"></i>Update</button>
                               
                               

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                </div>
                @endforeach
                <!-- End Update Modal -->
                <form action="{{route('update_bom_supplier_list')}}" method="post" id="update">
                    @csrf
                <input type="hidden" id="bom_supplier_list_ID" name="bom_supplier_list_ID">
                <!-- Begin Edit Quoted Price Modal -->
                @foreach($bom_supplier_pro as $bspro)
                    <div class="modal fade" id="quoted_price_{{$bspro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Quoted Price</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Quoted Price</label>
                                <input type="number" class="form-control" id="quo_price{{$bspro->id}}" name="quo_price[]" placeholder="Enter Quoted Price">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="edit_quo_price('{{$bspro->id}}','{{$bspro->product_id}}','{{$bspro->product->name}}')">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>
                @endforeach
                <!-- End Edig Quoted Price Modal -->
                <!-- Begin Edit Available Qty Modal -->
                @foreach($bom_supplier_pro as $bspro)
                    <div class="modal fade" id="available_qty_{{$bspro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Available Qunatity</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Available Qty</label>
                                <input type="number" class="form-control" id="ava_qty{{$bspro->id}}" name="ava_qty[]" placeholder="Enter Available Quantity">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="edit_ava_qty('{{$bspro->id}}','{{$bspro->product_id}}','{{$bspro->product_name}}')">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>
                @endforeach
                <!-- End Ending Available Qty Modal -->
                <!-- Begin Edit Available Specification Modal -->
                @foreach($bom_supplier_pro as $bspro)
                    <div class="modal fade" id="available_spec_{{$bspro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Available Specification</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Available Specification</label>
                                <input type="text" class="form-control" id="ava_spec{{$bspro->id}}" name="ava_spec[]" placeholder="Enter Available Specification">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="edit_ava_spec('{{$bspro->id}}','{{$bspro->product_id}}','{{$bspro->product->name}}')">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>
                @endforeach
                <!-- End Ending Available Specification Modal -->

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')

<script>

$( document ).ready(function() {
    var quot = @json($quo);
    var invo = @json($inv);
    var str = JSON.stringify(quot);
    var arr = [];
    $.each( quot, function( i, val ) {
        arr.push(quot[i].id);
        $('#quo_no'+quot[i].bom_supplier_id).val(quot[i].supplier_quotation_number);
        
        document.getElementById("quo_no"+quot[i].bom_supplier_id).disabled = true;

        $('#quo_file_name'+quot[i].bom_supplier_id).val(quot[i].quotation_file_name);
        document.getElementById("quo_file_name"+quot[i].bom_supplier_id).disabled = true;

        $('#quo_description'+quot[i].bom_supplier_id).val(quot[i].quotation_file_description);
        document.getElementById("quo_description"+quot[i].bom_supplier_id).disabled = true;

        $('#quo_file_path'+quot[i].bom_supplier_id).hide();

        
        var html = "";
        html +=`
        <input type="text" class="form-control" value="${quot[i].quotation_file_path}" readonly>
        `;
        $('#have_file'+quot[i].bom_supplier_id).html(html);
        $('#uploadquo'+quot[i].bom_supplier_id).hide();
    });
    // alert(arr);
    $.each(invo, function( i, val ) {
        arr.push(invo[i].id);
        $('#invoice_no'+invo[i].bom_supplier_id).val(invo[i].supplier_invoice_number);
        
        document.getElementById("invoice_no"+invo[i].bom_supplier_id).disabled = true;

        $('#invoice_file_name'+invo[i].bom_supplier_id).val(invo[i].invoice_file_name);
        document.getElementById("invoice_file_name"+invo[i].bom_supplier_id).disabled = true;

        $('#invoice_description'+invo[i].bom_supplier_id).val(invo[i].invoice_file_description);
        document.getElementById("invoice_description"+invo[i].bom_supplier_id).disabled = true;

        $('#invoice_file_path'+invo[i].bom_supplier_id).hide();

        
        var htmlinvo = "";
        htmlinvo +=`
        <input type="text" class="form-control" value="${invo[i].invoice_file_path}" readonly>
        `;
        $('#have_file_invo'+invo[i].bom_supplier_id).html(htmlinvo);

        $('#uploadinvo'+invo[i].bom_supplier_id).hide();
        
    });


});

function edit_quo_price(bom_supplier_product_id,product_id,product_name)
{
    var quo_price = $('#quo_price'+bom_supplier_product_id).val();
    
    var quoPrice = {id:bom_supplier_product_id,product_id:product_id,product_name:product_name,quo_price:quo_price};
    var quopricecart = localStorage.getItem('quo_pricecart');
    if(!quopricecart){
          quopricecart = '[]';
        }
    var myquopricecartobj = JSON.parse(quopricecart);
    myquopricecartobj.push(quoPrice);
    localStorage.setItem('quo_pricecart',JSON.stringify(myquopricecartobj));
    var htmlqp = "";
    htmlqp +=`
        <label class="text-danger">${quo_price}</label>
    `;
    $('#QuoPrice'+bom_supplier_product_id).html(htmlqp);
    $('#quoted_price_'+bom_supplier_product_id).modal('hide');
    var bom_supplier_list_id_arr = [];
    $.each(myquopricecartobj,function(i,v){
        
        bom_supplier_list_id_arr.push(v.id);
        
    })
    var bom_supplier_list_id_str = JSON.stringify(bom_supplier_list_id_arr);
    $('#bom_supplier_list_ID').val(bom_supplier_list_id_str);
}
function edit_ava_qty(bom_supplier_product_id,product_id,product_name)
{
    var ava_qty = $('#ava_qty'+bom_supplier_product_id).val();
    var available_qty = {id:bom_supplier_product_id,product_id:product_id,product_name:product_name,ava_qty:ava_qty};
    var avaqtycart = localStorage.getItem('ava_qtycart');
    if(!avaqtycart){
          avaqtycart = '[]';
        }
    var myavaqtycartobj = JSON.parse(avaqtycart);
    myavaqtycartobj.push(available_qty);
    localStorage.setItem('ava_qtycart',JSON.stringify(myavaqtycartobj));
    var htmlavaqty = "";
    htmlavaqty +=`
        <label class="text-danger">${ava_qty}</label>
    `;
    $('#AvaQty'+bom_supplier_product_id).html(htmlavaqty);
    $('#available_qty_'+bom_supplier_product_id).modal('hide');
}
function edit_ava_spec(bom_supplier_product_id,product_id,product_name)
{
    
    var ava_spec = $('#ava_spec'+bom_supplier_product_id).val();
    var available_spec = {id:bom_supplier_product_id,product_id:product_id,product_name:product_name,ava_spec:ava_spec};
    var avaspecart = localStorage.getItem('ava_specart');
    if(!avaspecart){
          avaspecart = '[]';
        }
    var myavaspecartobj = JSON.parse(avaspecart);
    myavaspecartobj.push(available_spec);
    localStorage.setItem('ava_specart',JSON.stringify(myavaspecartobj));
    var htmlavaspec = "";
    htmlavaspec +=`
        <label class="text-danger">${ava_spec}</label>
    `;
    $('#AvaSpec'+bom_supplier_product_id).html(htmlavaspec);
    $('#available_spec_'+bom_supplier_product_id).modal('hide');
}
function Update()
{
    alert("hell");
    $('#update').submit();
}
function attach_option(value,bomsup_id,req_no)
{
    // alert(value+"----"+bomsup_id);
    if(value == 1)
    {
        var htmlreq = "";
        htmlreq +=`
        <label class="text-success">(${req_no})</label>
        `;
        $('#req_sup'+bomsup_id).html(htmlreq);
    $('#supplier_quotation_'+bomsup_id).modal('show');
    }
    else if(value == 2)
    {
        $('#bom_supplier_id').val(bomsup_id);
        $('#po').submit();
    }
    else if(value == 3)
    {
        var htmlinv = "";
        htmlinv +=`
        <label class="text-success">(${req_no})</label>
        `;
        $('#inv_sup'+bomsup_id).html(htmlinv);
    $('#supplier_invoice_'+bomsup_id).modal('show');
    }
    else if(value == 4)
    {
        $('#import_bom_supplier_id').val(bomsup_id);
        $('#import').submit();
    }

}
// $( ".sup_option" ).change(function() {
//   alert( "Handler for .change() called." );
// });


</script>

@endsection