function changeBorder(id){
  var element1 = document.getElementById('link1');
  var element2 = document.getElementById('link2');
  if(id === 1){
    element1.classList.add('border-left-dark')
    element2.classList.remove('border-left-dark')
  }else{
    element1.classList.remove('border-left-dark')
    element2.classList.add('border-left-dark')
  }
}