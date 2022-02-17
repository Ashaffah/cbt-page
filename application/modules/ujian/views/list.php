<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Ujian</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Data Ujian</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
					 <div class="col-5 align-self-center">
					
                        <div class="customize-input float-right">
                    <button class="btn waves-effect waves-light btn-rounded btn-success text-center" data-toggle="modal" data-target="#ModalaAdd">Tambah Data</button>
				</div>
				</div>
                </div>
            </div>
			
			
              
           <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
					<h4 class="card-title">Data Ujian</h4>
			<div class="table-responsive">
            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th>NO</th>
						<th>Ujian</th>
						<th></th>
                    </tr>
                </thead>
		<tbody>		
		<?php 
		$no = 1;
		foreach($data as $u){ //untuk menampilkan variabel data yang diangkut dari controller
		?>
		<tr>  
			<td><?php echo $no++ ?></td>
			<td><?php echo $u->ujian ?></td>
			
			<td><?php echo anchor('ujian/soal/'.$u->id,'<button type="button" class="btn btn-primary text-center">Tambah Soal</button>'); ?> <?php echo anchor('ujian/edit/'.$u->id,'<button type="button" class="btn btn-warning text-center">Edit Data</button>'); ?>  <?php echo anchor('ujian/hapus/'.$u->id,'<button type="button" class="btn btn-danger text-center">Hapus Data</button>'); ?></td>
			
		</tr>
		<?php } ?>
		</tbody>
            </table>
        </div>
		</div>
		</div>
		</div>
</div>
</div>
<!-- MODAL ADD -->
        <div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">TAMBAH DATA</h3>
            </div>
            <?php
            echo form_open_multipart('ujian/add', 'role="form" class="form-horizontal"');
            ?>
                <div class="modal-body">
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Ujian</label>
                        <div class="col-xs-9">
                           <input type="text" class="form-control" name="data1">
                        </div>
                    </div>
                   
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_simpan">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
