<?php
// app/controllers/ProductController.php
class ProductController extends Controller
{
    public function create()
    {
        $this->view('products/create');
    }

    public function store()
    {
        $product = (new Product())->createProduct($_POST);
        redirect('/products');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $this->view('products/edit', compact('product'));
    }

    public function update($id)
    {
        $product = (new Product())->updateProduct($id, $_POST);
        redirect('/products');
    }

    public function destroy($id)
    {
        (new Product())->deleteProduct($id);
        redirect('/products');
    }

    public function index()
    {
        $products = (new Product())->getAllProducts();
        $this->view('products/index', compact('products'));
    }

    public function productsByType($type)
    {
        $products = (new Product())->getProductsByType($type);
        $this->view('products/type', compact('products', 'type'));
    }
}