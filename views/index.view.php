<?php require('partials/head.php'); ?>


<?php require('partials/nav.php'); ?>

<?php require('partials/banner.php'); ?>

	<main>
		<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
			<!-- Your content -->
			<h1 class="text-3xl font-bold tracking-tight text-gray-900">My Home Page </h1>
			<p class="mt-4 text-gray-600">Welcome to your dashboard! Here you can manage your projects, view reports,
			                              and access your settings.</p>
			<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
				<?php foreach ($filteredBooks as $book): ?>
					<div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
						<h2 class="text-xl font-semibold text-gray-900"><?= htmlspecialchars($book['name']) ?></h2>
						<p class="text-gray-700">Author: <?= htmlspecialchars($book['author']) ?></p>
						<p class="text-gray-500">Year: <?= htmlspecialchars($book['year']) ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</main>
<?php require('partials/footer.php'); ?>