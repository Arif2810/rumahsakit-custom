<?php require_once"../_config/config.php"; ?>
<?php include_once('../_header.php'); ?>

	<div class="box">
		<h1>Detail Kunjungan</h1>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
		<h4>
			<small>Data Detail Kunjungan Pasien</small>
		</h4>
		<form method="post" name="proses">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="rekammedis">
					<thead>
						<tr style="background-color: #dfdfdf;">
							<th>No.</th>
							<th>Tanggal Periksa</th>
							<th>Poli</th>
							<th>Nama Pasien</th>
							<th>Keluhan</th>
							<th>Nama Dokter</th>
							<th>Diagnosa</th>
							<th>Obat</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
            $id_pasien = @$_GET['id'];
            $tgl_sekarang = date('Y-m-d');
            $limit = date('Y-m-d', strtotime('-365 days', strtotime($tgl_sekarang)));
            $query = "SELECT * FROM tb_rekammedis
              INNER JOIN tb_poliklinik ON tb_rekammedis.id_poli = tb_poliklinik.id_poli
              INNER JOIN tb_pasien ON tb_rekammedis.id_pasien = tb_pasien.id_pasien
              WHERE tb_pasien.id_pasien = '$id_pasien'
              AND '$limit' <= tgl_periksa AND tgl_periksa <= '$tgl_sekarang'
              ORDER BY tb_rekammedis.tgl_periksa DESC
            ";

						$sql_rm = mysqli_query($con, $query) or die(mysqli_error($con));
						while($data = mysqli_fetch_array($sql_rm)){ ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= tgl_indo($data['tgl_periksa']); ?></td>
								<td><?= $data['nama_poli'] ?></td>
								<td><?= $data['nama_pasien'] ?></td>
								<td><?= $data['keluhan'] ?></td>
								<td><?= $data['dokter'] ?></td>
								<td><?= $data['diagnosa'] ?></td>
								<td>
									<?php
									$sql_obat = mysqli_query($con, "SELECT * FROM tb_rm_obat JOIN tb_obat ON tb_rm_obat.id_obat = tb_obat.id_obat WHERE id_rm = '$data[id_rm]'") or die(mysqli_error($con));
									while($data_obat = mysqli_fetch_array($sql_obat)){
										echo $data_obat['nama_obat']. "<br>";
									}
									?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</form>
	</div>


	<script>
		$(document).ready(function(){
			$('#rekammedis').DataTable({
				dom: 'Bfrtip',
				buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
				columnDefs: [{
					"searchable": false,
					"orderable": false,
					"targets": 7
				}],
				"order": [0, "asc"]
			})
		});
	</script>

<?php include_once('../_footer.php'); ?>                                                       