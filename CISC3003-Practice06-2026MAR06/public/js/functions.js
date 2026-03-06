/* define functions here */
// 计算单行商品总金额（数量 × 单价）
function calculateTotal(quantity, price) {
    var qty = parseFloat(quantity);
    var prc = parseFloat(price);
    return qty * prc;
}

// 生成购物车表格行
function outputCartRow(file, title, quantity, price, total) {
    // 格式化金额为两位小数
    var formattedPrice = price.toFixed(2);
    var formattedTotal = total.toFixed(2);
    
    // 拼接表格行HTML并输出
    document.write('<tr>');
    document.write('<td><img src="images/' + file + '"></td>');
    document.write('<td>' + title + '</td>');
    document.write('<td>' + quantity + '</td>');
    document.write('<td>$' + formattedPrice + '</td>');
    document.write('<td>$' + formattedTotal + '</td>');
    document.write('</tr>');
}

        
