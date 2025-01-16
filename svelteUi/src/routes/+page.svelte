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

<h1>Hello in svelte project</h1>

{#if customers === undefined}
	<p>Loading...</p>
{:else if Array.isArray(customers) && customers.length === 0}
	<p>No customers found</p>
{:else}
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>email</th>
				<th />
			</tr>
		</thead>
		<tbody>
			{#each customers as customer}
				<tr>
					<td>{customer.fullName}</td>
					<td>{customer.email}</td>
					<td>
						<a href={`/customer/${customer.id}`}>Detail</a>
					</td>
				</tr>
			{/each}
		</tbody>
	</table>
{/if}

<style lang="sass">
	table
		thead
			th
				text-align: left
</style>
