<?php
// app/models/Order.php
class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'first_name',
        'last_name',
        'state',
        'street_address',
        'town',
        'zip_code',
        'phone',
        'user_id',
        'status',
        'total_price'
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function items()
    {
        return $this->hasMany('OrderItem', 'order_id');
    }

    public function createOrder($data)
    {
        $order = new Order($data);
        $order->save();
        return $order;
    }

    public function updateOrder($id, $data)
    {
        $order = Order::find($id);
        $order->update($data);
        return $order;
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);
        $order->delete();
    }

    public function getAllOrders()
    {
        return Order::all();
    }

    public function getOrdersByUser($userId)
    {
        return Order::where('user_id', $userId)->get();
    }
}