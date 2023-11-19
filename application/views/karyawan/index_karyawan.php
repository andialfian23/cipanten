<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Karyawan</h6>
            </div>
            <div class="card-body px-3 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-bordered table-striped" id="tbl-karyawan">
                        <thead>
                            <tr>
                                <th class=" font-weight-bolder ">
                                    No
                                </th>
                                <th class=" font-weight-bolder">
                                    Nama</th>
                                <th class=" font-weight-bolder">
                                    Alamat</th>
                                <th class=" font-weight-bolder">
                                    No HP</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Andi Alfian</td>
                                <td>Sindang</td>
                                <td>0882000560334</td>
                                <td class="text-center align-middle">
                                    <a href="#" class="btn btn-info btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#tbl-karyawan').DataTable();
});
</script>