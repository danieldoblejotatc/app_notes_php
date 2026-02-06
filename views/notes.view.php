<?php require("partials/head.php") ?>
<?php require("partials/nav.php") ?>
<?php require("partials/banner.php") ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($notes as $note): ?>
                <div class="group relative flex flex-col rounded-xl border border-white/10 bg-gray-800/50 p-6 transition-all hover:bg-gray-800 hover:ring-1 hover:ring-indigo-500">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white group-hover:text-indigo-400">
                            <a href="/app_notas_pract/note?id=<?= $note['id'] ?>">
                                <span class="absolute inset-0"></span> <?= htmlspecialchars($note['body']) ?>
                            </a>
                        </h3>
                        <p class="mt-2 text-sm text-gray-400 line-clamp-3">
                            Click para ver los detalles de esta nota...
                        </p>
                    </div>

                    <div class="mt-4 flex items-center text-xs font-medium text-indigo-400">
                        Ver nota
                        <svg class="ml-1 size-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php require("partials/footer.php") ?>