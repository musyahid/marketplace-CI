<div class="col-md-3">
  <h5>Profil Seller</h5>
  <hr>
  <p align="center">
    <?php echo $seller->nama ?>
    <br><br>
    <img src="<?php echo base_url('assets/images/user/').$seller->userfile.$seller->userfile_type ?>" class="img-circle" width="100px">
    <br><br>
    <a href="<?php echo base_url('user/profile/').$seller->username ?>">
      <button type="button" name="button" class="btn btn-primary">Lihat Toko</button>
    </a>
  </p>
  <br>
</div>
