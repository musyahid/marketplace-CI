<?php $this->load->view('back/head'); ?>
<?php $this->load->view('back/header'); ?>
<?php $this->load->view('back/leftbar'); ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit <?php echo $setting->judul ?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><?php echo clean(ucfirst($this->uri->segment(2))) ?></li>
      <li class="active"><a href="<?php echo current_url() ?>"><?php echo clean(ucfirst($this->uri->segment(4))) ?></a></li>
    </ol>
  </section>
  <section class='content'>
    <div class='row'>
        <div class="col-md-12"> <?php echo validation_errors() ?> </div>
        <?php if($this->uri->segment(4) == '3'){ ?>
          <?php echo form_open_multipart($action_update);?>
            <!-- kolom kiri -->
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-body">
                  <div class="form-group">
                    <div class="form-group"><label>Gambar Sebelumnya</label><br>
                      <img src="<?php echo base_url('assets/images/upload/'.$setting->userfile.$setting->userfile_type.'') ?>" width="200px"/>
                    </div>
                    <input type="file" class="form-control" name="userfile" id="userfile" onchange="tampilkanPreview(this,'preview')"/>
                    <br><p><b>Preview Gambar</b><br>
                    <img id="preview" src="" alt="" width="350px"/>
                  </div>
                </div>
                <?php echo form_input($id_setting,$setting->id_setting);?>
                <div class="box-footer">
                  <button type="submit" name="submit" class="btn btn-success"><?php echo $button_update ?></button>
                  <button type="reset" name="reset" class="btn btn-danger"><?php echo $button_reset ?></button>
                </div>
              </div>
            </div>
          <?php echo form_close(); ?>

          <?php } else{ ?>

          <?php echo form_open($action_update2);?>
            <!-- kolom kiri -->
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-body">
                  <div class="form-group">
                    <?php echo form_textarea($isi_setting,$setting->isi_setting);?>
                  </div>
                </div>
                <?php echo form_input($id_setting,$setting->id_setting);?>
                <div class="box-footer">
                  <button type="submit" name="submit" class="btn btn-success"><?php echo $button_update ?></button>
                  <button type="reset" name="reset" class="btn btn-danger"><?php echo $button_reset ?></button>
                </div>
              </div>
            </div>
          <?php echo form_close(); ?>
        <?php } ?>
        </div>
  </section>
</div>

<?php if($this->uri->segment(4) == '3'){ ?>
<script type="text/javascript">
function tampilkanPreview(userfile,idpreview)
{ //membuat objek gambar
  var gb = userfile.files;
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
</script>
<?php }else { ?>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
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
<?php } ?>

<?php $this->load->view('back/footer'); ?>
