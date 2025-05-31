<?php require('partials/head.php'); ?>
<?php require('partials/nav.php'); ?>
<?php require('partials/banner.php'); ?>


	<main>
		<div class='mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8'>
			<!-- Your content -->
			<h1 class='text-3xl font-bold tracking-tight text-gray-900'>
				Posts Page
			</h1>
			<!--// Showing All Posts at Card-->

			<div class='mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3'>
				<?php foreach ($posts as $post): ?>
					<div class='bg-white shadow rounded-lg p-6'>
						<h2 class='text-xl font-semibold text-gray-900'><?= htmlspecialchars($post['title']) ?></h2>
						<a href='/post?id=<?= $post['id'] ?>' class='block mt-2 text-blue-600 hover:underline'>
							<p class='mt-2 text-gray-700'><?= htmlspecialchars($post['description']) ?></p>
						</a>
						<p class='mt-4 text-sm text-gray-500'>
							Posted on <?= date('F j, Y', strtotime($post['created_at'])) ?></p>
					</div>
				<?php endforeach; ?>
			</div>

		</div>
	</main>

<?php require('partials/footer.php'); ?>