
 <script lang="ts">
	import { onMount } from 'svelte';
	import { page } from '$app/stores';
	import AddressForm from '$components/AddressForm.svelte';
	import NavBar from '$components/NavBar.svelte';
  
	let customer: undefined | CustomerType;
	
	let homeAddress: CustomerAddressType = { country: '', street: '', city: '', postcode: '' };
	let billingAddress: CustomerAddressType = { country: '', street: '', city: '', postcode: '' };
	let postalAddress: CustomerAddressType = { country: '', street: '', city: '', postcode: '' };
  
	onMount(() => {
	  fetch(`${import.meta.env.VITE_API_URL}/customers/${$page.params.id}`, {
		method: 'GET',
	  }).then((response) => {
		response.json().then((data) => {
		  customer = data;
  
		  homeAddress = customer?.addressHome || homeAddress;
		  billingAddress = customer?.addressBilling || billingAddress;
		  postalAddress = customer?.addressPostal || postalAddress;
		});
	  });
	});
  </script>
  
  {#if customer === undefined}
	<p>Loading...</p>
  {:else}
  
  <div class="nav-bar">
	<NavBar/>
  </div>
  	<h2 class="text-center text-primary font-weight-bold display-4">{customer.fullName	}</h2>

  
	<AddressForm
	  homeAddress={homeAddress}
	  billingAddress={billingAddress}
	  postalAddress={postalAddress}
	  readonly={true} />

  {/if}
  
