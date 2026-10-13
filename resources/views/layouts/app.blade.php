<x-layouts::app.sidebar :title="$title ?? null">
    <main class="w-full">
        {{ $slot }}
    </main>
</x-layouts::app.sidebar>
