document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
    });

    // slider


    !(function(d){
        // Variables to target our base class,  get carousel items, count how many carousel items there are, set the slide to 0 (which is the number that tells us the frame we're on), and set motion to true which disables interactivity.
        var itemClassName = "carousel__photo";
            items = d.getElementsByClassName(itemClassName),
            totalItems = items.length,
            slide = 0,
            moving = true; 
      
        // To initialise the carousel we'll want to update the DOM with our own classes
        function setInitialClasses() {
      
          // Target the last, initial, and next items and give them the relevant class.
          // This assumes there are three or more items.
          items[totalItems - 1].classList.add("prev");
          items[0].classList.add("active");
          items[1].classList.add("next");
        }
      
        // Set click events to navigation buttons
      
        function setEventListeners() {
          var next = d.getElementsByClassName('carousel__button--next')[0],
              prev = d.getElementsByClassName('carousel__button--prev')[0];
      
          next.addEventListener('click', moveNext);
          prev.addEventListener('click', movePrev);
        }
      
        // Disable interaction by setting 'moving' to true for the same duration as our transition (0.5s = 500ms)
        function disableInteraction() {
          moving = true;
      
          setTimeout(function(){
            moving = false
          }, 500);
        }
      
        function moveCarouselTo(slide) {
      
          // Check if carousel is moving, if not, allow interaction
          if(!moving) {
      
            // temporarily disable interactivity
            disableInteraction();
      
            // Preemptively set variables for the current next and previous slide, as well as the potential next or previous slide.
            var newPrevious = slide - 1,
                newNext = slide + 1,
                oldPrevious = slide - 2,
                oldNext = slide + 2;
      
            // Test if carousel has more than three items
            if ((totalItems - 1) > 0) {
      
              // Checks if the new potential slide is out of bounds and sets slide numbers
              if (newPrevious <= 0) {
                oldPrevious = (totalItems - 1);
              } else if (newNext >= (totalItems - 1)){
                oldNext = 0;
              }
      
              // Check if current slide is at the beginning or end and sets slide numbers
              if (slide === 0) {
                newPrevious = (totalItems - 1);
                oldPrevious = (totalItems - 2);
                oldNext = (slide + 1);
              } else if (slide === (totalItems -1)) {
                newPrevious = (slide - 1);
                newNext = 0;
                oldNext = 1;
              }
      
              // Now we've worked out where we are and where we're going, by adding and removing classes, we'll be triggering the carousel's transitions.
      
              // Based on the current slide, reset to default classes.
              items[oldPrevious].className = itemClassName;
              items[oldNext].className = itemClassName;
      
              // Add the new classes
              items[newPrevious].className = itemClassName + " prev";
              items[slide].className = itemClassName + " active";
              items[newNext].className = itemClassName + " next";
            }
          }
        }
      
        // Next navigation handler
        function moveNext() {
      
          // Check if moving
          if (!moving) {
      
            // If it's the last slide, reset to 0, else +1
            if (slide === (totalItems - 1)) {
              slide = 0;
            } else {
              slide++;
            }
      
            // Move carousel to updated slide
            moveCarouselTo(slide);
          }
        }
      
        // Previous navigation handler
        function movePrev() {
      
          // Check if moving
          if (!moving) {
      
            // If it's the first slide, set as the last slide, else -1
            if (slide === 0) {
              slide = (totalItems - 1);
            } else {
              slide--;
            }
      
            // Move carousel to updated slide
            moveCarouselTo(slide);
          }
        }
      
        // Initialise carousel
        function initCarousel() {
          setInitialClasses();
          setEventListeners();
      
          // Set moving to false now that the carousel is ready
          moving = false;
        }
      
        // make it rain
        initCarousel();
      
      }(document));


      // typeing effect


      var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #000}";
        document.body.appendChild(css);
    };


// form validaction And submit start here

$(document).ready(function(){

   $('#demo-form').parsley({
        
    });


$("#top-form").on('submit', function(event){

  event.preventDefault();
 
  var form = $(this);
  if (form.parsley().isValid()) {
    var formData = {
       fname: $("#m-fname").val(),
       email: $("#m-email").val(),
       phone: $("#m-phone").val(),
       service: $("#m-service").val(),
       message: $("#m-message").val()
      };

      $.ajax({
        method: "POST",
        url: "./mail.php",
        data:formData,
        success: function(res){
          $("#form-error-message-main-form").html(res);
          $("#top-form").trigger("reset");

        }
    });
}
});

$("#top-form").parsley({});
$("#form-footer").on('submit', function(event){

  event.preventDefault();

  var footerForm = $(this);
  if (footerForm.parsley().isValid()) {
    var formData = {
     fname: $("#fname").val(),
     email: $("#email").val(),
     phone: $("#phone").val(),
     service: $("#service").val(),
     message: $("#message").val()
    };

    $.ajax({
      method: "POST",
      url: "./mail.php",
      data:formData,
      success: function(res){
        $("#form-error-message").html(res);
        $("#form-footer").trigger("reset");
      }
  });
}

});
$("#form-footer").parsley({});
});

