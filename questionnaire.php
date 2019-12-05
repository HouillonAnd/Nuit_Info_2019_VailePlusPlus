<form method="post" action="index.php">
	<fieldset>
		<legend>Vous :</legend>
		    <p>
		      <label for="nom">Nom</label> :
		      <input type="text" placeholder="Ex : Dupont" name="nom" id="nom" required/>
		    </p>
		    <p>
		      <label for="prenom">Prénom</label> :
		      <input type="text" placeholder="Ex : Jean" name="prenom" id="prenom" required/>
		    </p>
		    <p>
		    	Veuillez indiquer votre genre :<br />
		    	<input type="radio" name="genre" value="h" id="h" /> <label for="h">Homme</label><br />
		    	<input type="radio" name="genre" value="f" id="f" /> <label for="f">Femme</label><br />
		    	<input type="radio" name="genre" value="n" id="n" /> <label for="n">Non-Binaire</label><br />
		    </p>
		    <p>
		        Veuillez indiquer votre situation familiale :<br />
		       	<input type="radio" name="situation" value="m" id="m" /> <label for="m">Marié(e)</label><br />
		       	<input type="radio" name="situation" value="p" id="p" /> <label for="p">Pacsé(e)</label><br />
		       	<input type="radio" name="situation" value="d" id="d" /> <label for="d">Divorcé(e)</label><br />
		       	<input type="radio" name="situation" value="s" id="s" /> <label for="s">Séparé(e)</label><br />
		       	<input type="radio" name="situation" value="c" id="c" /> <label for="c">Célibataire</label><br />
		       	<input type="radio" name="situation" value="v" id="v" /> <label for="v">Veuf/Veuve</label><br />
		    </p>
		    <p>
		    	Veuillez indiquer votre situation professionelle :<br />
		       	<input type="radio" name="emploi" value="etude" id="etude" /> <label for="etude">Etudiant</label><br />
		       	<input type="radio" name="emploi" value="job" id="job" /> <label for="job">Etudiant + Job</label><br />
		    </p>
		    <p>
		    	Veuillez indiquer votre type d'étude :<br />
		    	<input type="radio" name="etude" value="lycee" id="lycee" /> <label for="lycee">Lycee</label><br />
				<input type="radio" name="etude" value="bts" id="bts" /> <label for="bts">BTS</label><br />
		       	<input type="radio" name="etude" value="dut" id="dut" /> <label for="dut">DUT</label><br />
		       	<input type="radio" name="etude" value="prepa" id="prepa" /> <label for="prepa">CPGE</label><br />
		       	<input type="radio" name="etude" value="inge" id="inge" /> <label for="inge">Ecole inge</label><br />
		       	<input type="radio" name="etude" value="licence" id="licence" /> <label for="licence">Licence</label><br />
		       	<input type="radio" name="etude" value="licence_pro" id="licence_pro" /> <label for="licence_pro">Licence profesionnelle</label><br />
		       	<input type="radio" name="etude" value="master_pro" id="lmaster_pro" /> <label for="master_pro">Master profesionnel</label><br />
		       	<input type="radio" name="etude" value="doctorat" id="doctorat" /> <label for="doctorat">Doctorat</label><br />
		       	<input type="radio" name="etude" value="docteur" id="docteur" /> <label for="docteur">Diplôme d'état de docteur</label><br />
		    </p>
		    <p>
		    	<label for="region">Dans quelle région habitez-vous ?</label><br />
			       <select name="region" id="region">
			           <option value="ara">Auvergne-Rhône-Alpes</option>
			           <option value="bfc">Bourgogne-Franche-Comté</option>
			           <option value="bre">Bretagne</option>
			           <option value="cvl">Centre-Val de Loire</option>
			           <option value="cor">Corse</option>
			           <option value="ges">Grand Est</option>
			           <option value="hdf">Hauts-de-France</option>
			           <option value="idf">Île-de-France</option>
			           <option value="nor">Normandie</option>
			           <option value="naq">Nouvelle-Aquitaine</option>
			           <option value="occ">Occitanie</option>
			           <option value="pdl">Pays de la Loire</option>
			           <option value="pac">Provence-Alpes-Côte d'Azur</option>
			           <option value="gp">Guadeloupe</option>
			           <option value="gf">Guyane</option>
			           <option value="mq">Martinique</option>
			           <option value="re">La Réunion</option>
			           <option value="yt">Mayotte</option>
			       </select>
		    </p>
		    <p>
		      <label for="mail">Votre e-mail pour pouvoir être recontacter</label> :
		      <input type="email" placeholder="Ex : dupont@gmail.com" name="mail" id="mail" required/>
		    </p>
	</fieldset>
	<fieldset>
		<legend>Votre Recherche</legend>
			<p>
				
			</p>
	</fieldset>
		    	
		    <p>
		      <input type="submit" value="Envoyer" />
		    </p>
		    <input type='hidden' name='action' value='created'>
	
</form>

