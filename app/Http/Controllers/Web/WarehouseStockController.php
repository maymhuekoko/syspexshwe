<?php

namespace App\Http\Controllers;

use App\MaterialRequest;
use App\MaterialRequestLists;
use App\SaleOrder;
use App\SaleOrderLists;
use App\Product;
use App\Item;
use App\MaterialIssue;
use App\MaterialIssueList;
use App\ProjectPhase;
use App\PhaseTask;

use Illuminate\Http\Request;

class WarehouseStockController extends Controller
{
    //
    public function ajaxSendMaterialIssue(Request $request){
		// dd($request->digit);
		if($request->material_request_id){
		    $material_request = MaterialRequest::find($request->material_request_id);
		    $material_request->warehouse_status = 1;
    		$phase = ProjectPhase::where('user_id',$material_request->user_id)->first();
    		
    		$project = Project::find($phase->project_id);
    		
    		$material_request->site_status = 0;
    		$material_request->dispatch_date = date('Y-m-d');
    		$material_request->save();
    		
    		
			// dd($total_qty_arr);
		
            $total_qty = 0;
			
			foreach($available_items_lists as $available_items)
			{
				$count = count($available_items);
                $total_qty += $count;
			}
			
    		// dd("ye");
    		$material_issue = MaterialIssue::create([
				
    			'purchase_order_id' => $purchase_order->id??null,
    			'material_request_id' => $material_request->id??null,
				'prefix_syntax' => $request->prefix,
				'index_digit' => $request->digit,
    			'project_id' => $project->id,
    			'phase_id' => $phase->id,
    			'item_list' => $material_request_lists,
    			'approve' => 0,
				'total_qty' => $total_qty,
    			'approve_delivery_order' => 0,
    			'delivery_order_status' => 0,
    			'status' => 0,
    			'warehouse_transfer_status' => 0,
    		]);
			$mi_no = $material_issue->prefix_syntax."-".sprintf("%0".$request->digit."s", $material_issue->id);
			$material_issue->material_issue_no = $mi_no;
			$material_issue->save();
    		
    		foreach ($available_items_lists as $available_items) {
                foreach($available_items as $item)
    			MaterialIssueList::create([
    				'material_issue_id' => $material_issue->id,
    				'item_id' => $item->id,
    				'stock_qty' => 1,
    			]);
    
    			$selected_item = Item::find($item->id);
    			$selected_item->reserved_flag = 1;
    			$selected_item->save();
    
    		}
		}
		
		if($request->sale_order_id) {
		    $sale_orders = SaleOrder::find($request->sale_order_id);
    		$sale_orders->material_issue_status = 1;
    		$sale_orders->save();
    		
    		
    		
    		$sale_order_lists = SaleOrderList::where('sale_order_id',$sale_orders->id)->get();
    
    		$project = Project::find($sale_orders->project_id);
    
    		$phase = ProjectPhase::find($sale_orders->phase_id);
    
    		//Changing Site Status of po when warehosue sending to Site
    		$purchase_order = PurchaseOrder::find($sale_orders->purchase_order_id);
    		
    		$purchase_order->site_status = 0;
    		$purchase_order->dispatch_date = date('Y-m-d');
    		$purchase_order->save();
    		
    		$total_qty = 0;
			
			foreach($available_items_lists as $available_items)
			{
				$count = count($available_items);
                $total_qty += $count;
			}
    		
    		$material_issue = MaterialIssue::create([
    			'purchase_order_id' => $purchase_order->id??null,
    			'material_request_id' => $request->material_request_id??null,
				'prefix_syntax' => $request->prefix,
				'index_digit' => $request->digit,
    			'project_id' => $sale_orders->project_id,
    			'phase_id' => $sale_orders->phase_id,
    			'item_list' => $sale_order_list,
    			'approve' => 0,
    			'approve_delivery_order' => 0,
    			'delivery_order_status' => 0,
				'total_qty' => $tot,
    			'status' => 0,
    			'warehouse_transfer_status' => 0,
    		]);
			$mi_no = $material_issue->prefix_syntax."-".sprintf("%0".$request->digit."s", $material_issue->id);
			$material_issue->material_issue_no = $mi_no;
			$material_issue->save();

    		//Change Warehouse Inventory stock
    	    foreach ($available_items_lists as $available_items) {
                foreach($available_items as $item)
    			MaterialIssueList::create([
    				'material_issue_id' => $material_issue->id,
    				'item_id' => $item->id,
    				'stock_qty' => 1,
    			]);
    
    			$selected_item = Item::find($item->id);
    			$selected_item->reserved_flag = 1;
    			$selected_item->save();
    
    		}
		}

		return response()->json([
			'material_issue' => $material_issue,
		]);

	}
}
