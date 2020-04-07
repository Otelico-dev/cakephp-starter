# Installation de Cake

1. Se connecter à la machine virtuelle ( vagrant ssh )
2. Naviguer au dossier racine du pojet
3. Executer script build : ./build.sh
4. Répondre yes [Y] à la question 'Set folder permissions
5. Ajouter utilisateur 'superadmin' : bin/cake users addSuperuser

# Installation de gulp ( dans le terminale de la machine hôte - hors vagrant)

1. Rendre executable le fichier build-gulp.sh
   chmod +x build-gulp.sh
2. Executer la commande build-gulp.sh
   ./build-gulp.sh
3. Si les node modules de l'admin ne sont pas installé correctement, naviguer au dossier (./plugin/AdminTheme/webroot/assets/gulp), hors la machine virtuelle, et installer normalement : npm install && gulp build

# Création de modules pour l'admin

1. Créer une table à l'aide de migrations

bin/cake bake migration Create[TableName][field:type]

ex. bin/cake bake migration CreateMembers name:string

bin/cake migrations migrate

2. Créer des fichiers en utilisant bake

bin/cake AdminTheme.AdminBake --table Members

3. Modifier le views selon besoin

# Création de controllers coté publique

1. Créer le controller en utilisant bake

bin/cake bake controller [TableNamePluriel]

ex. bin/cake bake controller Members

# Création de view coté publique

1. Créer dossier avec nom du tableau dans 'src/Template'

ex. mkdir src/Template/Members

2. Créer le view avec le même nom de l'action dans le controller

ex. index.ctp , view.ctp
