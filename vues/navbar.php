<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    	<div class="container">
    		<?php
			if (isset($_SESSION['current_user'])) {
				echo '<a class="navbar-brand cursorDefault" href="#">Bonjour '.$_SESSION['current_user']['username'].'</a>';
				echo '	
						<ul class="navbar-nav">
							<li class="nav-item dropdown">
								<a class="navbar-brand dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Menu</a>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="/">Accueil</a>
									<a class="dropdown-item" href="/view/access_new_post/">Ajouter un post</a>
									<a class="dropdown-item" href="/view/access_all_post/">Liste des posts</a>
									<a class="dropdown-item" href="/view/access_all_categories/">Liste des catégories</a>
								</div>
							</li>
						</ul>';
				echo '<a class="navbar-brand" href="/log_out/">Déconnexion</a>';
			}else{
				echo '<a class="navbar-brand" href="index.php?controleur=annonce&action=home">Accueil</a>';
				echo '<a class="navbar-brand" href="index.php?controleur=utilisateur&action=pageConnexion">Connexion</a>';
			}
    		?>
    	</div>
	</nav>
</header>