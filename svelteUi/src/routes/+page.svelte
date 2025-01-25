<script lang="ts">
	import { onMount } from 'svelte';
	import { goto } from '$app/navigation';
	import NavBar from '$components/NavBar.svelte';
	import Footer from '$components/Footer.svelte';
  
	let customers = undefined as undefined | any[];
	let customerAddresses = {
	  billingAddress: { building: 'billing', country: 'USA', street: '', city: '', postcode: '' },
	  postalAddress: { building: 'postal', country: 'USA', street: '', city: '', postcode: '' },
	  homeAddress: { building: 'home', country: 'USA', street: '', city: '', postcode: '' }
	};
  
	let activeTab: string = 'billing';
  
	function switchTab(tabId: string) {
	  activeTab = tabId;
	}
  
	const redirectTo = (url: string) => {
	  goto(url);
	};
  
	onMount(() => {
	  fetch(`${import.meta.env.VITE_API_URL}/customers?page=1`, {
		method: 'GET',
	  }).then((response) => {
		response.json().then((data) => {
		  customers = data.member;
		});
	  });
  
	  fetch(`${import.meta.env.VITE_API_URL}/addresses`, {
		method: 'GET',
	  })
		.then((response) => response.json())
		.then((data) => {
		  customerAddresses = {
			billingAddress: data.billing || { building: '', country: '', street: '', city: '', postcode: '' },
			postalAddress: data.postal || { building: '', country: '', street: '', city: '', postcode: '' },
			homeAddress: data.home || { building: '', country: '', street: '', city: '', postcode: '' }
		  };
		})
		.catch((error) => {
		  console.error('Error fetching addresses:', error);
		});
	});
  </script>
  
  <div class="nav-bar">
	<NavBar />
  </div>
    
  <div class="container mt-4">
	<div class="mb-4 text-center">
	  <button class="create-btn" on:click={() => redirectTo('customer/create')}>
		Create New Customer
	  </button>
	</div>
  
	{#if customers === undefined}
	  <p class="text-center loading-text">Loading...</p>
	{:else if Array.isArray(customers) && customers.length === 0}
	  <p class="text-center loading-text">No customers found</p>
	{:else}
	  <div class="row">
		{#each customers as customer}
		  <div class="col-md-2"></div>
		  <div class="col-md-8 mb-3">
			<div class="customer-card">
			  <div>
				<p class="customer-name">{customer.fullName}</p>
				<p class="customer-email">{customer.email}</p>
			  </div>
			  <div class="action-buttons">
				<button class="details-btn" on:click={() => redirectTo(`/customer/${customer.id}`)}>Details</button>
				<button class="edit-btn" on:click={() => redirectTo(`/customer/edit/${customer.id}`)}>Edit</button>
			  </div>
			</div>
		  </div>
		  <div class="col-md-2"></div>
		{/each}
	  </div>
	{/if}
  </div>
  <div class="footer">
	<Footer totalCustomers={customers?.length} />
  </div>
  
  <style lang="SASS">
	
	.create-btn {
	  background-color: #000;
	  background-image: linear-gradient(125deg, #a72879, #064497);
	  color: #fff;
	  font-size: 14px;
	  text-transform: uppercase;
	  padding: 10px 20px;
	  border: none;
	  border-radius: 4px;
	  cursor: pointer;
	  transition: background-color 0.3s;
	}
  
	.create-btn:hover {
	  background-color: #444;
	}
  
	.loading-text {
	  font-size: 18px;
	  color: #777;
	  text-align: center;
	  margin: 20px 0;
	}
  
	.customer-card {
	  display: flex;
	  justify-content: space-between;
	  align-items: center;
	  padding: 15px 20px;
	  background-color: #fff;
	  border: 1px solid #ddd;
	  border-radius: 8px;
	  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
	  transition: transform 0.2s ease, box-shadow 0.2s ease;
	}
  
	.customer-card:hover {
	  transform: translateY(-4px);
	  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
	}
  
	.customer-name {
	  font-size: 18px;
	  font-weight: 700;
	  margin: 0;
	  color: #5543ca;
	}
  
	.customer-email {
	  font-size: 14px;
	  color: #777;
	  margin: 0;
	}
  
	.action-buttons {
	  display: flex;
	  gap: 10px;
	}
  
	.details-btn,
	.edit-btn {
	  font-size: 12px;
	  text-transform: uppercase;
	  padding: 8px 12px;
	  border: none;
	  border-radius: 4px;
	  cursor: pointer;
	  transition: background-color 0.3s;
	}
  
	.details-btn {
	  background-color: #5543ca;
	  color: #fff;
	}
  
	.details-btn:hover {
	  background-color: #372a87;
	}
  
	.edit-btn {
	  background-color: #f4524d;
	  color: #fff;
	}
  
	.edit-btn:hover {
	  background-color: #d13833;
	}
  </style>
  