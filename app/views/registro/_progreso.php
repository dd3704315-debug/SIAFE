<?php
// Espera que la vista que lo incluye defina $paso (1 a 4)
$nombresPasos = [
    1 => "Plan",
    2 => "Empresa",
    3 => "Usuario",
    4 => "Confirmar"
];
?>

<div class="asistente-pasos">
    <?php foreach ($nombresPasos as $numero => $nombre): ?>
        <div class="paso-punto <?= $numero == $paso ? "activo" : ($numero < $paso ? "completado" : "") ?>">
            <div class="circulo">
                <?= $numero < $paso ? "✔" : $numero ?>
            </div>
            <?= htmlspecialchars($nombre) ?>
        </div>
    <?php endforeach; ?>
</div>
