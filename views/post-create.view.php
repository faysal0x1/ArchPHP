<?php require('partials/head.php'); ?>
<?php require('partials/nav.php'); ?>
<?php require('partials/banner.php'); ?>


	<main>
		<div class='mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8'>
			<!-- Your content -->
			<h1 class='text-3xl font-bold tracking-tight text-gray-900'>Create Post </h1>

			<p class='mt-4 text-gray-600'>Welcome to your post creation page! Here you can create a new post.</p>

			<!-- Form to create a new note -->
			<form action="/post/create" method="POST" class="mt-6">
				<div class="mb-4">
					<label for="title" class="block text-sm font-medium text-gray-700">Title</label>
					<input type="text" id="title" name="title" required
					       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
				</div>
				<div class="mb-4">
					<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
					<textarea id="description" name="description" rows="4" required
					          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
				</div>


				<div class="mb-4">
					<label for="user_id" class="block text-sm font-medium text-gray-700">User ID</label>
					<input type="number" id="user_id" name="user_id" required
					       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
				</div>


				<div class="mb-4">
					<label for="status" class="block text-sm font-medium text-gray-700">Status</label>
					<select id="status" name="status"
					        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
						<option value="draft">Draft</option>
						<option value="published">Published</option>
					</select>
				</div>

				<div class="mb-4">
					<button type="submit"
					        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
						Create Note
					</button>
				</div>
			</form>

		</div>
	</main>

<?php require('partials/footer.php'); ?>