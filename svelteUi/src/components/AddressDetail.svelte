<script lang="ts">
	export let title: string;
	export let address = undefined as undefined | CustomerAddressType;
  </script>
  
  {#if title && address}
	<h2>{title}</h2>
	<address>
	  {address.street}<br />
	  {address.city}, {address.postcode}<br />
	  {address.country}
	</address>
  {/if}
  
  <style lang="SASS">
	h2 {
	  color: maroon;
	}
  </style>
  