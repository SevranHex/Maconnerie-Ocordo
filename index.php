<?php
function display()
{
    $xmlData = simplexml_load_file('source.xml');
    if (!isset($_GET['id'])) {
        return $xmlData->page[0]->content;
    } else {
        foreach ($xmlData as $pageValue) {
            $id = $pageValue->attributes()->id;
            if (isset($_GET['id']) && $_GET['id'] == $id) {
                return $pageValue->content;
            }
        }
    }
}

function displayLink()
{
    $xmlData = simplexml_load_file('source.xml');
    foreach ($xmlData as $pageValue) {
        $id = $pageValue->attributes()->id; ?>
        <li class="nav-item">
            <a class="nav-link navTextColor" href="<?= $id++ ?>.html"><?= $pageValue->menu ?></a>
        </li>
<?php }
}

$nameRegex = '/^[A-Z][a-zöø-ÿ]*([\-][A-Z][a-zöø-ÿ]*)?/';
$phoneNumberRegex = '/^(\+33|0)[1-9]\d{8}$/';
$textRegex = '/^[A-Z][1-9a-zöø-ÿ\.\ \-]*/';

if (isset($_POST['send'])) {
    $errorList = [];
    $valueList = [];
    if (!empty($_POST['your-name'])) {
        if (preg_match($nameRegex, $_POST['your-name'])) {
            $valueList['name'] = htmlspecialchars($_POST['']);
        } else {
            $errorList['name'] = 'Veuillez entrer un nom valide.';
        }
    } else {
        $errorList['name'] = 'Veuillez saisir votre nom.';
    }
    if (!empty($_POST['your-email'])) {
        if (filter_var($_POST['your-email'], FILTER_VALIDATE_EMAIL)) {
            $valueList['email'] = htmlspecialchars($_POST['']);
        } else {
            $errorList['email'] = 'Veuillez entrer un email valide.';
        }
    } else {
        $errorList['email'] = 'Veuillez saisir votre email.';
    }
    if (!empty($_POST['your-tel-615'])) {
        if (preg_match($phoneNumberRegex, $_POST['your-tel-615'])) {
            $valueList['phoneNumber'] = htmlspecialchars($_POST['your-tel-615']);
        } else {
            $errorList['phoneNumber'] = 'Veuillez entrer un numéro de téléphone valide.';
        }
    } else {
        $errorList['phoneNumber'] = 'Veuillez saisir votre numéro de téléphone.';
    }
    if (!empty($_POST['your-subject'])) {
        if (preg_match($textRegex, $_POST['your-subject'])) {
            $valueList['subject'] = htmlspecialchars($_POST['']);
        } else {
            $errorList['subject'] = 'Veuillez entrer un sujet valide.';
        }
    } else {
        $errorList['subject'] = 'Veuillez saisir votre sujet.';
    }
    if (!empty($_POST['your-ville'])) {
        if (preg_match($nameRegex, $_POST['your-ville'])) {
            $valueList['city'] = htmlspecialchars($_POST['']);
        } else {
            $errorList['city'] = 'Veuillez entrer une ville valide.';
        }
    } else {
        $errorList['city'] = 'Veuillez saisir votre ville.';
    }
    if (!empty($_POST['your-message'])) {
        if (preg_match($textRegex, $_POST['your-message'])) {
            $valueList['message'] = htmlspecialchars($_POST['']);
        } else {
            $errorList['message'] = 'Veuillez entrer un message valide.';
        }
    } else {
        $errorList['message'] = 'Veuillez saisir votre message.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maconnerie Ocordo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div>
        <img class="img-fluid formBackground" src="assets/img/6555_113_Actu-forum-btp.jpg" alt="Rénovation d'une maison à Nantes" />
        <p class="caption-text">Rénovation d'une maison à Nantes</p>
    </div>
    <header>
        <nav class="row navbar navbar-expand-lg navbar-light navColor shadow fixed-top">
            <div class="container">
                <div class="col-12 col-sm-2">
                    <p><img class="logo img-fluid max-width: 50%" src="assets/img/bonhomme-Petit-1.png" alt=""></p>
                </div>
                <div class="col-12 col-sm-3">
                    <p class="title h1 text-light">Maçonnerie Ocordo</p>
                </div>
                <div class="col-1">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="col-6 collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <?php displayLink() ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="content">
        <?= display() ?>
    </div>
    <footer class="navColor text-center text-lg-start text-muted">
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <div class="d-none d-lg-block">
                <p class="textcontent2">Rejoignez nous sur les réseaux sociaux :</p>
            </div>
            <div>
                <a href="" class="me-4  text-reset">
                    <i class="text-white fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="text-white fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="text-white fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="text-white fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="text-white fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="text-white fab fa-github"></i>
                </a>
            </div>
        </section>
        <section>
            <div class="container navTextColor text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                        <p class="h6 text-uppercase fw-bold mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                                <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                            </svg>
                            Maçonnerie Ocordo
                        </p>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                        <p class="h6 navTextColor text-uppercase fw-bold mb-4">
                            Liens
                        </p>
                        <ul>
                            <?php displayLink() ?>
                        </ul>
                    </div>

                    <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-md-0 mb-4">
                        <p class="text-uppercase fw-bold mb-4">
                            Contact
                        </p>
                        <p><i class="fas fa-home me-3"></i> 11 All. de l'Île Gloriette, 44000 Nantes</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            contact@ocordo-travaux.fr
                        </p>
                        <p><i class="fas fa-phone me-3"></i> 02.51.84.18.24</p>
                    </div>
                </div>
            </div>
        </section>
    </footer>
</body>

</html>