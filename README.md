# 📚 Exercice ELAN Formation — *Forum MVC en PHP*

## 📝 À propos  
Ce projet est un **exercice pratique en PHP orienté objet**, réalisé dans le cadre de la formation **ELAN Formation**.  

L’objectif est de développer un **forum fonctionnel** basé sur :  
- une **architecture MVC**,  
- un **framework maison** fourni par le formateur,  
- et une **gestion complète des utilisateurs, topics et posts**.  

L’application permet notamment de :  
- 📌 Naviguer dans les catégories  
- 🧵 Créer des topics  
- 💬 Ajouter des posts  
- ✏️ Modifier ses propres messages  
- 🔐 S’inscrire, se connecter, consulter un profil utilisateur  

Ce projet met en pratique :  
- la **programmation orientée objet**,  
- le **pattern MVC**,  
- la manipulation d’un **framework maison**,  
- l’hydratation dynamique d’entités,

---

## 🧠 Notions abordées

### 🏗️ Architecture MVC  
- **Controllers** : réception des requêtes, logique métier  
- **Managers** : communication avec la base via le DAO  
- **Entities** : représentation objet des données SQL  
- **Views** : affichage via des templates dédiés  
- **Routing** basé sur les paramètres `ctrl` et `action`

---

### 🗄️ Base de données & framework maison  
- Gestion des **clés primaires et étrangères**  
- **Hydratation automatique** via `Entity::hydrate()`  
- Relations entre objets : *user → posts*, *topic → posts*, *category → topics*  
- Gestion du CRUD via les managers du framework

---

### 👤 Gestion utilisateur  
- Inscription, connexion, déconnexion  
- Stockage de l’utilisateur en session  
- Gestion des droits :  
  - Un utilisateur ne peut modifier **que ses propres messages**

---

### 🎨 Intégration front  
- Mise en place d’un **style CSS unifié**  
- Layout global appliqué à toutes les vues  
- Cohérence visuelle et structurelle sur l’ensemble du forum  
- Adaptation harmonieuse des vues dans le template principal

---

### 🔐 Sécurité & bonnes pratiques  
- Validation & nettoyage via `filter_input()`  
- Vérification systématique des permissions  
- Protection contre les injections SQL grâce à :  
  - l’usage de requêtes préparées PDO  
  - le passage de paramètres nommés  
- Gestion de l’authentification via les sessions PHP  
- **Séparation stricte** :  
  - Données (SQL)  
  - Logique (Controllers / Managers)  
  - Affichage (Views)

---

## 🎯 Objectifs pédagogiques

### 🧩 Partie PHP / POO  
- Manipuler classes, objets, propriétés et méthodes  
- Structurer un projet en **architecture MVC**  
- Comprendre et utiliser un **framework maison**  
- Gérer l’hydratation d’entités  
- Sécuriser les formulaires, manipuler `$_POST` proprement

---

### 🗄️ Partie SQL  
- Concevoir un **Modèle Conceptuel de Données (MCD)**  
- Modéliser les relations via clés étrangères  
- Utiliser les jointures dans les Managers  
- Séparer données, logique et présentation

---

### 🧭 Partie Générale  
- Lire et comprendre du **code existant** (framework MVC)  
- Naviguer dans une **architecture logicielle préconstruite**  
- Identifier les rôles : DAO / Managers / Entités / Contrôleurs / Vues  
- Adapter son code aux conventions du framework

---

## 📚 Ressources utiles  
- Documentation PHP : https://www.php.net/manual/fr/  
- MDN Web Docs : https://developer.mozilla.org/fr/  
- Stack Overflow : https://stackoverflow.com/  

---

## 👨‍💻 Auteur  
Projet réalisé dans le cadre de la formation **ELAN Formation**.
