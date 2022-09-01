@extends('master')

@section('title','Brand list')
@section('link','Brand list')
@section('content')


<div class="row">
    <div class="col-12">
          <div class="card">
          <div class="card-header">
          <div class="row justify-content-between">
              <label class="">Brand List<span class="float-right">	<button type="button" data-toggle="modal" data-target="#brand_" class="btn btn-primary"><i class="fas fa-plus"></i> Add Brand</button></span></label>

          </div>
        </div>

        <div class="card-body">
        <div class="table-responsive" id="slimtest2">
            <table id="brand_table" class="table table-bordered table-striped">
                        <thead class="text-center bg-info">

                            <tr>
                                <th>#</th>
                                <th>Brand Code</th>
                                <th>Related SubCategory</th>
                                <th>Brand Name</th>



                                <th class="text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;?>
                        @foreach($brands as $brand)

                            <?php
                            foreach ($brand->subcategories as $brandsub) {

                            }
                            ?>

                            <tr>
                            <td class="text-center">{{$i++}}</td>
                                <td class="text-center">{{$brand->brand_code}}</td>
                                <td class="text-center">

                                    <?php

                                    foreach ($brand->subcategories as $brandsub) {
                                        echo $brandsub->name;
                                        $bsub = $brandsub->name;
                                        $bsub_id = $brandsub->id;
                                    }
                                    ?>

                                </td>
                                <td class="text-center">{{$brand->name}}</td>



                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_subcategory{{$brand->id}}">
                                Update</a>



                                    <a href="#" class="btn btn-sm btn-danger" onclick="ApproveLeave('{{$brand->id}}')">
                                Delete</a>

                                </td>

                                <div class="modal fade" id="edit_subcategory{{$brand->id}}" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title pinkcolor">Update Brand Form</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>

                                    <div class="modal-body">
                                        <form class="form-material m-t-40" method="post" action="{{route('brand_update', $brand->id)}}">
                                            @csrf

                                            <div class="form-group">
                                                <label class="font-weight-bold">Code</label>
                                                <input type="number" name="brand_code" class="form-control" value="{{$brand->brand_code}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Category</label>
                                                <select class="form-control" name="category_id" onchange="showRelatedSubCategoryUpdate(this.value,'{{$brand->id}}')" required>
                                                    <option value="{{$brand->category_id}}" name="category_id">{{$brand->category->category_name}}</option>
                                                    @foreach($categories as $category)
                                                    <!-- @if($brand->category_id != $category->id) -->
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                    <!-- @endif -->
                                                    @endforeach
                                                </select>

                                            </div> 
                                            <div class="form-group">
                                                <label class="font-weight-bold">SubCategory</label>
                                                <span id="choose_sub{{$brand->id}}">
                                                <select class="form-control" id="subcategory_update{{$brand->id}}" name="subcategory">
                                                    <option value="{{$bsub_id}}" id="old_sub">{{$bsub}}</option>
                                                </select>
                                                </span>
                        <!-- @error('band_code')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror -->


                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Name</label>
                                                <input type="text" name="brand_name" class="form-control" value="{{$brand->name}}">
                                            </div>
                                            <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-primary" value="Save">
                                        </form>
                                    </div>


                              </div>
                                    </div>
                                </div>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                                </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="brand_" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Brand Form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form class="form-material m-t-40" method="post" action="{{route('brand_store')}}">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">Code</label>
                        <input type="number" name="brand_code" class="form-control @error('category_code') is-invalid @enderror" placeholder="enter brand code">


                        @error('brand_code')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror



                    </div>


                     <div class="form-group">
                        <label class="font-weight-bold">Category</label>
                        <select class="form-control" name="category_id" onchange="showRelatedSubCategory(this.value)" required>
                            <option value="">Select Category</option>

                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>

                    </div> 
                        <div class="form-group">
                        <label class="font-weight-bold">SubCategory</label>
                        <select class="form-control" id="subcategory" name="subcategory" required>
                            <!-- <option value="">{{$brand->subcategory}}</option> -->
                        </select>

                        <!-- @error('band_code')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>
                        @enderror -->


                    </div>
                    <div class="form-group">
                        <label>Supplier</label>
                        <div class="select2-purple">
                        <select class="form-control" id="select2" multiple="multiple" name="supplier[]" id="supplier">
                        @foreach($supplier as $eachsupp)
                        <option value="{{$eachsupp->id}}">{{$eachsupp->company_name}}</option>
                        @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="font-weight-bold">Name</label>
                        <input type="text" name="brand_name" class="form-control @error('category_name') is-invalid @enderror" placeholder="enter brand name">
                        @error('brand_name')
                            <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                {{ $message }}
                            </span>

                        @enderror
                    </div>
                    <div class="form-group">
 		            <label for="message-text"  class="float-left">Description:</label>
		            <textarea class="form-control" id="description" name="description"></textarea>
		            <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="message-text"  class="float-left">Country of Region:</label>
                        <input type="text" class="form-control" id="country_of_origin" name="country_of_origin" id="recipient-name">
                        <span class="text-danger">{{ $errors->first('country_of_origin') }}</span>
                    </div>
                    <input type="submit" name="btnsubmit" class="btnsubmit float-right btn btn-warning" value="save brand">
                </form>
            </div>
        </div>
    </div>

</div>


</div>


<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script> 
<script type="text/javascript">

 $('#select2').select2({
        dropdownParent: $('#brand_'),
        
    });

function ApproveLeave(value){

var brand_id = value;

swal({

    title: "Confirm!!!",
    icon:'warning',
    buttons: ["No", "Yes"]

})

.then((isConfirm)=>{

if(isConfirm){

    $.ajax({
        type:'POST',
        url:'brand/delete',
        dataType:'json',

        data:{

          "_token": "{{ csrf_token() }}",
          "brand_id": brand_id,
        },

        success: function(){



            swal({
                title: "Success!",
                text : "Successfully Deleted!",
                icon : "success",
            });

            setTimeout(function(){window.location.reload()}, 1000);



        },

    });
}
});


}




function showRelatedSubCategory(value) {
// alert("hello");
console.log(value);

$('#subcategory').prop("disabled", false);

var category_id = value;

$('#subcategory').empty();

$.ajax({
    type: 'POST',
    url: '/showSubCategory',
    dataType: 'json',
    data: {
        "_token": "{{ csrf_token() }}",
        "category_id": category_id,
    },

    success: function(data) {

        console.log(data);

        $('#subcategory').append($('<option>').text("Select SubCategory"));
        $.each(data, function(i, value) {

            $('#subcategory').append($('<option>').text(value.name).attr('value', value.id));
        });

    }

});
}

function showRelatedSubCategoryUpdate(value,brand_id) {
// alert("hello");
console.log(value);
$('#old_sub').hide();
$('#subcategory').prop("disabled", false);

var category_id = value;

$('#subcategory').empty();

$.ajax({
    type: 'POST',
    url: '/showSubCategory',
    dataType: 'json',
    data: {
        "_token": "{{ csrf_token() }}",
        "category_id": category_id,
    },

    success: function(data) {
        var html = "";
        console.log(data);
        // $('#subcategory_update'+brand_id).children('option[value="1"]').hide();
        // $('#subcategory_update'+brand_id).append($('<option>').text("Select SubCategory"));
        html+=`
        <select class="form-control" id="subcategory_update{{$brand->id}}" name="subcategory">`;
        $.each(data, function(i, v) {
            if(v.id == null)
            {
               
            }
            else
            {
            html+=`
            
                <option value="${v.id}" id="old_sub">${v.name}</option>`;
            
            }
            
            // $('#subcategory_update'+brand_id).append($('<option>').text(value.name).attr('value', value.id));
        });
        html+=`
        </select>`;
        $('#choose_sub'+brand_id).html(html);

    }

});
}
$('#brand_table').DataTable( {

"paging":   true,
"ordering": true,
"info":     true

});

// $('#slimtest2').slimScroll({
// color: '#00f',
// height: '600px'
// });
</script>   
@endsection





