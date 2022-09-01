@extends('master')
@section('title','BOM Supplier Good Receive Note')
@section('link','BOM Supplier Good Receive Note')
@section('content')
<style>
.crd{
    box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
}

.borderless table {
    border-top-style: none;
    border-left-style: none;
    border-right-style: none;
    border-bottom-style: none;
}

</style>
<div class="card crd" style="border-radius:0px 0px 50px 50px;border-bottom: 2px solid cyan;">
    <div class="card-shadow">
        <div class="card-header">
            <label class="text-success"><i></i></label>
            <span class="float-center offset-md-5 text-primary"><label>BOM Supplier Good Receive Note</label></span>
            
        </div>
        <form action="{{route('store_grn')}}" method="post" id="">
            @csrf
            <input type="hidden" name="bom_supplier_id" value="">
            <input type="hidden" name="grnitem" id="grnitem" value="">
            <input type="hidden" name="bom_po_id" value="{{$bom_po->id}}">

        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="name" class="text-info">Grn No</label>
                        <input type="text" class="form-control border border-info" id="grn_no" name="grn_no" placeholder="Enter Good Receive Note Number">
                        </div>
                    </div>
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                        <label for="name" class="text-info">Date</label>
                        <input type="date" class="form-control border border-info" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                <label class="text-info">Choose Inventory Location</label>
                <div id="goto">
                    
                    <div class="row">
                        <div class="col-md-6">
                        <span class="badge badge-light text-primary">
                            <input type="radio" id="warehouse" name="type" value="1" onclick="isWarehouse(this.value)">
                            <label class="control-lable" style="font-size:15px;letter-spacing: 5px;">Warehouse</label>
                        </span>
                        </div>
                        <div class="col-md-6">
                        <span class="badge badge-light text-primary">
                            <input type="radio" id="site" name="type" value="2" onclick="isWarehouse(this.value)">
                            <label class="control-label" style="font-size:15px;letter-spacing: 5px;">Site</label>
                        </span>
                        </div>
                    </div><br>
                </div>
                </div>
                <div class="form-group inv d-none">
                <div class="row">
                        <div class="col-md-2 mt-4 mainradio" id="main_radio">
                            <input type="radio" name="warehouse_flag" id="main" value="1" onclick="isWarehouse(this.value)">
                            <label class="control-label text-primary">Main</label>
                        </div>
                        <div class="col-md-2 mt-4 regionalradio" id="regional_radio">
                            <input type="radio" id="region" value="2" name="warehouse_flag" onclick="isregional()">
                            <label class="control-label text-primary">Regional</label>
                        </div>
                        <div class="col-md-6 rename mt-4 ml-2 re_name" id="rename">
                            <label class="control-label text-primary">Regional Name</label>
                            <select class="form-control border border-info" id="regID" name="regional_id" onchange="regionalName(this.value)">
                              <option>Select Regional Warehouse</option>
                              @foreach($regionalname as $rename)
                              <option value="{{$rename->id}}">{{$rename->warehouse_name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <!-- Site -->
                        <div class="col-md-4 projectbox" id="project_box">
                            <label class="control-label text-info">Project</label>
                            <input type="hidden" id="projIDD">
                            <select class="form-control border border-info" id="pro" name="proid" onchange="getSiteInventoryProject(this.value)">
                              <option>Select Project</option>
                              @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 phasebox" id="phase_box">
                            <label class="control-label text-info">Phase</label>
                            <select class="form-control border border-info" id="forPhase" name="phase_id" disabled="disabled" onchange="getSiteInventoryPhase(this.value)">
                            </select>
                        </div>
                        <div class="col-md-4 sitebox" id="site_box">
                            <label class="control-label text-info">Site Engineer</label>
                            <select class="form-control border border-info" name="site_id" onchange="getSiteInventoryAll(this.value)">
                            <option value="">Select</option>
                            
                            </select>
                        </div>
                        <!-- end site -->
                </div>
            </div>
            <hr>
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
                        @foreach($bom_po_product as $bspro)
                        <tr>
                            <input type="hidden" name="product_id[]" value="{{$bspro->product_id}}">
                            
                            <td>{{$i++}}</td>
                            <td>{{$bspro->product->name}}</td>
                            <td>{{$bspro->product->brand->name}}</td>
                            <td>{{$bspro->order_qty}}</td>
                            <td>{{$bspro->order_price}}</td>
                            <td>{{$bspro->required_specification}}</td>

                            <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_item{{$bspro->product_id}}"><i class="fa fa-plus mr-2"></i>Item</button>   
                            <a data-toggle="collapse" href="#items{{$bspro->product_id}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" class="btn btn-secondary btn-sm" onclick="show_item('{{$bspro->id}}','{{$bspro->product_id}}')"><i class="fa fa-caret-down" aria-hidden="true"></i></a> 
                            <span class="badge badge-danger pl-2 pr-2 pt-2 pb-2"><i class="fas fa-times"></i></span></td>
                        </tr>
                        <tr>
                            <td colspan="10">
                            <div class="collapse out container mr-5" id="items{{$bspro->product_id}}">
                                <table class="table borderless">
                                    <thead class="bg-secondary text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>S/N</th>
                                            <th>Hs code</th>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Dimension</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="result_item{{$bspro->product_id}}" class="text-center">
                                        
                                    </tbody>
                                </table>
                            </div>
                            </td>
                        </tr>
                        <!-- Begin Add Item Modal -->
                        <div class="modal fade" id="add_item{{$bspro->product_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Item Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">Item Registration</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <!-- {{$bspro->id}} -->
                              <input type="text" name="product_id" value="{{$bspro->product_id}}">
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="phase_name" class="text-info">Serial Number</label>
                                      <input type="text" class="form-control" name="serial_no" id="serial_no{{$bspro->product_id}}" placeholder="Enter Phase Name">
                                  </div>
                                  <div class="form-group">
                                      <label for="phase_name" class="text-info">Unit Purchase Price</label>
                                      <input type="text" class="form-control" name="unit_price" id="unit_price{{$bspro->product_id}}" placeholder="Enter Unit Purchase Price">
                                  </div>
                                  <div class="form-group">
                                      <label for="phase_name" class="text-info">Unit Purchase Date</label>
                                      <input type="date" class="form-control" name="date" id="unit_date{{$bspro->product_id}}" value="<?php echo date('Y-m-d'); ?>">
                                  </div>
                                  <div class="form-group">
                                      <label for="phase_name" class="text-info">Size</label>
                                      <input type="text" class="form-control" name="size" id="size{{$bspro->product_id}}" placeholder="Enter item size">
                                  </div>
                                  <div class="form-group">
                                      <label for="phase_name" class="text-info">Color</label>
                                      <input type="text" class="form-control" name="color" id="color{{$bspro->product_id}}" placeholder="Enter item color">
                                  </div>
                                  <div class="form-group">
                                      <label for="phase_name" class="text-info">Dimension</label>
                                      <input type="text" class="form-control" name="dimension" id="dimension{{$bspro->product_id}}" placeholder="Enter item dimension">
                                  </div>
                                  <div class="form-group">
                                      <label for="phase_name" class="text-info">HS_Code</label>
                                      <input type="text" class="form-control" name="hs_code" id="hs_code{{$bspro->product_id}}" placeholder="Enter item hs_code">
                                  </div>
                                  <div class="form-group">
                                      <label for="phase_name" class="text-info">Stock Qty</label>
                                      <input type="number" class="form-control" name="qty" id="qty{{$bspro->product_id}}" placeholder="Enter Stock Qty">
                                  </div>
                                  <div class="form-group">
                                        <label for="description" class="text-info">Other Specification</label>
                                        <textarea class="form-control" name="other_spec" id="other_spec{{$bspro->product_id}}" rows="3" placeholder="Enter Specification"></textarea>
                                  </div>
                        </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="tgPanel('{{$bspro->id}}','{{$bspro->product_id}}')">Save</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                     <!-- End Item Modal -->
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </form>

        
        
       
        
        <div class="card-footer">
            
            <button class="btn btn-primary offset-md-5" onclick="sendcheck()"><i class="fas fa-save ml-2 mr-2"></i>Save And Send</button>
            <!-- <button class="btn btn-danger"><i class="fas fa-paper-plane ml-2 mr-2"></i>Send Email</button> -->

        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $(document).ready(function(){
    $('.mainradio').hide();
    $('.regionalradio').hide();
    $('.projectbox').hide();
    
    $('.phasebox').hide();
    
    $('.sitebox').hide();

    $('.re_name').hide();

    // $('#goto').hide();
  })
    function isWarehouse(value){
    //    alert("isWarehouse"+value);
    $('.inv').removeClass("d-none");
        $('#mainval').val(value);
        $('#regionalval').val("");
        $('#projectID').val("");
        $('#phaseID').val("");
        $('#engeID').val(""); 
      
        console.log(value);
        
        if(value == 1){
            
            $('#main_radio').show();
            
            $('#regional_radio').show();
            
            $('#project_box').hide();
            
            $('#phase_box').hide();
            
            $('#site_box').hide();

            $('#rename').hide();
        }
        
        else if(value == 2){
            
            $('#main_radio').hide();
            
            $('#regional_radio').hide();

            $('#rename').hide();
            
            $('#project_box').show();
            
            $('#phase_box').show();
            
            $('#site_box').show();

            $('.ren_ame').hide();
        }
    }
    function isregional(){
        // alert("HEEEEEE");
        $('#rename').show();
    }
    function tgPanel(bspro_id,bsproduct_id)
    {
        // alert(bsproduct_id)
        var sn = $('#serial_no'+bsproduct_id).val();
        var unit_price = $('#unit_price'+bsproduct_id).val();
        var date = $('#unit_date'+bsproduct_id).val();
        var size = $('#size'+bsproduct_id).val();
        var color = $('#color'+bsproduct_id).val();
        var dim = $('#dimension'+bsproduct_id).val();
        var hs = $('#hs_code'+bsproduct_id).val();
        var qty = $('#qty'+bsproduct_id).val();
        var spec = $('#other_spec'+bsproduct_id).val();

        var item = {id:parseInt(bspro_id),product_id:bsproduct_id,serial_no:sn,unit_price:unit_price,date:date,size:size,color:color,dim:dim,hs:hs,qty:qty,spec:spec};
        var itemcart = localStorage.getItem('itemcart');
            if(!itemcart){
                itemcart = '[]';
                }
        var itemcartobj = JSON.parse(itemcart);
        itemcartobj.push(item);
        var itemobjj = JSON.stringify(itemcartobj);
        $('#grnitem').val(itemobjj);
        localStorage.setItem('itemcart',JSON.stringify(itemcartobj));
         $('#serial_no'+bsproduct_id).val("");
         $('#unit_price'+bsproduct_id).val("");
        
         $('#size'+bsproduct_id).val("");
         $('#color'+bsproduct_id).val("");
         $('#dimension'+bsproduct_id).val("");
         $('#hs_code'+bsproduct_id).val("");
         $('#qty'+bsproduct_id).val("");
         $('#other_spec'+bsproduct_id).val("");
         $('#add_item'+bsproduct_id).modal('hide');
        show_itemcart(bspro_id,bsproduct_id);
    }
    function show_itemcart(bspro_id,bsproduct_id)
    {
        // alert(bsproduct_id);
        var count = 0;
        var htmlitem = "";
        var itemcart = localStorage.getItem('itemcart');
        var itemcartobj = JSON.parse(itemcart);
        $.each(itemcartobj,function(i,v){
            if(v.id == bspro_id)
            {
                
                count = i+1;
            }
            else if(v.id != bspro_id)
            {
                
            }
            if(v.product_id == bsproduct_id)
            {
            htmlitem += `
            
            <tr>
            <td>${count}</td>
            <td>${v.serial_no}</td>
            <td>${v.hs}</td>
            <td>${v.size}</td>
            <td>${v.color}</td>
            <td>${v.dim}</td>
            <td><button type="button" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button></td>
            </tr>
           
            `;
            }
        });
        $('#result_item'+bsproduct_id).html(htmlitem);
    }
    function show_item(bspro_id,bsproduct_id)
    {
        var htmlitem = "";
        var itemcart = localStorage.getItem('itemcart');
        var itemcartobj = JSON.parse(itemcart);
        $.each(itemcartobj,function(i,v){
            if(v.product_id == bsproduct_id)
            {
            htmlitem += `
            
            <tr>
            <td>${i+1}</td>
            <td>${v.serial_no}</td>
            <td>${v.hs}</td>
            <td>${v.size}</td>
            <td>${v.color}</td>
            <td>${v.dim}</td>
            <td><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button></td>
            </tr>
           
            `;
            }
        });
        $('#result_item'+bsproduct_id).html(htmlitem);
    }
</script>
@endsection