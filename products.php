<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class products extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('product');
    }
    function index(){
        $data=array();
        $data['products']= $this->product->getrows();
        $this->load->view('index',$data);
    }
    function addToCart($proID){
        $product=$this->product->getrows($proID);
        $data = array(
            'id'=>$product['id'],
            'qty'=>1,
            'price'=>$product['price'],
            'name'=>$product['name'],
            'image'=>$product['image']
        );
        $this->cart->insert($data);
        redirect ('cart/');
    }
}