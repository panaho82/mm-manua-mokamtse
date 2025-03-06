// Fonction pour charger les traductions
async function loadTranslations(lang) {
    try {
        const response = await fetch(`js/translations/${lang}.json`);
        if (!response.ok) {
            throw new Error(`Failed to load translations for ${lang}`);
        }
        return await response.json();
    } catch (error) {
        console.error('Error loading translations:', error);
        return null;
    }
}

// Fonction pour appliquer les traductions
function applyTranslations(translations) {
    if (!translations) return;
    
    const elements = document.querySelectorAll('[data-lang-key]');
    elements.forEach(element => {
        const key = element.getAttribute('data-lang-key');
        if (translations[key]) {
            // Si l'élément est un input avec un placeholder
            if (element.placeholder !== undefined) {
                element.placeholder = translations[key];
            } 
            // Si l'élément est un input avec une valeur (comme les boutons)
            else if (element.value !== undefined && element.type !== 'text' && element.type !== 'email' && element.type !== 'password') {
                element.value = translations[key];
            } 
            // Pour tous les autres éléments
            else {
                element.textContent = translations[key];
            }
        }
    });
    
    // Stocker la langue actuelle dans localStorage
    localStorage.setItem('selectedLanguage', currentLanguage);
}

// Initialiser la langue par défaut
let currentLanguage = localStorage.getItem('selectedLanguage') || 'fr';

// Fonction pour changer de langue
async function changeLanguage(lang) {
    if (lang === currentLanguage) return;
    
    currentLanguage = lang;
    
    // Mettre à jour les boutons de langue
    document.querySelectorAll('.lang-btn').forEach(btn => {
        if (btn.getAttribute('data-lang') === lang) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
    
    // Charger et appliquer les traductions
    const translations = await loadTranslations(lang);
    applyTranslations(translations);
}

// Initialiser le sélecteur de langue
document.addEventListener('DOMContentLoaded', async () => {
    // Ajouter les écouteurs d'événements aux boutons de langue
    document.querySelectorAll('.lang-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            changeLanguage(btn.getAttribute('data-lang'));
        });
        
        // Activer le bouton de la langue actuelle
        if (btn.getAttribute('data-lang') === currentLanguage) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
    
    // Charger et appliquer les traductions initiales
    const translations = await loadTranslations(currentLanguage);
    applyTranslations(translations);
});
