<?php
	include("sess_check.php");
	
	// deskripsi halaman
	$pagedesc = "Data Kredit Mikro";
	include("layout_top.php");
	include("dist/function/format_tanggal.php");
	include("dist/function/format_rupiah.php");
?>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Data Kredit Mikro</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
				
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<a href="karyawan_tambah.php" class="btn btn-success">Tambah</a>
							</div>
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No.pemohon</th>
											<th width="10%">Nama Agen</th>
											<th width="10%">Nama Perusahaan</th>
											<th width="5%">Telepon</th>
											<th width="10%">Jenis Jamian</th>
											<th width="10%">Nilai Jaminan</th>
											<th width="10%">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											$sql = "SELECT * FROM Jaminan ORDER BY nama_agen ASC";
											$ress = mysqli_query($conn, $sql);
											while($data = mysqli_fetch_array($ress)) {
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $data['id'] .'</td>';
												echo '<td class="text-center">'. $data['nama_perusahaan'] .'</td>';
												echo '<td class="text-center">'. $data['no_telp'] .'</td>';
												echo '<td class="text-center">'. $data['jenis_jaminan'] .'</td>';
												echo '<td class="text-center">'. $data['nilai_jaminan'] .'</td>';
												echo '<td class="text-center">
												<a href="#myModal" data-toggle="modal" data-load-code="'.$data['id'].'" data-remote-target="#myModal .modal-body" class="btn btn-primary btn-xs">Detail</a>
												<a href="kredit_mikro_edit.php?id='. $data['id'] .'" class="btn btn-warning btn-xs">Edit</a>';?>
													  <a href="action/kredit_mikro_hapus.php?id=<?php echo $data['id'];?>" onclick="return confirm('Apakah anda yakin akan menghapus <?php echo $data['nama_agen'];?>?');" class="btn btn-danger btn-xs">Hapus</a></td>
												<?php
													  echo '</td>';
												echo '</tr>';												
												$i++;
											}
										?>
									</tbody>
								</table>
							</div>
			<!-- Large modal -->
			<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-body">
							<p>One fine body…</p>
						</div>
					</div>
				</div>
			</div>    
						</div><!-- /.panel -->
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<!-- bottom of file -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#tabel-data').DataTable({
			"responsive": true,
			"processing": true,
			"columnDefs": [
				{ "orderable": false, "targets": [6] }
			]
		});
		
		$('#tabel-data').parent().addClass("table-responsive");
	});
</script>
	<script>
		var app = {
			code: '0'
		};
		
		$('[data-load-code]').on('click',function(e) {
					e.preventDefault();
					var $this = $(this);
					var code = $this.data('load-code');
					if(code) {
						$($this.data('remote-target')).load('kredit_mikro_detail.php?code='+code);
						app.code = code;
						
					}
		});		
    </script>
<?php
	include("layout_bottom.php");
?>