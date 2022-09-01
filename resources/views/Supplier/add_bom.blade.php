@extends('master')
@section('title','Add Bill Of Material')
@section('link','Add Bill Of Material')
@section('content')
<style>
        hr{
        height: 3px;
        background-color: green;
        border: none;
    }
</style>
<div class="row">
    <div class="col-md-6">
        <div class="card" style="border-radius:50px 0px 50px 50px;border-bottom: 2px solid cyan;">
            <div class="card-shadow">
                <div class="card-header bg-info">
                    <h5>Bill Of Material (<span class="text-dark"><i>BOM</i></span>)</h5>
                </div>
                
                <form action="{{route('store_bom')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="text-info">Sale Project</label>
                                <select class="form-control" name="project_id" onchange="getProjectDetail(this.value)">
                                <option selected="selected">Select RFQ Project</option>
                                @foreach($project as $pj)
                                    <option value="{{$pj->id}}">{{$pj->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <div class="offset-md-5">
                                    <a href="#" class="btn btn-outline-warning mt-2" data-toggle="modal" data-target=".proj_detail">Details</a>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4">
                                   
                                    <a id="file" href=""  class="btn btn-outline-primary mt-2">RFQ File</a>
                                </div>
                                <!-- <div class="col-md-5 mt-4"> -->
                                   
                                    <!-- <a id="" href=""  class="btn btn-danger mt-2" data-toggle="modal" data-target=".supplier_list">Supplier List</a> -->
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="text-info">BOM NO</label>
                                <input type="text" class="form-control" id="bom_no" name="bom_no" placeholder="Enter Bill Of Material Number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="text-info">Date</label>
                                <input type="date" class="form-control" id="bom_date" name="bom_date">
                            </div>
                        </div>
                    </div>
                    
                    
                    <hr>
                <!-- Begin Product List -->
                    <div class="form-group">
                        <label class="text-success">Product List</label>
                        <div class="col-12" class="show_hide">
                            <table class="table table-bordered table-striped">
                                <thead class="text-center bg-info">
                                    <th>No</th>
                                    <th>Name</th>                                   
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Required Specs</th>
                                    <th>Required Qty</th>
                                    <th>Action</th>
                                </thead>
                                <input type="hidden" name="bom_pro" id="bom">
                                <input type="hidden" name="supplier_pricing" id="supp_pric">
                                <input type="hidden" name="total_req_qty" id="tot">
                                <tbody id="forProduct" class="text-center">
                                   
                                <?php $i = 1;?>

                                </tbody>
                            </table>
                            <label class="text-success">Total Quantity :</label><span class="badge badge-info ml-2"><span id="total"></span></span>
                        </div>
                    </div>
                <!-- End Product List -->
                <button type="submit" class="btn btn-success float-right mt-2">Save</button>
                </div><!-- End Card Body -->
                </form>
            </div>
        </div>
    </div><!-- Left Div End -->
    <div class="col-md-6">
        <div class="card" style="border-radius:50px 0px 50px 50px;border-bottom: 2px solid blue;">
            <div class="card-shadow">
                <div class="card-header bg-primary">
                    <h5 class="text-center">Inventory</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-primary">Department</label>
                                <select class="form-control" name="department_id" onchange="getDepProduct(this.value)">
                                <option selected="selected">Select Department</option>
                                
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-primary">Category</label>
                                <select class="form-control" name="department_id">
                                <option selected="selected">Select Category</option>
                                @foreach($category as $cate)
                                    <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="col-md-12">
                            <table class="table  table-striped">
                                <thead class="text-center bg-primary">
                                    <th>No</th>
                                    <th>Product Name</th>                                   
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Instock Qty</th>                                    
                                    <th>Action</th>
                                </thead>
                                <tbody id="origin_product" class="text-center">
                                <?php $i = 1;?>
                                @foreach($product as $pros)
                                <tr>
                                <input type="hidden" name="pro_id" id="name{{$pros->id}}" value="{{$pros->name}}">
                                <input type="hidden" id="proID{{$pros->id}}" value="{{$pros->id}}">
                                <input type="hidden" id="brand{{$pros->id}}" value="{{$pros->brand->name}}">                                
                                <input type="hidden" id="cate{{$pros->id}}" value="{{$pros->category->category_name}}">                                
                                <input type="hidden" id="qty{{$pros->id}}" value="{{$pros->stock_qty}}">
                                
                                
                                    <td>{{$i++}}</td>
                                    <td>{{$pros->name}}</td>
                                    <td>{{$pros->brand->name}}</td>
                                    <td>{{$pros->category->category_name}}</td>
                                    <td>{{$pros->stock_qty}}</td>
                                    <td id="color{{$pros->id}}"><button type="button" class="btn btn-primary" id="add{{$pros->id}}" data-toggle="modal" data-target="#required_{{$pros->id}}"><i class="fas fa-plus"></i></i></button></td>
                                   
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Required Modal -->
                            @foreach($product as $pros)
                            <div class="modal fade req" id="required_{{$pros->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <!-- <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div> -->
                                    <!-- <input type="text" value="{{$pros->id}}"> -->
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Supplier</label>
                                            <select class="form-control" name="supplier_id" id="supplier_id{{$pros->id}}">
                                            <option selected="selected">Select Supplier</option>
                                            @foreach($supplier as $sup)
                                                <option value="{{$sup->id}}">{{$sup->company_name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Required Qunatity</label>
                                            <input type="number" class="form-control" id="req_qty{{$pros->id}}" name="req_qty" placeholder="Enter Required Quantity">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Required Specification</label>
                                            <input type="text" class="form-control" id="req_spec{{$pros->id}}" name="req_spec" placeholder="Enter Required Specification">
                                        </div>
                                    </div>
                                        
                                      <div class="form-group">  
                                      <button class="btn btn-primary btn_addtocart float-right mr-3" data-id="{{$pros->id}}" data-name="hello" data-qty=""  onclick="tgPanel('{{$pros->id}}')" style="cursor: pointer;" ><i class="fas fa-plus"></i> Add</button>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- End Required Modal -->
                            <!-- Project Detail Modal -->
                            <div class="modal fade proj_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" id="proj_head">
                                        
                                    </div>
                                    <div class="modal-body" id="proj_body">
                                       <!-- body -->
                                       <div class="row bg-info font-weight-bold p-2">
                                            <div class="col-md-3 text-center">
                                            <span>Name</span>
                                            </div>
                                            <div class="col-md-2">
                                            <span>Estimate Date</span>
                                            </div>
                                            <div class="col-md-3 text-center">
                                            <span>Contact Person</span>
                                            </div>
                                            <div class="col-md-2">
                                            <span>Phone</span>
                                            </div>
                                            <div class="col-md-2">
                                            <span>Location</span>
                                            </div>
                                        </div>
                                        <div id="body">
                                        </div>
                                       <!-- end body -->
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- End Project Detail Modal -->
                            <!-- Begin Supplier Modal -->
                            <div class="modal fade supplier_list" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>Supplier Lists In BOM</h5>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Begin Body -->
                                        <div class="row bg-info font-weight-bold p-2">
                                            <div class="col-md-1">
                                            <span>No</span>
                                            </div>
                                            <div class="col-md-2">
                                            <span>Product</span>
                                            </div>
                                            <div class="col-md-2">
                                            <span>Brand</span>
                                            </div>
                                            <div class="col-md-2 text-center">
                                            <span>Supplier</span>
                                            </div>
                                            <div class="col-md-3 text-center">
                                            <span>Email</span>
                                            </div>
                                            <div class="col-md-2 text-center">
                                            <span>Action</span>
                                            </div>
                                        </div>
                                        <div id="supplierspace">
                                        </div>
                                        <!-- End body -->
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- End Supplier Modal -->
                            <!-- Begin Price Modal -->
                            @foreach($product as $pros)
                            <div class="modal fade offset-md-4" id="price_{{$pros->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                        <input type="hidden" id="SupplierID{{$pros->id}}">
                                        <h5><span id="suppl{{$pros->id}}"></span></h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger error" role="alert" id="alert{{$pros->id}}">
                                        Supplier Quotated Price is greater than Proposed Price
                                        </div>
                                       <!-- modal body -->
                                       <div class="form-group">
                                            <label for="message-text" class="col-form-label">Supplier Quoted Price</label>
                                            <input type="number" class="form-control" name="sup_quo_price" id="quo_price{{$pros->id}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Proposed Price</label>
                                            <input type="number" class="form-control" name="proposed_price" id="proposed_price{{$pros->id}}" onkeyup="keypropose('{{$pros->id}}')">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Profit Margin</label>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input type="number" class="form-control" name="profit" id="profit{{$pros->id}}">
                                                </div>
                                                <div class="col-md-3">
                                                <input type="number" class="form-control" name="margin" id="margin{{$pros->id}}">
                                                </div>
                                                <div class="col-md-1">
                                                <span><i class="fas fa-percentage mt-3 fa-lg pr-2"></i></span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger float-right pricesave" id="priceSave{{$pros->id}}" onclick="price_sup('{{$pros->id}}')">Save</button>
                                        </div>

                                       <!-- End modal Body -->
                                    </div>
                                </div>
                            </div>
                            </div>
                            @endforeach
                            <!-- End Price Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
@section('js')
<script>
$(document).ready(function()
{

})
function getDepProduct(dep_id)
{
   
    
    // alert(dep_id);
    
    $.ajax({
           type:'POST',
           url:'/ajax_get_department_product',
           dataType:'json',
           data:{ "_token": "{{ csrf_token() }}",
           "dep_id":dep_id,
        },
           success:function(data){
               var htmldep = "";
                var i=0;j=1;
                // alert(data[0].id);
               for(i=0,j=1;i<data.pro_dep.length,j<=data.pro_dep.length;i++,j++)
               {
               htmldep +=`
               <tr>
                    <input type="hidden" id="proID${data.pro_dep[i].id}" value="${data.pro_dep[i].id}">
                    <input type="hidden" id="name${data.pro_dep[i].id}" value="${data.pro_dep[i].name}">
                    <input type="hidden" id="brand${data.pro_dep[i].id}" value="${data.brand_name[i]}">                                
                    <input type="hidden" id="cate${data.pro_dep[i].id}" value="${data.cate_name[i]}">                                
                    <input type="hidden" id="qty${data.pro_dep[i].id}" value="${data.pro_dep[i].stock_qty}">
                <td>${j}</td>
                <td>${data.pro_dep[i].name}</td>
                <td>${data.brand_name[i]}</td>
                <td>${data.cate_name[i]}</td>
                <td>${data.pro_dep[i].stock_qty}</td>
                <td id="color${data.pro_dep[i].id}"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#required_${data.pro_dep[i].id}"><i class="fas fa-plus"></i> Add</i></button></td>
               </tr>
               `;
               }
               $('#origin_product').html(htmldep);
               var products_all_id = @json($product_all);
    var bomcart = localStorage.getItem('bomcart');
    var mybomcartobj = JSON.parse(bomcart);
    var cart_arr = [];
           $.each(mybomcartobj,function(i,v){
                cart_arr.push(v.id);
                if(jQuery.inArray(cart_arr, products_all_id)) {
                    // alert("has");
            var htmlcolor = "";
            htmlcolor +=`<button class="btn btn-secondary"><i class="fas fa-plus"></i></button>`;
            $('#color'+v.id).html(htmlcolor);
                } else {
                    console.log("is NOT in array");
                    // alert("not have");
                }
           })
           }
    });
}

var count =0;
function tgPanel(id) {
    var products_all_id = @json($product_all);
    // alert(products_all_id);
   
   //Check jquery data-id from tgpanel
   var proid= $(this).data('name');
   //Cneck end
   
   console.log(proid);
   var supplier_id = $('#supplier_id'+id).val();
//    alert(supplier_id);
    var product_id = $('#proID'+id).val();
    var brand = $('#brand'+id).val();
    var category = $('#cate'+id).val();
    var stock = $('#qty'+id).val();
    var req_qty = $('#req_qty'+id).val();
    var req_spec = $('#req_spec'+id).val();
    var name = $('#name'+id).val();
    if($.trim(req_qty) == '' || $.trim(req_spec) == ''){
          
          swal({

                title:"Failed!",
                text:"Please fill all basic field",
                icon:"info",
                timer: 3000,
            });
      }
      else
      {
    // alert(product_id+brand+category+stock+req_qty+req_spec);
    var products = {id:product_id,supplier_id:supplier_id,name:name,brand:brand,category:category,req_qty:req_qty,req_spec:req_spec,stock_qty:stock};
    var bomcart = localStorage.getItem('bomcart');
    if(!bomcart){
          bomcart = '[]';
        }
    var mybomcartobj = JSON.parse(bomcart);
   

        
                mybomcartobj.push(products);
            
            
            localStorage.setItem('bomcart',JSON.stringify(mybomcartobj));
            // $('#add'+id).attr('disabled','disabled');
            var cart_arr = [];
           $.each(mybomcartobj,function(i,v){
                cart_arr.push(v.id);
                if(jQuery.inArray(cart_arr, products_all_id)) {
            var htmlcolor = "";
            htmlcolor +=`<button class="btn btn-secondary"><i class="fas fa-plus"></i></button>`;
            $('#color'+id).html(htmlcolor);
                } else {
                    console.log("is NOT in array");
                }
           })
        //    alert(cart_arr);
           
            
            $('.req').modal('hide');
            // Begin left side
            
            showleft_product()
           var bom =  JSON.stringify(mybomcartobj);
           var htmltotal = "";
            $('#bom').val(bom);
            // End left Side
            var total = 0;
            $.each(mybomcartobj,function(i,v){
                total =total + JSON.parse(v.req_qty);

            });
            htmltotal +=`${total}`;
           $('#total').html(htmltotal);
           $('#tot').val(total);
        //    Begin Supplier List Modal
            
                $.ajax({
                type:'POST',
                url:'/ajax_get_bom_supplier',
                dataType:'json',
                data:{ "_token": "{{ csrf_token() }}",
                "supplier_id":supplier_id,
                "product_id":id,
                },
                success:function(data){
                    count++;
                    var htmlsupplier = "";
                        htmlsupplier += `
                            <div class="row mb-1 mt-3 font-weight-bold" style="font-size:18px;">  
                            <div class="col-md-1">
                                <span>${count}</span>
                            </div>             
                            <div class="col-md-2">
                                <span>${data.product_name}<span>
                            </div>
                            <div class="col-md-2">
                            <span>${data.brand_name}</span>
                            </div>
                            <div class="col-md-2 text-center">
                            <span>${data.supplier.name}</span>
                            </div>
                            <div class="col-md-3 text-center">
                            <span>${data.supplier.email}</span>
                            </div>
                            <div class="col-md-2 text-center">
                            <span><button class="btn btn-dark" data-toggle="modal" data-target="#price_${product_id}">Price</button></span>
                            </div>
                            
                        
                        </div>
                        
                        
                        
                        
                        `;
                        $('#supplierspace').append(htmlsupplier);
                        var supplier = "";
                        supplier +=`${data.supplier.name}`;
                        $('#suppl'+product_id).html(supplier);
                        $('#SupplierID'+product_id).val(data.supplier.id);

                    }

                });


        //    End Supplier List Modal
           
           
        }

}
function showleft_product()
{
    var bomcart = localStorage.getItem('bomcart');
    var mybomcartobj = JSON.parse(bomcart);
    var htmlshow = "";
            $.each(mybomcartobj,function(i,v){
            htmlshow +=`
                    <tr>
                    <td>${i+1}</td>
                    <td>${v.name}</td>
                    <td>${v.brand}</td>
                    <td>${v.category}</td>
                    <td>${v.req_spec}</td>
                    <td>${v.req_qty}</td>
                    <td><span class="badge badge-danger  btn_delete" data-index="${i}"><i class="fas fa-times"></i></span></td>
                    </tr>
            `;
            });
            $('#forProduct').html(htmlshow);
}
$("#forProduct").on('click','.btn_delete',function(data){
        var index=$(this).data('index');
        // alert(id);
        var bomcart = localStorage.getItem('bomcart');
        var mybomcartobj = JSON.parse(bomcart);
        // alert(mybomcartobj.length);
        mybomcartobj.splice(index,1);
        
        if(mybomcartobj.length == 0)
        {
            setTimeout(function(){
             		window.location.reload();
             	},1000);
                 localStorage.clear();
        }
        else
        {
            localStorage.setItem('bomcart',JSON.stringify(mybomcartobj));
        }



        
        showleft_product();
        
        
})
function getProjectDetail(proj_id)
{
    // alert(proj_id);
    $.ajax({
           type:'POST',
           url:'/ajax_get_project_detail',
           dataType:'json',
           data:{ "_token": "{{ csrf_token() }}",
           "project_id":proj_id,
        },
           success:function(data){
               var htmlhead = "";
               var htmlbody = "";
               htmlhead +=`<label class="text-success">${data.name}</label>`;
               $('#proj_head').html(htmlhead);
               htmlbody +=`
               
                        <div class="row mb-1 mt-3 font-weight-bold" style="font-size:18px;">                
                            <div class="col-md-3">
                                <span>${data.name}<span>
                            </div>
                            <div class="col-md-2">
                                <span>${data.estimate_date}</span>
                            </div>
                            <div class="col-md-3 text-center">
                                <span>${data.project_contact_person}</span>
                            </div>
                            <div class="col-md-2">
                                <span>${data.phone}</span>
                            </div>
                            <div class="col-md-2">
                                <span>${data.location}</span>
                            </div>
                        </div>
               
               `;
            $('#body').html(htmlbody);
            var rfq = "image/"+data.rfq_file_path;
            
            
            $('#file').attr("href",rfq);
           }
        });


}

function price_sup(product_id)
{
    var supplier_id = $('#SupplierID'+product_id).val();
    var quo_price = $('#quo_price'+product_id).val();
    var propo_price = $('#proposed_price'+product_id).val();
    var profit = $('#profit'+product_id).val();
    var margin = $('#margin'+product_id).val();
    // alert(quo_price+propo_price);
    if($.trim(quo_price) == '' || $.trim(propo_price) == ''){
          
          swal({

                title:"Failed!",
                text:"Please fill all basic field",
                icon:"info",
                timer: 3000,
            });
      }
      else
      {
          var supplier_price = {id:product_id,supplier_id:supplier_id,quoted_price:quo_price,proposed_price:propo_price,profit:profit,margin:margin};
          var pricecart = localStorage.getItem('pricecart');
          if(!pricecart){
          pricecart = '[]';
        }
        var mypricecartobj = JSON.parse(pricecart);
        var hasid = false;
        
            $.each(mypricecartobj,function(i,v){
                // v.total_amount = total_amount;
            
                if(v.id == product_id)
                {
                hasid = true;
                
                }
            })
            if(!hasid){
                mypricecartobj.push(supplier_price);
            }
            
            localStorage.setItem('pricecart',JSON.stringify(mypricecartobj));
            var str_price = JSON.stringify(mypricecartobj);
            $('#supp_pric').val(str_price);
            $('#priceSave'+product_id).hide();

      }
    
 }
 function keypropose(product_id)
 {
    var quo_price = $('#quo_price'+product_id).val();
            var propo_price = $('#proposed_price'+product_id).val();
    if(JSON.parse(quo_price) > JSON.parse(propo_price))
        {
            
            $('.error').show();
            $('.pricesave').attr('disabled',true);
        }
        else
        {
            $('.error').hide();
            var profit_in = JSON.parse(propo_price) - JSON.parse(quo_price);
            var margin_in = (JSON.parse(quo_price) / JSON.parse(propo_price)) * 100;
            $('#profit'+product_id).val(profit_in);
            var margin = $('#margin'+product_id).val(margin_in);
            $('.pricesave').attr('disabled',false);
        }
   
 }
 $(document).ready(function()
 {
    $('.pricesave').attr('disabled',true);
    $('.error').hide();
 })

</script>

@endsection