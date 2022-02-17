<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">Ubah Data</h4>
                                 <?php
            echo form_open_multipart('ujian/edit', 'role="form" class="form-horizontal"');
            echo form_hidden('id', $data['id']);
            ?>
<div class="form-group input-rounded">
<label>Ujian</label>
<input type="text" value = "<?php echo $data['ujian'] ?>" class="form-control" name="data1">
</div>

<div class="form-inline">
</div>
<button type="submit" name="submit" value="submit" class="btn btn-primary btn-block">Ubah</button>
<button type="button" name="back" value="Go back!" onclick="history.back()" class="btn btn-primary btn-block">Kembali</button>
</form>
</br>
</br>
</br>
</div>
</div>
</div>
</div>
</div>
