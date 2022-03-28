function show(id){
  var element = document.getElementById(id);
  element.style.display = "block";
}

function hide(id){
  var element = document.getElementById(id);
  element.style.display = "none";;
}

function changeIcon(id){
  var element = document.getElementById('icon_' + id);
  var parent = document.getElementById(id);
  if(parent.classList.contains('show')){
    element.innerHTML = '<i class="bi bi-caret-down-fill"></i>'
  }else{
    element.innerHTML = '<i class="bi bi-caret-up-fill"></i>'
  }
}