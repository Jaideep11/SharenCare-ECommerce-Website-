<?php
 if(isset($_SERVER['HTTP_REFERER']))
        {
              include_once'includes/dbh.inc.php';
            include_once'session_check_user.php';
            include_once'LSHeader.php';
            // include_once'Cs/display_product.css.php';

            if (isset($_GET['del']))
            {
                if($_GET['del']=="success")
                {
                    echo "<p style='color:green; font-size:20px'><center>Product Deleted Successfully!</center></p>";
                }
                else if ($_GET['del']=="failed") 
                {
                    $pid=$_GET['pid'];
                    echo "<p style='color:red; font-size:20px'><center>Error Deleting Product?pid=".$pid."!<center></p>";
                }
            }

           else if (isset($_GET['update']))
            {
                if($_GET['update']=="success")
                {
                    echo "<p style='color:green; font-size:20px'><center>Update Successfully!</center></p>";
                }
                else if ($_GET['update']=="failed") 
                {
                    
                    echo "<p style='color:red; font-size:20px'><center>Error Updating!<center></p>";
                }
            }

            else if (isset($_GET['add']))
            {
                if($_GET['add']=="success")
                {
                    echo "<p style='color:green; font-size:20px'><center>Product Added !</center></p>";
                }
                else if ($_GET['add']=="failed") 
                {
                    
                    echo "<p style='color:red; font-size:20px'><center>Error Adding Product!<center></p>";
                }
            }

            if(isset($_SESSION["email"]))
            {
                $accID=$_SESSION["accountid"];
                
                $sql="SELECT ref_id from refowner where seler_id= $accID || buyer_id=  $accID || doner_id=$accID ;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0)
                {
                    if($row = $result->fetch_assoc())
                    {
                        $refID=$row['ref_id'];
                    }
                    else if (!$row=mysqli_fetch_assoc($result))
                    {
                        echo "Account ID not found ?show-all-products  ".$accID."<br>";
                        exit();
                    }
                  }

                  if($Doner || $Borrower)
                    $sql="SELECT * from donate_product where donerid=$refID";
                  else
                    $sql="call product_seller($refID)";
                    $result = $conn->query($sql);



?>


<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" type="text/css" href="Cs/show_all_products.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container ">
    <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            
                            <?php if(!$Doner && !$Borrower){
                            ?>
                            <th style="width:50%">Product</th>
                            <th style="width:10%">Price</th>
                            <th style="width:-20%"></th>
                            <th style="width:20%" >Added</th>
                            <th style="width:-10%"></th>
                            <th style="width:10%">Actions</th>
                            <?php
                                }
                                else
                                {?>
                                 
                                <th style="width:50%">Product</th>
                            <th style="width:10%" class="text-center"></th>
                            <th style="width:-10%" class="text-center">Added</th>
                            <th style="width:10%"></th>
                            <th style="width:-10%">Actions</th>
                            <th style="width:0%"></th>
                                <?php
                                }
                            ?>
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                <?php
                    if ($result->num_rows > 0)
                    {
                        while($row = $result->fetch_assoc())
                        {
                            if($Doner||$Borrower)
                            {
                                $row["car_name"]=$row["dpname"];
                                $row["img_1"]=$row["pro_img"];
                                $row["product_id"]=$row["dpid"];
                                $pdate="<td>" . date('d-m-Y', strtotime($row['entry_date'])) . "</td>";

                            }
                            else
                            $pdate="<td>" . date('d-m-Y', strtotime($row['date_time'])) . "</td>";
                            $pid=$row["product_id"];
                            ?>
                    <tbody>
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                        <div class="col-sm-2 hidden-xs"><img style="width: 250px !important; height:150px; " src="<?php echo $row['img_1'];?>" alt="..." class="img-responsive"/></div>
                                    <div class="col-sm-10">
                                        <section class="move">
                                        <h4 class="nomargin"><?php echo $row["car_name"] ?></h4>
                                        <p><?php echo $row["pdescription"]?></p>
                                    </div>
                                    </section>
                                </div>
                            </td>

                            <?php if(!$Doner && !$Borrower) {?>
                            <td data-th="Price"><strong>Rs. <?php echo $row["price"]; ?></strong></td>
                            <?php
                                }      
                            ?>
                            <td data-th="Quantity">
                                <p ><?php echo $pdate; ?></p>
                            </td>
                            <td data-th="Subtotal" class="text-center"></td>
                            <td class="actions" data-th="">
                            <?php
                                if($Doner || $Borrower)
                                {
                                    ?>   
                                    <a href="doner_edit_product.php?req=<?php echo $row['product_id'];?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                               <?php
                                }    
                                else
                                {
                                    ?>

                                    <a href="edit_product.php?req=<?php echo $pid;?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>

                                     
                                    <?php
                                }
                                ?>
                            
                            
                    <a href="includes/delete_product.inc.php?req=<?php echo $pid ?>"><button class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure You Want To Delete This Product?')"><i class="fa fa-trash-o"></i> </button></a>
                                    

                            </td>
                        </tr>
                    </tbody>
                    
                    <?php
                        }
                    }
                     else if (!$row=mysqli_fetch_assoc($result))
                        {
                            echo "Error Sql:".$sql -> error;
                            exit();
                        }
                    
                    else
                    {
                        echo "No Record Found";
                        exit();
                    }

                }   //issetof email
                else
                {
                    header('location: login.php?show-all-products');
                }
            

?>
                    <tfoot>
                        <tr>
                            <td ><a href="#" class="btn btn-warning btn-block" style="height:auto;
    width:200px;"> Previous <i class="fa fa-angle-left"></i></a></td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td><a href="#" class="btn btn-success btn-block">Next <i class="fa fa-angle-right"></i></a></td>
                        </tr>
                    </tfoot>
                </table>
</div>
</div>
</div>
</div>

<?php
include_once'footer.php';
}
else
{
    header('location: index.php');
    exit();
}
?>