<script lang="ts">
	export let title: string;
	export let address = undefined as undefined | CustomerAddressType;
</script>

{#if title && address}
	<div class="row mt-5">
		<div class="col-md-4">
			<h6>Building</h6>
			<p class="text-break">
				{address.building ? address.building : 'N/A'}
			</p>
		</div>

		<div class="col-md-4">
			<h6>Street</h6>
			<p class="text-break">
				{address.street ? address.street : 'N/A'}
			</p>
		</div>

		<div class="col-md-4">
			<h6>Postcode</h6>
			<p class="text-break">
				{address.postcode ? address.postcode : 'N/A'}
			</p>
		</div>

		<div class="row mt-4">
			<div class="col-md-4">
				<h6>City</h6>
				<p class="text-break">
					{address.city ? address.city : 'N/A'}
				</p>
			</div>

			<div class="col-md-4">
				<h6>Country</h6>
				<p class="text-break">
					{address.country ? address.country : 'N/A'}
				</p>
			</div>
		</div>
	</div>
{/if}

<style lang="sass">

</style>
