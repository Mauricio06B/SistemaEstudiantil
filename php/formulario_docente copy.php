<?php 
include('sesionActiva.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("encabezado.php");?>
</head>
<body class="bg-zinc-100 dark:bg-zinc-800">
    <div class="container mx-auto p-4">
        <header class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-4">
                <img src="https://placehold.co/50" alt="Logo" class="rounded-full">
                <h1 class="text-xl font-bold text-zinc-700 dark:text-white">U. Caldas Open AI</h1>
            </div>
            <div class="flex items-center space-x-4">
                <img src="https://placehold.co/50" alt="Professor" class="rounded-full">
                <h2 class="text-lg font-semibold text-zinc-700 dark:text-white">Profesor Diego Maradona</h2>
                <button class="text-zinc-500 dark:text-zinc-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white dark:bg-zinc-700 p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-zinc-800 dark:text-white mb-3">CLASES</h3>
                <select class="w-full p-2 rounded border-zinc-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white">
                    <option>Redes y comunicacion</option>
                </select>
                <div class="mt-4">
                    <h4 class="font-semibold text-zinc-800 dark:text-white">Mensaje Ucaldas open Ai...</h4>
                    <p class="text-zinc-600 dark:text-zinc-300">Cuanto estudiantes faltaron a la clase de 11 de noviembre</p>
                    <div class="mt-2 p-2 bg-blue-100 dark:bg-blue-900 rounded">
                        <p class="text-zinc-800 dark:text-white">Los estudiantes que faltaron a la clase de redes y comunicaciones sin ningún tipo de excusa fueron:</p>
                        <ul class="list-disc pl-5 mt-2 text-zinc-700 dark:text-zinc-300">
                            <li>Martin Valverde (Lleva 4 faltas sin excusa)</li>
                            <li>José Marín (Primera falta)</li>
                            <li>Pepito Pérez (Lleva 2 faltas)</li>
                            <li>Alejandro Salgado (Primera falta)</li>
                        </ul>
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-2">Tener en cuenta que a las 5 faltas el estudiante puede perder la materia, por inasistencia.</p>
                    </div>
                </div>
            </div>

            <div class="col-span-2">
                <div class="bg-white dark:bg-zinc-700 p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-zinc-800 dark:text-white mb-3">Ultimas consultas</h3>
                    <ul class="list-disc pl-5 text-zinc-700 dark:text-zinc-300">
                        <li>Quien fue el mejor estudiante de clase</li>
                        <li>Quienes perdieron el primer parcial</li>
                        <li>Martin a cuantas clases falto en el semestre</li>
                        <li>Que personas quedaron recuperando</li>
                        <li>Cual fue el joven que no pudo inscribirse</li>
                        <li>Que personas no pudieron entrar a la clase</li>
                        <li>Cuantas faltas hubo el 12 de febrero</li>
                        <li>Quienes perdieron el tercer parcial</li>
                        <li>Quien saco el puntaje mas alto en el quiz</li>
                        <li>Quiz de primer corte quien fue el mejor</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
s