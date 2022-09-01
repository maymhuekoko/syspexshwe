@extends('master')
@section('title','BOM Supplier Import Process')
@section('link','BOM Supplier Import Process')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-shadow">
            <div class="card-header">
                <label class="text-success"><i>{{$bom_supplier->request_no}}</i></label>
                <span class="float-center offset-md-4 text-danger"><label>BOM Supplier Import Process Form</label></span>
            </div>
            
                
                <input type="hidden" value="{{$bom_supplier->id}}" name="bom_supplier_id" id="bomsupplierID">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="name" class="text-secondary">Supplier Name</label>
                        <input type="hidden" value="{{$bom_supplier->supplier->id}}" name="supplier_id" id="supplierID">
                        <input type="text" class="form-control border border-success" id="supplier_name" name="supplier_name" value="{{$bom_supplier->supplier->name}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-9">
                                <!-- have -->
                                @if(!$import_processes->isEmpty())
                                <div class="form-group">
                                <label for="name">Ref Commercial Invoice No</label>
                               
                                    @foreach($import_processes as $impro)
                                    @if($impro->bom_supplier_id == $bom_supplier->id)
                                    <input type="hidden" id="import_process_id" value="{{$impro->id}}">
                                    <input type="text" class="form-control border border-success" value="{{$impro->supplier_invoice_no}}" readonly>
                                    
                                </div>
                            </div>
                                <div class="col-md-3 pt-3 pb-2">
                                <div class="form-group">
                                <label></label>
                                <button type="button" class="btn btn-warning form-control" data-toggle="modal" data-target="#started_invoice_pdf" onclick="startedInvoice_pdf('{{$impro->supplier_invoice_id}}')"><i class="fas fa-eye mr-2"></i>View</button>
                                </div>
                            </div>
                            @endif
                                    @endforeach
                                <!-- end have -->
                                @else
                                <!-- not have -->
                                <div class="form-group" style="margin-top:7px">
                                <label for="name" class="text-secondary">Ref Commercial Invoice No</label>
                                    <select class="form-control border border-success text-secondary" name="invoice_id" id="invoice_id" onchange="get_invoice_pdf(this.value)">
                                    <option selected="selected" disabled hidden>Select BOM Supplier Invoice Number</option>
                                    @foreach($bsup_invoice as $inv)
                                        <option value="{{$inv->id}}">{{$inv->supplier_invoice_number}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <!-- end not have -->
                                </div>
                                <div class="col-md-3 pt-3 pb-2">
                                <div class="form-group">
                                <label></label>
                                <button type="button" class="btn btn-warning form-control" data-toggle="modal" data-target="#invoice_pdf"><i class="fas fa-eye mr-2"></i>View</button>
                                </div>
                            </div>
                                @endif
                            
                            
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-9">
                            @if(!$import_processes->isEmpty())
                                <!-- have -->
                                <div class="form-group">
                                    <label for="name" class="text-secondary">Ref Quotation No</label>
                                        @foreach($import_processes as $impro)
                                        @if($impro->bom_supplier_id == $bom_supplier->id)
                                        <input type="text" class="form-control border border-success" value="{{$impro->supplier_quotation_number}}" readonly>
                                                                     
                                </div>
                            </div>
                                <div class="col-md-3 pt-3 pb-2">
                                <div class="form-group">
                                <label></label>
                                <button type="button" class="btn btn-warning form-control" data-toggle="modal" data-target="#started_quotation_pdf" onclick="startedQuotation_pdf('{{$impro->supplier_quotation_id}}')"><i class="fas fa-eye mr-2"></i>View</button>
                                </div>
                            </div>
                            @endif
                                        @endforeach 
                                <!-- end have -->
                                @else
                                <!-- not have -->
                                <div class="form-group" style="margin-top:7px;">
                                <label for="name">Ref Quotation No</label>
                                    <select class="form-control border border-success text-secondary" name="quotation_id" id="quotation_id" onchange="get_quo_pdf(this.value)">
                                    <option selected="selected" disabled hidden>Select BOM Supplier Quotation Number</option>
                                    @foreach($bsup_quotation as $quo)
                                        <option value="{{$quo->id}}">{{$quo->supplier_quotation_number}}</option>
                                    @endforeach
                                    </select>
                                </div>
                        </div>
                                <div class="col-md-3 pt-3 pb-2">
                                <div class="form-group">
                                <label></label>
                                <button type="button" class="btn btn-warning form-control" data-toggle="modal" data-target="#quotation_pdf"><i class="fas fa-eye mr-2"></i>View</button>
                                </div>
                            </div>
                                <!-- end not have -->
                                @endif
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-9">
                            @if(!$import_processes->isEmpty())
                                <!-- have -->
                                <div class="form-group">
                                <label for="name" class="text-secondary">Incoterm</label><br>                               
                                    @foreach($import_processes as $impro)
                                    @if($impro->bom_supplier_id == $bom_supplier->id)
                                    <input type="text" class="form-control border border-success" value="{{$impro->incoterm_long}}" readonly>
                                    @endif
                                    @endforeach
                                </div>
                                <!-- end have -->
                                @else
                                <!-- not have -->
                                <div class="form-group" style="margin-top:7px;">
                                <label for="name">Incoterm</label><br>
                                    <select style="width:455px;border-radius:5px;" class="border border-success selectpicker pt-2 pb-2 pl-2 text-secondary"  name="inco" id="inco">
                                    <option selected="selected" disabled hidden>Select Incoterm 2020</option>
                                    
                                        <option value="1">E&nbsp;X&nbsp;W&nbsp;&nbsp;(EX Work)</option>
                                        <option value="2">F&nbsp;C&nbsp;A&nbsp;&nbsp;(Free Carrier)</option>
                                        <option value="3">F&nbsp;A&nbsp;S&nbsp;&nbsp;(Free Analog Side Ship)</option>
                                        <option value="4">F&nbsp;O&nbsp;B&nbsp;&nbsp;(Free On Board)</option>
                                        <option value="5">C&nbsp;F&nbsp;R&nbsp;&nbsp;(Cost & Freight)</option>
                                        <option value="6">C&nbsp;I&nbsp;F&nbsp;&nbsp;(Cost ,Insurence & Freight)</option>
                                        <option value="7">C&nbsp;P&nbsp;T&nbsp;&nbsp;(Cost ,Paid To (Trucking to Buyer))</option>
                                        <option value="8">D&nbsp;P&nbsp;U&nbsp;&nbsp;(Delivered At PlaceUnloaded)</option>
                                        <option value="9">D&nbsp;A&nbsp;P&nbsp;&nbsp;(Delivered At Place)</option>
                                        <option value="10">D&nbsp;D&nbsp;P&nbsp;&nbsp;(Delivered Duty Paid)</option>

                                    </select>
                                </div>
                                <!-- end not have -->
                            @endif
                            </div>
                            <div class="col-md-3 pt-3 pb-2">
                                <div class="form-group">
                                <label></label>
                                <button type="button" class="btn btn-success form-control"><i class="fas fa-edit mr-2"></i>Update</button>
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    @if(!$import_processes->isEmpty())
                        <!-- have -->
                        <div class="row">
                            <div class="col-md-8">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label text-secondary">Project Name</label><br>                           
                                @foreach($import_processes as $impro)
                                @if($impro->bom_supplier_id == $bom_supplier->id)
                                <input type="text" class="form-control" value="{{$impro->project_name}}" readonly>
                                @endif
                                @endforeach            
                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="col-form-label text-secondary">Total Cost</label>
                                <input type="number" class="form-control" value="{{$impro->total_cost}}" readonly>
                                </div>
                            </div>
                        </div>
                        <!-- end have -->
                        @else
                        <!-- not have -->
                        <div class="form-group" style="margin-top:7px;">
                            <label for="recipient-name" class="col-form-label">Project Name</label><br>
                            <select style="width:625px;border-radius:5px;" class="border border-success selectpicker pt-2 pb-2 pl-2 text-secondary" name="project_id" id="project_id">
                            <option selected="selected" disabled hidden>Select Project Name</option>
                            @foreach($sale_project as $salepj)
                                <option value="{{$salepj->id}}">{{$salepj->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <!-- end not have -->
                    @endif
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4" style="margin-top:45px">
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger pt-2 pl-5 pr-5" onclick="check_input()"><i class="fas fa-window-restore mr-2"></i>Start</button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="text-secondary" style="margin-top:20px;">Progress Stage Bar</label>
                                    @if(!$import_processes->isEmpty())
                                    @foreach($import_processes as $impro)
                                    @if($impro->bom_supplier_id == $bom_supplier->id && $impro->start_status == 1)
                                        @if($impro->imp_send_status == 0)
                                        <span class="text-danger font-weight-bold"><i>( Send Stage is waiting .. )</i></span>
                                        <div class="progress" style="margin-top:10px;">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:1%">
                                            0%
                                        </div>
                                        </div>
                                        @elseif($impro->imp_send_status == 1 && $impro->imp_export_status == 0 && $impro->imp_forwarding_status == 0 && $impro->imp_import_status == 0)
                                        <span class="text-danger font-weight-bold"><i>( Export Stage is waiting .. )</i></span>
                                        <div class="progress" style="margin-top:10px;">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                                            20%
                                        </div>
                                        </div>
                                        @elseif($impro->imp_send_status == 1 && $impro->imp_export_status == 1 && $impro->imp_forwarding_status == 0 && $impro->imp_import_status == 0)
                                        <span class="text-danger font-weight-bold"><i>( Forwarding Stage is waiting .. )</i></span>
                                        <div class="progress" style="margin-top:10px;">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                            40%
                                        </div>
                                        </div>
                                        @elseif($impro->imp_send_status == 1 && $impro->imp_export_status == 1 && $impro->imp_import_status == 0 && $impro->imp_forwarding_status == 1)
                                        <span class="text-danger font-weight-bold"><i>( Import Stage is waiting .. )</i></span>
                                        <div class="progress" style="margin-top:10px;">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                            60%
                                        </div>
                                        </div>
                                        @elseif($impro->imp_send_status == 1 && $impro->imp_export_status == 1 && $impro->imp_forwarding_status == 1 && $impro->imp_import_status == 1)
                                        <span class="text-danger font-weight-bold"><i>( The Last Stage is waiting .. )</i></span>
                                        <div class="progress" style="margin-top:10px;">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                            80%
                                        </div>
                                        </div>
                                        @endif
                                    @endif
                                    @endforeach
                                    @else
                                    <div class="progress" style="margin-top:10px;">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:1%">
                                        
                                        </div>
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>                       
                    </div>
                
                </div>
                <div class="card-footer mt-2">
                <div class="col-md-12 ml-5 container">
                    <div class="container ml-5 pl-3 wrap">
                    <!-- <a href="" data-toggle="modal" data-target=".send_form"><span class="badge badge-pill badge-info pt-3 pb-3 pr-3 pl-3 border border-secondary" style="border-radius:50px"><h5>Send</h5></span></a><span class="dot" id="dot"><i class="fas fa-ellipsis-h ml-2 fa-lg"></i><i class="fas fa-ellipsis-h fa-lg"></i><i class="fas fa-ellipsis-h fa-lg"></i><i class="fas fa-ellipsis-h fa-lg"></i><i class="fas fa-chevron-right fa-lg mr-2"></i></span>
                    <a href="" data-toggle="modal" data-target=".export_form"><span class="badge badge-pill badge-info pt-3 pb-3 pr-3 pl-3 border border-secondary" style="border-radius:50px"><h5>Export</h5></span></a><span class="dot" id="dot"><i class="fas fa-ellipsis-h ml-2 fa-lg"></i><i class="fas fa-ellipsis-h fa-lg"></i><i class="fas fa-ellipsis-h fa-lg"></i><i class="fas fa-ellipsis-h fa-lg"></i><i class="fas fa-chevron-right fa-lg mr-2"></i></span>     
                    <span class="badge badge-pill badge-info pt-3 pb-3 pr-3 pl-3 border border-secondary" style="border-radius:50px"><h5>Shipping Forward</h5></span><span class="dot" id="dot"><i class="fas fa-ellipsis-h ml-2 fa-lg"></i><i class="fas fa-ellipsis-h fa-lg"></i><i class="fas fa-ellipsis-h fa-lg"></i><i class="fas fa-ellipsis-h fa-lg"></i><i class="fas fa-chevron-right fa-lg mr-2"></i></span>     
                    <span class="badge badge-pill badge-info pt-3 pb-3 pr-3 pl-3 border border-secondary" style="border-radius:50px"><h5>Import</h5></span><span class="dot" id="dot"><i class="fas fa-ellipsis-h ml-2 fa-lg"></i><i class="fas fa-ellipsis-h fa-lg"></i><i class="fas fa-ellipsis-h fa-lg"></i><i class="fas fa-ellipsis-h fa-lg"></i><i class="fas fa-chevron-right fa-lg mr-2"></i></span>
                    <span class="badge badge-pill badge-info pt-3 pb-3 pr-3 pl-3 border border-secondary" style="border-radius:50px"><h5>Receive</h5></span> -->

                    

                    <!-- continue -->
                    @if(!$import_processes->isEmpty())
                        @foreach($import_processes as $impro)
                        @if($impro->bom_supplier_id == $bom_supplier->id && $impro->start_status == 1)
                        @if($impro->imp_send_status == 0)
                        <a href="" data-toggle="modal" data-target="#send_form{{$impro->id}}" class="btn Hover impinprogress pt-3 pb-2 pr-3 pl-3" style="border-radius:20px;margin-left:40px;"><label style="font-size: 15px;"><i>Send</i></label></a>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>
                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;" disabled><i>Export</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>

                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3"  style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Forwarding</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>

                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Import</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>

                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Receive</i></label></button>
                        @elseif($impro->imp_send_status == 1 && $impro->imp_export_status == 0 && $impro->imp_forwarding_status == 0 && $impro->imp_import_status == 0)
                        <a href="" data-toggle="modal" data-target="#send_form{{$impro->id}}" class="btn impfinish pt-3 pb-2 pr-3 pl-3" style="border-radius:20px;margin-left:40px;"><label style="font-size: 15px;"><i>Sended</i></label></a>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4 arrow1" style="margin-top:13px"></i>
                        <button type="button" data-toggle="modal" data-target=".export_form" class="btn Hover impinprogress pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;" disabled><i>Export</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>

                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Forwarding</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>

                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Import</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>

                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Receive</i></label></button>
                        
                        @elseif($impro->imp_export_status == 1 && $impro->imp_send_status == 1 && $impro->imp_forwarding_status == 0 && $impro->imp_import_status == 0)
                        <a href="" data-toggle="modal" data-target="#send_form{{$impro->id}}" class="btn impfinish pt-3 pb-2 pr-3 pl-3" style="border-radius:20px;margin-left:40px;"><label style="font-size: 15px;"><i>Sended</i></label></a>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4 arrow1" style="margin-top:13px"></i>
                        <button type="button" data-toggle="modal" data-target=".export_form" class="btn impfinish pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;" disabled><i>Exported</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4 arrow1" style="margin-top:13px"></i>
                        

                        <button type="button" data-toggle="modal" data-target="#forwarding{{$impro->id}}" class="btn Hover impinprogress  pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;"><i>Forwarding</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>
                       
                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Import</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>

                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Receive</i></label></button>
                        @elseif($impro->imp_export_status == 1 && $impro->imp_send_status == 1 && $impro->imp_forwarding_status == 1 && $impro->imp_import_status == 0)
                        <a href="" data-toggle="modal" data-target="#send_form{{$impro->id}}" class="btn impfinish pt-3 pb-2 pr-3 pl-3" style="border-radius:20px;margin-left:40px;"><label style="font-size: 15px;"><i>Sended</i></label></a>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4 arrow1" style="margin-top:13px"></i>
                        <button type="button" data-toggle="modal" data-target=".export_form" class="btn impfinish pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;" disabled><i>Exported</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4 arrow1" style="margin-top:13px"></i>
                        

                        <button type="button" data-toggle="modal" data-target="#forwarding{{$impro->id}}" class="btn impfinish  pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;"><i>Forwarded</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4 arrow1" style="margin-top:13px"></i>
                       
                        <button type="button" data-toggle="modal" data-target="#import{{$impro->id}}" class="btn Hover impinprogress  pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;"><i>Import</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>

                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Receive</i></label></button>
                        @elseif($impro->imp_export_status == 1 && $impro->imp_send_status == 1 && $impro->imp_forwarding_status == 1 && $impro->imp_import_status == 1)
                        <a href="" data-toggle="modal" data-target="#send_form{{$impro->id}}" class="btn impfinish pt-3 pb-2 pr-3 pl-3" style="border-radius:20px;margin-left:40px;"><label style="font-size: 15px;"><i>Sended</i></label></a>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4 arrow1" style="margin-top:13px"></i>
                        <button type="button" data-toggle="modal" data-target=".export_form" class="btn impfinish pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;" disabled><i>Exported</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4 arrow1" style="margin-top:13px"></i>
                        

                        <button type="button" data-toggle="modal" data-target="#forwarding{{$impro->id}}" class="btn impfinish  pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;"><i>Forwarded</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4 arrow1" style="margin-top:13px"></i>
                       
                        <button type="button" data-toggle="modal" data-target="#import{{$impro->id}}" class="btn impfinish  pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;"><i>Import</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4 arrow1" style="margin-top:13px"></i>

                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Receive</i></label></button>
                        @endif
                        @endif
                        @endforeach
                    @else
                    <a href="#" type="button" class="btn impstart pt-3 pb-2 pr-3 pl-3" style="border-radius:20px;margin-left:60px;"><label style="font-size: 15px;" disabled><i>Send</i></label></a>
                    <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>
                    <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;" disabled><i>Export</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>
                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Forwarding</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>
                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Import</i></label></button>
                        <i class="fas fa-long-arrow-alt-right fa-3x ml-4 mr-4" style="margin-top:13px"></i>
                        <button type="button" class="btn impstart pt-3 pb-3 pr-3 pl-3" style="border-radius:20px" onclick="error_stage()"><label style="font-size: 15px;"><i>Receive</i></label></button>
                    @endif
                    
                    <!-- end continue -->

                    <!-- Work Process -->
                    <!-- <a href="" data-toggle="modal" data-target=".send_form" class="btn btn-secondary pt-3 pb-2 pr-3 pl-3" style="border-radius:20px;margin-left:40px;"><label style="font-size: 15px;"><i>Send</i></label></a>
                    <i class="fas fa-long-arrow-alt-right fa-3x ml-3 mr-5 arrow1"></i>
                    
                    <a href="" data-toggle="modal" data-target=".export_form" class="btn btn-secondary pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;"><i>Export</i></label></a>
                    <i class="fas fa-long-arrow-alt-right fa-3x ml-3 mr-5 arrow1"></i>
                    <a href="" class="btn btn-secondary pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;"><i>Forwarding</i></label></a>
                    <i class="fas fa-long-arrow-alt-right fa-3x ml-3 mr-5 arrow1"></i>
                    <a href="" class="btn btn-secondary pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;"><i>Import</i></label></a>
                    <i class="fas fa-long-arrow-alt-right fa-3x ml-3 mr-5 arrow1"></i>
                    <a href="" class="btn btn-secondary pt-3 pb-3 pr-3 pl-3" style="border-radius:20px"><label style="font-size: 15px;"><i>Receive</i></label></a> -->
                    <!-- end work process -->

                </div>  
                </div>   
                <!-- Not Have Commercial Invoice Pdf Modal -->
                <div class="modal fade bd-example-modal-lg" id="invoice_pdf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5>Commercial Invoice File</h5>
                        </div>
                        <dic class="card">
                            <div class="card-body" id="show_invoice_pdf">

                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- End Not Have Commercial Invoice Pdf Modal -->
                <!-- Have Commercial Invoice Pdf Modal -->
                <div class="modal fade bd-example-modal-lg" id="started_invoice_pdf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5>Commercial Invoice File</h5>
                        </div>
                        <dic class="card">
                            <div class="card-body" id="show_started_invoice_pdf">

                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- End Have Commercial Invoice Pdf Modal -->

                <!-- Quotation Not Have Pdf Modal -->
                <div class="modal fade bd-example-modal-lg" id="quotation_pdf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5>Commercial Invoice File</h5>
                        </div>
                        <dic class="card">
                            <div class="card-body" id="show_quo_pdf">

                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- End Not Have Quotation Pdf Modal -->
                <!-- Quotation Have Pdf Modal -->
                <div class="modal fade bd-example-modal-lg" id="started_quotation_pdf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5>Commercial Invoice File</h5>
                        </div>
                        <dic class="card">
                            <div class="card-body" id="show_started_quotation_pdf">

                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- End Have Quotation Pdf Modal -->
                
                <!-- Send form Modal -->
                @foreach($import_processes as $im_pro)
                <div class="modal fade" id="send_form{{$im_pro->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                        <h5>Send Registeration Form</h5>
                        </div>
                        <form id="store_form" action="{{route('bom_import_send_store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="send_form_id{{$im_pro->id}}" name="send_form_id">
                        <div class="modal-body"> 
                            <div class="card"> 
                                <div class="card-body"> 
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-9">
                                            <label for="name">Commerical Invoice</label>
                                            @foreach($import_processes as $im_pro)
                                            <input type="hidden" value="{{$im_pro->id}}" name="im_pro_id">
                                            <input type="text" class="form-control" value="{{$im_pro->supplier_invoice_no}}" name="invoice_id">
                                            @endforeach
                                            </div>
                                            <div class="col-md-3" style="margin-top:40px;">
                                            <div class="form-group">
                                            <button type="button" class="btn btn-warning btn-block form-control" onclick="view_pdf()" data-toggle="modal" data-target="#com_pdf"><i class="fas fa-eye mr-2"></i>View</button>  
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <label for="name">Packing List</label>
                                            </div>
                                            <div class="col-md-3">
                                            <input type="hidden" id="hasfile_send{{$im_pro->id}}" name="hasfile">
                                            <input type="file" id="packfile" name="packfile" class="form-control input-sm mr-8 bg-dark hidepack">
                                            <span id="upload{{$im_pro->id}}">
                                            <button type="button" id="upload{{$im_pro->id}}" class="btn btn-primary  btn-block" onclick="impackData()"><i class="fas fa-file-import mr-2"></i>Upload</button> 
                                            </span>
                                            </div>
                                            <div class="col-md-3">
                                            <span id="show_view_pdf{{$im_pro->id}}">
                                            <button type="button" class="btn btn-secondary btn-block" disabled><i class="fas fa-eye mr-2"></i>View</button>  
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                
                                <div class="form-group">
                                <label for="name" class="text-success">Shipper Name</label>
                                
                                
                                <input type="text" class="form-control" id="shipper_name{{$im_pro->id}}" name="shipper_name" placeholder="Enter Shipper Name">
                                
                                </div>
                                
                                <div class="form-group">
                                <label for="name" class="text-success">Shipper Address</label>
                                <input type="text" class="form-control" id="shipper_addr{{$im_pro->id}}" name="shipper_addr" placeholder="Enter Shipper Address">
                                </div>
                                <div class="form-group">
                                <label for="name" class="text-success">Shipper Tax ID</label>
                                <input type="text" class="form-control" id="ship_tax_id{{$im_pro->id}}" name="ship_tax_id" placeholder="Enter Shipper Tax ID">
                                </div>
                                <div class="form-group" class="text-success">
                                <label for="name" class="text-success">Phone Number</label>
                                <input type="number" class="form-control" id="ship_phno{{$im_pro->id}}" name="ship_phno" placeholder="Enter Shipper Phone Number">
                                </div>
                                <div class="form-group" class="text-success">
                                <label for="name" class="text-success">Consigner Name</label>
                                <input type="text" class="form-control" id="cong_name{{$im_pro->id}}" name="cong_name" placeholder="Enter Consigner Name">
                                </div>
                                <div class="form-group" class="text-success">
                                <label for="name" class="text-success">Consigner Address</label>
                                <input type="text" class="form-control" id="con_addr{{$im_pro->id}}" name="con_addr" placeholder="Enter Address">
                                </div>
                                <div class="form-group" class="text-success">
                                <label for="name" class="text-success">Consigner Tax ID</label>
                                <input type="text" class="form-control" id="con_tax_id{{$im_pro->id}}" name="con_tax_id" placeholder="Enter Consigner Tax ID">
                                </div>
                                <div class="form-group" class="text-success">
                                <label for="name" class="text-success">Consigner Phone Number</label>
                                <input type="text" class="form-control" id="con_ph_no{{$im_pro->id}}" name="con_ph_no" placeholder="123-456-789">
                                </div>
                                </div><!-- first end -->
                                <div class="col-md-6">
                                
                                <div class="form-group">
                                <label for="name" class="text-success">Notify Party</label>
                                <input type="text" class="form-control" id="noti{{$im_pro->id}}" name="noti" placeholder="Enter Notify Party Name">
                                </div>
                                <div class="form-group">
                                <label for="name" class="text-success">Notify Party Address</label>
                                <input type="text" class="form-control" id="noti_addr{{$im_pro->id}}" name="noti_addr" placeholder="Enter Notify Party Address">
                                </div>
                                <div class="form-group">
                                <label for="name" class="text-success">Notify Party Phone</label>
                                <input type="text" class="form-control" id="noti_phone{{$im_pro->id}}" name="noti_phone" placeholder="Enter Notify Party Phone">
                                </div>
                                <div class="form-group">
                                <label for="name" class="text-success">Pick Up Address</label>
                                <input type="text" class="form-control" id="pick_addr{{$im_pro->id}}" name="pick_addr" placeholder="Enter Pick Up Address">
                                </div>
                                <div class="form-group">
                                <label for="name" class="text-success">Total Freight Cost</label>
                                <input type="number" class="form-control" id="total_fre_cost{{$im_pro->id}}" name="total_fre_cost" placeholder="Enter Total Freight Cost">
                                </div>
                                <div class="form-group">
                                <label for="name" class="text-success">Insurence Cost</label>
                                <input type="number" class="form-control" id="ins_cost{{$im_pro->id}}" name="ins_cost" placeholder="Enter Insurence Cost">
                                </div>
                                <div class="form-group mt-2 pt-2">
                                <label for="name" class="text-success">Status</label>
                                <span id="change_send_status{{$im_pro->id}}">
                                <select class="form-control" name="status" id="send_status{{$im_pro->id}}">
                                <!-- <option selected="selected">Select Status</option> -->
                                <option value="1" selected>Start</option>
                                <option value="2" disabled>Inprogress</option>
                                <option value="3" disabled>Finished</option>
                                </select>
                                </span>
                                </div>

                                </div><!-- second end -->
                            
                            </div>
                            <div class="card-footer">
                                <span id="place_send_update{{$im_pro->id}}"></span>
                                <!-- <button type="button" class="btn btn-danger btn-block" onclick="store_send()">Save</button> -->
                                <button type="submit" id="first_store_send{{$im_pro->id}}" class="btn btn-danger btn-block" onclick="ajax_store_send_form()">Save</button>
                            </div>  
                        </form>         
                        </div>
                    </div>
                </div>
                
                </div>
                @endforeach
                <!-- End Send form Modal -->
                <!-- Send form Commercial PDF Modal -->
                <div class="modal fade" id="com_pdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <iframe src ="" class="img-fluid text-center attachmentimg" id="com_view_pdf" style="width: -webkit-fill-available;height: 100vh;"></iframe>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Send form End Commercial PDF Modal -->
                <!-- Packing list in Send form Commercial PDF Modal -->
                @foreach($import_processes as $im_pro)
                <div class="modal fade" id="pack_pdf_modal{{$im_pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Packing List PDF</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <span id="pack_file_path{{$im_pro->id}}"></span>
                        </div>
                        
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- End Packing List in Send form End Commercial PDF Modal -->
                
               
                <!-- Export Form Modal -->
                @foreach($import_processes as $im_pro)
                <form action="{{route('bom_import_export_store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="export_form_id{{$im_pro->id}}" name="export_form_id">
                    
                    <input type="hidden" value="{{$im_pro->id}}" name="im_pro_id">
                    
                <div class="modal fade bd-example-modal-lg export_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5>Export Registeration Form</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-success">Freight Forwarder Name</label>
                                            <input type="text" class="form-control" name="fre_for_name" id="fre_for_name{{$im_pro->id}}" placeholder="Enter Freight Forwarder Name">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Forwarder Address</label>
                                            <input type="text" class="form-control" name="for_address" id="for_address{{$im_pro->id}}" placeholder="Enter Freight Forwarder Address">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Freight Forwarder Phone</label>
                                            <input type="number" class="form-control" name="for_phno" id="for_phno{{$im_pro->id}}" placeholder="Enter Freight Forwarder Phone Number">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Shipping/Airline Name</label>
                                            <input type="text" class="form-control" name="ship_air_name" id="ship_air_name{{$im_pro->id}}" placeholder="Enter Shipping or Ariline Name">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Shipping/Airline Address</label>
                                            <input type="text" class="form-control" name="ship_air_address" id="ship_air_address{{$im_pro->id}}" placeholder="Enter Freight Forwarder Name">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Shipping/Airline Phone</label>
                                            <input type="number" class="form-control" name="ship_air_ph" id="ship_air_ph{{$im_pro->id}}" placeholder="Enter Freight Forwarder Name">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Bill Of Lading Number</label>
                                            <input type="text" class="form-control" name="lad_no" id="lad_no{{$im_pro->id}}" placeholder="Enter Bill of Lading Number">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">BL Type</label>
                                            <select class="form-control text-secondary" name="bl_type" id="bl_type{{$im_pro->id}}">
                                                <option selected="selected" value="0">Select BL Type</option>
                                                <option value="1">BL One</option>
                                                <option value="2">BL Two</option>
                                                <option value="3">BL Three</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                <label class="text-success">BL Document</label>
                                                </div>
                                                <div class="col-md-8">
                                                <input type="hidden" id="hasfile_export{{$im_pro->id}}" name="hasblfile">
                                                <input type="file" id="blfile" name="blfile" class="form-control input-sm mr-8 bg-dark">
                                                
                                                <button type="button" id="upload_bl{{$im_pro->id}}" class="btn btn-primary" onclick="im_bldoc()"><i class="fas fa-file-import mr-2"></i>Upload</button>
                                                
                                                <span id="show_bl_view_pdf{{$im_pro->id}}">
                                                <button type="button" class="btn btn-secondary ml-2" disabled><i class="fas fa-eye mr-2"></i>View</button>
                                                <span>
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-success">Place Of Acceptence</label>
                                            <input type="text" class="form-control" name="acceptence" id="acceptence{{$im_pro->id}}" placeholder="Enter Place Of Acceptence">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Place Of Delivery</label>
                                            <input type="text" class="form-control" name="deli" id="deli{{$im_pro->id}}" placeholder="Enter Place of Delivery">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Port Of Loading</label>
                                            <input type="text" class="form-control" name="load" id="load{{$im_pro->id}}" placeholder="Enter Port Of Loading">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Port Of Discharge</label>
                                            <input type="text" class="form-control" name="discharge" id="discharge{{$im_pro->id}}" placeholder="Enter Port Of Discharge">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Carrier Type</label>
                                            <select class="form-control text-secondary" name="carr_type" id="carr_type{{$im_pro->id}}">
                                                <option selected="selected" value="0">Select Carrier Type</option>
                                                <option value="1">Carrier One</option>
                                                <option value="2">Carrier Two</option>
                                                <option value="3">Carrier Three</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Movement Type</label>
                                            <select class="form-control text-secondary" name="mov_type" id="mov_type{{$im_pro->id}}">
                                                <option selected="selected" value="0">Select Movement Type</option>
                                                <option value="1">Movement One</option>
                                                <option value="2">Movement Two</option>
                                                <option value="3">Movement Three</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Carrier Cost</label>
                                            <input type="number" class="form-control" name="carr_cost" id="carr_cost{{$im_pro->id}}" placeholder="0">
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4 mt-3">
                                                    <label class="text-success">Pick Up</label>
                                                </div>
                                                <div class="col-md-8 mt-3">
                                                    <div class="row">
                                                        <div class="col-md-6 pick_radio_yes">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="pick_flag" id="yes{{$im_pro->id}}" value="1">
                                                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pick_radio_no">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="pick_flag" id="no{{$im_pro->id}}" value="2">
                                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div><!-- col-md-8 end -->
                                                
                                            </div>
                                        </div>
                                        <div class="form-group pick">
                                            <label class="text-success">Pick Up Cost</label>
                                            <input type="number" class="form-control" name="pick_cost" id="pick_cost{{$im_pro->id}}" placeholder="0">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-success">Status</label>
                                            <span id="change_export_status{{$im_pro->id}}">
                                            <select class="form-control text-secondary" name="status" id="estatus{{$im_pro->id}}">
                                                <!-- <option selected="selected">Select Export Status</option> -->
                                                <option value="1" selected>Start</option>
                                                <option value="2" disabled>Inprogress</option>
                                                <option value="3" disabled>Finished</option>
                                            </select>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                <button type="submit" class="btn btn-danger btn-block">Save</button>
                            </div> 
                            </form>
                            </div><!-- end modal body --> 
                            @endforeach                    
                        </div>
                    </div>
                </div>
                <!-- End Export Form Modal -->
                 <!-- BL Document in Export form Commercial PDF Modal -->
                 @foreach($import_processes as $im_pro)
                <div class="modal fade" id="bl_pdf_modal{{$im_pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Packing List PDF</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <span id="bl_path{{$im_pro->id}}"></span>
                        </div>
                        
                        </div>
                    </div>
                </div>
                
                @endforeach
                <!-- End Bl Document in Export form End Commercial PDF Modal -->
                <!-- Shipping Forwarding Form Modal -->
                @foreach($import_processes as $im_pro)
                <div class="modal fade" id="forwarding{{$im_pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title">Shipping Forwarding Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('bom_forwarding_store')}}" method="post" id="forwardsubmit">
                        @csrf
                        <input type="hidden" name="im_pro_id" value="{{$im_pro->id}}">
                        <input type="hidden" name="forward_id" id="forward_id{{$im_pro->id}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Carrier Type</label>
                            <span id="replace_car_type{{$im_pro->id}}">
                            <select style="width:470px;border-radius:5px;" class="border border-success selectpicker pt-2 pb-2 pl-2 text-secondary" name="for_car_type" id="for_car_type{{$im_pro->id}}">
                            <option selected="selected" disabled hidden>Select Carrier Type</option>
                            <option value="1">Forward Type One</option>
                            <option value="2">Forward Type Two</option>
                            </select>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Vessle / Flight / Truck Number</label>
                            <input type="text" class="form-control border border-success" name="ves_flig_tru_no" id="vft_no{{$im_pro->id}}" placeholder="Enter Vessle / Flight / Truck Number">
                        </div>
                        <div class="form-group">
                            <label>Voyage / Departure Date</label>
                            <input type="date" class="form-control border border-success" name="voy_dep_date" id="voy_dep_date{{$im_pro->id}}">
                        </div>
                        <div class="form-group">
                            <label>Estimate Arrival Date</label>
                            <input type="date" class="form-control border border-success" name="estimate_date" id="estimate_date{{$im_pro->id}}">
                        </div>
                        <div class="form-group">
                            <label>Current Location</label>
                            <input type="text" class="form-control border border-success" name="current_locat" id="current_locat{{$im_pro->id}}" placeholder="Enter Current Location">
                        </div>
                        <div class="form-group">
                            <label>Vessle / Flight / Truck Code</label>
                            <input type="text" class="form-control border border-success" name="vft_code" id="vft_code{{$im_pro->id}}" placeholder="Enter Vessle / Flight / Truck Code">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <span id="forward_status{{$im_pro->id}}">
                            <select style="width:470px;border-radius:5px;" class="border border-success selectpicker pt-2 pb-2 pl-2 text-secondary" name="for_status" id="for_status{{$im_pro->id}}">
                            <!-- <option selected="selected" disabled hidden>Select Forwarding Status</option> -->
                            <option value="1" selected>Departed</option>
                            <option value="2" disabled>Flying</option>
                            <option value="2" disabled>Arrival</option>
                            </select>
                            </span>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-danger btn-block" type="submit">Save</button>
                        </div>
                    </form>
                    </div>
                    
                    </div>
                </div>
                </div>
                @endforeach
                <!-- End Shipping Forwarding Form Modal -->
                <!-- Import Form Modal -->
                @foreach($import_processes as $im_pro)
                <div class="modal fade bd-example-modal-lg" id="import{{$im_pro->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title">Import Registration Form</h5>
                        </div>
                        <form action="{{route('bom_importstage_store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$im_pro->id}}" name="im_pro_id">
                            <input type="text" name="imported_id" id="imported_id{{$im_pro->id}}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- <div class="form-group">
                                        <label class="float-right text-success">License Applied</label>
                                    </div><br> -->
                                    <div class="form-group">
                                        <label class="text-success">Custom Agent Name</label>
                                        <input type="text" class="form-control" name="custom_agent" id="custom_agent{{$im_pro->id}}" placeholder="Enter Custom Agent Name">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-success">Address</label>
                                        <input type="text" class="form-control" name="address" id="address{{$im_pro->id}}" placeholder="Enter Custom Agent Address">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-success">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone{{$im_pro->id}}" placeholder="Enter Custom Agent Phone Number">
                                    </div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <label class="text-success">License Applied</label>
                                                </div>
                                                <div class="col-md-6 mt-3" id="import_radio_hide{{$im_pro->id}}">
                                                    <div class="row">
                                                        <div class="col-md-6 pick_lic_radio_yes">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="lisen_flag" id="yes" value="1">
                                                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pick_lic_radio_no">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="lisen_flag" id="no" value="2">
                                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="text-success">Import Expired Date</label>
                                        <input type="date" class="form-control" name="expdate" id="expdate{{$im_pro->id}}" placeholder="Enter Import Lisence Date">
                                    </div>
                                    <div class="form-group lic_dt">
                                        <label class="text-success">Import License Date</label>
                                        <input type="date" class="form-control" name="date" id="date{{$im_pro->id}}" placeholder="Enter Import Lisence Date">
                                    </div>
                                    
                                    <div class="form-group lic_cost">
                                        <label class="text-success">License Cost</label>
                                        <input type="number" class="form-control" name="licen_cost" id="licen_cost{{$im_pro->id}}" placeholder="Enter license Cost">
                                    </div>
                                    <div class="form-group lic_doc">
                                        <div class="row">
                                            <div class="col-md-5">
                                            <label class="text-success">License Document</label>
                                            </div>
                                            <div class="col-md-7">
                                            <input type="file" id="lisenfile" name="lisenfile" class="form-control input-sm mr-8 bg-dark">
                                            <button type="button" class="btn btn-primary" onclick="im_lisendoc()" id="licen_doc_upload{{$im_pro->id}}"><i class="fas fa-file-import mr-2"></i>Upload</button>
                                            <span id="licen_doc_view{{$im_pro->id}}">
                                            <button type="button" class="btn btn-secondary ml-2" disabled><i class="fas fa-eye mr-2"></i>View</button>
                                            </span>
                                            </div>
                                        </div> 
                                    </div>
                                </div><!-- first row col md 6 end -->
                                <div class="col-md-6">
                                    <!-- <div class="form-group">
                                        <div class="row float-left">
                                            <div class="col-md-6 pick_radio_yes">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pick_flag" id="yes" value="1">
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pick_radio_no">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pick_flag" id="no" value="2">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                            </div>
                                        </div> 
                                    </div><br> -->
                                    <div class="form-group">
                                        <label class="text-success float-left">Import Tax / Duty %</label>
                                        <input type="text" class="form-control border border-success" name="tax_duty_per" id="tax_duty_per{{$im_pro->id}}" placeholder="Enter Tax / Duty percentage">
                                    </div> 
                                    <div class="form-group">
                                        <label class="text-success">Tax / Duty Total Cost</label>
                                        <input type="text" class="form-control border border-success" name="tax_duty_cost" id="tax_duty_cost{{$im_pro->id}}" placeholder="Enter Tax / Duty percentage">
                                    </div> 
                                    <div class="form-group">
                                        <label class="text-success">Cargo Release / Date</label>
                                        <input type="date" class="form-control border border-success" name="car_rel_date" id="car_rel_date{{$im_pro->id}}" placeholder="Enter Tax / Duty percentage">
                                    </div> 
                                    <div class="form-group">
                                        <label class="text-success">Delivery Address</label>
                                        <input type="text" class="form-control border border-success" name="deli_addr" id="deli_addr{{$im_pro->id}}" placeholder="Enter Delivery Address">
                                    </div> 
                                    <div class="form-group">
                                        <label class="text-success">Delivery Cost</label>
                                        <input type="number" class="form-control border border-success" name="deli_cost" id="deli_cost{{$im_pro->id}}" placeholder="Enter Tax / Duty percentage">
                                    </div> 
                                    <div class="form-group">
                                        <label class="text-success">Labor Cost</label>
                                        <input type="number" class="form-control border border-success" name="labor_cost" id="labor_cost{{$im_pro->id}}" placeholder="Enter Tax / Duty percentage">
                                    </div> 
                                    <div class="form-group">
                                        <label>Status</label>
                                        <span id="imported_status{{$im_pro->id}}">
                                        <select style="width:380px;border-radius:5px;" class="border border-success selectpicker pt-2 pb-2 pl-2 text-secondary" name="for_status" id="for_status{{$im_pro->id}}">
                                      
                                        <option value="1" selected>Start</option>
                                        <option value="2" disabled>Inprogress</option>
                                        <option value="3" disabled>Finished</option>
                                        </select>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-5">
                                            <label class="text-success">Tax/Duty Document</label>
                                            </div>
                                            <div class="col-md-7">
                                            <input type="file" id="tax_duty_file" name="tax_duty_file" class="form-control input-sm mr-8 bg-dark">
                                            <button type="button" class="btn btn-primary" onclick="im_tax_duty_doc()" id="taxduty_upload{{$im_pro->id}}"><i class="fas fa-file-import mr-2"></i>Upload</button>
                                            <span id="taxduty_doc_view{{$im_pro->id}}">
                                            <button type="button" class="btn btn-secondary ml-2" disabled ><i class="fas fa-eye mr-2"></i>View</button>
                                            </span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-danger btn-block" id="imported_save{{$im_pro->id}}">Save</button>  
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                </div>
                @endforeach
                <!-- End Import Form Modal -->
                <!--Tax Duty Document in Import PDF Modal -->
                @foreach($import_processes as $im_pro)
                <div class="modal fade" id="taxduty_pdf_modal{{$im_pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Packing List PDF</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <span id="taxduty_file_path{{$im_pro->id}}"></span>
                        </div>
                        
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- End Tax Duty Document in Import PDF Modal -->
                <!--License Document in Import PDF Modal -->
                @foreach($import_processes as $im_pro)
                <div class="modal fade" id="license_pdf_modal{{$im_pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Packing List PDF</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <span id="license_file_path{{$im_pro->id}}"></span>
                        </div>
                        
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- End license Document in Import PDF Modal -->
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
$(document).ready(function () {
    $('#comfile').hide();
    $('.hidepack').hide();
    $('#blfile').hide();
    $('.pick').hide();
    $('#lisenfile').hide();
    $('#tax_duty_file').hide();
    $('.lic_dt').hide();
    $('.lic_cost').hide();
    $('.lic_doc').hide();
    
    var send = @json($send_form);
    var export_form = @json($export_form);
    var forward = @json($forward_form);
    var imported = @json($import_form);

    $.each( send, function( i, val ) {
        if(send[i].status == 2)
        {
            $('#send_form_id'+send[i].import_process_id).val(send[i].id);
            $('#status'+send[i].import_process_id).hide();
            var htmlsendstatus = "";
            
            htmlsendstatus +=`
            <select class="form-control" name="status">
                                    
                                    <option value="1" disabled>Start</option>
                                    <option value="2"  selected>Inprogress</option>
                                    <option value="3" disabled>Finished</option>
                                    </select>
            `;
            $('#change_send_status'+send[i].import_process_id).html(htmlsendstatus);

            // $('#first_store_send'+send[i].import_process_id).hide();
            
            
            $('#shipper_name'+send[i].import_process_id).val(send[i].shipper_name);
            // $('#shipper_name'+send[i].import_process_id).prop('disabled', true);

            $('#shipper_addr'+send[i].import_process_id).val(send[i].shipper_address);
            // $('#shipper_addr'+send[i].import_process_id).prop('disabled', true);

            $('#ship_tax_id'+send[i].import_process_id).val(send[i].shipper_tax_id);

            $('#ship_phno'+send[i].import_process_id).val(send[i].shipper_ph_no);

            $('#cong_name'+send[i].import_process_id).val(send[i].consignee_name);

            $('#con_addr'+send[i].import_process_id).val(send[i].consignee_address);

            $('#con_tax_id'+send[i].import_process_id).val(send[i].consignee_tax_id);

            $('#con_ph_no'+send[i].import_process_id).val(send[i].consignee_ph_no);

            $('#noti'+send[i].import_process_id).val(send[i].notify_party_name);

            $('#noti_addr'+send[i].import_process_id).val(send[i].notify_party_address);

            $('#noti_phone'+send[i].import_process_id).val(send[i].notify_party_phno);

            $('#pick_addr'+send[i].import_process_id).val(send[i].pick_up_address);

            $('#total_fre_cost'+send[i].import_process_id).val(send[i].total_freight_cost);

            $('#ins_cost'+send[i].import_process_id).val(send[i].insurance_cost);
            var photo = send[i].supplier_packinglist_filepath;
                var str_photo = JSON.stringify(photo);
                $('#hasfile_send'+send[i].import_process_id).val(send[i].supplier_packinglist_filepath);
            
            if(send[i].supplier_packinglist_filepath != null)
            {
               
                var htmlpackfile = "";
                var htmlpackfilemodal = "";
               
                htmlpackfile = `
                <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#pack_pdf_modal${send[i].import_process_id}"><i class="fas fa-eye mr-2"></i>View</button>  
                `;
                htmlpackfilemodal = `
                <iframe src ="image/${send[i].supplier_packinglist_filepath}" class="img-fluid text-center attachmentimg" style="width: -webkit-fill-available;height: 100vh;"></iframe>
                `;
                
                $('#pack_file_path'+send[i].import_process_id).html(htmlpackfilemodal);
                $('#show_view_pdf'+send[i].import_process_id).html(htmlpackfile);
            }

        }
        else if(send[i].status == 3)
        {
            $('#status'+send[i].import_process_id).hide();
            var htmlsendstatus = "";
            htmlsendstatus +=`
            <select class="form-control" name="status">
                                    
                                    <option value="1" disabled>Start</option>
                                    <option value="2"  disabled>Inprogress</option>
                                    <option value="3" selected>Finished</option>
                                    </select>
            `;
            $('#change_send_status'+send[i].import_process_id).html(htmlsendstatus);

            $('#shipper_name'+send[i].import_process_id).val(send[i].shipper_name);
            $('#shipper_name'+send[i].import_process_id).prop('disabled', true);

            $('#shipper_addr'+send[i].import_process_id).val(send[i].shipper_address);
            $('#shipper_addr'+send[i].import_process_id).prop('disabled', true);

            $('#ship_tax_id'+send[i].import_process_id).val(send[i].shipper_tax_id);
            $('#ship_tax_id'+send[i].import_process_id).prop('disabled', true);

            $('#ship_phno'+send[i].import_process_id).val(send[i].shipper_ph_no);
            $('#ship_phno'+send[i].import_process_id).prop('disabled', true);

            $('#cong_name'+send[i].import_process_id).val(send[i].consignee_name);
            $('#cong_name'+send[i].import_process_id).prop('disabled', true);

            $('#con_addr'+send[i].import_process_id).val(send[i].consignee_address);
            $('#con_addr'+send[i].import_process_id).prop('disabled', true);

            $('#con_tax_id'+send[i].import_process_id).val(send[i].consignee_tax_id);
            $('#con_tax_id'+send[i].import_process_id).prop('disabled', true);

            $('#con_ph_no'+send[i].import_process_id).val(send[i].consignee_ph_no);
            $('#con_ph_no'+send[i].import_process_id).prop('disabled', true);

            $('#noti'+send[i].import_process_id).val(send[i].notify_party_name);
            $('#noti'+send[i].import_process_id).prop('disabled', true);

            $('#noti_addr'+send[i].import_process_id).val(send[i].notify_party_address);
            $('#noti_addr'+send[i].import_process_id).prop('disabled', true);

            $('#noti_phone'+send[i].import_process_id).val(send[i].notify_party_phno);
            $('#noti_phone'+send[i].import_process_id).prop('disabled', true);

            $('#pick_addr'+send[i].import_process_id).val(send[i].pick_up_address);
            $('#pick_addr'+send[i].import_process_id).prop('disabled', true);

            $('#total_fre_cost'+send[i].import_process_id).val(send[i].total_freight_cost);
            $('#total_fre_cost'+send[i].import_process_id).prop('disabled', true);

            $('#ins_cost'+send[i].import_process_id).val(send[i].insurance_cost);
            $('#ins_cost'+send[i].import_process_id).prop('disabled', true);

            $('#first_store_send'+send[i].import_process_id).hide();

            if(send[i].supplier_packinglist_filepath != null)
            {
                
                var photo = send[i].supplier_packinglist_filepath;
                var str_photo = JSON.stringify(photo);
                $('#hasfile_send'+send[i].import_process_id).val(str_photo);
                var htmlpackfile = "";
                var htmlpackfilemodal = "";
               
                htmlpackfile = `
                <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#pack_pdf_modal${send[i].import_process_id}"><i class="fas fa-eye mr-2"></i>View</button>  
                `;
                htmlpackfilemodal = `
                <iframe src ="image/${send[i].supplier_packinglist_filepath}" class="img-fluid text-center attachmentimg" style="width: -webkit-fill-available;height: 100vh;"></iframe>
                `;
                
                $('#pack_file_path'+send[i].import_process_id).html(htmlpackfilemodal);
                $('#show_view_pdf'+send[i].import_process_id).html(htmlpackfile);
            }
        }
      
    });

    $.each( export_form, function( i, val ) {
        if(export_form[i].status == 2)
        {
            $('#export_form_id'+export_form[i].import_process_id).val(export_form[i].id);
            $('#estatus'+export_form[i].import_process_id).hide();
            var htmlexportstatus = "";
            htmlexportstatus += `
            <select class="form-control" name="status">                       
                <option value="1" disabled>Start</option>
                <option value="2"  selected>Inprogress</option>
                <option value="3" disabled>Finished</option>
            </select>
            `;
            $('#change_export_status'+export_form[i].import_process_id).html(htmlexportstatus);

            $('#fre_for_name'+export_form[i].import_process_id).val(export_form[i].freight_forwarder_name);
            $('#for_address'+export_form[i].import_process_id).val(export_form[i].forwarder_address);
            $('#for_phno'+export_form[i].import_process_id).val(export_form[i].forwarder_phone);
            $('#ship_air_name'+export_form[i].import_process_id).val(export_form[i].shipping_line_name);
            $('#ship_air_address'+export_form[i].import_process_id).val(export_form[i].shipping_line_address);
            $('#ship_air_ph'+export_form[i].import_process_id).val(export_form[i].shipptin_air_phone);
            $('#lad_no'+export_form[i].import_process_id).val(export_form[i].bill_of_loding_number);
            $('#bl_type'+export_form[i].import_process_id).val(export_form[i].bill_of_loding_type);
            $('#acceptence'+export_form[i].import_process_id).val(export_form[i].place_of_acceptance);
            $('#deli'+export_form[i].import_process_id).val(export_form[i].place_of_delivery);
            $('#load'+export_form[i].import_process_id).val(export_form[i].port_of_loading);
            $('#discharge'+export_form[i].import_process_id).val(export_form[i].port_of_discharge);
            $('#carr_type'+export_form[i].import_process_id).val(export_form[i].carrier_type);
            $('#mov_type'+export_form[i].import_process_id).val(export_form[i].movement_type);
            $('#carr_cost'+export_form[i].import_process_id).val(export_form[i].carrier_cost);
            $('#pickflag'+export_form[i].import_process_id).val(export_form[i].pick_up_flag);
            $('#pick_cost'+export_form[i].import_process_id).val(export_form[i].pick_up_cost);
            var expphoto = export_form[i].bill_of_loading_filepath;
            // alert(expphoto);
            $('#hasfile_export'+export_form[i].import_process_id).val(expphoto);

            if(export_form[i].bill_of_loading_filepath != null)
            {
                var htmlbl = "";
                var htmlblmodal = "";
                htmlbl +=`
                <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target="#bl_pdf_modal${send[i].import_process_id}"><i class="fas fa-eye mr-2"></i>View</button>  
                `;
                htmlblmodal = `
                <iframe src ="image/${export_form[i].bill_of_loading_filepath}" class="img-fluid text-center attachmentimg" style="width: -webkit-fill-available;height: 100vh;"></iframe>
                `;
                $('#bl_path'+export_form[i].import_process_id).html(htmlblmodal);
                $('#show_bl_view_pdf'+export_form[i].import_process_id).html(htmlbl);
            }
            else
            {

            }
        }
        else if(export_form[i].status == 3)
        {
            $('#export_form_id'+export_form[i].import_process_id).val(export_form[i].id);
            $('#estatus'+export_form[i].import_process_id).hide();
            var htmlexportstatus = "";
            htmlexportstatus += `
            <select class="form-control" name="status">                       
                <option value="1" disabled>Start</option>
                <option value="2" disabled>Inprogress</option>
                <option value="3" selected>Finished</option>
            </select>
            `;
            $('#change_export_status'+export_form[i].import_process_id).html(htmlexportstatus);

            $('#fre_for_name'+export_form[i].import_process_id).val(export_form[i].freight_forwarder_name);
            $('#fre_for_name'+export_form[i].import_process_id).prop('disabled', true);;

            $('#for_address'+export_form[i].import_process_id).val(export_form[i].forwarder_address);
            $('#for_address'+export_form[i].import_process_id).prop('disabled', true);;

            $('#for_phno'+export_form[i].import_process_id).val(export_form[i].forwarder_phone);
            $('#for_phno'+export_form[i].import_process_id).prop('disabled', true);;

            $('#ship_air_name'+export_form[i].import_process_id).val(export_form[i].shipping_line_name);
            $('#ship_air_name'+export_form[i].import_process_id).prop('disabled', true);;

            $('#ship_air_address'+export_form[i].import_process_id).val(export_form[i].shipping_line_address);
            $('#ship_air_address'+export_form[i].import_process_id).prop('disabled', true);;

            $('#ship_air_ph'+export_form[i].import_process_id).val(export_form[i].shipptin_air_phone);
            $('#ship_air_ph'+export_form[i].import_process_id).prop('disabled', true);;

            $('#lad_no'+export_form[i].import_process_id).val(export_form[i].bill_of_loding_number);
            $('#lad_no'+export_form[i].import_process_id).prop('disabled', true);;

            $('#bl_type'+export_form[i].import_process_id).val(export_form[i].bill_of_loding_type);
            $('#bl_type'+export_form[i].import_process_id).prop('disabled', true);;

            $('#acceptence'+export_form[i].import_process_id).val(export_form[i].place_of_acceptance);
            $('#acceptence'+export_form[i].import_process_id).prop('disabled', true);;

            $('#deli'+export_form[i].import_process_id).val(export_form[i].place_of_delivery);
            $('#deli'+export_form[i].import_process_id).prop('disabled', true);;

            $('#load'+export_form[i].import_process_id).val(export_form[i].port_of_loading);
            $('#load'+export_form[i].import_process_id).prop('disabled', true);;

            $('#discharge'+export_form[i].import_process_id).val(export_form[i].port_of_discharge);
            $('#discharge'+export_form[i].import_process_id).prop('disabled', true);;

            $('#carr_type'+export_form[i].import_process_id).val(export_form[i].carrier_type);
            $('#carr_type'+export_form[i].import_process_id).prop('disabled', true);;

            $('#mov_type'+export_form[i].import_process_id).val(export_form[i].movement_type);
            $('#mov_type'+export_form[i].import_process_id).prop('disabled', true);;

            $('#carr_cost'+export_form[i].import_process_id).val(export_form[i].carrier_cost);
            $('#carr_cost'+export_form[i].import_process_id).prop('disabled', true);;

            $('#pickflag'+export_form[i].import_process_id).val(export_form[i].pick_up_flag);
            $('#pickflag'+export_form[i].import_process_id).prop('disabled', true);;

            $('#pick_cost'+export_form[i].import_process_id).val(export_form[i].pick_up_cost);
            $('#pick_cost'+export_form[i].import_process_id).prop('disabled', true);;

            if(export_form[i].bill_of_loading_filepath != null)
            {
                var htmlbl = "";
                var htmlblmodal = "";
                htmlbl +=`
                <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target="#bl_pdf_modal${send[i].import_process_id}"><i class="fas fa-eye mr-2"></i>View</button>  
                `;
                htmlblmodal = `
                <iframe src ="image/${export_form[i].bill_of_loading_filepath}" class="img-fluid text-center attachmentimg" style="width: -webkit-fill-available;height: 100vh;"></iframe>
                `;
                $('#bl_path'+export_form[i].import_process_id).html(htmlblmodal);
                $('#show_bl_view_pdf'+export_form[i].import_process_id).html(htmlbl);
                $('#upload_bl'+export_form[i].import_process_id).attr('disabled','disabled')
            }
            else
            {

            }
        }
    })

    $.each( forward, function( i, val ) {
        if(forward[i].status == 2)
        {
            $('#forward_id'+forward[i].import_process_id).val(forward[i].id);
            // $('#for_car_type'+forward[i].import_process_id).hide();
            $('#for_car_type'+forward[i].import_process_id).val(forward[i].carrier_type).attr('selected','selected');

            $('#vft_no'+forward[i].import_process_id).val(forward[i].vessel_flight_truck_no);

            $('#voy_dep_date'+forward[i].import_process_id).val(forward[i].voyage_departure_date);

            $('#estimate_date'+forward[i].import_process_id).val(forward[i].estimate_arrival_date);

            $('#current_locat'+forward[i].import_process_id).val(forward[i].current_location);

            $('#vft_code'+forward[i].import_process_id).val(forward[i].voyage_flight_truck_code);
        $('#for_status'+forward[i].import_process_id).hide();
           var htmlforstatus = "";
           htmlforstatus += `
           
           <select style="width:470px;border-radius:5px;" class="border border-success selectpicker pt-2 pb-2 pl-2 text-secondary" name="for_status">                           
            <option value="1" disabled>Departed</option>
            <option value="2" selected>Flying</option>
            <option value="2" disabled>Arrival</option>
            </select>
           
           `;
           $('#forward_status'+forward[i].import_process_id).html(htmlforstatus);
        }
        else if(forward[i].status == 3)
        {

        }
        
    });
    // alert(send_form_data);
    $.each( imported, function( i, val ) {
        if(imported[i].status == 2)
        {
            $('#imported_id'+imported[i].import_process_id).val(imported[i].id);
            $('#custom_agent'+imported[i].import_process_id).val(imported[i].custom_agent_name);
            $('#address'+imported[i].import_process_id).val(imported[i].agent_address);
            $('#phone'+imported[i].import_process_id).val(imported[i].agent_phone);
            $('#date'+imported[i].import_process_id).val(imported[i].import_license_issued_date);
            $('#expdate'+imported[i].import_process_id).val(imported[i].import_license_expired_date);
            $('#licen_cost'+imported[i].import_process_id).val(imported[i].license_cost);
            $('#tax_duty_per'+imported[i].import_process_id).val(imported[i].import_duty_percent);
            $('#tax_duty_cost'+imported[i].import_process_id).val(imported[i].tax_duty_total_cost);
            $('#car_rel_date'+imported[i].import_process_id).val(imported[i].cargo_release_date);
            $('#deli_addr'+imported[i].import_process_id).val(imported[i].delivery_address);
            $('#deli_cost'+imported[i].import_process_id).val(imported[i].delivery_cost);
            $('#labor_cost'+imported[i].import_process_id).val(imported[i].labor_cost);
            var htmlimportedstatus = "";
            htmlimportedstatus +=`
            <select style="width:380px;border-radius:5px;" class="border border-success selectpicker pt-2 pb-2 pl-2 text-secondary" name="for_status">
                                      
                                        <option value="1" disabled>Start</option>
                                        <option value="2" selected>Inprogress</option>
                                        <option value="3" disabled>Finished</option>
                                        </select>
            
            `;
            $('#imported_status'+imported[i].import_process_id).html(htmlimportedstatus);
            if(imported[i].tax_duty_document_filepath != null)
            {
                var htmltaxdoc = "";
                var htmltaxdocfile = "";
                htmltaxdoc += `
                <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target="#taxduty_pdf_modal${imported[i].import_process_id}"><i class="fas fa-eye mr-2"></i>View</button>
                `;
                htmltaxdocfile +=`
                <iframe src ="image/${imported[i].tax_duty_document_filepath}" class="img-fluid text-center attachmentimg" style="width: -webkit-fill-available;height: 100vh;"></iframe>
                `;
                $('#taxduty_doc_view'+imported[i].import_process_id).html(htmltaxdoc);
                $('#taxduty_file_path'+imported[i].import_process_id).html(htmltaxdocfile);
            }
            if(imported[i].license_document_filepath != null)
            {
                var htmllicdoc = "";
                var htmllicdocfile = "";
                htmllicdoc += `
                <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target="#license_pdf_modal${imported[i].import_process_id}"><i class="fas fa-eye mr-2"></i>View</button>
                `;
                htmllicdocfile +=`
                <iframe src ="image/${imported[i].license_document_filepath}" class="img-fluid text-center attachmentimg" style="width: -webkit-fill-available;height: 100vh;"></iframe>
                `;
                $('#licen_doc_view'+imported[i].import_process_id).html(htmllicdoc);
                $('#license_file_path'+imported[i].import_process_id).html(htmllicdocfile);
            }
            if(imported[i].import_license_flag == 1)
            {
                $('#yes').attr('checked', true);
            }
            else if(imported[i].import_license_flag == 2)
            {
                $('#no').attr('checked', true);
            }
            

        }
        else if(imported[i].status == 3)
        {
            $('#imported_id'+imported[i].import_process_id).val(imported[i].id);

            $('#custom_agent'+imported[i].import_process_id).val(imported[i].custom_agent_name);
            $('#custom_agent'+imported[i].import_process_id).prop('disabled', true);

            $('#address'+imported[i].import_process_id).val(imported[i].agent_address);
            $('#address'+imported[i].import_process_id).prop('disabled', true);

            $('#phone'+imported[i].import_process_id).val(imported[i].agent_phone);
            $('#phone'+imported[i].import_process_id).prop('disabled', true);

            $('#date'+imported[i].import_process_id).val(imported[i].import_license_issued_date);
            $('#date'+imported[i].import_process_id).prop('disabled', true);

            $('#expdate'+imported[i].import_process_id).val(imported[i].import_license_expired_date);
            $('#expdate'+imported[i].import_process_id).prop('disabled', true);

            $('#licen_cost'+imported[i].import_process_id).val(imported[i].license_cost);
            $('#licen_cost'+imported[i].import_process_id).prop('disabled', true);

            $('#tax_duty_per'+imported[i].import_process_id).val(imported[i].import_duty_percent);
            $('#tax_duty_per'+imported[i].import_process_id).prop('disabled', true);

            $('#tax_duty_cost'+imported[i].import_process_id).val(imported[i].tax_duty_total_cost);
            $('#tax_duty_cost'+imported[i].import_process_id).prop('disabled', true);

            $('#car_rel_date'+imported[i].import_process_id).val(imported[i].cargo_release_date);
            $('#car_rel_date'+imported[i].import_process_id).prop('disabled', true);

            $('#deli_addr'+imported[i].import_process_id).val(imported[i].delivery_address);
            $('#deli_addr'+imported[i].import_process_id).prop('disabled', true);

            $('#deli_cost'+imported[i].import_process_id).val(imported[i].delivery_cost);
            $('#deli_cost'+imported[i].import_process_id).prop('disabled', true);

            $('#labor_cost'+imported[i].import_process_id).val(imported[i].labor_cost);
            $('#labor_cost'+imported[i].import_process_id).prop('disabled', true);

            var htmlimportedstatus = "";
            htmlimportedstatus +=`
            <select style="width:380px;border-radius:5px;" class="border border-success selectpicker pt-2 pb-2 pl-2 text-secondary" name="for_status">
                                      
                                        <option value="1" disabled>Start</option>
                                        <option value="2" disabled>Inprogress</option>
                                        <option value="3" selected>Finished</option>
                                        </select>
            
            `;
            $('#imported_status'+imported[i].import_process_id).html(htmlimportedstatus);

            $('#imported_save'+imported[i].import_process_id).prop('disabled', true);
            if(imported[i].tax_duty_document_filepath != null)
            {
                var htmltaxdoc = "";
                var htmltaxdocfile = "";
                htmltaxdoc += `
                <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target="#taxduty_pdf_modal${imported[i].import_process_id}"><i class="fas fa-eye mr-2"></i>View</button>
                `;
                htmltaxdocfile +=`
                <iframe src ="image/${imported[i].tax_duty_document_filepath}" class="img-fluid text-center attachmentimg" style="width: -webkit-fill-available;height: 100vh;"></iframe>
                `;
                $('#taxduty_doc_view'+imported[i].import_process_id).html(htmltaxdoc);
                $('#taxduty_file_path'+imported[i].import_process_id).html(htmltaxdocfile);
                $('#taxduty_upload'+imported[i].import_process_id).prop('disabled', true);
            }
            if(imported[i].license_document_filepath != null)
            {
                var htmllicdoc = "";
                var htmllicdocfile = "";
                htmllicdoc += `
                <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target="#license_pdf_modal${imported[i].import_process_id}"><i class="fas fa-eye mr-2"></i>View</button>
                `;
                htmllicdocfile +=`
                <iframe src ="image/${imported[i].license_document_filepath}" class="img-fluid text-center attachmentimg" style="width: -webkit-fill-available;height: 100vh;"></iframe>
                `;
                $('#licen_doc_view'+imported[i].import_process_id).html(htmllicdoc);
                $('#license_file_path'+imported[i].import_process_id).html(htmllicdocfile);
                $('#licen_doc_upload'+imported[i].import_process_id).prop('disabled', true);
            }
            if(imported[i].import_license_flag == 1)
            {
                $('#yes').attr('checked', true);
                // alert("yes");
                var htmlradio = "";
                htmlradio +=`<label class="text-danger">(Yes)</label>`;
                $('#import_radio_hide'+imported[i].import_process_id).html(htmlradio);

            }
            else if(imported[i].import_license_flag == 2)
            {
                $('#no').attr('checked', true);
                // alert("no");
                var htmlradio = "";
                htmlradio +=`<label class="text-danger">(No)</label>`;
                $('#import_radio_hide'+imported[i].import_process_id).html(htmlradio);
            }
        }
    });

})

function imcomData()
{
    
    $('#comfile').click();

}
function impackData()
{
    
    $('#packfile').click();
    
}
function view_pdf()
{
    var file = $('#comfile').val();
    $("#com_view_pdf").attr("src", file);
    
}
$('.pick_radio_yes').on('click','#yes',function(){
    // alert('yes');
    $('.pick').show();
})
$('.pick_radio_no').on('click','#no',function(){
    // alert('no');
    $('.pick').hide();
})
$('.pick_lic_radio_yes').on('click','#yes',function(){
    alert('yes');
    $('.lic_dt').show();
    $('.lic_cost').show();
    $('.lic_doc').show();
})
$('.pick_lic_radio_no').on('click','#no',function(){
    alert('no');
    $('.lic_dt').hide();
    $('.lic_cost').hide();
    $('.lic_doc').hide();
})
function im_bldoc()
{
    $('#blfile').click();
}
function im_lisendoc()
{
    $('#lisenfile').click();
}
function im_tax_duty_doc()
{
    $('#tax_duty_file').click();
}

function check_input()
{
    var project_id = $('#project_id').val();
    var bom_supplier_id = $('#bomsupplierID').val();
    var supplier_id = $('#supplierID').val();
    var supplier_name = $('#supplier_name').val();
    var invoice_no = $('#invoice_id').val();
    var quotation_no = $('#quotation_id').val();
    var incot = $('#inco').val();
    var pj_name = $('#project_id').val();
    var inc_long = $( "#inco option:selected" ).text();
    alert(inc_long+""+bom_supplier_id+"=="+supplier_id+"=="+supplier_name+"=="+invoice_no+"=="+quotation_no+"=="+incot+"=="+pj_name);
    if($.trim(supplier_name) == '' || $.trim(invoice_no) == '' || $.trim(quotation_no) == '' || $.trim(incot) == '' || $.trim(pj_name) == "")
    {
        $('#supplier_name').val("");
        $('#invoice_id').val("");
        $('#quotation_id').val("");
        $('#inco').val("");
        $('#project_id').val("");
        // alert("not ok");
        swal({

                title:"Failed!",
                text:"Please fill Basic Field",
                icon:"info",
                timer: 3000,
                })
    }
    else
    {
        // alert("ok");
        $.ajax({
           type:'POST',
           url:'/ajax_store_import_processes',
           dataType:'json',
           data:{ "_token": "{{ csrf_token() }}",
           'bom_supplier_id' : bom_supplier_id,
           'supplier_id' : supplier_id,
           'quotation_id' : quotation_no,
           'invoice_id' : invoice_no,
           'inco' : incot,
           'inco_long' : inc_long,
           'project_id':project_id,
           
        },
        success:function(data){
            
                swal({

                    title:"Success!",
                    text:"Successfully Stored!!!",
                    icon:"success",
                    timer: 3000,
                    })
                    setTimeout(function(){
             		window.location.reload();
             	},1000);
                  
        },
        });
        
        
        // alert(invoice_no);
        // $('#store_main').submit();
        // $('#supplier_name').val("");
        // $('#invoice_id').val("");
        // $('#quotation_id').val("");
        // $('#inco').val("");
        // $('#project_id').val("");
        
    }
}
function get_invoice_pdf(invoice_id)
{
    // alert(invoice_id);
    $.ajax({
           type:'POST',
           url:'/ajax_get_invoice_pdf',
           dataType:'json',
           data:{ "_token": "{{ csrf_token() }}",
           "invoice_id":invoice_id,
        },
           success:function(data){
             alert('success');
            var html = "";
            html +=`
            
            <iframe src ="image/${data.invoice_file_path}" class="img-fluid text-center attachmentimg" style="width: -webkit-fill-available;height: 100vh;"></iframe>
            `;
            $('#show_invoice_pdf').html(html);

           }
    });
}
function get_quo_pdf(quo_id)
{
    $.ajax({
           type:'POST',
           url:'/ajax_get_quotation_pdf',
           dataType:'json',
           data:{ "_token": "{{ csrf_token() }}",
           "quo_id":quo_id,
        },
        success:function(data){

            var html = "";
            html +=`
         <iframe src ="image/${data.quotation_file_path}" class="img-fluid text-center attachmentimg" style="width: -webkit-fill-available;height: 100vh;"></iframe>
            `;
            $('#show_quo_pdf').html(html);
        }
    });
}

function store_send()
{
    var im_pro_id = $('#import_process_id').val();
    var com_file = $('#comfile').val();
    var pack_file = $('#packfile').val();
    // alert(im_pro_id);
    var con_ph = $('#con_ph_no').val();
    var ship_name = $('#shipper_name').val();
    var ship_addr = $('#shipper_addr').val();
    var ship_tax_id = $('#ship_tax_id').val();
    var ship_ph = $('#ship_phno').val();
    var consig_name = $('#cong_name').val();
    var consig_addr = $('#con_addr').val();
    var consig_tax_id = $('#con_tax_id').val();
    var notify = $('#noti').val();
    var notify_addr = $('#noti_addr').val();
    var notify_ph = $('#noti_phone').val();
    var pick_up_addr = $('#pick_addr').val();
    var total_fre_cost = $('#total_fre_cost').val();
    var insur_cost = $('#ins_cost').val();
    var status = $('#status').val();

    // if($.trim(ship_name) == '' || $.trim(ship_addr) == '' || $.trim(ship_tax_id) == '' || $.trim(ship_ph) == '' || $.trim(consig_name) == "" || $.trim(consig_addr) == "" || $.trim(consig_tax_id) == "" || $.trim(notify) == "" || $.trim(notify_addr) == "" || $.trim(notify_ph) == "" || $.trim(pick_up_addr) == "" || $.trim(total_fre_cost) == "" || $.trim(insur_cost) == "" || $.trim(status) == "")
    // {
    //     alert("Please");
    // }
    // else
    // {
        $.ajax({
           type:'POST',
           url:'/ajax_bom_import_send_store',
           dataType:'json',
           data:{ "_token": "{{ csrf_token() }}",
           "im_pro_id" : im_pro_id,
           "ship_name" : ship_name,
           "ship_addr" : ship_addr,
           "ship_tax_id" : ship_tax_id,
           "ship_ph" : ship_ph,
           "consig_name" : consig_name,
           "consig_addr" : consig_addr,
           "consig_tax_id" :consig_tax_id,
           "notify" : notify,
           "notify_addr" : notify_addr,
           "notify_ph" : notify_ph,
           "pick_up_addr" : pick_up_addr,
           "total_fre_cost" : total_fre_cost,
           "insur_cost" : insur_cost,
           "status" : status,
           "comfile" : com_file,
           'packfile' : pack_file,
           "con_ph" : con_ph,
        },
        success:function(data){
                            swal({

                title:"Success!",
                text:"Successfully Stored Send Form!!!",
                icon:"success",
                timer: 3000,
                })
                setTimeout(function(){
                window.location.reload();
                },1000);

            }
        });
    // }

}
function error_stage()
{
    swal({

title:"error!",
text:"Please Fill Data in Previous Form First!!!",
icon:"error",
timer: 3000,
})
}

function startedInvoice_pdf(invoice_id)
{
    $.ajax({
           type:'POST',
           url:'/ajax_get_started_invoice_pdf',
           dataType:'json',
           data:{ "_token": "{{ csrf_token() }}",
           "invoice_id":invoice_id,
        },
        success:function(data){
            var html = "";
            html +=`
         <iframe src ="image/${data.invoice_file_path}" class="img-fluid text-center attachmentimg" style="width: -webkit-fill-available;height: 100vh;"></iframe>
            `;
            $('#show_started_invoice_pdf').html(html);
        }
    });
}
function startedQuotation_pdf(quotation_id)
{
    $.ajax({
           type:'POST',
           url:'/ajax_get_started_quotation_pdf',
           dataType:'json',
           data:{ "_token": "{{ csrf_token() }}",
           "quotation_id":quotation_id,
        },
        success:function(data){
            var html = "";
            html +=`
         <iframe src ="image/${data.quotation_file_path}" class="img-fluid text-center attachmentimg" style="width: -webkit-fill-available;height: 100vh;"></iframe>
            `;
            $('#show_started_quotation_pdf').html(html);
        }
    });
}


</script>

@endsection
