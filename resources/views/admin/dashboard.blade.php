<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 min-h-screen p-4">
            <h2 class="text-white text-lg font-semibold mb-6">Admin Dashboard</h2>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-4 py-2 rounded">Dashboard</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('users.index') }}"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-4 py-2 rounded">Manage
                        Users</a>
                </li>
                <!-- ปุ่มกลับหน้า Home -->
                <li class="mb-2">
                    <a href="{{ route('home') }}"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-4 py-2 rounded">Home</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Welcome to the Admin Dashboard</h1>

            <!-- Success Notification -->
            @if (session('success'))
                <div id="success-alert" class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Manage Users Section -->
            <div class="mt-6">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Manage Users</h2>
                <button onclick="openModal('createModal')"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add New User</button>

                <!-- Table for displaying users -->
                <table class="min-w-full mt-4 bg-white border border-gray-200 rounded-lg shadow">
                    <thead>
                        <tr>
                            <th class="py-3 px-4 border-b bg-gray-200 text-left text-gray-600">
                                Name
                            </th>
                            <th class="py-3 px-4 border-b bg-gray-200 text-left text-gray-600">
                                Email
                            </th>
                            <th class="py-3 px-4 border-b bg-gray-200 text-left text-gray-600">
                                Verified
                            </th>
                            <th class="py-3 px-4 border-b bg-gray-200 text-left text-gray-600">
                                Role
                            </th>
                            <th class="py-3 px-4 border-b bg-gray-200 text-left text-gray-600">
                                Created At
                            </th>
                            <th class="py-3 px-4 border-b bg-gray-200 text-left text-gray-600">
                                Updated At
                            </th>
                            <th class="py-3 px-4 border-b bg-gray-200 text-left text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                                <td class="py-2 px-4 border-b">
                                    {{ $user->email_verified_at ? 'Yes' : 'No' }}
                                </td>
                                <td class="py-2 px-4 border-b">{{ ucfirst($user->role) }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->updated_at->format('Y-m-d H:i') }}</td>
                                <td class="py-2 px-4 border-b flex space-x-2">
                                    <button onclick="openModal('editModal', {{ $user }})"
                                        class="text-blue-500 hover:text-blue-600">Edit</button>
                                    <button onclick="confirmDelete({{ $user->id }})"
                                        class="text-red-500 hover:text-red-600">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <!-- Create User Modal -->
            <div id="createModal"
                class="hidden fixed z-10 inset-0 overflow-y-auto flex items-center justify-center bg-gray-800 bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-lg font-bold mb-4">Add New User</h2>
                    <form id="createUserForm">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="createName" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="createEmail" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="createPassword" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        {{-- <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                                Password</label>
                            <input type="password" name="password_confirmation" id="createPasswordConfirmation" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                        </div> --}}

                        <!-- Role Field (Dropdown) -->
                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" id="createRole" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="superadmin">Super Admin</option>
                            </select>
                        </div>


                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal('createModal')"
                                class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                            <button type="button" onclick="createUser()"
                                class="px-4 py-2 bg-blue-500 text-white rounded">Create</button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Edit User Modal -->
            <div id="editModal"
                class="hidden fixed z-10 inset-0 overflow-y-auto flex items-center justify-center bg-gray-800 bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-lg font-bold mb-4">Edit User</h2>
                    <form id="editUserForm">
                        @csrf
                        @method('PUT')

                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="editName" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="editName" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="editEmail" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>

                        <!-- Role Field (Dropdown) -->
                        <div class="mb-4">
                            <label for="editRole" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" id="editRole" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="superadmin">Super Admin</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal('editModal')"
                                class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                            <button type="button" onclick="updateUser()"
                                class="px-4 py-2 bg-blue-500 text-white rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

    <script>
        // Functions for handling modals
        function openModal(modalId, user = null) {
            const modal = document.getElementById(modalId);
            console.log(modal); // ตรวจสอบว่า modal ถูกพบหรือไม่
            if (modal) {
                modal.classList.remove('hidden');
                if (user) {
                    document.getElementById('editName').value = user.name;
                    document.getElementById('editEmail').value = user.email;
                    document.getElementById('editUserForm').action = `/users/${user.id}`;
                }
            } else {
                console.error(`Modal with id ${modalId} not found`); // แสดงข้อผิดพลาดใน console
            }
        }


        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden'); // แสดงว่า modal มีอยู่ใน DOM
            } else {
                console.error(`Modal with id ${modalId} not found`);
            }
        }


        function createUser() {
            const name = document.getElementById('createName').value;
            const email = document.getElementById('createEmail').value;
            const password = document.getElementById('createPassword').value;
            const role = document.getElementById('createRole').value; // เพิ่ม role

            // Confirm with Swal
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to add this user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, add it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{ route('users.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                name: name,
                                email: email,
                                password: password,
                                role: role, // ส่ง role ไปด้วย
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Success!', 'User added successfully.', 'success').then(() => {
                                    window.location.reload();
                                });
                            } else {
                                let errorMessage = data.message || 'There was an error adding the user.';
                                Swal.fire('Error!', errorMessage, 'error');
                            }
                        })
                        .catch((error) => {
                            Swal.fire('Error!', 'There was a problem with the request.', 'error');
                        });
                }
            });
        }

        function updateUser() {
            const userId = document.getElementById('editUserForm').action.split('/').pop();
            const name = document.getElementById('editName').value;
            const email = document.getElementById('editEmail').value;
            const role = document.getElementById('editRole').value; // เพิ่ม role

            // Confirm with Swal
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to update this user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/users/${userId}`, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                name: name,
                                email: email,
                                role: role, // ส่ง role ไปด้วย
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Success!', 'User updated successfully.', 'success').then(() => {
                                    window.location.reload();
                                });
                            } else {
                                let errorMessage = data.message || 'There was an error updating the user.';
                                Swal.fire('Error!', errorMessage, 'error');
                            }
                        })
                        .catch((error) => {
                            Swal.fire('Error!', 'There was a problem with the request.', 'error');
                        });
                }
            });
        }


        function confirmDelete(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/users/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(() => {
                        Swal.fire(
                            'Deleted!',
                            'User has been deleted.',
                            'success'
                        ).then(() => {
                            window.location.reload();
                        });
                    });
                }
            });
        }
    </script>

</body>

</html>
