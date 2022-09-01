@extends('master')
@section('title','Bom Supplier Product')
@section('link','Bom Of Material Product')
@section('content')
<style>
.crd{
    box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
}
</style>
<div class="row">
    <div class="col-12">
        <div class="card crd" style="border-radius:0px 0px 50px 50px;border-bottom: 2px solid cyan;">
            <div class="card-header">
                <div class="row justify-content-between">
                    <h4 class="text-success"><i>{{$bom->bom_no}}</i><span class="text-secondary">'s Request Registration Form</span></h4>
                </div>                
            </div>
            <form action="{{route('send_email_store_req')}}" method="post" id="store_request">
                @csrf
                <input type="hidden" value="{{$bom->id}}" name="bom_id">
                <input type="hidden" id="email_flag" name="email_flag">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name" class="text-info">Request No</label>
                            <input type="text" class="form-control" id="request_no" name="request_no" placeholder="Enter Request No" style="border-color:cyan">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label text-info">Supplier</label>
                            <select class="form-control" name="supplier_id" id="supplier_id" onchange="filldetail(this.value,'{{$bom->id}}')" style="border-color:cyan">
                            <option selected="selected">Select Supplier</option>
                            @foreach($bom_supplier as $sup)
                                <option value="{{$sup->id}}">{{$sup->company_name}}</option>
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
                            <label for="name" class="text-info">Email</label>
                            <input type="text" class="form-control" id="supplier_email" name="supplier_email" placeholder="Supplier Email" readonly style="border-color:cyan">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name" class="text-info">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" style="border-color:cyan">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name" class="text-info">Tendative Reply Date</label>
                            <input type="date" class="form-control" id="reply_date" name="reply_date" placeholder="Enter Tendative Reply Date" value="<?php echo date('Y-m-d'); ?>" style="border-color:cyan">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="container">
                            <label class="offset-md-5 text-info">Description</label><br>
                            <textarea class="ml-3" rows="5px" cols="155px" name="description" id="desc" style="border-color:cyan"></textarea>
                        </div>
                    </div>
                </div><hr>
                <div class="form-group mt-3">                   
                    <div class="col-12" class="show_hide">
                        <label class="text-success">Product List</label>
                    <span class="offset-md-5 mb-2">
                            <button type="button" class="btn btn-sm btn-outline-primary mb-2" onclick="get_all_pro('{{$bom->id}}')">All Products<i class="fa fa-reply-all ml-2" aria-hidden="true"></i></button>
                    </span>
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
                            <input type="hidden" id="product_id" name="product_id[]" value="{{$bpro->product_id}}">
                                <tr id="change_color{{$bpro->id}}">
                                    <td>{{$i++}}</td>
                                    <td>{{$bpro->product->name}}</td>
                                    <td>{{$bpro->product->brand->name}}</td>
                                    <td class="pr-3"><span id="editQty{{$bpro->id}}"><input type="text" class="form-control" id="qty{{$bpro->id}}" name="qty[]" size="1" value="0" style="border-color:cyan"></span></td>
                                    <td class="pr-3"><span id="editPrice{{$bpro->id}}"><input type="text" class="form-control" id="price{{$bpro->id}}" name="price[]" size="1" value="0" style="border-color:cyan"></span></td>
                                    <td class="pr-3"><span id="editSpec{{$bpro->id}}"><input type="text" class="form-control" id="spec{{$bpro->id}}" name="spec[]" size="1" placeholder="specs..." style="border-color:cyan"></span></td>
                                <!--<td><span id="editQty{{$bpro->id}}"><button type="button"  class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit_req_qty_{{$bpro->id}}"><i class="fas fa-tools mr-2"></i>Edit</button></span></td>
                                    <td><span id="editPrice{{$bpro->id}}"><button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit_req_price_{{$bpro->id}}"><i class="fas fa-tools mr-2"></i>Edit</button></span></td>
                                    <td><span id="editSpec{{$bpro->id}}"><button type="button"  class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit_req_spec_{{$bpro->id}}"><i class="fas fa-tools mr-2"></i>Edit</button></span></td> -->
                                    <td><span class="badge badge-danger pl-2 pr-2 pt-2 pb-2"><i class="fas fa-times"></i></span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- <label>Total Quantity :</label><span class="badge badge-info ml-2"><span id="total"></span></span> -->
                    </div>                  
                </div>
                </form>
            </div><!-- card body end -->
            <!-- End Edit product required spec modal -->
            <div class="card-footer">
               
                    
                        <button type="button" class="btn btn-primary" style="margin-left:580px" onclick="sendcheck()"><i class="fas fa-save mr-2"></i>Save</button>
                   
                   
                   
                        
                            <!-- <input type="hidden" name="sup_id" id="sup_id">
                            <input type="hidden" name="bom_id" value="{{$bom->id}}">
                            <input type="text" name="title" id="title_mail">
                            <input type="text" name="desc" id="desc_mail">
                            <input type="text" name="product" id="productmail">
                            <input type="text" name="qtymail" id="qtymail">
                            <input type="text" name="pricemail" id="pricemail">
                            <input type="text" name="specmail" id="specmail"> -->

                            <button type="button" class="btn btn-danger" style="margin-right:200px" onclick="sent_to()"><i class="fas fa-envelope mr-2"></i>Send Email</button>
                      
                    
                
            </div>

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

function filldetail(supplier_id,bom_id)
{
    // alert(supplier_id);
    $('#sup_id').val(supplier_id);
    $.ajax({
                type:'POST',
                url:'/ajax_get_request_supplier',
                dataType:'json',
                data:{ "_token": "{{ csrf_token() }}",
                "supplier_id":supplier_id,
                "bom_id":bom_id
                },
                success:function(data){
                    $('#supplier_email').val(data.supplier.email);
                    var htmlproduct = "";
                    var i=0;
                    for(i=0;i<data.bpsup.length;i++)
                    {
                        htmlproduct +=`
                        <tr>
                        <input type="hidden" id="product_id" name="product_id[]" value="${data.bpsup[i].product_id}">

                            <td>${i+1}</td>
                            <td>${data.bpsup[i].product.name}</td>
                            <td>${data.brand[i].name}</td>
                            <td class="pr-3"><span><input type="text" class="form-control" id="qty${data.bpsup[i].id}" name="qty[]" size="1" value="0"></span></td>
                            <td class="pr-3"><span><input type="text" class="form-control" id="price${data.bpsup[i].id}" name="price[]" size="1" value="0"></span></td>
                            <td class="pr-3"><span><input type="text" class="form-control" id="spec${data.bpsup[i].id}" name="spec[]" size="1" placeholder="specs..."></span></td>
                            <td><span class="badge badge-danger pl-2 pr-2 pt-2 pb-2"><i class="fas fa-times"></i></span></td>
                        </tr>
                    `;
                    }
                    $('#bom_product').html(htmlproduct);
                   
                }
    });
}
// function sendcheck()
// {
    
//     // alert("hel");
//     var qtycart = localStorage.getItem('qtycart');
//     var myqtycartobj = JSON.parse(qtycart);

//     var pricecart = localStorage.getItem('pricecart');
//     var mypricecartobj = JSON.parse(pricecart);

//     var specart = localStorage.getItem('specart');
//     var myspecartobj = JSON.parse(specart);
   

   
//     // for(i=0;i<myqtycartobj.length;i++)
//     // {
//     //     // alert($('#req_qty'+myqtycartobj[i].id).val());
//     //     if(!$('#req_price'+myqtycartobj[i].id).val())
//     //     {
//     //         alert("blue");
//     //         swal({

//     //     title:"Failed!",
//     //     text:"Please fill Qty field of "+myqtycartobj[i].product_id,
//     //     icon:"info",
//     //     timer: 3000,
//     //     })
//     //     }
//     // }
//     /////////////////////////////////////////////////////////////////////////
//     // var i;
//     // if(myqtycartobj)
//     // {
//     //     if(!myspecartobj || !mypricecartobj)
//     //     {          
//     //         swal({

//     //         title:"Failed!",
//     //         text:"Please fill all basic field",
//     //         icon:"info",
//     //         timer: 3000,
//     //         });        
//     //     }
//     //     else if(myspecartobj && mypricecartobj)
//     //     {
//     //         // alert("all have");
//     //         // var price = mypricecartobj.toArray();
//     //         var qty_product = [];
//     //         for(i=0;i<myqtycartobj.length;i++)
//     //         {
//     //             qty_product.push(myqtycartobj[i].product_id);
//     //         }
//     //         if()
//     //         {

//     //         }
            

//     //     }

//     // }
//     // else if(mypricecartobj)
//     // {
//     //     if(!myqtycartobj || !myspeccartobj)
//     //     {          
//     //         swal({

//     //         title:"Failed!",
//     //         text:"Please fill all basic field",
//     //         icon:"info",
//     //         timer: 3000,
//     //         });        
//     //     }
//     //     else if(myspecartobj && myqtycartobj)
//     //     {
//     //         // alert("all have");

//     //     }
//     // }
//     // else if(myspeartobj)
//     // {
//     //     if(!myqtycartobj || !mypricecartobj)
//     //     {          
//     //         swal({

//     //         title:"Failed!",
//     //         text:"Please fill all basic field",
//     //         icon:"info",
//     //         timer: 3000,
//     //         });        
//     //     }
//     //     else if(mypricecartobj && myqtycartobj)
//     //     {
//     //         // alert("all have");

//     //     }
//     // }
//     if(myqtycartobj && mypricecartobj && myspecartobj)
//     {
//         // alert("all");
//         // alert(myqtycartobj.length+"=="+mypricecartobj.length+"++"+myspecartobj.length);
//         var i,j,k;
//         for(i=0,j=0,k=0;i<myqtycartobj.length,j<mypricecartobj.length,k<myspecartobj.length;i++,j++,k++)
//         {
//             if(!$('#req_price'+myqtycartobj[i].id).val())
//             {
//                 // alert("Fill Price"+myqtycartobj[i].product_name);
//                 swal({
//                     title:"Failed!",
//                     text:"Please fill Price field of "+myqtycartobj[i].product_name,
//                     icon:"info",
//                     timer: 3000,
//                     });    
//             }
//             else if(!$('#req_spec'+myqtycartobj[i].id).val())
//             {
//                 // alert("Fill Specification"+myqtycartobj[i].product_name);
//                 swal({
//                     title:"Failed!",
//                     text:"Please fill Specification field of "+myqtycartobj[i].product_name,
//                     icon:"info",
//                     timer: 3000,
//                     }); 
//             }
//             else if(!$('#req_qty'+mypricecartobj[j].id).val())
//             {
//                 // alert("Fill Qty"+mypricecartobj[j].product_name);
//                 swal({
//                     title:"Failed!",
//                     text:"Please fill Quantity field of "+mypricecartobj[j].product_name,
//                     icon:"info",
//                     timer: 3000,
//                     }); 
//             }
//             else if(!$('#req_spec'+mypricecartobj[j].id).val())
//             {
//                 // alert("Fill Specification"+mypricecartobj[i].product_name);
//                 swal({
//                     title:"Failed!",
//                     text:"Please fill Specification field of "+mypricecartobj[j].product_name,
//                     icon:"info",
//                     timer: 3000,
//                     });
//             }
//             else if(!$('#req_price'+myspecartobj[k].id).val())
//             {
//                 // alert("Fill Price"+myspecartobj[k].product_name);
//                 swal({
//                     title:"Failed!",
//                     text:"Please fill Price field of "+myspecartobj[k].product_name,
//                     icon:"info",
//                     timer: 3000,
//                     });
//             }
//             else if(!$('#req_qty'+myspecartobj[k].id).val())
//             {
//                 // alert("Fill Qty"+myspecartobj[k].product_name);
//                 swal({
//                     title:"Failed!",
//                     text:"Please fill Quantity field of "+myspecartobj[k].product_name,
//                     icon:"info",
//                     timer: 3000,
//                     });
//             }
//             else
//             {
//                 // alert("<<>>");
//                 $('#store_request').submit();
//                 localStorage.clear();

//             }
//         }
//     }
//     else if(myqtycartobj)
//     {
//         alert("qty");
//         if(!myspecartobj || !mypricecartobj)
//         {          
//             swal({

//             title:"Failed!",
//             text:"Please fill all basic field",
//             icon:"info",
//             timer: 3000,
//             });        
//         }
//         else
//         {

//         }
//     }
//     else if(mypricecartobj)
//     {
//         alert("price");
//         if(!myqtycartobj || !myspeccartobj)
//         {          
//             swal({

//             title:"Failed!",
//             text:"Please fill all basic field",
//             icon:"info",
//             timer: 3000,
//             });        
//         }
//         else
//         {
//             // alert("all have");

//         }
//     }
//     else if(myspecartobj)
//     {
//         alert("spec");
//         if(!myqtycartobj || !mypricecartobj)
//         {          
//             swal({

//             title:"Failed!",
//             text:"Please fill all basic field",
//             icon:"info",
//             timer: 3000,
//             });        
//         }
//         else if(mypricecartobj && myqtycartobj)
//         {
//             // alert("all have");

//         }
//     }
//     else
//     {
//         alert("no");
//     }
    
    
// }
function sendcheck()
{
    var bomproduct = @json($bom_product);
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
            $('#email_flag').val(0);
            $('#store_request').submit();
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
            $('#email_flag').val(0);
            $('#store_request').submit();
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
            $('#email_flag').val(0);
            $('#store_request').submit();
        }
    }
        
    });
}
function get_all_pro(bom_id)
{
    // alert(bom_id);
    $.ajax({
        type:'POST',
        url:'/ajax_get_all_products',
        dataType:'json',
        data:{ "_token": "{{ csrf_token() }}",
        "bom_id":bom_id
        },
        success:function(data){
            // alert("success");
            var htmlproduct = "";
                    var i=0;
                    for(i=0;i<data.bom_product.length;i++)
                    {
                        htmlproduct +=`
                        <tr>
                        <input type="hidden" id="product_id" name="product_id[]" value="${data.bom_product[i].product_id}">

                            <td>${i+1}</td>
                            <td>${data.bom_product[i].product.name}</td>
                            <td>${data.brand[i]}</td>
                            <td class="pr-3"><span><input type="text" class="form-control" id="qty${data.bom_product[i].id}" name="qty[]" size="1" value="0"></span></td>
                            <td class="pr-3"><span><input type="text" class="form-control" id="price${data.bom_product[i].id}" name="price[]" size="1" value="0"></span></td>
                            <td class="pr-3"><span><input type="text" class="form-control" id="spec${data.bom_product[i].id}" name="spec[]" size="1" placeholder="specs..."></span></td>
                            <td><span class="badge badge-danger pl-2 pr-2 pt-2 pb-2"><i class="fas fa-times"></i></span></td>
                        </tr>
                    `;
                    }
                    $('#bom_product').html(htmlproduct);
        }
    });
}
function sent_to()
{
    var bomproduct = @json($bom_product);
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
            $('#email_flag').val(1);
            $('#store_request').submit();
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
            $('#email_flag').val(1);
            $('#store_request').submit();
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
            $('#email_flag').val(1);
            $('#store_request').submit();
        }
    }
        
    });

//     var pro_id_arr = [];
//     var qty_arr = [];
//     var price_arr = [];
//     var spec_arr = [];
//     $('#title_mail').val($('#title').val());
//     $('#desc_mail').val($('#desc').val());
//     var inps = document.getElementsByName('product_id[]');
//     var qtys = document.getElementsByName('qty[]');
//     var prices = document.getElementsByName('price[]');
//     var specs = document.getElementsByName('spec[]');
// for (var i = 0; i <inps.length; i++) {
// var inp=inps[i];
// var qt = qtys[i];
// var pr = prices[i];
// var spe = specs[i];
//     // alert("product_id["+i+"].value="+inp.value);
//     pro_id_arr.push(inp.value);
//     qty_arr.push(qt.value);
//     price_arr.push(pr.value);
//     spec_arr.push(spe.value);
// }
//     var pro_id = JSON.stringify(pro_id_arr);
//     var qtymail = JSON.stringify(qty_arr);
//     var pricemail = JSON.stringify(price_arr);
//     var specmail = JSON.stringify(spec_arr);

//     $('#productmail').val(pro_id);
//     $('#qtymail').val(qtymail);
//     $('#pricemail').val(pricemail);
//     $('#specmail').val(specmail);
//     $('#send_email').submit();
}

</script>

@endsection