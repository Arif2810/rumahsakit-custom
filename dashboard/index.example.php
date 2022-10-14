<?php include_once('../_header.php'); ?>

<div class="row">
	<div class="col-lg-12">
		<h1>Dashboard</h1>
		<p>Selamat datang <mark> <?= $_SESSION['nama_user']; ?> </mark> di website Rumah Sakit (Rekam Medis)</p>
		<a href="#menu-toggle" class="btn btn-default"id="menu-toggle">Toggle Menu</a>
	</div>
</div>
<hr>

<div class="row">
	<div class="col-md-12">
		<center>
			<h4>GRAFIK KUNJUNGAN PASIEN</h4>
		</center>
		<div style="width: 100%;margin: 0px auto;">
			<canvas id="myChart"></canvas>
		</div>
	</div>
</div>
<hr>

<?php if($_SESSION['level'] == 'Admin' || $_SESSION['level'] == 'Petugas'){ ?>
<div class="row">
	<div class="col-lg-12">
		<h4 class="text-danger"><i class="glyphicon glyphicon-info-sign"></i> Notifikasi</h4>
		<?php 
		$tgl_sekarang = date('Y-m-d');
		// $limit2 = date('Y-m-d', strtotime('-1 days', strtotime($tgl_sekarang)));
		$limit = date('Y-m-d', strtotime('+7 days', strtotime($tgl_sekarang)));

		$query = "SELECT * FROM tb_rekammedis
		INNER JOIN tb_pasien ON tb_rekammedis.id_pasien = tb_pasien.id_pasien
		WHERE tgl_kembali >= '$tgl_sekarang' AND tgl_kembali <= '$limit'
		";

		$sql_notif = mysqli_query($con, $query) or die(mysqli_error($con));

		if($sql_notif->num_rows == 0){
		?>
			<div class="alert alert-success" role="alert">Tidak ada Notifikasi</div>
		<?php }
		else{ ?>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover" id="notif">
						<thead>
							<tr>
								<th>No Identitas</th>
								<th>Nama Pasien</th>
								<th>Tgl Periksa</th>
								<th>Tgl Kembali</th>
								<th>No. Telepon</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php
								while($data = mysqli_fetch_array($sql_notif)) {
							?>
							<tr>
								<td><?= $data['nomor_identitas']; ?></td>
								<td><?= $data['nama_pasien']; ?></td>
								<td><?= tgl_indo($data['tgl_periksa']); ?></td>
								<td><?= tgl_indo($data['tgl_kembali']); ?></td>
								<td><b><?= $data['no_telp']; ?></b></td>
								<td><small><i class="text-danger">Waktunya kontrol ulang!</i></small></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

			</div>

		<?php } ?>
	</div>
</div>
<?php } ?>

<script>
	$(function(){

		$('#notif').DataTable({
			columnDefs: [{
				"searchable": false,
				"orderable": false,
				"targets": [0, 5]
			}],
			"order": [1, "asc"]
		});

		$('#select_all').on('click', function(){
			if(this.checked){
				$('.check').each(function(){
					this.checked = true;
				})
			}
			else{
				$('.check').each(function(){
					this.checked = false;
				})
			}
		});
		$('.check').on('click', function(){
			if($('.check:checked').length == $('.check').length){
				$('#select_all').prop('checked', true)
			}
			else{
				$('#select_all').prop('checked', false)
			}
		})
	});

</script>

<script>
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: [
				<?php 
					$query2 = "SELECT DISTINCT nama_pasien FROM tb_pasien
						INNER JOIN tb_rekammedis ON tb_rekammedis.id_pasien = tb_pasien.id_pasien
						ORDER BY tb_pasien.nama_pasien ASC
					";
					$sql_pasien = mysqli_query($con, $query2) or die(mysqli_error($con));
					while($data = mysqli_fetch_array($sql_pasien)){
						echo '"'.$data['nama_pasien'] . '"' . ',';
					}
				?>
			],
			datasets: [{
				label: '',
				data: [
					<?php
						$sql_pasien = mysqli_query($con, $query2) or die(mysqli_error($con));
						while($data = mysqli_fetch_array($sql_pasien)){ ?>
							<?php
								$nama_pasien = $data['nama_pasien'];
								$query4 = "SELECT * FROM tb_rekammedis
									INNER JOIN tb_pasien ON tb_pasien.id_pasien = tb_rekammedis.id_pasien
									WHERE tb_pasien.nama_pasien = '$nama_pasien'
									ORDER BY tb_pasien.nama_pasien ASC
								";

								$jumlah = mysqli_query($con, $query4) or die(mysqli_error($con));
								echo mysqli_num_rows($jumlah). ',';
							?>

					<?php } ?>
				],
				backgroundColor: [
					<?php
						while($data = mysqli_fetch_array($sql_pasien)){
							echo 'rgba(255, 99, 132, 0.2)'. ',';
						}	
					?>
				],
				borderColor: [
					<?php
						while($data = mysqli_fetch_array($sql_pasien)){
							echo 'rgba(255,99,132,1)'. ',';
						}	
					?>
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
</script>


<?php include_once('../_footer.php'); ?>