<?php
$nombre = "Jhon Robert Paitan Montes";
$fecha = date("d/m/Y");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Proyecto PHP — <?php echo $nombre; ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg: #0b0c10;
      --surface: #13151a;
      --border: #1e2128;
      --accent: #c8f542;
      --accent2: #42b8f5;
      --text: #e8eaf0;
      --muted: #6b7180;
      --danger: #f54242;
    }

    body {
      font-family: 'Space Mono', monospace;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* GRAIN OVERLAY */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 999;
      opacity: 0.5;
    }

    header {
      border-bottom: 1px solid var(--border);
      padding: 1.2rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      background: rgba(11,12,16,0.92);
      backdrop-filter: blur(12px);
      z-index: 100;
    }

    .logo {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.1rem;
      color: var(--accent);
      letter-spacing: -0.02em;
    }

    nav a {
      color: var(--muted);
      text-decoration: none;
      font-size: 0.78rem;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      margin-left: 2rem;
      transition: color .2s;
    }
    nav a:hover, nav a.active { color: var(--accent); }

    /* HERO */
    .hero {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 5rem 2rem 3rem;
      max-width: 900px;
      margin: 0 auto;
      width: 100%;
      animation: fadeUp .7s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(30px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .tag {
      font-size: 0.72rem;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: var(--accent);
      border: 1px solid var(--accent);
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border-radius: 2px;
      margin-bottom: 2rem;
    }

    h1 {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: clamp(2.4rem, 6vw, 4.5rem);
      line-height: 1.05;
      letter-spacing: -0.03em;
      margin-bottom: 1.5rem;
    }

    h1 span {
      color: transparent;
      -webkit-text-stroke: 1px var(--accent2);
    }

    .desc {
      color: var(--muted);
      font-size: 0.9rem;
      line-height: 1.8;
      max-width: 540px;
      margin-bottom: 3rem;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1px;
      border: 1px solid var(--border);
      background: var(--border);
      border-radius: 4px;
      overflow: hidden;
    }

    .card {
      background: var(--surface);
      padding: 2rem;
      text-decoration: none;
      color: inherit;
      transition: background .2s;
      position: relative;
      overflow: hidden;
    }

    .card::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 2px;
      background: var(--accent);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform .3s;
    }

    .card:hover { background: #1a1d24; }
    .card:hover::after { transform: scaleX(1); }

    .card-num {
      font-size: 0.65rem;
      letter-spacing: 0.1em;
      color: var(--muted);
      margin-bottom: 1rem;
    }

    .card-title {
      font-family: 'Syne', sans-serif;
      font-size: 1.1rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .card-desc {
      font-size: 0.75rem;
      color: var(--muted);
      line-height: 1.6;
    }

    .card-arrow {
      position: absolute;
      top: 1.5rem; right: 1.5rem;
      font-size: 1.2rem;
      color: var(--accent);
      opacity: 0;
      transform: translate(-4px, 4px);
      transition: all .3s;
    }
    .card:hover .card-arrow { opacity: 1; transform: translate(0,0); }

    /* PROFILE BOX */
    .profile-box {
      background: var(--surface);
      border: 1px solid var(--border);
      border-left: 3px solid var(--accent2);
      border-radius: 4px;
      padding: 2rem;
      margin-bottom: 2.5rem;
    }

    .profile-label {
      font-size: 0.65rem;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 0.5rem;
    }

    .profile-name {
      font-family: 'Syne', sans-serif;
      font-size: 1.8rem;
      font-weight: 800;
      letter-spacing: -0.02em;
      margin-bottom: 0.25rem;
    }

    .profile-meta {
      font-size: 0.75rem;
      color: var(--muted);
    }

    .profile-meta span { color: var(--accent); }

    footer {
      border-top: 1px solid var(--border);
      padding: 1.2rem 2rem;
      font-size: 0.7rem;
      color: var(--muted);
      display: flex;
      justify-content: space-between;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">&#9679; PROYECTO PHP</div>
  <nav>
    <a href="index.php" class="active">Inicio</a>
    <a href="serie.php">Serie</a>
    <a href="factorial.php">Factorial</a>
  </nav>
</header>

<main class="hero">
  <div class="tag">&#128100; Identificación</div>

  <div class="profile-box">
    <div class="profile-label">Desarrollado por</div>
    <div class="profile-name"><?php echo htmlspecialchars($nombre); ?></div>
    <div class="profile-meta">Fecha de acceso: <span><?php echo $fecha; ?></span></div>
  </div>

  <h1>Herramientas<br><span>Matemáticas</span></h1>
  <p class="desc">
    Proyecto PHP con cálculo de series numéricas, factoriales y más.
    Selecciona una herramienta para comenzar.
  </p>

  <div class="card-grid">
    <a href="serie.php" class="card">
      <div class="card-num">01 / MÓDULO</div>
      <div class="card-title">Serie de Dos Números</div>
      <div class="card-desc">Genera la serie aritmética entre dos números con su diferencia y cantidad de términos.</div>
      <span class="card-arrow">↗</span>
    </a>
    <a href="factorial.php" class="card">
      <div class="card-num">02 / MÓDULO</div>
      <div class="card-title">Factorial de N</div>
      <div class="card-desc">Calcula el factorial de cualquier número entero no negativo con visualización paso a paso.</div>
      <span class="card-arrow">↗</span>
    </a>
    <div class="card" style="cursor:default;">
      <div class="card-num">03 / INFO</div>
      <div class="card-title">Autor</div>
      <div class="card-desc"><?php echo htmlspecialchars($nombre); ?> &mdash; Proyecto académico PHP.</div>
    </div>
  </div>
</main>

<footer>
  <span><?php echo htmlspecialchars($nombre); ?></span>
  <span><?php echo $fecha; ?></span>
</footer>

</body>
</html>
