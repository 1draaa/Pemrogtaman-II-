@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <h3 class="text-xl font-black text-slate-900 font-headline">{{ $title }}</h3>
    <p class="text-slate-700 font-medium mt-1">{{ $description }}</p>
</div>
