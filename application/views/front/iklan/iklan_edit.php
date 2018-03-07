<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
        <li>Iklan</li>
        <li><a href="<?php echo current_url() ?>">Ubah Iklan Saya</a></li>
      </ol>

      <h5>Ubah Data Iklan</h5>
    </div>
  </div>

  <hr>

  <div class="row">
    <div class="col-lg-12">
      <?php echo form_open_multipart($action);?>
        <?php echo validation_errors() ?>
        <div class="form-group"><label>Nama Produk</label>
          <?php echo form_input($judul_produk, $iklan->judul_produk);?>
        </div>
        <div class="form-group"><label>Deskripsi</label>
          <?php echo form_textarea($deskripsi, $iklan->deskripsi);?>
        </div>
        <div class="form-group"><label>Harga</label>
          <?php echo form_input($harga, $iklan->harga);?>
        </div>
        <div class="row">
          <div class="col-lg-4"><label>Kategori</label>
            <?php echo form_dropdown('',$ambil_kategori,$iklan->kat_id,$kat_id);?>
          </div>
          <div class="col-lg-4"><label>SubKategori</label>
            <?php echo form_dropdown('',$ambil_subkat,$iklan->subkat_id,$subkat_id);?>
          </div>
          <div class="col-lg-4"><label>SuperSubKategori</label>
            <?php echo form_dropdown('',$ambil_supersubkat,$iklan->supersubkat_id,$supersubkat_id);?>
          </div>
        </div><br>
        <div class="form-group"><label>Gambar Sebelumnya</label><br>
          <img src="<?php echo base_url('assets/images/produk/'.$iklan->foto.$iklan->foto_type.'') ?>" width="200px"/>
        </div>
        <div class="form-group"><label>Gambar</label>
          <input type="file" class="form-control" name="foto" id="foto" onchange="tampilkanPreview(this,'preview')"/>
          <br><p><b>Preview Gambar</b><br>
          <img id="preview" src="" alt="" width="350px"/>
        </div>
        <?php echo form_input($id_produk,$iklan->id_produk);?>
        <hr>
        <button type="submit" name="submit" class="btn btn-success"><?php echo $button_submit ?></button>
        <button type="reset" name="reset" class="btn btn-danger"><?php echo $button_reset ?></button>
      <?php echo form_close() ?>
    </div>

  	<?php $this->load->view('front/footer') ?>

    <script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/currency/inputmask.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
    $('#harga').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 2,
        autoGroup: true,
        rightAlign: false,
        oncleared: function () { self.Value(''); }
    });

    function tampilkanPreview(foto,idpreview)
    { //membuat objek gambar
      var gb = foto.files;
      //loop untuk merender gambar
      for (var i = 0; i < gb.length; i++)
      { //bikin variabel
        var gbPreview = gb[i];
        var imageType = /image.*/;
        var preview=document.getElementById(idpreview);
        var reader = new FileReader();
        if (gbPreview.type.match(imageType))
        { //jika tipe data sesuai
          preview.file = gbPreview;
          reader.onload = (function(element)
          {
            return function(e)
            {
              element.src = e.target.result;
            };
          })(preview);
          //membaca data URL gambar
          reader.readAsDataURL(gbPreview);
        }
          else
          { //jika tipe data tidak sesuai
            alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
          }
      }
    }

    function tampilSubkat()
    {
      kat_id = document.getElementById("kat_id").value;
      $.ajax({
    	  url:"<?php echo base_url();?>iklan/pilih_subkategori/"+kat_id+"",
    	  success: function(response){
          $("#subkat_id").html(response);
    	  },
    	  dataType:"html"
      });
    return false;
    }

    function tampilSuperSubkat()
    {
      subkat_id = document.getElementById("subkat_id").value;
      $.ajax({
    	  url:"<?php echo base_url();?>iklan/pilih_supersubkategori/"+subkat_id+"",
    	  success: function(response){
    	    $("#supersubkat_id").html(response);
    	  },
    	  dataType:"html"
      });
    return false;
    }
    tinymce.init({
      selector: "textarea",

      // ===========================================
      // INCLUDE THE PLUGIN
      // ===========================================

      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste jbimages"
      ],

      // ===========================================
      // PUT PLUGIN'S BUTTON on the toolbar
      // ===========================================

      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",

      // ===========================================
      // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
      // ===========================================

      relative_urls: false,
      remove_script_host : false,
      convert_urls : true,

    });
    </script>
