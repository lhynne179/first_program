<?php

require_once('../models/product.php');

use Models\Product as P;

//controller to create product

if(isset($_POST)){
    extract($_POST);
    if(isset($_POST["function"])){
        switch($_POST["function"]){
            case "create":
                $product = new P($name,$price, $stock);
                $product->createProduct();
                $product->close();
                break;
            case "update":
                $product = new P($name,$price, $stock);
                $product->updateProduct($id);
                $product->close();
                break;
            default:
                echo $function;

        }
        
    }
    
    
    

    if(isset($_POST["delete"])){
        $product = new P();
        $product->deleteProduct($id);
        $product->close();
    }
}

//controller to find_product by name

if(isset($_GET["view"])){
   $products = NULL;
   $p = new P();
   if($_GET["view"]=='by_name'){
    
    extract($_GET);
    $products = $p->findByName($pname);   
    if(!$products==NULL){
        view_products($products);
    }
    else{
        echo "No match found for $pname.";
    }
    $p->close();
   }
   else if($_GET["view"]=='all'){
    $products = $p->all();
    if(!$products==NULL){
        view_products($products);
    }
    else{
        echo 'No products found.Add New';
    }
    $p->close();
   }
    
   ?>


<script type='text/javascript'>
            $(()=>{
                $('button.edit').click(
            function() {
                var parent = $(this).parent().parent();
                $('input[name=\'id\']').val(parent.attr('id'))
                $('input[name=\'name\']').val(parent.children('td.name').text())
                $('input[name=\'price\']').val(parent.children('td.price').text())
                $('input[name=\'stock\']').val(parent.children('td.stock').text())
                $('#staticBackdrop').modal('show');
            })
            $("button.delete").click(function(){
                var parent = $(this).parent().parent();
                
                var id = parent.attr("id")
                toastr.warning("<br /><button type='button' value='yes'>Yes</button><button type='button'  value='no' >No</button>",'Are you sure you want to delete this item?',
                {
                    positionClass: "toast-top-center",
                    allowHtml: true,
    
                    onclick: function (toast) {
                    value = toast.target.value
                    if (value == 'yes') {
                        console.log(toast.target.value, 'carai')
                        const form = new FormData();
                        form.append('id', id);
                        form.append('delete',null)
                        //ajax here to
                        
                        axios.post("./controller/product_mid.php",form)
                        .then((response)=>{
                            switch(response.data.trim()){
                                case "Successfully deleted!":
                                    toastr.success("Product ID"+id+" is "+response.data);
                                    break;
                                case "Failed to delete": toastr.warning(response.data)
                            }
                        });
                        toastr.options.hideMethod = 'yes'; 
                        parent.remove()
                      }
                    }

                })
                
                

            })
            })
</script>




   <?php


}

function view_products($products){
    foreach($products as $product){
        echo '<tr id="'.$product['pid'].'">';
          echo "<td class='id'>".$product['pid']."</td>";
          echo "<td class='name'>".$product['pname']."</td>";
          echo "<td class='price'>".$product['pprice']."</td>";
          echo "<td class='stock'>".$product['pstocks']."</td>";
          echo "<td><button type='button' class='edit btn btn-primary'>Edit</button></td>";
          echo "<td><button type='button' class='delete btn btn-danger'>Delete</buttontype=></td>";
        echo '</tr>';
    
    }

    
}
?>



