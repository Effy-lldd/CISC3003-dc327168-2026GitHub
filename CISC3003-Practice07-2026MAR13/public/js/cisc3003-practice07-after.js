
/* add code here  */


// 等待页面完全加载后执行所有DOM操作
document.addEventListener('DOMContentLoaded', function() {
    // ===================== 1. 高亮功能实现（hilightable类元素） =====================
    // 获取所有带有hilightable类的元素
    const highlightableElements = document.querySelectorAll('.hilightable');
    
    // 为每个高亮元素绑定focus和blur事件
    highlightableElements.forEach(element => {
        // 聚焦时添加highlight类
        element.addEventListener('focus', function() {
            this.classList.add('highlight');
        });
        
        // 失焦时移除highlight类
        element.addEventListener('blur', function() {
            this.classList.remove('highlight');
        });
    });

    // ===================== 2. 表单提交验证（required类元素） =====================
    // 获取表单元素
    const mainForm = document.getElementById('mainForm');
    // 获取所有带有required类的元素
    const requiredElements = document.querySelectorAll('.required');

    // 表单提交事件处理
    mainForm.addEventListener('submit', function(event) {
        let hasError = false; // 标记是否有必填项为空
        
        // 遍历所有必填项，检查是否为空
        requiredElements.forEach(element => {
            // 去除首尾空格后判断是否为空
            if (element.value.trim() === '') {
                element.classList.add('error'); // 添加错误样式
                hasError = true;
            } else {
                element.classList.remove('error'); // 有内容则移除错误样式
            }
        });
        
        // 如果有错误，阻止表单提交
        if (hasError) {
            event.preventDefault();
        }
    });

    // ===================== 3. 实时移除错误样式（内容变更时） =====================
    // 为每个必填项绑定输入事件，内容变化时移除error类
    requiredElements.forEach(element => {
        // input事件监听所有内容变更（键盘输入、粘贴等）
        element.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('error');
            }
        });
    });
});