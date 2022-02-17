<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Jawaban</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Data Jawaban</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
					 <div class="col-5 align-self-center">
					
                        <div class="customize-input float-right">
					<?php echo anchor('jawaban/cetak','<button type="button" class="btn btn-primary btn-rounded text-center">Cetak Nilai</button>'); ?>
					<?php echo anchor('soal','<button type="button" class="btn btn-danger btn-rounded text-center">Kembali</button>'); ?>
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
					<h4 class="card-title">Data Jawaban</h4>
			<div class="table-responsive">
            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th>No</th>
						<th>NIM</th>
						<th>Peserta</th>
						<th>Kelas</th>
						<?php $soal = $this->db->select('*')->from('soal')->where('id_ujian', $this->session->userdata('id_ujian'))->get()->result(); $nox = 1;
						foreach ($soal as $s){
						?>
						<td><?php echo $nox++; ?></td> 
						<?php } ?>
						<th>Nilai</th>
                    </tr>
                </thead>
		<tbody>		
		<?php 
		$no = 1;
		foreach($data as $u){ //untuk menampilkan variabel data yang diangkut dari controller
		?>
		<tr>  
			<td><?php echo $no++ ?></td>
			<td><?php echo $u->nim ?></td>
			<td><?php echo $u->nama ?></td>
			<td><?php echo $u->kelas ?></td>
			<?php $nilai = 0; $jawaban = $this->db->select('*')->from('jawaban')->where('id_ujian', $this->session->userdata('id_ujian'))->where('nim', $u->nim)->get()->result();  
			foreach ($jawaban as $j) { ?>
			<td><?php echo $j->jawaban ?></td>
			<?php $kunci = $this->db->select('*')->from('soal')->where('id_ujian', $this->session->userdata('id_ujian'))->where('id', $j->id)->get()->result(); 
			foreach ($kunci as $k) { 
				$nilai += intval($k->nilai) * banding($k->kunci, $j->jawaban);
			 } ?>
			<?php } ?>
			<td><?php echo $nilai ?></td>
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
