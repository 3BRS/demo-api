<script lang="ts">
	const date: Date = new Date();
	const dateOptions : Intl.DateTimeFormatOptions = {
		day: 'numeric',
		month: 'numeric',
		year: 'numeric',
		hour: 'numeric',
		minute: 'numeric'
	};
	const dateString: string = date.toLocaleString('en-GB', dateOptions).replace(',', '').replaceAll('/','.');
</script>

<nav class="navbar navbar-dark bg-dark">
	<a class="navbar-brand mx-3" href="/">
		<i class="bi bi-person-raised-hand h2" />
		Customer's GmbH
	</a>
    <span class="mx-3 text-light">{dateString}</span>
</nav>

<slot />

<footer class="text-muted text-center text-small my-5 pt-5">
	<p class="mb-1">&copy; Yasser Sheweta - Sample Project</p>
</footer>

