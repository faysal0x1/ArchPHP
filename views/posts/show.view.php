<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
	<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
		<div class="bg-white shadow rounded-lg p-6">
			<h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-4">
				<?= htmlspecialchars($post->title) ?>
			</h1>

			<div class="prose max-w-none">
				<p class="text-gray-700"><?= htmlspecialchars($post->description) ?></p>
			</div>

			<div class="mt-6 flex items-center justify-between">
				<p class="text-sm text-gray-500">
					Posted on <?= date('F j, Y', strtotime($post->created_at)) ?>
				</p>

				<div class="flex space-x-4">
					<a href="/post/edit?id=<?= $post->id ?>"
						class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
						Edit Post
					</a>

					<form method="POST" action="/post/delete" class="inline">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="id" value="<?= $post->id ?>">
						<button type="submit"
							class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700"
							onclick="return confirm('Are you sure you want to delete this post?')">
							Delete Post
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>

<?php require base_path('views/partials/footer.php'); ?>