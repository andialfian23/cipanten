<style>
#tbl-absensi th {
    text-align: center;
    font-size: 12px !important;
}

.inptd {
    width: 100%;
}

.inpdate {
    width: 120px;
    font-size: 14px;
    text-align: center;
    border-radius: none;
    border: 1px solid #ffc107;
}

.inpselect {
    font-size: 14px;
    border: 1px solid #ffc107;
}

#tbl-absensi td {
    font-size: 12px !important;
}
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class=" row d-flex justify-content-between">

                    <div class="col-lg-3 mt-2">
                        <span class="mx-2">Data Absensi</span>
                    </div>
                    <div class="text-right ml-auto pr-3">
                        <div class="input-group input-group-sm d-flex justify-content-end">
                            <a href="<?= base_url('scan_qr') ?>" class="btn btn-sm bg-gradient-success mr-2 mt-1">
                                <i class="fas fa-qrcode mr-1"></i> Scan QR-Code</a>

                            <div class="input-group-prepend mt-1">
                                <span class="input-group-text border-warning bg-dark">Bagian</span>
                            </div>
                            <select id="dept" class="inpselect mt-1 mr-2">
                                <option value="All">Semua</option>
                                <?php foreach($dept as $d){ ?>
                                <option value="<?= $d->id_dept ?>"><?= $d->nama_dept ?></option>
                                <?php } ?>
                            </select>

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
                                <!-- <th>No</th> -->
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Dept</th>
                                <th>Tanggal</th>
                                <th>Masuk</th>
                                <th>Telat Masuk</th>
                                <th>Pulang</th>
                                <th>Kerja</th>
                                <th>--</th>
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
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        lengthMenu: [
            [5, 10, 25],
            ['5', '10', '25']
        ],
        pageLength: 10,
        buttons: [{
                extend: 'pageLength',
                text: 'Tampilkan Data',
                className: 'btn btn-secondary btn-sm',
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-print"></i> Cetak Laporan',
                className: 'btn bg-gradient-blue btn-sm',
                action: function(e, dt, node, config) {
                    setTimeout(function() {
                        window.open("<?= base_url('absensi/print') ?>", '_blank');
                    }, 1000);
                }
            },
        ],
        language: {
            url: "<?= base_url('extra-libs/ID.json') ?>",
        },
        serverSide: true,
        processing: true,
        "columnDefs": [{
            "orderable": false,
            "targets": [9]
        }],
        ajax: {
            url: "<?= base_url('absensi/get_data') ?>",
            type: "POST",
            data: function(d) {
                d.xBegin = $('#xBegin').val();
                d.xEnd = $('#xEnd').val();
                d.dept = $('#dept').val();
                localStorage.setItem('xBegin', "" + d.xBegin + "");
                localStorage.setItem('xEnd', "" + d.xEnd + "");
                localStorage.setItem('dept', "" + d.dept + "");
            }
        },
        columns: [{
                data: 'nik'
            },
            {
                data: 'nama'
            },
            {
                data: 'nama_jabatan'
            },
            {
                data: 'nama_dept'
            },
            {
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
            {
                data: 'nik',
                className: 'text-center',
                render: function(data, type, row, meta) {
                    // return `<a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                    return `<a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('absensi/delete/') ?>` + row.nik + `/` + row.tanggal + `"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i
                                class="fas fa-trash-alt"></i></a>`;
                }
            },
        ],
    });


    $(document).on('click', '#cari', function() {
        table.ajax.reload(null, false);
    });
});
</script>