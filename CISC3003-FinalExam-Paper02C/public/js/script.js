// 注册表单前端验证
function validateRegisterForm(){
    let name = document.getElementById('fullname').value.trim();
    let email = document.getElementById('email').value.trim();
    let pwd = document.getElementById('password').value.trim();
    let repwd = document.getElementById('repassword').value.trim();

    if(name === "" || email === "" || pwd === "" || repwd === ""){
        alert("All fields cannot be empty");
        return false;
    }
    let emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!emailReg.test(email)){
        alert("Invalid email format");
        return false;
    }
    if(pwd.length < 6){
        alert("Password must be at least 6 characters");
        return false;
    }
    if(pwd !== repwd){
        alert("Passwords do not match");
        return false;
    }
    return true;
}

// 登录表单前端验证
function validateLoginForm(){
    let email = document.getElementById('login_email').value.trim();
    let pwd = document.getElementById('login_pwd').value.trim();
    if(email === "" || pwd === ""){
        alert("Please fill in all fields");
        return false;
    }
    return true;
}

// C06 Ajax 实时检查邮箱是否已注册
function checkEmailExist(){
    let email = document.getElementById('email').value.trim();
    if(email === ""){
        document.getElementById('email_tip').innerText = "";
        return;
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/check_email.php", true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById('email_tip').innerText = xhr.responseText;
        }
    };
    xhr.send("email="+email);
}