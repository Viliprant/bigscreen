# Bigscreen

## Obtenir le projet
Cloner le projet via github :
```
git clone https://github.com/Viliprant/bigscreen.git
```

## Installer les dépendances
Dans le terminal :
```
composer install
npm install
```

## .ENV
Choisir entre le **.env.dev** (debug) ou **env.production** (sans debug) en laissant seulement le **.env**. <br>
Ne pas oubliez de changer les informations de connexion à votre base de données dans le **.env**.

## Mise en place de la base de données
Après avoir crée la base de données avec le nom **bigscreen** (voir le **.env**).<br>
Entrez la commande suivante dans le terminal afin de lancer la création des tables et le remplissage avec de fausses données:
```
php artisan migrate:fresh --seed
```

## Lancer le projet
Utilisez les commandes suivantes dans votre terminal :
<br>
**Le serveur php** :
```
php artisan serve
```
Si vous souhaitez un **rechargement automatique de la page** pour des modifications :
```
npm run watch
```

## Explications pour parcourir le site
### Partie public
* **Formulaire**, accessible à la racine du site.<br>
*Choisir une adresse mail présent dans la base de données dont le status est égale à 0.*
* **Réponses**, accessible via l'url présente dans la base de données dans la table **poll** (http://localhost/poll/ **URL**).<br>
*Le statut doit être égale à 1.*

### Partie administration
Accessible via l'url : http://localhost/administration.<br>
* Login : admin@admin.fr
* Mot de passe : admin 

Les différentes pages seront indiquées sur le menu de gauche.