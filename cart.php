<?php



require 'inc/head.php'; ?>
<section class="cookies container-fluid">
    <div class="row">
      <!-- TODO : Display shopping cart items from $_COOKIES here. -->
        <?php
        if (isset($_SESSION['username'])) {

            $products = array("0", "Pecan nuts", "Chocolate chips", "Chocolate cookies", "M&M's cookies");

            if (!isset($_SESSION["total"])) {
                $_SESSION["total"] = 0;
                for ($i = 0; $i < count($products); $i++) {
                    $_SESSION["qty"][$i] = 0;
                }
            }

            //Add
            if (isset($_GET["add"])) {
                $i = $_GET["add"];
                $qty = $_SESSION["qty"][$i] + 1;
                $_SESSION["cart"][$i] = $i;
                $_SESSION["qty"][$i] = $qty;
            }
            //---------------------------
            //Delete
            if (isset($_GET["delete"])) {
                $i = $_GET["delete"];
                $qty = $_SESSION["qty"][$i];
                $qty--;
                $_SESSION["qty"][$i] = $qty;
                //remove item if quantity is zero
                if ($qty == 0) {
                    unset($_SESSION["cart"][$i]);
                }
            }

            if (isset($_SESSION["cart"])) {
                ?>
                <div class="container">
                <h2>Cart</h2>
                <table>
                    <tr>
                        <th>Product</th>
                        <th width="10px">&nbsp;</th>
                        <th>Qty</th>
                        <th width="10px">&nbsp;</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $total = 0;
                    foreach ($_SESSION["cart"] as $i) {
                        ?>
                        <tr>
                            <td><?php echo($products[$_SESSION["cart"][$i]]); ?></td>
                            <td width="10px">&nbsp;</td>
                            <td><?php echo($_SESSION["qty"][$i]); ?></td>
                            <td width="10px">&nbsp;</td>
                            <td><a href="?delete=<?php echo($i); ?>">Delete from cart</a></td>
                        </tr>
                        <?php
                        $total = $total + $_SESSION["qty"][$i];
                    }
                    $_SESSION["total"] = $total;


                    ?>

                    <tr>
                        <td colspan="7">Total : <?php echo($total); ?></td>
                    </tr>
                </table>
                </div>
                <?php
            } else { echo "<h1>Your cart is empty ... </h1>"; }
        } else { echo "<h1>You must log in to order our cookies, please connect !!</h1>";
        }
        ?>
    </div>
</section>
<?php require 'inc/foot.php'; ?>
