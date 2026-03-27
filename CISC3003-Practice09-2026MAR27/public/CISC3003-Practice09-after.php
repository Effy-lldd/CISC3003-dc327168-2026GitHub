<?php
// 1. 引入函数库
include 'functions.inc.php';
// 2. 引入数据文件
include 'data.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CISC3003 Practice 09 - PHP Version</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/styles-sol.css">
</head>
<body>
    <div class="app-container">

        <?php include 'left.inc.php'; ?>

        <main class="main-content">
           <?php include 'header.inc.php'; ?>

            <div class="content-header">
                <h4>Order Summaries</h4>
                <p>Examine your customer orders</p>
            </div>

            <div class="cards-container">
                <div class="card card-orders">
                    <div class="card-header"><h4>My Orders</h4></div>
                    <div class="card-content">
                        <ul class="order-list">
                            <?php 
                            // 使用循环输出订单编号
                            for ($i = 500; $i <= 540; $i += 10) {
                                echo "<li class='order-item'><a href='#'>Order #$i</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="card card-order-detail">
                    <div class="card-header"><h4>Selected Order: #520</h4></div>
                    <div class="card-content">
                        <p class="customer-info">Customer: Mount Royal University</p>
                        
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // 初始化小计变量
                                    $subtotal = 0;

                                    // 步骤 7: 调用函数输出各行，并累加返回的 amount 到 subtotal
                                    // 注意：这里使用的变量名必须与 data.inc.php 中的一致
                                    $subtotal += outputOrderRow($file1, $title1, $quantity1, $price1);
                                    $subtotal += outputOrderRow($file2, $title2, $quantity2, $price2);
                                    $subtotal += outputOrderRow($file3, $title3, $quantity3, $price3);
                                    $subtotal += outputOrderRow($file4, $title4, $quantity4, $price4);

                                    // 步骤 7: 运费逻辑计算
                                    // 规则：subtotal > 10000 运费 100，否则 200
                                    $shipping = ($subtotal > 10000) ? 100 : 200;
                                    $grandTotal = $subtotal + $shipping;
                                ?>

                                <tr>
                                    <td colspan="4" class="text-right totals">Subtotal</td>
                                    <td class="text-right totals">$<?php echo number_format($subtotal, 2); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right totals">Shipping</td>
                                    <td class="text-right totals">$<?php echo number_format($shipping, 2); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right grandtotals">Grand Total</td>
                                    <td class="text-right grandtotals">$<?php echo number_format($grandTotal, 2); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>