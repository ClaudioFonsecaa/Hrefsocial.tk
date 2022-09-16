
<?php

require "../database/connect.php";

$img_loc="nada";

?>

<meta name="viewport" content="width=device-width, initial-scale=1">



<script src="https://kit.fontawesome.com/4993c2bd61.js" crossorigin="anonymous"></script>
<link rel="icon" href="../src/img/favicon_io/favicon.ico" type="image/ico"> <!--  FAV ICON DO SITE   -->
<!--  NAVBAR V2   -->


            <div class="container fixed-top">
                <div style="height:130px; width:100%; clear:both; background: #182635;">
                    <img src="../src/img/logo_href_short.png" alt="href_logo" width="40%" height="auto" style="max-height:100%;" class="float-right">
                </div>

                <div class="profile-page tx-3">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="profile-header">
                                <div class="cover">
                                    <div class="gray-shade"></div>
                                        <div class="cover-body d-flex justify-content-between align-items-center">
                                            <div>
                                                <!-- QUERY PARA VERIFICAR SE O UTILIZADOR TEM FOTO SENÃO FOTO PADRÃO -->
                                                <?php
                                                $q = mysqli_query($conn,"SELECT * FROM utilizador WHERE id_user = '".$_SESSION["id"]."'");
                                                while($row = mysqli_fetch_assoc($q)) {
                                                    if ($row['imagem'] == "vazio") {
                                                        $img_loc = "../src/img/default_avatar.png";
                                                    } else {
                                                        $img_loc = "../utilizadores/" . $_SESSION['nome_utilizador'] . "/pictures/" . $row['imagem'] . "";
                                                    }
                                                }
                                                echo " <img class='profile-pic' src='$img_loc' alt='profile' style='width:100px; height: 100px;'>";
                                                ?>
                                                <span class="profile-name" style="font-size: 80%;">Bem vindo, <?php echo $_SESSION["nome_utilizador"]; ?> !</span>
                                            </div>
                                        </div>
                                    </div>
                                    


                                            <!-- Navbar v2-->
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light icons_navbar">
                                              <div class="container-fluid justify-content-between">

                                            
                                                <!-- Center elements -->
                                                <ul class="navbar-nav flex-row d-none d-md-flex">
                                                  
                                                </ul>
                                                <!-- Center elements -->
                                            
                                                <!-- Right elements -->
                                                  <div class="d-flex">

                                                      <div class="navbar_titulo">
                                                          <?php
                                                          echo $_SESSIONS["pagina_atual"];
                                                          ?>
                                                      </div>

                                                  </div>
                                                <!-- Right elements -->



                                                  <!-- ex Left elements -->

                                                  <ul class="navbar-nav flex-row">


                                                      <li id="home" class="nav-item me-3 me-lg-1" style="padding-right: 10px;">
                                                          <a class="nav-link" href="home.php">
                                                              <span>
                                                                  <i id="home_icon" class="fa-solid fa-person-military-pointing fa-2x"></i>
                                                              </span>
                                                          </a>
                                                      </li>

                                                      <li id="edu_work" class="nav-item me-3 me-lg-1" style="padding-right: 10px;">
                                                          <a class="nav-link" href="education_work.php">
                                                              <span><i id="news_icon" class="fa-solid fa-newspaper fa-2x"></i></span>
                                                          </a>
                                                      </li>

                                                      <li id="games" class="nav-item me-3 me-lg-1" style="padding-right: 10px;">
                                                          <a class="nav-link" href="games.php">
                                                              <span><i id="games_icon" class="fa-solid fa-chess-knight fa-2x"></i></span>
                                                          </a>
                                                      </li>

                                                      <li id="memes" class="nav-item me-3 me-lg-1" style="padding-right: 10px;">
                                                          <a class="nav-link" href="memes.php">
                                                              <span><i id="memes_icon" class="fa-solid fa-face-grin-squint-tears fa-2x"></i></span>
                                                          </a>
                                                      </li>

                                                      <li id="perfil" class="nav-item me-3 me-lg-1" style="padding-right: 10px;">
                                                          <a class="nav-link" href="perfil.php">
                                                              <span><i id="perfil_icon" class="fa-solid fa-user fa-2x"></i></span>

                                                          </a>
                                                      </li>

                                                      <li   class="nav-item me-3 me-lg-1">
                                                          <a class="nav-link" href="../account/logout.php" style="padding-right: 10px;">
                                                              <span><i id="logout_icon" class="fa-solid fa-door-open fa-2x"></i></span>

                                                          </a>
                                                      </li>


                                                  </ul>


                                                  <!-- Left elements -->

                                              </div>
                                            </nav>
                                            <!-- Navbar -->



                            </div>
                        </div>
                    </div>
                </div>
            </div>


<!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>

<!-- Função para mudar a class dos botoes consoante o tamanho -->
<!-- Função para por o texto da navbar ativo consoante a página atual -->
<script>
    window.onload = screenClass;

    function screenClass() {
        var win = $(this);
        if (win.width() < 992) {

            $('#home_icon').removeClass('fa-2x');
            $('#home_icon').addClass('fa-1x');
            $('#news_icon').removeClass('fa-2x');
            $('#news_icon').addClass('fa-1x');
            $('#games_icon').removeClass('fa-2x');
            $('#games_icon').addClass('fa-1x');
            $('#memes_icon').removeClass('fa-2x');
            $('#memes_icon').addClass('fa-1x');
            $('#perfil_icon').removeClass('fa-2x');
            $('#perfil_icon').addClass('fa-1x');
            $('#logout_icon').removeClass('fa-2x');
            $('#logout_icon').addClass('fa-1x');

        } else {

            $('#home_icon').addClass('fa-2x');
            $('#news_icon').addClass('fa-2x');
            $('#games_icon').addClass('fa-2x');
            $('#memes_icon').addClass('fa-2x');
            $('#perfil_icon').addClass('fa-2x');
            $('#logout_icon').addClass('fa-2x');
        }
    }

    
    $(window).bind('resize',function(){
        screenClass();
    });


    var path = window.location.pathname;
    var page = path.split("/").pop();

    switch(page) {
        case 'home.php':
            var h = document.getElementById("home");
            h.className += " active";
            break;
        case 'education_work.php':
            var e = document.getElementById("edu_work");
            e.className += " active";
            break;
        case 'games.php':
            var g = document.getElementById("games");
            g.className += " active";
            break;
        case 'memes.php':
            var m = document.getElementById("memes");
            m.className += " active";
            break;
        case 'perfil.php':
            var p = document.getElementById("perfil");
            p.className += " active";
            break;
    }

</script>