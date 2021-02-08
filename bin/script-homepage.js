/*window.onload = function(){
  var btn = document.getElementById('send_data_btn')
  if (btn) {
    btn.addEventListener('mousemove', send_data_btn_clicked)
  }
};*/

function bind_btns () {
  var btn = document.getElementById('find_btn')
  if (btn)
    btn.addEventListener('mousedown', function () {
      btn_clicked(btn.id)
    })
  var btn2 = document.getElementById('search_btn')
  if (btn2)
    btn2.addEventListener('mousedown', function () {
      btn_clicked(btn2.id)
    })
  var btn3 = document.getElementById('add_user_btn')
  if (btn3)
    btn3.addEventListener('mousedown', function () {
      btn_clicked(btn3.id)
    })
  var btn4 = document.getElementById('change_pwd_btn')
  if (btn4)
    btn4.addEventListener('mousedown', function () {
      btn_clicked(btn4.id)
    })
}

function btn_clicked (btn_id) {
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
