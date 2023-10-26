<?php
namespace App\Repos;
use Illuminate\Validation\Rule;

class MenuRepo{
    public function rules(){
        return [
            'name' => 'required|max:255',
            'regular_price' => 'required|min:1|numeric',
            'sales_price' => 'nullable|lt:regular_price|numeric|min:1',
            'description' => 'nullable',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:400',
            'category' => ['required', Rule::in(['Meals', 'Sides', 'Drinks','Proteins'])],
            'slug' => 'required',
            // 'status' => ['required', Rule::in(['active', 'inactive']),],
            'vendor_id' => 'required|exists:vendors,id',
        ];
    }
}