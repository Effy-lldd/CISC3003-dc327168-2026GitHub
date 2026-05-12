<?php
/**
 * 函数功能：输出单个订单行并计算小计
 * @param string $file     图片文件名
 * @param string $title    商品标题
 * @param int    $quantity 数量
 * @param float  $price    单价
 */
function outputOrderRow($file, $title, $quantity, $price) {
    // 计算当前行的总额
    $amount = $quantity * $price;
    
    // 格式化输出为 2 位小数
    $formattedPrice = number_format($price, 2);
    $formattedAmount = number_format($amount, 2);
    
    // 输出 HTML 表格行
    echo "<tr>";
    echo "<td><img src='images/books/tinysquare/{$file}' alt='{$title}' class='product-cover'></td>";
    echo "<td>{$title}</td>";
    echo "<td class='text-right'>{$quantity}</td>";
    echo "<td class='text-right'>\${$formattedPrice}</td>";
    echo "<td class='text-right'>\${$formattedAmount}</td>";
    echo "</tr>";
    
    // 返回当前行的金额供外部累加 Subtotal
    return $amount;
}
?>