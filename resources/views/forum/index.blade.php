@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center mb-8">ฟอรัม</h1>

        @auth
            <div class="mb-6 text-center">
                <a href="{{ route('forum.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    สร้างโพสต์ใหม่
                </a>
            </div>
        @endauth

        <div id="post-container" class="post-list bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="border-t border-gray-200">
                <dl>
                    @foreach ($posts as $post)
                        <div class="post bg-gray-50 rounded-lg p-4 mb-4">
                            <div class="post-title">{{ $post->title }}</div>
                            <div class="post-content text-sm text-gray-900 mb-4">
                                {{ Str::limit($post->content, 200) }}
                            </div>
                            <div class="post-actions flex justify-between items-center">
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

        <!-- Loading Status -->
        <div id="loading" class="text-center mt-4 hidden">
            <p>กำลังโหลด...</p>
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
            let likeCount = parseInt(button.data('like-count'));

            $.ajax({
                url: '/like-post/' + postId,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    showNotification(response.message);
                    button.toggleClass('liked'); // สลับคลาสเมื่อไลค์

                    // อัปเดตจำนวนไลค์
                    likeCount = button.hasClass('liked') ? likeCount + 1 : likeCount - 1; // อัปเดตค่าในตัวแปร
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

        function sharePost(link) {
            $('#shareLink').val(link);
            $('#shareModal').removeClass('hidden');
        }

        function closeShareModal() {
            $('#shareModal').addClass('hidden');
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
                            // ซ่อนปุ่มโหลดเพิ่มเติมและแสดงปุ่มรีเฟรชเมื่อไม่มีโพสต์
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

        });
    </script>
@endsection
