<div>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="border-t border-gray-200">
            <dl>
                @foreach ($posts as $post)
                    <a href="{{ route('forum.show', $post->id) }}" class="block">
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">{{ $post->title }}</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ Str::limit($post->content, 100) }}
                            </dd>
                        </div>
                    </a>
                @endforeach
            </dl>
        </div>
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
