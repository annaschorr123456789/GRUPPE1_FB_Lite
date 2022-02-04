/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var myInput;
var myInputConf;
var letter;
var capital;
var number;
var length;
var confirmed;



    
function init()
{
        myInput = document.getElementById("psw");
        myInputConf=document.getElementById("pswconf");
        letter = document.getElementById("letter");
        capital = document.getElementById("capital");
        number = document.getElementById("number");
        length = document.getElementById("length");
        confirmed= document.getElementById("password_conf");

        // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
      document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
      document.getElementById("message").style.display = "none";
    }

    myInputConf.onfocus = function()
    {
      document.getElementById("message").style.display = "block";
    }

    myInputConf.onblur = function()
    {
      document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
      // Validate lowercase letters
      var lowerCaseLetters = /[a-z]/g;
      if(myInput.value.match(lowerCaseLetters)) {  
        letter.classList.remove("invalid");
        letter.classList.add("valid");
      } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
      }

      // Validate capital letters
      var upperCaseLetters = /[A-Z]/g;
      if(myInput.value.match(upperCaseLetters)) {  
        capital.classList.remove("invalid");
        capital.classList.add("valid");
      } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
      }

      // Validate numbers
      var numbers = /[0-9]/g;
      if(myInput.value.match(numbers)) {  
        number.classList.remove("invalid");
        number.classList.add("valid");
      } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
      }

      // Validate length
      if(myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
      } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
      }
      if(myInput.value !== myInputConf.value)
        {
            confirmed.classList.remove("valid");
            confirmed.classList.add("invalid");
        }
        else
        {
            confirmed.classList.remove("invalid");
            confirmed.classList.add("valid");
        }
    }
    myInputConf.onkeyup = function()
    {
        if((myInput.value == myInputConf.value)&&myInput.value!==0)
        {
           //  alert("passwörter stimmen überein");
            confirmed.classList.remove("invalid");
            confirmed.classList.add("valid");
        }
        else
        {
           // alert("passwörter stimmen nicht überein");
            confirmed.classList.remove("valid");
            confirmed.classList.add("invalid");
        }
    }

}
    window.onload=init;