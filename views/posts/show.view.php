<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>


<main>
	<div class='mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8'>
		<!-- Your content -->
		<h1 class='text-3xl font-bold tracking-tight text-gray-900'>
			Post Page
		</h1>
		<!--// Showing Single Post at Card-->

		<div class='mt-6 bg-white shadow rounded-lg p-6'>
			<h2 class='text-xl font-semibold text-gray-900'><?= htmlspecialchars($post['title']) ?></h2>
			<p class='mt-2 text-gray-700'><?= htmlspecialchars($post['description']) ?></p>
			<p class='mt-4 text-sm text-gray-500'>
				Posted on <?= date('F j, Y', strtotime($post['created_at'])) ?></p>
		</div>
		<div class='mt-6'>
			<a href='/posts' class='text-blue-600 hover:underline'>Back to Posts</a>
		</div>

	</div>
</main>

<?php require base_path('views/partials/footer.php'); ?>