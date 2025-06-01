<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
    <div class='mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8'>
        <!-- Your content -->
        <h1 class='text-3xl font-bold tracking-tight text-gray-900'>
            <?= htmlspecialchars($heading) ?>
        </h1>

        <!-- Display errors if any -->
        <?php if (!empty($errors)): ?>
            <div class='mt-4 bg-red-50 border border-red-200 rounded-md p-4'>
                <div class='flex'>
                    <div class='ml-3'>
                        <h3 class='text-sm font-medium text-red-800'>
                            There were errors with your submission:
                        </h3>
                        <div class='mt-2 text-sm text-red-700'>
                            <ul class='list-disc pl-5 space-y-1'>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Edit File -->
        <div class='mt-6 bg-white shadow rounded-lg p-6'>
            <h2 class='text-xl font-semibold text-gray-900'>Edit Post</h2>
            <form method='POST' action='/post/update' class='space-y-4'>
                <input type='hidden' name='post_id' value='<?= htmlspecialchars($post['id']) ?>'>
                <input type='hidden' name='_method' value='PATCH'>

                <div>
                    <label for='title' class='block text-sm font-medium text-gray-700'>Title</label>
                    <input type='text' id='title' name='title'
                        class='mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500'
                        value='<?= htmlspecialchars($post['title']) ?>' required>
                </div>

                <div>
                    <label for='description' class='block text-sm font-medium text-gray-700'>Description</label>
                    <textarea id='description' name='description'
                        class='mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500'
                        rows='4' required><?= htmlspecialchars($post['description']) ?></textarea>
                </div>

                <div>
                    <label for='status' class='block text-sm font-medium text-gray-700'>Status</label>
                    <select id='status' name='status'
                        class='mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500'>
                        <option value='draft' <?= ($post['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value='published' <?= ($post['status'] ?? 'draft') === 'published' ? 'selected' : '' ?>>Published</option>
                    </select>
                </div>

                <button type='submit'
                    class='inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700'>
                    Update Post
                </button>
            </form>
        </div>

        <div class='mt-6'>
            <a href='/posts' class='text-blue-600 hover:underline'>Back to Posts</a>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php'); ?>