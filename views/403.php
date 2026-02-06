<?php require("partials/head.php") ?>
<?php require("partials/nav.php") ?>

<main class="grid min-h-full place-items-center bg-gray-900 px-6 py-24 sm:py-32 lg:px-8">
    <div class="text-center">
        <p class="text-xl font-bold text-indigo-500"><?= http_response_code() ?></p>

        <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-5xl">
            Unauthorized
        </h1>

        <p class="mt-6 text-base leading-7 text-gray-400">
            Lo sentimos, no tienes los permisos necesarios para ver esta página. </p>

        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="/app_notas_pract/"
                class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                Volver al inicio
            </a>

            <a href="/app_notas_pract/contact" class="text-sm font-semibold text-gray-300 hover:text-white">
                Contactar soporte <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
    </div>
</main>

<?php require("partials/footer.php") ?>