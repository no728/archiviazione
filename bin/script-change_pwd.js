function bind_btns() {
  var btn = document.getElementById('change_pwd')
  if (btn)
    btn.addEventListener('mousedown', function () {
      btn_clicked(btn.id)
    })
}

function btn_clicked(btn_id) {
  if (validate()) {
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

function validate(){
  var old_pwd = document.getElementById('old_pwd').value
  var new_pwd = document.getElementById('new_pwd').value
  if (old_pwd.length > 0) {
    if (new_pwd.length > 0) {
      return true
    }
  }
  return false
}