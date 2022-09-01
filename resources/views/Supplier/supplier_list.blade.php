@extends('master')
@section('title','Supplier List')
@section('link','Supplier List')
@section('content')

  <!-- Social Address Modal -->
<div class="row">
        <div class="col-12">
          	<div class="card">
              <div class="card-header">
              <div class="row justify-content-between">
              	<label class="">Supplier List<span class="float-right"><button type="button" data-toggle="modal" data-target="#supplier" class="btn btn-primary"><i class="fas fa-plus"></i> Add Supplier</button></span></label>

              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="supplier_table" class="table table-bordered table-striped">
                <thead class="text-center bg-info">
                	<th>#</th>
                	<th>Name</th>
                    <th>Email</th>
                    <th>Website</th>
                  	<th>Phone</th>
                  	<th>Address</th>
                    <th>Action</th>
                    
                </thead>
                <tbody>
                  <?php $i = 1;?>
                  @foreach($suppliers as $supplier)
                  <tr class="text-center">
                  	<td>{{$i++}}</td>
                  	<td>{{$supplier->company_name}}</td>
                    <td>{{$supplier->email}}</td>
                    <td>{{$supplier->website}}</td>
                  	<td>{{$supplier->phone}}</td>
                  	<td>{{$supplier->address}}</td>
                    <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#supplier_details_{{$supplier->id}}" onclick="brand_detail('{{$supplier->id}}')">Details</button>

                    <a href="{{route('supplier_po_list',$supplier->id)}}" type="button" class="btn btn-success btn-sm">Payable</a>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#update_supplier_{{$supplier->id}}">Update</button>

                    <a href="{{route('delete_supplier',$supplier->id)}}" type="button" class="btn btn-danger btn-sm">Delete</a>
  
                </td>
                
                  </tr>
                  <!-- begin -->
                  
                  <!-- end -->
                  <div class="modal fade" id="update_supplier_{{$supplier->id}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-info">
                          <h5 class="modal-title" id="exampleModalLabel">Update Supplier Form</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body text-center">
                        <form action="{{route('update_supplier_info')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$supplier->id}}" name="supplier_id">
                        <div class="row">
                          <div class="col-md-6">
                          

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                                <br>
                              @endif
                            <div class="form-group">
                                <label for="message-text"  class="float-left">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$supplier->company_name}}">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="message-text"  class="float-left">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$supplier->email}}">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="message-text"  class="float-left">Website:</label>
                                <input type="text" class="form-control" id="website" name="website" value="{{$supplier->email}}">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <!-- <div class="form-group" id="multiple_brand">
                              <label for="message-text" style="margin-right: 500px;">Brand:</label>
                              <div class="select2-purple">
                                <select class="" id="select2" multiple="multiple"  name="brands[]" data-placeholder="Select Brands"  style="width: 100%;margin-top:70px">
                                <option>Choose Brand</option>
                                  @foreach($brands as $brand)
                                  <option value="{{$brand->id}}">{{$brand->name}}</option>
                                  @endforeach
                                </select>
                              </div>

                            </div> -->
                            <!-- <div class="form-group" id="multiple_brand">
                              <label for="message-text" style="margin-right: 500px;">Social:</label>
                              <div class="select2-red">
                                <select class="" id="select3" multiple="multiple"  name="social[]" data-placeholder="Select Social Type"  style="width: 100%;margin-top:70px" onchange="social_addr()">
                                <option>Choose Social Type</option>
                                  @foreach($social as $socials)
                                  <option value="{{$socials->id}}">{{$socials->social_name}}</option>
                                  @endforeach
                                </select>
                              </div>

                            </div> -->
                            <div class="form-group">
                                <label for="message-text"  class="float-left">Department:</label>
                                <input type="text" class="form-control" id="department" name="department" value="{{$supplier->department}}">
                                <span class="text-danger">{{ $errors->first('department') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="message-text"  class="float-left">Address:</label>
                                <textarea class="form-control" id="address" name="address">{{$supplier->address}}</textarea>
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="message-text"  class="float-left">Rank:</label>
                                <input type="text" class="form-control" id="rank" name="rank" value="{{$supplier->supplier_rank}}">
                                <span class="text-danger">{{ $errors->first('rank') }}</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="message-text"  class="float-left">Country:</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{$supplier->country}}">
                                <span class="text-danger">{{ $errors->first('country') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="message-text"  class="float-left">Sector:</label>
                                <input type="text" class="form-control" id="sector" name="sector" value="{{$supplier->sector}}">
                                <span class="text-danger">{{ $errors->first('secotor') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="message-text"  class="float-left">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{$supplier->phone}}">
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="message-text"  class="float-left">Fax:</label>
                                <input type="text" class="form-control" id="fax" name="fax" value="{{$supplier->fax}}">
                                <span class="text-danger">{{ $errors->first('fax') }}</span>
                            </div>
                            
                            <div class="form-group">
                                <label for="message-text"  class="float-left">Remark:</label>
                                <textarea class="form-control" id="remark" name="remark">{{$supplier->remark}}</textarea>
                                <span class="text-danger">{{ $errors->first('remark') }}</span>
                            </div>
                          
                             

                          
                          


                        </div>
                        <div class="modal-footer">
                        <button type="submit"  class="btn btn-primary float-right" value="Update Supplier">Update</button>
                              </form>
                        </div>
                        </div>
                      </div>
        </div>
      </div>
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
      
  @foreach($suppliers as $supplier)
  <!-- Support Brand Modal -->
  <div class="modal fade" id="supplier_details_{{$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Support Brands/Social Types</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <div class="row">
            <div class="col-md-8">
                <ul class="nav nav-pills m-t-30 m-b-30 container mb-2" style="margin-left:180px;">
                    <li class="nav-item">
                        <a href="#navpills-1{{$supplier->id}}" class="nav-link active" data-toggle="tab" aria-expanded="false" onclick="show_brand('{{$supplier->id}}')">
                        Support Brand
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#navpills-3{{$supplier->id}}" class="nav-link" data-toggle="tab" aria-expanded="false" onclick="show_product('{{$supplier->id}}')">
                        Available Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#navpills-2{{$supplier->id}}" class="nav-link" data-toggle="tab" aria-expanded="false" onclick="show_social('{{$supplier->id}}')">
                        Social Contact
                        </a>

                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content br-n pn">
          <div id="navpills-1{{$supplier->id}}" class="tab-pane active">
            <input type="hidden" id="last_no{{$supplier->id}}" name="last_no[]" value="0">
            <button type="button" id="save" class="btn btn-outline-success btn-sm mb-2 offset-md-10" data-toggle="modal" data-target="#add_brand_each" onclick="inside_id('{{$supplier->id}}')"><i class="fas fa-plus" ></i>Add Brand{{$supplier->id}}</button>
            <table id="supplier_table" class="table table-bordered table-striped">
                <thead class="text-center bg-info">
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                  	<th>SubCategory</th>
                  	<th>Country Orging</th>
                    <th>Action</th>
                </thead>
                <tbody id="result_brand{{$supplier->id}}">

                </tbody></table>
          </div>
          <div id="navpills-2{{$supplier->id}}" class="tab-pane">
              <div class="row bg-info font-weight-bold p-2 offset-md-2 col-md-8">
                  <div class="col-md-2">
                    <span>No</span>
                  </div>
                  <div class="col-md-4">
                    <span>Social Type</span>
                  </div>
                  <div class="col-md-5">
                    <span class="text-center">Social Address</span>
                  </div>
              </div>
              <div id="result_social{{$supplier->id}}"></div>
          </div>
          <div id="navpills-3{{$supplier->id}}" class="tab-pane">
                <!-- Table -->
                <button type="button" class="btn btn-outline-success btn-sm mb-2 offset-md-10" data-toggle="modal" data-target="#add_product_each{{$supplier->id}}"><i class="fas fa-plus" ></i>Add Product{{$supplier->id}}</button>

                <table id="supplier_table" class="table table-bordered table-striped">
                <thead class="text-center bg-info">
                	<th>#</th>
                	<th>Name</th>
                    <th>Purchase Price</th>
                  	<th>Discount</th>
                  	<th>Credit Term</th>
                    <th>Lead Time</th>
                    <th>Action</th>
                </thead>
                <tbody id="result_product{{$supplier->id}}">

                </tbody></table>
                <!-- end table -->
          </div>
        </div>

                <!-- <div id="result{{$supplier->id}}"></div> -->
        
                          
    </div>
  </div>
  </div>
  </div>
 
@endforeach
 <!-- Begin brand each-->
 <div class="modal fade addbe" id="add_brand_each" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="sup_ID">
      
            <div class="form-group">
              <label for="message-text" style="margin-right: 500px;">Brand:</label>
              <div class="select2-blue">
                <select class="" id="select4" multiple="multiple"  name="addbrands[]" data-placeholder="Select Brands"  style="width: 100%;margin-top:70px">
                
                <option>Choose Brand</option>
                  @foreach($brands as $brand)
                  <option value="{{$brand->id}}">{{$brand->name}}</option>
                  @endforeach
              
                </select>
              </div>

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="add_new_brand_ajax()">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- end brand each -->
@foreach($suppliers as $sup)
<!-- Begin Product each-->
<div class="modal fade addbe" id="add_product_each{{$sup->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" id="sup_ID">
              <div class="form-group">
              <label>Department</label>
              <select class="form-control" name="department_id" id="department_id{{$sup->id}}" required>
              <option selected="selected">Select Department</option>
                <option value="1">Department One</option>
                </select>
              </div>
              <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="category_id" id="category{{$sup->id}}" onchange="get_subcate(this.value,'{{$sup->id}}')" required>
                <option selected="selected">Select Category</option>
                  @foreach ($category as $cate)
                  <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
            <label>Sub Category</label>
            <select class="form-control" name="subcategory_id" id="subcategory{{$sup->id}}">
              <option selected="selected">Select SubCategory</option>
                
            </select>
          </div>
          <div class="form-group">
            <label>Brand</label>
            <select class="form-control" name="brand_id" id="brand{{$sup->id}}">
              <option selected="selected">Select Brand</option>
              @foreach($brands as $bd)
                        <option value="{{$bd->id}}">{{$bd->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name{{$sup->id}}" name="name" placeholder="Enter Your Product Name" >
          </div>
          <div class="form-group">
            <label for="name">Part Number</label>
            <input type="text" class="form-control" id="part{{$sup->id}}" name="part" placeholder="Enter Your Product Name" >
          </div>
          <div class="form-group">
            <label for="name">Mearsuring Unit</label>
            <input type="text" class="form-control" id="measuring_unit{{$sup->id}}" name="measuring_unit" placeholder="Enter Unit Name" >
            </div>
          
          <div class="form-group">
            <label>Register Date:</label>

            <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
              <i class="far fa-calendar-alt"></i>
              </span>
            </div>
            <input type="date" id="reg_date{{$sup->id}}" name="reg_date" class="form-control float-right" >
            </div>
          </div>
          </div><!-- row first div col-6 end -->
            <div class="col-md-6">
            <div class="row mt-5">
            <div class="col-md-4 offset-md-2">
            <div class="form-check form-check-inline col-md-4" id="">
              <input class="form-check-input" type="radio" name="exist_asset" id="rad{{$sup->id}}" value="1" >
              <label class="form-check-label text-success" for="sell">Instock</label>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-check form-check-inline col-md-4" id="">
              <input class="form-check-input" type="radio" name="exist_asset" id="rad{{$sup->id}}" value="2" >
              <label class="form-check-label text-success" for="end">Reorder</label>
            </div>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Moq Price</label>
            <input type="text" class="form-control" id="moq_price{{$sup->id}}" name="moq_price" placeholder="100000" >
			    </div>
        
            <div class="form-group">
              <label for="name">Minimum Order Quantity</label>
              <input type="text" class="form-control" id="minimum_order_qty{{$sup->id}}" name="minimum_order_qty" placeholder="1" >
            </div>
            <div class="form-group">
              <label for="name">In-Stock Qty</label>
              <input type="number" class="form-control" id="stock_qty{{$sup->id}}" name="stock_qty" placeholder="Enter Stock Quantity" >
            </div>
            <div class="form-group">
              <label for="name">Reorder Quantity</label>
              <input type="text" class="form-control" id="reorder_qty{{$sup->id}}" name="reorder_qty" placeholder="1" >
            </div>
            <div class="form-group ml-5" style="margin-top:100px;">
              <label for="name"><span class="text-info font-weight-bold">{{$sup->company_name}}'s</span> Detail Informations</label>
              <button class="btn btn-warning ml-3"  data-toggle="modal" data-target="#pro_info_{{$sup->id}}">Detail</button>
            </div>
          </div><!-- row second div col-6 end -->
        </div><!-- row end-->
      </div><!-- end modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="add_new_product_ajax('{{$sup->id}}')">Save</button>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- end Product each -->
<!-- secondary supplier's product info modal -->
@foreach($suppliers as $sup)
<div class="modal fade bd-example-modal-lg" id="pro_info_{{$sup->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		<div class="modal-header bg-info text-white">
			<h5>Primary Supplier ({{$sup->company_name}}) Product Detail Comparison Dialog</h5>
		</div>
		<div class="modal-body">
			<div class="row offset-md-1">
				<div class="col-md-8">
					<div class="form-group" id="pri_supplierspace">
						<label class="text-info">Choose To Adding</label>
						
						<select class="form-control" name="add_type" id="add_type{{$sup->id}}">
						<option value="0">Select Adding Type</option>
						
						<option value="1">Discount</option>
						
						<option value="3">Lead Time</option>
						<option value="2">Credit</option>
						</select>
						
					</div>
				</div>
				<div class="col-md-4" style="margin-top:32px;">
					<button type="button" class="btn btn-warning text-white" onclick="add_supplier_type('{{$sup->id}}')">Add</button>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-7">
					<div class="form-group">
						<label for="name">Unit Purchase Price</label>
						<input type="text" class="form-control" id="unit_pur_price{{$sup->id}}" name="unit_pur_price" placeholder="1000" >
					</div>
					<div class="form-group" id="incoterm_type">
						<label>Incoterm Type</label>
						
						<select class="form-control" name="incoterm" id="incoterm{{$sup->id}}" >
						<option value="0">Select Incoterm Type</option>
						@foreach($incoterm as $inc)
						<option value="{{$inc->id}}">{{$inc->incoterm_name}}</option>
						@endforeach
						</select>
						
						
					</div>
					<div class="form-group">
						<label for="name">MOQ Qty</label>
						<input type="number" class="form-control" id="moq_qty{{$sup->id}}" name="moq_qty" >
					</div>
					<div class="form-group">
						<label for="name">Initial Purchase Amount</label>
						<input type="number" class="form-control" id="initial_pur_amt{{$sup->id}}" name="initial_pur_amt" >
					</div>
					<span id="add_type_one{{$sup->id}}"></span>
				</div><!-- first col end in row -->
				<div class="col-md-5">
					<div class="form-group">
						<label for="name">Currency Type</label>
						<select style="margin-top:5px" class="form-control" name="currency" id="currency{{$sup->id}}" data-placeholder="Select Primary Supplier" >
						<option value="0">Select Currency Type</option>
						<option value="1">MMK</option>
						<option value="2">USD</option>
						</select>
					</div>
					
					
					<div class="form-group">
						<label for="name">Last Purchase Date</label>
						<input type="date" class="form-control" id="last_pur_date{{$sup->id}}" name="last_pur_date" >
					</div>
					
					<div class="form-group">
						<label for="name">MOQ Price</label>
						<input type="number" class="form-control" id="moq_price{{$sup->id}}" name="moq_price" >
					</div>
					<div class="form-group">
						<label for="name">Initial Purchase Qty</label>
						<input type="number" class="form-control" id="initial_pur_qty{{$sup->id}}" name="initial_pur_qty" >
					</div>
					<span id="add_type_two{{$sup->id}}"></span>
				</div><!-- second col end in row -->
			</div>
		</div>
		<div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="hide_modal('{{$sup->id}}')">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      	</div>
    </div>
  </div>
</div>
@endforeach
<div class="modal fade bd-example-modal-lg" id="product_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered prohide">
    <div class="modal-content">
      <div class="modal-header">
          <h5>Product Detail Info For <span id="detail_header"></span></h5>
      </div>
       <div class="modal-body">
          <table id="supplier_table" class="table table-bordered table-striped">
              <thead class="text-center bg-info">
                <th>#</th>
                <th>Total Purchase Amount</th>
                  <th>Total Purchase Qty</th>
                  <th>Incoterm</th>
                  <th>last Purchase Date</th>
                  <th>MOQ Price</th>
                  <th>MOQ Qty</th>
              </thead>
              <tbody id="detail_pro">

              </tbody>
          </table>
       </div>
    </div>
  </div>
</div>
<!-- end product detail -->
<!--Add Supplier Modal -->
<div class="modal fade" id="supplier" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="exampleModalLabel">Supplier Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">



        <form action="{{route('ajaxSupplier')}}" method="post">
          @csrf
          <input type="hidden" id="social_obj" name="social_obj">
          <input type="hidden" id="brands" name="brands">
        <div class="row">
          <div class="col-md-6">
        	

        		@if ($message = Session::get('success'))
	               <div class="alert alert-success alert-block">
	                  <button type="button" class="close" data-dismiss="alert">×</button>
	                  <strong>{{ $message }}</strong>
	               </div>
	               <br>
               @endif
		        <div class="form-group">
		            <label for="message-text"  class="float-left">Name:</label>
		            <input type="text" class="form-control" id="name" name="name">
		            <span class="text-danger">{{ $errors->first('name') }}</span>
		        </div>
		        <div class="form-group">
		            <label for="message-text"  class="float-left">Email:</label>
		            <input type="email" class="form-control" id="email" name="email">
		            <span class="text-danger">{{ $errors->first('email') }}</span>
		        </div>
            <div class="form-group">
                <label for="message-text"  class="float-left">Website:</label>
                <input type="text" class="form-control" id="website" name="website">
                <span class="text-danger">{{ $errors->first('website') }}</span>
            </div>
            <div class="form-group" id="multiple_brand">
              <label for="message-text" style="margin-right: 500px;">Brand:</label>
              <div class="select2-purple">
                <select class="" id="select2" multiple="multiple"  name="brands[]" data-placeholder="Select Brands"  style="width: 100%;margin-top:70px">
                <option>Choose Brand</option>
                  @foreach($brands as $brand)
                  <option value="{{$brand->id}}">{{$brand->name}}</option>
                  @endforeach
                </select>
               </div>

            </div>
            <div class="form-group" id="multiple_brand">
              <label for="message-text" style="margin-right: 500px;">Social:</label>
              <div class="select2-red">
                <select class="" id="select3" multiple="multiple"  name="social[]" data-placeholder="Select Social Type"  style="width: 100%;margin-top:70px" onchange="social_addr()">
                <option>Choose Social Type</option>
                  @foreach($social as $socials)
                  <option value="{{$socials->id}}">{{$socials->social_name}}</option>
                  @endforeach
                </select>
               </div>

            </div>
            <div class="form-group">
 		            <label for="message-text"  class="float-left">Department:</label>
                 <input type="text" class="form-control" id="department" name="department">
		            <span class="text-danger">{{ $errors->first('department') }}</span>
		        </div>
		        <div class="form-group">
 		            <label for="message-text"  class="float-left">Address:</label>
		            <textarea class="form-control" id="address" name="address"></textarea>
		            <span class="text-danger">{{ $errors->first('address') }}</span>
		        </div>
          </div>
          <div class="col-md-6">
            
            <div class="form-group">
 		            <label for="message-text"  class="float-left">Country:</label>
                 <input type="text" class="form-control" id="country" name="country">
		            <span class="text-danger">{{ $errors->first('country') }}</span>
		        </div>
            <div class="form-group">
 		            <label for="message-text"  class="float-left">Sector:</label>
                 <input type="text" class="form-control" id="sector" name="sector">
		            <span class="text-danger">{{ $errors->first('secotor') }}</span>
		        </div>
		        <div class="form-group">
		            <label for="message-text"  class="float-left">Phone:</label>
		            <input type="text" class="form-control" id="phone" name="phone">
		            <span class="text-danger">{{ $errors->first('phone') }}</span>
		        </div>

            <div class="form-group">
 		            <label for="message-text"  class="float-left">Fax:</label>
                 <input type="text" class="form-control" id="fax" name="fax">
		            <span class="text-danger">{{ $errors->first('fax') }}</span>
		        </div>
            <div class="form-group">
 		            <label for="message-text"  class="float-left">Rank:</label>
                 <input type="text" class="form-control" id="rank" name="rank">
		            <span class="text-danger">{{ $errors->first('rank') }}</span>
		        </div>
            <div class="form-group">
 		            <label for="message-text"  class="float-left">Remark:</label>
		            <textarea class="form-control" id="remark" name="remark"></textarea>
		            <span class="text-danger">{{ $errors->first('remark') }}</span>
		        </div>
        </div>
        </div>



      </div>
      <div class="modal-footer">
      <input type="submit" name="btnsubmit" class="btn btn-primary float-right btn-submit" value="Create Supplier">
      </form>
      </div>
    </div>
  </div>
  @foreach($social as $socials)
  <div class="modal fade socialAddress" id="socialaddr{{$socials->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fill Social Address For &nbsp;<span id="addname" class="text-success"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <div class="form-group">
            <label for="message-text"  class="float-left">Social Address(Link)</label>
            <textarea class="form-control" id="link{{$socials->id}}" name="link"></textarea>
            <span class="text-danger">{{ $errors->first('link') }}</span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="store_link('{{$socials->id}}')">Save</button>
      </div>

    </div>
  </div>
</div>
@endforeach
  <!-- End Social Address Modal -->
 
  <!-- End Support Brand Modal -->

<!-- page script -->
<!-- jQuery -->
<!-- <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}"> -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script> 
<script type="text/javascript">
	// $('.select2').select2();
// $(document).ready(function(){
  

// })

  $('#select2').select2({
        dropdownParent: $('#supplier'),
        
    });
    $('#select3').select2({
        dropdownParent: $('#supplier'),
        
    });
      $('#select4').select2({
     
     dropdownParent: $('#add_brand_each'),
     allowClear: true
      });
    
   function inside_id(value)
   {
  
     $('#sup_ID').val(value);
   }
    
    // $(document).ready(function(){
    //   var sup = @json($suppliers);
    //   console.log(sup);
    //   $.each(sup,function(i,v){
    //     //  $('#select4').select2();
    //   });
      
      
    // });
    
    // $('.select4').select2();
    $('#supplier_table').DataTable( {

"paging":   true,
"ordering": true,
"info":     true

});
// $('.select4').on('select2:select', function (e) {
//     var data = e.params.data;
//     console.log(data);
// });



  //   $('document').ready(function()
  //   {

  //       $('#multiple')
  //   })

// $(".btn-submit").click(function(e){

// e.preventDefault();
// var categories = [];
// var name = $("input[name=name]").val();

// var brands = $("select[name='brands[]']").val();
// var socials = $("select[name='social[]']").val();
// var address = $("textarea[name=address]").val();
// var email = $("input[name=email]").val();
// var phone = $("input[name=phone]").val();
// var department = $("input[name=department]").val();
// var sector = $("input[name=sector]").val();
// var rank = $("input[name=rank]").val();
// var remark = $("textarea[name=remark]").val();
// var fax = $("input[name=fax]").val();
// var country = $("input[name=country]").val();
// var socialObj = $('#social_obj').val();
// $.ajax({

//    type:'POST',

//    url:'/ajaxSupplier',

//    data:{
//        "_token":"{{csrf_token()}}",
//        "name":name,
//        "phone":phone,
//        "address":address,
//       "brands":brands,
//       "email":email,
//       "fax":fax,
//       "department":department,
//       "rank":rank,
//       "remark":remark,
//       "country":country,
//       "sector":sector,
//       "socialObj":socialObj
//    },

//    success:function(data){
//         //   localStorage.clear();
//         //    swal({

//         //      title:"Success!",
//         //      text:"You Have Successfully Added Supplier",
//         //      icon:"success",
//         //  })

//         //  setTimeout(function(){
//         //      window.location.reload();
//         //  },1000);

//    }

// });
// });

function brand_detail(supplier_id)
{
$.ajax({

    type:'POST',

    url:'/ajaxBrand_detail',

    data:{
      "_token":"{{csrf_token()}}",
      "supplier_id":supplier_id,

    },

    success:function(data){
      var htmlbrands = "";
      var i=0;j=1;
      var arr_no = [];
      for(i=0,j=1;i<=data.brand_name.length,j<=data.brand_name.length;i++,j++)
      {
        htmlbrands += `
        <tr>
            <td class="text-center" id="bno${j}">${j}</td>
            <td class="text-center" id="bname${j}">${data.brand_name[i].name}</td>
            <td class="text-center" id="bcat${j}">${data.category[i]}</td>
            <td class="text-center" id="bsub${j}">${data.sub_category[i]}</td>
            <td class="text-center" id="bco${j}">${data.countryof[i]}</td>
            <td class="text-center" id="bbtn${j}"><button class="btn btn-outline-danger btn-sm" onclick="delete_brand('${supplier_id}','${j}','${data.brand_name[i].id}')">Delete</button></td>
            </tr>
        `;
        arr_no.push(j);
      }
      $('#last_no'+supplier_id).val(arr_no);
      $('#result_brand'+supplier_id).html(htmlbrands);

    }
});
}
var dif =0;
function social_addr()
{
  // var social_name = $('#select3').text();
  // var social_name = $('#select3').find('option:selected').text();
  var social_id = $('#select3').val();
	// alert(supplier_id.length);
	for(var i=dif;i<social_id.length;i++)
	{
		// alert(supplier_id[i]);
		$('#socialaddr'+social_id[i]).modal('show');
	}
	dif++;
  // var html ="";
  // html +=`${social_name}`;
  // $('#addname').html(html);
  // $('#socialaddr').modal('show');
}
var count = 0;
function store_link(social_id)
{
  // var social_type_id = $('#select3').val();
  
  // alert(parseInt(social_type_id));
  var link = $('#link'+social_id).val();
  var social = {id:parseInt(social_id),social_address:link,};
  var socialcart = localStorage.getItem('socialcart');
    if(!socialcart){
          socialcart = '[]';
        }
  var socialcartobj = JSON.parse(socialcart);
  var hasid = false;
  
      $.each(socialcartobj,function(i,v){
          // v.total_amount = total_amount;
      
          if(v.id == social_id)
          {
          hasid = true;
          
          }
      })
      if(!hasid){
          socialcartobj.push(social);
      }
      localStorage.setItem('socialcart',JSON.stringify(socialcartobj));
      var socialcart = localStorage.getItem('socialcart');
      var socialcartobj = JSON.parse(socialcart);
      $('#link').val("");
      $('.socialAddress').modal('hide');
      var socialobjj = JSON.stringify(socialcartobj);
      $('#social_obj').val(socialobjj);

}
function show_social(value)
{
  $.ajax({

      type:'POST',

      url:'/ajaxSocial',

      data:{
        "_token":"{{csrf_token()}}",
        "supplier_id":value,

      },

      success:function(data){
        var htmlsocial = "";
        var i=0;
        for(var i=0,j=1;i<=data.social_type_name.length,j<=data.social_type_name.length;i++,j++)
        {
        htmlsocial +=`
        <div class="row font-weight-bold p-2 offset-md-2 col-md-8">
                  <div class="col-md-2">
                    <span>${j}</span>
                  </div>
                  <div class="col-md-4">
                    <span class="text-success">${data.social_type_name[i]}</span>
                  </div>
                  <div class="col-md-5">
                    <span class="text-center">${data.social_address[i]}</span>
                  </div>
                  <hr>
              </div>
          
        `;
        }
        $('#result_social'+value).html(htmlsocial);
      }
    });
}
function show_product(value)
{
  // alert("product");
        $.ajax({

      type:'POST',

      url:'/ajaxProduct_Comparison',

      data:{
        "_token":"{{csrf_token()}}",
        "supplier_id":value,

      },

      success:function(data){
          var htmlproduct = "";
          var i=0;j=1;
          for(var i=0,j=1;i<=data.length,j<=data.length;i++,j++)
        {
           if(data[i].discount_value == null)
           {
            var dis_value = "NA";
           }
           else
           {
            var dis_value = data[i].discount_value;
           }
           if(data[i].credit_term_value == null)
           {
            var credit_value = "NA";
           }
           else
           {
            var credit_value = data[i].credit_term_value;
           }
           if(data[i].delivery_lead_time == null)
           {
            var time = "NA";
           }
           else
           {
            var time = data[i].delivery_lead_time;
           }
           if(data[i].unit_purchase_price == null)
           {
                var upp = "NA";
           }
           else
           {
                var upp = data[i].unit_purchase_price;
           }
        htmlproduct +=`
          <tr>
          <td class="text-center">${j}</td>
          <td class="text-center">${data[i].product.name}</td>
          <td class="text-center">${upp}</td>
          <td class="text-center">${dis_value}/${data[i].discount_type}</td>
          <td class="text-center">${credit_value}/${data[i].credit_term_type}</td>
          <td class="text-center">${time}/${data[i].lead_time_type}</td>
          <td class="text-center"><button class="btn btn-success btn-sm" onclick="detail_product('${data[i].id}')">Detail</button>
          <button class="btn btn-danger btn-sm" onclick="detail_product('${data[i].id}')">Delete</button>
          </td>
          </tr>
        `;
        }
        $('#result_product'+value).html(htmlproduct);
      }
    })
}
function detail_product(id)
{
  $('#product_detail').modal('show');
  $.ajax({

    type:'POST',

    url:'/ajaxComparison_detail',

    data:{
      "_token":"{{csrf_token()}}",
      "supcom_id":id,

    },

    success:function(data){
      var htmlheader = "";
      
      var htmldetail = "";
          var i=0;j=1;
          for(var i=0,j=1;i<=data.length,j<=data.length;i++,j++)
        {
          // htmlheader +=`
          // ${data[i].product.name}
          // `;
          htmldetail+=`
          <tr>
          <td>${j}</td>
          <td>${data[i].total_purchase_amount}</td>
          <td>${data[i].total_purchase_qty}</td>
          <td>${data[i].incoterm.incoterm_name}</td>
          <td>${data[i].last_purchase_date}</td>
          <td>${data[i].moq_price}</td>
          <td>${data[i].moq_qty}</td>
          </tr>
          `;
        }
        $('#detail_header').html(htmlheader);
        $('#detail_pro').html(htmldetail);
    }
  })
}
function show_brand(supplier_id)
{
  $.ajax({

type:'POST',

url:'/ajaxBrand_detail',

data:{
  "_token":"{{csrf_token()}}",
  "supplier_id":supplier_id,

},

success:function(data){
  var htmlbrands = "";
  var i=0;j=1;


  for(i=0,j=1;i<=data.brand_name.length,j<=data.brand_name.length;i++,j++)
  {
    htmlbrands += `
            <tr>
            <td>${j}</td>
            <td>${data.brand_name[i]}</td>
            <td>${data.category[i]}</td>
            <td>${data.sub_category[i]}</td>
            <td>${data.countryof[i]}</td>
            <td><button class="btn btn-danger btn-sm">Delete</button></td>
            </tr>
                
         
    `;
  }

  $('#result'+supplier_id).html(htmlbrands);

}
});
}

var count = 0;
function add_new_brand_ajax()
{
  var addbrand = $('#select4').val();
  var sup = $('#sup_ID').val();
  
  // alert(addbrand);
  $.ajax({

    type:'POST',

    url:'/ajax_add_brand',

    data:{
      "_token":"{{csrf_token()}}",
      "brands":addbrand,
      "supplier_id":sup,

    },

    success:function(data){
      var arr_no = [];
      var no = $('#last_no'+sup).val();
      
      var noArray = no.split(',');
      alert(noArray+"-----"+noArray.length);
      // if(noArray.length != 1)
      // {
      //   alert("no");
      //   var lastNo = 1; 

      // }
      // else if(noArray.length > 0)
      // {
      //   alert("yes");
      //   var lastNo = JSON.parse(noArray[noArray.length - 1]);

      // }
      // alert(last);
      var brands = @json($brands);
      // alert("sss");
      
     var html = "";
    var htmlbrand = "";
     $.each(data.all_brand,function(i,v){
      html +=`
     
     <option value="${v.id}">${v.name}</option>
     
     `;
     })
    var i=0;j=1;
     for(i=0,j=1;i<=data.brand.length,j<=data.brand.length;i++,j++)
     {
      //  alert(data.brand[i].name+data.countryof[i]);
      
      
        htmlbrand +=`
        <tr>
        <td class="text-center">${j}</td>
        <td class="text-center">${data.brand[i].name}</td>
        <td class="text-center">${data.category[i]}</td>
        <td class="text-center">${data.sub_category[i]}</td>
        <td class="text-center">${data.countryof[i]}</td>
        <td class="text-center"><button class="btn btn-danger btn-sm" onclick="delete_brand('${sup}','${j}','${data.brand[i].id}')">Delete</button></td>
        </tr>
        `;
        // alert(j);
        arr_no.push(j);
    }
    alert("error = "+arr_no);
      $('#last_no'+sup).val(arr_no);
      $('#result_brand'+sup).html(htmlbrand);
      $('#select4').html(html);
    }
    
  });
  count ++;
}
function delete_brand(supid,no,bid)
{
  // alert(bid);
  
  // document.getElementById( "bno"+no).remove();
  // document.getElementById( "bname"+no).remove();
  // document.getElementById( "bcat"+no).remove();
  // document.getElementById( "bsub"+no).remove();
  // document.getElementById( "bco"+no).remove();
  // document.getElementById( "bbtn"+no).remove();
  $.ajax({

type:'POST',

url:'/ajax_delete_brand',

data:{
  "_token":"{{csrf_token()}}",
  "brand_id":bid,
  "supplier_id":supid,

},

  success:function(data){
    var htmlbrands = "";
      var i=0;j=1;
      var arr_no = [];
      for(i=0,j=1;i<=data.brand_name.length,j<=data.brand_name.length;i++,j++)
      {
        htmlbrands += `
        <tr>
            <td class="text-center" id="bno${j}">${j}</td>
            <td class="text-center" id="bname${j}">${data.brand_name[i].name}</td>
            <td class="text-center" id="bcat${j}">${data.category[i]}</td>
            <td class="text-center" id="bsub${j}">${data.sub_category[i]}</td>
            <td class="text-center" id="bco${j}">${data.countryof[i]}</td>
            <td class="text-center" id="bbtn${j}"><button class="btn btn-outline-danger btn-sm" onclick="delete_brand('${supid}','${j}','${data.brand_name[i].id}')">Delete</button></td>
            </tr>
        `;
        // alert(j);
        arr_no.push(j);
      }
      
      $('#last_no'+supid).val(arr_no);
      $('#result_brand'+supid).html(htmlbrands);
  }
  });
}
function get_subcate(cateid,supID)
{
  $.ajax({

    type:'POST',

    url:'/get_subcate_ajax',

    data:{
      "_token":"{{csrf_token()}}",
      "cate_id":cateid,

    },

      success:function(data){
        var htmlsub = "";
        // htmlsub +=`<option selected>Select SubCategory</option>`;

        $.each(data,function(i,v){
          htmlsub +=`<option value="${v.id}">${v.name}</option>`;
        })
        $('#subcategory'+supID).html(htmlsub);
      }
    })
}
function add_new_product_ajax(supid)
{
  // alert(dep);
   var dep = $('#department_id'+supid).val();
   var cate = $('#category'+supid).val();
   var sub = $('#subcategory'+supid).val();
   var brand = $('#brand'+supid).val();
   var name = $('#name'+supid).val();
   var part = $('#part'+supid).val();
   var unit = $('#measuring_unit'+supid).val();
   var reg_date = $('#reg_date'+supid).val();
   var radio = $('#rad'+supid).val();
   var moq_price = $('#moq_price'+supid).val();
   var min_order_qty = $('#minimum_order_qty'+supid).val();
   var instock = $('#stock_qty'+supid).val();
   var reorder = $('#reorder_qty'+supid).val();
   var unit_pur_price = $('#unit_pur_price'+supid).val();
   var inco = $('#incoterm'+supid).val();
   var moq_qty = $('#moq_qty'+supid).val();
   var in_pur_amt = $('#initial_pur_amt'+supid).val();
   var curr = $('#currency'+supid).val();
   var last_date = $('#last_pur_date'+supid).val();
   var moq_price = $('#moq_price'+supid).val();
   var in_pur_qty = $('#initial_pur_qty'+supid).val();
   var dis_amt = $('#dis_amt'+supid).val();
   var dis_cond = $('#dis_cond'+supid).val();
   var dis_type = $('#dis_type'+supid).val();
   var dis_con_type = $('#dis_con_type'+supid).val();
   var credit_term = $('#credit_term'+supid).val();
   var credit_term_type = $('#credit_term_type'+supid).val();
   var credit_con_type = $('#credit_con_type'+supid).val();
   var deli_time = $('#deli_lead'+supid).val();
   var time_type = $('#lead_type'+supid).val();
   var credit_con = $('#credit_con'+supid).val();
   var credit_amt = $('#credit_amt'+supid).val();
   $.ajax({

    type:'POST',

    url:'/store_add_product_ajax',

    data:{
      "_token":"{{csrf_token()}}",
      "supplier_id":supid,
      "dep":dep,
      "cate":cate,
      "sub":sub,
      "brand":brand,
      "name":name,
      "part":part,
      "unit":unit,
      "reg_date":reg_date,
      "radio":radio,
      "moq_price":moq_price,
      "min_order_qty":min_order_qty,
      "instock":instock,
      "reorder":reorder,
      "unit_pur_price" : unit_pur_price,
      "inco" : inco,
      "moq_qty":moq_qty,
      "in_pur_amt":in_pur_amt,
      "curr":curr,
      "last_date":last_date,
      "moq_price":moq_price,
      "in_pur_qty":in_pur_qty,
      "dis_amt":dis_amt,
      "dis_cond":dis_cond,
      "dis_type":dis_type,
      "dis_con_type":dis_con_type,
      "credit_term":credit_term,
      "credit_term_type":credit_term_type,
      "credit_con_type":credit_con_type,
      "deli_time":deli_time,
      "time_type":time_type,
      "credit_con":credit_con,
      "credit_amt":credit_amt
    },

      success:function(data){
          var htmlpro = "";
          $.each(data,function(i,v){
            if(v.discount_value == null)
           {
            var dis_value = "NA";
           }
           else
           {
            var dis_value = v.discount_value;
           }
           if(v.credit_term_value == null)
           {
            var credit_value = "NA";
           }
           else
           {
            var credit_value = v.credit_term_value;
           }
           if(v.delivery_lead_time == null)
           {
            var time = "NA";
           }
           else
           {
            var time = v.delivery_lead_time;
           }
           if(v.unit_purchase_price == null)
           {
             var upp = "NA";
           }
           else
           {
             var upp = v.unit_purchase_price;
           }
            htmlpro +=`
            <tr>
          <td>${i+1}</td>
          <td>${v.product.name}</td>
          <td>${upp}</td>
          <td>${dis_value}/${v.discount_type}</td>
          <td>${credit_value}/${v.credit_term_type}</td>
          <td>${time}/${v.lead_time_type}</td>
          <td><button class="btn btn-success btn-sm" onclick="detail_product('${v.id}')">Detail</button>
          <button class="btn btn-danger btn-sm" onclick="detail_product('${v.id}')">Delete</button>
          </td>
          </tr>`;
          })
          $('#result_product'+supid).html(htmlpro);
          $('#add_product_each'+supid).modal('hide');
      }
    });
}
function add_supplier_type(supplier_id)
{
	// alert("hello");
	// count ++;
	var value = $('#add_type'+supplier_id).val();
	// alert(value);
	var htmlone = "",htmltwo = "",
	htmlthree = "";
	if(value == 1)
	{
		htmlone +=`
		<div class="form-group">
			<label for="name">Discount Amount</label>
			<input type="number" class="form-control" id="dis_amt${supplier_id}" name="dis_amt" placeholder="1000">
		</div>
		<div class="form-group">
			<label for="name">Discount Condition</label>
			<input type="text" class="form-control" id="dis_cond${supplier_id}" name="dis_cond">
		</div>
		`;
		
		htmltwo +=`
		<div class="form-group">
			<label>Discount Type</label>
			
			<select class="form-control" name="dis_type" id="dis_type${supplier_id}" style="margin-top:4px" >
			<option value="0">Select Discount Type</option>
			<option value="1">No Discount</option>
			<option value="2">Percentage%</option>
			<option value="3">Amount</option>
			<option value="4">FOC</option>
			<option value="5">Delivery Fees</option>
			</select>
			
			
		</div>
		<div class="form-group">
			<label style="margin-top:5px">Discount Condition Type</label>
			
			<select class="form-control" name="dis_con_type" id="dis_con_type${supplier_id}" style="margin-top:2px" >
			<option value="0">Select Discount Condition Type</option>
			<option value="1">Purchase Qty</option>
			<option value="2">Purchase Amount</option>
			<option value="3">Purchase Time</option>
			</select>
			
		</div>
		`;
		$('#add_type_one'+supplier_id).append(htmlone);
		$('#add_type_two'+supplier_id).append(htmltwo);
		$('#add_type option[value=1]').attr("disabled","disabled");
		$('#add_type option[value=0]').attr("selected","selected");
	}
	else if(value == 2)
	{
		htmlone +=`
		<div class="form-group">
			<label for="name">Credit Term</label>
			<input type="text" class="form-control" id="credit_term${supplier_id}" name="credit_term">
		</div>
		<div class="form-group">
			<label for="name">Credit Condition</label>
			<input type="text" class="form-control" id="credit_con${supplier_id}" name="credit_con">
		</div>
		<div class="form-group">
			<label for="name">Credit Amount</label>
			<input type="number" class="form-control" id="credit_amt${supplier_id}" name="credit_amt">
		</div>
		`;
		htmltwo +=`
		<div class="form-group">
			<label style="margin-top:5px">Credit Term Type</label>
			
			<select class="form-control" name="credit_term_type" id="credit_term_type${supplier_id}" style="margin-top:2px" >
			<option value="0">Select Credit Term Type</option>
			<option value="1">No Credit</option>
			<option value="2">Day</option>
			<option value="3">Week</option>
			<option value="4">Month</option>
			</select>
			
		</div>
		<div class="form-group">
			<label style="margin-top:5px">Credit Condition Type</label>
			
			<select class="form-control" name="credit_con_type" id="credit_con_type${supplier_id}" style="margin-top:2px" >
			<option value="0">Select Credit Condition Type</option>
			<option value="1">Purchase Qty</option>
			<option value="2">Purchase Amount</option>
			<option value="3">Purchase Time</option>
			</select>
			
		</div>


		`;
		$('#add_type_one'+supplier_id).append(htmlone);
		$('#add_type_two'+supplier_id).append(htmltwo);
		$('#add_type option[value=2]').attr("disabled","disabled");
		$('#add_type option[value=0]').attr("selected","selected");
	}
	else if(value == 3)
	{
		htmlone +=`
		<div class="form-group">
			<label for="name">Delivery Lead Time</label>
			<input type="number" class="form-control" id="deli_lead${supplier_id}" name="deli_lead">
		</div>

		`;
		htmltwo +=`
		<div class="form-group">
			<label style="margin-top:5px" >Lead Time Type</label>
			
			<select class="form-control" name="lead_type" id="lead_type${supplier_id}" style="" >
			<option value="0">Select Discount Type</option>
			
			<option value="1">Day</option>
			<option value="2">Week</option>
			<option value="3">Month</option>
			
			</select>
			
		</div>
		`;
		$('#add_type_one'+supplier_id).append(htmlone);
		$('#add_type_two'+supplier_id).append(htmltwo);
		$('#add_type option[value=3]').attr("disabled","disabled");
		$('#add_type option[value=0]').attr("selected","selected");
	}
	// alert(count);
}
// $(document).ready(function(){
//   $('.prohide').modal('hide');
// })
function hide_modal(value)
{
  // alert(value);
  $('#pro_info_'+value).modal('hide');
}
</script>


@endsection





