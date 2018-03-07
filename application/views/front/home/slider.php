<ul class="bxslider">
  <?php foreach($slider_data as $slider){ ?>
  <li>
    <a href="<?php echo $slider->link ?>" target="_self">
      <img src="<?php echo base_url('assets/images/slider/').$slider->userfile.$slider->userfile_type?>">
    </a>
  </li>
  <?php } ?>
</ul>

<!-- bxSlider Javascript file -->
<script src="<?php echo base_url('assets/plugins/slider/jquery.bxslider/jquery.bxslider.min.js') ?>"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo base_url('assets/plugins/slider/jquery.bxslider/jquery.bxslider.css') ?>" rel="stylesheet" />

<script type="text/javascript">
$('.bxslider').bxSlider({
  auto: true,
});
</script>
