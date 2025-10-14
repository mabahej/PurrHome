README.txt
Projet Symfony – PurrHome
------------------------------------------------------------------
Étudiante : Mabahej BEN HASSINE
Thème : Gestion d’un refuge de chats (application PurrHome)
------------------------------------------------------------------
Présentation générale

PurrHome est une application Symfony dédiée aux refuges et aux passionnés de chats.
Elle permet de gérer les chats disponibles à l’adoption, de présenter leurs profils dans des vitrines d’adoption, et de faciliter les interactions entre refuges, adoptants et bénévoles.

L’objectif du projet est de :

Centraliser les informations des refuges et de leurs chats.

Offrir une vitrine numérique pour promouvoir l’adoption.
---------------------------------------------------------------------
---------------------------------------------------------------------
Domaine fonctionnel 
Nom logique	Entité réelle	Description
[objet]			Chat		Représente un chat à adopter ou déjà adopté.
[inventaire]	Refuge		Contient la liste des chats gérés par un refuge.
[galerie]		Vitrine		Présente des photos et descriptions d’un chat.
[Member]		Member		Personne adoptante ou bénévole.
---------------------------------------------------------------------
---------------------------------------------------------------------
Contrôleurs et Routes créées
 RefugeController (/refuge)

Nom interne : RefugeController (lié à [inventaire])
--------
Routes :
--------
GET /refuge
→ Affiche la liste de tous les refuges.
But : Consultation générale de l’inventaire des refuges.

GET /refuge/{id}
→ Affiche le détail d’un refuge et la liste des chats qui y sont hébergés.
But : Permet de visualiser les chats d’un refuge précis.

(Les routes sont définies dans src/Controller/RefugeController.php.)
---------------------------------------------------------------------------
---------------------------------------------------------------------------
 ChatController (/chat)

Nom interne : ChatController (lié à [objet])
--------
Routes :
--------
GET /chat
→ Affiche tous les chats (adoptés ou disponibles).

GET /chat/{id}
→ Détail d’un chat précis.
---------------------------------------------------------------------------
---------------------------------------------------------------------------

 ![datagram](./DIAGRAM.png)
 ---------------------------------------------------------------------------
 --------------------------------------------------------------------------
 Instructions d’installation et d’exécution
 Étape 1 — Extraire le projet

Décompressez l’archive dans un répertoire de travail .
Exemples :

Windows : C:\Users\<votre_nom>\rendu-CSC4101/mycat

Linux / macOS : /home/<votre_nom>/rendu-CSC4101/mycat

Puis, ouvrez un terminal dans le dossier du projet.
-------------------------------------------------
 Étape 2 — Nettoyer et installer les dépendances

🔹 Sous Linux / macOS :
rm -rf composer.lock symfony.lock vendor/ var/cache/
symfony composer install
🔹 Sous Windows (PowerShell) :
Remove-Item composer.lock, symfony.lock -ErrorAction SilentlyContinue
Remove-Item -Recurse -Force vendor, var\cache
symfony composer install

Cette commande télécharge et installe toutes les dépendances PHP nécessaires au bon fonctionnement de l’application.
---------------------------------------------------
Étape 3 Assurez-vous que les fixtures (données de test) sont bien chargées.

Si nécessaire, rechargez-les avec :

symfony console doctrine:fixtures:load
---------------------------------------------------
 Étape 4 — Démarrer le serveur Symfony
🔹 Sous Linux / macOS :
symfony server:start

🔹 Sous Windows :
symfony server:start


Ensuite, ouvrez votre navigateur et rendez-vous à l’adresse affichée dans le terminal, généralement :
http://127.0.0.1:8000/refuge

 Étape 4 — Vérifier le bon fonctionnement

Vérifiez que la page d’accueil s’affiche correctement.

Naviguez vers les pages refuge et chat.

