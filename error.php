<?php
$bug = 'controller';
	switch ($bug) {
		case 'controller':
			echo " <img src='src/controller.jpg' alt='Desc'>"
			// source : http://fr.hellokids.com/r_2620/coloriage/coloriage-metier/coloriage-metier-sncf"
			echo "Erreur Controleur ";
			break;

		case 'fonction':
			echo : <img src='src/fonction' alt='Desc'>
			// source : https://farm5.staticflickr.com/4055/4464587793_503d14c38c.jpg
			echo "Erreur fonction inexistante";
			break;

		case 'login':
		echo " <img src='src/suspicious' alt='Desc'>"
			// source : https://tse1.mm.bing.net/th?id=OIP.vm6tKXwcmJ9OZMTxm3rgmwHaFj&pid=Api
			echo "Login Incorrect";
			break;
			
		case 'Password':
		echo " <img src='src/kid' alt='Desc'>"
			// source : https://tse4.mm.bing.net/th?id=OIP.jrh4lAWBQ-iO-cyUClD3bQHaLG&pid=Api
			echo "Mot de passe Incorrect";
			break;	

		case 'ElementNotExists':
		echo " <img src='src/scrut' alt='Desc'>"
			// source http://www.davidgos.fr/wp-content/uploads/2012/03/insight-me-1280x800.jpg
			echo "Erreur Element inexistant";
			break;

		case 'internalError': 
		echo "<img src='src/startrek' alt='Desc'>"
			// source https://tse3.mm.bing.net/th?id=OIP.b3KSY6gtK4hIlTLvbmcolgHaEW&pid=Api
			echo "Vu que nous ne faisons jamais de faute de code cela ne peut être que de votre faute, et puis vous savez personne 
			n'est pa...enfin si nous on est parfaits";
			echo "<button class='btn btn-info-outline'>Je suis pas convaincu</button>"
			break;
			
			case 'internalError': 
		echo "<img src='src/star' alt='Desc'>"
			// source https://i3.kym-cdn.com/entries/icons/original/000/001/569/insp_captkirk_5_.jpg"
		
			break;

		case 'notAuthorized':
		echo " <img src='src/bouncer' alt='Desc'>"
			// source  https://tse1.mm.bing.net/th?id=OIP.B73wiiOeBKbIDDm8NskEzAHaIt&pid=Api
			echo "Acces non autorisé";
			echo "<button class='btn btn-danger-outline'>Insister pour avoir l'acces</button>"
			break;
			
		case 'notAuthorizedInsist':
		echo "<img src='src/bouncer' alt='Desc'>"
			// source https://knowyourmeme.com/memes/jack-blacks-octagon
			echo "Vous ne possédez pas les droits nécessaires pour aller ici, on vous l'a déja dit faut pas insister hein";
			echo "<button class='btn btn-danger'>Insister encore plus</button>"
			break;	
			
		case 'notAuthorizedInsistMore':
		echo "<img src='src/police' alt='Desc'>"
			// source https://c8.alamy.com/comp/B7AM9W/police-officer-tearing-a-blank-generic-citation-from-his-ticket-book-B7AM9W.jpg
			echo "Allez directement en prison sans passer par la case départ";
			echo "<button class='btn btn-danger'>D'accord monsieur le commissaire</button>"
			break;		
			
		case 'server':
		echo "<img src='src/serveur' alt='Desc'>"
			// source http://www.chosebine.com/images/serveur-maladroit-gaffeur-faux-serveur-comedien-animation-loufoque-patronne2.jpg
			echo "Erreur Serveur";
			break;
			
		case 'PageNotExists':
		echo "<img src='src/howdy' alt='Desc'>"
			// source https://tse4.mm.bing.net/th?id=OIP.aNKdY791n5WYEPIuccWn4wHaHn&pid=Api + https://tse2.mm.bing.net/th?id=OIP.x5cWTFWaydb4DHQWp-bz9AHaJq&pid=Api
			echo "Page inexistante";
			break;	
	

		default:
			echo "Comment êtes-vous arrivés là?";
			echo "source : <a>http://www.quickmeme.com/meme/3pgqjq</a>";
			break;
	}
?>
