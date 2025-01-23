<script lang="ts">
	export let title: string;
	export let address = undefined as undefined | CustomerAddressType;
	export let id: string;
</script>

{#if title}
	{#if address}
		<div class="tab-pane fade" {id} role="tabpanel" aria-labelledby={`${id}-tab`} tabindex="0">
			<div class="row mt-5" role="tabpanel">
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
		</div>
	{:else}
		<div
			class="mt-5 justify-content-center align-items-center text-center tab-pane fade"
			id={`${id}-none`}
			role="tabpanel"
			aria-labelledby={`${id}-tab`}
			tabindex="0"
		>
			<i class="bi bi-house-x-fill display-1" />
			<p class="mt-3 fs-4 text-secondary">No Address Found</p>
		</div>
	{/if}
{/if}

<style lang="sass">

</style>
