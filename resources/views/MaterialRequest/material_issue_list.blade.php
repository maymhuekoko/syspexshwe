@extends('master')
@section('title','Material Request List')
@section('link','Material Request List')
@section('content')

<div class="row">

    <h4>Hello</h4>

</div>
<!-- page script -->
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script type="text/javascript">

    function sale_order(material_request_id,available_items_lists){

    var prefix = $('#prefix').val();
    var digit = $('#digit').val();

    $.ajax({
      type:'POST',
      url:'/ajaxSendMaterialIssue',
      dataType:'json',
      data:{"_token": "{{ csrf_token() }}",
      "material_request_id":material_request_id,
      "available_items_lists": available_items_lists,
      "prefix": prefix,
      "digit":digit,
    },

      success:function(data){
        console.log(data);

        swal({
          'title':"Successfully Send Sale Order!",
          'text':"Successfully Send Sale Order!",
          'icon':"success",

        })
      }
    });

  }


//hello
//noble

</script>
@endsection

