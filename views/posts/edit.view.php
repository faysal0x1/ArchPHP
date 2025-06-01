<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-4">
                Edit Post
            </h1>

            <form method="POST" action="/post/update" class="space-y-6">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $post->id ?>">

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text"
                        name="title"
                        id="title"
                        value="<?= htmlspecialchars($post->title) ?>"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description"
                        id="description"
                        rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"><?= htmlspecialchars($post->description) ?></textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="/post?id=<?= $post->id ?>"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                        Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php'); ?>