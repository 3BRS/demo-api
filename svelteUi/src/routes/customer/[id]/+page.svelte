<script lang="ts">
	import { onMount } from 'svelte';
	import { page } from '$app/stores';
	import AddressDetail from '$components/AddressDetail.svelte';
	import PillNav from '$components/PillNav.svelte';

	let customer = undefined as undefined | CustomerType;

	const navTabs: { id: string; label: string; target: string; active?: boolean }[] = [
		{ id: 'pills-basic-tab', label: 'Basic Info', target: '#pills-basic', active: true },
		{ id: 'pills-home-tab', label: 'Home Address', target: '#pills-home, #pills-home-none' },
		{
			id: 'pills-billing-tab',
			label: 'Billing Address',
			target: '#pills-billing, #pills-billing-none'
		},
		{
			id: 'pills-postal-tab',
			label: 'Postal Address',
			target: '#pills-postal, #pills-postal-none'
		}
	];

	onMount(() => {
		fetch(`${import.meta.env.VITE_API_URL}/customers/${$page.params.id}`, {
			method: 'GET'
		}).then((response) => {
			response.json().then((data) => {
				customer = data;
				//format date for display
				if (customer) {
					const date = new Date(customer.dateOfBirth);
					customer.dateOfBirth = date.toISOString().split('T')[0];
				}
			});
		});
	});
</script>

<div class="container mt-4">
	<div class="my-5 text-center">
		<h2>Customer Details</h2>
	</div>

	<PillNav tabs={navTabs} />

	{#if customer === undefined}
		<div class="row mt-5">
			<div class="spinner-border mx-auto" role="status">
				<span class="sr-only" />
			</div>
		</div>
		<div class="row mt-2 text-center">
			<h6>Loading</h6>
		</div>
	{:else}
		<div class="tab-content" id="pills-tabContent">
			<div
				class="tab-pane fade show active"
				id="pills-basic"
				role="tabpanel"
				aria-labelledby="pills-basic-tab"
				tabindex="0"
			>
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

			<AddressDetail address={customer.addressHome} title="Home address" id="pills-home" />

			<AddressDetail
				address={customer.addressBilling}
				title="Billing address"
				id="pills-billing"
			/>

			<AddressDetail
				address={customer.addressPostal}
				title="Postal address"
				id="pills-postal"
			/>
		</div>
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
