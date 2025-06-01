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

		<!-- // Edit Button -->
		<div class='mt-6'>
			<a href='/post/edit?id=<?= htmlspecialchars($post['id']) ?>'
				class='inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700'>
				Edit Post
			</a>
		</div>

		<!-- // Delete Button -->

		<div class='mt-6'>
			<form method='POST' action='/post/delete' class='bg-white shadow rounded-lg p-6'>
				<h2 class='text-xl font-semibold text-gray-900 mb-4'>Delete Post</h2>
				<input type='hidden' name='post_id' value='<?= htmlspecialchars($post['id']) ?>'>
				<input type='hidden' name='_method' value='DELETE'>
				<p class='text-red-600 mb-4'>Are you sure you want to delete this post?</p>
				<button type='submit'
					class='inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700'>
					Delete Post
				</button>
			</form>


			<div class='mt-6'>
				<a href='/posts' class='text-blue-600 hover:underline'>Back to Posts</a>
			</div>

		</div>
</main>

<?php require base_path('views/partials/footer.php'); ?>