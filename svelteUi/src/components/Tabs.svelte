<script lang="ts">
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();

	export let tabNames: String[];
	export let activeTab: String;
</script>

<div class="mb-3 border">
	<ul class="nav nav-pills nav-fill">
		{#each tabNames as tab}
			<li class="nav-item">
				<button class="nav-link" class:active={tab === activeTab} on:click={() => dispatch('tabChange', tab)}>
					{tab}
				</button>
			</li>
		{/each}
	</ul>
</div>

<style lang="sass">
    $activeButton: #00ADB5
    $inactiveText: #393E46
    .nav-link
        color: $inactiveText
    .nav-link.active
        background-color: $activeButton

</style>
