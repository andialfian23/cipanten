<div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
        <div class="card shadow mt-4">
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
    <div class="col-lg-4">
        <div class="card shadow mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="text-center">Data Karyawan</h5>
                        <table class="table table-sm">
                            <tr>
                                <th>NIK</th>
                                <th id="nik"></th>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <th id="nama"></th>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <th id="jabatan"></th>
                            </tr>
                            <tr>
                                <th>Bagian</th>
                                <th id="dept"></th>
                            </tr>
                            <tr>
                                <th>Waktu Absensi</th>
                                <th id="waktu"></th>
                            </tr>
                        </table>
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
        $.redirectPost(result.code);
    }
};

let decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
decoder.buildSelectMenu("select");
decoder.play();
$('select').on('change', function() {
    decoder.stop().play();
});

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
                if (res.status == 1) {
                    $(document).find('#nik').text(": " + res.data.nik);
                    $(document).find('#nama').text(": " + res.data.nama);
                    $(document).find('#dept').text(": " + res.data.dept);
                    $(document).find('#jabatan').text(": " + res.data.jabatan);
                    $(document).find('#waktu').text(": " + res.data.waktu);
                    setTimeout(() => {
                        toastr.success(res.pesan);
                    }, 2000);
                } else {
                    $(document).find('#nik').text('');
                    $(document).find('#nama').text('');
                    $(document).find('#dept').text('');
                    $(document).find('#jabatan').text('');
                    $(document).find('#waktu').text('');
                    setTimeout(() => {
                        toastr.error(res.pesan);
                    }, 2000);
                }
                decoder.stop().play();
            }
        });
    }
});

//CONFIGURASI CAMERA
decoder.options.zoom = 0;
decoder.options.flipHorizontal = true;
</script>