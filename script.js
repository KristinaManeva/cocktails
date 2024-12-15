const cocktailList = document.getElementById('cocktailList');

// Initial cocktails
const initialCocktails = [
    {
        name: "Mojito",
        description: "Refreshing cocktail with mint, lime, and soda.",
        image: "https://www.example.com/images/mojito.jpg"
    },
    {
        name: "Margarita",
        description: "Classic cocktail with tequila, lime, and salt on the rim.",
        image: "https://www.example.com/images/margarita.jpg"
    },
    {
        name: "Pina Colada",
        description: "Tropical cocktail with pineapple and coconut.",
        image: "https://www.example.com/images/pina_colada.jpg"
    },
    {
        name: "Cosmopolitan",
        description: "Cocktail with vodka, lime, and cranberry.",
        image: "https://www.example.com/images/cosmopolitan.jpg"
    },
    {
        name: "Daiquiri",
        description: "Summer cocktail with rum, lime, and sugar.",
        image: "https://www.example.com/images/daiquiri.jpg"
    }
];

// Display the initial cocktails
initialCocktails.forEach(cocktail => {
    const li = document.createElement('li');
    li.innerHTML = `<strong>${cocktail.name}</strong>: ${cocktail.description} <img src="${cocktail.image}" alt="${cocktail.name}" width="50"> <button class="delete-button" onclick="deleteCocktail(this)">Delete</button>`;
    
    cocktailList.appendChild(li);
});

document.getElementById('cocktailForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const name = document.getElementById('cocktailName').value;
    const description = document.getElementById('cocktailDescription').value;
    const image = document.getElementById('cocktailImage').value;

    const li = document.createElement('li');
    li.innerHTML = `<strong>${name}</strong>: ${description} <img src="${image}" alt="${name}" width="50"> <button class="delete-button" onclick="deleteCocktail(this)">Delete</button>`;
    
    cocktailList.appendChild(li);

    // Clear the form
    document.getElementById('cocktailForm').reset();
});

function deleteCocktail(button) {
    const li = button.parentElement;
    li.remove();
}
