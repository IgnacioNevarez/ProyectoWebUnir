<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metaetiquetas requeridas -->
    <meta charset="UTF-8">
    <meta name="description" content="Dashboard - Screen">
    <meta name="author" content="Ignacio Esaú Nevarez Zúñiga">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Referencia al código de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Referencia al código de jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <title><?php echo $data['title']?></title>
</head>
<body>
    <!-- Archivos opcionales de JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Inclusión de la barra de navegación -->
    <?php require APPROOT . '/views/basicStructure/navbar.php'?>
    
    <!-- Código de implementación de la lista de publicaciones -->
    <section class="p-5">
        <?php foreach($data['publications'] as $publication) : ?>
            <div class="rounded container bg-warning mt-3" style="height: 225px">
                <div class="float-left mt-5 mr-3">
                    <img class="rounded" src="/orderOfThePhoenix/public/img/<?php echo $publication->role ?>.jpg" alt="" width="150" height="150">
                </div>
                <div>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item bg-warning border-warning">
                            <h4 class="text-dark font-weight-bold"><?php echo $publication->username ?></h4>
                        </li>
                        <li class="ml-auto list-group-item bg-warning border-warning">
                            <a 
                            href="<?php if($publication->username == $_SESSION['username']) {
                                echo URLROOT; ?>/edit/<?php echo $publication->publicationID; 
                            } else {
                                echo '';
                            } ?>">
                                <button class="btn bg-success border-success <?php if($publication->username != $_SESSION['username']) {
                                    echo 'disabled';
                                } ?>">
                                    <?php echo $data["editButton"] ?>
                                </button>
                            </a>
                        </li>
                        <li class="list-group-item bg-warning border-warning">
                            <a
                            href="<?php if($publication->username == $_SESSION['username']) {
                                echo URLROOT; ?>/delete/<?php echo $publication->publicationID; 
                            } else {
                                echo '';
                            } ?>">
                                <button class="btn bg-danger border-danger <?php if($publication->username != $_SESSION['username']) {
                                    echo 'disabled';
                                } ?>">
                                    <?php echo $data["deleteButton"] ?>
                                </button>
                            </a>
                        </li>
                    </ul>
                    <div>
                    <p class="text-justify font-weight-light text-dark"><?php echo $publication->publication ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </section>

    <!-- Inclusión del pie de página -->
    <?php require APPROOT . '/views/basicStructure/footer.php'?>

</body>
</html>