@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center mb-8">ฟอรัม</h1>

        @auth
            <div class="mb-6 text-center">
                <button id="openCreatePostModal"
                    class="bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white px-4 py-2 rounded-full hover:scale-105 hover:shadow-lg transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300 dark:focus:ring-white flex items-center space-x-2"
                    aria-label="Create new post">
                    <span class="text-lg">✍️</span> <!-- อิโมจิที่ใช้แทนไอคอนการโพสต์ -->
                    <span>สร้างโพสต์ใหม่</span>
                </button>
            </div>
        @endauth


        <div id="post-container" class="post-list bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="border-t border-gray-200">
                <dl>
                    @foreach ($posts as $post)
                        <div class="post bg-gray-50 rounded-lg p-4 mb-4 relative">
                            <!-- ส่วนของหัวข้อโพสต์ -->
                            <div class="post-title font-bold text-lg">{{ $post->title }}</div>

                            <!-- ส่วนของรูปภาพโพสต์ -->
                            @if ($post->image)
                                <div class="post-image mb-4">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="rounded-lg"
                                        onerror="this.onerror=null; this.src='default-image-path.png';">
                                </div>
                            @endif

                            <!-- ส่วนของเนื้อหาโพสต์ -->
                            <div class="post-content text-sm text-gray-900 mb-4">
                                {{ Str::limit($post->content, 200) }}
                            </div>

                            <!-- ส่วนของคอมเมนต์ล่าสุด -->
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

                            <!-- ปุ่มเพิ่มเติม 3 จุด -->
                            <!-- ปุ่มเพิ่มเติม 3 จุด -->
                            <div class="absolute top-2 right-2">
                                <button class="flex items-center p-2 hover:bg-gray-200 rounded"
                                    onclick="toggleDropdown(event)">
                                    <i class="fa fa-ellipsis-v text-xl"></i> <!-- เพิ่มขนาดของไอคอน -->
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


                            <!-- ส่วนของปุ่มไลค์ คอมเมนต์ แชร์ -->
                            <div class="post-actions flex justify-between items-center mt-4">
                                <!-- ปุ่มไลค์ -->
                                <button onclick="likePost({{ $post->id }})"
                                    class="like-button flex items-center space-x-2 {{ $post->likes->contains('user_id', auth()->id()) ? 'liked' : '' }}"
                                    data-like-count="{{ $post->likes->count() }}">
                                    <i class="fa fa-thumbs-up"></i>
                                    <span class="like-count">{{ $post->likes->count() }} ไลค์</span>
                                </button>

                                <!-- ปุ่มคอมเมนต์ -->
                                <a href="{{ route('forum.show', $post->id) }}"
                                    class="flex items-center space-x-2 text-blue-500">
                                    <i class="fa fa-comment"></i>
                                    <span>คอมเมนต์</span>
                                </a>

                                <!-- ปุ่มแชร์ -->
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


        <!-- Loading Status -->
        {{-- <div id="loading" class="text-center mt-4 hidden">
            <p>กำลังโหลด...</p>
        </div> --}}

        <div id="loading" class="hidden text-center py-4">Loading more posts...</div>
        <button id="refreshButton" class="hidden" onclick="location.reload();">Refresh</button>


    </div>

    <!-- Modal for Creating Post -->
    <div id="createPostModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 shadow-lg">
            <h3 class="text-lg font-medium text-gray-900 mb-4">สร้างโพสต์ใหม่</h3>
            <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">หัวข้อ</label>
                    <input type="text" name="title" id="title"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required>
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">เนื้อหา</label>
                    <textarea name="content" id="content" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required></textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">อัปโหลดรูปภาพ</label>
                    <input type="file" name="image" id="image"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">สร้างโพสต์</button>
                <button type="button" onclick="closeCreatePostModal()"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">ปิด</button>
            </form>
        </div>
    </div>



    <!-- Modal for Sharing Link -->
    <div id="shareModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 shadow-lg">
            <h3 class="text-lg font-medium text-gray-900 mb-4">แชร์ลิงก์</h3>
            <input type="text" id="shareLink" readonly class="w-full mb-4 px-3 py-2 border rounded" />
            <button onclick="closeShareModal()"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">ปิด</button>
        </div>
    </div>

    <div id="notification" class="hidden fixed top-0 right-0 mt-4 mr-4 p-4 bg-blue-500 text-white rounded-lg shadow-lg">
        <span id="notificationMessage"></span>
    </div>

    <!-- ปุ่มรีเฟรช -->
    <div id="refreshButton" class="text-center mt-4 hidden">
        <button onclick="location.reload();" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            รีเฟรช
        </button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showNotification(message) {
            $('#notificationMessage').text(message);
            $('#notification').removeClass('hidden').fadeIn().delay(5000).fadeOut();
        }

        function likePost(postId) {
            const button = $(`button[onclick="likePost(${postId})"]`);
            const likeCountSpan = button.find('.like-count');

            $.ajax({
                url: '/like-post/' + postId,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    showNotification(response.message);
                    button.toggleClass('liked'); // สลับคลาสเมื่อไลค์

                    // อัปเดตจำนวนไลค์จากการตอบสนอง
                    const likeCount = response.likeCount; // ใช้ค่า likeCount ที่ได้รับจากเซิร์ฟเวอร์
                    likeCountSpan.text(`${likeCount} ไลค์`);
                    button.data('like-count', likeCount); // อัปเดตค่าใน data attribute

                    // อัปเดตสีปุ่ม
                    if (button.hasClass('liked')) {
                        button.css({
                            backgroundColor: '#f44242',
                            color: 'white'
                        });
                    } else {
                        button.css({
                            backgroundColor: '',
                            color: ''
                        });
                    }
                },
                error: function(xhr) {
                    showNotification(xhr.responseJSON.message || 'เกิดข้อผิดพลาดในการไลค์โพสต์');
                }
            });
        }


        function deletePost(postId) {
            if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบโพสต์นี้?')) {
                $.ajax({
                    url: '/forum/posts/' + postId, // URL สำหรับลบโพสต์
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        showNotification(response.message);
                        // อัปเดต UI หรือโหลดโพสต์ใหม่หลังจากลบ
                        location.reload(); // ตัวอย่างการโหลดหน้าใหม่
                    },
                    error: function(xhr) {
                        showNotification(xhr.responseJSON.message || 'เกิดข้อผิดพลาดในการลบโพสต์');
                    }
                });
            }
        }


        function sharePost(link) {
            $('#shareLink').val(link);
            $('#shareModal').removeClass('hidden');
        }

        function closeShareModal() {
            $('#shareModal').addClass('hidden');
        }

        function openCreatePostModal() {
            $('#createPostModal').removeClass('hidden');
        }

        function closeCreatePostModal() {
            $('#createPostModal').addClass('hidden');
        }

        $(document).ready(function() {
            let page = 1;
            let loading = false;

            function loadMorePosts() {
                if (loading) return;
                loading = true;
                $('#loading').removeClass('hidden');

                $.ajax({
                    url: '{{ route('forum.index') }}',
                    type: 'GET',
                    data: {
                        page: ++page
                    },
                    success: function(response) {
                        if (response.html.trim() === "") {
                            $('#loading').addClass('hidden');
                            $('#refreshButton').removeClass('hidden');
                        } else {
                            $('#post-container').append(response.html);
                            $('#loading').addClass('hidden');
                            loading = false;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        $('#loading').addClass('hidden');
                        loading = false;
                    }
                });
            }

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
                    loadMorePosts();
                }
            });

            $('#openCreatePostModal').click(openCreatePostModal);
        });

        function toggleDropdown(event) {
            const dropdownMenu = $(event.currentTarget).siblings('.dropdown-menu');
            dropdownMenu.toggleClass('hidden');
        }
    </script>
@endsection


{{-- <style>

</style> --}}
