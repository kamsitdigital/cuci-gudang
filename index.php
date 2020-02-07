<!DOCTYPE html>
<html>
<head>
	<title>Cuci Gudang Indonesia</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="/img/favicon.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
<style>
body {
    margin: 0;
    font-family: Nunito,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #343a40;
    text-align: left;
    background-color: #fff;
}
    .card-body{
        height: 215px;
    }
    .absolute-bottom{
        position: absolute;
        bottom: 10px;
    }
    .image-loading{
        width: 100%;
    }
</style>
</head>
<body class="bg-light">
	<div class="container mt-3 mb-5">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<h2 class="text-center" style="font-weight: 800;">CUCI GUDANG GILA-GILAAN</h2>
				<h4 class="text-center">Dapatkan Produk Terbaik dengan Harga GILA-GILAAN, Silahkan Pilih dan kontak CS Kami untuk membeli produk</h4>
			</div>
		</div>
		<div class="row mt-3" id="result-here" data-page="0">
		</div>

        <div class="row mt-3">
            <div class="text-center image-loading">
                <img src="./loading.gif" id="loading"/>
            </div>
            <div class="text-center image-loading">
                <button id="load-more" class="btn btn-primary" style="display: none">
                    Load More...
                </button>
            </div>
        </div>
	</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="./endles-scroll.min.js"></script>
    <script>
        $(document).ready(function() {
            const theURL    = '<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ;?>';

            let thePage     = $('#result-here').data('page');
            $.ajax({
                url: theURL + 'data.php?page=' + thePage,
                dataType: 'html',
                success: function(result) {
                    let responseResult  = JSON.parse(result);
                    let HTML    = '';
                    $.each(responseResult, function (key, val) {
                        HTML    += '' +
                            '<div class="col-md-3 mt-3">\n' +
                            '<div class="card">\n' +
                            '<img src="' + val.image + '" class="card-img-top" height="250">\n' +
                            '<div class="card-body">\n' +
                            '<h5 class="card-title">'+ val.title_en +'</h5>\n' +
                            '<div class="absolute-bottom">' +
                            '<p class="card-text">Harga Mulai <b>Rp '+ val.price +'</b></p>\n' +
                            '<div class="text-center">\n' +
                            '<a href="'+ val.wa_link +'" target="_blank" class="btn btn-success">WhatsApp Sekarang</a>\n' +
                            '</div>' +
                            '</div>\n' +
                            '</div>\n' +
                            '</div>\n' +
                            '</div>';
                    });
                    $('#result-here').data('page', (thePage+1));
                    $('#result-here').append(HTML);

                    $('#loading').hide();
                    $('#load-more').show();
                }
            });

            $('#load-more').on('click', function(e){
                $(this).text('Loading...');
                $(this).attr('disabled', true);

                let newThis = $(this);

                $('#loading').show();
                // ajax
                let thePage     = $('#result-here').data('page');
                $.ajax({
                    url: theURL + 'data.php?page=' + thePage,
                    dataType: 'html',
                    success: function(result) {
                        let responseResult  = JSON.parse(result);
                        let HTML    = '';
                        $.each(responseResult, function (key, val) {
                            HTML    += '' +
                                '<div class="col-md-3 mt-3">\n' +
                                '<div class="card">\n' +
                                '<img src="' + val.image + '" class="card-img-top" height="250">\n' +
                                '<div class="card-body">\n' +
                                '<h5 class="card-title">'+ val.title_en +'</h5>\n' +
                                '<div class="absolute-bottom">' +
                                '<p class="card-text">Harga Mulai <b>Rp '+ val.price +'</b></p>\n' +
                                '<div class="text-center">\n' +
                                '<a href="'+ val.wa_link +'" target="_blank" class="btn btn-success">WhatsApp Sekarang</a>\n' +
                                '</div>' +
                                '</div>\n' +
                                '</div>\n' +
                                '</div>\n' +
                                '</div>';
                        });
                        $('#result-here').data('page', (thePage+1));
                        $('#result-here').append(HTML);

                        $('#loading').hide();

                        newThis.text('Load More...');
                        newThis.attr('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>