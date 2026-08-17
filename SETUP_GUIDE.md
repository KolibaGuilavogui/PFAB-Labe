# 🔧 Guide de Configuration - Ajout d'Utilisateurs

## ⚠️ ÉTAPE CRUCIALE: Exécuter les migrations

Avant de pouvoir ajouter des utilisateurs (producteurs ou fournisseurs), vous DEVEZ exécuter les migrations pour créer les tables dans la base de données.

### Commande à exécuter:

```bash
php artisan migrate
```

### Que cela fait:
✅ Crée la table `producteur` avec tous les champs nécessaires
✅ Crée la table `fournisseur` avec tous les champs nécessaires  
✅ Crée la table `commandes` pour les commandes
✅ Crée la table `ligne_commandes` pour les articles de commande

---

## 📝 Checklist - Avant d'ajouter un utilisateur

- ✅ Migrations exécutées: `php artisan migrate`
- ✅ Vous êtes connecté en tant qu'admin
- ✅ Les rôles 'producteur' et 'fournisseur' existent (vérifiez la table `roles`)
- ✅ Le dossier `storage/app/public/cni_documents` existe

### Créer le lien symbolique pour les fichiers publics:
```bash
php artisan storage:link
```

---

## 🐛 Dépannage

### ❌ "Table not found" ou "SQLSTATE"
**Solution:** Exécutez `php artisan migrate` dans votre terminal

### ❌ Fichiers CNI ne s'enregistrent pas
**Solution:** Exécutez `php artisan storage:link` pour créer le lien symbolique

### ❌ L'utilisateur est créé mais pas le profil (producteur/fournisseur)
**Solution:** Vérifiez les logs:
```bash
tail -f storage/logs/laravel.log
```

### ❌ "Rôle non attribué"
**Solution:** Vérifiez que les rôles 'producteur' et 'fournisseur' existent dans la table `roles`:
```bash
php artisan tinker
# Puis tapez:
# \App\Models\Role::pluck('name');
```

---

## 📊 Structure après migration

Après exécution de `php artisan migrate`, vous aurez:

| Table | Relation | Description |
|-------|----------|-------------|
| `users` | Parent | Les comptes utilisateurs |
| `producteur` | Enfant de users | Informations des producteurs agricoles |
| `fournisseur` | Enfant de users | Informations des fournisseurs d'intrants |
| `commandes` | Commandes | Les commandes créées |
| `ligne_commandes` | Articles | Les articles des commandes |

---

## ✅ Test rapide

1. Allez à `/admin/users/create`
2. Remplissez le formulaire pour un Producteur Agricole
3. Cliquez sur "Enregistrer l'utilisateur"
4. Vous devriez voir: "Utilisateur créé avec succès !"

---

**Questions?** Consultez les logs: `storage/logs/laravel.log`
