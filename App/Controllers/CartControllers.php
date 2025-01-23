<?php
// app/controllers/CartController.php
class CartController extends Controller
{
    public function add()
    {
        $data = array_merge($_POST, ['user_id' => Auth::user()->id]);
        $cart = (new Cart())->addToCart($data);
        redirect('/cart');
    }

    public function update($id)
    {
        $cart = (new Cart())->updateCart($id, $_POST);
        redirect('/cart');
    }

    public function remove($id)
    {
        (new Cart())->deleteFromCart($id);
        redirect('/cart');
    }

    public function index()
    {
        $userId = Auth::user()->id;
        $cartItems = (new Cart())->getCartByUserId($userId);
        $this->view('cart/index', compact('cartItems'));
    }
}