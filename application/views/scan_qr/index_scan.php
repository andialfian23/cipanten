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
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive p-2">
                            <table class="table table-bordered table-striped table-hover table-sm" border="2"
                                id="tbl-absensi">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th class="font-weight-bolder">No</th>
                                        <th class="font-weight-bolder">NIK</th>
                                        <th class="font-weight-bolder">Nama</th>
                                        <th class="font-weight-bolder">Jabatan</th>
                                        <th class="font-weight-bolder">Tanggal</th>
                                        <th class="font-weight-bolder">Masuk</th>
                                        <th class="font-weight-bolder">Pulang</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
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
        var redirect = '<?= base_url("scan_qr/proses_scan") ?>';
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

function load_data() {
    $.ajax({
        url: '<?= base_url('json/absensi') ?>',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            $('#tbl-absensi tbody').empty();
            let no = 1;
            let tbody = [];
            $.each(res.data, function(i, row) {
                tbody[i] = `
                            <tr>
                                <td>` + no + `</td>
                                <td>` + row.id_karyawan + `</td>
                                <td>` + row.nama + `</td>
                                <td>` + row.nama_jabatan + `</td>
                                <td>` + row.tanggal + `</td>
                                <td>` + row.waktu_masuk + `</td>
                                <td>` + row.waktu_pulang + `</td>
                            </tr>
                            `;
                no++;
            });
            $('#tbl-absensi tbody').append(tbody.join(''));
        },
        complete: function() {
            $('#tbl-absensi').DataTable();
        }
    });
}

$(function() {
    load_data();
});
</script>