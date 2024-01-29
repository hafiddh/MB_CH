<!DOCTYPE html>
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Store Information System --- Mega Baja Kendari</title>
  <script src="<?= base_url('dist/') ?>/js/title-scroll.js"></script>
  <link rel="icon" href="<?= base_url('dist/') ?>images/mb.ico">
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="initial-scale=1">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700,800' rel='stylesheet' type='text/css'> 


  <link rel="stylesheet" href="<?= base_url('dist/') ?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('dist/') ?>css/bootstrap_4.min.css"> 
  <link rel="stylesheet" href="<?= base_url('dist/') ?>css/templatemo_misc.css">
  <link rel="stylesheet" href="<?= base_url('dist/') ?>css/templatemo_style.css">
  <link rel="stylesheet" href="<?= base_url('dist/') ?>css/animate.css">
  <link rel="stylesheet" href="<?= base_url('dist/') ?>css/custom.css">


</head>
<body>
  <main>

    <div class="container">   
      <div class="d-flex justify-content-center" style="margin-top: -70px; border-width: 0px 0px;">
        <img src="<?= base_url('dist/') ?>images/mb2.png" alt="Mega Baja Logo" class="image img-square mb-3"
        style="opacity: .9;height: 150px; width: 150px;">
      </div>    

      <h1 style="color: white;">Cek Harga Barang</h1>
      <div class="search-box">
        <div class="search-icon"><i class="fa fa-search search-icon"></i></div>
        <form action="" class="search-form">
          <input type="text" placeholder="ID Produk/Nama Produk" id="search" name="inputan" autocomplete="off" required>
          <div id="result"> </div>
          <button type="submit" id="tambah_label" class="btn btn-outline-primary" hidden><i class="fas fa-plus-square"></i> Tambah Label</button>
        </form>
        <svg class="search-border" version="1.1" x="0px" y="0px" viewBox="0 0 671 111" style="enable-background:new 0 0 671 111;"xml:space="preserve">
          <path class="border" d="M335.5,108.5h-280c-29.3,0-53-23.7-53-53v0c0-29.3,23.7-53,53-53h280"/>
          <path class="border" d="M335.5,108.5h280c29.3,0,53-23.7,53-53v0c0-29.3-23.7-53-53-53h-280"/></svg>
          <div class="go-icon"><i class="fa fa-arrow-right"></i></div>
        </div>


        <div id="harganya" class="form-control" style="margin-top: 20px;">
         <div style="font-size: 16px;" class="p-3">
          <div class="row ml-1">
            <div class="col-3">
              <div class="d-flex justify-content-center row">
                <div class="col-4">
                  ID :
                </div>
                <div class="col-8">
                  <span style="margin-left: -25px;" id="id_p"></span>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="d-flex justify-content-center">
                 <div class="col-4">
                  Nama : 
                </div>
                 <div class="col-8">
                <span style="margin-left: -55px;" id="nama_p"></span>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="d-flex justify-content-center">
                <div class="col-6">
                  Stok :
                </div>
                <div class="col-6">
                <span style="margin-left: -30px;" id="jml_p"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center mt-3 ml-1" style="font-size: 24px">
            <span id="harga_p"></span>
          </div>
        </div>
      </div>
    </main>

    <!-- JavaScripts -->   
    <script src="<?= base_url('dist/') ?>js/jquery-1.11.1.min.js"></script>  <!-- lightbox -->
    <script src="<?= base_url('dist/') ?>js/templatemo_custom.js"></script> <!-- lightbox -->
    <script src="<?= base_url('dist/') ?>js/jquery.lightbox.js"></script>
    <script src="<?= base_url('dist/') ?>js/bootstrap-collapse.js"></script>
  </script>
  <script src="<?= base_url('dist/') ?>js/popper.min.js"></script>
</script>
<script src="<?= base_url('dist/') ?>js/bootstrap.min.js"></script>

</body>
</html>


<script type="text/javascript">

         $("#harganya").hide();

  $("#search").keyup(function() {
   var search_value = $(this).val();
   var datas     = 'search='+search_value;

   if ( search_value != '' ) {
     console.log(datas);
     $.ajax({
       type: "get",
       url: "<?= base_url('index/autocomplete') ?>",
       data: datas,
       success: function(data) {
         $("#result").html(data).show();
         $("#harganya").hide();
       }
     });
   }
   return false;
 });


  function showData(id,barcode)
  {

    $("#search").val(id);
    $("#result").hide();

    var keyword = $("#search").val();
    
    $.ajax({
      url: "<?= base_url('index/ambilData') ?>",
      type: "post",
      dataType: "json",
      data:{
        keyword : keyword
      },
      error: function (request, status, error) {
        alert(request.responseText);
      },
      success: function(data){        
        // alert(data.post.Hpokok);
        console.log(data);

        var reverse = data.post.Hpokok.toString().split('').reverse().join(''),
        ribuan  = reverse.match(/\d{1,3}/g);
        ribuan  = ribuan.join('.').split('').reverse().join('');
        $('#id_p').text(data.post.id_produk);
        $('#nama_p').text(data.post.nama_produk);
        $('#jml_p').text(data.post.stok);
        $('#harga_p').text("Rp."+ribuan);

         $("#harganya").show();
      },       
    });
  }


  $(document).ready(function(){
    $("#search").focus(function() {
      $(".search-box").addClass("border-searching");
      $(".search-icon").addClass("si-rotate");
    });
    $("#search").blur(function() {
      $(".search-box").removeClass("border-searching");
      $(".search-icon").removeClass("si-rotate");
    });
    $("#search").keyup(function() {
      if($(this).val().length > 0) {
        $(".go-icon").addClass("go-in");
      }
      else {
        $(".go-icon").removeClass("go-in");
      }
    });
  });


</script>