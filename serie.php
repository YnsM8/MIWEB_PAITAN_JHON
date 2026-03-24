<?php
$autor = "Jhon Robert Paitan Montes";

$num1 = $num2 = $resultado = $error = null;
$serie = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = trim($_POST['num1'] ?? '');
    $num2 = trim($_POST['num2'] ?? '');

    if ($num1 === '' || $num2 === '') {
        $error = "Por favor ingresa ambos números.";
    } elseif (!is_numeric($num1) || !is_numeric($num2)) {
        $error = "Ambos valores deben ser números válidos.";
    } else {
        $num1 = (float)$num1;
        $num2 = (float)$num2;

        // Genera la serie entre num1 y num2
        if ($num1 == $num2) {
            $serie = [$num1];
        } elseif ($num1 < $num2) {
            for ($i = $num1; $i <= $num2; $i++) {
                $serie[] = $i;
            }
        } else {
            for ($i = $num1; $i >= $num2; $i--) {
                $serie[] = $i;
            }
        }

        $diferencia = abs($num2 - $num1);
        $suma = array_sum($serie);
        $cantidad = count($serie);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Serie de Números — Proyecto PHP</title>
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
      --error: #f54242;
    }

    body {
      font-family: 'Space Mono', monospace;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 999;
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

    main {
      flex: 1;
      max-width: 760px;
      margin: 0 auto;
      width: 100%;
      padding: 4rem 2rem;
      animation: fadeUp .6s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .page-tag {
      font-size: 0.68rem;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: var(--accent);
      border: 1px solid var(--accent);
      display: inline-block;
      padding: 0.2rem 0.6rem;
      border-radius: 2px;
      margin-bottom: 1.2rem;
    }

    h1 {
      font-family: 'Syne', sans-serif;
      font-size: clamp(1.8rem, 4vw, 3rem);
      font-weight: 800;
      letter-spacing: -0.03em;
      margin-bottom: 0.5rem;
    }

    .subtitle {
      color: var(--muted);
      font-size: 0.8rem;
      margin-bottom: 2.5rem;
      line-height: 1.7;
    }

    /* FORM */
    form {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 4px;
      padding: 2rem;
      margin-bottom: 2rem;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .field label {
      display: block;
      font-size: 0.65rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 0.5rem;
    }

    .field input {
      width: 100%;
      background: var(--bg);
      border: 1px solid var(--border);
      border-radius: 3px;
      padding: 0.75rem 1rem;
      color: var(--text);
      font-family: 'Space Mono', monospace;
      font-size: 1rem;
      transition: border-color .2s;
      outline: none;
    }

    .field input:focus {
      border-color: var(--accent2);
    }

    .field input::placeholder { color: var(--muted); }

    button[type=submit] {
      background: var(--accent);
      color: #0b0c10;
      border: none;
      border-radius: 3px;
      padding: 0.85rem 2rem;
      font-family: 'Space Mono', monospace;
      font-size: 0.85rem;
      font-weight: 700;
      cursor: pointer;
      letter-spacing: 0.05em;
      transition: opacity .2s, transform .15s;
    }

    button[type=submit]:hover { opacity: 0.88; transform: translateY(-1px); }
    button[type=submit]:active { transform: translateY(0); }

    /* ERROR */
    .error-box {
      background: rgba(245,66,66,0.08);
      border: 1px solid rgba(245,66,66,0.3);
      border-left: 3px solid var(--error);
      border-radius: 3px;
      padding: 1rem 1.25rem;
      color: var(--error);
      font-size: 0.82rem;
      margin-bottom: 1.5rem;
    }

    /* RESULT */
    .result-block {
      animation: fadeUp .5s ease both;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1px;
      background: var(--border);
      border: 1px solid var(--border);
      border-radius: 4px;
      overflow: hidden;
      margin-bottom: 1.5rem;
    }

    .stat {
      background: var(--surface);
      padding: 1.25rem;
    }

    .stat-label {
      font-size: 0.62rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 0.4rem;
    }

    .stat-value {
      font-family: 'Syne', sans-serif;
      font-size: 1.4rem;
      font-weight: 800;
      color: var(--accent);
    }

    .serie-container {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 4px;
      padding: 1.5rem;
    }

    .serie-label {
      font-size: 0.65rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 1rem;
    }

    .serie-nums {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
    }

    .serie-num {
      background: var(--bg);
      border: 1px solid var(--border);
      border-radius: 3px;
      padding: 0.35rem 0.75rem;
      font-size: 0.85rem;
      color: var(--text);
      transition: all .15s;
    }

    .serie-num:first-child,
    .serie-num:last-child {
      border-color: var(--accent2);
      color: var(--accent2);
    }

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
    <a href="index.php">Inicio</a>
    <a href="serie.php" class="active">Serie</a>
    <a href="factorial.php">Factorial</a>
  </nav>
</header>

<main>
  <div class="page-tag">01 / Módulo</div>
  <h1>Serie de Dos Números</h1>
  <p class="subtitle">
    Ingresa dos números enteros y el sistema generará la serie completa<br>
    entre ellos, mostrando estadísticas del resultado.
  </p>

  <?php if ($error): ?>
    <div class="error-box">&#9888; <?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="POST" action="serie.php">
    <div class="form-row">
      <div class="field">
        <label>Número Inicial</label>
        <input type="number" name="num1" placeholder="Ej: 1"
               value="<?php echo htmlspecialchars($num1 ?? ''); ?>" required>
      </div>
      <div class="field">
        <label>Número Final</label>
        <input type="number" name="num2" placeholder="Ej: 10"
               value="<?php echo htmlspecialchars($num2 ?? ''); ?>" required>
      </div>
    </div>
    <button type="submit">&#9654; Generar Serie</button>
  </form>

  <?php if (!empty($serie)): ?>
  <div class="result-block">
    <div class="stats-grid">
      <div class="stat">
        <div class="stat-label">Términos</div>
        <div class="stat-value"><?php echo $cantidad; ?></div>
      </div>
      <div class="stat">
        <div class="stat-label">Diferencia</div>
        <div class="stat-value"><?php echo $diferencia; ?></div>
      </div>
      <div class="stat">
        <div class="stat-label">Suma Total</div>
        <div class="stat-value"><?php echo $suma; ?></div>
      </div>
    </div>

    <div class="serie-container">
      <div class="serie-label">
        Serie de <?php echo number_format($num1); ?> a <?php echo number_format($num2); ?>
        <?php if($cantidad > 50): ?>
          &mdash; mostrando primeros 50 de <?php echo $cantidad; ?>
        <?php endif; ?>
      </div>
      <div class="serie-nums">
        <?php
          $mostrar = array_slice($serie, 0, 50);
          foreach ($mostrar as $n):
        ?>
          <span class="serie-num"><?php echo $n; ?></span>
        <?php endforeach; ?>
        <?php if ($cantidad > 50): ?>
          <span class="serie-num" style="color:var(--muted);">+<?php echo $cantidad - 50; ?> más...</span>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
</main>

<footer>
  <span><?php echo htmlspecialchars($autor); ?></span>
  <span>Módulo: Serie de Números</span>
</footer>

</body>
</html>
