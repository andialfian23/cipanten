<!-- JavaScript webcodecam -->
<script src="<?= base_url() ?>extra-libs/webcodecam/js/jquery.min.js"></script>
<script src="<?= base_url() ?>extra-libs/webcodecam/js/bootstrap.min.js"></script>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body text-center">

                <h3>Silahkan arahkan QR CODE ke kamera!</h3>

                <div class="row mt-2">
                    <div class="col-md-12 text-center">

                        <canvas></canvas>

                        <div class="row">
                            <hr>
                            <div class="col-md-3 col-sm-1"></div>
                            <div class="col-md-6 col-sm-8 col-xs-12">
                                <select class="form-control"></select>
                            </div>
                            <div class="col-md-3 col-sm-1"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url() ?>extra-libs/webcodecam/js/qrcodelib.js"></script>
<script type="text/javascript" src="<?= base_url() ?>extra-libs/webcodecam/js/webcodecamjquery.js"></script>
<script type="text/javascript">
var arg = {
    resultFunction: function(result) {
        var redirect = '<?= base_url("Admin/scan") ?>';
        $.redirectPost(redirect, {
            no_qr: result.code //no_qr
        });
    }
};

var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
decoder.buildSelectMenu("select");
decoder.play();
$('select').on('change', function() {
    decoder.stop().play();
});

// jquery extend function
$.extend({
    redirectPost: function(location, args) {
        var form = '';
        $.each(args, function(key, value) {
            form += '<input type="hidden" name="' + key + '" value="' + value + '">';
        });
        $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo('body').submit();
    }
});

//CONFIGURASI CAMERA
decoder.options.zoom = 0;
decoder.options.flipHorizontal = true;
</script>