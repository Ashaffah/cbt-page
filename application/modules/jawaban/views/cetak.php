

<html>
    <head>
        <title>Cetak Kartu</title>
        <script language="javascript">
        function printpage()
            {
                window.print();
            }
        </script>
    </head>
   <style>
   #card{
	   float:left;
	   width: 20cm;
        height: 29.7cm;
        margin: 0mm 0mm 0mm 0mm; 
	 
		background-repeat: no-repeat;
		background-size: contain;
	   border:1px solid white;
	  
	   
	   -webkit-print-color-adjust: exact;
   }
   #c_identitas{
	   margin-top:20px;
		margin-left:15px;
	   width:100%;
	   height:auto;
		text-align:left;

	   
   }

	#c_isi{
	   margin-top:1px;
		margin-left:15px;
	   width:90%;
	   height:auto;
	

	   
   }

	#c_tgl{
	
	   margin-top:20px;
		
		margin-left:15px;
	   width:30%;
	   height:120px;
	

	   
   }

	#c_ttdmhs{
	   margin-top:20px;
		margin-left:15px;
		float:left;
	   width:20%;
	   height:120px;
	

	   
   }

	#c_ttddsn{
	   margin-top:20px;
		float:right;
		margin-right:145px;
	   width:20%;
	   height:120px;
	

	   
   }
  

   </style>
   
   
     <body onLoad="printpage()">
	
	 <div id="card">
	 <h1>Laporan Nilai</h1>
	  <div id="c_identitas">

	 </div>
	 
	  <div id="c_isi">
		<table style="width:100%">
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
			<td style="text-align:center"><?php echo $no++ ?></td>
			<td style="text-align:center"><?php echo $u->nim ?></td>
			<td style="text-align:center"><?php echo $u->nama ?></td>
			<td style="text-align:center"><?php echo $u->kelas ?></td>
			<?php $nilai = 0; $jawaban = $this->db->select('*')->from('jawaban')->where('id_ujian', $this->session->userdata('id_ujian'))->where('nim', $u->nim)->get()->result();  
			foreach ($jawaban as $j) { ?>
			<?php $kunci = $this->db->select('*')->from('soal')->where('id_ujian', $this->session->userdata('id_ujian'))->where('id', $j->id)->get()->result(); 
			foreach ($kunci as $k) { 
				$nilai += intval($k->nilai) * banding($k->kunci, $j->jawaban);
			 } ?>
			<?php } ?>
			<td style="text-align:center"><?php echo $nilai ?></td>
		</tr>
		<?php } ?>
		</tbody>
            </table>
			</div>
			</body>
</html>