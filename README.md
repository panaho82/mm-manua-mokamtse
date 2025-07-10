# M&M Rental Car Raiatea - Site Web Statique

Un site web statique moderne et élégant pour M&M Rental Car à Raiatea, Polynésie Française.

## ✅ CORRECTIONS RÉCENTES (2025)

### 🐛 Problème résolu : Emails multiples
- ✅ **Ajout des attributs `name` manquants** dans le formulaire de réservation
- ✅ **Correction du JavaScript** qui bloquait les soumissions
- ✅ **Protection contre les doublons** côté serveur avec sessions PHP
- ✅ **Validation des données** avant envoi des emails
- ✅ **Désactivation du bouton** après soumission pour éviter les clics multiples

### 📝 Fichiers modifiés
- `reservation.html` - Ajout des attributs `name` aux champs du formulaire
- `contact.html` - Correction du JavaScript de soumission
- `js/main.js` - Suppression du `preventDefault()` problématique
- `send_reservation.php` - Protection contre les doublons + validation
- `send_contact.php` - Protection contre les doublons + validation
- `css/styles.css` - Styles pour champs en erreur et boutons désactivés

## 🚀 Déploiement sur Hostinger

### Fichiers à uploader
Uploadez tous ces fichiers sur votre hébergement Hostinger :

**Fichiers HTML :**
- `index.html`
- `reservation.html` ⭐ **MODIFIÉ**
- `contact.html` ⭐ **MODIFIÉ**
- `vehicules.html`
- `tarifs.html`
- `services.html`
- `about.html`
- `faq.html`
- `terms.html`
- `privacy.html`
- Pages de succès/erreur

**Fichiers PHP :**
- `send_reservation.php` ⭐ **MODIFIÉ**
- `send_contact.php` ⭐ **MODIFIÉ**

**Dossiers complets :**
- `css/` (avec `styles.css` ⭐ **MODIFIÉ**)
- `js/` (avec `main.js` ⭐ **MODIFIÉ**)
- `images/`

### 📧 Configuration email sur Hostinger
1. Vérifiez que l'adresse `reservation@mm-locationvoitureraiatea.shop` existe
2. La fonction `mail()` PHP devrait fonctionner automatiquement
3. Testez avec `test_mail.php` si nécessaire

## Caractéristiques

- Design moderne et épuré suivant les principes UX/UI
- Site entièrement responsive (s'adapte à tous les écrans)
- Animations et transitions fluides
- Optimisé pour les performances
- Navigation simple et intuitive
- **Formulaires sécurisés contre les soumissions multiples**

## Structure du Site

- `index.html` - Page d'accueil
- `css/styles.css` - Feuille de style principale
- `js/main.js` - JavaScript pour l'interactivité
- `images/` - Dossier pour toutes les images
- **Formulaires PHP sécurisés** - Protection contre les doublons

## Pages à Développer

- [x] Accueil (index.html)
- [x] Nos Véhicules (vehicules.html)
- [x] Tarifs (tarifs.html)
- [x] Services (services.html)
- [x] À Propos (about.html)
- [x] Contact (contact.html) ✅ **CORRIGÉ**
- [x] Réservation (reservation.html) ✅ **CORRIGÉ**
- [x] FAQ (faq.html)
- [x] Conditions Générales (terms.html)
- [x] Politique de Confidentialité (privacy.html)

## Personnalisation

### Couleurs

Les couleurs principales du site sont définies dans les variables CSS dans le fichier `styles.css`. Elles peuvent être facilement modifiées pour correspondre à la charte graphique exacte du logo.

```css
:root {
    --primary-color: #1478c4; /* Bleu du logo - couleur principale */
    --secondary-color: #00a0d1; /* Bleu ciel - couleur secondaire */
    --accent-color: #ff8c00; /* Orange - couleur d'accent */
    --dark-color: #1478c4; /* Bleu foncé - pour texte et fonds */
    --light-color: #f8f9fa; /* Blanc cassé - pour les fonds */
    /* ... autres variables ... */
}
```

### Images

Remplacer les images d'espace réservé dans le dossier `images/` par les images réelles :

- `M&M Rental Car logo.jpg` - Logo de M&M Rental Car Raiatea
- `hero.png` - Grande image d'arrière-plan pour la section héro
- Images des véhicules (déjà en place)

## Installation et Utilisation

1. ⭐ **Uploadez les fichiers modifiés sur Hostinger**
2. Vérifiez que l'adresse email de destination est correcte
3. Testez les formulaires de contact et de réservation
4. **Les emails multiples ne devraient plus se produire**

## 🔧 Fonctionnalités de Sécurité

- **Protection CSRF** avec tokens de session
- **Validation des données** côté serveur
- **Prévention des soumissions multiples**
- **Nettoyage des données** avec `htmlspecialchars()`
- **Messages d'erreur sécurisés**

## Développement Futur

- Intégration de formulaires fonctionnels pour les réservations ✅ **FAIT**
- Système de galerie photo pour les véhicules
- Fonctionnalité de calcul de devis en ligne
- Intégration de Google Maps pour localiser l'agence

---

© 2025 M&M Rental Car Raiatea
