<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Connexion MUDEA</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}


body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:25px;
    background:var(--bg);
    position:relative;
    overflow-x:hidden;
}

/* ======================
   BLOBS
====================== */

.blob{
    position:absolute;
    border-radius:50%;
    filter:blur(15px);
    z-index:1;
    opacity:.7;
}

.blob1{
    width:260px;
    height:260px;
    top:-80px;
    left:-80px;
    background:radial-gradient(circle,#fff,#d88349);
}

.blob2{
    width:220px;
    height:220px;
    top:-60px;
    right:-60px;
    background:radial-gradient(circle,#fff,#c56d2f);
}

.blob3{
    width:280px;
    height:280px;
    bottom:-120px;
    left:-80px;
    background:radial-gradient(circle,#fff,#d88349);
}

.blob4{
    width:220px;
    height:220px;
    bottom:-100px;
    right:-60px;
    background:radial-gradient(circle,#fff,#146B3A);
}

/* ======================
   CARD
====================== */

.login-card{
    width:1150px;
    max-width:100%;
    min-height:620px;

    background:#fff;

    border-radius:30px;

    overflow:hidden;

    display:grid;
    grid-template-columns:430px 1fr;

    box-shadow:
    0 25px 60px rgba(0,0,0,.15);

    position:relative;
    z-index:2;
}

/* ======================
   LEFT
====================== */

.login-form{
    padding:40px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.logo-box{
    display:flex;
    align-items:center;
    gap:15px;
    margin-bottom:35px;
}

.logo-box img{
    width:65px;
    height:65px;
    object-fit:contain;
}

.logo-box h3{
    color:var(--green);
    font-size:20px;
    font-weight:700;
}

.logo-box p{
    font-size:13px;
    color:var(--muted);
}

.login-form h1{
    color:var(--green);
    font-size:38px;
    font-weight:800;
    margin-bottom:10px;
}

.subtitle{
    color:var(--muted);
    margin-bottom:30px;
}

.form-group{
    margin-bottom:18px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    color:var(--text);
    font-weight:600;
}

.form-group input{
    width:100%;
    height:52px;

    border:none;

    background:#F5F7FA;

    border-radius:12px;

    padding:0 18px;

    font-size:15px;

    transition:.3s;
}

.form-group input:focus{
    outline:none;

    background:#fff;

    box-shadow:
    0 0 0 3px rgba(20,107,58,.15);
}

.options{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin:18px 0 25px;
}

.remember{
    display:flex;
    align-items:center;
    gap:8px;
    color:#666;
    font-size:14px;
}

.options a{
    text-decoration:none;
    color:var(--gold);
    font-weight:600;
    font-size:14px;
}

.btn-login{
    width:100%;
    height:54px;

    border:none;

    border-radius:12px;

    background:
    linear-gradient(
        135deg,
        var(--green),
        var(--green-dark)
    );

    color:white;

    font-size:16px;
    font-weight:700;

    cursor:pointer;

    transition:.3s;
}

.btn-login:hover{
    transform:translateY(-2px);

    box-shadow:
    0 10px 25px rgba(20,107,58,.25);
}

/* ======================
   RIGHT
====================== */

.login-image{
    position:relative;

    background:
    linear-gradient(
        rgba(20,107,58,.20),
        rgba(20,107,58,.80)
    ),
    url('{{ asset("images/hero-ande.png") }}');

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
}

.content{
    position:absolute;
    left:45px;
    right:45px;
    bottom:45px;
    color:white;
}

.badge{
    display:inline-block;

    padding:10px 22px;

    border-radius:50px;

    background:rgba(255,255,255,.18);

    backdrop-filter:blur(8px);

    margin-bottom:20px;

    font-size:14px;
    font-weight:600;
}

.content h2{
    font-size:42px;
    line-height:1.15;
    margin-bottom:20px;
}

.content p{
    font-size:16px;
    line-height:1.8;
    margin-bottom:25px;
}

.features{
    list-style:none;
}

.features li{
    margin-bottom:12px;
    font-size:16px;
}

.features li::before{
    content:"✓ ";
    color:white;
    font-weight:bold;
}

/* ======================
   RESPONSIVE
====================== */

@media(max-width:992px){

.login-card{
    grid-template-columns:1fr;
}

.login-image{
    min-height:380px;
}

.content h2{
    font-size:32px;
}

}

@media(max-width:576px){

body{
    padding:15px;
}

.login-form{
    padding:25px;
}

.login-form h1{
    font-size:32px;
}

.options{
    flex-direction:column;
    align-items:flex-start;
    gap:12px;
}

.content{
    left:25px;
    right:25px;
    bottom:25px;
}

.content h2{
    font-size:28px;
}

}
</style>
</head>
<body>

<div class="blob blob1"></div>
<div class="blob blob2"></div>
<div class="blob blob3"></div>
<div class="blob blob4"></div>

<div class="login-card">

    <div class="login-form">

        <div class="logo-box">

            <!-- Remplace par ton logo -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo MUDEA">

            <div>
                <h3>MUDEA</h3>
                <p>Mutuelle de Développement d'Andé</p>
            </div>

        </div>

        <h1>Connexion</h1>

        <p class="subtitle">
            Connectez-vous à votre espace sécurisé.
        </p>

        <form>

            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="exemple@email.com">
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" placeholder="••••••••">
            </div>

            <div class="options">

                <label class="remember">
                    <input type="checkbox">
                    Se souvenir de moi
                </label>

                <a href="#">
                    Mot de passe oublié ?
                </a>

            </div>

            <button class="btn-login">
                Se connecter
            </button>

        </form>

    </div>

    <div class="login-image">

        <div class="content">

            <span class="badge">
                Portail Institutionnel
            </span>

            <h2>
                Bienvenue sur l'espace MUDEA
            </h2>

            <p>
                Gérez vos informations, consultez les actualités
                et accédez facilement aux services de la Mutuelle
                de Développement d'Andé.
            </p>

            <ul class="features">
                <li>Connexion sécurisée</li>
                <li>Accès rapide aux services</li>
                <li>Interface moderne et intuitive</li>
            </ul>

        </div>

    </div>

</div>

</body>
</html>