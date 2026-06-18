# Structure de la Base de Données MUDEA

## Migrations créées avec Soft Deletes

### 1. Users (Utilisateurs)

**Fichier**: `2024_01_15_000009_add_fields_to_users_table.php`

**Champs**:

- `id` - Clé primaire
- `nom` - Nom de famille
- `prenom` - Prénom
- `email` - Email unique
- `telephone` - Numéro de téléphone
- `password` - Mot de passe hashé
- `role` - Enum: admin, moderateur, membre (défaut: membre)
- `statut` - Enum: actif, inactif (défaut: actif)
- `photo` - Chemin de la photo de profil
- `adresse` - Adresse complète
- `email_verified_at` - Timestamp de vérification email
- `remember_token` - Token "remember me"
- `last_login_at` - Dernière connexion
- `created_at`, `updated_at` - Timestamps
- `deleted_at` - Soft delete

**Relations**:

- hasMany Actualite
- hasMany Projet (comme responsable)
- hasMany Evenement
- hasMany Page

---

### 2. Actualités

**Fichier**: `2024_01_15_000001_create_actualites_table.php`

**Champs**:

- `id` - Clé primaire
- `titre` - Titre de l'actualité
- `slug` - Slug unique pour l'URL
- `categorie` - Enum: projets, education, communaute, culture, sante, actualite
- `statut` - Enum: publie, brouillon, archive (défaut: brouillon)
- `auteur` - Nom de l'auteur (défaut: "Admin MUDEA")
- `date_publication` - Date de publication
- `resume` - Résumé (max 300 caractères)
- `contenu` - Contenu principal (HTML supporté)
- `image` - Chemin de l'image
- `tags` - JSON array de mots-clés
- `vues` - Nombre de vues (défaut: 0)
- `notifier` - Boolean: notifier les abonnés (défaut: true)
- `partager_reseaux` - Boolean: partage auto réseaux (défaut: false)
- `epingle` - Boolean: épingler en haut (défaut: false)
- `commentaires` - Boolean: autoriser commentaires (défaut: true)
- `user_id` - Foreign key vers users
- `created_at`, `updated_at` - Timestamps
- `deleted_at` - Soft delete

**Scopes**:

- `publie()` - Actualités publiées
- `brouillon()` - Brouillons
- `archive()` - Archives
- `epingle()` - Actualités épinglées
- `byCategorie($categorie)` - Par catégorie

---

### 3. Projets

**Fichier**: `2024_01_15_000002_create_projets_table.php`

**Champs**:

- `id` - Clé primaire
- `titre` - Titre du projet
- `slug` - Slug unique pour l'URL
- `description` - Description détaillée
- `statut` - Enum: en-cours, realise, futur (défaut: futur)
- `secteur` - Enum: education, sante, eau, infrastructure, energie, agriculture
- `budget` - Budget en FCFA
- `avancement` - Pourcentage d'avancement (0-100)
- `date_debut` - Date de début
- `date_fin` - Date de fin prévisionnelle
- `media` - Chemin du document/média
- `featured` - Boolean: projet à la une (défaut: false)
- `responsable_id` - Foreign key vers users
- `created_at`, `updated_at` - Timestamps
- `deleted_at` - Soft delete

**Scopes**:

- `enCours()` - Projets en cours
- `realise()` - Projets réalisés
- `futur()` - Projets futurs
- `featured()` - Projets à la une
- `bySecteur($secteur)` - Par secteur

---

### 4. Messages (Contact)

**Fichier**: `2024_01_15_000003_create_messages_table.php`

**Champs**:

- `id` - Clé primaire
- `nom` - Nom
- `prenom` - Prénom
- `telephone` - Téléphone
- `email` - Email
- `objet` - Enum: adhesion, contribution, projet, education, information, autre
- `message` - Contenu du message
- `statut` - Enum: nouveau, lu, traite, archive (défaut: nouveau)
- `lu_at` - Timestamp de lecture
- `traite_at` - Timestamp de traitement
- `created_at`, `updated_at` - Timestamps
- `deleted_at` - Soft delete

**Méthodes**:

- `markAsLu()` - Marquer comme lu
- `markAsTraite()` - Marquer comme traité

**Scopes**:

- `nouveau()` - Messages nouveaux
- `lu()` - Messages lus
- `traite()` - Messages traités
- `archive()` - Messages archivés
- `nonLu()` - Messages non lus

---

### 5. Événements

**Fichier**: `2024_01_15_000004_create_evenements_table.php`

**Champs**:

- `id` - Clé primaire
- `titre` - Titre de l'événement
- `slug` - Slug unique pour l'URL
- `description` - Description
- `date` - Date de l'événement
- `lieu` - Lieu de l'événement
- `heure_debut` - Heure de début
- `heure_fin` - Heure de fin
- `image` - Chemin de l'image
- `statut` - Enum: a_venir, en_cours, termine, annule (défaut: a_venir)
- `user_id` - Foreign key vers users
- `created_at`, `updated_at` - Timestamps
- `deleted_at` - Soft delete

**Scopes**:

- `aVenir()` - Événements à venir
- `enCours()` - Événements en cours
- `termine()` - Événements terminés
- `annule()` - Événements annulés
- `futurs()` - Événements futurs (date >= aujourd'hui)
- `passes()` - Événements passés (date < aujourd'hui)

---

### 6. Pages

**Fichier**: `2024_01_15_000005_create_pages_table.php`

**Champs**:

- `id` - Clé primaire
- `titre` - Titre de la page
- `slug` - Slug unique pour l'URL
- `contenu` - Contenu de la page (HTML)
- `meta_title` - Meta title pour SEO
- `meta_description` - Meta description pour SEO
- `is_published` - Boolean: publié (défaut: true)
- `is_home` - Boolean: page d'accueil (défaut: false)
- `ordre` - Ordre d'affichage (défaut: 0)
- `user_id` - Foreign key vers users
- `created_at`, `updated_at` - Timestamps
- `deleted_at` - Soft delete

**Scopes**:

- `published()` - Pages publiées
- `draft()` - Brouillons
- `home()` - Page d'accueil
- `orderByOrdre()` - Trier par ordre

---

### 7. Newsletters

**Fichier**: `2024_01_15_000006_create_newsletters_table.php`

**Champs**:

- `id` - Clé primaire
- `email` - Email unique
- `nom` - Nom (optionnel)
- `prenom` - Prénom (optionnel)
- `statut` - Enum: actif, desabonne, bounce (défaut: actif)
- `desabonne_at` - Timestamp de désabonnement
- `token` - Token unique pour désabonnement
- `created_at`, `updated_at` - Timestamps
- `deleted_at` - Soft delete

**Méthodes**:

- `desabonner()` - Désabonner l'utilisateur
- `reactiver()` - Réactiver l'abonnement

**Scopes**:

- `actif()` - Abonnés actifs
- `desabonne()` - Abonnés désabonnés
- `bounce()` - Emails en bounce

---

### 8. Paramètres

**Fichier**: `2024_01_15_000007_create_parametres_table.php`

**Champs**:

- `id` - Clé primaire
- `cle` - Clé unique
- `valeur` - Valeur (peut être JSON)
- `type` - Type: text, number, boolean, json (défaut: text)
- `groupe` - Groupe de paramètres (défaut: general)
- `description` - Description du paramètre
- `created_at`, `updated_at` - Timestamps

**Méthodes statiques**:

- `getValeur($cle, $default)` - Récupérer une valeur
- `setValeur($cle, $valeur)` - Définir une valeur

**Scopes**:

- `byGroupe($groupe)` - Par groupe

---

### 9. Statistiques

**Fichier**: `2024_01_15_000008_create_statistiques_table.php`

**Champs**:

- `id` - Clé primaire
- `type` - Type de statistique (visites, inscriptions, contributions, etc.)
- `cle` - Clé pour distinguer (jour, mois, projet_id, etc.)
- `valeur` - Valeur numérique (défaut: 0)
- `date` - Date de la statistique
- `metadonnees` - JSON de métadonnées additionnelles
- `created_at`, `updated_at` - Timestamps

**Méthodes statiques**:

- `incrementer($type, $cle, $valeur, $metadonnees)` - Incrémenter une statistique
- `getSomme($type, $cle, $start, $end)` - Obtenir la somme sur une période

**Scopes**:

- `byType($type)` - Par type
- `byCle($cle)` - Par clé
- `byDate($date)` - Par date
- `betweenDates($start, $end)` - Entre deux dates

---

## Commandes pour exécuter les migrations

```bash
# Exécuter toutes les migrations
php artisan migrate

# Annuler la dernière migration
php artisan migrate:rollback

# Annuler toutes les migrations
php artisan migrate:reset

# Réexécuter toutes les migrations (reset + migrate)
php artisan migrate:fresh

# Voir le statut des migrations
php artisan migrate:status
```

## Seeders

### 1. AdminSeeder

**Fichier**: `AdminSeeder.php`

**Description**: Crée l'utilisateur administrateur par défaut du site.

**Informations de connexion**:

- **Email**: admin@mudea.com
- **Mot de passe**: 12345
- **Nom**: Admin MUDEA
- **Téléphone**: +225 07 00 00 00 28
- **Adresse**: Abidjan, Côte d'Ivoire
- **Rôle**: admin
- **Statut**: actif

**Commande pour exécuter**:

```bash
# Exécuter tous les seeders
php artisan db:seed

# Exécuter uniquement le seeder admin
php artisan db:seed --class=AdminSeeder

# Réinitialiser la base et exécuter les seeders
php artisan migrate:fresh --seed
```

**Note**: Le seeder utilise `updateOrCreate()` pour éviter les doublons lors d'exécutions multiples.

---

## Seeders recommandés (à créer)

Il est recommandé de créer des seeders supplémentaires pour:

- Paramètres par défaut du site
- Pages statiques initiales
- Catégories d'actualités
- Secteurs de projets
- Données de démonstration
