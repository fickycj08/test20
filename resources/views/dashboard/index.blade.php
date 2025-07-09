<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Akastra - Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  
   <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
      background: #94a3b8;
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #64748b;
    }
    /* Table Row Hover Effect */
    tbody tr {
      transition: transform 0.15s ease;
    }
    tbody tr:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      z-index: 10;
      position: relative;
    }
    /* Button Transitions */
    button,
    a.bg-blue-500,
    a.bg-green-500 {
      transition: all 0.2s ease;
    }
    button:hover,
    a.bg-blue-500:hover,
    a.bg-green-500:hover {
      transform: translateY(-2px);
    }
    /* Animation */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }
    .loading-animation {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 100;
    }
    .spinner {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #dc2626;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    /* Modal Animation */
    #detailModal {
      transition: opacity 0.3s ease;
    }
    #detailModal:not(.hidden) {
      animation: fadeIn 0.3s ease-out forwards;
    }

    /* PERBAIKAN CSS UNTUK SCROLLABLE TABLE */
    .scrollable-table {
      max-height: 400px;
      overflow-y: auto;
      display: block;
      scrollbar-width: thin;
      transition: all 0.3s ease;
    }

    .scrollable-table table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
    }

    .scrollable-table thead tr th {
      position: sticky;
      top: 0;
      background-color: #f8fafc;
      z-index: 20;
      padding-top: 12px;
      padding-bottom: 12px;
      box-shadow: 0 2px 0 0 #e2e8f0;
    }

    .scrollable-table tbody tr {
      position: relative;
      z-index: 1;
      transition: all 0.2s ease;
    }

    .scrollable-table tbody tr:hover {
      z-index: 15;
      transform: translateY(-2px);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    /* Style untuk tabel full view */
    .full-view-table {
      max-height: none !important;
      overflow-y: visible !important;
      display: block;
    }

    /* Style untuk tombol aktif */
    #lihatSemuaBtn.active {
      font-weight: bold;
      text-decoration: underline;
      color: #dc2626;
    }

    @media (max-width: 768px) {
      .scrollable-table {
        max-height: 300px;
      }
      .scrollable-table thead tr th {
        padding-top: 8px;
        padding-bottom: 8px;
      }
    }
  </style>

</head>
<body class="bg-slate-100">
  <!-- Loading Animation -->
  <div class="loading-animation">
    <div class="spinner"></div>
  </div>

  <div class="flex">
    <!-- Tombol Hamburger untuk Mobile -->
    <button id="toggleSidebar" class="md:hidden fixed top-4 left-4 z-[61] p-2 bg-red-600 text-white rounded-lg">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 w-64 h-screen bg-red-600 p-4 flex-col z-[60] -translate-x-full md:translate-x-0 transition-transform duration-300">
        <!-- Logo -->
        <a href="#" class="flex justify-center items-center mb-4">
          <img src="build/assets/akastrawhitelogo.png" class="h-[175px] w-auto transition-transform hover:scale-105" alt="Logo Akastra" />
        </a>

        <!-- Menu -->
        <nav class="flex flex-col h-full">
            <div>
                <div class="px-4 py-2 mb-2">
                    <h3 class="text-xs font-semibold text-neutral-50 uppercase tracking-wider">Dashboard</h3>
                </div>
                <ul class="space-y-2 px-2">
                    <li>
                        <a href="#" class="group flex items-center p-3 bg-white rounded-xl shadow-sm">
                            <div class="flex items-center justify-center w-8 h-8 text-white bg-red-600 rounded-lg mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" /><path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" /></svg>
                            </div>
                            <span class="text-red-600 font-bold">Beranda</span>
                        </a>
                    </li>
                </ul>
                <div class="border-t border-red-500 my-4"></div>
                <div class="px-2 py-2 mb-1">
                    <h3 class="text-xs font-semibold text-neutral-50 uppercase tracking-wider">Menu</h3>
                </div>
                <ul class="space-y-2 px-2">
                    <li>
                        <a href="{{ route('jadwalservis.index') }}" class="group flex items-center p-3 rounded-xl hover:bg-red-700 transition-colors duration-300">
                            <div class="flex items-center justify-center w-8 h-8 text-white rounded-lg mr-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" /><path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" /></svg></div>
                            <span class="text-white font-bold">Jadwal Servis</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="group flex items-center p-3 rounded-xl hover:bg-red-700 transition-colors duration-300">
                            <div class="flex items-center justify-center w-8 h-8 text-white rounded-lg mr-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 18.375V5.625zM21 9.375A.375.375 0 0020.625 9h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zm0 3.75a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zm0 3.75a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zM10.875 18.75a.375.375 0 00.375-.375v-1.5a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5zM3.375 15h7.5a.375.375 0 00.375-.375v-1.5a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375zm0-3.75h7.5a.375.375 0 00.375-.375v-1.5A.375.375 0 0010.875 9h-7.5A.375.375 0 003 9.375v1.5c0 .207.168.375.375.375z" clip-rule="evenodd" /></svg></div>
                            <span class="text-white font-bold">Data Kendaraan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="group flex items-center p-3 rounded-xl hover:bg-red-700 transition-colors duration-300">
                            <div class="flex items-center justify-center w-8 h-8 text-white rounded-lg mr-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M12 6.75a5.25 5.25 0 016.775-5.025.75.75 0 01.313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 011.248.313 5.25 5.25 0 01-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 112.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0112 6.75zM4.117 19.125a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75h-.008a.75.75 0 01-.75-.75v-.008z" clip-rule="evenodd" /><path d="M10.076 8.64l-2.201-2.2V4.874a.75.75 0 00-.364-.643l-3.75-2.25a.75.75 0 00-.916.113l-.75.75a.75.75 0 00-.113.916l2.25 3.75a.75.75 0 00.643.364h1.564l2.062 2.062 1.575-1.297z" /><path fill-rule="evenodd" d="M12.556 17.329l4.183 4.182a3.375 3.375 0 004.773-4.773l-3.306-3.305a6.803 6.803 0 01-1.53.043c-.394-.034-.682-.006-.867.042a.589.589 0 00-.167.063l-3.086 3.748zm3.414-1.36a.75.75 0 011.06 0l1.875 1.876a.75.75 0 11-1.06 1.06L15.97 17.03a.75.75 0 010-1.06z" clip-rule="evenodd" /></svg></div>
                            <span class="text-white font-bold">Suku Cadang</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Tombol Logout -->
            <div class="mt-auto p-3">
                <a href="#" class="flex items-center justify-center p-3 bg-red-700 text-white rounded-xl shadow-md hover:bg-red-800 transition-all transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2"><path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm5.03 4.72a.75.75 0 010 1.06l-1.72 1.72h10.94a.75.75 0 010 1.5H10.81l1.72 1.72a.75.75 0 11-1.06 1.06l-3-3a.75.75 0 010-1.06l3-3a.75.75 0 011.06 0z" clip-rule="evenodd" /></svg>
                    <span class="font-bold">Logout</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-0 md:ml-64 p-4 md:p-8 transition-all duration-300 mt-16">
      
      <!-- Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 fade-in">
        <!-- Card 1: Servis Hari Ini -->
        <div class="bg-white rounded-xl shadow-md p-5">
          <div class="flex justify-between items-start">
            <h2 class="text-base text-gray-500 font-medium">Servis Hari Ini</h2>
            <div class="text-blue-500 bg-blue-100 p-2 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z" clip-rule="evenodd" /></svg>
            </div>
          </div>
          <p id="servis-hari-ini-count" class="text-3xl font-bold mt-2">0</p>
          <p class="text-sm text-gray-500 mt-1">Jadwal untuk hari ini</p>
        </div>

        <!-- Card 2: Menunggu Konfirmasi -->
        <div class="bg-white rounded-xl shadow-md p-5">
          <div class="flex justify-between items-start">
            <h2 class="text-base text-gray-500 font-medium">Menunggu Konfirmasi</h2>
            <div class="text-yellow-500 bg-yellow-100 p-2 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" /></svg>
            </div>
          </div>
          <p id="menunggu-konfirmasi-count" class="text-3xl font-bold mt-2">0</p>
          <p class="text-sm text-gray-500 mt-1">Dalam Pengerjaan</p>
        </div>

        <!-- Card 3: Total Kendaraan -->
        <div class="bg-white rounded-xl shadow-md p-5">
          <div class="flex justify-between items-start">
            <h2 class="text-base text-gray-500 font-medium">Total Kendaraan</h2>
            <div class="text-purple-500 bg-purple-100 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M8.25 18.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zM12 2.25a.75.75 0 01.75.75v9a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75z" />
                    <path fill-rule="evenodd" d="M3 6a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6zM12 12.75a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM3.75 12a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5z" clip-rule="evenodd" />
                </svg>
            </div>
          </div>
          <p id="total-kendaraan-count" class="text-3xl font-bold mt-2">0</p>
          <p class="text-sm text-gray-500 mt-1">Terdaftar di sistem</p>
        </div>

        <!-- Card 4: Servis Selesai -->
        <div class="bg-white rounded-xl shadow-md p-5">
          <div class="flex justify-between items-start">
            <h2 class="text-base text-gray-500 font-medium">Servis Selesai</h2>
            <div class="text-green-500 bg-green-100 p-2 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" /></svg>
            </div>
          </div>
          <p id="servis-selesai-count" class="text-3xl font-bold mt-2">0</p>
          <p class="text-sm text-gray-500 mt-1">Selesai</p>
        </div>
      </div>
      
     <div class="mt-8 grid grid-cols-1 gap-8">

     <!-- Modal Edit Status -->
<div id="editStatusModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[100] hidden">
  <div class="bg-white rounded-lg w-full max-w-md mx-4">
    <div class="p-6">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold text-gray-800">Ubah Status Order</h3>
        <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      
      <div class="space-y-4">
        <div>
          <h4 class="font-semibold text-gray-700 mb-2">Status Order</h4>
          <select id="statusDropdown" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
    <option value="Dalam Antrian">Dalam Antrian</option>
    <option value="Dalam Pengerjaan">Dalam Pengerjaan</option>
    <option value="Selesai">Selesai</option>
</select>
        </div>
      </div>
      
      <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end gap-2">
        <button onclick="closeEditModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-lg font-medium transition-colors">
          Batal
        </button>
        <button onclick="updateOrderStatus()" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
          Simpan Perubahan
        </button>
      </div>
    </div>
  </div>
</div>
  <!-- Order IN_PROGRESS -->
<div class="bg-white rounded-xl shadow-md p-5 fade-in">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Menunggu Konfirmasi</h2>
            <button id="lihatSemuaBtn" class="text-red-500 text-sm font-medium hover:underline focus:outline-none">
              Lihat Semua
            </button>
          </div>
          <div id="tableContainer" class="overflow-x-auto scrollable-table">
            <table class="min-w-full text-sm">
              <thead class="bg-gray-50 text-gray-600">
                <tr>
                  <th class="px-4 py-3 text-left">Pelanggan</th>
                  <th class="px-4 py-3 text-left">Kendaraan</th>
                  <th class="px-4 py-3 text-left">Jenis Servis</th>
                  <th class="px-4 py-3 text-left">Jadwal</th>
                  <th class="px-4 py-3 text-left">Status</th>
                  <th class="px-4 py-3">Aksi</th>
                </tr>
              </thead>
              <tbody id="konfirmasi-table-body" class="text-gray-700 divide-y divide-gray-200">
        <!-- Data akan diisi -->
      </tbody>
    </table>
  </div>
</div>

  <!-- Jadwal Hari Ini -->
   <div class="bg-white rounded-xl shadow-md p-5 fade-in" style="animation-delay: 0.4s;">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Jadwal Hari Ini</h2>
            <div id="tanggal-hari-ini" class="text-sm text-gray-500"></div>
          </div>
          <div id="jadwal-hari-ini-list" class="space-y-3">
            <p class="text-center text-gray-500">Memuat jadwal...</p>
          </div>
        </div>
      </div>
    </main>
  </div>

 <!-- Modal Detail Keluhan -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[100] hidden">
  <div class="bg-white rounded-lg w-full max-w-md mx-4">
    <div class="p-6">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold text-gray-800">Detail Keluhan</h3>
        <button onclick="closeDetailModal()" class="text-gray-500 hover:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      
      <div class="space-y-4">
        <div>
          <h4 class="font-semibold text-gray-700">Pelanggan</h4>
          <p id="detail-pelanggan" class="mt-1">-</p>
        </div>
        
        <div>
          <h4 class="font-semibold text-gray-700">Kendaraan</h4>
          <p id="detail-kendaraan" class="mt-1">-</p>
        </div>
        
        <div>
          <h4 class="font-semibold text-gray-700">Jenis Servis</h4>
          <p id="detail-jenis-servis" class="mt-1">-</p>
        </div>
        
        <div>
          <h4 class="font-semibold text-gray-700">Keluhan</h4>
          <p id="detail-keluhan" class="mt-1">-</p>
        </div>
        
        <div>
          <h4 class="font-semibold text-gray-700">Jadwal</h4>
          <p id="detail-jadwal" class="mt-1">-</p>
        </div>
      </div>
      
      <div class="mt-6 pt-4 border-t border-gray-200">
        <button id="contactCustomerBtn" class="w-full bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-lg font-medium transition-colors flex items-center justify-center shadow-md hover:shadow-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
          </svg>
          Hubungi Pelanggan via WhatsApp
        </button>
      </div>
    </div>
  </div>
</div>

  <!-- Modal Penolakan Pesanan -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[100] hidden">
  <div class="bg-white rounded-lg w-full max-w-md mx-4">
    <div class="p-6">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold text-gray-800">Tolak Pesanan</h3>
        <button onclick="closeRejectModal()" class="text-gray-500 hover:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      
      <div class="space-y-4">
        <div>
          <h4 class="font-semibold text-gray-700">Pelanggan</h4>
          <p id="reject-pelanggan" class="mt-1">-</p>
        </div>
        
        <div>
          <h4 class="font-semibold text-gray-700">Kendaraan</h4>
          <p id="reject-kendaraan" class="mt-1">-</p>
        </div>
        
        <div>
          <h4 class="font-semibold text-gray-700">Jenis Servis</h4>
          <p id="reject-jenis-servis" class="mt-1">-</p>
        </div>
        
        <div>
          <h4 class="font-semibold text-gray-700">Alasan Penolakan</h4>
          <textarea id="reject-reason" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent" rows="3" placeholder="Masukkan alasan penolakan..." required></textarea>
        </div>
      </div>
      
      <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end gap-2">
        <button onclick="closeRejectModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-lg font-medium transition-colors">
          Batal
        </button>
        <button onclick="confirmRejectOrder()" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
          Tolak Pesanan
        </button>
      </div>
    </div>
  </div>
</div>

  <!-- Firebase SDK -->
  <script type="module">
    // Import fungsi yang diperlukan dari SDK
    import { 
      initializeApp 
    } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
    import { 
      getFirestore, 
      collection, 
      getDocs, 
      getCountFromServer, 
      query, 
      where, 
      onSnapshot,
      doc,
      getDoc,
      updateDoc,
      serverTimestamp
    } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

    // Konfigurasi Firebase Anda
    const firebaseConfig = {
      apiKey: "AIzaSyB-FBt737Xr163ElsjnofcHkSVXqYVK618",
      authDomain: "my-akastra-app.firebaseapp.com",
      projectId: "my-akastra",
      storageBucket: "my-akastra.firebasestorage.app",
      messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
      appId: "1:983577813931:android:3ddc40de72673f8b6068ee"
    };  

    // Inisialisasi Firebase
    const app = initializeApp(firebaseConfig);
    const db = getFirestore(app);

    // --- Fungsi untuk memperbarui statistik di kartu ---
    async function updateDashboardStats() {
        try {
            // 1. Total Kendaraan
            const vehiclesCol = collection(db, "vehicles");
            const vehicleSnapshot = await getCountFromServer(vehiclesCol);
            document.getElementById('total-kendaraan-count').textContent = vehicleSnapshot.data().count;

            // 2. Status Order
            const ordersCol = collection(db, "orders");

            // Menunggu Konfirmasi (IN_QUEUE dan IN_PROGRESS)
const qPending = query(ordersCol, where("order_status", "in", ["Menunggu Konfirmasi", "Dalam Antrian", "Dalam Pengerjaan"]));
const pendingSnapshot = await getCountFromServer(qPending);
document.getElementById('menunggu-konfirmasi-count').textContent = pendingSnapshot.data().count;

            // Servis Selesai (COMPLETED)
            const qCompleted = query(ordersCol, where("order_status", "==", "Selesai"));
            const completedSnapshot = await getCountFromServer(qCompleted);
            document.getElementById('servis-selesai-count').textContent = completedSnapshot.data().count;

            // Servis Hari Ini
            const today = new Date();
            const startOfDay = new Date(today.setHours(0, 0, 0, 0));
            const endOfDay = new Date(today.setHours(23, 59, 59, 999));
            
            const qToday = query(ordersCol, 
                where("scheduled_date", ">=", startOfDay),
                where("scheduled_date", "<=", endOfDay)
            );
            const todaySnapshot = await getCountFromServer(qToday);
            document.getElementById('servis-hari-ini-count').textContent = todaySnapshot.data().count;

        } catch (error) {
            console.error("Error updating dashboard stats: ", error);
            document.getElementById('total-kendaraan-count').textContent = 'Err';
            document.getElementById('menunggu-konfirmasi-count').textContent = 'Err';
            document.getElementById('servis-selesai-count').textContent = 'Err';
            document.getElementById('servis-hari-ini-count').textContent = 'Err';
        }
    }
    
    // Fungsi untuk menampilkan modal detail
    function showDetailModal(orderData) {
      const modal = document.getElementById('detailModal');
      
      // Isi data ke dalam modal
      document.getElementById('detail-pelanggan').textContent = orderData.pelanggan || '-';
      document.getElementById('detail-kendaraan').textContent = orderData.kendaraan || '-';
      document.getElementById('detail-jenis-servis').textContent = orderData.jenisServis || '-';
      document.getElementById('detail-keluhan').textContent = orderData.keluhan || '-';
      document.getElementById('detail-jadwal').textContent = orderData.jadwal || '-';
      
      // Tampilkan modal
      modal.classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeDetailModal() {
      document.getElementById('detailModal').classList.add('hidden');
    }

// Variabel state
let isShowingAll = false;

// Fungsi untuk toggle tampilan
function toggleTableView() {
  const tableContainer = document.getElementById('tableContainer');
  const lihatSemuaBtn = document.getElementById('lihatSemuaBtn');
  
  isShowingAll = !isShowingAll;
  
  if (isShowingAll) {
    tableContainer.classList.remove('scrollable-table');
    tableContainer.classList.add('full-view-table');
    lihatSemuaBtn.textContent = 'Sembunyikan';
    lihatSemuaBtn.classList.add('active');
  } else {
    tableContainer.classList.remove('full-view-table');
    tableContainer.classList.add('scrollable-table');
    lihatSemuaBtn.textContent = 'Lihat Semua';
    lihatSemuaBtn.classList.remove('active');
  }
}

// Event listener untuk tombol Lihat Semua
document.getElementById('lihatSemuaBtn').addEventListener('click', function(e) {
  e.preventDefault();
  toggleTableView();
});

    // Fungsi untuk menampilkan detail layanan
async function populateConfirmationTable() {
    const tbody = document.getElementById('konfirmasi-table-body');
    const tableContainer = document.getElementById('tableContainer');
    
    try {
        // 1. Ambil semua data yang diperlukan sekaligus
        const [ordersSnapshot, usersSnapshot, vehiclesSnapshot, servicesSnapshot] = await Promise.all([
            getDocs(query(collection(db, "orders"), where("order_status", "in", ["Menunggu Konfirmasi", "Dalam Antrian", "Dalam Pengerjaan"]))),
            getDocs(collection(db, "users")),
            getDocs(collection(db, "vehicles")),
            getDocs(collection(db, "services"))
        ]);

        // 2. Buat mapping untuk akses cepat
        const usersMap = {};
        usersSnapshot.forEach(doc => {
            usersMap[doc.id] = doc.data();
        });

        const vehiclesMap = {};
        vehiclesSnapshot.forEach(doc => {
            vehiclesMap[doc.id] = doc.data();
        });

        const servicesMap = {};
        servicesSnapshot.forEach(doc => {
            servicesMap[doc.id] = doc.data().label;
        });

        // 3. Kosongkan tabel
        tbody.innerHTML = '';

        // 4. Proses setiap order dengan batasan maksimal 20 data
        let rowCount = 0;
        const maxRows = 20; // Batas maksimal data yang ditampilkan
        
        ordersSnapshot.forEach(doc => {
            if (rowCount >= maxRows) return;
            rowCount++;
            
            const order = doc.data();
            const user = usersMap[order.userId] || {};
            const vehicle = vehiclesMap[order.vehicle_id] || {};
                
            // 1. Ambil HANYA service pertama
            const firstServiceId = order.ordered_service_ids?.[0];
            const firstServiceName = firstServiceId 
                ? (servicesMap[firstServiceId] || `Service ${firstServiceId.substring(0,4)}`)
                : 'Tidak ada layanan';

            // 2. Format tanggal
            const formattedDate = order.scheduled_date?.toDate().toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }) || 'Tanggal tidak tersedia';

            // 3. Buat row tabel
            const row = `
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <p class="font-semibold">${user.name || 'Pelanggan tidak ditemukan'}</p>
                        <p class="text-xs text-gray-500">${user.email || ''}</p>
                    </td>
                    <td class="px-4 py-3">
                        <p class="font-semibold">${vehicle.model || 'Kendaraan tidak ditemukan'}</p>
                        <p class="text-xs text-gray-500">${vehicle.nomor_polisi || 'Tidak ada plat'}</p>
                    </td>
                    <td class="px-4 py-3">
                        <p class="font-medium">${firstServiceName}</p>
                        <a href="#" class="text-blue-500 text-xs hover:underline" 
                           onclick="showServiceDetails('${doc.id}'); return false;">
                           Lihat Detail
                        </a>
                    </td>
                    <td class="px-4 py-3">
                        <p>${formattedDate}</p>
                        <p class="text-xs text-gray-500">${order.scheduled_time || ''}</p>
                    </td>
                    <td class="px-4 py-3">
                        <span class="${
                            order.order_status === 'Menunggu Konfirmasi' ? 'bg-yellow-200 text-yellow-800' :
                            order.order_status === 'Dalam Antrian' ? 'bg-sky-200 text-sky-800' : 
                            order.order_status === 'Dalam Pengerjaan' ? 'bg-orange-200 text-orange-800' :
                            order.order_status === 'Selesai' ? 'bg-emerald-200 text-emerald-800' :
                            order.order_status === 'Ditolak' ? 'bg-red-200 text-red-800' :
                            'bg-gray-100 text-gray-800'
                        } px-2 py-1 rounded-full text-xs">
                            ${
                                order.order_status === 'Menunggu Konfirmasi' ? 'Menunggu Konfirmasi' :
                                order.order_status === 'Dalam Antrian' ? 'Dalam Antrian' : 
                                order.order_status === 'Dalam Pengerjaan' ? 'Dalam Pengerjaan' :
                                order.order_status === 'Selesai' ? 'Selesai' :
                                order.order_status === 'Ditolak' ? 'Ditolak' :
                                'Status Tidak Dikenal'
                            }
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex justify-center gap-2">
                            <!-- Tombol Edit -->
                            <button 
                                class="flex items-center justify-center gap-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-all shadow-sm hover:shadow-md"
                                onclick="showEditModal('${doc.id}')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Edit
                            </button>
                            
                            <!-- Tombol Reject -->
                            <button 
                                class="flex items-center justify-center gap-1 bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-all shadow-sm hover:shadow-md"
                                onclick="handleRejectOrder('${doc.id}')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                Reject
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            
            tbody.innerHTML += row;
        });

        // 5. Tambahkan class scrollable jika data lebih dari 5
        if (rowCount > 5) {
            tableContainer.classList.add('scrollable-table');
            tableContainer.style.maxHeight = '400px'; // Atur tinggi maksimal
        } else {
            tableContainer.classList.remove('scrollable-table');
            tableContainer.style.maxHeight = 'none';
        }

        // 6. Handle jika tidak ada data
        if (ordersSnapshot.empty) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">
                        Tidak ada order yang menunggu konfirmasi
                    </td>
                </tr>`;
        }

         // Di dalam fungsi populateConfirmationTable(), ganti bagian ini:
if (!isShowingAll && ordersSnapshot.size > 5) {
  tableContainer.classList.add('scrollable-table');
  tableContainer.classList.remove('full-view-table');
} else {
  tableContainer.classList.remove('scrollable-table');
  tableContainer.classList.add('full-view-table');
}

    } catch (error) {
        console.error("Error loading data:", error);
        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center py-4 text-red-500">
                    Gagal memuat data. Silakan coba lagi.
                </td>
            </tr>`;
    }
}

    async function populateTodaySchedule() {
        const listContainer = document.getElementById('jadwal-hari-ini-list');
        document.getElementById('tanggal-hari-ini').textContent = new Date().toLocaleDateString('id-ID', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });

        const today = new Date();
        const startOfDay = new Date(today.setHours(0, 0, 0, 0));
        const endOfDay = new Date(today.setHours(23, 59, 59, 999));

        const q = query(collection(db, "orders"), 
            where("scheduled_date", ">=", startOfDay),
            where("scheduled_date", "<=", endOfDay)
        );
        
        try {
            // Ambil data users dan vehicles terlebih dahulu
            const [usersSnapshot, vehiclesSnapshot, querySnapshot] = await Promise.all([
                getDocs(collection(db, "users")),
                getDocs(collection(db, "vehicles")),
                getDocs(q)
            ]);

            // Buat mapping untuk users dan vehicles
            const usersMap = {};
            usersSnapshot.forEach(doc => {
                usersMap[doc.id] = doc.data().name;
            });

            const vehiclesMap = {};
            vehiclesSnapshot.forEach(doc => {
                vehiclesMap[doc.id] = doc.data().model || doc.data().nomor_polisi|| 'Kendaraan';
            });

            if (querySnapshot.empty) {
                listContainer.innerHTML = '<p class="text-center text-gray-500">Tidak ada jadwal untuk hari ini.</p>';
                return;
            }

            listContainer.innerHTML = '';
            querySnapshot.forEach(doc => {
                const data = doc.data();
                // Dapatkan nama user dan kendaraan
                const userName = usersMap[data.userId] || `User (${data.userId.substring(0, 6)}...)`;
                const vehicleName = vehiclesMap[data.vehicle_id] || `Kendaraan (${data.vehicle_id.substring(0, 6)}...)`;

                const item = `
                    <div class="bg-gray-100 p-4 rounded-lg flex justify-between items-center">
                        <div>
                            <p class="text-red-600 font-bold">${data.scheduled_time || 'N/A'}</p>
                            <p class="font-semibold">${userName}</p>
                            <p class="text-sm text-gray-500">${vehicleName}</p>
                        </div>
                        <span class="text-xs ${
    data.order_status === 'Menunggu Konfirmasi' ? 'bg-yellow-200 text-yellow-800' :
    data.order_status === 'Dalam Antrian' ? 'bg-sky-200 text-sky-800' : 
    data.order_status === 'Dalam Pengerjaan' ? 'bg-orange-200 text-orange-800' :
    data.order_status === 'Selesai' ? 'bg-green-200 text-green-800' :
    data.order_status === 'Ditolak' ? 'bg-red-200 text-red-800' :
    'bg-gray-200 text-gray-800'
} px-3 py-1 rounded-full whitespace-nowrap">
    ${
        data.order_status === 'Menunggu Konfirmasi' ? 'Menunggu Konfirmasi' :
        data.order_status === 'Dalam Antrian' ? 'Dalam Antrian' : 
        data.order_status === 'Dalam Pengerjaan' ? 'Dalam Pengerjaan' :
        data.order_status === 'Selesai' ? 'Selesai' :
        data.order_status === 'Ditolak' ? 'Ditolak' :
        'Status Tidak Dikenal'
    }
</span>
                    </div>
                `;
                listContainer.innerHTML += item;
            });
        } catch (error) {
            console.error("Error populating today's schedule: ", error);
            listContainer.innerHTML = '<p class="text-center text-red-500">Gagal memuat jadwal.</p>';
        }
    }

    // Fungsi untuk menangani konfirmasi order
    async function handleConfirmOrder(orderId) {
        try {
            // Referensi ke dokumen order yang akan diupdate
            const orderRef = doc(db, "orders", orderId);
            
            // Update status order menjadi "DONE" dan timestamp
            await updateDoc(orderRef, {
                order_status: "Selesai",
                updated_at: serverTimestamp()
            });
            
            // Beri feedback ke user
            alert("Order berhasil dikonfirmasi sebagai selesai!");
            
            // Tidak perlu memanggil populateConfirmationTable() lagi karena
            // sudah ada listener real-time yang akan menangani update
        } catch (error) {
            console.error("Error mengkonfirmasi order:", error);
            alert("Gagal mengkonfirmasi order: " + error.message);
        }
    }

   // Variabel untuk menyimpan orderId yang akan ditolak
let currentRejectOrderId = null;

// Fungsi untuk menampilkan modal penolakan
async function showRejectModal(orderId) {
  currentRejectOrderId = orderId;
  
  try {
    // Ambil data order dari Firestore
    const orderDoc = doc(db, "orders", orderId);
    const docSnap = await getDoc(orderDoc);
    
    if (docSnap.exists()) {
      const orderData = docSnap.data();
      
      // Ambil data user dan vehicle
      const [userSnap, vehicleSnap] = await Promise.all([
        getDoc(doc(db, "users", orderData.userId)),
        getDoc(doc(db, "vehicles", orderData.vehicle_id))
      ]);
      
      // Ambil data services
      let servicesList = [];
      if (orderData.ordered_service_ids && orderData.ordered_service_ids.length > 0) {
        const servicePromises = orderData.ordered_service_ids.map(serviceId => 
          getDoc(doc(db, "services", serviceId))
        );
        const serviceSnaps = await Promise.all(servicePromises);
        servicesList = serviceSnaps.map(snap => snap.exists() ? snap.data().label : null)
          .filter(label => label !== null);
      }
      
      // Isi data ke dalam modal penolakan
      document.getElementById('reject-pelanggan').textContent = 
        userSnap.exists() ? userSnap.data().name : 'Pelanggan tidak ditemukan';
      document.getElementById('reject-kendaraan').textContent = 
        vehicleSnap.exists() ? 
        `${vehicleSnap.data().model} - ${vehicleSnap.data().nomor_polisi}` : 
        'Kendaraan tidak ditemukan';
      document.getElementById('reject-jenis-servis').textContent = 
        servicesList.join(', ') || 'Tidak ada layanan';
      
      // Reset textarea
      document.getElementById('reject-reason').value = '';
      
      // Tampilkan modal
      document.getElementById('rejectModal').classList.remove('hidden');
    } else {
      console.log("Order tidak ditemukan!");
      alert("Order tidak ditemukan!");
    }
  } catch (error) {
    console.error("Error mengambil data order:", error);
    alert("Gagal memuat detail order. Silakan coba lagi.");
  }
}

// Fungsi untuk menutup modal penolakan
function closeRejectModal() {
  document.getElementById('rejectModal').classList.add('hidden');
}

// Fungsi untuk konfirmasi penolakan
async function confirmRejectOrder() {
  const reason = document.getElementById('reject-reason').value.trim();
  
  if (!reason) {
    alert('Harap masukkan alasan penolakan');
    return;
  }
  
  if (!currentRejectOrderId) {
    alert('Tidak ada pesanan yang dipilih untuk ditolak');
    return;
  }
  
  try {
    const orderRef = doc(db, "orders", currentRejectOrderId);
    await updateDoc(orderRef, {
      order_status: "Ditolak",
      rejection_reason: reason,
      updated_at: serverTimestamp()
    });
    
    alert("Pesanan berhasil ditolak!");
    closeRejectModal();
  } catch (error) {
    console.error("Error menolak order:", error);
    alert("Gagal menolak order: " + error.message);
  }
}

// Fungsi untuk menangani penolakan order (versi baru)
async function handleRejectOrder(orderId) {
  showRejectModal(orderId);
}
// Variabel global untuk menyimpan orderId yang sedang diedit
let currentEditOrderId = null;

// Fungsi untuk menampilkan modal edit
async function showEditModal(orderId) {
    currentEditOrderId = orderId;
    
    try {
        // Ambil data order untuk mendapatkan status saat ini
        const orderDoc = doc(db, "orders", orderId);
        const docSnap = await getDoc(orderDoc);
        
        if (docSnap.exists()) {
            const orderData = docSnap.data();
            
            // Set nilai dropdown sesuai status saat ini
            const statusDropdown = document.getElementById('statusDropdown');
            statusDropdown.value = orderData.order_status || 'Menunggu Konfirmasi';
            
            // Tampilkan modal
            document.getElementById('editStatusModal').classList.remove('hidden');
        }
    } catch (error) {
        console.error("Error mengambil data order:", error);
        alert("Gagal memuat data order. Silakan coba lagi.");
    }
}

// Fungsi untuk menutup modal edit
function closeEditModal() {
    document.getElementById('editStatusModal').classList.add('hidden');
}

// Fungsi untuk update status order
async function updateOrderStatus() {
    if (!currentEditOrderId) return;
    
    const newStatus = document.getElementById('statusDropdown').value;
    
    try {
        const orderRef = doc(db, "orders", currentEditOrderId);
        await updateDoc(orderRef, {
            order_status: newStatus,
            updated_at: serverTimestamp()
        });
        
        alert("Status order berhasil diperbarui!");
        closeEditModal();
    } catch (error) {
        console.error("Error mengupdate status order:", error);
        alert("Gagal mengupdate status order: " + error.message);
    }
}
    // --- Event Listeners dan Panggilan Fungsi Awal ---

    // Toggle Sidebar untuk Mobile
    document.getElementById('toggleSidebar').addEventListener('click', function() {
      document.getElementById('sidebar').classList.toggle('-translate-x-full');
    });

    // Panggil semua fungsi saat halaman dimuat
    window.addEventListener('load', function() {
        // Panggil fungsi-fungsi yang sudah diperbaiki
        updateDashboardStats();
        populateConfirmationTable();
        populateTodaySchedule();
        
        setTimeout(() => {
            document.querySelector('.loading-animation').style.display = 'none';
        }, 500); // Beri sedikit jeda agar transisi lebih mulus

        document.getElementById('lihatSemuaBtn').addEventListener('click', function(e) {
        e.preventDefault();
        toggleTableView();
    });
    });

    // Listener real-time untuk memperbarui data secara otomatis
    onSnapshot(collection(db, "orders"), (snapshot) => {  
        console.log("Data 'orders' berubah, memperbarui tampilan...");
        updateDashboardStats();
        populateConfirmationTable();
        populateTodaySchedule();
    }); 

    onSnapshot(collection(db, "vehicles"), (snapshot) => {
        console.log("Data 'vehicles' berubah, memperbarui jumlah total...");
        updateDashboardStats();

         if (isShowingAll) {
        document.getElementById('tableContainer').classList.add('full-view-table');
        document.getElementById('tableContainer').classList.remove('scrollable-table');
    }
    });

    // Fungsi untuk membuka WhatsApp dengan nomor pelanggan
async function contactCustomer(orderId) {
    try {
        // 1. Ambil data order untuk mendapatkan userId
        const orderDoc = doc(db, "orders", orderId);
        const orderSnap = await getDoc(orderDoc);
        
        if (!orderSnap.exists()) {
            alert('Order tidak ditemukan');
            return;
        }
        
        const orderData = orderSnap.data();
        const userId = orderData.userId;
        
        // 2. Ambil data user untuk mendapatkan nomor telepon dan nama
        const userDoc = doc(db, "users", userId);
        const userSnap = await getDoc(userDoc);
        
        if (!userSnap.exists()) {
            alert('Data pelanggan tidak ditemukan');
            return;
        }
        
        const userData = userSnap.data();
        const phoneNumber = userData.phone;
        const customerName = userData.name || 'Pelanggan';
        
        if (!phoneNumber) {
            alert('Nomor telepon pelanggan tidak tersedia');
            return;
        }
        
        // 3. Format nomor untuk WhatsApp
        const formattedPhone = phoneNumber.replace(/\D/g, '');
        const whatsappNumber = formattedPhone.startsWith('62') ? 
            formattedPhone : 
            `62${formattedPhone.startsWith('0') ? formattedPhone.substring(1) : formattedPhone}`;
        
        // 4. Ambil data tambahan dari modal yang sudah terbuka
        const vehicleInfo = document.getElementById('detail-kendaraan').textContent;
        const serviceInfo = document.getElementById('detail-jenis-servis').textContent;
        const scheduleDate = document.getElementById('detail-jadwal').textContent;
        
        // 5. Format pesan WhatsApp
        const defaultMessage = `Halo Bapak/Ibu ${customerName} 
Terima kasih telah melakukan booking servis di Akastra Toyota.
Berikut kami konfirmasi jadwal servis kendaraan Anda:

> Tanggal Servis: ${scheduleDate.split(',')[0]}
> Waktu: ${orderData.scheduled_time || '--:--'}
> Jenis Servis: ${serviceInfo}
> Lokasi: https://maps.app.goo.gl/6i8cxoxKRNswyr4G7

Mohon hadir 10–15 menit sebelum jadwal untuk memperlancar proses servis.

Jika Bapak/Ibu ingin mengubah jadwal atau memiliki pertanyaan lebih lanjut, silakan hubungi kami kembali

Terima kasih atas kepercayaannya.
Akastra Toyota siap menjaga performa kendaraan Anda tetap optimal!
Sampai jumpa di bengkel kami! 

#AkastraToyota #ServisTanpaRibet #ToyotaCare`;

        // 6. Buka WhatsApp
        window.open(`https://wa.me/${whatsappNumber}?text=${encodeURIComponent(defaultMessage)}`, '_blank');
        
    } catch (error) {
        console.error('Gagal menghubungi pelanggan:', error);
        alert('Terjadi kesalahan saat menghubungi pelanggan');
    }
}

    // Ekspos fungsi ke global scope agar bisa dipanggil dari HTML
    window.showServiceDetails = showServiceDetails;
    window.closeDetailModal = closeDetailModal;
    window.handleConfirmOrder = handleConfirmOrder;
    window.handleRejectOrder = handleRejectOrder;
    window.closeRejectModal = closeRejectModal;
    window.confirmRejectOrder = confirmRejectOrder;
    window.showEditModal = showEditModal;
    window.closeEditModal = closeEditModal;
    window.updateOrderStatus = updateOrderStatus;
    window.contactCustomer = contactCustomer;
    window.showServiceDetails = showServiceDetails;
    window.closeDetailModal = closeDetailModal;

  </script>
</body>
</html>