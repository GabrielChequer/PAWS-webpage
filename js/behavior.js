// Slideshow
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demodots");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " w3-white";
}

// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'block';
  }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}

//Sign in

function showReg() {

  document.getElementById('id01').style.display='none';
  document.getElementById('id02').style.display='block';
  
}

var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if ((event.target == modal) || (event.target == modal2)) {
    modal.style.display = "none";
    modal2.style.display = "none";
  }
}

function vetSignUpSelect() {
  const element = document.getElementById('vet00')
  if (element.checked) {
    document.getElementById('vet01').style.display='block';
  } else {
    document.getElementById('vet01').style.display='none';
  }
}

function vetLoginSelect(){
  const element = document.getElementById('vetLog0')
  if (element.checked) {
    document.getElementById('vetLog1').style.display='block';
  } else {
    document.getElementById('vetLog1').style.display='none';
  }
}