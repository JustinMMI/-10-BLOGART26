document.addEventListener('DOMContentLoaded', () => {

    const btnAdd = document.getElementById('btn-add');
    const btnRemove = document.getElementById('btn-remove');
    const dispo = document.getElementById('mots-dispo');
    const ajoutes = document.getElementById('mots-ajoutes');
    const form = ajoutes?.closest('form');

    if (!btnAdd || !btnRemove || !dispo || !ajoutes || !form) return;

    btnAdd.addEventListener('click', () => {
        moveOptions(dispo, ajoutes, true);
    });

    btnRemove.addEventListener('click', () => {
        moveOptions(ajoutes, dispo, false);
    });

    form.addEventListener('submit', () => {
        Array.from(ajoutes.options).forEach(opt => {
            opt.selected = true;
        });
    });

    function moveOptions(from, to, selectAfterMove) {
        Array.from(from.selectedOptions).forEach(option => {
            option.selected = selectAfterMove;
            to.appendChild(option);
        });
    }
});
