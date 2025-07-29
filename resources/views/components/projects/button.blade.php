<button {{ $attributes->merge(['class' => 'px-3 py-2 rounded']) }} type="button" >
  {{ $slot }}
</button>

{{-- 
<button type="button" class="border border-gray-300 px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-zinc-700"
  wire:click="closeModal">
  Cancel
</button>
<button class="border border-green-400 px-3 py-2 rounded bg-green-500 text-white hover:bg-green-600">
  Save
</button> --}}