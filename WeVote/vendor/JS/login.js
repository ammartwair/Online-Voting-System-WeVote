
let username = document.getElementById('username');
let pass = document.getElementById('upass');

let isUserNameValid = false;
let isPassValid = false;

let lginbtn = document.getElementById("lginbtn");

function checkInputs() {
    if (isUserNameValid && isPassValid) {
        lginbtn.removeAttribute('disabled');
        lginbtn.type="submit";
        if (lginbtn.classList.contains('btn-outline-secondary')) {
            lginbtn.classList.remove('btn-outline-secondary');
        }
        lginbtn.classList.add('btn-outline-success');
    } else {
        if (lginbtn.classList.contains('btn-outline-success')) {
            lginbtn.classList.remove('btn-outline-success');
        }
        lginbtn.classList.add('btn-outline-secondary');
        lginbtn.setAttribute('disabled', 'disabled');
        lginbtn.type="button";
    }
}


/*
* Username  - Log in
* 4-15 charachters starting with a small letter
* numbers
* regex /^[a-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{3,15}$/
*/
let fauser = document.getElementById("fa-user");
let fausercheck = document.getElementById("fa-usercheck");
fausercheck.style.display= "none";
let userAlert = document.getElementById('userAlert');
userAlert.style.visibility = "hidden";
username.onkeyup = function(){
    let pattern = /^[a-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{3,15}$/
    if (pattern.test(username.value)) {
        isUserNameValid = true;
        if (username.classList.contains('is-invalid')) {
            username.classList.remove('is-invalid');
        }
        username.classList.add('is-valid');
        fauser.style.display="none";
        fausercheck.style.display="block";
        fausercheck.style.color="#198754";
        userAlert.style.visibility = "hidden";
    } else {
        isUserNameValid = false;
        if (username.classList.contains('is-valid')) {
            username.classList.remove('is-valid');
        }
        username.classList.add('is-invalid');
        fausercheck.style.display="none";
        fauser.style.display="block";
        fauser.style.color="#dc3545";
        userAlert.style.visibility = "visible";
    }
    checkInputs();
}

/*
* Password - Log in
* starts with a letter
* 6-25
* numbers
* special charachters
* regex /^[A-Za-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{5,25}$/

 */
let falock = document.getElementById("fa-lock");
let faunlock = document.getElementById("fa-unlock");
faunlock.style.display="none";
let passAlert = document.getElementById('passwordAlert');
passAlert.style.visibility = "hidden";
pass.onkeyup = function() {
    let pattern = /^[A-Za-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{5,25}$/
    if (pattern.test(pass.value)) {
        isPassValid = true;
        if (pass.classList.contains('is-invalid')) {
            pass.classList.remove('is-invalid');
        }
        faunlock.style.color="#198754";
        falock.style.color="#198754";
        pass.classList.add('is-valid');
        passAlert.style.visibility = "hidden";
    } else {
        isPassValid = false;
        if (pass.classList.contains('is-valid')) {
            pass.classList.remove('is-valid');
        }
        falock.style.color="#dc3545";
        faunlock.style.color="#dc3545";
        pass.classList.add('is-invalid');
        passAlert.style.visibility = "visible";
    }
    checkInputs();
}

window.onload= function(){
    if(pass.value!=''){
    let pattern = /^[A-Za-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{5,25}$/
    if (pattern.test(pass.value)) {
        isPassValid = true;
        if (pass.classList.contains('is-invalid')) {
            pass.classList.remove('is-invalid');
        }
        pass.classList.add('is-valid');
        passAlert.style.visibility = "hidden";
    } else {
        isPassValid = false;
        if (pass.classList.contains('is-valid')) {
            pass.classList.remove('is-valid');
        }
        pass.classList.add('is-invalid');
        passAlert.style.visibility = "visible";
    }
    checkInputs();
}
if(username.value!=''){
    let pattern = /^[a-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{3,15}$/
    if (pattern.test(username.value)) {
        isUserNameValid = true;
        if (username.classList.contains('is-invalid')) {
            username.classList.remove('is-invalid');
        }
        username.classList.add('is-valid');
        userAlert.style.visibility = "hidden";
    } else {
        isUserNameValid = false;
        if (username.classList.contains('is-valid')) {
            username.classList.remove('is-valid');
        }
        username.classList.add('is-invalid');
        userAlert.style.visibility = "visible";
    }
    checkInputs();
}
let input = document.getElementById('username').focus(); 
}

let showIcon= document.getElementById('showIcon');
let hideIcon= document.getElementById('hideIcon');
let showPass= document.getElementById('showPass');
let hidePass= document.getElementById('hidePass');
let showHide = document.getElementById('showHide');

hideIcon.style.display="none";
hidePass.style.display="none";
showHide.onclick = function(){
    if(pass.type==="password"){
    showIcon.style.display = "none";
    showPass.style.display = "none";
    hideIcon.style.display ="block";
    hidePass.style.display ="block";
    falock.style.display="none";
    faunlock.style.display="block";
    pass.type="text";
    }else{
        hideIcon.style.display = "none";
        hidePass.style.display = "none";
        showIcon.style.display ="block";
        showPass.style.display ="block";
        faunlock.style.display="none";
        falock.style.display="block";
        pass.type="password";
    }
}