<?php

require_once 'config/config.php';

function loadFile(){
    var_dump($_FILES);
    if ($_FILES['donnees-file-to-import']['error'] != 0) {
        return "Une erreur c'est produite durant le transfert";
    }
    if (is_uploaded_file($_FILES['donnees-file-to-import']['tmp_name']) === false){
        return "Un fichier est requis";
    }
    if(!move_uploaded_file($_FILES['donnees-file-to-import']['tmp_name'], FILE_FLIGHT_DATA)){
        return "Une erreur s'est produite durant la copie du fichier";
    }
    return TRUE;
}

$fileErr = "";
if(isset($_POST['submit'])){
    $message = loadFile();
    if ($message === TRUE){
        header("Location: tableau_bord_post_vol.php");
    } else{
        $fileErr = $message;
    }
}
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <title>Chargement des données</title>
        <meta name="description"
              content="Extrait les donnéesdu fichier généré par l'application embarqué">
        <meta charset="UTF-8">
        <meta name="author" content="Baptiste Thevenet">
        <link rel="stylesheet" type="text/css" href="css/skeleton.css">
        <link rel="stylesheet" type="text/css" href="css/knacss.css">
        <link rel="stylesheet" type="text/css" href="css/my_style.css">
        <script src=""js/jquery-1.12.2.min.js""></script>
    </head>
    <body>
        <div class="main small-w100">
            <h1>Chargement des données</h1>
            <form enctype="multipart/form-data"
                  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
                  method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                <div class="grid-2">
                    <div class="input-group flex-item-double">
                        <div class="fileUpload button input-group-addon">
                            <span class="floppy-open">&nbsp;&nbsp;&nbsp;</span> <input
                                type="file" id="donnees-file-to-import"
                                name="donnees-file-to-import" class="upload" />
                        </div>
                        <input class="fileUpload form-control" id="uploadFile"
                               name="uploadFile" type="text"
                               placeholder="Sélectionner un fichier" disabled="disabled" />
                    </div>
                    <span class="error flex-item-double"><?php echo $fileErr;?></span>
                    <div>
                        <input type="submit" value="OK" class="w100p" name="submit" />
                    </div>
                    <div>
                        <a href="index.php" class="button w100p">Menu</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
<script src="js/myScript.js"></script>

