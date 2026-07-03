<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message MUDEA</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #1f2937;">
    <h2 style="color: #14532d;">Nouveau message de contact reçu</h2>
    <p>Bonjour,</p>
    <p>Vous avez reçu un nouveau message depuis le formulaire de contact ou le chatbox MUDEA.</p>

    <div style="background: #f9fafb; padding: 16px; border-radius: 8px; margin: 16px 0;">
        <p><strong>Nom :</strong> {{ $message->prenom }} {{ $message->nom }}</p>
        <p><strong>Email :</strong> {{ $message->email ?: 'Non renseigné' }}</p>
        <p><strong>Téléphone :</strong> {{ $message->telephone ?: 'Non renseigné' }}</p>
        <p><strong>Objet :</strong> {{ $message->objet }}</p>
        <p><strong>Message :</strong></p>
        <p>{{ $message->message }}</p>
    </div>

    <p>Veuillez consulter la messagerie de l’administration pour y répondre.</p>
</body>
</html>
