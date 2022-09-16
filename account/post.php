<?php

$sql = "SELECT * FROM post where id_cat=1 ORDER BY id_post DESC";
$result = mysqli_query($conn, $sql);


while ($row = mysqli_fetch_object($result)) {

    $sql2 = "SELECT * FROM utilizador where id_user = ".$row->id_user."";
    $result2 = mysqli_query($conn, $sql2);
    $r = mysqli_fetch_object($result2);
    $nome_criador_post = $r->username;
    $imagem_criador_post = $r->imagem;
    $post_img_loc = "../postagens/".$row->id_post."/".$row->imagem;
    $img_loc="nada";
    ?>

    <!-- ESTRUTURA DE UM POST ------------------------------------------------------------->
    <div class="col-md-12 grid-margin" data-toggle="modal" data-target="#modalPublicacao">
        <div class="card rounded">
            <div class="card-header" >
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <!-- BLOCO PARA VERIFICAR SE O UTILIZADOR TEM FOTO SENÃO FOTO PADRÃO -->
                        <?php
                            if ($imagem_criador_post=="vazio") {
                                $img_loc = "../src/img/default_avatar.png";
                            } else {
                                $img_loc = "../utilizadores/" . $nome_criador_post . "/pictures/" . $imagem_criador_post . "";
                            }
                        echo " <img class='img-xs rounded-circle' src='$img_loc' alt='profile_pic'> ";
                        ?>
                        <div class="ml-2">
                            <?php echo $nome_criador_post ?>
                        </div>
                    </div>
                    <?php if($row->id_user==$_SESSION["id"]){  ?>
                        <a data-toggle="modal" data-target="#deletePost">
                            <i class="fa-solid fa-trash fa-2x" style="color:#11ceed"></i>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="card-body">
                <p class="mb-3 tx-14"><?php echo $row->titulo; ?></p>
                <!-- BLOCO PARA VERIFICAR SE O POST TEM FOTO OU NAO -->
                <?php
                    if($row->imagem=="vazio" or $row->imagem=="") {
                        //Não tem imagem no post
                    }else{
                        echo"<img class='img-responsive img-thumbnail'  width='600' height='600' src='$post_img_loc' alt='IMG_POST'>";
                    }
                ?>
                <!--<img class="img-responsive img-thumbnail"  width="600" height="600" src="<?php echo $post_img_loc;?>" alt="IMG_POST"> -->
                <p>
                <p class="mb-3 tx-14"><?php echo $row->conteudo; ?></p>
            </div>
            <div class="card-footer ">
                <?php if($row->id_user==$_SESSION["id"]){  ?>
                    <div class="d-flex post-actions">
                        <a data-toggle="modal" data-target="#alterarPost" class="d-flex align-items-center text-muted mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart icon-md">
                                <i class="fa-solid fa-pen-to-square fa-2x" style="color:#0ecedd" type="button"></i>Editar
                            </svg>
                        </a>
                    </div>
                    <div class="float-right">
                        <i class="fa-solid fa-calendar-days" style="color:#0ecedd"></i><?php echo " ",$row->data; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>



    <!-- ALTERAR POST MODAL ------------------------------------------------------------------------------------>
    <div class="modal fade" id="alterarPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Publicação</h5><p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="commands/alterarPost.php">
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="file" accept="image/*"  id="file" name="file" value='<?php echo $row->imagem;?>'>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Título:</label>
                            <input type="text" class="form-control" id="recipient-name" name="title" value='<?php echo $row->titulo;?>' required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Conteúdo:</label>
                            <textarea type="textarea" class="form-control" id="message-text" name="content" required><?php echo $row->conteudo;?></textarea>
                        </div>
                        <input type="hidden" id="post_id" name="post_id" value='<?php echo $row->id_post;?>'>
                        <input type="hidden" value="1" name="id_cat"><!-- Mandar em variavel escondida o tipo da categoria do post -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" onclick="return VerifyUploadSizeIsOK()" class="btn " style="background-color: #03d0a4; color: white">Editar</button>
                        <button type="reset" class="btn  fa-solid fa-eraser fa-2x" style="color:deepskyblue"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Eliminar POST MODAL ------------------------------------------------------------------------------------>
    <div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="POST" action="commands/deletePost.php">
                <div class="modal-header">
                    <h5 class="modal-title alert-danger" id="exampleModalLabel">Aviso!</h5><p>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que pretende apagar o post ?</h5><p>
                        <input type="hidden" value=<?php echo $row->id_post; ?> name="id_post">
                        <input type="hidden" value="1" name="id_cat"><!-- Mandar em variavel escondida o tipo da categoria do post -->
                </div>
                <div class="modal-footer">
                    <button type="submit" name="apagar" class="btn " style="background-color: #03d0a4; color: white">Apagar</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>
