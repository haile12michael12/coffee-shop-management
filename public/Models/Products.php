<?php
// app/models/Product.php
class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'type'
    ];

    public function carts()
    {
        return $this->hasMany('Cart', 'pro_id');
    }

    public function createProduct($data)
    {
        $product = new Product($data);
        $product->save();
        return $product;
    }

    public function updateProduct($id, $data)
    {
        $product = Product::find($id);
        $product->update($data);
        return $product;
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProductsByType($type)
    {
        return Product::where('type', $type)->get();
    }
}