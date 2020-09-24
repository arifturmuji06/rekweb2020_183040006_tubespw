const sideNav = document.querySelectorAll('.sidenav');
M.Sidenav.init(sideNav);


$(document).ready(function(){
    $('select').formSelect();
  });



$(document).ready(function(){
    $('.carousel').carousel();
  });

$(document).ready(function() {

	// hilangkan tombol cari
	$('#cari').hide();

	// event ketika keyword ditulis
	$('#keyword').on('keyup', function() {
		// loader
		$('.loader').show();

		// ajax load
		// $('#container').load('ajax/buku.php?keyword=' + $('#keyword').val());

		// $.get()
		$.get('../ajax/buku-library.php?keyword=' + $('#keyword').val(), function(data) {

			$('#container-ajax').html(data);
			$('.loader').hide();

		});
	});

})
