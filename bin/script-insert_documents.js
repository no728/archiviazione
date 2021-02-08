function bind_btns () {
    var btn = document.getElementById('insert_btn')
    if (btn)
      btn.addEventListener('mousedown', function () {
        btn_clicked(btn.id)
      })
  }
  
function btn_clicked (btn_id) {
  if (validate()){
    var current_btn = document.getElementById(btn_id)
    // btn.setAttribute("disabled", true);
    current_btn.innerHTML = 'Carico...<br>'
    var newSpan = document.createElement('span')
    newSpan.classList.add('spinner-border')
    newSpan.classList.add('spinner-border-sm')
    newSpan.setAttribute('role', 'status')
    newSpan.setAttribute('aria-hidden', 'true')
    current_btn.appendChild(newSpan)
  }
}

function validate (){
  if (document.getElementById('document_name').value.length > 0){
    if (document.getElementById('publishment_date').value != ""){
      if (document.getElementById('document_file').value != null){
        return true;
      }
    }
  }
  return false;
}