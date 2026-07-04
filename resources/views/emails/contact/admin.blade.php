<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message MUDEA</title>
</head>
<body style="margin:0; padding:0; background-color:#f0f2ec; font-family: Arial, Helvetica, sans-serif;">
    <div style="display:none; max-height:0; overflow:hidden; opacity:0;">
        Nouveau message de {{ $contactMessage->prenom }} {{ $contactMessage->nom }} — {{ $contactMessage->objet }}
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f2ec; padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:100%; max-width:600px; background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 2px 10px rgba(27,94,60,0.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1B5E3C; padding:28px 40px; text-align:center;">
                            <p style="margin:0; font-size:22px; font-weight:bold; letter-spacing:1px; color:#ffffff;">MUDEA</p>
                            <p style="margin:4px 0 0; font-size:12px; letter-spacing:2px; text-transform:uppercase; color:#C9A227;">Administration</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="height:4px; background-color:#C9A227; line-height:4px; font-size:0;">&nbsp;</td>
                    </tr>

                    <!-- Badge notification -->
                    <tr>
                        <td style="padding:32px 40px 0;">
                            <table role="presentation" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#FEF3C7; border-radius:20px; padding:6px 14px;">
                                        <span style="font-size:12px; font-weight:bold; color:#92400e; text-transform:uppercase; letter-spacing:0.5px;">● Nouveau message</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:16px 40px 0;">
                            <h2 style="margin:0; font-size:20px; color:#14532d;">Nouveau message de contact reçu</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:10px 40px 0; color:#374151; font-size:15px; line-height:1.6;">
                            <p style="margin:0;">Bonjour,</p>
                            <p style="margin:8px 0 0;">Vous avez reçu un nouveau message depuis le formulaire de contact ou le chatbox MUDEA.</p>
                        </td>
                    </tr>

                    <!-- Détails du contact -->
                    <tr>
                        <td style="padding:24px 40px 0;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb; border-radius:8px; border:1px solid #eef0eb;">
                                <tr>
                                    <td style="padding:20px 24px;">

                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding:6px 0; font-size:13px; color:#6b7280; width:110px; vertical-align:top;">Nom</td>
                                                <td style="padding:6px 0; font-size:15px; color:#1f2937; font-weight:bold;">{{ $contactMessage->prenom }} {{ $contactMessage->nom }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="border-top:1px solid #eef0eb; line-height:1px; font-size:0;">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:10px 0; font-size:13px; color:#6b7280; vertical-align:top;">Email</td>
                                                <td style="padding:10px 0; font-size:15px; color:#1f2937;">{{ $contactMessage->email ?: 'Non renseigné' }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="border-top:1px solid #eef0eb; line-height:1px; font-size:0;">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:10px 0; font-size:13px; color:#6b7280; vertical-align:top;">Téléphone</td>
                                                <td style="padding:10px 0; font-size:15px; color:#1f2937;">{{ $contactMessage->telephone ?: 'Non renseigné' }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="border-top:1px solid #eef0eb; line-height:1px; font-size:0;">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:10px 0; font-size:13px; color:#6b7280; vertical-align:top;">Objet</td>
                                                <td style="padding:10px 0; font-size:15px; color:#1B5E3C; font-weight:bold;">{{ $contactMessage->objet }}</td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Message -->
                    <tr>
                        <td style="padding:20px 40px 0;">
                            <p style="margin:0 0 8px; font-size:13px; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px;">Message</p>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border:1px solid #eef0eb; border-left:4px solid #1B5E3C; border-radius:6px;">
                                <tr>
                                    <td style="padding:16px 20px;">
                                        <p style="margin:0; font-size:15px; color:#374151; line-height:1.6;">{{ $contactMessage->message }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- CTA -->
                    <tr>
                        <td style="padding:28px 40px 8px; text-align:center;">
                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto;">
                                <tr>
                                    <td style="background-color:#1B5E3C; border-radius:6px;">
                                        <a href="{{ url('/admin/messages/' . $contactMessage->id) }}" style="display:inline-block; padding:12px 28px; font-size:14px; font-weight:bold; color:#ffffff; text-decoration:none;">
                                            Voir dans l'administration
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:16px 40px 32px; text-align:center;">
                            <p style="margin:0; font-size:13px; color:#6b7280;">Ou consultez la messagerie de l'administration pour y répondre.</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f9fafb; padding:24px 40px; text-align:center; border-top:1px solid #eef0eb;">
                            <p style="margin:0; font-size:12px; color:#9ca3af; line-height:1.6;">
                                Notification automatique — Site MUDEA<br>
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
