var modal = document.getElementById("myModal");
var body = document.getElementsByTagName("body")[0];
var seMostro = false

    $("#imagenHLC").fadeTo(2000, 1);
    if ( localStorage.getItem("seMostro")) {
    	$("#descripcionHomeInterno").addClass('displayFlex')
    }
    window.addEventListener('scroll',function(e) {
        if ($(this).scrollTop() > 220 && !seMostro) {
            $("#descripcionHomeInterno").fadeIn(750);
            $("#descripcionHomeInterno").addClass('displayFlex')
            localStorage.setItem("seMostro", "true");
        }
    });

function artistasDiv(nombre) {
    var descripcionJ = document.getElementById("descripcionJ");
    var nombreJ = document.getElementById("nombreJ");
    var descripcionN = document.getElementById("descripcionN");
    var nombreN = document.getElementById("nombreN");

    if (nombre == 'n') {
        descripcionN.style.opacity = '1'
        nombreN.style.opacity = '0'
        descripcionJ.style.opacity = '0'
        nombreJ.style.opacity = '1'
    } else {
        descripcionJ.style.opacity = '1'
        nombreJ.style.opacity = '0'
        descripcionN.style.opacity = '0'
        nombreN.style.opacity = '1'
    }

}

    function mostrarModal(n) {
        imgModal = document.getElementById("imagenModal").src = "img/galeria/" +n;
        body.style.overflowY = "hidden";
        modal.style.display = "flex";
    }

    function cerrarModal(n) {
        body.style.overflowY = "scroll";
        modal.style.display = "none";
    }
    
$(document).ready(function () {
    x = 12

    // if(window.innerWidth > 851) {x = 50}
    // if(window.innerWidth > 550 && window.innerWidth < 850 ) {x = 50}
    if(window.innerWidth < 550) {x = 19}
    y = x ; 
    size_li = $("#galeriaGestion li").length;
    $('#galeriaGestion li:lt('+x+')').show();

    $('#mas').click(function () {
        x= (x+5 <= size_li) ? x+3 : size_li;
        $('#galeriaGestion li:lt('+x+')').show();
        if(x == size_li){
            $('#mas').hide();
            $('#ocultar').show();
        }
    });
    $('#ocultar').click(function () {
        // x=(x-3<0) ? 5 : x-3;
        $('#galeriaGestion li').not(':lt('+y+')').hide();
        $('#mas').show();
        // if(x <= 3){
            $('#ocultar').hide();
        // }

    });
});

    function estaAbierto(number){ 
        open = '0';
        $('#textoGeneralBooking').slideDown();
    }

    $('.open-1').click(function() {
        $('#textoGeneralBooking').slideUp();
        $('#intro-2').slideUp();
        if (open == 1) {
            estaAbierto(1);
            $('#intro-1').slideUp();
            document.getElementsByClassName('open-1')[0].style.borderTop = 'none';
        } else {
            $('#intro-1').slideDown();
            document.getElementById('bookingTitle').style.height = '8vh';   
            document.getElementsByClassName('booking')[0].style.height = '80vh';                
            if (window.matchMedia("(orientation: landscape)").matches) {
                console.log('entra')    
                document.getElementById('bookingTitle').style.height = '11vh';                
            }
            document.getElementsByClassName('open-2')[0].style.borderTop = 'none';
            document.getElementsByClassName('open-1')[0].style.borderTop = '3px solid white';
            open = '1'
        }
    });
    $('.open-2').click(function() {
        $('#textoGeneralBooking').slideUp();
        $('#intro-1').slideUp();
        if (open == 2) {
            estaAbierto(2);
            $('#intro-2').slideUp();
            document.getElementsByClassName('open-2')[0].style.borderTop = 'none';
        } else {
            $('#intro-2').slideDown();
            document.getElementById('bookingTitle').style.height = '8vh';                
            document.getElementsByClassName('booking')[0].style.height = '80vh';                
            if (window.matchMedia("(orientation: landscape)").matches) {
                document.getElementById('bookingTitle').style.height = '11vh';            
                console.log('entra')    
            }
            document.getElementsByClassName('open-1')[0].style.borderTop = 'none';
            document.getElementsByClassName('open-2')[0].style.borderTop = '3px solid white';
            open = '2'
        }
    });

