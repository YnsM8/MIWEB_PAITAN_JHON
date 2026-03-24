<?php
$autor = "Jhon Robert Paitan Montes";

$numero = $resultado = $error = null;
$pasos = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = trim($_POST['numero'] ?? '');

    if ($numero === '') {
        $error = "Por favor ingresa un número.";
    } elseif (!ctype_digit($numero)) {
        $error = "El número debe ser un entero no negativo (0, 1, 2, ...).";
    } else {
        $numero = (int)$numero;

        if ($numero > 20) {
            $error = "Por seguridad, el máximo permitido es 20 (el resultado superaría el límite de enteros).";
        } else {
            // Calcula factorial con pasos
            $resultado = 1;
            if ($numero === 0 || $numero === 1) {
                $pasos[] = ["expr" => "{$numero}!", "valor" => 1];
                $resultado = 1;
            } else {
                $expr = "";
                for ($i = $numero; $i >= 1; $i--) {
                    $expr .= ($expr === '') ? $i : " × $i";
                    $parcial = 1;
                    for ($j = $numero; $j >= $i; $j--) {
                        $parcial *= $j;
                    }
                    // Solo guardamos pasos clave
                }
                // Reconstruimos pasos de forma ascendente
                $acum = 1;
                for ($i = 1; $i <= $numero; $i++) {
                    $acum *= $i;
                    $exprPaso = implode(' × ', range(1, $i));
                    $pasos[] = ["expr" => $exprPaso, "valor" => $acum];
                }
                $resultado = $acum;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Factorial — Proyecto PHP</title>
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

    form {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 4px;
      padding: 2rem;
      margin-bottom: 2rem;
      display: flex;
      gap: 1rem;
      align-items: flex-end;
    }

    .field { flex: 1; }

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
      font-size: 1.1rem;
      transition: border-color .2s;
      outline: none;
    }

    .field input:focus { border-color: var(--accent2); }
    .field input::placeholder { color: var(--muted); }

    button[type=submit] {
      background: var(--accent);
      color: #0b0c10;
      border: none;
      border-radius: 3px;
      padding: 0.85rem 1.75rem;
      font-family: 'Space Mono', monospace;
      font-size: 0.85rem;
      font-weight: 700;
      cursor: pointer;
      letter-spacing: 0.05em;
      white-space: nowrap;
      transition: opacity .2s, transform .15s;
    }

    button[type=submit]:hover { opacity: 0.88; transform: translateY(-1px); }

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
    .result-block { animation: fadeUp .5s ease both; }

    .resultado-hero {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 4px;
      padding: 2.5rem 2rem;
      text-align: center;
      margin-bottom: 1.5rem;
      position: relative;
      overflow: hidden;
    }

    .resultado-hero::before {
      content: '<?php echo $numero ? $numero . '!' : ''; ?>';
      position: absolute;
      font-family: 'Syne', sans-serif;
      font-size: 12rem;
      font-weight: 800;
      color: var(--border);
      top: -1rem;
      right: -1rem;
      pointer-events: none;
      line-height: 1;
    }

    .result-label {
      font-size: 0.65rem;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 0.75rem;
    }

    .result-equation {
      font-family: 'Syne', sans-serif;
      font-size: 1.1rem;
      color: var(--accent2);
      margin-bottom: 0.5rem;
    }

    .result-value {
      font-family: 'Syne', sans-serif;
      font-size: clamp(2.5rem, 6vw, 4rem);
      font-weight: 800;
      color: var(--accent);
      letter-spacing: -0.03em;
      word-break: break-all;
    }

    /* STEPS TABLE */
    .steps-box {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 4px;
      overflow: hidden;
    }

    .steps-header {
      padding: 1rem 1.5rem;
      border-bottom: 1px solid var(--border);
      font-size: 0.65rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--muted);
    }

    .step-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0.75rem 1.5rem;
      border-bottom: 1px solid var(--border);
      font-size: 0.82rem;
      transition: background .15s;
    }

    .step-row:last-child { border-bottom: none; }
    .step-row:hover { background: rgba(200,245,66,0.03); }

    .step-expr { color: var(--muted); flex: 1; }

    .step-eq {
      color: var(--border);
      margin: 0 1rem;
    }

    .step-val {
      color: var(--accent);
      font-weight: 700;
      font-family: 'Syne', sans-serif;
      font-size: 0.95rem;
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
    <a href="serie.php">Serie</a>
    <a href="factorial.php" class="active">Factorial</a>
  </nav>
</header>

<main>
  <div class="page-tag">02 / Módulo</div>
  <h1>Factorial de N</h1>
  <p class="subtitle">
    Ingresa un número entero entre 0 y 20.<br>
    El sistema calculará N! mostrando cada paso del proceso.
  </p>

  <?php if ($error): ?>
    <div class="error-box">&#9888; <?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="POST" action="factorial.php">
    <div class="field">
      <label>Número (0 – 20)</label>
      <input type="number" name="numero" min="0" max="20"
             placeholder="Ej: 7"
             value="<?php echo htmlspecialchars($numero ?? ''); ?>" required>
    </div>
    <button type="submit">&#9654; Calcular</button>
  </form>

  <?php if ($resultado !== null && $error === null): ?>
  <div class="result-block">

    <div class="resultado-hero">
      <div class="result-label">Resultado</div>
      <?php if ($numero <= 1): ?>
        <div class="result-equation"><?php echo $numero; ?>! = 1</div>
      <?php else: ?>
        <div class="result-equation"><?php echo $numero; ?>! =</div>
      <?php endif; ?>
      <div class="result-value"><?php echo number_format($resultado); ?></div>
    </div>

    <?php if (count($pasos) > 0): ?>
    <div class="steps-box">
      <div class="steps-header">Paso a paso</div>
      <?php foreach ($pasos as $p): ?>
        <div class="step-row">
          <span class="step-expr"><?php echo htmlspecialchars($p['expr']); ?></span>
          <span class="step-eq">=</span>
          <span class="step-val"><?php echo number_format($p['valor']); ?></span>
        </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
  <?php endif; ?>
</main>

<footer>
  <span><?php echo htmlspecialchars($autor); ?></span>
  <span>Módulo: Factorial</span>
</footer>

</body>
</html>
