@foreach ($posts as $post)
    <div class="post bg-gray-50 rounded-lg">
        <div class="post-title">{{ $post->title }}</div>
        <div class="post-content text-sm text-gray-900">
            {{ Str::limit($post->content, 200) }}
        </div>
        <div class="post-actions">
            <button onclick="likePost({{ $post->id }})">ไลค์</button>
            <a href="{{ route('forum.show', $post->id) }}" class="text-blue-500">คอมเมนต์</a>
            <button onclick="sharePost('{{ route('forum.show', $post->id) }}')">แชร์</button>
        </div>
    </div>
@endforeach
