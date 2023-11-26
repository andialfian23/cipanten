<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body text-center">

                <h3>Silahkan arahkan QR CODE ke kamera!</h3>

                <div class="row mt-2">
                    <div class="col-md-12 text-center  py-4">

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
    <!-- <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Data Absensi Hari Ini</div>
            <div class="card-body">
                <table class="table" width="100%" id="tbl-absensi">
                    <thead class="bg-gradient-dark">
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div> -->
</div>

<script type="text/javascript" src="<?= base_url() ?>extra-libs/webcodecam/js/qrcodelib.js"></script>
<script type="text/javascript" src="<?= base_url() ?>extra-libs/webcodecam/js/webcodecamjquery.js"></script>
<script type="text/javascript">
var arg = {
    resultFunction: function(result) {
        $.redirectPost(result.code);
    }
};

let decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
decoder.buildSelectMenu("select");
decoder.play();
$('select').on('change', function() {
    decoder.stop().play();
});

// jquery extend function
$.extend({
    redirectPost: function(value) {
        let params = {
            no_qr: value
        }

        $.ajax({
            url: '<?= base_url("scan_qr/proses_scan") ?>',
            type: 'POST',
            data: params,
            dataType: 'json',
            success: function(res) {
                decoder.stop();
                setTimeout(() => {
                    toastr.success('Berhasil Melakukan Absensi');
                    decoder.stop().play();
                }, 2000);
            }
        });
    }
});

//CONFIGURASI CAMERA
decoder.options.zoom = 0;
decoder.options.flipHorizontal = true;
</script>