<div class="row">
    <div class="col-lg-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class=" row d-flex justify-content-between">

                    <div class="col-lg-4 mt-2">
                        <span class="mx-2">Absensi Harian</span>
                    </div>
                    <div class="text-right ml-auto pr-3">
                        <div class="input-group input-group-sm d-flex justify-content-end">

                            <div class="input-group-prepend mt-1">
                                <span class="input-group-text border-warning bg-dark">Tanggal</span>
                            </div>
                            <input type="date" class="inpdate mt-1" id="xBegin" value="<?= date('Y-m-01') ?>" />
                            <input type="date" class="inpdate mt-1" id="xEnd" value="<?= date('Y-m-d') ?>" />
                            <div class="input-group-prepend">
                                <button id="cari" type="button"
                                    class="btn bg-gradient-success btn-sm border-warning mt-1">
                                    <i class="fas fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm w-100 responsive" border="2"
                        id="tbl-absensi">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Tanggal</th>
                                <th>Masuk</th>
                                <th>Telat Masuk</th>
                                <th>Pulang</th>
                                <th>Kerja</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    let localStorage = window.localStorage;

    let table = $('#tbl-absensi').DataTable({
        lengthMenu: [
            [5, 10, 25],
            ['5', '10', '25']
        ],
        pageLength: 10,
        language: {
            url: "<?= base_url('extra-libs/ID.json') ?>",
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: "<?= base_url('json/absensi_harian') ?>",
            type: "POST",
            data: function(d) {
                d.xBegin = $('#xBegin').val();
                d.xEnd = $('#xEnd').val();
                d.nik = '<?= $_SESSION['nik'] ?>';
            }
        },
        columns: [{
                data: 'tanggal',
                className: 'text-center',
            },
            {
                data: 'waktu_masuk',
                className: 'text-center',
            },
            {
                data: 'telat_masuk',
                className: 'text-center',
            },
            {
                data: 'waktu_pulang',
                className: 'text-center',
            },
            {
                data: 'waktu_kerja',
                className: 'text-center',
            },
        ],
    });


    $(document).on('click', '#cari', function() {
        table.ajax.reload(null, false);
    });
});
</script>