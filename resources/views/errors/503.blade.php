<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance - MUDEA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --green: #1b5e20;
            --green-dark: #0a3d14;
            --green-mid: #2e7d32;
            --green-light: #e8f5e9; 
            --green-soft: #c8e6c9;
            --gold: #f5a623;
            --gold-light: #fff8e1;
            --white: #ffffff;
            --cream: #f4f6f8;
            --border: #e0e8e4;
            --text: #1a2e25;
            --text-mid: #455d4f;
            --text-light: #7a9585;
            --radius-md: 14px;
            --radius-lg: 20px;
            --shadow-md: 0 6px 24px rgba(0, 0, 0, .11);
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--cream);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .error-container {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 60px 40px;
            max-width: 500px;
            text-align: center;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
        }

        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            object-fit: contain;
        }

        .error-code {
            font-size: 120px;
            font-weight: 900;
            color: var(--green);
            line-height: 1;
            margin-bottom: 10px;
        }

        .error-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 15px;
        }

        .error-message {
            font-size: 16px;
            color: var(--text-mid);
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .icon-container {
            width: 100px;
            height: 100px;
            background: var(--green-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            border: 3px solid var(--green-soft);
        }

        .icon-container i {
            font-size: 40px;
            color: var(--green);
        }

        .refresh-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--green);
            color: var(--white);
            padding: 14px 28px;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .refresh-btn:hover {
            background: var(--green-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(27, 94, 32, 0.3);
        }

        .footer-text {
            margin-top: 30px;
            font-size: 14px;
            color: var(--text-light);
        }

        @media (max-width: 480px) {
            .error-container {
                padding: 40px 25px;
            }

            .error-code {
                font-size: 80px;
            }

            .error-title {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-code">503</div>

        <h1 class="error-title">Maintenance en cours</h1>

        <p class="error-message">
            Nous effectuons actuellement des travaux de maintenance pour améliorer votre expérience.
            Le site sera de nouveau disponible très prochainement.
        </p>

        <button onclick="window.location.reload()" class="refresh-btn">
            <i class="fas fa-sync-alt"></i>
            Rafraîchir la page
        </button>

        <p class="footer-text">
            MUDEA © {{ date('Y') }}
        </p>
    </div>
</body>

</html>
