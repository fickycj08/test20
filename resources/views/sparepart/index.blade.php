<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Suku Cadang - Toyota Admin</title>
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Firestore SDK -->
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-firestore.js"></script>
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
    /* Table Animation */
    @keyframes fadeIn {
      0% {
        opacity: 0;
        transform: translateY(10px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    #tableContainer {
      animation: fadeIn 0.5s ease-out forwards;
    }
    .available {
      color: #10b981;
      font-weight: 500;
    }
    .not-available {
      color: #ef4444;
      font-weight: 500;
    }
  </style>
</head>
<body class="bg-[#F7F7F7]">
  <div class="loading-animation">
    <div class="spinner"></div>
  </div>

  <!-- HEADER -->
  <header class="fixed top-0 left-0 w-full bg-gradient-to-r from-[#ffffff] to-[#ffffff] text-white shadow-lg p-8 flex flex-col justify-center font-[Inter] font-bold tracking-[0.5px] z-50">
    <div class="container mx-auto flex items-center justify-start space-x-3">
      <div class="text-left pl-[32px]">
        <h1 class="text-xl md:text-[32px] font-medium mb-1 text-neutral-950">Suku Cadang</h1>
      </div>
    </div>
  </header>

  <div class="flex">
    <!-- Tombol Hamburger untuk Mobile -->
    <button id="toggleSidebar" class="md:hidden fixed top-4 left-4 z-50 p-2 bg-[#70C1F3] rounded-lg">
      <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 w-64 h-screen bg-red-600 p-4 flex flex-col z-[60]">
      <!-- Logo -->
      <a href="#" class="flex justify-center items-center">
        <img src="build/assets/toyota-admin-logo.png" class="h-[100px] w-auto transition-transform hover:scale-105" alt="Logo Toyota Admin" />
      </a>

      <!-- Menu -->
      <nav>
        <div class="px-4 py-2 mb-2">
          <h3 class="text-xs font-semibold text-neutral-50 uppercase tracking-wider">Dashboard</h3>
        </div>
        <ul class="space-y-1 px-2">
          <li>
            <a href="{{ route('dashboard') }}" class="group flex items-center p-3 bg-neutral-50 rounded-xl hover:bg-white transition-colors duration-300 ">
              <div class="flex items-center justify-center w-8 h-8 text-neutral-50 bg-red-600 rounded-lg mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                  <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                  <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                </svg>
              </div>
              <span class="text-red-600 font-bold">Beranda</span>
            </a>
          </li>
          <div class="border-t border-gray-100 my-4"></div>
          <div class="px-2 py-2 mb-1">
            <h3 class="text-xs font-semibold text-neutral-50 uppercase tracking-wider">Menu</h3>
          </div>
          <li>
            <a href="{{ route('jadwalservis.index') }}" class="group flex items-center p-3 bg-red-600 rounded-xl hover:bg-white transition-colors duration-300">
              <div class="flex items-center justify-center w-8 h-8 text-neutral-50 bg-red-600 rounded-lg mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                  <path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                  <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
                </svg>
              </div>
              <span class="text-white group-hover:text-red-600 font-bold transition-colors duration-300">Jadwal Servis</span>
            </a>
          </li>
          <li>
            <a href="{{ route('datakendaraan.index') }}" class="group flex items-center p-3 bg-red-600 rounded-xl hover:bg-white transition-colors duration-300">
              <div class="flex items-center justify-center w-8 h-8 text-neutral-50 bg-red-600 rounded-lg mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                  <path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 18.375V5.625zM21 9.375A.375.375 0 0020.625 9h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zm0 3.75a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zm0 3.75a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zM10.875 18.75a.375.375 0 00.375-.375v-1.5a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5zM3.375 15h7.5a.375.375 0 00.375-.375v-1.5a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375zm0-3.75h7.5a.375.375 0 00.375-.375v-1.5A.375.375 0 0010.875 9h-7.5A.375.375 0 003 9.375v1.5c0 .207.168.375.375.375z" clip-rule="evenodd" />
                </svg>
              </div>
              <span class="text-white group-hover:text-red-600 font-bold transition-colors duration-300">Data Kendaraan</span>
            </a>
          </li>
          <li>
            <a href="#" class="group flex items-center p-3 bg-white rounded-xl hover:bg-white transition-colors duration-300">
              <div class="flex items-center justify-center w-8 h-8 text-neutral-50 bg-red-600 rounded-lg mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                  <path fill-rule="evenodd" d="M12 6.75a5.25 5.25 0 016.775-5.025.75.75 0 01.313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 011.248.313 5.25 5.25 0 01-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 112.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0112 6.75zM4.117 19.125a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75h-.008a.75.75 0 01-.75-.75v-.008z" clip-rule="evenodd" />
                  <path d="M10.076 8.64l-2.201-2.2V4.874a.75.75 0 00-.364-.643l-3.75-2.25a.75.75 0 00-.916.113l-.75.75a.75.75 0 00-.113.916l2.25 3.75a.75.75 0 00.643.364h1.564l2.062 2.062 1.575-1.297z" />
                  <path fill-rule="evenodd" d="M12.556 17.329l4.183 4.182a3.375 3.375 0 004.773-4.773l-3.306-3.305a6.803 6.803 0 01-1.53.043c-.394-.034-.682-.006-.867.042a.589.589 0 00-.167.063l-3.086 3.748zm3.414-1.36a.75.75 0 011.06 0l1.875 1.876a.75.75 0 11-1.06 1.06L15.97 17.03a.75.75 0 010-1.06z" clip-rule="evenodd" />
                </svg>
              </div>
              <span class="text-red-600 font-bold">Suku Cadang</span>
            </a>
          </li>
        </ul>
        <div class="border-t border-gray-100 my-4"></div>
        
        <!-- Tombol Logout -->
        <div class="p-3 mt-2 pt-[450px]">
          <a href="#" class="flex items-center justify-center p-3 bg-red-500 text-white rounded-xl shadow-md hover:from-red-700 hover:to-red-600 transition-all transform hover:-translate-y-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
              <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm5.03 4.72a.75.75 0 010 1.06l-1.72 1.72h10.94a.75.75 0 010 1.5H10.81l1.72 1.72a.75.75 0 11-1.06 1.06l-3-3a.75.75 0 010-1.06l3-3a.75.75 0 011.06 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-white group-hover:text-neutral-50 font-bold transition-colors duration-300">Keluar</span>
          </a>
        </div>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-0 md:ml-64 p-4 md:p-8 transition-all duration-300 mt-16">
      <!-- Search Input -->
      <div class="mb-6 mt-4 relative">
        <input
          type="text"
          id="searchInput"
          placeholder="Cari Nama Sparepart/Deskripsi"
          class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
        />
        <svg
          class="absolute right-3 top-3 w-5 h-5 text-gray-400"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z" />
        </svg>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto" id="tableContainer">
        <table class="min-w-full border border-red-600">
          <thead>
            <tr class="bg-red-600 text-white text-left">
              <th class="px-4 py-2 border-r border-red-400">No</th>
              <th class="px-4 py-2 border-r border-red-400">Nama Sparepart</th>
              <th class="px-4 py-2 border-r border-red-400">Deskripsi</th>
              <th class="px-4 py-2 border-r border-red-400">Harga</th>
              <th class="px-4 py-2 border-r border-red-400">Ketersediaan</th>
              <th class="px-4 py-2 border-r border-red-400">Aksi</th>
            </tr>
          </thead>
          <tbody class="text-gray-700" id="sparepartsTableBody">
            <!-- Data will be inserted here by JavaScript -->
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <script>
    // Firebase configuration
    const firebaseConfig = {
      apiKey: "AIzaSyB-FBt737Xr163ElsjnofcHkSVXqYVK618",
      authDomain: "my-akastra-app.firebaseapp.com",
      projectId: "my-akastra",
      storageBucket: "my-akastra.firebasestorage.app",
      messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
      appId: "1:983577813931:android:3ddc40de72673f8b6068ee"
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    const db = firebase.firestore();

    // Function to fetch and display spareparts data
    async function fetchSpareparts() {
      const tableBody = document.getElementById('sparepartsTableBody');
      tableBody.innerHTML = '<tr><td colspan="6" class="text-center py-4">Memuat data...</td></tr>';

      try {
        const snapshot = await db.collection("spareparts").orderBy("createdAt", "desc").get();
        tableBody.innerHTML = '';

        let rowNumber = 1;
        snapshot.forEach((doc) => {
          const data = doc.data();
          const availabilityClass = data.available ? 'available' : 'not-available';
          const availabilityText = data.available ? 'Available' : 'Not Available';

          const row = `
            <tr class="border-t border-gray-200 hover:bg-gray-50">
              <td class="px-4 py-2">${rowNumber}</td>
              <td class="px-4 py-2 font-medium">${data.name || '-'}</td>
              <td class="px-4 py-2">${data.description || '-'}</td>
              <td class="px-4 py-2">${formatCurrency(data.price) || '-'}</td>
              <td class="px-4 py-2 ${availabilityClass}">${availabilityText}</td>
              <td class="px-4 py-2">
                <button onclick="editSparepart('${doc.id}')" class="text-blue-500 hover:text-blue-700 mr-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                  </svg>
                </button>
                <button onclick="deleteSparepart('${doc.id}')" class="text-red-500 hover:text-red-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                  </svg>
                </button>
              </td>
            </tr>
          `;
          tableBody.innerHTML += row;
          rowNumber++;
        });

      } catch (error) {
        console.error("Error getting documents: ", error);
        tableBody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>';
      }
    }

    // Format currency (IDR)
    function formatCurrency(amount) {
      if (!amount) return 'Rp.0';
      return 'Rp.' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Edit sparepart function
    function editSparepart(id) {
      // Implement edit functionality
      console.log("Edit sparepart with ID:", id);
      // You can redirect to edit page or show a modal
      // window.location.href = `/spareparts/edit/${id}`;
    }

    // Delete sparepart function
    function deleteSparepart(id) {
      if (confirm("Apakah Anda yakin ingin menghapus suku cadang ini?")) {
        db.collection("spareparts").doc(id).delete()
          .then(() => {
            alert("Suku cadang berhasil dihapus");
            fetchSpareparts(); // Refresh the list
          })
          .catch((error) => {
            console.error("Error removing document: ", error);
            alert("Gagal menghapus suku cadang");
          });
      }
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      const rows = document.querySelectorAll('#sparepartsTableBody tr');
      
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
      });
    });

    // Toggle Sidebar for Mobile
    document.getElementById('toggleSidebar').addEventListener('click', function() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('-translate-x-full');
    });

    // Hide loading animation when page is loaded
    window.addEventListener('load', function() {
      setTimeout(function() {
        document.querySelector('.loading-animation').style.display = 'none';
        fetchSpareparts(); // Load data after page is loaded
      }, 500);
    });

    // Real-time listener for data changes
    db.collection("spareparts").orderBy("createdAt", "desc")
      .onSnapshot((querySnapshot) => {
        fetchSpareparts(); // Refresh data when changes occur
      });
  </script>
</body>
</html>