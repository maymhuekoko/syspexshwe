@extends('master')
@section('title','Bom Supplier Product')
@section('link','Bom Of Material Product')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <h4 class="text-success"><i>{{$bom->bom_no}}</i></h4>
                </div>                
            </div>
            <form action="{{route('send_email_store_req')}}" method="post" id="store_request">
                @csrf
                <input type="hidden" value="{{$bom->id}}" name="bom_id">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Request No</label>
                            <input type="text" class="form-control" id="request_no" name="request_no" placeholder="Enter Request No">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Supplier</label>
                            <select class="form-control" name="supplier_id" id="supplier_id" onchange="filldetail(this.value)">
                            <option selected="selected">Select Supplier</option>
                            @foreach($bom_supplier as $sup)
                                <option value="{{$sup->id}}">{{$sup->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4 pt-3">  
                        <div class="row">
                        <div class="col-md-5">
                        <button class="btn btn-info ml-3 btn-block"><i class="fas fa-info-circle mr-2"></i>Details</button>
                        </div> 
                        <div class="col-md-5">
                        <button class="btn btn-warning ml-3 btn-block mr-2"><i class="fas fa-align-left mr-2"></i>Brands</button>                   
                        </div> 
                        <div class="col-md-2">
                        </div>
                        </div>
                                                 
                                                 
                       
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" class="form-control" id="supplier_email" name="supplier_email" placeholder="Supplier Email" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Tendative Reply Date</label>
                            <input type="date" class="form-control" id="reply_date" name="reply_date" placeholder="Enter Tendative Reply Date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="container">
                            <label class="offset-md-5">Description</label><br>
                            <textarea class="ml-3" rows="5px" cols="155px" name="description"></textarea>
                        </div>
                    </div>
                </div><hr>
                <input type="hidden" id="product_id" name="product_id">
                <input type="hidden" id="qty_req_str">
                <input type="hidden" id="price_req_str">
                <input type="hidden" id="spec_req_str">
                <div class="form-group mt-3">                   
                    <div class="col-12" class="show_hide">
                        <label>Product List</label>
                        <table class="table table-bordered">
                            <thead class="text-center bg-info">
                                <th>No</th>
                                <th>Name</th>                                   
                                <th>Brand</th>
                                <th>Required Qty</th>
                                <th>Required Price</th>
                                <th>Required Specification</th>
                                <th>Action</th>
                            </thead>                           
                            <tbody id="bom_product" class="text-center">                                
                            <?php $i = 1;?>
                            @foreach($bom_product as $bpro)
                                <tr id="change_color{{$bpro->id}}">
                                    <td>{{$i++}}</td>
                                    <td>{{$bpro->product->name}}</td>
                                    <td>{{$bpro->product->brand->name}}</td>
                                    <td><span id="editQty{{$bpro->id}}"><button type="button"  class="btn btn-success" data-toggle="modal" data-target="#edit_req_qty_{{$bpro->id}}"><i class="fas fa-tools mr-2"></i>Edit</button></span></td>
                                    <td><span id="editPrice{{$bpro->id}}"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit_req_price_{{$bpro->id}}"><i class="fas fa-tools mr-2"></i>Edit</button></span></td>
                                    <td><span id="editSpec{{$bpro->id}}"><button type="button"  class="btn btn-success" data-toggle="modal" data-target="#edit_req_spec_{{$bpro->id}}"><i class="fas fa-tools mr-2"></i>Edit</button></span></td>
                                    <td><span class="badge badge-danger pl-2 pr-2 pt-2 pb-2"><i class="fas fa-times"></i></span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- <label>Total Quantity :</label><span class="badge badge-info ml-2"><span id="total"></span></span> -->
                    </div>                  
                </div>
                
            </div><!-- card body end -->
            <!-- Begin Edit product required qty modal -->
            @foreach($bom_product as $bpro)
            <div class="modal fade" id="edit_req_qty_{{$bpro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit&nbsp;<span class="text-success"><i>{{$bpro->product->name}}'s</i></span>&nbsp;Required Quantity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="name">Required Qty</label>
                            <input type="number" class="form-control req_qty_all" id="req_qty{{$bpro->id}}" name="req_qty[]" placeholder="Enter Required Qunatity">
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="edit_qty{{$bpro->id}}" class="btn btn-primary" onclick="required_qty('{{$bpro->id}}','{{$bpro->product_id}}','{{$bpro->product->name}}')">Save changes</button>
                </div>
                </div>
            </div>
            </div>
            @endforeach
            <!-- End Edit product required qty modal -->
            <!-- Begin Edit product required price modal -->
            @foreach($bom_product as $bpro)
            <div class="modal fade" id="edit_req_price_{{$bpro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit&nbsp;<span class="text-success"><i>{{$bpro->product->name}}'s</i></span>&nbsp;Required Price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="name">Required Price</label>
                            <input type="number" class="form-control" id="req_price{{$bpro->id}}" name="req_price[]" placeholder="Enter Required Price">
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="edit_price{{$bpro->id}}" onclick="requir_price('{{$bpro->id}}','{{$bpro->product_id}}','{{$bpro->product->name}}')">Save changes</button>
                </div>
                </div>
            </div>
            </div>
            @endforeach
            <!-- End Edit product required price modal -->
            <!-- Begin Edit product required spec modal -->
            @foreach($bom_product as $bpro)
            <div class="modal fade" id="edit_req_spec_{{$bpro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit&nbsp;<span class="text-success"><i>{{$bpro->product->name}}'s</i></span>&nbsp;Required Specification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="name">Required Specification</label>
                            <input type="text" class="form-control" id="req_spec{{$bpro->id}}" name="req_spec[]" placeholder="Enter Required Specification">
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="edit_spec{{$bpro->id}}" class="btn btn-primary" onclick="requir_specif('{{$bpro->id}}','{{$bpro->product_id}}','{{$bpro->product->name}}')">Save changes</button>
                </div>
                </div>
            </div>
            </div>
            @endforeach
            <!-- End Edit product required spec modal -->
            <div class="card-footer">
                
                <button type="button" class="btn btn-danger offset-md-5" onclick="sendcheck()"><i class="fas fa-envelope mr-2"></i>Send Email</button>
            </div>
</form>
        </div>
    </div>
</div>

@endsection
@section('js')

<script>

function required_qty(bom_pro_id,product_id,product_name)
{
    // alert(bom_pro_id+"--"+product_id);
    // alert(product_id);
    var qty_req = $('#req_qty'+bom_pro_id).val();
    // alert(qty_req);
    var req_Qty = {id:bom_pro_id,product_id:product_id,product_name:product_name,req_qty:qty_req};
    var qtycart = localStorage.getItem('qtycart');
    if(!qtycart){
          qtycart = '[]';
        }
    var myqtycartobj = JSON.parse(qtycart);
    var hasid = false;
        
            
            
                
                
                myqtycartobj.push(req_Qty);
            
            
            localStorage.setItem('qtycart',JSON.stringify(myqtycartobj));
            var qtystr = JSON.stringify(myqtycartobj);
            var htmlqty = "";
            htmlqty +=`
                <label class="text-danger">${qty_req}</label>
            `;
            $('#editQty'+bom_pro_id).html(htmlqty);
            $('#qty_req_str').val(qtystr);
            $('#edit_req_qty_'+bom_pro_id).modal('hide');
            $('#edit_qty'+bom_pro_id).attr('disabled',true);
            // $('#change_color').attr('class','table-success');
            $( "#change_color"+bom_pro_id ).addClass( 'table-warning' );
            var pro_arr_id = [];
            $.each(myqtycartobj,function(i,v){
                // v.total_amount = total_amount;
              pro_arr_id.push(v.product_id);
                
            })
            var pro_str_id = JSON.stringify(pro_arr_id);
            $('#product_id').val(pro_str_id);
           
}

function requir_price(bom_pro_id,product_id,product_name)
{
    // alert(bom_pro_id+"--"+product_id);
    // alert(product_id);
    var price_req = $('#req_price'+bom_pro_id).val();
    // alert(qty_req);
    var req_pric = {id:bom_pro_id,product_id:product_id,product_name:product_name,req_price:price_req};
    var pricecart = localStorage.getItem('pricecart');
    if(!pricecart){
          pricecart = '[]';
        }
    var mypricecartobj = JSON.parse(pricecart);
    var hasid = false;
        
            // $.each(myqtycartobj,function(i,v){
            //     // v.total_amount = total_amount;
            
            //     if(v.product_id == product_id)
            //     {
            //     hasid = true;
            //     alert("same");
            //     }
                
            // })
            
                
                
                mypricecartobj.push(req_pric);
            
            
            localStorage.setItem('pricecart',JSON.stringify(mypricecartobj));
            var pricestr = JSON.stringify(mypricecartobj);
            var htmlprice = "";
            htmlprice +=`
                <label class="text-danger">${price_req}</label>
            `;
            $('#editPrice'+bom_pro_id).html(htmlprice);
            $('#price_req_str').val(pricestr);
            $('#edit_req_price_'+bom_pro_id).modal('hide');
            $('#edit_price'+bom_pro_id).attr('disabled',true);
            $( "#change_color"+bom_pro_id ).addClass( 'table-warning' );

}
function requir_specif(bom_pro_id,product_id,product_name)
{
    // alert(bom_pro_id+"--"+product_id);
    // alert(product_id);
    var spec_req = $('#req_spec'+bom_pro_id).val();
    // alert(qty_req);
    var req_specific = {id:bom_pro_id,product_id:product_id,product_name:product_name,req_price:spec_req};
    var specart = localStorage.getItem('specart');
    if(!specart){
          specart = '[]';
        }
    var myspecartobj = JSON.parse(specart);
    var hasid = false;
        
            // $.each(myqtycartobj,function(i,v){
            //     // v.total_amount = total_amount;
            
            //     if(v.product_id == product_id)
            //     {
            //     hasid = true;
            //     alert("same");
            //     }
                
            // })
            
                
                
                myspecartobj.push(req_specific);
            
            
            localStorage.setItem('specart',JSON.stringify(myspecartobj));
            var specstr = JSON.stringify(myspecartobj);
            var htmlspec = "";
            htmlspec +=`
                <label class="text-danger">${spec_req}</label>
            `;
            $('#editSpec'+bom_pro_id).html(htmlspec);
            $('#spec_req_str').val(specstr);
            $('#edit_req_spec_'+bom_pro_id).modal('hide');
            $('#edit_spec'+bom_pro_id).attr('disabled',true);
            $( "#change_color"+bom_pro_id ).addClass( 'table-warning' );
}

function filldetail(supplier_id)
{
    // alert(supplier_id);
    $.ajax({
                type:'POST',
                url:'/ajax_get_request_supplier',
                dataType:'json',
                data:{ "_token": "{{ csrf_token() }}",
                "supplier_id":supplier_id,
                
                },
                success:function(data){
                    $('#supplier_email').val(data.email);
                }
    });
}
function sendcheck()
{
    
    // alert("hel");
    var qtycart = localStorage.getItem('qtycart');
    var myqtycartobj = JSON.parse(qtycart);

    var pricecart = localStorage.getItem('pricecart');
    var mypricecartobj = JSON.parse(pricecart);

    var specart = localStorage.getItem('specart');
    var myspecartobj = JSON.parse(specart);
   

   
    // for(i=0;i<myqtycartobj.length;i++)
    // {
    //     // alert($('#req_qty'+myqtycartobj[i].id).val());
    //     if(!$('#req_price'+myqtycartobj[i].id).val())
    //     {
    //         alert("blue");
    //         swal({

    //     title:"Failed!",
    //     text:"Please fill Qty field of "+myqtycartobj[i].product_id,
    //     icon:"info",
    //     timer: 3000,
    //     })
    //     }
    // }
    /////////////////////////////////////////////////////////////////////////
    // var i;
    // if(myqtycartobj)
    // {
    //     if(!myspecartobj || !mypricecartobj)
    //     {          
    //         swal({

    //         title:"Failed!",
    //         text:"Please fill all basic field",
    //         icon:"info",
    //         timer: 3000,
    //         });        
    //     }
    //     else if(myspecartobj && mypricecartobj)
    //     {
    //         // alert("all have");
    //         // var price = mypricecartobj.toArray();
    //         var qty_product = [];
    //         for(i=0;i<myqtycartobj.length;i++)
    //         {
    //             qty_product.push(myqtycartobj[i].product_id);
    //         }
    //         if()
    //         {

    //         }
            

    //     }

    // }
    // else if(mypricecartobj)
    // {
    //     if(!myqtycartobj || !myspeccartobj)
    //     {          
    //         swal({

    //         title:"Failed!",
    //         text:"Please fill all basic field",
    //         icon:"info",
    //         timer: 3000,
    //         });        
    //     }
    //     else if(myspecartobj && myqtycartobj)
    //     {
    //         // alert("all have");

    //     }
    // }
    // else if(myspeartobj)
    // {
    //     if(!myqtycartobj || !mypricecartobj)
    //     {          
    //         swal({

    //         title:"Failed!",
    //         text:"Please fill all basic field",
    //         icon:"info",
    //         timer: 3000,
    //         });        
    //     }
    //     else if(mypricecartobj && myqtycartobj)
    //     {
    //         // alert("all have");

    //     }
    // }
    if(myqtycartobj && mypricecartobj && myspecartobj)
    {
        // alert("all");
        // alert(myqtycartobj.length+"=="+mypricecartobj.length+"++"+myspecartobj.length);
        var i,j,k;
        for(i=0,j=0,k=0;i<myqtycartobj.length,j<mypricecartobj.length,k<myspecartobj.length;i++,j++,k++)
        {
            if(!$('#req_price'+myqtycartobj[i].id).val())
            {
                // alert("Fill Price"+myqtycartobj[i].product_name);
                swal({
                    title:"Failed!",
                    text:"Please fill Price field of "+myqtycartobj[i].product_name,
                    icon:"info",
                    timer: 3000,
                    });    
            }
            else if(!$('#req_spec'+myqtycartobj[i].id).val())
            {
                // alert("Fill Specification"+myqtycartobj[i].product_name);
                swal({
                    title:"Failed!",
                    text:"Please fill Specification field of "+myqtycartobj[i].product_name,
                    icon:"info",
                    timer: 3000,
                    }); 
            }
            else if(!$('#req_qty'+mypricecartobj[j].id).val())
            {
                // alert("Fill Qty"+mypricecartobj[j].product_name);
                swal({
                    title:"Failed!",
                    text:"Please fill Quantity field of "+mypricecartobj[j].product_name,
                    icon:"info",
                    timer: 3000,
                    }); 
            }
            else if(!$('#req_spec'+mypricecartobj[j].id).val())
            {
                // alert("Fill Specification"+mypricecartobj[i].product_name);
                swal({
                    title:"Failed!",
                    text:"Please fill Specification field of "+mypricecartobj[j].product_name,
                    icon:"info",
                    timer: 3000,
                    });
            }
            else if(!$('#req_price'+myspecartobj[k].id).val())
            {
                // alert("Fill Price"+myspecartobj[k].product_name);
                swal({
                    title:"Failed!",
                    text:"Please fill Price field of "+myspecartobj[k].product_name,
                    icon:"info",
                    timer: 3000,
                    });
            }
            else if(!$('#req_qty'+myspecartobj[k].id).val())
            {
                // alert("Fill Qty"+myspecartobj[k].product_name);
                swal({
                    title:"Failed!",
                    text:"Please fill Quantity field of "+myspecartobj[k].product_name,
                    icon:"info",
                    timer: 3000,
                    });
            }
            else
            {
                // alert("<<>>");
                $('#store_request').submit();
                localStorage.clear();

            }
        }
    }
    else if(myqtycartobj)
    {
        alert("qty");
        if(!myspecartobj || !mypricecartobj)
        {          
            swal({

            title:"Failed!",
            text:"Please fill all basic field",
            icon:"info",
            timer: 3000,
            });        
        }
        else
        {

        }
    }
    else if(mypricecartobj)
    {
        alert("price");
        if(!myqtycartobj || !myspeccartobj)
        {          
            swal({

            title:"Failed!",
            text:"Please fill all basic field",
            icon:"info",
            timer: 3000,
            });        
        }
        else
        {
            // alert("all have");

        }
    }
    else if(myspecartobj)
    {
        alert("spec");
        if(!myqtycartobj || !mypricecartobj)
        {          
            swal({

            title:"Failed!",
            text:"Please fill all basic field",
            icon:"info",
            timer: 3000,
            });        
        }
        else if(mypricecartobj && myqtycartobj)
        {
            // alert("all have");

        }
    }
    else
    {
        alert("no");
    }
    
    
}

</script>

@endsection