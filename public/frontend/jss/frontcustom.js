jQuery(document).ready(function() {
    jQuery("#bannerslider").owlCarousel({
        nav: true,
        dots:false,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 2000,
        navText:[],
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 5
            },
            1000: {
                items: 10
            }
        }
    });
 
    jQuery("#nsnrecentlyaddedslider").owlCarousel({
        items: 4,
        itemsMobile: [599, 1],
        nav: false,
        navText: false,
        margin: 0,
        navigationText: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 4,
            }
        }
    });
    jQuery("#nsnrecentlyaddedsliderTwo").owlCarousel({
        items: 4,
        itemsMobile: [599, 1],
        navText: false,
        margin: 0,
        navigationText: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        nav:false,
        dots:false,
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 4,
            }
        }
    });
    jQuery("#nsnsimilarhotelslider").owlCarousel({
      items: 4,
        itemsMobile: [599, 1],
        nav: false,
        navText: false,
        margin: 20,
        navigationText: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false,
                loop: true
            },
            600: {
                items: 2,
                nav: false,
                loop: true
            },
            1000: {
                items: 4,
                nav: false,
                loop: true
            }
        }
    });
    jQuery("#nsnrecentstoriesslider").owlCarousel({
        items: 4,
        itemsMobile: [599, 1],
        nav: false,
        navText: false,
        margin: 20,
        navigationText: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
            },
            600: {
                items: 2,
                nav: false,
            },
            1000: {
                items: 4,
                nav: false,
            }
        }
    });
    jQuery("#nsnhotelspeoplessays").owlCarousel({
        items: 2,
        itemsMobile: [599, 1],
        nav: false,
        navText: true,
        margin: 20,
        navigationText: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: true
            },
            600: {
                items: 1,
                nav: false,
                loop: true
            },
            1000: {
                items: 2,
                nav: false,
                loop: true
            }
        }
    });
    jQuery(".nsnhotelsimageslider").owlCarousel({
        items: 1,
        itemsMobile: [599, 1],
        nav: false,
        navText: false,
        margin: 1,
        navigationText: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: false
            },
            600: {
                items: 1,
                nav: false,
                loop: false
            },
            1000: {
                items: 1,
                nav: false,
                loop: false
            }
        }
    });
    jQuery("#nsnhotelsimageslider").owlCarousel({
        items: 1,
        itemsMobile: [599, 1],
        nav: false,
        navText: false,
        margin: 1,
        navigationText: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: false
            },
            600: {
                items: 1,
                nav: false,
                loop: false
            },
            1000: {
                items: 1,
                nav: false,
                loop: false
            }
        }
    });
    jQuery("#nsnhotelsimagesliderss").owlCarousel({
        items: 1,
        itemsMobile: [599, 1],
        nav: false,
        navText: false,
        margin: 1,
        navigationText: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: false
            },
            600: {
                items: 1,
                nav: false,
                loop: false
            },
            1000: {
                items: 1,
                nav: false,
                loop: false
            }
        }
    });
  
    jQuery("#resort").owlCarousel({
        items: 1,
        itemsMobile: [599, 1],
        nav: false,
        navText: false,
        margin: 1,
        navigationText: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: false
            },
            600: {
                items: 3,
                nav: false,
                loop: false
            },
            1000: {
                items: 4,
                nav: false,
                loop: false
            }
        }
    });
    jQuery("#nsnhotelsblogslider").owlCarousel({
        items: 4,
        itemsMobile: [599, 1],
        nav: false,
        navText: false,
        margin: 20,
        navigationText: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: true
            },
            600: {
                items: 2,
                nav: false,
                loop: true
            },
            1000: {
                items: 4,
                nav: false,
                loop: true
            }
        }
    });
  
});


//Internal Page JS//
jQuery(".hotel-toggle").click(function() {
  jQuery('.hiddenDiv-one').toggle();
});

jQuery("#checkboxid").click(function() {
  jQuery('#autoupdate').toggle(1000);
});

 $('.panel-dropdown .guestspicker').on('click', function(event) {
      $('.panel-dropdown').toggleClass('active');
      event.preventDefault();
    });
    $(window).click(function() {
      $('.panel-dropdown').removeClass('active');
    });
    $('.panel-dropdown').on('click', function(event) {
      event.stopPropagation();
    });


    $(function() {
      $(".plus, .minus").on("click", function() {
        var button = $(this);
        var oldValue = button.parent().find("input").val();
        if (button.hasClass('plus')) {
          
            if(oldValue  < 3){
                 var newVal = parseFloat(oldValue) + 1;
            }
              else{
                var newVal = parseFloat(oldValue);
            }
        } else {
          if (oldValue > 0) {
               if(oldValue  > 1){
            var newVal = parseFloat(oldValue) - 1;
               }
                 else{
                var newVal = parseFloat(oldValue);
            }
          } else {
            newVal = 0;
          }
        }
        button.parent().find("input").val(newVal);
       guest_rooms();
     
      });
});
    
$(function(){
	var overlay = $('<div id="overlay"></div>');
	overlay.show();
	overlay.appendTo(document.body);
	$('.popup').show();
	$('.close').click(function(){
	$('.popup').hide();
	overlay.appendTo(document.body).remove();
	return false;
});
$('.x').click(function(){
	$('.popup').hide();
	overlay.appendTo(document.body).remove();
	return false;
	});
});

function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

     function guest_rooms(){
        
        var room = parseFloat($('#room').text());
         var gueststotal = parseFloat($('.gueststotal').text());
         var gueststotal0 = parseFloat($('#guest').val());
         if(gueststotal0 > 3){
                $('#guest').val(3);
             alert('3 Person Allowed In 1 Room');
         }
         var gueststotal1 = parseFloat($('#guest1').val());
          if(gueststotal1 > 3){
               $('#guest1').val(3);
             alert('3 Person Allowed In One Room');
         }
         var gueststotal2 = parseFloat($('#guest2').val());
            if(gueststotal2 > 3){
                  $('#guest2').val(3);
             alert('3 Person Allowed In One Room');
         }
         var gueststotal3 = parseFloat($('#guest3').val());
           if(gueststotal3 > 3){
               $('#guest3').val(3);
             alert('3 Person Allowed In One Room');
         }
         var gueststotal4 = parseFloat($('#guest4').val());
          if(gueststotal4 > 3){
               $('#guest4').val(3);
             alert('3 Person Allowed In One Room');
         }
         var total = 0;
        var max_guest  = room * 3;
        if(gueststotal === 0){
      var  aa = 1;
        }
        else{
         
            if(gueststotal0 !='NaN'){
                if(gueststotal0 > 2){
                    gueststotal0 = 3;
                }
                 
                 total= total+gueststotal0;
                  
            }
             if(gueststotal1 !='NaN'){
                   if(gueststotal1 > 2){
                    
                    gueststotal1 = 3;
                }
                 total= total+gueststotal1;
             } 
               if(gueststotal2 !='NaN'){
                if(gueststotal2 > 2){
                    gueststotal2 = 3;
                }
                   total= total+gueststotal2;
             } 
             
               if(gueststotal3 !='NaN'){
                if(gueststotal3 > 2){
                    gueststotal3 = 3;
                }
                   total= total+gueststotal3;
             } 
               if(gueststotal4 !='NaN'){
               if(gueststotal4 > 2){
                    gueststotal4 = 3;
                }
                  total= total+gueststotal4;
             } 
          
              $('.gueststotal').text(total); 
                 sessionStorage.setItem("guest",total);
             
             
        }
       
    };

jQuery(document).ready(function(){
        // This button will increment the value
        $('.qtyplus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment only if value is < 20
                if (currentVal < 3)
                {
                  $('input[name='+fieldName+']').val(currentVal + 1);
                  $('.qtyminus').val("-").removeAttr('style');
                }
                else
                {
                	$('.qtyplus').val("+").css('color','#aaa');
                    $('.qtyplus').val("+").css('cursor','not-allowed');
                }
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(1);
            }
        });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 1) {
            // Decrement one only if value is > 1
            $('input[name='+fieldName+']').val(currentVal - 1);
             $('.qtyplus').val("+").removeAttr('style');
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
            $('.qtyminus').val("-").css('color','#aaa');
            $('.qtyminus').val("-").css('cursor','not-allowed');
        }
    });
});


$("#nsnhotelsblogsliders").owlCarousel(
    {
        nav: false,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 5000,
        loop:false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    }
); 





$("#searchslider").owlCarousel(
    {
        nav: false,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    }
); 



$("#offer_bannerslider").owlCarousel(
    {
        nav: true,
        dots:false,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 2000,
        navText:[],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    }
); 
