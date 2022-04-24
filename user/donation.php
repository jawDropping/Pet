<html>
    <head>
        <title>Pet Society</title>
        <link rel = "stylesheet" href="css/style.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Fredoka+One&family=Open+Sans:wght@500&family=Palette+Mosaic&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
    </head>

    <body>
       
        <?php 
            include ("inc/db.php");
            include ("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 
            ?>
             <div id='main'>
            <div class="slider">
           

            <div class="carousel-container">
  <div class="mySlides animate">
    <img src="../uploads/slide1.png" alt="slide" />
    <div class="number">1 / 5</div>
  </div>

  <div class="mySlides animate">
    <img src="../uploads/slide2.png" alt="slide" />
    <div class="number">2 / 5</div>
  </div>

  <div class="mySlides animate">
    <img src="../uploads/slide3.png" alt="slide" />
    <div class="number">3 / 5</div>
  </div>

  
  <!-- Next and previous buttons -->
  <a class="prev" onclick="prevSlide()">&#10094;</a>
  <a class="next" onclick="nextSlide()">&#10095;</a>

  <!-- The dots/circles -->
  <div class="dots-container">
    <span class="dots" onclick="currentSlide(1)"></span>
    <span class="dots" onclick="currentSlide(2)"></span>
    <span class="dots" onclick="currentSlide(3)"></span>

  </div>
</div>


    </div>
            </div>
            <div class="orgs">
            <ul>
                  <?php donate(); ?>
                </ul>
            </div>
               
                
                  </div>
                  <?php
                    include ("inc/footer.php"); 
                  ?>
    </body>
    <style>
       
        :root {
  --primary-color: slategrey;
}

.slider{
  font-family: "@Microsoft YaHei Light";
  background: #fafafa;
  display: flex;
  justify-content: center;
  overflow: hidden;
  width: 100vw;
  z-index: 1;
}

.carousel-container {
 
  width: 100vw;

  box-shadow: 0 0 30px -20px #223344;
}

/* Hide the images by default */
.mySlides {
  display: none;
}
.mySlides img {
  display: block;
  width: 100%;
}

/* image gradient overlay [optional] */
/*  .mySlides::after {
  content: "";
  position: absolute;
  inset: 0;
    background-image: linear-gradient(-45deg, rgba(110, 0, 255, .1), rgba(70, 0, 255, .2));
} */

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  transform: translate(0, -50%);
  width: auto;
  padding: 20px;
  color: white;
  font-weight: bold;
  font-size: 24px;
  border-radius: 0 8px 8px 0;
  background: rgba(173, 216, 230, 0.1);
  user-select: none;
}
.next {
  right: 0;
  border-radius: 8px 0 0 8px;
}
.prev:hover,
.next:hover {
  background-color: rgba(173, 216, 230, 0.3);
}

/* Caption text */
.text {
  color: #f2f2f2;
  background-color: rgba(10, 10, 20, 0.1);
  backdrop-filter: blur(6px);
  border-radius: 10px;
  font-size: 20px;
  padding: 8px 12px;
  position: absolute;
  bottom: 60px;
  left: 50%;
  transform: translate(-50%);
  text-align: center;
}

/* Number text (1/3 etc) */
.number {
  color: #f2f2f2;
  font-size: 16px;
  background-color: rgba(173, 216, 230, 0.15);
  backdrop-filter: blur(6px);
  border-radius: 10px;
  padding: 8px 12px;

  top: 10px;
  left: 10px;
  display: none;
}
.orgs{
    margin-top: 5%;
    background: red;
    width: 90%;
    margin-left: 5%;
}
/* The dots/bullets/indicators */
.dots {
  cursor: pointer;
  height: 14px;
  width: 14px;
  margin: 0 4px;
  background-color: rgba(173, 216, 230, 0.2);
  backdrop-filter: blur(2px);
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.3s ease;
  display: none;
}
.active,
.dots:hover {
  background-color: rgba(173, 216, 230, 0.8);
}

/* transition animation */
.animate {
  -webkit-animation-name: animate;
  -webkit-animation-duration: 1s;
  animation-name: animate;
  animation-duration: 2s;
}
#lowerSide{
    
}
 /* @keyframes animate {
  from {
    transform: scale(1) rotateY(0deg);
  }
  to {
    transform: scale(1) rotateY(0deg);
  }
}  */

/* 
@-webkit-keyframes slide {
    100% { left: 0; }
}

@keyframes slide {
    100% { left: 0; }
}  */

    </style>


    <script>
        let slideIndex = 0;
showSlides();

// Next-previous control
function nextSlide() {
  slideIndex++;
  showSlides();
  timer = _timer; // reset timer
}

function prevSlide() {
  slideIndex--;
  showSlides();
  timer = _timer;
}

// Thumbnail image controlls
function currentSlide(n) {
  slideIndex = n - 1;
  showSlides();
  timer = _timer;
}

function showSlides() {
  let slides = document.querySelectorAll(".mySlides");
  let dots = document.querySelectorAll(".dots");

  if (slideIndex > slides.length - 1) slideIndex = 0;
  if (slideIndex < 0) slideIndex = slides.length - 1;
  
  // hide all slides
  slides.forEach((slide) => {
    slide.style.display = "none";
  });
  
  // show one slide base on index number
  slides[slideIndex].style.display = "block";
  
  dots.forEach((dot) => {
    dot.classList.remove("active");
  });
  
  dots[slideIndex].classList.add("active");
}

// autoplay slides --------
let timer = 5; // sec
const _timer = timer;

// this function runs every 1 second
setInterval(() => {
  timer--;

  if (timer < 1) {
    nextSlide();
    timer = _timer; // reset timer
  }
}, 1000); // 1sec
    </script>
</html>