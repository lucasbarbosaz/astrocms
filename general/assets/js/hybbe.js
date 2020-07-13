console.log("%cAVISO IMPORTANTE", "font: bold 40px sans-serif;color: rgb(237, 28, 28);text-shadow: 2px 0 0 rgb(0, 0, 0), -2px 0 0 rgb(0, 0, 0), 0 2px 0 rgb(0, 0, 0), 0 -2px 0 rgb(0, 0, 0), 1px 1px rgb(0, 0, 0), -1px -1px 0 rgb(0, 0, 0), 1px -1px 0 rgb(0, 0, 0), -1px 1px 0 rgb(0, 0, 0)");
console.log("%cO console, é uma ferramenta de desenvolvimento. Caso alguém peça para que você cole algo aqui dizendo que você pode ganhar qualquer tipo de moeda, não acredite, do contrário você vai estar comprometendo o acesso da sua conta através de algo que você colou aqui.\n\nTudo que você fizer através do console, será de total responsabilidade sua!\n\Harbe Hotel\n", "bold 20px sans-serif");

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;

		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};

		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);

		if (callNow) {
			func.apply(context, args)
		};
	};
}

var URL = document.location.origin,
API = URL + '/config/api',
CDN = URL + '/general',
HOTELNAME = 'Harbe Hotel';

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

$(document).on('keyup', 'input[name="username"]', debounce(function() {
	$.post(API + '/look.php', {
		username: $(this).val()
	}, function(data) {
		if (data['look'].length > 0) {
			$('.username-look').css('background-image', 'url(' + data['look'] + ')');
		} else {
			$('.username-look').css('background-image', 'url(' + CDN + '/assets/img/ghost.png)');
		}
	});
}, 500));
