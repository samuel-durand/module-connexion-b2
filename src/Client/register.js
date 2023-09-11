document.getElementById('registrationForm').addEventListener('submit', async function (e) {
    e.preventDefault(); // Empêche la soumission du formulaire par défaut

    const formData = new FormData(this);

    try {
        const response = await fetch('Register.php', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            const data = await response.text(); // Vous pouvez utiliser .json() si la réponse est au format JSON

            console.log('Données renvoyées par register.php :', data);
        } else {
            console.error('Erreur lors de la requête vers register.php');
        }
    } catch (error) {
        console.error('Erreur lors de la requête fetch :', error);
    }
});