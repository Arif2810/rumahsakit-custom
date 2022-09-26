<?php require_once"../_config/config.php"; ?>
<?php include_once('../_header.php'); ?>
	<div class="box">
		<h1>Pasien</h1>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
		<h4>
			<small>Data Pasien</small>
			<div class="pull-right">
				<?php if($_SESSION['level'] == 'Admin'){ ?>
					<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
					<a href="add.php" class="btn btn-success btn-xs" disabled><i class="glyphicon glyphicon-plus"></i> Tambah Pasien</a>
					<a href="import.php" class="btn btn-info btn-xs" disabled><i class="glyphicon glyphicon-import"></i> Import Pasien</a>
				<?php }
				else{ ?>
					<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
					<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Pasien</a>
					<a href="import.php" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-import"></i> Import Pasien</a>
				<?php } ?>

			</div>
		</h4>

		<div class="table-responsive">
			<?php if($_SESSION['level'] == 'Admin'){ ?>
				<table class="table table-bordered table-striped table-hover" id="pasien-admin">
			<?php }
			else{ ?>
				<table class="table table-bordered table-striped table-hover" id="pasien">
			<?php } ?>
				<thead>
					<tr>
						<th>Nomor Identitas</th>
						<th>Nama Pasien</th>
						<th>Jenis Kelamin</th>
						<th>Alamat</th>
						<th>No. Telepon</th>
						<th><i class="glyphicon glyphicon-cog"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>


	<script>
		$(document).ready(function(){
			$('#pasien').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "pasien-data.php",
				// scrollY : '250px',
				dom: 'Bfrtip',
				buttons: [
					'copy',
					{
						extend: 'excel',
						messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
					},
					{
						extend: 'csv'
					},
					{
						extend: 'pdfHtml5',
						download: 'open',
						messageBottom: null
					},
					{
						extend: 'print',
						messageTop: function () {
							printCounter++;

							if ( printCounter === 1 ) {
								return 'This is the first time you have printed this document.';
							}
							else {
								return 'You have printed this document '+printCounter+' times';
							}
						},
						messageBottom: null
					}
				],
				columnDefs:[{
					"searchable": false,
					"orderable": false,
					"targets": 5,
					"render": function(data, type, row){
						var btn = "<center><a href=\"edit.php?id="+data+"\" class=\"btn btn-warning btn-xs\"><i class=\"glyphicon glyphicon-edit\"></i></a> <a href=\"del.php?id="+data+"\" onclick=\"return confirm('Yakin menghapus data?');\" class=\"btn btn-danger btn-xs\"><i class=\"glyphicon glyphicon-trash\"></i></a></center>";
						return btn;
					}
				}]
			});
		});

		$(document).ready(function(){
			$('#pasien-admin').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "pasien-data.php",
				// scrollY : '250px',
				dom: 'Bfrtip',
				buttons: [
					'copy',
					{
						extend: 'excel',
						messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
					},
					{
						extend: 'csv'
					},
					{
						extend: 'pdfHtml5',
						download: 'open',
						messageBottom: null
					},
					{
						extend: 'print',
						messageTop: function () {
							printCounter++;

							if ( printCounter === 1 ) {
								return 'This is the first time you have printed this document.';
							}
							else {
								return 'You have printed this document '+printCounter+' times';
							}
						},
						messageBottom: null
					}
				],
				columnDefs:[{
					"searchable": false,
					"orderable": false,
					"targets": 5,
					"render": function(data, type, row){
						var btn = "<center><a href=\"edit.php?id="+data+"\" class=\"btn btn-warning btn-xs\" disabled><i class=\"glyphicon glyphicon-edit\"></i></a> <a href=\"del.php?id="+data+"\" onclick=\"return confirm('Yakin menghapus data?');\" class=\"btn btn-danger btn-xs\" disabled><i class=\"glyphicon glyphicon-trash\"></i></a></center>";
						return btn;
					}
				}]
			});
		});
	</script>

<?php include_once('../_footer.php'); ?>                                                       