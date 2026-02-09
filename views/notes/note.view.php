<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="/app_notas_pract/notes" class="inline-flex items-center text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors">
                <svg class="mr-2 size-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Volver a todas las notas
            </a>
        </div>

        <article class="rounded-xl border border-white/10 bg-gray-800/30 p-8 shadow-2xl">
            <header class="mb-6 border-b border-white/5 pb-6">
                <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    Detalles de la Nota
                </h1>
                <div class="mt-3 flex items-center gap-4 text-sm text-gray-400">
                    <span class="flex items-center gap-1">
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        ID de nota: <?= $note['id'] ?>
                    </span>
                </div>
            </header>

            <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed">
                <p class="text-xl text-white/90">
                    <?= nl2br(htmlspecialchars($note['body'])) ?>
                </p>
            </div>

            <div class="mt-10 flex gap-4 border-t border-white/5 pt-8">
                <a href="/app_notas_pract/note/edit?id=<?= $note['id'] ?>" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Editar nota
                </a>

                <form method="POST" action="/app_notas_pract/note">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="<?= $note['id'] ?>">
                    <button class="rounded-lg bg-red-600/20 px-4 py-2 text-sm font-semibold text-red-400 hover:bg-red-600/40 border border-red-500/50">
                        Eliminar
                    </button>
                </form>
            </div>
        </article>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>