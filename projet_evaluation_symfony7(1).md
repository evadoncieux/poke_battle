
# Projet d'Évaluation Symfony 7 : Jeu de Memory Pokémon

## Contexte
Vous allez développer un jeu de memory basé sur les Pokémon. Ce jeu sera accessible en ligne et nécessitera une connexion pour permettre le suivi des scores et des performances des joueurs.

## Objectifs
- Créer un jeu de memory avec trois niveaux de difficulté : débutant (9 cartes), avancé (16 cartes) et expert (25 cartes).
- Le jeu doit se jouer en solo, mais nécessitera une connexion pour gérer un historique personnel et un classement global.
- Les cartes afficheront une image de Pokémon, son nom et son niveau d'évolution, informations récupérées via l'API Pokémon.

## Fonctionnalités Requises

### Authentification et Gestion des Utilisateurs
- Implémenter un système d'authentification pour que seuls les utilisateurs connectés puissent jouer.
- Prévoir un rôle administrateur pour la gestion des données.

### Gestion des Cartes Pokémon
- Récupérer les informations de 36 Pokémon (image, nom, niveau d'évolution) via un appel à l'API Pokémon et les stocker dans une table de la base de données.
- Une interface accessible uniquement par l'administrateur doit permettre de lancer ce processus de récupération et d'insertion des données.
- Si l'administrateur relance ce processus, la table est préalablement vidée.

### Jeu de Memory
- Créer le jeu avec trois niveaux de difficulté :
  - Débutant : 4 cartes.
  - Avancé : 16 cartes.
  - Expert : 36 cartes.
- Chaque carte doit afficher l'image d'un Pokémon, son nom et son niveau d'évolution.
- **Explication du Jeu de Memory** :
  - Le jeu de memory est un jeu de correspondance où toutes les cartes sont placées face cachée. Le joueur retourne deux cartes à chaque tour. Si les deux cartes montrent le même Pokémon, elles restent face visible et le joueur peut continuer. Sinon, les cartes sont retournées face cachée. Le but du jeu est de trouver toutes les paires de cartes correspondantes avec le moins de tours possibles.

### Suivi des Scores et Classements
- Enregistrer l'historique des parties de chaque utilisateur.
- Mettre en place un classement global visible par tous les utilisateurs.

## Contraintes Techniques
- Utiliser Symfony 7 pour développer l'application.
- Base de données : MySQL.
- Interface utilisateur : HTML, CSS, JavaScript (vous pouvez utiliser un framework JS si vous le souhaitez).

## Livrables

### Code Source
- Un dépôt Git contenant le code source complet du projet.
- Des instructions claires pour installer et exécuter le projet en local.

### Documentation
- Documentation technique détaillant la structure du projet, les principaux composants, et comment les fonctionnalités ont été implémentées.
- Documentation utilisateur expliquant comment utiliser l'application.

### Démo Fonctionnelle
- Une version déployée de l'application accessible en ligne.
- Une démonstration en direct du fonctionnement de l'application devant la classe.

## Critères d'Évaluation
- **Fonctionnalités** : Respect des fonctionnalités demandées.
- **Qualité du Code** : Clarté, propreté et organisation du code.
- **Utilisabilité** : Facilité d'utilisation de l'application pour les utilisateurs.
- **Performance** : Temps de réponse de l'application et fluidité de l'expérience utilisateur.
- **Documentation** : Qualité et clarté de la documentation fournie.

## Ressources
- Documentation Symfony : [https://symfony.com/doc/current/index.html](https://symfony.com/doc/current/index.html)
- API Pokémon : [https://pokeapi.co/](https://pokeapi.co/)
