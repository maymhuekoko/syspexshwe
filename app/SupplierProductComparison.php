<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierProductComparison extends Model
{
    //
    protected $fillable = [
    'supplier_id',
            'product_id',
            'primary_flag',
            'unit_purchase_price',
            'currency_id',
            'discount_type',
            'discount_value',
            'incoterm_id',
            'last_purchase_date',
            'total_purchase_qty',
            'total_purchase_amount',
            'delivery_lead_time',
            'lead_time_type',
            'discount_condition',
            'discount_condition_value',
            'credit_term_type',
            'credit_term_value',
            'credit_condition',
            'credit_condition_value',
            'moq_price',
            'moq_qty',

            'credit_amount'
    ];
    public function supplier(){
		return $this->belongsTo('App\Supplier','supplier_id');
	}
    public function product(){
		return $this->belongsTo('App\Product','product_id');
	}
  public function incoterm()
  {
    return $this->belongsTo('App\incoterm_type','incoterm_id');
  }
  public function getDiscountTypeAttribute($discount_type) {
    switch ($discount_type) {
        case '1':
            return "No Discount";
            break;
        case '2':
            return "%percentage";
            break;
        case '3':
            return "Amount";
            break;
        case '4':
            return "FOC";
            break;
        case '5':
            return "Delivery Fee";
            break;
        

        default:
            return "NA";
            break;
    }
}
public function getDiscountConditionAttribute($discount_condition) {
  switch ($discount_condition) {
      case '1':
          return "Purchase Qty";
          break;
      case '2':
          return "Purchase Amount";
          break;
      case '3':
          return "Purchase Time";
          break;
      
      

      default:
          return "NA";
          break;
  }
}
public function getCreditTermTypeAttribute($credit_term_type) {
    switch ($credit_term_type) {
        case '1':
            return "No Credit";
            break;
        case '2':
            return "Day";
            break;
        case '3':
            return "Week";
            break;
        case '4':
            return "Month";
            break;
        
  
        default:
            return "NA";
            break;
    }
  }
  public function getCreditConditionAttribute($credit_condition) {
    switch ($credit_condition) {
        case '1':
            return "Purchase Qty";
            break;
        case '2':
            return "Purchase Amount";
            break;
        case '3':
            return "Purchase Time";
            break;
        default:
            return "NA";
            break;
    }
  }
  public function getLeadTimeTypeAttribute($lead_time_type) {
    switch ($lead_time_type) {
        case '1':
            return "Day";
            break;
        case '2':
            return "Week";
            break;
        case '3':
            return "Month";
            break;
        default:
            return "NA";
            break;
    }

  }

}
