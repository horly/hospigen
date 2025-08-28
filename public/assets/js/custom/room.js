
const cabinetsData = window.jsonData;

//console.log(cabinetsData);

const searchInput = document.getElementById('searchInput');
const suggestionsContainer = document.getElementById('suggestions');
var no_results = $('.no_results').val();
var try_other_terms = $('.try_other_terms').val();

let searchTimeout = null;

// Écouter les changements dans le champ de recherche
searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    const query = this.value.trim();

    if (query.length >= 2) {
        searchTimeout = setTimeout(() => {
            fetchSuggestions(query);
        }, 200);
    } else {
        suggestionsContainer.style.display = 'none';
    }
});

// Fermer les suggestions quand on clique en dehors
document.addEventListener('click', function(e) {
    if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
        suggestionsContainer.style.display = 'none';
    }
});


// Recherche avec la touche Entrée
searchInput.addEventListener('keyup', function(e) {
    if (e.key === 'Enter') {
        const query = searchInput.value.trim();
        if (query) {
            fetchSuggestions(query);
        }
    }
});

// Récupérer les suggestions
function fetchSuggestions(query) {
    const results = filterCabinets(query);
    displaySuggestions(results, query);
}

// Filtrer les armoires
function filterCabinets(query) {
    const searchTerm = query.toLowerCase();
    return cabinetsData.filter(cabinet => {
        return cabinet.name.toLowerCase().includes(searchTerm) ||
                cabinet.description.toLowerCase().includes(searchTerm);
    });
}

// Afficher les suggestions
function displaySuggestions(suggestions, query) {
    if (suggestions.length === 0) {
        suggestionsContainer.innerHTML = `
            <div class="suggestion-item">
                <div class="suggestion-icon">
                    <i class="fas fa-search"></i>
                </div>
                <div class="suggestion-text">
                    <div class="suggestion-number">${no_results}</div>
                    <div class="suggestion-desc">${try_other_terms}</div>
                </div>
            </div>
        `;
        suggestionsContainer.style.display = 'block';
        return;
    }

    let html = '';
    suggestions.forEach(cabinet => {
        // Mise en évidence des correspondances
        const highlightedNumber = highlightMatch(cabinet.name, query);
        const highlightedDesc = highlightMatch(cabinet.description, query);

        html += `
            <a href="${cabinet.url}" class="suggestion-item">
                <div class="suggestion-icon">
                    <i class="fa-solid fa-door-open"></i>
                </div>
                <div class="suggestion-text">
                    <div class="suggestion-number">${highlightedNumber}</div>
                    <div class="suggestion-desc">${highlightedDesc}</div>
                </div>
            </a>
        `;
    });

    suggestionsContainer.innerHTML = html;
    suggestionsContainer.style.display = 'block';
}

// Fonction de surlignage des correspondances
function highlightMatch(text, query) {
    if (!query) return text;

    const regex = new RegExp(`(${escapeRegExp(query)})`, 'gi');
    return text.replace(regex, '<span class="suggestion-highlight">$1</span>');
}

// Échapper les caractères spéciaux pour les regex
function escapeRegExp(string) {
    return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}
