// script.js

var users = [
    { id: 1, fullName: 'Beatriz', role: 0 },
    { id: 2, fullName: 'Jon Sanchez', role: 0 },
    { id: 3, fullName: 'David Ivars', role: 0 },
    { id: 4, fullName: 'Juan Cruz', role: 1 },
    { id: 5, fullName: 'Africa Perez', role: 1 }
];

function searchUsers() {
    var searchTerm = document.getElementById('search').value.toLowerCase();
    var resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = '';

    var filteredUsers = users.filter(function(user) {
        return user.fullName.toLowerCase().includes(searchTerm);
    });

    filteredUsers.forEach(function(user) {
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.value = user.id;

        var label = document.createElement('label');
        label.appendChild(checkbox);
        label.appendChild(document.createTextNode(user.fullName));

        resultsContainer.appendChild(label);
        resultsContainer.appendChild(document.createElement('br'));
    });
}

function deleteSelected() {
    var selectedIds = getSelectedUserIds();
    users = users.filter(function(user) {
        return !selectedIds.includes(user.id.toString());
    });

    searchUsers();
}

function editSelected() {
    var selectedIds = getSelectedUserIds();
    if (selectedIds.length !== 1) {
        alert("Selecciona un solo usuario para editar.");
        return;
    }

    var userId = selectedIds[0];
    var user = users.find(function(user) {
        return user.id == userId;
    });

    var newName = prompt("Editar nombre:", user.fullName);
    if (newName !== null) {
        user.fullName = newName;
        searchUsers(); // Actualizar la lista después de la edición
    }
}

function getSelectedUserIds() {
    var checkboxes = document.querySelectorAll('#results input[type="checkbox"]:checked');
    var selectedIds = [];
    checkboxes.forEach(function(checkbox) {
        selectedIds.push(checkbox.value);
    });
    return selectedIds;
}

function insertUser() {
    var newFullName = document.getElementById('newFullName').value;
    var newUserId = users.length + 1; // Simulación de nuevo ID

    users.push({ id: newUserId, fullName: newFullName, role: 0 });

    searchUsers();
}
