<script lang="ts">
	import { onMount } from 'svelte';
	import { page } from '$app/stores';
	import AddressDetail from '$components/AddressDetail.svelte';

	let customer = undefined as undefined | CustomerType;

	onMount(() => {
		fetch(`${import.meta.env.VITE_API_URL}/customers/${$page.params.id}`, {
			method: 'GET'
		}).then((response) => {
			response.json().then((data) => {
				customer = data;
			});
		});
	});
</script>

{#if customer === undefined}
	<p>Loading...</p>
{:else}
	<h1>Customer {customer.fullName}</h1>

	<AddressDetail address={customer.addressHome} title="Home address" />
	<AddressDetail address={customer.addressBilling} title="Billing address" />
	<AddressDetail address={customer.addressPostal} title="Postal address" />
{/if}

<a href="/">Back to list</a>
