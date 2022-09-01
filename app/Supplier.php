<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = [
    	'supplier_code','email','company_name','phone','address','category_id','available_brands',
      'department',
      'sector',
      'fax',
      'supplier_rank',
      'remark',
      'country',
      'website'
    ];

    public function getAvailableBrandAttribute($value){
    	return json_decode($value);
    }

    public function brand(){
    	return $this->belongsToMany('App\Brand');
    }

    public function assignBrand($brand) {
		return $this->brand()->attach($brand);
    }
    public function supplier_social()
    {
		return $this->belongsToMany('App\SupplierSocialType')->withPivot('id','supplier_id','social_type','social_address');

    }
}
