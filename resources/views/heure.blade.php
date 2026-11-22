<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heure - Mini-CMS</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 40rem; margin: 3rem auto; padding: 0 1rem; color: #1f2937; line-height: 1.6; }
        h1 { color: #e6291b; }
        .clock { font-size: 2.5rem; font-weight: 700; margin: 1rem 0 0.25rem; }
        .date { color: #6b7280; font-size: 1.25rem; }
    </style>
</head>
<body>
    <h1>Heure de Tunis</h1>
    <p>Heure et date renvoyées par une vue Blade.</p>
    <div class="clock">{{ $heure }}</div>
    <div class="date">{{ $date }}</div>
</body>
</html>
