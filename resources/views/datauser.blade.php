<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                        <a href="admins" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Data Admin</a>

                        <!-- Tautan untuk Data Pengguna -->
                        <a href="/datauser" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">Data User</a>
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
                        <h2 class="text-2xl font-bold text-gray-900">Data User</h2>
                        <button onclick="openAddModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah User
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kota</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usia</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tinggi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hasil</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody" class="bg-white divide-y divide-gray-200">
                                <!-- Data will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add/Edit Modal -->
    <div id="userModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                    <h3 id="modalTitle" class="text-lg leading-6 font-medium text-gray-900 mb-4"></h3>
                    <form id="userForm" class="space-y-4">
                        <input type="hidden" id="userId">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" id="nama" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="kota" class="block text-sm font-medium text-gray-700">Kota</label>
                            <input type="text" name="kota" id="kota" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="usia" class="block text-sm font-medium text-gray-700">Usia</label>
                                <input type="number" name="usia" id="usia" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="tinggi" class="block text-sm font-medium text-gray-700">Tinggi (cm)</label>
                                <input type="number" name="tinggi" id="tinggi" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="berat" class="block text-sm font-medium text-gray-700">Berat (kg)</label>
                                <input type="number" name="berat" id="berat" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="hasil" class="block text-sm font-medium text-gray-700">Hasil (BMI)</label>
                                <input type="text" name="hasil" id="hasil" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-100" readonly> 
                            </div>
                        </div>
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori Berat Badan</label>
                            <input type="text" name="kategori" id="kategori" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-100" readonly> 
                        </div>
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="saveUser()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Save
                </button>
                <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="saveUser()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
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
            // Fungsi untuk menghitung dan menampilkan Hasil (BMI) dan Kategori
    function updateHasilDanKategori() {
        const berat = parseFloat($('#berat').val());
        const tinggiCm = parseFloat($('#tinggi').val());
        let hasilBMI = '';
        let kategori = '';

        // Hitung BMI jika berat dan tinggi valid
        if (!isNaN(berat) && !isNaN(tinggiCm) && tinggiCm > 0 && berat > 0) {
            const tinggiM = tinggiCm / 100; // Ubah tinggi dari cm ke meter
            hasilBMI = (berat / (tinggiM * tinggiM)).toFixed(2); // BMI = berat (kg) / (tinggi (m))^2, dibulatkan 2 desimal
        }
        $('#hasil').val(hasilBMI); // Update field hasil

        // Tentukan kategori berdasarkan berat
        if (!isNaN(berat) && berat > 0) {
            if (berat < 45) {
                kategori = 'Kurus';
            } else if (berat > 80) {
                kategori = 'Gemuk';
            } else { // Antara 45 kg dan 80 kg (inklusif)
                kategori = 'Ideal';
            }
        }
        $('#kategori').val(kategori); // Update field kategori
    }


        // Fetch and display user data
    function loadUsers() {
        // ... (fungsi loadUsers Anda tetap sama) ...
        $.get('http://127.0.0.1:8000/api/users', function(data) {
            let tableBody = $('#userTableBody');
            tableBody.empty();
            data.forEach(user => {
                tableBody.append(`
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${user.id}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${user.nama}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${user.kota}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${user.usia}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${user.tinggi}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${user.berat}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${user.hasil || '-'}</td> 
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${user.kategori || '-'}</td> 
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${user.tanggal}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <button onclick="openEditModal(${user.id})" class="text-blue-600 hover:text-blue-800">Edit</button>
                            <button onclick="deleteUser(${user.id})" class="text-red-600 hover:text-red-800 ml-4">Delete</button>
                        </td>
                    </tr>
                `);
            });
        });
    }

        // Open Add User Modal
        function openAddModal() {
            $('#userId').val('');
            $('#modalTitle').text('Tambah User');
            $('#userModal').show();
        }

        // Open Edit User Modal
        function openEditModal(userId) {
            $.get(`http://127.0.0.1:8000/api/users/${userId}`, function(user) {
                $('#userId').val(user.id);
                $('#nama').val(user.nama);
                $('#kota').val(user.kota);
                $('#usia').val(user.usia);
                $('#tinggi').val(user.tinggi);
                $('#berat').val(user.berat);
                $('#hasil').val(user.hasil);
                $('#kategori').val(user.kategori);
                $('#tanggal').val(user.tanggal);
                $('#modalTitle').text('Edit User');
                $('#userModal').show();
            });
        }

        // Save User (Add or Edit)
        function saveUser() {
        // Panggil updateHasilDanKategori sekali lagi untuk memastikan nilai terbaru sebelum submit
        // Meskipun event listener sudah ada, ini untuk jaga-jaga jika ada perubahan non-event
        updateHasilDanKategori(); 

        let userId = $('#userId').val();
        let userData = {
            nama: $('#nama').val(),
            kota: $('#kota').val(),
            usia: $('#usia').val(),
            tinggi: $('#tinggi').val(),
            berat: $('#berat').val(),
            hasil: $('#hasil').val(),       // Akan mengambil nilai yang sudah dihitung
            kategori: $('#kategori').val(), // Akan mengambil nilai yang sudah dihitung
            tanggal: $('#tanggal').val()
        };

        let ajaxUrl = 'http://127.0.0.1:8000/api/users';
        let ajaxMethod = 'POST';

        if (userId) { // Jika ada userId, berarti ini mode Edit
            ajaxUrl += `/${userId}`;
            ajaxMethod = 'PUT';
        }

        $.ajax({
            url: ajaxUrl,
            method: ajaxMethod,
            contentType: 'application/json', // Kirim sebagai JSON
            data: JSON.stringify(userData),  // Ubah data menjadi string JSON
            success: function() {
                loadUsers();
                closeModal();
            },
            error: function(xhr, status, error) {
                // Tambahkan penanganan error jika perlu
                console.error("Error saving user:", status, error);
                alert("Gagal menyimpan data: " + (xhr.responseJSON ? JSON.stringify(xhr.responseJSON.errors || xhr.responseJSON.message) : error));
            }
        });
    }


    function deleteUser(userId) {
        // ... (fungsi deleteUser Anda tetap sama) ...
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: `http://127.0.0.1:8000/api/users/${userId}`,
                method: 'DELETE',
                success: function() {
                    loadUsers();
                },
                error: function(xhr, status, error) {
                    console.error("Error deleting user:", status, error);
                    alert("Gagal menghapus data: " + error);
                }
            });
        }
    }


    function closeModal() {
        $('#userForm')[0].reset(); // Reset form saat modal ditutup
        updateHasilDanKategori();  // Kosongkan field hasil & kategori juga
        $('#userModal').addClass('hidden');
        $('#userModal').removeClass('flex'); // Jika Anda menggunakan flex
        // Atau cara jQuery standar: $('#userModal').hide();
    }

    function logout() {
        // Implementasi logout Anda
        window.location.href = '/'; // Ganti dengan URL logout yang sesuai
    }


        // Initial load of users
        $(document).ready(function() {
            loadUsers();
        });
    </script>
</body>
</html>
