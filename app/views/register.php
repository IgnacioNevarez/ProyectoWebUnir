<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metaetiquetas requeridas -->
    <meta charset="UTF-8">
    <meta name="description" content="Register - Screen">
    <meta name="author" content="Ignacio Esaú Nevarez Zúñiga">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Referencia al repositorio de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Referencia al repositorio de jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <!-- Validación de los campos en el formulario -->
    <script type="text/javascript">
        "use strict";
        (function() {
            window.addEventListener("load", function() {
                var forms = document.getElementsByClassName("needs-validation");
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener("submit", function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add("was-validated");
                    }, false);
                });
            }, false);
        })();
    </script> 

    <title><?php echo $data['title']?></title>
</head>
<body>
    <!-- JavaScript opcionales -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <!-- Inclusión de la cabecera -->
    <?php require APPROOT . '/views/basicStructure/header.php'?>

    <!-- Implementación del formulario de registro -->
    <section class="p-5 m-5">
        <div class="container border border-warning p-3 rounded" style="width: 500px">
            <div> 
                <h2 class="text-center"><?php echo $data['principalMessage']?></h2>
                <p class="text-center text-secondary"><?php echo $data['secondMessage']?></p>
            </div>
            <form action="<?php echo $data['registerAction']?>" method="POST" class="needs-validation" novalidate>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend"><?php echo $data['usernamePrefix']?></span>
                        </div>
                        <input name="username" type="text" class="form-control rounded-right" id="inputUsername" placeholder="<?php echo $data['username']?>" required>
                        <div class="invalid-feedback">
                            <?php echo $data['usernameError']?>
                        </div>
                    </div>
                </div>
                <div class="form-group" >
                    <input name="email" type="email" class="form-control" id="emailInput" placeholder="<?php echo $data['email']?>" required>
                    <div class="invalid-feedback">
                        <?php echo $data['emailError']?>
                    </div>
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" id="passwordInput" placeholder="<?php echo $data['password']?>" required minlength="8">
                    <div class="invalid-feedback">
                        <?php echo $data['passwordError']?>
                    </div>
                </div>
                <div>
                    <label><?php echo $data['role']?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="inlineWizard" value="wizard" required>
                        <label class="form-check-label" for="inlineWizard"><?php echo $data['wizardRole']?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="inlineWitch" value="witch" required>
                        <label class="form-check-label" for="inlineWitch"><?php echo $data['witchRole']?></label>
                    </div>
                </div>
                <div class="text-center"> 
                    <button type="submit" class="btn btn-warning mt-3"><?php echo $data['title']?></button>
                </div>
            </form>
            <div class="border-top m-5 text-center">
                <?php echo $data['logInMessage']?>
                <a class="text-warning p-3" href="<?php echo $data['logInLink']?>">
                    <?php echo $data['logIn']?></button>
                </a>
            </div>
        </div>
    </section>

    <!-- Inclusión del pie de página -->
    <?php require APPROOT . '/views/basicStructure/footer.php'?>
</body>
</html>