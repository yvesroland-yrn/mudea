<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message reçu</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #1f2937;">
    <h2 style="color: #14532d;">Nous avons bien reçu votre message</h2>
    <p>Bonjour {{ $message->prenom }},</p>
    <p>Merci pour votre message. Notre équipe a bien reçu votre demande et vous répondra dans les meilleurs délais.</p>
    <p><strong>Référence :</strong> #{{ $message->id }}</p>
    <p>Voici le résumé de votre message :</p>
    <div style="background: #f9fafb; padding: 16px; border-radius: 8px; margin: 16px 0;">
        <p><strong>Objet :</strong> {{ $message->objet }}</p>
        <p>{{ $message->message }}</p>
    </div>
    <p>Merci pour votre confiance.</p>
    <p>L’équipe MUDEA</p>
</body>
</html>
