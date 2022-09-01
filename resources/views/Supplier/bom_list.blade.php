@extends('master')
@section('title','Bill Of Material List')
@section('link','Bill Of Material List')
@section('content')
<style>
    .borderless table {
    border-top-style: none;
    border-left-style: none;
    border-right-style: none;
    border-bottom-style: none;
}
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <label class="">Bill Of Material List<span class="float-right">	<a href="{{route('add_bom')}}"  class="btn btn-primary" style="margin-left:1000px"><i class="fas fa-plus"></i> Add Bill Of Material</a></span></label>
                
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="text-center bg-info">
                        <th>#</th>
                        <th>BOM No</th>                                   
                        <th>Project Name</th>
                        <th>No Product Type</th>
                        <th>No Product Qty</th>
                        <th>Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody class="text-center">
                        <?php $i=1; ?>
                        @foreach($boms as $bom)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$bom->bom_no}}</td>
                            <td>{{$bom->saleproject->name}}</td>
                            <td>{{$bom->num_product_type}}</td>
                            <td>{{$bom->num_product_qty}}</td>
                            <td>{{$bom->create_date}}</td>
                            <td><button class="btn btn-info btn-sm text-dark" onclick="bom_product_list('{{$bom->id}}')" data-toggle="modal" data-target="#list_{{$bom->id}}">Product List</button>
                            <a href="{{route('bom_supplier_list',$bom->id)}}" class="btn btn-warning btn-sm text-dark">Supplier</a>
                            <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#price_{{$bom->id}}">Price</button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#attach_{{$bom->id}}">Attach</button>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Product List Modl -->
                @foreach($boms as $bom)
                <div class="modal fade bd-example-modal-lg" id="list_{{$bom->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5><span class="text-success mr-2">{{$bom->bom_no}}</span>Product Lists</h5>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-striped">
                                <thead class="bg-info">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Brand</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Supplier</th>
                                    </tr>
                                </thead>
                                <tbody id="productspace{{$bom->id}}">

                                </tbody>
                            </table>
                           
                           

                        </div><!--modal body end -->
                    </div>
                </div>
                </div>
                
                @endforeach
                
                @foreach($boms as $bom)
                <div class="modal fade" id="price_{{$bom->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span class="text-success">{{$bom->bom_no}}</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Supplier</label>
                                <select class="form-control" name="supplier_id">
                                <option selected="selected">Select Supplier</option>
                                @foreach($supplier as $sup)
                                    <option value="{{$sup->id}}">{{$sup->name}}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Supplier Quoted Price</label>
                            <input type="number" class="form-control" name="sup_quo_price" id="quo_price">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Proposed Price</label>
                            <input type="number" class="form-control" name="proposed_price" id="proposed_price">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Profit Margin</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="profit" id="profit">
                                </div>
                                <div class="col-md-3">
                                 <input type="number" class="form-control" name="margin" id="margin">
                                </div>
                                <div class="col-md-1">
                                <span><i class="fas fa-percentage mt-3 fa-lg pr-2"></i></span>
                                </div>
                            </div>
                            
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                </div>
                </div>

                @endforeach
                @foreach($boms as $bom)
                <div class="modal fade" id="attach_{{$bom->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span class="text-success">{{$bom->bom_no}}</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>                       
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Description</label><br>
                            <textarea id="desc" name="descriptiono" cols="60" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">File</label>
                           
                            <input type="file" class="form-control" id="file" name="file">
                            
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                    </div>
                </div>
                </div>

                @endforeach
                <!-- End Product -->
                
            </div>
        </div>
    </div>
</div>
@foreach($suppliers_com as $supcom)
<!-- Begin Supplier Comparison data -->
<div class="modal fade" id="com_detail{{$supcom->supplier_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><span class="text-success">{{$supcom->supplier->company_name}}</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table borderless">
                <thead class="bg-info text-center">
                    <tr>
                        <th>Discount</th>
                        <th>Discount Condition</th>
                        <th>Credit Term</th>
                        <th>Credit Condition</th>
                        <th>Lead Time</th>
                    </tr>
                </thead>
                <tbody id="result_detail{{$supcom->supplier_id}}">
                <!-- {{$supcom->supplier_id}} -->
                </tbody>
            </table>
        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
    </div>
    </div>
</div>
</div>
@endforeach
<!-- end sup compare data detail -->

@endsection
@section('js')

<script>

function bom_product_list(bom_id)
{
    // alert(bom_id);
    $.ajax({
           type:'POST',
           url:'/ajax_bom_product',
           dataType:'json',
           data:{ "_token": "{{ csrf_token() }}",
           "bom_id":bom_id,
        },
           success:function(data){
                var htmlbom = "";
                
                var i=0;
                var j=1;
                for(i=0;i<data.bompro.length;i++)
                {
                    // alert(data.product[i].name);
                    htmlbom +=`
                        <tr>
                        <td class="text-center">${i+1}</td>
                        <td class="text-center">${data.bompro[i].product.name}</td>
                        <td class="text-center">${data.brand[i]}</td>
                        <td class="text-center">${data.category[i]}</td>
                        <td class="text-center">-</td>
                        <td class="text-center"><a data-toggle="collapse" href="#related_detail${data.bompro[i].id}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" class="btn btn-secondary btn-sm" onclick="related('${data.bompro[i].id}','${data.bompro[i].selected_supplier_id}')">Info<i class="fas fa-arrow-down ml-2" aria-hidden="true"></i>
                        </a></td>
                        </tr
                        <tr>
                        <td colspan="12" >
                        <div class="collapse out container" id="related_detail${data.bompro[i].id}">
                        <table class="table borderless">
                            <thead class="bg-secondary">
                                <tr>
                                    
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Unit Price</th>
                                    <th class="text-center">Incoterm</th>
                                    <th class="text-center">Last Date</th>
                                    <th class="text-center">MOQ price</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="sup_detail${data.bompro[i].id}">
                            </tbody>
                        </table>
                        </div>
                        </td>
                        </tr>
                    `;
                }
               
                $('#productspace'+bom_id).html(htmlbom);
                
                
           }
    });
}
function related(bom_id,supplier_id)
{
    // alert(bom_id+"---"+supplier_id);
    var supcom = @json($suppliers_com);
    console.log(supcom);
    var htmlcom = "";
    $.each(supcom,function(i,v){
        if(v.supplier_id == supplier_id)
        {
                    htmlcom +=`
                    
                        <tr>
                            <td class="text-center">${v.supplier.company_name}</td>
                            <td class="text-center">${v.unit_purchase_price}</td>
                            <td class="text-center">${v.incoterm.incoterm_name}</td>
                            <td class="text-center">${v.last_purchase_date}</td>
                            <td class="text-center">${v.moq_price}</td>
                            <td class="text-center"><button class="btn btn-warning btn-sm" onclick="getsup_detail('${v.supplier.id}')">Detail</button></td>
                        </tr>
                   
                    `;
        }
                })
                $('#sup_detail'+bom_id).html(htmlcom);
}
function getsup_detail(sup_id)
{
    // alert(sup_id);
    var supcom = @json($suppliers_com);
    var htmlcomd = "";
    $.each(supcom,function(i,v){
        if(v.supplier_id == sup_id)
        {
            if(v.delivery_lead_time == null)
           {
            var time = "NA";
           }
           else
           {
            var time = v.delivery_lead_time;
           }
        htmlcomd +=`
        <tr>
        `;
            if(v.discount_type == null)
            {
                htmlcomd += `<td class="text-center">${v.discount_value}/NA</td>`;
            }
            else if(v.discount_value == null)
            {
                htmlcomd += `<td class="text-center">NA/${v.discount_type}</td>`;
            }
            else if(v.discount_type == null && v.discount_value == null)
            {
                htmlcomd =`<td class="text-center">NA/NA</td>`;    
            }
            else
            {
                htmlcomd += `<td class="text-center">${v.discount_value}/${v.discount_type}</td>`;
            }

            if(v.discount_condition == null)
            {
                htmlcomd += `<td class="text-center">'+${v.discount_condition_value}/NA</td>`;
            }
            else if(v.discount_condition_value == null)
            {
                htmlcomd += `<td class="text-center">NA/${v.discount_condition}</td>`;
            }
            else if(v.discount_condition_value == null && v.discount_condition == null)
            {
                htmlcomd += `<td class="text-center">NA/NA</td>`;
            }
            else
            {
                htmlcomd += `<td class="text-center">'+${v.discount_condition_value}/${v.discount_condition}</td>`;
            }

            if(v.credit_term_type == null)
            {
                htmlcomd +=`<td class="text-center">${v.credit_term_value}/NA</td>')`;
            }
            else if(v.credit_term_value == null)
            {
                htmlcomd +=`<td class="text-center">NA/${v.credit_term_type}</td>`;
            }
            else if(v.credit_term_value == null && v.credit_term_type == null)
            {
                htmlcomd += `<td class="text-center">NA/NA</td>`;
            }
            else
            {
                htmlcomd += `<td class="text-center">'+${v.credit_term_value}/${v.credit_term_type}</td>`;
            }

            if(v.credit_condition == null)
            {
                htmlcomd += `<td class="text-center">'+data.pri_sup.credit_condition_value+' (NA)'+'</td>`;
            }
            else if(v.credit_condition_value == null)
            {
                htmlcomd +=`<td class="text-center">NA/${v.credit_condition}</td>`;
            }
            else if(v.credit_condition_value == null && v.credit_condition == null)
            {
                htmlcomd +=`<td class="text-center">NA/NA</td>`;
            }
            else
            {
                htmlcomd += `<td class="text-center">${v.credit_condition_value}/${v.credit_condition}</td>`;
            }

        htmlcomd +=`
        <td>${time}/${v.lead_time_type}</td>
        </tr>`;
        }
    });
    // alert("helll");
  $('#result_detail'+sup_id).html(htmlcomd);
    $('#com_detail'+sup_id).modal('show');
}

</script>

@endsection