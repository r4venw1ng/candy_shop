<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        h1 {
            text-align: center;
            text-transform: uppercase;
        }
        .contenido {
            font-size: 20px;
        }
        #primero {
            background-color: #ccc;
        }
        #segundo {
            color: #44a359;
        }
        #tercero {
            text-decoration: line-through;
        }
    </style>
</head>
<body>
    <h1>Título de prueba</h1>
    <hr>
    <div class="contenido">
        <p id="primero">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        <p id="segundo">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        <p id="tercero">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        <p>Fecha de hoy: {{ $today }}</p>
    </div>
</body>
</html>
