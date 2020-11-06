<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
    <link href="http://localhost/shopping/assets/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<div class="container">
             <div class="navbar navbar-dark bg-dark">
             <a href="a" class="navbar-brand ">ORDER PREVIEW</a>
            </div>
        
    <div class="row checkout">
        <table class="table">
            <thead>
                <tr>
                     <th width="13%"></th>
                    <th width="34%">product</th>
                    <th width="18%">price</th>
                    <th width="13%">quantity</th>
                    <th width="22%">subtotal</th>
                 </tr>
            </thead>
                <tbody>
                    <?php if($this->cart->total_items()>0){foreach($cartItems as $item)?>
                        <tr>
                            <td>
                                <?php $imageURL = !empty($item["image"])?base_url('uploads/product_images/'.$item["image"]):base_url('assets/images/pro-demo-img.jpeg'); ?>
					            <img src="<?php echo $imageURL; ?>" width="75"/>
                            </td>
                            <td><?php echo $item["name"]; ?> </td>
                            <td><?php echo '$'.$item["price"]. 'USD';?>
                            <td><?php echo $item["qty"]; ?> </td>
                            <td><?php echo '$'.$item["subtotal"]. 'usd'; ?></td>
                        </tr>
                        <?php }  else { ?>
                        <tr>
                            <td colspan="5"><p> no items in your cart</p></td>
                        </tr>
                        <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"></td>
                        <?php if ($this->cart->total_items()>0){ ?>
                        <td class=" text-centre">
                            <strong>total <?php echo '$' .$this->cart->total(). 'usd';?> </strong>
                        </td>
                        <?php } ?>
                    </tr>
                </tfoot>
        </table>
            <form class="form -horizontal" method="post">
            <div class="ship info">
                <h4> shipping info</h4>
            <div class="form-group">
                <label class="control-label col-sm-2">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="<?php echo !empty($custData['name'])?$custData['name']: '' ;?>" placeholder="Enter Name">
                    <?php echo form_error('name','<p class="help-block error">','</p>');?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" value="<?php echo !empty($custData['email'])?$custData['email']: '' ;?>" placeholder="Enter Email">
                    <?php echo form_error('email','<p class="help-block error">','</p>');?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Phone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="phone" value="<?php echo !empty($custData['phone'])?$custData['phone']: '' ;?>" placeholder="Enter Phpne No.">
                    <?php echo form_error('phone','<p class="help-block error">','</p>');?>
                </div>
            </div>
            <div class="form-group">
                 <label class="control-label col-sm-2">Address:</label>
                 <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" value="<?php echo !empty($custData['address'])?$custData['address']: '' ;?>" placeholder="Enter Address">
                    <?php echo form_error('address','<p class="help-block error">','</p>');?>
                 </div>
            </div>
        </div>
        <div class="footbtn">
            <a href="<?php echo base_url('cart/');?>" class= "btn btn-warning" >back to cart</a>
            <button type="submit" name="placeOrder" class="btn btn-success orderbtn"> place order</button>
        </div>
        </form>
    </div>
</div>
</body>
</html>