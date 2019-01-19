<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mon site - me contacter</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=WEBROOT?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=WEBROOT?>/css/style.css" />
    <script type="text/javascript" src="<?=WEBROOT?>/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?=WEBROOT?>/js/bootstrap.min.js"></script>

</head>
<body>
<!-- header -->
<div class="container-fluid" id="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <h3><a class="navbar-brand" href="/">Mon site </a></h3>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size:1em;">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="/contact_tuto">Accueil</a></li>        
                <li class="nav-item active"><a class="nav-link" href="/contact_tuto">Contact</a></li>        
            </ul>
        </div>
    </nav>
</div>
<!-- end header -->
<!-- content -->
<div class="container page-header">
	<div class="col-lg-12">
			<br>
			<?=(isset($this->session)) ? $this->session->flash() :''; ?>

	</div>
	<div class="col-12 col-lg-12">
		<div class="">
			<h1>Me contacter</h1>
			<hr>
		</div>

		<div class="content">
			<form method="POST" enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI']?>">

					<?=$this->form->text(
                                            'Nom',
                                                [
                                                    'balise'=>'input',
                                                    'attr'=>[
                                                                'class'=>'form-control col-lg-6'
                                                                ]
                                                ]
                                            );?>
					<?=$this->form->text(
                                            'Email',
                                            [
                                                'balise'=>'input',
                                                'attr'=>[
                                                            'class'=>'form-control col-lg-6'
                                                            ]
                                                ]
                                            );?>
					<?=$this->form->text(
                                            'Objet',
                                            [
                                                'balise'=>'input',
                                                'attr'=>[
                                                            'class'=>'form-control col-lg-6'
                                                            ]
                                                ]
                                            );?>
					<?=$this->form->text(
                                            'Message', 
                                            [
                                                'balise'=>'textarea', 
                                                'attr'=>[
                                                            'width'=>'35', 
                                                             'class'=>'form-control col-lg-12', 
                                                             'height'=>'50',
                                                             'id'=>'mytextarea'
                                                             ]
                                             ]
                                         );?>

					<?=$this->form->send('Envoyer le message');?>
			</form>

		</div>
	</div>

</div>

<div class="container-fluid bg-dark footer">
    <span><i class="fas fa-copyright"></i>Copyright 2018 Ib-academy | All right reserved | Designed by IB DEV</span>
</div>

<!-- end content -->
<script src="<?=WEBROOT?>/js/tinymce/tinymce.js"></script>
<script>
  tinymce.init({
    selector: '#mytextarea',
    menubar:false,
    width: 600,
    height: 300,
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
    toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link'
  });
  </script>
</body>
</html>