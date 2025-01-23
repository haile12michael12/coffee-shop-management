
<?php
// app/models/Cart.php

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'name',
        'image',
        'price',
        'pro_id',
        'description',
        'quantity',
        'user_id'
    ];

    public function product()
    {
        return $this->belongsTo('Product', 'pro_id');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function addToCart($data)
    {
        $cart = new Cart($data);
        $cart->save();
        return $cart;
    }

    public function updateCart($id, $data)
    {
        $cart = Cart::find($id);
        $cart->update($data);
        return $cart;
    }

    public function deleteFromCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
    }

    public function getCartByUserId($userId)
    {
        return Cart::where('user_id', $userId)->get();
    }
}