$("#general-button-view-all").click( () => {
	$("#general-alert-label-description").toggleClass("reading");
	if($("#general-button-view-all").text() == "Ver mais"){
		$("#general-button-view-all").text("Ver menos");
	} else {
		$("#general-button-view-all").text("Ver mais");
	}
});

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
    if (n > slides.length) {
        slideIndex = 1
    }

    if (n < 1) {
        slideIndex = slides.length
    }

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    if (slides.length > 0) {
        slides[slideIndex - 1].style.display = "block";
    }
}

$(document).ready(function() {
    var interval = setInterval(function() {
        var $curr = $('.mySlides:visible'),
            $next = ($curr.next().length) ? $curr.next() : $('.mySlides').first();
        $next.css('z-index', 2).fadeIn('slow', function() {
            $curr.hide().css('z-index', 0);
            $next.css('z-index', 1);
        });
    }, 5000);

    $('.mySlides').hover(function() {
        clearInterval(interval);
    }, function() {
        interval = setInterval(function() {
            var $curr = $('.mySlides:visible'),
                $next = ($curr.next().length) ? $curr.next() : $('.mySlides').first();
            $next.css('z-index', 2).fadeIn('slow', function() {
                $curr.hide().css('z-index', 0);
                $next.css('z-index', 1);
            });
        }, 5000);
    });
});

$(document).ready(function () {
    $('body').on('keyup', '#username', function () {

        var user = $(this).val(),
        name = $('#result-register-card-display-username > h4');
        if (user == '') {
            name.html("Seu nome aqui!");
        } else {
            name.html(user);
        }
    });
});

$(document).ready(function () {
    $('body').on('keyup', '#username', function () {

        var user = $(this).val(),
        name = $('#login-info > h6 > name');
        if (user == '') {
            name.html("Hey");
        } else {
            name.html(user);
        }
    });
});

$(document).ready(function () {

    $('.close-modal').on('click', function () {
        $('.modal-container').removeClass('active');
    });

    $('#news-open-form').on('click', function () {
        $('.modal-container').addClass('active');
    });

});

function Style(type, argument) {
    document.execCommand(type, false, null);
}

$(document).ready(function(){
   $("#errands-form").on("submit", function () {
        var value = $('.errand-message').html();
        $(this).append("<input type='hidden' name='errand_message' value='" + value + "'>");
    });
});
