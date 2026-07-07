<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message reçu</title>
</head>
<body style="margin:0; padding:0; background-color:#f0f2ec; font-family: Arial, Helvetica, sans-serif;">
    <!-- Preheader (texte d'aperçu invisible) -->
    <div style="display:none; max-height:0; overflow:hidden; opacity:0;">
        Nous avons bien reçu votre message, {{ $contactMessage->prenom }}. Notre équipe vous répondra très vite.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f2ec; padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:100%; max-width:600px; background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 2px 10px rgba(27,94,60,0.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1B5E3C; padding:32px 40px; text-align:center;">
                            <p style="margin:0; font-size:22px; font-weight:bold; letter-spacing:1px; color:#ffffff;">MUDEA</p>
                            <p style="margin:4px 0 0; font-size:12px; letter-spacing:2px; text-transform:uppercase; color:#C9A227;">Mutuelle de Développement d'Andé</p>
                        </td>
                    </tr>

                    <!-- Bandeau doré fin -->
                    <tr>
                        <td style="height:4px; background-color:#C9A227; line-height:4px; font-size:0;">&nbsp;</td>
                    </tr>

                    <!-- Icône check -->
                    <tr>
                        <td style="padding:40px 40px 0; text-align:center;">
                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto;">
                                <tr>
                                    <td style="width:56px; height:56px; border-radius:50%; background-color:#E8F3EC; text-align:center; vertical-align:middle; font-size:26px; color:#1B5E3C;">
                                        ✓
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Corps -->
                    <tr>
                        <td style="padding:20px 40px 8px; text-align:center;">
                            <h2 style="margin:0; font-size:21px; color:#14532d;">Nous avons bien reçu votre message</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:12px 40px 0; color:#374151; font-size:15px; line-height:1.7;">
                            <p style="margin:0 0 12px;">Bonjour <strong>{{ $contactMessage->prenom }}</strong>,</p>
                            <p style="margin:0 0 12px;">
                                Merci pour votre message. Notre équipe a bien reçu votre demande et vous répondra dans les meilleurs délais.
                            </p>
                        </td>
                    </tr>

                    <!-- Référence -->
                    <tr>
                        <td style="padding:8px 40px 0;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb; border-left:4px solid #C9A227; border-radius:6px;">
                                <tr>
                                    <td style="padding:12px 16px;">
                                        <p style="margin:0; font-size:13px; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px;">Référence</p>
                                        <p style="margin:2px 0 0; font-size:16px; font-weight:bold; color:#1B5E3C;">#{{ $contactMessage->id }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Résumé du message -->
                    <tr>
                        <td style="padding:24px 40px 0;">
                            <p style="margin:0 0 8px; font-size:13px; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px;">Résumé de votre message</p>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb; border-radius:8px; border:1px solid #eef0eb;">
                                <tr>
                                    <td style="padding:18px 20px;">
                                        <p style="margin:0 0 10px; font-size:15px; color:#1f2937;"><strong style="color:#1B5E3C;">Objet :</strong> {{ $contactMessage->objet }}</p>
                                        <p style="margin:0; font-size:15px; color:#374151; line-height:1.6;">{{ $contactMessage->message }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:28px 40px 40px; color:#374151; font-size:15px; line-height:1.7;">
                            <p style="margin:0;">Merci pour votre confiance.</p>
                            <p style="margin:16px 0 0; font-weight:bold; color:#14532d;">L'équipe MUDEA</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f9fafb; padding:24px 40px; text-align:center; border-top:1px solid #eef0eb;">
                            <p style="margin:0; font-size:12px; color:#9ca3af; line-height:1.6;">
                                Vous recevez cet email suite à l'envoi d'un message via le site MUDEA.<br>
                                © {{ date('Y') }} MUDEA — Andé, Côte d'Ivoire
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
