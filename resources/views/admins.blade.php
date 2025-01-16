<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="text-white font-bold text-xl">Admin Panel</span>
                    </div>
                    <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Tautan untuk Dashboard Admin -->
                        <a href="/admins" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">Data Admin</a>

                        <!-- Tautan untuk Data Pengguna -->
                        <a href="/datauser" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Data User</a>
                    </div>

                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <button onclick="logout()" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold text-gray-900" id="pageTitle">Data Admin</h2>
                        <button onclick="openAddModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Admin
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="adminTableBody" class="bg-white divide-y divide-gray-200">
                                <!-- Data will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add/Edit Modal -->
    <div id="adminModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 id="modalTitle" class="text-lg leading-6 font-medium text-gray-900 mb-4"></h3>
                        <form id="adminForm" class="space-y-4">
                            <input type="hidden" id="adminId">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" name="username" id="username" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" id="password" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="saveAdmin()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Save
                    </button>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fetch and display admin data
        function loadAdmins() {
            document.getElementById('pageTitle').innerText = "Data Admin";
            axios.get('http://127.0.0.1:8000/api/admins')
                .then(response => {
                    let tableBody = '';
                    response.data.forEach(admin => {
                        tableBody += `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${admin.id}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${admin.email}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${admin.username}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formatDate(admin.created_at)}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formatDate(admin.updated_at)}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="editAdmin(${admin.id})" class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 px-3 py-1 rounded-md mr-2">Edit</button>
                                    <button onclick="deleteAdmin(${admin.id})" class="text-red-600 hover:text-red-900 bg-red-100 px-3 py-1 rounded-md">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#adminTableBody').html(tableBody);
                })
                .catch(error => {
                    console.error("Error fetching admins:", error);
                });
        }

        // Format date
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', { 
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Open modal for adding new admin
        function openAddModal() {
            $('#modalTitle').text('Tambah Admin');
            $('#adminId').val('');
            $('#adminForm')[0].reset();
            $('#adminModal').removeClass('hidden');
        }

        // Open modal for editing admin
        function editAdmin(id) {
            axios.get(`http://127.0.0.1:8000/api/admins/${id}`)
                .then(response => {
                    const admin = response.data;
                    $('#modalTitle').text('Edit Admin');
                    $('#adminId').val(admin.id);
                    $('#email').val(admin.email);
                    $('#username').val(admin.username);
                    $('#password').val('');
                    $('#adminModal').removeClass('hidden');
                })
                .catch(error => {
                    console.error('Error fetching admin:', error);
                });
        }

        // Close modal
        function closeModal() {
            $('#adminModal').addClass('hidden');
        }

        // Save admin (create or update)
        function saveAdmin() {
            const id = $('#adminId').val();
            const data = {
                email: $('#email').val(),
                username: $('#username').val(),
                password: $('#password').val()
            };

            const url = id ? `http://127.0.0.1:8000/api/admins/${id}` : 'http://127.0.0.1:8000/api/admins';
            const method = id ? 'PUT' : 'POST';

            axios({
                method: method,
                url: url,
                data: data
            })
            .then(response => {
                closeModal();
                loadAdmins();
                alert(response.data.message);
            })
            .catch(error => {
                console.error('Error saving admin:', error);
            });
        }

        // Delete admin
        function deleteAdmin(id) {
            if (confirm('Are you sure you want to delete this admin?')) {
                axios.delete(`http://127.0.0.1:8000/api/admins/${id}`)
                    .then(response => {
                        loadAdmins();
                        alert(response.data.message);
                    })
                    .catch(error => {
                        console.error('Error deleting admin:', error);
                    });
            }
        }

        // Logout
        function logout() {
            window.location.href = '/'; // Ganti dengan URL logout
        }

        // Initial load of admin data
        loadAdmins();
    </script>
</body>
</html>
