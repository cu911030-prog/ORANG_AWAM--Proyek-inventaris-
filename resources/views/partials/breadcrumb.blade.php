@if(isset($breadcrumbs) && count($breadcrumbs))
<nav class="bg-white border-b border-slate-100" aria-label="Breadcrumb">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ol class="flex items-center space-x-4 py-3 text-sm text-slate-500">
            @foreach($breadcrumbs as $crumb)
                <li class="inline-flex items-center">
                    @if(!$loop->last)
                        <a href="{{ $crumb['url'] }}" class="hover:text-slate-700">{{ $crumb['label'] }}</a>
                        <svg class="w-4 h-4 mx-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    @else
                        <span class="text-slate-700">{{ $crumb['label'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
</nav>
@endif
