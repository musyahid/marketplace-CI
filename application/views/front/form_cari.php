<div class="col-lg-12">
  <?php echo form_open('produk/cari_produk') ?>
    <div class="input-group">
      <?php echo form_input(array('class'  => 'form-control', 'name'  => 'cari_produk','placeholder'  => 'Cari Produk....')) ?>
      <span class="input-group-btn"><button class="btn btn-default" type="submit">Go!</button></span>
    </div>
  <?php form_close() ?>
