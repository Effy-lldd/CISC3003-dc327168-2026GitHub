/* add loop and other code here ... in this simple exercise we are not
   going to concern ourselves with minimizing globals, etc */

   // 初始化小计变量
   var subtotal = 0;

   // 循环遍历数组，生成商品表格行
   for (var i = 0; i < filenames.length; i++) {
       // 获取当前商品的各项数据
       var file = filenames[i];
       var title = titles[i];
       var quantity = quantities[i];
       var price = prices[i];
       
       // 调用calculateTotal计算单行总金额
       var rowTotal = calculateTotal(quantity, price);
       
       // 累加至小计
       subtotal += rowTotal;
       
       // 调用outputCartRow生成表格行
       outputCartRow(file, title, quantity, price, rowTotal);
   }

   // 计算税费（10%）
   var tax = subtotal * 0.1;

   // 计算运费：小计>1000则运费0，否则40
   var shipping = subtotal > 1000 ? 0 : 40;

   // 计算总计
   var grandTotal = subtotal + tax + shipping;

   // 生成结算行（Subtotal/Tax/Shipping/Grand Total）
   document.write('<tr class="totals">');
   document.write('<td colspan="4">Subtotal</td>');
   document.write('<td>$' + subtotal.toFixed(2) + '</td>');
   document.write('</tr>');

   document.write('<tr class="totals">');
   document.write('<td colspan="4">Tax</td>');
   document.write('<td>$' + tax.toFixed(2) + '</td>');
   document.write('</tr>');

   document.write('<tr class="totals">');
   document.write('<td colspan="4">Shipping</td>');
   document.write('<td>$' + shipping.toFixed(2) + '</td>');
   document.write('</tr>');

   document.write('<tr class="totals focus">');
   document.write('<td colspan="4">Grand Total</td>');
   document.write('<td>$' + grandTotal.toFixed(2) + '</td>');
   document.write('</tr>');