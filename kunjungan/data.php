<?php require_once"../_config/config.php"; ?>
<?php include_once('../_header.php'); ?>

	<div class="box">
		<h1>Kunjungan Pasien</h1>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
		<h4>
			<small>Data kunjungan pasien 1 tahun terakhir</small>
		</h4>
		<form method="post" name="proses">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="kunjungan">
					<thead>
						<tr>
							<th>No Identitas</th>
							<th>Nama Pasien</th>
							<th>Kunjungan</th>
							<th><i class="glyphicon glyphicon-cog"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT * FROM tb_pasien";
						$sql_kunjungan = mysqli_query($con, $query) or die(mysqli_error($con));
						while($data = mysqli_fetch_array($sql_kunjungan)){ ?>
							<tr>
								<td><?= $data['nomor_identitas']; ?></td>
								<td><?= $data['nama_pasien']; ?></td>
								<td>
									<?php
									$id_pasien = $data['id_pasien'];
									$tgl_sekarang = date('Y-m-d');
									$limit = date('Y-m-d', strtotime('-365 days', strtotime($tgl_sekarang)));
									$kunjungan = "SELECT * FROM tb_rekammedis
										INNER JOIN tb_pasien ON tb_rekammedis.id_pasien = tb_pasien.id_pasien
										WHERE tb_pasien.id_pasien = '$id_pasien'
										AND '$limit' <= tgl_periksa AND tgl_periksa <= '$tgl_sekarang'
									";
									$jml_kunjungan = mysqli_query($con, $kunjungan) or die(mysqli_error($con));
									?>
									<?= mysqli_num_rows($jml_kunjungan); ?> kali
								</td>
								<td align="center">
									<a href="detail.php?id=<?= $data['id_pasien'] ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
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
			$('#kunjungan').DataTable({
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