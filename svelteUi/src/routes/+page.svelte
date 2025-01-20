<script lang="ts">
	import { onMount } from 'svelte';

	let customers = undefined as undefined | any[];

	onMount(() => {
		fetch(`${import.meta.env.VITE_API_URL}/customers?page=1`, {
			method: 'GET'
		}).then((response) => {
			response.json().then((data) => {
				customers = data.member;
			});
		});
	});
</script>

<div class="container">
	<!-- Intro div -->
	<div class="py-5 text-center">
		<h2>Business Customers</h2>
		<p class="lead">
			Your customers are the heart of your business, and we just help you keep track of them.
			Our database makes it easy to organize, manage, and grow your relationships with your
			customers with ease.
		</p>
	</div>

	{#if customers === undefined}
		<div class="row mt-5">
			<div class="spinner-border mx-auto" role="status">
				<span class="sr-only" />
			</div>
		</div>
		<div class="row mt-2 text-center">
			<h6>Loading</h6>
		</div>
	{:else if Array.isArray(customers) && customers.length === 0}
		<p>No customers found</p>
	{:else}
		<div class="table-responsive">
			<table class="table">
				<thead class="table-dark">
					<tr>
						<th scope="col">Name</th>
						<th scope="col">Email</th>
						<th class="text-center">
                            <a href={'/create'} class="btn btn-sm btn-success">Add Customer</a>
                        </th>
					</tr>
				</thead>

				<tbody>
					{#each customers as customer}
						<tr>
							<td>
								{customer.fullName}
							</td>
							<td>
								{customer.email}
							</td>
							<td class="text-center">
								<a
									href={`/customer/${customer.id}`}
									class="btn btn-sm btn-outline-dark">Details</a
								>
							</td>
						</tr>
					{/each}
				</tbody>
			</table>
		</div>
	{/if}
</div>

<style lang="sass">
</style>
