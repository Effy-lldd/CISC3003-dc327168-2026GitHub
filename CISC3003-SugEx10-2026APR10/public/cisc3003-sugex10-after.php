<?php
include 'includes/book-utilities.inc.php';

$customerList = readCustomers('data/customers.txt');

$selectedCustomerId = isset($_GET['customer_id']) ? trim($_GET['customer_id']) : null;
$selectedCustomer = null;
$customerOrders = [];
if ($selectedCustomerId && isset($customerList[$selectedCustomerId])) {
    $selectedCustomer = $customerList[$selectedCustomerId];
    $customerOrders = readOrders($selectedCustomerId, 'data/orders.txt');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CISC3003 Suggested Exercise 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/demo-styles.css">
    <link rel="stylesheet" href="css/material.min.css">
    
    <script src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script src="js/jquery.sparkline.2.1.2.js"></script>
</head>
<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">
            <div class="mdl-grid">
              <div class="mdl-cell mdl-cell--7-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Customers</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table  mdl-shadow--2dp">
                      <thead>
                        <tr>
                          <th class="mdl-data-table__cell--non-numeric">Name</th>
                          <th class="mdl-data-table__cell--non-numeric">University</th>
                          <th class="mdl-data-table__cell--non-numeric">City</th>
                          <th>Sales</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($customerList as $customer): ?>
                        <tr>
                          <td class="mdl-data-table__cell--non-numeric">
                            <a href="cisc3003-sugex10-after.php?customer_id=<?= htmlspecialchars($customer['id']) ?>">
                                <?= htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']) ?>
                            </a>
                          </td>
                          <td class="mdl-data-table__cell--non-numeric">
                              <?= htmlspecialchars($customer['university']) ?>
                          </td>
                          <td class="mdl-data-table__cell--non-numeric">
                              <?= htmlspecialchars($customer['city']) ?>
                          </td>
                          <td>
                            <span class="inlinesparkline"><?= htmlspecialchars($customer['sales']) ?></span>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                </div>
              </div>  
              
            <div class="mdl-grid mdl-cell--5-col">
    
       
                  <!-- 客户详情卡片 -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Customer Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <?php if ($selectedCustomer): ?>
                            <h4><?= htmlspecialchars($selectedCustomer['first_name'] . ' ' . $selectedCustomer['last_name']) ?></h4>
                            <p><strong>Email:</strong> <?= htmlspecialchars($selectedCustomer['email']) ?></p>
                            <p><strong>University:</strong> <?= htmlspecialchars($selectedCustomer['university']) ?></p>
                            <p>
                                <strong>Address:</strong> 
                                <?php
                                $addressSegments = [
                                    $selectedCustomer['address'],
                                    $selectedCustomer['city'],
                                    $selectedCustomer['state'],
                                    $selectedCustomer['country'],
                                    $selectedCustomer['zip']
                                ];
                                $addressSegments = array_filter($addressSegments, fn($val) => !empty(trim($val)));
                                echo htmlspecialchars(implode(', ', $addressSegments));
                                ?>
                            </p>
                            <p><strong>Phone:</strong> <?= htmlspecialchars($selectedCustomer['phone']) ?></p>
                        <?php else: ?>
                            <p>Select a customer to view details.</p>
                        <?php endif; ?>
                    </div>    
                  </div>  
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Order Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">       
                               
                               <table class="mdl-data-table  mdl-shadow--2dp">
                              <thead>
                                <tr>
                                  <th class="mdl-data-table__cell--non-numeric">Cover</th>
                                  <th class="mdl-data-table__cell--non-numeric">ISBN</th>
                                  <th class="mdl-data-table__cell--non-numeric">Title</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if ($selectedCustomer): ?>
                                    <?php if (!empty($customerOrders)): ?>
                                        <?php foreach ($customerOrders as $order): ?>
                                        <tr>
                                          <td class="mdl-data-table__cell--non-numeric">
                                              <img src="https://covers.openlibrary.org/b/isbn/<?= htmlspecialchars($order['isbn']) ?>-S.jpg" 
                                                   alt="Book Cover" style="width: 50px; height: auto; border-radius: 4px;">
                                          </td>
                                          <td class="mdl-data-table__cell--non-numeric">
                                              <?= htmlspecialchars($order['isbn']) ?>
                                          </td>
                                          <td class="mdl-data-table__cell--non-numeric">
                                              <?= htmlspecialchars($order['title']) ?>
                                          </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="mdl-data-table__cell--non-numeric">
                                                No orders for this customer.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="mdl-data-table__cell--non-numeric">
                                            Select a customer to view order details.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                              </tbody>
                            </table>
       
                        </div>    
                   </div>           
               </div>   
           
           
            </div>  <!-- /mdl-grid -->    
        </section>
    </main>    
</div>    <!-- /mdl-layout --> 

<script>
$(document).ready(function() {
    $('.inlinesparkline').sparkline('html', {
        type: 'bar',
        barColor: '#3f51b5',
        height: '20px',
        barWidth: 4,
        barSpacing: 2
    });
});
</script>
          
</body>
</html>