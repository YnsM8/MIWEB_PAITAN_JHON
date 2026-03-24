<?php
$autor = "Jhon Robert Paitan Montes";

$num1 = $num2 = $num3 = $suma = $error = null;
$promedio = $mayor = $menor = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = trim($_POST['num1'] ?? '');
    $num2 = trim($_POST['num2'] ?? '');
    $num3 = trim($_POST['num3'] ?? '');

    if ($num1 === '' || $num2 === '' || $num3 === '') {
        $error = "Por favor ingresa los tres números.";
    } elseif (!is_numeric($num1) || !is_numeric($num2) || !is_numeric($num3)) {
        $error = "Los tres valores deben ser números válidos.";
    } else {
        $num1 = (float)$num1;
        $num2 = (float)$num2;
        $num3 = (float)$num3;

        $suma     = $num1 + $num2 + $num3;
        $promedio = $suma / 3;
        $mayor    = max($num1, $num2, $num3);
        $menor    = min($num1, $num2, $num3);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suma de Tres Números — Proyecto PHP</title>
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
      grid-template-columns: repeat(4, 1fr);
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

    /* EQUATION BOX */
    .equation-box {
      background: var(--surface);
      border: 1px solid var(--border);
      border-left: 3px solid var(--accent2);
      border-radius: 4px;
      padding: 1.5rem 2rem;
      display: flex;
      align-items: center;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .eq-num {
      font-family: 'Syne', sans-serif;
      font-size: 2rem;
      font-weight: 800;
      color: var(--text);
    }

    .eq-op {
      font-size: 1.5rem;
      color: var(--muted);
    }

    .eq-eq {
      font-size: 1.5rem;
      color: var(--accent2);
    }

    .eq-result {
      font-family: 'Syne', sans-serif;
      font-size: 2.5rem;
      font-weight: 800;
      color: var(--accent);
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
  <h1>Suma de Tres Números</h1>
  <p class="subtitle">
    Ingresa tres números y el sistema calculará su suma total,<br>
    promedio, mayor y menor valor de forma instantánea.
  </p>

  <?php if ($error): ?>
    <div class="error-box">&#9888; <?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="POST" action="serie.php">
    <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr;">
      <div class="field">
        <label>Primer Número</label>
        <input type="number" step="any" name="num1" placeholder="Ej: 5"
               value="<?php echo htmlspecialchars($num1 ?? ''); ?>" required>
      </div>
      <div class="field">
        <label>Segundo Número</label>
        <input type="number" step="any" name="num2" placeholder="Ej: 12"
               value="<?php echo htmlspecialchars($num2 ?? ''); ?>" required>
      </div>
      <div class="field">
        <label>Tercer Número</label>
        <input type="number" step="any" name="num3" placeholder="Ej: 8"
               value="<?php echo htmlspecialchars($num3 ?? ''); ?>" required>
      </div>
    </div>
    <button type="submit">&#9654; Calcular Suma</button>
  </form>

  <?php if ($suma !== null): ?>
  <div class="result-block">
    <div class="stats-grid">
      <div class="stat">
        <div class="stat-label">Suma Total</div>
        <div class="stat-value"><?php echo number_format($suma, 2); ?></div>
      </div>
      <div class="stat">
        <div class="stat-label">Promedio</div>
        <div class="stat-value"><?php echo number_format($promedio, 2); ?></div>
      </div>
      <div class="stat">
        <div class="stat-label">Mayor</div>
        <div class="stat-value"><?php echo number_format($mayor, 2); ?></div>
      </div>
      <div class="stat">
        <div class="stat-label">Menor</div>
        <div class="stat-value"><?php echo number_format($menor, 2); ?></div>
      </div>
    </div>

    <div class="equation-box">
      <span class="eq-num"><?php echo number_format($num1, 2); ?></span>
      <span class="eq-op">+</span>
      <span class="eq-num"><?php echo number_format($num2, 2); ?></span>
      <span class="eq-op">+</span>
      <span class="eq-num"><?php echo number_format($num3, 2); ?></span>
      <span class="eq-eq">=</span>
      <span class="eq-result"><?php echo number_format($suma, 2); ?></span>
    </div>
  </div>
  <?php endif; ?>
</main>

<footer>
  <span><?php echo htmlspecialchars($autor); ?></span>
  <span>Módulo: Suma de Tres Números</span>
</footer>

</body>
</html>
