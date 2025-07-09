<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Akastra - Jadwal Servis</title>
  {{-- @vite('resources/css/app.css') --}}
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
  {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #F7F7F7; /* Menggunakan warna latar dari body pertama */
    }
    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 8px; height: 8px; }
    ::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #64748b; }
    /* Table Row Hover Effect */
    tbody tr { transition: transform 0.15s ease; }
    tbody tr:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); z-index: 10; position: relative; }
    /* Custom Severity Colors */
    .High { background-color: #fee2e2; color: #b91c1c; padding: 2px 8px; border-radius: 9999px; font-weight: 600; }
    .Medium { background-color: #ffedd5; color: #c2410c; padding: 2px 8px; border-radius: 9999px; font-weight: 600; }
    .Low { background-color: #ecfccb; color: #3f6212; padding: 2px 8px; border-radius: 9999px; font-weight: 600; }
    /* Button Transitions */
    button, a.bg-blue-500, a.bg-green-500, a.bg-red-500 { transition: all 0.2s ease; }
    button:hover, a.bg-blue-500:hover, a.bg-green-500:hover, a.bg-red-500:hover { transform: translateY(-2px); }
    /* Table & Map Animation (Jika masih diperlukan) */
    @keyframes fadeIn { 0% { opacity: 0; transform: translateY(10px); } 100% { opacity: 1; transform: translateY(0); } }
    #tableContainer, #calendarContainer { animation: fadeIn 0.5s ease-out forwards; }
    /* Loading Animation (Jika masih diperlukan) */
    .loading-animation { /* Style loading Anda */ }
    .spinner { /* Style spinner Anda */ }
    /* FullCalendar Height Adjustment */
    #calendar {
        width: 100%; /* Memastikan lebar penuh */
    }
  </style>
</head>
<body class="bg-[#F7F7F7]">
  <div class="loading-animation">
    <div class="spinner"></div>
  </div>

  <header class="fixed top-0 left-0 w-full bg-white text-white shadow-lg p-4 md:p-8 flex flex-col justify-center font-[Inter] font-bold tracking-[0.5px] z-50">
    <div class="container mx-auto flex items-center justify-start space-x-3">
        <button id="toggleSidebar" class="md:hidden p-2 bg-[#70C1F3] rounded-lg mr-2">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
      <div class="text-left">
        <h1 class="text-xl md:text-[32px] font-medium mb-1 text-neutral-950">Jadwal Servis</h1>
      </div>
    </div>
  </header>

  <div class="flex">
    <aside id="sidebar" class="fixed top-0 left-0 w-64 h-screen bg-red-600 p-4 flex-col z-[60] transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0">
      <a href="#" class="flex justify-center items-center">
        <img src="build/assets/akastrawhitelogo.png" class="h-[175px] w-auto transition-transform hover:scale-105" alt="Logo Akastra" />
      </a>
      <nav class="flex flex-col flex-1">
        <div class="px-4 py-2 mb-2">
          <h3 class="text-xs font-semibold text-neutral-50 uppercase tracking-wider">Dashboard</h3>
        </div>
        <ul class="space-y-1 px-2">
          <li>
            <a href="{{ route('dashboard.index') }}" class="group flex items-center p-3 bg-red-600 rounded-xl hover:bg-white transition-colors duration-300 ">
              <div class="flex items-center justify-center w-8 h-8 text-neutral-50 bg-red-600 rounded-lg mr-3 group-hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" /><path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" /></svg>
              </div>
              <span class="text-white group-hover:text-red-600 font-bold transition-colors duration-300">Beranda</span>
            </a>
          </li>
          <div class="border-t border-gray-100 my-4"></div>
          <div class="px-2 py-2 mb-1">
            <h3 class="text-xs font-semibold text-neutral-50 uppercase tracking-wider">Menu</h3>
          </div>
          <li>
            <a href="#" class="group flex items-center p-3 bg-neutral-50 rounded-xl hover:bg-white transition-colors duration-300">
              <div class="flex items-center justify-center w-8 h-8 text-neutral-50 bg-red-600 rounded-lg mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" /><path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" /></svg>
              </div>
              <span class="text-red-600 font-bold">Jadwal Servis</span>
            </a>
          </li>
          <li>
            <a href="{{ route('datakendaraan.index') }}" class="group flex items-center p-3 bg-red-600 rounded-xl hover:bg-white transition-colors duration-300">
              <div class="flex items-center justify-center w-8 h-8 text-neutral-50 bg-red-600 rounded-lg mr-3 group-hover:text-red-600">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 18.375V5.625zM21 9.375A.375.375 0 0020.625 9h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zm0 3.75a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zm0 3.75a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zM10.875 18.75a.375.375 0 00.375-.375v-1.5a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5zM3.375 15h7.5a.375.375 0 00.375-.375v-1.5a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375zm0-3.75h7.5a.375.375 0 00.375-.375v-1.5A.375.375 0 0010.875 9h-7.5A.375.375 0 003 9.375v1.5c0 .207.168.375.375.375z" clip-rule="evenodd" /></svg>
              </div>
              <span class="text-white group-hover:text-red-600 font-bold transition-colors duration-300">Data Kendaraan</span>
            </a>
          </li>
            <li>
            <a href="#" class="group flex items-center p-3 bg-red-600 rounded-xl hover:bg-white transition-colors duration-300">
              <div class="flex items-center justify-center w-8 h-8 text-neutral-50 bg-red-600 rounded-lg mr-3 group-hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M12 6.75a5.25 5.25 0 016.775-5.025.75.75 0 01.313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 011.248.313 5.25 5.25 0 01-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 112.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0112 6.75zM4.117 19.125a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75h-.008a.75.75 0 01-.75-.75v-.008z" clip-rule="evenodd" /><path d="M10.076 8.64l-2.201-2.2V4.874a.75.75 0 00-.364-.643l-3.75-2.25a.75.75 0 00-.916.113l-.75.75a.75.75 0 00-.113.916l2.25 3.75a.75.75 0 00.643.364h1.564l2.062 2.062 1.575-1.297z" /><path fill-rule="evenodd" d="M12.556 17.329l4.183 4.182a3.375 3.375 0 004.773-4.773l-3.306-3.305a6.803 6.803 0 01-1.53.043c-.394-.034-.682-.006-.867.042a.589.589 0 00-.167.063l-3.086 3.748zm3.414-1.36a.75.75 0 011.06 0l1.875 1.876a.75.75 0 11-1.06 1.06L15.97 17.03a.75.75 0 010-1.06z" clip-rule="evenodd" /></svg>
              </div>
              <span class="text-white group-hover:text-red-600 font-bold transition-colors duration-300">Suku Cadang</span>
            </a>
          </li>
        </ul>
        <div class="border-t border-gray-100 my-4"></div>
        <div class="mt-auto p-3">
          <a href="#" class="flex items-center justify-center p-3 bg-red-500 text-white rounded-xl shadow-md hover:bg-red-700 transition-all transform hover:-translate-y-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2"><path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm5.03 4.72a.75.75 0 010 1.06l-1.72 1.72h10.94a.75.75 0 010 1.5H10.81l1.72 1.72a.75.75 0 11-1.06 1.06l-3-3a.75.75 0 010-1.06l3-3a.75.75 0 011.06 0z" clip-rule="evenodd" /></svg>
            <span class="text-white font-bold">Logout</span>
          </a>
        </div>
      </nav>
    </aside>

    <main class="flex-1 ml-0 md:ml-64 p-4 md:p-8 transition-all duration-300 pt-24 md:pt-32"> <div id="calendarContainer" class="w-full mx-auto bg-white p-4 rounded-xl shadow pb-4 mb-6">
        <h1 class="text-2xl font-bold mb-4 text-center">📅 Kalender Jadwal</h1>
        <div id="calendar" class="w-full overflow-x-auto"></div> </div>

      <div id="tableContainer" class="bg-white rounded-xl shadow p-4">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-lg font-semibold">Menunggu Konfirmasi</h2>
          <a href="#" class="text-red-500 text-sm font-medium hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-600 uppercase">
              <tr>
                <th class="px-4 py-3">Pelanggan</th>
                <th class="px-4 py-3">Kendaraan</th>
                <th class="px-4 py-3">Jenis Servis</th>
                <th class="px-4 py-3">Jadwal</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Aksi</th>
              </tr>
            </thead>
            <tbody class="text-gray-700">
              <tr class="border-b">
                <td class="px-4 py-3 flex items-center space-x-3">
                  <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                  <div>
                    <p class="font-semibold">abudi Siti</p>
                    <p class="text-gray-500 text-xs">Budi@example.com</p>
                  </div>
                </td>
                <td class="px-4 py-3">
                  <p>Toyota Avanza</p>
                  <p class="text-xs text-gray-500">B 1234 C</p>
                </td>
                <td class="px-4 py-3">
                  <p>Servis Berkala 10.000 KM</p>
                  <a href="#" class="text-blue-600 text-xs hover:underline">Lihat Detail</a>
                </td>
                <td class="px-4 py-3">
                  <p class="font-medium">12 Juni 2025</p>
                  <p class="text-xs text-gray-500">09:00 - 11:00</p>
                </td>
                <td class="px-4 py-3">
                  <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Menunggu Konfirmasi</span>
                </td>
                <td class="px-4 py-3 space-x-1">
                  <button class="bg-green-500 text-white text-xs px-3 py-1 rounded-full hover:bg-green-600">TERIMA</button>
                  <button class="bg-red-500 text-white text-xs px-3 py-1 rounded-full hover:bg-red-600">TOLAK</button>
                </td>
              </tr>
               <tr class="border-b">
                <td class="px-4 py-3 flex items-center space-x-3">
                  <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                  <div>
                    <p class="font-semibold">Andi Wijaya</p>
                    <p class="text-gray-500 text-xs">andi.wijaya@example.com</p>
                  </div>
                </td>
                <td class="px-4 py-3">
                  <p>Mitsubishi Xpander</p>
                  <p class="text-xs text-gray-500">D 5678 ZX</p>
                </td>
                <td class="px-4 py-3">
                  <p>Ganti Oli Mesin</p>
                  <a href="#" class="text-blue-600 text-xs hover:underline">Lihat Detail</a>
                </td>
                <td class="px-4 py-3">
                  <p class="font-medium">15 Juni 2025</p>
                  <p class="text-xs text-gray-500">08:00 - 09:00</p>
                </td>
                <td class="px-4 py-3">
                  <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Menunggu Konfirmasi</span>
                </td>
                <td class="px-4 py-3 space-x-1">
                  <button class="bg-green-500 text-white text-xs px-3 py-1 rounded-full hover:bg-green-600">TERIMA</button>
                  <button class="bg-red-500 text-white text-xs px-3 py-1 rounded-full hover:bg-red-600">TOLAK</button>
                </td>
              </tr>
              <tr class="border-b">
                <td class="px-4 py-3 flex items-center space-x-3">
                  <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                  <div>
                    <p class="font-semibold">Siti Rahma</p>
                    <p class="text-gray-500 text-xs">siti.rahma@example.com</p>
                  </div>
                </td>
                <td class="px-4 py-3">
                  <p>Honda Brio</p>
                  <p class="text-xs text-gray-500">F 3456 YU</p>
                </td>
                <td class="px-4 py-3">
                  <p>Servis Rem & Kampas</p>
                  <a href="#" class="text-blue-600 text-xs hover:underline">Lihat Detail</a>
                </td>
                <td class="px-4 py-3">
                  <p class="font-medium">16 Juni 2025</p>
                  <p class="text-xs text-gray-500">13:00 - 14:30</p>
                </td>
                <td class="px-4 py-3">
                  <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Menunggu Konfirmasi</span>
                </td>
                <td class="px-4 py-3 space-x-1">
                  <button class="bg-green-500 text-white text-xs px-3 py-1 rounded-full hover:bg-green-600">TERIMA</button>
                  <button class="bg-red-500 text-white text-xs px-3 py-1 rounded-full hover:bg-red-600">TOLAK</button>
                </td>
              </tr>
              <tr class="border-b">
                <td class="px-4 py-3 flex items-center space-x-3">
                  <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                  <div>
                    <p class="font-semibold">Rizky Maulana</p>
                    <p class="text-gray-500 text-xs">rizky.m@example.com</p>
                  </div>
                </td>
                <td class="px-4 py-3">
                  <p>Suzuki Ertiga</p>
                  <p class="text-xs text-gray-500">B 8910 TR</p>
                </td>
                <td class="px-4 py-3">
                  <p>Periksa Aki & Kelistrikan</p>
                  <a href="#" class="text-blue-600 text-xs hover:underline">Lihat Detail</a>
                </td>
                <td class="px-4 py-3">
                  <p class="font-medium">17 Juni 2025</p>
                  <p class="text-xs text-gray-500">10:00 - 11:00</p>
                </td>
                <td class="px-4 py-3">
                  <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Menunggu Konfirmasi</span>
                </td>
                <td class="px-4 py-3 space-x-1">
                  <button class="bg-green-500 text-white text-xs px-3 py-1 rounded-full hover:bg-green-600">TERIMA</button>
                  <button class="bg-red-500 text-white text-xs px-3 py-1 rounded-full hover:bg-red-600">TOLAK</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </main>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const calendarEl = document.getElementById('calendar');

      const eventsData = [
        // Contoh event dari data tabel
        {
          title: 'Budi S - Avanza (Servis Berkala)',
          start: '2025-06-12T09:00:00',
          end: '2025-06-12T11:00:00',
          backgroundColor: '#fde047', // Kuning (Menunggu Konfirmasi)
          borderColor: '#fde047',
          textColor: '#ca8a04',
          description: 'Servis Berkala 10.000 KM'
        },
        {
          title: 'Andi W - Xpander (Ganti Oli)',
          start: '2025-06-15T08:00:00',
          end: '2025-06-15T09:00:00',
          backgroundColor: '#fde047',
          borderColor: '#fde047',
          textColor: '#ca8a04',
          description: 'Ganti Oli Mesin'
        },
        {
          title: 'Siti R - Brio (Servis Rem)',
          start: '2025-06-16T13:00:00',
          end: '2025-06-16T14:30:00',
          backgroundColor: '#fde047',
          borderColor: '#fde047',
          textColor: '#ca8a04',
          description: 'Servis Rem & Kampas'
        },
        {
          title: 'Rizky M - Ertiga (Aki)',
          start: '2025-06-17T10:00:00',
          end: '2025-06-17T11:00:00',
          backgroundColor: '#fde047',
          borderColor: '#fde047',
          textColor: '#ca8a04',
          description: 'Periksa Aki & Kelistrikan'
        },
        // Data event lama (jika masih relevan)
        {
          title: 'Meeting Tim A',
          start: '2025-05-15',
          description: 'Meeting bersama tim A di ruang 302',
        },
        {
          title: 'Diskusi Proyek X',
          start: '2025-05-15',
          description: 'Diskusi awal proyek X dengan tim developer',
        },
        {
          title: 'Deadline Tugas',
          start: '2025-05-18',
          end: '2025-05-20',
          color: 'red',
          description: 'Pengumpulan tugas akhir semester'
        }
      ];

      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'standard',
        events: eventsData,
        height: 'auto', // <--- INI KUNCINYA: Membuat tinggi kalender otomatis
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        dateClick: function(info) {
          const clickedDate = info.dateStr;
          const eventsOnDate = calendar.getEvents().filter(event =>
            event.startStr.startsWith(clickedDate) ||
            (event.endStr && event.startStr <= clickedDate && event.endStr > clickedDate)
          );

          if (eventsOnDate.length > 0) {
            let detail = `📌 Jadwal pada ${clickedDate}:\n\n`;
            eventsOnDate.forEach((event, index) => {
              detail += `${index + 1}. ${event.title}\n`;
              if (event.extendedProps.description) {
                detail += `   - ${event.extendedProps.description}\n`;
              }
            });
            alert(detail);
          } else {
            alert(`Tidak ada jadwal pada tanggal ${clickedDate}`);
          }
        },
        eventClick: function(info) {
          alert('📍 Event: ' + info.event.title + '\n' + (info.event.extendedProps.description || ''));
        }
      });

      calendar.render();
    });

    // Toggle Sidebar for Mobile
    document.getElementById('toggleSidebar').addEventListener('click', function() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('-translate-x-full');
    });

    // Hide loading animation when page is loaded (jika ada)
    window.addEventListener('load', function() {
      const loading = document.querySelector('.loading-animation');
      if (loading) {
          setTimeout(function() {
              loading.style.display = 'none';
          }, 500);
      }
    });
  </script>
</body>
</html>