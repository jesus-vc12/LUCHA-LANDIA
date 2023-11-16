<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo 3D Interactivo</title>
    <style>
        body {
            margin: 0;
        }

        #canvas-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            /* Asegúrate de que el contenedor de Three.js esté detrás del modelo de Sketchfab */
        }

        .sketchfab-embed-wrapper {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
        }
    </style>
</head>

<body>
    <div id="canvas-container"></div>

    <!-- Código de incrustación de Sketchfab -->
    <div class="sketchfab-embed-wrapper"> <iframe title="John Cena" frameborder="0" allowfullscreen
            mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking"
            xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share
            src="https://sketchfab.com/models/ddaa747898ee49e38cb4b523c654ff16/embed"> </iframe>
        <p style="font-size: 13px; font-weight: normal; margin: 5px; color: #4A4A4A;"> <a
                href="https://sketchfab.com/3d-models/john-cena-ddaa747898ee49e38cb4b523c654ff16?utm_medium=embed&utm_campaign=share-popup&utm_content=ddaa747898ee49e38cb4b523c654ff16"
                target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;"> John Cena </a> by <a
                href="https://sketchfab.com/pixelnomialstudios?utm_medium=embed&utm_campaign=share-popup&utm_content=ddaa747898ee49e38cb4b523c654ff16"
                target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;"> pixelnomialstudios </a> on <a
                href="https://sketchfab.com?utm_medium=embed&utm_campaign=share-popup&utm_content=ddaa747898ee49e38cb4b523c654ff16"
                target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;">Sketchfab</a></p>
    </div>
    <div class="sketchfab-embed-wrapper"> <iframe title="John Cena" frameborder="0" allowfullscreen
            mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking"
            xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share
            src="https://sketchfab.com/models/ddaa747898ee49e38cb4b523c654ff16/embed"> </iframe>
        <p style="font-size: 13px; font-weight: normal; margin: 5px; color: #4A4A4A;"> <a
                href="https://sketchfab.com/3d-models/john-cena-ddaa747898ee49e38cb4b523c654ff16?utm_medium=embed&utm_campaign=share-popup&utm_content=ddaa747898ee49e38cb4b523c654ff16"
                target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;"> John Cena </a><a
                href="https://sketchfab.com/pixelnomialstudios?utm_medium=embed&utm_campaign=share-popup&utm_content=ddaa747898ee49e38cb4b523c654ff16"
                target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;"></a><a
                href="https://sketchfab.com?utm_medium=embed&utm_campaign=share-popup&utm_content=ddaa747898ee49e38cb4b523c654ff16"
                target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;"></a></p>
    </div>

    <!-- Three.js -->
    <script src="https://threejs.org/build/three.js"></script>
    <!-- OrbitControls.js -->
    <script src="https://threejs.org/examples/js/controls/OrbitControls.js"></script>

    <script>
        // Configuración básica de Three.js
        var scene = new THREE.Scene();
        var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        var renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('canvas-container').appendChild(renderer.domElement);

        // Configuración de la cámara y renderizado
        camera.position.set(0, 0, 10); // Ajusta la posición de la cámara para hacer zoom
        camera.lookAt(0, 0, 0); // Ajusta la dirección de la cámara para que apunte al origen

        // Añadir interactividad de movimiento con el mouse
        var controls = new THREE.OrbitControls(camera, renderer.domElement);

        var animate = function () {
            requestAnimationFrame(animate);

            // Actualizar el control para habilitar la interactividad
            controls.update();

            renderer.render(scene, camera);
        };

        animate();
    </script>
</body>

</html>