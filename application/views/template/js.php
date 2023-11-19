<!--   Core JS Files   -->
<script src="<?= base_url() ?>argon/assets/js/core/popper.min.js"></script>
<script src="<?= base_url() ?>argon/assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url() ?>argon/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>argon/assets/js/plugins/smooth-scrollbar.min.js"></script>

<script>
var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
        damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
</script>

<script src="<?= base_url() ?>extra-libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>extra-libs/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>extra-libs/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>extra-libs/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>extra-libs/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>extra-libs/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>extra-libs/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>extra-libs/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>extra-libs/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="<?= base_url() ?>argon/assets/js/argon-dashboard.min.js?v=2.0.4"></script>