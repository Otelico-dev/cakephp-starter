# Base de données

1. Créer la base de données

2. Mettre à jour le fichier config/app.php avec les connexions de la base de données (lignes 266, 267, 268)

# Installation de Cake

1.  Se connecter à la machine virtuelle :

        vagrant ssh

2.  Naviguer au dossier racine du pojet

3.  Executer script build :

        ./build.sh

4.  Répondre yes [Y] à la question 'Set folder permissions'

5.  Ajouter utilisateur 'superadmin' :

        bin/cake users addSuperuser

# Installation de gulp ( dans le terminale de la machine hôte - hors vagrant)

1.  Rendre executable le fichier build-gulp.sh

        chmod +x build-gulp.sh

2.  Executer la commande build-gulp.sh

        ./build-gulp.sh

3.  Si les node modules de l'admin ne sont pas installé correctement, naviguer au dossier (./plugin/AdminTheme/webroot/assets/gulp), hors la machine virtuelle, et installer normalement :

        npm install && gulp build

# Création de modules pour l'admin

1.  Créer une table à l'aide de migrations

        bin/cake bake migration Create[TableName][field:type]

    ex. bin/cake bake migration CreateMembers name:string

2.  Executer les migrations

        bin/cake migrations migrate

3.  Créer des fichiers en utilisant bake

        bin/cake AdminTheme.AdminBake --table Members

4.  Modifier le views selon besoin

# Création de controllers coté publique

1.  Créer le controller en utilisant bake

        bin/cake bake controller [TableNamePluriel]

    ex. bin/cake bake controller Members

# Création de view coté publique

1. Créer dossier avec nom du tableau dans 'src/Template'

    ex. mkdir src/Template/Members

2. Créer le view avec le même nom de l'action dans le controller

    ex. index.ctp , view.ctp

# Ajout de behavior 'position' afin de pouvoir changer l'ordre des enregistrements

1.  Ajouter dans la fonctionne 'initialize' dans le fichier src/Model/Table/[NOM_DU_MODULE]Table.php

        $this->addBehavior('AdminTheme.Positionable');

2.  Ajouter l'option 'rowReorder' et le finder 'position' dans la fonctionne 'setDataTablesConfiguration' dans le fichier 'src/Controller/Admin/[NOM_DU_MODULE]Controller.php

        $this->DataTables->createConfig('Examples')
        	->options([
        		'rowReorder' =>  ['update' => false],
        	])
        	->column('Examples.id', ['label' => 'ID'])
        	->column('Examples.title', ['label' => 'Title'])
        	->column('actions', ['label' => 'Actions', 'class' => 'actions', 'database' => false])
        	->finder('position');

3.  Ajouter le code d'initilisation en bas du le fichier 'src/Template/Admin/[NOM_DU_MODULE]/index.ctp

        <?php
        $this->Html->scriptStart(['block' => true]);
        echo $this->DtReorder->getScript('dt[NOM_DU_MODULE]', ['action' => 'reorder']);
        $this->Html->scriptEnd();
        ?>

# Ajout de behavior 'publishable' afin de pouvoir publier / dépublier les enregistrements

1.  Ajouter dans la fonctionne 'initialize' dans le fichier src/Model/Table/[NOM_DU_MODULE]Table.php

        $this->addBehavior('AdminTheme.Publishable');

2.  Utiliser l'input 'switch' dans le formulaire

        echo $this->Form->control('is_published', [
        	'type' => 'switch'
        ]);
