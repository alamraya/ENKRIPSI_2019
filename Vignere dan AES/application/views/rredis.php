<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
    <link rel="stylesheet" href="<?php echo base_url('vendor/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendor/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 pt-2">
                <form method="POST" action="javascript:void(0)" id="add">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover" id="table-bio">
            <thead>
                <th>Nama</th>
                <th>Alamat</th>
            </thead>
            <tbody></tbody>
            <tfoot>
                <th>Nama</th>
                <th>Alamat</th>
            </tfoot>
        </table>
    </div>
    <script src="<?php echo base_url('vendor/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('vendor/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('vendor/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('vendor/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            var table = $('#table-bio').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url('rredis/get_data') ?>",
                    "type": "POST",
                    "dataType": "Json",
                    "dataSrc": 'data'
                },
                "columns": [{
                        "data": "nama"
                    },
                    {
                        "data": "alamat"
                    },
                ],
            });
            $('#add').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    'url': '<?php echo base_url('rredis/add') ?>',
                    'method': 'POST',
                    'data': $('#add').serialize(),
                    'success': function(data) {
                        table.draw();
                    }
                });
            });
        });
    </script>
</body>

</html>