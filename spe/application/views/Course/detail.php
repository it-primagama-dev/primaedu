<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- fONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
    <!-- CSS-KU -->
    <style type="text/css">
      section {
        min-height: 300px;
        font-family: 'Raleway';
      }

      .navbar-brand {
        font-family: 'Raleway';
        font-size: 22px;
      }

      footer {
        font-family: 'Raleway';
      }

      .btn {
        background-image: url('<?php echo base_url(); ?>assets/images/img/btn.jpg');
      }

      .judul {
        background-image: url('<?php echo base_url(); ?>assets/images/img/bg.jpg');
      }
    </style>
    <title>Primagama</title>
  </head>
  <body class="mt-5">
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary" style="background-image: url('<?php echo base_url(); ?>assets/images/img/nav.jpg')">
    <div class="container">
      <a class="navbar-brand" href="javascript:void(0)">Primagama - Terdepan Dalam Prestasi</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
            <img src="<?php echo base_url(); ?>assets/images/img/LogoPrima.png" width="75%">
          </div>
        </div>
      </div>
    </nav>

    <section id="detailpaket" class="detailpaket mb-4">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card mt-5">
              <div class="card-header judul">
                <h4 class="pt-2">
                  Paket 
                </h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Privat SD</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <button class="btn btn-primary" onclick="detail(3)">Lihat Paket Ini</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Privat SD</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <button class="btn btn-primary" onclick="detail(3)">Lihat Paket Ini</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Privat SD</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <button class="btn btn-primary" onclick="detail(3)">Lihat Paket Ini</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Privat SD</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <button class="btn btn-primary" onclick="detail(3)">Lihat Paket Ini</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="bg-primary text-white" style="background-image: url('<?php echo base_url(); ?>assets/images/img/nav.jpg')">
      <div class="container">
        <div class="row text-center pt-3">
          <div class="col">
            <p>Copyright &copy; 2020. PRIMAGAMA</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
<script type="text/javascript">
    window.base_url = <?php echo json_encode(base_url()); ?>;
</script>