<form method="post" action="index.php">
	<fieldset>
		<legend>Mon formulaire :</legend>
		<form method="post" action="traitement.php">

		    <p>
		      <label for="Nom">Nom</label> :
		      <input type="text" placeholder="Ex : Dupont" name="nom" id="Nom" required/>
		    </p>
		    <p>
		      <label for="Prenom">Prénom</label> :
		      <input type="text" placeholder="Ex : Jean" name="prenom" id="Prenom" required/>
		    </p>
		    <p>
		        Veuillez indiquer votre situation familiale :<br />
		       	<input type="radio" name="situation" value="m" id="m" /> <label for="m">Marié(e)</label><br />
		       	<input type="radio" name="situation" value="p" id="p" /> <label for="p">Pacsé(e)</label><br />
		       	<input type="radio" name="situation" value="d" id="d" /> <label for="d">Divorcé(e)</label><br />
		       	<input type="radio" name="situation" value="s" id="s" /> <label for="s">Séparé(e)</label><br />
		       	<input type="radio" name="situation" value="c" id="c" /> <label for="c">Célibataire</label><br />
		       	<input type="radio" name="situation" value="v" id="v" /> <label for="v">Veuf/Veuve</label><br />
		    <p>
		      <input type="submit" value="Envoyer" />
		    </p>
		    <input type='hidden' name='action' value='created'>
	</fieldset> 
</form>

