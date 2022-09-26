<?php include_once('../_header.php'); ?>

	<div class="box">
		<h1>Obat</h1>
		<h4>
			<small>Data Obat</small>
			<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Obat</a>
			</div>
		</h4>
	
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover" id="obat">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Obat</th>
						<th>Keterangan</th>
						<th><i class="glyphicon glyphicon-cog"></i></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$no = 1;
						$query = "SELECT * FROM tb_obat ORDER BY nama_obat ASC";
						$sql_obat = mysqli_query($con, $query) or die(mysqli_error($con));
						while($data = mysqli_fetch_array($sql_obat)){ ?>
							<tr>
								<td><?= $no++; ?>.</td>
								<td><?= $data['nama_obat']; ?></td>
								<td><?= $data['ket_obat']; ?></td>
								<td class="text-center">
									<a href="edit.php?id=<?= $data['id_obat'] ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
									<a href="del.php?id=<?= $data['id_obat'] ?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
								</td>
							</tr>
						<?php } ?>
				</tbody>
			</table>
		</div>

	</div>


	<script>
		$(document).ready(function(){
			$('#obat').DataTable({
				dom: 'Bfrtip',
				buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
				columnDefs: [{
					"searchable": false,
					"orderable": false,
					"targets": 3
				}],
				"order": [0, "asc"]
			})
		});
	</script>


<?php include_once('../_footer.php'); ?>