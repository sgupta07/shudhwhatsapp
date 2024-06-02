function forceLower(strInput) 
{
	var ls = strInput.value.toLowerCase();
	strInput.value = ls.replace(/\s+/g, '_');
}
	
// find elements
var pwd = $("#pwd");
var button = $(".getNewPass");
var len = 8;

// handle click and add class
button.on("click", function(){
  pwd.val(CreateRandomPassword());
  password_valid();
})

function CreateRandomPassword()
{
  var _allowedChars = 'ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789!^&*@#$%';
  allowedCharCount = _allowedChars.length;
  var chars = "";
  for (var i = 0; i < len; i++)
  {
    chars += _allowedChars[Math.floor(Math.random() * Math.floor(allowedCharCount))];
  }
  return chars;
}

var myInput = document.getElementById("pwd");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
	$('#messagePP').fadeIn();
	password_valid();
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  $('#messagePP').fadeOut();
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  password_valid();
}

function password_valid(){
	// messagePPvalidate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("messagePPinvalid");
    letter.classList.add("messagePPvalid");
  } else {
    letter.classList.remove("messagePPvalid");
    letter.classList.add("messagePPinvalid");
  }
  
  // messagePPvalidate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("messagePPinvalid");
    capital.classList.add("messagePPvalid");
  } else {
    capital.classList.remove("messagePPvalid");
    capital.classList.add("messagePPinvalid");
  }

  // messagePPvalidate numbers
  var numbers = /[0-9]/g;
  var special = /[!@#%$&^*]+/;

  if(myInput.value.match(numbers)) {  
    number.classList.remove("messagePPinvalid");
    number.classList.add("messagePPvalid");
  } 
  else if(myInput.value.match(special)) {  
    number.classList.remove("messagePPinvalid");
    number.classList.add("messagePPvalid");
  } else {
    number.classList.remove("messagePPvalid");
    number.classList.add("messagePPinvalid");
  }
  
  // messagePPvalidate length
  if(myInput.value.length >= len) {
    length.classList.remove("messagePPinvalid");
    length.classList.add("messagePPvalid");
  } else {
    length.classList.remove("messagePPvalid");
    length.classList.add("messagePPinvalid");
  }
  
}