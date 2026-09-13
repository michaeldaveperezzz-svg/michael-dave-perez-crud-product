<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->model('ProductModel');
    }

    // =========================
    // PRODUCT LIST
    // =========================
    public function index()
    {
        $data['products'] = $this->ProductModel->get_all_products();

        $this->call->view('products/index', $data);
    }


    // =========================
    // CREATE PRODUCT
    // =========================
    public function create()
    {
        if ($this->io->method() === 'post') {

            $data = [
                'product_name' => $this->io->post('product_name'),
                'description'  => $this->io->post('description'),
                'price'        => $this->io->post('price'),
                'quantity'     => $this->io->post('quantity')
            ];

            $this->ProductModel->create_product($data);

            redirect('products');
            exit;
        }

        $this->call->view('products/create');
    }


    // =========================
    // EDIT PRODUCT
    // =========================
    public function edit($id)
    {
        // Kunin ang product gamit ang ID
        $product = $this->ProductModel->get_product($id);

        // Kapag walang product
        if (!$product) {
            show_404();
            return;
        }

        // Kapag nag-submit ng update
        if ($this->io->method() === 'post') {

            $data = [
                'product_name' => $this->io->post('product_name'),
                'description'  => $this->io->post('description'),
                'price'        => $this->io->post('price'),
                'quantity'     => $this->io->post('quantity')
            ];

            $this->ProductModel->update_product($id, $data);

            redirect('products');
            exit;
        }

        // IPASA ANG PRODUCT SA EDIT VIEW
        $data['product'] = $product;

        $this->call->view('products/edit', $data);
    }


    // =========================
    // DELETE PRODUCT
    // =========================
    public function delete($id)
    {
        $product = $this->ProductModel->get_product($id);

        if (!$product) {
            show_404();
            return;
        }

        $this->ProductModel->delete_product($id);

        redirect('products');
        exit;
    }
}