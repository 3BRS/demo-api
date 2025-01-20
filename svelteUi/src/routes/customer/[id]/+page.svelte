<script lang="ts">
	import { onMount } from 'svelte';
	import { page } from '$app/stores';
	import AddressDetail from '$components/AddressDetail.svelte';
	import Tabs from '$components/Tabs.svelte';
	let customer = undefined as undefined | CustomerType;

	let tabNames = ['Basic Info', 'Home Address', 'Billing Address', 'Postal Address'];
	let activeTab = 'Basic Info';

	const tabChange = (e: CustomEvent) => {
		activeTab = e.detail;
		console.log(e.detail);
	};

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

<div class="container mt-4">
	<div class="my-5 text-center">
		<h2>Customer Details</h2>
	</div>

	<Tabs {tabNames} {activeTab} on:tabChange={tabChange} />

	{#if customer === undefined}
		<div class="row mt-5">
			<div class="spinner-border mx-auto" role="status">
				<span class="sr-only" />
			</div>
		</div>
		<div class="row mt-2 text-center">
			<h6>Loading</h6>
		</div>
	{:else if activeTab === 'Basic Info'}
		<div class="row mt-5">
			<div class="col-md-4">
				<h6>First Name</h6>
				<p class="text-break">
					{customer.firstName}
				</p>
			</div>

			<div class="col-md-4">
				<h6>Last Name</h6>
				<p class="text-break">
					{customer.lastName}
				</p>
			</div>

			<div class="col-md-4">
				<h6>Date of Birth</h6>
				<p class="text-break">
					{customer.dateOfBirth}
				</p>
			</div>

			<div class="row mt-4">
				<div class="col-md-4">
					<h6>Email</h6>
					<p class="text-break">
						{customer.email}
					</p>
				</div>

				<div class="col-md-4">
					<h6>Phone Number</h6>
					<p class="text-break">
						{customer.phone}
					</p>
				</div>
			</div>
		</div>
	{:else if activeTab === 'Home Address'}
		{#if customer.addressHome}
			<AddressDetail address={customer.addressHome} title="Home address" />
		{:else}
			<div class="mt-5 justify-content-center align-items-center text-center">
				<i class="bi bi-house-x-fill display-1" />
				<p class="mt-3 fs-4 text-secondary">No Address Found</p>
			</div>
		{/if}
	{:else if activeTab === 'Billing Address'}
		{#if customer.addressBilling}
			<AddressDetail address={customer.addressBilling} title="Billing address" />
		{:else}
			<div class="mt-5 justify-content-center align-items-center text-center">
				<i class="bi bi-house-x-fill display-1" />
				<p class="mt-3 fs-4 text-secondary">No Address Found</p>
			</div>
		{/if}
	{:else if activeTab === 'Postal Address'}
		{#if customer.addressPostal}
			<AddressDetail address={customer.addressPostal} title="Postal address" />
		{:else}
			<div class="mt-5 justify-content-center align-items-center text-center">
				<i class="bi bi-house-x-fill display-1" />
				<p class="mt-3 fs-4 text-secondary">No Address Found</p>
			</div>
		{/if}
	{/if}

	{#if customer !== undefined}
		<div class="row mb-4 mt-5 justify-content-center">
			<div class="col-2 text-center">
				<a href="/" class="btn btn-secondary">Back</a>
			</div>
			<div class="col-2 text-center d-grid gap-2">
				<a href="/edit/{customer.id}" class="btn btn-dark">Edit Info</a>
			</div>
		</div>
	{/if}
</div>

<style lang="sass">

</style>
