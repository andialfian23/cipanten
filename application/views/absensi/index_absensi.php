<style>
#tbl-absensi th {
    text-align: center;
    font-size: 12px !important;
}

.inptd {
    width: 100%;
}

#tbl-absensi td {
    font-size: 12px !important;
}

.btn-kecil {
    padding: 2px !important;
    font-size: 14px !important;
}

.nwrap {
    white-space: nowrap;
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
                                <th>Bagian</th>
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

<div class="modal fade" id="modal-edit-absensi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Edit Absensi</h5>
                <button type="button" class="btn btn-close bg-gradient-danger " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-sm table-bordered" width="100%">
                            <tr>
                                <th colspan="2" class="bg-dark text-center">Identitas Karyawan</th>
                            </tr>
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
                                <th id="bagian"></th>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <th id="tgl_absensi"></th>
                            </tr>
                        </table>
                        <table class="table table-sm table-bordered" width="100%" id="tbl-waktu">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center bg-dark">Waktu Absensi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">--</th>
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
                data: 'nama',
                className: 'nwrap'
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
                className: 'text-center nwrap',
                render: function(data, type, row, meta) {
                    return `<a href="#modal-edit-absensi" data-toggle="modal" class="btn btn-info btn-sm btn-edit" data-id="` +
                        row.nik + `" data-tgl="` + row.tanggal + `"><i class="fas fa-edit"></i></a>
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

    $(document).on('click', '.btn-edit', function() {
        let tgl = $(this).data('tgl');
        $.ajax({
            url: '<?= base_url('absensi/get_absensi') ?>',
            type: 'POST',
            data: {
                nik: $(this).data('id'),
                tgl: tgl,
            },
            dataType: 'json',
            success: function(res) {
                //
                $(document).find('#nik').text(res.nik);
                $(document).find('#nama').text(res.nama);
                $(document).find('#jabatan').text(res.jabatan);
                $(document).find('#bagian').text(res.dept);
                $(document).find('#tgl_absensi').text(tgl);

                $(document).find('#tbl-waktu tbody').empty();

                $.each(res.data_waktu, function(i, row) {
                    $(document).find('#tbl-waktu tbody').append(`<tr>
                        <th class="text-center">
                            <input type="time" class="form-control form-control-sm inpwaktu" data-id="` + row.id +
                        `" value="` + row.waktu + `" />
                        </th>
                        <th class="text-center">
                            <button type="button" data-id="` + row.id + `" class="btn btn-kecil btn-primary btn-save-edit">Simpan</button>
                            <button type="button" data-id="` + row.id + `" class="btn btn-kecil btn-danger btn-hapus-absensi" onclick="return confirm('Apakah anda yakin akan menghapus data waktu ini?')">Hapus</button>
                        </th>
                    </tr>`);
                })
            }
        });
    });

    $(document).on('click', '.btn-save-edit', function() {
        let id = $(this).data('id');
        let waktu = $(document).find('.inpwaktu[data-id="' + id + '"]').val();

        $.ajax({
            url: '<?= base_url('absensi/update') ?>',
            type: 'POST',
            data: {
                id: id,
                waktu: waktu
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == 1) {
                    toastr.success(res.pesan);
                    setTimeout(() => {
                        window.location.replace('<?= base_url('absensi') ?>');
                    }, 2000);
                } else {
                    toastr.error(res.pesan);
                }
            }
        });
    });

    $(document).on('click', '.btn-hapus-absensi', function() {
        $.ajax({
            url: '<?= base_url('absensi/delete2') ?>',
            type: 'POST',
            data: {
                id: $(this).data('id'),
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == 1) {
                    toastr.success(res.pesan);
                    setTimeout(() => {
                        window.location.replace('<?= base_url('absensi') ?>');
                    }, 2000);
                } else {
                    toastr.error(res.pesan);
                }
            }
        });
    });

});
</script>