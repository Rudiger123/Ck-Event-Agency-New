<div class="bg-white min-h-screen pt-20">
    <div class="container mx-auto px-6 py-12 max-w-4xl">
        <h1 class="text-3xl md:text-4xl font-serif font-bold text-brand-black mb-8">
            {{ $page->title }}
        </h1>
        
        <div class="prose prose-lg max-w-none text-gray-600">
            {!! $page->content !!}
        </div>
    </div>
</div>