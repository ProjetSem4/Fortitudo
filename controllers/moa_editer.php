<div class="col-lg-9">
		<?php
		    // Check if the id is a number, and sanitize it
		    if(!is_numeric($_GET['id']))
		        die('Bad usage. $_GET[id] should be a number!');
		    else
		        $_GET['id'] = $slim->pdo->quote($_GET['id']);
		
		    // Query the database
		    $query = $slim->pdo->query('SELECT * FROM ' . $config['db_prefix'] . 'V_MOA WHERE id_personne = ' . $_GET['id']);
		
		    // Check if the id is valid
		    if($query->rowCount() < 1)
		        die('Nothing found');
		
		    $line = $query->fetch();
		
		    $templacat->set_variable("page_title", "Éditer " . $line['prenom'] . ' ' . $line['nom']);
		
		    // Show message(s), if needed
		    if(isset($_SESSION['fortitudo_messages']) && is_array($_SESSION['fortitudo_messages']))
		    {
		        // For each message
		        foreach($_SESSION['fortitudo_messages'] as $message)
		        {
		            // Use a different layout, determined by the type of the message
		            switch($message['type'])
		            {
		                case 'error' : 
		                    echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message['content'] . '</div>';
		                    break;
		            
		                case 'success' : 
		                    echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message['content'] . '</div>';
		                    break;
		            }
		        }
		
		        // Clean the message queue
		        $_SESSION['fortitudo_messages'] = array();
		    }
		?>    
		         
		<div class="panel panel-default contenu-page">
		    <p><a href="moa_visualiser?id=<?php echo $line['id_personne']; ?>">« Retourner sur la fiche MOA</a></p>
		    <h1>Éditer une fiche MOA</h1>
		                    
		    <form class="" role="form" method="post" action="moa_editer_submit">
		        <input id=id_moa name="id_moa" type="hidden" value="<?php echo $line['id_personne']; ?>" >
		        <div class="form-group col-sm-6">
		            <label for="nom">Nom du MOA :</label>
		            <div class="input-group">
		                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
		                <input id="nom" name="nom" type="text" value="<?php echo $line['nom']; ?>" class="form-control" placeholder="Nom" required > 
		            </div>
		        </div>
		                        
		        <div class="form-group col-sm-6">
		            <label for="prenom">Prénom du MOA :</label>
		            <div class="input-group">
		                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
		                <input id="prenom" name="prenom" type="text" value="<?php echo $line['prenom']; ?>" class="form-control" placeholder="Prénom" required>
		            </div>
		        </div>
		        <div class="form-group col-sm-12">
		            <label for="adresse">Adresse du MOA :</label>
		            <div class="input-group">
		                <div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
		                <input id="adresse" name="adresse" type="text" value="<?php echo $line['adresse']; ?>" class="form-control" placeholder="Adresse" required>
		            </div>
		        </div>
		        <div class="form-group col-sm-4">
		            <label for="cp">Code postal :</label>
		            <div class="input-group">
		                <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
		                <input id="cp" name="cp" type="text" value="<?php echo $line['code_postal']; ?>" class="form-control" placeholder="Code postal" required>
		            </div>
		        </div>
		        <div class="form-group col-sm-8">
		            <label for="email">Ville :</label>
		            <div class="input-group">
		                <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
		                <input type="text" value="<?php echo $line['ville']; ?>" name="ville" class="form-control" placeholder="Ville" required>
		            </div>
		        </div>
		                        
		        <div class="form-group col-sm-6">
		            <label for="email">Numéro de téléphone :</label>
		            <div class="input-group">
		                <div class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></div>
		                <input type="text" value="<?php echo $line['telephone']; ?>" name="tel" class="form-control" placeholder="Téléphone" required>
		            </div>
		        </div>
		        
		        <div class="form-group col-sm-6">
		            <label for="email">Adresse e-mail :</label>
		            <div class="input-group">
		                <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
		                <input type="email" value="<?php echo $line['mail']; ?>" name="email" class="form-control" placeholder="E-mail" required>
		            </div>
		        </div>
		                        
		        <button type="reset" class="btn btn-danger">Remettre à zéro le formulaire</button>
		        <button type="submit" class="btn btn-success">Editer le MOA</button>
		    </form>                 
		</div></div>
