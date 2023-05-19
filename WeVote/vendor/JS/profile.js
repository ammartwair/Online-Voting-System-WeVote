let continuebtn = document.getElementById("continuebtn");
let regbtn = document.getElementById("regbtn");

let regName = document.getElementById('regname');
let reguser = document.getElementById('reguser');
let regmob = document.getElementById('regmob');
let regpass = document.getElementById('regpass');
let regconf = document.getElementById('regconf');
let regadd = document.getElementById('regadd');
let prefix = document.getElementById('prefix');
let adminbtn = document.getElementById('adminbtn');
let useradmin = document.getElementById('useradmin');

let iname = document.getElementById('iname');
let iuser = document.getElementById('iuser');
let imob = document.getElementById('imob');
let ipass = document.getElementById('ipass');
let iadd = document.getElementById('iadd');
let iprefix = document.getElementById('iprefix');

let isuseradmin = false;
let isNameValid = true;
let isUserNameValid = true;
let isPassValid = true;
let isConfValid = true;
let isMobValid = true;
let isAddValid = true;

let firstpagelogin1 = document.getElementById("firstpagelogin1");

window.onload = function () {
    let input = document.getElementById('regname').focus();
    firstpagelogin1.style.display="none";
    firstpagelogin1.style.visibility="hidden";
    if(regName.value!=''){
        isNameValid=true;
        regName.classList.add('is-valid');
        fauser.style.display="none";
        fausercheck.style.display="block";
        fausercheck.style.color="#198754";
    }
    if(reguser.value!=''){
        isUserNameValid=true;
        reguser.classList.add('is-valid');
        fauser1.style.display="none";
        fausercheck1.style.display="block";
        fausercheck1.style.color="#198754";
    }
    if(regpass.value==''){
        isPassValid=true;
        isConfValid=true;
    }
    if(regmob.value!=''){
        isMobValid=true;
        regmob.classList.add('is-valid');
        faphone.style.color="#198754";
    }
    if(regadd.value!=''){
        isAddValid=true;
        regadd.classList.add('is-valid');
        faaddress.style.color="#198754";
    }
    checkContinue();
    checkRegInputs();
}

function checkContinue() {
    if (isNameValid && isPassValid && isUserNameValid && isConfValid) {
        continuebtn.removeAttribute('disabled');
        if (continuebtn.classList.contains('btn-outline-secondary')) {
            continuebtn.classList.remove('btn-outline-secondary');
        }
        continuebtn.classList.add('btn-outline-success');
    } else {
        if (continuebtn.classList.contains('btn-outline-success')) {
            continuebtn.classList.remove('btn-outline-success');
        }
        continuebtn.classList.add('btn-outline-secondary');
        continuebtn.setAttribute('disabled', 'disabled');
    }
}

function checkRegInputs() {
    if (isNameValid && isPassValid && isMobValid && isAddValid && isUserNameValid && isConfValid && (regName.value!=iname.value || reguser.value!=iuser.value || regmob.value!=imob.value || prefix.value!=iprefix.value || regadd.value!=iadd.value || (regpass.value!=ipass.value && regpass.value==regconf.value))) {
        regbtn.removeAttribute('disabled');
        if (regbtn.classList.contains('btn-outline-secondary')) {
            regbtn.classList.remove('btn-outline-secondary');
        }
        regbtn.type="submit";
        regbtn.classList.add('btn-outline-success');
    } else {
        if (regbtn.classList.contains('btn-outline-success')) {
            regbtn.classList.remove('btn-outline-success');
        }
        regbtn.type="button";
        regbtn.classList.add('btn-outline-secondary');
        regbtn.setAttribute('disabled', 'disabled');
    }
}

function checkAdminBtn() {
    if (isuseradmin) {
        adminbtn.removeAttribute('disabled');
        if (adminbtn.classList.contains('btn-outline-secondary')) {
            adminbtn.classList.remove('btn-outline-secondary');
        }
        adminbtn.type="submit";
        adminbtn.classList.add('btn-outline-success');
    } else {
        if (adminbtn.classList.contains('btn-outline-success')) {
            adminbtn.classList.remove('btn-outline-success');
        }
        adminbtn.type="button";
        adminbtn.classList.add('btn-outline-secondary');
        adminbtn.setAttribute('disabled', 'disabled');
    }
}

let adminAlert = document.getElementById('adminAlert');
adminAlert.style.visibility = "hidden";
useradmin.onkeyup = function checkUserName() {
    let pattern = /^[a-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{3,15}$/
    if (pattern.test(useradmin.value)) {
        isuseradmin = true;
        if (useradmin.classList.contains('is-invalid')) {
            useradmin.classList.remove('is-invalid');
        }
        useradmin.classList.add('is-valid');
        adminAlert.style.visibility = "hidden";

    } else {
        isuseradmin = false;
        adminAlert.style.visibility = "visible";
        if (useradmin.classList.contains('is-valid')) {
            useradmin.classList.remove('is-valid');
        }
        useradmin.classList.add('is-invalid');
    }
    checkAdminBtn();
}


prefix.onchange = function(){
    checkRegInputs();
}

let fauser = document.getElementById("fa-user");
let fausercheck = document.getElementById("fa-usercheck");
fausercheck.style.display= "none";

/*
* Name - register
* 4-15
* spaces
* starts with capital letter
* regex /^[A-Z][A-za-z\s]{3,15}$/
*/

let nameAlert = document.getElementById('nameAlert');
nameAlert.style.visibility = "hidden";
regName.onkeyup = function checkName() {
    let pattern = /^[A-Z][A-Za-z\s]{3,15}$/
    if (pattern.test(regName.value)) {
        isNameValid = true;
        if (regName.classList.contains('is-invalid')) {
            regName.classList.remove('is-invalid');
        }
        regName.classList.add('is-valid');
        fauser.style.display="none";
        fausercheck.style.display="block";
        fausercheck.style.color="#198754";
        nameAlert.style.visibility = "hidden";

    } else {
        isNameValid = false;
        nameAlert.style.visibility = "visible";
        if (regName.classList.contains('is-valid')) {
            regName.classList.remove('is-valid');
        }
        fausercheck.style.display="none";
        fauser.style.display="block";
        fauser.style.color="#dc3545";
        regName.classList.add('is-invalid');
    }
    checkContinue();
    checkRegInputs();
}


let fauser1 = document.getElementById("fa-user1");
let fausercheck1 = document.getElementById("fa-usercheck1");
fausercheck1.style.display= "none";

/*
* Username - register
* 4-15
* starts with a letter
* uses special charachters
* regex /^[A-Za-z][A-Za-z0-9\s\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{3,15}$/
*/

let usernameAlert = document.getElementById('usernameAlert');
usernameAlert.style.visibility = "hidden";
reguser.onkeyup = function checkUserName() {
    let pattern = /^[a-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{3,15}$/
    if (pattern.test(reguser.value)) {
        isUserNameValid = true;
        if (reguser.classList.contains('is-invalid')) {
            reguser.classList.remove('is-invalid');
        }
        reguser.classList.add('is-valid');
        fauser1.style.display="none";
        fausercheck1.style.display="block";
        fausercheck1.style.color="#198754";
        usernameAlert.style.visibility = "hidden";

    } else {
        isUserNameValid = false;
        usernameAlert.style.visibility = "visible";
        if (reguser.classList.contains('is-valid')) {
            reguser.classList.remove('is-valid');
        }
        reguser.classList.add('is-invalid');
        fausercheck1.style.display="none";
        fauser1.style.display="block";
        fauser1.style.color="#dc3545";
    }
    checkContinue();
    checkRegInputs();
}

let faphone = document.getElementById("fa-phone");
/*
* Mobile Number - Log in
* 9 digits
* numbers
* regex  /^[5][9|6][0-9]{7}$/
*/
let mobAlert = document.getElementById('regMobAlert');
mobAlert.style.visibility = "hidden";
regmob.onkeyup = function checkMobile() {
    let pattern =  /^[5][9|6][0-9]{7}$/
    if (pattern.test(regmob.value)) {
        isMobValid = true;
        if (regmob.classList.contains('is-invalid')) {
            regmob.classList.remove('is-invalid');
        }
        faphone.style.color="#198754";
        regmob.classList.add('is-valid');
        mobAlert.style.visibility = "hidden";
    } else {
        isMobValid = false;
        if (regmob.classList.contains('is-valid')) {
            regmob.classList.remove('is-valid');
        }
        faphone.style.color="#dc3545";
        regmob.classList.add('is-invalid');
        mobAlert.style.visibility = "visible";
    }
    checkRegInputs();
}


let falock = document.getElementById("fa-lock");
let faunlock = document.getElementById("fa-unlock");
faunlock.style.display="none";

/*
* Password - Log in
* starts with a letter
* 6-25
* numbers
* regex /^[A-Za-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{5,25}$/
 
 */
let passAlert = document.getElementById('passAlert');
passAlert.style.visibility = "hidden";
regpass.onkeyup = function checkPass() {
    let pattern = /^[A-Za-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{5,25}$/
    if (pattern.test(regpass.value)) {
        isPassValid = true;
        if (regpass.classList.contains('is-invalid')) {
            regpass.classList.remove('is-invalid');
        }
        regpass.classList.add('is-valid');
        faunlock.style.color="#198754";
        falock.style.color="#198754";
        passAlert.style.visibility = "hidden";
        if (regconf.value == regpass.value) {
            if (regconf.classList.contains('is-invalid')) {
                regconf.classList.remove('is-invalid');
                regconf.classList.add('is-valid');
                faunlock1.style.color="#198754";
                falock1.style.color="#198754";
                confAlert2.style.display = "none";
                confAlert.style.display = "block";
                confAlert.style.visibility = "hidden";
                isConfValid=true;
            }
        } else if (regconf.classList.contains('is-valid')) {
            isConfValid=false;
            regconf.classList.remove('is-valid');
            regconf.classList.add('is-invalid');
            confAlert.style.display = "none";
            confAlert2.style.display = "block";
            confAlert2.style.visibility = "visible";
            falock1.style.color="#dc3545";
            faunlock1.style.color="#dc3545";
        }
    } else {
        isPassValid = false;
        if (regpass.classList.contains('is-valid')) {
            regpass.classList.remove('is-valid');
        }
        regpass.classList.add('is-invalid');
        falock.style.color="#dc3545";
        faunlock.style.color="#dc3545";
        passAlert.style.visibility = "visible";
    }
    checkContinue();
    checkRegInputs();
}

/*
* Confirm Password - Log in
* starts with a letter
* 6-25
* numbers
* regex /^[A-Za-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{5,25}$/
 */

let falock1 = document.getElementById("fa-lock1");
let faunlock1 = document.getElementById("fa-unlock1");
faunlock1.style.display="none";

let confAlert = document.getElementById('confAlert');
let confAlert2 = document.getElementById('confAlert2');
confAlert.style.visibility = "hidden";
confAlert2.style.display = "none";
regconf.onkeyup = function checkConf() {
    let pattern = /^[A-Za-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{5,25}$/
    if (pattern.test(regconf.value)) {
        if (regconf.value != regpass.value) {
            isConfValid = false;
            if (regconf.classList.contains('is-valid')) {
                regconf.classList.remove('is-valid');
            }
            regconf.classList.add('is-invalid');
            falock1.style.color="#dc3545";
            faunlock1.style.color="#dc3545";
            confAlert.style.display = "none";
            confAlert2.style.display = "block";
            confAlert2.style.visibility = "visible";
        } else {
            isConfValid = true;
            if (regconf.classList.contains('is-invalid')) {
                regconf.classList.remove('is-invalid');
            }
            regconf.classList.add('is-valid');
            faunlock1.style.color="#198754";
            falock1.style.color="#198754";
            confAlert.style.display = "block";
            confAlert.style.visibility = "hidden";
            confAlert2.style.display = "none";
        }
    } else {
        isConfValid = false;
        if (regconf.classList.contains('is-valid')) {
            regconf.classList.remove('is-valid');
        }
        regconf.classList.add('is-invalid');
        falock1.style.color="#dc3545";
        faunlock1.style.color="#dc3545";
        confAlert.style.display = "block";
        confAlert.style.visibility = "visible";
        confAlert2.style.display = "none";
    }
    checkContinue();
    checkRegInputs();
}


let faaddress = document.getElementById("fa-address");
/*
* add
* starts with a letter
* 5-120
* numbers
* regex /^[A-Za-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{4,120}$/

 */
let addAlert = document.getElementById('addAlert');
addAlert.style.visibility = "hidden";
regadd.onkeyup = function checkAddress() {
    let pattern = /^[A-Za-z][A-Za-z0-9\s\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{4,120}$/
    if (pattern.test(regadd.value)) {
        isAddValid = true;
        if (regadd.classList.contains('is-invalid')) {
            regadd.classList.remove('is-invalid');
        }
        faaddress.style.color="#198754";
        regadd.classList.add('is-valid');
        addAlert.style.visibility = "hidden";
    } else {
        isAddValid = false;
        if (regadd.classList.contains('is-valid')) {
            regadd.classList.remove('is-valid');
        }
        faaddress.style.color="#dc3545";
        regadd.classList.add('is-invalid');
        addAlert.style.visibility = "visible";
    }
    checkRegInputs();
}


let showIcon= document.getElementById('showIcon');
let hideIcon= document.getElementById('hideIcon');
let showPass= document.getElementById('showPass');
let hidePass= document.getElementById('hidePass');
let showHide = document.getElementById('showHide');

hideIcon.style.display="none";
hidePass.style.display="none";
showHide.onclick = function(){
    if(regpass.type==="password"){
    showIcon.style.display = "none";
    showPass.style.display = "none";
    hideIcon.style.display ="block";
    hidePass.style.display ="block";
    falock.style.display="none";
    falock1.style.display="none";
    faunlock.style.display="block";
    faunlock1.style.display="block";
    regpass.type="text";
    regconf.type="text";
    }else{
        hideIcon.style.display = "none";
        hidePass.style.display = "none";
        showIcon.style.display ="block";
        showPass.style.display ="block";
        falock.style.display="block";
        falock1.style.display="block";
        faunlock.style.display="none";
        faunlock1.style.display="none";
        regpass.type="password";
        regconf.type="password";
    }
}


let a1 = document.getElementById("a1");
let a2 = document.getElementById("continuebtn");

a2.onclick = function(){
    $("#firstpagelogin").fadeOut(500);
    $("#firstpagelogin1").fadeOut(500);
    setTimeout(myff, 500);
}
function myff(){
    firstpagelogin1.style.display="block";
    firstpagelogin1.style.visibility="visible";
    $("#firstpagelogin1").fadeIn(500);
    let y = document.getElementById('regmob').focus();
}
a1.onclick = function(){
    $("#firstpagelogin1").fadeOut(500);
    $("#firstpagelogin").fadeOut(500);
    setTimeout(myffs, 500);
}
function myffs(){
    $("#firstpagelogin").fadeIn(500);
    let x = document.getElementById('regname').focus();

}
