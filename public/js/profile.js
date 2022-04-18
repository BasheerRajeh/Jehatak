function editUser()
{
  var name = document.getElementById("name");
  var email = document.getElementById("email");
  var u_id = document.getElementById("u_id");
  var n_id = document.getElementById("n_id");
  var rate = document.getElementById("rate");
  var spec = document.getElementById("spec");
  var password = document.getElementById("password");
  var image = document.getElementById("url-img");
  var submit = document.getElementById("submit");
  var button = document.getElementById("button");
  
  name.disabled = false;
  email.disabled = false;
  if (u_id != null)
    u_id.disabled = false;
  if (n_id != null)
    n_id.disabled = false;
  if (rate != null)
    rate.disabled = false;
  if (spec != null)
    spec.disabled = false;
  password.disabled = false;
  image.disabled = false;
  submit.disabled = false;
  button.disabled = true;
}
