<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class checkout extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('cart');
        $this->load->model('product');
        $this->controller='checkout';
    }
    function index(){
        if($this->cart->total_items()<=0){
            redirect('products/');
        }
        $custData = $data = array();
        $submit=$this->input->post('placeOrder');
        if(isset($submit))
        {
            $this->form_validation->set_rules('name','Name','required');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('phone','Phone','required');
            $this->form_validation->set_rules('address','Address','required');

            $custData = array(
                'name'=>strip_tags($this->input->post('name')),
                'email'=>strip_tags($this->input->post('email')),
                'phone'=>strip_tags($this->input->post('phone')),
                'address'=>strip_tags($this->input->post('address')),

            );
            if($this->form_validation->run()==true){
                $insert=$this->product->insertcustomer($custData);
                if($insert){
                    $order=$this->placeOrder($insert);
                    if($order)
                    {
                        $this->session->set_userdata('success_msg','order placed');
                        redirect($this->controller.'/ordersu/'.$order);
                    }else{
                        $data['error_msg']='order submission failed';
                    }

                }else{
                    $data['error_msg']='some problem occured';
                }
            }

        }
        $data['custData']=$custData;
        $data['cartItems']=$this->cart->contents();
        //echo "<pre>";
        //print_r($data);ItemData
        $this->load->view($this->controller.'/index',$data);
    }
    function placeOrder ($custID){
              $ordData = array(
            'customer_id'=>$custID,
            'grand_total'=>$this->cart->total()
        );
        $insertOrder=$this->product->insertOrder($ordData);
        if($insertOrder){
           $cartItems=$this->cart->contents();
            $ordItemData=array();
            $i=0;
            foreach($cartItems as $item)
            {
                $ordItemData[$i]['order_id']=$insertOrder;
                $ordItemData[$i]['product_id']=$item['id'];
                $ordItemData[$i]['quantity']=$item['qty'];
                $ordItemData[$i]['sub_total']=$item['subtotal'];
                $i++;
            }
            if(!empty($ordItemData)){
                $insertOrderItems=$this->product->insertOrderItems($ordItemData);
                if($insertOrderItems){
                    $this->cart->destroy();
                    return $insertOrder;
                }
            }
        }return false;
    }
        public function ordersu($ordID){
            // Fetch order data from the database
            $data['order'] = $this->product->getOrder($ordID);
            // Load order details view
            $this->load->view($this->controller.'/order-success', $data);
        }
       }

