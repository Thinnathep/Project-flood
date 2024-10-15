<div id="post-container" class="post-list bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="border-t border-gray-200">
        <dl>
            @foreach ($posts as $post)
                <div class="post bg-gray-50 rounded-lg p-4 mb-4 relative" data-id="{{ $post->id }}">
                    <!-- Post Title -->
                    <div class="post-title font-bold text-lg">{{ $post->title }}</div>

                    <!-- Post Image -->
                    @if ($post->image)
                        <div class="post-image mb-4">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="rounded-lg"
                                onerror="this.onerror=null; this.src='default-image-path.png';">
                        </div>
                    @endif

                    <!-- Post Content -->
                    <div class="post-content text-sm text-gray-900 mb-4">
                        {{ Str::limit($post->content, 200) }}
                    </div>

                    <!-- Latest Comments -->
                    <div class="post-comments text-sm text-gray-700 mb-4">
                        @if ($post->comments->count())
                            <h4 class="font-bold">คอมเมนต์ล่าสุด:</h4>
                            @foreach ($post->comments->take(2) as $comment)
                                <div class="comment-item">{{ Str::limit($comment->content, 50) }}
                                    - <i>{{ $comment->user->name }}</i>
                                </div>
                            @endforeach
                        @else
                            <div>ยังไม่มีคอมเมนต์</div>
                        @endif
                    </div>

                    <!-- More Options -->
                    <div class="absolute top-2 right-2">
                        <button class="flex items-center p-2 hover:bg-gray-200 rounded" onclick="toggleDropdown(event)">
                            <i class="fa fa-ellipsis-v text-xl"></i>
                        </button>
                        <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded">
                            <ul class="py-1">
                                <li>
                                    <a href="{{ route('forum.edit', $post->id) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">แก้ไข</a>
                                </li>
                                <li>
                                    <a href="#" onclick="deletePost({{ $post->id }})"
                                        class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">ลบโพสต์นี้</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Like, Comment, Share Actions -->
                    <div class="post-actions flex justify-between items-center mt-4">
                        <button onclick="likePost({{ $post->id }})"
                            class="like-button flex items-center space-x-2 {{ $post->likes->contains('user_id', auth()->id()) ? 'liked' : '' }}"
                            data-like-count="{{ $post->likes->count() }}">
                            <i class="fa fa-thumbs-up"></i>
                            <span class="like-count">{{ $post->likes->count() }} ไลค์</span>
                        </button>

                        <a href="{{ route('forum.show', $post->id) }}"
                            class="flex items-center space-x-2 text-blue-500">
                            <i class="fa fa-comment"></i>
                            <span>คอมเมนต์</span>
                        </a>

                        <button onclick="sharePost('{{ route('forum.show', $post->id) }}')"
                            class="flex items-center space-x-2">
                            <i class="fa fa-share"></i>
                            <span>แชร์</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </dl>
    </div>
</div>
