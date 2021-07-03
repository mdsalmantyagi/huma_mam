var name="";
var name_text="";
var email="";
var email_text="";
var size_text="";
var ext_text="";
var checked="";
var check_text="";
var pass_text="";

function Name()
{
   name = document.getElementById("name").value;
   //var regName = /^[a-z][a-z\s]*$/;
   var regName = /^[a-zA-Z0_ ]*$/;
   if(name.match(regName))
     {
      name_text="";
     }
   else
     {
     name_text="Only Characters and Spaces are Allowed.";
     }

  document.getElementById("name_err").innerHTML=name_text;

} 


function Email()
{
   email = document.getElementById("email").value;
   var regEmail =  /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   if(email.match(regEmail))
     {
      email_text="";
     }
   else
     {
     email_text="Please enter a valid email format.";
     }

  document.getElementById("email_err").innerHTML=email_text;

} 


var validExt = ".png,.jpg";
function fileExtValidate(fdata) {
 var filePath = fdata.value;
 var getFileExt = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
 var pos = validExt.indexOf(getFileExt);
 if(pos < 0) {
    alert("This file is not allowed, please upload valid file.");
    return false;
  } else {
    return true;
  }
}

var maxSize = '300';
function fileSizeValidate(fdata) {
     if (fdata.files && fdata.files[0]) {
                var fsize = fdata.files[0].size/300;
                if(fsize > maxSize) {
                     alert('Maximum file size 300kb exceed');
                     return false;
                } else {
                    return true;
                }
     }
 }

$("#file").change(function () {
        if(fileExtValidate(this)) {
             if(fileSizeValidate(this)) {
                showImg(this);
             }   
        }    
    });



function Checkbox(){
      checked = $("input[type=checkbox]:checked").length;

      if(checked != 2) {
        check_text="You must check at least two checkbox.";
      } else {
        check_text = "";
      }
document.getElementById("hobbies_err").innerHTML=check_text;
}


function Password() {
        var pass = document.getElementById("password").value;
        if (pass.match(/[a-z]/g) && pass.match(/[A-Z]/g) && pass.match(/[0-9]/g) && pass.match(/[^a-zA-Z\d]/g) && pass.length >= 8 && pass.length <= 16){
            pass_text = "";
        }else{
            pass_text="Please enter 1 special character, 1 number, 1 capital letter, 1 small leter, length 8 to 16.";
        }
        
        document.getElementById("password_err").innerHTML=pass_text;

    }