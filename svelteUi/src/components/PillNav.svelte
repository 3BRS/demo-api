<script lang="ts">
	export let tabs: { id: string; label: string; target: string; active?: boolean }[] = [];
</script>

<div class="mb-3 border rounded">
	<ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
		{#each tabs as { id, label, target, active }}
			<li class="nav-item" role="presentation">
				<button
					class="nav-link {active ? 'active' : ''}"
					{id}
					data-bs-toggle="pill"
					data-bs-target={target}
					type="button"
					role="tab"
					aria-controls={id}
					aria-selected={active ? 'true' : 'false'}
				>
					{label}
				</button>
			</li>
		{/each}
	</ul>
</div>

<style lang="sass">
    button
        color: #222831
    .nav
        .active
             background-color: #00ADB5
</style>
