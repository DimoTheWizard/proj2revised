<!DOCTYPE html>
<html>
<head>

<title>Preview Rooms</title>
<link rel="stylesheet" href="res/style.css">
</head>
<body id="roompage">

<?php
    include('res/elements/header.php');
    ?>
    <div class="firstroom">
        <h1 class="firsthead">First class Room</h1>
    <br>
    <div class="backgroundforinfo">
        <p class="firstparg">This room contains two bedrooms</p>
    <br>
        <h1 class="firstparg">Book&ensp;<a href="reserve_rooms.php"> Here </a> to reserve the room!</h1>
    </div>
    </div>
    <br>
    <div class="all">
    <div class="slideshow-container">
    <div class="mySlides" id="parent">
    <div class="child numbertext">
        <p>1 / 3</p>
    </div>
    <div class="child imgRoom">
        <img src="res/images/room1.jfif" class="imgres" >
    </div>

        <!-- Slideshow-->

    <div class="child text" id="lastChild">
        <p>First Room</p>
    </div>
    </div>
    <div class="mySlides" id="parent">
    <div class="child numbertext">
        <p>2 / 3</p>
    </div>
    <div class="child imgRoom">
        <img src="res/images/room2.jpg" class="imgres" >
    </div>


    <div class="child text" id="lastChild">
        <p>Second Room</p>
    </div>
    </div>
    <div class="mySlides" id="parent">
    <div class="child numbertext">
        <p>3 / 3</p>
    </div>
    <div class="child imgRoom">
        <img src="res/images/room3.jpg" class="imgres" >
    </div>
    <div class="child text" id="lastChild">
        <p>Third Room</p>
    </div>
    </div>
    <div class="arrows">
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
</div>
    <br>
    <div class="dots">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
</div>
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}
function currentSlide(n) {
  showSlides(slideIndex = n);
}
function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
</script>
<?php
        include('res/elements/footer.php');
    ?>
</body>
</html>
