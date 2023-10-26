<?php
    session_start();
    $sessionId = $_SESSION['id'] ?? '';
    $sessionRole = $_SESSION['role'] ?? '';
    echo "$sessionId $sessionRole";
    if ( !$sessionId && !$sessionRole ) {
        header( "location:login.php" );
        die();
    }

    ob_start();

    include_once "config.php";
    $connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if ( !$connection ) {
        echo mysqli_error( $connection );
        throw new Exception( "Database cannot Connect" );
    }

    $id = $_REQUEST['id'] ?? 'dashboard';
    $action = $_REQUEST['action'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1024">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Dashboard</title>
</head>

<body style="background-image: url('images/img.jpg'); background-repeat:no-repeat; background-size:100% 100%">
    <!--------------------------------- Secondary Navber -------------------------------->
    <section class="topber">
        <div class="topber__title">
            <span class="topber__title--text">
                <?php
                    if ( 'dashboard' == $id ) {
                        echo "DashBoard";
                    } elseif ( 'addStock' == $id ) {
                        echo "Add Stock";
                    } elseif ( 'allStock' == $id ) {
                        echo "All Stock";
                    } elseif ( 'addPharmacist' == $id ) {
                        echo "Add Pharmacist";
                    } elseif ( 'allPharmacist' == $id ) {
                        echo "Pharmacists";
                    } elseif ( 'addBill' == $id ) {
                        echo "Add Bill";
                    } elseif ( 'allBill' == $id ) {
                        echo "View Bill";
                    } elseif ( 'userProfile' == $id ) {
                        echo "Your Profile";
                    // } elseif ( 'editManager' == $action ) {
                    //     echo "Edit Manager";
                    } elseif ( 'editPharmacist' == $action ) {
                        echo "Edit Pharmacist";
                    // } elseif ( 'editSalesman' == $action ) {
                    //     echo "Edit Salesman";
                    }
                ?>

            </span>
        </div>

        <div class="topber__profile">
            <?php
                $query = "SELECT fname,lname,role,avatar FROM {$sessionRole}s WHERE id='$sessionId'";
                $result = mysqli_query( $connection, $query );

                if ( $data = mysqli_fetch_assoc( $result ) ) {
                    $fname = $data['fname'];
                    $lname = $data['lname'];
                    $role = $data['role'];
                    $avatar = $data['avatar'];
                ?>
               <?php if($role =='admin') {
                   ?><img src="assets/img/images.png" height="25" width="25" class="rounded-circle" alt="profile">
                   <div class="dropdown">
<?php
               }
               else
               {
?>
<img src="assets/img/pharma.png" height="25" width="25" class="rounded-circle" alt="profile">
                   <div class="dropdown">
                       <?php
               }
            ?>

                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <?php
                        echo "$fname $lname (" . ucwords( $role ) . " )";
                        }
                    ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="index1.php">Dashboard</a>
                    <a class="dropdown-item" href="index1.php?id=userProfile">Profile</a>
                    <a class="dropdown-item" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </section>
    <!--------------------------------- Secondary Navber -------------------------------->


    <!--------------------------------- Sideber -------------------------------->
    <section id="sideber" class="sideber">
        <ul class="sideber__ber">
            <h3 class="sideber__panel"><i id="left" class="fas fa-laptop-medical"></i> PMS</h3>
            <li id="left" class="sideber__item<?php if ( 'dashboard' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="index1.php?id=dashboard"><i id="left" class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <?php if ( 'admin' == $sessionRole ) {?>
            <li id="left" class="sideber__item <?php if ( 'addPharmacist' == $id ) {
                                                                            echo " active";
                                                                        }?>">
                <a href="index1.php?id=addPharmacist"><i id="left" class="fas fa-user-plus"></i></i>Add Pharmacist</a>
            </li><?php }?>
            <li id="left" class="sideber__item<?php if ( 'allPharmacist' == $id ) {
    echo " active";
}?>">
                <a href="index1.php?id=allPharmacist"><i id="left" class="fas fa-user"></i>All Pharmacist</a>
            </li>
            <?php if ('pharmacist' == $sessionRole ) {?>
            <!-- For Admin, Manager, Pharmacist-->
            <!-- Only For Admin -->
            <li id="left" class="sideber__item <?php if ( 'addStock' == $id ) {
                                                                            echo " active";
                                                                        }?>">
                <a href="index1.php?id=addStock"><i id="left" class="fas fa-user-plus"></i></i>Add Stock</a>
            </li><?php }?>
            <li id="left" class="sideber__item <?php if ( 'addStock' == $id ) {
    echo " active";
}?>">
                <a href="index1.php?id=allStock"><i id="left" class="fas fa-user"></i>All Stock</a>
            </li>
            <?php if ( 'pharmacist' == $sessionRole  ) {?>
            <!-- For Admin, Manager -->
            <li id="left" class="sideber__item <?php if ( 'addBill' == $id ) {
                                                                            echo " active";
                                                                        }?>">
                <a href="index1.php?id=addBill"><i id="left" class="fas fa-user-plus"></i>Add Bill</a>
            </li><?php }?>
            <li id="left" class="sideber__item<?php if ( 'allBill' == $id ) {
    echo " active";
}?>">
                <a href="index1.php?id=allBill"><i id="left" class="fas fa-user"></i>View Bill</a>
            </li>
        </ul>
        <footer class="text-center">Pharmacy Management System</footer>
    </section>
    <!--------------------------------- #Sideber -------------------------------->


    <!--------------------------------- Main section -------------------------------->
    <section class="main" >
        <div class="container">

            <!-- ---------------------- DashBoard ------------------------ -->
            <?php if ( 'dashboard' == $id ) {?>
            <div class="dashboard p-5">
                <div class="total">
                    <div class="row">
                        <div class="col-3">
                            <div class="total__box text-center">
                                <h1>2453</h1>
                                <h2>Total Sell</h2>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="total__box text-center">
                                <h1>
                                    <?php
                                            $query = "SELECT COUNT(*) totalStock FROM stock_master;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalStock = mysqli_fetch_assoc( $result );
                                                echo $totalStock['totalStock'];
                                               
                                            ?>
                                </h1>
                                <h2>Stock</h2>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="total__box text-center">
                                <h1>
                                    <?php
                                            $query = "SELECT COUNT(*) totalPharmacist FROM pharmacists;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalPharmacist = mysqli_fetch_assoc( $result );
                                                echo $totalPharmacist['totalPharmacist'];
                                            ?>

                                </h1>
                                <h2>Pharmacist</h2>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="total__box text-center">
                                <h1><?php
                                            $query = "SELECT COUNT(*) totalBill FROM bill_master;";
                                                $result = mysqli_query( $connection, $query );
                                                $totalBill = mysqli_fetch_assoc( $result );
                                            echo $totalBill['totalBill'];
                                            ?></h1>
                                <h2>Sales</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
            <!-- ---------------------- DashBoard ------------------------ -->

            <!-- ---------------------- Stock Master ------------------------ -->
            <div class="Stock">
                <?php if ( 'allStock' == $id ) {?>
                <div class="allStock">
                    <div class="main__table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">Avater</th> -->
                                    <th scope="col">Med name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col"> Category</th>
                                    <th scope="col"> Quantity</th>
                                    <th scope="col"> Entry date</th>
                                    <th scope="col"> Manufacture date</th>
                                    <th scope="col"> Expiry date</th>
                                    <th scope="col"> Description</th>
                                    <?php if ( 'pharmacist' == $sessionRole ) {?>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                    <?php }?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                        $Stock_master = "SELECT * FROM stock_master";
                                         $result = mysqli_query( $connection, $Stock_master );

                                        while ( $stock = mysqli_fetch_assoc( $result ) ) {?>

                                <tr>
                                    <!-- <td>
                                        <center><img class="rounded-circle" width="40" height="40"
                                                src="assets/img/Medicines.jpg"></center>
                                    </td> -->
                                    <td><?php printf( "%s", $stock['med_name'] );?></td>
                                    <td><?php  echo "₹"; printf( "%s", $stock['med_price'] );?></td>
                                    <td><?php printf( "%s", $stock['med_category'] );?></td>
                                    <td><?php printf( "%s", $stock['med_quantity'] );?></td>
                                    <td><?php printf( "%s", $stock['med_entry_date'] );?></td>
                                    <td><?php printf( "%s", $stock['med_manufacture_date'] );?></td>
                                    <td><?php printf( "%s", $stock['med_expiry_date'] );?></td>
                                    <td><?php printf( "%s", $stock['med_description'] );?></td>
                                    <?php if ( 'pharmacist' == $sessionRole ) {?>
                                    <!-- Only For Admin -->
                                    <td><?php printf( "<a href='index1.php?action=editStock&med_d=%s'><i class='fas fa-edit'></i></a>", $stock['med_id'] )?>
                                    </td>
                                    <td><?php printf( "<a class='delete' href='index1.php?action=deleteStock&med_id=%s'><i class='fas fa-trash'></i></a>", $stock['med_id'] )?>
                                    </td>
                                    <?php }?>
                                </tr>

                                <?php }?>

                            </tbody>
                        </table>


                    </div>
                </div>
                <?php }?>

                <?php if ( 'addStock' == $id ) {?>
                <div class="addStock">
                    <div class="main__form">
                        <div class="main__form--title text-center">Add Stock</div>
                        <form action="add.php" method="POST">
                            <div class="form-row">
                                <div class="col col-12">
                                    <!-- <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="First name" required>
                                        </label> -->
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="med_name" placeholder="Medicine name" required>
                                    </label>
                                </div>
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-rupee-sign"></i>
                                            <input type="number" name="med_price" placeholder="Selling Price" required>
                                        </label>
                                    </div>
                                <div class="col col-12">
                                    <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <!-- <input type="text" name="med_category" placeholder="Medicine Category" required> -->
                                            <i id="left" class="fas fa-envelope"></i>
                                            <select name="med_category">
                                            <option value="Liquid">Liquid</option>
                                            <option value="Tablet">Tablet</option>  
                                            <option value="Capsules">Capsules</option>
                                            <option value="Topical medicines">Topical medicines</option>
                                            <option value="Suppositories">Suppositories</option>
                                            <option value="Drops">Drops</option>
                                            <option value="Inhalers">Inhalers</option>
                                            <option value="Injections">Injections</option>
                                         </select>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-book-medical"></i>
                                        <input type="number" name="med_quantity" placeholder="Medicine Quantity"
                                            required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-calendar-alt"></i>
                                        <input type="text" name="med_entry_date" onfocus="(this.type = 'date')"
                                            placeholder="Medicine Entry Date" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class=" fas fa-calendar-alt"></i>
                                        <input type="text" name="med_manufacture_date" onfocus="(this.type = 'date')"
                                            placeholder="Medicine Manufacture Date" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fas fa-calendar-alt"></i>
                                        <input type="text" name="med_expiry_date" onfocus="(this.type = 'date')"
                                            placeholder="Medicine Expiry Date" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-comment-medical"></i>
                                        <input type="text" name="med_description" placeholder="Medicine Description"
                                            required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <!-- <label class="input">
                                            <i id="left" class="fas fa-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                            <i id="pwd" class="fas fa-eye right"></i>
                                        </label> -->
                                </div>
                                <input type="hidden" name="action" value="addStock">
                                <div class="col col-12">
                                    <input type="submit" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <?php }?>
                <?php if ( 'editStock' == $action ) {
                        $stockID = $_REQUEST['id'];
                        $selectStock_master = "SELECT * FROM stock_master WHERE med_id='{$stockID}'";
                        $result = mysqli_query( $connection, $selectStock_master );

                    $stock = mysqli_fetch_assoc( $result );?>
                <div class="addStock">
                    <div class="main__form">
                        <div class="main__form--title text-center">Update Stock</div>
                        <form action="add.php" method="POST">
                            <div class="form-row">
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="med_name" placeholder="Medicine name"
                                            value="<?php echo $stock['med_name']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="med_category" placeholder="Medicine Category"
                                            value="<?php echo $stock['med_category']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-envelope"></i>
                                        <input type="number" name="med_quantity" placeholder="Medicine Quantity"
                                            value="<?php echo $stock['med_quantity']; ?>" required>
                                    </label>
                                </div>
                                <!-- <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" value="<?php echo $manager['phone']; ?>" required>
                                        </label>
                                    </div> -->
                                <input type="hidden" name="action" value="updateStock">
                                <input type="hidden" name="id" value="<?php echo $stockId; ?>">
                                <div class="col col-12">
                                    <input type="submit" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php }?>

                <?php if ( 'deleteStock' == $action ) {
                        $stockID = $_REQUEST['med_id'];
                        $deleteStock = "DELETE FROM stock_master WHERE med_id ='{$stockID}'";
                        $result = mysqli_query( $connection, $deleteStock );
                        header( "location:index1.php?id=allStock" );
                }?>
            </div>
            <!-- ---------------------- Stock Master ------------------------ -->

            <!-- ---------------------- Pharmacist ------------------------ -->
            <div class="pharmacist">
                <?php if ( 'allPharmacist' == $id ) {?>
                <div class="allPharmacist">
                    <div class="main__table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <?php if ( 'admin' == $sessionRole || 'manager' == $sessionRole ) {?>
                                    <!-- For Admin, Manager -->
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                    <?php }?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                        $getPharmacist = "SELECT * FROM pharmacists";
                                            $result = mysqli_query( $connection, $getPharmacist );

                                        while ( $pharmacist = mysqli_fetch_assoc( $result ) ) {?>

                                <tr>
                                    <td>
                                        <center><img class="rounded-circle" width="40" height="40"
                                                src="assets/img/<?php echo $pharmacist['avatar']; ?>" alt=""></center>
                                    </td>
                                    <td><?php printf( "%s %s", $pharmacist['fname'], $pharmacist['lname'] );?></td>
                                    <td><?php printf( "%s", $pharmacist['email'] );?></td>
                                    <td><?php printf( "%s", $pharmacist['phone'] );?></td>
                                    <td><?php printf( "%s", $pharmacist['address'] );?></td>
                                    <?php if ( 'admin' == $sessionRole || 'manager' == $sessionRole ) {?>
                                    <!-- For Admin, Manager -->
                                    <td><?php printf( "<a href='index1.php?action=editPharmacist&id=%s'><i class='fas fa-edit'></i></a>", $pharmacist['id'] )?>
                                    </td>
                                    <td><?php printf( "<a class='delete' href='index1.php?action=deletePharmacist&id=%s'><i class='fas fa-trash'></i></a>", $pharmacist['id'] )?>
                                    </td>
                                    <?php }?>
                                </tr>

                                <?php }?>

                            </tbody>
                        </table>


                    </div>
                </div>
                <?php }?>

                <?php if ( 'addPharmacist' == $id ) {?>
                <div class="addPharmacist">
                    <div class="main__form">
                        <div class="main__form--title text-center">Add New Pharmacist</div>
                        <form action="add.php" method="POST">
                            <div class="form-row">
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="fname" placeholder="First name" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="lname" placeholder="Last Name" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-envelope"></i>
                                        <input type="username" name="username" placeholder="Username" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-key"></i>
                                        <input id="pwdinput" type="password" name="password" placeholder="Password"
                                            required>
                                        <i id="pwd" class="fas fa-eye right"></i>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-envelope"></i>
                                        <input type="email" name="email" placeholder="email" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-phone-alt"></i>
                                        <input type="text" maxlength="10"  pattern="^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$"  
                                            title="Please enter number starts from 7,8 or 9" name="phone" placeholder="Phone"
                                            required>
                                    </label>
                                </div>
                                <!-- pattern="\d{10}" -->
                                <!--<div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="radio" name="rd_gender" placeholder="Gender"  value="male" required>Male
                                            <input type="radio" name="rd_gender" placeholder="Gender"  value="female" required>Female
                                        </label>
                                    </div>-->
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-address-book"></i>
                                        <input type="text" name="address" placeholder="Address" required>
                                    </label>
                                </div>
                                <input type="hidden" name="action" value="addPharmacist">
                                <div class="col col-12">
                                    <input type="submit" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <?php }?>

                <?php if ( 'editPharmacist' == $action ) {
                        $pharmacistID = $_REQUEST['id'];
                        $selectPharmacist = "SELECT * FROM pharmacists WHERE id='{$pharmacistID}'";
                        $result = mysqli_query( $connection, $selectPharmacist );

                    $pharmacist = mysqli_fetch_assoc( $result );?>
                <div class="addManager">
                    <div class="main__form">
                        <div class="main__form--title text-center">Update Pharmacist</div>
                        <form action="add.php" method="POST">
                            <div class="form-row">
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="fname" placeholder="First name"
                                            value="<?php echo $pharmacist['fname']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-user-circle"></i>
                                        <input type="text" name="lname" placeholder="Last Name"
                                            value="<?php echo $pharmacist['lname']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-envelope"></i>
                                        <input type="email" name="email" placeholder="Email"
                                            value="<?php echo $pharmacist['email']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-phone-alt"></i>
                                        <input type="number" name="phone" placeholder="Phone"
                                            value="<?php echo $pharmacist['phone']; ?>" required>
                                    </label>
                                </div>
                                <input type="hidden" name="action" value="updatePharmacist">
                                <input type="hidden" name="id" value="<?php echo $pharmacistID; ?>">
                                <div class="col col-12">
                                    <input type="submit" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php }?>

                <?php if ( 'deletePharmacist' == $action ) {
                        $pharmacistID = $_REQUEST['id'];
                        $deletePharmacist = "DELETE FROM pharmacists WHERE id ='{$pharmacistID}'";
                        $result = mysqli_query( $connection, $deletePharmacist );
                        header( "location:index1.php?id=allPharmacist" );
                }?>
            </div>
            <!-- ---------------------- Pharmacist ------------------------ -->

            <!-- ---------------------- bill_master ------------------------ -->

            <div class="bill">
                <?php if ( 'allBill' == $id ) {?>
                <div class="allBill">
                    <div class="main__table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Doctor Name</th>
                                    <th scope="col">Medicine Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Payment Type</th>
                                    <th scope="col">Quantity</th>
                                    <?php if ( 'pharmacist' == $sessionRole ) {?>
                                    <!-- For Admin, Manager, Pharmacist -->
                                    <!-- <th scope="col">Edit</th> -->
                                    <th scope="col">PDF</th>
                                    <th scope="col">DELETE</th>
                                    <?php }?>
                                    
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                        $getBill_master = "SELECT * FROM bill_master";
                                            $result = mysqli_query( $connection, $getBill_master );

                                        while ( $bill = mysqli_fetch_assoc( $result ) ) {?>

                                <tr>
                                    <!-- <td>
                                                <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $salesman['avatar']; ?>" alt=""></center>
                                            </td> -->
                                    <td><?php printf( "%s",$bill['customer_name'] );?></td>
                                    <td><?php printf("%s", $bill['doctor'] );?></td>
                                    <td><?php printf( "%s", $bill['med_name'] );?></td>
                                    <td><?php printf( "%s", $bill['bill_date'] );?></td>
                                    <td><?php printf( "%s",$bill['payment_type'] );?></td>
                                    <td><?php printf( "%s", $bill['med_quantity'] );?></td>
                                    <?php if ('pharmacist' == $sessionRole ) {?>
                                    <!-- For Admin, Manager, Pharmacist -->
                                    <form  method="get" action="pdf.php">
                         <input type="hidden" name="name" value="<?php echo $bill['customer_name']?>">
                         <input type="hidden" name="doctor" value="<?php echo $bill['doctor']?>">
                         <input type="hidden" name="medicine" value="<?php echo $bill['med_name']?>">
                         <input type="hidden" name="quantity" value="<?php echo $bill['med_quantity']?>">    
                         <input type="hidden" name="payment_type" value="<?php echo $bill['payment_type']?>">
                         <input type="hidden" name="date" value="<?php echo $bill['bill_date']?>">
                         <style>
       
        button {
           
           
            border: none;
            cursor: pointer;
            outline: none;
        }
    </style>
                         <td><button   type="submit"  ><i class='fas fa-file-pdf' style="margin:auto; display:block;"></i></button></td>
                        
                     </form>
                                    <!-- <td><?php printf( "<a class='editBill' href='index1.php?action=editBill&id=%s'><i class='fas fa-edit'></i></a>", $bill['bill_id'] )?></td> -->
                                    <td><?php printf( "<a class='delete' href='index1.php?action=deleteBill&billid=%s'><i class='fas fa-trash'></i></a>", $bill['bill_id'] )?>
                                   
                                    <?php }?>
                                </tr>

                                <?php }?>

                            </tbody>
                        </table>


                    </div>
                </div>
                <?php }?>

                <?php if ( 'addBill' == $id ) {?>
                    <div class="addBill">
                        <div class="main__form">
                            <div class="main__form--title text-center">Add Bill</div>
                            <form action="add.php" method="POST">
                            <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="customer_name" placeholder="Customer Name" required>
                                        </label>
                                        <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="doctor" placeholder="Doctor Name" required>
                                        </label>
                                
                                    </div>
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-briefcase-medical"></i>
                                            <form action="" method="GET">
                                            <input type="text" id="med_name" name="med_name" placeholder="Medicine Name" onkeyup="GetDetail(this.value)" value="" required>
                                            
                                        </label>
                                    </div>
                                    
  



 
      
    
    

                                    <!-- <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-briefcase-medical"></i>
                                            <input type="number" id="med_price" name="med_price" placeholder="Price" required>
                                        </label>
                                    </div> -->
                                   
                                    <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="number" name="med_quantity" placeholder="Medicine Quantity" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                         <label class="input">
                                            <i id="left" class="fas fa-calendar-alt"></i>
                                            <input type="text" name="bill_date" onfocus="(this.type = 'date')"
                                            placeholder="Bill Date" required>
                                        </label> 
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                        <i id="left" class="fa fa-credit-card"></i>
                                         <select name="payment_type">
                                            <option value="Cash">Cash</option>
                                            <option value="Card">Card</option>  
                                         </select>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <!-- <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" required>
                                        </label> -->
                                    </div>
                                    <div class="col col-12">
                                        <!-- <label class="input">
                                            <i id="left" class="fas fa-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                        </label> -->
                                    </div>
                                    <input type="hidden" name="action" value="addBill">
                                    <div class="col col-12">
                                        <input type="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>






                        

                </div>
                <?php }?>

                <!-- <?php if ( 'editBill' == $action ) {
                        $billID = $_REQUEST['id'];
                        $selectBill = "SELECT * FROM bill_master WHERE id='{$billID}'";
                        $result = mysqli_query( $connection, $selectBill );

                    $bill = mysqli_fetch_assoc( $result );?>
                    <div class="addManager">
                        <div class="main__form">
                            <div class="main__form--title text-center">Update bill</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="customer_name" placeholder="Customer name" value="<?php echo $bill['customer_name']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="bill_date" placeholder="Bill Date" value="<?php echo $bill['bill_date']; ?>" required>
                                        </label>
                                    </div>
                                    <!-- <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="payment_type" placeholder="Email" value="<?php echo $salesman['payment_type']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" value="<?php echo $salesman['phone']; ?>" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="updateSalesman">
                                    <input type="hidden" name="id" value="<?php echo $salesmanID; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Update">
                                    </div>
                                </div> -->
                </form>
            </div>
        </div>
        <?php }?> -->

        
                     
                     
                     <?php
                      if ( 'deleteBill' == $action ) {
                        $billID = $_REQUEST['billid'];
                        $deleteBill = "DELETE FROM bill_master WHERE bill_id ='{$billID}'";
                        $result = mysqli_query( $connection, $deleteBill );
                        header( "location:index1.php?id=allBill" );
                        ob_end_flush();
                } 
               
                
               ?>
        </div>

        <!-- ---------------------- bill_master ------------------------ -->

        <!-- ---------------------- User Profile ------------------------ -->
        <?php if ( 'userProfile' == $id ) {
                    $query = "SELECT * FROM {$sessionRole}s WHERE id='$sessionId'";
                    $result = mysqli_query( $connection, $query );
                    $data = mysqli_fetch_assoc( $result )
                ?>
        <div class="userProfile">
            <div class="main__form myProfile">
                <form action="index1.php">
                    <div class="main__form--title myProfile__title text-center">My Profile</div>
                    <div class="form-row text-center">
                        <div class="col col-12 text-center pb-3">
                           <?php if($role == 'admin'){?>
                            <img src="assets/img/images.png" class="img-fluid rounded-circle" alt="">
                           <?php }
                            else{?>
                                <img src="assets/img/image 2.png" class="img-fluid rounded-circle" alt="">
                          <?php   } ?>
                        </div>
                        <div class="col col-12">
                            <h4><b>Full Name : </b><?php printf( "%s %s", $data['fname'], $data['lname'] );?></h4>
                        </div>
                        <div class="col col-12">
                            <h4><b>UserName : </b><?php printf( "%s", $data['username']);?></h4>
                        </div>
                        <div class="col col-12">
                            <h4><b>Email : </b><?php printf( "%s", $data['email'] );?></h4>
                        </div>
                        <div class="col col-12">
                            <h4><b>Phone : </b><?php printf( "%s", $data['phone'] );?></h4>
                        </div>
                        <input type="hidden" name="id" value="userProfileEdit">
                        <div class="col col-12">
                            <input class="updateMyProfile" type="submit" value="Update Profile">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php }?>

        <?php if ( 'userProfileEdit' == $id ) {
                    $query = "SELECT * FROM {$sessionRole}s WHERE id='$sessionId'";
                    $result = mysqli_query( $connection, $query );
                    $data = mysqli_fetch_assoc( $result )
                ?>


        <div class="userProfileEdit">
            <div class="main__form">
                <div class="main__form--title text-center">Update My Profile</div>
                <form enctype="multipart/form-data" action="add.php" method="POST">
                    <div class="form-row">
                        <div class="col col-12 text-center pb-3">
                            <img id="pimg" src="assets/img/<?php echo $data['avatar']; ?>"
                                class="img-fluid rounded-circle" alt="">
                            <i class="fas fa-pen pimgedit"></i>
                            <input
                                onchange="document.getElementById('pimg').src = window.URL.createObjectURL(this.files[0])"
                                id="pimgi" style="display: none;" type="file" name="avatar">
                        </div>
                        <div class="col col-12">
                            <?php if ( isset( $_REQUEST['avatarError'] ) ) {
                                            echo "<p style='color:red;' class='text-center'>Please make sure this file is jpg, png or jpeg</p>";
                                    }?>
                        </div>
                        <div class="col col-12">
                            <label class="input">
                                <i id="left" class="fas fa-user-circle"></i>
                                <input type="text" name="fname" placeholder="First name"
                                    value="<?php echo $data['fname']; ?>" required>
                            </label>
                        </div>
                        <div class="col col-12">
                            <label class="input">
                                <i id="left" class="fas fa-user-circle"></i>
                                <input type="text" name="lname" placeholder="Last Name"
                                    value="<?php echo $data['lname']; ?>" required>
                            </label>
                        </div>
                        <div class="col col-12">
                            <label class="input">
                                <i id="left" class="fas fa-user-circle"></i>
                                <input type="text" name="username" placeholder="UserName"
                                    value="<?php echo $data['username']; ?>" required>
                            </label>
                        </div>
                        <div class="col col-12">
                            <label class="input">
                                <i id="left" class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Email"
                                    value="<?php echo $data['email']; ?>" required>
                            </label>
                        </div>
                        <div class="col col-12">
                            <label class="input">
                                <i id="left" class="fas fa-phone-alt"></i>
                                <input type="number" name="phone" placeholder="Phone"
                                    value="<?php echo $data['phone']; ?>" required>
                            </label>
                        </div>
                        <div class="col col-12">
                            <label class="input">
                                <i id="left" class="fas fa-key"></i>
                                <input id="pwdinput" type="password" name="oldPassword" placeholder="Old Password"
                                    required>
                                <i id="pwd" class="fas fa-eye right"></i>
                            </label>
                        </div>
                        <div class="col col-12">
                            <label class="input">
                                <i id="left" class="fas fa-key"></i>
                                <input id="pwdinput" type="password" name="newPassword" placeholder="New Password"
                                    required>
                                <p>Type Old Password if you don't want to change</p>
                                <i id="pwd" class="fas fa-eye right"></i>
                            </label>
                        </div>
                        <input type="hidden" name="action" value="updateProfile">
                        <div class="col col-12">
                            <input type="submit" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php }?>
        <!-- ---------------------- User Profile ------------------------ -->

        </div>

    </section>

    <!--------------------------------- #Main section -------------------------------->



    <!-- Optional JavaScript -->
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom Js -->
    <script src="./assets/js/app.js"></script>
</body>

</html>

</html>
</html>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
 
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- Bootstrap Css -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body> 
<div class="container">
  <div class="row">
   
     
  </div>
</div>
<script type="text/javascript">
  $(function() {
     $( "#med_name" ).autocomplete({
       source: 'main.php',
     });
  });
</script>
</body>
</html>