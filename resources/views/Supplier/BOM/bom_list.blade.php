@extends('master')
@section('title','Bay Of Material List')
@section('link','Bay Of Material List')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <label class="">Bay Of Material List<span class="float-right">	<a href="{{route('add_bom')}}"  class="btn btn-primary"><i class="fas fa-plus"></i> Add Bay Of Material</a></span></label>
                
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
                            <td><button class="btn btn-info" onclick="bom_product_list('{{$bom->id}}')" data-toggle="modal" data-target="#list_{{$bom->id}}">Product List</button>
                            <a href="{{route('bom_supplier_list',$bom->id)}}" class="btn btn-warning">Supplier</a>
                            <button class="btn btn-dark" data-toggle="modal" data-target="#price_{{$bom->id}}">Price</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#attach_{{$bom->id}}">Attach</button>
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
                            <div class="row bg-info font-weight-bold p-2">
                                <div class="col-md-1">
                                <span>No</span>
                                </div>
                                <div class="col-md-2">
                                <span>Name</span>
                                </div>
                                <div class="col-md-2">
                                <span>Brand</span>
                                </div>
                                <div class="col-md-2 text-center">
                                <span>Category</span>
                                </div>
                                <div class="col-md-3">
                                <span>Department</span>
                                </div>
                                <div class="col-md-2">
                                <span>Stock Qty</span>
                                </div>
                            </div>
                            <div id="productspace{{$bom->id}}">
                            </div>
                           

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
                for(i=0;i<data.product.length;i++)
                {
                    // alert(data.product[i].name);
                    htmlbom +=`
                    
                    <div class="row mb-1 mt-3 font-weight-bold" style="font-size:18px;">  
                        <div class="col-md-1">
                            <span>${i+1}</span>
                        </div>             
                        <div class="col-md-2">
                            <span>${data.product[i].name}<span>
                        </div>
                        <div class="col-md-2">
                            <span>${data.brand[i]}</span>
                        </div>
                        <div class="col-md-2 text-center">
                            <span>${data.category[i]}</span>
                        </div>
                        <div class="col-md-3">
                            <span>${data.department[i]}</span>
                        </div>
                        <div class="col-md-2">
                            <span>${data.product[i].stock_qty}</span>
                        </div>
                       
                    </div>
                    
                    `;
                }
                $('#productspace'+bom_id).html(htmlbom);
                
                
           }
    });
}



</script>

@endsection