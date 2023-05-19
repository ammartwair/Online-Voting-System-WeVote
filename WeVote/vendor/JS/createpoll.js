function reloadpoll(){
  location = "../routes/createpoll.php";
}
function goBack(){
  location = "../routes/dashboard.php";
}



let optionaldesc = document.getElementById("optionaldesc");
let descShowHide = document.getElementById("descShowHide");

let minusdesc = document.getElementById("minusdesc");
let plusdesc = document.getElementById("plusdesc");
minusdesc.style.display="none";
optionaldesc.style.display="none";

descShowHide.onclick = function(){
  if(optionaldesc.style.display=="none"){
  optionaldesc.style.display="block";
  minusdesc.style.display="inline-block";
  plusdesc.style.display="none";
  }else{
    optionaldesc.style.display="none"
    plusdesc.style.display="inline-block";
    minusdesc.style.display="none";
  }
}

let polltitle = document.getElementById('polltitle');
let createbtn =document.getElementById('createbtn');

let isTitleValid = false;
let isCand1Valid = false;
let isCand2Valid = false;
let selected = false;

let hidtitle = document.getElementById("hidtitle");
let hidcand1 = document.getElementById("hidcand1");
let hidcand2 = document.getElementById("hidcand2");

let candidate1 = document.getElementById("candidate1");
let candidate2 = document.getElementById("candidate2");



function checkbtn(){
  if(isTitleValid && isCand1Valid && isCand2Valid && selected  &&  (hidtitle.value!=polltitle.value || hidcand1.value!=candidate1.value || hidcand2.value!=candidate2.value) ){
    createbtn.removeAttribute('disabled');
        if (createbtn.classList.contains('btn-outline-secondary')) {
            createbtn.classList.remove('btn-outline-secondary');
        }
        createbtn.classList.add('btn-outline-success');
    } else {
        if (createbtn.classList.contains('btn-outline-success')) {
            createbtn.classList.remove('btn-outline-success');
        }
        createbtn.classList.add('btn-outline-secondary');
        createbtn.setAttribute('disabled', 'disabled');
    
  }
}

let titleAlert = document.getElementById('titleAlert');
let fatitle = document.getElementById('fatitle');

titleAlert.style.visibility = "hidden";
polltitle.onkeyup = function checkName() {
    let pattern = /^[A-Za-zأ-ي\s]{4,25}$/
    if (pattern.test(polltitle.value)) {
        isTitleValid = true;
        if (polltitle.classList.contains('is-invalid')) {
            polltitle.classList.remove('is-invalid');
        }
        polltitle.classList.add('is-valid');
        fatitle.style.color="#198754";
        titleAlert.style.visibility = "hidden";

    } else {
        isTitleValid = false;
        titleAlert.style.visibility = "visible";
        if (polltitle.classList.contains('is-valid')) {
            polltitle.classList.remove('is-valid');
        }
        fatitle.style.color="#dc3545";
        polltitle.classList.add('is-invalid');
    }
    checkbtn();
}

let createsel = document.getElementById("visibility");

createsel.onchange = function(){
  createsel.classList.add("is-valid");
  selected=true;
  checkbtn();
}

let cand1Alert = document.getElementById('cand1alert');
cand1Alert.style.visibility="hidden";
candidate1.onkeyup = function checkUserName() {
    let pattern = /^[a-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{3,15}$/
    if (pattern.test(candidate1.value)) {
        isCand1Valid = true;
        if (candidate1.classList.contains('is-invalid')) {
            candidate1.classList.remove('is-invalid');
        }
        candidate1.classList.add('is-valid');
        cand1Alert.style.visibility="hidden";

    } else {
      isCand1Valid = false;
      cand1Alert.style.visibility="visible";
        if (candidate1.classList.contains('is-valid')) {
            candidate1.classList.remove('is-valid');
        }
        candidate1.classList.add('is-invalid');
    }
    checkbtn();
}
let cand2Alert = document.getElementById('cand2alert');
cand2Alert.style.visibility="hidden";
candidate2.onkeyup = function checkUserName() {
    let pattern = /^[a-z][A-Za-z0-9\\\/\*\_\.\@\!\$\#\%\^\&\(\)\]\[\{\}\-\+\,\|\=\?\`\<\>\;\:\"\']{3,15}$/
    if (pattern.test(candidate2.value)) {
        isCand2Valid = true;
        if (candidate2.classList.contains('is-invalid')) {
            candidate2.classList.remove('is-invalid');
        }
        candidate2.classList.add('is-valid');
        cand2Alert.style.visibility="hidden";

    } else {
      isCand2Valid = false;
      cand2Alert.style.visibility="visible";
        if (candidate2.classList.contains('is-valid')) {
            candidate2.classList.remove('is-valid');
        }
        candidate2.classList.add('is-invalid');
    }
    checkbtn();
}

window.onload= function(){
  if(polltitle.value!='' && candidate1.value!='' && candidate2.value!='' && createsel.value!=''){
    isTitleValid = true;
    isCand1Valid = true;
    isCand2Valid = true;
    selected = true;
    polltitle.classList.add('is-valid');
    candidate1.classList.add('is-valid');
    candidate2.classList.add('is-valid');
    createsel.classList.add('is-valid');
  checkbtn();
}
let input = document.getElementById('polltitle').focus(); 
}