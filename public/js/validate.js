function isEmptySignUp(spans, email, name, password)
{
    var flag = false;
    if(email == "")
    {
        spans[0].innerHTML="هذا الحقل مطلوب.";
        flag = true;
    }
	else
	{
		spans[0].innerHTML="";
	}
    if(name == "")
    {
        spans[1].innerHTML="هذا الحقل مطلوب.";
        flag = true;
    }
	else
	{
		spans[1].innerHTML="";
	}
    if(password == "")
    {
        spans[2].innerHTML="هذا الحقل مطلوب.";
        flag = true;
    }
	else
	{
		spans[2].innerHTML="";
	}
    return flag;
}

function validateSignUp()
{
    var flag = true;
    var spans = document.getElementsByClassName('error'); // n = 4
    var email = document.getElementById('email').value;
    var name = document.getElementById('name').value;
    var password = document.getElementById('password').value;
    var confirm_password = document.getElementById('confirm_password').value;
    if(isEmptySignUp(spans, email, name, password))
    {
        flag = false;
    }
    if((password.length < 5) && password!="")
    {
        spans[2].innerHTML="كلمة المرور لا يجب أن تقل عن خمسة محارف.";
        flag = false;
    }
    if(password != confirm_password)
    {
        spans[3].innerHTML="كلمات المرور غير متطابقة.";
        flag = false;
    }
    else
    {
        spans[3].innerHTML="";
    }
    return flag;
}

function validateSignIn()
{
    var flag = true;
    var spans = document.getElementsByClassName('error'); // n = 2
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    if(email == "")
    {
        spans[0].innerHTML="هذا الحقل مطلوب.";
        flag = false;
    }
    else
    {
        spans[0].innerHTML="";
    }
    if(password == "")
    {
        spans[1].innerHTML="هذا الحقل مطلوب.";
        flag = false;
    }
    else
    {
        spans[1].innerHTML="";
    }
    return flag;
}