
/* add code here  */


document.addEventListener('DOMContentLoaded', function() {
    const highlightableElements = document.querySelectorAll('.hilightable');
    
    highlightableElements.forEach(element => {
        element.addEventListener('focus', function() {
            this.classList.add('highlight');
        });
        
        element.addEventListener('blur', function() {
            this.classList.remove('highlight');
        });
    });
    
    const mainForm = document.getElementById('mainForm');
    const requiredElements = document.querySelectorAll('.required');

    mainForm.addEventListener('submit', function(event) {
        let hasError = false; // 标记是否有必填项为空
        
        requiredElements.forEach(element => {
            if (element.value.trim() === '') {
                element.classList.add('error'); // 添加错误样式
                hasError = true;
            } else {
                element.classList.remove('error'); // 有内容则移除错误样式
            }
        });
        
        if (hasError) {
            event.preventDefault();
        }
    });


    requiredElements.forEach(element => {
        element.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('error');
            }
        });
    });
});
