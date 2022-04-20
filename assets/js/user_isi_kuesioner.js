function show(id){
  var element = document.getElementById(id);
  element.style.display = "block";
}

function hide(id){
  var element = document.getElementById(id);
  element.style.display = "none";;
}

function changeIcon(id){
  console.log('something')
  var element = document.getElementById('icon_' + id);
  var parent = document.getElementById(id);
  if(parent.classList.contains('show')){
    element.innerHTML = '<span><i class="bi bi-caret-down-fill"></i></span>'
  }else{
    console.log('something else')
    element.innerHTML = '<span><i class="bi bi-caret-up-fill"></i></span>'
  }
}

function checkCheckbox(){
  const comp = document.getElementById('cmengerti');
  if(comp.checked == true){
    document.getElementById('n-button-accor_-1').click();
  }else{
    alert('You must agree to the terms first by check the checkbox')
  }
}

function checkForm(id){
  // console.log(id)
  // return
  let allAreFilled = true;
  document.getElementById(id).querySelectorAll("[required]").forEach(function(i) {
    if (!allAreFilled) return;
    if (i.type === "radio" || i.type === "checkbox") {
      let radioValueCheck = false;
  document.getElementById(id).querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
        if (r.checked) radioValueCheck = true;
      })
      allAreFilled = radioValueCheck;
      return;
    }
    if (!i.value) { allAreFilled = false;  return; }
  })
  if (!allAreFilled) {
    alert('Fill all the fields');
  }else{    
    document.getElementById('n-button-'+id).click();
  }
}